<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Columnist extends Model
{
	
	protected $table =  'columnists';
    protected $fillable = [
        'user_id',
        'user_type',
        'created_at',
        'updated_at',
    ];
	
}