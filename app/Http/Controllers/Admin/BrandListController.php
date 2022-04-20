<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\BrandList;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BrandListBuyFrom;

use App\Models\BrandListCollaborator;
use App\Models\BrandListOfficialLink;
use App\Models\MetaData;
use App\Models\BrandListCommunityStat;
use App\Models\BrandListClassification;
use App\Models\BrandListAdditionalSuggestion;
use App\Models\BrandListCategory;
use App\Models\BrandListGalleryMetaData;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\BrandListOther;
use App\Models\BrandListVideo;
use App\Models\BrandListSocialMedia;
use App\Models\BrandListStatistic;
use App\Models\UsersUserRole;
use App\Models\SubCategory;
use App\Models\Role;

use Auth;
use Session;
use File;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        return view('admin.brand_list.index');
    }

    public function getList()
    {
        $brand_list = BrandList::select('*');
        $data = \DataTables::of($brand_list)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('group_id', function ($query) {
                $retVal = (!empty($query->group_id)) ? $query->group_id : 1 ;
                return config('cms.group')[$retVal];
            })
            ->editColumn('main_image', function ($query) {
                $retVal = (!empty($query->main_image)) ? @imageBasePath($query->main_image) : url('front/new/images/10.png');
                return $retVal;
            })
            ->filterColumn('group_id', function ($query, $keyword) {
                if ($keyword == 'toy') {
                    $keyword = 1;
                } elseif ($keyword == 'game') {
                    $keyword = 2;
                }
                // $keyword = strtolower($keyword) == "toy" ? 1 : 2;
                $query->where("group_id", $keyword);
            })
            ->make();
        return $data;
    }

    public function brand_lists_export()
    {
        $fileName = 'brand_lists-'.time().'.csv';

        $brand_lists = BrandList::get();

        $tasks = array();
        if (!empty($brand_lists)) {
            foreach ($brand_lists as $key => $brand_list) {
                $category = 'No Category';
                $subcategory = 'No Sub Category';
                if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[0]) ){
                    $category1 = $brand_list->categories->pluck('category_id')[0];
                    $category = Category::find($category1)->category_name;
                }

                if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[0]) ){
                    $sub_category1 = $brand_list->categories->pluck('sub_category_id')[0];
                    $subcategory = SubCategory::find($sub_category1)->sub_category;
                }

                $tasks[] = array(
                    'Name'      => $brand_list->name,
                    'Category'     => $category,
                    'SubCategory'      => $subcategory,
                    'url'   => url('/brand_list/'.$brand_list->slug),
                );
            }
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Category', 'Sub Category', 'URL');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['Name']    = $task['Name'];
                $row['Category']    = $task['Category'];
                $row['SubCategory']        =    $task['SubCategory'];
                $row['url']  = $task['url'];

                fputcsv($file, array($row['Name'], $row['Category'], $row['SubCategory'], $row['url']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function getCreate()
    {
        BrandListCollaborator::where(['brand_list_id' => '0','user_id' => Auth::guard('admin')->user()['id']])->delete();
        // $users = User::pluck('email', 'id');
        $users = User::get_company_user_list_by_email_name();
        $category = Category::pluck('category_name', 'id');
        // pr($users,1);
        // $brand_list_categories = BrandListCategory::pluck('name', 'id');
        $brand_list_categories = '';
		$user_id = 0;
		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$int_role_type_id_data_new = 0;

        return view('admin.brand_list.create', compact('int_role_type_id_data_new', 'brand_list_categories', 'users','category', 'user_id', 'str_random_time_stamp_new'));
    }

    public function postCreate(Request $request)
    {
        // pr($request->all(),1);
        $name = [
                'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address',
                'official_links.*' => 'Official Links URL format is Invalid. Please enter full https:// address',
                'buy_from.*.amazon.url'   => 'Site URL 1 format is Invalid. Please enter full https:// address',
                'buy_from.*.ebay.url'     => 'Site URL 2 format is Invalid. Please enter full https:// address',
                'buy_from.*.pop.url'      => 'Site URL 3 format is Invalid. Please enter full https:// address',
            ];
        $request->validate(BrandList::validateBrandList(), $name);
        try {
            // $current_user = get_current_user_info();
            $current_user = (object) ['id' => $request->user_id];
            // pre($current_user,1);
            DB::beginTransaction();

            // Add BrandList
            $brand_list = $this->addBrandList($request);

            // TODO: Add Gallery
            if ($request->hasFile('gallery')) {
                $this->addGallery($request, $brand_list->id);
            }

            // Add Classification
            $classification_data = $request->classification;
            $classification_data['user_id'] = $brand_list->user_id;
            $classification_data['brand_list_id'] = $brand_list->id;
            BrandListClassification::updateOrCreate(['brand_list_id' => $brand_list->id], $classification_data);

            // Add Additional Suggestion
            // $additional_suggestion = $request->additional_suggestion;
            // $additional_suggestion['user_id'] = $current_user->id;
            // $additional_suggestion['brand_list_id'] = $brand_list->id;
            // BrandListAdditionalSuggestion::insert($additional_suggestion);

            // Add BuyFrom
            foreach ($request->buy_from as $buy_from) {
                $buy_from['user_id'] = $brand_list->user_id;
                $buy_from['brand_list_id'] = $brand_list->id;
                // pr($buy_from,1);
                BrandListBuyFrom::updateOrCreate(['brand_list_id' => $brand_list->id], $buy_from);
            }

            // Add Categories
            BrandListCategory::where('brand_list_id', $brand_list->id)->delete();
            $category_data = array(
                'user_id' => @$brand_list->user_id,
                'brand_list_id' => @$brand_list->id,
                'category_id' => $request->category1,
                'sub_category_id' => $request->sub_category1,
            );
            BrandListCategory::insert($category_data);

            if(!empty($request->category2) && !empty($request->sub_category2)){
                $category_data['category_id'] = $request->category2;
                $category_data['sub_category_id'] = $request->sub_category2;
                BrandListCategory::insert($category_data);
            }

            if(!empty($request->category3) && !empty($request->sub_category3)){
                $category_data['category_id'] = $request->category3;
                $category_data['sub_category_id'] = $request->sub_category3;
                BrandListCategory::insert($category_data);
            }

            // $categories = array_map(function ($data) use ($current_user, $brand_list) {
            //     return [
            //         'user_id' => $brand_list->user_id,
            //         'category_id' => $data,
            //         'brand_list_id' => $brand_list->id
            //     ];
            // }, $request->categories);

            // BrandListCategory::where('brand_list_id', $brand_list->id)->delete();
            // BrandListCategory::insert($categories);

            // Add Collaborators
                $update_collaborator = ['brand_list_id' => $brand_list->id,'user_id' => $brand_list->user_id];
                $where_collaborator  = ['brand_list_id' => '0','user_id' => Auth::guard('admin')->user()['id']];
                BrandListCollaborator::where($where_collaborator)->update($update_collaborator);

            // Add Official Link
            $officials = collect($request->official_links)->map(function ($link) use ($brand_list, $current_user) {

                return [
                    'user_id' => $brand_list->user_id,
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
                    'user_id' => $brand_list->user_id,
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
                            $social_media->user_id = $brand_list->user_id;
                            $social_media->brand_list_id = $brand_list->id;
                        }
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    }
                }
            } */

			if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {

					$social_media =  BrandListSocialMedia::where('user_id', $brand_list->user_id)
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
            $stats['user_id'] = $brand_list->user_id;
            $stats['brand_list_id'] = $brand_list->id;
            BrandListStatistic::updateOrCreate(['brand_list_id' => $brand_list->id], $stats);


            // Add Others
            $other = $request->other;
            $other['user_id'] = $brand_list->user_id;
            $other['brand_list_id'] = $brand_list->id;
            BrandListOther::updateOrCreate(['brand_list_id' => $brand_list->id], $other);

            DB::commit();
			Session::flash('brand_list_data_saved_flag', 1);
            return json_encode(['status' => true, 'message' => 'brand created']);
            return successMessage('Brand created');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdate($id)
    {
		$user_id = 0;

		$users = User::get_company_user_list_by_email_name();

        $brand_list = BrandList::where('id', $id)
            ->with([
                'buyFrom',
            ])
            ->firstOrFail();

        $category = Category::pluck('category_name', 'id');
        $collaborator_photos_folder = $this->_collaboratorPhotosFolder;
        // $collaborator_photos_folder = [];
        $brand_list_categories = [];

		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$int_role_type_id_data_new = 0;

        return view('admin.brand_list.create', compact('int_role_type_id_data_new', 'str_random_time_stamp_new', 'user_id', 'brand_list_categories', 'users','category','brand_list','collaborator_photos_folder'));

    }

    public function getDelete($id)
    {
		try {

			DB::beginTransaction();

			$image_data = BrandList::select('main_image')->where('id', $id)->first();

			$file_path = Utilities::get_brands_upload_folder_path();
			$image_path = public_path($file_path . $image_data->main_image);

			if(file_exists($image_path)) {
				File::delete($image_path);
			}

            BrandListSocialMedia::where('brand_list_id', $id)->delete();
			BrandListClassification::where('brand_list_id', $id)->delete();
			BrandListCollaborator::where('brand_list_id', $id)->delete();
			BrandListOfficialLink::where('brand_list_id', $id)->delete();
			BrandListCategory::where('brand_list_id', $id)->delete();
			BrandListBuyFrom::where('brand_list_id', $id)->delete();
			BrandListOther::where('brand_list_id', $id)->delete();
			BrandListStatistic::where('brand_list_id', $id)->delete();
			BrandListVideo::where('brand_list_id', $id)->delete();

			$brand_list  = BrandList::findOrFail($id)->delete();

			DB::commit();

			return response()->json([
				'status' => 1,
				'msg' => adminTransLang('request_processed_successfully'),
			], 200);

		} catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function addBrandList($request)
    {
        // $current_user = get_current_user_info();
        $brand_list_data = $request->brand_list;
        // pre($brand_list_data,1);
        // $brand_list_data['user_id'] = $current_user->id;
        if ($request->hasFile('main_image')) {
            // Shubham Code For Image Compression Start //
                $file_comp = $request->main_image;
                $extension = $file_comp->getClientOriginalExtension();
                $timestamp = generateFilename();
                $image_comp_size = getimagesize($file_comp);
                $filename = $timestamp . '_brands_' . '.' . $extension;
                $file_path = $this->_brandsPhotosFolder;
                $img = \Image::make($file_comp->getRealPath());
                $destinationPath = public_path($file_path);
                if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename,50,'jpg')){

                        $brand_list_data['main_image'] = $filename;
                }else{
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            // Shubham Code For Image Compression End //
        }
        return BrandList::updateOrCreate(['id' => $request->brand_list_id], $brand_list_data);
    }

    public function getView($id = null)
    {
        $users = User::get_company_user_list_by_email_name();

        $brand_list = BrandList::find($id);
        $collaborator_photos_folder = $this->_collaboratorPhotosFolder;
        if (!$brand_list) {
            return redirect()->route('admin.brand_list.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        // $user->profile_image = imageBasePath($user->profile_image);

        // $user_status = config('cms.user_status');
        // $user->status = $user_status[$user->status];

        return view('admin.brand_list.view', compact('brand_list','collaborator_photos_folder','users'));
    }

    private function addGallery($request, $brand_list_id)
    {
        $current_user = get_current_user_info();
        foreach ($request->gallery as $gallery) {
            $data = [];
            // Shubham Code For Image Compression Start //
                $file_comp = $gallery;
                $extension = $file_comp->getClientOriginalExtension();
                $timestamp = generateFilename();
                $image_comp_size = getimagesize($file_comp);
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $img = \Image::make($file_comp->getRealPath());
                $destinationPath = public_path($file_path);
                if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename,50,'jpg')){

                        $data = [
                            'title' => $filename,
                            'user_id' => $current_user->id,
                            'brand_list_id' => $brand_list_id
                        ];
                }else{
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            // Shubham Code For Image Compression End //

            $brand_list_gallery = BrandListGallery::create($data);
            if ($request->has('gallery_meta')) {
                $meta_data = $request->gallery_meta;
                $meta_data['gallery_id'] = $brand_list_gallery->id;
                // dd($meta_data);
                MetaData::create($meta_data);
            }
        }

        // return BrandListGallery::insert($data);
        return true;
    }

    public function collaborator_AddEdit(Request $request )
    {
        $request->validate([
            'collab_user_name' => 'required',
            'collab_user_role' => 'required',
        ]);

        $brand_list = BrandList::where('id', $request->brand_list_id)->first();

        $brand_list_id = (!empty($request->brand_list_id)) ? $request->brand_list_id : '0' ;
        $user_id = (!empty($brand_list->user_id)) ? $brand_list->user_id : Auth::guard('admin')->user()['id'] ;

        // pre(Auth::guard('admin')->user(),1);
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


        if($role_data){
            foreach(users_user_roles() as $key => $value){
                if(@$role_data->role == $key){
                    $user_role = $value;
                }
            }
            $url = "/user/brand_list/collaborator/delete/".$role_data->id;
			/* <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td> */

            if(!empty($request->collaboration_id) && $request->collaboration_id == $role_data->id){
                $html = '<td class="verticalalign text-left pl-0">'.$str_people_name.'</td>
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
                return json_encode(['status' => true, 'html' => $html]);
            }
            $url = "/user/brand_list/collaborator/delete/".$role_data->id;
            /* <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td> */

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
        } else {
            return errorMessage('collaborator not saved');
        }
    }

    public function collaborator_delete(Request $request)
    {
        // pre($request->all(),1);
        BrandListCollaborator::where('id', $request->id)->delete();
        return json_encode(['status' => true, 'data' => $request->id]);
        return back();
    }

    public function User_role_Index()
    {
        return view('admin.brand_list.User_role_Index');
    }

    public function User_role_getList()
    {
        $users_roles = UsersUserRole::select('*');
        $data = \DataTables::of($users_roles)
            ->make();
        return $data;
    }
    public function User_role_getCreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            $where  = [ 'id' => $request->user_role_id ];
            $update = [ 'role_name' => $request->role_name ];

            UsersUserRole::updateOrCreate($where,$update);
            return redirect()->route('admin.user_role.index');
        }
        return view('admin.brand_list.User_role_create');
    }

    public function User_role_getUpdate(Request $request, $id)
    {
        $user_role = UsersUserRole::where('id', $id)->firstOrFail();
        return view('admin.brand_list.User_role_create', compact('user_role'));
    }

    public function User_role_getDelete($id)
    {
        $brand_list  = UsersUserRole::findOrFail($id)->delete();
        return view('admin.brand_list.User_role_create');
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
}
