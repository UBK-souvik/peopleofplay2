<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class YoutubePremiere extends Model
{

    protected $fillable = [
       'url',
       'description',
       'status'
    ];

    public static $fillable_shadow = [
      'url',
      'description',
      'status'
    ];    
}