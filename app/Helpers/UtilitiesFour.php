<?php

namespace App\Helpers;

use URL;
use DB;
use Carbon\Carbon;
use File;
use Config;
use Illuminate\Http\Request;
use App\Helpers\UtilitiesTwo;
use App\Helpers\Utilities;
use App\Models\HomePageWhateverDay;
use App\Models\Question;
use App\Models\QuizQuestion;
use App\Models\Dictionary;
use App\Models\User;
use App\Models\Role;
use App\Models\Blog;
use App\Models\BloomAdsImages;
use App\Models\BloomReport;

class UtilitiesFour
{
		
		public static function is_chk_blog_news_flag($current_url_new)
	    {
		  $is_chk_blog_news_flag = 0;	
			
		  if(strpos($current_url_new,'/interviews')>0 || strpos($current_url_new,'/blog')>0 || strpos($current_url_new,'/news')>0 || strpos($current_url_new,'/knowledge-base')>0 || strpos($current_url_new,'/did-you-know-list')>0 || strpos($current_url_new,'/did-you-know')>0)
		  {
			$is_chk_blog_news_flag = 1;  
		  }
		  
		  return $is_chk_blog_news_flag;
		  
		}  
		
	  public static function is_chk_user_blog_news_flag($current_url_new)
	  {	
	    $is_chk_user_blog_news_flag = 0;
		
		if(strpos($current_url_new,'/user/blog')>0 || strpos($current_url_new,'/user/news')>0 || strpos($current_url_new,'/user/did-you-know')>0)
		  {
			$is_chk_user_blog_news_flag = 1;  
		  }
		  
		  return $is_chk_user_blog_news_flag;
       } 

       public static function is_chk_edit_update_create_flag($current_url_new)
	  {	
	     $is_chk_edit_update_create_flag = 0;
	  
        if(strpos($current_url_new,'/edit')>0 || strpos($current_url_new,'/update')>0 || strpos($current_url_new,'/create')>0)
		{
			$is_chk_edit_update_create_flag = 1;  
		}
		
		return $is_chk_edit_update_create_flag;
	  }
	  
	  
	  public static function is_chk_edit_profile_update_create_flag($current_url_new)
	  {		  
		  $is_chk_edit_profile_update_create_flag = 0;
		  
		  if(strpos($current_url_new,'/user/profile/edit')>0 || strpos($current_url_new,'/user/company/profile/edit')>0)
		  {
			$is_chk_edit_profile_update_create_flag = 1;  
		  }
	  
	     return $is_chk_edit_profile_update_create_flag;
	  
      }

      public static function is_chk_user_register_page_flag($current_url_new)
	  {
		  $is_chk_user_register_page_flag = 0;
		  
		  if(strpos($current_url_new,'/register')>0)
		  {
			$is_chk_user_register_page_flag = 1;  
		  }
		  
		  return $is_chk_user_register_page_flag;
	  }
	  
	  public static function is_chk_user_blog_news_create_flag($current_url_new)
	  {
		  
		$is_chk_user_blog_news_create_flag = 0;
		
	  if(strpos($current_url_new,'/user/profile/edit')>0 || strpos($current_url_new,'/user/company/profile/edit')>0 
	  || strpos($current_url_new,'/user/product/create')>0 || strpos($current_url_new,'/user/brand/create')>0
	  || strpos($current_url_new,'/user/product/update')>0 || strpos($current_url_new,'/user/brand/update')>0
	  || strpos($current_url_new,'/user/event/create')>0 || strpos($current_url_new,'/user/classified/create')>0
	  || strpos($current_url_new,'/user/event/update')>0 || strpos($current_url_new,'/user/classified/update')>0
	  || strpos($current_url_new,'/user/news/create')>0 || strpos($current_url_new,'/user/news/update')>0)
	  {
		$is_chk_user_blog_news_create_flag = 1;  
	  }
	  
	   return $is_chk_user_blog_news_create_flag;
	  
     }
	 
	 public static function is_chk_user_blog_create_flag($current_url_new)
	  {
		  $is_chk_user_blog_create_flag = 0;
	 
	     if(strpos($current_url_new,'/user/blog/create')>0 || strpos($current_url_new,'/user/blog/update')>0)
	     {
		   $is_chk_user_blog_create_flag = 1;  
	     }
		 
		 return $is_chk_user_blog_create_flag;
	  
     }
	 
