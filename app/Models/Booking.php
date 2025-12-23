<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = [
        'room_id','guest_name','guest_email','check_in','check_out','nights','total_amount','status','razorpay_order_id'
    ];

    public function room()
    {
        
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
