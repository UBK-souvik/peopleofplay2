<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListBuyFrom extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'type',
        'suggested_retail',
        'ebay',
        'amazon',
        'pop',
		'ebay_caption',
        'amazon_caption',
        'pop_caption'
    ];
}
