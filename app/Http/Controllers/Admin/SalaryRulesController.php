<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryRule;

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
}
