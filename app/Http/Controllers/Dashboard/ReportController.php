<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = ['nav_status' => 'reports','user' => $user];
        return view('dashboard.reports', compact('data'));
    }
}
