<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloomAdsImages extends Model
{
    //
    protected $table = 'bloom_ads_images';

    protected $fillable = [
        'id','slug','category_id','image','status','created_at','updated_at'
    ];
}
