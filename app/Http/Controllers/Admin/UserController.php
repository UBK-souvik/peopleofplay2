<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\MetaData;
use App\Models\UserGallery;
use App\Models\InventorAward;
use App\Models\InventorContactInformation;
use App\Models\UserSocialMedia;
use App\Models\UserSubscription;
use App\Models\Plan;
use App\Models\UsersUserRole;
use App\Models\Skill;
use App\Models\News;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Event;
use App\Models\EventAward;
use App\Models\EventSocialMedia;
use App\Models\Gallery;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryOtherTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryProductTag;
use App\Models\Watchlist;
use App\Models\PollAnswer;
use App\Models\Product;
use App\Models\ProductClassification;
use App\Models\ProductCollaborator;
use App\Models\ProductOfficialLink;
use App\Models\ProductCategory;
use App\Models\ProductBuyFrom;
use App\Models\ProductOther;
use App\Models\ProductStatistic;
use App\Models\ProductVideo;
use App\Models\ProductSocialMedia;
use App\Models\Message;
use App\Models\Report;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Session;
use Excel;
use Config;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;


class UserController extends Controller
{
	
	 public function __construct()
    {
		$this->_usersPhotosFolder = Utilities::get_users_upload_folder_path();
        $this->_badgesPhotosFolder = Utilities::get_badges_upload_folder_path();         
	}
	
    public function getIndex()
    {
        return view('admin.users.index');
    }

