<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{

    protected $fillable = [
        'display_order',
        'title',
        'type',
        'status',
    ];
	
	public function brand_lists()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 7);
    }

    public function products()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 1);
    }

    public function events()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 2);
    }

    public function latestNews()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 3);
    }

    public function newsLetter()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 4);
    }

    public function birthDaysAndAnniversaries()
    {
        return User::whereMonth('dob', '=', Carbon::now()->format('m'))
            ->whereDay('dob', '=', Carbon::now()->format('d'))
            ->paginate(4);
        // return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 5);
    }

    public function polls()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 5);
    }

    public function users()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->where('type', 6);
    }

    public function VideoLinks()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->whereNotNull('video_link')->where('type', 0);
    }

    public function RightVideoLinks()
    {
        return $this->hasMany(HomePageDetail::class, 'home_page_id', 'id')->whereNotNull('right_video_link')->where('type', 0);
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
                return $this->events;
                break;

            case 4:
                # code...
                break;

            case 6:
                return $this->users;
                break;
			case 7:
                return $this->brand_lists;
                break;	
        }
        return $response;
    }
}
