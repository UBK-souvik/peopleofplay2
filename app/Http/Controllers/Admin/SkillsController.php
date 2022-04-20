<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class SkillsController extends Controller
{
    public function getIndex()
    {
        return view('admin.skills.index');
    }

    public function getList()
    {
        $skill = \App\Models\Skill::select('*');
        return \DataTables::of($skill)
            //->editColumn('status', function ($query) {
              //  return config('cms.blog_status')[$query->status];
            //})
            ->make();
    }


    public function getDelete($id)
    {
        $skill  = Skill::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
