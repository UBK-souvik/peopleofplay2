<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListOther extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'in_depth_review',
        'ratings',
        'forum',
        'forum_categories'
    ];
}
