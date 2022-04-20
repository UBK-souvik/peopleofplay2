<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'status'
    ];

    public static $fillable_shadow = [
        'parent_id',
        'name',
        'status'
    ];
}
