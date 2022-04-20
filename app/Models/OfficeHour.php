<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class OfficeHour extends Model
{
    protected $fillable = [
      'featured_image',
      'description',
      'featured_image_url',
      'type',
      'meeting_url',
      'website_url',
      'status'
    ];

    public static $fillable_shadow = [
      'featured_image',
      'description',
      'featured_image_url',
      'type',
      'meeting_url',
      'website_url',
      'status'
    ];

    
}