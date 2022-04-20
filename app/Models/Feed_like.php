<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed_like extends Model
{
    protected $table  = 'feed_likes';
    protected $fillable = ['user_id','feed_id' ,'news_feed_id', 'reply_id', 'type'];
}
