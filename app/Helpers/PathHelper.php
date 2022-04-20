<?php

if (!function_exists('imagePath')) {
    function imagePath($filename = '')
    {		
		$people_upload_folder_path = App\Helpers\Utilities::get_users_upload_folder_path();
		$ads_upload_folder_path = App\Helpers\Utilities::get_ads_upload_folder_path();
		$brands_upload_folder_path = App\Helpers\Utilities::get_brands_upload_folder_path();
		$badges_upload_folder_path = App\Helpers\Utilities::get_badges_upload_folder_path();
		$award_upload_folder_path = App\Helpers\Utilities::get_award_upload_folder_path();
		
		if(strpos($filename, '_users_')>0)
		  return $people_upload_folder_path . $filename;
		elseif(strpos($filename, '_badges_')>0)
		  return $badges_upload_folder_path . $filename;
		elseif(strpos($filename, '_advertisements_')>0)
		  return $ads_upload_folder_path . $filename;
		elseif(strpos($filename, '_brands_')>0)
		  return $brands_upload_folder_path . $filename; 
	    elseif(strpos($filename, '_award_')>0)
		  return $award_upload_folder_path . $filename;  
		else
		  return config('cms.originalImagePath') . $filename;	
		 
    }
}

/*if (!function_exists('collaboratorImagePath')) {
    function collaboratorImagePath($filename = '')
    {
        return config('cms.collaboratorImagePath') . $filename;
    }
}*/

if (!function_exists('imageBasePath')) {
    function imageBasePath($filename = '')
    {
		$people_upload_folder_path = App\Helpers\Utilities::get_users_upload_folder_path();
		$ads_upload_folder_path = App\Helpers\Utilities::get_ads_upload_folder_path();		
		$brands_upload_folder_path = App\Helpers\Utilities::get_brands_upload_folder_path();		
		$get_user_def_path = App\Helpers\UtilitiesTwo::getUserDefaultImage();
		$badges_upload_folder_path = App\Helpers\Utilities::get_badges_upload_folder_path();
		$award_upload_folder_path = App\Helpers\Utilities::get_award_upload_folder_path();
		$wiki_upload_folder_path = App\Helpers\Utilities::get_wiki_upload_folder_path();
		$rip_upload_folder_path = App\Helpers\Utilities::get_rip_upload_folder_path();
		$entertainment_upload_folder_path = App\Helpers\Utilities::get_entertainment_upload_folder_path();
		$office_hour_upload_folder_path = App\Helpers\Utilities::get_office_hour_upload_folder_path();
		$meme_upload_folder_path = App\Helpers\Utilities::get_meme_upload_folder_path();
		$quiz_upload_folder_path = App\Helpers\Utilities::get_quiz_upload_folder_path();
		
		if(empty($filename))
		{
			return $get_user_def_path;
		}			
		else
		{		
			if(strpos($filename, '_users_')>0)
			  return $people_upload_folder_path . $filename;
			elseif(strpos($filename, '_badges_')>0)
		      return $badges_upload_folder_path . $filename;
			elseif(strpos($filename, '_advertisements_')>0)
			  return $ads_upload_folder_path . $filename;
			elseif(strpos($filename, '_brands_')>0)
		      return $brands_upload_folder_path . $filename;
		  	elseif(strpos($filename, '_award_')>0)
		      return $award_upload_folder_path . $filename;
		  	elseif(strpos($filename, '_wiki_')>0)
		      return $wiki_upload_folder_path . $filename;
		    elseif(strpos($filename, '_rip_')>0)
		      return $rip_upload_folder_path . $filename;
		    elseif(strpos($filename, '_entertainment_')>0)
		      return $entertainment_upload_folder_path . $filename;
			elseif(strpos($filename, '_office_')>0)
		      return $office_hour_upload_folder_path . $filename;
		     elseif(strpos($filename, '_meme_')>0)
		      return $meme_upload_folder_path . $filename;
		  elseif(strpos($filename, '_quiz_')>0)
		      return $quiz_upload_folder_path . $filename;
			else
			  return \URL::to(config('cms.originalImagePath') . $filename);
		}
    }
}

if (!function_exists('prodEventImageBasePath')) {
    function prodEventImageBasePath($filename = '')
    {
		$products_upload_folder_path = App\Helpers\UtilitiesTwo::get_products_upload_folder_path();
		$events_upload_folder_path = App\Helpers\UtilitiesTwo::get_events_upload_folder_path();
		
		$get_prod_event_def_path = App\Helpers\UtilitiesTwo::getDefaultEventProdImageNew();
		
		if(empty($filename))
		{
			return $get_prod_event_def_path;
		}			
		else
		{		
			if(strpos($filename, '_products_')>0)
			  return $products_upload_folder_path . $filename;
            elseif(strpos($filename, '_events_')>0)
			  return $events_upload_folder_path . $filename;
            else
			  return \URL::to(config('cms.originalImagePath') . $filename);
		}
    }
}

