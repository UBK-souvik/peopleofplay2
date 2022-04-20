<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class BloomReport extends Model
{
    //
    protected $table = 'bloom_reports';

    protected $fillable = [
        'id','slug','section_type','title','sub_heading','caption','date','is_featured','url','category_id','image','video_url','submitted_by','week_range','status','is_home_feed','is_news_feed','created_at','updated_at'
    ];
}
