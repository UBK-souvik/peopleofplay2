<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Meme;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Feed;
use App\Models\Gallery;
use App\Models\MediaList;
use App\Models\Blog;
use App\Models\Classified;
use App\Models\Role;
use App\Models\UsersUserRole;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\GalleryProductTag;
use App\Models\GalleryPeopleTag;
use App\Models\GalleryCompanyTag;
use App\Models\Dictionary;
use App\Models\Advertisement;
use App\Models\HomePageWhateverDay;
use App\Models\Question;
use App\Models\QuizQuestion;
use App\Models\Quiz;
use App\Helpers\UtilitiesFour;
use App\Models\QuizApplication;
use App\Models\FeedPreferenceIama;
use App\Models\FeedPreferenceIlove;
use App\Models\FeedAd;
use App\Models\Feed_like;
use App\Models\Feed_comment_like;
use App\Models\NewsFeeds;
use App\Models\NewsFeedsSubmit;
use App\Models\FeedsCategory;
use App\Models\RipCategory;
use App\Models\Rip;
use Session;
use Validator;
use Auth;
use Response;
use File;
use URL;

class FeedsNewsController extends Controller
{

    public function newsFeeds(Request $request)
    {

        // echo '<pre>request - '; print_r($request->all()); die;

        if(!empty($request->page_scroll == 'yes')){
            $offset = $request->offset;
            $offset_i = $request->i_position;
            $limit = $noUserLimit = $request->limit;
            $no_User_Offset = $request->no_user_offset;
        }else{
            $offset = 0;
            $offset_i = 0;
            $limit = 5;
            $noUserLimit = 5;
            $no_User_Offset = 0;
        }
        $page_type = 'news_feeds';

        $user_id = $session_id ='';
        if(Auth::guard('users')->user()){
        $user_id = $session_id = Auth::guard('users')->user()->id;
        }

        $roles = $user_product_categories = $userPeopleRole = $userCompanyRole = $userProductRole = $userIdProduct =  $new_users = $newfeeds = $adminWiki = $notLoveUser = $newfeeds2 = $count_feeds2 = array();
        array_push($new_users,$user_id);

        DB::enableQueryLog();

        $qry = NewsFeeds::select('feeds_news.*','users.first_name','users.last_name','users.profile_image','users.slug','users.role as userRole','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug','feeds_categories.name as category_name','feeds_categories_2.name as category_name_2')->join('users','users.id','=','feeds_news.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds_news.id')->leftJoin("feeds_categories", 'feeds_categories.id','=', 'feeds_news.category_id')->leftJoin("feeds_categories as feeds_categories_2", 'feeds_categories_2.id','=', 'feeds_news.secondary_category_id')->where('feeds_news.pop_feed_position',0)->where('feeds_news.category_id','!=',0)->groupBy('feeds_news.id')->orderByDesc('feeds_news.created_at')->offset($offset * $limit)->limit($limit);
        if(!empty($request->datepicker) && !empty($request->is_date_select == 1)){
            // $date = explode('-',$request->datepicker);
            // $from = date('Y-m-d H:i:s',strtotime($date[0]));
            // $to = date('Y-m-d H:i:s',strtotime($date[1]));
            $qry->whereDate('feeds_news.created_at','<=', date('Y-m-d H:i:s',strtotime($request->datepicker)));
            $qry->whereDate('feeds_news.created_at','>=', date('Y-m-d H:i:s',strtotime($request->datepicker)));
        }
        if(!empty($request->category_filter)){
            $qry->whereIn('feeds_news.category_id',$request->category_filter);
            $qry->orWhereIn('feeds_news.secondary_category_id',$request->category_filter);
            // $explode = @$request->category_filter;
            // $qry->where(function($q)use ($explode) {
            //     foreach($explode as $arr_search_data_row){
            //         $q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",feeds_news.category_id)');
            //         $q->orWhereRaw('FIND_IN_SET("'.$arr_search_data_row.'",feeds_news.secondary_category_id)');
            //     }
            // });
        }
        $newfeeds1 = $qry->get()->toArray();

        // dd(DB::getQueryLog()); die;

        $qry = NewsFeeds::select('feeds_news.*','users.first_name','users.last_name','users.profile_image','users.slug','users.role as userRole','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug','feeds_categories.name as category_name','feeds_categories_2.name as category_name_2')->join('users','users.id','=','feeds_news.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds_news.id')->leftJoin("feeds_categories", 'feeds_categories.id','=', 'feeds_news.category_id')->leftJoin("feeds_categories as feeds_categories_2", 'feeds_categories_2.id','=', 'feeds_news.secondary_category_id')->where('feeds_news.pop_feed_position',0)->where('feeds_news.category_id','!=',0)->groupBy('feeds_news.id')->orderByDesc('feeds_news.created_at')->offset($offset * $limit)->limit($limit);
        if(!empty($request->datepicker) && !empty($request->is_date_select == 1)){
            // $date = explode('-',$request->datepicker);
            // $from = date('Y-m-d H:i:s',strtotime($date[0]));
            // $to = date('Y-m-d H:i:s',strtotime($date[1]));
            $qry->whereDate('feeds_news.created_at','<=', date('Y-m-d H:i:s',strtotime($request->datepicker)));
            $qry->whereDate('feeds_news.created_at','>=', date('Y-m-d H:i:s',strtotime($request->datepicker)));
        }
        if(!empty($request->category_filter)){
            $qry->whereIn('feeds_news.category_id',$request->category_filter);
            $qry->orWhereIn('feeds_news.secondary_category_id',$request->category_filter);
            // $explode = @$request->category_filter;
            // $qry->where(function($q)use ($explode) {
            //     foreach($explode as $arr_search_data_row){
            //         $q->whereRaw('FIND_IN_SET("'.$arr_search_data_row.'",feeds_news.category_id)');
            //         $q->orWhereRaw('FIND_IN_SET("'.$arr_search_data_row.'",feeds_news.secondary_category_id)');
            //     }
            // });
        }
        $count_feeds1 = $qry->get()->toArray();

        $featured_news_feeds = NewsFeedsSubmit::where('submitted_by', 1)->first();
        // pr($featured_news_feeds->toArray()); die;

        $feeds = array_merge ($newfeeds1);
        $countFeeds = array_merge ($count_feeds1);
        $cnt_feeds = count(array_merge($newfeeds1));
        $is_show_all =0; $is_front_page = 1;
        $uinfo = Auth::guard('users')->user();
        $feeds_ad = FeedAd::get();
        $feedsCategorys = FeedsCategory::get();
        // echo count($countFeeds); die;
        // echo "<pre>$cnt_feeds - "; print_r($feeds); die;
        $filter_type = '';
        $c_date_data = json_decode($request->c_date_data);
        // pr($c_date_data);
        if(!empty($request->page_scroll == 'yes')){
            if($request->clear_filter == 1){
                $filter_type = 'yes';
            }
            $offset = $offset+1;
            $offset_i+1;
            $feed_scroll_view = view('front.feeds_news.news_feeds_page_scroll',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page','filter_type','c_date_data','request'))->render();
            // echo $feed_scroll_view; die;
            echo json_encode(array('status'=>1,'view'=>$feed_scroll_view,'offset'=>$offset,'noUserOffset'=>$no_User_Offset,'cnt_feeds'=>$cnt_feeds,'countFeeds'=>count($countFeeds),'feed_Id'=>@$newfeeds1[0]['id']));
        }else if(!empty($request->filter_type == 'yes')){
            $filter_type = $request->filter_type;
            $feed_scroll_view = view('front.feeds_news.news_feeds_page_scroll',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page','filter_type','c_date_data','request'))->render();
            // echo $feed_scroll_view; die;
            $res = array('status'=>1,'view'=>$feed_scroll_view,'offset'=>$offset,'noUserOffset'=>$no_User_Offset,'cnt_feeds'=>$cnt_feeds,'countFeeds'=>count($countFeeds),'feed_Id'=>@$newfeeds1[0]['id']);
            return $res;
        }else{
            return view('front.feeds_news.news_feeds',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','no_User_Offset','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page'));
        }

    }

    public function news_feeds_filter(Request $request){
        $request['filter_type'] = 'yes';
        // pr($request->all()); die;
        $feedsFilter = $this->newsFeeds($request);

        // echo $feed_truth_view; die;
        echo json_encode($feedsFilter); die;
    }

    public function submit_news_feeds_form(Request $request){
        $data['feeds_categorys'] = FeedsCategory::get();
        $uinfo = Auth::guard('users')->user();
        if(!isset($uinfo) && empty($uinfo->id)){
            $feedform_view = view('front.feeds.not_logged_user')->render();
            return response()->json(array('status'=>2,'view'=>$feedform_view)); die;
        }

        $data['rip_categories'] = RipCategory::where('status',1)->orderBy('name','DESC')->get();

        $view = view('front.feeds_news.submit_news_feeds_form',$data)->render();
        return response()->json(['status'=>1,'view'=>$view]);
    }

    public function submit_news_feeds(Request $request)
    {
        // echo "<pre>submit_news_feeds request - "; print_r($request->all()); die;
        $current_user = get_current_user_info();
        $arr = [
            'category'=>'required',
            'title' => 'required',
        ];
        $validator = Validator::make($request->all(),$arr);

        if($validator->fails()){
            return response()->json(['status'=>0,'response'=>$validator->errors()->toJson()]);
        } else {

            $feed_data = array(
                'user_id'=>$current_user->id,
                'title'=>ucfirst($request->title),
                'caption' => ucfirst($request->caption),
                'video_url' => trim($request->video_url),
                'url' => trim($request->link),
                'category_id' => $request->category,
                'rip_category_id' => $request->rip_category,
                'secondary_category_id' => $request->secondary_category,
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
                        })->save($destinationPath.'/'.$filename,75)){
                            $feed_data['image'] = $filename;
                    }else{
                        // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                // Shubham Code For Image Compression End //
            }
            // pr($feed_data); die;
            $feedInsert = NewsFeedsSubmit::insertGetId($feed_data);
            $feeds_category = FeedsCategory::where('id',$request->category)->first();
            $uinfo = Auth::guard('users')->user();

            //***** || Mail || ***** //

            $to_name = 'Admin';
            $to_email = env('TO_EMAIL');
            // $to_email = 'shubham16.sws@gmail.com';
            // $data = array("username" => $to_name);
            $data = $feed_data;
            $data['category_name'] = @$feeds_category->name;
            $data['user_name'] = @$uinfo->first_name.' '.@$uinfo->last_name;
            $message ="";
            $subject = "News submission : ".date('F d, Y');

            // $view = view('mail.new_submission_mail', $data)->render();
            // echo '<pre>';print_r($data); die;
            // echo $view; die;
            $moduleController = new ModuleController();
            $send_mail = $moduleController->send_mail_by_phpmailer($to_email, $subject , 'mail.new_submission_mail', $data);

            //***** || Mail || ***** //

            return response()->json(['status'=>1,'message'=>'News submitted successfully.']);
        }
    }

    public function feed_type(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $user = $uinfo = Auth::guard('users')->user();
        if(empty($user)){
            $feedform_view = view('front.feeds.not_logged_user')->render();
            echo json_encode(array('status'=>2,'view'=>$feedform_view)); die;
        }
        $type_of_user = $user->type_of_user;
        $role = $user->role;

        $user_id = $user->id;
        $title_type = 'Media';
        $product_list = Product::pluck('name', 'id');
        $company_list = User::where('role', 3)->pluck('first_name', 'id');
        $products = Product::where(['user_id'=>$user_id,'status'=>1])->get();
        $people_list = User::where('role','!=', 3)->get(['id','first_name', 'last_name']);
        $page_type = $request->page_type;
        $feeds_categorys = FeedsCategory::get();
        // $people_list = User::where('role', 2)->pluck('first_name', 'id');
        // pr($people_list->toArray()); die;
        $news_Feeds = array();
        $requset_type = '';
        if(!empty($request->type == 'news_feed_edit')){
            $news_Feeds = NewsFeeds::where('id',$request->news_feed_id)->first();
            $requset_type = $request->type;
        }
        $view_type = $request->view_type;
        $rip_categories = RipCategory::where('status',1)->orderBy('name','DESC')->get();

        $feedform_view = view('front.feeds_news.type',compact('product_list','company_list','people_list','products','title_type','view_type','type_of_user','role','page_type','feeds_categorys','uinfo','news_Feeds','requset_type','rip_categories'))->render();
        if($user->type_of_user == 1 && $user->role == 1){
            $feedform_view = view('front.feeds.free_user_type',compact('product_list','company_list','people_list','products','title_type','view_type','type_of_user','role'))->render();
            echo json_encode(array('status'=>0,'view'=>$feedform_view));
        }else{
            echo json_encode(array('status'=>1,'view'=>$feedform_view));
        }
    }

    public function feeds_save(Request $request)
    {
        // echo "<pre>request - "; print_r($request->all()); die;

        $current_user = get_current_user_info();
        if($request->type==1) {
            $arr = [
                'type'=>'required',
                'title' => 'required',
                // 'caption' => 'required',
                // 'image_name' => 'required',
            ];
            if($request->submit_post_val != '1'){
                $arr['image_name'] = 'required';
            }
        } else if($request->type==2) {
            $arr = array(
                'type'=>'required',
                'title' => 'required',
                // 'caption' => 'required',
                // 'video_url' =>'required',
            );
            if($request->submit_post_val != '1'){
                $arr['video_url'] = 'required';
            }
        } else if($request->type==4) {
            $arr = array(
                'type'=>'required',
                'title' => 'required',
                'link' => 'required|url',
                // 'caption' => 'required',
                // 'image_name' => 'required',
            );
        } else if($request->type==5) {
            $arr = array(
                'type'=>'required',
                'title' => 'required',
                // 'caption' => 'required',
                'product_id' => 'required',
            );
        }

        if($request->page_type == 'news_feeds'){
            $arr['category'] = 'required';
        }

        $validator = Validator::make($request->all(),$arr);

        if($validator->fails()){
            return response()->json(['success'=>0,'response'=>$validator->errors()->toJson()]);
        } else {

            $feedData = array();

            $str_tag = $this->getBlogTags($request);
            $feedcCompanies = $feedPerson = $feedProduct ='';
            if(isset($request->peoples) && count($request->peoples)>0) {
            $feedPerson = implode(",",$request->peoples);
            }
            if(isset($request->products) && count($request->products)>0) {
            $feedProduct = implode(",",$request->products);
            }
            if(isset($request->companies) && count($request->companies)>0) {
                $feedcCompanies = implode(",",$request->companies);
            }

            $feed_data = array(
                'user_id'=>$current_user->id,
                'type'=>$request->type,
                'title'=>ucfirst($request->title),
                'caption' => ucfirst($request->caption),
                'tag' => $str_tag,
                'tag_peoples' =>$feedPerson,
                'tag_products' =>$feedProduct,
                'tag_companies' =>$feedcCompanies,
                'time' =>time(),
            );

            if($request->type == 1 || $request->type==4) {
                // echo $request->image_name; die;
                if(!empty($request->og_fetch_link == 1)){
                    $site_image = @file_get_contents($request->image_name,false);
                    $fileExtension = \File::extension($request->image_name);
                    $timestamp = generateFilename();
                    // $filename = $timestamp.'.'.$fileExtension;
                    $filename = $timestamp.'.jpg';

                    $img_path = public_path('/uploads/images/feed/'.$filename);
                    $ch = curl_init($request->image_name);
                    $fp = fopen($img_path, 'wb');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                    fclose($fp);
                    $feed_data['image'] = $filename;
                }else{
                    $feed_data['image'] = $request->image_name;
                }
            }

            if($request->type == 2) {
                $feed_data['video_url'] = trim($request->video_url);
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$request->video_url, $match);
                UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);
            }
            if($request->type == 4) {
            $feed_data['url'] = trim($request->link);
            }

            $feedData = $feed_data;

            $feed_data['category_id'] = $request->category;
            $feed_data['secondary_category_id'] = $request->secondary_category;
            $feed_data['rip_category_id'] = $request->rip_category;

            // pr($feed_data); die;
            $feedInsert = NewsFeeds::updateOrCreate(['id'=>$request->news_feed_id], $feed_data);
            // pr($feedInsert); die;
            if(!empty($request->add_to_feeds == 'on')){
                $feedData['category_id'] = '';
                $feedData['news_feeds_id'] = $feedInsert->id;
                // // Feed::insertGetId($feed_data);
                Feed::updateOrCreate(['news_feeds_id'=>$request->news_feed_id], $feedData);
            }

            if(!empty($request->rip_category)){
                if(!empty($request->link)){
                    $request['url'] = $request->link;
                }elseif(!empty($request->video_url)){
                    $request['url'] = $request->video_url;
                }else{
                    $request['url'] = "#!";
                }

                $request['category_id'] = $request->rip_category;
                $request['description'] = $request->caption;

                // echo "<pre>request - "; print_r($request->all()); die;

                $rip_data = $request->only(Rip::$fillable_shadow);
                if (!empty($request->image_name)) {
                    if(!empty($request->og_fetch_link == 1)){
                        $oldPath = public_path('/uploads/images/feed/'.$feed_data['image']);
                    }else{
                        $oldPath = public_path('/uploads/images/feed/'.$request->image_name);
                    }
                    $fileExtension = \File::extension($oldPath);
                    $filenamefeed = $request->image_name;
                    $timestamp = generateFilename();
                    $filename = $timestamp . '_rip_'.'.' . $fileExtension;
                    $newPathWithName = public_path('/uploads/images/rip/'.$filename);
                    if (\File::copy($oldPath , $newPathWithName)) {
                        // dd("success");
                        $rip_data['featured_image'] = $filename;
                    }
                }
                $rip_data['news_feed_id'] = $feedInsert->id;

                Rip::updateOrCreate(['news_feed_id' => $request->news_feed_id], $rip_data);
            }
            $pg = 'news_feeds';
            return response()->json(['success'=>1,'message'=>'Posted Successfully.','page'=>$pg]);
        }


    }

    public function feed_image_upload(Request $request)
    {
    $image = $request->image;
            list($type, $image) = explode(';',$image);
            list(, $image) = explode(',',$image);

            $image = base64_decode($image);
            $timestamp = generateFilename();
            $image_name = $timestamp.'.png';
            file_put_contents('uploads/images/feed/'.$image_name, $image);
            echo json_encode(['success'=>1,'crop_img'=>$image_name]);
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


    public function get_product_infp(Request $request)
    {
        $data = Product::find($request->id);
        $image = @prodEventImageBasePath(@$data->main_image);
    return Response::json(['image' => $image]);
    }

    public function feed_like(Request $request)
    {
        $start_time = date('h:i:s a');
        $uinfo = Auth::guard('users')->user();
        if(!isset($uinfo) && empty($uinfo->id)){
            $feedform_view = view('front.feeds.not_logged_user')->render();
            echo json_encode(array('status'=>2,'view'=>$feedform_view)); die;
        }

        $session_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        if($request->is_like == 1) {
            // DB::table('feed_likes')->insert( [
            //     'user_id'=>$session_id,
            //     'feed_id'=>$request->feed_id,
            //     'type'=>$request->type,
            //     'reply_id'=>$request->reply_id,
            // ]);
            $like_data = array(
                'user_id'=>$session_id,
                'type'=>$request->type,
                'reply_id'=>$request->reply_id,
            );
            $totalLikePost = 0;
            $like_data['news_feed_id'] = $request->feed_id;

            Feed_like::updateOrCreate(['user_id'=>$session_id,'news_feed_id'=>$request->feed_id], $like_data);
            $likeCount = DB::table('feed_likes')->where(['news_feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();

            if($likeCount>0) {
                $totalLikePost = $likeCount;
            }
            $res = array('status'=>1,'likeCount'=>$totalLikePost,'message'=>'Like successfully','start_time'=>$start_time,'end_time'=>date('h:i:s a'));
            echo json_encode($res);
        } else {
            DB::table('feed_likes')->where(['user_id'=>$session_id,'news_feed_id'=>$request->feed_id,'type'=>$request->type, 'reply_id'=>$request->reply_id])->delete();
            $likeCount = DB::table('feed_likes')->where(['news_feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();

            $totalLikePost = 0;
            if($likeCount>0) {
                $totalLikePost = $likeCount;
            }
            $res = array('status'=>0,'likeCount'=>$totalLikePost,'message'=>'Unlike successfully','start_time'=>$start_time,'end_time'=>date('h:i:s a'));
            echo json_encode($res);
        }
    }

    public function feed_comment(Request $req)
    {

        $msg = [
            'comment.required'=> 'Enter Comment',
        ];
        $validator = Validator::make($req->all(), [
            'comment' => 'required',
        ],$msg);

        if ($validator->fails())
        {
            return response()->json(['success'=>0,'response'=>$validator->errors()->toJson()]);
        } else {
            $user_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            $feed_cmt_data = array(
                'user_id' =>$user_id,
                'type' =>$req->type,
                'comment' =>$req->comment,
                'comm_id' =>$req->comm_id,
                'reply_id' =>$req->reply_id,
                'time' =>time(),
            );


            $feed_id = $req->feed_id;

            $feed_cmt_data['news_feed_id'] = $req->feed_id;
            DB::table('feed_comment')->insert($feed_cmt_data);
            $where = array('news_feed_id'=>$feed_id);
            $page_type = 'news_feeds';

            $lastInsertId = DB::getPdo()->lastInsertId();
            $is_show_all=$req->hid_view_all_comment;
            $uinfo = Auth::guard('users')->user();
            $view =  view('front.feeds_news.feed_comment_view',compact('feed_id','is_show_all','uinfo','page_type'))->render();
            // echo $view; die;
            $feed_count = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where($where)->orderByDesc('id')->get()->count();

            return response()->json(['success'=>1,'response'=>'Comment successfully.','view'=>$view,'feed_id'=>$feed_id,'feed_count'=>$feed_count]);
        }
    }


    public function feed_comment_like(Request $request)
    {
        // pr($request->all()); die;
        $current_user = get_current_user_info();
        if(empty($current_user)){
            $feedform_view = view('front.feeds.not_logged_user')->render();
            return response()->json(['success'=>0,'response'=>'Please Login.','view'=>$feedform_view]);
        } else{
            //echo $request->feed_id."==".$request->comment_id."==".$request->reply_id."==".$request->type;die;
            $user_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d');

            $data = Feed_comment_like::where(['user_id'=>$user_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type,'news_feed_id'=>$request->feed_id])->first();



            if($data && !empty($data)) {
                // echo "d"; die;
                Feed_comment_like::where('id',$data->id)->delete();
                $like_type = 0;
                $msg = 'unlike successfully';

                $totalReplyLike = Feed_comment_like::where(['news_feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();


                if($totalReplyLike>0) {
                    $totalCount = $totalReplyLike;
                } else {
                    $totalCount = 0;
                }
            } else {
                $dataInsert = array(
                    'user_id' =>$user_id,
                    'comment_id' =>$request->comment_id,
                    'reply_id' =>$request->reply_id,
                    'type'=>$request->type,
                );

                $dataInsert['news_feed_id'] = $request->feed_id;

                Feed_comment_like::updateOrCreate(['news_feed_id'=>$request->feed_id,'user_id' =>$user_id,'reply_id' =>$request->reply_id], $dataInsert);

                $totalReplyLike = Feed_comment_like::where(['news_feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();


                if($totalReplyLike>0) {
                    $totalCount = $totalReplyLike;
                } else {
                    $totalCount = 0;
                }
                $like_type = 1;
                $msg = 'like successfully';
            }
            return response()->json(['success'=>1,'response'=>$msg,'like_type'=>$like_type,'totalCount'=>$totalCount]);
        }
    }



    public function new_post_type(Request $request)
    {
        $user_id ='';
        if(Auth::guard('users')->user()){
        $user_id = Auth::guard('users')->user()->id;
        }
        $products ='';
        $type = $request->type;
        if($type==1) {
            $view_type = 'feed_image';
            $title_type = 'Image';
        }elseif($type==2) {
            $view_type = 'video';
            $title_type = 'Video';
        }elseif($type==4){
            $view_type = 'media';
            $title_type = 'Media';
        }elseif($type==5){
            $products = Product::where(['user_id'=>$user_id,'status'=>1])->get();
            $view_type = 'product';
            $title_type = 'Product';
        }
        $news_Feeds = array();
        $request_type = '';
        if(!empty($request->request_type_id)){
            $news_Feeds = NewsFeeds::where('id',$request->request_type_id)->first();
            $request_type = 'news_feed_edit';
        }
        $view = view('front.feeds_news.'.$view_type,compact('products','view_type','news_Feeds','request_type'))->render();
        echo json_encode(array('view'=>$view,'type'=>$type,'title_type'=>$title_type));
    }



    public function croppieIndex()
    {

        return view('front.feeds_news.croppie');

    }

    public function croppieUploadCropImage(Request $request)
    {
        // pr($request->all()); //die;
        if(empty($request->image_name)){
            $image = $request->image;

            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            // $image_name= time().'.png';
            // $path = public_path('uploads/images/feed/'.$image_name);
            // file_put_contents($path, $image);

            $file_comp = $request->photo;
            $extension = $file_comp->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file_path = 'uploads/images/feed/'.$filename;
            $image_comp_size = getimagesize($file_comp);
            // $img = \Image::make($file_comp->getRealPath());
            $img = \Image::make($image);
            $destinationPath = public_path($file_path);
            if($img->save($destinationPath,75)){
                    $image_name = $filename;
            }

            return response()->json(['status'=>true,'image_name'=>$image_name]);
        }else{
            return response()->json(['status'=>true,'image_name'=>$request->image_name]);
        }
    }

    public function feedShare($id)
    {


        $feeds = NewsFeeds::select('feeds_news.*','users.first_name','users.last_name','users.profile_image','users.slug','users.role as userRole','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug','feeds_categories.name as category_name')->join('users','users.id','=','feeds_news.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds_news.id')->leftJoin('feeds_categories','feeds_categories.id','=','feeds_news.category_id')->where('feeds_news.id',$id)->where('feeds_news.pop_feed_position',0)->where('feeds_news.category_id','!=',0)->groupBy('feeds_news.id')->orderByDesc('feeds_news.time')->get()->toArray();

        $session_id ='';
        if(Auth::guard('users')->user()){
        $session_id = Auth::guard('users')->user()->id;
        }
        $is_show_all = $offset = $offset_i = $no_User_Offset = 0;
        $limit = $noUserLimit = 20;

        $feeds_ad = FeedAd::get();
        $feedsCategorys = FeedsCategory::get();
        $featured_news_feeds = NewsFeedsSubmit::where('submitted_by', 1)->first();

        //   echo '<pre>feeds - '; print_r($feeds); die;
        return view('front.feeds_news.feed_meta',compact('feeds','session_id','is_show_all','offset','offset_i','no_User_Offset','limit','noUserLimit','feeds_ad','feedsCategorys','featured_news_feeds'));
    }

    public function newsFeedActionType(Request $request){
        // echo '<pre>newsFeedActionType - '; print_r($request->all()); die;

        if($request->action_type == 'remove'){

            $image_data = NewsFeeds::where('id', $request->id)->first();
            if(NewsFeeds::where('id', $request->id)->delete()){

                $file_path = 'uploads/images/feed/'.$image_data->image;
                $image_path = public_path($file_path);
                if(file_exists($image_path)) {
                    // File::delete($image_path);
                }
                echo json_encode(array('status'=>1,'msg'=>'Feed removed successfully'));
            }

        }elseif($request->action_type == 'delete'){
            $image_data = NewsFeeds::where('id', $request->id)->first();
            if(NewsFeeds::where('id', $request->id)->delete()){
                $file_path = 'uploads/images/feed/'.$image_data->image;
                $image_path = public_path($file_path);
                if(file_exists($image_path)) {
                    // File::delete($image_path);
                }
            }
            echo json_encode(array('status'=>1,'msg'=>'Feed deleted successfully'));

        }elseif($request->action_type == 'report_from_show'){
            $report_labels = DB::table('feeds_report_label')->get();
            $feed_id = $request->id;
            $action_url = route('front.feeds_news.news_feed_action_type');
            $view = view('front.feeds.feed_report_form',compact('report_labels','feed_id','action_url'))->render();
            echo json_encode(array('status'=>2,'view'=>$view));

        }elseif($request->action_type == 'feed_report_submit'){
            $feed_data = NewsFeeds::where('id',$request->feed_id)->first();
            $user_ids = Auth::guard('users')->user();
            if(empty( $user_ids->id)){
                echo json_encode(array('status'=>0,'url'=>'login')); die;
            }
            $user_id = $user_ids->id;

            $feeds_report_data = array(
                'user_id' => $user_id,
                'type' => 2,    //  1 -> Home Feeds, 2 -> News-Feeds
                'feed_user' => $feed_data->user_id,
                'news_feed_id' => $request->feed_id,
                'reason' => $request->reason,
                'description' => $request->description,
                'created_at' =>time(),
            );
            DB::table('feeds_report_save')->insert($feeds_report_data);
            echo json_encode(array('status'=>3,'msg'=>'Report added successfully'));
        }
    }


    public function news_feed_comment_like_user(Request $request){
        // pr($request->all()); die;

        if(!empty($request->like_type == 'feed_like')){
            $datas = Feed_like::where(['news_feed_id'=>$request->feed_id])->select('feed_likes.*','users.first_name','users.last_name','users.type_of_user','users.role','users.profile_image','users.slug')->leftJoin('users','users.id','=','feed_likes.user_id')->get();
        }else{
            $datas = Feed_comment_like::where(['comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'news_feed_id'=>$request->feed_id])->select('feed_comment_like.*','users.first_name','users.last_name','users.type_of_user','users.role','users.profile_image','users.slug')->leftJoin('users','users.id','=','feed_comment_like.user_id')->get();
        }


        if(!empty($datas->toArray())){
            $view = '<div class="border-bottom ml-3 mt-3 mb-2"><div class="mb-3"><b>People who liked</b></div></div>';
            foreach($datas as $data){
                if($data->role == 3){
                    $url = url('company/'.$data->slug);
                }else{
                    $url = url('people/'.$data->slug);
                }
                if(!empty($data->profile_image)){
                    $src = asset('uploads/images/users/'.$data->profile_image);
                }else{
                    $src = asset('front/new/images/Product/team_new.png');
                }

                $view .= '<div class="mt-2 mb-3 ml-3"><a href="'.$url.'" target="_blank"><img src="'.$src.'" alt="" class="mr-3 rounded-circle" style="width:45px;"><span>'.ucwords($data->first_name.' '.$data->last_name).'</span></a></div>';
            }
            echo json_encode(['status'=>1,'view'=>$view]);
            // pr($data->toArray()); die;
        }
    }

    public function searchNewFeedsData(Request $request){

        $news_feeds_arr['news_feeds'] = NewsFeeds::where('feeds_news.title', 'LIKE', '%'.$request->feeds.'%')->orWhere('feeds_news.caption', 'LIKE', '%'.$request->feeds.'%')->get()->toArray();

        $request->result_for = $request->feeds;
        $rtn_arr_cnt = count($news_feeds_arr);
        $rtn_arr = array_merge($news_feeds_arr);

		// echo '<pre>rtn_arr - '; print_r($rtn_arr); die;
		$view = view('front.pages.additional_search_ajax', compact('rtn_arr','request','rtn_arr_cnt'))->render();
		echo json_encode(['status'=>1,'view'=>$view]); die;
    }

}
