<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Statement;

class StatementController extends Controller
{
    public function index()
    {
        $data = ['nav_status' => 'statements'];
        return view('dashboard.statements', compact('data'));
    }

    public function requestStatement($id)
    {
        $statement = Statement::findOrFail($id);

        $data = ['nav_status' => 'statements', 'statement' => $statement];
        
        return view('dashboard.statements.showStatement', compact('data'));
    }

}
