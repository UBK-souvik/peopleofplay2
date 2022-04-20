<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListVideo extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'value'
    ];
}
