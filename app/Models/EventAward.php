<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAward extends Model
{
    protected $fillable = [
        'event_id',
        'award_id',
        'name',
        'description',
        'year_established',
        'year_dissolved',
        'events_associated_with',
        'previous_year_recipients',
        'previous_year_products'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function award()
    {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }

    public function nominees()
    {
        return $this->hasMany(EventAwardNominee::class, 'event_award_id','id');
    }

}
