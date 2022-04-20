<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPeopleTag extends Model
{
    //
	protected $fillable = ['gallery_id', 'people_id', 'user_id', 'status', 'created_at', 'updated_at'];
	
	public function peopledata()
    {
        return $this->belongsTo('App\Models\User', 'people_id');
    }
}
