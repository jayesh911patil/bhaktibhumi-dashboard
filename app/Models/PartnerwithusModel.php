<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerwithusModel extends Model
{
    use SoftDeletes;
    protected $table = 'partner_with_us';
    protected $primaryKey = 'partner_with_us_id';
    protected $guarded = [];
}
