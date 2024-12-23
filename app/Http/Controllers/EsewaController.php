<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\UserJob;
use App\Mail\Invoice;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Upload; // Ensure this is correct
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EsewaController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $status = $request->q;
        $total_price = $request->amt;
        $oid = $request->oid;
        $refId = $request->refId;

        if ($status == 'su') {
            // Payment success
            $userID = session()->get('userData.id');
            $cartItems = Cart::where('user_id', $userID)->get();

            $sum = $cartItems->sum('sub_total');

            $verifyTransaction = $this->verifyTransaction($request, $sum);

            if (strpos($verifyTransaction, 'Success') !== false) {
                // Verified (process further)
                $allSufficientQuantity = $this->checkSufficientQuantity($cartItems);
                if ($allSufficientQuantity) {
                    $orderData = Order::create([
                        'user_id' => $userID,
                        'total_amount' => $sum,
                        'status' => 'Success'
                    ]);

                    foreach ($cartItems as $cart) {
                        OrderDetail::create([
                            'order_id' => $orderData->id,
                            'product_id' => $cart->product_id, // Ensure this matches your actual data structure
                            'quantity' => $cart->quantity,
                            'price' => $cart->sub_total,
                        ]);

                        Cart::destroy($cart->id);
                    }

                    $this->sendMail($orderData->id);
                    return redirect('/user/order')->with('success', 'Successfully Added Order With Payment');
                } else {
                    return redirect('/user/order')->with('success', 'Payment Successful but some items were not available.');
                }
            } else {
                // Not verified
                return redirect('/user/cart')->with('error', 'Payment Not Verified');
            }
        } else {
            // Payment failed
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
                    // Insufficient quantity
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

    public function sendMail($order_id)
    {
        $orderData = Order::with('orderDetails.product', 'user')->find($order_id);
        dispatch(new UserJob($orderData));
        // Mail::to($orderData->user->email)->send(new Invoice($orderData));
    }
}
