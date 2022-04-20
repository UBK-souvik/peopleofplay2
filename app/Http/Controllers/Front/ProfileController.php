<?php

namespace App\Http\Controllers\Front;

use Exception;
use App\Models\Blog;
use App\Models\Social_media_setting;
use App\Models\Dictionary;
use App\Models\Skill;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\BrandList;
use App\Models\Country;
use App\Models\MetaData;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Models\UserGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\InventorAward;
use App\Models\UserSocialMedia;
use App\Models\EventAwardNominee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\Hash;
use App\Models\InventorContactInformation;
use Str;
use Session;
use Config;
use App\Rules\WebsiteValidation;
use Validator;
use Auth;


class ProfileController extends ModuleController
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    function __construct()
    { 
        parent::__construct();
    }
    
    // list of people for auto complete
    public function getPeopleData(Request $request)//, $p*/eople_id
    { 
        $searchTerm = $request->searchTerm;
        $data_list = User::get_people_search_by_name($searchTerm);
        echo $data_list->toJson();                  
    }
    
    // list of companies for auto complete
    public function getCompanyData(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $data_list = User::get_company_search_by_name($searchTerm);
        echo $data_list->toJson();                  
    }
    
    // list of products for auto complete
    public function getProductData(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $data_list = Product::get_product_search_by_name($searchTerm);
        echo $data_list->toJson();                  
    }
    
    // list of brandlist for auto complete
    public function getBrandListData(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $data_list = BrandList::get_brand_list_search_by_name($searchTerm);
        echo $data_list->toJson();                  
    }
    
    // list of dictionary for auto complete
    public function getDictionaryListData(Request $request)
    {
        $searchTerm = $request->searchTerm;
        $data_list = Dictionary::get_dictionary_list_search_by_name($searchTerm);
        echo $data_list->toJson();                  
    }

    public function getProfile()
    {
        $current_user = get_current_user_info();
        $user_id = $current_user->id;
        if ($current_user->type_of_user == 1) {
            return redirect()->route('front.user.free.edit.profile');
        }
        echo $this->getPageContentData(1, '', $user_id);
        //echo $this->getProfileContent('', $user_id);
    }

    public function getProfileEdit()
    {

        $current_user = get_current_user_info();
        if($current_user->role != 2 && $current_user->type_of_user == 1)
        {
            return redirect('/');
        }
        $user = User::select('users.home_page_slide_show_caption','users.country_id','users.dial_code','users.first_name','users.last_name','users.name','users.id','users.profile_image','users.website','users.acronym','users.pronoun','users.description',
            'users.hide_email','users.hide_telephone','users.hide_secondary_email','users.email','users.mobile','users.virtual_show_room',
            'users.fun_fact1','users.fun_fact2','users.fun_fact3','users.dobday','users.dobmonth','users.phone_number','users.secondary_phone_number',
            'users.secondary_email','users.secondary_mobile','users.postal_address','users.city','users.state','users.zip_code','users.business_address',
            'users.city_business','users.state_business','users.zip_code_business','users.country_id_business','users.dobyear','users.role',
            'users.skills','users.gender','users.badge_1','users.badge_2','users.badge_3','users.badge_4','users.badge_5')->where('id', $current_user->id)
        ->with([
            'inventorContactInfo',
            'galleries',
            'socialMedia',
            'inventorAwards',
            'roles'
        ])
        ->firstOrFail();

        // pr($user->country_id,1);
        $countries = Country::pluck('country_name', 'id');

        $arr_role_at_list = $this->_arr_role_at_list;       
        $arr_roles_list = Utilities::get_roles_list();
        $arr_get_company_users_list = User::get_company_users_list();
        $arr_get_people_users_list = User::get_people_users_list();
        $role_type_data_new = $role_type_data_new = UtilitiesTwo::getRoleText($current_user->role);
        
        $get_skill_list = Skill::get_skill_list();
        return view('front.profile.edit', compact('get_skill_list', 'arr_get_people_users_list', 'role_type_data_new', 'user', 'countries', 'arr_role_at_list', 'arr_roles_list', 'arr_get_company_users_list'));
    }

    public function get_tags(Request $request)
    {
        $postData = $request->all();
        $keyword = $postData['query'];
        $data = Skill::where('skill', 'like', '%' . $keyword . '%')->select('skill as name', 'id')->groupBy('skill')->get();
        return response()->json($data, 200);
    }

    public function get_tags_dropdown(Request $request)
    {
        $data_array = array();
        $postData = $request->all();
        //$keyword = $postData['query']['term'];
        $keyword = $postData['query'];
        $data = Skill::where('skill', 'like', '%' . $keyword . '%')->select('skill')->groupBy('skill')->get();
        
        if(!empty($data) && count($data)>0)
        {
            foreach($data as $data_row)
            {
                $data_array[] = $data_row->skill;
            }
        }
        
        $data_array = array_values($data_array);
        
        return $data_array;
    }

    public function postProfileEdit(Request $request)
    {
        // pr($request->all());
         //echo  $request->virtual_show_room; die;
      
        $current_user = get_current_user_info();
        $user = User::findOrFail($current_user->id);
        $name = [
            // 'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address'
            'socials.*' => 'Socials URL format is Invalid.'
        ]; 
        //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $regex = UtilitiesTwo::get_regular_exp_format();

        if ($request->filled('socials')) {
            foreach ($request->socials as $key => $socials) {
                $social_url[] = strtolower($socials);
            }
            $request->merge([
                'socials' => $social_url,
            ]);
        }

        // pr($request->socials,1);

        $rule = [       
            'first_name' => 'required',
            // 'last_name' => 'required',
            //'socials.*' => 'sometimes|nullable|regex:'.$regex,            
            'username' => 'nullable',
            //'gender' => 'nullable|in:Male,Female,Transgender',
            // 'dob' => 'nullable',
            'description' => 'nullable',
            'postal_address' => 'nullable',
            'city' => 'nullable',
            'skills' => 'nullable',
            'phone_number' => 'nullable',
            // 'mobile' => 'nullable',
            'zip_code' => 'nullable',            
          //regex:'.$regex
            'business_address' => 'nullable',
            'contact_info' => 'array',
            'contact_info.agent_name' => 'nullable',
            'contact_info.agent_email_id' => 'nullable',
            'contact_info.manager_name' => 'nullable',
            'contact_info.manager_email_id' => 'nullable',
            'contact_info.legal_name' => 'nullable',
            'contact_info.legal_email_id' => 'nullable',
            'contact_info.company_name' => 'nullable',
            'contact_info.company_email_id' => 'nullable',
            'gallery' => 'array',
            'gallery.photo' => 'array',
            'gallery.video' => 'array',
            'gallery.article' => 'array',
            'awards' => 'array',
            'roles' => 'array'
        ];
        
        $rule = UtilitiesFour::chkUrlWebsite($rule, 'website');
        $rule = UtilitiesFour::chkUrlWebsite($rule, 'socials');
       // $rule = UtilitiesFour::chkUrlWebsite($rule, 'virtual_show_room');
        
        $str_image_types = UtilitiesTwo::get_image_types_list();

        if($request->type == 'people') {
            $rule['profile_image'] =  $str_image_types. 'max:'.Config::get('commonconfig.max_file_upload_size_new'); 
        } else if($request->type == 'company') {
            //$rule['profile_image'] =  'max:'.Config::get('commonconfig.max_file_upload_size_new').'|dimensions:ratio=2/2';
            $rule['profile_image'] =  $str_image_types. 'max:'.Config::get('commonconfig.max_file_upload_size_new');
        }


        $rule['Email'] = 'required|unique:users,email,' . $user->id;
        if(!empty($request->secondary_email)){
            $rule['secondary_email'] = 'required|unique:users,secondary_email,'.$user->id.'|unique:users,email';

            // $check_user = User::where('email',$request->secondary_email)->orWhere('secondary_email',$request->secondary_email)->get();
            // echo "<pre>$user->id - "; print_r($check_user->toArray()); die;
            // if(@$check_user->email == $request->Email || @$check_user->secondary_email == $request->secondary_email){
            //     $rule['secondary_email'] = 'required|unique:users,secondary_email,'.$user->id.'|unique:users,email,'.$user->id;
            // }
        }
        //$request->validate($rule,$name);
        
        if($user->role == 2)
        {
            $rule['dobday'] = 'required';
            $rule['dobmonth'] = 'required';
            $rule['country_id'] = 'required|nullable|exists:countries,id';
         //  $request->validate([       
         //    'dobday' => 'required',
   //          'dobmonth' => 'required',
   //          // 'gender' => 'required',
            // 'country_id' => 'required|nullable|exists:countries,id',
   //        ]);    
        }
        

        $validator = Validator::make($request->all(), $rule ,  $name = [
            'first_name.required' => 'The First Name field is required.',
            'username.nullable' => 'The User Name field is nullable.',
            'Email.required' => 'The Email field is required.',
            // 'Email.unique' => 'The Email field is nullable.',
            'profile_image.max' => 'The Profile Image Size Invalid.',
            'description.nullable' => 'The Description field is nullable.',
            'postal_address.nullable' => 'The City field is nullable.',
            'city.nullable' => 'The Postal Address field is nullable.',
            'phone_number.nullable' => 'The Phone Number field is nullable.',
            // 'mobile.nullable' => 'The mMobile field is nullable.',
            'skills.nullable' => 'The Skills Address field is nullable.',
            'socials.required' => 'Socials URL format is Invalid.',
            'dobday.required' => 'The Day field is required.',
            'dobmonth.required' => 'The Month field is required.',
            'country_id.required' => 'The Country field is required.',
            'country_id.nullable' => 'The Country field is nullable.',
            'country_id.exists' => 'The Country field is exists.',

        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>0,'response'=>$validator->errors()->toJson()]);
        } else {
            // echo "SAdsa"; die;
            //   pr($request->all(),1); die;
       // try {

            // DB::beginTransaction();

           // echo "<pre>"; print_r($request->all()); die;
            /*if (!empty($request->username)) {
                $str_username = preg_replace('/\s+/', ',', $request->username);
                $arr_username = explode(",", $str_username);

                if (!empty($arr_username) && count($arr_username) > 0) {
                    if (!empty($arr_username[0])) {
                        $user->first_name =  $arr_username[0];
                    }

                    if (!empty($arr_username[1])) {
                        $user->last_name =  $arr_username[1];
                    }
                }
            }*/
       
            $user->virtual_show_room = $request->virtual_show_room;
            $user->first_name = $request->first_name;
            $user->last_name =  $request->last_name;
            $user->acronym =  $request->acronym;
            $user->email =  $request->Email;
            $user->hide_email =  $request->hide_email;          
            $user->hide_telephone =  $request->hide_telephone;          
            $user->hide_secondary_email =  $request->hide_secondary_email;          
            $user->pronoun =  $request->pronoun;

            if (!empty($request->home_page_slide_show_caption)) { 
             $user->home_page_slide_show_caption = $request->home_page_slide_show_caption;
         }
            /*$user->username = $request->username;
            $user->username = $request->username;
            if (!empty($request->username)) {
                $user->slug = Str::slug($request->username, '-');
            }*/
            
            $user->gender = $request->gender;
            // $user->dob = $request->dob;
            $user->dobday    = $request->dobday;
            $user->dobmonth    = $request->dobmonth;
            $user->dobyear    = $request->dobyear;
            $user->description = $request->description;
            $user->postal_address = $request->postal_address;
            $user->state = $request->state;
            
            $str_skills_data = '';
            $arr_skills = array();              
            $arr_skills = UtilitiesFour::get_skills_array(@$request->skills);

            Skill::save_skill_data($arr_skills);
            // echo "sdasddsa"; die;
            $str_skills_data = UtilitiesFour::get_skills_list($arr_skills);

            if($user->role == 3)
            {
              $user->services = $str_skills_data;
          }
          else
          {
              $user->skills = $str_skills_data; 
          }
        
          $user->phone_number = $request->phone_number;
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
          $user->secondary_phone_number = $request->secondary_phone_number;
          $user->secondary_mobile = $request->secondary_mobile;
          $user->secondary_email = $request->secondary_email;
          $user->no_of_employees = $request->no_of_employees;
          $user->company_category_id = $request->company_category_id;

          $user = $this->save_fun_facts_data($user, '', $request);

         

          if ($request->hasFile('profile_image')) {
            $file_path = $this->_usersPhotosFolder;
            // $oldPath = public_path('/uploads/crop/'.$request->crop_img); 
           
            // $fileExtension = \File::extension($oldPath);
            // $timestamp = generateFilename();
            // $filename = $timestamp .'_users_'. '.' . $fileExtension;

            // $newPathWithName = public_path('/uploads/images/users/'.$filename);
            // if (\File::copy($oldPath , $newPathWithName)) {
            //         // dd("success");
            //         //die;
            // }




            //$file = $request->crop_img;
                //$extension = $file->getClientOriginalExtension();
                //$extension = UtilitiesTwo::get_image_ext_name();
                //$timestamp = generateFilename();
                //$filename = $timestamp . '_users_' . '.' . $extension;
                //$file_path = imagePath();

                //$upload_status = $file->move($file_path, $filename);
              //  $upload_status = $file->move(public_path($file_path), $filename);
              // $upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
               //echo $upload_status; die;
                
                // if ($upload_status) {
                //     $user->profile_image = $filename;
                // } else {
                //     // Rollback Transaction
                //     DB::rollBack();

                //     $message = ['msg' => errorMessage('file_uploading_failed')];
                //     return response()->json($message, 422);
                // }
            $user->profile_image = $request->crop_img;
            }
            $user->save();

            /*if ($request->has('videos')) {
                UserGallery::where('user_id', $current_user->id)
                    ->where('media_type', 2)
                    ->delete();
                foreach ($request->videos as $video) {
                    if (!is_null($video)) {
                        $gallery = new UserGallery();
                        $gallery->user_id = $current_user->id;
                        $gallery->media_type = 2;
                        $gallery->media = $video;
                        $gallery->save();
                    }
                }
            }*/

            if ($request->hasFile('awards')) {
                InventorAward::where('user_id', $current_user->id)
                ->delete();
                foreach ($request->awards as $awards) {
                    $new_award = new InventorAward();
                    $new_award->user_id = $current_user->id;
                    $file = $awards;
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $upload_status = $file->move($file_path, $filename);
                    if ($upload_status) {
                        $new_award->file = $filename;
                    } else {
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                    $new_award->save();
                }
            }

            /*if ($request->hasFile('photo')) {

                UserGallery::where('user_id', $current_user->id)
                    ->where('media_type', 1)
                    ->delete();
                foreach ($request->photo as $photo) {
                    $gallery = new UserGallery();
                    $gallery->user_id = $current_user->id;
                    $file = $photo;
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $upload_status = $file->move($file_path, $filename);
                    if ($upload_status) {
                        $gallery->media_type = 1;
                        $gallery->media = $filename;
                    } else {
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                    $gallery->save();

                    if ($request->has('gallery_meta')) {
                        $meta_data = $request->gallery_meta;
                        $meta_data['gallery_id'] = $gallery->id;
                        MetaData::create($meta_data);
                    }
                }
            }*/

            if ($request->hasFile('article')) {
                UserGallery::where('user_id', $current_user->id)
                ->where('media_type', 3)
                ->delete();
                foreach ($request->article as $article) {
                    $gallery = new UserGallery();
                    $gallery->user_id = $current_user->id;
                    $file = $article;
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $upload_status = $file->move($file_path, $filename);
                    if ($upload_status) {
                        $gallery->media_type = 3;
                        $gallery->media = $filename;
                    } else {
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                    $gallery->save();
                }
            }


            if ($request->filled('contact_info')) {
                $contact_info =  InventorContactInformation::where('user_id', $current_user->id)->first();
                if (!$contact_info) {
                    $contact_info = new InventorContactInformation();
                    $contact_info->user_id = $current_user->id;
                }

                foreach ($request->only(
                    'contact_info.agent_name',
                    'contact_info.agent_email_id',
                    'contact_info.manager_name',
                    'contact_info.manager_email_id',
                    'contact_info.legal_name',
                    'contact_info.legal_email_id',
                    //'contact_info.company_name',
                    'contact_info.company_email_id',
                    'contact_info.company_phone',
                ) as $value) {
                    foreach ($value as $key => $contact) {
                        if (!is_null($contact)) {
                            $contact_info->$key = $contact;
                        }
                    }
                }
                
                //if(!empty($request->company_name_new))
                //{
                $contact_info->company_name = $request->company_name_new; 
                //}
                
                $contact_info->save();
            }

            $contact_info =  InventorContactInformation::where('user_id', $current_user->id)->first();

            /*if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    $social_media =  UserSocialMedia::where('user_id', $current_user->id)
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

                    $social_media->user_id = $current_user->id;
                    $social_media->type = $key;
                    $social_media->value = $socials;
                    $social_media->save();
                }
            } */
            
            if ($request->filled('socials_new')) {
                foreach ($request->socials_new as $key => $socials) {
                    $social_media =  UserSocialMedia::where('user_id', $current_user->id)
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

                $social_media->user_id = $current_user->id;
                $social_media->type = $key;
                $social_media->value = $socials;
                $social_media->save();
            }
        }

        if ($request->has('roles') && count($request->roles) > 0) {
            Role::where('user_id', $current_user->id)->delete();
            $i = 0;
            foreach ($request->roles as $role) {
                if (!is_null($role)) {
                    $new_role = [
                        'user_id' => $current_user->id,
                        'role' => $role,
                        'at' => @$request->at[$i],
                        'name' => @$request->role_name[$i],
                        'description' => @$request->role_description[$i],
                        'date_from' => @$request->date_from[$i],
                        'date_to' => @$request->date_to[$i]
                    ];
                    Role::create($new_role);
                }
                $i++;
            }
        }
        return response()->json(['success'=>1,'response'=>'']);
        //     Session::flash('profile_data_saved_flag', 1);
        //     DB::commit();
        //     return successMessage('Profile Updated');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     throw $e;
        //     return errorMessage($e->getMessage(), true);
    }
}

public function postUserProfileRoleEdit(Request $request)
{
    //pr($request->all()); die;
    $int_people_id = 0;
    $int_company_id = 0;
    $int_product_id = 0;
    $int_role_type = 0;
    $is_product_flag = 0;
    $is_company_flag = 0;
    $is_people_flag = 0;

    $current_user = get_current_user_info();
    $int_at_data = $request->input('add_edit_profile_role.at');

    $rules = [
        'add_edit_profile_role.role' => 'required',
            //'add_edit_profile_role.at' => 'required',
            //'add_edit_profile_role.description' => 'required',
            // 'add_edit_profile_role.date_from' => 'required',
            // 'add_edit_profile_role.from_month' => 'required',
            //'add_edit_profile_role.from_year' => 'required|not_in:0',

            // 'add_edit_profile_role.date_to' => 'required',
            // 'add_edit_profile_role.to_month' => 'required',
            //'add_edit_profile_role.to_year' => 'required|not_in:0',
    ];

    if($int_at_data == 2)
    {
        $rules['add_edit_profile_role.company_name'] = 'required';
    }

    if($int_at_data == 1)
    {
        $rules['add_edit_profile_role.product_name'] = 'required';
    }

    if($current_user->role == 3)//$int_at_data == 2 && 
    {
        $rules['add_edit_profile_role.people_name'] = 'required';
    }
        
    if($current_user->role == 2)//$int_at_data == 2 && 
    {
        $rules['add_edit_profile_role.at'] = 'required';
    }
        
        $niceNames = [
            'add_edit_profile_role.role' => 'Role',
            'add_edit_profile_role.at' => 'Please Select Company or Product',
            'add_edit_profile_role.people_name' => 'Name',
            'add_edit_profile_role.company_name' => 'Company Name',
            'add_edit_profile_role.description' => 'Description',
            // 'add_edit_profile_role.date_from' => 'From',
            // 'add_edit_profile_role.from_month' => 'From Month',
            'add_edit_profile_role.from_year' => 'From Year',            
            // 'add_edit_profile_role.date_to' => 'To',
            // 'add_edit_profile_role.to_month' => 'To Month',
            'add_edit_profile_role.to_year' => 'To Year',

        ];
        $this->validate($request, $rules, [], $niceNames);


        //   $validator = Validator::make($request->all(), $rules ,  $name = [
        //     'add_edit_profile_role.role.required' => 'The Role field is required.',
        //     'company_name.company_name.required' => 'The Company Name field is nullable.',
        //     'add_edit_profile_role.product_name.required' => 'The Product Name field is required.',
        //     'add_edit_profile_role.people_name.required' => 'The People Name field is required.',
        //     'add_edit_profile_role.people_name.required' => 'The People Name field is required.',
        //     'Email.unique' => 'The Email field is nullable.',
        //     'profile_image.max' => 'The Profile Image Size Invalid.',
        //     'description.nullable' => 'The Description field is nullable.',
        //     'postal_address.nullable' => 'The City field is nullable.',
        //     'city.nullable' => 'The Postal Address field is nullable.',
        //     'phone_number.nullable' => 'The Phone Number field is nullable.',
        //     'mobile.nullable' => 'The mMobile field is nullable.',
        //     'skills.nullable' => 'The Skills Address field is nullable.',
        //     'socials.required' => 'Socials URL format is Invalid.',
        //     'dobday.required' => 'The Day field is required.',
        //     'dobmonth.required' => 'The Month field is required.',
        //     'country_id.required' => 'The Country field is required.',
        //     'country_id.nullable' => 'The Country field is nullable.',
        //     'country_id.exists' => 'The Country field is exists.',

        // ]);


        /*$request->validate([
            'add_edit_profile_role.role' => 'required',
            'add_edit_profile_role.at' => 'required',
            'add_edit_profile_role.name' => 'required',
            'add_edit_profile_role.description'rom' => 'required',
            'add_edit_profile_role.d => 'required',
            'add_edit_profile_role.date_fate_to' => 'required',
        ]);*/

        try {
            DB::beginTransaction();
            
            if(!empty($int_at_data) && $int_at_data == 1)
            {
              $is_product_flag = 1; 
          }

          if(!empty($int_at_data) && $int_at_data == 2)
          {
              $is_company_flag = 1; 
          }

          if(!empty($int_at_data) && $int_at_data == 5)
          {
              $is_people_flag = 1;  
          }

            /*if ($request->has('roles') && count($request->roles) > 0) {
                Role::where('user_id', $current_user->id)->delete();
                $i = 0;
                foreach ($request->roles as $role) {
                    if (!is_null($role)) {
                        $new_role = [
                            'user_id' => $current_user->id,
                            'role' => $role,
                            'at' => @$request->at[$i],
                            'name' => @$request->role_name[$i],
                            'description' => @$request->role_description[$i],
                            'date_from' => @$request->date_from[$i],
                            'date_to' => @$request->date_to[$i]
                        ];
                        Role::create($new_role);
                    }
                    $i++;
                }
            } */

            $int_role_id = $request->input('add_edit_profile_role.role_id');            
            $int_at_data = $request->input('add_edit_profile_role.at');         
            $str_role_name = $request->input('add_edit_profile_role.people_name');
            $str_company_name = $request->input('add_edit_profile_role.company_name');
            $str_product_name = $request->input('add_edit_profile_role.product_name');          
            
            $int_company_id = $request->input('add_edit_profile_role.company_hidden_id');           
            $int_people_id = $request->input('add_edit_profile_role.people_hidden_id');
            $int_product_id = $request->input('add_edit_profile_role.product_hidden_id');
            
            if(($is_people_flag>0) && (!empty($int_people_id) || $int_people_id>0) && (!empty($str_role_name) || empty($str_role_name)))
            {
             $str_role_name = ''; 
         }

         if(($is_company_flag>0) && (!empty($int_company_id) || $int_company_id>0) && (!empty($str_company_name) || empty($str_company_name)))
         {
             $str_company_name = '';
             $str_product_name = '';
             $str_role_name = '';
         }

         if(($is_product_flag>0) && (!empty($int_product_id) || $int_product_id>0) && (!empty($str_product_name) || empty($str_product_name)))
         {
             $str_product_name = '';
             $str_company_name = '';
             $str_role_name = '';
         }

         if(($is_company_flag>0) && (!empty($str_company_name)))
         {
             $str_role_name = $str_company_name;  
         }

         if(($is_product_flag>0) && (!empty($str_product_name)))
         {
             $str_role_name = $str_product_name;  
         }

            if($current_user->role == 3)// || $current_user->role == 3)//$int_at_data == 2 && 
            {
              $int_company_id = @$current_user->id;
              $int_role_type = 2;             
          }

            if($current_user->role == 2)// || $current_user->role == 2)//$int_at_data == 2 && 
            {
              $int_people_id = @$current_user->id;
              $int_role_type = 1;
          }

          if(empty($int_company_id))
          {
            $int_company_id = 0;
        }

        if(empty($int_product_id))
        {
            $int_product_id = 0;
        }

        if(empty($int_people_id))
        {
            $int_people_id = 0;
        }

        if(!empty($arr_peoples[0]))
        {
                //$people_user_id = $arr_peoples[0];
        }
            //echo 'p';
            //print_r($arr_peoples);            
            //echo 'c';
            //print_r($arr_companies);          
            //exit;         
            //exit;

        $data = [
            'role' => $request->input('add_edit_profile_role.role'),
            'role_type' => $int_role_type,
            'at' => $request->input('add_edit_profile_role.at'),
            'company_id' => $int_company_id,
            'people_id' => $int_people_id,
            'product_id' => $int_product_id,
            'name' => $str_role_name,
                //'name' => $people_user_id,
            'description' => $request->input('add_edit_profile_role.description'),
                // 'date_from' => $request->input('add_edit_profile_role.date_from'),
                //'from_day' => $request->input('add_edit_profile_role.from_day'),
                //'from_month' => $request->input('add_edit_profile_role.from_month'),
                //'from_year' => $request->input('add_edit_profile_role.from_year'),

                // 'date_to' => $request->input('add_edit_profile_role.date_to'),
                //'to_day' => $request->input('add_edit_profile_role.to_day'),
                //'to_month' => $request->input('add_edit_profile_role.to_month'),
                //'to_year' => $request->input('add_edit_profile_role.to_year'),

            'status' => 1,
            'user_id' => $current_user->id
        ];

        if (!empty($int_role_id))
            $role_data = Role::updateOrCreate(['id' => $int_role_id], $data);
        else
            $role_data = Role::create($data);

        DB::commit();
        return successMessage('Role Saved');
    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
        return errorMessage($e->getMessage(), true);
    }
}

public function deleteRoleData($id)
{
    try {

        DB::beginTransaction();

        Role::where('id', $id)->delete();

        DB::commit();

            //return redirect("/user/profile/edit");
        return successMessage('Role Deleted Successfully');
    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
        return errorMessage($e->getMessage(), true);
    }
}

public function getChangePassword()
{
    return view('front.profile.change_password');
}


public function postChangePassword(Request $request)
{

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|different:current_password',
        'confirm_password' => 'required|same:password',
    ]);
    try {
        $current_user = get_current_user_info();
        $user = User::findOrFail($current_user->id);
        $checkCurrentPassword = Hash::check($request->current_password, $user->password);
        if (!$checkCurrentPassword) {
            throw new \Exception('Current password is not correct');
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return successMessage('Password Changed');
    } catch (\Exception $e) {
        return errorMessage($e->getMessage(), true);
    }
}


