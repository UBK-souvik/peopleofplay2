<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'type',
        'url',
    ];

    public function products()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->whereIn('type', [4]);
    }

}
