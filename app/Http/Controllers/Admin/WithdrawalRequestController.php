<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use App\Models\AdminBank;
use App\Models\UserBank;
use App\Models\User;

class WithdrawalRequestController extends Controller
{
    public function index()
    {
        $withdrawal_requests = WithdrawalRequest::with('user', 'adminBank', 'userBank')->get();
        return view('admin.withdrawal-request.index', compact('withdrawal_requests'));
    }

    public function add()
    {
        $users = User::select('id', 'username')->get();
        $banks = AdminBank::select('id', 'name')->get();
        $user_banks = UserBank::select('id', 'bank_name')->get();

        return view('admin.withdrawal-request.add', compact('users', 'banks', 'user_banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'admin_bank_id'    => 'nullable|exists:admin_banks,id',
            'user_bank_id'     => 'nullable|exists:user_banks,id',
            'request_date'     => 'required|date',
            'requested_amount' => 'required|numeric|min:0',
            'status'           => 'required|in:pending,approved,rejected,completed',
            'approval_date'    => 'nullable|date',
            'payout_date'      => 'nullable|date',
            'payout_amount'    => 'nullable|numeric|min:0',
            'fee'              => 'nullable|numeric|min:0',
            'total_payout'     => 'nullable|numeric|min:0',
            'transaction_id'   => 'nullable|string|max:255',
            'screenshot'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'client_status'    => 'required|in:pending,verified',
        ]);

        $withdrawal_request = new WithdrawalRequest();
        $withdrawal_request->user_id         = $request->user_id;
        $withdrawal_request->admin_bank_id   = $request->admin_bank_id;
        $withdrawal_request->user_bank_id    = $request->user_bank_id;
        $withdrawal_request->request_date    = $request->request_date;
        $withdrawal_request->requested_amount = $request->requested_amount;
        $withdrawal_request->status          = $request->status;
        $withdrawal_request->approval_date   = $request->approval_date;
        $withdrawal_request->payout_date = $request->payout_date;
        $withdrawal_request->payout_amount   = $request->payout_amount;
        $withdrawal_request->fee             = $request->fee;
        $withdrawal_request->total_payout    = $request->total_payout;
        $withdrawal_request->transaction_id  = $request->transaction_id;
        $withdrawal_request->client_status   = $request->client_status;

        // Screenshot upload
        if ($request->hasFile('screenshot')) {
            $file = $request->file('screenshot');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . rand() . '.' . $extension;
            $file->move(public_path('assets/admin/uploads/withdrawal_request/'), $filename);
            $withdrawal_request->screenshot = $filename;
        }

        $withdrawal_request->save();

        $notification = [
            'message' => 'Withdrawal Request Added Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.withdrawal-request.index')->with('notification', $notification);
    }


    public function edit($id)
    {
        $withdrawal_request = WithdrawalRequest::findOrFail($id);

        $users = User::select('id', 'username')->get();
        $banks = AdminBank::select('id', 'name')->get();
        $user_banks = UserBank::select('id', 'bank_name')->get();

        return view('admin.withdrawal-request.edit', compact('withdrawal_request', 'users', 'banks', 'user_banks'));
    }

    public function update(Request $request, $id)
    {
        $withdrawal_request = WithdrawalRequest::findOrFail($id);

        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'admin_bank_id'    => 'nullable|exists:admin_banks,id',
            'user_bank_id'     => 'nullable|exists:user_banks,id',
            'request_date'     => 'required|date',
            'requested_amount' => 'required|numeric|min:0',
            'status'           => 'required|in:pending,approved,rejected,completed',
            'approval_date'    => 'nullable|date',
            'payout_date'      => 'nullable|date',
            'payout_amount'    => 'nullable|numeric|min:0',
            'fee'              => 'nullable|numeric|min:0',
            'total_payout'     => 'nullable|numeric|min:0',
            'transaction_id'   => 'nullable|string|max:255',
            'screenshot'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'client_status'    => 'required|in:pending,verified',
        ]);

        $withdrawal_request->user_id         = $request->user_id;
        $withdrawal_request->admin_bank_id   = $request->admin_bank_id;
        $withdrawal_request->user_bank_id    = $request->user_bank_id;
        $withdrawal_request->request_date    = $request->request_date;
        $withdrawal_request->requested_amount = $request->requested_amount;
        $withdrawal_request->status          = $request->status;
        $withdrawal_request->approval_date   = $request->approval_date;
        $withdrawal_request->payout_date = $request->payout_date;
        $withdrawal_request->payout_amount   = $request->payout_amount;
        $withdrawal_request->fee             = $request->fee;
        $withdrawal_request->total_payout    = $request->total_payout;
        $withdrawal_request->transaction_id  = $request->transaction_id;
        $withdrawal_request->client_status   = $request->client_status;

        // Screenshot update logic
        if ($request->hasFile('screenshot')) {
            // Purani file delete karo
            if ($withdrawal_request->screenshot && file_exists(public_path('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->screenshot))) {
                unlink(public_path('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->screenshot));
            }

            // New file upload
            $file = $request->file('screenshot');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . rand() . '.' . $extension;
            $file->move(public_path('assets/admin/uploads/withdrawal_request/'), $filename);
            $withdrawal_request->screenshot = $filename;
        }

        $withdrawal_request->save();

        $notification = [
            'message' => 'Withdrawal Request Updated Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.withdrawal-request.index')->with('notification', $notification);
    }


    public function delete($id)
    {
        $withdrawal_request = WithdrawalRequest::findOrFail($id);
        @unlink('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->image);
        $withdrawal_request->delete();

        $notification = [
            'message' => 'Withdrawal Request Deleted Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.withdrawal-request.index')->with('notification', $notification);
    }
}
