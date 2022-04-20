<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function getIndex()
    {
        return view('admin.settings.index');
    }

    public function getList()
    {
        $settings = \App\Models\Setting::select(['*']);
        return \DataTables::of($settings)->make();
    }

    public function getUpdate(Request $request)
    {
        $setting = \App\Models\Setting::find($request->id);
        if (!$setting) {
            return redirect()->route('admin.settings.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }
        return view('admin.settings.update', ['setting' => $setting]);
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'value' => 'required',
        ]);

        $settings = \App\Models\Setting::find($request->id);
        $settings->label = $request->label;
        $settings->value = $request->value;
        $settings->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
