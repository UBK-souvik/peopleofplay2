<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementCategory extends Model
{
    protected $fillable = [
        'category',
        'status',
        'created_at',
        'updated_at'	
    ];

    public static $fillable_shadow = [
        'category',
        'status',
        'created_at',
        'updated_at'	
    ];
	
}