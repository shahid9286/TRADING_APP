<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminBank;
use App\Models\Investment;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

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
    $bankAccounts = AdminBank::all();
    
    return view('admin.investment.add', compact('users', 'bankAccounts'));
}

    public function store(Request $request)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:0',
            'is_active'      => 'required|in:active,expired',
            'transaction_id' => 'required|string|max:255|unique:investments,transaction_id',
            'screenshot'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id'        => 'required|exists:users,id',
            'referral_id'    => 'nullable|exists:users,id',
            'admin_bank_id' => 'required|exists:admin_banks,id',
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
        $investment->is_active = $request->is_active;
        $investment->admin_bank_id = $request->admin_bank_id;

        if ($request->hasFile('screenshot')) {
            $investment->screenshot = FileHelper::upload(
                $request->file('screenshot'),
                'assets/admin/uploads/investments/screenshots'
            );
        }

        $investment->save();

        return redirect()->route('admin.investment.index')
            ->with(['message' => 'Investment Added Successfully!', 'alert' => 'success']);
    }

public function edit($id)
{
    $investment = Investment::findOrFail($id);
    $users = User::select('id', 'username', 'email')->get();
    $bankAccounts = AdminBank::all();

    return view('admin.investment.edit', compact('investment', 'users', 'bankAccounts'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:0',
            'is_active'      => 'required|in:active,expired',
            'transaction_id' => 'required|string|max:255|unique:investments,transaction_id,' . $id,
            'screenshot'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id'        => 'required|exists:users,id',
            'referral_id'    => 'nullable|exists:users,id',
            'admin_bank_id' => 'required|exists:admin_banks,id',
            'status'         => 'required|in:pending,approved,rejected',
        ]);

        $investment = Investment::findOrFail($id);

        $investment->amount = $request->amount;
        $investment->status = $request->status;
        $investment->transaction_id = $request->transaction_id;
        $investment->user_id = $request->user_id;
        $investment->referral_id = $request->referral_id;
        $investment->is_active = $request->is_active;
        $investment->admin_bank_id = $request->admin_bank_id;

        if ($request->hasFile('screenshot')) {
            $investment->screenshot = FileHelper::update(
                $investment->screenshot,
                $request->file('screenshot'),
                'assets/admin/uploads/investments/screenshots'
            );
        }

        $investment->save();

        return redirect()->route('admin.investment.index')
            ->with(['message' => 'Investment Updated Successfully!', 'alert' => 'success']);
    }

    public function delete($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->delete();

        return back()->with(['message' => 'Investment Deleted Successfully!', 'alert' => 'success']);
    }

    public function restorePage()
    {
        $investments = Investment::onlyTrashed()->get();
        return view('admin.investment.restore', compact('investments'));
    }

    public function restore($id)
    {
        $investment = Investment::withTrashed()->findOrFail($id);
        $investment->restore();

        return back()->with(['message' => 'Investment Restored Successfully!', 'alert' => 'success']);
    }

    public function forceDelete($id)
    {
        $investment = Investment::withTrashed()->findOrFail($id);
        $investment->forceDelete();

        return back()->with(['message' => 'Investment Permanently Deleted Successfully!', 'alert' => 'success']);
    }
}
