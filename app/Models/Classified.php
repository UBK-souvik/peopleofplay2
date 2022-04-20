<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Classified extends Model
{
    use HasSlug;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'added_by',
        'status',
		'profile_url'
    ];

    public static $fillable_shadow = [
        'user_id',
        'category_id',
        'title',
        'description',
        'added_by',
        'status',
		'profile_url'
    ];


    public function getSlugOptions()
    {

        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(ClassifiedCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
	public static function get_all_classified_list($type_id)
	{
		$classified_list = Classified::with(['user']);//select('classifieds.title', 'classifieds.id', 'classifieds.description', 'classifieds.created_at')
		
		//$classified_list->leftjoin('classified_applications','classified_applications.classified_id', '=', 'classifieds.id');
	
        //$classified_list->;	
		if(!empty($type_id))
		{
		   $classified_list->where('classifieds.category_id', $type_id);	
		}		
		
	 	$classified_list_data = $classified_list->where('classifieds.status', 1)->orderBy('classifieds.id', 'desc')->get();//CONCAT_WS
        
		return $classified_list_data;
	}
}
