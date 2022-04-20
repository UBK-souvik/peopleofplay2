<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tag;
use App\Models\Feed;
use App\Helpers\UtilitiesFour;
use App\Models\FeedAd;
use App\Models\NewsFeeds;
use App\Models\FeedsCategory;
use App\Models\BloomReport;
use Session;
use Validator;
use Auth;
use Response;
use File;
use URL;

class BloomController extends Controller
{

    public function index(Request $request)
    { 
        $bloom_welcome_reports = BloomReport::where('section_type','welcome')->first();
        $bloom_person_reports = BloomReport::where('section_type','person')->first();
        $bloom_news_reports = BloomReport::select('bloom_reports.*','feeds_categories.name as cat_name')->leftJoin('feeds_categories','feeds_categories.id','=','bloom_reports.category_id')->where('section_type','news')->orderBy('bloom_reports.category_id','Desc')->orderBy('bloom_reports.created_at','Desc')->get();

        $bloomReports = BloomReport::where('section_type','!=','news')->get();

        $bloomReport = array();
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

        // pr($bloom_reports->toArray()); 
        // pr($bloom_news_reports->toArray()); 
        // die;

        return view('front.bloom_reports.index',compact('bloomReport','bloom_news_reports'));
    }
    

/******** || Shubham Code End ||  ********/

}
