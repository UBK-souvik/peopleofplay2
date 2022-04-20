<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedsCategory extends Model
{
    //
    protected $table = 'feeds_categories';

    protected $fillable = [
        'name','status','created_at','updated_at'
    ];
}
