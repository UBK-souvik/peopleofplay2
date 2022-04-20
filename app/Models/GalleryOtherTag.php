<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryOtherTag extends Model
{
    //
	protected $fillable = ['gallery_id', 'tag', 'user_id', 'status', 'created_at', 'updated_at'];
	
}
