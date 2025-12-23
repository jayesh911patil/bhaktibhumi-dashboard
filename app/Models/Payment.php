<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $fillable = [
        'booking_id','razorpay_payment_id','razorpay_order_id','razorpay_signature','amount','status','payload'
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
