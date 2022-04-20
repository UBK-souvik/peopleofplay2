<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;

class QuizController extends AdminModuleController
{
    public function getIndex()
    {
        return view('admin.quiz.index');
    }
    
      public function getList()
    {       
        $quiz =DB::table('quizzes')->select('quizzes.*')->orderBy('id','desc');
        
        return \DataTables::of($quiz)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
       
        return view('admin.quiz.create');
    }

    public function postCreate(Request $request)
    {
        // pr($request->all()); die;
        $str_tag = '';

        $request->validate([
            'user_id' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:0,1',
            //'image' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $data = $request->only(Quiz::$fillable_shadow);
                 if ($request->hasFile('file')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $file;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '_quiz_'.'.' . $extension;
                        $file_path = '/uploads/images/quiz';
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $data['image'] = $filename;
                        } else {
                            throw new \Exception(errorMessage('file_uploading_failed'));
                        }
                    // Shubham Code For Image Compression End //
                }
            Quiz::updateOrCreate(['id' => $request->question_id], $data);
            DB::commit();
            Session::flash('question_data_saved_flag', 1);
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
        $question  = Quiz::findOrFail($id);
        
        $users = User::get_all_user_list_by_email_name();
        return view('admin.quiz.create', compact('question'));
    }

    public function getDelete($id)
    {
        $question  = Quiz::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    public function postUpload(Request $request)
    {
        $image = $request->image;
        list($type, $image) = explode(';',$image);
        list(, $image) = explode(',',$image);
        $image = base64_decode($image);
        $timestamp = generateFilename();
        $image_name = $timestamp. '_quiz_' .'.'.'png';
        file_put_contents('uploads/images/quiz/'.$image_name, $image);
     //  UtilitiesFour::createThumb(public_path('uploads/images/'), $image_name, 'png', 100);
        echo json_encode(['success'=>1,'crop_img'=>$image_name]);
    }

}