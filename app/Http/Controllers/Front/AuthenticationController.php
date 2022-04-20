<?php

namespace App\Http\Controllers\Front;

use Stripe\Stripe;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\Registration;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use GuzzleHttp\Client;

use App\Models\User;
use App\Models\TypeOfIndustries;
use App\Models\Role;
use App\Models\Country;
use App\Models\MetaData;
use App\Models\UserGallery;
use App\Models\InventorAward;
use App\Models\InventorContactInformation;
use App\Models\UserSocialMedia;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionInvoice;
use App\Models\Plan;
use App\Models\UsersUserRole;
use App\Models\Skill;
use App\Models\News;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Event;
use App\Models\EventAward;
use App\Models\EventSocialMedia;
use App\Models\Gallery;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryOtherTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryProductTag;
use App\Models\Watchlist;
use App\Models\PollAnswer;
use App\Models\Product;
use App\Models\ProductClassification;
use App\Models\ProductCollaborator;
use App\Models\ProductOfficialLink;
use App\Models\ProductCategory;
use App\Models\ProductBuyFrom;
use App\Models\ProductOther;
use App\Models\ProductStatistic;
use App\Models\ProductVideo;
use App\Models\ProductSocialMedia;
use App\Models\Message;
use Illuminate\Validation\Rule;
use URL;
use Validator;


use Mail;
use Carbon\Carbon;

class AuthenticationController extends ModuleController
{

    public function getLogin()
    {

        $plans = Plan::where('status', 1)
            ->get();
        // Get URLs

        $urlPrevious = url()->previous();
        // echo $urlPrevious; die();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if(($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url_intended_val', $urlPrevious);
        }
         // echo "Sad"; die;

