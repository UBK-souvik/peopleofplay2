<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'status',
        'created_at',
        'updated_at',
        'category_id'	
    ];

    public static $fillable_shadow = [
        'question',
        'answer',
        'status',
        'created_at',
        'updated_at',
        'category_id'
    ];
	
}