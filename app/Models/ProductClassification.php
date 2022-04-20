<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductClassification extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'category_id',
        'type',
        'sub_category',
        'official_link',
        'social_media',
        'toy_type',
        'delivery_mechanism',
        'game_type',
        'inventor',
        'team',
        'launched',
    ];
}
