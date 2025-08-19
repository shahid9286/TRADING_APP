<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminBank;
use App\Models\Investment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('user')->get();
        return view('admin.investment.index', compact('investments'));
    }

public function search(Request $request)
{
    $query = Investment::query();

    // Filter by Transaction ID
    if ($request->filled('transaction_id')) {
        $query->where('transaction_id', $request->transaction_id);
    }

    if ($request->filled('date_range')) {
        $dates = explode(' - ', $request->date_range);
        if (count($dates) === 2) {
            $startDate = \Carbon\Carbon::parse($dates[0])->startOfDay();
            $endDate   = \Carbon\Carbon::parse($dates[1])->endOfDay();

            $query->whereBetween('start_date', [$startDate, $endDate]);
        }
    }

    // Filter by Amount
    if ($request->filled('amount')) {
        $query->where('amount', $request->amount);
    }

    // Filter by Status
    if ($request->filled('is_active')) {
        $query->where('is_active', $request->is_active);
    }

    $investments = $query->get();

    $html = view('admin.investment.table', compact('investments'))->render();
    return response()->json(['html' => $html]);
}
}
