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

class FaqCategoryController extends Controller
{
	
	public function __construct()
    {
		
	}
	
    public function getIndex()
    {
        return view('admin.knowledge_base.faq_categories.index');
    }
	
    public function getList()
    {
        $faq_categories = \App\Models\FaqCategory::select(['faq_categories.id', 'faq_categories.category', 'faq_categories.status', 'faq_categories.created_at']);
    	
		return \DataTables::of($faq_categories)
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
		$faq_category = \App\Models\FaqCategory::find($id)->delete();
		$faq_question = FaqQuestion::where('category_id', $id)->delete();
		
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddFaqCategory(Request $request)
    {
		echo $this->saveAddEditFaqCategory($request, 0);
	}

    public function showEditFaqCategory(Request $request, $faq_category_id)
    {
        echo $this->saveAddEditFaqCategory($request, $faq_category_id);
        
	}	
	
	public function saveAddEditFaqCategory(Request $request, $faq_category_id)
    {
		
		$faq_category_id_edit_mode = $faq_category_id;
		$error_msg = '';
		
		if ($request->isMethod('post')) 
        {
          // pre($request->all('add_edit_profile_role'),1);
			$rules = [
				'category' => 'required',  				
            ];
			
    	    $niceNames = array();     
            $this->validate($request, $rules, [], $niceNames);
    			 
			try 
            {
				// Start Transaction
				\DB::beginTransaction();

				if(!empty($faq_category_id))
				{
				   $obj_faq_category = \App\Models\FaqCategory::find($faq_category_id);
				   $obj_faq_category->updated_at = new \DateTime();
				}
				else
				{
				   $obj_faq_category = new \App\Models\FaqCategory();
                   $obj_faq_category->status = 1; 
                }				
				
				$obj_faq_category->category =  $request->category;
				$obj_faq_category->created_at = new \DateTime();			    
				
				$obj_faq_category->save();
				$obj_faq_category_id = $obj_faq_category->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('faq_category_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$faq_category_data = \App\Models\FaqCategory::find($faq_category_id);		
		
	    return view('admin.knowledge_base.faq_categories.add_update_faq_category', ['faq_category_data' => $faq_category_data, 'faq_category_id' => $faq_category_id]);	
    }

}
