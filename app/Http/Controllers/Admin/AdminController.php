<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex()
    {
        return view('admin.admins.index');
    }

    public function getList()
    {
        $admins = \App\Models\Admin::select(['id', 'name', 'email', 'mobile', 'status', 'created_at'])->where('id', '!=', 1);
        return \DataTables::of($admins)
            ->editColumn('created_at', function ($query) {
                return $query->created_at ? with(new \Carbon\Carbon($query->created_at))->format('Y/m/d h:i:s A') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->editColumn('status', function ($query) {
                return config('cms.user_status')[$query->status];
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword) == "active" ? 1 : 0;
                $query->where("status", $keyword);
            })
            ->make();
    }

    public function getCreate()
    {
        $roles = \App\Models\UserRole::where('status', '=', 1)->get();
        return view('admin.admins.create', ['roles' => $roles]);
    }

    public function postCreate(Request $request)
    {
        $fieldArr  = array('name', 'email', 'role_id', 'mobile', 'locale', 'password', 'status');
        $dataArr   = arrayFromPost($request, $fieldArr);
        $locale = \Auth::guard('admin')->user()->locale;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'role_id' => 'required',
            'mobile' => 'nullable|numeric|min:9',
            'locale' => 'required',
            'password' => 'required|min:6',
            'profile_image' => config('cms.allowed_image_mimes'),
        ]);

        try {
            // Start Transaction
            \DB::beginTransaction();

            $admin = new \App\Models\Admin();
            $admin->name = $dataArr->name;
            $admin->role_id = $dataArr->role_id;
            $admin->email = $dataArr->email;
            $admin->password = bcrypt($dataArr->password);
            $admin->mobile = $dataArr->mobile;
            $admin->status = $dataArr->status;
            $admin->locale = $locale;

            if (\Input::hasFile('profile_image')) {
                $image = \Input::file('profile_image');
                $extension = $image->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $image->move($file_path, $filename);
                if ($upload_status) {
                    $admin->profile_image = $filename;

                } else {
                    // Rollback Transaction
                    \DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            }
            $admin->save();

            // Commit Transaction
            \DB::commit();
            return response()->json([
                'msg' => adminTransLang('request_processed_successfully')
            ], 201);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            $message = ['msg' => errorMessage($e->errorInfo[2], true)];
            return response()->json($message, 422);
        }
    }

    public function getUpdate($id = null)
    {
        $admin = \App\Models\Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.admins.index')->with(['fail' =>  adminTransLang('admin_not_found')]);
        }
        $admin->profile_image = imageBasePath($admin->profile_image);
        $roles = \App\Models\UserRole::whereIn('id', [1,2])->get();
        return view('admin.admins.update', ['admin' => $admin, 'roles' => $roles]);
    }

    public function postUpdate(Request $request)
    {
        $fieldArr  = ['name', 'email', 'role_id', 'mobile', 'locale', 'status'];
        $dataArr   = arrayFromPost($request, $fieldArr);

        $locale = \Auth::guard('admin')->user()->locale;
        $id = \Auth::guard('admin')->user()->id;

        $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:admins,email,{$request->id}",
            'role_id' => ($id != $request->id ? 'required' : 'nullable'),
            'mobile' => 'nullable|numeric|min:9',
            'locale' => 'required',
            'profile_image' => config('cms.allowed_image_mimes'),
        ]);

        try {
            // Start Transaction
            \DB::beginTransaction();

            $admin = \App\Models\Admin::find($request->id);
            $admin->name = $dataArr->name;
            $admin->email = $dataArr->email;
            $admin->mobile = $dataArr->mobile;
            if($id != $request->id)
            {
                $admin->role_id = $dataArr->role_id;
                $admin->status = $dataArr->status;
            }
            $admin->locale = $dataArr->locale;
            if (\Input::hasFile('profile_image')) {
                $image = \Input::file('profile_image');
                $extension = $image->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $image->move($file_path, $filename);
                if ($upload_status) {
                    $admin->profile_image = $filename;
                } else {
                    // Rollback Transaction
                    \DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            }
            $admin->save();

            // Commit Transaction
            \DB::commit();
            $response = ['msg' => adminTransLang('request_processed_successfully')];
            return response()->json($response, 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback Transaction
            \DB::rollBack();

            $message = ['msg' => errorMessage($e->errorInfo[2], true)];
            return response()->json($message, 422);
        }
    }

    public function getDelete($id)
    {
        $admin = \App\Models\Admin::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }

    public function getView($id = null)
    {
        $admin = \App\Models\Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.admins.index')->with(['fail' => adminTransLang('admin_not_found')]);
        }
        $admin->profile_image = imageBasePath($admin->profile_image);
        $admin_status = config('cms.user_status');
        $admin->status = $admin_status[$admin->status];
        $admin->locale = config('cms.locale')[$admin->locale];

        return view('admin.admins.view', ['admin' => $admin]);
    }

    public function getPasswordReset($id = false)
    {
        $admin = \App\Models\Admin::find($id);
        if (!$admin) {
            return redirect()->route("admin.admins.index")->with(['fail' => adminTransLang('admin_not_found')]);
        }
        return view('admin.admins.password-reset', ['id' => $id]);
    }

    public function postPasswordReset($id = false, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = \App\Models\Admin::find($id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('password_changed_successfully'),
        ], 200);
    }

    public function getPermission($id = null)
    {
        $navigationArr = getGroupNavigations();
        $userPermissions = getUserPermission($id);
        return view('admin.admins.permission', ['navigations' => $navigationArr, 'userPermissions' => $userPermissions]);
    }

    public function savePermission($id = false, Request $request)
    {
        $this->validate($request, [
            'navigation_id' => 'required|array',
        ]);

        $fieldArr = array('navigation_id');
        $dataArr = arrayFromPost($request, $fieldArr);
        \DB::table('users_permissions')->where('user_id', '=', $id)->delete();

        if (count($dataArr->navigation_id)) {
            foreach ($dataArr->navigation_id as $navigation_id) {
                $newUserPermission = new \App\Models\UserPermission();
                $newUserPermission->user_id = $id;
                $newUserPermission->navigation_id = $navigation_id;
                $newUserPermission->save();
            }
        }

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('permission_updated'),
        ], 200);
    }

}
