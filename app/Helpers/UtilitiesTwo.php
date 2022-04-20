<?php

namespace App\Helpers;

use URL;
use DB;
use Carbon\Carbon;
use File;
use Config;
use Session;
use App\Models\UsersUserRole;
use App\Models\User;
use App\Models\Role;
use App\Models\ProductCollaborator;
use App\Models\Gallery;
use App\Models\Product;

class UtilitiesTwo
{
	public static function get_questions_list_new()
        {
 	      return array(1,2,3,4);
		}
		
	public static function get_fun_fact_word_size_new()
        {
           return 17;
	    }
	    
    public static function get_test_data()
        {
           return array(1 => 'ab', 2 => 'cd');
	    }		
		
		public static function get_batch_list_data()
        {
           return array(1,2,3,4,5);
	    }
		
		 public  static function getUserIP()
		{
			$client  = @$_SERVER['HTTP_CLIENT_IP'];
			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			$remote  = $_SERVER['REMOTE_ADDR'];

			if(filter_var($client, FILTER_VALIDATE_IP))
			{
				$ip = $client;
			}
			elseif(filter_var($forward, FILTER_VALIDATE_IP))
			{
				$ip = $forward;
			}
			else
			{
				$ip = $remote;
			}

			return $ip;
		}
		
		// validate the urls of social media
		public  static function getSocialMediaArrayValue($social_media_data)
		{
			//echo "<pre>"; print_r($social_media_data); die;
			$social_media_array_type = array();
			$social_media_array_value= array();
			if(!empty($social_media_data) && count($social_media_data))
			{                      
				foreach($social_media_data as $socials_val)
				{  
				  $social_media_array_type[] =	$socials_val->type;
				  
				  $social_media_array_value[$socials_val->type] = $socials_val->value;
				  
				  /*if(!empty($socials_val->value))
				  {
					  if(filter_var($socials_val->value, FILTER_VALIDATE_URL))
					  {
					     $social_media_array_value[$socials_val->type] = $socials_val->value;	  
					  }
					  else
					  {
						 continue; 
					  }
				  }*/
				}	
			}

			$social_media_array_type = array_unique($social_media_array_type);	
			//$social_media_array_value = array_unique($social_media_array_value);
			ksort($social_media_array_value);
			
			return array($social_media_array_type, $social_media_array_value);
		}

        public  static function getUserDefaultImage()
		{
		   $current_url =	url()->current();
		   $current_url =  strtolower($current_url);
		   $base_url = url('/');	
			
		   return  $base_url . '/front/new/images/Product/team_new.png';
		}
		
		public  static function getBlogNewsDefaultImage()
		{
		   $current_url =	url()->current();
		   $current_url =  strtolower($current_url);
		   $base_url = url('/');	
			
		   return  $base_url . '/front/new/images/default_blog_news.png';		    
		}
		
		public  static function getDefaultEventProdImageNew()
		{
		   $current_url =	url()->current();
		   $current_url =  strtolower($current_url);
		   $base_url = url('/');	
					     
           return  $base_url . '/front/new/images/default_image.jpg';
		}
		
		public static function get_news_upload_folder_path()
        {
           return '/uploads/images/news/';
	    }
		
		public static function get_blogs_upload_folder_path()
        {
           return '/uploads/images/news/';
	    }
		
		public static function get_events_upload_folder_path()
        {
           return '/uploads/images/events/';
	    }
		
		public static function get_products_upload_folder_path()
        {
           return '/uploads/images/products/';
	    }

	    public static function get_quiz_upload_folder_path()
        {
           return '/uploads/images/quiz/';
	    }
		
		public  static function chkIsMyBlogNews()
		{
		   $current_url =	url()->current();
		   $current_url =  strtolower($current_url);
		   $base_url = url('/');	
			
			if(strpos($current_url, '/blog-list')>0 || strpos($current_url, '/news-list')>0)
			{		     
              return  true;
		    }
			else
			{
			  return  false;
			}
		}
		
