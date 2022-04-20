<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListGalleryMetaData extends Model
{
    protected $fillable = [
        'brand_list_gallery_id',
        'meta_key',
        'meta_value',
        'meta_value_int'
    ];

    public static $fillable_shadow = [
        'brand_list_gallery_id',
        'meta_key',
        'meta_value',
        'meta_value_int'
    ];
}
