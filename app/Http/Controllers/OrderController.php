<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart; // Import the Cart model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function verifyPayment(Request $request)
    {
        // Get the necessary parameters from the request
        $oid = $request->input('oid'); // Order ID from the URL
        $amt = $request->input('amt'); // Total amount
        $refId = $request->input('refId'); // Reference ID from eSewa

        // Assuming cart_ids were sent as JSON array in the URL
        $cartIds = json_decode($oid, true);

        // Check if $cartIds is null or not an array
        if (!$cartIds || !is_array($cartIds)) {
            return redirect('/cart')->with('error', 'Invalid cart data.');
        }

        // Retrieve user and cart items from the session or database
        $user = Auth::user();
        $cartItems = Cart::whereIn('id', $cartIds)->get(); // Retrieve cart items

        // Ensure cart items are not empty
        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'No items found in the cart.');
        }

        // Calculate total amount
        $totalAmount = $cartItems->sum(function($item) {
            return $item->quantity * $item->price;
        });

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'status' => 'completed', // Set appropriate status
        ]);

        // Create order details
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear the cart
        Cart::whereIn('id', $cartIds)->delete();

        return redirect('/orders')->with('success', 'Payment successful and order placed.');
    }

    public function paymentFail()
    {
        return redirect('/cart')->with('error', 'Payment failed. Please try again.');
    }
}
