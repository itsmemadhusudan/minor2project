<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Upload;
use Log;

class CartController extends Controller
{
    public function calculatesignature(Request $request)
    {
        $amount = $request->amount;
        $uuid = now()->timestamp;
        $message = "total_amount={$amount},transaction_uuid={$uuid},product_code=EPAYTEST";
        $secret = "8gBm/:&EnhH.1/q";
        $s = hash_hmac("sha256", $message, $secret, true);

        $signature = base64_encode($s);
        $data = [
            'amount' => $amount,
            'signature' => $signature,
            'transaction_uuid' => $uuid,
            'product_code' => 'EPAYTEST',
        ];
        return response()->json($data);
    }

    public function index()
    {
        // $cartItems = Auth::user()->cartItems;
        $cartItems = Cart::with('user', 'product')->where(['status'=>'pending'])->where(['user_id' => Auth::user()->id])->get();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }

    public function editCart($cart_id)
    {
        // dd(decrypt($cart_id));
        $cart = Cart::where('id', decrypt($cart_id))->first();

        return view('edit_cart', compact('cart'));
    }
    public function checkout()
    {
        $product = Cart::with('user', 'product')->where('status','pending')->where(['user_id' => user()->id])->get();
        $orderID = 'ORD-' . strtoupper(uniqid());
        $totalPrice = $product->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        $message = "total_amount={$totalPrice},transaction_uuid={$orderID},product_code=EPAYTEST";
        // Use your actual secret key here
        $secret = "8gBm/:&EnhH.1/q";
        $s = hash_hmac("sha256", $message, $secret, true);

        $signature = base64_encode($s);
        return view('payment.index', compact('product','totalPrice','orderID','signature'));
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
    public function verifyEsewa(Request $request){
        $data = $request->all();
        $payment_status = 'Unpaid';
        $payment_method = "eSewa";
        $decodedData = json_decode(base64_decode($data['data']), true);
        $transaction_code = $decodedData['transaction_code'];
        $status = $decodedData['status'];
        $total_amount = $decodedData['total_amount'];
        $transaction_uuid = $decodedData['transaction_uuid']; // change name
        $order_id = $decodedData['transaction_uuid']; // change name
        $product_code = $decodedData['product_code'];
        $signed_field_names = $decodedData['signed_field_names'];
        $signature = $decodedData['signature'];
        $cart_ids = Cart::where('user_id', user()->id)->where('status','pending')->pluck('id');



        $user_id = Auth::id();

        $payment_id = "";
        $payload = [
            'transaction_code' => $transaction_code,
            'total_amount' => $total_amount,
            'transaction_uuid' => $transaction_uuid,
            'product_code' => $product_code,
        ];
        $data = [
                    'user_id' => $user_id,
                    'total_amount' => floatval(str_replace(',', '', $total_amount)),
                    'status' => 'pending',
                    'cart_ids' => $cart_ids,
                    'order_id' => $order_id,
                    'payment_type' => $payment_method,
                    'payment_status' => $payment_status,
                ];
        Order::create($data);
        return $response = $this->verifyEsewaPayment($payload,$cart_ids,$order_id);

    }
    public function verifyEsewaPayment($payload, $cart_ids, $order_id)
    {
        try {
            $curl = curl_init();
            $data = [
                'product_code' => $payload['product_code'],
                'transaction_code' => $payload['transaction_code'],
                'total_amount' => $payload['total_amount'],
                'transaction_uuid' => $payload['transaction_uuid'],
            ];

            $url = 'https://rc.esewa.com.np/api/epay/transaction/status/?' . http_build_query($data);

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                Log::error('eSewa API Error: ' . $err);
                return view('payment_failed');
            }

            $res = json_decode($response);
            Log::info('eSewa Response: ' . $response);

            if (!$res || !isset($res->status)) {
                Log::error('Invalid eSewa Response: ' . $response);
                return view('payment_failed');
            }

            if ($res->status == "COMPLETE") {
                $find_invoice = Order::where("user_id", Auth::id())
                                    ->where("order_id", $order_id)
                                    ->first();

                if ($find_invoice) {
                    $find_invoice->update([
                        "payment_status" => "Paid",
                    ]);
                    Cart::whereIn('id', $cart_ids)->update(['status' => 'done']);
                }
                return view('payment_success');
            }

            return view('payment_failed');
        } catch (\Exception $e) {
            Log::error('eSewa Payment Verification Error: ' . $e->getMessage());
            return view('payment_failed');
        }
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
    public function placeOrder(Request $request)
    {
        try {
            $orderID = $request->orderID;
            $totalPrice = $request->totalPrice;
            $cart_ids = Cart::where('user_id', user()->id)->where('status','pending')->pluck('id');

            $data = [
            'user_id' => user()->id,
            'total_amount' => $totalPrice,
            'status' => 'pending',
            'cart_ids' => $cart_ids,
            'order_id' => $orderID,
            'payment_type' => 'Cash on delivery',
            'payment_status' => 'pending',
            ];
            Order::create($data);
            Cart::whereIn('id', $cart_ids)->update(['status' => 'done']);

            return redirect()->route('cart')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', 'Failed to place order: ' . $e->getMessage());
        }
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



}
