<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPersonTag extends Model
{
    //
	protected $fillable = ['gallery_id', 'user_id', 'person_id', 'status', 'created_at', 'updated_at'];
	
	public function persondata()
    {
        return $this->belongsTo('App\Models\User', 'person_id');
    }
}
