<?php

namespace App\Http\Controllers\Admin;

use App\Services\InvestmentApprovalService;
use App\Models\SystemLog;
use App\Models\Investment;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('user')->orderBy('id', 'desc')->get();
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
                $endDate = \Carbon\Carbon::parse($dates[1])->endOfDay();

                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('expiry_date', [$startDate, $endDate])
                        ->orWhere(function ($q2) use ($startDate, $endDate) {
                            $q2->where('start_date', '<=', $startDate)
                                ->where('expiry_date', '>=', $endDate);
                        });
                });
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

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $investments = $query->orderBy('id', 'desc')->get();

        $html = view('admin.investment.table', compact('investments'))->render();
        return response()->json(['html' => $html]);
    }


    public function investmentApproved($id)
    {
        try {
            $investmentApprovalService = new InvestmentApprovalService();
            $result = $investmentApprovalService->approveInvestment($id);

            $notification = [
                'alert' => 'success',
                'message' => $result['message']
            ];

            return redirect()->back()->with('notification', $notification);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            SystemLog::createLog([
                'module' => 'investment',
                'action' => 'investment_approval_failed',
                'log_level' => 'error',
                'description' => 'Model not found during investment approval',
                'details' => $e->getMessage(),
                'metadata' => ['investment_id' => $id]
            ]);

            $notification = [
                'alert' => 'error',
                'message' => 'Investment or user not found.'
            ];

            return redirect()->back()->with('notification', $notification);
        } catch (\Exception $e) {
            SystemLog::createLog([
                'module' => 'investment',
                'action' => 'investment_approval_failed',
                'log_level' => 'error',
                'description' => 'Error during investment approval',
                'details' => $e->getMessage(),
                'metadata' => [
                    'investment_id' => $id,
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ]);

            $notification = [
                'alert' => 'error',
                'message' => 'Failed to approve investment: ' . $e->getMessage()
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function investmentReject($id)
    {
        $investment = Investment::find($id);
        if ($investment) {
            $investment->status = 'rejected';
            $investment->is_active = 'inactive';
            $investment->save();

            SystemLog::createLog([
                'module' => 'investment',
                'action' => 'investment_rejected',
                'loggable_id' => $investment->id,
                'loggable_type' => Investment::class,
                'affected_user_id' => $investment->user->id,
                'description' => "Investment #{$investment->id} approved for {$investment->user->username}",
                'details' => "Amount: $" . number_format($investment->amount, 2),
                'metadata' => [
                    'investment_amount' => $investment->amount,
                    'rejected_by' => Auth::user()->username,
                    'rejection_date' => today()
                ]
            ]);

            $notification = array(
                'message' => 'Investment Rejected Successfully!',
                'alert' => 'success',
            );
            return redirect()->back()->with('notification', $notification);
        }
        $notification = array(
            'message' => 'Investment not found!',
            'alert' => 'error',
        );
        return redirect()->back()->with('notification', $notification);
    }
}
