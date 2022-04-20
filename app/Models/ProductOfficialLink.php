<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOfficialLink extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'value'
    ];
}
