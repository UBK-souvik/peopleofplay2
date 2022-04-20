<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
     protected $fillable = [
        'title',
        'featured_image',
        'status'
    ];

    public static $fillable_shadow = [
        'title',
        'featured_image',
        'status'
    ];

}
