<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListCategory extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
