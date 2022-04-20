<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SideBarDetail extends Model
{
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

    public function news()
    {
        return $this->belongsTo(News::class, 'reference_id', 'id');
    }

    public function interview()
    {
        return $this->belongsTo(Blog::class, 'reference_id', 'id');
    }

}
