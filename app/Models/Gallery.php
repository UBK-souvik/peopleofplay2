<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model 
{
    protected $fillable = [
        'user_id', 'destination_id', 'assign_product_id', 'assign_brand_id', 'assign_event_id', 'type', 'media', 'title', 'caption', 'url', 'is_known_for', 'featured_image', 'status', 'feed_id', 'created_at', 'updated_at'
    ];

    public static $fillable_shadow = [
        'type',
        'sr_no',
        'user_id',
        'media',
        'title',
        'featured_image',
        'caption',
        'url',
        'status',
		'is_known_for'
    ];
	
	public static function validateGallery()
    {
        return [
            // 'main_image' => 'required_without:product_id|file',
            'gallery_meta.title' => 'required',
			'gallery_meta.caption' => 'required',
			//'photo' => 'array',
            'photo' => 'file',//.*
			'persons' => 'required|array',
			'products' => 'required|array',
			//'awards' => 'required|array',
			//'companies' => 'required|array'            
        ];
    }
	
	public function gallery_person_tags()
    {
        return $this->hasMany(GalleryPersonTag::class, 'gallery_id', 'id');
    }

    public function gallery_product_tags()
    {
        return $this->hasMany(GalleryProductTag::class, 'gallery_id', 'id');
    }
	
	public function gallery_award_tags()
    {
        return $this->hasMany(GalleryAwardTag::class, 'gallery_id', 'id');
    }
	
	public function gallery_company_tags()
    {
        return $this->hasMany(GalleryCompanyTag::class, 'gallery_id', 'id');
    }
	
	public function gallery_people_tags()
    {
        return $this->hasMany(GalleryPeopleTag::class, 'gallery_id', 'id');
    }
	
	public function gallery_other_tags()
    {
        return $this->hasMany(GalleryOtherTag::class, 'gallery_id', 'id');
    }
	
	public function gallery_products()
    {
		return $this->belongsTo('App\Models\Product', 'assign_product_id');
    }
	
	public function gallery_events()
    {
		return $this->belongsTo('App\Models\Event', 'assign_event_id');
    }
	
	public function gallery_users()
    {
		return $this->belongsTo('App\Models\User', 'user_id');
    }
	
	public function user_data()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
}
