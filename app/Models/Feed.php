<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table  = 'feeds';
    protected $fillable = ['type', 'title','user_id', 'caption', 'tag', 'tag_peoples', 'tag_products', 'tag_companies', 'image', 'video_url', 'url', 'category_id','check_post','time','product_name','news_feeds_id','feeds_bloom_id'];
}
