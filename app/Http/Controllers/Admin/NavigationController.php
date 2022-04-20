<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    public function getIndex()
    {
        return view('admin.navigation.index');
    }

    public function getList()
    {
        $navigation = \App\Models\NavigationMaster::select('*');
        return \DataTables::of($navigation)
            ->editColumn('parent_id', function ($query) {
                return $query->parent_id ? 'Yes' : 'No';
            })
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->editColumn('show_in_menu', function ($query) {
                return config('cms.other_action')[$query->show_in_menu];
            })
            ->editColumn('show_in_permission', function ($query) {
                return config('cms.other_action')[$query->show_in_permission];
            })
            ->editColumn('child_permission', function ($query) {
                return config('cms.other_action')[$query->child_permission];
            })
            ->make();
    }

    public function getCreate()
    {
        $navigations = \App\Models\NavigationMaster::where('parent_id', '=', 0)->get();
        return view('admin.navigation.create', ['navigations' => $navigations]);
    }

    public function postCreate(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'action_path' => 'required',
            'display_order' => 'required|numeric',
            'parent_id' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'show_in_permission' => 'required',
            'child_permission' => 'required',
        ]);

        $fieldArr = array('name', 'en_name', 'action_path', 'icon', 'display_order', 'parent_id', 'status', 'show_in_menu', 'show_in_permission', 'child_permission');
        $dataArr = arrayFromPost($request, $fieldArr);

        $navigationMaster = new \App\Models\NavigationMaster();
        $navigationMaster->name = $dataArr->name;
        $navigationMaster->en_name = $dataArr->en_name;
        $navigationMaster->action_path = $dataArr->action_path;
        $navigationMaster->icon = $dataArr->icon;
        $navigationMaster->display_order = $dataArr->display_order;
        $navigationMaster->parent_id = $dataArr->parent_id;
        $navigationMaster->status = $dataArr->status;
        $navigationMaster->show_in_menu = $dataArr->show_in_menu;
        $navigationMaster->show_in_permission = $dataArr->show_in_permission;
        $navigationMaster->child_permission = $dataArr->child_permission;
        $navigationMaster->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('navigation_created'),
        ], 200);
    }


    public function getUpdate($id = null)
    {
        $navigationMaster = \App\Models\NavigationMaster::find($id);
        if (!$navigationMaster) {
            return redirect()->route('admin.navigation.index')->with(['fail' => adminTransLang('navigation_not_found')]);
        }
        $navigations = \App\Models\NavigationMaster::where('parent_id', '=', 0)->get();
        return view('admin.navigation.update', ['navigation' => $navigationMaster, 'navigations' => $navigations]);
    }

    public function postUpdate($id = false, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'action_path' => 'required',
            'display_order' => 'required|numeric',
            'parent_id' => 'required',
            'status' => 'required',
            'show_in_menu' => 'required',
            'show_in_permission' => 'required',
            'child_permission' => 'required',
        ]);

        $fieldArr = array('name', 'en_name', 'action_path', 'icon', 'display_order', 'parent_id', 'status', 'show_in_menu', 'show_in_permission', 'child_permission');
        $dataArr = arrayFromPost($request, $fieldArr);
        $navigationMaster = \App\Models\NavigationMaster::find($id);
        if ($navigationMaster != null) {
            $navigationMaster->name = $dataArr->name;
            $navigationMaster->en_name = $dataArr->en_name;
            $navigationMaster->action_path = $dataArr->action_path;
            $navigationMaster->icon = $dataArr->icon;
            $navigationMaster->display_order = $dataArr->display_order;
            $navigationMaster->parent_id = $dataArr->parent_id;
            $navigationMaster->status = $dataArr->status;
            $navigationMaster->show_in_menu = $dataArr->show_in_menu;
            $navigationMaster->show_in_permission = $dataArr->show_in_permission;
            $navigationMaster->child_permission = $dataArr->child_permission;
            $navigationMaster->save();
        }
        $response = [
            'status' => 1,
            'msg' => adminTransLang('navigation_updated'),
        ];
        return response()->json($response, 200);
    }
}
