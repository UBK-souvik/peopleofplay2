<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsCategoryController extends Controller
{
    public function getIndex()
    {
        return view('admin.news_category.index');
    }

    public function getList()
    {
        $news_category = \App\Models\NewsCategory::select('*');
        return \DataTables::of($news_category)
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
        return view('admin.news_category.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1'
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(NewsCategory::$fillable_shadow);

            NewsCategory::updateOrCreate(['id' => $request->blog_id], $data);

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
        $news_category  = NewsCategory::findOrFail($id);
        return view('admin.news_category.create', compact('news_category'));
    }

    public function getDelete($id)
    {
        $news_category  = NewsCategory::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
