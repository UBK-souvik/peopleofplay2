<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\BrandList;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Tag;
use Carbon\Carbon;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use DB;
use Session;

class AdminModuleController extends Controller
{
	
	 public function __construct()
    {
		$this->_arr_role_at_list = Utilities::get_roles_at_list();		        
	}
	
	
	function getAdminBlogTags($request)
	{
		$str_tags_data = '';
		$arr_tags = array();				
		$arr_tags = UtilitiesFour::get_skills_array(@$request->tags);

		Tag::save_tag_data($arr_tags);
		
		$str_tags_data = UtilitiesFour::get_skills_list($arr_tags);
		
		return $str_tags_data;
     }
	
	public function getAdminPeopleData(Request $request)//, $p*/eople_id
	{
		$searchTerm = $request->searchTerm;
		
		$data_list = User::get_people_search_by_name($searchTerm);
		
		echo $data_list->toJson();			 		
	}
	
	public function getAdminCompanyData(Request $request)
	{
		$searchTerm = $request->searchTerm;
		
		$data_list = User::get_company_search_by_name($searchTerm);
					 
		echo $data_list->toJson();			 		
	}
	
	public function getAdminProductData(Request $request)
	{
		$searchTerm = $request->searchTerm;
		
		$data_list = Product::get_product_search_by_name($searchTerm);
			 
		echo $data_list->toJson();			 		
	}
	
	// list of brandlist for auto complete
	public function getAdminBrandListData(Request $request)
	{
		$searchTerm = $request->searchTerm;
		
		$data_list = BrandList::get_brand_list_search_by_name($searchTerm);
			 
		echo $data_list->toJson();			 		
	}
	
	
	public function postAdminUserProfileRoleEdit(Request $request)
    {
		$int_people_id = 0;
		$int_company_id = 0;
		$int_product_id = 0;
		$int_role_type = 0;
		$is_product_flag = 0;
		$is_company_flag = 0;
		$is_people_flag = 0;
		$str_random_time_stamp_new = '';
		
		$int_user_id = $request->input('admin_add_edit_profile_role.user_id');
		
		$current_user = \App\Models\User::find(@$int_user_id);

		$int_at_data = $request->input('admin_add_edit_profile_role.at');
		$int_role_type_new = $request->input('admin_add_edit_profile_role.int_role_type_new');
				
        $rules = [
            'admin_add_edit_profile_role.role' => 'required',
            //'admin_add_edit_profile_role.at' => 'required',
            //'admin_add_edit_profile_role.description' => 'required',
            // 'add_edit_profile_role.date_from' => 'required',
            // 'add_edit_profile_role.from_month' => 'required',
            //'admin_add_edit_profile_role.from_year' => 'required|not_in:0',

            // 'add_edit_profile_role.date_to' => 'required',
            // 'add_edit_profile_role.to_month' => 'required',
            //'admin_add_edit_profile_role.to_year' => 'required|not_in:0',
        ];
		
		if($int_at_data == 2)
		{
			$rules['admin_add_edit_profile_role.company_name'] = 'required';
		}
		
		if($int_at_data == 1)
		{
			$rules['admin_add_edit_profile_role.product_name'] = 'required';
		}
		
		if($int_role_type_new == 3)//$int_at_data == 2 && 
		{
			$rules['admin_add_edit_profile_role.people_name'] = 'required';
		}
		
		if($int_role_type_new == 2)//$int_at_data == 2 && 
		{
			$rules['admin_add_edit_profile_role.at'] = 'required';
		}
		
        $niceNames = [
            'admin_add_edit_profile_role.role' => 'Role',
            'admin_add_edit_profile_role.at' => 'Please Select a Product or Company',
            'admin_add_edit_profile_role.people_name' => 'Name',
			'admin_add_edit_profile_role.company_name' => 'Company Name',
			'admin_add_edit_profile_role.product_name' => 'Product Name',
            //'admin_add_edit_profile_role.description' => 'Description',
            // 'add_edit_profile_role.date_from' => 'From',
            // 'add_edit_profile_role.from_month' => 'From Month',
            //'admin_add_edit_profile_role.from_year' => 'From Year',            
            // 'add_edit_profile_role.date_to' => 'To',
            // 'add_edit_profile_role.to_month' => 'To Month',
            //'admin_add_edit_profile_role.to_year' => 'To Year',

        ];
        $this->validate($request, $rules, [], $niceNames);

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

            $int_role_id = $request->input('admin_add_edit_profile_role.role_id');			
			$int_at_data = $request->input('admin_add_edit_profile_role.at');			
		    $str_role_name = $request->input('admin_add_edit_profile_role.people_name');
            $str_company_name = $request->input('admin_add_edit_profile_role.company_name');
            $str_product_name = $request->input('admin_add_edit_profile_role.product_name');			
			
			$int_company_id = $request->input('admin_add_edit_profile_role.company_hidden_id');			
			$int_people_id = $request->input('admin_add_edit_profile_role.people_hidden_id');
			$int_product_id = $request->input('admin_add_edit_profile_role.product_hidden_id');
			
			if(empty($current_user->id))
			{
			   $str_random_time_stamp_new = $request->input('admin_add_edit_profile_role.random_time_stamp_new');	
			}
			
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
			
			if($int_role_type_new == 3)// || $current_user->role == 3)//$int_at_data == 2 && 
			{
			  $int_company_id = @$current_user->id;
              $int_role_type = 2;			  
			}
			
			if($int_role_type_new == 2)// || $current_user->role == 2)//$int_at_data == 2 && 
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
                'role' => $request->input('admin_add_edit_profile_role.role'),
				'role_type' => $int_role_type,
				'at' => $int_at_data,
                'company_id' => $int_company_id,
				'people_id' => $int_people_id,
				'product_id' => $int_product_id,
				'name' => $str_role_name,
                //'name' => $people_user_id,
				'description' => $request->input('admin_add_edit_profile_role.description'),
                // 'date_from' => $request->input('add_edit_profile_role.date_from'),
                //'from_day' => $request->input('admin_add_edit_profile_role.from_day'),
                //'from_month' => $request->input('admin_add_edit_profile_role.from_month'),
                //'from_year' => $request->input('admin_add_edit_profile_role.from_year'),

                // 'date_to' => $request->input('add_edit_profile_role.date_to'),
                //'to_day' => $request->input('admin_add_edit_profile_role.to_day'),
                //'to_month' => $request->input('admin_add_edit_profile_role.to_month'),
                //'to_year' => $request->input('admin_add_edit_profile_role.to_year'),
                'random_unique_timestamp' => $str_random_time_stamp_new,
                'status' => 1,
                'user_id' => @$current_user->id
            ];
			
