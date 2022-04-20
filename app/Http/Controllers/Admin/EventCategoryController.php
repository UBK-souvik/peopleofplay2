<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EventCategory;

class EventCategoryController extends Controller
{
    public function getIndex()
    {
        return view('admin.event_category.index');
    }

    public function getList()
    {
        $event_category = \App\Models\EventCategory::where('parent_id', '=', NULL)->get();
        return \DataTables::of($event_category)
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
        return view('admin.event_category.create');
    }

    public function postCreate(Request $request)
    {
//dd($request->all());
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1'
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(EventCategory::$fillable_shadow);

            EventCategory::updateOrCreate(['id' => $request->event_id], $data);

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
        $event_category  = EventCategory::findOrFail($id);
        return view('admin.event_category.create', compact('event_category'));
    }

    public function getDelete($id)
    {
        $event_category  = EventCategory::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