	 public static function is_chk_user_news_create_flag($current_url_new)
	  {
		  $is_chk_user_news_create_flag = 0;
	 
	     if(strpos($current_url_new,'/user/news/create')>0 || strpos($current_url_new,'/user/news/update')>0)
	     {
		   $is_chk_user_news_create_flag = 1;  
	     }
		 
		 return $is_chk_user_news_create_flag;
	  
     }
	 
	 public static function is_chk_user_media_create_flag($current_url_new)
	  {
		  $is_chk_user_media_create_flag = 0;
	 
	     if(strpos($current_url_new,'/user/media/create')>0 || strpos($current_url_new,'/user/media/update')>0)
	     {
		   $is_chk_user_media_create_flag = 1;  
	     }
		 
		 return $is_chk_user_media_create_flag;
	  
     }
	 
	 public static function is_chk_tag_create_flag($current_url_new)
	  {
	 
	     $is_chk_tag_create_flag = 0;
		 
		 if(strpos($current_url_new,'/user/news/create')>0 || strpos($current_url_new,'/user/news/update')>0
	  || strpos($current_url_new,'/user/blog/create')>0 || strpos($current_url_new,'/user/blog/update')>0
	  || strpos($current_url_new,'/image-gallery')>0 || strpos($current_url_new,'/video-gallery')>0
	  || strpos($current_url_new,'/known-for-gallery')>0 || strpos($current_url_new,'/user/event/award/create')>0
	  || strpos($current_url_new,'/user/event/award/update')>0)
		  {
			$is_chk_tag_create_flag = 1;  
		  }
		  
		  return $is_chk_tag_create_flag;
	  
	  }
	  
	  public static function is_chk_pop_dictionary_flag($current_url_new)
	  {
		  $is_chk_pop_dictionary_flag = 0;
		  
		  if(strpos($current_url_new,'/pop-dictionary/')>0)
		  {
			$is_chk_pop_dictionary_flag = 1;  
		  }
		  
		  return $is_chk_pop_dictionary_flag;
	  }
	  
	  public static function is_chk_pop_classified_flag($current_url_new)
	  {
		  $is_chk_pop_classified_flag = 0;
		  
		  if(strpos($current_url_new,'/pop-classified')>0)
		  {
			$is_chk_pop_classified_flag = 1;  
		  }
		  
		  return $is_chk_pop_classified_flag;
	  }
	  
	  public static function is_chk_plan_flag($current_url_new)
	  {
		  $is_chk_plan_flag = 0;
	  
		  if(strpos($current_url_new,'/plan')>0)
		  {
			   $is_chk_plan_flag = 1;  
		  }
		  
		  return $is_chk_plan_flag;
	  
	  }
	  
	  public static function is_chk_change_plan_flag($current_url_new)
	  {
		  $is_chk_change_plan_flag = 0;
		  
		  if(strpos($current_url_new,'/change-plan')>0 || strpos($current_url_new,'/sign-up')>0)
		  {
			 $is_chk_change_plan_flag = 1;  
		  }
		  
		  return $is_chk_change_plan_flag;
	  }
	  
	  public static function is_chk_plan_create_flag($current_url_new)
	  {
		  $is_chk_plan_create_flag = 0;
	  
		  if(strpos($current_url_new,'/plan/purchase/')>0)
		  {
				$is_chk_plan_create_flag = 1;
		  }
	      
		  return $is_chk_plan_create_flag;
	  }
	  
