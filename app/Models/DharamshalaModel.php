<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DharamshalaModel extends Model
{
    use SoftDeletes;
    protected $table = 'dharamshala';
    protected $primaryKey = 'dharamshala_id';
    protected $guarded = [];
}
