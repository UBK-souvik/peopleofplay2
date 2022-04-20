<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'advertisement_position',
		'advertisement_category',
        'from_date',
        'to_date',
        'destination_link',
        'created_at',
        'modified_at',
        'status',		
    ];

    public static $fillable_shadow = [
        'advertisement_position',
        'advertisement_category',
		'from_date',
        'to_date',
        'destination_link',
        'created_at',
        'modified_at',
        'status',
    ];
	
}