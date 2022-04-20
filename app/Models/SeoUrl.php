<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class SeoUrl extends Model
{
    protected $fillable = [        
		'url_data',
		'title',
        'description',
		'keywords',
        'status',
    ];

    public static $fillable_shadow = [
        'url_data',
		'title',
        'description',
        'keywords',
		'status',
    ];

}
