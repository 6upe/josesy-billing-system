<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class StatementController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'statements'];
        return view('dashboard.statements', compact('data'));
    }
}
