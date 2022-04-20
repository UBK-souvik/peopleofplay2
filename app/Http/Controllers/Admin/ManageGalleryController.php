<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\Gallery;
use App\Models\GalleryProductTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryOtherTag;
use App\Models\GalleryPeopleTag;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use File;
use Carbon\Carbon;
use DB;
use Session;

class ManageGalleryController extends \App\Http\Controllers\Front\ModuleController
{
	
	public function __construct()
    {
		parent::__construct();        
	}
	
    public function getIndex($user_id, $int_media_id)
    {
		//$advertisement_category = AdvertisementCategory::pluck('category', 'id');
		$users_list = User::get_all_user_list_by_email_name();	
		$folder_path = $this->_galleryPhotosFolder;
		$get_gallery_link_types_urls = Utilities::get_gallery_link_types_urls();
		
		$gallery_type = 0;
		
        return view('admin.galleries.index', ['int_media_id'=> $int_media_id, 'get_gallery_link_types_urls' => $get_gallery_link_types_urls, 'folder_path' => $folder_path, 'gallery_type' => $gallery_type, 'users_list' => $users_list, 'user_id' => $user_id]);
    }
	
    public function getList($user_id, $int_media_id)//, $category_id
    {
        $galleries = \App\Models\Gallery::select(['galleries.*',DB::raw("0 AS user_name"),DB::raw("0 AS gallery_type_data"),DB::raw("0 AS video_id_data"),DB::raw("0 AS image_video_data")])->with(['user_data']);
        
		$galleries->leftJoin('users as u', 'u.id', '=', 'galleries.user_id');
		//$advertisements->leftJoin('advertisement_categories as ac', 'ac.id', '=', 'advertisements.advertisement_category');
	
		if(!empty($user_id))
		{
		   $galleries->where('galleries.user_id', $user_id);	
		}
		
		if(!empty($int_media_id))
		{
		   // for known for	
		   if($int_media_id == 3)
		   {
			   //echo 'abcd';
			   $int_media_id = 1;
			   $galleries->where('galleries.is_known_for', 1);
			   $galleries->where('galleries.type', $int_media_id);   
		   }
		   else
		   {
			   //echo 'efgh';
			   $galleries->where('galleries.type', $int_media_id);
		   }			   
		   
		}
		
		return \DataTables::of($galleries)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
			
			->editColumn('user_name', function ($query) {
                   $str_user_name = Utilities::getUserName(@$query->user_data);
					
				   if(!empty(@$query->user_data->name))
					return @$query->user_data->name;
				   else
					return @$str_user_name;					
            })
			
			->editColumn('gallery_type_data', function ($query) {
              $arr_gallery_link_types_urls =  Utilities::get_gallery_link_types_urls();
			  $arr_gallery_type_data = array();	
				
			  $str_gallery_type_data =  $arr_gallery_link_types_urls[@$query->type];	
			  
			  if(strpos($str_gallery_type_data,'-')>0)
			  {
				 $arr_gallery_type_data = explode('-', $str_gallery_type_data);
			  } 
			  if(!empty($arr_gallery_type_data[0]))
			  {
				  return ucfirst($arr_gallery_type_data[0]);
			  }
			  else
			  {
				  return 'Image';
			  }	  
			  
            })
			
			->editColumn('video_id_data', function ($query) {
                
				$str_media_data = $query->media;
				$str_video_id = '';
				
				if($query->type == 2)
				{
				   	$str_video_id = UtilitiesFour::getYoutubeVideoId($str_media_data); 
				}
				else
				{
					$str_video_id = '';
				}
			    
				return $str_video_id;
            })
			
			->editColumn('image_video_data', function ($query) {
                
				$str_media_data = $query->media;
				
				if($query->type == 2)
				{
				    $GetAPI = @GetYoutubeAPI($str_media_data);
                    $thumbnail_data = @$GetAPI['thumbnail']['thumb'];
				}
				else
				{
					$thumbnail_data = $str_media_data;
				}
			    
				return $thumbnail_data;
            })
			
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);				
            })
            ->make();
    }

    public function getDelete($id)
    {

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
			 $message = ['msg' => adminTransLang('success')];
            return response()->json($message, 200);
			//return redirect($main_gallery_url);
            //return successMessage('Gallery Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
		    return errorMessage($e->getMessage(), true);            
        }
    }
	
	public function showAddGallery(Request $request, $gallery_type)
    {
		echo $this->saveAddEditGallery($request, 0, $gallery_type);
	}

    public function showEditGallery(Request $request, $gallery_id, $gallery_type)
    {
        $advertisement = \App\Models\Gallery::find($gallery_id);
        
		echo $this->saveAddEditGallery($request, $gallery_id, $gallery_type);
        
	}	
	
	public function saveAddEditGallery(Request $request, $gallery_id, $gallery_type)
    {
		
		$gallery_id_edit_mode = $gallery_id;
		$error_msg = '';
		$is_known_for = 0;
		
		if ($request->isMethod('post')) 
        {
			
			$destination_id = $request->input('gallery_meta.destination_id');
				// dd($request->all());		 
			 $data = array();
			 $data_media = '';
			 //$gallery_type = 1;
			 
			 $rules = [
			// 'gallery_meta.title' => 'required',
			//'gallery_meta.caption' => 'required',
			'gallery_meta.destination_id' => 'required',
			'select_gallery_user_id' => 'required',
			//'persons' => 'required|array',
			//'products' => 'required|array',			
			];
		
		 if(empty($gallery_id) && ($gallery_type == 1 || $gallery_type == 3))
		 {
			$rules['gallery_image'] =  'required';
		 }
		 
		 if($gallery_type == 2)
		 {
			$rules['gallery_meta.video_url'] =  'required';
		 }
		 
		 if($destination_id == 2)
		 {
			$rules['gallery_meta.assign_product_id'] =  'required'; 
		 }
		 
		 if($destination_id == 3)
		 {
			$rules['gallery_meta.assign_event_id'] =  'required'; 
		 }           		 
		 
		$niceNames = [
			// 'gallery_meta.title' => 'Title',
			'gallery_meta.caption' => 'Caption',
			'gallery_meta.destination_id' => 'Destination',
			'persons' => 'Persons',
			'products' => 'Products',
			'select_gallery_user_id' => 'User',
			'gallery_meta.assign_product_id' => 'Product',
			'gallery_meta.assign_event_id' => 'Event'
		];

		if($gallery_type == 1 || $gallery_type == 3)
		 {
			$niceNames['gallery_image'] =  'Photo';
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
				
				if($gallery_type == 1 || $gallery_type == 3)
				{
					if ($request->hasFile('gallery_image')) 
					{
						// Shubham Code For Image Compression Start //
							$file_comp = $request->gallery_image;
							$extension = $file_comp->getClientOriginalExtension();
							$timestamp = generateFilename();
							$filename = $timestamp . '.' . $extension;
							$file_path = $this->_galleryPhotosFolder;
							$image_comp_size = getimagesize($file_comp);
							$img = \Image::make($file_comp->getRealPath());
							$destinationPath = public_path($file_path);
							if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
								$constraint->aspectRatio();
								})->save($destinationPath.'/'.$filename,50,'jpg')){
		
									$data_media = $filename;
							}else{
								$message = ['msg' => errorMessage('file_uploading_failed')];
								return response()->json($message, 422);			
							}
						// Shubham Code For Image Compression End //
					}	
				}
				
				// for video
				if($gallery_type == 2)
				{
				  $data_media = $request->input('gallery_meta.video_url');	
				}
				
				// for known for 
				if($gallery_type == 3)
				{
				  $is_known_for = 1;
				  $is_known_for = intval($is_known_for);
				  $gallery_type = 1;
				}
								
				$assign_event_id = $request->input('gallery_meta.assign_event_id');
				$assign_product_id = $request->input('gallery_meta.assign_product_id');
				
				$select_gallery_user_id  = $request->input('hidden_gallery_user_id');
				
				if(empty($assign_event_id))
				{
				  $assign_event_id = 0;	
				}
				
				if(empty($assign_product_id))
				{
				  $assign_product_id = 0;	
				}
				
				$data = [
						'title' => $request->input('gallery_meta.title'),
						'caption' => $request->input('gallery_meta.caption'),
						'type' => $gallery_type,					
						'is_known_for' => $is_known_for,
						'destination_id' => $destination_id,
						'assign_product_id' => $assign_product_id,
						'assign_event_id' => $assign_event_id,
						'status' => 1,
						'user_id' => $select_gallery_user_id
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
				 
				 if(!empty($gallery_id))
				  $gallery_data = Gallery::updateOrCreate(['id' => $gallery_id], $data);
				 else
				  $gallery_data = Gallery::create($data); 	 
				// Add Product
				//$product = $this->addProduct($request);
				
		if(!empty($request->persons))
		{
				if(!empty($gallery_data->id))
				{
				   GalleryPersonTag::where('gallery_id', $gallery_data->id)
					->where('user_id', $select_gallery_user_id)
					->update(['status' => 0]);	
				}				
				
			   foreach ($request->persons as $person_data_row) {
				
				$data_person_tag = array();
				
				$chk_person_tag_data = GalleryPersonTag::select('id')
											->where('user_id', $select_gallery_user_id)
											->where('person_id', $person_data_row)
											->where('gallery_id', $gallery_data->id)->first();
				
				$data_person_tag['user_id'] = $select_gallery_user_id;
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
					->where('user_id', $select_gallery_user_id)
					->update(['status' => 0]);	
				}				
				
			   foreach ($request->products as $product_data_row) {
				
				$data_product_tag = array();
				
				$chk_product_tag_data = GalleryProductTag::select('id')
											->where('user_id', $select_gallery_user_id)
											->where('product_id', $product_data_row)
											->where('gallery_id', $gallery_data->id)->first();
				
				$data_product_tag['user_id'] = $select_gallery_user_id;
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
					->where('user_id', $select_gallery_user_id)
					->update(['status' => 0]);	
				}				
				
			   foreach ($request->awards as $award_data_row) {
				
				$data_award_tag = array();
				
				$chk_award_tag_data = GalleryAwardTag::select('id')
											->where('user_id', $select_gallery_user_id)
											->where('award_id', $award_data_row)
											->where('gallery_id', $gallery_data->id)->first();
				
				$data_award_tag['user_id'] = $select_gallery_user_id;
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
					->where('user_id', $select_gallery_user_id)
					->update(['status' => 0]);	
				}				
				
			   foreach ($request->companies as $company_data_row) {
				
				$data_company_tag = array();
				
				$chk_company_tag_data = GalleryCompanyTag::select('id')
											->where('user_id', $select_gallery_user_id)
											->where('company_id', $company_data_row)
											->where('gallery_id', $gallery_data->id)->first();
				
				$data_company_tag['user_id'] = $select_gallery_user_id;
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
				->where('user_id', $select_gallery_user_id)
				->update(['status' => 0]);	
			}				
			
		   foreach ($request->peoples as $people_data_row) {
			
			$data_people_tag = array();
			
			$chk_people_tag_data = GalleryPeopleTag::select('id')
										->where('user_id', $select_gallery_user_id)
										->where('people_id', $people_data_row)
										->where('gallery_id', $gallery_data->id)->first();
			
			$data_people_tag['user_id'] = $select_gallery_user_id;
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
					->where('user_id', $select_gallery_user_id)
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
											->where('user_id', $select_gallery_user_id)
											->where('tag', $other_data_row)
											->where('gallery_id', $gallery_data->id)->first();
				
				$data_other_tag['user_id'] = $select_gallery_user_id;
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
		
		$arr_destinations_list = $this->_arr_destinations_list;		
		$arr_destinations_list_keys = array_keys($arr_destinations_list);
		
		$arr_event_product_data = $this->getEventProductData(0);
		   
		$user_product_data = $arr_event_product_data[0];
	    $user_event_data = $arr_event_product_data[1];
	    $category_list = $arr_event_product_data[2];
	    $person_list = $arr_event_product_data[3];
	    $product_list = $arr_event_product_data[4];
	    $award_list = $arr_event_product_data[5];
	    $company_list = $arr_event_product_data[6];
        $people_list = $arr_event_product_data[7];		
    		
		$gallery_data = '';
		$gallery_user_id = 0;
		$int_assign_product_id = 0;
		$int_assign_event_id = 0;
		$str_media_data = '';
		$int_destination_id = 0;
		$str_title = '';
		$str_caption = '';
		$str_url = '';
		$str_others = '';
		$arr_products = array();
		$arr_persons = array();
		$arr_others = array();
		$arr_companies = array();
		$arr_peoples = array();
				
        if(empty($gallery_id))
		{
		   	$gallery_id = 0;
		}
		else
		{
			
	    $query = Gallery::select('galleries.*')->with(['gallery_product_tags' => function($gallery_product_tags) {
            
            $gallery_product_tags->where('status', 1); 			
 			$gallery_product_tags->with('productdata');
	
		}, 'gallery_company_tags' => function($gallery_company_tags) {
            
			$gallery_company_tags->where('status', 1);
			$gallery_company_tags->with('companydata');
			
         }, 'gallery_people_tags' => function($gallery_people_tags) {
            
			$gallery_people_tags->where('status', 1);
			$gallery_people_tags->with('peopledata');
			
         },
		 'gallery_other_tags' => function($gallery_other_tags) {
            
			$gallery_other_tags->where('status', 1);
         
		 }, 'gallery_person_tags' => function($gallery_person_tags) {
            
			$gallery_person_tags->where('status', 1);
			$gallery_person_tags->with('persondata');
			
         }, 'gallery_award_tags' => function($gallery_award_tags) {
            
			$gallery_award_tags->where('status', 1);
			$gallery_award_tags->with('awarddata');
			
         }, 'gallery_products' => function($gallery_products){
			  
         }, 'gallery_users' => function($gallery_users){
			
         }]);
		 
		   $query->where('galleries.id', $gallery_id);		   
		   
		   $gallery_data =  $query->first();
		   
			$gallery_user_id = $gallery_data->user_id;
			$int_assign_product_id = $gallery_data->assign_product_id;
			$int_assign_event_id = $gallery_data->assign_event_id;
			$str_media_data = $gallery_data->media;
			$int_destination_id = $gallery_data->destination_id;
			$str_title = $gallery_data->title;
			$str_caption = $gallery_data->caption;
			$str_url = $gallery_data->url;
			$is_known_for = $gallery_data->is_known_for;
					
			if(is_object($gallery_data->gallery_product_tags))
		    {
			   
			   foreach($gallery_data->gallery_product_tags as $gallery_data_product_tag_row)
			   {
				   
				 if(!empty($gallery_data_product_tag_row->productdata->id))
				 {
				   $arr_products[$gallery_id][] = $gallery_data_product_tag_row->productdata->id;
				   
				 }			   
			   }					   
		    }
				   
			   if(is_object($gallery_data->gallery_person_tags))
			   {
				   
				   foreach($gallery_data->gallery_person_tags as $gallery_data_person_tag_row)
				   {
					   
					 if(!empty($gallery_data_person_tag_row->persondata->id))
					 {
						 $arr_persons[$gallery_id][] = $gallery_data_person_tag_row->persondata->id;
						  
					 }
						  
				   }					   
			   }
			   
			   if(is_object($gallery_data->gallery_company_tags))
			   {
				   
				   foreach($gallery_data->gallery_company_tags as $gallery_data_company_tag_row)
				   {
					   
					 if(!empty($gallery_data_company_tag_row->companydata->id))
					 {
					   $arr_companies[$gallery_id][] = $gallery_data_company_tag_row->companydata->id;
					 }			   
				   }					   
			   }

              if(is_object($gallery_data->gallery_people_tags))
			   {
				   
				   foreach($gallery_data->gallery_people_tags as $gallery_data_people_tag_row)
				   {
					   
					 if(!empty($gallery_data_people_tag_row->peopledata->id))
					 {
					   $arr_peoples[$gallery_id][] = $gallery_data_people_tag_row->peopledata->id;
					 }			   
				   }					   
			   }			   
			   
			   if(is_object($gallery_data->gallery_other_tags))
			   {
				   foreach($gallery_data->gallery_other_tags as $gallery_data_other_tag_row)
				   {
					  if(!empty($gallery_data_other_tag_row->tag))
					 {
					   $arr_others[$gallery_id][] = $gallery_data_other_tag_row->tag;
					   $str_others = implode(",", $arr_others[$gallery_id]);
					 } 
				   }
			   }
			
		}		
		
        $users_list = User::get_all_user_list_by_email_name();		
		
		$folder_path = $this->_galleryPhotosFolder;
		
	    return view('admin.galleries.add_update_gallery', 
		['arr_destinations_list' => $arr_destinations_list, 'user_product_data' => $user_product_data, 'int_destination_id' => $int_destination_id,
'user_event_data' => $user_event_data, 'category_list' => $category_list, 'int_assign_product_id' => $int_assign_product_id, 'str_title' => $str_title, 'str_others' => $str_others,
'person_list' => $person_list, 'product_list' => $product_list, 'arr_destinations_list_keys' => $arr_destinations_list_keys, 'folder_path' => $folder_path,
'award_list' => $award_list, 'company_list' => $company_list, 'users_list' => $users_list, 'int_assign_event_id' => $int_assign_event_id, 'str_media_data' => $str_media_data,	
		'gallery_data' => $gallery_data, 'gallery_id' => $gallery_id, 'gallery_type' => $gallery_type, 'gallery_user_id' => $gallery_user_id, 'str_caption'	=> $str_caption, 'is_known_for' => $is_known_for,
        'arr_others' => $arr_others, 'arr_companies' => $arr_companies, 'arr_peoples' => $arr_peoples, 'arr_persons' => $arr_persons, 'arr_products' => $arr_products, 'str_url' => $str_url, 'people_list' => $people_list ]);
	
	}
	
	public function getUserProductEvents(Request $request)
    {
		$hidden_gallery_user_id =  $request->hidden_gallery_user_id;
		$data_type = $request->data_type;
		$int_assign_product_id = $request->int_assign_product_id;
		$int_assign_event_id = $request->int_assign_event_id;
		
		$arr_event_product_data = $this->getEventProductData($hidden_gallery_user_id);
		   
		$user_product_data = $arr_event_product_data[0];
	    $user_event_data = $arr_event_product_data[1];
		
        return view('admin.galleries.get_event_product_dropdown', ['int_assign_event_id' => $int_assign_event_id, 'int_assign_product_id' => $int_assign_product_id, 'user_product_data' => $user_product_data, 'user_event_data' => $user_event_data, 'data_type'=>$data_type]);
    }

}
