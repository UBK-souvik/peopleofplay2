<?php

namespace App\Http\Controllers\Front;

use App\Models\News;
use App\Models\User;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\NewsCategoryPivot;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class NewsController extends ModuleTwoController
{
	public function getAllNews()
    {
        echo  $this->getArticleBloglist('news', '');
        /*$current_user = get_current_user_info();

        if (!empty($current_user->id)) {
            $user_id = $current_user->id;
        }

        $news = News::where('status', 1);

        if (!empty($user_id)) {
            $news = $news->where('user_id', $user_id);
        } else {
            //$news = $news->where('added_by', 2);
        }

        if (request()->filled('user_id')) {
            $news = $news->where('user_id', request()->user_id);
        } else {
            $news = $news->where('added_by', 2);
        }

        $recent_news = clone $news;
        $news = $news->orderBy('created_at', 'desc')
            ->paginate(30);

        $news_category = News::join('news_category_pivots', 'news_category_pivots.news_id', '=', 'news.id')
            ->join('news_categories', 'news_categories.id', '=', 'news_category_pivots.news_category_id')
            ->pluck('news_categories.name', 'news_categories.id');

        $authors = News::join('users', 'users.id', '=', 'news.user_id')
            ->select(DB::raw('CONCAT(users.first_name," ",users.last_name) as author_name'), 'users.username')
            ->get();

        $recent_news = $recent_news->limit(5)->get();

        return view('front.pages.news.index', compact('news', 'recent_news', 'news_category', 'authors')); */
		
    }

    public function getNewsDetail($slug)
    {
		echo $this->getArticleBlogContent('news', $slug);	
    }
    public function getDidYouKnowDetail($slug)
    {
        echo $this->getArticleBlogContent('did-you-know', $slug);   
    }
	
	public function getUserNewsList($slug)
    {
		echo  $this->getArticleBloglist('did-you-know', $slug);
    }
	
    public function getNewsData()
    {
        $current_user = get_current_user_info();
        $news = News::where('user_id', $current_user->id)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('front.user.news.index', compact('news'));
    }

    public function getCreateBlog(Request $request)
    {
        $news_categories = NewsCategory::pluck('name', 'id');
        return view('front.user.news.create', compact('news_categories'));
    }

    public function postCreateBlog(Request $request)
    {
		$str_tag = '';
		
        /*$request->validate([
            'blog_id' => 'nullable|exists:news,id',
            'title' => 'required',
            'featured_image' => 'required_without:blog_id|file',
            'description' => 'required',
            'tag' => 'required',
            'category_id.*' => 'required|array',
            'category_id.*' => 'required|exists:news_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            //'status' => 'required|in:0,1'
        ]); */
		
		$rules = [
            'blog_id' => 'nullable|exists:news,id',
            'title' => 'required',
            //'featured_image' => 'required_without:blog_id|file',
            'ckeditor_description_new' => 'required',
            'tag' => 'required',
            'category_id.*' => 'required|array',
            'category_id.*' => 'required|exists:news_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            //'status' => 'required|in:0,1'
        ];
	
	    $niceNames = [
            'title' => 'Title',
            'featured_image' => 'Featured Image',
            'ckeditor_description_new' => 'Description',
            'tag' => 'Tag',
            'category_id.*' => 'Category',
            'category_id.*' => 'Category',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
	
    	if(empty($request->blog_id))
    	{
    	   $rules['featured_image'] = 'required|file';	
    	}

       $this->validate($request, $rules, [], $niceNames);

        try {

            DB::beginTransaction();

            $current_user = get_current_user_info();
            $data = $request->only(News::$fillable_shadow);
            $data['user_id'] = $current_user->id;
			
			$is_featured_news = $request->is_featured_news;
			
			$arr_tag = $request->tag;
			
			if(!empty($arr_tag) && count($arr_tag)>0)
			{
			   $str_tag = implode(',', $arr_tag);
			}
			
			$str_ckeditor_description_new = $request->ckeditor_description_new;
			
			$data['tag'] = $str_tag;
			$data['status'] = 1;
			$data['description'] = $str_ckeditor_description_new;
				
			if(!empty($is_featured_news) && $is_featured_news>0)
			{
				News::where('user_id', $current_user->id)
				 ->update(['is_featured' => 0]);
				 
				$data['is_featured'] = $is_featured_news;
			}
			
            if ($request->hasFile('featured_image')) {
                $file = $request->featured_image;
								
                $extension = $file->getClientOriginalExtension();
				//$extension = UtilitiesTwo::get_image_ext_name();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
				//$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
                if ($upload_status) {
                    $data['featured_image'] = $filename;
                } else {
                    // Rollback Transaction
                    DB::rollBack();

                    $message = ['msg' => errorMessage('file_uploading_failed')];
                    return response()->json($message, 422);
                }
            }
			
            $news = News::updateOrCreate(['id' => $request->blog_id], $data);

            /*foreach ($request->category_id as $category) {
                NewsCategoryPivot::updateOrCreate([
                    'news_id' => $news->id,
                    'news_category_id' => $category
                ], [
                    'news_id' => $news->id,
                    'news_category_id' => $category
                ]);
            }*/
			if(!empty($request->category_id))
			{
			
			    if(!empty($news->id))
				{
				   NewsCategoryPivot::where('news_id', $news->id)
				    ->update(['status' => 0]);	
				}
			
			   foreach ($request->category_id as $category) {
                
				$data_caegory_pivot = array();				
				$chk_news_categories_pivot = NewsCategoryPivot::select('id')->where('news_id', $news->id)->where('news_category_id', $category)->first();
				
				$data_caegory_pivot['news_id'] = $news->id;
				$data_caegory_pivot['news_category_id'] = $category;
				$data_caegory_pivot['status'] = 1;	
				
				if(!empty($chk_news_categories_pivot->id))
				{
				    $news_categories_pivot_id = $chk_news_categories_pivot->id;
					$update = NewsCategoryPivot::where('id', $news_categories_pivot_id)
				    ->update(['status' => 1]);
				}
				else
				{
					$news_categories_pivot_id = 0;
					NewsCategoryPivot::updateOrCreate(['id' => $news_categories_pivot_id], $data_caegory_pivot);
				}				
				
               }
			}   


            DB::commit();
			Session::flash('news_data_saved_flag', 1);
            return successMessage('News saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdateBlog($slug)
    {
        $current_user = get_current_user_info();
        $news = News::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail();
        $news_categories = NewsCategory::pluck('name', 'id');
		$news_categories_pivot = NewsCategoryPivot::where('news_id', $news->id)->where('status', 1)->get();

        return view('front.user.news.create', compact('news_categories', 'news', 'news_categories_pivot'));
    }

    public function getDeleteBlog($slug)
    {
        $current_user = get_current_user_info();
        News::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail()
            ->delete();
			
		Session::flash('news_data_deleted_flag', 1);	

        return redirect()->route('front.user.news.index');
    }

    public function manage_subscription()
    {
        $current_user = get_current_user_info();


        $news = News::orderBy('created_at', 'desc')
            ->paginate(30);

        return view('front.user.subscription', compact('news')); 
        
    }
    public function manage_account_subscription()
    {
        $user = get_current_user_info();
        $news = News::orderBy('created_at', 'desc')
            ->paginate(30);

        return view('front.user.account_subscription', compact('news', 'user')); 
    }

    public function newsletter_subscribe(Request $request, $ids)
    {
        $current_user = get_current_user_info();
        $users = User::where('id', $current_user->id)->update(array('newsletter' => $ids));
        Session::flash('newsletter_flag', 1);
        return redirect()->back();
        
    }
}
