<?php

namespace App\Http\Controllers\Front;

use App\Models\Wiki;
use App\Models\Meme;
use App\Models\WikiCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Response;

use Session;

class WikiController extends Controller
{
    public function getCategoryWiki()
    {
        $data = WikiCategory::join('wikis','wikis.category_id','=','wiki_categories.id')->select('wiki_categories.*')->where('wiki_categories.status',1)->groupBy('wiki_categories.id')->get();
         foreach ($data as $key => $row) {
            $data[$key]->wiki = Wiki::where(['status'=>1,'category_id'=>$row->id])->orderBy('id','DESC')->get()->take(6);
         }
         $categories = WikiCategory::where('status',1)->get();
        return view('front.pages.wiki.index',compact('data','categories'));
    }

     public function getWikiList($slug)
     {
        $category = WikiCategory::where('slug',$slug)->first();
        $categories = WikiCategory::get();
        $data = Wiki::where(['status'=>1,'category_id'=>@$category->id])->with(['user'])->orderBy('id','DESC')->paginate(10);
         return view('front.pages.wiki.list',compact('data','category','categories'));
     }


 public function test_mail()
    {

        // echo Hash::make(123456); die;
       //***** || Mail || ***** //
            // $orderInfo =  Order::where('id',$decResponse['order_id'])->first();
            // // echo "sdsa"; die;
            // $userInfo = User::where('id',$orderInfo['user_id'])->first();
        $new_otp =123456;
        $to_name = 'Harshpal';
        $to_email = 'shubham16.sws@gmail.com';
        $data = array("username" => $to_name);
        $message ="";
        $subject = "User $to_name has ready for payment.";
        
        $moduleController = new ModuleController();
        $view = view('mail.auth.make_payment', $data)->render();
        echo $view; die;

        Mail::send('mail.text_mail', $data, function($message) use ($to_name, $to_email,$subject) {
             $message->from('info@peopleofplay.com',env('MAIL_FROM_NAME'));
        $message->to($to_email, $to_name)
        ->subject($subject);
        
        });

         echo "ds"; die;
            //***** || Mail || ***** //
    }

     public function memeModel(Request $request)
{
  $str_current_date = date('Y-m-d');
  $current_id = $request->id;
  $data = Meme::where('date','<=',$str_current_date)->get();
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
