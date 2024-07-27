<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'nav_status' => 'reports',
            'user' => $user,
        ];
        return view('dashboard.reports', compact('data'));
    }

    public function monthlyReport(Request $request)
    {
        $user = Auth::user();
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();

        $data = $this->getReportData($start_date, $end_date, $user, 'reports');

        return view('dashboard.reports.monthly', compact('data'));
    }

    public function annualReport(Request $request)
    {
        $user = Auth::user();
        $start_date = Carbon::now()->startOfYear();
        $end_date = Carbon::now()->endOfYear();

        $data = $this->getReportData($start_date, $end_date, $user, 'reports');

        return view('dashboard.reports.annual', compact('data'));
    }

    public function weeklyReport(Request $request)
    {
        $user = Auth::user();
        $start_date = Carbon::now()->startOfWeek();
        $end_date = Carbon::now()->endOfWeek();

        $data = $this->getReportData($start_date, $end_date, $user, 'reports');

        return view('dashboard.reports.weekly', compact('data'));
    }

    public function customReport(Request $request)
    {
        $user = Auth::user();
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $data = $this->getReportData($start_date, $end_date, $user, 'custom');

        return view('dashboard.reports.custom', compact('data'));
    }

    private function getReportData($start_date, $end_date, $user, $nav_status)
    {
        $invoices = Invoice::whereBetween('date', [$start_date, $end_date])->with('client')->get();
        $quotations = Quotation::whereBetween('date', [$start_date, $end_date])->with('client', 'products')->get();
        $expenses = Expense::whereBetween('created_at', [$start_date, $end_date])->get();
        $payments = Payment::whereBetween('created_at', [$start_date, $end_date])->with('client')->get();

        return [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'invoices' => $invoices,
            'quotations' => $quotations,
            'expenses' => $expenses,
            'payments' => $payments,
            'user' => $user,
            'nav_status' => $nav_status, // Include nav_status in the report data
        ];
    }

    public function exportReport(Request $request)
    {
        $user = Auth::user();
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $data = $this->getReportData($start_date, $end_date, $user, 'reports');

        // Logic for exporting the report as PDF
        // Ensure to use the correct PDF package and method
        // Example:
        // $pdf = PDF::loadView('dashboard.reports.export', ['data' => $data]);
        // return $pdf->download('report.pdf');
    }
}
