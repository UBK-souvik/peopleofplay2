<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PubHeading extends Model
{
    protected $guarded = [];

    public static function getAppSetting()
    {
        return self::pluck('value', 'attribute')->toArray();
    }
}
