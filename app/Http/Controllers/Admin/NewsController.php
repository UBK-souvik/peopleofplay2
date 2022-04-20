<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use App\Models\NewsCategory;
use App\Models\NewsCategoryPivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;

class NewsController extends Controller
{
	
    public function getIndex()
    {
        return view('admin.news.index');
    }

    public function getList()
    {
        $news = \App\Models\News::select('*')->with('user')->where(['added_by' => 2,'user_id' => 0]);
        return \DataTables::of($news)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
			->editColumn('is_home_page', function ($query) {
				if(!empty($query->is_home_page))
				{
				   return 'Yes';	
				}
                else
				{
					return 'No';
				}
            })			
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->make();
    }

    public function getCreate()
    {
        $news_categories = NewsCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
		
        return view('admin.news.create', compact('news_categories', 'users'));
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'news_id' => 'nullable|exists:news,id',
            // 'user_id' => 'nullable|exists:users,id',
            'title' => 'required',
            'featured_image' => 'required_without:news_id|file',
            'ckeditor_description_new' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required|in:0,1'
        ],[
            'ckeditor_description_new.required' => 'Description field is required',
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(News::$fillable_shadow);
			
			$arr_tag = $request->tag;
			
			if(!empty($arr_tag) && count($arr_tag)>0)
			{
			   $str_tag = implode(',', $arr_tag);
			}
			
			$str_ckeditor_description_new = $request->ckeditor_description_new;
						 
            $data['tag'] = $str_tag;
			
            $data['user_id'] = 0;
            $data['added_by'] = 2;
			$data['description'] = $str_ckeditor_description_new;
			
			if(!empty($request->is_home_page))
			{
			   News::where('status', '>=', 1)
				 ->update(['is_home_page' => 0]);
			   $data['is_home_page'] = $request->is_home_page;	
			}			
			
            if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    }else{
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                // Shubham Code For Image Compression End //
            }

            $news = News::updateOrCreate(['id' => $request->news_id], $data);
			
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
        $news  = News::findOrFail($id);
        $news_categories = NewsCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
		$news_categories_pivot = NewsCategoryPivot::where('news_id', $id)->where('status', 1)->get();
		
        return view('admin.news.create', compact('news_categories', 'news', 'users', 'news_categories_pivot'));
    }

    public function getDelete($id)
    {
        $news  = News::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }


    public function DidYouKnow_Index()
    {
        return view('admin.news.did_you_know.index');
    }

    public function DidYouKnow_List()
    {
        $news = \App\Models\News::select('*')->with('user')->where(['added_by' => 1]);
        return \DataTables::of($news)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('is_home_page', function ($query) {
                if(!empty($query->is_home_page))
                {
                   return 'Yes';    
                }
                else
                {
                    return 'No';
                }
            })          
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->make();
    }

    public function DidYouKnow_Create()
    {
        $news_categories = NewsCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
        
        return view('admin.news.did_you_know.create', compact('news_categories', 'users'));
    }

    public function DidYouKnow_postCreate(Request $request)
    {
        $str_tag = '';

        $request->validate([
            'news_id' => 'nullable|exists:news,id',
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required',
            'featured_image' => 'required_without:news_id|file',
            'ckeditor_description_new' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required|in:0,1'
        ],[
            'ckeditor_description_new.required' => 'Description field is required',
        ]);
        try {

            DB::beginTransaction();

            $data = $request->only(News::$fillable_shadow);
            
            $arr_tag = $request->tag;
            
            if(!empty($arr_tag) && count($arr_tag)>0)
            {
               $str_tag = implode(',', $arr_tag);
            }
			
			$str_ckeditor_description_new = $request->ckeditor_description_new;
                         
            $data['tag'] = $str_tag;
            
            $data['added_by'] = 1;
			$data['description'] = $str_ckeditor_description_new;
			
            if (!$request->filled('user_id')) {
                $data['user_id'] = 0;
                $data['added_by'] = 2;
            }
            
            if(!empty($request->is_home_page))
            {
               News::where('status', '>=', 1)
                 ->update(['is_home_page' => 0]);
               $data['is_home_page'] = $request->is_home_page;  
            }           
            
            if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    }else{
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                // Shubham Code For Image Compression End //
            }

            $news = News::updateOrCreate(['id' => $request->news_id], $data);
            
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
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function DidYouKnow_Update($id)
    {
        $news  = News::findOrFail($id);
        $news_categories = NewsCategory::pluck('name', 'id');
        $users = User::get_all_user_list_by_email_name();
        $news_categories_pivot = NewsCategoryPivot::where('news_id', $id)->where('status', 1)->get();
        
        return view('admin.news.did_you_know.create', compact('news_categories', 'news', 'users', 'news_categories_pivot'));
    }

    public function DidYouKnow_Delete($id)
    {
        $news  = News::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
}
