<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainListPage extends Model
{
    protected $fillable = [
        'display_order',
        'title',
        'type',
		'category_id',
        'status',
    ];
	
	public function brand_lists()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->whereIn('category_id', [7]);
    }

    public function products()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->whereIn('category_id', [1, 2]);
    }

    public function awards()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->whereIn('category_id', [6]);
    }

    public function events()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->where('category_id', 5);
    }

    public function users()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->where('category_id', 4);
    }

    public function companies()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->where('category_id', 3);
    }

    public function videos()
    {
        return $this->hasMany(MainListPageDetail::class, 'main_list_page_id', 'id')->whereNotNull('video_link');
    }

    public function getExpendables()
    {
        $type = $this->category_id;

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
