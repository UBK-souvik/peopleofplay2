<?php

namespace App\Http\Controllers\Admin;

use App\Models\YoutubePremiere;
use App\Helpers\UtilitiesTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class YoutubePremieresController extends Controller
{
    public function getIndex()
    {
        return view('admin.youtube_premieres.index');
    }

    public function getList()
    {
        $data = YoutubePremiere::all();
        return \DataTables::of($data)
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.youtube_premieres.create');
    }

    public function postCreate(Request $request)
    {
        
       $rules['url'] =  ['required', 
            function($attribute, $value, $fail) {            

                $chk_url_validation_check = UtilitiesTwo::get_url_validation_check($value);

                $chk_valid_youtube_url = UtilitiesTwo::chk_valid_youtube_url($value);

                if ($chk_url_validation_check == false || $chk_valid_youtube_url == false) {
                    return $fail('Please Enter a Valid Youtube Url.');
                }
            }];
  
      $this->validate($request, $rules, []);

        try {

            DB::beginTransaction();
            $data = $request->only(YoutubePremiere::$fillable_shadow);
            YoutubePremiere::updateOrCreate(['id' => $request->id], $data);
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
        $data  = YoutubePremiere::findOrFail($id);
        return view('admin.youtube_premieres.create', compact('data'));
    }

    public function getDelete($id)
    {
        $news_category  = YoutubePremiere::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

        public function getView($id)
    {
        $data  = YoutubePremiere::findOrFail($id);
        return view('admin.youtube_premieres.view', compact('data'));
    }
}
