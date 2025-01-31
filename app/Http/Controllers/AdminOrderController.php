<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */

     public function show(Order $order)
     {
         $order->load('user'); // Load related user
         $carts = $order->carts; // Access carts accessor

         // Debug the data being passed to the view
        //  dd($order, $carts);

         return view('admin.orders.show', compact('order', 'carts'));
     }

     /**
     * Show the form for editing the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
          return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order's status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
     {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
        $payment_status="Unpaid";
        if($request->status == 'completed'){
            $payment_status="Paid";
        }
        $order->update([
            'status' => $request->status,
            'payment_status'=>$payment_status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
