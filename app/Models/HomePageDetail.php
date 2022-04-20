<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HomePageDetail extends Model
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
            // ->whereMonth('dob', '=', Carbon::now()->format('m'))
            // ->whereDay('dob', '=', Carbon::now()->format('d'));
    }
}
