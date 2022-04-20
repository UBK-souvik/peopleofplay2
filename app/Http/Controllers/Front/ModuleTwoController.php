<?php

namespace App\Http\Controllers\Front;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesFour;
use App\Models\User;
use App\Models\News;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\BlogPedia;
use App\Models\NewsCategoryPivot;

use Illuminate\Support\Facades\View;

class ModuleTwoController extends Controller
{
	
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	}
	
	function getBlogTags($request)
	{
		$str_tags_data = '';
		$arr_tags = array();				
		$arr_tags = UtilitiesFour::get_skills_array(@$request->tags);

		Tag::save_tag_data($arr_tags);
		
		$str_tags_data = UtilitiesFour::get_skills_list($arr_tags);
		
		return $str_tags_data;
     }		
	
	
	function getArticleBlogContent($type_post, $slug)
	{

		$blog_category_name = '';
		
		$blog_category_id = '';
		if($type_post == "news")
		{
			$query = News::select('news.*')->with(['categories' => function($categories) {

			$categories->with('category');
	          }]);
		 
		   if(!empty($slug))
		   {
			  $query->where('slug', $slug);   
		   }
		   
		   $blog =   $query->firstOrFail();
		   
		    if(is_object($blog->categories))
		    {
			   
			   foreach($blog->categories as $blog_cat_row)
			   {						   
				 if(!empty($blog_cat_row->category->name))
				 {
				    $blog_category_name = $blog_cat_row->category->name;
					$blog_category_id  = $blog_cat_row->category->id;
				 }
			   }
		    }
			$query = News::where('news.status', 1);
			$query->leftJoin('news_category_pivots', 'news_category_pivots.news_id', '=', 'news.id');
			$query->where('news_category_pivots.news_category_id', $blog_category_id);
			$query->where('news.added_by', 2);
            $query->limit(5);
		    $related_blog = $query->get();
		} 

		if($type_post == "did-you-know")
		{
			$query = News::select('news.*')->with(['categories' => function($categories) {

			$categories->with('category');
	          }]);
		 
		   if(!empty($slug))
		   {
			  $query->where('slug', $slug);   
		   }
		   
		   $blog =   $query->firstOrFail();
		   
		    if(is_object($blog->categories))
		    {
			   
			   foreach($blog->categories as $blog_cat_row)
			   {						   
				 if(!empty($blog_cat_row->category->name))
				 {
				    $blog_category_name = $blog_cat_row->category->name;
					$blog_category_id  = $blog_cat_row->category->id;
				 }
			   }
		    }
			$query = News::where('news.status', 1);
			$query->leftJoin('news_category_pivots', 'news_category_pivots.news_id', '=', 'news.id');
			$query->where('news_category_pivots.news_category_id', $blog_category_id);
            $query->limit(5);
		    $related_blog = $query->get();
		}
		
		if($type_post == "blog")
		{
		    $query = Blog::where('status', 1);
            
			if(!empty($slug))
			{
			  $query->where('slug', $slug);	
			}
			
			$query->orderBy('created_at', 'desc');
            $blog = $query->firstOrFail();
            // pr($blog,1); 
			
			$blog_category_name = @$blog->category->name;
			
			$blog_category_id = @$blog->category->id;
			
			//$related_blog = Blog::where('status', 1)
            //->where('category_id', $blog_category_id);			
			$random_blogs = DB::table('blogs')
			->select('blogs.id', 'blogs.featured_image', 'blogs.title', 'blogs.slug')  
			->inRandomOrder();
			
			$category_blogs = DB::table('blogs')
			->where('blogs.status',1)
			->select('blogs.id', 'blogs.featured_image', 'blogs.title', 'blogs.slug'); 
			 // ->where('category_id', $blog_category_id);
			 
			 // if(!empty($blog->user_id))
			 // {
				// $category_blogs->where('user_id', $blog->user_id); 
			 // }	 
			 
			 //if(empty($blog->user_id) && $blog->added_by == 2){
            	//$category_blogs = $category_blogs->where('added_by', 2);
            	//$category_blogs = $category_blogs->orderBy('id', 'desc');
			//}
			$category_blogs = $category_blogs->orderBy('id', 'desc');
			// $category_blogs->union($random_blogs);

			$related_blog = $category_blogs->limit(5)->get();
				//pr($related_blog); die;		
            //$related_blog = $related_blog->limit(5)->get();
		}

		if($type_post == "AdminBlog")
		{
		  //  echo $type_post; die;
		    $query = Blog::where('status', 1);
            
			if(!empty($slug))
			{
			  $query->where('slug', $slug);	
			}
			
			$query->orderBy('created_at', 'desc');
            $blog = $query->firstOrFail();
            // pr($blog,1);  die;
			
			$blog_category_name = @$blog->category->name;
			
			$blog_category_id = @$blog->category->id;
			
			$related_blog = Blog::where('status', 1);
            // ->where('category_id', $blog_category_id);

        	//$related_blog = $related_blog->where('added_by', 2);
        	$related_blog = $related_blog->orderBy('id', 'desc');
            $related_blog = $related_blog->limit(5)->get();

          // pr($related_blog); die;
		}
		$view_content = (string)View::make('front.pages.blog.detail', compact('blog' ,'type_post', 'blog_category_name', 'related_blog'))->render();
		   /*  */
	    return $view_content;
		
	}
	
	
	function getArticleBloglist($type_post, $slug,$category_id ='')
	{
		$user_id = 0;
		$str_user_name = '';
		$blog_categories =  BlogCategory::where('status',1)->get();
		
		if(!empty($slug))
		{
		   $query = User::where('users.slug', $slug);            
		   $user = $query->firstOrFail();
		   $str_user_name = Utilities::getUserName($user);
		   $user_id = $user->id;	
		}
		
		// pr($type_post,1);

			// echo $type_post; die;
			//echo "<pre>"; print_r($blog_categories); die;
		
		if($type_post == 'blog_pedia')
		{
		   // $blogs = BlogPedia::select('blog_pedias.blog_id','blogs.*')
		   //          ->where('blog_pedias.status', 1)
		   //          ->with(['blog_data'])
		   //          ->leftjoin('blogs','blogs.id', '=', 'blog_pedias.blog_id')
					// ->orderBy('blog_pedias.id', 'desc')
					// ->paginate(10);

			 $blog5 = DB::table('blogs'); 
			  $blog5->where('status', 1);
			 if($category_id !='') {
			 	
			 	$blog5->where('category_id',$category_id);
			 }
		
			 $blog5->orderBy('id','desc');
			 $blogs = $blog5->paginate(10);
			 foreach ($blogs as $ukey => $bloguser) {
			 $blogs[$ukey]->user = User::where('id',$bloguser->user_id)->first();
			 }
		}

        if($type_post == 'blog')
		{
		   if (!empty($user_id)) {
            $blogs = Blog::where('status', 1)
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(30);
			} else {
				$blogs = Blog::where('status', 1)
					->orderBy('created_at', 'desc')
					->paginate(30);
			}	
		}
		
		if($type_post == 'AdminBlog')
		{


			$blog5 = DB::table('blogs'); 
			  $blog5->where(['status'=> 1,'user_id'=> 0,'added_by'=> 2]);
			 if($category_id !='') {
			 	
			 	$blog5->where('category_id',$category_id);
			 }
		
			 $blog5->orderBy('id','desc');
			 $blogs = $blog5->paginate(10);


		   // $blogs = Blog::where('status', 1)
	    //         	->where('user_id', 0)
	    //         	->where('added_by', 2)
					// ->orderBy('created_at', 'desc')
					// ->paginate(30);
		}
        
		if($type_post == 'news')
		{
		   if (!empty($user_id)) {
            $blogs = News::where('status', 1)
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(30);
			} else {
				$blogs = News::where('status', 1)
					->where('user_id', 0)
	            	->where('added_by', 2)
					->orderBy('created_at', 'desc')
					->paginate(30);
			}	
		}

		if($type_post == 'did-you-know')
		{
			$blogs = News::where('status', 1)
				->where('user_id', $user_id)
				->orderBy('created_at', 'desc')
				->paginate(30);
		}
		
        $view_content = (string)View::make('front.pages.blog.index', compact('type_post', 'blogs', 'str_user_name','blog_categories','category_id'))->render();
		
		return $view_content;
		
	}
	
	public function get_blog_tags_dropdown(Request $request)
    {
        $data_array = array();
		$postData = $request->all();
        //$keyword = $postData['query']['term'];
		$keyword = $postData['query'];
        $data = Tag::where('tag', 'like', '%' . $keyword . '%')->select('tag')->groupBy('tag')->get();
		
		if(!empty($data) && count($data)>0)
		{
			foreach($data as $data_row)
			{
				$data_array[] = $data_row->tag;
			}
		}
		
		$data_array = array_values($data_array);
		
		return $data_array;
    }



	 
}
