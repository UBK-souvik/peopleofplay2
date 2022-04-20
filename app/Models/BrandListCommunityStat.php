<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListCommunityStat extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'own',
        'for_trade',
        'wishlist',
        'want_it_trade',
        'has_part',
        'wants_part'
    ];
}
