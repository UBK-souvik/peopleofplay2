<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Entertainment extends Model
{
   use HasSlug;
    protected $fillable = [
       'category_id',
       'title',
       'type',
       'slug',
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
       'type',
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

 public  function entertainmentCategory()
 {
     return $this->hasOne(EntertainmentCategory::class,'id','category_id');
 }
    
}