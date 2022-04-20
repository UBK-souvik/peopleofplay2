<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGalleryMetaData extends Model
{
    protected $fillable = [
        'product_gallery_id',
        'meta_key',
        'meta_value',
        'meta_value_int'
    ];

    public static $fillable_shadow = [
        'product_gallery_id',
        'meta_key',
        'meta_value',
        'meta_value_int'
    ];
}
