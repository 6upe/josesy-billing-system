<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'receipts'];
        return view('dashboard.receipts', compact('data'));
    }
}
