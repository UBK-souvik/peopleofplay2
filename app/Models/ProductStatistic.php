<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStatistic extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'page_views',
        'standard_deviation',
        'number_of_ratings',
        'overall_rank',
        'all_time_plays',
        'party_rank',
        'this_month',
        'own',
        'for_trade',
        'wishlist',
        'previously_owned',
        'want_it_trade',
        'has_part',
        'wants_part',
        'comments',
        'fans'
    ];
}
