<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Payment;

class ReceiptController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'receipts'];
        return view('dashboard.receipts', compact('data'));
    }

    public function requestReceipt($id)
    {
        $receipt = Receipt::findOrFail($id);
        $payment = Payment::findOrFail($id);

        $data = ['nav_status' => 'statements', 'receipt' => $receipt, 'payment' => $payment];

        // Add any additional logic here if needed
        return view('dashboard.receipts.showReceipt', compact('data'));
    }

}
