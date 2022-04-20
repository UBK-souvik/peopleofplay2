<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCompanyTag extends Model
{
    //
	protected $fillable = ['gallery_id', 'company_id', 'user_id', 'status', 'created_at', 'updated_at'];
	
	public function companydata()
    {
        return $this->belongsTo('App\Models\User', 'company_id');
    }
}
