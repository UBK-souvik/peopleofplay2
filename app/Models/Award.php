<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'name',
        'description',
        'year_established',
        'year_dissolved',
        'events_associated_with',
        'previous_year_recipients',
        'previous_year_products',
        'status'
    ];

    public static $fillable_shadow = [
        'name',
        'description',
        'year_established',
        'year_dissolved',
        'events_associated_with',
        'previous_year_recipients',
        'previous_year_products',
    ];
}
