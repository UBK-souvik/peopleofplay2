<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'type',
        'title'
    ];
}
