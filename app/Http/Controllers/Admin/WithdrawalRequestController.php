<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;

class WithdrawalRequestController extends Controller
{
    public function index(Request $request)
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
}
