<?php

namespace App\Http\Controllers\Front;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Invoice;
use App\Models\Plan;
use App\Models\News;
use App\Models\User;
use App\Models\Country;
use App\Models\CouponCode;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use Session;
use Auth;
use Config;
use Illuminate\Support\Facades\View;
use Mail;

require (app_path() . '/Libraries/PHPMailer-master/vendor/autoload.php');


class PlanController extends ModuleController
{
    public function getPlans($role_id, Request $request)
    {
        $plans = Plan::where('status', 1)
            ->get()->toArray();
        $user = get_current_user_info();
        $subscription = UserSubscription::where([
            'user_id' => $user->id,
        ])
		    ->orderBy('id', 'desc')
            ->first();

        $price = array_column($plans, 'price');
        array_multisort($price, SORT_ASC, $plans);

		$is_plan_expire=0;
		$plan_end_date='';
		$user_current_info = get_current_user_info();
		$st_customer_invoices = '';
		if(!empty($user_current_info))
		{
		$diff = self::getDatesDiff($user_current_info);
		if($diff<=0){
			$is_plan_expire=1;
			$plan_end_date = $subscription->ends_at;
			$mk_payment = $this->makePayment();
			// echo $mk_payment; die;
			if($mk_payment > 0){
				$is_plan_expire = 2; // 2 for profile activation;
			}else{
				$stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
				$st_customer_invoices = $stripe->invoices->all(['customer'=>$user_current_info->subscription->stripe_id,'limit' => 1])->data[0];
			}
		}
		}

		if(!empty($request->invoice_id)){
			$invoice_id = '?invoice_id='.$request->invoice_id;
		}else{
			$invoice_id = '';
		}

        return view('front.auth.plans', compact('plans', 'subscription' ,'role_id','is_plan_expire','plan_end_date','st_customer_invoices','invoice_id'));
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

	public function makePayment(){
		$user_current_info = get_current_user_info();
		$stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
		$st_customer_invoices = $stripe->invoices->all(['customer'=>$user_current_info->subscription->stripe_id,'limit'=>1]);
		// echo '<pre>st_customer_invoices - '; print_r($st_customer_invoices); die;
		$err = 0;
		if($st_customer_invoices->data){
			foreach($st_customer_invoices->data as $k => $st_customer_invoice){
				// echo '<pre>st_customer_invoice - '; print_r($st_customer_invoice); die;
				if($st_customer_invoice->paid == 1 && !empty($st_customer_invoice->payment_intent) && $st_customer_invoice->status == 'paid'){
					$err++;
				}else{
					// echo 'No such coustomer';
				}
			}
		}
		return $err;
		die;
	}

	public function getPlanIdNew($plan)
    {
		$is_live_url_mode =  UtilitiesTwo::chkLiveCurrentUrl();

		if(!empty($is_live_url_mode))
		{
		   $str_stripe_plan_id =	$plan->stripe_plan_id_live;
		}
		else
		{
			$str_stripe_plan_id =	$plan->stripe_plan_id;
		}

		return $str_stripe_plan_id;

	}

	// save the error log data in payment log table
	function save_payment_log($str_subscription_id, $customer_id, $error_message)
	{
		$user = User::find(get_current_user_info()->id);

		$user_id_new = get_current_user_info()->id;

		$str_latest_invoice = $str_payment_intent = '';
		$message = '';
		$code = '';
		$seller_message = '';
		$network_status = '';
		$reason = '';
		$type = '';
		$rule = '';
		$risk_level = '';

		if(!empty($str_subscription_id) && !empty($customer_id))
		{

			Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

			$str_subscription_id = trim(@$str_subscription_id);
			$subscription_data = Subscription::retrieve($str_subscription_id);
			$str_latest_invoice = @$subscription_data->latest_invoice;

			$str_latest_invoice = trim(@$str_latest_invoice);
			$invoice_data = Invoice::retrieve($str_latest_invoice);
			$str_payment_intent = @$invoice_data->payment_intent;
			$str_payment_intent = trim($str_payment_intent);

			$payment_intent_data = PaymentIntent::retrieve($str_payment_intent);

			$message = @$payment_intent_data->last_payment_error['message'];
			$code = @$payment_intent_data->last_payment_error['code'];
			$customer_id = @$subscription_data->customer;

			$seller_message = @$payment_intent_data->charges['data'][0]['outcome']->seller_message;
			$network_status = @$payment_intent_data->charges['data'][0]['outcome']->network_status;
			$reason = @$payment_intent_data->charges['data'][0]['outcome']->reason;
			$type = @$payment_intent_data->charges['data'][0]['outcome']->type;
			$rule = @$payment_intent_data->charges['data'][0]['outcome']->rule;
			$risk_level = @$payment_intent_data->charges['data'][0]['outcome']->risk_level;
		}

		if(!empty($customer_id) && empty($str_subscription_id))
		{
		   $message = 'Subscription Creation failed.';
		}

       if(empty($customer_id) && !empty($str_subscription_id))
		{
			$message = 'Customer Creation failed.';
		}

        if(empty($customer_id) && empty($str_subscription_id))
		{
			$message = 'Customer & Subscription Creation failed.';
		}

        if(!empty($error_message))
		{
		    $message = $error_message;
		}

		$payment_log = new PaymentLog();
		$payment_log->user_id = $user_id_new;
		$payment_log->subscription_id = $str_subscription_id;
		$payment_log->invoice_id = $str_latest_invoice;
		$payment_log->customer_id = $customer_id;
		$payment_log->payment_rule = $rule;
		$payment_log->payment_risk_level = $risk_level;
		$payment_log->payment_message = $message;
		$payment_log->payment_code = $code;
		$payment_log->payment_seller_message = $seller_message;
		$payment_log->payment_network_status = $network_status;
		$payment_log->payment_reason = $reason;
		$payment_log->payment_type = $type;
		$payment_log->status = 1;
		$payment_log->save();

		return $payment_log->id;
     }


	 public function cancelPreviousSubscription($change_plan, $user)
    {

	 if($change_plan){
					//if($user->gold !=2 && $user->gold !=3){

						//$this->cancel_user_stripe_subscription($user);
					//}
				}
    }

    // when the user pays the amount by card in signup or upgrade plan process
    /*public function postPlanSubscribe(Request $request)
    {
		$int_payment_log_id = 0;
		$str_time = time();
        // pr($request->all(),1);
        $request->validate([
            //'paymentMethod' => 'required',
            //'paymentMethod.card' => 'required',
            //'paymentMethod.card.brand' => 'required',
            //'paymentMethod.card.last4' => 'required',
            //'paymentMethod.id' => 'required',
            'plan_id' => 'required|exists:plans,id'
        ]);

        try {

			DB::beginTransaction();

            $plan = Plan::find($request->plan_id);
			$str_stripe_plan_id = $this->getPlanIdNew($plan);
            $change_plan = ($request->change_plan) ? $request->change_plan : 0 ;

            $user = User::find(get_current_user_info()->id);
			//$str_stripe_coupon_id_hidden =  $request->stripe_coupon_id_hidden;
            $str_stripe_coupon_id_hidden = session()->get('stripe_coupon_id_new');
			$int_coupon_code_data_id = session()->get('int_coupon_code_data_id');

			$int_hundred_discount_flag = $request->int_hundred_discount_flag;

			$str_resp_data_src_id_new = $request->str_resp_data_src_id_new;

			$this->set_stripe_apikey();

            // if the 100% discount is not enterd then execute the stripe payment
            if(empty($int_hundred_discount_flag))
			{
				// Stripe
				// create a customer
				// if(empty($user->stripe_id) || strpos($user->stripe_id, 'price_')>0)
				//if(empty($user->stripe_id) || strpos($user->stripe_id, 'rice_')>0) // new code to make it new user
				//{
					$stripe_customer = Customer::create([
						'email' => $user->email,
						  'source' => $request->str_source_id,
						  //'address' => [
							//'line1' => '510 Townsend St',
							//'postal_code' => '98140',
							//'city' => 'San Francisco',
							//'state' => 'CA',
							//'country' => 'US',
						  //],

						//'payment_method' => $str_resp_data_src_id_new,//$request->paymentMethod['id']
						//'invoice_settings' => [
						//    'default_payment_method' => $str_resp_data_src_id_new,
						//],
					]);

				   $str_user_stripe_id = $stripe_customer->id;


					// return 'inin'.$str_user_stripe_id;
				/*}
				else
				{
					// return 'out'.$user->stripe_id;
				   $str_user_stripe_id =	$user->stripe_id;
				}

				//when the user is not created by stripe
				if(empty($str_user_stripe_id))
				{
					//echo 'a';
				   // save the data in log table
				   $int_payment_log_id = $this->save_payment_log(0, 0, '');
				   DB::commit();

				   $message = ['int_payment_log_id' => $int_payment_log_id, 'type'=> 'cancel','msg' => 'There was a problem while creating the Customer. Please try again.'];
				   return response()->json($message, 422);
				}

				$pre_plan = '';

				// cancel a subscription in stripe if already exists for change plan
				$this->cancelPreviousSubscription($change_plan, $user);

				// create a subscription in stripe
				$stripe_subscription = Subscription::create([
					'customer' => $str_user_stripe_id,
					'items' => [
						['price' => $str_stripe_plan_id],
					],
					//'default_source' => $request->str_source_id,
					//'expand' => ['latest_invoice.payment_intent'],
					// 'shipping' => [
					//     'address' => [],
					// ],
					'coupon' => $str_stripe_coupon_id_hidden
				]);

				//print_r($stripe_subscription);


                //when only the user has been created by stripe
				if(empty($stripe_subscription->id))
				{
					//echo 'b';
				  // save the data in log table
				   $int_payment_log_id = $this->save_payment_log(0, $str_user_stripe_id, '');

				   DB::commit();
				   $message = ['int_payment_log_id' => $int_payment_log_id, 'type'=>'cancel','msg'=>'There was a problem while creating the Subscription. Please try again.'];
				   return response()->json($message, 422);
				}

				//when the entire subscription creation fails
				if($stripe_subscription['status']!="active")
				{
					 //echo 'c';
					 // save the data in log table
					 $int_payment_log_id = $this->save_payment_log($stripe_subscription->id, $str_user_stripe_id, '');
					 DB::commit();

					 $message = ['int_payment_log_id' => $int_payment_log_id, 'type'=> 'failed','msg' => 'There was a problem while making the Payment. Please try again.'];
					 return response()->json($message, 422);
				}

			}


			if(!empty($int_hundred_discount_flag))
			{
			    // cancel a subscription in stripe if already exists for change plan
				$this->cancelPreviousSubscription($change_plan, $user);
			}

            $type_of_user_hidden = $plan->type_of_plan;

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

			$role_id_hidden = $request->role_id_hidden;

            if(empty($int_hundred_discount_flag))
			{
				$user->stripe_id = $str_user_stripe_id;
			}

            $user->type_of_user = $user_type;
            $user->role = $role_id;
            $user->gold = 0;

            // $user->type_of_user = $user->type_of_user;
			// if(!empty($role_id_hidden) && $role_id_hidden>1)
			// {
			//    $user->role = $role_id_hidden;
			// }

            // End Stripe
            $subscription = new UserSubscription();
            $subscription->user_id = $user->id;
            $subscription->plan_id = $plan->id;
            $subscription->price = $plan->price;
			$subscription->coupon_code_id = $int_coupon_code_data_id;
            $subscription->validity = $plan->validity;
            $subscription->ends_at = Carbon::now()->addDay($plan->validity);
            $subscription->payment_status = 2;

			if(empty($int_hundred_discount_flag))
			{
              $subscription->stripe_id = $str_user_stripe_id;
			  $subscription->stripe_subscription_id = $stripe_subscription->id;
			}
            else
			{
			  $subscription->stripe_id = $str_time;
              $subscription->stripe_subscription_id = 0;

			  $user->stripe_id = $str_time;
			}

            $user->save();

            $subscription->stripe_plan_id = $str_stripe_plan_id;

            $subscription->save();

            // $user->notify(new InvoicePaid());
            $user = User::find(get_current_user_info()->id);

			$base_url = url('/');
            $str_user_url = Utilities::get_user_url($base_url, $user);

            $data['email'] = @$user->email;
            $data['name']  = @$user->first_name.' '.@$user->last_name;
            $data['plan_name']  = @$plan->name;
            $data['plan_id']  = @$plan->id;
            $data['plan_price']  = @$plan->price;
            $data['str_user_url']  = @$str_user_url;
            $data['pre_plan']       = @$pre_plan;

            session()->put('data', $data);
            session()->put('change_plan', $change_plan);

			Session::flash('user_subscribe_data_saved_flag', 1);

			//when the entire subscription is created successfully
			if(!empty($stripe_subscription->id) && !empty($str_user_stripe_id))
			{
			   //echo 'd';

			   $pm = PaymentMethod::retrieve($str_resp_data_src_id_new);
                $cpm = $pm->attach(['customer' => $str_user_stripe_id]);

				$obj_customers_update = Customer::update(
                   $str_user_stripe_id,
                   ['invoice_settings' => ['default_payment_method' => $str_resp_data_src_id_new]]
                  );

			  // save the data in log table
			  $this->save_payment_log($stripe_subscription->id, $str_user_stripe_id, '');
			}

			//return redirect($str_user_url);
            DB::commit();
            // return successMessage($str_user_url);

			$base_url = url('/');
            $str_user_url = Utilities::get_user_url($base_url, $user);

			if(empty($int_hundred_discount_flag))
			{
			  return successMessage('Payment Successful, Please Wait...');
			}
			// if user has entered a 100% discount coupon code
			else
			{
			  if(!empty($change_plan))
			  {

                 if(@$data['plan_price'] < @$pre_plan->plan->price){
                    $this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Changed - Peopleofplay.com', 'mail.invoice.downgrade', $data);
                } else {
                    $this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Upgraded - Peoplofplay.com', 'mail.invoice.upgrade', $data);
                }


				 Session::flash('user_plan_upgrade_data_saved_flag', 1);
			  }
			  else
              {
				 Session::flash('user_plan_created_data_saved_flag', 1);
			  }

			  return successMessage($str_user_url);
			}

        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }*/


    public function plan_renew(Request $request)
    {

        try {
            DB::beginTransaction();

            $user = User::find(get_current_user_info()->id);

            $subscription = $user->subscription;

            // pr($user);
            // pr($subscription,1);
            $plan_id = $subscription->plan_id;
            $subscription_id = $subscription->stripe_subscription_id;
            // $subscription_id = 'sub_I57mmTCUb9IlMU';

            $plan = Plan::find($plan_id);

            $str_stripe_plan_id = $this->getPlanIdNew($plan);

            // Stripe
            Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
            // echo $subscription_id; die;

            // $stripe = new \Stripe\StripeClient($subscription_id);
             // echo "<pre>"; print_r($subscription_data); die;

            $subscription_data = \Stripe\Subscription::retrieve($subscription_id);
            // echo "<pre>"; print_r(expression)
            // echo "<pre>"; print_r($subscription_data); die;
            $EndDate    = date('Y-m-d H:i:s',$subscription_data->current_period_end);
            // $trai_end = strtotime(time)
            // echo $subscription_data->current_period_end; die;
            $NewEndDate = date('Y-m-d H:i:s', strtotime($EndDate . " +1 year"));
             // echo $NewEndDate; die;
            $current_period_end = strtotime($NewEndDate);


            // echo $subscription_id; die;

            // pr(date('Y-m-d',$subscription_data->created));
            // pr(date('Y-m-d',$subscription_data->current_period_start));
            // pr(date('Y-m-d',$subscription_data->current_period_end));

            $stripe_subscription = Subscription::update(
                $subscription_id, [
                 'trial_end'=> $subscription_data->current_period_end,
                 'billing_cycle_anchor' => 'now',

                 // 'proration_behavior' => 'none',

                 'proration_behavior' => 'create_prorations',
            ]);


//             $stripe_subscription = Subscription::update ('sub_49ty4767H20z6a', [
//   'items' => [
//     [
//       'id' => $subscription->items->data[0]->id,
//       'price' => 'price_CBb6IXqvTLXp3f',
//     ],
//   ],
//   'proration_date' => $current_period_end,
// ]);






// echo "<pre>"; print_r($stripe_subscription); die;
            if(empty($stripe_subscription->id))
            {
               DB::rollback();
               $message = ['type'=>'cancel','msg'=>'There was a problem while creating the Subscription. Please try again.'];
               return response()->json($message, 422);
            }

            if($stripe_subscription['status']!="active")
            {
                 DB::rollback();
                 $message = ['type'=> 'failed','msg' => 'There was a problem while making the Payment. Please try again.'];
                 return response()->json($message, 422);
            }

             // pr($stripe_subscription,1);

            // $upcommingPlanCheck = UserSubscription::where(['user_id'=>$user->id,'plan_id'=>$plan->id,'payment_status'=>2])->get();

            // if(count($upcommingPlanCheck)>0) {
            // 	echo  Carbon::now()->addDay(730); die;
            // }

            // End Stripe
            $subscript = new UserSubscription();
            $subscript->user_id = $user->id;
            $subscript->plan_id = $plan->id;
            $subscript->price = $plan->price;
            $subscript->validity = $plan->validity;
            $subscript->ends_at = Carbon::now()->addDay($plan->validity);
            $subscript->payment_status = 2;
            $subscript->stripe_id = $subscription->stripe_id;
            $subscript->stripe_plan_id = $subscription->stripe_plan_id;
            $subscript->stripe_subscription_id = $subscription_id;

            $subscript->save();

            DB::commit();
            return successMessage('Plan renew successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    // when a card is updated by user
    public function card_update(Request $request)
    {
		// echo '<pre>request - '; print_r($request->all()); die;
        $request->validate([
            'paymentMethod'         => 'required',
            'paymentMethod.card'    => 'required',
            'paymentMethod.card.brand' => 'required',
            'paymentMethod.card.last4' => 'required',
            'paymentMethod.id' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $plan = Plan::find($request->plan_id);

            $user = User::find(get_current_user_info()->id);

			$user_current_info = get_current_user_info();
			if(isset($user_current_info->subscription->stripe_id) && !empty($user_current_info->subscription->stripe_id)){
				$user->stripe_id = $user_current_info->subscription->stripe_id;
				// echo '<pre>user_current_info - '; print_r($user_current_info->subscription->toArray()); die;
			}


            // Stripe
            Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

            $pm = PaymentMethod::retrieve($request->paymentMethod['id']);
            $cpm = $pm->attach(['customer' => $user->stripe_id]);

            $customers = Customer::update(
              $user->stripe_id,
              ['invoice_settings' => ['default_payment_method' => $request->paymentMethod['id']]]
            );
            // pr($customers,1);

            DB::commit();
            return successMessage('Card update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    // when a subscription is cancelled by user
    public function cancel_subscription()
    {

        $user = User::find(get_current_user_info()->id);

        try {

			DB::beginTransaction();

            $this->cancel_user_stripe_subscription($user);

			$user->gold = 2;
            $user->save();

            // pr($user,1);
            DB::commit();
            return successMessage('Plan Cancelled Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function get_subscription()
    {
        $users = User::where('type_of_user','!=',1)->where('role','!=',1)->where('created_by',2)->get();
        Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

        foreach ($users as $key => $user) {
            if(!empty($user->gold) && $user->gold == 1){
                continue;
            } else {
                try {
                    $subscription = $user->subscription;
                    $subscription_id = $subscription->stripe_subscription_id;

                    $subscription_data = Subscription::retrieve(
                        $subscription_id,
                    );

                    $stripe_date = $subscription_data->current_period_end;
                    $db_date     = strtotime($subscription->ends_at);

                    if($stripe_date > $db_date){
                        $subscript = new UserSubscription();
                        $subscript->user_id = $user->id;
                        $subscript->plan_id = $subscription->plan_id;
                        $subscript->price   = $subscription->price;
                        $subscript->validity = $subscription->validity;
                        $subscript->ends_at = Carbon::now()->addDay($subscription->validity);
                        $subscript->payment_status = 2;
                        $subscript->stripe_id = $subscription->stripe_id;
                        $subscript->stripe_plan_id = $subscription->stripe_plan_id;
                        $subscript->stripe_subscription_id = $subscription_id;
                        $subscript->save();
                    } else {
                        continue;
                    }
                } catch (\Exception $e) {
                    continue;
                }
                // pr(date('Y-m-d',$subscription_data->created));
                // pr(date('Y-m-d',$subscription_data->current_period_start));
                // pr(date('Y-m-d',$subscription_data->current_period_end));
                // pr($subscription_data,1);
            }
        }
        die('Done');
    }

    public function email_reminder()
    {
        $users = User::where('gold',0)->get();
        foreach ($users as $key => $user) {
            $subscription = $user->subscription;
            if(!empty($subscription->ends_at)){
                $plan = Plan::findOrFail($subscription->plan_id);

                $now = Carbon::now();
                $date = Carbon::parse($subscription->ends_at);

                $diff = $now->diffInMonths($date);
                // pr(date('Y-m-d',strtotime($subscription->ends_at)));

                // echo "----------------------";

                $data['email'] = @$user->email;
                $data['email'] = 'apamitpunj@yopmail.com';
                $data['name']  = @$user->first_name.' '.@$user->last_name;
                $data['plan_name']  = @$plan->name;
                $data['plan_price']  = @$plan->price;
                $data['ends_at']  = date('Y-m-d',strtotime(@$subscription->ends_at));
                if($diff <= 1){
                	// pr($diff,1);

					/*Mail::send('mail.invoice.subscription',$data, function($message) use ($data) {
                        $message->to(trim($data['email']), 'People Of Play')
                        ->subject('Renewal Package - People Of Play - '.$data['name'].' '.$data['plan_name']);
                        $message->from(config('mail.from.address'),'People Of Play');
                    });*/

					$this->send_mail_by_phpmailer(trim($data['email']), 'Your POP Account Auto Renewal Warning - '.$data['name'].' - People Of Play', 'mail.invoice.subscription', $data);


                }
            }
        }
        die('Done test');
    }

    // for display of the check out page or when change plan is clicked
	//and after user has entered the data of free registration
    public function createStripePaymentIntent(Request $request, $role_id, $plan_id, $change_plan)
    {



		$str_client_secret_new = '';
		$str_source_new = '';
		$str_resp_data_src_id_new = '';
		$str_session_id_new = '';
        //$request->validate([
         //   'plan' => 'required'
        //]);
		/*echo 'encrypt_plan_id: '.$encrypt_plan_id;

		$plan_id = Crypt::decrypt($encrypt_plan_id);
			echo 'plan_id'.$plan_id;exit;*/

		$plan_id =	base64_decode($plan_id);
        try {



            //$plan_id = decrypt($request->plan);
			DB::beginTransaction();

            $plan = Plan::findOrFail($plan_id);

            if ($plan->type == 1) {
                $user = User::find(get_current_user_info()->id);

				$user_current_info = get_current_user_info();
				if(isset($user_current_info->subscription->stripe_id) && !empty($user_current_info->subscription->stripe_id)){
					$user->stripe_id = $user_current_info->subscription->stripe_id;
					// echo '<pre>user_current_info - '; print_r($user_current_info->subscription->toArray()); die;
				}


				$str_stripe_plan_id = $this->getPlanIdNew($plan);
				$user->stripe_id = $str_stripe_plan_id;
				//$user->stripe_id = $plan->stripe_plan_id;
                $user->type_of_user = 1;

				// if(!empty($role_id))
				// {
				//    $user->role = $role_id;
				// }
                $user->role = 1;
                $user->save();


            //       $upcommingPlanCheck = UserSubscription::where(['user_id'=>$user->id,'plan_id'=>$plan->id,'payment_status'=>2])->get();
            //       echo "<pre>"; print_r($upcommingPlanCheck); die;

            // if(count($upcommingPlanCheck)>0) {
            // 	echo  Carbon::now()->addDay(730); die;
            // }

                $subscription = new UserSubscription();
                $subscription->user_id = $user->id;
                $subscription->plan_id = $plan->id;
				$subscription->stripe_plan_id = $str_stripe_plan_id;
                $subscription->price = $plan->price;
                $subscription->validity = $plan->validity;
                $subscription->ends_at = Carbon::now()->addDay($plan->validity);
                $subscription->payment_status = 2;
                $subscription->save();

                $user = get_current_user_info();
				$base_url = url('/');

				if($plan->id == 1)
				{
				   // cancel a subscription in stripe if already exists for change plan
				   $this->cancelPreviousSubscription(1, $user);

				   $str_user_url = 	$base_url . '/user/free/profile';
				}
				else
				{
				  $str_user_url = Utilities::get_user_url($base_url, $user);
				}


                $data['email'] = @$user->email;
                $data['name']  = @$user->first_name.' '.@$user->last_name;
                $data['plan_name']  = @$plan->name;


                if(empty($change_plan)) {

					/*Mail::send('mail.invoice.subscription',$data, function($message) use ($data) {
                    $message->to(trim($data['email']), 'People Of Play')
                    ->subject('Welcome Email');
                    $message->from(config('mail.from.address'),'People Of Play');
                    });*/

					$this->send_mail_by_phpmailer(trim($data['email']), 'Welcome Email', 'mail.invoice.welcome_free', $data);

                } else {

                    $pre_plan  = $user->subscription;
                    $data['pre_plan_name'] = $pre_plan->plan->name;

                    /*Mail::send('mail.invoice.change_plan',$data, function($message) use ($data) {
                    $message->to(trim($data['email']), 'People Of Play')
                    ->subject('Change Plan Email');
                    $message->from(config('mail.from.address'),'People Of Play');
                    });*/

					$this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Changed - Peopleofplay.com', 'mail.invoice.downgrade', $data);

                }

				DB::commit();
                /**/
				$return_url = $str_user_url;
                //return redirect()->route($return_url);
				return redirect($return_url);
            }
            else
			{


			   // get the secret id and sorce id from the url
               if( $request->has('client_secret') ) {
                 $str_client_secret_new = $request->query('client_secret');
               }

			   if( $request->has('source') ) {
                 $str_source_new = $request->query('source');
               }

			   if( $request->has('str_resp_data_src_id_new') ) {
                 $str_resp_data_src_id_new = $request->query('str_resp_data_src_id_new');
               }

			   if( $request->has('session_id') ) {
                 $str_session_id_new = $request->query('session_id');
               }


               // echo $str_client_secret_new ."==".$str_source_new."==".$str_resp_data_src_id_new."==". $str_session_id_new; die;
			//    pr($request->all()); die;
			   if(!empty($request->invoice_id)){
					$str_invoice_Id = $request->invoice_id;
			   }else{
				   $str_invoice_Id = '';
			   }

              return view('front.auth.payment-gateway', compact('str_session_id_new', 'plan', 'role_id','change_plan', 'str_client_secret_new', 'str_source_new', 'str_resp_data_src_id_new','str_invoice_Id'));
		    }
        } catch (\Exception $e) {
            // abort(404);
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

	function get_payment_error_page_content($error_type, $id, $request)
	{
		$str_error_message = '';
		// get the secret id and sorce id from the url
               if( $request->has('error_message') ) {
                 $str_error_message = $request->query('error_message');
               }

		try {

				DB::beginTransaction();

				if(!empty($str_error_message))
				{
					// save the data in log table
					$this->save_payment_log(0, 0, $str_error_message);
				}

				$payment_log_data = '';

				if(!empty($id))
				{
				  $payment_log_data = @PaymentLog::where('id', $id)->orderBy('id','desc')->first();
				}

				DB::commit();

		} catch (\Exception $e) {
            // abort(404);
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }

        $this->save_empty_coupon_data_session();

		$view_content = (string)View::make('front.auth.payment_failed', compact('payment_log_data', 'error_type', 'str_error_message'))->render();
		   /*  */
	    return $view_content;

	}

    function payment_cancel(Request $request, $id){

		echo $this->get_payment_error_page_content('cancel', $id, $request);
    }


    function payment_failed(Request $request, $id){

		echo $this->get_payment_error_page_content('failed', $id, $request);
    }

	// save the new legacy stripe check out data using session
	function saveSubscriptionData(Request $request)
    {
    	 // echo Carbon::parse('2022-05-16 07:33:28')->addDay(365); die;

		// echo '<pre>request - '; print_r($request->all()); die;
		$this->set_stripe_apikey();
		$str_session_id = $request->str_session_id;
		//echo 'session id:'.$request->session_id;
		$plan_id = @$request->plan_id;
		$str_subscription_id_new = '';
		$str_user_stripe_id = '';
		$invoice_url = '';

		   $request->validate([
            //'paymentMethod' => 'required',
            //'paymentMethod.card' => 'required',
            //'paymentMethod.card.brand' => 'required',
            //'paymentMethod.card.last4' => 'required',
            //'paymentMethod.id' => 'required',
            'plan_id' => 'required|exists:plans,id'
          ]);

		  if(!empty($str_session_id))
		  {
			  $session = \Stripe\Checkout\Session::retrieve($str_session_id);
			  //echo '<pre>';
			  //print_r($session);
			  //echo '</pre>';
			  $str_subscription_id_new = @$session->subscription;
			  $str_user_stripe_id = @$session->customer;
		  }

            $int_payment_log_id = 0;
		$str_time = time();
        // pr($request->all(),1);
        if(!empty($plan_id))
		{

			try {

				DB::beginTransaction();

				// $plan_id = 9;
				$plan = Plan::find($plan_id);
				$str_stripe_plan_id = $this->getPlanIdNew($plan);
				$change_plan = ($request->change_plan) ? $request->change_plan : 0 ;
				$user = User::find(get_current_user_info()->id);

				$user_current_info = get_current_user_info();
				if(isset($user_current_info->subscription->stripe_id) && !empty($user_current_info->subscription->stripe_id)){
					$user->stripe_id = $user_current_info->subscription->stripe_id;
					// echo '<pre>user_current_info - '; print_r($user_current_info->subscription->toArray()); die;
				}

				//$str_stripe_coupon_id_hidden =  $request->stripe_coupon_id_hidden;
				if(empty(@$request->coupon_code)){
					$this->save_empty_coupon_data_session();
				}
				$str_stripe_coupon_id_hidden = session()->get('stripe_coupon_id_new');
				$int_coupon_code_data_id = session()->get('int_coupon_code_data_id');

				$int_hundred_discount_flag = $request->int_hundred_discount_flag;
				$str_resp_data_src_id_new = $request->str_resp_data_src_id_new;

				$this->set_stripe_apikey();


				// if the 100% discount is not enterd then execute the stripe payment
				if(empty($int_hundred_discount_flag))
				{

					$stripe_subscription = Subscription::retrieve($str_subscription_id_new);

					//when the user is not created by stripe
					if(empty($str_user_stripe_id))
					{
						//echo 'a';
					// save the data in log table
					$int_payment_log_id = $this->save_payment_log(0, 0, '');
					DB::commit();

					$message = ['int_payment_log_id' => $int_payment_log_id, 'type'=> 'cancel','msg' => 'There was a problem
					while creating the Customer. Please try again.'];
					return response()->json($message, 422);
					}

					$pre_plan = '';

					// cancel a subscription in stripe if already exists for change plan
					$this->cancelPreviousSubscription($change_plan, $user);

					//print_r($stripe_subscription);

					//when only the user has been created by stripe
					if(empty($str_subscription_id_new))
					{
						//echo 'b';
					// save the data in log table
					$int_payment_log_id = $this->save_payment_log(0, $str_user_stripe_id, '');

					DB::commit();
					$message = ['int_payment_log_id' => $int_payment_log_id, 'type'=>'cancel','msg'=>'There was a problem while creating the Subscription. Please try again.'];
					return response()->json($message, 422);
					}

					//when the entire subscription creation fails
					if($stripe_subscription['status']!="active")
					{
						//echo 'c';
						// save the data in log table
						$int_payment_log_id = $this->save_payment_log($str_subscription_id_new, $str_user_stripe_id, '');
						DB::commit();

						$message = ['int_payment_log_id' => $int_payment_log_id, 'type'=> 'failed','msg' => 'There was a problem while making the Payment. Please try again.'];
						return response()->json($message, 422);
					}

				}
				if(!empty($int_hundred_discount_flag))
				{
					// cancel a subscription in stripe if already exists for change plan
					$this->cancelPreviousSubscription($change_plan, $user);
				}

				$type_of_user_hidden = $plan->type_of_plan;

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

				if(empty($int_hundred_discount_flag))
				{
					$user->stripe_id = $str_user_stripe_id;
				}

				$user->type_of_user = $user_type;
				$user->role = $role_id;
				$user->gold = 0;

				// $user->type_of_user = $user->type_of_user;
				// if(!empty($role_id_hidden) && $role_id_hidden>1)
				// {
				//    $user->role = $role_id_hidden;
				// }

				// End Stripe
				$subscription = new UserSubscription();
				$subscription->user_id = $user->id;
				$subscription->plan_id = $plan->id;
				$subscription->price = $plan->price;
				$subscription->coupon_code_id = $int_coupon_code_data_id;
				$subscription->validity = $plan->validity;
				$subscription->ends_at = Carbon::now()->addDay($plan->validity);
				$subscription->payment_status = 2;

				$payment_id = '';
				if(empty($int_hundred_discount_flag))
				{
					$st_customer_paments = PaymentIntent::all(['customer'=>$str_user_stripe_id,'limit' => 1]);
					$subscription->stripe_id = $str_user_stripe_id;
					$subscription->stripe_subscription_id = $str_subscription_id_new;
					$subscription->stripe_payment_id = $payment_id = $st_customer_paments->data[0]->id;
					$st_get_invoice = Invoice::retrieve($stripe_subscription->latest_invoice,[]);
					$invoice_url = $st_get_invoice->hosted_invoice_url;
				}
				else
				{

					$stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
					if(!empty($user->stripe_id)){
						// echo 'if - '; die;

						$st_cus_create_id = $user->stripe_id;

						$st_get_subscriptions = $stripe->subscriptions->all(['customer'=>$st_cus_create_id,'limit' => 100]);
						$err = 0;
						// $err = 1;
						$coupon_code = $this->getCouponIdNew($request->coupon_code);
						$st_coupon_code = $stripe->coupons->retrieve($coupon_code, []);

						// echo $str_stripe_plan_id;
						// pr($st_get_subscriptions->toArray()); die;
						if(!empty($request->stripe_invoice_renew_id_hidden)){

							$st_inv_retrive = $stripe->invoices->retrieve($request->stripe_invoice_renew_id_hidden,[]);

							$st_subs_retrive = $stripe->subscriptions->retrieve($st_inv_retrive->subscription,[]);
							$subs_id = $st_inv_retrive->subscription;

							$st_all_invs = $stripe->invoices->all(['customer'=>$st_cus_create_id,'subscription'=>$subs_id,'limit' => 100]);

							foreach($st_all_invs as $st_all_inv){
								if(!empty(@$st_all_inv->discount->coupon->id) && @$st_all_inv->discount->coupon->id == $st_coupon_code->id){

									$message = ['type'=>'same_code','msg'=>'This code is apply for once per customer.'];
									return response()->json($message, 422);	die;
								}
							}

							// pr($st_subs_retrive->toArray()); die;
							// pr($st_all_invs->toArray()); die;

							$billingDate = Carbon::parse(date('Y-m-d h:i:s a',$st_subs_retrive->current_period_end))->addDay($plan->validity);
							$billing_date = strtotime($billingDate);

							$st_get_subscription = $stripe->subscriptions->update(
								$subs_id,[
									'coupon' => $st_coupon_code->id,
									'collection_method' => 'send_invoice',
									'days_until_due' => '0',
									'billing_cycle_anchor' => 'now',
									'proration_behavior' => 'none',
								]
							);
							// // On update time billing_cycle_anchor must be 'unset,'now' or 'unchanged';

							$st_flz_inv = $stripe->invoices->finalizeInvoice($st_get_subscription->latest_invoice, []);

							$st_finalize_invoice = $stripe->invoices->retrieve($st_get_subscription->latest_invoice,[]);

							$invoice_url = $st_finalize_invoice->hosted_invoice_url;

							$stripe->invoices->voidInvoice($request->stripe_invoice_renew_id_hidden,[]);

						}else{

							foreach($st_get_subscriptions as $st_get_subscription){
								if($st_get_subscription->plan->id == $str_stripe_plan_id){
									$subs_id = $st_get_subscription->id;

									$billingDate = Carbon::parse(date('Y-m-d h:i:s a',$st_get_subscription->current_period_end))->addDay($plan->validity);
									$billing_date = strtotime($billingDate);

									$st_get_subscription = $stripe->subscriptions->update(
										$subs_id,[
											'coupon' => $st_coupon_code->id,
											'collection_method' => 'send_invoice',
											'days_until_due' => '0',
											'billing_cycle_anchor' => 'now',
											'proration_behavior' => 'none',
										]
									);
									// // On update time billing_cycle_anchor must be 'unset,'now' or 'unchanged';

									// if(!empty(@$st_get_subscription->discount->coupon->percent_off)){
									// 	$amount_decimal = $st_get_subscription->plan->amount_decimal - ($st_get_subscription->plan->amount_decimal * $st_get_subscription->discount->coupon->percent_off / 100);
									// }else{
									// 	$amount_decimal = $st_get_subscription->plan->amount_decimal;
									// }

									// $invoiceItems = $stripe->invoiceItems->create([
									// 	'customer' => $st_cus_create_id,
									// 	// 'price' => $str_stripe_plan_id,
									// 	'amount' => $amount_decimal,
									// 	'currency' => $st_get_subscription->plan->currency,
									// ]);
									// $st_new_invoice = $stripe->invoices->create([
									// 	'customer' => $st_cus_create_id,
									// 	'subscription' => $subs_id,
									// ]);
									$st_flz_inv = $stripe->invoices->finalizeInvoice($st_get_subscription->latest_invoice, []);


									$st_finalize_invoice = $stripe->invoices->retrieve($st_get_subscription->latest_invoice,[]);

									$invoice_url = $st_finalize_invoice->hosted_invoice_url;

									// echo $invoice_url.'<br>';
									// echo $st_get_subscription->plan->amount_decimal.' - '.@$st_get_subscription->discount->coupon->percent_off.' - '.$amount_decimal;
									// pr($st_get_subscription); //die;
									$err = 0;
									break;
								}else{
									// echo 'esle - <br>';
									$err++;
								}
							}

							if($err != 0){
								$st_customer = $stripe->customers->retrieve($st_cus_create_id,[]);

								if(($st_customer->metadata->coupon_code == $st_coupon_code->id) && ($st_coupon_code->duration != 'forever')){
									$message = ['type'=>'same_code','msg'=>'This code is apply for once per customer.'];
									return response()->json($message, 422);	die;
								}
								$st_subscription_create = $stripe->subscriptions->create([
									'customer' => $st_cus_create_id,
									'items' => [
										['price' => $str_stripe_plan_id],
									],
									'coupon' => $st_coupon_code->id,
									'collection_method' => 'send_invoice',
									'days_until_due' => '0',
								]);
								$subs_id = $st_subscription_create->id;

								$st_finalize_invoice = $stripe->invoices->sendInvoice($st_subscription_create->latest_invoice,[]);

								$invoice_url = $st_finalize_invoice->hosted_invoice_url;
								// echo '<pre>Live st_subscription_create - '; print_r($st_subscription_create);
							}
						}

					}else{
						// echo 'else - '; die;
						$coupon_code = $this->getCouponIdNew($request->coupon_code);
						$st_coupon_code = $stripe->coupons->retrieve($coupon_code, []);

						$st_cus_create = $stripe->customers->create(['email'=>$user->email,'name'=>$user->first_name.' '.$user->last_name,'metadata' => ['coupon_applied'=>'yes','coupon_code'=>$st_coupon_code->id]]);
						$st_cus_create_id = $st_cus_create->id;

						$st_get_subscriptions = $stripe->subscriptions->create([
							'customer' => $st_cus_create_id,
							'items' => [
							['price' => $str_stripe_plan_id],
							],
							'coupon' => $st_coupon_code->id,
							'collection_method' => 'send_invoice',
							'days_until_due' => '0',
						]);
						// echo "<pre>st_get_subscriptions - "; print_r($st_get_subscriptions); die;
						$subs_id = $st_get_subscriptions->id;

						$st_finalize_invoice = $stripe->invoices->sendInvoice($st_get_subscriptions->latest_invoice,[]);
						$invoice_url = $st_finalize_invoice->hosted_invoice_url;

						// echo "<pre>st_send_invoice - "; print_r($st_send_invoice); die;
					}
					$st_payment_create = $stripe->paymentIntents->all(['customer'=>$st_cus_create_id,'limit' => 1]);

					$subscription->stripe_id = $st_cus_create_id;
					$subscription->stripe_subscription_id = $subs_id;
					$subscription->stripe_payment_id = $payment_id;
					// $subscription->stripe_payment_id = $st_payment_create->data[0]->id;
					//   $subscription->stripe_id = $str_time;
					//   $subscription->stripe_subscription_id = 0;

					// echo '<pre>subscription - '; print_r($subscription->toArray()); die;

					$user->stripe_id = $st_cus_create_id;
					//   $user->stripe_id = $str_time;
				}
				$subscription->stripe_plan_id = $str_stripe_plan_id;
				$user->save();
				$subscription->save();

				// $subscription->updateOrCreate(['stripe_payment_id' => $payment_id], $subscription->toArray());

				// $user->notify(new InvoicePaid());
				$user = User::find(get_current_user_info()->id);

				$base_url = url('/');
				$str_user_url = Utilities::get_user_url($base_url, $user);

				$data['email'] = @$user->email;
				$data['name']  = @$user->first_name.' '.@$user->last_name;
				$data['plan_name']  = @$plan->name;
				$data['plan_id']  = @$plan->id;
				$data['plan_price']  = @$plan->price;
				$data['str_user_url']  = @$str_user_url;
				$data['pre_plan']       = @$pre_plan;
				$data['end_date']       = @$subscription->ends_at;
				$data['invoice_url']       = @$invoice_url;

				session()->put('data', $data);
				session()->put('change_plan', $change_plan);

				Session::flash('user_subscribe_data_saved_flag', 1);

				//when the entire subscription is created successfully
				if(!empty($str_subscription_id_new) && !empty($str_user_stripe_id))
				{
					$str_payment_method_obj =	 PaymentMethod::all([
						'customer' => $str_user_stripe_id,
						'type' =>'card',
						'limit' => 1
						]);

					// attach a payment method to customer
					if(!empty($str_payment_method_obj->data[0]->id))
					{
						$str_payment_method_obj_data_id = @$str_payment_method_obj->data[0]->id;

						$obj_customers_update = Customer::update(
						$str_user_stripe_id,
						['invoice_settings' => ['default_payment_method' => $str_payment_method_obj_data_id]]
						);
					}

				//echo 'd';

				/*$pm = PaymentMethod::retrieve($str_resp_data_src_id_new);
					$cpm = $pm->attach(['customer' => $str_user_stripe_id]);

					$obj_customers_update = Customer::update(
					$str_user_stripe_id,
					['invoice_settings' => ['default_payment_method' => $str_resp_data_src_id_new]]
					);*/

				// save the data in log table
				$this->save_payment_log($str_subscription_id_new, $str_user_stripe_id, '');
				}

				//return redirect($str_user_url);
				DB::commit();
				// return successMessage($str_user_url);

				$base_url = url('/');
				$str_user_url = Utilities::get_user_url($base_url, $user);

				if(empty($int_hundred_discount_flag))
				{
					// $this->send_mail_by_phpmailer(trim($data['email']), 'Welcome to People of Play - Peoplofplay.com', 'mail.invoice.change_plan', $data);

					$this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile Was Created - Peoplofplay.com', 'mail.invoice.new_register', $data);
					Session::flash('user_plan_created_data_saved_flag', 1);

					return successMessage('Payment Successful, Please Wait...');
				}
				// if user has entered a 100% discount coupon code
				else
				{
					if(!empty($change_plan)){

						if(@$data['plan_price'] < @$pre_plan->plan->price){
							$this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Changed - Peopleofplay.com', 'mail.invoice.downgrade', $data);
						} else {
							$this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Upgraded - Peoplofplay.com', 'mail.invoice.upgrade', $data);
						}

						Session::flash('user_plan_upgrade_data_saved_flag', 1);
					}else{
						$this->send_mail_by_phpmailer(trim($data['email']), 'Welcome to People of Play - Peoplofplay.com', 'mail.invoice.change_plan', $data);

						$this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile Was Created - Peoplofplay.com', 'mail.invoice.new_register', $data);
						Session::flash('user_plan_created_data_saved_flag', 1);
					}

					return successMessage($str_user_url);
				}

			} catch (\Exception $e) {
				DB::rollback();
				return errorMessage($e->getMessage(), true);
			}

	  }

	}

	// create a new check out session
	function create_checkout_session(Request $request)
    {
		// pr($request->all()); die;
		if(empty(@$request->stripe_coupon_id_hidden)){
			$this->save_empty_coupon_data_session();
		}
		$user = Auth::guard('users')->user();
		$user_current_info = get_current_user_info();
		if(isset($user_current_info->subscription->stripe_id) && !empty($user_current_info->subscription->stripe_id)){
			$user->stripe_id = $user_current_info->subscription->stripe_id;
			// echo '<pre>user_current_info - '; print_r($user_current_info->subscription->toArray()); die;
		}

		$plan_id = @$request->plan_id;
		$current_url_new = @$request->current_url_new;

		$stripe_coupon_id_hidden = @$request->stripe_coupon_id_hidden;
		//, $role_id_hidden, $change_plan, $int_hundred_discount_flag ,$str_resp_data_src_id_new, $plan_id

		$user_stripe_id = '';

		if(!empty($user->stripe_id) && strpos($user->stripe_id, 'us_')>0)
		{
		  $user_stripe_id = @$user->stripe_id;
		}
        else
		{
		  $user_stripe_id = '';
		}

		$get_plan_details = Plan::get_plan_details($plan_id);

		$price_id_new = $this->getPlanIdNew($get_plan_details);
		// echo $price_id_new; die;

		$this->set_stripe_apikey();

		header('Content-Type: application/json');

		$YOUR_DOMAIN = url('/');

	   $arr_session_data =	array(
		  'payment_method_types' => ['card'],
		//   'customer_email' => @$user->email,
		  // 'start_date'=>'20/12/2021',
		  'line_items' => [[
			'price' => $price_id_new,
			'quantity' => 1,
		  ]],
		  'mode' => 'subscription',
		  'discounts' => [[
			'coupon' => $stripe_coupon_id_hidden,
		  ]],
		//   'allow_promotion_codes' => true,
		  // 'start_at'=>1635510049,
		  // "billing_cycle_anchor"=> 1635510049,
		  'success_url' => $current_url_new.'?session_id={CHECKOUT_SESSION_ID}',
		  //'success_url' => $YOUR_DOMAIN . '/plan/save-subscription-data/'.$role_id_hidden.'/'.$change_plan.'/'.$int_hundred_discount_flag.'/'.$str_resp_data_src_id_new.'/'.$plan_id.'/'.'?session_id={CHECKOUT_SESSION_ID}',
		  'cancel_url' => $YOUR_DOMAIN . '/payment/cancel/0',
		  'metadata' => [[@base64_encode(@$user->id)]]
		);

	   // echo "sds"; die;

		// for auto fill the card details
		if(!empty($user_stripe_id)){
		   $arr_session_data['customer'] = @$user_stripe_id;
		   // $arr_session_data['start_date'] ='now';
		   // $arr_session_data['end_behavior'] ='release';
		}elseif(empty($user_stripe_id)){
			$arr_session_data['customer_email'] = @$user->email;
		}

		// pr($request->all());
		// echo '<pre>'; print_r($arr_session_data); die;
		$checkout_session = \Stripe\Checkout\Session::create($arr_session_data);

		// return redirect($checkout_session->url); die;
		//***** || Mail || ***** //

		$to_name = $user->first_name.' '.$user->last_name;
        $to_email = 'nitish.nitz@gmail.com';
        // $to_email = 'shubham16.sws@gmail.com';
        $data = array("username" => $to_name);
        $message ="";
        $subject = "User $to_name is ready for payment.";

		// $view = view('mail.auth.make_payment', $data)->render();
		// echo $view; die;
		// echo '<pre>';print_r($data); die;
		$moduleController = new ModuleController();
		$send_mail = $moduleController->send_mail_by_phpmailer($to_email, $subject  .' PeopleofPlay.com', 'mail.auth.make_payment', $data);

		//***** || Mail || ***** //

		echo json_encode(['id' => $checkout_session->id,'url'=>$checkout_session->url]);
		exit;
	}

	function set_stripe_apikey()
	{
	   Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
    }

    function payment_success(Request $request){

//dd($request);
        $base_url = url('/');
		$discount_per = 0;
        $after_apply = 0;
		$couponcode_data = '';
		// $user = User::find(30);
        $user = Auth::guard('users')->user();

        $subscription = UserSubscription::get_user_subscription_data($user);

		if(!empty($subscription->coupon_code_id))
		{
		  $couponcode_data = CouponCode::where('id',@$subscription->coupon_code_id)->orderBy('id','desc')->first();
	    }

	    $str_coupon_code = @$couponcode_data->coupon_code;
		$discount_value = @$couponcode_data->discount_value;
		$discount_percent = @$couponcode_data->discount_percent;
		$subscription_price = @$subscription->price;

		$arr_price_data = UtilitiesTwo::get_discount_price_data($discount_value,  $discount_percent, $subscription_price);

		$discount_per = $arr_price_data[0];
		$after_apply = $arr_price_data[1];

		$user->stripe_subscription_id = @$subscription->stripe_subscription_id;
		$user->stripe_payment_id = @$subscription->stripe_payment_id;
        $plan  = Plan::find(@$subscription->plan_id);
        $user->plan = @$plan->name;
        $countries = Country::pluck('country_name', 'id');
        if(!empty($user->country_id) ) {
          $country_id = @$user->country_id;
        } else {
          $country_id = 234;
        }
        foreach($countries as $id => $name) {
            if($id == $country_id){
                $user->country = $name;
                break;
            }
        }

        $data = session()->get('data');
        $change_plan = session()->get('change_plan');

        $data['country'] = @$user->country;
        $data['mobile']  = @$user->mobile;

        $plan = $data['plan_id'];

        $email_template = 'subscription';
        if($plan == 1){
            $email_template = 'welcome_free';
        } elseif ($plan == 2) {
            $email_template = 'welcome_pro';
        } elseif ($plan == 3) {
            $email_template = 'welcome_basic';
        } elseif ($plan == 4) {
            $email_template = 'welcome_company';
        }

		$pre_plan = $data['pre_plan'];

        $data['pre_plan_name'] = @$pre_plan->plan->name;

		$data['subs_pre_plan_price'] = $subs_pre_plan_price = @$subscription->price;
		$data['subs_pre_plan_validity'] = $subs_pre_plan_validity = @$subscription->validity;
		$data['subs_pre_plan_ends_at'] = $subs_pre_plan_ends_at = @$subscription->ends_at;

        $emails = array('harrison@playelevatorup.com', 'marycouzin@gmail.com', 'jaz.chitag@gmail.com', 'nitish.nitz@gmail.com');

		$this->save_empty_coupon_data_session();

		$str_user_url_new = Utilities::get_user_url($base_url, $user);

		$data['str_profile_content_mail'] = 'We suggest you share your profile on social media. I just signed up for POP.';
		$data['str_profile_content_mail'] = $data['str_profile_content_mail'] . 'You should, too! <a target="_blank" href="'.$str_user_url_new.'">(your personal url)</a>. We also suggest you add it to your signature block.';

        try {
            if(empty($change_plan)) {

                /*Mail::send('mail.invoice.'.$email_template,$data, function($message) use ($data) {
                    $message->to(trim($data['email']), 'People Of Play')
                    ->subject('Welcome to - '.$data["plan_name"].' - '.$data["name"].' - PeopleofPlay.com');
                    $message->from(config('mail.from.address'),'People Of Play');
                });*/

				$this->send_mail_by_phpmailer(trim($data['email']), 'Welcome to - '.$data["plan_name"].' - '.$data["name"].' - PeopleofPlay.com', 'mail.invoice.'.$email_template, $data);

                /*Mail::send('mail.invoice.new_register',$data, function($message) use ($data,$emails) {
                    $message->to($emails, 'People Of Play')
                    ->subject('New Registration at PeopleofPlay - '.$data["name"].' - '.$data["plan_name"]);
                    $message->from(config('mail.from.address'),'People Of Play');
                });*/

				$this->send_mail_by_phpmailer($emails, 'New Registration at PeopleofPlay - '.$data["name"].' - '.$data["plan_name"], 'mail.invoice.new_register', $data);


            } else {

                if(@$data['plan_price'] < @$pre_plan->plan->price){
                    $this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Changed - Peopleofplay.com', 'mail.invoice.downgrade', $data);
                } else {
                    $this->send_mail_by_phpmailer(trim($data['email']), 'Your People of Play Profile was Upgraded - Peoplofplay.com', 'mail.invoice.upgrade', $data);
                }

				/*Mail::send('mail.invoice.change_plan',$data, function($message) use ($data) {
                $message->to(trim($data['email']), 'People Of Play')
                ->subject('Change Plan Email');
                $message->from(config('mail.from.address'),'People Of Play');
                });*/

				// $this->send_mail_by_phpmailer(trim($data['email']), 'Change Plan Email', 'mail.invoice.change_plan', $data);

            }
            return view('front.auth.payment_success',compact('user', 'subs_pre_plan_price', 'subs_pre_plan_validity', 'subs_pre_plan_ends_at', 'discount_per', 'after_apply', 'str_coupon_code'));
        } catch (\Exception $e) {
            return view('front.auth.payment_success',compact('user', 'subs_pre_plan_price', 'subs_pre_plan_validity', 'subs_pre_plan_ends_at', 'discount_per', 'after_apply', 'str_coupon_code'));
        }

    }

    public function manage_account_subscription()
    {
        $user = get_current_user_info();
        $news = News::orderBy('created_at', 'desc')
            ->paginate(30);

        return view('front.user.account_subscription', compact('news', 'user'));
    }


	// ofr applying the coupon code
	public function get_coupon_id_by_code_ajax(Request $request)
    {
		if(@$request->coupon_type == 'remove_code'){
			$this->save_empty_coupon_data_session();
			return response()->json(['status'=>1,'msg'=>'Coupon removed successfully']);  die;
		}

		$int_coupon_code_data_id = 0;

		$str_coupon_code_message = 'Coupon doesnt Exist. Please try again.';

		$message = ['type'=>'error','msg'=>$str_coupon_code_message];

		if(!empty($request->str_coupon_code))
		{

		try {
            DB::beginTransaction();

			//$request->validate([
            //'str_coupon_code' => 'required'
        //]);


			$str_coupon_code =  $request->str_coupon_code;

			$str_coupon_code = strtoupper($str_coupon_code);

			$coupon_code_data = CouponCode::where('coupon_code',$str_coupon_code)->orderBy('id','desc')->first();

			if(empty($coupon_code_data->id))
            {
			   $this->save_empty_coupon_data_session();
               DB::rollback();
               return response()->json($message, 422);
            }

			$int_coupon_code_data_id = $coupon_code_data->id;

			 $is_live_url_mode =  UtilitiesTwo::chkLiveCurrentUrl();

			if(!empty($is_live_url_mode))
			{
			   $stripe_coupon_id =	@$coupon_code_data->stripe_coupon_id_live;
			}
			else
			{
				$stripe_coupon_id =	@$coupon_code_data->stripe_coupon_id;
			}


			if(empty($stripe_coupon_id))
            {
				 $this->save_empty_coupon_data_session();
                 DB::rollback();
                 return response()->json($message, 422);
            }

			$stripe = Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

			$stripe_coupon_id = trim($stripe_coupon_id);

			// $testArray=array('jujj'=>$stripe_coupon_id);
			// echo json_encode($testArray);exit;
            $stripe_coupon_response = \Stripe\Coupon::retrieve($stripe_coupon_id, []);
            // $testArray=array('jujj'=>$stripe_coupon_response);
			// echo json_encode($testArray);exit;


			$stripe_coupon_response_percent_off = '';

			$stripe_coupon_response_amount_off = '';

			if(!empty(@$stripe_coupon_response->percent_off))
			{
			  $stripe_coupon_response_percent_off =  @$stripe_coupon_response->percent_off;
			}

			if(!empty($stripe_coupon_response->amount_off))
			{
			  $stripe_coupon_response_amount_off =  @$stripe_coupon_response->amount_off;
			}


            if(empty($stripe_coupon_response->id))
            {
			   $this->save_empty_coupon_data_session();
               DB::rollback();
               $message = ['type'=>'error','msg'=>'There was a problem while fetching the coupon data. Please try again.'];
               return response()->json($message, 422);
            }

            if($stripe_coupon_response->id!=$stripe_coupon_id)
            {
		       $this->save_empty_coupon_data_session();
               DB::rollback();
			   $message = ['type'=>'error','msg'=>$str_coupon_code_message];
               return response()->json($message, 422);
			}
			else
			{

			}

			session()->put('stripe_coupon_id_new', $stripe_coupon_id);
			session()->put('int_coupon_code_data_id', $int_coupon_code_data_id);

             // pr($stripe_subscription,1);

            // End Stripe

            DB::commit();
            return successMessage( array( 0 => $stripe_coupon_id, 1 =>'Coupon applied succesfully', 2 => $stripe_coupon_response_percent_off, 3 => $stripe_coupon_response_amount_off, 4 => $int_coupon_code_data_id));
        } catch (\Exception $e) {

			$this->save_empty_coupon_data_session();

			DB::rollback();
            return errorMessage($e->getMessage(), true);
        }

	   }
	   else
	   {
		   $this->save_empty_coupon_data_session();
		   return successMessage( array( 0 => '', 1 =>'', 2 => 0, 3 => 0, 4 => 0));
	   }


	}


	function save_empty_coupon_data_session()
	{
		session()->put('stripe_coupon_id_new', '');
		session()->put('int_coupon_code_data_id', '');
	}

	function payment_pay()
	{
		return view('cash_collocation');
	}

	public function getCouponIdNew($coupon_code)
    {
		$coupon = CouponCode::where('coupon_code',$coupon_code)->first();
		$is_live_url_mode =  UtilitiesTwo::chkLiveCurrentUrl();

		if(!empty($is_live_url_mode)){
		   $str_stripe_coupon_id =	$coupon->stripe_coupon_id_live;
		}else{
			$str_stripe_coupon_id =	$coupon->stripe_coupon_id;
		}

		return $str_stripe_coupon_id;

	}


}