	  public static function is_chk_plan_purch_flag($current_url_new)
	  {
		  $is_chk_plan_purch_flag = 0;
		  
		  if(strpos($current_url_new,'/user/manage-account-subscription')>0)
		  {
				$is_chk_plan_purch_flag = 1;
		  }
	  
	     return $is_chk_plan_purch_flag;
	  }
	  
	  
	  public static function get_og_image_new($current_url_new, $blog, $user,$question_detail, $arr_objs)
	  {
		//   echo '<pre>current_url_new - '; print_r($current_url_new);
		//   echo '<pre>blog - '; print_r($blog);
		//   echo '<pre>user - '; print_r($user);
		//   echo '<pre>question_detail - '; print_r($question_detail);
		//   echo '<pre>arr_objs - '; print_r($arr_objs); die;
		  $str_og_image_new = '';
		  
		  if(strpos($current_url_new,'/pop-dictionary/')>0)
		  {
			$str_og_image_new = asset('front/images/offerImage.png');
		  } else if(!empty($question_detail)) {
		  	if(!empty($question_detail[0]->user->id)) {
		  		$str_og_image_new = @imageBasePath(@$question_detail[0]->user->profile_image);
		  	} else {
		  		$str_og_image_new = asset('front/images/mainLogo.png');
		  	}
		  }

		  else if(strpos($current_url_new,'/pop-dictionary/')>0)
		  {
			$str_og_image_new = asset('front/images/offerImage.png');
		  }
		  else if(strpos($current_url_new,'/blog/')>0 || strpos($current_url_new,'/featured-article/')>0)
		  {  
			//   echo '<pre>'; print_r($blog); die;
	    //    echo 'featured_image_thumbnail: '.$blog['featured_image_thumbnail'];	  
			//$str_og_image_new = @newsBlogImageBasePath(@$blog->featured_image);
			// if(!empty(@$blog['featured_image_thumbnail']))
			// {
			// 	$str_blog_featured_image = @$blog['featured_image_thumbnail'];
			// } 
			// else
			// {
			// 	$str_blog_featured_image = @$blog['featured_image'];
			// }
			$str_blog_featured_image = @$blog['featured_image'];
			
			$str_og_image_new = @newsBlogImageBasePath($str_blog_featured_image);
			
		  }
		  else if(strpos($current_url_new,'/people/')>0 || strpos($current_url_new,'/company/')>0)
		  {
			$str_og_image_new = $str_base_url.@imageBasePath(@$user->profile_image);
		  }
		  else
		  {
			$str_og_image_new = asset('front/images/mainLogo.png');
		  }
		   
			/******** || Shubham Code Start ||  ********/
				if(!empty($arr_objs[1]) && is_object($arr_objs[1]) && strpos($current_url_new,'/product/')>0)
				{
					$str_og_image_new = asset('uploads/images/'.@$arr_objs[1]->main_image);
				}

				// echo '<pre>'; print_r($_GET); die;

				if(strpos($current_url_new,'/feed/')>0){
					$url_explode = explode('feed/',$current_url_new);
					$feed_data = DB::table('feeds')->where('id',$url_explode[1])->first();
					if(!empty($feed_data->image)){
						$str_og_image_new = asset('uploads/images/feed/'.$feed_data->image);
					}elseif(!empty($feed_data->video_url)){
						preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed_data->video_url, $match);
						// $str_og_image_new = 'https://www.youtube.com/embed/'.$match[1];
						// $str_og_image_new = 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg';

						$oldPath = 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg';
						$fileExtension = \File::extension($oldPath);
						$timestamp = generateFilename();
						$filename = @$match[1].'.' . $fileExtension;
						$newPathWithName =public_path('/uploads/images/youtube_video/'.$filename);
						$productImg = $filename;

						if (\File::copy($oldPath , $newPathWithName)) {
							// dd("success");
						}

						
						$str_og_image_new = asset('/uploads/images/youtube_video/'.$filename);
						
					}
					elseif($feed_data->pop_feed_position == 1){
						$sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
						$str_og_image_new = @imageBasePath( @$sidebarData['meme']->featured_image);
					}elseif($feed_data->pop_feed_position == 3){
						$str_current_date = date('Y-m-d');
						$home_product_data = DB::table('home_page_whatever_days')->join('products','products.id', '=', 'home_page_whatever_days.product_id')->where(['home_page_whatever_days.id'=>$_GET['home_product_id'],'home_page_whatever_days.status'=> 1])->select('products.main_image')->orderBy('home_page_whatever_days.id','desc')->first();
						$str_og_image_new = @imageBasePath(@$home_product_data->main_image);
					}elseif($feed_data->pop_feed_position == 4){
						$question_detail = Question::where(['id'=>$_GET['question_detail'],'status'=>1])->with(['user'])->first();
						$str_og_image_new = @imageBasePath(@$question_detail->user->profile_image);
					}elseif($feed_data->pop_feed_position == 6){						
						$quiz_question_detail = QuizQuestion::where('status', 1)->where('id', $_GET['quiz_question_detail'])->with(['user'])->first();
						$str_og_image_new = asset('uploads/images/question_quiz/'.@$quiz_question_detail->image);
					}
					// echo '<pre>url_explode - '; print_r($url_explode); die;
				}

