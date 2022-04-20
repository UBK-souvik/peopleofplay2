<?php

namespace App\Http\Controllers\Front;

use App\Models\BrandList;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\BrandListOther;
use App\Models\BrandListVideo;
use Illuminate\Http\Request;
use App\Models\BrandListBuyFrom;
use App\Models\BrandListGallery;
use App\Models\BrandListStatistic;
use App\Models\BrandListSocialMedia;
use Illuminate\Support\Facades\DB;
use App\Models\BrandListCollaborator;
use App\Models\BrandListOfficialLink;
use App\Http\Controllers\Controller;
use App\Models\MetaData;
use App\Models\BrandListCommunityStat;
use App\Models\BrandListClassification;
use App\Models\BrandListAdditionalSuggestion;
use App\Models\BrandListCategory;
use App\Models\BrandListGalleryMetaData;
use App\Models\User;
use App\Models\Role;
use App\Helpers\Utilities;
use Session;
use File;
use App\Helpers\UtilitiesTwo;

class BrandListController extends Controller
{
	
	protected $_collaboratorPhotosFolder;
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->_collaboratorPhotosFolder = Utilities::get_collaborator_upload_folder_path();
        $this->_brandsPhotosFolder = Utilities::get_brands_upload_folder_path();		
	}

    public function getIndex()
    {
        $current_user = get_current_user_info();
        // pr($current_user,1);
        $brands_list = BrandList::where('user_id', $current_user->id)
            ->orderBy('sr_no', 'asc')
            ->paginate(30);

        return view('front.user.brand_list.index', compact('brands_list'));
    }

    public function getBrandListCreate()
    {

        $current_user = get_current_user_info();
        BrandListCollaborator::where(['brand_list_id' => '0','user_id' => $current_user->id])->delete();
    	$slug = '';
        $category = Category::pluck('category_name', 'id');
		$user = get_current_user_info();
        return view('front.user.brand_list.add', compact('category','slug', 'user'));
    }


    public function postBrandListCreate(Request $request)
    {
        // pr($request->all(),1);	die;	
		//$request->validate(BrandList::validateBrandList());	
		
		$rules = [
		    'brand_list_id' => 'nullable|exists:brand_lists,id',
            'socials.*' => 'sometimes|nullable|url',
            'official_links.*' => 'sometimes|nullable|url',
            'brand_list.brand_list_id_number' => 'required',
            // 'brand_list.user_id' => 'required',
            'brand_list.name' => 'required',
            //'brand_list.brand' => 'required',
            //'brand_list.company' => 'required',
            'brand_list.group_id' => 'required',
            // 'brand_list.ratings' => 'required',
            // 'brand_list.buy' => 'required',
            'brand_list.description' => 'required',
            'gallery' => 'array',
            'gallery.*' => 'file',
            // 'classification' => 'required',
            'category1' => 'required',
            //'sub_category1' => 'required',
            // 'categories' => 'required|array',
            // 'classification.category_id' => 'required|exists:categories,id',
            // 'classification.sub_category' => 'required|exists:categories,id',
            // 'classification.toy_type' => 'required',
            //'classification.inventor' => 'required',
            // 'classification.team' => 'required',
            // 'classification.launched' => 'required',
            //'buy_from.*.type' => 'required',
            // // 'buy_from.*.suggested_retail' => 'required',
            // 'buy_from.*.ebay' => 'required',
            //'buy_from.*.ebay' => 'sometimes|nullable|url',
            //'buy_from.*.amazon' => 'required|nullable|url',
			//'buy_from.*.amazon_caption' => 'required',
            //'buy_from.*.pop' => 'sometimes|nullable|url',
            // 'buy_from.*.pop' => 'required',

            /*'collaborator.image' => 'required_without:brand_list_id|array',
            'collaborator.name' => 'required|array',
            'collaborator.role' => 'required|array',*/
            
            // 'community_stats.own' => 'required',
            // 'community_stats.for_trade' => 'required',
            // 'community_stats.wishlist' => 'required',
            // 'community_stats.want_it_trade' => 'required',
            // 'community_stats.has_part' => 'required',
            // 'community_stats.wants_part' => 'required',
            
            // 'stats.rating' => 'required',
            // 'stats.page_views' => 'required',
            // 'stats.standard_deviation' => 'required',
            // 'stats.number_of_ratings' => 'required',
            // 'stats.overall_rank' => 'required',
            // 'stats.all_time_plays' => 'required',
            // 'stats.party_rank' => 'required',
            // 'stats.this_month' => 'required',
            // 'stats.own' => 'required',
            // 'stats.for_trade' => 'required',
            // 'stats.wishlist' => 'required',
            // 'stats.previously_owned' => 'required',
            // 'stats.want_it_trade' => 'required',
            // 'stats.has_part' => 'required',
            // 'stats.wants_part' => 'required',
            // 'stats.comments' => 'required',            
            'other.in_depth_review',
            // 'other.ratings',
            // 'other.forum',
            // 'other.forum_categories'			
        ];

        if ($request->hasFile('main_image')){
           $rules['main_image'] =  'max:2048'; 
        } 
    	
         
    	$niceNames = [
    		'brand_list_id' => 'BrandList Id',
                'brand_list' => 'BrandList',
                'brand_list.brand_list_id_number' => 'BrandList Id',
                // 'brand_list.user_id' => 'required',
                'brand_list.name' => 'BrandList Name',
                'brand_list.brand' => 'Brand',
                'brand_list.company' => 'Company',
				'brand_list.launched_date' => 'Launched',				
                'brand_list.group_id' => 'Group',
                // 'brand_list.ratings' => 'required',
                // 'brand_list.buy' => 'required',
                'brand_list.description' => 'Description',
                // 'classification' => 'required',
                'category1' => 'Primary Category',
                //'sub_category1' => 'Primary Sub Category',
                // 'categories' => 'required|array',
                // 'classification.category_id' => 'required|exists:categories,id',
                // 'classification.sub_category' => 'required|exists:categories,id',
                // 'classification.toy_type' => 'required',
                //'classification.inventor' => 'Inventor',
                // 'classification.team' => 'required',
                // 'classification.launched' => 'required',
                'buy_from.*.type' => 'Buy From Type',
                // // 'buy_from.*.suggested_retail' => 'required',
                // 'buy_from.*.ebay' => 'required',
                'buy_from.*.amazon' => 'Buy From Amazon',
                // 'buy_from.*.pop' => 'required',

                /*'collaborator.image' => 'required_without:brand_list_id|array',
                'collaborator.name' => 'required|array',
                'collaborator.role' => 'required|array',*/
                
                // 'community_stats.own' => 'required',
                // 'community_stats.for_trade' => 'required',
                // 'community_stats.wishlist' => 'required',
                // 'community_stats.want_it_trade' => 'required',
                // 'community_stats.has_part' => 'required',
                // 'community_stats.wants_part' => 'required',
                
                // 'stats.rating' => 'required',
                // 'stats.page_views' => 'required',
                // 'stats.standard_deviation' => 'required',
                // 'stats.number_of_ratings' => 'required',
                // 'stats.overall_rank' => 'required',
                // 'stats.all_time_plays' => 'required',
                // 'stats.party_rank' => 'required',
                // 'stats.this_month' => 'required',
                // 'stats.own' => 'required',
                // 'stats.for_trade' => 'required',
                // 'stats.wishlist' => 'required',
                // 'stats.previously_owned' => 'required',
                // 'stats.want_it_trade' => 'required',
                // 'stats.has_part' => 'required',
                // 'stats.wants_part' => 'required',
                // 'stats.comments' => 'required',            
                'other.in_depth_review',
                // 'other.ratings',
                // 'other.forum',
                // 'other.forum_categories'	
        ];
    	
    	 $name = [
                    'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address',
                    'official_links.*' => 'Official Links URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.amazon.url'   => 'Buy From amazon URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.ebay.url'     => 'Buy From ebay URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.pop.url'      => 'Buy From pop URL format is Invalid. Please enter full https:// address',
                ]; 
       $this->validate($request, $rules, $name, $niceNames);		
            try {
                $current_user = get_current_user_info();

                DB::beginTransaction();

                // Add BrandList
                $brand_list = $this->addBrandList($request);

                // TODO: Add Gallery
                if ($request->hasFile('gallery')) {
                    $this->addGallery($request, $brand_list->id);
                }

                // Add Classification
                $classification_data = $request->classification;
                $classification_data['user_id'] = $current_user->id;
                $classification_data['brand_list_id'] = $brand_list->id;
                
				BrandListClassification::updateOrCreate(['brand_list_id' => $brand_list->id], $classification_data);

                // Add Additional Suggestion
                // $additional_suggestion = $request->additional_suggestion;
                // $additional_suggestion['user_id'] = $current_user->id;
                // $additional_suggestion['brand_list_id'] = $brand_list->id;
                // BrandListAdditionalSuggestion::insert($additional_suggestion);

                // Add BuyFrom
                foreach ($request->buy_from as $buy_from) {
                    $buy_from['user_id'] = $current_user->id;
                    $buy_from['brand_list_id'] = $brand_list->id;
                    BrandListBuyFrom::updateOrCreate(['brand_list_id' => $brand_list->id], $buy_from);
                }

                // Add Categories

                // Add Categories
                BrandListCategory::where('brand_list_id', $brand_list->id)->delete();
                $category_data = array(
                    'user_id' => @$brand_list->user_id,
                    'brand_list_id' => @$brand_list->id,
                    'category_id' => $request->category1,
                    'sub_category_id' => $request->sub_category1,
                );
                BrandListCategory::insert($category_data);

                if(!empty($request->category2)){// && !empty($request->sub_category2)
                    $category_data['category_id'] = $request->category2;
                    //$category_data['sub_category_id'] = $request->sub_category2;
                    BrandListCategory::insert($category_data);
                }

                if(!empty($request->category3)){// && !empty($request->sub_category3)
                    $category_data['category_id'] = $request->category3;
                    //$category_data['sub_category_id'] = $request->sub_category3;
                    BrandListCategory::insert($category_data);
                }
            
                // $categories = array_map(function ($data) use ($current_user, $product) {
                //     return [
                //         'user_id' => $current_user->id,
                //         'category_id' => $data,
                //         'brand_list_id' => $brand_list->id
                //     ];
                // }, $request->categories);

                // BrandListCategory::where('brand_list_id', $brand_list->id)->delete();
                // BrandListCategory::insert($categories);


                // Add Collaborators
                $update_collaborator = ['brand_list_id' => $brand_list->id,'user_id' => $brand_list->user_id];
                $where_collaborator  = ['brand_list_id' => '0','user_id' => $current_user->id];
                BrandListCollaborator::where($where_collaborator)->update($update_collaborator);

            // Add Official Link
            $officials = collect($request->official_links)->map(function ($link) use ($brand_list, $current_user) {

                return [
                    'user_id' => $current_user->id,
                    'brand_list_id' => $brand_list->id,
                    'value' => $link
                ];
            })
                ->filter(function ($data) {
                    return $data['value'] !== null;
                });
            // dd($officials);
            BrandListOfficialLink::where('brand_list_id', $brand_list->id)->delete();
            BrandListOfficialLink::insert($officials->toArray());

            // Add Video
            $videos = collect($request->official_links)->map(function ($link) use ($brand_list, $current_user) {
                return [
                    'user_id' => $current_user->id,
                    'brand_list_id' => $brand_list->id,
                    'value' => $link
                ];
            });
            BrandListVideo::where('brand_list_id', $brand_list->id)->delete();
            BrandListVideo::insert($videos->toArray());

            // Add Socials
            /*if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    if (!is_null($socials)) {
                        $social_media =  BrandListSocialMedia::where('user_id', $current_user->id)
                            ->where('type', $key)
                            ->first();
                        if (!$social_media) {
                            $social_media = new BrandListSocialMedia();
                            $social_media->user_id = $current_user->id;
                            $social_media->brand_list_id = $brand_list->id;
                        }
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    }
                }
            }*/
			
			if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
					$social_media =  BrandListSocialMedia::where('user_id', $current_user->id)
                            ->where('brand_list_id', $brand_list->id)
							->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\BrandListSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new BrandListSocialMedia();
						}	
						
						$social_media->user_id = $brand_list->user_id;
                        $social_media->brand_list_id = $brand_list->id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();                    
                }
            }

            // Add BrandList Stats
            $stats = $request->stats;
            $stats['user_id'] = $current_user->id;
            $stats['brand_list_id'] = $brand_list->id;
            BrandListStatistic::updateOrCreate(['brand_list_id' => $brand_list->id], $stats);


            // Add Others
            $other = $request->other;
            $other['user_id'] = $current_user->id;
            $other['brand_list_id'] = $brand_list->id;
            BrandListOther::updateOrCreate(['brand_list_id' => $brand_list->id], $other);

            DB::commit();
            return successMessage('Brand Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getUpdate($slug)
    {
        //$product = BrandList::where('slug', $slug)->firstOrFail();
		
		$brand_list = BrandList::where('slug', $slug)
            ->with([
                'buyFrom',
				'collaborators'
            ])
            ->firstOrFail();
		
        $category = Category::pluck('category_name', 'id');
		$collaborator_photos_folder = $this->_collaboratorPhotosFolder;
		
		$user = get_current_user_info();

        return view('front.user.brand_list.add', compact('user', 'brand_list', 'category','slug','collaborator_photos_folder'));
    }

    public function getDelete($slug)
    {
        //BrandList::where('slug', $slug)->firstOrFail()->delete();
		
		try {

            DB::beginTransaction();
			
			$brand_list = BrandList::where('slug', $slug)->firstOrFail();
			
			$file_path = Utilities::get_brands_upload_folder_path();
			$image_path = public_path($file_path . $brand_list->main_image);
			
			if(file_exists($image_path)) {
				File::delete($image_path);
			}
			
			BrandListSocialMedia::where('brand_list_id', $brand_list->id)->delete();
			BrandListClassification::where('brand_list_id', $brand_list->id)->delete();
			BrandListCollaborator::where('brand_list_id', $brand_list->id)->delete();
			BrandListOfficialLink::where('brand_list_id', $brand_list->id)->delete();
			BrandListCategory::where('brand_list_id', $brand_list->id)->delete();
			BrandListBuyFrom::where('brand_list_id', $brand_list->id)->delete();
			BrandListOther::where('brand_list_id', $brand_list->id)->delete();
			BrandListStatistic::where('brand_list_id', $brand_list->id)->delete();
			BrandListVideo::where('brand_list_id', $brand_list->id)->delete();
			BrandList::where('id', $brand_list->id)->delete();
			
			DB::commit();
			Session::flash('brand_data_deleted_flag', 1);
			
        } catch (\Exception $e) {
            DB::rollback();
            
			Session::flash('brand_data_deleted_flag', 0);
        }
		
		return redirect()->route('front.user.brand.index');
		
    }


    // Private Methods

    private function addGallery($request, $brand_list_id)
    {
        $current_user = get_current_user_info();
        foreach ($request->gallery as $gallery) {
            $data = [];
            $file = $gallery;
            $extension = $file->getClientOriginalExtension();
            $timestamp = generateFilename();
            $filename = $timestamp . '.' . $extension;
            $file_path = imagePath();
            $upload_status = $file->move($file_path, $filename);
            if ($upload_status) {
                $data = [
                    'title' => $filename,
                    'user_id' => $current_user->id,
                    'brand_list_id' => $brand_list_id
                ];
            } else {
                // Rollback Transaction
                DB::rollBack();

                $message = ['msg' => errorMessage('file_uploading_failed')];
                return response()->json($message, 422);
            }
            $product_gallery = BrandListGallery::create($data);
            if ($request->has('gallery_meta')) {
                $meta_data = $request->gallery_meta;
                $meta_data['gallery_id'] = $product_gallery->id;
                // dd($meta_data);
                MetaData::create($meta_data);
            }
        }

        // return BrandListGallery::insert($data);
        return true;
    }

    private function addBrandList($request)
    {
        $current_user = get_current_user_info();
        $brand_list_data = $request->brand_list;
        $brand_list_data['user_id'] = $current_user->id;
        // pr($product_data,1);        
        if ($request->hasFile('main_image')) {
           // $file = $request->main_image;
           // $extension = $file->getClientOriginalExtension();
			//$extension = UtilitiesTwo::get_image_ext_name();
           // $timestamp = generateFilename();
			
			$filename = $request->crop_img;
			//$file_path = imagePath();
			//$file_path = $request->crop_img;
			//$upload_status = $file->move($file_path, $filename);
			//$upload_status = $file->move(public_path($file_path), $filename);				
            //$filename = $timestamp . '.' . $extension;
            //$file_path = imagePath();
            //$upload_status = $file->move($file_path, $filename);
			//$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
            
			//if ($upload_status) {
                $brand_list_data['main_image'] = $filename;
            // } else {
            //     // Rollback Transaction
            //     DB::rollBack();

            //     $message = ['msg' => errorMessage('file_uploading_failed')];
            //     return response()->json($message, 422);
            // }
        }
        return BrandList::updateOrCreate(['id' => $request->brand_list_id], $brand_list_data);
    }

    public function collaborator_AddEdit(Request $request )
    {
        $request->validate([        
            'collab_user_name' => 'required',
            'collab_user_role' => 'required',
        ]);   

        $current_user = get_current_user_info();
        $brand_list = BrandList::where('id', $request->brand_list_id)->first();
        $brand_list_id = (!empty($request->brand_list_id)) ? $request->brand_list_id : '0' ;
        $user_id = (!empty($brand_list->user_id)) ? $brand_list->user_id : $current_user->id ;

    	/*if ($request->hasFile('collab_user_image')) {
            $file = $request->collab_user_image;
			$extension = $file->getClientOriginalExtension();
			$timestamp = generateFilename();
			$filename = $timestamp . '.' . $extension;
			$file_path = $this->_collaboratorPhotosFolder;

			$upload_status = $file->move(public_path($file_path), $filename);
			if ($upload_status) {
				$collaborators['image'] = $filename;
			} else {
				throw new \Exception(errorMessage('file_uploading_failed'));
			}	
		}
		else if(!empty($request->collab_hidden_user_image))
		{
		   $collaborators['image'] = $request->collab_hidden_user_image;	
		}
		else
		{
			$collaborators['image'] = '';
		}*/
		
		$int_people_id = $request->input('collab_user_id_hidden');
		
		if(!empty($int_people_id))
		{
			$collaborators['people_id'] = $int_people_id;
		}
		else
		{
		    $collaborators['name'] = $request->collab_user_name;	
		}

		$collaborators['user_id'] = $user_id;
		$collaborators['brand_list_id'] = $brand_list_id;
		
		$collaborators['role'] = $request->collab_user_role;
		$collaborators['created_at'] =  new \DateTime();
		$collaborators['updated_at'] =  new \DateTime();

		// BrandListCollaborator::where('brand_list_id', $request->brand_list_id)->delete();
		$where = array('brand_list_id' => $brand_list_id,'id' => $request->collaboration_id);
		$role_data = BrandListCollaborator::updateOrCreate($where, $collaborators);
		
		$get_people_data =  User::get_people_name_by_id($role_data->people_id);
		
		if(!empty($get_people_data->id))
		{
			$str_people_name = $get_people_data->people_name;
		}
		else
		{
			$str_people_name = $role_data->name;
		}
		
		$str_profile_image = @imageBasePath($role_data->collaboratorData->profile_image);
		
		//print_r($role_data->collaboratorData);exit;

		if($role_data){
            foreach(users_user_roles() as $key => $value){
                if(@$role_data->role == $key){
                    $user_role = $value;
                }
            }
			
			/* <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td>
                <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td>
                                                

						*/

            $url = "/user/brand/collaborator/delete/".$role_data->id;
            if(!empty($request->collaboration_id) && $request->collaboration_id == $role_data->id){
                $html ='<td class="verticalalign text-left pl-0">'.$str_people_name.'</td>
                        <td class="verticalalign text-left pl-0">'.$user_role.'</td>
                        <td class="verticalalign text-left pl-0">
                          <span class="table-edit">
                              <a href="#" class="span-style1 my-0 edit-role-popup-class" data-user_role="'.$role_data->role.'" data-people_name="'.$str_people_name.'" data-people_id="'.$role_data->people_id.'" data-user_name="'.$role_data->name.'" data-user_image="'.$this->_collaboratorPhotosFolder.$role_data->image.'" data-hidden_user_image="'.$role_data->image.'" data-collaboration_id="'.$role_data->id.'" >Edit</a>
                          </span>
                        </td>
                        <td class="verticalalign text-left">
                          <span class="table-delete">
                            <a href="#" class="text-danger my-0" onclick="return deleteCollaboratorModal('.$role_data->id.');">Delete</a>
                          </span>
                        </td>';
                // pre($html,1);
                return json_encode(['status' => true, 'html' => $html]);
            }
            $url = "/user/brand/collaborator/delete/".$role_data->id;
            $html ='<tr class="" id="row_'.$role_data->id.'">
                        <td class="verticalalign text-left pl-0">'.$str_people_name.'</td>
                        <td class="verticalalign text-left pl-0">'.$user_role.'</td>
                        <td class="verticalalign text-left pl-0">
                          <span class="table-edit">
                              <a href="#" class="span-style1 my-0 edit-role-popup-class" data-user_role="'.$role_data->role.'" data-people_name="'.$str_people_name.'" data-people_id="'.$role_data->people_id.'" data-user_name="'.$role_data->name.'" data-user_image="'.$this->_collaboratorPhotosFolder.$role_data->image.'" data-hidden_user_image="'.$role_data->image.'" data-collaboration_id="'.$role_data->id.'" >Edit</a>
                          </span>
                        </td>
                        <td class="verticalalign text-left">
                          <span class="table-delete">
                            <a href="#" class="text-danger my-0" onclick="return deleteCollaboratorModal('.$role_data->id.');">Delete</a>
                          </span>
                        </td>
                    </tr>';
            return json_encode(['status' => true, 'html' => $html]);
			return successMessage('collaborator Saved');
		} else {
			return errorMessage('collaborator not saved');
		}
    }

    public function collaborator_delete(Request $request)
    {
        BrandListCollaborator::where('id', $request->id)->delete();
        return json_encode(['status' => true, 'data' => $request->id]);
    }

    public function get_sub_category(Request $request)
    {
        $id = $request->id;
        $sub_category  = SubCategory::where('category_id',$id)->get();

        $html = '<option value="">Select Sub Category</option>';
        foreach ($sub_category as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->sub_category.'</option>';
        }
        return $html;
        return json_encode(['status' => true, 'html' => $html]);
    }

    public function update_sequence(Request $request)
    {
        foreach ($request->brand_list_id ?? [] as $key => $value) {
            if($value != 0){
                $product = BrandList::find($value);
                $brand_list->sr_no = $request->sr_no[$key];
                $brand_list->save();
            }
        }
        // pr($request->all(),1);
        return json_encode(['status' => true, 'data' => $product]);
    }

    public function get_category_BYGroup(Request $request)
    {
        $id = $request->id;
        $category  = Category::where('group_id',$id)->get();

        $html = '<option value="">Select Category</option>';
        foreach ($category as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->category_name.'</option>';
        }
        return $html;
        return json_encode(['status' => true, 'html' => $html]);
    }
	
	
	public function getBrandList(Request $request)
    {
		$current_user = get_current_user_info();
        // pr($request->all(),1);
        $request->validate([
            'query' => 'required'
        ]);

        $result = null;
        $result = BrandList::where(DB::raw('name') , 'LIKE' , '%' . $request->input('query.term') . '%')
            ->where('status', '=', 1)
			//->where('user_id', '=', $current_user->id)
            ->select(DB::raw('name as text'), 'id')
            ->paginate(50);
        // pr($result->toArray(),1);
        return response()->json($result, 200);
    }

    public function postBrandImageUpload(Request $request)
    {
        //echo "sdas"; die;
        $image = $request->image;
        list($type, $image) = explode(';',$image);
        list(, $image) = explode(',',$image);

        $image = base64_decode($image);
       // $image_name = time().'.png';
         $timestamp = generateFilename();
         $image_name = $timestamp .'_brands_'. '.' .'png';
        file_put_contents('uploads/images/brands/'.$image_name, $image);
        echo json_encode(['success'=>1,'crop_img'=>$image_name]);
    }
}
