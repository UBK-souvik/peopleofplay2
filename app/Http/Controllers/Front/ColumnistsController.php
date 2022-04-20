<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Validator;

class ColumnistsController extends ModuleController
{

  /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

	public function __construct()
    { 
     parent::__construct();   
     
  }
	
	public function index()
    { 
      $users = DB::table('columnists')
            ->join('users','users.id','=','columnists.user_id')
            ->select('columnists.*','users.first_name','users.last_name','users.profile_image','users.slug')
            ->get();
        foreach ($users as $key => $row) {
          $users[$key]->blogs = Blog::select('blogs.title','blogs.slug','blogs.featured_image')->where('user_id',$row->user_id)->orderBy('id', 'desc')->get();
        }
     // echo "<pre>"; print_r($users); die;
    	 return view('front.pages.columnists', compact('users'));
	}
}
