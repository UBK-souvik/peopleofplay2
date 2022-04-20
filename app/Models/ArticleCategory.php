<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleCategory extends Model
{
	use HasSlug;
	
    protected $fillable = [
        'category',
        'status',
        'created_at',
        'updated_at'	
    ];

    public static $fillable_shadow = [
        'category',
        'status',
        'created_at',
        'updated_at'	
    ];
	
	 public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
	
	public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(array('category'))
            ->saveSlugsTo('slug');
    }
	
}