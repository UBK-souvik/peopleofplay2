<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuizQuestion;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;

class QuizQuestionController extends AdminModuleController
{
    public function getIndex()
    {
        return view('admin.quiz_question.index');
    }
	
      public function getList()
    {		
		$question =DB::table('quiz_questions')
                ->leftJoin('users','users.id', '=', 'quiz_questions.user_id')
                ->join('quizzes','quizzes.id', '=', 'quiz_questions.quiz_id')
                ->select('quiz_questions.*','users.email','quizzes.title')
                ->orderBy('id','desc');
		
        return \DataTables::of($question)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
			->editColumn('lie_val', function ($query) {                
				$which_is_lie = @$query->which_is_lie;
                $ques_which_is_lie = 'ques_'.$which_is_lie.'_val';				
				return @$query->$ques_which_is_lie;
            })
            ->make();
    }

    public function getCreate()
    {
        $users = User::get_all_user_list_by_email_name();
        $quizzes = Quiz::where('status',1)->get();
		return view('admin.quiz_question.create', compact('users','quizzes'));
    }

    public function postCreate(Request $request)
    {
        //pr($request->all()); die;
		$str_tag = '';

        $request->validate([
            'user_id' => 'nullable',
            'quiz_id' => 'required',
            'ques_1_val' => 'required',
			'ques_2_val' => 'required',
			'ques_3_val' => 'required',
			'ques_4_val' => 'required',
            'status' => 'required|in:0,1',
          //  'file' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if(!empty($request->user_id) ) {
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        }
        
        try {
            DB::beginTransaction();
			
			$int_truth_questions_count_flag =0;
			
			$arr_questions_ids = UtilitiesTwo::get_questions_list_new();
             $data = $request->only(QuizQuestion::$fillable_shadow);
           if ($request->hasFile('file')) {
           
            $imageName = time().'.'.request()->file->getClientOriginalExtension();
              request()->file->move(public_path('uploads/images/question_quiz'), $imageName);
              $data['image'] = $imageName;
			}
             //echo "yes"; die;
			foreach($arr_questions_ids as $arr_questions_id_row)
			{
				 $int_question_id = $arr_questions_id_row;
			     $str_truth_drop_down_name ='ques_'.$int_question_id.'_truth_val';
				 if(!empty($request->$str_truth_drop_down_name) && $request->$str_truth_drop_down_name == 1)
				 {
				    $int_truth_questions_count_flag = $int_truth_questions_count_flag+1;	 
				 }
				 
			}
			
			/*if(empty($int_truth_questions_count_flag))
			{
					$error_msg = 'Please Select atleast one truth value in the drop down.';
					$message_new = ['msg' => errorMessage($error_msg)];
					return response()->json($message_new, 422);
			}
			
			if(!empty($int_truth_questions_count_flag) && $int_truth_questions_count_flag>1)
			{
					$error_msg = 'Please Select atleast only one truth value in the drop down.';
					$message_new = ['msg' => errorMessage($error_msg)];
					return response()->json($message_new, 422);
			}*/


            

           
            
			
            QuizQuestion::updateOrCreate(['id' => $request->question_id], $data);

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
        $question  = QuizQuestion::findOrFail($id);
		$quizzes = Quiz::where('status',1)->get();
		$users = User::get_all_user_list_by_email_name();
        return view('admin.quiz_question.create', compact('question', 'users','quizzes'));
    }

    public function getDelete($id)
    {
        $question  = QuizQuestion::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

}