    public function getList()
    {
        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at', 'is_news_feeds'])->where('role', 2);
		//->orderBy('id', 'DESC');
		$users->whereIn("type_of_user", [2]);//->orderBy('id', 'DESC');
        // $users = $users->where("type_of_user", 2)->orderBy('id', 'DESC');
        // pr($users->get()->toArray(),1); 
        // die('amit');
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
			->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $query->whereRaw("CONCAT(dial_code, ' ', mobile) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->editColumn('type', function ($query) {
                return GetInnovatorRoles([$query->type]);
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);				
            })
            ->editColumn('news_feeds_checked', function ($query) {
                if($query->is_news_feeds == 1){
                    return 'checked';
                }else{
                    return '';
                }
            })
            ->make();
    }

    public function basic_getIndex()
    {
        return view('admin.users.indexBasic');
    }

    public function basic_getList()
    {
        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at', 'is_news_feeds'])->where('role', 2);
        $users->whereIn("type_of_user", [3]);//->orderBy('id', 'DESC');
        // $users = $users->where("type_of_user", 2)->orderBy('id', 'DESC');
        // pr($users->get()->toArray(),1); 
        // die('amit');
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $query->whereRaw("CONCAT(dial_code, ' ', mobile) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->editColumn('type', function ($query) {
                return GetInnovatorRoles([$query->type]);
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);              
            })
            ->editColumn('news_feeds_checked', function ($query) {
                if($query->is_news_feeds == 1){
                    return 'checked';
                }else{
                    return '';
                }
            })
            ->make();
    }


    public function getProfileType()
    {
        return view('admin.users.profile_type');
    }

    public function getProfileTypeList()
    {
        $users = \App\Models\User::select(['id','first_name', DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','type_of_user','email'])->whereIn('role', [2,3]);
        $users->whereIn("type_of_user", [3,2]);//->orderBy('id', 'DESC');
        // pr($users->get()->toArray(),1); 
        // die('amit');
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            ->editColumn('type_of_user', function ($query) {
                if($query->type_of_user == 2 && $query->role == 2){
                    return 'POP Pro';
                } elseif ($query->type_of_user == 2 && $query->role == 3) {
                    return 'POP Company';
                } elseif ($query->type_of_user == 3 && $query->role == 2) {
                    return 'POP Basic';
                }
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);              
            })
            ->make();
    }

    public function getProfileTypeEdit(Request $request, $user_id){
        $user = \App\Models\User::find($user_id);

        if($user->type_of_user == 2 && $user->role == 2){ // if its come with pro innovator plan
            $user_type =  2; 
        } elseif ($user->type_of_user == 2 && $user->role == 3) {  // if its come with pro comapany plan
            $user_type =  4; 
        } elseif ($user->type_of_user == 3 && $user->role == 2) { // if its come with basic plan
            $user_type =  3;
        }

        if($request->isMethod('post'))
        {
            try 
            {
                // Start Transaction
                \DB::beginTransaction();
                $str_time = time(); 

                if($request->user_type == 2 ) {  // if its come with pro innovator plan
                    $user_type = 2;
                    $role_id = 2; 
                    $plan_id = 2; 
                } elseif ( $request->user_type == 3) { // if its come with basic plan
                    $user_type = 3;
                    $role_id = 2;
                    $plan_id = 3;
                } elseif($request->user_type == 4) {  // if its come with pro comapany plan
                    $user_type = 2;
                    $role_id = 3;    
                    $plan_id = 4;
                } 

                $user->type_of_user = $user_type;
                $user->role = $role_id;
                $user->save();

                $plan = Plan::find($plan_id);
                        
                $subscription = new UserSubscription();
                $subscription->user_id = $user_id;
                $subscription->plan_id = $plan->id;
                $subscription->price = $plan->price;
                $subscription->validity = $plan->validity;
                $subscription->ends_at = Carbon::now()->addDay($plan->validity);
                $subscription->payment_status = 2;
                $subscription->stripe_id = $str_time;
                $subscription->stripe_plan_id = $plan->stripe_plan_id;
                $subscription->stripe_subscription_id = 0;
                $subscription->save();
            
                $user->stripe_id = $str_time;                   
                $user->save();  


                // Commit Transaction
                \DB::commit();
                $response = ['msg' => adminTransLang('data_saved_successfully')];
                Session::flash('user_data_saved_flag', 1);
                return response()->json($response, 200);
            } catch (\Illuminate\Database\QueryException $e) {
                // Rollback Transaction
                \DB::rollBack();
                errorMessage($e->errorInfo[2], true);
            }
        }

        return view('admin.users.profile_type_edit',compact('user','user_id', 'user_type'));
    }

    public function free_getIndex()
    {
        return view('admin.users.indexFree');
    }

    public function free_getList()
    {
        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at'])->where('role', 1);
        $users->whereIn("type_of_user", [1]);//->orderBy('id', 'DESC');
        // $users = $users->where("type_of_user", 2)->orderBy('id', 'DESC');
        // pr($users->get()->toArray(),1); 
        // die('amit');
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $query->whereRaw("CONCAT(dial_code, ' ', mobile) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->editColumn('type', function ($query) {
                return GetInnovatorRoles([$query->type]);
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);              
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.users.create');
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'dial_code' => 'required|numeric|digits_between:1,5',
            // 'mobile' => 'required|numeric|digits_between:9,20',
            'mobile' => 'numeric|digits_between:9,20',
            // 'gender' => 'required|in:Male,Female',
            'profile_image' => config('cms.allowed_image_mimes'),
        ]);
        $fieldArr = array('name', 'email', 'dial_code', 'mobile', 'gender', 'password', 'apartment_id', 'status');
        $dataArr = arrayFromPost($request, $fieldArr);

        try {
            // Start Transaction
            \DB::beginTransaction();

            $user = new \App\Models\User();
            $user->name = $dataArr->name;
            $user->email = $dataArr->email;
            $user->password = bcrypt($dataArr->password);
            $user->dial_code = $dataArr->dial_code;
            $user->mobile = ltrim($dataArr->mobile, '0');
            // $user->gender = $dataArr->gender;
            $user->status = $dataArr->status;

            if (\Input::hasFile('profile_image')) {
                $image = \Input::file('profile_image');
                $extension = $image->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $image->move($file_path, $filename);
                if ($upload_status) {
                    $user->profile_image = $filename;

                } else {
                    // Rollback Transaction
                    \DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            }
            $user->save();

            // Commit Transaction
            \DB::commit();
            return response()->json([
                'msg' => adminTransLang('request_processed_successfully')
            ], 201);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            $message = ['msg' => errorMessage($e->errorInfo[2], true)];
            return response()->json($message, 422);
        }
    }

    public function get_tags(Request $request)
    {
        $postData = $request->all();
        $keyword = $postData['query'];
        $data = Skill::where('skill', 'like', '%' . $keyword . '%')->select('skill as name', 'id')->groupBy('skill')->get();
        return response()->json($data, 200);
    }

    public function getUpdate(Request $request)
    {
        $user = \App\Models\User::find($request->id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        $user->profile_image = imageBasePath($user->profile_image);

        return view('admin.users.update', ['user' => $user]);
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$request->id},id",
            'dial_code' => 'required|numeric|digits_between:1,5',
            // 'mobile' => 'required|numeric|digits_between:9,20',
            'mobile' => 'numeric|digits_between:9,20',
            // 'gender' => 'required|in:Male,Female',
            'profile_image' => config('cms.allowed_image_mimes'),
        ]);
        $fieldArr = ['name', 'email', 'dial_code', 'mobile', 'gender', 'apartment_id', 'status'];
        $dataArr = arrayFromPost($request, $fieldArr);

        try {
            // Start Transaction
            \DB::beginTransaction();

            $user = \App\Models\User::find($request->id);
            $user->name = $dataArr->name;
            $user->email = $dataArr->email;
            $user->dial_code = $dataArr->dial_code;
            $user->mobile = ltrim($dataArr->mobile, '0');
            // $user->gender = $dataArr->gender;
            $user->status = $dataArr->status;

            if (\Input::hasFile('profile_image')) {
                $image = \Input::file('profile_image');
                $extension = $image->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $image->move($file_path, $filename);
                if ($upload_status) {
                    $user->profile_image = $filename;
                } else {
                    // Rollback Transaction
                    \DB::rollBack();

                    errorMessage('file_uploading_failed');
                }
            }
            $user->save();

            // Commit Transaction
            \DB::commit();
            $response = ['msg' => adminTransLang('request_processed_successfully')];
            return response()->json($response, 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            errorMessage($e->errorInfo[2], true);
        }
    }

    public function getDelete($id)
    {
        //$message = ['msg' => adminTransLang('success')];
        //return response()->json($message, 200);				
		try {
            // Start Transaction
            \DB::beginTransaction();
			
			$user = \App\Models\User::find($id);
			
			
			// cancel user stripe subscription
			$this->admin_cancel_user_stripe_subscription($user);
			
			//delete a user in stripe dashboard
			//$this->admin_delete_user_stripe($user);
			
			
            InventorContactInformation::where('user_id', $id)->delete();
			UserSocialMedia::where('user_id', $id)->delete();
			Role::where('user_id', $id)->delete();									
			//EventAward::where('user_id', $id)->delete();
			EventSocialMedia::where('user_id', $id)->delete();
			Event::where('user_id', $id)->delete();
			News::where('user_id', $id)->delete();
			Blog::where('user_id', $id)->delete();
			Chat::where('sender', $id)->delete();
            Chat::where('receiver', $id)->delete();				
			Gallery::where('user_id', $id)->delete();
			GalleryAwardTag::where('user_id', $id)->delete();
			GalleryCompanyTag::where('user_id', $id)->delete();
			GalleryOtherTag::where('user_id', $id)->delete();
			GalleryPersonTag::where('user_id', $id)->delete();
			GalleryProductTag::where('user_id', $id)->delete();
			InventorAward::where('user_id', $id)->delete();
			UserSubscription::where('user_id', $id)->delete();
			ProductSocialMedia::where('user_id', $id)->delete();
			ProductClassification::where('user_id', $id)->delete();
			ProductCollaborator::where('user_id', $id)->delete();
			ProductOfficialLink::where('user_id', $id)->delete();
			ProductCategory::where('user_id', $id)->delete();
			ProductBuyFrom::where('user_id', $id)->delete();
			ProductOther::where('user_id', $id)->delete();
			ProductStatistic::where('user_id', $id)->delete();
			ProductVideo::where('user_id', $id)->delete();
			Product::where('user_id', $id)->delete();
			Watchlist::where('user_id', $id)->delete();
			PollAnswer::where('user_id', $id)->delete();


            Message::where(
                        function ($query) use ($id)
                        { $query->where('sender', '=', $id)
                            ->orWhere('receiver', '=', $id);
                        })->delete();
            Chat::where(
                        function ($query) use ($id)
                        { $query->where('sender', '=', $id)
                            ->orWhere('receiver', '=', $id);
                        })->delete();
			
			$user = \App\Models\User::find($id)->delete();
            
            // Commit Transaction
            \DB::commit();
            $response = ['msg' => adminTransLang('request_processed_successfully')];
            return response()->json($response, 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            errorMessage($e->errorInfo[2], true);
        }
		
		
    }
	
	public function deleteUserRole($user_id, $role_id)
	{
		try {
            // Start Transaction
            \DB::beginTransaction();

            Role::where('user_id', $user_id)->where('id', $role_id)->delete();

            // Commit Transaction
            \DB::commit();
            $response = ['msg' => adminTransLang('request_processed_successfully')];
            return response()->json($response, 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            errorMessage($e->errorInfo[2], true);
        }
		
	}

    public function getView($id = null)
    {
        $user = \App\Models\User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        $user->profile_image = imageBasePath($user->profile_image);

        $user_status = config('cms.user_status');
        $user->status = $user_status[$user->status];


        $users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();
		
		$role_data = Role::get_role_data($id, 0);
		
        return view('admin.users.view', ['role_data' => $role_data, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'user_id' => $id,'users_user_roles' => $users_user_roles]); 

        // return view('admin.users.view', ['user' => $user]);
    }

    public function basic_getView($id = null)
    {
        $user = \App\Models\User::find($id);
        if (!$user) {
            return redirect()->route('admin.basic.users.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        $user->profile_image = imageBasePath($user->profile_image);

        $user_status = config('cms.user_status');
        $user->status = $user_status[$user->status];


        $users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();
        
        $role_data = Role::get_role_data($id, 0);
        
        return view('admin.users.view_basic', ['role_data' => $role_data, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'user_id' => $id,'users_user_roles' => $users_user_roles]); 

        // return view('admin.users.view', ['user' => $user]);
    }

     public function free_getView($id = null)
    {
        $user = \App\Models\User::find($id);
        if (!$user) {
            return redirect()->route('admin.free.users.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        $user->profile_image = imageBasePath($user->profile_image);

        $user_status = config('cms.user_status');
        $user->status = $user_status[$user->status];


        $users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();
        
        $role_data = Role::get_role_data($id, 0);
        
        return view('admin.users.view_free', ['role_data' => $role_data, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'user_id' => $id,'users_user_roles' => $users_user_roles]); 

        // return view('admin.users.view', ['user' => $user]);
    }

    public function getPasswordReset($id = false)
    {
        $user = \App\Models\User::find($id);
        if (!$user) {
            return redirect()->route("admin.users.index")->with(['fail' => adminTransLang('user_not_found')]);
        }
        return view('admin.users.password-reset', ['id' => $id]);
    }

    public function postPasswordReset($id = false, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('password_changed_successfully'),
        ], 200);
    }
	
	public function showAddUser(Request $request)
    {
		echo $this->saveAddEditUser($request, 0);
	}

    public function showEditUser(Request $request, $user_id)
    {
        $user = \App\Models\User::find($user_id);
        // if($user->role == 3){
        //     // return redirect('admin/users/showeditCompany/'.$user_id);
        //     echo $this->saveAddEditCompany($request, $user_id);
        // }
        // else{
		  echo $this->saveAddEditUser($request, $user_id);
        // }
	}

    public function chkBatchValidation($request, $user, $rules)
    {	
	      $arr_badges_list = UtilitiesTwo::get_batch_list_data();
	
	      foreach($arr_badges_list as $arr_badges_list_row)
			{
			  $int_batch_id = $arr_badges_list_row;
			  
			  $str_badge_name = 'badge_' . $int_batch_id;
			  
			  if ($request->hasFile($str_badge_name)){
               $rules[$str_badge_name] =  'max:'.Config::get('commonconfig.max_file_upload_size_new'); 
              }

		    }
			
			return $rules;
	}
	
	public function saveBatchImage($request, $user, $rules)
    {
		$arr_badges_list = UtilitiesTwo::get_batch_list_data();
		
		foreach($arr_badges_list as $arr_badges_list_row)
		{
		  $int_batch_id = $arr_badges_list_row;
		  
		  $str_badge_name = 'badge_' . $int_batch_id;
		  
		  $str_badge_caption = 'badge_' . $int_batch_id . '_caption';
		  
		  if ($request->hasFile($str_badge_name)) {

            //$extension = UtilitiesTwo::get_image_ext_name();
            // Shubham Code For Image Compression Start //
                $file_comp = $request->str_badge_name;
                $extension = $file_comp->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '_badges_' . '.' . $extension;
                $file_path = $this->_badgesPhotosFolder;
                $image_comp_size = getimagesize($file_comp);
                $img = \Image::make($file_comp->getRealPath());
                $destinationPath = public_path($file_path);
                if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename,50,'jpg')){

                        $user->$str_badge_name = $filename;
				        return $user;
                } else {
                    // Rollback Transaction
                    //DB::rollBack();
                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            // Shubham Code For Image Compression End //
		  }
           
		   if(!empty($request->$str_badge_caption))
		   {
			   $user->$str_badge_caption = $request->$str_badge_caption;
		   }

		}
    }
	
	
	public function saveSkillsData($request, $user, $rules)
	{
		$str_skills_data = '';
		$arr_skills = array();
		
		$arr_skills = UtilitiesFour::get_skills_array(@$request->skills);

		Skill::save_skill_data($arr_skills);
		
		$str_skills_data = UtilitiesFour::get_skills_list($arr_skills);

		if($user->role == 3)
		{
		  //$user->services = $str_skills_data;
		}
		else
		{
		  //$user->skills = $str_skills_data;	
		}
		
	}
	
	public function saveAddEditUser(Request $request, $user_id)
    {	
		// pr($request->all(),1);
		$user_id_edit_mode = $user_id;
		$str_time = time(); 
		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$role_type_data_new = '';
        $int_role_type_id_data_new = 2;

		if ($request->isMethod('post')) 
        {   
            //          pr(config('cms.social_media')[9],1);
            //          $request->validate([
            //              'socials.*' => 'sometimes|nullable|url'
            //          ]);

            //          preg_match("/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/i", "http://google.com");
            //          if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$request->socials[0]))
            //          {
            //              return $websiteErr = "Invalid URL";
            //          }
			$str_request_random_time_stamp_new = $request->input('admin_add_edit_profile.random_time_stamp_new');
			
            //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
			$regex = UtilitiesTwo::get_regular_exp_format();

            if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    $social_url[] = $socials;
                }
                $request->merge([
                    'socials' => $social_url,
                ]);
            }
            $request->merge([
                'website' => $request->website,
            ]);
            // pr($request->all(),1);
			$rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                //'socials.*' => 'sometimes|nullable|regex:'.$regex
             ];
			 
           if(empty($user_id))
            {
                $rules['password'] =  'required';
            }   			
			
			$rules['description'] =  'required';
			$rules['dial_code'] =  'required';
			// $rules['mobile'] =  'required|size:10';
			if(empty($user_id))
            {
                $rules['email'] =  'required|email|unique:users'; 
            }
            elseif ($user_id) {
               $rules['email'] =  'required|email|unique:users,email,'.$user_id; 
            }

            if ($request->hasFile('profile_image')){
               $rules['profile_image'] =  'max:'.Config::get('commonconfig.max_file_upload_size_new'); 
            }
			
			$rules = $this->chkBatchValidation($request, '', $rules);
			
			//$rules['email'] =  'required|email';
			// $rules['postal_address'] =  'required';
            //$rules['city'] =  'required';
            //$rules['state'] =  'required';
            //$rules['zip_code'] =  'required';
			$rules['country_id'] =  'required';
            $rules['skills'] =  'required';
            
			$rules = UtilitiesFour::chkUrlWebsite($rules, 'website');
			$rules = UtilitiesFour::chkUrlWebsite($rules, 'socials.*');			
			
            //$rules['website'] =  'sometimes|nullable|regex:'.$regex;
			// $rules['dobday'] =  'required';
			// $rules['dobmonth'] =  'required';
            // 'website' => 'required|url',
			
			   /*'description' => 'required',
                'mobile' => 'required|size:10',
                'email'  => 'required|email',
                //'gender' => 'required',
                'dial_code' => 'required',
                // 'dob' => 'required',
                'dobday'    => 'required',
                'dobmonth'  => 'required',
                // 'skills' => 'required',
                 'postal_address' => 'required',
                 'city' => 'required',
				 'state' => 'required',
                 'zip_code' => 'required',
                 'country_id' => 'required',
				 'skills' => 'required',
                // 'business_address' => 'required',
                // 'contact_info.agent_name' => 'required',
                // 'contact_info.agent_email_id' => 'required',
                // 'contact_info.manager_name' => 'required',
                // 'contact_info.manager_email_id' => 'required',
                // 'contact_info.legal_name' => 'required',
                // 'contact_info.legal_email_id' => 'required',
                // 'contact_info.company_name' => 'required',
                // 'contact_info.company_email_id' => 'required',
                // 'socials' => 'required|array',
                //'roles' => 'required|array',*/
		 
    	    //$niceNames = array();
			$niceNames = [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'description' => 'Innovator Description',
                'mobile' => 'Primary Mobile',
                'email' => 'Primary Email',
                'dial_code' => 'Dial Code',
                'dobday' => 'Date of Birth',
		        'dobmonth' => 'Month of Birth',
                'postal_address' => 'Postal Address',
                'city' => 'City',
                'state' => 'State',
                'zip_code' => 'Postalcode/Zipcode',
                'country_id' => 'Country',
                'skills' => 'Skills',            
                'password' =>  'Password'	
            ];

            $name = [
                // 'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address'
                'socials.*' => 'Socials URL format is Invalid.'
            ];
			
            $this->validate($request, $rules, $name, $niceNames);

			try 
            {
				// Start Transaction
				\DB::beginTransaction();

				if(!empty($user_id))
				{
				   $user = \App\Models\User::find($user_id);
				}
				else
				{
				   $user = new \App\Models\User();	
				   $user->password = bcrypt($request->password);
				   $user->type_of_user = 2;
				   $user->created_by = 1;
				}				
				
				$user->first_name =  $request->first_name;   
				$user->last_name =  $request->last_name;   
				
				if(!empty($request->role))
				{
				   $user->role =  $request->role;	
				}
                
				$user->email =  $request->email;
                $user->hide_email =  $request->hide_email;				
                $user->gold =  $request->gold;              
				//$user->username = $request->username;
				// $user->gender = $request->gender;
                $user->pronoun = $request->pronoun;
				// $user->dob    = $request->dob;
                $user->dobday    = $request->dobday;
                $user->dobmonth    = $request->dobmonth;
                $user->dobyear    = $request->dobyear;
				$user->description = $request->description;
				$user->postal_address = $request->postal_address;
				$user->state = $request->state;
				
				$this->saveSkillsData($request, $user, $rules);
								
				if(!empty($request->phone_number))
				{
				   $user->phone_number = $request->phone_number;	
				}
				$user->mobile = $request->mobile;
                $user->dial_code = $request->dial_code;
				$user->city = $request->city;
				$user->zip_code = $request->zip_code;
				$user->country_id = $request->country_id;
				$user->website = $request->website;
				$user->business_address = $request->business_address;
				$user->state_business = $request->state_business;
				$user->zip_code_business = $request->zip_code_business;
				$user->city_business = $request->city_business;
				$user->country_id_business = $request->country_id_business;

                $user->fun_fact1 = $request->fun_fact1;
                $user->fun_fact2 = $request->fun_fact2;
                $user->fun_fact3 = $request->fun_fact3;
				
				if(!empty($request->secondary_phone_number))
				{
				   $user->secondary_phone_number = $request->secondary_phone_number;	
				}
				if(!empty($request->secondary_mobile))
				{
				   $user->secondary_mobile = $request->secondary_mobile;
				}
				if(!empty($request->secondary_email))
				{
				   $user->secondary_email = $request->secondary_email;
				}
				$user->no_of_employees = $request->no_of_employees;
				$user->company_category_id = $request->company_category_id;
				if ($request->hasFile('profile_image')) {

					// Shubham Code For Image Compression Start //
                        $file_comp = $request->profile_image;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '_users_' . '.' . $extension;
                        $file_path = $this->_usersPhotosFolder;
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $user->profile_image = $filename;
                        } else {
                            // Rollback Transaction
                            //DB::rollBack();
                            $message = ['msg' => errorMessage('file_uploading_failed')];
                            return response()->json($message, 422);
                        }
                    // Shubham Code For Image Compression End //
				}				
				
				$this->saveBatchImage($request, $user, $rules);				
				
				$user->stripe_id = $str_time;
				
				$user->home_page_slide_show_caption = @$request->home_page_slide_show_caption;
                $user->caption_url = @$request->caption_url;
				
				$user->save();
				
				$user_id = $user->id;

                
				if(empty($user_id_edit_mode))
				{
					$role_update = Role::where('random_unique_timestamp', $str_request_random_time_stamp_new)
				->update(['user_id' => $user_id, 'people_id' => $user_id]);
					
					$plan = Plan::find(2);
					
					$subscription = new UserSubscription();
					$subscription->user_id = $user_id;
					$subscription->plan_id = $plan->id;
					$subscription->price = $plan->price;
					$subscription->validity = $plan->validity;
					$subscription->ends_at = Carbon::now()->addDay($plan->validity);
					$subscription->payment_status = 2;
					$subscription->stripe_id = $str_time;
					$subscription->stripe_plan_id = $plan->stripe_plan_id;
					$subscription->stripe_subscription_id = 0;
					$subscription->save();
				
				    $user->stripe_id = $str_time;    				
				    $user->save();					
				}
				
                InventorContactInformation::where('user_id', $user_id)->delete();
				if ($request->filled('contact_info')) {
                        $contact_info =  InventorContactInformation::where('user_id', $user_id)->first();
                        if (!$contact_info) {
                            $contact_info = new InventorContactInformation();
                            $contact_info->user_id = $user_id;
                        }
                        foreach ($request->only(
                                'contact_info.agent_name',
                                'contact_info.agent_email_id',
                                'contact_info.manager_name',
                                'contact_info.manager_email_id',
                                'contact_info.legal_name',
                                'contact_info.legal_email_id',
                                'contact_info.company_name',
                                'contact_info.company_email_id',
                                'contact_info.company_phone',
                            ) as $value) {
                                foreach ($value as $key => $contact) {
                                    if (!is_null($contact)) {
                                        $contact_info->$key = $contact;
                                    }
                                }
                        }
                    $contact_info->save();
                }

                $contact_info =  InventorContactInformation::where('user_id', $user_id)->first();

                /*if ($request->filled('socials')) {
                    foreach ($request->socials as $key => $socials) {
                        if (!is_null($socials)) {
                            $social_media =  UserSocialMedia::where('user_id', $user_id)
                                ->where('type', $key)
                                ->first();
                            if (!$social_media) {
                                $social_media = new UserSocialMedia();
                                $social_media->user_id = $user_id;
                            }
                            $social_media->type = $key;
                            $social_media->value = $socials;
                            $social_media->save();
                        }
                    }
                }*/
				
				if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
					$social_media =  UserSocialMedia::where('user_id', $user_id)
                            ->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\UserSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new UserSocialMedia();
						}	
						
						$social_media->user_id = $user_id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    
                }
            }
			
			    $arr_add_edit_profile_role = $request->add_edit_profile_role;
			
                /*if (!empty($arr_add_edit_profile_role) && count($arr_add_edit_profile_role) > 0) 
                {
    				
    			    $arr_role_hidden_id = $request->input('add_edit_profile_role.role_hidden_id');
                    //$arr_role_hidden_id = array_values($arr_role_hidden_id);
    				//DB::table('roles')->where('user_id', $user_id)->whereNotIn('id', $arr_role_hidden_id)->delete();
    				
    				$i = 0;
    				
    				$cnt_role_data = count($arr_add_edit_profile_role['role']);
                    
    				foreach ($arr_add_edit_profile_role as $role_row_key => $role_row_val) 
                    {
    					
    					if(!empty($arr_add_edit_profile_role['role'][$i]) && !empty($arr_add_edit_profile_role['name'][$i])
                            && !empty($arr_add_edit_profile_role['from_year'][$i]) && !empty($arr_add_edit_profile_role['to_year'][$i]) )
    					{
    						if($i == $cnt_role_data)
    						 break;	
    						
    						$role_hidden_id = @$arr_add_edit_profile_role['role_hidden_id'][$i];
    						
    						if(!empty($role_hidden_id))
    						{
    						   $obj_role = \App\Models\Role::find($role_hidden_id);	
    						}
    						else
    						{
    						   $obj_role = new \App\Models\Role();	
    						}			
    						
    						
    						//if(empty($arr_add_edit_profile_role['role'][$i]))
    						//  continue;	
    					
    						$obj_role->user_id =  $user_id;   
    						$obj_role->role =  $arr_add_edit_profile_role['role'][$i];
    						$obj_role->at =  @$arr_add_edit_profile_role['at'][$i];
    						$obj_role->name =  @$arr_add_edit_profile_role['name'][$i];
    						$obj_role->description =  @$arr_add_edit_profile_role['description'][$i];
    						// $obj_role->date_from =  @$arr_add_edit_profile_role['date_from'][$i];
                            $obj_role->from_day =  @$arr_add_edit_profile_role['from_day'][$i];
                            $obj_role->from_month =  @$arr_add_edit_profile_role['from_month'][$i];
                            $obj_role->from_year =  @$arr_add_edit_profile_role['from_year'][$i];
    						// $obj_role->date_to =  @$arr_add_edit_profile_role['date_to'][$i];
                            $obj_role->to_day =  @$arr_add_edit_profile_role['to_day'][$i];
                            $obj_role->to_month =  @$arr_add_edit_profile_role['to_month'][$i];
                            $obj_role->to_year =  @$arr_add_edit_profile_role['to_year'][$i];
    						$obj_role->save();
    						

                            // pr($obj_role);
    							/*if (!empty($role_row)) {
    								$new_role = [
    									'user_id' => $user_id,
    									'role' => @$arr_add_edit_profile_role['role'][$i],
    									'at' => @$arr_add_edit_profile_role['at'][$i],
    									'name' => @$arr_add_edit_profile_role['role_name'][$i],
    									'description' => @$arr_add_edit_profile_role['role_description'][$i],
    									'date_from' => @$arr_add_edit_profile_role['date_from'][$i],
    									'date_to' => @$arr_add_edit_profile_role['date_to'][$i]
    								];
    								Role::create($new_role);
    							}
    							$i++;
    				    }	
                    }
                }*/
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('user_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$user = \App\Models\User::find($user_id);
		
		//if(!empty($user->role))
		//{
		   $role_type_data_new = UtilitiesTwo::getRoleText($int_role_type_id_data_new);	
		//}
		
		$users_user_roles = UsersUserRole::pluck('role_name','id');
		$countries = Country::pluck('country_name', 'id');
		$arr_role_at_list = Utilities::get_roles_at_list();
		$arr_roles_list = Utilities::get_roles_list(); 

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }

        // pr($ip_data,1);
				
	    return view('admin.users.add_update_user', ['str_random_time_stamp_new' => $str_random_time_stamp_new, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 
		'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'role_type_data_new' => $role_type_data_new,
		'user_id' => $user_id,'users_user_roles' => $users_user_roles,'ip_data' => $ip_data, 'int_role_type_id_data_new' => $int_role_type_id_data_new]);	
    }


    public function basic_showAddUser(Request $request)
    {
        echo $this->showEditBasic_users($request);
    }

    public function showEditBasic_users(Request $request, $user_id='')
    {
        $user_id_edit_mode = $user_id;
        $str_time = time(); 
        $str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
        $role_type_data_new = '';
        $int_role_type_id_data_new = 2;

        if ($request->isMethod('post')) 
        {   
            // pr($request->all(),1);
            $str_request_random_time_stamp_new = $request->input('admin_add_edit_profile.random_time_stamp_new');
          
            //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
			$regex = UtilitiesTwo::get_regular_exp_format();

            if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    $social_url[] = $socials;
                }
                $request->merge([
                    'socials' => $social_url,
                ]);
            }
            $request->merge([
                'website' => $request->website,
            ]);

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                //'socials.*' => 'sometimes|nullable|regex:'.$regex
             ];
             
           if(empty($user_id))
            {
                $rules['password'] =  'required';
            }               
            
            $rules['description'] =  'required';
            $rules['dial_code'] =  'required';
            // $rules['mobile'] =  'required|size:10';
            if(empty($user_id))
            {
                $rules['email'] =  'required|email|unique:users'; 
            }
            elseif ($user_id) {
               $rules['email'] =  'required|email|unique:users,email,'.$user_id; 
            }

            if ($request->hasFile('profile_image')){
               $rules['profile_image'] =  'max:'.Config::get('commonconfig.max_file_upload_size_new'); 
            }
			
			
			$rules = $this->chkBatchValidation($request, '', $rules);
			
            //$rules['email'] =  'required|email';
            // $rules['postal_address'] =  'required';
            //$rules['city'] =  'required';
            //$rules['state'] =  'required';
            //$rules['zip_code'] =  'required';
            $rules['country_id'] =  'required';
            $rules['skills'] =  'required';
            
		    $rules = UtilitiesFour::chkUrlWebsite($rules, 'website');
			$rules = UtilitiesFour::chkUrlWebsite($rules, 'socials.*');
		
            //$rules['website'] =  'sometimes|nullable|regex:'.$regex;
            // $rules['dobday'] =  'required';
            // $rules['dobmonth'] =  'required';
            // 'website' => 'required|url',
            
               /*'description' => 'required',
                'mobile' => 'required|size:10',
                'email'  => 'required|email',
                //'gender' => 'required',
                'dial_code' => 'required',
                // 'dob' => 'required',
                'dobday'    => 'required',
                'dobmonth'  => 'required',
                // 'skills' => 'required',
                 'postal_address' => 'required',
                 'city' => 'required',
                 'state' => 'required',
                 'zip_code' => 'required',
                 'country_id' => 'required',
                 'skills' => 'required',
                // 'business_address' => 'required',
                // 'contact_info.agent_name' => 'required',
                // 'contact_info.agent_email_id' => 'required',
                // 'contact_info.manager_name' => 'required',
                // 'contact_info.manager_email_id' => 'required',
                // 'contact_info.legal_name' => 'required',
                // 'contact_info.legal_email_id' => 'required',
                // 'contact_info.company_name' => 'required',
                // 'contact_info.company_email_id' => 'required',
                // 'socials' => 'required|array',
                //'roles' => 'required|array',*/
         
            //$niceNames = array();
            $niceNames = [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'description' => 'Innovator Description',
                'mobile' => 'Primary Mobile',
                'email' => 'Primary Email',
                'dial_code' => 'Dial Code',
                'dobday' => 'Date of Birth',
                'dobmonth' => 'Month of Birth',
                'postal_address' => 'Postal Address',
                'city' => 'City',
                'state' => 'State',
                'zip_code' => 'Postalcode/Zipcode',
                'country_id' => 'Country',
                'skills' => 'Skills',            
                'password' =>  'Password'   
            ];

            $name = [
                'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address'
            ];
            
            $this->validate($request, $rules, $name, $niceNames);

            try 
            {
                // Start Transaction
                \DB::beginTransaction();

                if(!empty($user_id))
                {
                   $user = \App\Models\User::find($user_id);
                }
                else
                {
                   $user = new \App\Models\User();  
                   $user->password = bcrypt($request->password);
                   $user->type_of_user = 3;
                   $user->created_by = 1;
                }               
                
                $user->first_name =  $request->first_name;   
                $user->last_name =  $request->last_name;   
                
                if(!empty($request->role))
                {
                   $user->role =  $request->role;   
                }
                
                $user->email =  $request->email;
                $user->hide_email =  $request->hide_email;    
                $user->gold =  $request->gold;                
                //$user->username = $request->username;
                // $user->gender = $request->gender;
                $user->pronoun = $request->pronoun;
                // $user->dob    = $request->dob;
                $user->dobday    = $request->dobday;
                $user->dobmonth    = $request->dobmonth;
                $user->dobyear    = $request->dobyear;
                $user->description = $request->description;
                $user->postal_address = $request->postal_address;
                $user->state = $request->state;

                $this->saveSkillsData($request, $user, $rules);
                
				if(!empty($request->phone_number))
                {
                   $user->phone_number = $request->phone_number;    
                }
                $user->mobile = $request->mobile;
                $user->dial_code = $request->dial_code;
                $user->city = $request->city;
                $user->zip_code = $request->zip_code;
                $user->country_id = $request->country_id;
                $user->website = $request->website;
                $user->business_address = $request->business_address;
                $user->state_business = $request->state_business;
                $user->zip_code_business = $request->zip_code_business;
                $user->city_business = $request->city_business;
                $user->country_id_business = $request->country_id_business;

                $user->fun_fact1 = $request->fun_fact1;
                $user->fun_fact2 = $request->fun_fact2;
                $user->fun_fact3 = $request->fun_fact3;
                
                if(!empty($request->secondary_phone_number))
                {
                   $user->secondary_phone_number = $request->secondary_phone_number;    
                }
                if(!empty($request->secondary_mobile))
                {
                   $user->secondary_mobile = $request->secondary_mobile;
                }
                if(!empty($request->secondary_email))
                {
                   $user->secondary_email = $request->secondary_email;
                }
                $user->no_of_employees = $request->no_of_employees;
                $user->company_category_id = $request->company_category_id;
                if ($request->hasFile('profile_image')) {

                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->profile_image;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '_users_' . '.' . $extension;
                        $file_path = $this->_usersPhotosFolder;
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $user->profile_image = $filename;
                        } else {
                            // Rollback Transaction
                            //DB::rollBack();
                            $message = ['msg' => errorMessage('file_uploading_failed')];
                            return response()->json($message, 422);
                        }
                    // Shubham Code For Image Compression End //
                }
				
				$this->saveBatchImage($request, $user, $rules);
                
                $user->stripe_id = $str_time;
				$user->home_page_slide_show_caption = @$request->home_page_slide_show_caption;
                $user->caption_url = @$request->caption_url;
            
                $user->save();
                
                $user_id = $user->id;

                
                InventorContactInformation::where('user_id', $user_id)->delete();
                if ($request->filled('contact_info')) {
                        $contact_info =  InventorContactInformation::where('user_id', $user_id)->first();
                        if (!$contact_info) {
                            $contact_info = new InventorContactInformation();
                            $contact_info->user_id = $user_id;
                        }
                        foreach ($request->only(
                                'contact_info.agent_name',
                                'contact_info.agent_email_id',
                                'contact_info.manager_name',
                                'contact_info.manager_email_id',
                                'contact_info.legal_name',
                                'contact_info.legal_email_id',
                                'contact_info.company_name',
                                'contact_info.company_email_id',
                                'contact_info.company_phone',
                            ) as $value) {
                                foreach ($value as $key => $contact) {
                                    if (!is_null($contact)) {
                                        $contact_info->$key = $contact;
                                    }
                                }
                        }
                    $contact_info->save();
                }

                $contact_info =  InventorContactInformation::where('user_id', $user_id)->first();

                if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
                    $social_media =  UserSocialMedia::where('user_id', $user_id)
                            ->where('type', $key)
                            ->first();
                        
                       if (!empty($social_media->id)) {
                            $social_media = \App\Models\UserSocialMedia::find($social_media->id);
                        }
                        else
                        {
                           if (empty($socials)) {
                                continue;
                           }
                                            
                            $social_media = new UserSocialMedia();
                        }   
                        
                        $social_media->user_id = $user_id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    
                }
            }
            
                $arr_add_edit_profile_role = $request->add_edit_profile_role;
            
                // Commit Transaction
                \DB::commit();
                $response = ['msg' => adminTransLang('data_saved_successfully')];
                Session::flash('user_data_saved_flag', 1);
                return response()->json($response, 200);
            } catch (\Illuminate\Database\QueryException $e) {
                // Rollback Transaction
                \DB::rollBack();

                errorMessage($e->errorInfo[2], true);
            }
        }
            
        $user = \App\Models\User::find($user_id);
        
        //if(!empty($user->role))
        //{
           $role_type_data_new = UtilitiesTwo::getRoleText($int_role_type_id_data_new); 
        //}
        
        $users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }

        // pr($ip_data,1);
                
        return view('admin.users.add_update_basic_user', ['str_random_time_stamp_new' => $str_random_time_stamp_new, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 
        'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'role_type_data_new' => $role_type_data_new,
        'user_id' => $user_id,'users_user_roles' => $users_user_roles,'ip_data' => $ip_data, 'int_role_type_id_data_new' => $int_role_type_id_data_new]);   
    }

    public function showEditFree_users(Request $request, $user_id)
    {
        // pr($request->all(),1);
        $user_id_edit_mode = $user_id;
        $str_time = time(); 
        $str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
        $role_type_data_new = '';
        $int_role_type_id_data_new = 2;

        if ($request->isMethod('post')) 
        {   
            $str_request_random_time_stamp_new = $request->input('admin_add_edit_profile.random_time_stamp_new');
          
            $rules = [
                'first_name' => 'required',
                'last_name'  => 'required',
                'mobile'     => 'required',
             ];
             
            if(empty($user_id))
            {
                $rules['email'] =  'required|email|unique:users'; 
            }
            elseif ($user_id) {
               $rules['email'] =  'required|email|unique:users,email,'.$user_id; 
            }

         
            //$niceNames = array();
            $niceNames = [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'mobile' => 'Primary Mobile',
                'email' => 'Primary Email',
            ];

            $name = [];
            
            $this->validate($request, $rules, $name, $niceNames);

            try 
            {
                // Start Transaction
                \DB::beginTransaction();

                $user = \App\Models\User::find($user_id);
                $user->first_name =  $request->first_name;   
                $user->last_name =  $request->last_name;   
                $user->email =  $request->email;
                $user->mobile = $request->mobile;
                $user->stripe_id = $str_time;
                $user->save();
                
                $user_id = $user->id;


            if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
                    $social_media =  UserSocialMedia::where('user_id', $user_id)
                            ->where('type', $key)
                            ->first();
                        
                       if (!empty($social_media->id)) {
                            $social_media = \App\Models\UserSocialMedia::find($social_media->id);
                        }
                        else
                        {
                           if (empty($socials)) {
                                continue;
                           }
                                            
                            $social_media = new UserSocialMedia();
                        }   
                        
                        $social_media->user_id = $user_id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    
                }
            }
            
                $arr_add_edit_profile_role = $request->add_edit_profile_role;
            
                // Commit Transaction
                \DB::commit();
                $response = ['msg' => adminTransLang('data_saved_successfully')];
                Session::flash('user_data_saved_flag', 1);
                return response()->json($response, 200);
            } catch (\Illuminate\Database\QueryException $e) {
                // Rollback Transaction
                \DB::rollBack();

                errorMessage($e->errorInfo[2], true);
            }
        }
            
        $user = \App\Models\User::find($user_id);
        
        //if(!empty($user->role))
        //{
           $role_type_data_new = UtilitiesTwo::getRoleText($int_role_type_id_data_new); 
        //}
        
        $users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }

        // pr($ip_data,1);
                
        return view('admin.users.add_update_free_user', ['str_random_time_stamp_new' => $str_random_time_stamp_new, 'arr_roles_list' => $arr_roles_list, 'user' => $user, 
        'countries' => $countries , 'arr_role_at_list' => $arr_role_at_list, 'role_type_data_new' => $role_type_data_new,
        'user_id' => $user_id,'users_user_roles' => $users_user_roles,'ip_data' => $ip_data, 'int_role_type_id_data_new' => $int_role_type_id_data_new]);   
    }


    public function getIndexCompany()
    {
        return view('admin.users.indexCompany');
    }

    public function getListCompany()
    {
        $users = \App\Models\User::select(['id', DB::raw("CONCAT(first_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at', 'is_news_feeds'])->where('role', 3);
		//->orderBy('id','desc');
		
        $users->where("type_of_user", 2);
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name) like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $query->whereRaw("CONCAT(dial_code, ' ', mobile) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);              
            })
            ->editColumn('news_feeds_checked', function ($query) {
                if($query->is_news_feeds == 1){
                    return 'checked';
                }else{
                    return '';
                }
            })
            ->make();
    }

    public function getViewCompany($id = null)
    {
        $user = \App\Models\User::find($id);
        if (!$user) {
            return redirect()->route('admin.companies.index')->with(['fail' => adminTransLang('user_not_found')]);
        }
        $user->profile_image = imageBasePath($user->profile_image);

        $user_status = config('cms.user_status');
        $user->status = $user_status[$user->status];
		
		$role_data = Role::get_role_data($id, 0);
		
		$users_user_roles = UsersUserRole::pluck('role_name','id');
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();

        return view('admin.users.viewCompany', ['arr_roles_list' => $arr_roles_list, 'arr_role_at_list' => $arr_role_at_list, 'users_user_roles', $users_user_roles, 'user' => $user, 'role_data' => $role_data]);
    }


    public function showAddCompany(Request $request)
    {
        echo $this->saveAddEditCompany($request, 0);
        
    }

    public function showEditCompany(Request $request, $user_id)
    {
        echo $this->saveAddEditCompany($request, $user_id);
    }

    public function FunctionName(Request $request)
    {
        $companies = User::where('type_of_user', 2)->where('role', 3)->select('id','role','type_of_user')->get()->toArray();
        foreach ($companies as $key => $value) {
            $subscriptions = UserSubscription::where('user_id', $value['id'])->orderBy('id','desc')->first();
            $subscriptions->plan_id = 4;
            $subscriptions->save();
            pr($subscriptions);
        }
        pr($companies,1);
    }

    public function saveAddEditCompany(Request $request, $user_id)
    {
        $user_id_edit_mode = $user_id;
        $str_time = time();
		$str_random_time_stamp_new = UtilitiesTwo::getUniqueTimeStamp();
		$role_type_data_new = '';
		$int_role_type_id_data_new = 3;

        if ($request->isMethod('post')) 
        {
			$str_request_random_time_stamp_new = $request->input('admin_add_edit_profile.random_time_stamp_new');
            
            //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
			$regex = UtilitiesTwo::get_regular_exp_format();

            if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    $social_url[] = $socials;
                }
                $request->merge([
                    'socials' => $social_url,
                ]);
            }

			/*$rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'description' => 'required',
                'mobile' => 'required|size:10',
                'dial_code' => 'required',
                //'socials' => 'required|array',
            ];    
            if(empty($user_id))
            {
                $rules['password'] =  'required';
                $rules['email'] =  'required|email|unique:users'; 
            }
            elseif ($user_id) {
               $rules['email'] =  'required|email|unique:users,email,'.$user_id; 
            }*/
			
			$rules = [
                'first_name' => 'required',
                // 'last_name' => 'required',
                //'socials.*' => 'sometimes|nullable|regex:'.$regex,
                'hide_email' => 'sometimes|nullable'
             ];
			 
           if(empty($user_id))
            {
                $rules['password'] =  'required';

            }   			
			
			$rules['country_id'] =  'required';
			$rules['description'] =  'required';
			$rules['dial_code'] =  'required';
			// $rules['mobile'] =  'required|size:10';
			if(empty($user_id))
            {
                $rules['email'] =  'required|email|unique:users'; 
            }
            elseif ($user_id) {
               $rules['email'] =  'required|email|unique:users,email,'.$user_id; 
            }    
			
			$rules = UtilitiesFour::chkUrlWebsite($rules, 'socials.*');

            if ($request->hasFile('profile_image')){
               //$rules['profile_image'] =  'max:'.Config::get('commonconfig.max_file_upload_size_new').'|dimensions:ratio=2/2';
                 $rules['profile_image'] =  'max:'.Config::get('commonconfig.max_file_upload_size_new');			   
            }     
			
		     $niceNames = [
                'first_name' => 'First Name',
                // 'last_name' => 'Last Name',
                'description' => 'Company Description',
                'mobile' => 'Primary Mobile',
                'email' => 'Primary Email',
                'dial_code' => 'Dial Code',
                'password' =>  'Password',
                'country_id' =>  'Country'				
            ];

            $name = [
                // 'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address'
                'socials.*' => 'Socials URL format is Invalid.'
            ];
		 
            $this->validate($request, $rules, $name, $niceNames);
            try 
            {
                // Start Transaction
                \DB::beginTransaction();

                if(!empty($user_id))
                {
                   $user = \App\Models\User::find($user_id);
                }
                else
                {
                   $user = new \App\Models\User();  
                   $user->password = bcrypt($request->password);
                   $user->type_of_user = 2;
                }               
                
                $user->first_name =  $request->first_name;   
                $user->last_name =  $request->last_name;               
                $user->acronym =  $request->acronym;    
                $user->gold =  $request->gold;                               
                $user->company_category_id =  $request->company_category_id;               
                $user->role =  3;   
                
                $user->email =  $request->email;                
                $user->hide_email =  $request->hide_email;
				$user->description = $request->description;
                $user->mobile = $request->mobile;
                $user->dial_code = $request->dial_code;
				$user->country_id = $request->country_id;
				
				$str_skills_data = '';
				$arr_skills = array();
				
				if(!empty($request->skills) && strpos($request->skills, ',')>0)
				{
				   $arr_skills = explode(',', @$request->skills);	
				}
				else
				{
				   $arr_skills = @$request->skills;	
				}				

                Skill::save_skill_data($arr_skills);
				
				$str_skills_data = UtilitiesFour::get_skills_list($arr_skills);

				$user->services = $str_skills_data;
				
                if ($request->hasFile('profile_image')) 
                {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->profile_image;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '_users_' . '.' . $extension;
                        $file_path = $this->_usersPhotosFolder;
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $user->profile_image = $filename;
                        } else {
                            // Rollback Transaction
                            //DB::rollBack();
                            $message = ['msg' => errorMessage('file_uploading_failed')];
                            return response()->json($message, 422);
                        }
                    // Shubham Code For Image Compression End //
                }
                
                $user->save();
                
                $user_id = $user->id;

                /*Create subscription with plan Start*/
                if(empty($user_id_edit_mode))
                {
					
					$role_update = Role::where('random_unique_timestamp', $str_request_random_time_stamp_new)
				->update(['user_id' => $user_id, 'company_id' => $user_id]);
					
                    $plan = Plan::find(4);
                    
                    $subscription = new UserSubscription();
                    $subscription->user_id = $user_id;
                    $subscription->plan_id = $plan->id;
                    $subscription->price = $plan->price;
                    $subscription->validity = $plan->validity;
                    $subscription->ends_at = Carbon::now()->addDay($plan->validity);
                    $subscription->payment_status = 2;
                    $subscription->stripe_id = $str_time;
                    $subscription->stripe_plan_id = $plan->stripe_plan_id;
                    $subscription->stripe_subscription_id = 0;
                    $subscription->save();
                
                    $user->stripe_id = $str_time;                   
                    $user->save();                  
                }

                /*Create subscription with plan end*/
                
                /*if ($request->filled('socials')) {
                    foreach ($request->socials as $key => $socials) {
                        if (!is_null($socials)) {
                            $social_media =  UserSocialMedia::where('user_id', $user_id)
                                ->where('type', $key)
                                ->first();
                            if (!$social_media) {
                                $social_media = new UserSocialMedia();
                                $social_media->user_id = $user_id;
                            }
                            $social_media->type = $key;
                            $social_media->value = $socials;
                            $social_media->save();
                        }
                    }
                }*/

                 if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
					$social_media =  UserSocialMedia::where('user_id', $user_id)
                            ->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\UserSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new UserSocialMedia();
						}	
						
						$social_media->user_id = $user_id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    
                }
            }                

                \DB::commit();
                $response = ['msg' => adminTransLang('data_saved_successfully')];
                Session::flash('user_data_saved_flag', 1);
                return response()->json($response, 200);
            } catch (\Illuminate\Database\QueryException $e) {
                \DB::rollBack();

                errorMessage($e->errorInfo[2], true);
            }
        }
            
        $user = \App\Models\User::find($user_id);
		
		//if(!empty($user->role))
		//{
		   $role_type_data_new = UtilitiesTwo::getRoleText($int_role_type_id_data_new);	
		//}
                
        $countries = Country::pluck('country_name', 'id');
        $arr_role_at_list = Utilities::get_roles_at_list();
        $arr_roles_list = Utilities::get_roles_list();
        $categories = CompanyCategory::select('*')->get();

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }	
		
		$str_dial_code = '';
        $str_mobile_no = '';
		$str_mobile_no_new = '';
		
		if(!empty(@$user->dial_code))
		{
		  $str_dial_code = @$user->dial_code;	
		}
		
		if(!empty(@$user->mobile))
		{
		  $str_mobile_no = @$user->mobile;	
		}

        $str_mobile_no_new = UtilitiesTwo::get_mobile_no_data(@$str_dial_code, @$str_mobile_no); 		
		
        return view('admin.users.add_update_company',['str_random_time_stamp_new' => $str_random_time_stamp_new, 
		'str_dial_code' => $str_dial_code, 'str_mobile_no' => $str_mobile_no, 'str_mobile_no_new' => $str_mobile_no_new,
		'arr_roles_list' => $arr_roles_list, 'user' => $user, 'countries' => $countries , 
		'arr_role_at_list' => $arr_role_at_list, 'user_id' => $user_id,'ip_data' => $ip_data, 
		'role_type_data_new' => $role_type_data_new, 'int_role_type_id_data_new' => $int_role_type_id_data_new,'categories' => $categories]);
    }

    public function getPayments()
    {
        return view('admin.users.payments');
    }

    public function getPaymentList()
    {
        $payments =DB::table('user_subscriptions')
                ->join('users','users.id', '=', 'user_subscriptions.user_id')
                ->select('user_subscriptions.*','users.email','users.first_name',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"))
                ->where('plan_id',2)->orderBy('id','desc');
        // pr($payments->get()->toArray());
        return \DataTables::of($payments)
            ->filterColumn('email', function ($query, $keyword) {
                $query->whereRaw("users.email like ?", ["%$keyword%"]);
            })
            // ->filterColumn('created_at', function ($query, $keyword) {
            //     $query->whereRaw("created_at like ?", ["%$keyword%"]);
            // })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(users.first_name, ' ', users.last_name) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            // ->editColumn('type', function ($query) {
            //     return GetInnovatorRoles([$query->type]);
            // })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("user_subscriptions.status", $keyword);              
            })
            ->make();
    }

    public function getPaymentView($id = null)
    {
        $payments = UserSubscription::find($id);
        $payments =DB::table('user_subscriptions')
                ->join('users','users.id', '=', 'user_subscriptions.user_id')
                ->select('user_subscriptions.*','users.email',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"))
                ->where('plan_id',2)->where('user_subscriptions.id', $id)->first();
        if (!$payments) {
            return redirect()->route('admin.payments')->with(['fail' => adminTransLang('user_not_found')]);
        }

        $user_status = config('cms.user_status');
        $payments->status = $user_status[$payments->status];

        return view('admin.users.payment_view', ['payments' => $payments]);
    }


    public function getTransactions()
    {
        return view('admin.users.transactions');
    }

    public function getTransactionList()
    {

        $transactions = User::where(['created_by'=>2])->where('type_of_user','!=',1)->where('role','!=',1)
                        ->orderBy('id','desc');
        // pr($transactions->get()->toArray(),1);

        return \DataTables::of($transactions)
            ->filterColumn('email', function ($query, $keyword) {
                $query->whereRaw("email like ?", ["%$keyword%"]);
            })
            // ->filterColumn('created_at', function ($query, $keyword) {
            //     $query->whereRaw("created_at like ?", ["%$keyword%"]);
            // })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
            })
            ->filterColumn('stripe_subscription_id', function ($query, $keyword) {

            })
            ->editColumn('stripe_subscription_id', function ($query) {
                return getSubscription($query->id);
            })
            ->editColumn('price', function ($query) {
                return getSubscription($query->id);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            // ->editColumn('type', function ($query) {
            //     return GetInnovatorRoles([$query->type]);
            // })
            // ->filterColumn('status', function ($query, $keyword) {
            //     $keyword = strtolower($keyword) == "active" ? 1 : 0;
            //     $query->where("gold", $keyword);              
            // })
            ->make();
    }

    public function getNewsletter()
    {
        return view('admin.users.newsletter');
    }

    public function getNewsletterList(Request $request)
    {

        // $users = DB::table('user_subscriptions')
        //         ->join('users','users.id', '=', 'user_subscriptions.user_id')
        //         ->select('user_subscriptions.plan_id','users.id','users.email','users.first_name',DB::raw("users.id AS type"),DB::raw("users.id AS newsletter_type"),DB::raw("CONCAT(first_name,' ',last_name) AS name"),'users.role','users.status','users.created_at','users.zip_code', 'users.country_id')
        //         ->where('users.newsletter', 1)->orderBy('users.id','desc');

        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"),DB::raw("id AS newsletter_type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at','zip_code', 'country_id','type_of_user'])->where('newsletter', 1);
        
        if(isset($request->type) && !empty($request->type) && $request->type == 1){
            $users = $users->where(function ($query) {
                            $query->where('type_of_user', '=', 1)
                            ->orWhere('type_of_user', '=', 3);
                    });
        } else if(isset($request->type) && !empty($request->type) && $request->type == 2){
            $users = $users->where('type_of_user', '=', 2);
        } 
        
        // pr($users->get()->toArray());
        
        return \DataTables::of($users)
            ->filterColumn('type', function ($query, $keyword) {
                return;
            })
            ->filterColumn('newsletter_type', function ($query, $keyword) {
                return;
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $query->whereRaw("CONCAT(dial_code, ' ', mobile) like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->editColumn('type', function ($query) {
                return GetRoleType([$query->type]);
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->editColumn('type_of_user', function ($query) {
                if ($query->type_of_user == 2) {
                    return config('cms.newsletter_type')[2];
                } else if(!empty($query->type_of_user) && ($query->type_of_user == 1 || $query->type_of_user == 3)) {
                    return config('cms.newsletter_type')[1];
                } else {
                    return config('cms.newsletter_type')[1];
                }
            })
            // ->editColumn('newsletter_type', function ($query) {
            //     // $roles =    UserSubscription::where('user_id' , $query->newsletter_type)->first();
            //     $roles = $query->plan_id;
            //     if(!empty($roles) && ($roles == 1 || $roles == 3))
            //     {
            //         return config('cms.newsletter_type')[1];
            //     }
            //     else if(!empty($roles) && ($roles == 2 || $roles == 4))
            //     {
            //         return config('cms.newsletter_type')[2];
            //     } else {
            //         return config('cms.newsletter_type')[1];
            //     }
            // })
            ->editColumn('country_id', function ($query) {
                $countries = Country::pluck('country_name', 'id');
                if(!empty($query->country_id) ) {
                  $country_id = $query->country_id;
                }
                else {
                  $country_id = 234; 
                }
                foreach($countries as $id => $name) {
                    if($id == $country_id){
                        return $name;
                    }
                }
            })
            ->make();
    }

     public function getReports()
    {
        return view('admin.users.reports');
    }

    public function getReportsList(Request $request)
    {
        $reports = Report::select('*');
        
        return \DataTables::of($reports)
            ->editColumn('type', function ($query) {
                if ($query->type == 1) {
                    return 'Image';
                } else if($query->type == 2) {
                    return 'Video';
                } else if($query->type == 3){
                    return 'Known For';
                } else if($query->type == 0){
                    return 'Profile';
                } else if($query->type == 4){
                    return 'Product';
                } 
            })
             ->editColumn('url', function ($query) {
                return ($query->type == '0' || $query->type == '4') ? $query->url : galleryImageBasePath(@$query->url);
                // return galleryImageBasePath(@$query->url);
            })
            ->make();
    }

    function excel(Request $request)
    {
        $fileName = 'newsletter-all-'.time().'.csv';

        // $users = DB::table('user_subscriptions')
        //         ->join('users','users.id', '=', 'user_subscriptions.user_id')
        //         ->select('user_subscriptions.plan_id','users.id','users.email','users.first_name',DB::raw("users.id AS type"),DB::raw("users.id AS newsletter_type"),DB::raw("CONCAT(first_name,' ',last_name) AS name"),'users.role','users.status','users.created_at','users.zip_code', 'users.country_id')
        //         ->where('users.newsletter', 1);

        // if(isset($request->type) && !empty($request->type) && $request->type == 1){
        //     $fileName = 'newsletter-'.config('cms.newsletter_type')[1].'-'.time().'.csv';
        //     $users = $users->where(function ($query) {
        //                     $query->where('user_subscriptions.plan_id', '=', 1)
        //                     ->orWhere('user_subscriptions.plan_id', '=', 3);
        //             });
        // } else if(isset($request->type) && !empty($request->type) && $request->type == 2){
        //     $fileName = 'newsletter-'.config('cms.newsletter_type')[2].'-'.time().'.csv';
        //     $users = $users->where(function ($query) {
        //                     $query->where('user_subscriptions.plan_id', '=', 2)
        //                     ->orWhere('user_subscriptions.plan_id', '=', 4);
        //             });
        // }
        // $users = $users->orderBy('users.id','desc')->get();

        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"),DB::raw("id AS newsletter_type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at','zip_code', 'country_id','type_of_user'])->where('newsletter', 1);
        
        if(isset($request->type) && !empty($request->type) && $request->type == 1){
            $users = $users->where(function ($query) {
                            $query->where('type_of_user', '=', 1)
                            ->orWhere('type_of_user', '=', 3);
                    });
        } else if(isset($request->type) && !empty($request->type) && $request->type == 2){
            $users = $users->where('type_of_user', '=', 2);
        } 

        $users = $users->orderBy('id','desc')->get();

        $tasks = array();
        if (!empty($users)) {
            foreach ($users as $key => $value) {
                // $roles = $value->plan_id;
                // if(!empty($roles) && ($roles == 1 || $roles == 3))
                // {
                //     $Newsletter_Type =  config('cms.newsletter_type')[1];
                // }
                // else if(!empty($roles) && ($roles == 2 || $roles == 4))
                // {
                //     $Newsletter_Type =  config('cms.newsletter_type')[2];
                // } else {
                //     $Newsletter_Type =  config('cms.newsletter_type')[1];
                // }

                if ($value->type_of_user == 2) {
                    $Newsletter_Type =  config('cms.newsletter_type')[2];
                } else if(!empty($value->type_of_user) && ($value->type_of_user == 1 || $value->type_of_user == 3)) {
                    $Newsletter_Type =  config('cms.newsletter_type')[1];
                } else {
                    $Newsletter_Type =  config('cms.newsletter_type')[1];
                }

                $countries = Country::pluck('country_name', 'id');
                if(!empty($value->country_id) ) {
                  $country_id = $value->country_id;
                }
                else {
                  $country_id = 234; 
                }
                foreach($countries as $id => $name) {
                    if($id == $country_id){
                        $country_name =  $name;
                    }
                }
                
                $tasks[] = array(
                    'Name'      => ($value->name) ? $value->name : $value->first_name,
                    'Email'     => $value->email,
                    'Role'      => GetRoleType([$value->type]),
                    'Zip_Code'  => $value->zip_code,
                    'Registered_On'     => $value->created_at,
                    'Country'           => $country_name,
                    'Newsletter_Type'   => $Newsletter_Type,
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

        $columns = array('Name', 'Email', 'Role', 'Newsletter Type', 'Country', 'Zip Code', 'Registered On');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['Name']    = $task['Name'];
                $row['Email']    = $task['Email'];
                $row['Role']        =    $task['Role'];
                $row['Newsletter Type']  = $task['Newsletter_Type'];
                $row['Country']  = $task['Country'];
                $row['Zip Code']  = $task['Zip_Code'];
                $row['Registered On']  = $task['Registered_On'];

                fputcsv($file, array($row['Name'], $row['Email'], $row['Role'], $row['Newsletter Type'], $row['Country'],$row['Zip Code'], $row['Registered On']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function cancel_subscription($id)
    {
        $user = User::find($id);
        Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

        try {
            $subscription = $user->subscription;
            $subscription_id = $subscription->stripe_subscription_id;

            $subscription_data = Subscription::retrieve(
                                    $subscription_id,
                                );

            $subscription_data->cancel();

            $user->gold = 2;
            $user->save();

            return successMessage('Subscription cancel successfully');
        } catch (\Exception $e) {
            return errorMessage($e->getMessage(), true);
        }
    } 

    public function refund_subscription($id)
    {
        $user = User::find($id);
        Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

        try {
            $subscription = $user->subscription;
            $subscription_id = $subscription->stripe_subscription_id;

            $subscription_data = Subscription::retrieve(
                                    $subscription_id,
                                );

            // $subscription_data->cancel();
            $subscription_data->cancel([
                'prorate' => true
            ]);

            $user->gold = 3;
            $user->save();
            // pr($user,1);

            return successMessage('Subscription cancel successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

     
	 
	// cancel a user subscription in stripe and update in subscriptions table
	 function admin_cancel_user_stripe_subscription($user)
	 {
		 Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
		 
		 $str_date_time = date('Y-m-d H:i:s');
		 
		 if(!empty($user->subscription))
						{
							$pre_plan = $subscript = $user->subscription;
							$subscription_id = $subscript->stripe_subscription_id;
							
							if (!empty($subscription_id)) {
								$subscription_data = Subscription::retrieve(
														$subscription_id,
													);
													
								if($subscription_data->status!='canceled')					
								{
								   $subscription_data->cancel();

                                   DB::table('user_subscriptions')
									->where('stripe_subscription_id', $subscription_id)
									->update(['status' => 4, 'cancelled_at' => $str_date_time]);
			
								}				
										
							}
					   }
		    
	 }


     // delete a user in stripe
	 function admin_delete_user_stripe($user)
	 {
		 Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
		 
		 if(!empty($user->stripe_id) && strpos($user->stripe_id, 'us_')>0)
						{
							
							if (!empty($user->stripe_id)) {
								$customer_data = Customer::retrieve(
														$user->stripe_id,
													);
													
								if(!empty($customer_data->id))					
								{
								   $customer_data->delete();//[$customer_data->id], []
								}				
										
							}
					   }
		    
	 } 





    public function verify_getIndex()
    {
        return view('admin.users.indexVerify');
    }

    public function verify_getList()
    {
        $users = \App\Models\User::select(['id','first_name',DB::raw("id AS type"), DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'role','email', 'dial_code', 'mobile', 'status', 'created_at','is_verify_profile'])->where('role', '!=' ,3);
       // $users->whereIn("type_of_user", [1]);//->orderBy('id', 'DESC');
        // $users = $users->where("type_of_user", 2)->orderBy('id', 'DESC');
        // pr($users->get()->toArray(),1); 
        // die('amit');
        return \DataTables::of($users)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$keyword%"]);
            })
            
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->editColumn('name', function ($query) {
                return $retVal = ($query->name) ? $query->name : $query->first_name ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->addColumn('action', function ($query) {
                if($query->is_verify_profile ==1) {
                    $is_verify_profile_user = '<a href="javascript:void(0);" onclick="profileVerify(this,'.$query->id.',0);">Verified</a>';
                } else {
                    $is_verify_profile_user = '<a href="javascript:void(0);" onclick="profileVerify(this,'.$query->id.',1);">Not verified</a>';
                }
                return $is_verify_profile_user ;
                // return GetInnovatorRoles([$query->type]);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);              
            })
            ->make(['action']);
    }


    public function statusChange(Request $request)
    {
       $id = $request->id;
       $type = $request->type;
       if($type == 1) {
        $msg ="User profile verify successfully";
       } else {
         $msg ="User profile verify not successfully";
       }
       User::where('id',$id)->update(['is_verify_profile'=>$type]);
       echo json_encode(['success'=>1,'msg'=>$msg]);
    }


}

