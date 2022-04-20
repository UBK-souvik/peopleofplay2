<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Role;
use App\Models\ProductCollaborator;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\GalleryAwardTag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\Country;
use App\Models\UsersUserRole;
use App\Models\Blog;
use App\Models\BrandList;
use App\Models\Skill;

class SkillsControllers extends Controller
{
	
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//$this->_slug_prefix_list = Utilities::get_slug_prefix_list();	
        $this->_slug_prefix_list = Utilities::get_search_slug_prefix_list();
		$this->_images_upload_folder_path = Utilities::get_images_upload_folder_path();		
	}
	
	public function index()
    {
	  $skill_list = Skill::get_skill_list();
	  return view('front.pages.search.index',compact('skill_list'));
    }

    public function getSkillData($slug)
    {
    	$arr_slug_prefix_new = array();
		$arr_type_new = array();
		$folder_path = $this->_images_upload_folder_path;
		$result_data = array();	
    	$result_data['inventor_users'] = User::get_people_user_list_by_image($slug)->where('users.role', 2)->whereRaw('FIND_IN_SET("'.$slug.'",skills)')->get();
		$result_data['company_users'] = User::get_company_user_list_by_image($slug)->where('comp.role', 3)->whereRaw('FIND_IN_SET("'.$slug.'",services)')->get();   
	     $slug_prefix_list = $this->_slug_prefix_list;
	
	     return view('front.pages.search.skill_details', compact( 'result_data', 'folder_path', 'slug_prefix_list','slug'));
    }


    public function indexRole()
    {
     $role_list = UsersUserRole::where('status',1)->orderBy('role_name','ASC')->get();
	  return view('front.pages.search.index_role',compact('role_list'));
    }
	

	  public function getRoleData($id)
    {
    	$arr_slug_prefix_new = array();
		$arr_type_new = array();
		$folder_path = $this->_images_upload_folder_path;
		$result_data = array();	
		 $slug_prefix_list = $this->_slug_prefix_list;
   
    	 $products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw('2 as type'), 'products.slug')
			 ->join('product_collaborators','products.id', '=', 'product_collaborators.product_id')
							->where('product_collaborators.role',$id)->get();

		 $result_data['products'] = $products;
		$company_users = User::get_company_user_list_by_image($id)->where('comp.role', 3); 
  		$company_users  = $company_users
							->join('roles','comp.id', '=', 'roles.user_id')
							->where('roles.role',$id)->get();
		 $result_data['company_users'] = $company_users;

		$inventor_users = User::get_people_user_list_by_image($id)->where('users.role', 2);
    	$inventor_users = $inventor_users
			          ->whereRaw('id in (
									    SELECT people_id from roles where role = '.$id.' 
									    UNION
									    SELECT people_id from product_collaborators where role = '.$id.' 
									) ')->get();
		$result_data['inventor_users'] = $inventor_users;
		$role = UsersUserRole::where('id',$id)->first();
		//echo "<pre>"; print_r($role); die;
		if(!empty($role)) {
			$slug = $role->role_name;
		} else {
			$slug ='';
		}
		return view('front.pages.search.skill_details', compact( 'result_data', 'folder_path', 'slug_prefix_list','slug'));

    }

    public function roleCount($id)
    {
    	

		return "sds";
    }
	
	
}
