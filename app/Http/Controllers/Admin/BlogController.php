<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;

class BlogController extends AdminModuleController
{
    public function getIndex()
    {
        return view('admin.blog.index');
    }
	

    public function getList()
    {
        $blog = \App\Models\Blog::select('*')->with(['user', 'category'])->where(['added_by' => 1]);
        return \DataTables::of($blog)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('featured_image', function ($query) {
                return @newsBlogImageBasePath($query->featured_image);
            })
            ->make();
    }

    public function getCreate()
    {
        $users = User::get_all_user_list_by_email_name();
		$blog_categories = BlogCategory::pluck('name', 'id');
        return view('admin.blog.create', compact('blog_categories', 'users'));
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'blog_id' => 'nullable|exists:blogs,id',
            'user_id' => 'nullable',
            'title' => 'required',
            'featured_image' => 'required_without:blog_id|file',
            'ckeditor_description_new' => 'required',
            'tags' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required|in:0,1'
        ],[
            'ckeditor_description_new.required' => 'Description field is required',
        ]);

        if(!empty($request->user_id) ) {
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only(Blog::$fillable_shadow);
			
			$str_tag = $this->getAdminBlogTags($request);
						 
            $str_ckeditor_description_new = $request->ckeditor_description_new;
			
			$data['tag'] = $str_tag;			
            $data['added_by'] = 1;			
            $data['description'] = $str_ckeditor_description_new;
			
        // pr($data,1);
            $data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'blog');
			
            Blog::updateOrCreate(['id' => $request->blog_id], $data);

            DB::commit();
			Session::flash('blog_data_saved_flag', 1);
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
        $blog  = Blog::findOrFail($id);
        $blog_categories = BlogCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
        return view('admin.blog.create', compact('blog_categories', 'blog', 'users'));
    }

    public function getDelete($id)
    {
        $blog  = Blog::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }


    public function InterviewIndex()
    {
        return view('admin.blog.interview.index');
    }

    public function InterviewList()
    {
        $blog = \App\Models\Blog::select('*')->with(['user', 'category'])->where(['added_by' => 2,'user_id' =>0]);
        return \DataTables::of($blog)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('featured_image', function ($query) {
                return @newsBlogImageBasePath($query->featured_image);
            })
            ->make();
    }

    public function InterviewCreate()
    {
        $users = User::get_all_user_list_by_email_name();
        $blog_categories = BlogCategory::pluck('name', 'id');
        return view('admin.blog.interview.create', compact('blog_categories', 'users'));
    }

    public function InterviewpostCreate(Request $request)
    {
        $str_tag = '';

        $request->validate([
            'blog_id' => 'nullable|exists:blogs,id',
            'user_id' => 'nullable',
            'title' => 'required',
            'featured_image' => 'required_without:blog_id|file',
            'ckeditor_description_new' => 'required',
            'tags' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required|in:0,1'
        ],[
            'ckeditor_description_new.required' => 'Description field is required',
        ]);

        if(!empty($request->user_id) ) {
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        }
        
        try {
            DB::beginTransaction();

            $data = $request->only(Blog::$fillable_shadow);
            
            $str_tag = $this->getAdminBlogTags($request);
			
			$str_ckeditor_description_new = $request->ckeditor_description_new;
                         
            $data['tag'] = $str_tag;            
            $data['user_id'] = 0;
            $data['added_by'] = 2;
			$data['description'] = $str_ckeditor_description_new;
			
            // pr($data,1);
            $data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'blog');
			
            Blog::updateOrCreate(['id' => $request->blog_id], $data);

            DB::commit();
            Session::flash('blog_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function InterviewUpdate($id)
    {
        $blog  = Blog::findOrFail($id);
        $blog_categories = BlogCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
        return view('admin.blog.interview.create', compact('blog_categories', 'blog', 'users'));
    }

    public function InterviewDelete($id)
    {
        $blog  = Blog::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

   public function postUpload(Request $request)
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