        return view('front.auth.login', compact('plans'));
    }

    public function getSign_up()
    {
        $plans = Plan::where('status', 1)
            ->get()->toArray();

        $user = get_current_user_info();

        $subscription ='';
        // $subscription = UserSubscription::where([
        //     'user_id' => $user->id,
        // ])
        //     ->orderBy('id', 'desc')
        //     ->first();
         $role_id ='';
        // if(isset($user->id) && $user->id !=''){
        //     $role_id = $user;
        // }
        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        $price = array_column($plans, 'price');
        array_multisort($price, SORT_ASC, $plans);
        return view('front.auth.signup', compact('plans','subscription','role_id'));
    }

    public function getHome()
    {
        return view('front.pages.home');
    }


    public static function getDatesDiff($user)
    {
        $diff = 1;

        if(!empty($user->subscription))
        {
            $subscription = $user->subscription;
            //$now = Carbon::now();
            $str_date_now = strtotime(date('Y-m-d H:i:s'));
            $str_date_ends_at = strtotime($subscription->ends_at);
            //$date = Carbon::parse($subscription->ends_at);
            //$diff = $date->diffInDays($now);
            $diff = ($str_date_ends_at - $str_date_now);
       }

       return $diff;
    }

    public function postLogin(Request $request)
    {
        $url_intended_val = $request->session()->get('url_intended_val');
         $url = url('/').'/';

         //echo $url_intended_val; die();
        //echo $url_intended_val; die();
        //if(strpos($url_intended_val, '/forgot-password')>0 || strpos($url_intended_val, '/register')>0  || strpos($url_intended_val, '/home/get-site-search-data')>0)
        //{
           //$url_intended_val = '';
        //}
        // for recent page redirection
         // echo "sd"; die;
        if(strpos($url_intended_val, '/user')>0)
        {

           $url_intended_val = '';
        }
        else if(strpos($url_intended_val, '/people/')>0 || strpos($url_intended_val, '/company/')>0 || strpos($url_intended_val, '/pop-dictionary/')>0 || strpos($url_intended_val, '/classifieds/')>0)
        {

        } else if($url ==  $url_intended_val) {
            $url_intended_val = '';
        }
        else
        {


           // $url_intended_val = '';
        }
         // die();
   //      echo  $url_intended_val; die();
        // echo 'heree'; die;
        $messages = [
            'g-recaptcha-response.required' => 'The Captcha is required',
            'g-recaptcha-response.captcha' => 'Invalid Captcha',
            ];

        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => ['required','captcha'],
        ],$messages);

        try {
            $checkAuthentication = Auth::guard('users')->attempt($request->only(['email', 'password']));
            if (!$checkAuthentication) {
                // return errorMessage_new('Invalid credentials', true);
                return errorMessage(('Invalid credentials'), true);
            }
            $user = get_current_user_info();


            //if(empty($user->gold) && $user->gold == 0 ){

                /*if(!empty($user->subscription))
                {
                    $subscription = $user->subscription;
                    //$now = Carbon::now();
                    $str_date_now = strtotime(date('Y-m-d H:i:s'));
                    $str_date_ends_at = strtotime($subscription->ends_at);
                    //$date = Carbon::parse($subscription->ends_at);
                    //$diff = $date->diffInDays($now);
                    $diff = ($str_date_ends_at - $str_date_now);

               }*/
            //}

            $diff = self::getDatesDiff($user);

            if($diff <=0){
                        //Auth::guard('users')->logout();
                        //return errorMessage_new('Membership Expired!', true);
                    }


            $base_url = url('/');


            $str_user_url = Utilities::get_user_url($base_url, $user);

            //$return_url = route('front.pages.people.detail', $user->slug);
            //if ($user->role == 2) {
             //   $return_url = route('front.pages.people.detail', $user->slug);
            //}

            if(!empty($url_intended_val))
            {
                $str_user_url = $url_intended_val;
            }

            $str_checkPaidUserAuthentication = $this->checkPaidUserAuthentication(0);

            // for user who has not completed the payment process
            if(!empty($str_checkPaidUserAuthentication))
            {
                $return_url =  $str_checkPaidUserAuthentication;
            }
            else
            {
              //if ($user->role == 1) {
                 $return_url =  $str_user_url;
              //}
            }

         /*
        // ******************** Shubham Code Start *********************** //
            $threeDay = date('Y-m-d 23:59:59',strtotime('+3 days'));
            $todayDate = date('Y-m-d 00:00:00');
            $user_subscription = UserSubscription::where('user_id',$user->id)->whereBetween('ends_at', [$todayDate, $threeDay])->orderBy('id','DESC')->first();
            // echo '<pre>user - '; print_r($user_subscription); die;

            if(!empty($user_subscription->id)){
                $threeDayRemain = date('Y-m-d',strtotime('+3 days'));
                $oneDayRemain = date('Y-m-d',strtotime('+1 day'));
                $today = date('Y-m-d');
                $ends_at = date('Y-m-d',strtotime($user_subscription->ends_at));

                if($ends_at == $oneDayRemain || $ends_at == $today){
                    $return_url = route('front.plans', $user->role);
                }elseif($ends_at == $threeDayRemain){
                    $return_url = route('front.user.manage-payment-subscription');
                }elseif($ends_at >= $today){
                    // $return_url = route('front.plans', $user->role);
                }
            }
        // ******************** Shubham Code End *********************** //
        // echo $return_url;
        // echo '<pre>user - '; print_r($user); die;
        */
            return successMessage($return_url);
        } catch (\Exception $e) {
            return errorMessage($e->getMessage(), true);
        }

        $plans = Plan::where('status', 1)
            ->get();

        return view('front.auth.login', compact('plans'));
    }


    public function getRegister_olde()
    {
        $countries = Country::pluck('country_name', 'id');
        $type_of_industries = TypeOfIndustries::pluck('name', 'id');

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }

        $arr_roles_list = Utilities::get_roles_list();

        return view('front.auth.register', compact('arr_roles_list', 'countries', 'type_of_industries', 'ip_data'));
    }

    public function getRegister($type_of_user, $plan_id_encrypt)
    {
        $countries = Country::pluck('country_name', 'id');
        $type_of_industries = TypeOfIndustries::pluck('name', 'id');

        $getIpCountry = new \GuzzleHttp\Client();
        $response = $getIpCountry->request('GET', 'http://ip-api.com/json/' . request()->ip());
        $ip_data = null;
        if($response->getStatusCode() === 200) {
            $res_data = $response->getBody()->getContents();
            $ip_data = json_decode($res_data);
        }

        $arr_roles_list = Utilities::get_roles_list();

        $plan = Plan::findOrFail(base64_decode($plan_id_encrypt));

        return view('front.auth.register', compact('arr_roles_list', 'countries', 'type_of_industries', 'ip_data', 'plan_id_encrypt', 'type_of_user','plan'));
    }

    public function postRegister(Request $request)
    {
        // echo 11;exit;
        $rules = array(
            'first_name' => 'required',
            // 'term_and_condition' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'g-recaptcha-response' => ['required','captcha'],
            // 'confirm_password' => 'required|same:password',
            // 'country' => 'required|exists:countries,id',
            // 'dial_code' => 'required'
        );

          if($request->type_of_user_hidden != 4) {
            $rules['last_name'] = 'required';

       }
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules , $messages = [
            'first_name.required' => 'The First Name field is required.',
            'last_name.required' => 'The Last Name field is required.',
            // 'term_and_condition.required' => 'The Terms And Condition field is required.',
            'email.required' => 'The Email field is required.',
            'email.unique' => 'The Email Unique field is required.',
            'password.required' => 'The Password field is required.',
            'g-recaptcha-response.required' => 'The Captcha is required',
            'g-recaptcha-response.captcha' => 'Invalid Captcha',

            // 'confirm_password.required' => 'The Confirm Password field is required.',
            // 'country.required' => 'The Country field is required.',
            // 'dial_code.required' => 'The Dail Code field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>0,'response'=>$validator->errors()->toJson()]);
        } else {
              DB::beginTransaction();

            $str_plan_id_hidden = $request->plan_id_hidden;
            $type_of_user_hidden = $request->type_of_user_hidden;

            if($type_of_user_hidden == 2 ) {  // if its come with pro innovator plan
                $user_type = 2;
                $role_id = 2;
            } elseif ( $type_of_user_hidden == 3) { // if its come with basic plan
                $user_type = 3;
                $role_id = 2;
            } elseif($type_of_user_hidden == 4) {  // if its come with pro comapany plan
                $user_type = 2;
                $role_id = 3;
            } elseif($type_of_user_hidden == 1) {  // if its come with free plan
                $user_type = 1;
                $role_id = 1;
            } else {
                $user_type = 1;
                $role_id = 1;
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->user_id_number = generateRandomString();
            $user->last_name = $request->last_name;
            $user->mobile = $request->contract_number;
            $user->dial_code = $request->dial_code;
            $user->type_of_user = $user_type;

            $user->role = $role_id;
            $user->email = $request->email;
            $user->country_id = $request->country;
            $user->password = bcrypt($request->password);
            $user->created_by = 2;

            if (isset($request->newsletter) && !empty($request->newsletter) ) {
                $user->newsletter = 1;
            }

            $user->save();

            // $user->notify(new Registration());


            Auth::guard('users')->attempt($request->only(['email', 'password']));
             // echo "yes123";die;
            DB::commit();

            $user = get_current_user_info();


            //if($type_of_user_hidden == 2)
            //{
               //$str_plan_id_hidden_encrypt = encrypt($str_plan_id_hidden);
               $str_plan_id_hidden_encrypt = base64_encode($str_plan_id_hidden);
               $str_plan_id_hidden_encrypt = $str_plan_id_hidden;
               //route('front.plan.purchase')?plan={{encrypt($plan->id)}}
               $return_url = url('/').'/plan/purchase/'.$role_id.'/'.$str_plan_id_hidden_encrypt.'/0';
            // }
            // else
            // {
            //     $return_url = route('front.user.free.edit.profile');
            // }

            // $return_url = route('front.pages.people.detail', $user->slug);
            // if ($user->role == 2) {
            //     $return_url = route('front.pages.people.detail', $user->slug);
            // }

                return response()->json(['success'=>1,'message'=>$return_url]);
}

   //      $request->validate([
   //          'first_name' => 'required',
   //          'term_and_condition' => 'required',
   //          // 'terms_and_condition' => 'required',
   //          // 'contract_number' => 'required',
            // //'contract_number' => 'required|size:10',
   //          //'email' => 'required', Rule::unique('users', 'email')->ignore($request->first_name),
            // 'email' => 'required|unique:users,email',
   //          // 'type_of_industry' => 'required|exists:type_of_industries,id',
   //          'password' => 'required',
   //          'confirm_password' => 'required|same:password',
   //          'country' => 'required|exists:countries,id',
   //          'dial_code' => 'required'
   //      ]);
   //      if($request->type_of_user_hidden != 4) {
   //          $request->validate([
   //              'last_name' => 'required',
   //          ]);
   //      }



/*        try {
            DB::beginTransaction();

            $str_plan_id_hidden = $request->plan_id_hidden;
            $type_of_user_hidden = $request->type_of_user_hidden;

            if($type_of_user_hidden == 2 ) {  // if its come with pro innovator plan
                $user_type = 2;
                $role_id = 2;
            } elseif ( $type_of_user_hidden == 3) { // if its come with basic plan
                $user_type = 3;
                $role_id = 2;
            } elseif($type_of_user_hidden == 4) {  // if its come with pro comapany plan
                $user_type = 2;
                $role_id = 3;
            } elseif($type_of_user_hidden == 1) {  // if its come with free plan
                $user_type = 1;
                $role_id = 1;
            } else {
                $user_type = 1;
                $role_id = 1;
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->user_id_number = generateRandomString();
            $user->last_name = $request->last_name;
            $user->mobile = $request->contract_number;
            $user->dial_code = $request->dial_code;
            $user->type_of_user = $user_type;

            $user->role = $role_id;
            $user->email = $request->email;
            $user->country_id = $request->country;
            $user->password = bcrypt($request->password);
            $user->created_by = 2;

            if (isset($request->newsletter) && !empty($request->newsletter) ) {
                $user->newsletter = 1;
            }

            $user->save();

            // $user->notify(new Registration());

            Auth::guard('users')->attempt($request->only(['email', 'password']));
            DB::commit();

            $user = get_current_user_info();


            //if($type_of_user_hidden == 2)
            //{
               //$str_plan_id_hidden_encrypt = encrypt($str_plan_id_hidden);
               $str_plan_id_hidden_encrypt = base64_encode($str_plan_id_hidden);
               $str_plan_id_hidden_encrypt = $str_plan_id_hidden;
               //route('front.plan.purchase')?plan={{encrypt($plan->id)}}
               $return_url = url('/').'/plan/purchase/'.$role_id.'/'.$str_plan_id_hidden_encrypt.'/0';
            //}
            //else
            //{
                //$return_url = route('front.user.free.edit.profile');
            //}

            //$return_url = route('front.pages.people.detail', $user->slug);
            //if ($user->role == 2) {
                //$return_url = route('front.pages.people.detail', $user->slug);
            //}
        // echo "yes"; die;
            return successMessage($return_url);
        } catch (\Exception $e) {
            //DB::rollback();

            // return errorMessage()->json(['response'=>$validator->errors()->toJson()]);
          // return errorMessage($e->validator->errors()->toJson(), true);
        }*/
    }

    public function getLogout()
    {
        \Auth::guard('users')->logout();
        return redirect()->route('front.login');
    }

    public function getForgotPassword()
    {
        return view('front.auth.forgot_password');
    }

    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);
        try {
            $user = User::where('email', $request->email)->first();

            $url = get_reset_password_link($user->id);
            $data['url'] = $url;
            $data['email'] = $user->email;
            $data['name']  = @$user->first_name.' '.@$user->last_name;
            // pr($data,1);

            /*Mail::send('mail.auth.reset_password',$data, function($message) use ($data) {
            $message->to(trim($data['email']), 'People Of Play')
            ->subject('Reset Password - People Of Play - ' . $data['email']);
            $message->from(config('mail.from.address'),'People Of Play');
            });*/

            //$this->send_mail_by_phpmailer(trim($data['email']), 'Reset Password - People Of Play - ' . $data['email'], 'mail.auth.reset_password', $data);

           $this->send_mail_by_phpmailer(trim($data['email']), 'Reset People of Play Password  - ' . $data['name'] . ' - Peoplofplay.com', 'mail.auth.forgot_password', $data);

             $this->send_mail_by_phpmailer('info@peopleofplay.com', 'Reset People of Play Password  - ' . $data['name'] . ' - Peoplofplay.com', 'mail.auth.forgot_password', $data);
            // $user->notify(new ResetPassword($url));

            return successMessage('Reset Password link sent to your registered email');
        } catch (\Exception $e) {
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getResetPassword($user_id)
    {
        try {
            $id = decrypt($user_id);
            $user = User::findOrFail($id);
            return view('front.auth.reset_password', compact('user'));
        } catch (\Exception $e) {
            abort(404);
        }
    }


    public function postResetPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        try {
            $user = User::findOrFail($request->user_id);
            $user->password = bcrypt($request->password);
            $user->save();

            return successMessage('Password Changed');
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function Terms_Conditions(Request $request){
        return view('front.auth.Terms_Conditions');
    }

    public function delete_account(Request $request)
    {
        $user = get_current_user_info();
        $id = $user->id;

        if(Hash::check($request->pass, $user->password) ){
            try {
                // Start Transaction
                \DB::beginTransaction();

                // cancel user stripe subscription
                $this->cancel_user_stripe_subscription($user);

                //delete a user in stripe dashboard
                //$this->delete_user_stripe($user);

                InventorContactInformation::where('user_id', $id)->delete();
                UserSocialMedia::where('user_id', $id)->delete();
                Role::where('user_id', $id)->delete();
                //EventAward::where('user_id', $id)->delete();
                EventSocialMedia::where('user_id', $id)->delete();
                Event::where('user_id', $id)->delete();
                News::where('user_id', $id)->delete();
                Blog::where('user_id', $id)->delete();
                Chat::where('sender', $id)->delete();
                Chat::where('receiver', $id)->delete();
                Gallery::where('user_id', $id)->delete();
                GalleryAwardTag::where('user_id', $id)->delete();
                GalleryCompanyTag::where('user_id', $id)->delete();
                GalleryOtherTag::where('user_id', $id)->delete();
                GalleryPersonTag::where('user_id', $id)->delete();
                GalleryProductTag::where('user_id', $id)->delete();
                InventorAward::where('user_id', $id)->delete();
                UserSubscription::where('user_id', $id)->delete();
                ProductSocialMedia::where('user_id', $id)->delete();
                ProductClassification::where('user_id', $id)->delete();
                ProductCollaborator::where('user_id', $id)->delete();
                ProductOfficialLink::where('user_id', $id)->delete();
                ProductCategory::where('user_id', $id)->delete();
                ProductBuyFrom::where('user_id', $id)->delete();
                ProductOther::where('user_id', $id)->delete();
                ProductStatistic::where('user_id', $id)->delete();
                ProductVideo::where('user_id', $id)->delete();
                Product::where('user_id', $id)->delete();
                Watchlist::where('user_id', $id)->delete();
                PollAnswer::where('user_id', $id)->delete();

                Message::where(
                            function ($query) use ($id)
                            { $query->where('sender', '=', $id)
                                ->orWhere('receiver', '=', $id);
                            })->delete();
                Chat::where(
                            function ($query) use ($id)
                            { $query->where('sender', '=', $id)
                                ->orWhere('receiver', '=', $id);
                            })->delete();

                $user = \App\Models\User::find($id)->delete();

                // Commit Transaction
                \DB::commit();
                \Auth::guard('users')->logout();
                $response = ['status' => true,'msg' => 'Your account has been deleted'];
                return response()->json($response, 200);

            } catch (\Illuminate\Database\QueryException $e) {
                // Rollback Transaction
                \DB::rollBack();
                $response = ['status' => false,'msg' => 'Something went wrong!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ['status' => false,'msg' => 'Credential are invalid'];
            return response()->json($response, 200);
        }


    }



    public static function checkPaidUserAuthentication($int_page_check_flag)
    {
        $int_outer_pages_flag = 0;
        $int_is_not_user_subscribed_flag = 0;
        $str_user_subsc_invoice_pay_status = '';
        $str_time_current = strtotime(date('Y-m-d H:i:s'));

        $current_url_new = URL::current();

        if (strpos($current_url_new, 'blog_pedia') !== false) {
            return 0;
        }

        if (strpos($current_url_new, 'blog') !== false) {
            return 0;
        }

        $user_current_info = get_current_user_info();

        $diff = self::getDatesDiff($user_current_info);

        if(!empty($user_current_info))
        {
            $user_id = $user_current_info->id;
            $base_url = url('/');

            $arr_menu_list = UtilitiesTwo::getMenuLinks($base_url, $user_current_info);

            $str_profile_change_plan =  $arr_menu_list['profile_change_plan'];
            $obj_user_data = User::where('id', $user_id)->first();
            $obj_user_subscription_data =  UserSubscription::where('user_id', $user_id)->where('status', '>', 0)->orderBy('id', 'desc')->first();

            $obj_user_subscription_invoice_data =  UserSubscriptionInvoice::where('user_id', $user_id)->where('payment_status','!=','void')->orderBy('id', 'desc')->first();

            $str_user_subscription_data_ends_at =  strtotime(@$obj_user_subscription_data->ends_at);

           // for a logged in user
           if(!empty($obj_user_data->id))
           {
             // if subscription not created
             if((empty($obj_user_data->stripe_id) && $obj_user_data->created_by == 2)
             || empty($obj_user_subscription_data->id))
             {
                $int_is_not_user_subscribed_flag = 1;
             }

             // if subscription has canceled
             if(!empty($obj_user_subscription_data->id) && $obj_user_subscription_data->status == 4 && $str_time_current>$str_user_subscription_data_ends_at)
             {
                $int_is_not_user_subscribed_flag = 1;
             }

             if($diff<=0)
             {
                $int_is_not_user_subscribed_flag = 1;
             }

             if(!empty($obj_user_subscription_invoice_data->id))
             {
                $str_user_subsc_invoice_pay_status = @$obj_user_subscription_invoice_data->payment_status;
                $str_user_subsc_invoice_pay_status = strtolower($str_user_subsc_invoice_pay_status);
             }


             // if invoice payment is successfull or open
             if(!empty($obj_user_subscription_data->id) && strpos($obj_user_subscription_data->stripe_subscription_id, 'ub_')>0
             && strpos($obj_user_subscription_data->stripe_id, 'us_')>0 && (!empty($obj_user_subscription_invoice_data->id)
             &&  strpos($obj_user_subscription_invoice_data->stripe_subscription_id, 'ub_')>0))
             {
                 if($str_user_subsc_invoice_pay_status == "paid" || $str_user_subsc_invoice_pay_status == "open" ||
              $str_user_subsc_invoice_pay_status == "draft")
                 {

                 }
                 else
                 {
                     $int_is_not_user_subscribed_flag = 1;
                 }


             }

             // if the user has not subscribed he can vist only the outer pages no inner pages can be visited
             if(!empty($int_is_not_user_subscribed_flag))
             {
                 if(!empty($int_page_check_flag))
                 {

                     // if the user is visiting outer pages
                     if(strpos($current_url_new, '/pages/')>0 || strpos($current_url_new, '/coming-soon')>0
                     || strpos($current_url_new, '/pub')>0 || strpos($current_url_new, '/home/get-site-search-data')>0
                     || strpos($current_url_new, '/knowledge-base/faqs')>0 || strpos($current_url_new, '/contact-us')>0
                     || strpos($current_url_new, '/interviews')>0 || strpos($current_url_new, '/change-plan/')>0
                     || strpos($current_url_new, '/plan/purchase/')>0 || request()->is('/') || strpos($current_url_new, '/user/manage-payment-subscription')>0)
                     {
                        $int_outer_pages_flag = 1;
                     }

                     //echo 'int_outer_pages_flag'.$int_outer_pages_flag;
                     if(!empty($int_is_not_user_subscribed_flag) && empty($int_outer_pages_flag))
                     {
                       return $str_profile_change_plan;
                     }

                 }
                 else
                 {
                     return $str_profile_change_plan;
                 }

            }


           }

        }

        return 0;
    }


    public static function getUserObj($user_id)
    {
        $obj_user_data = User::where('id', $user_id)->first();
        return $obj_user_data;
    }

    public static function getProductUrl($product_id)
    {
        $obj_product_data = Product::where('id', $product_id)->first();

        $str_home_product_page_url_new = Utilities::get_product_url($obj_product_data);

        return $str_home_product_page_url_new;
    }



	public static function checkFreeUserAuthentication()
    {
	   $base_url = url('/');
       if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1) {

        $current_url_new = URL::current();

        if (strpos($current_url_new, 'blog_pedia') !== false) {
            //return $base_url;
        }

        if (strpos($current_url_new, 'blog') !== false) {
            //return $base_url;
        }

		if (strpos($current_url_new, 'classified') !== false) {
            return $base_url;
        }
		if (strpos($current_url_new, 'user/media') !== false) {
            return $base_url;
        }
		if (strpos($current_url_new, 'user/product') !== false) {
            return $base_url;
        }
	   }
       return '';
    }

}
