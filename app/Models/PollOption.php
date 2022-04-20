<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
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
        // ->whereMonth('dob', '=', Carbon::now()->format('m'))
        // ->whereDay('dob', '=', Carbon::now()->format('d'));
    }
}
