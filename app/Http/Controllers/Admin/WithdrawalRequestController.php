<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;
use App\Models\AdminBank;
use App\Models\BusinessRule;
use App\Models\SystemLog;
use App\Models\User;
use App\Models\UserReturn;
use App\Models\UserTotal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalRequestController extends Controller
{
    public function index()
    {
        $withdrawal_requests = WithdrawalRequest::with('user')->orderBy('id', 'desc')->get();
        return view('admin.withdrawal-request.index', compact('withdrawal_requests'));
    }

    public function delete($id)
    {
        $withdrawal_request = WithdrawalRequest::findOrFail($id);


        if ($withdrawal_request->status !== 'pending') {
            $notification = [
                'message' => 'Approved request cannot be deleted!',
                'alert'   => 'error'
            ];
            return redirect()->route('admin.withdrawal-request.index')->with('notification', $notification);
        }

        @unlink('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->image);
        $withdrawal_request->delete();

        $notification = [
            'message' => 'Withdrawal Request Deleted Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.withdrawal-request.index')->with('notification', $notification);
    }
    public function search(Request $request)
    {
        $query = WithdrawalRequest::with('user', 'adminBank', 'userBank');
        // 🔎 Filter by User ID
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('requested_amount')) {
            $amount = str_replace(',', '', $request->requested_amount);
            $query->where('requested_amount', $amount);
        }


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('request_date')) {
            $query->where('request_date', $request->request_date);
        }

        $withdrawal_requests = $query->get();

        // Return partial table
        $html = view('admin.withdrawal-request.table', compact('withdrawal_requests'))->render();
        return response()->json(['html' => $html]);
    }

    public function detail($id)
    {
        $admin_banks = AdminBank::where('status', 'active')->get();
        $withdrawal_request = WithdrawalRequest::with('user', 'adminBank', 'userBank')->findOrFail($id);
        return view('admin.withdrawal-request.detail', compact('withdrawal_request', 'admin_banks'));
    }

    public function approve(Request $request)
    {
        try {
            $request->validate([
                'withdrawal_request_id' => 'required|exists:withdrawal_requests,id',
                'payout_date' => 'required|date|after_or_equal:today',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert'   => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        DB::beginTransaction();

        $withdrawal_request = WithdrawalRequest::findOrFail($request->withdrawal_request_id);
        $business_rules = BusinessRule::first();

        if ($withdrawal_request->status === 'pending') {
            $withdrawal_request->status = 'approved';
            $withdrawal_request->payout_date = $request->payout_date;
            $withdrawal_request->approval_date = Carbon::now();
            $withdrawal_request->fee = ($business_rules->payout_fee_rate / 100) * $withdrawal_request->requested_amount;
            $withdrawal_request->payout_amount = $withdrawal_request->requested_amount - $withdrawal_request->fee;
            $withdrawal_request->total_payout = $withdrawal_request->requested_amount;
            $withdrawal_request->save();

            SystemLog::createLog([
                'module' => 'withdrawal_request',
                'action' => 'pay_withdrawal_request',
                'loggable_id' => $withdrawal_request->id,
                'loggable_type' => WithdrawalRequest::class,
                'affected_user_id' => $withdrawal_request->user_id,
                'description' => "Withdrawal Request #{$withdrawal_request->id} approved for {$withdrawal_request->user->username}",
                'details' => "Amount: $" . number_format($withdrawal_request->requested_amount, 2),
                'metadata' => [
                    'requested_amount' => $withdrawal_request->amount,
                    'payout_date' => $withdrawal_request->payout_date,
                    'approved_by' => auth()->user()->username,
                ]
            ]);

            DB::commit();

            return redirect()->back()->with('notification', [
                'message' => 'Request approved!',
                'alert'   => 'success'
            ]);
        }

        DB::rollBack();

        return redirect()->back()->with('notification', [
            'message' => 'Request cannot be approved!',
            'alert'   => 'error'
        ]);
    }

    public function reject(Request $request)
    {
        try {
            $request->validate([
                'withdrawal_request_id' => 'required|exists:withdrawal_requests,id',
                'remarks' => 'required|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert'   => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        DB::beginTransaction();

        $withdrawal_request = WithdrawalRequest::findOrFail($request->withdrawal_request_id);

        if ($withdrawal_request->status !== 'pending') {
            return redirect()->back()->with('notification', [
                'message' => 'Request cannot be rejected!',
                'alert'   => 'error'
            ]);
        }

        $withdrawal_request->status = 'rejected';
        $withdrawal_request->remarks = $request->remarks;
        $withdrawal_request->save();

        SystemLog::createLog([
            'module' => 'withdrawal_request',
            'action' => 'pay_withdrawal_request',
            'loggable_id' => $withdrawal_request->id,
            'loggable_type' => WithdrawalRequest::class,
            'affected_user_id' => $withdrawal_request->user_id,
            'description' => "Withdrawal Request #{$withdrawal_request->id} rejected for {$withdrawal_request->user->username}",
            'details' => "Amount: $" . number_format($withdrawal_request->requested_amount, 2),
            'metadata' => [
                'requested_amount' => $withdrawal_request->amount,
                'approved_by' => auth()->user()->username,
                'remarks' => $withdrawal_request->amount,
            ]
        ]);

        DB::commit();

        return redirect()->back()->with('notification', [
            'message' => 'Request rejected!',
            'alert'   => 'success'
        ]);
    }


    public function pay(Request $request)
    {
        try {
            $request->validate([
                'withdrawal_request_id' => 'required|exists:withdrawal_requests,id',
                'transaction_id' => 'required|max:255',
                'screenshot' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1024',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert'   => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }

        DB::beginTransaction();

        $withdrawal_request = WithdrawalRequest::findOrFail($request->withdrawal_request_id);

        if ($withdrawal_request->status !== 'approved') {
            return redirect()->back()->with('notification', [
                'message' => 'Request cannot be paid!',
                'alert'   => 'error'
            ]);
        }

        $withdrawal_request->payment_status = 'paid';
        $withdrawal_request->transaction_id = $request->transaction_id;
        $withdrawal_request->admin_bank_id = $request->admin_bank_id;
        $file = $request->file('screenshot');
        $extension = $file->getClientOriginalExtension();
        $screenshot = time() . rand() . '.' . $extension;
        $file->move('assets/admin/withdrawal_request/screenshots/', $screenshot);
        $withdrawal_request->screenshot = 'assets/admin/withdrawal_request/screenshots/' . $screenshot;

        $withdrawal_request->save();

        $user = User::findOrFail($withdrawal_request->user_id);

        SystemLog::createLog([
            'module' => 'withdrawal_request',
            'action' => 'pay_withdrawal_request',
            'loggable_id' => $withdrawal_request->id,
            'loggable_type' => WithdrawalRequest::class,
            'affected_user_id' => $withdrawal_request->user_id,
            'description' => "Withdrawal Request #{$withdrawal_request->id} paid for {$user->username}",
            'details' => "Amount: $" . number_format($withdrawal_request->requested_amount, 2),
            'metadata' => [
                'requested_amount' => $withdrawal_request->amount,
                'approved_by' => Auth::user()->username,
            ]
        ]);

        $user_return = UserReturn::create([
            'user_id' => $user->id,
            'amount' => $withdrawal_request->requested_amount,
            'type' => 'withdrawal',
            'description' => "Withdrawal Request #{$withdrawal_request->id} paid",
            'status' => 'completed',
            'withdrawal_request_id' => $withdrawal_request->id,  
            'entry_date' => Carbon::now(),  
            'created_at' => Carbon::now(),
        ]);

        UserLedger::create([
            'user_id' => $user->id,
            'user_return_id' => $user_return->id,
            'type' => 'withdrawal',
            'amount' => $withdrawal_request->requested_amount,
            'description' => "Withdrawal Request #{$withdrawal_request->id} paid",
            'balance_before' => $user->net_balance,
            'balance_after' => $user->net_balance - $withdrawal_request->requested_amount,
        ]);

        $user_total = UserTotal::findOrFail($user->id);

        $user->net_balance -= $withdrawal_request->requested_amount;
        $user->locked_amount -= $withdrawal_request->requested_amount;

        $user_total->total_fee += $withdrawal_request->fee;
        $user_total->total_withdraws += $withdrawal_request->requested_amount;

        $user_total->save();

        $user->save();

        DB::commit();

        return redirect()->back()->with('notification', [
            'message' => 'Request rejected!',
            'alert'   => 'success'
        ]);
    }
}
