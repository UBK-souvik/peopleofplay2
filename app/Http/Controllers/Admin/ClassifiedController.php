<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classified;
use App\Models\User;
use App\Helpers\Utilities;
use App\Models\ClassifiedCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class ClassifiedController extends Controller
{
    public function getIndex()
    {
        return view('admin.classified.index');
    }
	

    public function getList()
    {
        $classified = \App\Models\Classified::select('classifieds.*','users.email as user_email','classified_categories.name as category_name');//'user',->with(['category'])
		$classified->join('users','users.id', '=', 'classifieds.user_id');
		$classified->join('classified_categories','classified_categories.id', '=', 'classifieds.category_id');
		
        return \DataTables::of($classified)
            ->editColumn('status', function ($query) {
                return config('cms.classified_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        $users = User::get_all_user_list_by_email_name();
		$classified_categories = ClassifiedCategory::pluck('name', 'id');
        return view('admin.classified.create', compact('classified_categories', 'users'));
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'classified_id' => 'nullable|exists:classifieds,id',
            'user_id' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:classified_categories,id',
            'status' => 'required|in:0,1'
        ]);

        if(!empty($request->user_id) ) {
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only(Classified::$fillable_shadow);
			
						 
            $data['added_by'] = 1;			
         	

            Classified::updateOrCreate(['id' => $request->classified_id], $data);

            DB::commit();
			Session::flash('classified_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdate($id)
    {
        $classified  = Classified::findOrFail($id);
        $classified_categories = ClassifiedCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
        return view('admin.classified.create', compact('classified_categories', 'classified', 'users'));
    }

    public function getDelete($id)
    {
        $classified  = Classified::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
	
	public function getUserProfileUrl(Request $request)
    {
		
	 $user_id =	@$request->int_user_id;
		
	 $base_url = url('/');
	 
	 $user_obj = \App\Models\User::find(@$user_id);
	 
	 $str_user_url_new = Utilities::get_user_url(@$base_url, @$user_obj);
	 
	 return response()->json([
            'status' => 1,
            'msg' => $str_user_url_new,
        ], 200);
	
	 

    }

}
