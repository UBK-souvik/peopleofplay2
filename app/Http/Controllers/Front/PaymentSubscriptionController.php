<?php

namespace App\Http\Controllers\Front;

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

class PaymentSubscriptionController extends ModuleController
{


    public function manage_payment_subscription()
    {
		$user = get_current_user_info();       	
		$subscription = UserSubscription::get_user_subscription_data($user);	
		$str_subscription_id = $subscription->stripe_subscription_id;

		$is_plan_expire=0;
		$plan_end_date='';
		
		$user_current_info = get_current_user_info();
		// echo '<pre>subscription - '; print_r($subscription->toArray()); die;
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
					$is_plan_expire = 0;
				}else{
					$stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
					$st_customer_invoices = $stripe->invoices->all(['customer'=>$user_current_info->subscription->stripe_id,'limit' => 1])->data[0];

					$st_subs = $stripe->subscriptions->retrieve($st_customer_invoices->subscription,[]);
					if(empty($st_customer_invoices->hosted_invoice_url)){

						if($st_subs->status == 'unpaid'){
							$stripe->invoices->finalizeInvoice($st_subs->latest_invoice, []);
							$st_customer_invoices = $stripe->invoices->all(['customer'=>$user_current_info->subscription->stripe_id,'limit' => 1])->data[0];
						}

					}

				}
			}
		}
		
		//echo '<pre>';
		//print_r($subscription);
		//echo '</pre>';
		//exit;
		
		// echo '<pre>'; print_r($st_subs->toArray()); 
		// echo '<pre>'; print_r($st_customer_invoices->toArray()); 
		// die;

        return view('front.user.manage_payment_subscriptions', compact('str_subscription_id', 'user', 'subscription','plan_end_date','is_plan_expire','st_customer_invoices')); 
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
		$user_current_info->subscription;
		$stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));

		$st_subscriptions = $stripe->subscriptions->all(['customer'=>$user_current_info->subscription->stripe_id,'limit' => 100]);
		$st_customer_invoices = $stripe->invoices->all(['customer'=>$user_current_info->subscription->stripe_id,'limit' => 50]);
		
		// echo '<pre>st_customer_invoices - '; print_r($st_customer_invoices); die;
		// echo '<pre>st_customer_invoice - '; print_r($st_subscriptions); die;
		
		$err = 0;
		if($st_customer_invoices->data){
			foreach(array_reverse($st_customer_invoices->data) as $k => $st_customer_invoice){
				// echo '<pre>st_customer_invoice - '; print_r($st_customer_invoice); die;
				if($st_customer_invoice->paid == 1 && !empty($st_customer_invoice->payment_intent) && $st_customer_invoice->status == 'paid'){
					
					$is_live_url_mode =  UtilitiesTwo::chkLiveCurrentUrl();
					$p_id = $st_customer_invoice->lines->data[0]->plan->id;
					if(!empty($is_live_url_mode)){
						$plan = Plan::where('stripe_plan_id_live',$p_id)->first();
					}else{
						$plan = Plan::where('stripe_plan_id',$p_id)->first();
					}

					if(!empty($st_customer_invoice->discount->coupon->id)){		
						$c_id = $st_customer_invoice->discount->coupon->id;				
						if(!empty($is_live_url_mode)){
							$coupon_code = CouponCode::where('stripe_coupon_id_live',$c_id)->first();
						}else{
							$coupon_code = CouponCode::where('stripe_coupon_id',$c_id)->first();
						}
					}else{
						$coupon_code = 0;
					}
					$paymentIntents = $stripe->paymentIntents->retrieve($st_customer_invoice->payment_intent,[]);
					$pay_date = date('Y-m-d h:i:s',$paymentIntents->created);
					// echo '<pre>paymentIntents - '; print_r($paymentIntents); die;
					
					$up_data = array(
						'user_id' => $user_current_info->id,
						'plan_id' => $plan->id,
						'stripe_payment_id' => $st_customer_invoice->payment_intent,
						'stripe_id' => $st_customer_invoice->customer,
						'stripe_plan_id' => $p_id,
						'price' => $plan->price,
						'coupon_code_id' => $coupon_code,
						'validity' => $plan->validity,
						'ends_at' => Carbon::parse($pay_date)->addDay($plan->validity),
						'stripe_subscription_id' => $st_customer_invoice->subscription,
						'payment_status' => 2,
						'created_at' => date('Y-m-d h:i:s',$paymentIntents->created),
						'updated_at' => date('Y-m-d h:i:s',$paymentIntents->created),
					);
					
					
					$user_subscription = UserSubscription::where(['user_id' => $user_current_info->id,'stripe_payment_id' => $st_customer_invoice->payment_intent,'stripe_id' => $st_customer_invoice->customer,'stripe_plan_id' => $p_id,'stripe_subscription_id' => $st_customer_invoice->subscription])->orderBy('id','DESC')->first();

					if(empty($user_subscription->id)){
						UserSubscription::insert($up_data);
						$err++;
					}
					// echo "<pre>up_data $err - "; print_r($up_data); 
					// echo '<pre>paymentIntents - '; print_r($paymentIntents); die;
				}else{
					// echo 'No such coustomer';
				}
			}
			$due_date = date('Y-m-d',$st_customer_invoices->data[0]->due_date);
			$today = date('Y-m-d');
			if($st_customer_invoices->data[0]->status == 'open' && ($due_date < $today)){
				$err = 0;
			}
		}
		return $err;
		die;
	}
	
}