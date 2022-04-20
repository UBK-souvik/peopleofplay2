<?php

namespace App\Http\Controllers\Admin;

use App\Models\RipCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use URL;

class RipCategoryController extends Controller
{
    public function getIndex()
    {
        return view('admin.rip.category.index');
    }

    public function getList()
    {
        $news_category = RipCategory::select('*');
        return \DataTables::of($news_category)

            ->addColumn('action', function ($query) {
                    $disabledCheck = RipCategory::checkDelete($query->id);
                    $disabled ='';
                    $delete_url = URL::to("admin/rest-in-play/category/delete/".$query->id);
                    if($disabledCheck == 1)
                    {
                       $delete_url = 'javascript:void(0);';
                        $disabled ='disabled';
                    } 
                    return '<a href="{{ URL::to("admin/rest-in-play/category/update") }}/'.$query->id.'">
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
        return view('admin.rip.category.create');
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

            $data = $request->only(RipCategory::$fillable_shadow);

            RipCategory::updateOrCreate(['id' => $request->id], $data);

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
        $data  = RipCategory::findOrFail($id);
        return view('admin.rip.category.create', compact('data'));
    }

    public function getDelete($id)
    {
        $news_category  = RipCategory::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
