<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Upload;

class CartController extends Controller
{
    public function index()
    {
        // $cartItems = Auth::user()->cartItems;
        $cartItems = Cart::with('user', 'product')->where(['user_id' => user()->id])->get();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }

    public function editCart($cart_id)
    {
        // dd(decrypt($cart_id));
        $cart = Cart::where('id', decrypt($cart_id))->first();

        return view('edit_cart', compact('cart'));
    }

    public function updateCart(Request $request, $cart_id)
    {
        // Cart::update([
        //     'size' => $request->size,
        //     'quantity' => $request->quantity
        // ])->where('id', decrypt($cart_id));

        Cart::where('id', decrypt($cart_id))->update([
            'size' => $request->size,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    public function deleteCart($cart_id)
    {
        Cart::where('id', decrypt($cart_id))->delete();
        return redirect()->route('cart')->with('success', 'Cart deleted successfully!');
    }




    public function verifyPayment()
    {
        // $uploads = Upload::all();
        // return view('index',compact('uploads'))->with('success', 'Your order has been placed via E-sewa');
        return redirect()->route('index')->with('success', 'Your order has been placed via E-sewa');
    }














    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        Auth::user()->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'price' => $product->price,
        ]);

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Auth::user()->cartItems()->find($id);

        if ($cartItem) {
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
            $cartItem->update(['quantity' => $validated['quantity']]);
            return redirect()->route('cart')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart')->with('error', 'Cart item not found!');
    }

    public function remove($id)
    {
        $cartItem = Auth::user()->cartItems()->find($id);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart')->with('success', 'Cart item removed successfully!');
        }

        return redirect()->route('cart')->with('error', 'Cart item not found!');
    }

    public function checkout(Request $request)
    {
        // Implement your eSewa payment processing logic here

        // Example placeholder logic for order processing
        // Redirect to eSewa with necessary parameters
        return redirect('https://uat.esewa.com.np/epay/main')->with('success', 'Proceeding to checkout');
    }
}
