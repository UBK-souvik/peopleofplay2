<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasSlug;

    protected $fillable = [
        'user_id',
		'added_by',
		'date_to_be_published',
        'title',
        'description',
        'status'
    ];

    public static $fillable_shadow = [
        'user_id',
        'added_by',
		'date_to_be_published',
		'title',
        'description',
        'status'
    ];


    public function getSlugOptions()
    {

        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
	
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
	public static function get_dictionary_list_search_by_name($searchTerm)
	{
	   $data_list = DB::table('dictionaries')
			->select('dictionaries.id', DB::raw("dictionaries.title as text"))  
			 ->where(function($q)use ($searchTerm) {
                            	$q->where('dictionaries.title', 'LIKE', '%'.$searchTerm.'%');
			 })->get();
					 
		return $data_list;
	}
	
	
	public static function get_dictionary_word_of_day($id='')
	{
        if(!empty($id)){
            $dictionary_detail = Dictionary::where('id',$id)->get();
            return $dictionary_detail;	die;
        }

		$str_current_date = date('Y-m-d');
	
		$dictionary_detail = Dictionary::where('status', 1)
				->whereDate('date_to_be_published', $str_current_date)
				->get();
					
        if(empty($dictionary_detail[0]->id))
		{			
	 	   $dictionary_detail = Dictionary::where('status', 1)
		    ->whereDate('date_to_be_published', '<=', $str_current_date)
		    ->inRandomOrder()
			->limit(10)
            ->orderBy('id', 'asc')
            ->get(); 		
        }				
		
        return 	$dictionary_detail;				
	}		
}
