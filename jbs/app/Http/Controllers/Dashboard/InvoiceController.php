<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'invoices'];
        return view('dashboard.invoices', compact('data'));
    }
}
