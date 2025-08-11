<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Investment;
use App\Models\UserReturn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserReturnController extends Controller
{
    public function index()
    {
        $user_returns = UserReturn::with(['investment', 'user'])->get();
        return view('admin.user_returns.index', compact('user_returns'));
    }

    public function add()
    {
        $users = User::all();
        $investments = Investment::all();
        return view('admin.user_returns.add', compact('users', 'investments'));
    }

public function store(Request $request)
{
    $request->validate([
        'investment_id' => 'required|exists:investments,id',
        'user_id'       => 'required|exists:users,id',
        'amount'        => 'required|numeric|min:0',
        'type'          => 'required|string',
    ]);

    // Fetch the investment
    $investment = Investment::find($request->investment_id);

    UserReturn::create([
        'investment_id' => $request->investment_id,
        'user_id'       => $request->user_id,
        'amount'        => $request->amount,
        'type'          => $request->type,
        'entry_date'    => $investment->created_at->toDateString(), // Now safe
    ]);

    $notification = [
        'message' => 'User Return Added Successfully!',
        'alert'   => 'success',
    ];

    return redirect()->route('admin.user_returns.index')
                     ->with('notification', $notification);
}
    public function edit($id)
    {
        $user_return = UserReturn::findOrFail($id);
        $users = User::all();
        $investments = Investment::all();


        return view('admin.user_returns.edit', compact('user_return', 'users', 'investments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'investment_id' => 'required|exists:investments,id',
            'user_id'       => 'required|exists:users,id',
            'amount'        => 'required|numeric|min:0',
            'type'          => 'required|in:daily-return,monthly-commission,referral-commission,rewards,admin-fee'
        ]);
        $user_return = UserReturn::findOrFail($id); 
            $investment = Investment::findOrFail($request->investment_id);

    $user_return->update([
        'investment_id' => $request->investment_id,
        'user_id'       => $request->user_id,
        'amount'        => $request->amount,
        'type'          => $request->type,
        'entry_date'    => $investment->created_at->toDateString(), 
    ]);

        $notification = array(
            'message' => 'User Return Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.user_returns.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $user_returns = UserReturn::findOrFail($id);

        $user_returns->delete();

        $notification = array(
            'message' => 'User Return Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function restorePage()
    {

        $returns = UserReturn::onlyTrashed()->get();
        return view('admin.user_returns.restore', compact('returns'));
    }

    public function restore($id)
    {
        $returns = UserReturn::withTrashed()->find($id);
        $returns->restore();

        $notification = array(
            'message' => 'User Return Restored Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $returns = UserReturn::withTrashed()->find($id);

        $returns->forceDelete();

        $notification = array(
            'message' => 'User Return Permanently Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
