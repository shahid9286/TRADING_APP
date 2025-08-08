<?php

namespace App\Services;

use App\Models\Report;
use File;
use App\Models\Income;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense;

class ReportService
{
    public function generatePdf($data)
    {
        $reportType = $data['report_type'];
        $startDate =  $data['start_date'];
        $endDate = $data['end_date'];

        if ($reportType == 'Income') {
            $expenses = Income::whereBetween('created_at', [$startDate, $endDate])->get();
            $view = 'admin.pdf.income';
            $incomes = [];
        } elseif ($reportType == 'Expense') {
            $expenses = Expense::whereBetween('created_at', [$startDate, $endDate])->get();
            $view = 'admin.pdf.expense';
            $incomes = [];
        } elseif ($reportType == "Financial") {
            $incomes = Income::with("incomeSource")->whereBetween('created_at', [$startDate, $endDate])->get();
            $expenses = Expense::with("expenseType")->whereBetween('created_at', [$startDate, $endDate])->get();
            $view = 'admin.pdf.financial';
        } else {
            return redirect()->back()->withErrors('Invalid report type');
        }
        $pdf = Pdf::loadView($view, compact('expenses', "incomes"));
        $fileName = 'report_' . time() . '.pdf';
        $pdfDirectory = public_path('pdf');
        if (!File::exists($pdfDirectory)) {
            File::makeDirectory($pdfDirectory, 0755, true);
        }
        $pdf->save($pdfDirectory . '/' . $fileName);
        $report = new Report();
        $report->report_type = $reportType;
        $report->start_date = $startDate;
        $report->end_date = $endDate;
        $report->file_path = 'pdf/' . $fileName;
        $report->save();
    }
}
