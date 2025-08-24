<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessRule;
use Illuminate\Http\Request;
use App\Models\SalaryRule;
use App\Models\SystemLog;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\UserReturn;
use App\Models\UserTotal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalaryRulesController extends Controller
{
    public function index()
    {
        $salary_rules = SalaryRule::all();
        return view('admin.salary-rules.index', compact('salary_rules'));
    }

    public function add()
    {
        return view('admin.salary-rules.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'direct_investment' => 'required|numeric|min:0',
            'salary' => 'required|numeric|min:0',

        ]);

        $salary_rule = new SalaryRule();
        $salary_rule->direct_investment = $request->direct_investment;
        $salary_rule->salary = $request->salary;


        $salary_rule->save();

        $notification = array(
            'message' => 'Salary Rule Added Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.salary-rules.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $salary_rule = SalaryRule::find($id);
        return view('admin.salary-rules.edit', compact('salary_rule'));
    }

    public function update(Request $request, $id)
    {
        $salary_rule = SalaryRule::find($id);
        $request->validate([
            'direct_investment' => 'required|numeric|min:0',
            'salary' => 'required|numeric|min:0',
        ]);
        $salary_rule = SalaryRule::find($id);
        $salary_rule->direct_investment = $request->direct_investment;
        $salary_rule->salary = $request->salary;
        $salary_rule->save();

        $notification = array(
            'message' => 'Salary Rule Updated Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.salary-rules.index')->with('notification', $notification);
    }
    public function delete($id)
    {
        $salary_rule = SalaryRule::find($id);
        $salary_rule->save();
        $salary_rule->delete();

        $notification = array(
            'message' => 'Salary Rule Deleted Successfully!',
            'alert' => 'success'
        );

        return redirect()->route('admin.salary-rules.index')->with('notification', $notification);
    }

    public function updateSalary()
    {
        $today = Carbon::today();

        $payoutDate = BusinessRule::first()->salary_payout_date;

        $users = User::with('userTotal')->get();

        DB::beginTransaction();

        foreach ($users as $user) {
            $investment = $user->userTotal->level_1_investment ?? 0;

            $salaryRule = SalaryRule::where('direct_investment', '<=', $investment)
                ->orderByDesc('direct_investment')
                ->first();

            if (!$salaryRule) continue;

            $salaryAmount = $salaryRule->salary;

            if ($today->day <= $payoutDate) {
                SystemLog::createLog([
                    'module' => 'current_month_salary_update',
                    'action' => 'update_user_current_month_salary',
                    'affected_user_id' => $user->id,
                    'description' => "Current Month Salary updated from {$user->current_month_salary} to " . ($user->current_month_salary + $salaryAmount) . " for {$user->username}",
                    'details' => "Amount: $" . number_format($salaryAmount, 2),
                    'metadata' => [
                        'salary_amount' => $salaryAmount,
                    ]
                ]);
                $user->current_month_salary += $salaryAmount;
            } else {
                SystemLog::createLog([
                    'module' => 'next_month_salary_update',
                    'action' => 'update_user_next_month_salary',
                    'affected_user_id' => $user->id,
                    'description' => "Next Month Salary updated from {$user->next_month_salary} to " . ($user->next_month_salary + $salaryAmount) . " for {$user->username}",
                    'details' => "Amount: $" . number_format($salaryAmount, 2),
                    'metadata' => [
                        'salary_amount' => $salaryAmount,
                    ]
                ]);
                $user->next_month_salary += $salaryAmount;
            }

            $user->save();
        }

        DB::commit();
        return 0;
    }

    public function giveSalary()
    {
        
        DB::beginTransaction();
        
        $users = User::where('next_month_salary', '>', 0)->get();
        foreach ($users as $user) {
            $user->current_month_salary += $user->next_month_salary;
            $user->next_month_salary = 0;
            $user->save();
        }
        
        $users = User::where('current_month_salary', '>', 0)->get();

        foreach ($users as $user) {

            SystemLog::createLog([
                'module' => 'salary_paid',
                'action' => 'salary_paid_to_user',
                'affected_user_id' => $user->id,
                'description' => "Salary paid for {$user->username} of {$user->current_month_salary}.",
                'details' => "Amount: $" . number_format($user->current_month_salary, 2),
                'metadata' => [
                    'salary_amount' => $user->current_month_salary,
                ]
            ]);

            $user_return = UserReturn::create([
                'user_id' => $user->id,
                'amount' => $user->current_month_salary,
                'type' => 'salary',
                'description' => "Salary for User {$user->username} paid of amount {$user->current_month_salary}.",
                'status' => 'completed',
                'entry_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]);

            UserLedger::create([
                'user_id' => $user->id,
                'user_return_id' => $user_return->id,
                'type' => 'salary',
                'amount' => $user->current_month_salary,
                'description' => "Salary for User {$user->username} paid of amount {$user->current_month_salary}.",
                'balance_before' => $user->net_balance,
                'balance_after' => $user->net_balance + $user->current_month_salary,
            ]);

            $user_total = UserTotal::where('user_id', $user->id)->firstOrFail();

            $user_total->total_salaries += $user->current_month_salary;

            $user_total->save();

            $user->net_balance += $user->current_month_salary;
            $user->current_month_salary = 0;
            $user->save();
        }

        DB::commit();
        return 0;
    }
}
