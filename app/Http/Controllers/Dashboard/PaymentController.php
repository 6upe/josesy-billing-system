<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'payments'];
        return view('dashboard.payments', compact('data'));
    }
}
