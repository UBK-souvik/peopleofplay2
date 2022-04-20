<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainListPageDetail extends Model
{
	
	public function brand_list()
    {
        return $this->belongsTo(BrandList::class, 'reference_id', 'id');
    }
	
    public function product()
    {
        return $this->belongsTo(Product::class, 'reference_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'reference_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reference_id', 'id');
    }
}
