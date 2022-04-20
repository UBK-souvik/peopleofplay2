<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];

    public static $fillable_shadow = [
        'title',
        'description',
        'image',
        'status'
    ];
	
	
}
