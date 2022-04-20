<?php

namespace App\Http\Controllers\Front;

use App\Models\Entertainment;
use App\Models\EntertainmentCategory;
use App\Models\EventHeader;
use App\Models\EventDescription;
use App\Models\EventBanner;
use App\Models\EventYear;
use App\Models\DescriptionHeader;
use App\Models\ProfileHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class MarketingPrController extends Controller
{
    public function getEntertainment()
    {
        $data = EntertainmentCategory::join('entertainments','entertainments.category_id','=','entertainment_categories.id')->select('entertainment_categories.*')->where('entertainment_categories.status',1)->where('entertainment_categories.type','entertainment')->groupBy('entertainment_categories.id')->get();
         foreach ($data as $key => $row) {
            $data[$key]->wiki = Entertainment::where(['status'=>1,'category_id'=>$row->id])->orderBy('id','DESC')->get()->take(6);
         }

         $categories = EntertainmentCategory::where(['status'=>1,'type'=>'entertainment'])->get();
        return view('front.pages.wiki.index',compact('data','categories'));
    }

     public function getEntertainmentList($slug)
     {
        $category = EntertainmentCategory::where('slug',$slug)->first();
        $categories = EntertainmentCategory::where('type','entertainment')->get();
        $data = Entertainment::where(['status'=>1,'category_id'=>$category->id])->paginate(10);
         return view('front.pages.wiki.list',compact('data','category','categories'));
     }


   public function getCast()
    {

        $data = EventYear::all();
        $header = EventHeader::all();
        $profileHeader = ProfileHeader::all();
        $eventBanner = EventBanner::all();
        $eventDescription = EventDescription::all();
        $descriptionHeader = DescriptionHeader::all();

        // echo "<pre>";
        // print_r($header);exit;
        // foreach ($data as $key => $row) {
        //     $data[$key]->wiki = Entertainment::where(['status'=>1,'category_id'=>$row->id])->orderBy('id','DESC')->get()->take(6);
        //  }
         $categories = EntertainmentCategory::where(['status'=>1,'type'=>'cast'])->get();
        return view('front.prevent.pr_event',compact('data','header','profileHeader','eventBanner','eventDescription','descriptionHeader'));
    }

     public function getCastList($slug)
     {
        $category = EntertainmentCategory::where('slug',$slug)->first();
        $categories = EntertainmentCategory::where('type','cast')->get();
        $data = Entertainment::where(['status'=>1,'category_id'=>$category->id])->orderBy('id','DESC')->paginate(10);
         return view('front.pages.wiki.list',compact('data','category','categories'));
     }

}
