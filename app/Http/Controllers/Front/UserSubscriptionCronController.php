<?php

namespace App\Http\Controllers\Front;

use App\Models\Wiki;
use App\Models\Meme;
use App\Models\WikiCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Response;

use App\Models\UserSubscription;
use App\Models\UserSubscriptionLive;
use App\Models\UserSubscriptionInvoice;
use App\Models\User;
use App\Models\Plan;
use App\Models\CouponCode;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use DB;

use Session;

class UserSubscriptionCronController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->config = \App\Models\SiteSetting::get_keys(1);

		// $this->db_table = DB::table('user_subscriptions_live as user_subscriptions');
		// $this->db_table_2 = 'users_live as users';
		// $this->db_table_3 = DB::table('user_subscriptions_live as user_subscriptions');
		// $this->db_table_4 = 'users_live as users';

		$this->db_table = DB::table('user_subscriptions');
		$this->db_table_2 = 'users';
		$this->db_table_3 = DB::table('user_subscriptions');
		$this->db_table_4 = 'users';

		
	}

    public function setUserSubscription(){
        $stripe = $this->setApiKey();
        // $st_customers = $stripe->subscriptions->all(['customer'=>'cus_Kzy5FfT8ec9ZS1','limit' => 10]);
        $st_customers = $stripe->checkout->sessions->retrieve(
        'cs_test_a143138Eni4zChVPimBlT7JZH36lvd1nUI70PceIazlpAek5SskPb8UGQD',[]
        );
        echo '<pre>st_customers - '; print_r($st_customers); die;
        
    }
	public function setApiKey(){
		return new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
		// return new \Stripe\StripeClient(\App\Models\SiteSettingLive::get_keys(1));
	}

    public function checkInvoice(){
		echo 'check Invoice <br>';
		$today = date('Y-m-d');
		$user_arr = array();
		DB::enableQueryLog();
        $list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.plan_id','!=','1')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->whereIn('user_subscriptions.plan_id', ['2','3','4','9','10'])->where('user_subscriptions.is_numeric','!=','1')->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();
		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;
        $subscription_list_datas =$this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_4,'users.id','=','user_subscriptions.user_id')->whereIn('user_subscriptions.id',$user_arr)->whereDate('ends_at','<',$today)->orderBy('user_subscriptions.id','DESC')->get();
		
		// dd(DB::getQueryLog()); die;
        echo count($subscription_list_datas);
        echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
        
		try {
			$i=0;
			$count = 0;
			$stripe = $this->setApiKey();        
			
			foreach($subscription_list_datas as $subscription_list_data){
			
				$st_subscriptions = $stripe->subscriptions->all(['customer'=>$subscription_list_data->stripe_id,'limit' => 1]);
				// echo '<pre>st_subscriptions - '; print_r($st_subscriptions); //die;
					// echo $subscription_list_data->stripe_id.'<br>';
			
				foreach($st_subscriptions as $st_subscription){
					// echo $st_subscription->id.'<br>';

					$st_invoice = $stripe->invoices->retrieve($st_subscription->latest_invoice,[]);	
					// echo $st_invoice->status.'<br>';
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if(isset($st_invoice->discounts) && (empty($st_invoice->discounts) && $st_invoice->status == 'paid')){
						echo 'if - <br>';
						if($st_subscription->collection_method == 'send_invoice'){
							echo "if2 - $st_subscription->collection_method <br>";
							// $stripe->subscriptions->update($st_subscription->id,
							//     [
							//         'collection_method' => 'charge_automatically',
							//     ]
							// );
						}else{
							echo 'else - <br>';
							if($st_invoice->status == 'open'){
								echo 'if3 - <br>';
								$data['email'] = 'shubham16.sws@gmail.com'; // $subscription_list_data->email;
								$data['name'] = $subscription_list_data->first_name.' '.$subscription_list_data->last_name;
								$data['price'] = number_format(($st_invoice->amount_due / 100),2);
								$data['invoice_url'] = $st_invoice->hosted_invoice_url;
								
								$count++;
								$moduleController = new ModuleController();
								echo view('mail.invoice.stripe_payment_failed', $data);
								// $moduleController->send_mail_by_phpmailer(trim($data['email']), 'Your POP Account Auto Renewal Payment Was Failed - '.$data['name'].' - People Of Play', 'mail.invoice.stripe_payment_failed', $data);
							}else{
								echo 'Successfully paid - '.$st_invoice->status;
							}
						}
					}else{
						echo 'else2 - <br>';
						if(isset($st_invoice->discounts) && (empty($st_invoice->discounts) && $st_invoice->status != 'paid')){
							echo 'if4 - <br>';				
							// echo '<pre>st_invoice - '; print_r($st_invoice); die;
							
							$due_date_3 = date('Y-m-d',strtotime(date('Y-m-d',$st_invoice->due_date).'+2days'));
							$created_date = date('Y-m-d',$st_invoice->created);
							$next_attempt_date = date('Y-m-d',$st_invoice->next_payment_attempt);
							$today = date('Y-m-d',strtotime(date('Y-m-d').'+1day'));
							// echo $today.' - '. $created_date.' - '. $due_date_3.'<br>';
							// die;

							if($st_subscription->collection_method == 'charge_automatically' && $st_invoice->status == 'open' && ($created_date <= $today && $next_attempt_date >= $today)){
								echo 'if3 - <br>';
								$data['email'] = 'shubham16.sws@gmail.com'; // $subscription_list_data->email;
								$data['name'] = $subscription_list_data->first_name.' '.$subscription_list_data->last_name;
								$data['price'] = number_format(($st_invoice->amount_due / 100),2);
								$data['invoice_url'] = $st_invoice->hosted_invoice_url;
								
								$count++;
								$moduleController = new ModuleController();
								echo view('mail.invoice.stripe_payment_failed', $data);
								// $moduleController->send_mail_by_phpmailer(trim($data['email']), 'Your POP Account Auto Renewal Payment Was Failed - '.$data['name'].' - People Of Play', 'mail.invoice.stripe_payment_failed', $data);
							}elseif($st_subscription->collection_method == 'send_invoice' && $st_invoice->status == 'open' && ($created_date <= $today && $due_date_3 >= $today)){
								echo 'elseif4 - <br>';
								$st_finalize_invoice = $stripe->invoices->sendInvoice($st_invoice->id,[]);
								$data['email'] = 'shubham16.sws@gmail.com'; // $subscription_list_data->email;
								$data['name'] = $subscription_list_data->first_name.' '.$subscription_list_data->last_name;
								$data['price'] = number_format(($st_invoice->amount_due / 100),2);
								$data['invoice_url'] = $st_finalize_invoice->hosted_invoice_url;
								
								$count++;
								$moduleController = new ModuleController();
								echo view('mail.invoice.manual_payment', $data); // die;
								// $moduleController->send_mail_by_phpmailer(trim($data['email']), 'Your POP Account Auto Renewal Payment Was Failed - '.$data['name'].' - People Of Play local', 'mail.invoice.stripe_payment_failed', $data);
							}elseif($st_invoice->status == 'draft'){
								echo 'Invoice is draft now <br>';
							}elseif($st_invoice->status == 'paid'){
								echo 'Successfully paid - '.$st_invoice->status;
							}
						}
					}
					// die;
				}
				//die;
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
        echo $count." - $i ";
        die;
    }

    public function changeInvoicesStatus($subs_id=''){
		$today = date('Y-m-d');
		$user_arr = array();
		DB::enableQueryLog();
        $list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.plan_id','!=','1')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->whereIn('user_subscriptions.plan_id', ['2','3','4','9','10'])->where('user_subscriptions.is_numeric','!=','1')->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		if(empty($subs_id)){
			foreach($list_datas as $list_data){
				$user_arr[] = $list_data->latest_id;
			}
		}else{
			$user_arr[] = $subs_id;
		}
		// echo '<pre>'; print_r($user_arr); die;
        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_4,'users.id','=','user_subscriptions.user_id')->whereIn('user_subscriptions.id',$user_arr)->whereDate('ends_at','<',$today)->orderBy('user_subscriptions.id','DESC')->get();
		
		// dd(DB::getQueryLog()); die;

        // echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
        
		try {
			$i=0;
			$count = 0;
			$stripe = $this->setApiKey();
			foreach($subscription_list_datas as $list_data){	
				$st_invoices = $stripe->invoices->all(['customer'=>$list_data->stripe_id,'subscription'=>$list_data->stripe_subscription_id,'limit' => 100]);	
				// echo '<pre>st_invoice - '; print_r($st_invoices); die;
				$i = 0;
				foreach($st_invoices as $st_invoice){
					if($i == 0){
						// echo "$list_data->email - if - <br>";
						$i++;
						continue;
					}else{
						if($st_invoice->status == 'open' || $st_invoice->status == 'uncollectible'){
							$stripe->invoices->voidInvoice($st_invoice->id, []);
							// echo "$list_data->email - Void <br>";
							$i++;
							// if($list_data->id == '2483'){
							// }
						}
					}
				}
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
	}	

    
    public function sendRemainderSameDay()
    {
		echo 'Same Day <br>';
        $ends_at = date('Y-m-d');
		$user_arr = array();
		$list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->where('user_subscriptions.is_numeric','!=','1')->whereDate('ends_at',$ends_at)->where('reminder_mail',1)->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;

        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join($this->db_table_4,'users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereIn('user_subscriptions.id',$user_arr)->orderBy('user_subscriptions.id','DESC')->get();

        echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
		
		try {
			$moduleController = new ModuleController();
			if(isset($subscription_list_datas) && !empty($subscription_list_datas)) {
				foreach($subscription_list_datas as $row) {
					$data= array();
					$data['name'] = $row->first_name.' '.$row->last_name;
					$data['plan_name'] = $row->plan_name;
					$data['end_date'] = $row->ends_at;
					$data['price'] = number_format($row->price,2);

					$stripe = $this->setApiKey();
					$st_invoices = $stripe->invoices->all(['customer'=>$row->stripe_id,'limit' => 1]);	
					$st_invoice =$st_invoices->data[0];
					// echo "st_invoice->status - $st_invoice->status <br>";
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if($st_invoice->status == 'open'){
						$data['invoice_url'] = $st_invoice->hosted_invoice_url;
						echo view('mail.invoice.reminder_mail_one_day', $data); //die;

						// $moduleController->send_mail_by_phpmailer($row->email, 'URGENT - Your POP Account Expiring Warning - '. $data['name']  .' - PeopleofPlay.com', 'mail.invoice.reminder_mail_one_day', $data);
						// UserSubscription::where('id',$row->id)->update(['reminder_mail'=>0]);
					}
				}
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
	}

	public function sendRemainderBeforeThreeDay()
	{
		echo 'Three Day <br>';
		$ends_at = date('Y-m-d',strtotime('+3 days'));
		$user_arr = array();
		
		$list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->where('user_subscriptions.is_numeric','!=','1')->whereDate('ends_at',$ends_at)->where('reminder_mail',1)->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;

        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join($this->db_table_4,'users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereIn('user_subscriptions.id',$user_arr)->orderBy('user_subscriptions.id','DESC')->get();

        echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
		
		try {
			$moduleController = new ModuleController();
			if(isset($subscription_list_datas) && !empty($subscription_list_datas)) {
				foreach($subscription_list_datas as $row) {
					$data= array();
					$data['name'] = $row->first_name .' '. $row->last_name;
					$data['plan_name'] = $row->plan_name;
					$data['end_date'] = $row->ends_at;
					$data['plan_price'] = $row->price;
					
					$stripe = $this->setApiKey();
					$st_invoice = $stripe->invoices->upcoming(['customer'=>$row->stripe_id]);
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if($st_invoice->status == 'draft'){
						$data['invoice_url'] = $st_invoice->hosted_invoice_url;
						echo view('mail.invoice.reminder_mail_three_day', $data); //die;

						// $moduleController->send_mail_by_phpmailer($row->email, 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_three_day', $data);
						// UserSubscription::where('id',$row->id)->update(['reminder_mail'=>1]);
					}
				}
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
	}

	public function sendRemainderBeforeSevenDay()
	{
		echo 'Seven Day <br>';
		$ends_at = date('Y-m-d',strtotime('+7 days'));
		$user_arr = array();
		
		$list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->where('user_subscriptions.is_numeric','!=','1')->whereDate('ends_at',$ends_at)->where('reminder_mail',0)->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;

        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join($this->db_table_4,'users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereIn('user_subscriptions.id',$user_arr)->orderBy('user_subscriptions.id','DESC')->get();

        echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
		try {
			$moduleController = new ModuleController();
			$data= array();
			if(isset($subscription_list_datas) && !empty($subscription_list_datas)) {
				foreach($subscription_list_datas as $row) {
					$data= array();
					$data['name'] = $row->first_name .' '. $row->last_name;
					$data['plan_name'] = $row->plan_name;
					$data['end_date'] = $row->ends_at;
					$data['price'] = $row->price;
					
					$stripe = $this->setApiKey();
					$st_invoice = $stripe->invoices->upcoming(['customer'=>$row->stripe_id]);
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if($st_invoice->status == 'draft'){
						$data['invoice_url'] = $st_invoice->hosted_invoice_url;
						echo view('mail.invoice.reminder_mail_seven_day', $data); // die;

						// $moduleController->send_mail_by_phpmailer($row->email, 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_seven_day', $data);
						// UserSubscription::where('id',$row->id)->update(['reminder_mail'=>1]);
					}
				}
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
	}

	public function sendRemainderAfterThreeDay()
	{
		echo 'After Three Day <br>';
		$ends_at = date('Y-m-d',strtotime('-3 days'));
		$user_arr = array();
		
		$list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->where('user_subscriptions.is_numeric','!=','1')->whereDate('ends_at',$ends_at)->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;

        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join($this->db_table_4,'users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereIn('user_subscriptions.id',$user_arr)->orderBy('user_subscriptions.id','DESC')->get();

        echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
		
		try {
			$moduleController = new ModuleController();
			if(isset($subscription_list_datas) && !empty($subscription_list_datas)) {
				foreach($subscription_list_datas as $row) {
					$data= array();
					$data['name'] = $row->first_name .' '. $row->last_name;
					$data['plan_name'] = $row->plan_name;
					$data['end_date'] = $row->ends_at;
					$data['price'] = $row->price;
					
					$stripe = $this->setApiKey();
					$st_invoice = $stripe->invoices->all(['customer'=>$row->stripe_id,'limit' => 1])->data[0];	
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if($st_invoice->status == 'open'){
						$data['invoice_url'] = $st_invoice->hosted_invoice_url;
						echo '<pre>data'; print_r($data);
						echo view('mail.invoice.reminder_mail_after_three_day', $data); //die;

						// $moduleController->send_mail_by_phpmailer($row->email, 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_three_day', $data);
						// UserSubscription::where('id',$row->id)->update(['reminder_mail'=>1]);
					}
				}
			}
		} catch (\Exception $e) {
        //    echo errorMessage($e->getMessage(), true);
        }
	}

	public function sendRemainderAfterSevenDay()
	{
		echo 'After Seven Day <br>';
		$ends_at = date('Y-m-d',strtotime('-7 days'));
		$user_arr = array();
		
		$list_datas = $this->db_table->select(DB::raw('max(user_subscriptions.id) as latest_id'),'user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole')->leftJoin($this->db_table_2,'users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->whereNotNull('user_subscriptions.plan_id')->where('user_subscriptions.stripe_subscription_id','!=','0')->whereNotNull('users.email')->where('user_subscriptions.is_numeric','!=','1')->whereDate('ends_at',$ends_at)->orderBy('latest_id','DESC')->groupBy('user_subscriptions.user_id')->get();

		foreach($list_datas as $list_data){
			$user_arr[] = $list_data->latest_id;
		}
		// echo '<pre>'; print_r($user_arr); die;

        $subscription_list_datas = $this->db_table_3->select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join($this->db_table_4,'users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereIn('user_subscriptions.id',$user_arr)->orderBy('user_subscriptions.id','DESC')->get();

        echo count($subscription_list_datas);
        // echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
		
		try {
			$moduleController = new ModuleController();
			$data= array();
			if(isset($subscription_list_datas) && !empty($subscription_list_datas)) {
				foreach($subscription_list_datas as $row) {
				$data= array();
					$data['name'] = $row->first_name .' '. $row->last_name;
					$data['plan_name'] = $row->plan_name;
					$data['end_date'] = $row->ends_at;
					$data['price'] = $row->price;
					
					$stripe = $this->setApiKey();
					$st_invoice = $stripe->invoices->all(['customer'=>$row->stripe_id,'limit' => 1])->data[0];	
					// echo '<pre>st_invoice - '; print_r($st_invoice); die;
					if($st_invoice->status == 'open'){
						$data['invoice_url'] = $st_invoice->hosted_invoice_url;
						echo view('mail.invoice.reminder_mail_after_seven_day', $data); // die;

						// $moduleController->send_mail_by_phpmailer($row->email, 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_seven_day', $data);
						// UserSubscription::where('id',$row->id)->update(['reminder_mail'=>1]);
					}
				}
			}
		} catch (\Exception $e) {
			// echo errorMessage($e->getMessage(), true);
        }
	}

	public function saveMissingSubscriptions()
    {
		echo 'saveMissingSubscriptions <br>';
      $str_user_id = '';
      $int_user_id = 0;
      
      // $this->setApiKeys();
    //   Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
      Stripe::setApiKey('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');
      
      try {
        
        DB::beginTransaction();
      
        $sessions_list = \Stripe\Checkout\Session::all(['limit' => 100]);
        
        $int_stripe_subscription_status = 0;
            $int_stripe_payment_status = 0;	
        
        echo '<pre>'; print_r(@$sessions_list); die;

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
              echo $str_subscription_id_new;
              if(!empty($str_subscription_id_new) && strpos($str_subscription_id_new, 'ub_')>0)
              {
                    echo ' - '.$str_subscription_id_new;
                  // echo "<pre>sessions_list_row $str_subscription_id_new - "; print_r(@$sessions_list_row); die;
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
                        //  $subscription_obj->save();

                        echo "<pre>subscription_obj - ".@$int_user_id; print_r($subscription_obj);
                      
                        if(!empty(@$int_user_id))
                        {							 
                          $user_obj = User::find(@$int_user_id);
                          $user_obj->stripe_id = $str_stripe_customer_id;
                          //  $user_obj->save();
                        }
                        
                        echo 'Data Saved1';
                
                  }/**/
                  else{
                    echo 'esle - ';
                  }				  
                
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

	// public function deleteStripeCustomer(){
	// 	echo 'deleteStripeCustomer <br>'; // die;
		
	// 	$user_arrs = array(        
	// 		'cus_Kv9qg49ZmchsRO',
	// 		'cus_Kv9qIooGgBWUyv',
	// 	);
		
	// 	echo count($user_arrs).'<br>';
	// 	echo '<pre>st_customers - '; print_r($user_arrs); die;
	// 	$i = 0;
	// 	foreach($user_arrs as $user_arr){
	// 		$stripe_live_cus = DB::table('stripe_live_cus_delete')->where('cus_id',$user_arr)->first();
	// 		if(empty($stripe_live_cus)){
	// 			try {
	// 				$stripe = $this->setApiKey();
	// 				$st_customers = $stripe->customers->retrieve($user_arr,[]);
	// 				// echo '<pre>st_customers - '; print_r($st_customers->toArray()); die;
	// 				echo "Try - $st_customers->id <br>"; // die;
	// 				if($st_customers){
	// 					$del_data = array(
	// 						'cus_id' => $st_customers->id,
	// 						'server_type' => 'live',
	// 						'status' => 1,
	// 						'file_type' => 3,
	// 						'created_at' => time(),
	// 						'updated_at' => time(),
	// 					);
	// 					DB::table('stripe_live_cus_delete')->insert($del_data);

	// 					$st_cust_delete = $stripe->customers->delete($st_customers->id,[]);
	// 					$i++;
	// 				}
	// 			} catch (\Exception $e) {
	// 				// echo errorMessage($e->getMessage(), true);
	// 				$del_data = array(
	// 					'cus_id' => $st_customers->id,
	// 					'server_type' => 'live',
	// 					'status' => 2,
	// 					'file_type' => 3,
	// 					'created_at' => time(),
	// 					'updated_at' => time(),
	// 				);
	// 				DB::table('stripe_live_cus_delete')->insert($del_data);
	// 				echo "Catch - $user_arr <br>";
	// 			}
	// 		}
			
	// 	}
	// 	echo $i;
	// 	die;
	// }


}
