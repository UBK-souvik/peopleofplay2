<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAwardNominee extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'reference_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reference_id', 'id');
    }

    public  function eventAward()
    {
        return $this->belongsTo(EventAward::class, 'event_award_id', 'id');
    }
}
