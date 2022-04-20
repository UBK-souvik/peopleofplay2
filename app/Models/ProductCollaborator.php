<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollaborator extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
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
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
