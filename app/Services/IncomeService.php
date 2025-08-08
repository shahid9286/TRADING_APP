<?php

namespace App\Services;

use App\Models\Income;
use App\Models\IncomSources;

class IncomeService
{
    public function IncomSourcesIndex()
    {
        return Income::with("incomeSource")->get();
    }
    public function IncomeStore($data)
    {
        Income::create($data);
    }
    public function IncomeEdit($id)
    {
        return Income::findorfail($id);
    }
    public function IncomeUpdate($data, $id)
    {
        $Income = Income::findorfail($id);
        $Income->update($data);
    }
    public function IncomeDelete($id)
    {
        $Income = Income::findorfail($id);
        $Income->delete();
    }
    public function getAllIncomSources()
    {
        return IncomSources::all();
    }
}
