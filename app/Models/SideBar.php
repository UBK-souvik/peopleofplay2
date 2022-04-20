<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SideBar extends Model
{
    protected $fillable = [
        'display_order',
        'title',
        'type',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->whereIn('type', [4]);
    }

    public function awards()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->whereIn('type', [6]);
    }

    public function events()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->where('type', 5);
    }

    public function users()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->where('type', 5);
    }

    public function companies()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->where('type', 6);
    }
    public function news()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->where('type', 3);
    }

    public function interviews()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->where('type', 7);
    }

    public function videos()
    {
        return $this->hasMany(SideBarDetail::class, 'side_bars_id', 'id')->whereNotNull('video_link');
    }

    public function getExpendables()
    {
        $type = $this->type;

        $response = collect([]);
        switch ($type) {
            case 1:
                return $this->products;
                break;

            case 2:
                return $this->products;
                break;

            case 4:
                return $this->users;
                break;

            case 5:
                return $this->events;
                break;
        }
        return $response;
    }
}
