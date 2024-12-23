<?php

use Illuminate\Support\Facades\Auth;

function user(){
    return Auth::user();
}

function generateSignature($amount, $transactionId)
    {
        // eSewa signature key
        $key = 'YOUR_SECRET_KEY';  // Replace this with your actual eSewa secret key

        // Generate signature
        $signature = hash_hmac('sha256', $amount . '|' . $transactionId, $key);

        return $signature;
    }
