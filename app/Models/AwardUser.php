<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardUser extends Model
{
    protected $table = 'award_users';

    protected $fillable = [
       'user_id',
       'title',
       'url_data',
       'featured_image'
    ];

    public static $fillable_shadow = [
       'user_id',
       'title',
       'url_data',
       'featured_image'
    ];
}
