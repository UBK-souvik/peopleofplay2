<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use App\Models\User;
use App\Models\UserTypePermission;

class PermissionController extends Controller
{
    public function getIndex()
    {
        return view('admin.user_type.index');
    }

    public function getList()
    {
        $role = \App\Models\UserType::select('*');
        return \DataTables::of($role)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.user_type.create');
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users_types',
            'status' => 'required',
        ]);

        $fieldArr = ['name', 'en_name', 'status'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $userRole = new \App\Models\UserType();
        $userRole->name = $dataArr->name;
        $userRole->status = $dataArr->status;
        $userRole->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('role_created'),
        ], 200);
    }

    public function getUpdate($id = null)
    {
        $userRole = \App\Models\UserType::find($id);
        if (!$userRole) {
            return redirect()->route('admin.permission.index')->with(['fail' => adminTransLang('role_not_found')]);
        }
        return view('admin.user_type.update', ['role' => $userRole]);
    }

    public function postUpdate($id = false, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users_roles,name,' . $id,
            'status' => 'required',
        ]);

        $fieldArr = ['name', 'en_name', 'status'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $userRole = \App\Models\UserType::find($id);
        if ($userRole != null) {
            $userRole->name = $dataArr->name;
            $userRole->status = $dataArr->status;
            $userRole->save();
        }

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('role_updated'),
        ], 200);
    }

    public function get_frontend_Permission($id = null)
    {
        $user_type = \App\Models\UserType::find($id);
        if (!$user_type) {
            return redirect()->route('admin.permission.index')->with(['fail' => adminTransLang('role_not_found')]);
        }
        $navigations = getGroupNavigations();
        $rolePermissions = getRolePermission($id);
        $UserTypePermission = UserTypePermission::where('user_type_id', '=', $id)->pluck('permission')->toArray();
        // pr($UserTypePermission,1);
        return view('admin.user_type.permission', ['navigations' => $navigations, 'rolePermissions' => $rolePermissions,'user_type' => $user_type, 'UserTypePermission' => $UserTypePermission]);
    }

    public function save_frontend_Permission(Request $request, $id)
    {
        // pr($request->all(),1);
        $this->validate($request, [
            'navigation_id' => 'nullable|array',
        ]);

        $fieldArr = ['navigation_id'];
        $dataArr = arrayFromPost($request, $fieldArr);
        try {
            // Start Transaction
            \DB::beginTransaction();

            $result = UserTypePermission::where('user_type_id', '=', $request->id)->get();
            if ($result->isNotEmpty()) {
                foreach ($result as $value) {
                    $item = \App\Models\UserTypePermission::find($value->id);
                    $item->delete();
                }
            }
            if (isset($dataArr->navigation_id) && count($dataArr->navigation_id) > 0) {
                foreach ($dataArr->navigation_id as $navigation_id) {
                    $rolesPermissions = new \App\Models\UserTypePermission();
                    $rolesPermissions->user_type_id = $request->id;
                    $rolesPermissions->permission = $navigation_id;
                    $rolesPermissions->save();
                }
            }
            
            // Commit Transaction
            \DB::commit();
            
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('permission_updated'),
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            $message = ['msg' => errorMessage($e->errorInfo[2], true)];
            return response()->json($message, 422);
        }
    }
}