		public  static function getBaseUrlData()
		{
		   $base_url = url('/');
		   $arr_base_url = explode('/', $base_url);
		   return $arr_base_url;
		}
		
		public  static function getPreviousUrlData($str_previous_url)
		{
		   $arr_previous_url = explode('/', $str_previous_url);
		   return $arr_previous_url;
		}
		
		public  static function getPagenameData($arr_base_url, $arr_previous_url, $index)
		{
		   $str_page_name = '';
	   
		   if(!empty($arr_previous_url[$index]))
		   {
			  $str_page_name = $arr_previous_url[$index];
			  $str_page_name = strtolower($str_page_name);
			  $str_page_name = trim($str_page_name);
		   }   
		   
		   return $str_page_name;
		}
		
		public  static function getMenuLinks($base_url, $user_current_info)
		{
			$arr_menu_list = array();
			$chk_type_of_user = 0;
			$role_type_id = 0;
			$str_modal_role_type = "return open_select_role_modal();";

			if(!empty($user_current_info->type_of_user))// && get_current_usr_info()->type_of_user == 1
			{
				$chk_type_of_user = $user_current_info->type_of_user; 
			}
            
			if(!empty($user_current_info->role))
			{
			   $role_type_id = $user_current_info->role;	
			}

			if($chk_type_of_user == 2 && $role_type_id == 3)
			{
				$arr_menu_list['profile_user_edit'] = route('front.user.company.edit.profile');				
				$arr_menu_list['profile_change_plan'] = route('front.plans', $role_type_id);
				$arr_menu_list['profile_user_view'] = route('front.pages.company.detail', $user_current_info->slug);
			}
			
			if( ( $chk_type_of_user == 2 || $chk_type_of_user == 3) && $role_type_id == 2)
			{
				$arr_menu_list['profile_user_edit'] = route('front.user.profile.edit');				
				$arr_menu_list['profile_change_plan'] = route('front.plans', $role_type_id);
				$arr_menu_list['profile_user_view'] = route('front.pages.people.detail', $user_current_info->slug);
			}
				
			if($chk_type_of_user == 1 ) 
			{
				// $arr_menu_list['profile_user_edit'] = route('front.user.free.edit.profile');
				$arr_menu_list['profile_user_edit'] = route('front.user.free.edit.profile.edit');
				$arr_menu_list['profile_change_plan'] = route('front.plans', $role_type_id); //
				$arr_menu_list['profile_user_view'] = route('front.pages.people.detail', $user_current_info->slug); $str_modal_role_type;
			}

			$arr_menu_list['profile_change_password'] = route('front.user.profile.change_password');
			$arr_menu_list['profile_product_index'] = route('front.user.product.index');
			$arr_menu_list['profile_all_image_gallery'] = route('front.all.imagegallery.index');
			$arr_menu_list['profile_all_video_gallery'] = route('front.all.videogallery.index');
			$arr_menu_list['profile_event_index'] = route('front.user.event.index');
			$arr_menu_list['profile_blog_index'] = route('front.user.blog.index');
			$arr_menu_list['profile_news_index'] = route('front.user.news.index');
			$arr_menu_list['profile_user_message'] = route('front.user.message');
			$arr_menu_list['profile_dictionary_index'] = route('front.user.dictionary.index');
			$arr_menu_list['profile_classified_index'] = route('front.user.classified.index');
			
			
			$arr_menu_list['str_link_drop_menu_toys'] = route('front.pages.drop_menu','toys');
		    $arr_menu_list['str_link_drop_menu_games'] = route('front.pages.drop_menu','games');
		    $arr_menu_list['str_link_drop_menu_companies'] = route('front.pages.drop_menu','companies');
		    $arr_menu_list['str_link_drop_menu_inventors'] = route('front.pages.drop_menu','innovators');
		    $arr_menu_list['str_link_drop_menu_events'] = route('front.pages.drop_menu','events');
		    $arr_menu_list['str_link_drop_menu_awards'] = route('front.pages.drop_menu','awards');
		    $arr_menu_list['str_link_user_login'] = route('front.login');
		    $arr_menu_list['str_link_user_logout'] = route('front.logout');
		    $arr_menu_list['str_link_user_watch_list'] = route('front.pages.watch_list');
		    $arr_menu_list['str_link_knowledge_base_faqs'] = route('front.pages.knowledge.base.faqs');
		    $arr_menu_list['str_link_knowledge_base_articles'] = route('front.pages.knowledge.base.article.categories');
			$arr_menu_list['str_link_sign_up'] = url('sign-up');
			$arr_menu_list['profile_all_media'] = route('front.user.media.index');
			$arr_menu_list['profile_all_award'] = route('front.user.award.index');
			$arr_menu_list['str_link_coming_soon'] = route('front.page.coming-soon');
			$arr_menu_list['str_link_classifieds'] = route('front.pages.classifieds');
			$arr_menu_list['str_blog_pedia_link_new'] = route('front.pages.blog_pedias');
			
			$arr_menu_list['str_news_link_new'] = 'https://www.chitag.com/the-bloom-report';
			$arr_menu_list['str_interviews_link_new'] = 'http://www.chitag.com/news';
			$arr_menu_list['str_link_pop_2021_first_quarter'] = 'https://www.chitag.com/2021-innovation-conference';
			$arr_menu_list['str_link_pop_industry_get_together'] = 'https://www.chitag.com/industry-get-togethers';
			$arr_menu_list['str_link_pop_2020_pop_tagies_toys_games_awards'] = 'https://www.chitag.com/2021-tagies-toy-and-game-awards';
			$arr_menu_list['str_link_pop_playchic'] = 'https://www.chitag.com/playchic';
			$arr_menu_list['str_link_pop_yic'] = 'https://www.chitag.com/yic';
			$arr_menu_list['str_link_pop_2020_fair_stages'] = 'https://www.chitag.com/2020-fair-stages';
			$arr_menu_list['str_link_pop_play_in_education'] = 'https://www.playineducation.com';
			$arr_menu_list['str_link_pop_contact_us'] = route('front.contact-us');
			$arr_menu_list['profile_brand_index'] = route('front.user.brand.index');
			$arr_menu_list['str_link_drop_menu_brands'] = route('front.pages.drop_menu','brands');
			$arr_menu_list['str_link_drop_menu_kids'] = route('front.pages.drop_menu','kids');
			$arr_menu_list['str_link_drop_menu_rip'] = url('rest-in-play');
			$arr_menu_list['str_link_drop_menu_dictionary_word_of_day'] = url('pop-dictionary-word-of-day/1');
			$arr_menu_list['str_link_drop_menu_dictionary_random'] = url('pop-dictionary-word-of-day/0');
			$arr_menu_list['str_link_pop_play_shop'] = 'https://www.redbubble.com/people/People-of-Play/shop';
			$arr_menu_list['str_manage_account_subscription'] = route('front.user.manage-account-subscription');
			$arr_menu_list['str_manage_payment_subscription'] = route('front.user.manage-payment-subscription');
			$arr_menu_list['str_login'] = route('front.login');
			$arr_menu_list['str_columnists'] = route('front.columnists');
			$arr_menu_list['str_link_advance_search'] = url('home/get-site-search-data');
			$arr_menu_list['str_link_wiki'] = url('wiki');
			$arr_menu_list['str_link_office_hours'] = url('office-hours');
			$arr_menu_list['str_link_pop_entertainment'] = url('entertainment');
			$arr_menu_list['str_link_pop_cast'] = url('popcast');
			
			return $arr_menu_list;
		}
		
