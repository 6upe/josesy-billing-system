<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'reports'];
        return view('dashboard.reports', compact('data'));
    }
}
