<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopularritualsModel extends Model
{
    use SoftDeletes;
    protected $table = 'popular_rituals';
    protected $primaryKey = 'popular_rituals_id';
    protected $guarded = [];
}
