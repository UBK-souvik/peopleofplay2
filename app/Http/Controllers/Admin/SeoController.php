<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoUrl;
use App\Models\User;
use App\Helpers\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class SeoController extends Controller
{
    public function getIndex()
    {
        return view('admin.seo_url.index');
    }
	

    public function getList()
    {
        $seo_url = \App\Models\SeoUrl::select('seo_urls.*');
		
        return \DataTables::of($seo_url)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.seo_url.create');
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'url_data' => 'required',
			'title' => 'required',
            'description' => 'required',
			'keywords' => 'required',
            'status' => 'required|in:0,1'
        ]);

        
        
        try {
            DB::beginTransaction();

            $data = $request->only(SeoUrl::$fillable_shadow);
						 
            SeoUrl::updateOrCreate(['id' => $request->seo_url_id], $data);

            DB::commit();
			Session::flash('seo_url_data_saved_flag', 1);
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
        $seo_url  = SeoUrl::findOrFail($id);
        return view('admin.seo_url.create', compact('seo_url'));
    }

    public function getDelete($id)
    {
        $seo_url  = SeoUrl::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

}