if (!function_exists('newsBlogImageBasePath')) {
    function newsBlogImageBasePath($filename = '')
    {
		$news_upload_folder_path = App\Helpers\UtilitiesTwo::get_news_upload_folder_path();
		//$blogs_upload_folder_path = App\Helpers\UtilitiesTwo::get_blogs_upload_folder_path();
		
		$blogs_upload_folder_path = App\Helpers\Utilities::get_blog_upload_folder_path();
		
		$blogs_thumbnail_upload_folder_path = App\Helpers\Utilities::get_blog_thumbnails_upload_folder_path();
		
		$get_blog_news_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();

		$get_quiz_news_def_path = App\Helpers\UtilitiesTwo::get_quiz_upload_folder_path();
		
		if(empty($filename))
		{
			return $get_blog_news_def_path;
		}			
		else
		{		
			if(strpos($filename, '_news_')>0 && strpos($filename, 'humbnail_')<=0)
			  return $news_upload_folder_path . $filename;
            elseif(strpos($filename, '_blogs_')>0 && strpos($filename, 'humbnail_')<=0)
			  return $blogs_upload_folder_path . $filename;
            elseif(strpos($filename, '_blogs_')>0 && strpos($filename, 'humbnail_')>0)
			  return $blogs_thumbnail_upload_folder_path . $filename;
			 elseif(strpos($filename, '_quiz_')>0)		
			  return $get_quiz_news_def_path . $filename;  
			else
			  return \URL::to(config('cms.originalImagePath') . $filename);
		}
    }
}


if (!function_exists('collaboratorImageBasePath')) {
    function collaboratorImageBasePath($filename = '')
    {
		$get_collaborator_upload_folder_path = App\Helpers\Utilities::get_collaborator_upload_folder_path();
		
		$get_user_def_path = App\Helpers\UtilitiesTwo::getUserDefaultImage();
		
		if(empty($filename))
		{
			return $get_user_def_path;
		}			
		else
		{		
		   return $get_collaborator_upload_folder_path . $filename;       
		}
    }
}

if (!function_exists('galleryImageBasePath')) {
    function galleryImageBasePath($filename = '')
    {
		$get_gallery_upload_folder_path = App\Helpers\Utilities::get_gallery_upload_folder_path();
		
		$get_gallery_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		
		$base_url = url('/');
		
		if(empty($filename))
		{
			return $get_gallery_def_path;
		}			
		else
		{		
			return $base_url . $get_gallery_upload_folder_path . $filename;			  
		}
    }
}

if (!function_exists('mediaImageBasePath')) {
    function mediaImageBasePath($filename = '')
    {
		$get_media_upload_folder_path = App\Helpers\Utilities::get_media_upload_folder_path();
		
		$get_media_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		
		$base_url = url('/');
		
		if(empty($filename))
		{
			return $get_media_def_path;
		}			
		else
		{		
			return $base_url . $get_media_upload_folder_path . $filename;			  
		}
    }
}

if (!function_exists('awardUserImageBasePath')) {
    function awardUserImageBasePath($filename = '')
    {
		$get_media_upload_folder_path = App\Helpers\Utilities::get_awardUser_upload_folder_path();
		
		$get_media_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		
		$base_url = url('/');
		
		if(empty($filename))
		{
			return $get_media_def_path;
		}			
		else
		{		
			return $base_url . $get_media_upload_folder_path . $filename;			  
		}
    }
}

if (!function_exists('collectionImageBasePath')) {
    function collectionImageBasePath($filename = '')
    {
		$get_collections_upload_folder_path = App\Helpers\Utilities::get_collections_upload_folder_path();
		$get_media_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		$get_media_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		
		$base_url = url('/');
		
		if(empty($filename))
		{
			return $get_media_def_path;
		}			
		else
		{		
			return $base_url . $get_collections_upload_folder_path . $filename;			  
		}
    }
}

if (!function_exists('awardImageBasePath')) {
    function awardImageBasePath($filename = '')
    {

		$get_award_upload_folder_path = App\Helpers\Utilities::get_award_upload_folder_path();
		$get_media_def_path = App\Helpers\UtilitiesTwo::getBlogNewsDefaultImage();
		
		$base_url = url('/');
		
		if(empty($filename))
		{
			return $get_media_def_path;
		}			
		else
		{		
			return $base_url . $get_award_upload_folder_path . $filename;			  
		}
    }
}