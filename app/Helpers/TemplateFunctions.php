<?php

namespace App\Helpers;

use URL;
use DB;
use Carbon\Carbon;
use File;
use App\Helpers\UtilitiesFour;

class TemplateFunctions
{
		
		public  static function getCollaboratorListUsers($peoples_list_data)
		{
		   $str_colloborator_list_content ='';	
		   
		   foreach($peoples_list_data as $collaborator_key => $collaborator)
		   {			  
		              					   
		               $str_colloborator_name = '';
					   $str_colloborator_profile_image = '';
					  
					   if(!empty($collaborator->people_name))
					   {
						   $str_colloborator_name = @$collaborator->people_name;
					   }
					   else
					   {
						   $str_colloborator_name = @$collaborator->name;
					   }
					   
					   $str_colloborator_profile_image = @imageBasePath($collaborator->profile_image);
					   
                        if($collaborator_key > 2 )
                        { 
                             $str_tr_class = "py-1 px-3";
							 $str_td_class_one=   "pt-3";
							$str_td_class_two=   "pt-3";
							 
                        }

                        if($collaborator_key <= 2 )
                        { 
                            $str_tr_class = "py-0 px-3";
							$str_td_class_one=   "";
							 $str_td_class_two=   "";							
                        }						
						
					      $str_colloborator_list_content =  $str_colloborator_list_content .' <tr class="'.$str_tr_class.'">';
                          $str_colloborator_list_content =  $str_colloborator_list_content .' <td>';
						  $str_colloborator_list_content =  $str_colloborator_list_content .' 		<img src="'.$str_colloborator_profile_image.'" class="rounded-circle ">'; 									
						  $str_colloborator_list_content =  $str_colloborator_list_content .' 	    </td>';
                           $str_colloborator_list_content =  $str_colloborator_list_content .'     <td class="'.$str_td_class_one.'"><a href="#" class="dac_name">'.$str_colloborator_name.'</a></td>';
                           $str_colloborator_list_content =  $str_colloborator_list_content .'     <td class="'.$str_td_class_two.'"><p class="dac_name mb-0" style="color: #000;">';
                                    foreach(users_user_roles() as $key => $value)
									{
                                          if(@$collaborator->role == $key)
                                          {  
									       $str_colloborator_list_content =  $str_colloborator_list_content .$value; 
										  }
                                    }      
                                    
                           $str_colloborator_list_content =  $str_colloborator_list_content .     '</p></td>';
                           $str_colloborator_list_content =  $str_colloborator_list_content . '</tr>';
		              
		     }
			 
			 return $str_colloborator_list_content;
		   
		}
		
		public  static function getYearDropDown($year_id, $drop_down_class, $drop_down_name, $drop_down_id)
		{
			$str_drop_down = "<select class='$drop_down_class' name='$drop_down_name' id='$drop_down_id'>";
			
			$str_drop_down = $str_drop_down . "<option value='0'>Year</option>";		
		    
			for($i=1900;$i<=2020;$i++){
				
			   $year  = $i;
			   //$year = date('Y',strtotime("last day of +$i year"));
			   $str_drop_down_selected = '';   
			   if($year == $year_id)
			   {
			      $str_drop_down_selected= 'selected';	   
			   }
			   
			   $str_drop_down = $str_drop_down . "<option $str_drop_down_selected value='$year'>$year</option>";
			}
			
			$str_drop_down = $str_drop_down . "</select>";
			
            return $str_drop_down;
		}
		
		public  static function getMonthDropDown($month_id, $drop_down_class, $drop_down_name, $drop_down_id)
		{
			$str_drop_down = "<select class='$drop_down_class' name='$drop_down_name' id='$drop_down_id'>";
			
			$str_drop_down = $str_drop_down . "<option value='0'>Month</option>";		
		    
			for($i=1;$i<=12;$i++)
			{
			   //$month=date('F',strtotime("first day of -$i month"));
			   $month = date('F', mktime(0, 0, 0, $i, 10)); // March

			   $str_drop_down_selected = '';
			   
			   if($i<10)
			   {
				   $index_month =  '0' . $i;
			   }
			   else
			   {
				   $index_month = $i;
			   }

			   $str_drop_down_selected = '';   
			   if($index_month == $month_id)
			   {
			      $str_drop_down_selected= 'selected';	   
			   }
			   
			   $str_drop_down = $str_drop_down . "<option $str_drop_down_selected value='$index_month'>$month</option>";
			}
			
			$str_drop_down = $str_drop_down . "</select>";
			
            return $str_drop_down;
		}
		
		public  static function getDayDropDown($day_id, $drop_down_class, $drop_down_name, $drop_down_id)
		{
			$str_drop_down = "<select class='$drop_down_class' name='$drop_down_name' id='$drop_down_id'>";
			
			$str_drop_down = $str_drop_down . "<option value='0'>Day</option>";		
		    
			for($i=1;$i<=31;$i++)
			{
			   $day = $i;

			   $str_drop_down_selected = '';   
			   
			   if($day == $day_id)
			   {
			      $str_drop_down_selected= 'selected';	   
			   }
			   
			   $str_drop_down = $str_drop_down . "<option $str_drop_down_selected value='$day'>$day</option>";
			}
			
			$str_drop_down = $str_drop_down . "</select>";
			
            return $str_drop_down;
		}
		
		
public  static function getSocialMediaIcons($social_media_array_value, $social_media_array_type, $int_start_index, $int_count)//
{
	
	$int_socialmedia_count_flag = 1;
	 //$str_socialmedia_class_new = 'style=display:none;';
    $str_socialmedia_class_new = '';
	$str_socialmedia_icons_list = '';
	$str_socal_media_icon_link = '';
	
	$social_media_array_value = array_slice($social_media_array_value, $int_start_index, $int_count, true);
	
	foreach($social_media_array_type as $social_media_array_type_key => $social_media_array_type_val)
	{
		if(empty($social_media_array_value[$social_media_array_type_val]))
		{				 
		 	continue;
		}
		else
		{	

            $str_socal_media_icon_link = @$social_media_array_value[$social_media_array_type_val];  
			
			$str_socal_media_icon_link = UtilitiesFour::get_url_link($str_socal_media_icon_link);
		
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'<div class="Social-align d-flex align-items-center">';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'		<div class="link-text">';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'			<a style="word-break: break-all;"'; 
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'					href="'.$str_socal_media_icon_link.'" target="_blank">';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'        <img src="'.@asset('front/'.(@config('cms.social_media_icon')[$social_media_array_type_val])).'" ';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'         class="img-thumbnail imgsixtyfive mr-2">';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'   </a> ';                         								
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'					<span>';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'       <a href="'.$str_socal_media_icon_link.'" ';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'		class="span-style1" target="_blank">';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'            '.@config('cms.social_media')[$social_media_array_type_val];
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'       </a>';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'  </span>';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'				</div>';
			$str_socialmedia_icons_list = $str_socialmedia_icons_list .'   </div>';

			$int_socialmedia_count_flag++;
	 	}   
    }
	return $str_socialmedia_icons_list;
}

}
