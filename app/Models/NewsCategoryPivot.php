<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryPivot extends Model
{

    protected $fillable = [
        'news_id',
        'news_category_id',
		'status'
    ];

    public static $fillable_shadow = [
        'news_id',
        'news_category_id',
		'status'
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id', 'id');
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }
}
