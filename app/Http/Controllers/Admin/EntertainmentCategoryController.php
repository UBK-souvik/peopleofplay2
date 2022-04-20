<?php

namespace App\Http\Controllers\Admin;

use App\Models\EntertainmentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use URL;

class EntertainmentCategoryController extends Controller
{
    public function getIndex()
    {
        return view('admin.entertainment.category.index');
    }

    public function getList()
    {
        $news_category = \App\Models\EntertainmentCategory::select('*')->where('type','entertainment');
        return \DataTables::of($news_category)
            ->addColumn('action', function ($query) {
                $disabledCheck = EntertainmentCategory::checkDelete($query->id);
                $disabled ='';
                $delete_url = URL::to("admin/entertainment/category/delete/".$query->id);
                if($disabledCheck == 1)
                {
                   $delete_url = 'javascript:void(0);';
                    $disabled ='disabled';
                } 
                return '<a href="'. URL::to("admin/entertainment/category/update") .'/'.$query->id.'">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                        <a class="delete_admins"'. $disabled.' href="'.$delete_url  .'">
                            <i class="fa fa-trash fa-fw"></i>
                        </a>';
            })
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })->make();
    }

    public function getCreate()
    {
        return view('admin.entertainment.category.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'description' => 'required',
            'status' => 'required|in:0,1'
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(EntertainmentCategory::$fillable_shadow);

            EntertainmentCategory::updateOrCreate(['id' => $request->id], $data);

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
        // echo "dsfsd"; die;
        $data  = EntertainmentCategory::findOrFail($id);
        return view('admin.entertainment.category.create', compact('data'));
    }

    public function getDelete($id)
    {
        $news_category  = EntertainmentCategory::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

   
}
