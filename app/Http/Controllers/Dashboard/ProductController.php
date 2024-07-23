<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::paginate(8);
        $data = ['nav_status' => 'products','user' => $user, 'products' => $products];
        return view('dashboard.products', compact('data'));
    }

    public function addProduct()
    {
        $user = Auth::user();
        $data = ['nav_status' => 'products','user' => $user];
        return view('dashboard.products.addProduct', compact('data'));
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string',
            'product_price' => 'required|numeric',
            'product_description' => 'required|string',
        ]);

        Product::create([
            'name' => $request->product_name,
            'type' => $request->product_type,
            'price' => $request->product_price,
            'description' => $request->product_description,
        ]);

        return redirect()->route('dashboard.products')->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $data = ['nav_status' => 'products', 'product' => $product,'user' => $user];
        return view('dashboard.products.editProduct', compact('data'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_description' => 'required|string',
        ]);

        $product->name = $request->product_name;
        $product->type = $request->product_type;
        $product->price = $request->product_price;
        $product->description = $request->product_description;
        $product->save();

        return redirect()->route('dashboard.products', $product->id)->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.products')->with('success', 'Product deleted successfully');
    }

}
