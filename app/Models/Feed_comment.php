<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed_comment extends Model
{
    protected $table  = 'feed_comment';
    protected $fillable = ['user_id', 'feed_id' ,'news_feed_id', 'type', 'comment', 'comm_id', 'reply_id'];
}
