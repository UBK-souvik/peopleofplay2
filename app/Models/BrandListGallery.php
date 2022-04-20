<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListGallery extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'type',
        'title'
    ];
}
