<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at'	
    ];

    public static $fillable_shadow = [
        'name',
        'status',
        'created_at',
        'updated_at'	
    ];
	
}