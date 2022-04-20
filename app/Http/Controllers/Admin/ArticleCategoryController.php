<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\ArticleCategory;
use App\Models\Article;
use Carbon\Carbon;
use DB;
use Session;

class ArticleCategoryController extends Controller
{
	
	public function __construct()
    {
		
	}
	
    public function getIndex()
    {
        return view('admin.knowledge_base.article_categories.index');
    }
	
    public function getList()
    {
        $article_categories = \App\Models\ArticleCategory::select(['article_categories.id', 'article_categories.category', 'article_categories.status', 'article_categories.created_at']);
    	
		return \DataTables::of($article_categories)
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
		$category = \App\Models\ArticleCategory::find($id)->delete();
		$article = Article::where('category_id', $id)->delete();
		
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddArticleCategory(Request $request)
    {
		echo $this->saveAddEditArticleCategory($request, 0);
	}

    public function showEditArticleCategory(Request $request, $article_category_id)
    {
        echo $this->saveAddEditArticleCategory($request, $article_category_id);
        
	}	
	
	public function saveAddEditArticleCategory(Request $request, $article_category_id)
    {
		
		$article_category_id_edit_mode = $article_category_id;
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

				if(!empty($article_category_id))
				{
				   $obj_article_category = \App\Models\ArticleCategory::find($article_category_id);
				   $obj_article_category->updated_at = new \DateTime();
				}
				else
				{
				   $obj_article_category = new \App\Models\ArticleCategory();
                   $obj_article_category->status = 1; 
                }				
				
				$obj_article_category->category =  $request->category;
				$obj_article_category->created_at = new \DateTime();			    
				
				$obj_article_category->save();
				$obj_article_category_id = $obj_article_category->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('article_category_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$article_category_data = \App\Models\ArticleCategory::find($article_category_id);		
		
	    return view('admin.knowledge_base.article_categories.add_update_article_category', ['article_category_data' => $article_category_data, 'article_category_id' => $article_category_id]);	
    }

}