            if (!empty($int_role_id))
			{
				$role_data = Role::updateOrCreate(['id' => $int_role_id], $data);
			}
			else
			{
				$role_data = Role::create($data);
			}

            DB::commit();
            return successMessage('Role Saved');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }
	
	public function getAdminUserRoleData($user_id, $random_time_stamp, $int_role_type_id_data_new)
    {
        $arr_role_at_list = $this->_arr_role_at_list;
		
		$role_type_data_new = '';

        /*if(!empty($user_id))
		{
		   $current_user = \App\Models\User::find($user_id);
		
			$user = User::where('id', $user_id)
				->with([
					'inventorContactInfo',
					'galleries',
					'socialMedia',
					'inventorAwards',
					'roles'
				])
				->firstOrFail();
				
			$role_type_data_new = UtilitiesTwo::getRoleText($current_user->role);	
			
			return view('admin.users.admin_ajax_role_data_edit_profile', compact(
				'user',
				'arr_role_at_list',
				'role_type_data_new'
			));	
		}*/
		
           $role_data = Role::get_role_data($user_id, $random_time_stamp);  		   
		
		   return view('admin.users.admin_ajax_role_data_edit_profile', compact(
				'role_data',
				'arr_role_at_list',
				'role_type_data_new',
				'int_role_type_id_data_new'
			));
		
    }
	
	public function deleteAdminRoleData($id)
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
	
	public function admin_get_tags_dropdown(Request $request)
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
	
	public function admin_get_blog_tags_dropdown(Request $request)
    {
        $data_array = array();
		$postData = $request->all();
        //$keyword = $postData['query']['term'];
		$keyword = $postData['query'];
        $data = Tag::where('tag', 'like', '%' . $keyword . '%')->select('tag')->groupBy('tag')->get();
		
		if(!empty($data) && count($data)>0)
		{
			foreach($data as $data_row)
			{
				$data_array[] = $data_row->tag;
			}
		}
		
		$data_array = array_values($data_array);
		
		return $data_array;
    }
    
}
