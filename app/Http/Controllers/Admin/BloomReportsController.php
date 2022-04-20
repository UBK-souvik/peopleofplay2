<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FeedsCategory;
use App\Models\RipCategory;
use App\Models\BloomReport;
use App\Models\BloomAdsImages;
use App\Models\NewsFeeds;
use App\Models\Feed;
use App\Helpers\UtilitiesFour;
use DB;

class BloomReportsController extends Controller
{
    public function index()
    {
        return view('admin.bloom_reports.index');
    }

    public function getAdvtImageList(Request $request)
    {
        // pr($request->all()); die;
        $settings = BloomAdsImages::select('bloom_ads_images.*','feeds_categories.name as cat_name')->leftJoin('feeds_categories','feeds_categories.id','=','bloom_ads_images.category_id')->where('slug',$request->slug)->orderBy('id','DESC')->get();
        return \DataTables::of($settings)
        ->addIndexColumn()
        ->make();
    }

    public function getList(Request $request)
    {
        
        // pr($request->all()); die;
        $bloom_reports = new BloomReport();
        $where = array('slug'=>$request->slug,'section_type'=>$request->page_type);
        $settings = $bloom_reports->where($where)->orderBy('id','DESC')->get();
        return \DataTables::of($settings)
        ->addIndexColumn()
        ->make();
    }

    public function getWeeklyReportList(Request $request)
    {
        // pr($request->all()); die;
        $bloom_reports = new BloomReport();
        $settings = $bloom_reports->groupBy('week_range')->orderBy('id','DESC')->get();
        return \DataTables::of($settings)
        ->addIndexColumn()
        ->editColumn('week_range', function ($query) {
            return 'The Bloom Weekly Report - '.$query->week_range;
        })
        ->make();
    }

    public function getCreate(Request $request){

        $categorys = FeedsCategory::get();
        // $welcome_section = BloomReport::where('section_type','welcome')->first();
        // $person_section = BloomReport::where('section_type','person')->first();        
        // $bloomReports = BloomReport::where('section_type','!=','news')->get();
        $bloomReports = '';

        if(!empty(@$request->report_range)){
            $this->getUpdate(@$request); die;
        }
        $request_type = 'welcome';
        $weeks['previous_week'] = date('d-m-Y',strtotime('previous friday'));
        $weeks['current_week'] = date('d-m-Y',strtotime('this friday'));
        $weeks['next_week'] = date('d-m-Y',strtotime('next friday'));
        $weeks['today'] = date('d-m-Y');

        if($weeks['current_week'] < $weeks['today'] ){
            $week_range = date('M d',strtotime($weeks['previous_week'])).' - '.date('d',strtotime($weeks['current_week'].' -1day')).', '.date('Y');
            $week_range_slug = strtolower(date('M-d',strtotime($weeks['previous_week'])).'-'.date('d',strtotime($weeks['current_week'].' -1day')).'-'.date('Y'));
        }else{
            $week_range = date('M d',strtotime($weeks['current_week'])).' - '.date('d',strtotime($weeks['next_week'].' -1day')).', '.date('Y');
            $week_range_slug = strtolower(date('M-d',strtotime($weeks['current_week'])).'-'.date('d',strtotime($weeks['next_week'].' -1day')).'-'.date('Y'));
        }
        
        $upcoming_weeks['0']['week_range'] = $week_range;
        $upcoming_weeks['0']['week_range_slug'] = $week_range_slug;

        $upcoming_weeks['1']['week_range'] = date('M d',strtotime($weeks['next_week'])).' - '.date('d',strtotime($weeks['next_week'].'+6days')).', '.date('Y');
        $upcoming_weeks['1']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'])).'-'.date('d',strtotime($weeks['next_week'].'+6days')).'-'.date('Y'));

        $upcoming_weeks['2']['week_range'] = date('M d',strtotime($weeks['next_week'].'+7days')).' - '.date('d',strtotime($weeks['next_week'].'+13days')).', '.date('Y');
        $upcoming_weeks['2']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+7days')).'-'.date('d',strtotime($weeks['next_week'].'+13days')).'-'.date('Y'));

        $upcoming_weeks['3']['week_range'] = date('M d',strtotime($weeks['next_week'].'+14days')).' - '.date('d',strtotime($weeks['next_week'].'+20days')).', '.date('Y');
        $upcoming_weeks['3']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+14days')).'-'.date('d',strtotime($weeks['next_week'].'+20days')).'-'.date('Y'));

        $upcoming_weeks['4']['week_range'] = date('M d',strtotime($weeks['next_week'].'+21days')).' - '.date('d',strtotime($weeks['next_week'].'+27days')).', '.date('Y');
        $upcoming_weeks['4']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+21days')).'-'.date('d',strtotime($weeks['next_week'].'+27days')).'-'.date('Y'));


        // pr($upcoming_weeks); die;
        return view('admin.bloom_reports.create', compact('categorys','request_type','bloomReports','upcoming_weeks','week_range'));
    }

