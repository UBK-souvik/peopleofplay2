<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\BlogPreView;
use App\Models\Feed;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;
use File;
use Str;
use Auth;


class BlogController extends ModuleTwoController
{
	
	 public function getAllBlogs()
    {
       echo  $this->getArticleBloglist('blog', '');
    }
	
	public function getAllBlogPedias()
	{
	   echo  $this->getArticleBloglist('blog_pedia', '');	
	}

    public function getAllBlogPediasFilter($id)
    {
        $blog_categories = BlogCategory::where('id',$id)->first();
           if(empty($blog_categories)) {
            return redirect('blog_pedia');
           }
       echo  $this->getArticleBloglist('blog_pedia', '', $id);   
    }

  public function getAllInterviewFilter($id)
    {
        // echo $id; die;
        $blog_categories = BlogCategory::where('id',$id)->first();
           if(empty($blog_categories)) {
            return redirect('interviews');
           }
       echo  $this->getArticleBloglist('AdminBlog', '', $id);   
    }

    public function getBlogDetail($slug)
    {
		echo $this->getArticleBlogContent('blog', $slug);
    }

	public function getUserBlogList($slug)
    {
		echo  $this->getArticleBloglist('blog', $slug);
    }
    
    public function getAdminBlogList()
    {
        echo  $this->getArticleBloglist('AdminBlog', '');
    }
    public function getAdminBlogDetail($slug)
    {
        echo $this->getArticleBlogContent('AdminBlog', $slug);
    }

    public function getBlogs()
    {
        $current_user = get_current_user_info();
        $blogs = Blog::where('user_id', $current_user->id)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('front.user.blog.index', compact('blogs'));
    }

    public function getCreateBlog(Request $request)
    {
        $blog_categories = BlogCategory::pluck('name', 'id');
        return view('front.user.blog.create', compact('blog_categories'));
    }

