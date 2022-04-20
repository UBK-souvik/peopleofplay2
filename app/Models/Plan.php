<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Plan extends Model
{
    //
	
	// user details
    public static function get_plan_details($plan_id)
	{
	  $plan_data = DB::table('plans')
			->select('plans.id', 'plans.name', 'plans.price', 'plans.stripe_plan_id_live', 'plans.stripe_plan_id')  
			 ->where('plans.id', $plan_id)
			 ->orderBy('plans.id', 'desc')
			 ->first();
			 
	  return $plan_data;		 
	}
}
