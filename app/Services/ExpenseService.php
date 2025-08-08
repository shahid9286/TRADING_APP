<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\ExpenseType;


class ExpenseService
{
    public function expenseIndex()
    {
        return Expense::with("expenseType")->get();
    }
    public function expenseStore($data)
    {
        Expense::create($data);
    }
    public function expenseEdit($id)
    {
        return Expense::findorfail($id);
    }
    public function expenseUpdate($data, $id)
    {
        $Expense = Expense::findorfail($id);
        $Expense->update($data);
    }
    public function expenseDelete($id)
    {
        $Expense = Expense::findorfail($id);
        $Expense->delete();
    }
    public function getAllExpenseType()
    {
        return ExpenseType::all();
    }
}
