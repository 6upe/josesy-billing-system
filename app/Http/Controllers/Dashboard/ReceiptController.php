<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function index()
    {
       $user = Auth::user(); 
        $receipts = Receipt::all();

        $data = ['nav_status' => 'receipts','user' => $user, 'receipts' => $receipts];
        return view('dashboard.receipts', compact('data'));
    }

    public function requestReceipt($id)
    {
        
        
        
        $payment = Payment::findOrFail($id);
        $user = Auth::user();

        $receipts = Receipt::all();

        $receipt = Payment::findOrFail($payment->id);

        $invoice = Invoice::findOrFail($payment->invoice_id);

        $data = ['nav_status' => 'statements', 'receipt' => $receipt, 'payment' => $payment,'user' => $user, 'invoice' => $invoice];

        // Add any additional logic here if needed
        return view('dashboard.receipts.showReceipt', compact('data'));
    }

}
