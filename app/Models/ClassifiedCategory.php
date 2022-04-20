<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassifiedCategory extends Model
{
    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    public static $fillable_shadow = [
        'id',
        'name',
        'status'
    ];
	
	
	public static function get_all_classified_categories()
	{
		$classified_categories = ClassifiedCategory::select('name', 'id')->where('status', 1)->get();//CONCAT_WS
        
		return $classified_categories;
	}
	
}
