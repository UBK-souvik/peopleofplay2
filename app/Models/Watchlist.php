<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'value_id'
    ];

    public static $fillable_shadow = [
        'user_id',
        'type',
        'value_id'
    ];


    public function inventor()
    {
        return $this->belongsTo(User::class, 'value_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'value_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'value_id', 'id');
    }
}
