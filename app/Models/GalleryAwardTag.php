<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAwardTag extends Model
{
    //
	protected $fillable = ['gallery_id', 'award_id', 'user_id', 'status', 'created_at', 'updated_at'];
	
	public function awarddata()
    {
        return $this->belongsTo('App\Models\Award', 'award_id');
    }
}
