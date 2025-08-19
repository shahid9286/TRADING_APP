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

    if ($request->filled('transaction_id')) {
        $query->where('transaction_id', $request->transaction_id);
    }

    if ($request->filled('date_range')) {
        $dates = explode(' - ', $request->date_range); // ["2025-08-01", "2025-08-19"]

        if (count($dates) === 2) {
            $startDate = $dates[0];
            $endDate = $dates[1];

            $query->whereBetween('start_date', [$startDate, $endDate]);
        }
    }

    // ✅ Filter by Amount
    if ($request->filled('amount')) {
        $query->where('amount', $request->amount);
    }

    // ✅ Filter by Status
    if ($request->filled('status')) {
        $query->where('is_active', $request->status); // ✅ matches your Blade
    }

    // Get results
    $investments = $query->get();

    // Return partial table HTML
    $html = view('admin.investment.table', compact('investments'))->render();

    return response()->json(['html' => $html]);
}
}