    public function getUpdate($request){
        
        if(!empty(@$request->type)){
            $request_type = @$request->type;
        }else{
            $request_type = 'welcome';
        }
        $categorys = FeedsCategory::get();
        // $welcome_section = BloomReport::where(['section_type'=>'welcome'])->first();
        // $person_section = BloomReport::where(['section_type'=>'person'])->first();    
        // $bloomReports = BloomReport::where('id',@$request->id)->where('section_type','!=','news')->get();
        $report_range = @$request->report_range;
        $bloomReports = BloomReport::where('slug',@$request->report_range)->where('section_type','!=','news')->get();
        $where = array('id'=>@$request->id,'section_type'=>'news');
        $news_section = BloomReport::where($where)->first();
        $bloomAdsImages = BloomAdsImages::select('bloom_ads_images.*','feeds_categories.name as cat_name')->leftJoin('feeds_categories','feeds_categories.id','=','bloom_ads_images.category_id')->where('bloom_ads_images.id',@$request->id)->orderBy('id','DESC')->first();
        
        $weeks['previous_week'] = date('d-m-Y',strtotime('previous friday'));
        $weeks['current_week'] = date('d-m-Y',strtotime('this friday'));
        $weeks['next_week'] = date('d-m-Y',strtotime('next friday'));
        $weeks['today'] = date('d-m-Y');

        if($weeks['current_week'] < $weeks['today'] ){
            $week_range = date('M d',strtotime($weeks['previous_week'])).' - '.date('d',strtotime($weeks['current_week'].' -1day')).', '.date('Y');
            $week_range_slug = strtolower(date('M-d',strtotime($weeks['previous_week'])).'-'.date('d',strtotime($weeks['current_week'].' -1day')).'-'.date('Y'));
        }else{
            $week_range = date('M d',strtotime($weeks['current_week'])).' - '.date('d',strtotime($weeks['next_week'])).', '.date('Y');
            $week_range_slug = strtolower(date('M-d',strtotime($weeks['current_week'])).'-'.date('d',strtotime($weeks['next_week'])).'-'.date('Y'));
        }
        
        foreach($bloomReports as $bloom_Report){
            if($bloom_Report->section_type == 'welcome'){
                $bloomReport['welcome'] = $bloom_Report;
            }if($bloom_Report->section_type == 'person'){
                $bloomReport['person'] = $bloom_Report;
            }if($bloom_Report->section_type == 'weekly_stories'){
                $bloomReport['weekly_stories'] = $bloom_Report;
            }if($bloom_Report->section_type == 'video_week'){
                $bloomReport['video_week'] = $bloom_Report;
            }
        }
        
        $date_exp = explode('-',$bloomReports[0]->slug);
        if(date('d') > $date_exp[2]){
            $upcoming_weeks['0']['week_range'] = ucfirst($date_exp[0].' '.$date_exp[1].' - '.$date_exp[2].', '.$date_exp[3]);
            $upcoming_weeks['0']['week_range_slug'] = $date_exp[0].'-'.$date_exp[1].'-'.$date_exp[2].'-'.$date_exp[3];
        }else{
            $upcoming_weeks['0']['week_range'] = '';
            $upcoming_weeks['0']['week_range_slug'] = '';     
        }

        $upcoming_weeks['1']['week_range'] = $week_range;
        $upcoming_weeks['1']['week_range_slug'] = $week_range_slug;

        $upcoming_weeks['2']['week_range'] = date('M d',strtotime($weeks['next_week'])).' - '.date('d',strtotime($weeks['next_week'].'+6days')).', '.date('Y');
        $upcoming_weeks['2']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'])).'-'.date('d',strtotime($weeks['next_week'].'+6days')).'-'.date('Y'));

        $upcoming_weeks['3']['week_range'] = date('M d',strtotime($weeks['next_week'].'+7days')).' - '.date('d',strtotime($weeks['next_week'].'+13days')).', '.date('Y');
        $upcoming_weeks['3']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+7days')).'-'.date('d',strtotime($weeks['next_week'].'+13days')).'-'.date('Y'));

        $upcoming_weeks['4']['week_range'] = date('M d',strtotime($weeks['next_week'].'+14days')).' - '.date('d',strtotime($weeks['next_week'].'+20days')).', '.date('Y');
        $upcoming_weeks['4']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+14days')).'-'.date('d',strtotime($weeks['next_week'].'+20days')).'-'.date('Y'));

        $upcoming_weeks['5']['week_range'] = date('M d',strtotime($weeks['next_week'].'+21days')).' - '.date('d',strtotime($weeks['next_week'].'+27days')).', '.date('Y');
        $upcoming_weeks['5']['week_range_slug'] = strtolower(date('M-d',strtotime($weeks['next_week'].'+21days')).'-'.date('d',strtotime($weeks['next_week'].'+27days')).'-'.date('Y'));

        // pr($bloomReports->toArray()); die;

        echo view('admin.bloom_reports.update', compact('categorys','news_section','request_type','bloomReport','bloomAdsImages','upcoming_weeks','week_range','report_range')); 
    }
    
