<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
	use HasSlug;
	
    protected $fillable = [
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
        'category_id'	
    ];

    public static $fillable_shadow = [
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
        'category_id'
    ];
	
	public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(array('title'))
            ->saveSlugsTo('slug');
    }
	
}