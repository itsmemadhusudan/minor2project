<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Upload;
use App\Models\PaymentSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EsewaController extends Controller
{
    public function verifyPayment(Request $request)
    {
        dd($request);
        $status = $request->q;
        $total_price = $request->amt;
        $oid = $request->oid;
        $refId = $request->refId;

        if ($status == 'success') {
            $userID = session()->get('userData.id');
            $cartItems = Cart::where('user_id', $userID)->get();

            $sum = $cartItems->sum('sub_total');

            $verifyTransaction = $this->verifyTransaction($request, $sum);

            if (strpos($verifyTransaction, 'Success') !== false) {
                $allSufficientQuantity = $this->checkSufficientQuantity($cartItems);
                if ($allSufficientQuantity) {
                    $orderData = Order::create([
                        'user_id' => $userID,
                        'total_amount' => $sum,
                        'status' => 'Success',
                        'reference_id' => $oid,
                    ]);

                    foreach ($cartItems as $cart) {
                        OrderDetail::create([
                            'order_id' => $orderData->id,
                            'product_id' => $cart->product_id,
                            'quantity' => $cart->quantity,
                            'price' => $cart->sub_total,
                        ]);

                        Cart::destroy($cart->id);
                    }

                    $this->savePaymentDetails($request, $sum, 'Success');

                    $this->sendMail($orderData->id);
                    return redirect('/user/order')->with('success', 'Successfully Added Order With Payment');
                } else {
                    return redirect('/user/order')->with('success', 'Payment Successful but some items were not available.');
                }
            } else {
                return redirect('/user/cart')->with('error', 'Payment Not Verified');
            }
        } else {
            return redirect('/user/cart')->with('error', 'Payment failed');
        }
    }
    public function checkSufficientQuantity($cartItems)
    {
        DB::beginTransaction();
        try {
            foreach ($cartItems as $cart) {
                $sufficientQuantity = Upload::where('id', $cart->product_id)
                    ->where('quantity', '>=', $cart->quantity)
                    ->exists();

                if ($sufficientQuantity) {
                    Upload::where('id', $cart->product_id)
                        ->update([
                            'quantity' => DB::raw('quantity - ' . $cart->quantity),
                            'purchased_quantity' => DB::raw('purchased_quantity + ' . $cart->quantity)
                        ]);
                } else {
                    DB::rollBack();
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    // Verify transaction with eSewa API
    public function verifyTransaction($data, $sum)
    {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $params = [
            'amt' => $sum,
            'rid' => $data->refId,
            'pid' => $data->oid,
            'scd' => 'EPAYTEST'
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // Send an invoice email after successful order
    public function sendMail($order_id)
    {
        $orderData = Order::with('orderDetails.product', 'user')->find($order_id);
        dispatch(new UserJob($orderData));  // Assuming UserJob handles email sending
    }

    // Save payment details into the database
    public function savePaymentDetails(Request $request, $amount, $status)
    {
        PaymentSuccessful::create([
            'payment_id' => $request->refId,
            'status' => $status,
            'amount' => $amount,
            'reference_id' => $request->oid,
        ]);
    }

    // Handle the callback response from eSewa
    public function handleCallback(Request $request)
    {
        dd($request);
        $response = $request->getContent();
        $decodedData = json_decode($response, true);

        if ($decodedData['status'] == 'Success') {
            // Save payment details in the database
            $this->savePaymentDetails($request, $decodedData['amount'], 'Success');
            $this->processOrder($decodedData);

            return response()->json(['message' => 'Payment Successful', 'data' => $decodedData], 200);
        } else {
            // Payment Failed
            return response()->json(['message' => 'Payment Failed', 'data' => $decodedData], 400);
        }
    }

    // Process order and update order status to 'Paid'
    public function processOrder($decodedData)
    {
        $order = Order::where('reference_id', $decodedData['reference_id'])->first();

        if ($order) {
            $order->status = 'Paid';
            $order->save();
            $this->updateOrderDetails($order);
        }
    }

    // Update the quantity of products based on the order details
    public function updateOrderDetails($order)
    {
        foreach ($order->orderDetails as $orderDetail) {
            Upload::where('id', $orderDetail->product_id)
                ->decrement('quantity', $orderDetail->quantity);
        }
    }
}
