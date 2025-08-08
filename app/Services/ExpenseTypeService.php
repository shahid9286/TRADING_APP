<?php

namespace App\Services;

use App\Models\ExpenseType;
use Illuminate\Support\Arr;
use Nette\Utils\Arrays;

class ExpenseTypeService
{
    public function expenseIndex()
    {
        return ExpenseType::all();
    }
    public function expenseStore($data)
    {
        ExpenseType::create($data);
    }
    public function expenseEdit($id)
    {
        return ExpenseType::findorfail($id);
    }
    public function expenseUpdate($data, $id)
    {
        $expenseType = ExpenseType::findorfail($id);
        $expenseType->update($data);
    }
    public function expenseDelete($id)
    {
        $expenseType = ExpenseType::findorfail($id);
        $expenseType->delete();
    }
}
