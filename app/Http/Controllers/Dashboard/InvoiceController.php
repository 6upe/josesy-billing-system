<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Client;
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
        $clients = Client::all();
        $quotations = Quotation::with('products')->where('status', 'accepted')->get();


        if ($quotations->isEmpty()) {
            return back()->withErrors(['No accepted quotations available.']);
        }

        $data = ['nav_status' => 'invoices', 'quotations' => $quotations, 'clients' => $clients];

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

        return redirect()->route('dashboard.invoices')->with('success', 'Invoice created successfully.');;
    }

    public function editInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $quotations = Quotation::where('status', 'accepted')->get();
        $clients = Client::all(); // Assuming you have a Client model

        $data = [
            'nav_status' => 'invoices',
            'invoice' => $invoice,
            'quotations' => $quotations,
            'clients' => $clients
        ];

        return view('dashboard.invoices.editInvoice', compact('data'));
    }

    public function updateInvoice(Request $request, $id)
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

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->route('dashboard.invoices')->with('success', 'Invoice updated successfully');
    }



    public function deleteInvoice(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('dashboard.invoices');
    }


    public function showInvoice($invoice)
    {
        $invoice = Invoice::findOrFail($invoice);
        $data = [
            'nav_status' => 'invoices',
            'invoice' => $invoice,
        ];

        return view('dashboard.invoices.showInvoice', compact('data'));

    }

}
