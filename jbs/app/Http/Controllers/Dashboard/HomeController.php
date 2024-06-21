<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'home'];
        return view('dashboard.home', compact('data'));
    }
}
