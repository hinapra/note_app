<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $request->amount * 100, // Amount in paise (e.g., 500 for ₹5.00)
            'currency' => 'INR',
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'key' => env('RAZORPAY_KEY')
        ]);
    }


    public function verifySignature(Request $request)
{
    $signature = $request->razorpay_signature;
    $orderId = $request->razorpay_order_id;
    $paymentId = $request->razorpay_payment_id;

    $generatedSignature = hash_hmac('sha256', $orderId . "|" . $paymentId, env('RAZORPAY_SECRET'));

    if ($generatedSignature === $signature) {
        return response()->json(['message' => 'Payment verified']);
    } else {
        return response()->json(['message' => 'Invalid signature'], 400);
    }
}

}
