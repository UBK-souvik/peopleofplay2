<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $table =  'skills';

    protected $guarded = [];		
	
	public static function get_skill_list()	
	{	  
	   $data = Skill::select('skill as name', 'id')->groupBy('skill')->get();	  	  
	   return $data;	
	}
	
	public static function save_skill_data($data_skills)	
	{
	   $explode =  $data_skills;
                if (!empty($explode) && is_array($explode) && count($explode) > 0) {
                    foreach ($explode as $key => $value) {
                        if(!empty($value))
						{
						  $skill = Skill::firstOrNew(array('skill' => $value));
                          $skill->save();
						}
                    }
                }
      }
}
