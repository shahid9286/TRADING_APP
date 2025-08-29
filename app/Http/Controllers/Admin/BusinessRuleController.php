<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessRule;
use Illuminate\Http\Request;

class BusinessRuleController extends Controller
{
    public function edit()
    {
        $business_rules = BusinessRule::first();
        return view('admin.business-rules.edit', compact('business_rules'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'min_deposit' => 'required|numeric|min:0',
            'min_withdraw_limit' => 'required|numeric|min:0',
            'daily_return_rate' => 'required|numeric|min:0|max:100',
            'payout_fee_rate' => 'required|numeric|min:0|max:100',
            'monthly_return_rate' => 'required|numeric|min:0|max:100',
            'level_1_comm_rate' => 'required|numeric|min:0|max:100',
            'level_2_comm_rate' => 'required|numeric|min:0|max:100',
            'level_3_comm_rate' => 'required|numeric|min:0|max:100',
            'level_4_comm_rate' => 'required|numeric|min:0|max:100',
            'level_5_comm_rate' => 'required|numeric|min:0|max:100',
            'level_6_comm_rate' => 'required|numeric|min:0|max:100',
            'level_7_comm_rate' => 'required|numeric|min:0|max:100',
            'salary_day' => 'nullable|integer|min:1|max:31',
            'salary_payout_date' => 'nullable|date',
            'entry_approval_date' => 'nullable|date',
            'withdraw_last_date' => 'nullable|date',
            'withdraw_payout_date' => 'nullable|date',
            'withdraw_payout_date_2' => 'nullable|date',
        ]);

        $rule = BusinessRule::first();


        $rule->min_deposit = $request->min_deposit;
        $rule->min_withdraw_limit = $request->min_withdraw_limit;
        $rule->daily_return_rate = $request->daily_return_rate;
        $rule->payout_fee_rate = $request->payout_fee_rate;
        $rule->monthly_return_rate = $request->monthly_return_rate;
        $rule->level_1_comm_rate = $request->level_1_comm_rate;
        $rule->level_2_comm_rate = $request->level_2_comm_rate;
        $rule->level_3_comm_rate = $request->level_3_comm_rate;
        $rule->level_4_comm_rate = $request->level_4_comm_rate;
        $rule->level_5_comm_rate = $request->level_5_comm_rate;
        $rule->level_6_comm_rate = $request->level_6_comm_rate;
        $rule->level_7_comm_rate = $request->level_7_comm_rate;
        $rule->salary_day = $request->salary_day;
        $rule->salary_payout_date = $request->salary_payout_date;
        $rule->entry_approval_date = $request->entry_approval_date;
        $rule->withdraw_last_date = $request->withdraw_last_date;
        $rule->withdraw_payout_date = $request->withdraw_payout_date;
        $rule->withdraw_payout_date_2 = $request->withdraw_payout_date_2;

        $rule->save();

        $notification = [
            'message' => 'Business rules updated successfully!',
            'alert'   => 'success',
        ];

        return redirect()->back()->with('notification', $notification);
    }
}
