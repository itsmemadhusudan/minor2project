<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.detail', ['product' => $product]);
    }

    public function submitForm(Request $request)
    {
        // Handle form submission logic
        // For example, adding the product to the cart or processing the purchase
        // You can access form data using $request->input('field_name');
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
