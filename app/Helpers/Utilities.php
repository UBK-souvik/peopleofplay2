<?php

namespace App\Helpers;

use URL;
use DB;
use Carbon\Carbon;
use File;
use Config;
use App\Models\User;
use App\Models\Meme;
use App\Models\Wiki;
use App\Models\Entertainment;
use App\Models\HomePageWhateverDay;
use App\Models\FeedAd;
use DateTime;


class Utilities
{
	    public static $arr_destinations_list;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
           $arr_destinations_list = array("1" => "Profile", "2" => "Product", "3" => "Event", "4" => "Brand");
        }

    public static function getCollaboratorRole($role_id)
    {
        $collaborator_role = config('cms.collaborator_role');

        $str_role_name = $collaborator_role[$role_id];

        return $str_role_name;

    }

	public static function getcollaboratorImagePath($filename)
    {
        if(!empty($filename))
		{
		  return config('cms.originalImagePath') . config('cms.collaboratorImagePath') . $filename;
		}
		else
		{
			return config('cms.originalImagePath') . config('cms.collaboratorImagePath');
		}

    }

    public static function getYoutubeThumbnail($url)
    {
		$videoId = '';

		 if(strpos($url, "v="))
		{
		  $value = explode("v=", $url);

		  $videoId = $value[1];
		}

		if(strpos($url, "/embed"))
		{
		  $value = explode("/embed", $url);

		  $videoId = $value[1];
		}
		
		if(!empty($videoId))
		{
		  $videoId = str_replace("/", "", $videoId);	
		}

        return $videoId;
    }

    public static function getGalleryRedirectUrl($int_gallery_link_type)
    {

			if($int_gallery_link_type == 1)
			{
			   $str_save_gallery_url_redirect = 	"/user/image-gallery";
			}
			else if($int_gallery_link_type == 2)
			{
			   $str_save_gallery_url_redirect = 	"/user/video-gallery";
			}
			else if($int_gallery_link_type == 3)
			{
			   $str_save_gallery_url_redirect = 	"/user/known-for-gallery";
			}
			else
			{
			   $str_save_gallery_url_redirect = 	"/user/image-gallery";
			}

        return $str_save_gallery_url_redirect;
    }

    public static function checkDevice() {
		// checkDevice() : checks if user device is phone, tablet, or desktop
		// RETURNS 0 for desktop, 1 for mobile, 2 for tablets

		if (is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"))) {
		  return is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "tablet")) ? 2 : 1 ;
		}
		else
		{
		  return 0;
		}
   }

    public static function get_destination_types_dropdown($arr_destinations_list, $field_id)
        {
			$dropdown_list = $arr_destinations_list;
			$str_dropdown = '';

			$str_dropdown = $str_dropdown . "<select class='form-control' required name='destination_id' id='destination_id'  required>";
			$str_dropdown =	$str_dropdown . "<option value=''>Select</option>";

			foreach ($dropdown_list as $dropdown_list_row_key => $dropdown_list_row_val) {

				if(!empty($field_id) && $field_id == $dropdown_list_row_key)
				{
					$str_dropdown =		$str_dropdown . "<option selected value='".$dropdown_list_row_key."'>".$dropdown_list_row_val."</option>";
				}
				else
				{
			        $str_dropdown =		$str_dropdown . "<option value='".$dropdown_list_row_key."'>".$dropdown_list_row_val."</option>";
				}

			}

			$str_dropdown =		$str_dropdown . "</select>";

			return $str_dropdown;
		}

		public static function get_destination_types_list()
        {
           return array(1 => 'Profile', 2 => 'Product', 3 => 'Event', 4 => 'Brand');
	    }
		
		public static function get_top_search_types_list()
        {
           return array(0 => 'All', 1 => 'People', 2 => 'Companies', 3 => 'Toys', 4 =>'Games', 5 =>'Brand');
	    }
		
		public static function get_mainlist_destination_types_list()
        {
           return array(1 => 'Toys', 2 => 'Games', 3 => 'Companies', 4 => 'Innovator', 5 => 'Event', 6 => 'Award', 7 => 'Brand', 8 => 'Videos');
	    }
		
		public static function get_search_slug_prefix_list()
        {
           $arr_dest_slugs = array();
		   
		   $arr_dest_slugs[1][2]['type'] = 'People';
		   $arr_dest_slugs[1][3]['type'] = 'Company';
		   $arr_dest_slugs[2][0]['type'] = 'Product';
		   $arr_dest_slugs[3][0]['type'] = 'Event';
		   $arr_dest_slugs[7][0]['type'] = 'Brand';
		   $arr_dest_slugs[8][0]['type'] = 'Blog';
		   $arr_dest_slugs[9][0]['type'] = 'Feeds';
		   $arr_dest_slugs[10][0]['type'] = 'News Feeds';
		   
		   
		   $arr_dest_slugs[1][2]['slug_prefix'] = 'people';
		   $arr_dest_slugs[1][3]['slug_prefix'] = 'company';
		   $arr_dest_slugs[2][0]['slug_prefix'] = 'product';
		   $arr_dest_slugs[3][0]['slug_prefix'] = 'event';
		   $arr_dest_slugs[7][0]['slug_prefix'] = 'brand';
		   $arr_dest_slugs[8][0]['slug_prefix'] = 'blog';
		   $arr_dest_slugs[9][0]['slug_prefix'] = 'feeds';
		   $arr_dest_slugs[10][0]['slug_prefix'] = 'news_feeds';
		   
		   $arr_dest_slugs[1][2]['folder_prefix'] = 'users';
		   $arr_dest_slugs[1][3]['folder_prefix'] = 'users';
		   $arr_dest_slugs[2][0]['folder_prefix'] = 'products';
		   $arr_dest_slugs[3][0]['folder_prefix'] = 'events';
		   $arr_dest_slugs[7][0]['folder_prefix'] = 'brands';
		   $arr_dest_slugs[8][0]['folder_prefix'] = 'blogs';
		   $arr_dest_slugs[9][0]['folder_prefix'] = 'feed';
		   $arr_dest_slugs[10][0]['folder_prefix'] = 'feed';
		   
		   $arr_dest_slugs[1][2]['page_name'] = 'people';
		   $arr_dest_slugs[1][3]['page_name'] = 'company';
		   $arr_dest_slugs[2][0]['page_name'] = 'product';
		   $arr_dest_slugs[3][0]['page_name'] = 'event';
		   $arr_dest_slugs[7][0]['page_name'] = 'brand';
		   $arr_dest_slugs[8][0]['page_name'] = 'blog';
		   $arr_dest_slugs[9][0]['page_name'] = 'feeds';
		   $arr_dest_slugs[10][0]['page_name'] = 'news-feeds';
		   
		   return $arr_dest_slugs;
		   //return array(1 => 'Profile', 2 => 'Product', 3 => 'Event');
	    }
		
		public static function get_slug_prefix_list()
        {
           $arr_dest_slugs = array();
		   
		   $arr_dest_slugs[1]['type'] = 'People';
		   $arr_dest_slugs[2]['type'] = 'Product';
		   $arr_dest_slugs[3]['type'] = 'Event';
		   $arr_dest_slugs[4]['type'] = 'Company';
		   $arr_dest_slugs[5]['type'] = 'Brand';
		   $arr_dest_slugs[6]['type'] = 'Blog';
		   
		   $arr_dest_slugs[1]['slug_prefix'] = 'people';
		   $arr_dest_slugs[2]['slug_prefix'] = 'product';
		   $arr_dest_slugs[3]['slug_prefix'] = 'event';
		   $arr_dest_slugs[4]['slug_prefix'] = 'company';
		   $arr_dest_slugs[5]['slug_prefix'] = 'brand';
		   $arr_dest_slugs[6]['slug_prefix'] = 'blog';
		   
		   $arr_dest_slugs[1]['folder_prefix'] = 'users';
		   $arr_dest_slugs[2]['folder_prefix'] = 'products';
		   $arr_dest_slugs[3]['folder_prefix'] = 'events';
		   $arr_dest_slugs[4]['folder_prefix'] = 'users';
		   $arr_dest_slugs[5]['folder_prefix'] = 'brands';
		   $arr_dest_slugs[6]['folder_prefix'] = 'blogs';
		   
		   $arr_dest_slugs[1]['page_name'] = 'user';
		   $arr_dest_slugs[2]['page_name'] = 'product';
		   $arr_dest_slugs[3]['page_name'] = 'event';
		   $arr_dest_slugs[4]['page_name'] = 'company';
		   $arr_dest_slugs[5]['page_name'] = 'brand';
		   $arr_dest_slugs[6]['page_name'] = 'blog';
		   
		   return $arr_dest_slugs;
		   //return array(1 => 'Profile', 2 => 'Product', 3 => 'Event');
	    }
		
		public static function get_user_slug_prefix_list()
        {
           $arr_dest_slugs = array();
		   
		   $arr_dest_slugs[0][0]['type'] = 'Default';
		   $arr_dest_slugs[1][1]['type'] = 'User';
		   $arr_dest_slugs[2][2]['type'] = 'People';
		   $arr_dest_slugs[2][3]['type'] = 'Company';
		   
		   $arr_dest_slugs[0][0]['slug_prefix'] = 'user/profile';
		   $arr_dest_slugs[1][1]['slug_prefix'] = 'user/free/profile';
		   $arr_dest_slugs[2][2]['slug_prefix'] = 'people';
		   $arr_dest_slugs[2][3]['slug_prefix'] = 'company';
		   $arr_dest_slugs[3][2]['slug_prefix'] = 'people';
		   $arr_dest_slugs[1][2]['slug_prefix'] = 'people';
		   
		   $arr_dest_slugs[1][1]['page_name'] = 'user';
		   $arr_dest_slugs[2][2]['page_name'] = 'people';
		   $arr_dest_slugs[2][3]['page_name'] = 'company';
		   
		   return $arr_dest_slugs;
		   //return array(1 => 'Profile', 2 => 'Product', 3 => 'Event');
	    }
		
		public static function get_search_url_data($base_url, $type, $slug_prefix, $slug)
        {
			$arr_search_slug_prefix_list =  self::get_search_slug_prefix_list();			
			$type = intval($type);
			$slug_prefix = intval($slug_prefix);
			$str_slug_prefix = '';
			
			if($type == 1)
			{				
		    
			}
			else
			{
			   $slug_prefix  = 0;
			}
			
			if(isset($arr_search_slug_prefix_list[$type][$slug_prefix]['slug_prefix']))
			{
				 $str_slug_prefix = $arr_search_slug_prefix_list[$type][$slug_prefix]['slug_prefix'];   
			}
			
			//if($type == 1)
			//{
			 //  $str_search_page_url =  $base_url . '/' . $slug;	
			//}
			//else
			//{
				$str_search_page_url =  $base_url . '/' . $str_slug_prefix . '/' .  $slug;
			//}
						
			if(!empty($str_search_page_url))
			 return $str_search_page_url;
		    else
			 return "#";	
		}
		
		public static function get_slug_prefix_data($id, $key)
        {
			$arr_slug_prefix_list =  self::get_slug_prefix_list();
			
			if(!empty($arr_slug_prefix_list[$id][$key]))
			 return $arr_slug_prefix_list[$id][$key];
		    else
			 return 0;	
		}
		
		public static function get_folder_prefix_data($id, $key)
        {
			$arr_slug_prefix_list =  self::get_slug_prefix_list();
			
			if(!empty($arr_slug_prefix_list[$id][$key]))
			 return $arr_slug_prefix_list[$id][$key];
		    else
			 return 0;	
		}
		
		public static function get_roles_at_list()
        {
           return array(1 => 'Product', 2 => 'Company', 3 => 'Event', 4 => 'Brand', 5 => 'People');
	    }
		
		public static function get_type_of_users_list()
        {
           return array(1 => 'Standard', 2 => 'Paid');
	    }
		
		public static function get_roles_list()
        {
           return array(1 => 'Standard', 2 => 'Innovator', 3 => 'Company');
	    }
		
		public static function get_gallery_link_types_urls()
        {
           return array(1 => 'image-gallery', 2 => 'video-gallery', 3 => 'known-for-gallery');
	    }
		
		public static function get_default_image()
        {
		   $base_url = url('/');	
           return  $base_url . '/front/new/images/Product/team_new.png';
	    }
		
		public static function get_images_upload_folder_path()
        {
           return '/uploads/images/';
	    }

		public static function get_gallery_upload_folder_path()
        {
           return '/uploads/images/gallery/photos/';
	    }
		
		public static function get_media_upload_folder_path()
        {
           return '/uploads/images/media/';
	    }

	    public static function get_awardUser_upload_folder_path()
        {
           return '/uploads/images/awarduser/';
	    }
		
		public static function get_blog_upload_folder_path()
        {
           return '/uploads/images/blogs/';
	    }
		
		public static function get_blog_thumbnails_upload_folder_path()
        {
           return '/uploads/images/blogs/thumbnails/';
	    }
		
		public static function get_people_upload_folder_path()
        {
           return '/uploads/images/people/';
	    }
		
		public static function get_users_upload_folder_path()
        {
           return '/uploads/images/users/';
	    }
		
		public static function get_badges_upload_folder_path()
        {
           return '/uploads/images/badges/';
	    }
		
		public static function get_ads_upload_folder_path()
        {
           return '/uploads/images/advertisements/';
	    }
		
		public static function get_brands_upload_folder_path()
        {
           return '/uploads/images/brands/';
	    }
		
		public static function get_collaborator_upload_folder_path()
        {
           return '/uploads/images/products/collaborator/';
	    }

	    public static function get_award_upload_folder_path()
        {
           return '/uploads/images/award/';
	    }

	     public static function get_wiki_upload_folder_path()
        {
           return '/uploads/images/wiki/';
	    }

	    public static function get_rip_upload_folder_path()
        {
           return '/uploads/images/rip/';
	    } 

	     public static function get_entertainment_upload_folder_path()
        {
           return '/uploads/images/entertainment/';
	    }

		public static function get_office_hour_upload_folder_path()
        {
           return '/uploads/images/office_hour/';
	    }

	    public static function get_meme_upload_folder_path()
        {
           return '/uploads/images/meme/';
	    }

	    public static function get_quiz_upload_folder_path()
        {
           return '/uploads/images/quiz/';
	    }


		public static function get_gallery_images_link($dest_type, $slug)
        {
		   $str_gallery = 	'image-gallery';
		   
		   if(!empty($dest_type) && !empty($slug))
           {
			  $str_link = '/'.$dest_type.'/'.$slug.'/'.$str_gallery;   
			 //$str_link = '/'.$slug.'/'.$str_gallery;   
		   }
		   else
		   {
			 $str_link = '/all/'.$str_gallery;   
		   }

           return $str_link;
	    }

		public static function get_gallery_videos_link($dest_type, $slug)
        {
		   $str_gallery = 	'video-gallery';
		   
		   if(!empty($dest_type) && !empty($slug))
           {
			   $str_link = '/'.$dest_type.'/'.$slug.'/'.$str_gallery;   
			 //$str_link = '/'.$slug.'/'.$str_gallery;   
		   }
		   else
		   {
			 $str_link = '/all/'.$str_gallery;   
		   }

           return $str_link;
	    }

		public static function get_gallery_known_link($dest_type, $slug)
        {
			$str_gallery = 	'known-for-gallery';
           
		   if(!empty($dest_type) && !empty($slug))
           {
			   $str_link = '/'.$dest_type.'/'.$slug.'/'.$str_gallery;   
			 //$str_link = '/'.$slug.'/'.$str_gallery;   
		   }
		   else
		   {
			 $str_link = '/all/'.$str_gallery;   
		   }
		   
		   return $str_link;
	    }

		public static function get_blog_link()
        {
           //return '/user/blog';
		   $current_url_new = url()->current();
		  
		   if(strpos($current_url_new, '/')>0)
		   {
			  $arr_current_url_new = explode('/', $current_url_new);  
			  $arr_current_url_cnt = count($arr_current_url_new);
			  $arr_current_url_last_index = $arr_current_url_new[$arr_current_url_cnt-1];
			  
			  return '/blog-list/' . $arr_current_url_last_index;
		   }
		   else
		   {
			  return '/blog';   
		   }
		   
	    }
		
		public static function get_date_format($oldDate)
        {
			
	        if(strrpos($oldDate, " "))
			{
			   $newDate = explode(" " , $oldDate);
            }  
			else
			{
			   $newDate[0] = $oldDate;
			}
			
			  if(!empty($newDate[0]) && strpos($newDate[0], "-")>0)
              {
				  $newDate_arr = explode( "-" , $newDate[0]);
				  
				  $output = $newDate_arr[0] . "-". $newDate_arr[1] . "-" . $newDate_arr[2];
			  }
			  else
			  {
				  return '';
			  }
			
			return $output;
			/*
			$length = strrpos($oldDate, " ");
            if($length			
			$newDate = explode( "-" , substr($oldDate, $length));
			print_r($newDate);die;
			$output = $newDate[2] . "/". $newDate[1] . "/" . $newDate[0];
			
			return $output;*/
        }
		
		public static function get_date_format_new($oldDate)
        {
			
	        if(strrpos($oldDate, " "))
			{
			   $newDate = explode(" " , $oldDate);
            }  
			else
			{
			   $newDate[0] = $oldDate;
			}
			
			  if(!empty($newDate[0]) && strpos($newDate[0], "-")>0)
              {
				  $newDate_arr = explode( "-" , $newDate[0]);
				  
				  $output = $newDate_arr[2] . "-". $newDate_arr[1] . "-" . $newDate_arr[0];
			  }
			  else
			  {
				  return '';
			  }
			
			return $output;
			/*
			$length = strrpos($oldDate, " ");
            if($length			
			$newDate = explode( "-" , substr($oldDate, $length));
			print_r($newDate);die;
			$output = $newDate[2] . "/". $newDate[1] . "/" . $newDate[0];
			
			return $output;*/
        }
		
		
		public static function get_gallery_type_link_destination($current_url)
        {
			// array keys of this arr_gallery_data array gallery_type 0 gallery_link_type 1 is_known_for 2 destination 3
			
			$current_url = strtolower($current_url);
			
			$arr_gallery_data = array();
			
			$arr_gallery_data[3] = 0;
			
			$arr_destination_types = self::get_destination_types_list();
			
			if(strpos($current_url, 'image-gallery')>0)
			{
			  $arr_gallery_data[0] = 1;
			  $arr_gallery_data[1] = 1;		  
			}
			else if(strpos($current_url, 'video-gallery')>0)
			{
			  $arr_gallery_data[0] = 2;
			  $arr_gallery_data[1] = 2;		  
			}
			else
			{
			  $arr_gallery_data[0] = 1;
			  $arr_gallery_data[1] = 1; 		  
			}
			
			if(strpos($current_url, 'known-for-gallery')>0)
			{
			  $arr_gallery_data[0] = 1;
			  $arr_gallery_data[1] = 3;
              $arr_gallery_data[2] = 1;			  
			}
			
			//foreach($arr_destination_types as $arr_destination_type_row_key => $arr_destination_type_row_val)
			//{
				//$arr_destination_type_row_val = strtolower($arr_destination_type_row_val);
			    
				if(strpos($current_url, '/user')>0)
			    {	
			         $arr_gallery_data[3] = 1;
				}
				else if(strpos($current_url, '/product')>0)
			    {	
			         $arr_gallery_data[3] = array_keys($arr_destination_types)[1];
				}
				else if(strpos($current_url, '/brand')>0)
			    {	
			         $arr_gallery_data[3] = array_keys($arr_destination_types)[3];
				}
				else if(strpos($current_url, '/event')>0)
			    {	
			         $arr_gallery_data[3] = array_keys($arr_destination_types)[2];
				}
				else
			    {	
			         $arr_gallery_data[3] = 0;
				}
				
				//else
				//{
					//$arr_gallery_data[3] = 0;//array_keys($arr_destination_types)[0];
				//}
			//}
			
			return $arr_gallery_data;
		
		}
		
		
	public static function getGalleryUrls($current_url, $type)
    {		
	
	    if(!empty($type))
		{
		   $url_new = str_replace($type, '', $current_url);
           $url_new = $current_url . '/'.$type;	   
		}
		else
		{
			$url_new = $current_url;
		}		

        return $url_new;
    }
	
	public static function getGalleryUrlPrefix($current_url)
    {		
	
	   if(strpos($current_url, '?'))
	   {
		  $arr_quest_url = explode('?', $current_url); 
	   }
	   
	    if(!empty($arr_quest_url[0]))
		{
		    	
		}
		else
		{
		   $arr_quest_url[0] = 	$current_url;
		}
		
	    $arr_slash_url = explode('/', $arr_quest_url[0]);
		
		$cnt_arr_slash_url = count($arr_slash_url);
		
		$k = 0;
		
		$str_slash_url_new ='';
		
		foreach($arr_slash_url as $arr_slash_url_row)
		{
		  /*if(strpos($arr_slash_url_row, '-gallery')>0) 
          {
			 break; 
		  }*/
		  
		  if(($k == (count($arr_slash_url)-1)) &&  !empty($arr_slash_url_row))
		  {
			 break; 
		  }
		  
		  if(empty($str_slash_url_new))
          {
			 $str_slash_url_new  = $arr_slash_url_row;
		  }			  
		  else
		  {
			 $str_slash_url_new = $str_slash_url_new . '/' .$arr_slash_url_row; 
		  }

          $k++;		
		}		
		
        return $str_slash_url_new;
    }
	
	public static function getGalleryTopUrls($base_url, $gallery_url_prefix, $gallery_link_type)
	{
		
		$arr_gallery_link_types_urls = self::get_gallery_link_types_urls();
		
		if(!empty($gallery_link_type) && !empty($gallery_url_prefix))
		{
		  return  $gallery_url_prefix . '/' . $arr_gallery_link_types_urls[$gallery_link_type];
		}
		else
		{
		  return '';	
		}
	}
	
	public static function get_user_url($base_url, $user_data)
	{
		if(empty($user_data))
		{
			return '';
		}
		// pr($user_data->toArray(),1);
		$arr_dest_slugs = array();
		//if($user->type_of_user == 2 && $user->role == 2)
		//{
			$arr_get_user_slug_prefix_list = self::get_user_slug_prefix_list();
			$str_url = '';
			$role_id = $user_data->role;
			$slug = $user_data->slug;
			$type_of_user = $user_data->type_of_user;
	        
            if(isset($arr_get_user_slug_prefix_list[$type_of_user][$role_id]['slug_prefix']) && !empty($arr_get_user_slug_prefix_list[$type_of_user][$role_id]['slug_prefix']))			
			{
				$slug_prefix =  $arr_get_user_slug_prefix_list[$type_of_user][$role_id]['slug_prefix'];
			}
			else
			{
			    $slug_prefix =  $arr_get_user_slug_prefix_list[1][1]['slug_prefix'];
				$slug = '';
			}


            //$slug_prefix =  $arr_get_user_slug_prefix_list[$role_id]['slug_prefix'];  			
			if(($role_id == 1 && $type_of_user == 1))// || ($role_id == 3 && $type_of_user == 2)
			{
			  $str_url = $base_url . '/' . $slug_prefix;			  	
			}
			else
			{
			      $str_url = $base_url . '/' . $slug_prefix . '/' . $slug;
                //$str_url = $base_url . '/' . $slug;			  
			}		
			return $str_url;
		//}
		//else
		//{
			//return '';
		//}
	}

   public static function getDateFormat($date_obj)
	{
		$date_format = @Carbon::parse($date_obj)->format('d M Y');
		
		if(!empty($date_format))
		{
		  return  $date_format;
		}
		else
		{
		  return '';	
		}
	}
	
	public static function getFilterDescriptionHome($description, $type)
	{
		$int_no_of_chars = 0;
		
		// for blog 
		if($type == 3)
		{
		  $int_no_of_chars = 200;	
		}
		// for home page
		else if($type == 2)
		{
		  $int_no_of_chars = 360;
		}
		// for profile page
		else
		{
		  $int_no_of_chars = 450;	
		}
		
		$str_dots =  "...";
		$str_description = strip_tags($description);
		$str_description = addslashes(substr($str_description, 0, $int_no_of_chars));
		return $str_description . $str_dots;
	}
	
	public static function get_status_text($status)
	{
	   return '1';
	}
	
	
	public static function getUserName($user_obj)
	{
		     $str_user_name = '';
	         if(!empty($user_obj->first_name) && !empty($user_obj->last_name))
			  {
				 $str_user_name = $user_obj->first_name . ' ' . $user_obj->last_name;  
			  }
			  else if(!empty($user_obj->first_name))
			  {
				 $str_user_name = $user_obj->first_name;  
			  }
			  else if(!empty($user_obj->last_name))
			  {
				 $str_user_name = $user_obj->last_name;  
			  }
			  else if(!empty($user_obj->username))
			  {
				 $str_user_name = $user_obj->username; 
			  }
			  
			  $str_user_name = ucwords($str_user_name);
			  
			  return $str_user_name;
    }
	
	
	public  static function get_user_name_title_new($current_url_new, $arr_objs)
		{
			  if(!empty($arr_objs[2]) && is_object($arr_objs[2]) && (strpos($current_url_new,'/event/')>0))
			  {  
				$str_user_name = @$arr_objs[2]->name; 

				$str_user_name = $str_user_name . ' | '.Config::get('commonconfig.web_site_name_new');	
			  }
			  elseif(!empty($arr_objs[1]) && is_object($arr_objs[1]) && (strpos($current_url_new,'/product/')>0))
			  {  

				// $str_user_name = @$arr_objs[1]->name; 
				
				/******** || Shubham Code Start ||  ********/
					$home_product_data = HomePageWhateverDay::get_happy_whatever_day(@$arr_objs[1]->slug); 
					$str_user_name = @$home_product_data->home_caption_one; 
				/******** || Shubham Code End ||  ********/

				// echo '<pre>home_product_data - '; print_r($home_product_data); die;
				$str_user_name = $str_user_name . ' | '.Config::get('commonconfig.web_site_name_new');	
			  }
			  else if(!empty($arr_objs[0]) && is_object($arr_objs[0]) && (strpos($current_url_new,'/people/')>0 || strpos($current_url_new,'/company/')>0))
			  {  
				$str_user_name = @self::getUserName($arr_objs[0]); 

				$str_user_name = $str_user_name . ' | '.Config::get('commonconfig.web_site_name_new');	
			  }
			  else
			  {
				$str_user_name = Config::get('commonconfig.web_site_name_new');  
			  }
			  
			  return $str_user_name;
			  
		}
		
		function get_user_object($user_id)
		{
		   $user_obj = User::findOrFail($user_id);
           
		   return $user_obj;			
		}
		
		public static function get_collections_upload_folder_path()
        {
           return '/uploads/images/collections/';
	    }
		
		
		public static function get_product_url($obj_product)
        {
		   $str_home_product_page_url_new = url('/') . '/product/'. @$obj_product->slug;
		   
		   return $str_home_product_page_url_new;
		}


