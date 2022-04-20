<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasSlug;

    protected $fillable = [
        'user_id',
		'is_featured',
		'is_home_page',
        'title',
        'featured_image',
        'description',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'added_by',
        'status'
    ];

    public static $fillable_shadow = [
        'user_id',
        'is_featured',
		'is_home_page',
		'title',
        'featured_image',
        'description',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'added_by',
        'status'
    ];


    public function getSlugOptions()
    {

        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function categories()
    {
        return $this->hasMany(NewsCategoryPivot::class, 'news_id', 'id');
    }
	
	public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
