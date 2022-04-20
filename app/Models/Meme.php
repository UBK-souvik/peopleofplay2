<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $fillable = [
      'file_name',
      'featured_image',
      'date',
      'schedule_date',
      'is_schedule',
      'is_seen',
      'status'
    ];

    public static $fillable_shadow = [
      'file_name',
      'featured_image',
      'date',
      'schedule_date',
      'is_schedule',
      'is_seen',
      'status'
    ];

    
}