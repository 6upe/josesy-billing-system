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
        'created_by' => Auth::id(), // Track who created the payment
    ]);

    $receipt = Receipt::create([
        'payment_id' => $payment->id,
        'created_by' => Auth::id(), // Track who created the receipt
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
        $user = Auth::user();
        $payment = Payment::findOrFail($id);
        $invoices = Invoice::all();
        

        if($payment['created_by'] == $user['id'] || $user['position'] == 'Chief Executive Officer'){
            return view('payments.edit', compact('payment', 'invoices'));
        }else{
            return redirect()->route('dashboard.payments')->with('error', 'Permission edit denied!.');
        }

    }

    public function updatePayment(Request $request, $id)
{
    $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'amount' => 'required|numeric|min:0',
    ]);

    $payment = Payment::findOrFail($id);
    $newInvoice = Invoice::findOrFail($request->invoice_id);

    // Adjust the previous invoice
    $previousInvoice = $payment->invoice;
    $previousInvoice->paid_amount -= $payment->amount;
    $previousInvoice->balance = $previousInvoice->total_amount - $previousInvoice->paid_amount - $previousInvoice->discount;
    $previousInvoice->save();

    // Update payment details
    $payment->invoice_id = $request->invoice_id;
    $payment->amount = $request->amount;
    $payment->save();

    // Adjust the new invoice
    $newInvoice->paid_amount += $request->amount;
    $newInvoice->balance = $newInvoice->total_amount - $newInvoice->paid_amount - $newInvoice->discount;
    $newInvoice->save();

    // Update statement for the previous invoice
    Statement::updateOrCreate(
        ['invoice_id' => $previousInvoice->id],
        [
            'total_amount' => $previousInvoice->total_amount,
            'paid_amount' => $previousInvoice->paid_amount,
            'balance' => $previousInvoice->balance,
        ]
    );

    // Update statement for the new invoice
    Statement::updateOrCreate(
        ['invoice_id' => $newInvoice->id],
        [
            'total_amount' => $newInvoice->total_amount,
            'paid_amount' => $newInvoice->paid_amount,
            'balance' => $newInvoice->balance,
        ]
    );

    return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
}

}
