<?php

namespace App\Http\Controllers\Front;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\View;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

class AccountAjaxController extends ModuleController
{
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();
	}
	
	public function getAjaxAccountData(Request $request)
    {
		    $str_card_last_four ='';
			$str_card_brand ='';
		    $int_manage_payment_subscription_flag = 0;
		     Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
			 
			    $current_url_new = $request->current_url_new;
                
                 // for a payment subscriptions page
				 if(strpos($current_url_new, 'manage-payment-subscription')>0)
				 {
			        $int_manage_payment_subscription_flag = 1;		 
				 } 				 
				 		
				$current_user = get_current_user_info();		
						
				$str_customer_id =  @$current_user->stripe_id;					
						
				$str_customer_id = trim($str_customer_id);
				
				$customer_data = @Customer::retrieve(@$str_customer_id);
			
			   if(!empty(@$customer_data->invoice_settings['default_payment_method']))
			   {
			        $default_payment_method = @$customer_data->invoice_settings['default_payment_method'];	
				
						$payment_data = PaymentMethod::retrieve(
					  @$default_payment_method,
					  []
					);
					
					$str_card_last_four = @$payment_data->card['last4'];
					
					$str_card_brand = @$payment_data->card['networks']['available'][0];
			   }
			   
			   
			return view('front.profile.view_account_info', compact('int_manage_payment_subscription_flag','str_card_last_four','str_card_brand'));
	}
	
	
	
	
	public function getInvoicesBySubscriptionAjaxData(Request $request)
    {
		$current_user = get_current_user_info();
		$int_manage_payment_subscription_flag = 0;
		 Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
			 
		$subscription = UserSubscription::get_user_subscription_data($current_user);
		
		$str_subscription_id = $subscription->stripe_subscription_id;
		
		$str_subscription_id = trim($str_subscription_id);

		$cron = new UserSubscriptionCronController();
		$cron->changeInvoicesStatus($subscription->id); //die;
		// echo "<pre> subscription - "; print_r($subscription->user_id); die;
		
		$invoices_data = Invoice::all(['subscription' => $str_subscription_id]);
		
        // for the count of invoices
		if(!empty($request->subscription_invoice_count))
		{
			$int_invoices_data = count(@$invoices_data);
			
			if($int_invoices_data>1)
			{
			  $str_count_invoices = $int_invoices_data . ' invoices billed.';	
			}
			else
			{
			  $str_count_invoices = $int_invoices_data . ' invoice billed.';	
			}
			
			$hosted_invoice_url = @$invoices_data['data'][0]->hosted_invoice_url;
			$invoice_id = @$invoices_data['data'][0]->id;
			
			return json_encode(array( 'str_count_invoices' =>$str_count_invoices, 'hosted_invoice_url' =>$hosted_invoice_url,'invoice_id'=>$invoice_id));
            exit;  			
		}
        else
		{
			
		}	   
            $endDate = date('Y-m-d h:i:s',strtotime($subscription->ends_at.'-1year'));
		// echo "<pre> invoices_data - "; print_r($invoices_data->toArray()); die;
			return view('front.profile.view_invoices_by_subscription', compact('str_subscription_id','int_manage_payment_subscription_flag','invoices_data','endDate','subscription'));
	}
	
	public function getInvoiceId(Request $request){
		
		pr($request->all()); die;

		$current_user = get_current_user_info();
		$subscription = UserSubscription::get_user_subscription_data($current_user);
		Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
		
		$str_subscription_id = $subscription->stripe_subscription_id;
		$invoices_data = Invoice::all(['subscription' => $str_subscription_id]);

		$invoice_id = @$invoices_data['data'][0]->id;
			
		return json_encode(array('invoice_id'=>$invoice_id)); die;

	}

}
