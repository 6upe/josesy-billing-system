<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::all();
        $data = ['nav_status' => 'payments','user' => $user, 'payments' => $payments];
        return view('dashboard.payments', compact('data'));
    }

    public function registerPayment()
    {
        $invoices = Invoice::all();
        $user = Auth::user();
        $data = ['nav_status' => 'payments', 'invoices' => $invoices,'user' => $user];

        return view('dashboard.payments.registerPayment', compact('data'));
    }

    public function savePayment(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::find($request->invoice_id);

        $payment = Payment::create([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
        ]);

        $receipt = Receipt::create([
            'payment_id' => $payment->id,
        ]);

        $invoice->paid_amount += $request->amount;
        $invoice->balance = $invoice->total_amount - $invoice->paid_amount - $invoice->discount;
        $invoice->save();

        Statement::updateOrCreate(
            ['invoice_id' => $invoice->id],
            [
                'total_amount' => $invoice->total_amount,
                'paid_amount' => $invoice->paid_amount,
                'balance' => $invoice->balance,
            ]
        );

        return redirect()->route('dashboard.payments')->with('success', 'Payment recorded successfully.');
    }


    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $invoices = Invoice::all();
        return view('payments.edit', compact('payment', 'invoices'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $payment = Payment::findOrFail($id);
        $invoice = Invoice::findOrFail($request->invoice_id);

        // Adjust the previous invoice
        $previousInvoice = $payment->invoice;
        $previousInvoice->paid_amount -= $payment->amount;
        $previousInvoice->balance = $previousInvoice->total_amount - $previousInvoice->paid_amount;
        $previousInvoice->save();

        // Update payment details
        $payment->invoice_id = $request->invoice_id;
        $payment->amount = $request->amount;
        $payment->save();

        // Adjust the new invoice
        $invoice->paid_amount += $request->amount;
        $invoice->balance = $invoice->total_amount - $invoice->paid_amount;
        $invoice->save();

        // Update statement
        Statement::updateOrCreate(
            ['invoice_id' => $invoice->id],
            [
                'total_amount' => $invoice->total_amount,
                'paid_amount' => $invoice->paid_amount,
                'balance' => $invoice->balance,
            ]
        );

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }



}
