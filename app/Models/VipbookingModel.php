<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VipbookingModel extends Model
{
     use SoftDeletes;

     protected $table = 'vip_booking';
    protected $primaryKey = 'vip_booking_id';
    protected $guarded = [];
}
