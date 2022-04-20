<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $table = 'meta_datas';

    protected $fillable = [
        'module',
        'gallery_id',
        'person',
        'product',
        'award',
        'company',
        'other',
        'url'
    ];

    public static $fillable_shadow = [
        'module',
        'gallery_id',
        'person',
        'product',
        'award',
        'company',
        'other',
        'url'
    ];
}
