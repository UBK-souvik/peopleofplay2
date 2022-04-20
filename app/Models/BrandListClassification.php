<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListClassification extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
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
