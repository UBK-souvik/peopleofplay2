<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social_media_setting extends Model
{
    //
    //protected $table = 'social_media_setting';

    protected $fillable = [
        'type',
        'icon'
    ];
}
