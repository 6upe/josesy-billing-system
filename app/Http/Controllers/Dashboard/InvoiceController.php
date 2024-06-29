<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        $data = ['nav_status' => 'invoices', 'invoices' => $invoices];
        return view('dashboard.invoices', compact('data'));
    }


    public function createInvoice()
    {
        $quotations = Quotation::where('status', 'accepted')->get();

        $data = ['nav_status' => 'invoices', 'quotations' => $quotations];

        return view('dashboard.invoices.createInvoice', compact('data'));
    }

    public function saveInvoice(Request $request)
    {
        $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'balance' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'comment' => 'nullable|string',
        ]);

        $invoices = Invoice::create($request->all());
        $data = ['nav_status' => 'invoices', 'invoices' => $invoices];

        return view('dashboard.invoices', compact('data'));
    }

    public function editInvoice(Invoice $invoice)
    {
        $quotations = Quotation::where('status', 'accepted')->get();

        $data = ['nav_status' => 'invoices', 'quotations' => $quotations];

        return view('dashboard.invoices.editInvoice', compact('data'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'comment' => 'nullable|string',
        ]);

        $invoice->update($request->all());
        return redirect()->route('dashboard.invoices', $invoice);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('dashboard.invoices');
    }







    
}
