<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Rip extends Model
{
   use HasSlug;
    protected $fillable = [
       'category_id',
       'title',
       'slug',
       'url',
       'featured_image',
       'description',
       'status',
       'news_feed_id'
    ];

    public static $fillable_shadow = [
       'category_id',
       'title',
       'slug',
       'url',
       'featured_image',
       'description',
       'status',
       'news_feed_id'
    ];


    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

 // public static function getWikiCategory()
 // {
 //     return $this->belongsTo(WikiCategory::class,'category_id', 'id');
 // }
    
}