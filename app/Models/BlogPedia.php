<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BlogPedia extends Model
{

    protected $fillable = [
        'blog_id',
        'added_by',
        'status'
    ];

    public static $fillable_shadow = [
       'blog_id',
        'added_by',
        'status'
    ];

    public function blog_data()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
