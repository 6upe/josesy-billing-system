<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Payment;
use App\Models\Expense;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total number of invoices
        $totalInvoices = Invoice::count();

        // Total number of quotations
        $totalQuotations = Quotation::count();

        // Total balance (sum of unpaid invoices)
        $totalBalance = Invoice::sum('balance');

        // Total income (sum of all payments received)
        $totalIncome = Payment::sum('amount');

        $totalExpense = Expense::sum('amount');

        $data = [
            'nav_status' => 'home',
            'user' => $user,
            'totalInvoices' => $totalInvoices,
            'totalQuotations' => $totalQuotations,
            'totalBalance' => $totalBalance,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'availableRevenue' => $totalIncome - $totalExpense
        ];

        return view('dashboard.home', compact('data'));
    }
}
