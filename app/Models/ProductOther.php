<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOther extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'in_depth_review',
        'ratings',
        'forum',
        'forum_categories'
    ];
}
