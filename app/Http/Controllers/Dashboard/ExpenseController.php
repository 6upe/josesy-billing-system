<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $expenses = Expense::all();
        $data = ['nav_status' => 'expenses','user' => $user, 'expenses' => $expenses];

       
        return view('dashboard.expenses', compact('data'));
    }

    public function registerExpense()
    {
        $user = Auth::user();
        $data = ['nav_status' => 'expenses','user' => $user];

        return view('dashboard.expenses.register_expense', compact('data'));
    }

    public function saveExpense(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_contact' => 'required|string|max:255',
            'supporting_documents' => 'nullable|file',
            'products_purchased' => 'required|string',
            'amount' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'expense_type' => 'required|string|max:255',
        ]);

        $expense = new Expense();
        $expense->supplier_name = $request->supplier_name;
        $expense->supplier_contact = $request->supplier_contact;
        $expense->supporting_documents = $request->supporting_documents->store('documents'); // Save file path
        $expense->products_purchased = $request->products_purchased;
        $expense->amount = $request->amount;
        $expense->unit_price = $request->unit_price;
        $expense->quantity = $request->quantity;
        $expense->expense_type = $request->expense_type;
        $expense->save();

        return redirect()->route('dashboard.expenses');
    }

    public function showExpense(Expense $expense)
    {
        $user = Auth::user();
        $data = ['nav_status' => 'expenses','user' => $user, 'expense' => $expense];

        return view('dashboard.expenses.show_expense', compact('data'));
    }

    public function editExpense(Expense $expense)
    {
        $user = Auth::user();
        $data = ['nav_status' => 'expenses','user' => $user, 'expense' => $expense];

        return view('dashboard.expenses.edit_expense', compact('data'));
    }

    public function updateExpense(Request $request, Expense $expense)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_contact' => 'required|string|max:255',
            'supporting_documents' => 'nullable|file',
            'products_purchased' => 'required|string',
            'amount' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'expense_type' => 'required|string|max:255',
        ]);

        $expense->supplier_name = $request->supplier_name;
        $expense->supplier_contact = $request->supplier_contact;
        if ($request->hasFile('supporting_documents')) {
            $expense->supporting_documents = $request->supporting_documents->store('documents');
        }
        $expense->products_purchased = $request->products_purchased;
        $expense->amount = $request->amount;
        $expense->unit_price = $request->unit_price;
        $expense->quantity = $request->quantity;
        $expense->expense_type = $request->expense_type;
        $expense->save();

        return redirect()->route('dashboard.expenses');
    }

    public function deleteExpense(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('dashboard.expenses');
    }

}

