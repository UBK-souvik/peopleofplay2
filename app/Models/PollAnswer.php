<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    public function product()
    {
        return $this->belongsTo(PollOption::class, 'option_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(PollOption::class, 'option_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(PollOption::class, 'option_id', 'id');
        // ->whereMonth('dob', '=', Carbon::now()->format('m'))
        // ->whereDay('dob', '=', Carbon::now()->format('d'));
    }
}
