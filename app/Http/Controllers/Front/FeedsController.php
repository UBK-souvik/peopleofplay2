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
use Session;
use Validator;
use Auth;
use Response;
use File;
use URL;

class FeedsController extends Controller
{

    public function index(Request $request)
    { 
        // echo '<pre>request - '; print_r($request->all()); die;
        $pagesController = new PagesController();
        $pagesController->memeScheduleData();

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
        
        $feed_type = DB::table('feed_type')->get();
        $user_id = $session_id ='';
        if(Auth::guard('users')->user()){
        $user_id = $session_id = Auth::guard('users')->user()->id;
        }
    // $user_id = $session_id = Auth::guard('users')->user()->id;
        $roles = $user_product_categories = $userPeopleRole = $userCompanyRole = $userProductRole = $userIdProduct =  $new_users = $newfeeds = $adminWiki = $notLoveUser = $newfeeds2 = $count_feeds2 = array();
        array_push($new_users,$user_id);

        $getRole = Role::where('user_id',$user_id)->groupBy('role')->get(['role'])->toArray();
        
        foreach ($getRole as $key => $row) {
            $roles[] =  $row['role'];
        }
        
        // DB::enableQueryLog();
        if(!empty($roles) && count($roles)>0){            
            $preferenceIama = FeedPreferenceIama::where('user_id','!=',$user_id)->whereIn('categories',$roles)->groupBy(['categories'])->get(['user_id','categories']); 

            if(!empty($preferenceIama->toArray())){
                foreach($preferenceIama as $preferenceIam){
                    $userPeopleRole[] = $preferenceIam->user_id;
                }
            }else{
                $user_rolePeople = Role::whereIn('role',$roles)->groupBy(['role'])->get(['people_id','company_id','product_id']);
                foreach ($user_rolePeople  as $key => $row2) {
                    $userPeopleRole[] = $row2->people_id;
                    $userCompanyRole[] = $row2->company_id;
                    $userProductRole[] = $row2->product_id;
                }
            }
        }

        // $userProductCategories = ProductCategory::where('user_id',$user_id)->groupBy('category_id')->get(['category_id'])->toArray();
        
        // foreach ($userProductCategories as $key => $row1) {
        //     $user_product_categories[] =  $row1['category_id'];
        // }

        $userProductCategories = FeedPreferenceIlove::where('user_id',$user_id)->groupBy('categories')->get(['user_id','categories']);
        
        foreach ($userProductCategories as $key => $row1) {
            $user_product_categories[] =  $row1['categories'];
        }

        if(!empty($user_product_categories) && count($user_product_categories)>0){

            $preferenceIloves = FeedPreferenceIlove::where('user_id','!=',$user_id)->whereIn('categories',$user_product_categories)->groupBy('categories')->get(['user_id','categories']);

            if(!empty($preferenceIloves->toArray())){
                foreach($preferenceIloves as $preferenceIlove){
                    $userIdProduct[] = $preferenceIlove->user_id;
                }
            }else{
                $userProduct =  ProductCategory::whereIn('category_id',$user_product_categories)->groupBy(['user_id',])->get(['user_id']);
                foreach ($userProduct as $key => $row3) {
                    $userIdProduct[] =  $row3->user_id;
                }
            }
            $notPreferenceIloves = FeedPreferenceIlove::where('user_id','!=',$user_id)->whereNotIn('categories',$user_product_categories)->groupBy('categories')->get(['user_id','categories']);
            if(!empty($notPreferenceIloves->toArray())){
                foreach($notPreferenceIloves as $notPreferenceIlove){
                    $notLoveUser[] = $notPreferenceIlove->user_id;
                }
            }
        }
        $admin_user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();
        $admin_user[] = $admin_user_id->id;
        $users = array_unique (array_merge ($userIdProduct,$userPeopleRole, $userCompanyRole ,$userProductRole,$new_users,$admin_user));

        // DB::enableQueryLog();

        $newfeeds1 = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image','users.slug','users.role as userRole','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug')->join('users','users.id','=','feeds.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds.id')->where('feeds.pop_feed_position',0)->groupBy('feeds.id')->orderByDesc('feeds.time')->offset($offset * $limit)->limit($limit)->get()->toArray();

        
        // echo "<pre>users - "; print_r($users); //die;

        /******** || Shubham Code Start ||  ********/
        
            $count_feeds1 = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image','users.slug','users.is_front_admin_user')->join('users','users.id','=','feeds.user_id')->where('feeds.pop_feed_position',0)->groupBy('feeds.id')->orderByDesc('feeds.time')->get()->toArray();

            // echo $offset * $limit. ' - '.count($count_feeds1); die;
            
            // if(($offset * $limit) >= count($count_feeds1) || $offset == 0){                

            //     $newfeeds2 = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image','users.slug','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug')->join('users','users.id','=','feeds.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds.id')->where('feeds.pop_feed_position',0)->whereNotIn('feeds.user_id',$users)->groupBy('feeds.id')->orderByDesc('feeds.time')->offset($no_User_Offset * $noUserLimit)->limit($noUserLimit)->get()->toArray();

            //     // dd(DB::getQueryLog()); die; 
                
            //     $no_User_Offset = $no_User_Offset+1;
            // }
            
            // $count_feeds2 = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image','users.slug','users.is_front_admin_user')->join('users','users.id','=','feeds.user_id')->where('feeds.pop_feed_position',0)->groupBy('feeds.id')->orderByDesc('feeds.time')->get()->toArray();

            // // echo $offset * $limit. " - $no_User_Offset - ".count($count_feeds1); die;

            // // echo "<pre>newfeeds2 - "; print_r($newfeeds2);
            // // echo "<pre>count_feeds2 - "; print_r($count_feeds2); die;
            
            // dd(DB::getQueryLog()); die; 
            
            $newfeeds3 = Feed::where(['feeds.type'=>0,'feeds.check_post'=>2])->where('pop_feed_position','!=',0)->groupBy('feeds.id')->orderBy('feeds.id','ASC')->get()->toArray();
            

            $home_product_data = HomePageWhateverDay::get_happy_whatever_day(); 
            $home_advertisement_data = Advertisement::select('home_caption_one','home_caption_two','title','sponsor_name','advertisement_image','destination_link','id')
                ->where('advertisement_position', 4)
                ->where('advertisement_category', 1)
                ->where('status', 1)
                ->first();		

                if(!empty($request->dictionary_id)){
                    $dictionary_detail = Dictionary::get_dictionary_word_of_day($request->dictionary_id);
                }else{
                    $dictionary_detail = Dictionary::get_dictionary_word_of_day();
                }
                // pr($dictionary_detail->toArray()); die;
            $arr_dictionary_data = UtilitiesFour::getDictionaryFieldsData($dictionary_detail);

            $question_detail = Question::where('status', 1)
            ->with(['user'])
            ->inRandomOrder()
            ->limit(10)
            ->get();
            
            // $quiz_data = '';
            // $quiz_id = Quiz::where('status', 1)->get()->toArray();
            // shuffle($quiz_id);
            // // echo "<pre>quiz_id - "; print_r($quiz_id); die;
            // for($i=0; $i<count($quiz_id); $i++){
            //     $quiz_question_detail = QuizQuestion::where('status', 1)->where('quiz_id', $quiz_id[0]['id'])
            //     ->with(['user'])
            //     ->inRandomOrder()
            //     ->limit(10)
            //     ->get();
            //     // echo "<pre>"; print_r($quiz_question_detail); die;
                
            //     if(!empty($quiz_question_detail[0]->id)){
            //         $quiz_data = Quiz::where('id',$quiz_id[0]['id'])->first();
            //         break;
            //     }
            // }
            $trivia_quiz_questions = $this->trivia_quiz_questions();
            $quiz_data = $trivia_quiz_questions['quiz_data'];
            $quiz_question_detail = $trivia_quiz_questions['quiz_question_detail'];
                
        /******** || Shubham Code End ||  ********/

        $feeds = array_merge ($newfeeds3,$newfeeds1, $newfeeds2);
        // $countFeeds = array_merge ($newfeeds3,$count_feeds1, $count_feeds2);
        $countFeeds = array_merge ($count_feeds1, $count_feeds2);
        $cnt_feeds = count(array_merge($newfeeds1, $newfeeds2));
        $is_show_all =0; $is_front_page = 1;
        $uinfo = Auth::guard('users')->user();
        $feeds_ad = FeedAd::get();
        // echo count($countFeeds); die;
        // echo "<pre>trivia_quiz_questions - "; print_r($trivia_quiz_questions); die;
        // echo "<pre>$cnt_feeds - "; print_r($feeds); die;
        // echo "<pre>$cnt_feeds - "; print_r($newfeeds1); die;
        if(!empty($request->page_scroll == 'yes')){
            $offset = $offset+1;
            $offset_i+1;
            $feed_scroll_view = view('front.feeds.page_scroll_feeds_data',compact('feed_type','feeds','session_id','is_show_all','countFeeds','newfeeds3','home_product_data','home_advertisement_data','dictionary_detail','arr_dictionary_data','question_detail','offset','offset_i','quiz_question_detail','quiz_data','uinfo','feeds_ad','is_front_page'))->render();
            // echo $feed_truth_view; die;
            echo json_encode(array('status'=>1,'view'=>$feed_scroll_view,'offset'=>$offset,'noUserOffset'=>$no_User_Offset,'cnt_feeds'=>$cnt_feeds,'countFeeds'=>count($countFeeds),'feed_Id'=>@$newfeeds1[0]['id']));
        }else{
            return view('front.feeds.index',compact('feed_type','feeds','session_id','is_show_all','countFeeds','newfeeds3','home_product_data','home_advertisement_data','dictionary_detail','arr_dictionary_data','question_detail','offset','offset_i','quiz_question_detail','quiz_data','no_User_Offset','uinfo','feeds_ad','is_front_page'));
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
        $title_type = 'Image';  
        $product_list = Product::pluck('name', 'id');
        $company_list = User::where('role', 3)->pluck('first_name', 'id');
        $products = Product::where(['user_id'=>$user_id,'status'=>1])->get();
        $people_list = User::where('role','!=', 3)->get(['id','first_name', 'last_name']);
        $page_type = $request->page_type;
        $feeds_categorys = FeedsCategory::get();
        // $people_list = User::where('role', 2)->pluck('first_name', 'id');
        $feeds = array();
        $requset_type = '';
        if(!empty($request->type == 'feed_edit')){
            $feeds = Feed::where('id',$request->feed_id)->first();
            $requset_type = $request->type;
        }
        // pr($people_list); die;
        $view_type = $request->view_type;
        $feedform_view = view('front.feeds.type',compact('product_list','company_list','people_list','products','title_type','view_type','type_of_user','role','page_type','feeds_categorys','uinfo','feeds','requset_type'))->render();
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
    //   $feed_data['image'] =$request->image_name;
}


if($request->type == 2) {
  $feed_data['video_url'] = trim($request->video_url); 
  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$request->video_url, $match);
  UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);
}
if($request->type == 4) {
  $feed_data['url'] = trim($request->link); 
}

    if($request->type == 5) {
       $product = Product::find($request->product_id);
       if(isset($product->main_image) && !empty($product->main_image)) {
        //   $oldPath = public_path('/uploads/images/'.$product->main_image); 
        //    $fileExtension = \File::extension($oldPath);
        //    $timestamp = generateFilename();
        //    $filename = $timestamp . '.' . $fileExtension;
        //    $newPathWithName =public_path('/uploads/images/feed/'.$filename);
        //    $productImg = $filename;
        //    if (\File::copy($oldPath , $newPathWithName)) {
        //         // dd("success");
        //    }

            $file_comp = $product->main_image;
            $timestamp = generateFilename();
            $oldPath = public_path('/uploads/images/'.$product->main_image); 
            $extension = \File::extension($oldPath);
            $filename = $timestamp.'.' . $extension;
            $file_path = 'uploads/images/feed/'.$filename;
            // $image_comp_size = getimagesize($file_comp);
            // $img = \Image::make($file_comp->getRealPath());
            $img = \Image::make($oldPath);
            $destinationPath = public_path($file_path);
            if($img->save($destinationPath,50,'jpg')){
                    $productImg = $filename;
            }
       } else {
         $productImg = 'default_image.jpg';
       }

        $product_url = url('product/'.$product->slug);
        $feed_data['category_id'] = $request->product_id;
        $feed_data['product_name'] = $product->name;
        $feed_data['url'] = $product_url;
        $feed_data['image'] = $productImg;
    }
    // echo "<pre>feed_data - "; print_r($feed_data); die;

    if($request->page_type == 'news_feeds'){
        $feed_data['category_id'] = $request->category;
        $feedInsert = NewsFeeds::updateOrCreate(['id'=>$request->feed_id], $feed_data);
        $pg = 'news_feeds';
    }elseif(empty($request->add_to_profile)){
        $pg = 'home';
        $feedInsert = Feed::updateOrCreate(['id'=>$request->feed_id], $feed_data);
    }else{
        $pg = 'home';
        $feedInsert = Feed::updateOrCreate(['id'=>$request->feed_id], $feed_data);
        // pr($feedInsert); die;
        if($request->type == 5) {
            Product::where('id',$request->product_id)->update(['feed_id'=>$feedInsert->id]);
        }

        if($request->type == 4) {
            if(empty($request->og_fetch_link)){
                if($request->image_name != '') {
                    
                    //    $oldPath = public_path('/uploads/images/feed/'.$request->image_name); 
                    //    $fileExtension = \File::extension($oldPath);
                    //    $timestamp = generateFilename();
                    //    $filename = $timestamp . '.' . $fileExtension;
                    //    $newPathWithName = public_path('uploads/images/media/'.$filename);
                    //    if (\File::copy($oldPath , $newPathWithName)) {
                    //         // dd("success");
                    //    }

                    $oldPath = public_path('/uploads/images/feed/'.$request->image_name); 
                    $extension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $timestamp.'.' . $extension;
                    $file_path = 'uploads/images/media/'.$filename;
                    $img = \Image::make($oldPath);
                    $destinationPath = public_path($file_path);
                    if($img->save($destinationPath,50,'jpg')){
                        // dd("success");
                    }
                }else{
                    $filename = '';
                }
            }else{
                if($request->image_name != '') {
                    $oldPath = public_path('/uploads/images/feed/'.$feed_data['image']); 
                    $extension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $timestamp.'.' . $extension;
                    $file_path = 'uploads/images/media/'.$filename;
                    $img = \Image::make($oldPath);
                    $destinationPath = public_path($file_path);
                    if($img->save($destinationPath,50,'jpg')){
                        // dd("success");
                    }
                }else{
                    $filename = $feed_data['image'];
                }
            }
            $mediaData = array(
                'user_id' =>$current_user->id,
                'status'=>1,
                'title' => ucfirst($request->title),
                'featured_image' =>$filename,
                'url_data' => $request->link,
                'caption' => $request->caption,
                'added_by' =>1,
                'feed_id'=>$feedInsert->id
            );
            // pr($mediaData); die;
            MediaList::updateOrCreate(['feed_id' => $feedInsert->id], $mediaData);
        
        }
        if($request->type == 1 || $request->type == 2){
            $data = [
                'title' => ucfirst($request->title),
                'caption' => ucfirst($request->caption),
                'type' => $request->type,                    
                'is_known_for' => 0,
                'destination_id' => 1,
                'assign_product_id' => 0,
                'assign_brand_id' => 0,
                'assign_event_id' => 0,
                'status' => 1,
                'user_id' => $current_user->id,
                'feed_id' =>$feedInsert->id
            ];

            if($request->type == 2) {
                $data['media'] = $request->video_url;
            }

            if($request->type == 1) {
                if($request->image_name != '') {
                    //    $oldPath = public_path('/uploads/images/feed/'.$request->image_name); 
                    //    $fileExtension = \File::extension($oldPath);
                    //    $timestamp = generateFilename();
                    //    $filename = $timestamp . '.' . $fileExtension;
                    //    $newPathWithName = public_path('uploads/images/gallery/photos/'.$filename);
                    //    if (\File::copy($oldPath , $newPathWithName)) {
                    //    }

                        $oldPath = public_path('/uploads/images/feed/'.$request->image_name); 
                        $extension = \File::extension($oldPath);
                        $timestamp = generateFilename();
                        $filename = $timestamp.'.' . $extension;
                        $destinationPath = public_path('uploads/images/gallery/photos/'.$filename);
                        $img = \Image::make($oldPath);                
                        if($img->save($destinationPath,50,'jpg')){
                            $data['media'] = $filename;
                        }
                        
                    
                }
            }
            // $gallery_data = Gallery::create($data); 
            // pr($data); die;
            $gallery_data = Gallery::updateOrCreate(['feed_id' => $feedInsert->id], $data);

            if(!empty($request->peoples))
            {
                if(!empty($gallery_data->id)){
                    GalleryPeopleTag::where('gallery_id', $gallery_data->id)
                    ->where('user_id', $current_user->id)
                    ->update(['status' => 0]);  
                }               
                foreach ($request->peoples as $people_data_row) {
                    $data_people_tag = array();
                    $chk_people_tag_data = GalleryPeopleTag::select('id')
                    ->where('user_id', $current_user->id)
                    ->where('people_id', $people_data_row)
                    ->where('gallery_id', $gallery_data->id)->first();

                    $data_people_tag['user_id'] = $current_user->id;
                    $data_people_tag['gallery_id'] = $gallery_data->id;
                    $data_people_tag['people_id'] = $people_data_row;
                    $data_people_tag['created_at'] = new \DateTime();
                    $data_people_tag['updated_at'] = new \DateTime();
                    $data_people_tag['status'] = 1;                 

                    if(!empty($chk_people_tag_data->id)) {
                        $int_people_tag_data_id = $chk_people_tag_data->id;
                        $update = GalleryPeopleTag::where('id', $int_people_tag_data_id)
                        ->update(['status' => 1]);
                    } else {
                        $int_people_tag_data_id = 0;
                        GalleryPeopleTag::updateOrCreate(['id' => $int_people_tag_data_id], $data_people_tag);
                    }               
                }
            }

            if(!empty($request->products)) {
                if(!empty($gallery_data->id)) {
                    GalleryProductTag::where('gallery_id', $gallery_data->id)
                    ->where('user_id', $current_user->id)
                    ->update(['status' => 0]);  
                }               

                foreach ($request->products as $product_data_row) {

                    $data_product_tag = array();
                    $chk_product_tag_data = GalleryProductTag::select('id')
                    ->where('user_id', $current_user->id)
                    ->where('product_id', $product_data_row)
                    ->where('gallery_id', $gallery_data->id)->first();

                    $data_product_tag['user_id'] = $current_user->id;
                    $data_product_tag['gallery_id'] = $gallery_data->id;
                    $data_product_tag['product_id'] = $product_data_row;
                    $data_product_tag['created_at'] = new \DateTime();
                    $data_product_tag['updated_at'] = new \DateTime();
                    $data_product_tag['status'] = 1;                    

                    if(!empty($chk_product_tag_data->id)){
                        $int_product_tag_data_id = $chk_product_tag_data->id;
                        $update = GalleryProductTag::where('id', $int_product_tag_data_id)
                        ->update(['status' => 1]);
                    } else {
                        $int_product_tag_data_id = 0;
                        GalleryProductTag::updateOrCreate(['id' => $int_product_tag_data_id], $data_product_tag);
                    }               
                }
            }

            if(!empty($request->companies)) {
                if(!empty($gallery_data->id)) {
                    GalleryCompanyTag::where('gallery_id', $gallery_data->id)
                    ->where('user_id', $current_user->id)
                    ->update(['status' => 0]);  
                }               

                foreach ($request->companies as $company_data_row) {
                    $data_company_tag = array();
                    $chk_company_tag_data = GalleryCompanyTag::select('id')
                    ->where('user_id', $current_user->id)
                    ->where('company_id', $company_data_row)
                    ->where('gallery_id', $gallery_data->id)->first();

                    $data_company_tag['user_id'] = $current_user->id;
                    $data_company_tag['gallery_id'] = $gallery_data->id;
                    $data_company_tag['company_id'] = $company_data_row;
                    $data_company_tag['created_at'] = new \DateTime();
                    $data_company_tag['updated_at'] = new \DateTime();
                    $data_company_tag['status'] = 1;                    
                    if(!empty($chk_company_tag_data->id)) {
                        $int_company_tag_data_id = $chk_company_tag_data->id;
                        $update = GalleryCompanyTag::where('id', $int_company_tag_data_id)
                        ->update(['status' => 1]);
                    } else {
                        $int_company_tag_data_id = 0;
                        GalleryCompanyTag::updateOrCreate(['id' => $int_company_tag_data_id], $data_company_tag);
                    }               
                }
            }
        }
    }
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
        if(!empty($request->page_type == 'news_feeds')){
            $like_data['news_feed_id'] = $request->feed_id;

            Feed_like::updateOrCreate(['user_id'=>$session_id,'news_feed_id'=>$request->feed_id], $like_data);
            $likeCount = DB::table('feed_likes')->where(['news_feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();
        }else{
            $like_data['feed_id'] = $request->feed_id;

            Feed_like::updateOrCreate(['user_id'=>$session_id,'feed_id'=>$request->feed_id], $like_data);
            $likeCount = DB::table('feed_likes')->where(['feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();
        }
        if($likeCount>0) {
            $totalLikePost = $likeCount;
        }
        $res = array('status'=>1,'likeCount'=>$totalLikePost,'message'=>'Like successfully','start_time'=>$start_time,'end_time'=>date('h:i:s a'));
        echo json_encode($res);
    } else {
        if(!empty($request->page_type == 'news_feeds')){
            DB::table('feed_likes')->where(['user_id'=>$session_id,'news_feed_id'=>$request->feed_id,'type'=>$request->type, 'reply_id'=>$request->reply_id])->delete();
            $likeCount = DB::table('feed_likes')->where(['news_feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();
        }else{
            DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$request->feed_id,'type'=>$request->type, 'reply_id'=>$request->reply_id])->delete();
            $likeCount = DB::table('feed_likes')->where(['feed_id'=>$request->feed_id,'type'=>'comment', 'reply_id'=>0])->get()->count();
        }
       
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

        if(!empty($req->page_type == 'news_feeds')){
            $feed_cmt_data['news_feed_id'] = $req->feed_id;
            DB::table('feed_comment')->insert($feed_cmt_data);
            $where = array('news_feed_id'=>$feed_id);
            $page_type = 'news_feeds';
            // echo 'here'; die;
        }else{
            $feed_cmt_data['feed_id'] = $req->feed_id;
            DB::table('feed_comment')->insert($feed_cmt_data);
            $where = array('feed_id'=>$feed_id);
            $page_type = '';
        }
        
        $lastInsertId = DB::getPdo()->lastInsertId();
        $is_show_all=$req->hid_view_all_comment;
        $uinfo = Auth::guard('users')->user();
        $view =  view('front.feeds.feed_comment_view',compact('feed_id','is_show_all','uinfo','page_type'))->render();
        // echo $view; die;
        $feed_count = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where($where)->orderByDesc('id')->get()->count();

        return response()->json(['success'=>1,'response'=>'Comment successfully.','view'=>$view,'feed_id'=>$feed_id,'feed_count'=>$feed_count]);
    }
}

public function feedPreference(Request $request)
{
    $user_id =  Auth::guard('users')->user()->id;
    $user_role = $user_product_categories = array();
    
    // $userRoles_1 = Role::where('user_id',$user_id)->groupBy('role')->get(['role'])->toArray();
    $userRoles_1 = array();
    $userRoles_2 = FeedPreferenceIama::where('user_id',$user_id)->groupBy('categories')->get(['categories'])->toArray();    
    $userRoles = array_merge($userRoles_1,$userRoles_2);

    if(!empty($userRoles)){
        foreach ($userRoles as $key => $row) {
            if(!empty($row['role'])){
                $userrole[] =  $row['role'];
            }
            if(!empty($row['categories'])){
                $userrole[] =  $row['categories'];
            }
        }
        $user_role = array_unique($userrole);
    }

    // $userProductCategories_1 = ProductCategory::where('user_id',$user_id)->groupBy('category_id')->get(['category_id'])->toArray();
    $userProductCategories_1 = array();
    $userProductCategories_2 = FeedPreferenceIlove::where('user_id',$user_id)->groupBy('categories')->get(['categories'])->toArray();
    $userProductCategories = array_merge($userProductCategories_1,$userProductCategories_2);

    if(!empty($userProductCategories)){
        foreach ($userProductCategories as $key => $row1) {
            if(!empty($row1['category_id'])){
                $userproductcategories[] =  $row1['category_id'];
            }
            if(!empty($row1['categories'])){
                $userproductcategories[] =  $row1['categories'];
            }
        }
        $user_product_categories = array_unique($userproductcategories);
    }

    $roles = UsersUserRole::where('status',1)->get();
    $categories  = Category::where('status',1)->get();
    $view = view('front.feeds.preference',compact('roles','categories','user_role','user_product_categories'))->render();
    return Response::json(['view' => $view]);
}



public function feedPreferenceSearch(Request $request)
{
    // echo '<pre> feedPreferenceSearch - '; print_r($request->all()); die;

    $current_user = get_current_user_info();
    $is_show_all = 0;
    $feed_type = DB::table('feed_type')->get();
    $user_id = $session_id = Auth::guard('users')->user()->id;
    $roles = $user_product_categories = $userPeopleRole = $userCompanyRole = $userProductRole = $userIdProduct =  $new_users = $newfeeds= array();
    array_push($new_users,$user_id);
    $roles = $request->roles;
    $categories = $request->category;
    if(!empty($roles) && count($roles)>0){
        $user_rolePeople = Role::whereIn('role',$roles)->groupBy(['role'])->get(['people_id','company_id','product_id']);
        foreach ($user_rolePeople  as $key => $row2) {
            $userPeopleRole[] = $row2->people_id;
            $userCompanyRole[] = $row2->company_id;
            $userProductRole[] = $row2->product_id;
        }

        FeedPreferenceIama::where(['user_id'=>$current_user->id])->delete();
        foreach($roles as $role){
            $data = [
                'user_id' => $current_user->id,
                'level' => 2,
                'categories' => $role,
            ];    
            $role_data = FeedPreferenceIama::create($data);
            
        }        
    }

    if(!empty($categories) && count($categories)>0){
        $userProduct =  ProductCategory::whereIn('category_id',$categories)->groupBy('category_id')->get(['user_id']);
        foreach ($userProduct as $key => $row3) {
            $userIdProduct[] =  $row3->user_id;
        }

        FeedPreferenceIlove::where(['user_id'=>$current_user->id])->delete();
        foreach($categories as $category){
            $category_data = array(
                'user_id' => $current_user->id,
                'level' => 1,
                'categories' => $category,
            );
            if(!empty($category)){
                FeedPreferenceIlove::updateOrCreate(['categories'=>$category,'user_id'=>$current_user->id], $category_data);
            }else{
                FeedPreferenceIlove::create($category_data);
            }
        }        
    }

    $users = array_unique (array_merge ($userPeopleRole, $userCompanyRole ,$userProductRole,$userIdProduct));
    $feeds = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feeds.user_id')->whereIn('feeds.user_id',$users)->groupBy('feeds.id')->orderByDesc('feeds.id')->get()->toArray();

    // echo '<pre>feeds - '; print_r($feeds); die;

    $view = view('front.feeds.preference_data',compact('feed_type','feeds','session_id','is_show_all'))->render();
    echo json_encode(array('status'=>1,'view'=>$view));
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
        
        if(!empty($request->page_type == 'news_feeds')){
            $data = Feed_comment_like::where(['user_id'=>$user_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type,'news_feed_id'=>$request->feed_id])->first();
        }else{
            $data = Feed_comment_like::where(['user_id'=>$user_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type,'feed_id'=>$request->feed_id])->first();
        }

        
        if($data && !empty($data)) {
            // echo "d"; die;
            Feed_comment_like::where('id',$data->id)->delete();
            $like_type = 0;
            $msg = 'unlike successfully';

            if(!empty($request->page_type == 'news_feeds')){
                $totalReplyLike = Feed_comment_like::where(['news_feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();
            }else{
                $totalReplyLike = Feed_comment_like::where(['feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();
            }
            
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

            if(!empty($request->page_type == 'news_feeds')){
                $dataInsert['news_feed_id'] = $request->feed_id;

                Feed_comment_like::updateOrCreate(['news_feed_id'=>$request->feed_id,'user_id' =>$user_id,'reply_id' =>$request->reply_id], $dataInsert);

                $totalReplyLike = Feed_comment_like::where(['news_feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();
               
            }else{
                $dataInsert['feed_id'] = $request->feed_id;

                Feed_comment_like::updateOrCreate(['feed_id'=>$request->feed_id,'user_id' =>$user_id,'comment_id'=>$request->comment_id,'reply_id' =>$request->reply_id], $dataInsert);

                $totalReplyLike = Feed_comment_like::where(['feed_id'=>$request->feed_id,'comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'type'=>$request->type])->count();
            }

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

public function feedShare($id)
{

  $feeds = Feed::select('feeds.*','users.first_name','users.last_name','users.profile_image','users.slug')->join('users','users.id','=','feeds.user_id')->where('feeds.id',$id)->groupBy('feeds.id')->orderByDesc('feeds.id')->get()->toArray();
  $session_id ='';
  if(Auth::guard('users')->user()){
  $session_id = Auth::guard('users')->user()->id;
  }
  $is_show_all = $offset = $offset_i = $no_User_Offset = 0;
  $limit = $noUserLimit = 20;

    $home_product_data = DB::table('home_page_whatever_days')->join('products','products.id', '=', 'home_page_whatever_days.product_id')->where(['home_page_whatever_days.id'=>@$_GET['home_product_id'],'home_page_whatever_days.status'=> 1])->select('home_page_whatever_days.home_caption_one','home_page_whatever_days.home_caption_two','home_page_whatever_days.id','products.main_image','products.slug')->orderBy('home_page_whatever_days.id','desc')->first();	

    $dictionary_detail = Dictionary::where(['id'=>@$_GET['word_id'],'status'=>1])->get();
    $arr_dictionary_data = UtilitiesFour::getDictionaryFieldsData($dictionary_detail);

    $question_detail = Question::where(['id'=>@$_GET['question_detail'],'status'=>1])->with(['user'])->get();
    
    $quiz_question_detail = QuizQuestion::where('status', 1)->where('id', @$_GET['quiz_question_detail'])->with(['user'])->get();
    
//   echo '<pre>feeds - '; print_r($feeds); die;
  return view('front.feeds.feed_meta',compact('feeds','session_id','is_show_all','offset','offset_i','no_User_Offset','limit','noUserLimit','dictionary_detail','arr_dictionary_data','home_product_data','question_detail','quiz_question_detail'));
}

public function new_post_type(Request $request)
{
    // echo '<pre>new_post_type - '; print_r($request->all()); die;
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
      $feeds = array();
      $request_type = '';
      if(!empty($request->request_type_id)){
        $feeds = Feed::where('id',$request->request_type_id)->first();
        $request_type = 'feed_edit';
      }
      $view = view('front.feeds.'.$view_type,compact('products','view_type','feeds','request_type'))->render();
      echo json_encode(array('view'=>$view,'type'=>$type,'title_type'=>$title_type));
}



  public function croppieIndex()
    {

   return view('front.feeds.croppie');
   
    }
   
    public function croppieUploadCropImage(Request $request)
    {
        // pr($request->all()); die;
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
 
/******** || Shubham Code Start ||  ********/  

    public function feedTruthData(Request $request)
    {
        // echo '<pre>feedTruthData - '; print_r($request->all()); die;

        $uinfo = Auth::guard('users')->user();
        if(!isset($uinfo) && empty($uinfo->id)){
            $feedform_view = view('front.feeds.not_logged_user')->render();
            echo json_encode(array('status'=>0,'view'=>$feedform_view)); die;
        }

        $user_id = $uinfo->id;

        if($request->quiz_type == 'truth_quiz_play'){
            $rules = [
                // 'question_id' => 'required',       
                'quiz_id' => 'required'
            ];
            $niceNames = [
                // 'question_id' => 'Question',
                'quiz_id' => 'Quiz',   				
            ];	
            $this->validate($request, $rules, [], $niceNames);
        }
        try {

            $current_user = @get_current_user_info();

            if($request->quiz_type == 'truth_quiz_play'){
                $quiz_data = $request->only(QuizApplication::$fillable_shadow);
                
                if(!empty($current_user->id)){
                $quiz_data['applicant_user_id'] = $current_user->id;
                }else{
                $quiz_data['applicant_user_id'] = 0;	
                }
                
                $quiz_data['quiz_id'] = $request->quiz_id;
                $quiz_data['ques_id'] = $request->question_id;
                
                if($request->which_is_lie == $request->question_id){
                $quiz_data['is_lie'] = 1;	
                }else{
                $quiz_data['is_lie'] = 0;	
                }
                
                $quiz_data['status'] = 1;
                
                QuizApplication::updateOrCreate(['id' => 0], $quiz_data);

                $question_detail = Question::where('status', 1)
                ->with(['user'])
                ->inRandomOrder()
                ->limit(10)
                ->get();
            }elseif($request->quiz_type == 'quiz_play'){

                $quiz_id = Quiz::where('status', 1)->inRandomOrder()->get()->toArray();
                shuffle($quiz_id);
                // echo "<pre>quiz_id - "; print_r($quiz_id); die;
                $question_detail = QuizQuestion::where('status', 1)->where('quiz_id', $quiz_id[0]['id'])
                ->with(['user'])
                ->inRandomOrder()
                ->limit(10)
                ->get();
                // echo "<pre>"; print_r($question_detail); //die;
                // echo "<pre>question_detail"; print_r($question_detail->toArray()); die;
                
                if(!empty($question_detail[0]->id)){
                    $quiz_data = Quiz::where('id',$quiz_id[0]['id'])->first();	
                }else{
                    $this->feedTruthData($request); die;
                }
                
            }
            $feed_quiz_type = $request->quiz_type;

            $feed_truth_view = view('front.feeds.side_bar_content_feed',compact('user_id','question_detail','feed_quiz_type','quiz_data'))->render();
            // echo $feed_truth_view; die;
            if($request->quiz_type == 'truth_quiz_play'){
                echo json_encode(array('status'=>1,'view'=>$feed_truth_view));
            }elseif($request->quiz_type == 'quiz_play'){
                echo json_encode(array('status'=>2,'view'=>$feed_truth_view));
            }

        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
        
    }

    public function feedActionType(Request $request){
        // echo '<pre>feedActionType - '; print_r($request->all()); die;

        if($request->action_type == 'remove'){
            
            $image_data = Feed::where('id', $request->id)->first();			
            if(Feed::where('id', $request->id)->delete()){

                $file_path = 'uploads/images/feed/'.$image_data->image;
                $image_path = public_path($file_path);
                if(file_exists($image_path)) {
                    // File::delete($image_path);
                }
                echo json_encode(array('status'=>1,'msg'=>'Feed removed successfully'));
            }

            if($image_data->type == 1 || $image_data->type == 2){
                Gallery::where('feed_id', $request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 3){
                Blog::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 4){
                MediaList::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 5){
                Product::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 6){
                Classified::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }

        }elseif($request->action_type == 'delete'){
            $image_data = Feed::where('id', $request->id)->first();			
            $gallery_Image_data = Gallery::where('feed_id', $request->id)->first();		
            if($image_data->type == 1 || $image_data->type == 2){
                if(Gallery::where('feed_id', $request->id)->delete()){ 
    
                    $file_path = 'uploads/images/gallery/photos/'.$gallery_Image_data->media;
                    $image_path = public_path($file_path);
                    if(file_exists($image_path)) {
                        // File::delete($image_path);
                    }
                    
                }
            }else if($image_data->type == 3){
                // Blog::where('feed_id',$request->id)->delete();
                Blog::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 4){
                MediaList::where('feed_id',$request->id)->delete();
            }else if($image_data->type == 5){
                // Product::where('feed_id',$request->id)->delete();
                Product::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }else if($image_data->type == 6){
                // Classified::where('feed_id',$request->id)->delete();
                Classified::where('feed_id',$request->id)->update(['feed_id'=>'0']);
            }

            if(Feed::where('id', $request->id)->delete()){
                
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
            $action_url = route('front.feeds.feed_action_type');
            $view = view('front.feeds.feed_report_form',compact('report_labels','feed_id','action_url'))->render();
            echo json_encode(array('status'=>2,'view'=>$view));

        }elseif($request->action_type == 'feed_report_submit'){
            $feed_data = Feed::where('id',$request->feed_id)->first();
            $user_ids = Auth::guard('users')->user();
            if(empty( $user_ids->id)){
                echo json_encode(array('status'=>0,'url'=>'login')); die;
            }
            $user_id = $user_ids->id;

            $feeds_report_data = array(
                'user_id' => $user_id,
                'type' => 1,    //  1 -> Home Feeds, 2 -> News-Feeds
                'feed_user' => $feed_data->user_id,
                'feed_id' => $request->feed_id,
                'reason' => $request->reason,
                'description' => $request->description,
                'created_at' =>time(),
            );
            DB::table('feeds_report_save')->insert($feeds_report_data);
            echo json_encode(array('status'=>3,'msg'=>'Report added successfully'));
        }
    }

    public function userFeedUpdate(Request $request,$slug,$id){
        // echo "<pre>userFeedUpdate $slug - $id - "; print_r($request->all()); die;

        if($slug == 'blog'){
            $blog_data = Blog::where('feed_id',$id)->first();
            return redirect('/user/blog/update/'.$blog_data->slug);
        }elseif($slug == 'media'){
            $media_data = MediaList::where('feed_id',$id)->orderBy('id','Desc')->first();
            if(empty($media_data->id)){
                $media_data = Feed::where('id',$id)->first();
                return redirect('/user/media-update/'.$media_data->id); die;
            }
            // echo '<pre>media_data - '; print_r($media_data->toArray()); die;
            return redirect('/user/media/update/'.$media_data->id);
        }elseif($slug == 'classified'){
            $classified_data = Classified::where('feed_id',$id)->first();
            return redirect('/user/classified/update/'.$classified_data->slug);
        }elseif($slug == 'product'){
            $product_data = Product::where('feed_id',$id)->first();
            return redirect('/user/product/update/'.$product_data->slug);
        }
    }

    public function feed_check(){
        return view('front.feeds.feed_test');
    }

    public function trivia_quiz_questions(){
        $quiz_data = '';
        $cnt_quiz_id = $quiz_id = Quiz::where('status', 1)->get()->toArray();
        shuffle($quiz_id);
        // echo "<pre>quiz_id - "; print_r($quiz_id); die;
        if(empty($quiz_id[0]['id'])){
            $this->trivia_quiz_questions(); die;
        }
        for($i=0; $i<count($cnt_quiz_id); $i++){
            $quiz_question_detail = QuizQuestion::where('status', 1)->where('quiz_id', $quiz_id[$i]['id'])
            ->with(['user'])
            ->inRandomOrder()
            ->limit(10)
            ->get();
            // echo "<pre>"; print_r($quiz_question_detail); die;
            if(!empty($quiz_question_detail[$i]->id)){
                $quiz_data = Quiz::where('id',$quiz_id[0]['id'])->first();
                if(empty($quiz_data->toArray())){
                    $this->trivia_quiz_questions();
                }else{
                    $quizData['quiz_data'] = $quiz_data;
                    $quizData['quiz_question_detail'] = $quiz_question_detail;
                    // echo "<pre>quizData - "; print_r($quizData); die;
                    return $quizData; die;
                    break;
                }
            }else{
                $this->trivia_quiz_questions();
            }
        }
    }

    public function newsFeeds(Request $request){
        
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

        $qry = NewsFeeds::select('feeds_news.*','users.first_name','users.last_name','users.profile_image','users.slug','users.role as userRole','users.is_front_admin_user','blogs.id as blog_id','blogs.slug as blog_slug','feeds_categories.name as category_name')->join('users','users.id','=','feeds_news.user_id')->leftJoin('blogs','blogs.feed_id','=','feeds_news.id')->leftJoin('feeds_categories','feeds_categories.id','=','feeds_news.category_id')->where('feeds_news.pop_feed_position',0)->where('feeds_news.category_id','!=',0)->groupBy('feeds_news.id')->orderByDesc('feeds_news.time')->offset($offset * $limit)->limit($limit);
        if(!empty($request->datepicker) && !empty($request->is_date_select == 1)){
            $date = explode('-',$request->datepicker);
            $from = date('Y-m-d H:i:s',strtotime($date[0]));
            $to = date('Y-m-d H:i:s',strtotime($date[1]));
            
            $qry->whereDate('feeds_news.created_at','<=', $to);
            $qry->whereDate('feeds_news.created_at','>=', $from);
        }
        if(!empty($request->category_filter)){
            $qry->whereIn('feeds_news.category_id',$request->category_filter);
        }
        $newfeeds1 = $qry->get()->toArray();
        
        // dd(DB::getQueryLog()); die;

        $count_feeds1 = NewsFeeds::select('feeds_news.*','users.first_name','users.last_name','users.profile_image','users.slug','users.is_front_admin_user')->join('users','users.id','=','feeds_news.user_id')->where('feeds_news.pop_feed_position',0)->where('feeds_news.category_id','!=',0)->groupBy('feeds_news.id')->orderByDesc('feeds_news.time')->get()->toArray();

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
        if(!empty($request->page_scroll == 'yes')){
            $offset = $offset+1;
            $offset_i+1;
            $feed_scroll_view = view('front.feeds.news_feeds_page_scroll',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page'))->render();
            // echo $feed_scroll_view; die;
            echo json_encode(array('status'=>1,'view'=>$feed_scroll_view,'offset'=>$offset,'noUserOffset'=>$no_User_Offset,'cnt_feeds'=>$cnt_feeds,'countFeeds'=>count($countFeeds)));
        }else if(!empty($request->filter_type == 'yes')){
            $feed_scroll_view = view('front.feeds.news_feeds_page_scroll',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page'))->render();
            // echo $feed_scroll_view; die;
            $res = array('status'=>1,'view'=>$feed_scroll_view,'offset'=>$offset,'noUserOffset'=>$no_User_Offset,'cnt_feeds'=>$cnt_feeds,'countFeeds'=>count($countFeeds));
            return $res;
        }else{
            return view('front.feeds.news_feeds',compact('feeds','session_id','is_show_all','countFeeds','offset','offset_i','no_User_Offset','uinfo','feeds_ad','feedsCategorys','page_type','featured_news_feeds','is_front_page'));
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
        
        $view = view('front.feeds.submit_news_feeds_form',$data)->render();
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
            return response()->json(['status'=>1,'message'=>'Posted Successfully.']);
        }
    }

    public function getOgProperty(Request $request){
        // echo '<pre>request - '; print_r($request->all()); die;
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        
        $site_html=  @file_get_contents($request->url,false,$context);
        $matches=null;
        preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i',$site_html,$matches);
        $ogtags=array();
        for($i=0;$i<count(@$matches[1]);$i++){
            $ogtags[$matches[1][$i]]=$matches[2][$i];
        }
        // pr($ogtags); die;
        if(!empty($ogtags)){
            return response()->json(['success'=>1,'title'=>@$ogtags['og:title'],'caption'=>@$ogtags['og:description'],'image'=>@$ogtags['og:image']]);
        }else{
            return response()->json(['success'=>0,'msg'=>'Please enter valid url']);
        }
    }

    public function feed_comment_like_user(Request $request){
        // pr($request->all()); die;

        if(!empty($request->like_type == 'feed_like')){
            $datas = Feed_like::where(['feed_id'=>$request->feed_id])->select('feed_likes.*','users.first_name','users.last_name','users.type_of_user','users.role','users.profile_image','users.slug')->leftJoin('users','users.id','=','feed_likes.user_id')->get();
        }else{
            $datas = Feed_comment_like::where(['comment_id'=>$request->comment_id,'reply_id'=>$request->reply_id,'feed_id'=>$request->feed_id])->select('feed_comment_like.*','users.first_name','users.last_name','users.type_of_user','users.role','users.profile_image','users.slug')->leftJoin('users','users.id','=','feed_comment_like.user_id')->get();
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
    

/******** || Shubham Code End ||  ********/

}
