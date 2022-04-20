<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;

class RoleController extends Controller
{
    public function getIndex()
    {
        return view('admin.role.index');
    } 

    public function getList()
    {
        $role = \App\Models\UserRole::select('*');
        return \DataTables::of($role)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.role.create');
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users_roles',
            'status' => 'required',
        ]);

        $fieldArr = ['name', 'en_name', 'status'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $userRole = new \App\Models\UserRole();
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
        $userRole = \App\Models\UserRole::find($id);
        if (!$userRole) {
            return redirect()->route('admin.role.index')->with(['fail' => adminTransLang('role_not_found')]);
        }
        return view('admin.role.update', ['role' => $userRole]);
    }

    public function postUpdate($id = false, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users_roles,name,' . $id,
            'status' => 'required',
        ]);

        $fieldArr = ['name', 'en_name', 'status'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $userRole = \App\Models\UserRole::find($id);
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

    public function getPermission($id = null)
    {
        $navigations = getGroupNavigations();
        $rolePermissions = getRolePermission($id);
        return view('admin.role.permission', ['navigations' => $navigations, 'rolePermissions' => $rolePermissions]);
    }

    public function savePermission(Request $request)
    {
        $this->validate($request, [
            'navigation_id' => 'required|array',
        ]);

        $fieldArr = ['navigation_id'];
        $dataArr = arrayFromPost($request, $fieldArr);
        try {
            // Start Transaction
            \DB::beginTransaction();

            $result = \App\Models\RolePermission::where('role_id', '=', $request->id)->get();
            if ($result->isNotEmpty()) {
                foreach ($result as $value) {
                    $item = \App\Models\RolePermission::find($value->id);
                    $item->delete();
                }
            }
            if (count($dataArr->navigation_id)) {
                foreach ($dataArr->navigation_id as $navigation_id) {
                    $rolesPermissions = new \App\Models\RolePermission();
                    $rolesPermissions->role_id = $request->id;
                    $rolesPermissions->navigation_id = $navigation_id;
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

    public function get_frontend_Permission($id = null)
    {
        $navigations = getGroupNavigations();
        $rolePermissions = getRolePermission($id);
        return view('admin.role.permission', ['navigations' => $navigations, 'rolePermissions' => $rolePermissions]);
    }

    public function save_frontend_Permission(Request $request)
    {
        $this->validate($request, [
            'navigation_id' => 'required|array',
        ]);

        $fieldArr = ['navigation_id'];
        $dataArr = arrayFromPost($request, $fieldArr);
        try {
            // Start Transaction
            \DB::beginTransaction();

            $result = \App\Models\RolePermission::where('role_id', '=', $request->id)->get();
            if ($result->isNotEmpty()) {
                foreach ($result as $value) {
                    $item = \App\Models\RolePermission::find($value->id);
                    $item->delete();
                }
            }
            if (count($dataArr->navigation_id)) {
                foreach ($dataArr->navigation_id as $navigation_id) {
                    $rolesPermissions = new \App\Models\RolePermission();
                    $rolesPermissions->role_id = $request->id;
                    $rolesPermissions->navigation_id = $navigation_id;
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
