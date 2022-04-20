<?php

namespace App\Http\Controllers\Front;

use App\Models\Rip;
use App\Models\RipCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class RipController extends Controller
{
    public function getCategoryWiki()
    {

        $data = RipCategory::join('rips','rips.category_id','=','rip_categories.id')->select('rip_categories.*')->where('rip_categories.status',1)->orderBy('name','DESC')->groupBy('rip_categories.id')->get();

         foreach ($data as $key => $row) {
            $data[$key]->wiki = Rip::where(['status'=>1,'category_id'=>$row->id])->get()->take(6);
         }

        $categories = RipCategory::where('status',1)->orderBy('name','DESC')->get();
        // echo '<pre>categories - '; print_r($categories->toArray()); die;
        return view('front.pages.wiki.index',compact('data','categories'));
    }

     public function getWikiList($slug)
     {
        $category = RipCategory::where('slug',$slug)->orderBy('name','DESC')->first();
        $categories = RipCategory::where('status',1)->orderBy('name','DESC')->get();
        $data = Rip::where(['status'=>1,'category_id'=>$category->id])->paginate(10);
         return view('front.pages.wiki.list',compact('data','category','categories'));
     }

}
