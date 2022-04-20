<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Config;
use DB;

use App\Http\Controllers\Front\ModuleController;
use App\Http\Controllers\Front\AuthenticationController; 
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionInvoice;
use App\Models\Plan;
use App\Models\User;
use App\Models\CouponCode;
use Exception;
use Carbon\Carbon;
use App\Helpers\UtilitiesTwo;

ini_set('max_execution_time', 0);

 
class Invoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:cron';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';
     
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->config = \App\Models\SiteSetting::get_keys(1);
    }
     
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        

        $this->sendRemainderInvoices();   
        $this->saveMissingSubscriptions();
		$this->saveCanceledSubscriptions();        
		
        $this->info('Word of the Day sent to All Users');
    }
	
	public function setApiKeys()
	{
		
	Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
	
    }




	// send mail to the users and save the invoice data in the table
	public function sendRemainderInvoices(){
		

		$this->setApiKeys();
		
		$str_date_time = date('Y-m-d H:i:s');
		
		try {
            
            DB::beginTransaction();
			
			$subscription_list_data = Subscription::all();
			
            //echo '<pre>';			
			//print_r($subscription_list_data);			
			//echo '</pre>';			
		
		$all_invoices = Invoice::all(['limit' => 20]);//['limit' => 1000]['status' => 'paid']

         foreach($all_invoices as $all_invoices_row)
		 {
			 echo '<pre>';
			 //print_r($all_invoices_row);
			 echo '</pre>';
			 echo '</br>';
			 echo 'str_invoice_id: '.$str_invoice_id = @$all_invoices_row->id;
			 $str_invoice_id = trim($str_invoice_id);
			 echo '</br>';
			 echo 'str_subscription_id: '.$str_subscription_id = @$all_invoices_row->subscription;
			 $str_subscription_id = trim($str_subscription_id);
			 echo '</br>';
			 echo 'str_invoice_status: '.$str_invoice_status = @$all_invoices_row->status;
			 $str_invoice_status = trim($str_invoice_status);
			 
			 $str_invoice_status = strtolower($str_invoice_status);
			 
			 // if the invoice is not in the retrying process(auto renewal is not running)
			 if($str_invoice_status!="draft")
			 {
				 
				 $subscription_data = UserSubscription::where([
				'stripe_subscription_id' => @$str_subscription_id
				])
				->orderBy('id', 'desc')
				->first();
				
				$int_subscription_data_id =   @$subscription_data->id;
				$int_subscription_data_plan_id =   @$subscription_data->plan_id;
				
				if(!empty($int_subscription_data_id))
				{
				     
					  $subscription_invoice_data = UserSubscriptionInvoice::where([
				'stripe_invoice_id' => @$str_invoice_id
				])
				->orderBy('id', 'desc')
				->first();
				
				      $int_subscription_invoice_data_id =   @$subscription_invoice_data->id;
					 
					 if(empty($int_subscription_invoice_data_id))
					 {
					     $subscription_invoice = new UserSubscriptionInvoice();
						 $subscription_invoice->user_id = @$subscription_data->user_id;
						 $subscription_invoice->user_subscription_id	 = @$subscription_data->id;
						 $subscription_invoice->stripe_subscription_id	= @$str_subscription_id;
						 $subscription_invoice->stripe_invoice_id = @$str_invoice_id;
						 $subscription_invoice->payment_status	 = @$str_invoice_status;
						 $subscription_invoice->status = 1;				
						 $subscription_invoice->save();
						 
						$get_user_details =  User::get_user_details(@$subscription_data->user_id);
                        $get_plan_details =  Plan::get_plan_details(@$subscription_data->plan_id);  						
						
						 $data['email'] = @$get_user_details->email;
						$data['name']  = @$get_user_details->first_name.' '.@$get_user_details->last_name;
						$data['plan_name']  = @$get_plan_details->name;
						$data['plan_price']  = @$get_plan_details->price;
						$data['invoice_url']  = @$all_invoices_row->hosted_invoice_url;
						
						$data['ends_at']  = date('Y-m-d',strtotime(@$subscription_data->ends_at));
						
						 // send mail if the auto renewal failed
						 if($str_invoice_status == "open")
			             {
						   $moduleController = new ModuleController();
                        //   $moduleController->send_mail_by_phpmailer(trim($data['email']), 'Your POP Account Auto Renewal Failed - '.$data['name'].' - People Of Play', 'mail.invoice.update_card_details', $data);
						 }
						 

					 }
					 
					 
					 $get_subscription_invoice_data = UserSubscriptionInvoice::where([
				'user_id' => @$subscription_data->user_id
				])
				->orderBy('id', 'desc')
				->get();				
				
				    if(!empty($get_subscription_invoice_data) && count($get_subscription_invoice_data)>1)
					{  
				         // if the payment is made successfully
						 if($str_invoice_status == "paid")
						 {
							 $arr_data = array();  						 
							 
							 $plan = Plan::find($int_subscription_data_plan_id);
							 
							 $str_new_validity_date = strtotime("+".@$plan->validity." day", strtotime(@$get_subscription_invoice_data[0]->created_at));
                             $str_validity_date_new =  date("Y-m-d H:i:s", @$str_new_validity_date);
							 
							 //$arr_data['ends_at'] = Carbon::now()->addDay($plan->validity);
							 $arr_data['ends_at'] = $str_validity_date_new;
							 $arr_data['updated_at'] = $str_date_time;
							 $arr_data['payment_status'] = 2;
							 $arr_data['status'] = 1;
							 
							 UserSubscription::updateOrCreate(['id' => $int_subscription_data_id], $arr_data);
						 }
						 
						 if($str_invoice_status == "paid" || $str_invoice_status == "open" || $str_invoice_status == "draft")
						 {					 
						   
						 }
						 // for a failed susbscription
						 else
						 {
							 $arr_data = array();  						 
							 
							 $arr_data['payment_status'] = 1;
							 $arr_data['status'] = 4;
							 $arr_data['updated_at'] = $str_date_time;
							 
							 UserSubscription::updateOrCreate(['id' => $int_subscription_data_id], $arr_data);						 
						 }						 
					} 
					 
					 
				}//if(!empty($subscription_data->id))
				
				
				 
			 }//if($str_invoice_status!="draft")
			 
			 
			 
		 }

          echo '<pre>';
		  //print_r($all_invoices);
          echo '</pre>';
		  //$str_checkPaidUserAuthentication =  AuthenticationController::checkPaidUserAuthentication(1);
  //$this->send_mail_by_phpmailer(trim($data['email']), 'Welcome to - '.$data["plan_name"].' - '.$data["name"].' - PeopleofPlay.com', 'mail.invoice.'.$email_template, $data);
            
            
            DB::commit();           
            echo 'Data saved successfully';
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }			
		
		
	}
	
	
	public function saveMissingSubscriptions()
	{
		$str_user_id = '';
		$int_user_id = 0;
		
		$this->setApiKeys();
		
		try {
			
			DB::beginTransaction();
		
		$sessions_list = \Stripe\Checkout\Session::all(['limit' => 20]);
		
		$int_stripe_subscription_status = 0;
        $int_stripe_payment_status = 0;	
		
		echo '<pre>';
		//print_r(@$sessions_list['data']);
		echo '</pre>';
		//exit;

        foreach(@$sessions_list['data'] as $sessions_list_row)
		{
			//echo @$sessions_list_row->id;
			  if(!empty(@$sessions_list_row->id))
			  {	  
			  
			  $int_user_id = 0;
			  
			  $str_session_id = @$sessions_list_row->id;
			  
			  if(!empty(@$sessions_list_row->metadata[0]))
			  {
			    $str_user_id = @$sessions_list_row->metadata[0];
			
			    $int_user_id = base64_decode($str_user_id);
			  }
			  
						  
			  $str_subscription_id_new = @$sessions_list_row->subscription;		  
			  $str_user_stripe_id = @$sessions_list_row->customer;
			  
			  if(!empty($str_subscription_id_new) && strpos($str_subscription_id_new, 'ub_')>0)
			  {
				  $stripe_subscription = Subscription::retrieve($str_subscription_id_new);
				  
				  $str_stripe_subscription_id = @$stripe_subscription->id;
				  $str_stripe_customer_id = @$stripe_subscription->customer;
				  $str_stripe_created_date = date('Y-m-d H:i:s', @$stripe_subscription->created);
				  $str_stripe_plan_id = @$stripe_subscription->items['data'][0]->plan->id;
				  $str_discount_code = @$stripe_subscription->discount['coupon']->id;
				  $stripe_subscription_current_period_end = date('Y-m-d H:i:s', @$stripe_subscription->current_period_end);
				  $stripe_subscription_current_period_start = date('Y-m-d H:i:s', @$stripe_subscription->current_period_start);
				  $str_stripe_subscription_status = @$stripe_subscription->status;
				  
				  if($str_stripe_subscription_status == 'active')
				  {
					  $int_stripe_subscription_status = 1;
					  $int_stripe_payment_status = 2;
				  }
				  
				  $coupon_data = CouponCode::where([
				'stripe_coupon_id' => @$str_discount_code
				])
				->orderBy('id', 'desc')
				->first();
				
				if(empty($coupon_data->id))
				{
					$coupon_data = CouponCode::where([
					'stripe_coupon_id_live' => @$str_discount_code
					])
					->orderBy('id', 'desc')
					->first();
				}
				
				if(!empty(@$coupon_data->id))
				{
				  $int_coupon_code_id = @$coupon_data->id;
				}
				else
				{
				  $int_coupon_code_id = 0;	
				}					
				
				$plan_data = Plan::where([
				'stripe_plan_id' => @$str_stripe_plan_id
				])
				->orderBy('id', 'desc')
				->first();
				
				if(empty($plan_data->id))
				{
						$plan_data = Plan::where([
					'stripe_plan_id_live' => @$str_stripe_plan_id
					])
					->orderBy('id', 'desc')
					->first();
					
				}				
				
				$obj_subscription_data = UserSubscription::where([
				'stripe_subscription_id' => @$str_stripe_subscription_id
				])
				->orderBy('id', 'desc')
				->first();
				
					if(empty($obj_subscription_data->id))
					{
							if(!empty($str_stripe_customer_id))
							{						
								$str_payment_method_obj =	 PaymentMethod::all([
								  'customer' => $str_stripe_customer_id,
								  'type' =>'card',
								  'limit' => 1
								]);

								// attach a payment method to customer	
								if(!empty($str_payment_method_obj->data[0]->id))
								{
									$str_payment_method_obj_data_id = @$str_payment_method_obj->data[0]->id;
									
									$obj_customers_update = Customer::update(
									   $str_stripe_customer_id,				   
									   ['invoice_settings' => ['default_payment_method' => $str_payment_method_obj_data_id]]
									  );
								}
							
							}
							
							 						 
							     $subscription_obj = new UserSubscription();
								 
								 if(!empty(@$int_user_id))
								 {
									 $subscription_obj->user_id = @$int_user_id;
								 }
								 
								 $subscription_obj->plan_id	 = @$plan_data->id;
								 $subscription_obj->stripe_id	= @$str_stripe_customer_id;
								 $subscription_obj->stripe_plan_id = @$str_stripe_plan_id;
								 $subscription_obj->price	 = @$plan_data->price;
								 $subscription_obj->coupon_code_id = @$int_coupon_code_id;
								 $subscription_obj->validity = @$plan_data->validity;						 
								 $subscription_obj->ends_at = @$stripe_subscription_current_period_end;
								 $subscription_obj->stripe_subscription_id = @$str_stripe_subscription_id;
								 $subscription_obj->payment_status = @$int_stripe_payment_status;
								 $subscription_obj->status = @$int_stripe_subscription_status;
								 $subscription_obj->created_at = @$stripe_subscription_current_period_start;
								 $subscription_obj->save();
							 
								 if(!empty(@$int_user_id))
								 {							 
									 $user_obj = User::find(@$int_user_id);
									 $user_obj->stripe_id = $str_stripe_customer_id;
									 $user_obj->save();
								 }
								 
								 echo 'Data Saved1';
				
					}/**/				  
				  
			    }
				else
				{
					//continue;
				}
				
		      }	
			  
				
		    }		
			
			DB::commit();
			
			  
		 } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        	  
		 }
	}
	
	
	// save the cancelled subscriptions by stripe
	public function saveCanceledSubscriptions(){
		
		$this->setApiKeys();
		
		$str_date_time = date('Y-m-d H:i:s');
		
		try {
            
            DB::beginTransaction();
			
			
		 $get_subscriptions_data =	Subscription::all(['limit' => 20, 'status' => 'canceled']);
	   	
		foreach($get_subscriptions_data as $get_subscriptions_data_row)
		{
			$str_subscription_canceled_at = $get_subscriptions_data_row->canceled_at;
			$str_subscription_id = $get_subscriptions_data_row->id;
			
			$str_subscription_canceled_at_new = date('Y-m-d H:i:s', $str_subscription_canceled_at);
			
			$user_subscriptions_data = DB::table('user_subscriptions')
               ->select('id','user_id', 'stripe_id', 'stripe_subscription_id')
               ->where('stripe_subscription_id', 'LIKE', '%'.$str_subscription_id.'%')
			   ->first();
			   
			   if(!empty($user_subscriptions_data->id))
			   {
				   
				   DB::table('user_subscriptions')
					->where('id', $user_subscriptions_data->id)
					->update(['status' => 4, 'cancelled_at' => $str_subscription_canceled_at_new]);
				   
			   }			   
			
		}
		
			
		/*
		$user_subscriptions_data = DB::table('user_subscriptions')
               ->select('id','user_id', 'stripe_id', 'stripe_subscription_id')
               ->where('stripe_id', 'LIKE', '%us_%')
			   ->where('stripe_subscription_id', 'LIKE', '%ub_%')
			   ->where('status', '=', 1)
               ->get();
		
        foreach($user_subscriptions_data as $user_subscriptions_data_row)
		{
			echo 'stripe_subscription_id: '. $user_stripe_subscription_id = @$user_subscriptions_data_row->stripe_subscription_id;
			
			$subscription_data = @Subscription::retrieve($user_stripe_subscription_id);
			if(!empty($subscription_data->id))
			{				
				echo '<pre>';
				print_r($subscription_data);
                echo '</pre>';				
													
				if($subscription_data->status == 'canceled')					
				{

				   //DB::table('user_subscriptions')
					//->where('stripe_subscription_id', $user_stripe_subscription_id)
					//->update(['status' => 4]);
				}						
			
			echo 'stripe_subscription_id: '. $user_stripe_subscription_id = @$user_subscriptions_data_row->stripe_subscription_id;
			echo 'stripe_subscription_id: '. $user_stripe_id = @$user_subscriptions_data_row->user_id;
			$user_subscription_invoices = DB::table('user_subscription_invoices')
               ->select('id', 'user_id')
			   ->where('payment_status', '=', 'open')
               ->where('stripe_subscription_id', '=', $user_stripe_subscription_id)
			   ->whereDate('created_at', '>=', '( CURDATE() - INTERVAL 15 DAY )')
               ->get();
			   echo '<pre>';
			   echo 'cnt:'.count($user_subscription_invoices);
			   echo '</pre>';
			   
			   if(!empty($user_subscription_invoices) && count($user_subscription_invoices)>15)
			   {	   
		           $moduleController = new ModuleController;
				   $authenticationController = new AuthenticationController;
				   
				   $objUser = $authenticationController->getUserObj($user_stripe_id);

				   $moduleController->cancel_user_stripe_subscription($objUser);
			   }
			}   
		}*/

            DB::commit();           
            echo 'Data saved successfully2';
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }		
		
			 //$orders = DB::table('orders')
               //->select('*')
               //->whereDate('created_at', '>=', '( CURDATE() - INTERVAL 15 DAY )')
               //->get();
	}
	
}