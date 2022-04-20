<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
   use HasSlug;
    protected $fillable = [
       'category_id',
       'title',
       'slug',
       'user_id',
       'authore_no_profile',
       'url',
       'featured_image',
       'description',
       'status',
       'is_feed_btn',
    ];

    public static $fillable_shadow = [
       'category_id',
       'title',
       'slug',
       'user_id',
       'authore_no_profile',
       'url',
       'featured_image',
       'description',
       'status',
       'is_feed_btn',
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

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

 public function wikiCategory()
    {
       return $this->hasOne(WikiCategory::class ,'id','category_id');
    }
    
}