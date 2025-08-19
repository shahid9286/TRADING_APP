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
   public function index(Request $request)
{
    $query = WithdrawalRequest::with('user', 'adminBank', 'userBank');

    
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    $withdrawal_requests = $query->get();

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

}
