<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CompanyCategory;
use App\Models\FeedsCategory;
use App\Models\NewsFeeds;
use App\Models\NewsFeedsSubmit;
use App\Models\Feed;
use App\Models\RipCategory;
use App\Models\Rip;
use Session;


use Auth;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsFeedsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function news_feeds_getIndex()
    {
        return view('admin.news_feeds.index');
    }
    
    public function featured_news_feeds_getIndex()
    {
        return view('admin.news_feeds.featured_news_feeds');
    }

    public function featured_news_feeds_list()
    {
        $users_roles = NewsFeedsSubmit::where('submitted_by',1)->orderBy('id','DESC')->get();
        $data = \DataTables::of($users_roles)
        ->addIndexColumn()
            ->editColumn('video_url', function ($query) {
                if(!empty($query->video_url)){
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$query->video_url, $match);
    
                    return 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg';
                }
            })
            ->editColumn('image', function ($query) {
                if($query->type != 2){
                    if(empty($query->image)){
                        return asset('front/new/images/Product/team_new.png');
                    }else{
                        return asset('uploads/images/feed/'.$query->image);
                    }
                }elseif($query->type == 2){
                    if(!empty($query->video_url)){
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$query->video_url, $match);
        
                        return 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg';
                    }else{
                        return asset('front/new/images/Product/team_new.png');
                    }
                }
            })
            ->editColumn('type', function ($query) {
                if($query->type == 1){
                    return 'Image';
                }elseif($query->type == 2){
                    return 'Video';
                }elseif($query->type == 3){
                    return 'Blog';
                }elseif($query->type == 4){
                    return 'Media';
                }
            })
            ->make();
        return $data;
    }

    public function news_feeds_getList()
    {
        $users_roles = NewsFeedsSubmit::where('submitted_by',0)->orderBy('id','DESC')->get();
        $data = \DataTables::of($users_roles)
        ->addIndexColumn()
            ->editColumn('video_url', function ($query) {
                if(!empty($query->video_url)){
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$query->video_url, $match);
    
                    return 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg';
                }
            })
            ->editColumn('image', function ($query) {
                if($query->type != 2){
                    if(empty($query->image)){
                        return asset('front/new/images/Product/team_new.png');
                    }else{
                        return asset('uploads/images/feed/'.$query->image);
                    }
                }elseif($query->type == 2){
                    if(!empty($query->video_url)){
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$query->video_url, $match);
        
                        return 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg';
                    }else{
                        return asset('front/new/images/Product/team_new.png');
                    }
                }
            })
            ->editColumn('type', function ($query) {
                if($query->type == 1){
                    return 'Image';
                }elseif($query->type == 2){
                    return 'Video';
                }elseif($query->type == 3){
                    return 'Blog';
                }elseif($query->type == 4){
                    return 'Media';
                }
            })
            // ->filterColumn('group_id', function ($query, $keyword) {
            //     if ($keyword == 'toy') {
            //         $keyword = 1;
            //     } elseif ($keyword == 'game') {
            //         $keyword = 2;
            //     }
            //     // $keyword = strtolower($keyword) == "toy" ? 1 : 2;
            //     $query->where("group_id", $keyword);              
            // })
            ->make();
        return $data;
    }

    public function news_feeds_getCreate(Request $request)
    {
        // $this->bulk_upload($request); die;
        $data['page_type'] = 'Create';
        if($request->isMethod('post'))
        {
            // pr($request->all()); die;

            if(empty($request->url) && empty($request->video_url)){
                $request->validate([
                    'title' => 'required',
                    'caption' => 'required',
                    'featured_image' => 'required_without:news_feeds_id|file',
                    'category' => 'required',
                ]);
            }else{
                $request->validate([
                    'title' => 'required',
                    'caption' => 'required',
                    'category' => 'required',
                ]);
            }
            try {
    
                $user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();

                $feed_data = array(
                    'user_id'=>$request->news_feeds_user_id,
                    'title'=>ucfirst($request->title),
                    'caption' => ucfirst($request->caption),
                    'category_id' => ucfirst($request->category),
                    'type' => 4,
                    'submitted_by' => 0,
                    'time' =>time(),
                );
                
                if ($request->hasFile('featured_image')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->featured_image;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '.' . $extension;
                        $file_path = 'uploads/images/feed/';
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){                                
                                $feed_data['type'] = 1; 
                                $feed_data['image'] = $filename;
                        }else{
                            // Rollback Transaction
                            DB::rollBack();
    
                            $message = ['msg' => errorMessage('file_uploading_failed')];
                            return response()->json($message, 422);
                        }
                    // Shubham Code For Image Compression End //
                }elseif(!empty($request->is_image)){
                    $feed_data['type'] = 1; 
                    $feed_data['image'] = $request->is_image;
                }else{
                    $feed_data['image'] = '';
                }
                
                if(!empty($request->video_url)) {
                    $feed_data['video_url'] = trim($request->video_url); 
                    $feed_data['type'] = 2 ;
                }else{                    
                    $feed_data['video_url'] = ''; 
                }
                if(!empty($request->url)) {
                    $feed_data['url'] = trim($request->url); 
                    $feed_data['type'] = 4; 
                }else{                    
                    $feed_data['url'] = ''; 
                }    
                $feedData = $feed_data;
                
                $feed_data['rip_category_id'] = $request->rip_category; 
                $feed_data['secondary_category_id'] = $request->secondary_category;

                // pr($feed_data); die;

                $where  = ['id'=>$request->news_feeds_id];
                NewsFeedsSubmit::updateOrCreate($where,$feed_data);       
                $feed_data['news_feeds_submit_id'] = $request->news_feeds_id;
                $newsFeeds = NewsFeeds::updateOrCreate(['news_feeds_submit_id'=>$request->news_feeds_id],$feed_data);            
                
                if(!empty($request->add_to_feeds == 'on')){
                    $feedData['category_id'] = '';
                    $feedData['news_feeds_id'] = $newsFeeds->id;
                    // pr($newsFeeds); die;
                    Feed::updateOrCreate(['news_feeds_id'=>$newsFeeds->id],$feedData);
                }      
                
                if(!empty($request->rip_category)){
                    if(!empty($request->url)){
                        $request['url'] = $request->url;
                    }elseif(!empty($request->video_url)){
                        $request['url'] = $request->video_url;
                    }else{
                        $request['url'] = "#!";
                    }
                    
                    $request['category_id'] = $request->rip_category;
                    $request['description'] = $request->caption;
    
                    // echo "<pre>request - "; print_r($request->all()); die;
    
                    $rip_data = $request->only(Rip::$fillable_shadow);
                    if (!empty($request->is_image)) {
                        $oldPath = public_path('/uploads/images/feed/'.$request->is_image); 
                        $fileExtension = \File::extension($oldPath);
                        $filenamefeed = $request->is_image;
                        $timestamp = generateFilename();
                        $filename = $timestamp . '_rip_'.'.' . $fileExtension;
                        $newPathWithName = public_path('/uploads/images/rip/'.$filename);
                        if (\File::copy($oldPath , $newPathWithName)) {
                            // dd("success");
                            $rip_data['featured_image'] = $filename;
                        }
                    }
                    $rip_data['news_feed_id'] = $newsFeeds->id;
                    // pr($rip_data); die;

                    Rip::updateOrCreate(['news_feed_id' => $newsFeeds->id], $rip_data);
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

        $data['categorys'] = FeedsCategory::get();
        $data['rip_categories'] = RipCategory::where('status',1)->orderBy('name','DESC')->get();
        $newsFeeds = NewsFeedsSubmit::where('submitted_by', 0)->firstOrFail();
        if(isset($newsFeeds->id) && !empty($newsFeeds->id)){
            $data['newsFeeds'] = $newsFeeds;
        }
        return view('admin.news_feeds.create',$data);
        
    }

    public function news_feeds_getUpdate($id)
    {
        
        $page_type = 'Update';
        $categorys = FeedsCategory::get();
        $newsFeeds = NewsFeedsSubmit::where('id', $id)->firstOrFail();
        $rip_categories = RipCategory::where('status',1)->orderBy('name','DESC')->get();

        if($newsFeeds->submitted_by == 1){
            return redirect()->route('admin.news_feeds.index');
        }

        return view('admin.news_feeds.create', compact('categorys','newsFeeds','page_type','rip_categories'));
    }

    public function featured_news_getCreate(Request $request)
    {
        $data['page_type'] = 'Create';
        if($request->isMethod('post'))
        {
            // pr($request->all()); die;

            if(empty($request->url) && empty($request->video_url)){
                $request->validate([
                    'title' => 'required',
                    'caption' => 'required',
                    'featured_image' => 'required_without:news_feeds_id|file',
                    'category' => 'required',
                ]);
            }else{
                $request->validate([
                    'title' => 'required',
                    'caption' => 'required',
                    'category' => 'required',
                ]);
            }
            try {
    
                $user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();

                $feed_data = array(
                    'user_id'=>$user_id->id,
                    'title'=>ucfirst($request->title),
                    'caption' => ucfirst($request->caption),
                    'category_id' => ucfirst($request->category),
                    'submitted_by' => 1,
                    'time' =>time(),
                );
                
                if ($request->hasFile('featured_image')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->featured_image;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $filename = $timestamp . '.' . $extension;
                        $file_path = 'uploads/images/feed/';
                        $image_comp_size = getimagesize($file_comp);
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){                                
                                $feed_data['type'] = 1; 
                                $feed_data['image'] = $filename;
                        }else{
                            // Rollback Transaction
                            DB::rollBack();
    
                            $message = ['msg' => errorMessage('file_uploading_failed')];
                            return response()->json($message, 422);
                        }
                    // Shubham Code For Image Compression End //
                }
                
                if(!empty($request->video_url)) {
                    $feed_data['video_url'] = trim($request->video_url); 
                    $feed_data['type'] = 2 ;
                }
                if(!empty($request->url)) {
                    $feed_data['url'] = trim($request->url); 
                    $feed_data['type'] = 4; 
                }    
                
                // pr($feed_data); die;
                $where  = ['id'=>$request->news_feeds_id];
                NewsFeedsSubmit::updateOrCreate($where,$feed_data);            
                
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
        $data['categorys'] = FeedsCategory::get();
        
        // $newsFeeds = NewsFeedsSubmit::where('submitted_by', 1)->firstOrFail();
        $newsFeeds = NewsFeedsSubmit::where('submitted_by', 1)->first();
        if(isset($newsFeeds->id) && !empty($newsFeeds->id)){
            $data['newsFeeds'] = $newsFeeds;
        }
        return view('admin.news_feeds.featured_news_create',$data);
        
    }

    public function featured_news_getUpdate($id)
    {
        $page_type = 'Update';
        $categorys = FeedsCategory::get();
        $newsFeeds = NewsFeedsSubmit::where('id', $id)->firstOrFail();

        if($newsFeeds->submitted_by == 0){
            return redirect()->route('admin.news_feeds.featured_news_feeds');
        }

        return view('admin.news_feeds.featured_news_create', compact('categorys','newsFeeds','page_type'));
    }

    public function news_feeds_getDelete($id)
    {
        $newsFeedsSubmitData = NewsFeeds::where('news_feeds_submit_id',$id)->first();
        $newsFeeds  = NewsFeedsSubmit::findOrFail($id)->delete();
        $newsFeedsSubmit  = NewsFeeds::where('news_feeds_submit_id',$id)->delete();
        $feeds  = Feed::where('news_feeds_id',$newsFeedsSubmitData->id)->delete();
        return redirect()->route('admin.news_feeds.index')->with('message', 'News Feeds deleted!');
    }

    public function news_feeds_user_status(Request $request){
        // pr($request->all()); die;

        if($request->news_val == 0){
            User::where('id',$request->id)->update(['is_news_feeds'=>1]);
        }else{
            User::where('id',$request->id)->update(['is_news_feeds'=>0]);
        }
        return response()->json(['status'=>1]);
    }

    public function postYoutubeThumbnail(Request $request) {
        // echo 'here'; die;
        $GetAPI = @GetYoutubeAPI(@$request->video_url);
        $thumbnail = @$GetAPI['thumbnail']['thumb'];
        if(!empty($thumbnail)) {
           $res = array('success'=>1,'thumbnail'=>$thumbnail);
           echo json_encode($res);
        } else {
           $res = array('success'=>0,'msg'=>'Please Enter a Valid Youtube Url');
           echo json_encode($res);
        }
   }

}
