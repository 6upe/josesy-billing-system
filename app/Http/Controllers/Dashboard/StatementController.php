<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Statement;
use Illuminate\Support\Facades\Auth;


class StatementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = ['nav_status' => 'statements','user' => $user];
        return view('dashboard.statements', compact('data'));
    }

    public function requestStatement($id)
    {
        $statement = Statement::findOrFail($id);
        $user = Auth::user();
        $data = ['nav_status' => 'statements', 'statement' => $statement,'user' => $user];
        
        return view('dashboard.statements.showStatement', compact('data'));
    }

}
