<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassifiedApplication extends Model
{

    protected $fillable = [
        'applicant_user_id',
		'classified_id',
        'added_by',
        'status',
    ];

    public static $fillable_shadow = [
        'applicant_user_id',
		'classified_id',
        'added_by',
        'status',
    ];
	
	public static function get_classified_application($user_id)
	{
		$classified_application_list = ClassifiedApplication::select('classified_applications.id as classified_applications_id', 'classified_applications.applicant_user_id', 'classified_applications.classified_id');
		
		if(!empty($user_id))
		{
		   $classified_application_list->where('classified_applications.applicant_user_id', $user_id);	
		}		
		
	 	$classified_application_list_data = $classified_application_list->where('classified_applications.status', 1)->get();//CONCAT_WS
        
		return $classified_application_list_data;
	}

}