function timeago($time) {
	   $timestamp = $time;	
	   $strTime = array("s", "m", "h", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " ago";
	   }
	}

	public static function feedCommentCount($feed_id,$page_type='')
	{
		if($page_type == 'news_feeds'){
			return DB::table('feed_comment')->select('feed_comment.*')->join('users','users.id','=','feed_comment.user_id')->where(['news_feed_id'=>$feed_id])->get()->count();  
		}else{
			return DB::table('feed_comment')->select('feed_comment.*')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id])->get()->count();  
		}
	}

	public static function feedCommentLikeCount($feed_id,$type='comment',$reply_id=0,$page_type='')
	{
		if($page_type == 'news_feeds'){			
			return DB::table('feed_likes')->where(['news_feed_id'=>$feed_id,'type'=>$type, 'reply_id'=>$reply_id])->get()->count();
		}else{
			return DB::table('feed_likes')->where(['feed_id'=>$feed_id,'type'=>$type, 'reply_id'=>$reply_id])->get()->count();  
		}
	}

	public static function selfLikeFeed($feed_id,$user_id='',$type='comment',$reply_id=0)
	{
		 $checkdata = DB::table('feed_likes')->where(['user_id'=>$user_id,'feed_id'=>$feed_id,'type'=>$type, 'reply_id'=>$reply_id])->get()->first(); 
		 if(!empty($checkdata))
		 {
		 	return true;
		 }
		 return false;
	}

	public static function getCommentsFeeds($feed_id,$type='comment',$reply_id=0,$page_type='')
	{
		if($page_type == 'news_feeds'){
			$data = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image','users.slug')->join('users','users.id','=','feed_comment.user_id')->where(['news_feed_id'=>$feed_id,'type'=>$type])->get();
		 return $data;
		}else{
			$data = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image','users.slug')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id,'type'=>$type])->get();
		 return $data;
		}
		 
	}

	public static function getReplysFeeds($feed_id,$comment_id ,$type='reply',$page_type='')
	{
		if($page_type == 'news_feeds'){
			$data = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image','users.slug')->join('users','users.id','=','feed_comment.user_id')->where(['news_feed_id'=>$feed_id,'type'=>$type,'comm_id'=>$comment_id])->get();
		 	return $data;
		}else{
			$data = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image','users.slug')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id,'type'=>$type,'comm_id'=>$comment_id])->get();
		 	return $data;
		}
		 
	}

	public static function getReplysFeedsLike($feed_id,$comment_id,$user_id,$reply_id=0,$type='comment',$page_type='')
	{

		if($page_type == 'news_feeds'){
			$where = array('news_feed_id'=>$feed_id,'comment_id'=>$comment_id,'reply_id'=>$reply_id,'user_id'=>$user_id,'type'=>$type);
		}else{
			$where = array('feed_id'=>$feed_id,'comment_id'=>$comment_id,'reply_id'=>$reply_id,'user_id'=>$user_id,'type'=>$type);
		}
		// pr($where);
		$data = DB::table('feed_comment_like')->where($where)->count();
		//echo  'gggg'; 
		if(!empty($data)) {
		 return 0;
		//  return asset('front/images/pop_icons/like_icon.png');
		} else {
			return 1;
			// return asset('front/images/pop_icons/7.png');
		}
	}

	public static function getReplysFeedsLikeCount($feed_id,$comment_id,$reply_id=0,$type='comment',$page_type='')
	{
		if($page_type == 'news_feeds'){
			$where = array('news_feed_id'=>$feed_id,'comment_id'=>$comment_id,'reply_id'=>$reply_id,'type'=>$type);
		}else{
			$where = array('feed_id'=>$feed_id,'comment_id'=>$comment_id,'reply_id'=>$reply_id,'type'=>$type);
		}
	// echo "yes"; die;	
		$data = DB::table('feed_comment_like')->where($where)->count();
		if($data>0) {
		 return $data;
		} else {
			return ' 0';
		}
	}

	public static function feedCommentReplyCount($feed_id,$comment_id,$reply_id=0,$type='reply',$page_type='')
	{

		if($page_type == 'news_feeds'){
			$where = array('news_feed_id'=>$feed_id,'comm_id'=>$comment_id,'reply_id'=>$reply_id,'type'=>$type);
		}else{
			$where = array('feed_id'=>$feed_id,'comm_id'=>$comment_id,'reply_id'=>$reply_id,'type'=>$type);
		}
		$data = DB::table('feed_comment')->where($where)->count();
		// echo $data; die;
		if($data>0) {
		 return $data;
		} else {
			return 0;
		}
	}



	public static function getSingleCategoryName($table,$id,$column)
	{
		$name = DB::table($table)->select("$table.*")->where('id',$id)->first([$column]);
		if(!empty($name)){
			return $name->$column;
		}else {
			return '';
		}
	}



	public static function sidebarHomeNew()
	{
		$sidebarData =array();
		// DB::enableQueryLog();
		 $current_date = date('Y-m-d');
		 $sidebarData['meme'] = Meme::where(['date'=>$current_date,'status'=>1,'is_current'=>1])->first();
		 // dd(DB::getQueryLog());
		  $sidebarData['recentBlogsList'] =DB::table('blogs')
         ->join('blog_categories','blog_categories.id','=','blogs.category_id')
         ->where('blogs.status',1)
         ->select('blogs.title','blogs.slug','blogs.featured_image','blog_categories.name')
         ->orderBy('blogs.id','desc')
         ->take(5)->get();

          $sidebarData['recentWikiList'] = Wiki::where('status',1)
         ->orderBy('wikis.id','desc')
         ->with(['wikiCategory'])
         ->take(5)->get();

          $sidebarData['recentEntertainmentList'] = Entertainment::where(['status'=>1,'type'=>'entertainment'])
         ->orderBy('entertainments.id','desc')
         ->with(['entertainmentCategory'])
         ->take(5)->get();

           $sidebarData['recentCastList'] = Entertainment::where(['status'=>1,'type'=>'cast'])
         ->orderBy('entertainments.id','desc')
         ->with(['entertainmentCategory'])
         ->take(5)->get();

		 return $sidebarData;
	}

	public static function get_feeds_ad(){
        $feeds_ad = FeedAd::get();
		return $feeds_ad;
	}

	
}
