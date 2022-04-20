<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\AdvertisementPosition;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use Carbon\Carbon;
use DB;
use Session;

class AdvertisementController extends Controller
{
	
	 public function __construct()
    {
		$this->_adsPhotosFolder = Utilities::get_ads_upload_folder_path();        
	}
	
    public function getIndex($is_default, $category_id)
    {
		$advertisement_category = AdvertisementCategory::pluck('category', 'id');
		
        return view('admin.advertisements.index', ['category_id' => $category_id, 'is_default' => $is_default, 'advertisement_category' => $advertisement_category]);
    }
	
    public function getList($is_default, $category_id)//, $category_id
    {
        $advertisements = \App\Models\Advertisement::select(['advertisements.id', 'advertisements.title', 'ap.name as advertisement_position_new', 'ac.category as advertisement_category_name', 'advertisements.advertisement_image', 'advertisements.from_date','advertisements.to_date','advertisements.no_of_clicks', 'advertisements.is_default as is_default_new', 'advertisements.is_default as is_default_flag',  'advertisements.status', 'advertisements.created_at']);
        
		$advertisements->leftJoin('advertisement_positions as ap', 'ap.id', '=', 'advertisements.advertisement_position');
		$advertisements->leftJoin('advertisement_categories as ac', 'ac.id', '=', 'advertisements.advertisement_category');
		
		if(empty($is_default))
		{
		   $is_default = 0;			   	
		}
		
		$advertisements->where('advertisements.is_default', $is_default);
		
        if(empty($category_id))
		{        
	       $category_id = 0;		   		
		}
		
		if(!empty($category_id))
		{
		   $advertisements->where('advertisements.advertisement_category', $category_id);	
		}
		
		return \DataTables::of($advertisements)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
           ->editColumn('from_date', function ($query) {
                if(!empty($query->is_default))
				  return "";
			    else
				  return $query->from_date;	
            })
            ->editColumn('to_date', function ($query) {
                if(!empty($query->is_default))
				  return "";
			    else
				  return $query->to_date;	
            })			
			->editColumn('is_default_new', function ($query) {
                if(!empty($query->is_default_new))
				  return "Yes";
			    else
				  return "No";	
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
		$advertisement = \App\Models\Advertisement::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddAdvertisement(Request $request, $chk_is_default)
    {
		echo $this->saveAddEditAdvertisement($request, 0, $chk_is_default);
	}

    public function showEditAdvertisement(Request $request, $advertisement_id, $chk_is_default)
    {
        $advertisement = \App\Models\Advertisement::find($advertisement_id);
        
		echo $this->saveAddEditAdvertisement($request, $advertisement_id, $chk_is_default);
        
	}	
	
	public function saveAddEditAdvertisement(Request $request, $advertisement_id, $chk_is_default)
    {
		
		$advertisement_id_edit_mode = $advertisement_id;
		$error_msg = '';
		
		if ($request->isMethod('post')) 
        {
          // pre($request->all('add_edit_profile_role'),1);
			$rules = [
				'title' => 'required',
				'destination_link' => 'required',
                'advertisement_position' => 'required',
                'advertisement_category' => 'required',    				
            ];
			
			if(empty($chk_is_default))
			{
			   $rules['from_date'] = 'required';
			   $rules['to_date'] = 'required';
               $rules['sponsor_name'] = 'required';			   
			}
			
			if(empty($advertisement_id))
			{
			   $rules['advertisement_image'] = 'required';	
			}
			
    	    $niceNames = array();     
            $this->validate($request, $rules, [], $niceNames);
    			 
			try 
            {
				// Start Transaction
				\DB::beginTransaction();

				if(!empty($advertisement_id))
				{
				   $advertisement = \App\Models\Advertisement::find($advertisement_id);
				   $advertisement->updated_at = new \DateTime();
				}
				else
				{
				   $advertisement = new \App\Models\Advertisement();
                   $advertisement->status = 1; 
                   $advertisement->no_of_clicks = 0;   				   
				}				
				
				$advertisement->title =  $request->title;
				$advertisement->home_caption_one =  $request->home_caption_one;
				$advertisement->home_caption_two =  $request->home_caption_two;
				
				$advertisement->is_default =  $request->is_default;
				$advertisement->type =  $request->type;				
				$from_date = $request->from_date;
				$to_date =  $request->to_date;
				$str_sponsor_name =  $request->sponsor_name;
				
				if(!empty($str_sponsor_name))
				{
				   $advertisement->sponsor_name = $str_sponsor_name;	
				}
				
				if(empty($from_date))
				{
				   $advertisement->from_date =  null;	
				}
				else
				{
				   $advertisement->from_date =  $from_date;	
				}
				
				if(empty($to_date))
				{
				   $advertisement->to_date =  null;	
				}
				else
				{
				   $advertisement->to_date =  $to_date;	
				}
				   
				$int_advertisement_position = $request->advertisement_position;
				$advertisement->advertisement_position =  $int_advertisement_position;
				
				$int_advertisement_category = $request->advertisement_category;
				$advertisement->advertisement_category =  $int_advertisement_category;
				
				
				$adv_chk_dup_data = Advertisement::select('id')->where('is_default', $chk_is_default)->where('advertisement_position', $int_advertisement_position)->where('advertisement_category', $int_advertisement_category)->first();
				
				if(empty($advertisement_id))
				{
				
					if(!empty($adv_chk_dup_data) && $adv_chk_dup_data->id)
					{
						$error_msg = 'Advertisement already exists in this Category and Position. Please Select a different Category and Position';
						$message_new = ['msg' => errorMessage($error_msg)];
						return response()->json($message_new, 422);
					}
					
				}
								
				$advertisement->destination_link =  $request->destination_link;								
				
				if ($request->hasFile('advertisement_image')) {
						
					$banner_width_hidden = $request->banner_width_hidden;				
					$banner_width_hidden = intval($banner_width_hidden);				
					$banner_height_hidden = $request->banner_height_hidden;
					$banner_height_hidden = intval($banner_height_hidden);
					
					$adv_pos_orig_data = AdvertisementPosition::select('from_width', 'to_width', 'from_height', 'to_height')->where('id', $int_advertisement_position)->first();
					
					$adv_pos_data = AdvertisementPosition::select('id')
						->where(function ($query) use ($banner_width_hidden) {
						 $query->where('from_width', '<=', $banner_width_hidden);
						 $query->where('to_width', '>=', $banner_width_hidden);
						})
						->where(function ($query) use ($banner_height_hidden) {
						 $query->where('from_height', '<=', $banner_height_hidden);
						 $query->where('to_height', '>=', $banner_height_hidden);
						})
						->where('id', $int_advertisement_position)
						->first();
					
					if(!empty($adv_pos_data) && $adv_pos_data->id)
					{
						
					}
					else
					{
						
						$error_msg = 'Please Select an Image of width between '. $adv_pos_orig_data->from_width . ' and ' . $adv_pos_orig_data->to_width . ', height between '. $adv_pos_orig_data->from_height . ' and '. $adv_pos_orig_data->to_height;
						$message_new = ['msg' => errorMessage($error_msg)];
						return response()->json($message_new, 422);	
					}
					
					// Shubham Code For Image Compression Start //
						$file_comp = $request->advertisement_image;
						$image_comp_size = getimagesize($file_comp);
						$extension = $file_comp->getClientOriginalExtension();
						$timestamp = generateFilename();
						$filename = $timestamp . '_advertisements_' . '.' . $extension;
						$file_path = $this->_adsPhotosFolder;
						$img = \Image::make($file_comp->getRealPath());
						$destinationPath = public_path($file_path);
						if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
							$constraint->aspectRatio();
							})->save($destinationPath.'/'.$filename,50,'jpg')){

							$advertisement->advertisement_image = $filename;
						}else{
							throw new \Exception(errorMessage('file_uploading_failed'));
						}
					// Shubham Code For Image Compression End //
				}
				
				$advertisement->created_at = new \DateTime();			    
				
				$advertisement->save();
				$advertisement_id = $advertisement->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('advertisement_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$advertisement = \App\Models\Advertisement::find($advertisement_id);		
		$advertisement_position = AdvertisementPosition::pluck('name', 'id');
		$advertisement_category = AdvertisementCategory::pluck('category', 'id');
		
	    return view('admin.advertisements.add_update_advertisement', ['advertisement_category' => $advertisement_category, 'advertisement_position' => $advertisement_position, 'advertisement' => $advertisement, 'advertisement_id' => $advertisement_id, 'chk_is_default' => $chk_is_default]);	
    }

}