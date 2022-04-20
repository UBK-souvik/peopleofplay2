<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function getIndex()
    {
        return view('admin.blog_category.index');
    }

    public function getList()
    {
        $blog_category = \App\Models\BlogCategory::select('*');
        return \DataTables::of($blog_category)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.blog_category.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1'
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(BlogCategory::$fillable_shadow);

            BlogCategory::updateOrCreate(['id' => $request->blog_id], $data);

            DB::commit();
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
        $blog_category  = BlogCategory::findOrFail($id);
        return view('admin.blog_category.create', compact('blog_category'));
    }

    public function getDelete($id)
    {
        $blog_category  = BlogCategory::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
