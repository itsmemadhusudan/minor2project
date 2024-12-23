<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $uploads = Upload::all();
        // dd($uploads);
        return view('index', compact('uploads'));
    }

    public function addImage(){
        return view('upload');
    }

    public function create()
    {
        return view('uploads.create');
    }

    public function store(Request $request)
    {
       // return $request->all();
        $validatedData = $request->validate([
            'designer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('uploads', 'public');
            $validatedData['profile_picture'] = $path;
        }

        Upload::create($validatedData);

        return redirect()->route('index')->with('success', 'Upload created successfully.');
    }

    public function viewProduct($product_id){

        $product = Upload::find(decrypt($product_id));

        return view('productdetail',compact('product'));
    }

    public function storeCart(Request $request){

        // dd($request->all());

        Cart::create(
            [
                'user_id' => user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
            ]
        );

       return redirect()->route('cart');
    }


}
