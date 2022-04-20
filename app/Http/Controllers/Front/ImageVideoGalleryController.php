<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\User;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductOfficialLink;
use App\Http\Controllers\Controller;
use App\Models\MetaData;
use App\Models\Gallery;
use App\Models\GalleryProductTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryPeopleTag;
use App\Models\Report;
use App\Models\GalleryOtherTag;
use Illuminate\Support\Facades\View;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use Illuminate\Support\Facades\Hash;
use File;
use Mail;
use Config;

class ImageVideoGalleryController extends ModuleController
{
	
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		parent::__construct();		
		$this->_current_url = url()->current();
		$this->_create_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'create');
		$this->_delete_gallery_url = Utilities::getGalleryUrls($this->_current_url, 'delete');
		$this->_main_gallery_url = Utilities::getGalleryUrls($this->_current_url, '');
		$this->_base_url = url('/'); 
	}
	
	public function getTest($name)
	{		
		echo $name;		
	}
	
	
	public function getGalleryContent($slug)
	{
		$user_id = 0;
		$is_ajax_call = 0;
		$user_id_slug_data = 0; 
		$product_user_id_slug_data = 0;
		$field_name = '';	
		$is_known_for = 0;
		$gallery_type = 1;
		$gallery_link_type = 1;
		$gallery_destination_id = 0;
		$int_gallery_id = '';
		$str_modal_form_div_id =  "ModalGalleryVideoForm";
		$user_product_data = '';
		$user_event_data = '';
		//print_r($gallery_type_link_destination);exit;		
		$current_user = get_current_user_info();
		$current_url = $this->_current_url;
		
		if(!empty($current_user->id))
		{
			$user_id = $current_user->id;
		}
		
		$gallery_type_link_destination =  Utilities::get_gallery_type_link_destination($current_url);
		
		if(!empty($gallery_type_link_destination[0]) && $gallery_type_link_destination[0])
		{
			$gallery_type = $gallery_type_link_destination[0];	
		}
		
		if(!empty($gallery_type_link_destination[1]) && $gallery_type_link_destination[1])
		{
			$gallery_link_type = $gallery_type_link_destination[1];	
		}


		if(!empty($gallery_type_link_destination[2]) && $gallery_type_link_destination[2]>0)
		{
			$is_known_for = $gallery_type_link_destination[2];	
		}
		
		if(!empty($gallery_type_link_destination[3]) && $gallery_type_link_destination[3]>0)
		{
			$gallery_destination_id = $gallery_type_link_destination[3];	
		}
		
		if(!empty($gallery_destination_id) && $gallery_destination_id == 1)
		{              
			$user_slug_data = User::select('id')->where('slug', $slug)->first();

			if(!empty($user_slug_data->id))
			{
				$user_id_slug_data = $user_slug_data->id;
			}
		}

		if(!empty($gallery_destination_id) && $gallery_destination_id == 2)
		{              
			$product_slug_data = Product::select('user_id')->where('slug', $slug)->first();

			if(!empty($product_slug_data->user_id))
			{
				$product_user_id_slug_data = $product_slug_data->user_id;
			}
		}

		if(!empty($user_id) && !empty($user_id_slug_data) && ($user_id_slug_data == $user_id))
		{

		}
		else if(!empty($user_id) && !empty($product_user_id_slug_data) && ($product_user_id_slug_data == $user_id))
		{

		}
		else if(!empty($user_id) && strpos($current_url, '/all/')>0)
		{

		}
		else if(empty($user_id))
		{

		}
		else
		{
			   // return redirect("/user/profile");
		}
		
		$arr_destinations_list = $this->_arr_destinations_list;		
		$arr_destinations_list_keys = array_keys($arr_destinations_list);
		
		$gallery_url_prefix = Utilities::getGalleryUrlPrefix($current_url);

		$create_gallery_url = $this->_create_gallery_url;
		$delete_gallery_url = $this->_delete_gallery_url;
		$main_gallery_url = $this->_main_gallery_url;		
		
		$str_gallery_image_url = Utilities::getGalleryTopUrls($this->_base_url, $gallery_url_prefix, 1);
		$str_gallery_video_url = Utilities::getGalleryTopUrls($this->_base_url, $gallery_url_prefix, 2);
		$str_gallery_knownfor_url = Utilities::getGalleryTopUrls($this->_base_url, $gallery_url_prefix, 3);
		
		if($gallery_destination_id>1)
		{
			$field_name =	$arr_destinations_list[$gallery_destination_id];
			$field_name = strtolower($field_name);
			$field_name = 'assign_'.$field_name . '_id';
		}
		
		$folder_path = $this->_galleryPhotosFolder;

		$gallery_data = $this->getGalleryResult($gallery_destination_id, $slug, $user_id, $gallery_type, $is_known_for, 20);


		$arr_event_product_data = $this->getEventProductData($user_id);

		$user_product_data = $arr_event_product_data[0];
		$user_event_data = $arr_event_product_data[1];
		$category_list = $arr_event_product_data[2];
		$person_list = $arr_event_product_data[3];
		$product_list = $arr_event_product_data[4];
		$award_list = $arr_event_product_data[5];
		$company_list = $arr_event_product_data[6];
		$people_list = $arr_event_product_data[7];
		$user_brand_data = $arr_event_product_data[8];

		$slug = str_replace('-', ' ', $slug);    
		$slug = ucwords($slug);
		//    pr($gallery_data->toArray(),1);

		$view_content = (string)View::make('front.pages.gallery', compact('category_list' ,'person_list', 'product_list', 'company_list', 
			'gallery_data' , 'folder_path', 'gallery_type', 'str_modal_form_div_id', 'int_gallery_id', 'award_list', 'user_id',
			'gallery_link_type', 'is_known_for', 'user_product_data', 'user_event_data', 'arr_destinations_list', 'user_id_slug_data', 
			'arr_destinations_list_keys', 'main_gallery_url' , 'create_gallery_url' , 'delete_gallery_url', 'slug', 
			'product_user_id_slug_data', 'str_gallery_image_url', 'str_gallery_video_url', 'str_gallery_knownfor_url', 'is_ajax_call', 'people_list', 'user_brand_data'))->render();
		/*  */
		return $view_content;
	}

    public function showGalleryByFilter(Request $request, $slug)//$destination_type, 
    {
    	// die($slug);
		//echo 'slug'.$slug;exit;
    	echo $this->getGalleryContent($slug);
    }

    public function getIndex(Request $request)
    {
    	echo $this->getGalleryContent(0);
    }

    public function postGalleryCreate(Request $request)
    {

		// echo '<pre>postGalleryCreate request - '; print_r($request->all()); die;

    	$data = $feed = array();
		
		if(!empty($request->is_not_gallery == 1)){
			$this->updateFeedsImageVideo($request); 
			return successMessage(''); die;
		}

    	$gallery_id = $request->input('gallery_meta.gallery_id');
    	$data_media = '';
         //$gallery_type = 1;
    	$gallery_type = $request->input('gallery_meta.gallery_type');

    	$destination_id = $request->input('gallery_meta.destination_id');
    	$assign_product_id = $request->input('gallery_meta.assign_product_id');
    	$assign_event_id = $request->input('gallery_meta.assign_event_id');		 
    	$assign_brand_id = $request->input('gallery_meta.assign_brand_id');

    	$rules = [
        // 'gallery_meta.title' => 'required',
		//'gallery_meta.caption' => 'required',
    		'gallery_meta.destination_id' => 'required',
		//'persons' => 'required|array',
		//'products' => 'required|array',			

    	];
 	 
    	if($gallery_type == 1 && empty($gallery_id))
    	{
    		$rules['photo'] =  'required|max:'.Config::get('commonconfig.max_file_upload_size_new');
		// $rule['profile_image'] =  'max:4000|dimensions:ratio=2/2';
    	}

	 // for a video
    	if($gallery_type == 2)
    	{
		//$rules['gallery_meta.video_url'] =  'required';
    		$rules['gallery_meta.video_url'] =  ['required', 
    		function($attribute, $value, $fail) {            

    			$chk_url_validation_check = UtilitiesTwo::get_url_validation_check($value);

    			$chk_valid_youtube_url = UtilitiesTwo::chk_valid_youtube_url($value);

    			if ($chk_url_validation_check == false || $chk_valid_youtube_url == false) {
    				return $fail('Please Enter a Valid Youtube Url.');
    			}
    		}];
    	}

    	if($destination_id == 2)
    	{
    		$rules['gallery_meta.assign_product_id'] =  'required';
    	}

    	if($destination_id == 3)
    	{
    		$rules['gallery_meta.assign_event_id'] =  'required';
    	}

    	if($destination_id == 4)
    	{
    		$rules['gallery_meta.assign_brand_id'] =  'required';
    	} 	 

    	$niceNames = [
        // 'gallery_meta.title' => 'Title',
    		'gallery_meta.caption' => 'Caption',
    		'gallery_meta.destination_id' => 'Destination',
    		'persons' => 'Persons',
    		'products' => 'Products',
    		'gallery_meta.assign_product_id' => 'Product',
    		'gallery_meta.assign_event_id' => 'Event',
    		'gallery_meta.assign_brand_id' => 'Brand',
    	];

    	if($gallery_type == 1)
    	{
    		$niceNames['photo'] =  'Photo';
    	}


    	if($gallery_type == 2)
    	{
    		$niceNames['gallery_meta.video_url'] =  'Video Url';
    	}	

    	$this->validate($request, $rules, [], $niceNames);

        //$request->validate(Gallery::validateGallery());
    	try {

    		$current_user = get_current_user_info();			

    		DB::beginTransaction();

    		if($gallery_type == 1)
    		{
				if ($request->hasFile('photo')) 
    			{
					$data_media = $request->crop_img;
					// $data_media = $request->crop_img;
    	// 			$file = $request->photo;
    	// 			$extension = $file->getClientOriginalExtension();
					// //$extension = UtilitiesTwo::get_image_ext_name();
    	// 			$timestamp = generateFilename();
    	// 			$filename = $timestamp . '.' . $extension;

    	// 			$file_path = $this->_galleryPhotosFolder;
					// //$file_path = imagePath();
    	// 			$upload_status = $file->move(public_path($file_path), $filename);
					// //$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
    	// 			if ($upload_status) {
    	// 				$data_media = $filename;
    	// 			} else {
					// 	// Rollback Transaction

    	// 				$message = ['msg' => errorMessage('file_uploading_failed')];
    	// 				return response()->json($message, 422);
    	// 			}
    			}	
    		}

    		if($gallery_type == 2)
    		{
    			$data_media = $request->input('gallery_meta.video_url');	
    		}

    		$is_known_for = $request->input('gallery_meta.is_known_for');
    		$is_known_for = intval($is_known_for);



    		if(empty($assign_event_id))
    		{
    			$assign_event_id = 0;	
    		}

    		if(empty($assign_product_id))
    		{
    			$assign_product_id = 0;	
    		}

    		if(empty($assign_brand_id))
    		{
    			$assign_brand_id = 0;	
    		}

    		$data = [
    			'title' => $request->input('gallery_meta.title'),
    			'caption' => $request->input('gallery_meta.caption'),
    			'featured_image' =>($request->input('gallery_meta.featured_image')) ? $request->input('gallery_meta.featured_image') : 0 ,
    			'type' => $gallery_type,					
    			'is_known_for' => $is_known_for,
    			'destination_id' => $destination_id,
    			'assign_product_id' => $assign_product_id,
    			'assign_brand_id' => $assign_brand_id,
    			'assign_event_id' => $assign_event_id,
    			'status' => 1,
    			'user_id' => $current_user->id
    		];
    		if(!empty($data_media))
    		{
    			$data['media'] = $data_media;
    		}

    		if($gallery_type == 1)
    		{
    			$data['url'] = $request->input('gallery_meta.url');
    		}


            //$gallery_data = Gallery::create($data);
			
    		if(!empty($gallery_id)) {
			 //	echo "<pre>"; print_r("yes"); die;
    			$gallery_data = Gallery::updateOrCreate(['id' => $gallery_id], $data);
    		} else {
    			$gallery_data = Gallery::create($data);
				$gallery_id = $gallery_data->id;
			  //echo "<pre>"; print_r("no"); die;
    		} 

			//echo "<pre>"; print_r($request->products); die;
    		$feedCompanies = $feedPerson = $feedProduct ='';
    		if(!empty($request->persons) && count($request->persons)>0) {
    			$feedPerson = implode(",",$request->persons);
    		}elseif(!empty($request->peoples) && count($request->peoples)>0) {
    			$feedPerson = implode(",",$request->peoples);
    		}
			
    		if(!empty($request->products) && count($request->products)>0) {
    			$feedProduct = implode(",",$request->products);
    		} 
    		if(!empty($request->companies) && count($request->companies)>0) {
    			$feedCompanies = implode(",",$request->companies);
    		}
			// echo "feedPerson - $feedPerson"; die;
			//echo $gallery_id; die;
			//$feedData= array("Yes","No");
    		$feedData = Gallery::where('id',$gallery_id)->first();
			
			if((isset($feedData) && !empty($feedData)) && !empty($request->feed_check == 'on')){
    			
    			$feed = array(
					'user_id'=>$current_user->id,
                	'type'=>$feedData['type'],
    				'title' => ucfirst($feedData['title']),
    				'caption' => ucfirst($feedData['caption']),
    				'tag_peoples' =>$feedPerson,
    				'tag_products' =>$feedProduct,
    				'tag_companies' =>$feedCompanies,
                	'check_post' =>1,
					'time' =>time(),
    			);

    			if($feedData['type'] == 1) {
					// echo "<pre>request - "; print_r($request->all()); die;
    				if ($request->hasFile('photo') || $feedData['feed_id'] == 0) 
					{
						// $oldPath = public_path('/uploads/images/gallery/photos/'.$feedData['media']); 
						// $fileExtension = \File::extension($oldPath);
						// $filenamefeed = $feedData['media'];
						// $newName = time().'_'.rand().'.'.$fileExtension;
						// $newPathWithName = public_path('uploads/images/feed/'.$newName);
						// if (\File::copy($oldPath , $newPathWithName)) {
						// // dd("success");
						// }

						$oldPath = public_path('/uploads/images/gallery/photos/'.$feedData['media']); 
						$extension = \File::extension($oldPath);
						$filename = time().'_'.rand().'.'.$extension;
						$destinationPath = public_path('uploads/images/feed/'.$filename);
						$img = \Image::make($oldPath);                
						if($img->save($destinationPath,50,'jpg')){
							$feed['image'] = $filename;
						}
						// $feed['image'] = $newName;
					}elseif(!empty($request->is_image)){
						$oldPath = public_path('/uploads/images/gallery/photos/'.$request->is_image); 
						$extension = \File::extension($oldPath);
						$filename = time().'_'.rand().'.'.$extension;
						$destinationPath = public_path('uploads/images/feed/'.$filename);
						$img = \Image::make($oldPath);                
						if($img->save($destinationPath,50,'jpg')){
							$feed['image'] = $filename;
						}
					}
    			}

    			if($feedData['type'] == 2) {
    				$feed['video_url'] = $feedData['media'];
    			}
				// echo $feedData['feed_id']."<br>";
				// echo "<pre>feed - "; print_r($feed); die;
    			// Feed::where('id',$feedData['feed_id'])->update($feed);
    			$feed_update = Feed::updateOrCreate(['id' => $feedData['feed_id']], $feed);
				Gallery::where('id',$gallery_id)->update(['feed_id'=>$feed_update->id]);
    		}
    			//echo "<pre>"; print_r($request->all()); die;
			//echo "<pre>"; print_r($feedId); die;




			// Add Product
            //$product = $this->addProduct($request);

    		if(!empty($request->persons))
    		{
    			if(!empty($gallery_data->id))
    			{
    				GalleryPersonTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			foreach ($request->persons as $person_data_row) {

    				$data_person_tag = array();

    				$chk_person_tag_data = GalleryPersonTag::select('id')
    				->where('user_id', $current_user->id)
    				->where('person_id', $person_data_row)
    				->where('gallery_id', $gallery_data->id)->first();

    				$data_person_tag['user_id'] = $current_user->id;
    				$data_person_tag['gallery_id'] = $gallery_data->id;
    				$data_person_tag['person_id'] = $person_data_row;
    				$data_person_tag['created_at'] = new \DateTime();
    				$data_person_tag['updated_at'] = new \DateTime();
    				$data_person_tag['status'] = 1;					

    				if(!empty($chk_person_tag_data->id))
    				{
    					$int_person_tag_data_id = $chk_person_tag_data->id;
    					$update = GalleryPersonTag::where('id', $int_person_tag_data_id)
    					->update(['status' => 1]);
    				}
    				else
    				{
    					$int_person_tag_data_id = 0;
    					GalleryPersonTag::updateOrCreate(['id' => $int_person_tag_data_id], $data_person_tag);
    				}				

    			}

    		}



    		if(!empty($request->products))
    		{
    			if(!empty($gallery_data->id))
    			{
    				GalleryProductTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			foreach ($request->products as $product_data_row) {

    				$data_product_tag = array();

    				$chk_product_tag_data = GalleryProductTag::select('id')
    				->where('user_id', $current_user->id)
    				->where('product_id', $product_data_row)
    				->where('gallery_id', $gallery_data->id)->first();

    				$data_product_tag['user_id'] = $current_user->id;
    				$data_product_tag['gallery_id'] = $gallery_data->id;
    				$data_product_tag['product_id'] = $product_data_row;
    				$data_product_tag['created_at'] = new \DateTime();
    				$data_product_tag['updated_at'] = new \DateTime();
    				$data_product_tag['status'] = 1;					

    				if(!empty($chk_product_tag_data->id))
    				{
    					$int_product_tag_data_id = $chk_product_tag_data->id;
    					$update = GalleryProductTag::where('id', $int_product_tag_data_id)
    					->update(['status' => 1]);
    				}
    				else
    				{
    					$int_product_tag_data_id = 0;
    					GalleryProductTag::updateOrCreate(['id' => $int_product_tag_data_id], $data_product_tag);
    				}				

    			}

    		}



    		if(!empty($request->awards))
    		{
    			if(!empty($gallery_data->id))
    			{
    				GalleryAwardTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			foreach ($request->awards as $award_data_row) {

    				$data_award_tag = array();

    				$chk_award_tag_data = GalleryAwardTag::select('id')
    				->where('user_id', $current_user->id)
    				->where('award_id', $award_data_row)
    				->where('gallery_id', $gallery_data->id)->first();

    				$data_award_tag['user_id'] = $current_user->id;
    				$data_award_tag['gallery_id'] = $gallery_data->id;
    				$data_award_tag['award_id'] = $award_data_row;
    				$data_award_tag['created_at'] = new \DateTime();
    				$data_award_tag['updated_at'] = new \DateTime();
    				$data_award_tag['status'] = 1;					

    				if(!empty($chk_award_tag_data->id))
    				{
    					$int_award_tag_data_id = $chk_award_tag_data->id;
    					$update = GalleryAwardTag::where('id', $int_award_tag_data_id)
    					->update(['status' => 1]);
    				}
    				else
    				{
    					$int_award_tag_data_id = 0;
    					GalleryAwardTag::updateOrCreate(['id' => $int_award_tag_data_id], $data_award_tag);
    				}				
    			}
    		}

    		if(!empty($request->companies))
    		{
    			if(!empty($gallery_data->id))
    			{
    				GalleryCompanyTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			foreach ($request->companies as $company_data_row) {

    				$data_company_tag = array();

    				$chk_company_tag_data = GalleryCompanyTag::select('id')
    				->where('user_id', $current_user->id)
    				->where('company_id', $company_data_row)
    				->where('gallery_id', $gallery_data->id)->first();

    				$data_company_tag['user_id'] = $current_user->id;
    				$data_company_tag['gallery_id'] = $gallery_data->id;
    				$data_company_tag['company_id'] = $company_data_row;
    				$data_company_tag['created_at'] = new \DateTime();
    				$data_company_tag['updated_at'] = new \DateTime();
    				$data_company_tag['status'] = 1;					

    				if(!empty($chk_company_tag_data->id))
    				{
    					$int_company_tag_data_id = $chk_company_tag_data->id;
    					$update = GalleryCompanyTag::where('id', $int_company_tag_data_id)
    					->update(['status' => 1]);
    				}
    				else
    				{
    					$int_company_tag_data_id = 0;
    					GalleryCompanyTag::updateOrCreate(['id' => $int_company_tag_data_id], $data_company_tag);
    				}				

    			}

    		}

    		if(!empty($request->peoples))
    		{
    			if(!empty($gallery_data->id))
    			{
    				GalleryPeopleTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			foreach ($request->peoples as $people_data_row) {

    				$data_people_tag = array();

    				$chk_people_tag_data = GalleryPeopleTag::select('id')
    				->where('user_id', $current_user->id)
    				->where('people_id', $people_data_row)
    				->where('gallery_id', $gallery_data->id)->first();

    				$data_people_tag['user_id'] = $current_user->id;
    				$data_people_tag['gallery_id'] = $gallery_data->id;
    				$data_people_tag['people_id'] = $people_data_row;
    				$data_people_tag['created_at'] = new \DateTime();
    				$data_people_tag['updated_at'] = new \DateTime();
    				$data_people_tag['status'] = 1;					

    				if(!empty($chk_people_tag_data->id))
    				{
    					$int_people_tag_data_id = $chk_people_tag_data->id;
    					$update = GalleryPeopleTag::where('id', $int_people_tag_data_id)
    					->update(['status' => 1]);
    				}
    				else
    				{
    					$int_people_tag_data_id = 0;
    					GalleryPeopleTag::updateOrCreate(['id' => $int_people_tag_data_id], $data_people_tag);
    				}				

    			}

    		}

    		if(!empty($request->others))
    		{
    			$arr_req_other_data = $request->others;
    			if(!empty($gallery_data->id))
    			{
    				GalleryOtherTag::where('gallery_id', $gallery_data->id)
    				->where('user_id', $current_user->id)
    				->update(['status' => 0]);	
    			}				

    			if(strpos($arr_req_other_data[0], ',')>0)
    			{
    				$arr_others = explode(",", $arr_req_other_data[0]);  
    			}			  
    			else
    			{
    				$arr_others[] = $arr_req_other_data[0];
    			}

    			foreach ($arr_others as $other_data_row) {

    				if(!empty($other_data_row))
    				{

    					$other_data_row = trim($other_data_row);

    					$data_other_tag = array();

    					$chk_other_tag_data = GalleryOtherTag::select('id')
    					->where('user_id', $current_user->id)
    					->where('tag', $other_data_row)
    					->where('gallery_id', $gallery_data->id)->first();

    					$data_other_tag['user_id'] = $current_user->id;
    					$data_other_tag['gallery_id'] = $gallery_data->id;
    					$data_other_tag['tag'] = $other_data_row;
    					$data_other_tag['created_at'] = new \DateTime();
    					$data_other_tag['updated_at'] = new \DateTime();
    					$data_other_tag['status'] = 1;					

    					if(!empty($chk_other_tag_data->id))
    					{
    						$int_other_tag_data_id = $chk_other_tag_data->id;
    						$update = GalleryOtherTag::where('id', $int_other_tag_data_id)
    						->update(['status' => 1]);
    					}
    					else
    					{
    						$int_other_tag_data_id = 0;
    						GalleryOtherTag::updateOrCreate(['id' => $int_other_tag_data_id], $data_other_tag);
    					}
    				}  			

    			}

    		}


    		DB::commit();
    		Session::flash('gallery_data_saved_flag', 1); 

    		return successMessage('');
    	} catch (\Exception $e) {
    		DB::rollback();
    		throw $e;
    		return errorMessage($e->getMessage(), true);
    	}
    }

    public function report(Request $request, $type, $url, $profile_url)
    {
		// pr($request->all(),1);
    	$base_url = url('/');
    	$user_current_info_new = User::find($profile_url);
    	$str_user_url_new = Utilities::get_user_url($base_url, $user_current_info_new);

    	if($type == 4){
    		$url = $base_url.'/product/'.$url;
    	} else if($type == 0 && $url == 'url') {
    		$url = $str_user_url_new;
    	}


    	$report = new Report();
    	$report->type = $type;
		// $report->url = ($url == 'url') ? $str_user_url_new : $url;
    	$report->url = $url;
    	$report->profile_url = $str_user_url_new;
    	$report->save();

        // $data['url'] = $url;
        // $data['email'] = $user_current_info_new->email;
        // $data['name']  = @$user_current_info_new->first_name.' '.@$user_current_info_new->last_name;
        // // pr($data,1); 

        // Mail::send('mail.auth.report',$data, function($message) use ($data) {
        // $message->to('apamitpunj@yopmail.com', 'People Of Play')
        // ->subject('Reset Password');
        // $message->from(config('mail.from.address'),'People Of Play');
        // });

    	Session::put('report_successfully', 1);
    	return back();
    }


    public function deleteGallery(Request $request)
    {
		//echo 'id'.$id;exit;

    	$id = $request->input('gallery_id');

    	$main_gallery_url = $this->_main_gallery_url;

    	try {

    		DB::beginTransaction();

    		$image_data = Gallery::select('media')->where('id', $id)->first();

    		$image_path = public_path($this->_galleryPhotosFolder . $image_data->media);
    		if(file_exists($image_path)) {
    			File::delete($image_path);
    		}

    		GalleryPersonTag::where('gallery_id', $id)->delete();			
    		GalleryProductTag::where('gallery_id', $id)->delete();
    		GalleryAwardTag::where('gallery_id', $id)->delete();
    		GalleryCompanyTag::where('gallery_id', $id)->delete();
    		GalleryOtherTag::where('gallery_id', $id)->delete();

    		Gallery::where('id', $id)->delete();

			//$str_save_gallery_url_redirect = Utilities::getGalleryRedirectUrl($int_gallery_link_type);

    		DB::commit();
    		return successMessage('Gallery Deleted Successfully');
			//return redirect($main_gallery_url);
            //return successMessage('Gallery Created Successfully');
    	} catch (\Exception $e) {
    		DB::rollback();
    		throw $e;
    		return errorMessage($e->getMessage(), true);
    	}
    }

    public function getUpdateSequance(Request $request)
    {
       $type = $request->type;
       if($type == 3) {
         $gallay_images = Gallery::where(['user_id'=>Auth::guard('users')->user()->id,'type'=>1,'status'=>1,'is_known_for'=>1])->orderBy('sr_no', 'ASC')->orderBy('galleries.id','ASC')->get()->toArray();
       } else {
       $gallay_images = Gallery::where(['user_id'=>Auth::guard('users')->user()->id,'type'=>$type,'status'=>1,'is_known_for'=>0])->orderBy('sr_no', 'ASC')->orderBy('galleries.id','ASC')->get()->toArray();
       }
       $view = view('front/user/gallery/image_sequance_modal',compact('gallay_images','type'))->render();
       $res = array('success'=>1,'view'=>$view);
       echo json_encode($res);
    }

    public function updateSequenceImageData(Request $request)
    {
        $i = 1;
        foreach ($request->imageIds ?? [] as $key => $value) {
            if($value != 0){
                $product = Gallery::find($value);
                $product->sr_no = $i;
                $product->save();
                $i++;
            }
        }
    }

    public function postYoutubeThumbnail(Request $request) {
         $GetAPI = @GetYoutubeAPI(@$request->video_url);
         $thumbnail = @$GetAPI['thumbnail']['thumb'];
         if(!empty($thumbnail)) {
            $res = array('success'=>1,'thumbnail'=>$thumbnail);
            echo json_encode($res);
         } else {
            $res = array('success'=>0,'msg'=>'Please Enter a Valid Youtube Url');
            echo json_encode($res);
         }
    }

   public function postUploadImage(Request $request) {

        $image = $request->image;
       
        list($type, $image) = explode(';',$image);
        list(, $image) = explode(',',$image);

        $image = base64_decode($image);

		// $timestamp = generateFilename();
		// $image_name = $timestamp . '.' .'png';
        // file_put_contents('uploads/images/gallery/photos/'.$image_name, $image);

		$timestamp = generateFilename();
        $filename = $timestamp . '.' .'png';
        $file_path = 'uploads/images/gallery/photos/'.$filename;
        $img = \Image::make($image);
        $destinationPath = public_path($file_path);
        if($img->save($destinationPath,50,'jpg')){
                $image_name = $filename;
        }

        echo json_encode(['success'=>1,'crop_img'=>$image_name]);
    }

    public function postGalleryList(Request $request) {
        $type =$request->type;
        $id =$request->id;
        $user_id =$request->user_id;
       $show_btn =$request->show_btn; 

        if($type == 1) {
            $galleryTitle = 'Photo Gallery';
        } else if($type ==2) {
            $galleryTitle = 'Video Gallery';
        } else {
            $galleryTitle = 'Known For Gallery';
        }
        if($type == 3) {
         $gallay_images = Gallery::where(['user_id'=>$user_id,'type'=>1,'status'=>1,'is_known_for'=>1])->orderBy('sr_no', 'ASC')->orderBy('galleries.id','ASC')->get();

         foreach ($gallay_images as $key => $row_gallary) {
            $gallay_images[$key]->gallery_company_tags = GalleryCompanyTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_company_tags.company_id')->select('gallery_company_tags.*','users.first_name','users.last_name','users.slug')->get()->toArray();

             $gallay_images[$key]->gallery_people_tags = GalleryPeopleTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_people_tags.people_id')->select('gallery_people_tags.*','users.first_name','users.last_name','users.slug')->get();

            $gallay_images[$key]->gallery_product_tags = GalleryProductTag::where(['gallery_id'=>$row_gallary->id,'products.status'=>1])->leftJoin('products', 'products.id', '=', 'gallery_product_tags.product_id')->select('gallery_product_tags.*','products.name','products.slug')->get();

           
            $gallay_images[$key]->gallery_person_tags = GalleryPersonTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_person_tags.person_id')->select('gallery_person_tags.*','users.first_name','users.last_name','users.slug')->get();
          } 
        //echo "<pre>"; print_r($gallay_images); die;
       } else {
       $gallay_images = Gallery::where(['user_id'=>$user_id,'type'=>$type,'status'=>1,'is_known_for'=>0])->orderBy('sr_no', 'ASC')->orderBy('galleries.id','ASC')->get();
       // if(count($gallay_images) 0 ) {
         foreach ($gallay_images as $key => $row_gallary) {
            //echo $row_gallary['id']; die;
            $gallay_images[$key]->gallery_company_tags = GalleryCompanyTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_company_tags.company_id')->select('gallery_company_tags.*','users.first_name','users.last_name','users.slug')->get()->toArray();

             $gallay_images[$key]->gallery_people_tags = GalleryPeopleTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_people_tags.people_id')->select('gallery_people_tags.*','users.first_name','users.last_name','users.slug')->get();

            $gallay_images[$key]->gallery_product_tags = GalleryProductTag::where(['gallery_id'=>$row_gallary->id,'products.status'=>1])->leftJoin('products', 'products.id', '=', 'gallery_product_tags.product_id')->select('gallery_product_tags.*','products.name','products.slug')->get();

           
            $gallay_images[$key]->gallery_person_tags = GalleryPersonTag::where(['gallery_id'=>$row_gallary->id,'users.status'=>1])->leftJoin('users', 'users.id', '=', 'gallery_person_tags.person_id')->select('gallery_person_tags.*','users.first_name','users.last_name','users.slug')->get();
          }      
       }
        $view = view('front.user.gallery.gallery_images_modal',compact('gallay_images','id','type','galleryTitle','show_btn'))->render();
      
        $res = array('view' => $view);
        echo json_encode($res);
    }

    public function addOrEditPostGalleryList(Request $request) {
        // echo '<pre>request editPostGalleryList - '; print_r($request->all()); die;
		
		$user_id = 0;
		$gallery_link_type = 1;		
		$int_type_of_user = 0;	
		$request_type = '';
		$current_user = get_current_user_info();
		$current_url = $this->_current_url;		
		if(!empty($current_user->id)){
			$user_id = $current_user->id;
		}

		if(!empty($request->type == 'feeds_edit')){
			$g_data = Gallery::where('feed_id',$request->id)->orderBy('id','DESC')->first();
			if(empty($g_data->id)){
				$res_rtn = $this->editFeedsImageVideo($request); 
				echo json_encode($res_rtn); die;
			}
			$request['id'] = $g_data->id;
			$request_type = 'feeds_edit';
		}

		$arr_destinations_list = $this->_arr_destinations_list;		
		$arr_destinations_list_keys = array_keys($arr_destinations_list);
		
		$arr_products = $arr_companys = $arr_peoples = array();

		if($request->file_type == 'add'){
			$gallery_info = Gallery::get();
			$gallery_product_tags = GalleryProductTag::get();
			$gallery_company_tags = GalleryCompanyTag::get();
			$gallery_people_tags = GalleryPeopleTag::get();

			$int_gallery_id = '';
			$gallery_type = $request->type;
			$is_known_for = '';
			$is_known_for = '';
			$people_list =  '';
			
			$arr_event_product_data = $this->getEventProductData($user_id);
			$user_product_data = $arr_event_product_data[0];
			$user_event_data = $arr_event_product_data[1];
			$category_list = '';
			$person_list = '';
			$product_list = '';
			$award_list = '';
			$company_list = '';
			// $people_list = '';
			$user_brand_data = $arr_event_product_data[8];

		}elseif($request->file_type == 'edit'){

			$arr_event_product_data = $this->getEventProductData($user_id);
			$user_product_data = $arr_event_product_data[0];
			$user_event_data = $arr_event_product_data[1];
			$category_list = $arr_event_product_data[2];
			$person_list = $arr_event_product_data[3];
			$product_list = $arr_event_product_data[4];
			$award_list = $arr_event_product_data[5];
			$company_list = $arr_event_product_data[6];
			// $people_list = $arr_event_product_data[7];
			$user_brand_data = $arr_event_product_data[8];
			
			$gallery_info = Gallery::where('id',$request->id)->first();
			$gallery_product_tags = GalleryProductTag::where('gallery_id',$request->id)->get();
			$gallery_company_tags = GalleryCompanyTag::where('gallery_id',$request->id)->get();
			$gallery_people_tags = GalleryPeopleTag::where('gallery_id',$request->id)->get();
			
			$int_gallery_id = $gallery_info->id;
			$gallery_type = $gallery_info->type;
			$is_known_for = $gallery_info->is_known_for;
			$is_known_for = $gallery_info->is_known_for;
			
			foreach($gallery_product_tags as $gallery_product_tag){
				$arr_products[] = $gallery_product_tag->product_id;
			}
			
			foreach($gallery_company_tags as $gallery_company_tag){
				$arr_companys[] = $gallery_company_tag->company_id;
			}
			
			foreach($gallery_people_tags as $gallery_people_tag){
				$arr_peoples[] = $gallery_people_tag->people_id;
			}

			$people_list = User::where('role','!=',3)->get(['id','first_name', 'last_name']);
		}

		
		
		
		// echo '<pre>arr_products - '; print_r($arr_products); //die;
		// echo '<pre>gallery_info - '; print_r($gallery_info); die;
		if($request->file_type == 'add'){
			$file_name = 'add_image_gallery_modal';
		}elseif($request->file_type == 'edit'){
			$file_name = 'edit_image_gallery_modal';
		}
		

		$view_content = (string)View::make('front.user.gallery.'.$file_name, compact('category_list' ,'person_list', 'product_list', 'company_list', 'gallery_type','int_gallery_id','award_list','user_id','gallery_link_type', 'is_known_for', 'user_product_data','user_event_data','arr_destinations_list', 'arr_destinations_list_keys','people_list', 'user_brand_data','gallery_info','gallery_product_tags','arr_products','int_type_of_user','arr_companys','arr_peoples','request_type'))->render();
		/*  */
		// echo $view_content; die;

        $res = array('view' => $view_content);
        echo json_encode($res);
    }

	public function test_searching(Request $request){
		// echo '<pre>request - '; print_r($request->all()); die;

		$name = $request->searchTerm;

		if($request->searchTable == 'products'){
			$peoples = DB::table('products')
			->where(function($query) use ($name){
					$table_name = 'products';
					$query->where('products.name', 'LIKE', '%'.$name.'%');
			});
			$results = $peoples->get(['id','name'])->toArray();
		}else if($request->searchTable == 'peoples'){
			$peoples = DB::table('users')->where('role','!=',3)
			->where(function($query) use ($name){
					$table_name = 'users';
					$query->where('users.first_name', 'LIKE', '%'.$name.'%');
					$query->orWhere('users.last_name', 'LIKE', '%' . $name . '%');
			});
			$results = $peoples->get(['id','first_name', 'last_name'])->toArray();
		}else if($request->searchTable == 'company'){
			$peoples = DB::table('users')->where('role',3)
			->where(function($query) use ($name){
					$table_name = 'users';
					$query->where('users.first_name', 'LIKE', '%'.$name.'%');
					$query->orWhere('users.last_name', 'LIKE', '%' . $name . '%');
			});
			$results = $peoples->get(['id','first_name', 'last_name'])->toArray();
		}
		
			
		// echo '<pre>results - '; print_r($results); die;
		$peoples_result = array();
		foreach($results as $result){
			if($request->searchTable == 'products'){
				$peoples_result[] = array('id'=>$result->id,'text'=>$result->name);
			}else{
				$peoples_result[] = array('id'=>$result->id,'text'=>$result->first_name.' '.$result->last_name);
			}
			
		}
		// echo '<pre>peoples_result - '; print_r($peoples_result); die;
		echo json_encode($peoples_result);
	}

	public function editFeedsImageVideo(Request $request){
		
		// echo 'herejdfhj'; pr($request->all()); die;

		$user_id = 0;
		$gallery_link_type = 1;		
		$int_type_of_user = 0;	
		$request_type = '';
		$current_user = get_current_user_info();
		$current_url = $this->_current_url;		
		if(!empty($current_user->id)){
			$user_id = $current_user->id;
		}		

		$arr_destinations_list = $this->_arr_destinations_list;		
		$arr_destinations_list_keys = array_keys($arr_destinations_list);
		
		$arr_products = $arr_companys = $arr_peoples = array();

		if($request->file_type == 'edit'){

			$arr_event_product_data = $this->getEventProductData($user_id);
			$user_product_data = $arr_event_product_data[0];
			$user_event_data = $arr_event_product_data[1];
			$category_list = $arr_event_product_data[2];
			$person_list = $arr_event_product_data[3];
			$product_list = $arr_event_product_data[4];
			$award_list = $arr_event_product_data[5];
			$company_list = $arr_event_product_data[6];
			// $people_list = $arr_event_product_data[7];
			$user_brand_data = $arr_event_product_data[8];
			
			$gallery_info = $g_data = Feed::where('id',$request->id)->first();
			$gallery_product_tags = explode(',',$gallery_info->tag_products);
			$gallery_company_tags = explode(',',$gallery_info->tag_companies);
			$gallery_people_tags = explode(',',$gallery_info->tag_peoples);
			
			$int_gallery_id = $gallery_info->id;
			$gallery_type = $gallery_info->type;
			$is_known_for = '';
			if($gallery_info->type == 1){
				$gallery_info->media = $gallery_info->image;
			}elseif($gallery_info->type == 2){
				$gallery_info->media = $gallery_info->video_url;
			}
			
			foreach($gallery_product_tags as $gallery_product_tag){
				$arr_products[] = $gallery_product_tag;
			}
			
			foreach($gallery_company_tags as $gallery_company_tag){
				$arr_companys[] = $gallery_company_tag;
			}
			
			foreach($gallery_people_tags as $gallery_people_tag){
				$arr_peoples[] = $gallery_people_tag;
			}

			$people_list = User::where('role','!=',3)->get(['id','first_name', 'last_name']);
		}

		
		$request_type = 'feeds_edit';
		$is_not_gallery = 1;
		
		// echo '<pre>arr_peoples - '; print_r($arr_peoples); die;
		// echo '<pre>gallery_info - '; print_r($gallery_info->toArray()); die;
		$file_name = 'edit_image_gallery_modal';
		

		$view_content = (string)View::make('front.user.gallery.'.$file_name, compact('category_list' ,'person_list', 'product_list', 'company_list', 'gallery_type','int_gallery_id','award_list','user_id','gallery_link_type', 'is_known_for', 'user_product_data','user_event_data','arr_destinations_list', 'arr_destinations_list_keys','people_list', 'user_brand_data','gallery_info','gallery_product_tags','arr_products','int_type_of_user','arr_companys','arr_peoples','request_type','is_not_gallery'))->render();
		/*  */
		// echo $view_content; die;

        $res = array('view' => $view_content);
        return $res; die;
	}

	
	public function updateFeedsImageVideo(Request $request){
		// echo '<pre>updateFeedsImageVideo request - '; print_r($request->all()); die;	
		
    	$gallery_id = $request->input('gallery_meta.gallery_id');
    	$data_media = '';
         //$gallery_type = 1;
    	$gallery_type = $request->input('gallery_meta.gallery_type');

    	$rules = [
        	'gallery_meta.title' => 'required',
			//'gallery_meta.caption' => 'required',

    	];
 	 
    	if($gallery_type == 1 && empty($gallery_id))
    	{
    		$rules['photo'] =  'required|max:'.Config::get('commonconfig.max_file_upload_size_new');
		// $rule['profile_image'] =  'max:4000|dimensions:ratio=2/2';
    	}

	 // for a video
    	if($gallery_type == 2)
    	{
    		$rules['gallery_meta.video_url'] =  ['required', 
    		function($attribute, $value, $fail) {            

    			$chk_url_validation_check = UtilitiesTwo::get_url_validation_check($value);

    			$chk_valid_youtube_url = UtilitiesTwo::chk_valid_youtube_url($value);

    			if ($chk_url_validation_check == false || $chk_valid_youtube_url == false) {
    				return $fail('Please Enter a Valid Youtube Url.');
    			}
    		}];
    	}

    	$niceNames = [
        	'gallery_meta.title' => 'Title',
    		// 'gallery_meta.caption' => 'Caption',
    		'persons' => 'Persons',
    		'products' => 'Products',
    	];

    	if($gallery_type == 1)
    	{
    		$niceNames['photo'] =  'Photo';
    	}


    	if($gallery_type == 2)
    	{
    		$niceNames['gallery_meta.video_url'] =  'Video Url';
    	}	

    	$this->validate($request, $rules, [], $niceNames);

		try{	

			$current_user = get_current_user_info();	
			$feedCompanies = $feedPerson = $feedProduct ='';
    		if(!empty($request->persons) && count($request->persons)>0) {
    			$feedPerson = implode(",",$request->persons);
    		} 
    		if(!empty($request->products) && count($request->products)>0) {
    			$feedProduct = implode(",",$request->products);
    		} 
    		if(!empty($request->companies) && count($request->companies)>0) {
    			$feedCompanies = implode(",",$request->companies);
    		}

			//echo $gallery_id; die;
			//$feedData= array("Yes","No");
    		$feedData = $request;
			
			$feed = array(
				'user_id'=>$current_user->id,
				'type'=> $request->input('gallery_meta.gallery_type'),
				'title' => ucfirst($request->input('gallery_meta.title')),
				'caption' => ucfirst($request->input('gallery_meta.caption')),
				'tag_peoples' =>$feedPerson,
				'tag_products' =>$feedProduct,
				'tag_companies' =>$feedCompanies,
				'time' =>time(),
			);

			if($gallery_type == 1) {
				if ($request->hasFile('photo')) {

					$file_comp = $request->photo;
                    $extension = $file_comp->getClientOriginalExtension();
                    $filename = time().'_'.rand().'.'.$extension;
                    $file_path = 'uploads/images/feed/';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,70,'jpg')){      
                            $feed['image'] = $filename;
                    }
				}
			}

			if($gallery_type == 2) {
				$feed['video_url'] = $request->input('gallery_meta.video_url');
			}
			// echo $feedData['feed_id']."<br>";
			// echo "<pre>feed - "; print_r($feed); die;
			// Feed::where('id',$feedData['feed_id'])->update($feed);
			$feed_update = Feed::updateOrCreate(['id' => $request->input('gallery_meta.gallery_id')], $feed);

			DB::commit();
			Session::flash('gallery_data_saved_flag', 1); 

			return successMessage('');
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
			return errorMessage($e->getMessage(), true);
		}
			
	}

}
