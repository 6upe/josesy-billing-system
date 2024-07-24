<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'supporting_documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'products_purchased' => 'required|string',
            'amount' => 'required|numeric',
            'expense_type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $expense = new Expense();
        $expense->supplier_name = $request->supplier_name;
        $expense->supplier_contact = $request->supplier_contact;
        if ($request->hasFile('supporting_documents')) {
            // Store the file in the public/documents directory
            $path = $request->file('supporting_documents')->store('documents', 'public');
            $expense->supporting_documents = $path; // Save the relative file path
        }
        $expense->products_purchased = $request->products_purchased;
        $expense->amount = $request->amount;
        $expense->expense_type = $request->expense_type;
        $expense->description = $request->description;
        
        if($expense->save()){
            return redirect()->route('dashboard.expenses')->with('success', 'Expense saved successfully.');

        }else{
            return redirect()->route('dashboard.expenses.registerExpense')->with('error', 'Oops!, something went wrong.');
        }

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

    public function updateExpense(Request $request, $id)
{
    $request->validate([
        'supplier_name' => 'required|string|max:255',
        'supplier_contact' => 'required|string|max:255',
        'supporting_documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        'products_purchased' => 'required|string',
        'amount' => 'required|numeric',
        'expense_type' => 'required|string|max:255',
        'description' => 'required|string|max:255',
    ]);

    $expense = Expense::findOrFail($id);
    $expense->supplier_name = $request->supplier_name;
    $expense->supplier_contact = $request->supplier_contact;

    if ($request->hasFile('supporting_documents')) {
            // Store the file in the public/documents directory
            $path = $request->file('supporting_documents')->store('documents', 'public');
            $expense->supporting_documents = $path; // Save the relative file path
        }

    if ($request->hasFile('supporting_documents')) {
        // Optionally delete the old file
        if ($expense->supporting_documents) {
            Storage::disk('public')->delete($expense->supporting_documents);
        }

        $path = $request->file('supporting_documents')->store('documents', 'public');
        $expense->supporting_documents = $path; // Save the relative file path

    }

    $expense->products_purchased = $request->products_purchased;
    $expense->description = $request->description;
    $expense->amount = $request->amount;
    $expense->expense_type = $request->expense_type;
    $expense->save();

    return redirect()->route('dashboard.expenses')->with('success', 'Expense updated successfully.');
}



    public function deleteExpense(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('dashboard.expenses');
    }

}

