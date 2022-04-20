<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsFeeds extends Model
{
    protected $table  = 'feeds_news';
    protected $fillable = ['type', 'title','user_id', 'caption', 'tag', 'tag_peoples', 'tag_products', 'tag_companies', 'image', 'video_url', 'url', 'category_id','check_post','time','product_name','submitted_by','news_feeds_submit_id','rip_category_id','secondary_category_id','news_feeds_bloom_id'];
}