public function getUserRoleData()
{
    $arr_role_at_list = $this->_arr_role_at_list;

    $current_user = get_current_user_info();
    $user = User::where('id', $current_user->id)
    ->with([
        'inventorContactInfo',
        'galleries',
        'socialMedia',
        'inventorAwards',
        'roles'
    ])
    ->firstOrFail();


    $role_type_data_new = UtilitiesTwo::getRoleText($current_user->role);  

    //echo "<pre>"; print_r($role_type_data_new); die; 

    return view('front.profile.ajax_role_data_edit_profile', compact(
        'user',
        'arr_role_at_list',
        'role_type_data_new'
    ));
}

public function getCompanyProfile(Request $request)
{

    $user_slug = '';
    $folder_path = $this->_galleryPhotosFolder;

    $current_user = get_current_user_info();
    if ($current_user->type_of_user == 1) {
        return redirect()->route('front.user.free.edit.profile');
    }
    $user = User::where('id', $current_user->id)
    ->with([
        'inventorContactInfo',
        'galleries',
        'socialMedia',
        'inventorAwards',
        'roles'
    ])
    ->firstOrFail();

    if (!empty($user->slug)) {
        $user_slug =    $user->slug;
    }

    $news = News::where('user_id', $current_user->id)
    ->first();

    $gallery_image_data = $this->getGalleryImageData($current_user->id, 1, 0, 0);

    $gallery_video_data = $this->getGalleryVideoData($current_user->id, 1, 0, 0);

    $gallery_known_for_data = $this->getGalleryKnownForData($current_user->id, 1, 0, 0);

    $blogs_list = Blog::where('user_id', $current_user->id)
    ->orderBy('id', 'desc')
    ->get();

    $chk_device = Utilities::checkDevice();

    $blogs_link = $this->_blogs_link;

    $this->_gallery_videos_link = Utilities::get_gallery_videos_link('user', $user_slug);
    $this->_gallery_known_for_link = Utilities::get_gallery_known_link('user', $user_slug);
    $this->_gallery_images_link = Utilities::get_gallery_images_link('user', $user_slug);


    $gallery_videos_link = $this->_gallery_videos_link;
    $gallery_known_for_link = $this->_gallery_known_for_link;
    $gallery_images_link = $this->_gallery_images_link;

    $arr_role_at_list = $this->_arr_role_at_list;

    $countries = Country::pluck('country_name', 'id');

    $awards = EventAwardNominee::where([
        'reference_type' => 1,
        'type' => 2,
        'reference_id' => $current_user->id
    ])
    ->get();

    return view('front.profile.company.index', compact(
        'user',
        'news',
        'gallery_known_for_data',
        'gallery_video_data',
        'chk_device',
        'folder_path',
        'gallery_image_data',
        'gallery_videos_link',
        'gallery_known_for_link',
        'gallery_images_link',
        'blogs_list',
        'blogs_link',
        'countries',
        'arr_role_at_list',
        'awards'
    ));
}

