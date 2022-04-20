<?php

namespace App\Http\Controllers\Front;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\User;
use App\Models\News;
use App\Models\Blog;
use App\Models\HomePageAward;
use App\Models\Country;
use App\Models\EventAwardNominee;
use App\Models\Gallery;
use App\Models\GalleryProductTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryOtherTag;
use App\Models\Category;
use App\Models\Product;
use App\Models\Event;
use App\Models\Award;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use App\Models\SeoUrl;
use URL;

use Illuminate\Support\Facades\View;

class HomeAjaxController extends ModuleController
{
	public $chk_device;
	public $_galleryPhotosFolder;
	public $_blogs_link;
	public $_arr_role_at_list;
	
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();
		
		$this->_is_ajax_call = 1;
	}
	
	// for ajax gallery in user profile, product, event pages
	public function getAjaxGalleryImageData(Request $request)
    {
			$slug = 	$request->input('slug');
			$user_id = 	$request->input('user_id');
			$page_type = 	$request->input('page_type');
			$product_id = 	$request->input('product_id');
			$event_id = 	$request->input('event_id');
			$brand_list_id = 	$request->input('brand_list_id');
			$gallery_link_type = 	$request->input('gallery_link_type');
			$gallery_type = 	$request->input('gallery_type');
			$folder_path = $this->_galleryPhotosFolder;
			$is_ajax_call = $this->_is_ajax_call;
			
			$get_current_screen_size = 	$request->input('get_current_screen_size');
			
			// for a mobile
			if($get_current_screen_size<567)
			{
				$this->_galleryImageDeskLimit = 3;//6
				$this->_galleryKnownForDeskLimit = 3;
				$this->_galleryVideoDeskLimit = 3;
			}
			// for a desktop
			else
			{
				$this->_galleryImageDeskLimit = 4;//7
				$this->_galleryKnownForDeskLimit = 4;
				$this->_galleryVideoDeskLimit = 3;
			}
						
			// for a known for
			if($gallery_link_type == 4) {
				$utilities_helper = new Utilities;
				$folder_path = $utilities_helper->get_award_upload_folder_path();
				$gallery_data = HomePageAward::where('status',1)->get();
			}			
			else if($gallery_link_type == 3)
			{
			   $gallery_data = $this->getGalleryKnownForData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);
			}
			// for a video
			else if($gallery_link_type == 2)
			{
			   $gallery_data = $this->getGalleryVideoData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);			   	
			}
			// for a gallery image
			else
			{
			   $gallery_data = $this->getGalleryImageData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0); 	
			}
			
			return view('front.user.gallery.view_gallery_list', compact('folder_path','gallery_data', 'user_id', 'gallery_link_type', 'gallery_type', 'is_ajax_call'));
	}


	public function getAjaxHomeImageAwardData(Request $request)
    {
			$slug = 	$request->input('slug');
			$user_id = 	$request->input('user_id');
			$page_type = 	$request->input('page_type');
			$product_id = 	$request->input('product_id');
			$event_id = 	$request->input('event_id');
			$brand_list_id = 	$request->input('brand_list_id');
			$gallery_link_type = 	$request->input('gallery_link_type');
			$gallery_type = 	$request->input('gallery_type');
			$folder_path = $this->_galleryPhotosFolder;
			$is_ajax_call = $this->_is_ajax_call;
			
			$get_current_screen_size = 	$request->input('get_current_screen_size');
			
			// for a mobile
			if($get_current_screen_size<567)
			{
				$this->_galleryImageDeskLimit = 3;//6
				$this->_galleryKnownForDeskLimit = 3;
				$this->_galleryVideoDeskLimit = 3;
			}
			// for a desktop
			else
			{
				$this->_galleryImageDeskLimit = 4;//7
				$this->_galleryKnownForDeskLimit = 4;
				$this->_galleryVideoDeskLimit = 3;
			}
						
			// for a known for
			if($gallery_link_type == 4) {
				$utilities_helper = new Utilities;
				$folder_path = $utilities_helper->get_award_upload_folder_path();
				$gallery_data = HomePageAward::where('status',1)->get();
			}			
			else if($gallery_link_type == 3)
			{
			   $gallery_data = $this->getGalleryKnownForData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);
			}
			// for a video
			else if($gallery_link_type == 2)
			{
			   $gallery_data = $this->getGalleryVideoData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);			   	
			}
			// for a gallery image
			else
			{
			   $gallery_data = $this->getGalleryImageData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0); 	
			}
			
			return view('front.user.gallery.home_page_gellary', compact('folder_path','gallery_data', 'user_id', 'gallery_link_type', 'gallery_type', 'is_ajax_call'));
	}
	
	
	public function getAjaxAdvertisementData(Request $request)
    {
    	// Print_r($request->all());die;
	   $today = date('Y-m-d');
	   $str_page_name = '';	
	   $advertisement_category_id = 0;
	   
	   $int_limit = 1;
	   $int_position = 1;
	   
	   if(!empty($request->int_limit))
	   {
		 $int_limit = $request->int_limit;   
	   }
	   
	   if(!empty($request->int_position))
	   {
		 $int_position = $request->int_position;   
	   }
	   
	   // Get the full URL for the previous request...
       $str_previous_url = url()->previous();
	   
	   $arr_base_url = UtilitiesTwo::getBaseUrlData();	   
	   $arr_previous_url = UtilitiesTwo::getPreviousUrlData($str_previous_url);
	   
	   // if the application is inside a subfolder
	   if(!empty($arr_base_url[3]))
	   {		   
	     $str_page_name = UtilitiesTwo::getPagenameData($arr_base_url, $arr_previous_url, 4);
	   }
	   // if there is no subfolder
	   if(!empty($arr_base_url[2]))
	   {
		  $str_page_name = UtilitiesTwo::getPagenameData($arr_base_url, $arr_previous_url, 3);   
	   }
	   
	   if(strpos($str_page_name, '-list')>0)
	   {
		  $str_page_name = str_replace('-list', '', $str_page_name);   
	   }
	   
	   $advertisement_category_data = AdvertisementCategory::where('status', 1) 
		        ->where('page_name', $str_page_name)
				->first();
	   if(!empty($advertisement_category_data->id))
	   {
		  $advertisement_category_id = $advertisement_category_data->id;   
	   }
		
		    $ajax_default_advertisement_data = Advertisement::where('advertisement_position', $int_position) 
		        ->where('advertisement_category', $advertisement_category_id)
				->where('is_default', 1)				
				->where('status', 1)
				->limit($int_limit)
			    ->get();
				
		    $ajax_between_advertisement_data  = Advertisement::where('advertisement_position', $int_position) 		
		       ->where('advertisement_category', $advertisement_category_id)
			   ->whereDate('from_date','<=', $today)
               ->whereDate('to_date','>=', $today)
			   ->where('status', 1)
               ->limit($int_limit)
			   ->get();		
			
			if(empty($ajax_between_advertisement_data) || count($ajax_between_advertisement_data)<=0)
			{
				$ajax_between_advertisement_data = $ajax_default_advertisement_data;
			}			
		
			return view('front.user.modules.view_ads_list', compact('ajax_between_advertisement_data', 'int_position'));
	}
	
	
	public static function getSeoData()
    {
		$current_url_new = URL::current();
		
		$current_url_one = $current_url_new . '/';
		
		$base_url = url('/') . '/';
		
		$current_url_new_url = '';
		
		if(strpos($current_url_new, 'www.')>0)
		{
			$current_url_new_url = str_replace('www.', '', $current_url_new); 
		}
		
		//$arr_get_current_url =  explode($base_url, $current_url_new);
		
		$obj_seo_data =  SeoUrl::where('url_data', '=', $current_url_new)->where('status', '=', 1)->first();
		
		if(empty($obj_seo_data->id))
		{
		  $obj_seo_data =  SeoUrl::where('url_data', '=', $current_url_one)->where('status', '=', 1)->first();	
		}
		
		if(empty($obj_seo_data->id))
		{
		  $obj_seo_data =  SeoUrl::where('url_data', '=', $current_url_new_url)->where('status', '=', 1)->first();	
		}		

        if(!empty($obj_seo_data))
		{
		   return $obj_seo_data;  
		}			
	    else
		{
		  return 0;	
		}
						  
    }

}
