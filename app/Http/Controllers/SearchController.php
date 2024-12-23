<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Upload;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('searchField');

        $items = Upload::where('description', 'LIKE', "%$query%")->get();

        return view('product_list', compact('items'));
    }
}