		public  static function getMinMaxAge($type)
		{
		   $str_min_age = 0;
		   $str_max_age = 120;
			
		   if($type == 1)
		   {
			  return $str_min_age;  
		   }		   
		   else if($type == 2)
		   {
			   return  $str_max_age;
		   }
		   else
		   {
			  $str_min_age; 
		   }
		}
		
		public  static function getRoleText($type)
		{
		   if($type == 2)
		   {
			  return 'industry';  
		   }		   
		   else if($type == 3)
		   {
			   return  'Team Member';
		   }
		   else
		   {
			  return 'industry';
		   }
		}
		
		public  static function chkSlugInCurrentUrl()
		{
			$current_url =	url()->current();
		    $current_url =  strtolower($current_url);
			
			$base_url = url('/');
		   
		    if(strpos($current_url, '/user/profile/edit')>0 || strpos($current_url, '/company/profile/edit')>0 || strpos($current_url, '/user/free/profile/edit')>0)
			{
			   return 2;	
			}
			else if(strpos($current_url, '/company/')>0 || strpos($current_url, '/people/')>0 || strpos($current_url, '/user/free/profile')>0)
			{
			   return 1;	
			}			
			else if(strpos($current_url, '/change-plan/')>0)
			{
			   return 3;	
			}
			else if(strpos($current_url, '/user/product')>0 || strpos($current_url, '/product/')>0)
			{
			   return 4;	
			}
			else if(strpos($current_url, '/image-gallery')>0 || strpos($current_url, '/video-gallery')>0 || strpos($current_url, '/known-for-gallery')>0)
			{
			   return 5;	
			}
            else if(strpos($current_url, '/user/event')>0 || strpos($current_url, '/event/')>0)
			{
			   return 6;	
			}
            else if(strpos($current_url, '/user/blog')>0)
			{
			   return 7;	
			}			
			else if(strpos($current_url, '/user/did-you-know')>0 || strpos($current_url, '/user/news')>0)
			{
			   return 8;	
			}
			else if(strpos($current_url, '/user/message')>0)
			{
			   return 9;	
			}
			else if(strpos($current_url, '/user/manage-subscription')>0)
			{
			   return 10;	
			}
			else if(strpos($current_url, '/change-password')>0)
			{
			   return 11;	
			}
			else if(strpos($current_url, '/user/manage-account-subscription')>0)
			{
			   return 12;	
			}
			else if(strpos($current_url, '/user/media')>0)
			{
			   return 13;	
			}
			else if(strpos($current_url, '/user/brand')>0 || strpos($current_url, '/brand/')>0)
			{
			   return 14;	
			}
			else if(strpos($current_url, '/user/dictionary')>0 || strpos($current_url, '/dictionary/')>0)
			{
			   return 15;	
			}
			else if(strpos($current_url, '/user/classified')>0 || strpos($current_url, '/classified/')>0)
			{
			   return 16;	
			}
			else if(strpos($current_url, '/user/manage-payment-subscription')>0)
			{
			   return 17;	
			}
			else
			{
				return false;
			}
			/*if(strpos($current_url, $str_people_url)>0)
			{
			   return true;	
			}
			if(strpos($current_url, $str_people_url)>0)
			{
			   return true;	
			}
			if(strpos($current_url, $str_people_url)>0)
			{
			   return true;	
			}
			if(strpos($current_url, $str_people_url)>0)
			{
			   return true;	
			}*/
			
		}
		
