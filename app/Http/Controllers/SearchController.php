<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('searchField', '');
        $sortField = $request->input('sortField', 'price');
        $sortOrder = $request->input('sortOrder', 'asc');
        $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? strtolower($sortOrder) : 'asc';
          $sortField = in_array(strtolower($sortField), ['price', 'name', 'id']) ? strtolower($sortField) : 'price';
        $products = Product::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%")
                  ->orWhere('description', 'LIKE', "%$query%");
            })
            ->orderBy($sortField, $sortOrder)
            ->get();
        return view('product_list', compact('products'));
    }
}
