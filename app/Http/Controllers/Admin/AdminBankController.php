<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminBank;

class AdminBankController extends Controller
{
    public function index()
    {
        $banks = AdminBank::all();
        return view('admin.admin_banks.index', compact('banks'));
    }

    public function add()
    {
        return view('admin.admin_banks.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'account_no' => 'required|string|max:255|unique:admin_banks,account_no',
            'status'     => 'required|in:active,inactive',
            'order_no'   => 'required|integer|min:0',
            'notes'      => 'nullable|string',
        ]);

        $bank = new AdminBank();
        $bank->name = $request->name;
        $bank->account_no = $request->account_no;
        $bank->status = $request->status;
        $bank->order_no = $request->order_no;
        $bank->notes = $request->notes;
        $bank->save();

        $notification = [
            'message' => 'Bank Added Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.admin_banks.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $bank = AdminBank::find($id);
        return view('admin.admin_banks.edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $bank = AdminBank::find($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'account_no' => 'required|string|max:255|unique:admin_banks,account_no,' . $bank->id,
            'status'     => 'required|in:active,inactive',
            'order_no'   => 'required|integer|min:0',
            'notes'      => 'nullable|string',
        ]);

        $bank->name = $request->name;
        $bank->account_no = $request->account_no;
        $bank->status = $request->status;
        $bank->order_no = $request->order_no;
        $bank->notes = $request->notes;
        $bank->save();

        $notification = [
            'message' => 'Bank Updated Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.admin_banks.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $bank = AdminBank::find($id);
        $bank->save();
        $bank->delete();

        $notification = [
            'message' => 'Bank Deleted Successfully!',
            'alert'   => 'success'
        ];

        return redirect()->route('admin.admin_banks.index')->with('notification', $notification);
    }

    public function restorePage()
    {
        $banks = AdminBank::onlyTrashed()->get();
        return view('admin.admin_banks.restore', compact('banks'));
    }

    public function restore($id)
    {
        $bank = AdminBank::withTrashed()->find($id);
        $bank->restore();

        $notification = [
            'message' => 'Bank Restored Successfully!',
            'alert'   => 'success'
        ];

        return back()->with('notification', $notification);
    }

    public function forceDelete($id)
    {
        $bank = AdminBank::withTrashed()->find($id);
        $bank->forceDelete();

        $notification = [
            'message' => 'Bank Permanently Deleted Successfully!',
            'alert'   => 'success'
        ];

        return back()->with('notification', $notification);
    }
}
