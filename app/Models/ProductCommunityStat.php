<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCommunityStat extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'own',
        'for_trade',
        'wishlist',
        'want_it_trade',
        'has_part',
        'wants_part'
    ];
}
