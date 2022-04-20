<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedPreferenceIlove extends Model
{

    protected $table = 'feed_preference_ilove';
    protected $fillable = [
        'user_id', 
        'level', 
        'categories'
    ];

    public static $fillable_shadow = [
        'user_id', 
        'level', 
        'categories'
    ];
}
