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

class ArticleController extends Controller
{
	
	public function __construct()
    {
		
	}
	
    public function getIndex()
    {
        return view('admin.knowledge_base.articles.index');
    }
	
    public function getList()
    {
        $articles = \App\Models\Article::select(['articles.id', 'articles.title', 'ac.category as category_name', 'articles.description', 'articles.status', 'articles.created_at']);
        
		$articles->leftJoin('article_categories as ac', 'ac.id', '=', 'articles.category_id');
		
		return \DataTables::of($articles)
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
		$article = \App\Models\Article::find($id)->delete();
        $message = ['msg' => adminTransLang('success')];
        return response()->json($message, 200);
    }
	
	public function showAddArticle(Request $request)
    {
		echo $this->saveAddEditArticle($request, 0);
	}

    public function showEditArticle(Request $request, $article_id)
    {
        echo $this->saveAddEditArticle($request, $article_id);        
	}	
	
	public function saveAddEditArticle(Request $request, $article_id)
    {		
		
		$article_id_edit_mode = $article_id;
		$error_msg = '';
		
		if ($request->isMethod('post')) 
        {
          // pre($request->all('add_edit_profile_role'),1);
			$rules = [
				'title' => 'required',
				'description' => 'required',
                'category_id' => 'required',  				
            ];
			
    	    $niceNames = array();     
            $this->validate($request, $rules, [], $niceNames);
    			 
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
				
				$str_ckeditor_description_new = $request->description;

				if(!empty($article_id))
				{
				   $obj_article = \App\Models\Article::find($article_id);
				   $obj_article->updated_at = new \DateTime();
				}
				else
				{
				   $obj_article = new \App\Models\Article();
                   $obj_article->status = 1; 
                }				
				
				$obj_article->title =  $request->title;
				//$obj_article->description =  $request->description;
				$obj_article->description =  $str_ckeditor_description_new;
				$obj_article->category_id =  $request->category_id;
				
				$arr_tag = $request->tag;
			
				if(!empty($arr_tag) && count($arr_tag)>0)
				{
				   $str_tag = implode(',', $arr_tag);
				}
				
				$obj_article->tag = $str_tag;
				
				$obj_article->created_at = new \DateTime();			    
				
				$obj_article->save();
				$obj_article_id = $obj_article->id;					
				
				// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('article_data_saved_flag', 1);
				return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				errorMessage($e->errorInfo[2], true);
			}
    	}
    		
		$article_data = \App\Models\Article::find($article_id);		
		$article_categories = ArticleCategory::pluck('category', 'id');
		
	    return view('admin.knowledge_base.articles.add_update_article', ['article_categories' => $article_categories, 'article_data' => $article_data, 'article_id' => $article_id]);	
    }

}
