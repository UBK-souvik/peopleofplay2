<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed_comment_like extends Model
{
    protected $table  = 'feed_comment_like';
    protected $fillable = ['feed_id' ,'news_feed_id', 'comment_id', 'reply_id', 'user_id', 'type',  'created_at',  'updated_at'];

   


}