    public function postSubmit(Request $request){
        
        // pr($request->all()); die;

        $categorys = FeedsCategory::get();
        if($request->section_type == 'welcome' || $request->section_type == 'person'){
            $request->validate([
                'heading' => 'required',
                'date' => 'required',
                'description' => 'required',
            ]);
        }elseif($request->section_type == 'weekly_stories'){
            $request->validate([
                'description' => 'required',
            ]);            
        }elseif($request->section_type == 'video_week'){
            $request->validate([
                'video_url' => 'required',
            ]);            
        }elseif($request->section_type == 'advt_image'){
            $arr = array();
            if(empty($request->is_image)){
                $arr['featured_image'] = 'required';
            }
            $arr['category'] = 'required';
            $request->validate($arr);            
        }else{
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'date' => 'required',
                'submitted_by' => 'required',
                'url' => 'required',
            ]);
        }
        try {
            
            $bloom_reports = new BloomReport();
            if($request->section_type == 'welcome' || $request->section_type == 'person'){
                $data = array(
                    'section_type' => $request->section_type,
                    'title' => $request->heading,
                    'sub_heading' => $request->sub_heading,
                    'caption' => $request->description,
                    'date' => $request->date,
                    'slug' => $request->week_range_slug,
                    'week_range' => ucfirst($request->week_range_slug),
                    'is_featured' => $request->featured_block,
                    'created_at' => time(),
                    'updated_at' => time()
                );
                if(!empty($request->id)){
                    $where  = ['id'=>$request->id,'slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }else{
                    $where  = ['slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }
            }elseif($request->section_type == 'weekly_stories'){
                $data = array(
                    'section_type' => $request->section_type,
                    'caption' => $request->description,
                    'slug' => $request->week_range_slug,
                    'week_range' => ucfirst($request->week_range_slug),
                    'created_at' => time(),
                    'updated_at' => time()
                );
                if(!empty($request->id)){
                    $where  = ['id'=>$request->id,'slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }else{
                    $where  = ['slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }
            }elseif($request->section_type == 'video_week'){
                $data = array(
                    'video_url' => $request->video_url,
                    'slug' => $request->week_range_slug,
                    'week_range' => ucfirst($request->week_range_slug),
                    'created_at' => time(),
                    'updated_at' => time()
                );
                if(!empty($request->id)){
                    $where  = ['id'=>$request->id,'slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }else{
                    $where  = ['slug' => $request->week_range_slug,'section_type'=>$request->section_type];
                }
            }elseif($request->section_type == 'advt_image'){
                $bloom_reports = new BloomAdsImages();
                $data = array(
                    'category_id' => $request->category,
                    'slug' => $request->week_range_slug,
                    'created_at' => time(),
                    'updated_at' => time()
                );
                $where  = ['id'=>$request->id];
            }else{

                $data = array(
                    'section_type' => $request->section_type,
                    'title' => $request->title,
                    'url' => $request->url,
                    'category_id' => $request->category,
                    'caption' => $request->caption,
                    'date' => $request->date,
                    'slug' => $request->week_range_slug,
                    'week_range' => ucfirst($request->week_range_slug),
                    'submitted_by' => $request->submitted_by,
                    'video_url' => $request->video_url,
                    'image' => $request->type,
                    'created_at' => time(),
                    'updated_at' => time()
                );
                if(!empty($request->add_to_feeds == 'on')){
                    $data['is_home_feed'] = 1;
                }
                if(!empty($request->add_to_news_feeds == 'on')){
                    $data['is_news_feed'] = 1;
                }
                $where  = ['id'=>$request->id,'slug' => $request->week_range_slug,'section_type'=>$request->section_type];

                
                $user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();
            
                $feed_data = array(
                    'user_id' => $user_id->id,
                    'title' => $request->title,
                    'category_id' => $request->category,
                    'caption' => $request->caption,
                    'time' => time()
                );
            }

            if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = 'uploads/images/bloom_reports/';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){   
                            $feed_data['type'] = 1;   
                            $data['image'] = $filename;
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

                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$request->video_url, $match);
                UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);

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
            
            // echo "<pre>where - "; print_r($where); die;
            // echo "<pre>data - "; print_r($data); die;

            $bloom_id = $bloom_reports->updateOrCreate($where,$data);  

            if(!empty($request->add_to_news_feeds == 'on')){
                $feed_data['news_feeds_bloom_id'] = $bloom_id->id;
                // echo '<pre>news_feed_data - '; print_r($feed_data); //die;
                NewsFeeds::updateOrCreate(['news_feeds_bloom_id'=>$bloom_id->id],$feed_data);            
            }
            
            if(!empty($request->add_to_feeds == 'on')){
                $feedData['category_id'] = '';
                $feedData['feeds_bloom_id'] = $bloom_id->id;
                // echo '<pre>feedData - '; print_r($feedData); //die;
                Feed::updateOrCreate(['feeds_bloom_id'=>$bloom_id->id],$feedData);
            } 
            
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
                'url' => url("admin/bloom_reports_test_create").'?report_range='.$request->week_range_slug,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
    
}
