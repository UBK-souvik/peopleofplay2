<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedAd extends Model
{
    protected $table = 'feeds_ad';
    
    protected $guarded = [];

    protected $fillable = ['type', 'image', 'url', 'status'];

}
