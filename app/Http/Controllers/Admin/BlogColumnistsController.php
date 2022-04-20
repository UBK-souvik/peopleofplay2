<?php

namespace App\Http\Controllers\Admin;

use App\Models\Columnist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Session;

class BlogColumnistsController extends Controller
{
    public function getIndex()
    {
      $users = DB::table('users')
      ->join('blogs','blogs.user_id','=','users.id')
      ->select('users.id','users.first_name','users.last_name')
      ->groupBy('users.id')
      ->get();
      return view('admin.blog_columnists.index',compact('users'));
  }


  public function getList()
  {
     $blog = DB::table('columnists')
     ->join('users','users.id','=','columnists.user_id')
     ->select('columnists.*','users.first_name','users.last_name')
     ->get();
     return \DataTables::of($blog)
     ->editColumn('status', function ($query) {
        return config('cms.blog_status')[$query->status];
    })            
     ->make();

 }


 public function getDelete($id)
 {
    $blog_pedia  = Columnist::where('id',$id)->delete();
    return response()->json([
        'status' => 1,
        'msg' => adminTransLang('request_processed_successfully'),
    ], 200);
}

public function postCreate(Request $request)
{
    $str_tag = '';
     $messages = [
    'user_id.required' => 'Please Select User Name',     
    'user_id.unique' => 'User already exist'
  ];
    $request->validate([
        'user_id' => 'required|unique:columnists',
    ],$messages);

    try {
        DB::beginTransaction();
        
        $data = array(
            'user_id'=>$request->user_id,
            'user_type'=>1
        );
        DB::table('columnists')->insert($data);

        DB::commit();
        Session::flash('blog_pedia_data_saved_flag', 1);
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    } catch (\Exception $e) {
        DB::rollback();
        return errorMessage($e->getMessage(), true);
    }
}



}
