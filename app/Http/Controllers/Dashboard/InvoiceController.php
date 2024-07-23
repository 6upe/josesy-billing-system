<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $invoices = Invoice::all();

        $data = ['nav_status' => 'invoices', 'user' => $user,'invoices' => $invoices];
        return view('dashboard.invoices', compact('data'));
    }


    public function createInvoice()
    {
        $clients = Client::all();
        $quotations = Quotation::with('products')->where('status', 'accepted')->get();
        $user = Auth::user();

        if ($quotations->isEmpty()) {
            return back()->withErrors(['No accepted quotations available.']);
        }

        $data = ['nav_status' => 'invoices', 'quotations' => $quotations, 'clients' => $clients,'user' => $user];

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
        $user = Auth::user();
        $invoice = Invoice::findOrFail($id);
        $quotations = Quotation::where('status', 'accepted')->get();
        $clients = Client::all(); // Assuming you have a Client model

        $data = [
            'nav_status' => 'invoices',
            'invoice' => $invoice,
            'quotations' => $quotations,
            'clients' => $clients,
            'user' => $user
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
        $user = Auth::user();
        $invoice = Invoice::findOrFail($invoice);
        $data = [
            'nav_status' => 'invoices',
            'invoice' => $invoice,
            'user' => $user
        ];

        return view('dashboard.invoices.showInvoice', compact('data'));

    }

}
