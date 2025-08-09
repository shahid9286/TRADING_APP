<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Investment;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    public function index()
    {
    $investments = Investment::with('user')->get();
    return view('admin.investment.index', compact('investments'));
    }

public function add()
{
    $users = User::select('id', 'username', 'email')->get();
    return view('admin.investment.add', compact('users'));
}

    public function store(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:0',
            'is_active'     => 'required|boolean',
            'transaction_id' => 'nullable|string|max:255|unique:investments,transaction_id,' . $id,
            'screenshot'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id'        => 'required|exists:users,id',
            'referral_id'    => 'nullable|exists:users,id',
            'status'         => 'required|in:pending,approved,rejected',
        ]);

    $investment = new Investment();
    $investment->amount = $request->amount;
    $investment->start_date = now();
    $investment->expiry_date = Carbon::now()->addYear();
    $investment->status = $request->status;
    $investment->transaction_id = $request->transaction_id;
    $investment->user_id = $request->user_id;
    $investment->referral_id = $request->referral_id;
    $investment->is_active = $request->boolean('is_active');
    $investment->added_by = Auth::id();

    if ($request->hasFile('screenshot')) {
        $investment->screenshot = FileHelper::upload(
            $request->file('screenshot'),
            'assets/admin/uploads/investments/screenshots'
        );
    }

        $investment->save();

        $notification = array(
            'message' => 'Investment Added Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.investment.index')->with('notification', $notification);
    }

    public function edit($id)
    {
    $investment = Investment::findOrFail($id);
    $users = User::select('id', 'username', 'email')->get();
    return view('admin.investment.edit', compact('investment', 'users'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'amount'         => 'required|numeric|min:0',
        'is_active'      => 'required|boolean',
        'transaction_id' => 'required|string|max:255|unique:investments,transaction_id,' . $id,
        'screenshot'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'user_id'        => 'required|exists:users,id',
        'referral_id'    => 'nullable|exists:users,id',
        'status'         => 'required|in:pending,approved,rejected',
    ]);

    $investment = Investment::findOrFail($id);

    $investment->amount = $request->amount;
    $investment->start_date = now();
    $investment->expiry_date = Carbon::now()->addYear(); 
    $investment->status = $request->status;
    $investment->transaction_id = $request->transaction_id;
    $investment->user_id = $request->user_id;
    $investment->referral_id = $request->referral_id;
    $investment->is_active = $request->boolean('is_active');
    $investment->updated_by = Auth::id();

    if ($request->hasFile('screenshot')) {
        $investment->screenshot = FileHelper::update(
            $investment->screenshot,
            $request->file('screenshot'),
            'assets/admin/uploads/investments/screenshots'
        );
    }

        $investment->save();

        $notification = array(
            'message' => 'Investment Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.investment.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $investments = Investment::find($id);

        $investments->delete();

        $notification = array(
            'message' => 'Investment Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function restorePage()
    {

        $investment = Investment::onlyTrashed()->get();
        return view('admin.investment.restore', compact('Investment'));
    }

    public function restore($id)
    {
        $rewards = Investment::withTrashed()->find($id);
        $rewards->restore();

        $notification = array(
            'message' => 'Investment Restored Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $rewards = Investment::withTrashed()->find($id);

        $rewards->forceDelete();

        $notification = array(
            'message' => 'Investment Permanently Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
