<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogPedia;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class BlogPediaController extends Controller
{
    public function getIndex()
    {
        return view('admin.blog_pedia.index');
    }
	

    public function getList()
    {
        //$blog = \App\Models\BlogPedia::select('*')->with(['blog'])->where(['added_by' => 1]);
		
		$blog = \App\Models\BlogPedia::select('blog_pedias.*','blogs.title');
		$blog->join('blogs','blogs.id', '=', 'blog_pedias.blog_id');
		
        return \DataTables::of($blog)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })            
            ->make();
    }

    public function getCreate()
    {
        $blog_list = Blog::get_blog_list_data();
        return view('admin.blog_pedia.create', compact('blog_list'));
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'blog_id' => 'nullable|exists:blogs,id',
            'status' => 'required|in:0,1'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only(BlogPedia::$fillable_shadow);
			
            $data['added_by'] = 1;			
			
            BlogPedia::updateOrCreate(['id' => $request->blog_pedia_id], $data);

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

    public function getUpdate($id)
    {
        $blog_pedia  = BlogPedia::findOrFail($id);
		$int_blog_id_sel_new = $blog_pedia->blog_id; 
		$blog_list = Blog::get_blog_list_data();
        return view('admin.blog_pedia.create', compact('blog_pedia', 'blog_list', 'int_blog_id_sel_new'));
    }

    public function getDelete($id)
    {
        $blog_pedia  = BlogPedia::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

}