		public  static function getUniqueTimeStamp()
		{		
		  $str_unique = uniqid();		  
		  $str_time = time();
		  
		  $str_random = $str_unique . '_' . $str_time;

          return $str_random;		  
		}
		
		
		public static function arrayDifference(array $array1, array $array2, array $keysToCompare = null) {
				$serialize = function (&$item, $idx, $keysToCompare) {
					if (is_array($item) && $keysToCompare) {
						$a = array();
						foreach ($keysToCompare as $k) {
							if (array_key_exists($k, $item)) {
								$a[$k] = $item[$k];
							}
						}
						$item = $a;
					}
					$item = serialize($item);
				};

				$deserialize = function (&$item) {
					$item = unserialize($item);
				};

				array_walk($array1, $serialize, $keysToCompare);
				array_walk($array2, $serialize, $keysToCompare);

				// Items that are in the original array but not the new one
				$deletions = array_diff($array1, $array2);
				$insertions = array_diff($array2, $array1);

				array_walk($insertions, $deserialize);
				array_walk($deletions, $deserialize);

				return array('insertions' => $insertions, 'deletions' => $deletions);
			}
			
			
		public  static function getTagText()
		{		   
			  return '<p class="noteText">Type text and Press Enter to Create a Tag.</p>';		   
		}
		
		
		public  static function chkLiveCurrentUrl()
		{
			$current_url =	url()->current();

		    $current_url =  strtolower($current_url);
			// echo $current_url; die;
			if(strpos($current_url, 'peopleofplay.com') > 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
				
        }
				
		public  static function limit_words($string, $int_start, $word_limit)
		{
			$string=strip_tags($string);
			$arr_new_words = array();
			$str_dots_data = "...";
			
			if(strpos($string, " ")>0)
			{
			   $words = explode(" ", $string);
			   
			   foreach($words as $word_row)
			   {
				   // if the word size is more than 19 
				   if(strlen($word_row)>=19)
				   {
					  $arr_split_word_row = str_split($word_row, 19);
					  $arr_new_words[] = implode(" ", $arr_split_word_row);
				   }
				   else
				   {
				      $arr_new_words[] = $word_row;	   
				   }
				    
			   }
			   			   
			   //$arr_words = array_splice($words, $int_start, $word_limit);
			   $arr_words = array_splice($arr_new_words, $int_start, $word_limit);
			   			   
			   return ucfirst(implode(" ", $arr_words)) . $str_dots_data;	
			}
			else
			{
			   return ucfirst($string) . $str_dots_data;
			}
		}
		
		public  static function words_length($string)
		{
			
			if(strpos($string, " ")>0)
			{
			   $words = explode(" ", $string);	
			   return count($words);	
			}
			else
			{
				return 1;
			}
			
		}

        public  static function no_of_chars_length($string)
		{
			
			if(!empty($string))
			{
			   return strlen($string);	
			}
			else
			{
				return 0;
			}
			
		} 

        public  static function description_words_length()
		{
				return 50;
		}
		public  static function profile_about_words_length()
		{
				return 99;
		}

		public  static function fun_fact_description_words_length()
		{
				return 20;
		}
		
		public  static function word_description_words_length()
		{
				return 400;
		}

        public  static function get_max_upload_image_size()
		{
				return Config::get('commonconfig.max_file_upload_size_new')/1000 . 'MB';
		}


        public  static function get_video_title_data($string)
		{
			
			if(strlen($string)>15)
			{
			   $str_string = substr($string, 0, 15);	
			   return $str_string . '...';
			}
			else
			{
				return $string;
			}
			
		}
		
		public  static function get_blog_title_data($string)
		{
			
			if(strlen($string)>25)
			{
			   $str_string = substr($string, 0, 25);	
			   return $str_string . '...';
			}
			else
			{
				return $string;
			}
			
		}
		
		public  static function get_fun_fact_data($string, $int_no_of_chars)
		{
			
			if(strlen($string)>$int_no_of_chars)
			{
			   $str_string = substr($string, 0, $int_no_of_chars);	
			   return $str_string . '...';
			}
			else
			{
				return $string;
			}
			
		}
		
		public  static function get_limit_words_data($string)
		{
			$string=strip_tags($string);
			$arr_new_words = array();
			
			$int_fun_fact_word_size_new  = UtilitiesTwo::get_fun_fact_word_size_new();
			
			if(strpos($string, " ")>0)
			{
			   $words = explode(" ", $string);
			   
			   foreach($words as $word_row)
			   {
				   // if the word size is more than 15
				   if(strlen($word_row)>=$int_fun_fact_word_size_new)
				   {
					  $arr_split_word_row = str_split($word_row, $int_fun_fact_word_size_new);
					  $arr_new_words[] = implode(" ", $arr_split_word_row);
				   }
				   else
				   {
				      $arr_new_words[] = $word_row;	   
				   }
				    
			   }
			   
			   return ucfirst(implode(" ", $arr_new_words));	
			}
			else
			{
			   return ucfirst($string);
			}
		}


        public  static function get_discount_price_data($discount_value, $discount_percent, $subscription_price)
		{
			$discount_per = 0;
			$after_apply = 0;
			if(!empty($discount_value))
			{
			   $discount_per = $discount_value;
			   $discount_per = number_format((float)$discount_per, 2, '.', '');  // Outputs -> 105.00
			   $after_apply = $subscription_price - $discount_per;
			}
			else if(!empty($discount_percent))
			{
			   $discount_per = $subscription_price * ($discount_percent/100);
			   $discount_per = number_format((float)$discount_per, 2, '.', '');  // Outputs -> 105.00									
			   $after_apply = $subscription_price - $discount_per;	
			}
			else
			{
			   $after_apply = $subscription_price;	
			}
			
			return array(0 => $discount_per, 1 => $after_apply);
			
		}
		
		
		public  static function get_date_from_date_time_data($string)
		{
			$date = strtotime($string);
            $date_new = date('Y-m-d', $date);
		    return $date_new;	
		}
		
		public static function get_user_profile_name($user_data)
	    {
			if(!empty($user_data->role))
			{
				if($user_data->role == 1)
				{
					return 'My Profile';
					//return 'My Account';
				}
				else
				{
					return 'My Profile';
				}
			}
			else
			{
				return 'My Profile';
				//return 'My Account';
			}
			
		}
		
		public static function get_regular_exp_format()
	    {
			return "/(http(s?):\/\/)([a-z0-9\-]+\.)+[a-z]{2,4}(\.[a-z]{2,4})*(\/[^ ]+)*/i";
			
		}
		
		
		public static function get_current_user_url_new()
	    {
			
			$user_current_info = get_current_user_info();
			$base_url = url('/');
			$str_user_url = Utilities::get_user_url($base_url, $user_current_info);
		
		    return $str_user_url;
		}
		
		
		public static function compress_image($source_url, $destination_url)//, $quality
		{
			/*$str_base_path_image = '';
			
			echo 33242;
			if(strpos($destination_url, '/')>0)
			{
			   echo 'abd';
			   $arr_destination_url = explode($destination_url, '/');
			   
			   if(!empty($arr_destination_url) && count($arr_destination_url)>0)  
			   {
				    $int_destination_url = count($arr_destination_url);
				   
		            $file_name = $arr_destination_url[$int_destination_url-1];
					
					for($k =0; $k<$int_destination_url-1; $k++ )
					{
						$str_base_path_image = $str_base_path_image . '/'. $arr_destination_url[$k];
					}
					
					echo 'i:'.$str_base_path_image;
					echo 'f:'.$file_name;
					
                    $upload_status = $source_url->move($str_base_path_image, $file_name);
			
			        return $upload_status;  					
			   }
			
			}
			else
			{
				return false;
			}*/
			
			$quality = 20;
			$int_img_uploaded = 0;
			$info = getimagesize($source_url);
			//echo '<pre>';
			//print_r($info);
			//echo '</pre>';
			
			if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
			elseif ($info['mime'] == 'image/jpg') $image = imagecreatefromjpeg($source_url);
			elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
			elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
			
			$int_img_uploaded = imagejpeg($image, $destination_url, $quality);
			
			//echo "Image uploaded successfully.";
			if(!empty($int_img_uploaded))
			{
			  return true;	
			}
			else
			{
			  return false;	
			}
		}
		
		public static function get_image_types_list()
	    {
			$str_image_types = 'mimes:jpeg,jpg,png,gif|';
			
			return $str_image_types;
		}
		
		public static function get_image_ext_name()
	    {
			$str_image_types = 'jpg';
			
			return $str_image_types;
		}
		
	   public static function get_mobile_no_data($dial_code_data, $mobile_data)
	    {	
		
		$str_dial_code = @$dial_code_data;
		$str_mobile_no = @$mobile_data;

		if(substr($str_dial_code, 0, 1) == '+')
		{
			
		}
		else
		{
		  $str_dial_code = '+' . $str_dial_code;	
		}	

		$arr_dial_code = explode( $str_dial_code, @$str_mobile_no);

		if(!empty($arr_dial_code[1]))
		{
		  $str_mobile_no_new = @$arr_dial_code[1];
		}
		else
		{
		  $str_mobile_no_new = @$arr_dial_code[0];	
		}
		
		 return $str_mobile_no_new;
		
      }

       public static function get_url_validation_check($url)
	    { 

        $_domain_regex = "|^[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,})/?$|";
		if (preg_match($_domain_regex, $url)) {
			return true;
		}

		// Second: Check if it's a url with a scheme and all
		$_regex = '#^([a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))$#';
		if (preg_match($_regex, $url, $matches)) {
			// pull out the domain name, and make sure that the domain is valid.
			$_parts = parse_url($url);
			if (!in_array($_parts['scheme'], array( 'http', 'https' )))
				return false;

			// Check the domain using the regex, stops domains like "-example.com" passing through
			if (!preg_match($_domain_regex, $_parts['host']))
				return false;

			// This domain looks pretty valid. Only way to check it now is to download it!
			return true;
		}

		return false;  	  
		
		}	
		
		public static function get_smtp_details()
	    {
			/*MAIL_USERNAME
			MAIL_PASSWORD
			MAIL_FROM_ADDRESS
			MAIL_HOST
			MAIL_PORT*/
		}
		
		public static function chk_valid_youtube_url($youtube_url)
	    {		
		
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $youtube_url) == 1)
			//if (preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $youtube_url) == 1)
			{
				return true;
			}
			else
			{
				return false;
			}		
		}
		
		public  static function get_whatever_day_title_data($string)
		{
			
			if(strlen($string)>40)
			{
			   $str_string = substr($string, 0, 40);	
			   return $str_string . '...';
			}
			else
			{
				return $string;
			}
			
		}
		
		// add the word zise to the totl no of characters in fun fact
		public  static function no_of_words_size($string)
		{
			$int_fun_fact_word_size_new  = UtilitiesTwo::get_fun_fact_word_size_new();
			
			$arr_no_of_words = array();
			$int_word_size_flag = 0;
			
			if(strpos($string, ' ')>0)
			{
			   $arr_no_of_words = explode(' ', $string);
			}
			
			// check for the no of words with more than 15 char size
			foreach($arr_no_of_words as $arr_no_of_word_row)
			{
				$int_size_of_word_row =  strlen(@$arr_no_of_word_row);
				
				if($int_size_of_word_row>=10)
				{
				   $int_word_size_flag = $int_word_size_flag + $int_size_of_word_row;	
				}
			}
			
			return $int_word_size_flag;
		}


	public static function roleListCountUser($id) {
		 $products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw('2 as type'), 'products.slug')
			 ->join('product_collaborators','products.id', '=', 'product_collaborators.product_id')
							->where('product_collaborators.role',$id)->get();

		 $result_data['products'] = $products;
		$company_users = User::get_company_user_list_by_image($id)->where('comp.role', 3); 
  		$company_users  = $company_users
							->join('roles','comp.id', '=', 'roles.user_id')
							->where('roles.role',$id)->get();
		 $result_data['company_users'] = $company_users;

		$inventor_users = User::get_people_user_list_by_image($id)->where('users.role', 2);
    	$inventor_users = $inventor_users
			          ->whereRaw('id in (
									    SELECT people_id from roles where role = '.$id.' 
									    UNION
									    SELECT people_id from product_collaborators where role = '.$id.' 
									) ')->get();
		$result_data['inventor_users'] = $inventor_users;
		$total = count( $inventor_users) + count($company_users) + count($products);
		return  $total;
      }

      public static function skillsListCountUser($slug)
      {
        $inventor_users = User::get_people_user_list_by_image($slug)->where('users.role', 2)->whereRaw('FIND_IN_SET("'.$slug.'",skills)')->get();
		$company_users = User::get_company_user_list_by_image($slug)->where('comp.role', 3)->whereRaw('FIND_IN_SET("'.$slug.'",services)')->get();  
		$total = count($inventor_users) + count($company_users);
		return $total;
      }
	
		
}
