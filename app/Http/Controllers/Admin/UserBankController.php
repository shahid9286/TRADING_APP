<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBank;
use App\Models\User;

class UserBankController extends Controller
{
    public function index()
    {
        $user_banks = UserBank::with('user')->get();
        return view('admin.user-banks.index', compact('user_banks'));
    }

    public function add()
    {
        $users = User::select('id', 'name')->get();
        return view('admin.user-banks.add', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'bank_name'  => 'required|string|max:255',
            'account_no' => 'required|string|max:255|unique:user_banks,account_no',
        ]);

        $user_bank = new UserBank();
        $user_bank->user_id    = $request->user_id;
        $user_bank->bank_name  = $request->bank_name;
        $user_bank->account_no = $request->account_no;
        $user_bank->save();

        $notification = array(
            'message' => 'User Banks Added Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.user-banks.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $user_bank = UserBank::findOrFail($id);
        $users = User::select('id', 'name')->get();
        return view('admin.user-banks.edit', compact('user_bank', 'users'));
    }

    public function update(Request $request, $id)
    {
        $user_bank = UserBank::findOrFail($id);

        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'bank_name'  => 'required|string|max:255',
            'account_no' => 'required|string|max:255|unique:user_banks,account_no,' . $user_bank->id,
        ]);

        $user_bank->user_id    = $request->user_id;
        $user_bank->bank_name  = $request->bank_name;
        $user_bank->account_no = $request->account_no;
        $user_bank->save();

        $notification = array(
            'message' => 'User Banks Updated Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.user-banks.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $user_bank = UserBank::findOrFail($id);
        $user_bank->delete();

        $notification = [
            'message' => 'User Bank Deleted Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.user-banks.index')->with('notification', $notification);
    }
}
