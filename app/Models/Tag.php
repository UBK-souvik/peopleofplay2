<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table =  'tags';

    protected $guarded = [];		
	
	public static function get_tag_list()	
	{	  
	   $data = Tag::select('tag as name', 'id')->groupBy('tag')->get();	  	  
	   return $data;	
	}
	
	public static function save_tag_data($data_tags)	
	{
	   $explode =  $data_tags;
                if (!empty($explode) && is_array($explode) && count($explode) > 0) {
                    foreach ($explode as $key => $value) {
                        //echo 'value: '.$value;
						// $skill = Skill::findOrCreate($value);
                        $tag = Tag::firstOrNew(array('tag' => $value));
                        $tag->save();
                    }
                }
      }
}
