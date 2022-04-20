<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListCollaborator extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
		'people_id',
		'random_timestamp',
        'image',
        'name',
        'role'
    ];
	
	public function collaboratorData()
    {
        return $this->belongsTo(User::class, 'people_id', 'id');
    }
	
	public function collaboratorProductData()
    {
        return $this->belongsTo(BrandList::class, 'brand_list_id', 'id');
    }
}
