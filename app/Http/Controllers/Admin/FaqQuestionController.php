<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Carbon\Carbon;
use DB;
use Session;

class FaqQuestionController extends Controller
{
	
	public function __construct()
    {
		
	}
	
    public function getIndex()
    {
        return view('admin.knowledge_base.faq_questions.index');
    }
	
    public function getList()
    {
        $faq_questions = \App\Models\FaqQuestion::select(['faq_questions.id', 'faq_questions.question', 'fc.category as category_name', 'faq_questions.answer', 'faq_questions.status', 'faq_questions.created_at']);
        
		$faq_questions->leftJoin('faq_categories as fc', 'fc.id', '=', 'faq_questions.category_id');
		
		return \DataTables::of($faq_questions)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("created_at like ?", ["%$keyword%"]);
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

    public function getDelete($id)
    {
		$faq_question = \App\Models\FaqQuestion::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddFaqQuestion(Request $request)
    {
		echo $this->saveAddEditFaqQuestion($request, 0);
	}

    public function showEditFaqQuestion(Request $request, $faq_question_id)
    {
        echo $this->saveAddEditFaqQuestion($request, $faq_question_id);
        
	}	
	
	public function saveAddEditFaqQuestion(Request $request, $faq_question_id)
    {
		
		$faq_question_id_edit_mode = $faq_question_id;
		$error_msg = '';
		
		if ($request->isMethod('post')) 
        {
          // pre($request->all('add_edit_profile_role'),1);
			$rules = [
				'question' => 'required',
				'answer' => 'required',
                'category_id' => 'required',  				
            ];
			
    	    $niceNames = array();     
            $this->validate($request, $rules, [], $niceNames);
    			 
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
				
				$str_ckeditor_description_new = $request->answer;

				if(!empty($faq_question_id))
				{
				   $obj_faq_question = \App\Models\FaqQuestion::find($faq_question_id);
				   $obj_faq_question->updated_at = new \DateTime();
				}
				else
				{
				   $obj_faq_question = new \App\Models\FaqQuestion();
                   $obj_faq_question->status = 1; 
                }				
				
				$obj_faq_question->question =  $request->question;
				//$obj_faq_question->answer =  $request->answer;
				$obj_faq_question->answer =  $str_ckeditor_description_new;
				$obj_faq_question->category_id =  $request->category_id;
				
				
				$obj_faq_question->created_at = new \DateTime();			    
				
				$obj_faq_question->save();
				$obj_faq_question_id = $obj_faq_question->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('faq_question_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$faq_question_data = \App\Models\FaqQuestion::find($faq_question_id);		
		$faq_question_categories = FaqCategory::pluck('category', 'id');
		
	    return view('admin.knowledge_base.faq_questions.add_update_faq_question', ['faq_question_categories' => $faq_question_categories, 'faq_question_data' => $faq_question_data, 'faq_question_id' => $faq_question_id]);	
    }

}
