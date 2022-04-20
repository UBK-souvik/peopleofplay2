<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedPreferenceIama extends Model
{

    protected $table = 'feed_preference_iama';
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