				if(strpos($current_url_new,'/news_feed/')>0){
					$url_explode = explode('news_feed/',$current_url_new);
					$feed_data = DB::table('feeds_news')->where('id',$url_explode[1])->first();
					if(!empty($feed_data->image)){
						$str_og_image_new = asset('uploads/images/feed/'.$feed_data->image);
					}elseif(!empty($feed_data->video_url)){
						preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed_data->video_url, $match);

						$oldPath = 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg';
						$fileExtension = \File::extension($oldPath);
						$timestamp = generateFilename();
						$filename = @$match[1].'.' . $fileExtension;
						$newPathWithName =public_path('/uploads/images/youtube_video/'.$filename);
						$productImg = $filename;

						if (\File::copy($oldPath , $newPathWithName)) {
							// dd("success");
						}						
						$str_og_image_new = asset('/uploads/images/youtube_video/'.$filename);	
					}
					// echo '<pre>url_explode - '; print_r($url_explode); die;
				}
			/******** || Shubham Code End ||  ********/
		  return $str_og_image_new;
	  
     }
	 
	 public static function get_og_title_new($current_url_new, $str_get_seo_data, $dictionary_detail, $blog, $str_user_name,$question_detail,$classified)
	  {
	  //	echo "<pre>"; print_r($question_detail); die;
		  $str_og_title_new = '';
		  
		 if(!empty($str_get_seo_data->title))
		  {
			$str_og_title_new = @$str_get_seo_data->title;
		  }
		  else if(!empty($dictionary_detail[0]->title))
		  {
			$str_og_title_new = @$dictionary_detail[0]->title;
		  } 
		  else if(!empty($question_detail[0]->user->id))
		  {
			$str_og_title_new = @$question_detail[0]->user->first_name." ".@$question_detail[0]->user->last_name;
		  }
		  else if(!empty($blog->meta_title))
		  {
			$str_og_title_new = @$blog->meta_title;
		  } 
		   else if(!empty($classified->title))
		  {
			$str_og_title_new = @$classified->title;
		  } 
		  else
		  {
			$str_og_title_new = @$str_user_name;
		  }

		  
		/******** || Shubham Code Start ||  ********/
		  if(empty($str_get_seo_data->title))
		  {
			if(!empty($question_detail[0]->user->id) && strpos($current_url_new,'/3-truths-and-a-lie/')>0)
			{
				$str_og_title_new = '3 Truths & a Lie | POP Mini-Games';
				$u_name = @$question_detail[0]->user->first_name." ".@$question_detail[0]->user->last_name;
				$str_og_title_new = str_ireplace("POP Mini-Games",ucwords($u_name),$str_og_title_new);
			}
		  }else{
		      if(!empty($question_detail[0]->user->id))
    		  {
    			  $u_name = @$question_detail[0]->user->first_name." ".@$question_detail[0]->user->last_name;
    			  $str_og_title_new = str_ireplace("POP Mini-Games",ucwords($u_name),$str_og_title_new);
    		  }
		  }

		  if(strpos($current_url_new,'/user/blog')>0){
			$str_og_title_new = @$str_user_name;
		  }

		  if(strpos($current_url_new,'/feed/')>0){
			$url_explode = explode('feed/',$current_url_new);
			$feed_data = DB::table('feeds')->where('id',$url_explode[1])->first();
			if(!empty($feed_data->title)){
				$str_og_title_new = ucwords($feed_data->title);
			}
			// echo '<pre>url_explode - '; print_r($url_explode); die;
		  }
		  if(strpos($current_url_new,'/news_feed/')>0){
			$url_explode = explode('news_feed/',$current_url_new);
			$feed_data = DB::table('feeds_news')->where('id',$url_explode[1])->first();
			if(!empty($feed_data->title)){
				$str_og_title_new = ucwords($feed_data->title);
			}
			// echo '<pre>url_explode - '; print_r($url_explode); die;
		  }
		/******** || Shubham Code End ||  ********/
		  
		  
		  return $str_og_title_new;
	  } 
	  
	  
	 public static function get_og_desc($current_url_new, $str_get_seo_data, $dictionary_detail, $blog, $str_user_name,$classified)
	  { 
		  $str_og_desc = '';
		  
		  if(!empty($str_get_seo_data->title))
		  {
			$str_og_desc = UtilitiesTwo::limit_words(@$str_get_seo_data->description, 0, 50);;
		  }
		  else if(!empty($blog->meta_description))
		  {
			$str_og_desc = UtilitiesTwo::limit_words(@$blog->meta_description, 0, 50);
		  }
		   else if(!empty($classified->description))
		  {
			$str_og_desc = UtilitiesTwo::limit_words(@$classified->description, 0, 50);
		  }
		  else if(!empty(@$dictionary_detail[0]->description))
		  {
			$str_og_desc = UtilitiesTwo::limit_words(@$dictionary_detail[0]->description, 0, 50);
		  }
		  else
		  {
			$str_og_desc = $str_user_name;   
		  }
		  
		/******** || Shubham Code Start ||  ********/
		  if(empty($str_get_seo_data->title))
		  {
			$exp_url = explode('3-truths-and-a-lie',$current_url_new);
			if((isset($exp_url[1]) && !empty($exp_url[1])) && strpos($current_url_new,'/3-truths-and-a-lie/')>0){
			    
    			$new_url = $exp_url[0].'3-truths-and-a-lie';
    
    			$obj_seo_data =  DB::table('seo_urls')->where('url_data', '=', $new_url)->where('status', '=', 1)->first();
    
    			$str_og_desc = UtilitiesTwo::limit_words(@$obj_seo_data->description, 0, 50);
			}
		  }

		  if(strpos($current_url_new,'/feed/')>0){
			$url_explode = explode('feed/',$current_url_new);
			$feed_data = DB::table('feeds')->where('id',$url_explode[1])->first();
			if(!empty($feed_data->caption)){
				$str_og_desc = ucfirst(strip_tags($feed_data->caption));
			}elseif($feed_data->pop_feed_position == 1){
				$str_og_desc = 'Meme of the day';
			}elseif($feed_data->pop_feed_position == 2){
				$dictionary_detail = Dictionary::where(['id'=>@$_GET['word_id'],'status'=>1])->first();
				$str_og_desc = @$dictionary_detail->description;
			}elseif($feed_data->pop_feed_position == 3){
				$str_current_date = date('Y-m-d');
				$home_product_data = DB::table('home_page_whatever_days')->join('products','products.id', '=', 'home_page_whatever_days.product_id')->where(['home_page_whatever_days.id'=>$_GET['home_product_id'],'home_page_whatever_days.status'=> 1])->select('home_page_whatever_days.home_caption_one')->orderBy('home_page_whatever_days.id','desc')->first();				
				$str_og_desc = \App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_one);
			}elseif($feed_data->pop_feed_position == 4){
				$str_og_desc = '3 TRUTHS & A LIE - Can you guess which is the lie?';
			}elseif($feed_data->pop_feed_position == 6){						
				$quiz_question_detail = QuizQuestion::where('status', 1)->where('id', $_GET['quiz_question_detail'])->with(['user'])->first();
				$str_og_desc = $quiz_question_detail->question;
			}
			// echo '<pre>url_explode - '; print_r($url_explode); die;
		  }

		  if(strpos($current_url_new,'/news_feed/')>0){
			$url_explode = explode('news_feed/',$current_url_new);
			$feed_data = DB::table('feeds_news')->where('id',$url_explode[1])->first();
			if(!empty($feed_data->caption)){
				$str_og_desc = ucfirst(strip_tags($feed_data->caption));
			}
			// echo '<pre>url_explode - '; print_r($url_explode); die;
		  }
		/******** || Shubham Code End ||  ********/
		  
		  return $str_og_desc;
	  }
	 
     public static function get_meta_desc($current_url_new, $str_get_seo_data, $dictionary_detail, $blog, $str_user_name,$classified)
	  {	 
	  	  $str_meta_desc = '';
	  
		  if(!empty($str_get_seo_data->description))
		  {
			$str_meta_desc = @$str_get_seo_data->description;
		  }
		  else if(!empty($blog->meta_description))
		  {
			$str_meta_desc = @$blog->meta_description;
		  }
		   else if(!empty($classified->description))
		  { 
			$str_meta_desc =  @$classified->description; 
		  }
		  else if(!empty(@$dictionary_detail[0]->description))
		  {
			$str_meta_desc = @$dictionary_detail[0]->description;
		  }
		  else
		  {
			$str_meta_desc = $str_user_name;   
		  }
		 
		  return $str_meta_desc;
	  
	  }
	  
	   public static function get_meta_keyword($current_url_new, $str_get_seo_data, $dictionary_detail, $blog, $str_user_name)
	  {	  
		  $str_meta_keyword = '';
	  
		  if(!empty($str_get_seo_data->keywords))
		  {
			$str_meta_keyword = @$str_get_seo_data->keywords;
		  }
		  else if(!empty($blog->meta_keyword))
		  {
			$str_meta_keyword = @$blog->meta_keyword;
		  }  
		  else
		  {
			$str_meta_keyword = $str_user_name;   
		  }
		  
			return $str_meta_keyword;
	  
	  }
	  
	  public static function get_page_title($current_url_new, $str_get_seo_data, $dictionary_detail, $blog, $str_user_name,$classified)
	  {
	  
		  $str_page_title = '';
	  
		  if(!empty($str_get_seo_data->title))
		  { 
			$str_page_title = @$str_get_seo_data->title;
		  }
		  else if(!empty($dictionary_detail->title))
		  { 
			$str_page_title =  @$dictionary_detail->title;
		  }
		  else if(!empty($blog->meta_title))
		  { 
			 $str_page_title =  @$blog->meta_title;
		  }
		  else if(!empty($classified))
		  { 
			$str_page_title =  @$classified->title; 
		  }
		  else if(!empty($str_user_name))
		  {
			$str_page_title =  @$str_user_name; 
		  }
		  else 
		  {
			 //$str_page_title =  @yield('title');
		  }

		/******** || Shubham Code Start ||  ********/
		  if(strpos($current_url_new,'/user/blog')>0){
			$str_page_title = @$str_user_name;
		  }
		/******** || Shubham Code End ||  ********/
		  
		  return $str_page_title;	  
    } 
	
	public static function is_product_page_flag($request, $current_url_new)
	{
		  
		   $is_product_page_flag = 0;  
	
		   if(strpos($current_url_new,'/product/')>0)
		   {
			   $is_product_page_flag = 1;
		   }
	   
	    return $is_product_page_flag;
		
	}
	
	public static function is_profile_page_flag($request, $current_url_new)
	{
		  
		   $is_profile_page_flag = 0; 

		   if(strpos($current_url_new,'/people/')>0 || strpos($current_url_new,'/company/')>0)
		   {
			   $is_profile_page_flag = 1;
		   }
	   
	    return $is_profile_page_flag;
		
	}
	
	public static function is_event_page_flag($request, $current_url_new)
	{
		  
		   $is_event_page_flag = 0;  
	
		   if(strpos($current_url_new,'/event/')>0)
		   {
			   $is_event_page_flag = 1;
		   }
	   
	    return $is_event_page_flag;
		
	}
	
	public static function is_gallery_page_flag($request, $current_url_new)
	{
		  
		   $is_gallery_page_flag = 0;  
	
		   if(strpos($current_url_new,'/image-gallery')>0 || strpos($current_url_new,'/video-gallery')>0
		   || strpos($current_url_new,'/known-for-gallery')>0)
		  {
				$is_gallery_page_flag = 1;
		  }
	   
	    return $is_gallery_page_flag;
		
	}
	
	public static function get_skills_list($skills_list)
	{
		$str_skills_data = '';
		
	        if(!empty($skills_list) && is_array($skills_list))
			{
			  foreach($skills_list as $skills_data_row) 
			  {			
				if(!empty($skills_data_row))
				{
					if(empty($str_skills_data))
					{
					   $str_skills_data = $skills_data_row;	
					}
					else
					{
					   $str_skills_data = $str_skills_data . ',' . $skills_data_row;	
					}
					 
				}								
				
			   }	
			}
			
			return  $str_skills_data;
	
    }
	
	public static function get_skills_array($str_skills)
	{
		$arr_skills = array();
		
	   if(!empty($str_skills) && strpos($str_skills, ',')>0)
				{
				   $arr_skills = explode(',', @$str_skills);	
				}
				else
				{
				   $arr_skills[] = @$str_skills;	
				}
			
         return  $arr_skills;			
    }

    public static function get_url_link($str_url)
	{ 
	     $str_new_url = '';
	       // echo $str_url; die;
		 if(strpos($str_url, 'http://')<=0 && strpos($str_url, 'https://')<=0)
		 {
		   $str_new_url = $str_url;	 
		  // $str_new_url = 'http://' . $str_url;	 
		 }
		 else
		 {
			$str_new_url =  $str_url;
		 }
		 
		 return $str_new_url;
 	
	}


	
	public static function createThumb($originalImagePath, $imageName, $ext, $thumbWidth=100)
    {
		
		$srcImagePath = $originalImagePath . $imageName;
		
		$str_image_thumbnail =  'thumbnail_' . $imageName;
		
		$destImagePath = $originalImagePath . '/thumbnails/' . $str_image_thumbnail;
		
		if($ext == 'jpg' || $ext == 'jpeg')
		{
		   $sourceImage = imagecreatefromjpeg($srcImagePath);	
		}
        
		if($ext == 'gif')
		{
		   $sourceImage = imagecreatefromgif($srcImagePath);	
		}
		
		if($ext == 'png')
		{
		   $sourceImage = imagecreatefrompng($srcImagePath);	
		}
		
		if($ext == 'bmp')
		{
		   $sourceImage = imagecreatefromwbmp($srcImagePath);	
		}
		
        $orgWidth = imagesx($sourceImage);
        $orgHeight = imagesy($sourceImage);
        $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
        imagejpeg($destImage, $destImagePath);
        imagedestroy($sourceImage);
        imagedestroy($destImage);
		
		return $str_image_thumbnail;
    }
	
	
	public static function chkUrlWebsite($rules, $field_name)
    {
	
	   $rules[$field_name] =  ['nullable', 'sometimes', 
        function($attribute, $value, $fail) {            
		//echo 'value: '.$value;
			if(!empty($value))
			{
				if(is_array($value) && count($value)>0)
				{	
					 foreach($value as $value_row)
					 {
						 UtilitiesFour::getUrlWebsiteValidationMsg($value_row, $attribute, $fail);
					 }			
				  
				}
				else
				{
					UtilitiesFour::getUrlWebsiteValidationMsg($value, $attribute, $fail);
				}
			}
			
			
        }];
		
		return $rules; 
	
	}
	
	public  static function getUrlWebsiteValidationMsg($value, $attribute, $fail)
	{
		if(!empty($value))
		{
		
	    $chk_url_validation_check = UtilitiesTwo::get_url_validation_check($value);
							
						if ($chk_url_validation_check == false) {
							return $fail($attribute.' is invalid.');
						}
						else
						{
							return true;
						}
		}
        else
		{
			return true;
		}			
    }

    public  static function getUserDialCode($user)
	{
	  $str_dial_code = '';
      	
      if(!empty($user->dial_code))
	  {
	     $str_dial_code = $user->dial_code;
	  }	
	  else
	  {
		  
	  }
	  
	   if(!empty($str_dial_code))
	   {
			if(substr($str_dial_code, 0, 1) == '+' || strpos($str_dial_code, '+')>0)
			{
			}
			else
			{
			   $str_dial_code = '+' . $str_dial_code;	
			}
	   }
	   
	   return $str_dial_code;
	  
    }
	
	
	public  static function uploadImageToDirectory($data, $request, $image_field_name, $upload_type)
	{
	       if ($request->hasFile($image_field_name)) {
                $file = $request->$image_field_name;
                $extension = $file->getClientOriginalExtension();
				//$extension = UtilitiesTwo::get_image_ext_name();
                $timestamp = generateFilename();
				if($upload_type == 'media')
				{

                  $filename = $timestamp . '.' . $extension;
				  $file_path = Utilities::get_media_upload_folder_path();
				//  echo $file_path; die;
                }
                else if($upload_type == 'awarduser')
				{
                  $filename = $timestamp . '.' . $extension;
				  $file_path = Utilities::get_awardUser_upload_folder_path();
                }				
				elseif($upload_type == 'blog')
				{
                  $filename = $timestamp . '_blogs_' . '.' . $extension;
				  $file_path = Utilities::get_blog_upload_folder_path();
                }
				elseif($upload_type == 'happy_whatever_day')
				{
                  $filename = $timestamp . '_happy_whatever_day_' . '.' . $extension;
				  $file_path = Utilities::get_collections_upload_folder_path();
                }
				else
				{
				  $filename = $timestamp . '.' . $extension;
				  $file_path = imagePath();
				}				
				
					//$file_path = imagePath();
					$upload_status = $file->move(public_path($file_path), $filename);
					//$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
				
                if ($upload_status) {
                    
					if($upload_type == 'blog')
					{
						$str_image_thumbnail = UtilitiesFour::createThumb(public_path($file_path), $filename, $extension, 100);
						$data[$image_field_name . '_thumbnail'] = $str_image_thumbnail;
					}
					
					$data[$image_field_name] = $filename;
                     					
					return $data; 
					
                } else {
                    // Rollback Transaction
                    DB::rollBack();
                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            }
			else
			{
				return $data;
			}
			
    }

     
	public  static function getDictionaryUrl($base_url, $str_dictionary_slug)
	{
			$str_dictionary_url = $base_url . '/pop-dictionary/' . $str_dictionary_slug;
			
			return $str_dictionary_url;
    } 
	
	public  static function getDictionaryFieldsData($dictionary_detail)
	{
		    $arr_dictionary_data = array();
		
	        $str_dictionary_url = '';
            $base_url = url('/');
            $dictionary_user_current_info_new = @$dictionary_detail[0]->user;
            $str_user_name_dictionary_day = '';
			// for a company or people
            if(@$dictionary_user_current_info_new->role == 2 || @$dictionary_user_current_info_new->role == 3)
            {
				$arr_dictionary_data[0] = $str_user_url_new_dictionary_day = Utilities::get_user_url($base_url, $dictionary_user_current_info_new);  
				$arr_dictionary_data[1] = $str_user_name_dictionary_day = Utilities::getUserName($dictionary_user_current_info_new);
            }
			// for an admin
            else
            {
				$arr_dictionary_data[0] = $str_user_url_new_dictionary_day = "#";
				$arr_dictionary_data[1] = $str_user_name_dictionary_day = Config::get('commonconfig.web_site_name_new');               
            }
            $arr_dictionary_data[2] = $str_dictionary_slug = @$dictionary_detail[0]->slug;
            $arr_dictionary_data[3] = $str_dictionary_url = UtilitiesFour::getDictionaryUrl($base_url, $str_dictionary_slug);
			$arr_dictionary_data[4] = $str_current_url = $str_dictionary_url;
            $arr_dictionary_data[5] = $str_dictionary_publish_date = @$dictionary_detail[0]->date_to_be_published;
			
			return $arr_dictionary_data;
	
    }
	
	public  static function getYoutubeVideoId($url)
	{
	
	  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
     $youtube_id = @$match[1];
	 
	 return $youtube_id;

    }
	
	public  static function getLoadingMessage()
	{
	
	 return 'Loading. Please Wait...';

    }
	
	public  static function get_date_from_time_stamp($date)
		{
		   $date_new = date('Y-m-d H:i:s', $date);
		    return $date_new;	
		}
    
    public  static function get_blog_meta_description($feed_id){
		$blog_desc = Blog::where('feed_id',$feed_id)->first();
		if(!empty($blog_desc->meta_description)){
			return $blog_desc->meta_description;
		}else{
			return $blog_desc->meta_description;
		}
	}

    public  static function getTeamMemberLinks($role_id){
		$user_info = User::where('id',@$role_id)->first();
		// echo $role_id;
		// pr($user_info->toArray()); die;

		if(isset($user_info->id) && !empty(@$user_info->id)){
			if(@$user_info->role == 3){		
				// echo 'here 1'; die;
				return url('company/'.@$user_info->slug);
			}else{
				// echo 'here 2'; die;
				return url('people/'.@$user_info->slug);
			}
		}
	}
    public  static function uploadYoutTubeThumbnail($youtube_id){

		$oldPath = 'https://img.youtube.com/vi/'.@$youtube_id.'/mqdefault.jpg';
		$fileExtension = \File::extension($oldPath);
		$timestamp = generateFilename();
		$filename = @$youtube_id.'.' . $fileExtension;
		$newPathWithName =public_path('/uploads/images/youtube_video/'.$filename);
		$productImg = $filename;

		if (\File::copy($oldPath , $newPathWithName)) {
			// dd("success");
		}
	}

    public  static function getDateCheck($c_date){

		echo '<div class="mt-3" id="date_cls_'.date('F_Y_d',strtotime($c_date)).'"><i><small><b>'.date('F d, Y',strtotime($c_date)).'</b></small></i></div>';
	}

    public  static function getBloomAds($cat_data,$cat_id){
		$cat_data_cnt = count($cat_data[$cat_id]);
		$bloomRptCnt = BloomReport::where('category_id',$cat_id)->count();

		if($bloomRptCnt == $cat_data_cnt){
			$bloomAdsImages = BloomAdsImages::where('category_id',@$cat_id)->orderBy('id','DESC')->get();
			// pr($bloomAdsImages->toArray());
			if(!empty($bloomAdsImages->toArray())){
				foreach($bloomAdsImages as $bloomAdsImage){
					echo '<div class="imageAdd"><a href="javascript:void(0);" class="d-block"><img src="'.asset('uploads/images/bloom_reports/'.$bloomAdsImage->image).'" class="img-fluid"></a></div>';
				}
			}
		}
	}
	
}
