<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryProductTag extends Model
{
    //
	
	protected $fillable = ['gallery_id', 'user_id', 'product_id', 'status', 'created_at', 'updated_at'];
	
	public function productdata()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
	
}
