<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use DB;
use Session;
use Validator;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Helpers\Common_helper;
use App\Models\User;
use App\Models\Admin;
use App\Helpers\Utilities;

class SalesController extends Controller
{
  public function index($slug=''){
      return view("front/sales/sales");
  }

  public function sales_login(Request $request){

      if(!empty($request->input_pin)){
          $user = Admin::where('pin',$request->input_pin)->first();

          if(!empty($user))
          {
              return redirect('sales/reports');
          }
          else {
            return back();
          }
      }
  }
  
  public function get_product_forms($type){
	  
	  if($type == 1)
	  {
		  $str_date =  date('Y-m-d'); 
	  }
	  
	  if($type == 2)
	  {
		  $str_date =  date('Y-m-d',strtotime("-1 days")); 
	  }
	  
  
  $str_reports  = ProductForm::whereDate('product_forms.created_at', $str_date)
                  ->where('payment_id', '!=', null)
                  ->select('product_forms.*', DB::raw('count(*) as total'))
				  ->groupBy('product_forms.id')
                  ->get();
				  
	return $str_reports;			  
  } 

  public function sales_reports(Request $request){
      $today = date('Y-m-d');
      $yesterday = date('Y-m-d',strtotime("-1 days"));
	  
	  //DB::enableQueryLog();


      $today_reports =DB::table('user_subscriptions')
                      ->join('users','users.id', '=', 'user_subscriptions.user_id')
					  ->leftjoin('coupon_codes','coupon_codes.id', '=', 'user_subscriptions.coupon_code_id')
                      ->select('coupon_codes.*','user_subscriptions.*','users.email','users.created_at as users_created_at','users.gold','users.first_name',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"))
                      //->whereDate('users.created_at', Carbon::today())
                      ->whereDate('user_subscriptions.created_at', $today)
					  ->orderBy('user_subscriptions.id','desc')->get();
					  
					  
// and then you can get query log

//dd(DB::getQueryLog());


      $last_7 =DB::table('user_subscriptions')
                      ->join('users','users.id', '=', 'user_subscriptions.user_id')
					  ->leftjoin('coupon_codes','coupon_codes.id', '=', 'user_subscriptions.coupon_code_id')
                      ->select('coupon_codes.*','user_subscriptions.*','users.email', 'users.created_at as users_created_at','users.gold','users.first_name',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"))
                      ->whereDate('user_subscriptions.created_at', '>=', Carbon::now()->subDays(7))
                      ->orderBy('user_subscriptions.id','desc')->get();

      $last_30 =DB::table('user_subscriptions')
                      ->join('users','users.id', '=', 'user_subscriptions.user_id')
					  ->leftjoin('coupon_codes','coupon_codes.id', '=', 'user_subscriptions.coupon_code_id')
                      ->select('coupon_codes.*','user_subscriptions.*','users.email', 'users.created_at as users_created_at', 'users.gold','users.first_name',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"))
                      ->whereDate('user_subscriptions.created_at', '>=', Carbon::now()->subDays(30))
                      ->orderBy('user_subscriptions.id','desc')->get();

      // echo "<pre>";
      // print_r($last_30);
      // die('ddd');

      
      return view("front/sales/reports", compact('last_30','last_7','today_reports','today','yesterday'));
  }

  public function reset_pin(Request $request)
  {
        $validator = Validator::make($request->all(),array(
                "email"=>"required|email|exists:users,email",
            )
        );
        if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
        }

        $data = User::where('email', $request->email)->first();

        $expert['email'] = base64_encode($data->email);

        if(!empty($data)){
              \Mail::send('email_templates.reset_pin', ['expert' => $expert, 'data' => $data, 'banner'=>'600394878.jpg'], function ($message)use($data) {
                      $message->to(trim($data->email), $data->name)
                      ->bcc('asdsdf@yopmail.com', 'Amit Sharma testing')
                      ->subject('Trusted Teller Reset Your PIN');
              });
              return back(); 
        }
  }

    public function change_pin(Request $request)
    {
      // echo "<pre>";
      // print_r($request->all());
      // die('aaaaaaaaaaaaaaaa');
      $email = base64_decode($request->email);
      return view("frontend/reports/reset_pin", compact('email'));
    } 

    public function pin_update(Request $request)
    {
      $validator = Validator::make($request->all(),array(
              "email"=>"required|email|exists:users,email",
              'pin'  => 'required|min:6|confirmed',
              'pin_confirmation' => 'required',
          )
      );
      if ($validator->fails()){
              return back()->withErrors($validator)->withInput();
      }

      $user = User::where('email', $request->email)->first();

      if(!empty($user))
      {
          $user->pin = $request->pin;
          $user->save();
          return redirect('sales/reports');
      }
      else {
        return back();
      }
    }    

 
}