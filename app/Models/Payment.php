<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_id', 'email', 'amount', 'currency', 'status', 'signature', 'razorpay_payment_id','razorpay_order_id'];

}
