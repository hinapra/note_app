<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function showPaymentForm()
    {
        return view('razorpay.form');
    }


    public function handlePayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);
    
            if ($payment->status == 'captured') {
                // Save payment to DB
                Payment::create([
                    'razorpay_order_id' => $payment->order_id ?? '',
                    'razorpay_payment_id' => $payment->id,
                    'signature' => $request->razorpay_signature ?? '',
                    'amount' => $payment->amount / 100, // Razorpay gives amount in paise
                    'currency' => $payment->currency,
                    'status' => $payment->status,
                    'user_id' => auth()->id() ?? null,
                ]);
    
                return back()->with('success', 'Payment successful and recorded!');
            }
    
            return back()->with('error', 'Payment not captured!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
    
}
