<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLedger;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = UserLedger::orderBy('created_at', 'desc')->get();
        $users = User::role('user')->select('username')->get();
        // dd( $users);
        return view('admin.transactions.index', compact('transactions', 'users'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'type' => 'nullable',
            'date_range' => 'nullable'
        ]);

        $query = UserLedger::whereHas('user', function ($q) use ($request) {
            $q->where('username', $request->username);
        });

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->date_range) {
            [$start, $end] = explode(' - ', $request->date_range);
            $query->whereBetween('date_range', [$start, $end]);
        }

        return response()->json([
            'transactions' => $query->latest()->get()
        ]);
    }
}
