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

use App\Models\Wiki;
use App\Models\Entertainment;
use App\Models\Feed;
use App\Models\NewsFeeds;

class SearchPageController extends Controller
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
	
		
    }
	
	// for top dictionary word search
	public function getWordSearchAjaxData(Request $request)
    {
        $search_data = $request->input('search');
		
		$users = $this->getWordSearchData($search_data);			 
		
		echo $users->toJson();		
    }
	
	// for a dictionary search results
	public function getWordSearchData($search_data)
	{
		$events = '';
		$user_current_info = get_current_user_info();
		$int_type_of_user = 0;
		if(!empty($user_current_info->type_of_user))
		{
			$int_type_of_user = $user_current_info->type_of_user; 
		}
		// pr($int_type_of_user,1);
	    $str_no_of_char = 100;		
		$slug_prefix_list = $this->_slug_prefix_list;
		
		$arr_search_data = array();
		
		if(!empty($search_data) && strpos($search_data, ' ')>0)
		{
			$arr_search_data = explode(' ',$search_data);		
		}
		else
		{
			$arr_search_data[0] = $search_data;
		}
		
		$arr_image_data_new = array();
		
		$dictionaries = DB::table('dictionaries')
			->select('dictionaries.id'
			  ,'dictionaries.title'
			  ,'dictionaries.slug')
			->where(function($query) use ($arr_search_data){
				foreach($arr_search_data as $arr_search_data_row){
					$query->where('dictionaries.title', 'LIKE', '%'.$arr_search_data_row.'%');
				}
            });
			
			$dictionaries_result = $dictionaries->get();

       return $dictionaries_result;
    }
	
	
	
	// for top header search results
	public function getSearchAjaxData(Request $request)
    {
        $search_data = $request->input('search');
		
		// get the entire search results
		$users = $this->getSearchData($search_data, $request);			 
		// dd($users);
		if(!empty($users))
		{
			// echo "<pre>"; print_r($users); die;
		   echo $users->toJson();	
		}
		else
		{
			// echo "dfsd"; die;
		   echo json_encode(array());	
		}			
    }
	
	// for search page when top header search submit button is clicked
	public function getHomeSearchPage(Request $request)
    {
    	// pr($request->all());die;
		
        $arr_slug_prefix_new = array();
		$arr_type_new = array();
		//$result_data = array();
		$search_data = '';
	    $desk_search_data = $request->input('home-site-search-text-name');
		
        $mobile_search_data = $request->input('home-site-search-input-mobile'); 
           
        if(!empty($desk_search_data))		   
		{
			$search_data = $desk_search_data;
		}
		
		if(!empty($mobile_search_data))		   
		{
			$search_data = $mobile_search_data;
		}
		
		if( $request->has('type') ) {
           $str_type_new = $request->query('type');
        }
		
		if( $request->has('category_id') ) {
           $int_category_id = $request->query('category_id');
        }
		
		// if ($request->isMethod('get') && empty($str_type_new) && empty($int_category_id))
		// {
		// 	return redirect('/', 301);			
		// }	
			
		$folder_path = $this->_images_upload_folder_path;		
		
		// get the entire search results
		 if ($request->isMethod('get') && empty($str_type_new) && empty($int_category_id))
		{
			
			$result_data = $slug_prefix_list =array();
			
		} else {
			$result_data = $this->getSearchData($search_data, $request);
			
			$slug_prefix_list = $this->_slug_prefix_list;
		}
		
		// store all the slugs and types in an array
		// echo "<pre>"; print_r($result_data);die;
		if($result_data){
			foreach($result_data as $result_data_row)
			{
			  $arr_slug_prefix_new[] = $result_data_row->slug_prefix;
			  $arr_type_new[] = $result_data_row->type;
			}
		}




				
		$arr_slug_prefix_new = array_unique($arr_slug_prefix_new);
		$arr_type_new = array_unique($arr_type_new);
		foreach($arr_slug_prefix_new as $arr_slug_prefix_new_row_key => $arr_slug_prefix_new_row_val)
		{
			if($arr_slug_prefix_new_row_val =="product" || $arr_slug_prefix_new_row_val =="event")
			{
				$arr_slug_prefix_new[$arr_slug_prefix_new_row_key] = 0;
			}
		}
		
		//print_r($arr_slug_prefix_new);		
		//print_r($arr_type_new);exit;
		$str_category_name = '';
		
		if(!empty($int_category_id) && $str_type_new == 'product_category')
		{
		  $categories_data = DB::table('categories')
			->select('categories.id'
			  ,'categories.category_name')
			->where('categories.id', '=', $int_category_id)
			->get();

           $str_category_name = $categories_data[0]->category_name; 			
		}	
		
		$int_search_dd_val_desk_new = $this->getSearchDDlVal($request);
			
		$is_right_bar_show=0;	
        $countries = Country::pluck('country_name', 'id');
       
       

    	return view('front.pages.home_search', compact('search_data', 'int_search_dd_val_desk_new', 'str_category_name', 'arr_slug_prefix_new', 'arr_type_new', 'search_data', 'result_data', 'folder_path', 'slug_prefix_list','countries','is_right_bar_show'));		
		//$queries = DB::getQueryLog();
        //print_r($queries); 				
		//echo $users->toJson();		
    }
	
	public function getSearchDDlVal($request)
	{
		$int_search_dd_val_desk_new = 0;
		
	    if( $request->has('int_search_dd_val_desk_new') && !empty($request->int_search_dd_val_desk_new)) {
           $int_search_dd_val_desk_new = $request->int_search_dd_val_desk_new;
        }
		
		if( $request->has('int_search_dd_val_mobile_new') && !empty($request->int_search_dd_val_mobile_new)) {
           $int_search_dd_val_desk_new = $request->int_search_dd_val_mobile_new;
        }
		
		if( $request->has('resizing_select_mainSearch_Desk_Name') && !empty($request->resizing_select_mainSearch_Desk_Name)) {
           $int_search_dd_val_desk_new = $request->resizing_select_mainSearch_Desk_Name;
        }
		
		if( $request->has('resizing_select_mainSearch_Name') && !empty($request->resizing_select_mainSearch_Name)) {
           $int_search_dd_val_desk_new = $request->resizing_select_mainSearch_Name;
        }
		
		return $int_search_dd_val_desk_new;
    }
	
	// returns the query for single single term
	function get_skill_wise_query($skills_query, $arr_search_data, $int_type_of_user, $search_data, $table_name)
	{

     $skills_query->where(function($q)use ($arr_search_data, $int_type_of_user, $table_name, $search_data) {
				foreach($arr_search_data as $arr_search_data_row){
					$q->where($table_name.'.first_name', 'LIKE', '%'.$arr_search_data_row.'%');
					$q->orWhere($table_name.'.last_name', 'LIKE', '%' . $arr_search_data_row . '%');
					  
					  // if(!empty($int_type_of_user) && $int_type_of_user == 2)
					  // {
						 // $q->orWhere($table_name.'.skills', 'LIKE', '%' . $arr_search_data_row . '%');  
					  // }
				}
				//$q->where('comp.first_name', 'like', '%' . $search_data . '%')
				//->orWhere('comp.last_name', 'like', '%' . $search_data . '%');
		 });
										 
	   return $skills_query;									 
     }
	
	// returns the query for word wise
	function get_word_wise_query($word_wise_query, $arr_search_data_word_wise, $int_type_of_user, $search_data, $table_name,$role='')
	{
	    $word_wise_query->where(function($q)use ($arr_search_data_word_wise, $int_type_of_user, $table_name, $search_data,$role) {
												
		//foreach($arr_search_data_word_wise as $arr_search_data_word_wise_row){
			if(!empty($arr_search_data_word_wise[0]))
			{
				$string1 = $arr_search_data_word_wise[0] ." ".$arr_search_data_word_wise[1];
				// Shubham Code Start //
					if(!empty($role == 3)){
						$q->where($table_name.'.first_name', 'LIKE', '%'.$search_data.'%');
					}else{
						$q->where($table_name.'.first_name', 'LIKE', '%'.$string1.'%');
					}
				// Shubham Code End //
			}
			
			if(empty($role)){
				if(!empty($arr_search_data_word_wise[1]))
				{
					if($arr_search_data_word_wise[1] == 'relation' || $arr_search_data_word_wise[1] == 'RELATION')
					{
						$q->orWhere($table_name.'.last_name', 'LIKE', '%' . $arr_search_data_word_wise[1] . '%');
					}
					else
					{
						$q->where($table_name.'.last_name', 'LIKE', '%' . $arr_search_data_word_wise[1] . '%');  
					}	
				}
			}
			
			//$q->orWhere($table_name.'.name', 'LIKE', '%' . $search_data . '%');
		//}
				
				//$q->where('users.first_name', 'like', '%' . $search_data . '%')
				//->orWhere('users.last_name', 'like', '%' . $search_data . '%');
		 });
		return 	$word_wise_query;							 
    }
	
	// get a basic search results 
	public function getSearchData($search_data, $request)
	{
		//DB::enableQueryLog();
# your laravel query builder goes here
		// print_r($request->all());die;
		$events = '';
		$int_search_dd_val_desk_new = 0;
		$user_current_info = get_current_user_info();
		$int_type_of_user = 0;

		if(empty($request->search)){
			$request['search'] = $request['home-site-search-input-mobile'];
		}
		
		if(!empty($user_current_info->type_of_user))
		{
			$int_type_of_user = $user_current_info->type_of_user; 
		}
		// pr($int_type_of_user,1);
	    $str_no_of_char = 100;		
		$slug_prefix_list = $this->_slug_prefix_list;
		
		$arr_search_data = array();
		$arr_search_data_word_wise = array();
		
		if($search_data == 'pr' || $search_data == 'PR')
		{
		   $search_data = 'public relation';
		}
		
		if(!empty($search_data) && strlen($search_data)<=2)
		{		   	
		   return false;
		}	
		
		// for word wise search
		if(!empty($search_data) && strpos($search_data, ' ')>0)
		{
			//$arr_search_data = explode(' ',$search_data);
              $arr_search_data[0] = $search_data;
              $arr_search_data_word_wise = explode(' ',$search_data); 			  
		}
		else
		{
			$arr_search_data[0] = $search_data;
		}
		
		if( $request->has('type') ) {
           $str_type_new = $request->query('type');
        }
		
		if( $request->has('category_id') ) {
           $int_category_id = $request->query('category_id');
        }
		
		 $int_search_dd_val_desk_new = $this->getSearchDDlVal($request);
		
		/*
		// search the roles in the role table for the input text entered 		
		$user_user_role_data = UsersUserRole::select('id')->where('role_name', 'like', '%' . $search_data . '%')->first();			
		$user_user_role_data_id = @$user_user_role_data->id;
		
		$people_ids_results = DB::select( DB::raw(" SELECT people_id from roles where role = :user_user_role_data_id"), array(
   'user_user_role_data_id' => $user_user_role_data_id ));
   
        $arr_people_ids = array();
		
        foreach($people_ids_results as $people_ids_results_row)
		{
			if(!empty($people_ids_results_row->people_id))
			{
			   $arr_people_ids[] = $people_ids_results_row->people_id;	
			}
			
		}
   
        $product_collaborators_results = DB::select( DB::raw(" SELECT people_id from product_collaborators where role = :user_user_role_data_id"), array(
   'user_user_role_data_id' => $user_user_role_data_id ));
   
        foreach($product_collaborators_results as $product_collaborators_results_row)
		{
			
			if(!empty($product_collaborators_results_row->people_id))
			{
			   $arr_people_ids[] = $product_collaborators_results_row->people_id;	
			}
			
		}
		
		$arr_people_ids = array_values($arr_people_ids); */
		
		//users
		//first_name
		//last_name
       //DB::enableQueryLog();	
		//$search_temr =
        //DB::raw("SUBSTRING(products.description, 1, ".$str_no_of_char.") as content_description")
        //DB::raw("SUBSTRING(events.description, 1, ".$str_no_of_char.") as content_description"),
        //DB::raw("SUBSTRING(users.description, 1, ".$str_no_of_char.") as content_description"),	   
		
		$arr_image_data_new = array();
		
		//DB::raw('2 as data_type_index'),
		
		// for product categories
		$categories = DB::table('categories')
			->select('categories.id'
			  ,'categories.category_name'
			  ,DB::raw('0 as image'), DB::raw('0 as slug_prefix'), DB::raw('10 as type'), DB::raw('0 as slug'))
			//->where('products.name', 'like', '%' . $search_data . '%');  
			->where(function($query) use ($arr_search_data){
				foreach($arr_search_data as $arr_search_data_row){
					$query->where('categories.category_name', 'LIKE', '%'.$arr_search_data_row.'%');
				}
            });
		
		// for products
		/*$products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw("'".$slug_prefix_list[2][0]['slug_prefix']."' as slug_prefix"), DB::raw('2 as type'), 'products.slug');
			//->where('products.name', 'like', '%' . $search_data . '%'); */

         $products =    Product::get_product_list_by_image($slug_prefix_list); 			
		 
		// search for the products by category	
		if(!empty($int_category_id) && $str_type_new == 'product_category')
		{
			
			$products->join('product_categories','product_categories.product_id', '=', 'products.id');
			$products->where('product_categories.category_id', '=', $int_category_id);
		}	
        else
		{			
			$products->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('products.name', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
        }
		
		$toy_products =    Product::get_toy_product_list_by_image($slug_prefix_list); 			
		 
		// search for the products by category	
					
		$toy_products->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('products.name', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
        
		$game_products =    Product::get_game_product_list_by_image($slug_prefix_list); 			
		 
		// search for the products by category	
					
		$game_products->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('products.name', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
		
		
		$brand_lists =    BrandList::get_brand_list_by_image($slug_prefix_list); 			
		 					
		$brand_lists->where(function($query) use ($arr_search_data){
				foreach($arr_search_data as $arr_search_data_row){
					$query->where('brand_lists.name', 'LIKE', '%'.$arr_search_data_row.'%');
				}
			});
        
        // for blogs
        $blogs =    Blog::get_blog_list_by_image($slug_prefix_list); 			
		
		$blogs->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('blogs.title', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
		
		
        // for non categories list   
		if(empty($int_category_id) && empty($str_type_new))
		{  
 		
			// for events
			// if($int_type_of_user == 2 || $int_type_of_user == 3) {
			$events = DB::table('events')
					->select('events.id', 'events.name'
					  ,'events.main_image as image', DB::raw("'".$slug_prefix_list[3][0]['slug_prefix']."' as slug_prefix"), DB::raw('3 as type'), 'events.slug')
					 //->where('events.name', 'like', '%' . $search_data . '%');
					 ->where(function($query) use ($arr_search_data){
						foreach($arr_search_data as $arr_search_data_row){
							$query->where('events.name', 'LIKE', '%'.$arr_search_data_row.'%');
						}
					});	
				// }		
				


			// for innovator users	
			$inventor_users = User::get_people_user_list_by_image($arr_search_data,$request->search);
				
				// echo "<pre>"; print_r($inventor_users); die;						 
			 // fora  role wise search
			 //if(!empty($arr_people_ids) && count($arr_people_ids)>0)			 
			 //{
				 //$inventor_users->whereIn('users.id', $arr_people_ids);
			 //}
			 //else
			 //{
			
				 // for word wise search like Tim Walsh
				 if(!empty($arr_search_data_word_wise))
				 {
					  $inventor_users = $this->get_word_wise_query($inventor_users, $arr_search_data_word_wise, $int_type_of_user, $search_data, 'users');	
				 }
				 else
				 {
					 $inventor_users = $this->get_skill_wise_query($inventor_users, $arr_search_data, $int_type_of_user, $search_data, 'users');							 
				 }							 
			 //}
				 
		   // for company users		 
		   $company_users = User::get_company_user_list_by_image($arr_search_data);	 
		   	// echo "<pre>"; print_r($company_users); die;
		   // for word wise search like Tim Walsh
				 if(!empty($arr_search_data_word_wise))
				 {
					// Shubham Code Start //
					 	$role = 3;
					// Shubham Code End //
				   $company_users = $this->get_word_wise_query($company_users, $arr_search_data_word_wise, $int_type_of_user, $search_data, 'comp',$role);

				 }
				 else
				 {
					$company_users = $this->get_skill_wise_query($company_users, $arr_search_data, $int_type_of_user, $search_data, 'comp');
				 }
						 
				 // for people
				 if(!empty($int_search_dd_val_desk_new) && $int_search_dd_val_desk_new == 1)
				 {	 
				   $company_users = $inventor_users;
				 }
				 
				 // for company
				 if(!empty($int_search_dd_val_desk_new) && $int_search_dd_val_desk_new == 2)
				 {	 
				   $company_users = $company_users;
				 }
				 
				 // for brand list
				 if(!empty($int_search_dd_val_desk_new) && ($int_search_dd_val_desk_new == 5))
				 {
				    $company_users = $brand_lists; 
				 }
				 				 				 
				 // for toys
				 if(!empty($int_search_dd_val_desk_new) && ($int_search_dd_val_desk_new == 3))
				 {
				    $company_users = $toy_products; 
				 }
				 
				 // for games
				 if(!empty($int_search_dd_val_desk_new) && ($int_search_dd_val_desk_new == 4))
				 {
				    $company_users = $game_products; 
				 }

				//  $news_feeds = DB::table('feeds_news')
				// ->select('feeds_news.id', DB::raw("feeds_news.title as name"), 'feeds_news.image', DB::raw("'feeds_news' as slug_prefix"), DB::raw('9 as type'),  'feeds_news.id as slug')->where('feeds_news.pop_feed_position','!=',0)
				// ->where(function($query) use ($arr_search_data){
				// 	foreach($arr_search_data as $arr_search_data_row){
				// 		$query->where('feeds_news.title', 'LIKE', '%'.$arr_search_data_row.'%');
				// 	}
				// });

				 
				 if(empty($int_search_dd_val_desk_new))
				 {
					$company_users->union($blogs);
                    // $company_users->union($news_feeds);
					$company_users->union($inventor_users);
					$company_users->union($brand_lists); 
				    $company_users->union($products);
                    $company_users->union($categories);
                    $company_users = $company_users->union($events);   					
				 }
				 
				// if($int_type_of_user == 2 || $int_type_of_user == 3) {
				// }
				
				$company_users = $company_users->get();	
				
				$news_feeds = DB::table('feeds_news')
				->select('feeds_news.id', DB::raw("feeds_news.title as name"), 'feeds_news.image', DB::raw("'news_feeds' as slug_prefix"), DB::raw('9 as type'),  'feeds_news.id as slug')
				->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('feeds_news.title', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
				$newsFeeds = $news_feeds->get()->toArray();

				$feeds = DB::table('feeds')
				->select('feeds.id', DB::raw("feeds.title as name"), 'feeds.image', DB::raw("'feeds' as slug_prefix"), DB::raw('10 as type'),  'feeds.id as slug')
				->where(function($query) use ($arr_search_data){
					foreach($arr_search_data as $arr_search_data_row){
						$query->where('feeds.title', 'LIKE', '%'.$arr_search_data_row.'%');
					}
				});
				$feeds_post = $feeds->get()->toArray();

				if(!empty($newsFeeds)){
					$company_users = $company_users->merge($newsFeeds);
					// $company_users = array_merge($company_users->toArray(),$newsFeeds);
				}
				if(!empty($feeds_post)){
					$company_users = $company_users->merge($feeds_post);
					// $company_users = array_merge($company_users->toArray(),$newsFeeds);
				}
				
				
				// echo "<pre>company_users - "; print_r($company_users); die;
		}		
		else
		{
			   $company_users = $products->get();
		}

		//echo "<pre>"; print_r($company_users); die;
		
		$laQuery = DB::getQueryLog();


       			   
			
	# optionally disable the query log:
//	DB::disableQueryLog();

		
       return $company_users;
    }
	
    // for advanced search page
    public function advance_search(Request $request)
    {
    	$arr_slug_prefix_new = array();
		$arr_type_new = array();
	    $desk_search_data = $request->input('home-site-search-text-name');
        $mobile_search_data = $request->input('home-site-search-input-mobile'); 
          
        $search_data = '';
        if(!empty($desk_search_data))		   
		{
			$search_data = $desk_search_data;
		}
		
		if(!empty($mobile_search_data))		   
		{
			$search_data = $mobile_search_data;
		}
				
		$folder_path = $this->_images_upload_folder_path;		
		
		// get the entire search results
		$result_data = (!empty($search_data)) ? $this->getSearchData($search_data, $request) : [] ;
		// echo "<pre>";print_r($result_data)
		$slug_prefix_list = $this->_slug_prefix_list;
		
		// store all the slugs and types in an array
		foreach($result_data as $result_data_row)
		{
		  $arr_slug_prefix_new[] = $result_data_row->slug_prefix;
		  $arr_type_new[] = $result_data_row->type;
		}
		
		$arr_slug_prefix_new = array_unique($arr_slug_prefix_new);
		$arr_type_new = array_unique($arr_type_new);
		
		foreach($arr_slug_prefix_new as $arr_slug_prefix_new_row_key => $arr_slug_prefix_new_row_val)
		{
			if($arr_slug_prefix_new_row_val =="product" || $arr_slug_prefix_new_row_val =="event")
			{
				$arr_slug_prefix_new[$arr_slug_prefix_new_row_key] = 0;
			}
		}
		$countries = Country::pluck('country_name', 'id');
    	return view('front.pages.home_search', compact('arr_slug_prefix_new', 'arr_type_new', 'search_data', 'result_data', 'folder_path', 'slug_prefix_list','countries'));	
    }

    // get advanced search page
    public function get_advance_search(Request $request)
    {
    	$arr_slug_prefix_new = array();
		$arr_type_new = array();
		
		$folder_path = $this->_images_upload_folder_path;		
		
		if(!empty($request->additional_search) && $request->additional_search == 'yes'){
			$result_data = $this->GetAdditionalSearch($request); die;
		}else{
			$result_data = $this->GetAdvanceSearch($request);
		}
		$search_data = '';
		
		$slug_prefix_list = $this->_slug_prefix_list;
		
		foreach($result_data as $result_data_row)
		{
		  $arr_slug_prefix_new[] = $result_data_row->slug_prefix;
		  $arr_type_new[] = $result_data_row->type;
		}
		
		$arr_slug_prefix_new = array_unique($arr_slug_prefix_new);
		$arr_type_new = array_unique($arr_type_new);
		
		foreach($arr_slug_prefix_new as $arr_slug_prefix_new_row_key => $arr_slug_prefix_new_row_val)
		{
			if($arr_slug_prefix_new_row_val =="product" || $arr_slug_prefix_new_row_val =="event")
			{
				$arr_slug_prefix_new[$arr_slug_prefix_new_row_key] = 0;
			}
		}
		$countries = Country::pluck('country_name', 'id');
    	return view('front.pages.advance_search_ajax', compact('arr_slug_prefix_new', 'arr_type_new', 'search_data', 'result_data', 'folder_path', 'slug_prefix_list','countries','request'));
    }

    // get advanced search results 
    function GetAdvanceSearch(Request $request)
    {
		$arr_search_data_new = array();
    	$events = '';
		$explode_keyword_text_search = array();
		$user_current_info = get_current_user_info();
		$int_type_of_user = 0;
		if(!empty($user_current_info->type_of_user))
		{
			$int_type_of_user = $user_current_info->type_of_user; 
		}
	    $str_no_of_char = 100;		
		$slug_prefix_list = $this->_slug_prefix_list;
		
		$int_filter_by_people = 0;
		$int_filter_by_company = 0;
        $int_filter_by_product = 0;		
		
		$int_people_selected_flag = 0;		
        $int_company_selected_flag = 0;		
        $int_product_selected_flag = 0;		  
	    $int_people_company_selected_flag = 0;		
	    $int_product_people_company_selected_flag = 0;		 
        $int_product_people_selected_flag = 0;		
        $int_product_company_selected_flag = 0;		 
	    $int_product_company_not_selected_flag = 0;
		
		// fetch the check boxes data
		if(!empty($request->advanced_people_filter_chk))
		{
			foreach($request->advanced_people_filter_chk as $advanced_people_filter_chk_key => $advanced_people_filter_chk_val)
			{
				$advanced_people_filter_chk_val = intval($advanced_people_filter_chk_val);
				
				if(!empty($advanced_people_filter_chk_val))
				{
				   $int_filter_by_people = 1;	
				}
				
			}
		}
		
		// fetch the check boxes data
		if(!empty($request->advanced_company_filter_chk))
		{
			foreach($request->advanced_company_filter_chk as $advanced_company_filter_chk_key => $advanced_company_filter_chk_val)
			{
				$advanced_company_filter_chk_val = intval($advanced_company_filter_chk_val);
				
				if(!empty($advanced_company_filter_chk_val))
				{
				   $int_filter_by_company = 2;	
				}
				
			}
		}
		
		// fetch the check boxes data
		if(!empty($request->advanced_product_filter_chk))
		{
			foreach($request->advanced_product_filter_chk as $advanced_product_filter_chk_key => $advanced_product_filter_chk_val)
			{
				$advanced_product_filter_chk_val = intval($advanced_product_filter_chk_val);
				
				if(!empty($advanced_product_filter_chk_val))
				{
				   $int_filter_by_product = 3;	
				}
				
			}
		}
		
				  
		// when  people is selected
        if(!empty($int_filter_by_people) && empty($int_filter_by_company) && empty($int_filter_by_product))
		{ 
          $int_people_selected_flag = 1;
		}
		
		// when  company is selected
		if(empty($int_filter_by_people) && !empty($int_filter_by_company) && empty($int_filter_by_product))
		{ 
          $int_company_selected_flag = 1;
		}
		
		// when only product is selected 
		if(empty($int_filter_by_people) && empty($int_filter_by_company) && !empty($int_filter_by_product))
		{  
          $int_product_selected_flag = 1;
		}
		
		// when  people and company is selected
		if(!empty($int_filter_by_people) && !empty($int_filter_by_company) && empty($int_filter_by_product))
		{  
	      $int_people_company_selected_flag = 1;
		}
		
		// when  product, people and company is selected
		if(!empty($int_filter_by_people) && !empty($int_filter_by_company) && !empty($int_filter_by_product))
		{  
	      $int_product_people_company_selected_flag = 1;
		}
		
		// when  people and product is selected
		if(!empty($int_filter_by_people) && empty($int_filter_by_company) && !empty($int_filter_by_product))
		{ 
          $int_product_people_selected_flag = 1;
		}
		
		// when  product and company is selected
		if(empty($int_filter_by_people) && !empty($int_filter_by_company) && !empty($int_filter_by_product))
		{ 
          $int_product_company_selected_flag = 1;
		}
		
		// when  product, people and company is not selected
		if(empty($int_filter_by_people) && empty($int_filter_by_company) && empty($int_filter_by_product))
		{  
	      $int_product_company_not_selected_flag = 1;
		}
		
		
		
	   if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
		{
		  $inventor_users = User::get_people_user_list_by_image($arr_search_data_new,$request->keyword_text_search);

		}
		
		if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
		{

			// echo "yes2"; die;
	        //$inventor_users = User::get_people_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
			$company_users = User::get_company_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
		}		
		
		if(!empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_product_selected_flag) || !empty($int_product_people_selected_flag))
		{
			//echo "yes1"; die;
		  // $inventor_users = User::get_people_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
			//$company_users = User::get_company_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
			$products =    Product::get_product_list_by_image($slug_prefix_list,$request->keyword_text_search);
			$products  		= $products
							->join('product_collaborators','products.id', '=', 'product_collaborators.product_id')
							->where('product_collaborators.role',$request->collab_user_role);
		}
		
		
		if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag)) 
		{
			$inventor_users = User::get_people_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
			$company_users = User::get_company_user_list_by_image($arr_search_data_new,$request->keyword_text_search);
			$products =    Product::get_product_list_by_image($slug_prefix_list,$request->keyword_text_search);
			$products  		= $products
							->join('product_collaborators','products.id', '=', 'product_collaborators.product_id')
							->where('product_collaborators.role',$request->collab_user_role);
		}
		

		// echo "<pre>"; print_r($products); die;
		
		if (!empty($request->country_id)) {
			
			if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
			{
				$inventor_users = $inventor_users->where('country_id',$request->country_id);
			}
			
			if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
			{
			    $company_users  = $company_users->where('country_id',$request->country_id);
			}
						
			if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag) || !empty($int_people_company_selected_flag))
			{
				$inventor_users = $inventor_users->where('country_id',$request->country_id);
				
				$company_users  = $company_users->where('country_id',$request->country_id);
			}
		}
		
		if (!empty($request->state)) {
			
			if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
			{
			  $inventor_users = $inventor_users->where('state','like', '%' . $request->state. '%');
			}			
			
			if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
			{
			  $company_users  = $company_users->where('state','like', '%' . $request->state. '%');
			}
			
			if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag) || !empty($int_people_company_selected_flag))
			{
				$inventor_users = $inventor_users->where('state','like', '%' . $request->state. '%');
				$company_users  = $company_users->where('state','like', '%' . $request->state. '%');
			}
		}
		
		if (!empty($request->city)) {
			
			if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
			{
			  $inventor_users = $inventor_users->where('city','like', '%' . $request->city. '%');
			}
			
			if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
			{
			  $company_users  = $company_users->where('city','like', '%' . $request->city. '%');
			}
			
			if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag) || !empty($int_people_company_selected_flag))
			{
				$inventor_users = $inventor_users->where('city','like', '%' . $request->city. '%');
				$company_users  = $company_users->where('city','like', '%' . $request->city. '%');
			}
		}
		
		if(!empty($request->collab_user_role)) {

			//echo $request->collab_user_role; die;
			// $inventor_users = $inventor_users
			// 				->leftjoin('roles','users.id', '=', 'roles.people_id')
			// 				->join('product_collaborators','users.id', '=', 'product_collaborators.people_id')
			// 				->where(function($query) use ($request){
			// 			        $query->where('roles.role',$request->collab_user_role);
			// 			        $query->orWhere('product_collaborators.role',$request->collab_user_role);
			// 			    });
							// ->where('roles.role',$request->collab_user_role);

            if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
			{  
				//echo "dfs"; die;
			  $inventor_users = $inventor_users
			          ->whereRaw('id in (
									    SELECT people_id from roles where role = '.$request->collab_user_role.' 
									    UNION
									    SELECT people_id from product_collaborators where role = '.$request->collab_user_role.' 
									) ');
			}
			
			if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
			{
				//echo "dfs2"; die;
			   // $company_users  = $company_users
						// 	->join('roles','comp.id', '=', 'roles.user_id')
						// 	->where('roles.role',$request->collab_user_role);


			}
			if(!empty($int_company_selected_flag) || !empty($int_product_company_selected_flag)) {
				 $company_users  = $company_users
							->join('roles','comp.id', '=', 'roles.user_id')
							->where('roles.role',$request->collab_user_role);
			}
			
			
			if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag) || !empty($int_people_company_selected_flag))
			{
			//	echo "dfs3"; die;
				$inventor_users = $inventor_users
			          ->whereRaw('id in (
									    SELECT people_id from roles where role = '.$request->collab_user_role.' 
									    UNION
									    SELECT people_id from product_collaborators where role = '.$request->collab_user_role.' 
									) ');
			          // if()
						if(empty($int_product_people_company_selected_flag) || empty($int_people_company_selected_flag)){			
				$company_users  = $company_users
							->join('roles','comp.id', '=', 'roles.user_id')
							->where('roles.role',$request->collab_user_role);
						}
			}


			
						// ->whereIn('id', static function ($query) use ($request) {
			   //              $query->select(['people_id'])
			   //                  ->from((new Role)->getTable())
			   //                  ->where('role', $request->collab_user_role);

				  //               $query->union(function($qq)use ($request) {
						// 				$qq->select(['people_id'])
						//                     ->from((new ProductCollaborator)->getTable())
						//                     ->where('role', $request->collab_user_role);
						// 		});
			   //          });
						
						// ->whereIn('id', DB::raw("SELECT people_id from roles where role = '$request->collab_user_role' UNION SELECT people_id from product_collaborators where role = '$request->collab_user_role'"));


			 // select `users`.`id`, CONCAT(users.first_name,' ',users.last_name) as name, `users`.`profile_image` as `image`, `users`.`role` as `slug_prefix`, 1 as type, `users`.`slug` from `users` where `users`.`role` = ? and `users`.`type_of_user` = ? and `id` in (select `people_id` from `roles` where `role` = ?)


			// select `users`.`id`, CONCAT(users.first_name,' ',users.last_name) as name, `users`.`profile_image` as `image`, `users`.`role` as `slug_prefix`, 1 as type, `users`.`slug` from `users` where id in 
			// (
			//     SELECT people_id from roles where role = 40 
			//     UNION
			//     SELECT people_id from product_collaborators where role = 40 
			// ) and `users`.`role` = 2 and `users`.`type_of_user` = 2 


			// select `users`.`id`, CONCAT(users.first_name,' ',users.last_name) as name, `users`.`profile_image` as `image`, `users`.`role` as `slug_prefix`, 1 as type, `users`.`slug` from `users` where `users`.`role` = ? and `users`.`type_of_user` = ? and id in (
			//     SELECT people_id from roles where role = 3 
			//     UNION
			//     SELECT people_id from product_collaborators where role = 3 
			// )

			// select `users`.`id`, CONCAT(users.first_name,' ',users.last_name) as name, `users`.`profile_image` as `image`, `users`.`role` as `slug_prefix`, 1 as type, `users`.`slug` from `users` where `users`.`role` = 2 and `users`.`type_of_user` = 2 and `id` in 
			// (
			// 	(select `people_id` from `roles` where `role` = 40) 
			// 	union 
			// 	(select `people_id` from `product_collaborators` where `role` = 40)
			// )

			// \DB::enableQueryLog();
			//  $inventor_users->get();
			//  $query = \DB::getQueryLog();
			//  pr($query,1);
			

            				
					
			// $products  		= $products
			// 				->join('product_collaborators','products.id', '=', 'product_collaborators.product_id')
			// 				->where('product_collaborators.role',$request->collab_user_role);
						
						
		}
		
		
        // search the skills in the skills field
		if((isset($request->skills) && !empty($request->skills)) ||(isset($request->keyword_text_search) && !empty($request->keyword_text_search))) { 
				
			
			if(strpos($request->keyword_text_search, ' '))
			{
			  $explode_keyword_text_search = explode(' ', @$request->keyword_text_search);
			}
			else
			{
			  $explode_keyword_text_search[0] = @$request->keyword_text_search; 	
			}
			
			$explode = explode(',', @$request->skills);

			
			//$explode = array_merge($explode, $explode_keyword_text_search); 
			//echo "<pre>"; print_r($explode); die;
			// echo $int_product_people_selected_flag; die;
			if(!empty($int_people_selected_flag) || !empty($int_people_company_selected_flag) || !empty($int_product_people_company_selected_flag) ||!empty($int_product_people_selected_flag))
			{


			  $inventor_users = $inventor_users
							->where(function($q)use ($explode) {
								foreach($explode as $arr_search_data_row){
									$q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",skills)');
								}
							});
			}
            
			if(!empty($int_people_company_selected_flag) || !empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_company_selected_flag))
			{

			  $company_users  = $company_users
							->where(function($q)use ($explode) {
								foreach($explode as $arr_search_data_row){
									$q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",skills)');
								}
							});
			}
            
			
			if(!empty($int_product_company_selected_flag) || !empty($int_product_people_company_selected_flag) || !empty($int_product_selected_flag) || !empty($int_product_people_selected_flag))
			{


			  $products->where(function($q) use ($explode){
					
					foreach($explode as $arr_search_data_row){
									$q->where('products.name', 'LIKE', '%'.$arr_search_data_row.'%');
									//$q->orWhere('products.description', 'LIKE', '%'.$arr_search_data_row.'%');
								}
				});
			}
            
			if(!empty($int_product_people_company_selected_flag) || !empty($int_product_company_not_selected_flag))
			{


				//echo "<pre>"; print_r($request->skills); die;
				$inventor_users = $inventor_users
							->where(function($q)use ($explode) {
								foreach($explode as $arr_search_data_row){
									//echo $arr_search_data_row; die;
									$q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",skills)');
								}
							});
							
				$company_users  = $company_users
							->where(function($q)use ($explode) {

								foreach($explode as $arr_search_data_row){

									$q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",skills)');
								}
							});			
				
				$products->where(function($q) use ($explode){
					
					foreach($explode as $arr_search_data_row){
						
									$q->where('products.name', 'LIKE', '%'.$arr_search_data_row.'%');
									//$q->orWhere('products.description', 'LIKE', '%'.$arr_search_data_row.'%');
								}
				});
				
			}	


 			
		}

		if(empty($request->keyword_text_search) && empty($request->skills) && empty($request->country_id) && empty($request->state) && empty($request->city) && empty($request->collab_user_role)) 
		{
			return array();
		}
		
		
        // when  people is selected
        if(!empty($int_filter_by_people) && empty($int_filter_by_company) && empty($int_filter_by_product))
		{ 
          $company_users = $inventor_users;
		}
		
		// when  company is selected
		if(empty($int_filter_by_people) && !empty($int_filter_by_company) && empty($int_filter_by_product))
		{ 
          $company_users = $company_users;
		}
		
		// when  people and company is selected
		if(!empty($int_filter_by_people) && !empty($int_filter_by_company) && empty($int_filter_by_product))
		{  
	      $company_users = $company_users->union($inventor_users);
		}
		
		// when  product, people and company is selected
		if(!empty($int_filter_by_people) && !empty($int_filter_by_company) && !empty($int_filter_by_product))
		{  
	      $company_users = $company_users->union($inventor_users);
		  $company_users = $company_users->union($products);
		}
		
		// when only product is selected 
		if(empty($int_filter_by_people) && empty($int_filter_by_company) && !empty($int_filter_by_product))
		{  
          $company_users = $products;
		}
		
		// when  people and product is selected
		if(!empty($int_filter_by_people) && empty($int_filter_by_company) && !empty($int_filter_by_product))
		{ 
          $company_users = $inventor_users;
	      $company_users = $company_users->union($products);
		}
		
		// when  product and company is selected
		if(empty($int_filter_by_people) && !empty($int_filter_by_company) && !empty($int_filter_by_product))
		{ 
          $company_users = $company_users;
	      $company_users = $company_users->union($products);
		}
		
		// when  product, people and company is not selected
		if(empty($int_filter_by_people) && empty($int_filter_by_company) && empty($int_filter_by_product))
		{  
	      $company_users = $company_users->union($inventor_users);
		  $company_users = $company_users->union($products);
		}
		
		// $company_users = $company_users->union($products);
		$company_users = $company_users->get();
		//echo $company_users; die;
		//dd($company_users) die;
		return $company_users;
    }

	
    function GetAdditionalSearch(Request $request)
    {
		// echo '<pre> GetAdditionalSearch - '; print_r($request->all()); die;
		$blogs_arr['blogs'] = $wiki_arr['wiki'] = $pop_cast_arr['pop_casts'] = $entertainment_arr['entertainment'] = $feeds_arr['feeds'] = $news_feeds_arr['news_feeds'] = $rtn_arr = array();
		$rtn_arr_cnt = 0;
		
		if(!empty($request->contents)){
			$request->result_for = $request->contents;
			// DB::enableQueryLog();
			
			if(empty($request->advanced_filter_chk['blogs']) && empty($request->advanced_filter_chk['featured_articles']) && empty($request->advanced_filter_chk['wiki']) && empty($request->advanced_filter_chk['pop_cast']) && empty($request->advanced_filter_chk['entertainment']) && empty($request->advanced_filter_chk['feeds']) && empty($request->advanced_filter_chk['news_feeds']))
			{
				$blogs_arr['blogs'] = Blog::where('blogs.title', 'LIKE', '%'.$request->contents.'%')->where(['status'=>1,'added_by'=>1])->where('user_id','!=',0)->orWhere('blogs.meta_description', 'LIKE', '%'.$request->contents.'%')->get()->toArray();

				$wiki_arr['wiki'] = Wiki::where('wikis.title', 'LIKE', '%'.$request->contents.'%')->get()->toArray();

				$pop_cast_arr['pop_casts'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->contents.'%')->where('type', 'cast')->get()->toArray();

				$entertainment_arr['entertainment'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->contents.'%')->where('type', 'entertainment')->get()->toArray();

				$feeds_arr['feeds'] = Feed::where('feeds.title', 'LIKE', '%'.$request->contents.'%')->orWhere('feeds.caption', 'LIKE', '%'.$request->contents.'%')->get()->toArray();	

				$news_feeds_arr['news_feeds'] = NewsFeeds::where('feeds_news.title', 'LIKE', '%'.$request->contents.'%')->orWhere('feeds_news.caption', 'LIKE', '%'.$request->contents.'%')->get()->toArray();

			}else{

				if(!empty($request->advanced_filter_chk['blogs'])){
					$blogs_arr['blogs'] = Blog::where('blogs.title', 'LIKE', '%'.$request->contents.'%')->where(['status'=>1,'added_by'=>1])->where('user_id','!=',0)->orWhere('blogs.meta_description', 'LIKE', '%'.$request->contents.'%')->get()->toArray();
				}

				if(!empty($request->advanced_filter_chk['wiki'])){
					$wiki_arr['wiki'] = Wiki::where('wikis.title', 'LIKE', '%'.$request->contents.'%')->get()->toArray();
				}
				if(!empty($request->advanced_filter_chk['pop_cast'])){
					$pop_cast_arr['pop_casts'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->contents.'%')->where('type', 'cast')->get()->toArray();
				}
				if(!empty($request->advanced_filter_chk['entertainment'])){
					$entertainment_arr['entertainment'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->contents.'%')->where('type', 'entertainment')->get()->toArray();
				}
	
				if(!empty($request->advanced_filter_chk['feeds'])){
					$feeds_arr['feeds'] = Feed::where('feeds.title', 'LIKE', '%'.$request->contents.'%')->orWhere('feeds.caption', 'LIKE', '%'.$request->contents.'%')->get()->toArray();				
				}
				if(!empty($request->advanced_filter_chk['news_feeds'])){
					$news_feeds_arr['news_feeds'] = NewsFeeds::where('feeds_news.title', 'LIKE', '%'.$request->contents.'%')->orWhere('feeds_news.caption', 'LIKE', '%'.$request->contents.'%')->get()->toArray();
				}
			}			
			
			// pr($blogs_arr); die;
			$rtn_arr_cnt = count($blogs_arr['blogs']) + count($wiki_arr['wiki']) + count($pop_cast_arr['pop_casts']) + count($entertainment_arr['entertainment']) + count($feeds_arr['feeds']) + count($news_feeds_arr['news_feeds']);
			
			$rtn_arr = array_merge($blogs_arr,$wiki_arr,$pop_cast_arr,$entertainment_arr,$feeds_arr,$news_feeds_arr);
		}
		// echo $rtn_arr_cnt; die;

		// echo "<pre>rtn_arr_cnt - $rtn_arr_cnt - "; print_r($rtn_arr); die;
		$view = view('front.pages.additional_search_ajax', compact('rtn_arr','request','rtn_arr_cnt'))->render();
		echo $view; die;
		return $view;
	}
	
    function GetAdditionalSearch_copy(Request $request)
    {
		// echo '<pre> GetAdditionalSearch - '; print_r($request->all()); die;
		$blogs_arr = $featured_articles_arr = $wiki_arr = $pop_cast_arr = $entertainment_arr = $feeds_arr = $news_feeds_arr = $rtn_arr = array();
		$rtn_arr_cnt = 0;
		
		if(!empty($request->articles)){
			$request->result_for = $request->articles;
			// DB::enableQueryLog();
			if(!empty($request->advanced_filter_chk['blogs'])){
				$blogs_arr['blogs'] = Blog::where('blogs.title', 'LIKE', '%'.$request->articles.'%')->where(['status'=>1,'added_by'=>1])->where('user_id','!=',0)->orWhere('blogs.meta_description', 'LIKE', '%'.$request->articles.'%')->get()->toArray();
			}
			if(!empty($request->advanced_filter_chk['featured_articles'])){
				$featured_articles_arr['featured_articles'] = Blog::where('blogs.title', 'LIKE', '%'.$request->articles.'%')->where(['user_id'=>0,'status'=>1,'added_by'=>2])->orWhere('blogs.meta_description', 'LIKE', '%'.$request->articles.'%')->get()->toArray();
			}
			// dd(DB::getQueryLog()); die;
			if(empty($request->advanced_filter_chk['blogs']) && empty($request->advanced_filter_chk['featured_articles'])){
				$blogs_arr['blogs'] = Blog::where('blogs.title', 'LIKE', '%'.$request->articles.'%')->where(['status'=>1,'added_by'=>1])->where('user_id','!=',0)->orWhere('blogs.meta_description', 'LIKE', '%'.$request->articles.'%')->get()->toArray();

				$featured_articles_arr['featured_articles'] = Blog::where('blogs.title', 'LIKE', '%'.$request->articles.'%')->where(['user_id'=>0,'status'=>1,'added_by'=>2])->orWhere('blogs.meta_description', 'LIKE', '%'.$request->articles.'%')->get()->toArray();
			}
			// pr($blogs_arr); die;
			$rtn_arr_cnt = count($blogs_arr) + count($featured_articles_arr);
			$rtn_arr = array_merge($blogs_arr,$featured_articles_arr);
		}
		if(!empty($request->casts)){
			$request->result_for = $request->casts;
			if(!empty($request->advanced_filter_chk['wiki'])){
				$wiki_arr['wiki'] = Wiki::where('wikis.title', 'LIKE', '%'.$request->casts.'%')->orWhere('wikis.description', 'LIKE', '%'.$request->casts.'%')->get()->toArray();
			}
			if(!empty($request->advanced_filter_chk['pop_cast'])){
				$pop_cast_arr['pop_casts'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->casts.'%')->orWhere('entertainments.description', 'LIKE', '%'.$request->casts.'%')->where('type', 'cast')->get()->toArray();
			}
			if(!empty($request->advanced_filter_chk['entertainment'])){
				$entertainment_arr['entertainment'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->casts.'%')->orWhere('entertainments.description', 'LIKE', '%'.$request->casts.'%')->where('type', 'entertainment')->get()->toArray();
			}
			if(empty($request->advanced_filter_chk['wiki']) && empty($request->advanced_filter_chk['pop_cast']) && empty($request->advanced_filter_chk['entertainment'])){
				$wiki_arr['wiki'] = Wiki::where('wikis.title', 'LIKE', '%'.$request->casts.'%')->orWhere('wikis.description', 'LIKE', '%'.$request->casts.'%')->get()->toArray();

				$pop_cast_arr['pop_casts'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->casts.'%')->orWhere('entertainments.description', 'LIKE', '%'.$request->casts.'%')->where('type', 'cast')->get()->toArray();

				$entertainment_arr['entertainment'] = Entertainment::where('entertainments.title', 'LIKE', '%'.$request->casts.'%')->orWhere('entertainments.description', 'LIKE', '%'.$request->casts.'%')->where('type', 'entertainment')->get()->toArray();
			}
			$rtn_arr_cnt = count($wiki_arr) + count($pop_cast_arr) + count($entertainment_arr);
			$rtn_arr = array_merge($wiki_arr,$pop_cast_arr,$entertainment_arr);
		}
		if(!empty($request->feeds)){
			$request->result_for = $request->feeds;
			if(!empty($request->advanced_filter_chk['feeds'])){
				$feeds_arr['feeds'] = Feed::where('feeds.title', 'LIKE', '%'.$request->feeds.'%')->orWhere('feeds.caption', 'LIKE', '%'.$request->feeds.'%')->get()->toArray();				
			}
			if(!empty($request->advanced_filter_chk['news_feeds'])){
				$news_feeds_arr['news_feeds'] = NewsFeeds::where('feeds_news.title', 'LIKE', '%'.$request->feeds.'%')->orWhere('feeds_news.caption', 'LIKE', '%'.$request->feeds.'%')->get()->toArray();
			}
			if(empty($request->advanced_filter_chk['feeds']) && empty($request->advanced_filter_chk['news_feeds'])){
				$feeds_arr['feeds'] = Feed::where('feeds.title', 'LIKE', '%'.$request->feeds.'%')->orWhere('feeds.caption', 'LIKE', '%'.$request->feeds.'%')->get()->toArray();	

				$news_feeds_arr['news_feeds'] = NewsFeeds::where('feeds_news.title', 'LIKE', '%'.$request->feeds.'%')->orWhere('feeds_news.caption', 'LIKE', '%'.$request->feeds.'%')->get()->toArray();
			}
			$rtn_arr_cnt = count($feeds_arr) + count($news_feeds_arr);
			$rtn_arr = array_merge($feeds_arr,$news_feeds_arr);
		}

		// echo '<pre>rtn_arr - '; print_r($rtn_arr); die;
		$view = view('front.pages.additional_search_ajax', compact('rtn_arr','request','rtn_arr_cnt'))->render();
		echo $view; die;
		return $view;
	}
}
