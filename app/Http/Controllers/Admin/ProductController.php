<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductBuyFrom;

use App\Models\ProductCollaborator;
use App\Models\ProductOfficialLink;
use App\Models\MetaData;
use App\Models\ProductCommunityStat;
use App\Models\ProductClassification;
use App\Models\ProductAdditionalSuggestion;
use App\Models\ProductCategory;
use App\Models\ProductGalleryMetaData;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\ProductOther;
use App\Models\ProductVideo;
use App\Models\ProductSocialMedia;
use App\Models\ProductStatistic;
use App\Models\UsersUserRole;
use App\Models\SubCategory;
use App\Models\Role;
use App\Models\ProductGallery;

use Auth;
use Session;
use File;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
    }

    public function getIndex()
    {
        return view('admin.product.index');
    }

    public function getList()
    {
        $product = Product::select('*');
        $data = \DataTables::of($product)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('group_id', function ($query) {
                $retVal = (!empty($query->group_id)) ? $query->group_id : 1 ;
                return config('cms.group')[$retVal];
            })
			->editColumn('brand', function ($query) {
                $str_brand_retVal = (!empty($query->brand_list->name)) ? @$query->brand_list->name : @$query->brand;
                return $str_brand_retVal;
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

    public function products_export()
    {
        $fileName = 'products-'.time().'.csv';

        $products = Product::get();

        $tasks = array();
        if (!empty($products)) {
            foreach ($products as $key => $product) {
                $category = 'No Category';
                $subcategory = 'No Sub Category';
                if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[0]) ){
                    $category1 = $product->categories->pluck('category_id')[0];
                    $category = Category::find($category1)->category_name;
                } 

                if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[0]) ){
                    $sub_category1 = $product->categories->pluck('sub_category_id')[0];
                    $subcategory = SubCategory::find($sub_category1)->sub_category;
                } 

                $tasks[] = array(
                    'Name'      => $product->name,
                    'Category'     => $category,
                    'SubCategory'      => $subcategory,
                    'url'   => url('/product/'.$product->slug),
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
        ProductCollaborator::where(['product_id' => '0','user_id' => Auth::guard('admin')->user()['id']])->delete();
        // $users = User::pluck('email', 'id');
        $users = User::get_all_user_list_by_email_name();
        $category = Category::pluck('category_name', 'id');
        // pr($users,1);
        // $product_categories = ProductCategory::pluck('name', 'id');
        $product_categories = '';
		$user_id = 0;
		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$int_role_type_id_data_new = 0;
		
        return view('admin.product.create', compact('int_role_type_id_data_new', 'product_categories', 'users','category', 'user_id', 'str_random_time_stamp_new'));
    }

    public function postCreate(Request $request)
    {
        // pr($request->all(),1);   
        $name = [
                'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address',
                'official_links.*' => 'Official Links URL format is Invalid. Please enter full https:// address',
                'buy_from.*.amazon.url'   => 'Buy From amazon URL format is Invalid. Please enter full https:// address',
                'buy_from.*.ebay.url'     => 'Buy From ebay URL format is Invalid. Please enter full https:// address',
                'buy_from.*.pop.url'      => 'Buy From pop URL format is Invalid. Please enter full https:// address',
            ];  
        $request->validate(Product::validateProduct(), $name);
        try {
            // $current_user = get_current_user_info();
            $current_user = (object) ['id' => $request->user_id];
            // pre($current_user,1);
            DB::beginTransaction();

            // Add Product
            $product = $this->addProduct($request);

            // TODO: Add Gallery
            if ($request->hasFile('gallery')) {
                $this->addGallery($request, $product->id);
            }

            // Add Classification
            $classification_data = $request->classification;
            $classification_data['user_id'] = $product->user_id;
            $classification_data['product_id'] = $product->id;
            ProductClassification::updateOrCreate(['product_id' => $product->id], $classification_data);

            // Add Additional Suggestion
            // $additional_suggestion = $request->additional_suggestion;
            // $additional_suggestion['user_id'] = $current_user->id;
            // $additional_suggestion['product_id'] = $product->id;
            // ProductAdditionalSuggestion::insert($additional_suggestion);

            // Add BuyFrom
            foreach ($request->buy_from as $buy_from) {
                $buy_from['user_id'] = $product->user_id;
                $buy_from['product_id'] = $product->id;
                // pr($buy_from,1);
                ProductBuyFrom::updateOrCreate(['product_id' => $product->id], $buy_from);
            }

            // Add Categories
            ProductCategory::where('product_id', $product->id)->delete();
            $category_data = array(
                'user_id' => @$product->user_id,
                'product_id' => @$product->id,
                'category_id' => $request->category1,
                'sub_category_id' => $request->sub_category1,
            );
            ProductCategory::insert($category_data);

            if(!empty($request->category2) && !empty($request->sub_category2)){
                $category_data['category_id'] = $request->category2;
                $category_data['sub_category_id'] = $request->sub_category2;
                ProductCategory::insert($category_data);
            }

            if(!empty($request->category3) && !empty($request->sub_category3)){
                $category_data['category_id'] = $request->category3;
                $category_data['sub_category_id'] = $request->sub_category3;
                ProductCategory::insert($category_data);
            }

            // $categories = array_map(function ($data) use ($current_user, $product) {
            //     return [
            //         'user_id' => $product->user_id,
            //         'category_id' => $data,
            //         'product_id' => $product->id
            //     ];
            // }, $request->categories);

            // ProductCategory::where('product_id', $product->id)->delete();
            // ProductCategory::insert($categories);

            // Add Collaborators
                $update_collaborator = ['product_id' => $product->id,'user_id' => $product->user_id];
                $where_collaborator  = ['product_id' => '0','user_id' => Auth::guard('admin')->user()['id']];
                ProductCollaborator::where($where_collaborator)->update($update_collaborator);
            
            // Add Official Link
            $officials = collect($request->official_links)->map(function ($link) use ($product, $current_user) {

                return [
                    'user_id' => $product->user_id,
                    'product_id' => $product->id,
                    'value' => $link
                ];
            })
                ->filter(function ($data) {
                    return $data['value'] !== null;
                });
            // dd($officials);
            ProductOfficialLink::where('product_id', $product->id)->delete();
            ProductOfficialLink::insert($officials->toArray());

            // Add Video
            $videos = collect($request->official_links)->map(function ($link) use ($product, $current_user) {
                return [
                    'user_id' => $product->user_id,
                    'product_id' => $product->id,
                    'value' => $link
                ];
            });
            ProductVideo::where('product_id', $product->id)->delete();
            ProductVideo::insert($videos->toArray());

            // Add Socials
            /*if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    if (!is_null($socials)) {
                        $social_media =  ProductSocialMedia::where('user_id', $current_user->id)
                            ->where('type', $key)
                            ->first();
                        if (!$social_media) {
                            $social_media = new ProductSocialMedia();
                            $social_media->user_id = $product->user_id;
                            $social_media->product_id = $product->id;
                        }
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    }
                }
            } */
			
			if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
					
					$social_media =  ProductSocialMedia::where('user_id', $product->user_id)
					        ->where('product_id', $product->id)
                            ->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\ProductSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new ProductSocialMedia();
						}	
						
						$social_media->user_id = $product->user_id;
                        $social_media->product_id = $product->id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
					
                }
            }

            // Add Product Stats
            $stats = $request->stats;
            $stats['user_id'] = $product->user_id;
            $stats['product_id'] = $product->id;
            ProductStatistic::updateOrCreate(['product_id' => $product->id], $stats);


            // Add Others
            $other = $request->other;
            $other['user_id'] = $product->user_id;
            $other['product_id'] = $product->id;
            ProductOther::updateOrCreate(['product_id' => $product->id], $other);

            DB::commit();
			Session::flash('product_data_saved_flag', 1);
            return json_encode(['status' => true, 'message' => 'product created']);
            return successMessage('Product created');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdate($id)
    {
		$user_id = 0;
        
		$users = User::get_all_user_list_by_email_name();
		
        $product = Product::where('id', $id)
            ->with([
                'buyFrom',
            ])
            ->firstOrFail();
        
        $category = Category::pluck('category_name', 'id');
        $collaborator_photos_folder = $this->_collaboratorPhotosFolder;
        // $collaborator_photos_folder = [];
        $product_categories = [];
		
		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$int_role_type_id_data_new = 0;

        return view('admin.product.create', compact('int_role_type_id_data_new', 'str_random_time_stamp_new', 'user_id', 'product_categories', 'users','category','product','collaborator_photos_folder'));

    }

    public function getDelete($id)
    {
		try {

			DB::beginTransaction();
			
			$image_data = Product::select('main_image')->where('id', $id)->first();			
			$file_path = Utilities::get_images_upload_folder_path();
			$image_path = public_path($file_path . $image_data->main_image);
			
			if(file_exists($image_path)) {
				File::delete($image_path);
			}
			
            ProductSocialMedia::where('product_id', $id)->delete();
			ProductClassification::where('product_id', $id)->delete();
			ProductCollaborator::where('product_id', $id)->delete();
			ProductOfficialLink::where('product_id', $id)->delete();
			ProductCategory::where('product_id', $id)->delete();
			ProductBuyFrom::where('product_id', $id)->delete();
			ProductOther::where('product_id', $id)->delete();
			ProductStatistic::where('product_id', $id)->delete();
			ProductVideo::where('product_id', $id)->delete();
			Role::where('product_id', $id)->delete();
			
			$product  = Product::findOrFail($id)->delete();
			
			DB::commit();
			
			return response()->json([
				'status' => 1,
				'msg' => adminTransLang('request_processed_successfully'),
			], 200);
		
		} catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function addProduct($request)
    {
        // $current_user = get_current_user_info();
        $product_data = $request->product;
		if(!empty($product_data['company_hidden_id']))
		{
		  $product_data['company'] = $product_data['company_hidden_id'];	
		}
        else
		{
		  $product_data['company'] = $product_data['company'];	
		}
		
        if(!empty($product_data['brand_hidden_id']))
		{
		  $product_data['brand'] = $product_data['brand_hidden_id'];	
		}
        else
		{
		  $product_data['brand'] = $product_data['brand'];	
		}
				
		
        // pre($product_data,1);
        // $product_data['user_id'] = $current_user->id;
        if ($request->hasFile('main_image')) {
            // Shubham Code For Image Compression Start //
                $file_comp = $request->main_image;
                $extension = $file_comp->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $image_comp_size = getimagesize($file_comp);
                $img = \Image::make($file_comp->getRealPath());
                $destinationPath = public_path($file_path);
                if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename,50,'jpg')){

                        $product_data['main_image'] = $filename;
                }else{
                    // Rollback Transaction
                    DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            // Shubham Code For Image Compression End //
        }
        return Product::updateOrCreate(['id' => $request->product_id], $product_data);
    }

    public function getView($id = null)
    {
        $users = User::get_all_user_list_by_email_name();
		
        $product = Product::find($id);
        $collaborator_photos_folder = $this->_collaboratorPhotosFolder;
        if (!$product) {
            return redirect()->route('admin.product.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        // $user->profile_image = imageBasePath($user->profile_image);

        // $user_status = config('cms.user_status');
        // $user->status = $user_status[$user->status];

        return view('admin.product.view', compact('product','collaborator_photos_folder','users'));
    }

    private function addGallery($request, $product_id)
    {
        $current_user = get_current_user_info();
        foreach ($request->gallery as $gallery) {
            $data = [];
            // Shubham Code For Image Compression Start //
                $file_comp = $gallery;
                $extension = $file_comp->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $image_comp_size = getimagesize($file_comp);
                $img = \Image::make($file_comp->getRealPath());
                $destinationPath = public_path($file_path);
                if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename,50,'jpg')){

                        $data = [
                            'title' => $filename,
                            'user_id' => $current_user->id,
                            'product_id' => $product_id
                        ];
                }else{
                    // Rollback Transaction
                    DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            // Shubham Code For Image Compression End //

            $product_gallery = ProductGallery::create($data);
            if ($request->has('gallery_meta')) {
                $meta_data = $request->gallery_meta;
                $meta_data['gallery_id'] = $product_gallery->id;
                // dd($meta_data);
                MetaData::create($meta_data);
            }
        }

        // return ProductGallery::insert($data);
        return true;
    }

    public function collaborator_AddEdit(Request $request )
    {
        $request->validate([        
            'collab_user_name' => 'required',
            'collab_user_role' => 'required',
        ]);   
        
        $product = Product::where('id', $request->product_id)->first();

        $product_id = (!empty($request->product_id)) ? $request->product_id : '0' ;
        $user_id = (!empty($product->user_id)) ? $product->user_id : Auth::guard('admin')->user()['id'] ;

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
        $collaborators['product_id'] = $product_id;
        $collaborators['role'] = $request->collab_user_role;
        $collaborators['created_at'] =  new \DateTime();
        $collaborators['updated_at'] =  new \DateTime();

        // ProductCollaborator::where('product_id', $request->product_id)->delete();
        $where = array('product_id' => $product_id,'id' => $request->collaboration_id);
        $role_data = ProductCollaborator::updateOrCreate($where, $collaborators);
		
		
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
            $url = "/user/product/collaborator/delete/".$role_data->id;
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
            $url = "/user/product/collaborator/delete/".$role_data->id;
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
        ProductCollaborator::where('id', $request->id)->delete();
        return json_encode(['status' => true, 'data' => $request->id]);
        return back();
    }

    public function User_role_Index()
    {
        return view('admin.product.User_role_Index');
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
        return view('admin.product.User_role_create');
    }

    public function User_role_getUpdate(Request $request, $id)
    {
        $user_role = UsersUserRole::where('id', $id)->firstOrFail();
        return view('admin.product.User_role_create', compact('user_role'));
    }

    public function User_role_getDelete($id)
    {
        $product  = UsersUserRole::findOrFail($id)->delete();
        return view('admin.product.User_role_create');
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