public function getCompanyProfileEdit(Request $request)
{
    $current_user = get_current_user_info();
    if($current_user->role != 3 && $current_user->type_of_user == 1)
    {
        return redirect('/');
    }

    $user = User::where('id', $current_user->id)
    ->firstOrFail();
    $countries = Country::pluck('country_name', 'id');
        $company_categories = CompanyCategory::pluck('name', 'id', 'status');//->where('status', 1);
        $arr_roles_list = Utilities::get_roles_list();
        
        $arr_role_at_list = $this->_arr_role_at_list;
        
        $arr_get_company_users_list = User::get_company_users_list();
        
        $arr_get_people_users_list = User::get_people_users_list();
        
        $role_type_data_new = UtilitiesTwo::getRoleText($current_user->role);
        
        $get_skill_list = Skill::get_skill_list();
        
        return view('front.profile.company.edit', compact('get_skill_list', 'arr_get_people_users_list', 'role_type_data_new', 'arr_role_at_list', 'user', 'countries', 'company_categories', 'arr_roles_list', 'arr_get_company_users_list'));
    }


    public function getFreeUserEditProfile()
    {
        $current_user = get_current_user_info();
        if($current_user->role != 1 && $current_user->type_of_user != 1)
        {
            return redirect('/');
        }
        $user = User::where('id', $current_user->id)
        ->firstOrFail();
        $countries = Country::pluck('country_name', 'id');

        return view('front.profile.free_user.edit', compact('user', 'countries'));
    }
    public function getFreeUserProfile()
    {
        $current_user = get_current_user_info();
        if($current_user->role != 1 && $current_user->type_of_user != 1)
        {
            return redirect('/');
        }
        $user = User::where('id', $current_user->id)
        ->firstOrFail();
        $countries = Country::pluck('country_name', 'id');

        return view('front.profile.free_user.index', compact('user', 'countries'));
    }


    public function getUserProfileUploads(Request $request)
    {
        $image = $request->image;
        list($type, $image) = explode(';',$image);
        list(, $image) = explode(',',$image);

        $image = base64_decode($image);
       // $image_name = time().'.png';
         $timestamp = generateFilename();
         $image_name = $timestamp .'_users_'. '.' .'png';
        file_put_contents('uploads/images/users/'.$image_name, $image);
        echo json_encode(['success'=>1,'crop_img'=>$image_name]);
    }


}
