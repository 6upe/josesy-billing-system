<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        // Fetch quotations with related client and products, sorted by creation date in descending order
        $quotations = Quotation::with('client', 'products')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Fetch all products
        $products = Product::all();

        // Prepare the data array with the fetched data and nav status
        $data = ['nav_status' => 'quotations', 'quotations' => $quotations, 'products' => $products];

        // Return the view with the prepared data
        return view('dashboard.quotations', compact('data'));
    }


    public function createQuotation()
    {
        $clients = Client::all();
        $products = Product::all();
        $data = ['nav_status' => 'quotations', 'clients' => $clients, 'products' => $products];

        return view('dashboard.quotations.createQuotation', compact('data'));
    }

     
    public function saveQuotation(Request $request)
    {
        // Log the request data for debugging
        \Log::info('Request data:', $request->all());

        // Validate the request data
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'status' => 'required|string|in:pending,accepted,rejected',
            'tax_type' => 'required|string',
            'tax_amount' => 'required|numeric',
            'total' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.total_amount' => 'required|numeric',
        ]);

        // Extract quotation data
        $quotationData = $request->only([
            'client_id',
            'date',
            'status',
            'tax_type',
            'tax_amount',
            'total',
            'grand_total'
        ]);

        try {
            // Create the quotation
            $quotation = Quotation::create($quotationData);

            // Attach products to the quotation
            foreach ($validated['products'] as $product) {
                $quotation->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'total_amount' => $product['total_amount']
                ]);
            }

            \Log::info('Quotation created successfully:', ['quotation_id' => $quotation->id]);

            // If successful, redirect with a success message
            return redirect()->route('dashboard.quotations')->with('success', 'Quotation created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Failed to create quotation:', ['error' => $e->getMessage()]);

            // If there's an error, redirect with an error message
            return redirect()->route('dashboard.quotations')->with('error', 'Failed to create quotation. Please try again.');
        }
    }




    public function editQuotation($id)
    {
        $quotation = Quotation::with('products')->findOrFail($id);
        $clients = Client::all();
        $products = Product::all();

        $data = ['nav_status' => 'quotations', 'products' => $products];

        return view('dashboard.quotations.editQuotation', [
            'quotation' => $quotation,
            'data' => $data, 
            'clients' => $clients,
            'products' => $products
        ]);
    }

    public function updateQuotation(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'status' => 'required|string',
            'tax_type' => 'required|string',
            'tax_amount' => 'required|numeric',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer',
            'products.*.total_amount' => 'required|numeric'
        ]);

        $quotation = Quotation::findOrFail($id);
        $quotation->client_id = $request->client_id;
        $quotation->date = $request->date;
        $quotation->status = $request->status;
        $quotation->tax_type = $request->tax_type;
        $quotation->tax_amount = $request->tax_amount;
        $quotation->save();

        $quotation->products()->detach();

        foreach ($request->products as $product) {
            $quotation->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'total_amount' => $product['total_amount']
            ]);
        }

        return redirect()->route('dashboard.quotations')->with('success', 'Quotation updated successfully');
    }

    public function deleteQuotation(Quotation $quotation)
    {
        $quotation->delete();
        return redirect()->route('dashboard.quotations')->with('success', 'Quotation deleted successfully.');
    }


}
