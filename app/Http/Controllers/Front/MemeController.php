<?php

namespace App\Http\Controllers\Front;

use App\Models\Meme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Response;
use Session;

class MemeController extends Controller
{
  

public function memeModel(Request $request)
    {
      $str_current_date = date('Y-m-d');
      $current_id = $request->id;
      $data = Meme::where('date','<=',$str_current_date)->where('is_seen',1)->orderBy('id','DESC')->get();

      // echo '<pre>data - '; print_r($data->toArray()); die;
      $view = view('front.pages.meme',compact('data','current_id'))->render();
      return Response::json(['view' => $view]);
    }

public function memeDetails($id)
    {
      $meme = Meme::where('id',$id)->first();
      $str_og_image_new = url('/'). @imageBasePath($meme->featured_image);
      return view('front.pages.meme_details',compact('meme','str_og_image_new'));
    }

}