    public function postCreateBlog(Request $request)
    {

        // echo '<pre>request - '; print_r($request->all()); die;
        /*$request->validate([
            'blog_id' => 'nullable|exists:blogs,id',
            'title' => 'required',
            'featured_image' => 'required_without:blog_id|file',
            'description' => 'required',
            'tag' => 'required',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            //'status' => 'required|in:0,1'
        ]); */		
				 
		 $rules = [
        'blog_id' => 'nullable|exists:blogs,id',
            'title' => 'required',
            //'featured_image' => 'required|file',//required_without:blog_id|file
            'ckeditor_description_new' => 'required',
            // 'tags' => 'required',
            'category_id' => 'required',//|exists:blog_categories,id
            //'meta_title' => 'required',
            //'meta_description' => 'required',
            //'meta_keyword' => 'required',
            //'status' => 'required|in:0,1'
    ];
	
	$niceNames = [
            'title' => 'Title',
			'featured_image' => 'Featured Image',
            'ckeditor_description_new' => 'Description',
            'tags' => 'Tag',
            'category_id' => 'Category',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
            //'status' => 'required|in:0,1'
    ];
	
	if(empty($request->blog_id))
	{
	   $rules['featured_image'] = 'required|file';	
	}

       $this->validate($request, $rules, [], $niceNames);

        try {

            // DB::beginTransaction();


            $current_user = get_current_user_info();
            $data = $request->only(Blog::$fillable_shadow);
            // echo '<pre>request - '; print_r($request); die;
            $data['user_id'] = $current_user->id;
			
			/*$arr_tag = $request->tag;
			
			if(!empty($arr_tag) && count($arr_tag)>0)
			{
			   $str_tag = implode(',', $arr_tag);
			}*/
			
			$str_tag = $this->getBlogTags($request);
			
			$str_ckeditor_description_new = $request->ckeditor_description_new;
			
			$data['tag'] = $str_tag;
			$data['status'] = $request->blg_status;
			$data['description'] = $str_ckeditor_description_new;
			
			//$data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'blog');
            if(!empty($request->crop_img)) {
            $data['featured_image'] = $request->crop_img;
            $data['featured_image_thumbnail'] = 'thumbnail_'.$request->crop_img;
            }
            $feedData = Blog::updateOrCreate(['id' => $request->blog_id], $data);
            // $feedData = Blog::where('id',$request->blog_id)->first();

            if((isset($feedData) && !empty($feedData)) && (!empty($request->feed_check == 'on') && !empty($request->blg_status == 1))) {
                // $oldPath = public_path('/uploads/images/blogs/'.$feedData['featured_image']); 
                // $fileExtension = \File::extension($oldPath);
                // //////$timestamp = generateFilename();
                // $filename = $feedData['featured_image'];
                // $newPathWithName = public_path('uploads/images/feed/'.$filename);
                // if (\File::copy($oldPath , $newPathWithName)) {
                //     // dd("success");
                // }

                $timestamp = generateFilename();
                $oldPath = public_path('/uploads/images/blogs/'.$feedData['featured_image']); 
                $extension = \File::extension($oldPath);
                $filename = $feedData['featured_image'];
                $file_path = 'uploads/images/feed/'.$filename;
                $img = \Image::make($oldPath);
                $destinationPath = public_path($file_path);
                if($img->save($destinationPath,75)){
                    $feedData['featured_image'] = $filename;
                }
                // if ($feedData['feed_id'] == 0) {
                // }

                $feed_data = array(
                    'title' => $feedData['title'],
                    'type' => 3,
                    'tag' => $str_tag,
                    'caption'=> $feedData['description'],
                    'category_id'=> $feedData['category_id'],
                    'user_id'=> $feedData['user_id'],
                    'image'=>$feedData['featured_image'],
                    'url'=>url('blog/'.$feedData['slug']),
                    'check_post' => 1,
                    'time' => time(),

                );
                $feedInsert = Feed::updateOrCreate(['id' => $feedData['feed_id']], $feed_data);
                Blog::where('id',$feedData->id)->update(['feed_id'=>$feedInsert->id]);
            }

            
            if((!empty($request->feed_check == 'on') && $request->blg_status == 0)) {
                return json_encode(['status'=>2]); die;
            }
            
            // DB::commit();
			Session::flash('blog_data_saved_flag', 1);
            return successMessage('Blog saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdateBlog($slug)
    {
        $current_user = get_current_user_info();
        $blog = Blog::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail();
        $blog_categories = BlogCategory::pluck('name', 'id');
        return view('front.user.blog.create', compact('blog_categories', 'blog'));
    }

    public function getDeleteBlog($slug)
    {
        $current_user = get_current_user_info();
        Blog::where('slug', $slug)
            ->where('user_id', $current_user->id)
            ->firstOrFail()
            ->delete();
			
		Session::flash('blog_data_deleted_flag', 1);	

        return redirect()->route('front.user.blog.index');
    }


    public function getBlogUploadImg(Request $request)
    {
        // echo 'herer'; die;
        $image = $request->image;
        list($type, $image) = explode(';',$image);
        list(, $image) = explode(',',$image);
        $image = base64_decode($image);
        // $timestamp = generateFilename();
        // $image_name = $timestamp. '_blogs_' .'.'.'png';
        // file_put_contents('uploads/images/blogs/'.$image_name, $image);

        $timestamp = generateFilename();
        $filename = $timestamp. '_blogs_' .'.'.'png';
        $file_path = 'uploads/images/blogs/'.$filename;
        $img = \Image::make($image);
        $destinationPath = public_path($file_path);
        if($img->save($destinationPath,50,'jpg')){
                $image_name = $filename;
        }

        UtilitiesFour::createThumb(public_path('uploads/images/blogs/'), $image_name, 'jpg', 100);
        echo json_encode(['success'=>1,'crop_img'=>$image_name]);
    }

    public function blog_Pre_Preview(Request $request){
        
        // echo "<pre> - "; print_r($request->all()); die;

        $user_name = Auth::guard('users')->user();
        
        $rules = [
            'title' => 'required',
            'ckeditor_description_new' => 'required',
            'tags' => 'required',
            'category_id' => 'required',
        ];
        
        $niceNames = [
                'title' => 'Title',
                'featured_image' => 'Featured Image',
                'ckeditor_description_new' => 'Description',
                'tags' => 'Tag',
                'category_id' => 'Category',
        ];
        
        if(empty($request->blog_id))
        {
           $rules['featured_image'] = 'required|file';	
        }
    
        $this->validate($request, $rules, [], $niceNames);

        try {
            // echo "<pre>"; print_r($request->all()); die;
            $blog_categories = BlogCategory::where('id',$request->category_id)->first();
            // $blog = array(
            //     'featured_image' => @newsBlogImageBasePath($request->image_priview),
            //     'title' => $request->title,
            //     'blog_category_name' => $blog_categories->name,
            //     'description' => $request->ckeditor_description_new,
            //     'tag' => $request->tags,
            //     'meta_title' => $request->meta_title,
            //     'meta_keyword' => $request->meta_keyword,
            //     'meta_description' => $request->meta_description,
            //     'user' => $user_name->first_name.' '.$user_name->last_name,
            //     'created_at' => date('Y-m-d h:i:s'),
            // );





            $current_user = get_current_user_info();
            $data = $request->only(BlogPreView::$fillable_shadow);
            $data['user_id'] = $current_user->id;
			
			$str_tag = $this->getBlogTags($request);
			$str_ckeditor_description_new = $request->ckeditor_description_new;
			
			$data['tag'] = $str_tag;
			$data['status'] = $request->blg_status;
			$data['description'] = $str_ckeditor_description_new;
			
			//$data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'blog');
            if(!empty($request->crop_img)) {
                $data['featured_image'] = $request->crop_img;
                $data['featured_image_thumbnail'] = 'thumbnail_'.$request->crop_img;
            }else if(!empty($request->image_priview)) {
                $data['featured_image'] = $request->image_priview;
                $data['featured_image_thumbnail'] = 'thumbnail_'.$request->image_priview;
            }

            // echo "<pre>data - "; print_r($data); die;

            BlogPreView::updateOrCreate(['id' => $request->blog_preview_id], $data);
            if(empty($request->blog_preview_id)){
                $ins_id = DB::getPdo()->lastInsertId();
            }else{
                $ins_id = $request->blog_preview_id;
            }
            $preview_blog = BlogPreView::where('id',$ins_id)->first();
            
			$res = array('success'=>1,'id'=>$ins_id,'slug'=>$preview_blog->slug);
            echo json_encode($res); die;

        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
        
    }

    public function blogPreview(Request $request,$slug){
        
        // echo "<pre>$slug - "; print_r($request->all()); die;
        $user_name = Auth::guard('users')->user();
        
        $blog_data = Blog::where('slug',$slug)->first();
        $blog_categories = BlogCategory::where('id',$blog_data->category_id)->first();

        $blog = array(
            'featured_image' => @newsBlogImageBasePath($blog_data->featured_image),
            'featured_image_thumbnail' => $blog_data->featured_image_thumbnail,
            'id' => $blog_data->id,
            'title' => $blog_data->title,
            'blog_category_name' => $blog_categories->name,
            'description' => $blog_data->description,
            'tag' => $blog_data->tag,
            'meta_title' => $blog_data->meta_title,
            'meta_keyword' => $blog_data->meta_keyword,
            'meta_description' => $blog_data->meta_description,
            'user' => $user_name->first_name.' '.$user_name->last_name,
            'created_at' => date('Y-m-d h:i:s'),
        );

        $category_blogs = DB::table('blogs')->where('blogs.status',1)->select('blogs.id', 'blogs.featured_image', 'blogs.title', 'blogs.slug')->orderBy('id', 'desc');
        $related_blog = $category_blogs->limit(5)->get();
        $type_post = 'blog';
        // echo '<pre>blog - '; print_r($blog); die;
        $view_content = (string)View::make('front.pages.blog.preview_detail', compact('blog','related_blog','type_post'))->render();
        // echo $view_content; die;
        return $view_content;

    }

    public function blogPre_View_Show(Request $request,$slug){
        
        // echo "<pre>$slug - "; print_r($request->all()); die;
        $user_name = Auth::guard('users')->user();
        
        $blog_data = BlogPreView::where('slug',$slug)->first();
        $blog_categories = BlogCategory::where('id',$blog_data->category_id)->first();

        $blog = array(
            'featured_image' => @newsBlogImageBasePath($blog_data->featured_image),
            'id' => $blog_data->id,
            'title' => $blog_data->title,
            'blog_category_name' => $blog_categories->name,
            'description' => $blog_data->description,
            'tag' => $blog_data->tag,
            'meta_title' => $blog_data->meta_title,
            'meta_keyword' => $blog_data->meta_keyword,
            'meta_description' => $blog_data->meta_description,
            'user' => $user_name->first_name.' '.$user_name->last_name,
            'created_at' => date('Y-m-d h:i:s'),
        );

        $category_blogs = DB::table('blogs')->where('blogs.status',1)->select('blogs.id', 'blogs.featured_image', 'blogs.title', 'blogs.slug')->orderBy('id', 'desc');
        $related_blog = $category_blogs->limit(5)->get();
        $type_post = 'blog';
        // echo '<pre>blog - '; print_r($blog); die;
        $view_content = (string)View::make('front.pages.blog.preview_detail', compact('blog','related_blog','type_post'))->render();
        // echo $view_content; die;
        return $view_content;

    }

    public function publish_blog(Request $request){
        
        Blog::where('id',$request->id)->update(['status'=>$request->type]);
        $res = array('success'=>1);
        echo json_encode($res);
    }
}
