<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\MetaData;
use App\Models\UserGallery;
use App\Models\InventorAward;
use App\Models\InventorContactInformation;
use App\Models\UserSocialMedia;
use App\Models\UserSubscription;
use App\Models\Plan;
use App\Models\UsersUserRole;
use App\Models\Gallery;


use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\UserSubscriptionInvoice;



use Carbon\Carbon;
use DB;
use Session;
ini_set('max_execution_time', 0);
set_time_limit(0);


class ImportCsvController extends \App\Http\Controllers\Front\ModuleController
{
	
	 public function __construct()
    {
		parent::__construct();
		$this->_usersPhotosFolder = Utilities::get_users_upload_folder_path();        
	}
	
	
	public function showInvoiceImportCsv(Request $request)
    {
		
		$str_password_data = '123456';
		$is_user_add_mode = 0;
		$m = 0;
		$int_time_stamp = time();
		
		
		// map the social ids to the csv file
		   
		if ($request->isMethod('post')) 
        {
			
			
            // pr($request->all(),1);
			$rules = [
                'import_csv_file' => 'required',
                					
            ];
	
    	    $niceNames = array();
     
            $this->validate($request, $rules, [], $niceNames);
			
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
    			 
			$file = $request->import_csv_file;
			
			
			
			echo '<br>';
			echo 'ext '.$extension = $file->getClientOriginalExtension();
			echo '<br>';
			echo 'pathname'.$pathname = $file->getPathname();
			echo '<br>';
			echo 'size'.$get_size = $file->getSize();
			echo '<br>';
			
			
			if ($get_size > 0) {
        
        $file = fopen($pathname, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			$country_id = 0;
			$str_time = time();
			
			
			
			if($m == 0)
			{
				
			}			
			
			if($m>0)
            {  
		      //foreach($column as $column_row)
			  //{
				  
				  echo '<pre>';
			 //print_r($all_invoices_row);
			 echo '</pre>';
			 echo '</br>';
			 echo 'str_invoice_id: '.$str_invoice_id = @$column[0];
			 $str_invoice_id = trim($str_invoice_id);
			 echo '</br>';
			 echo 'str_subscription_id: '.$str_subscription_id = @$column[10];
			 $str_subscription_id = trim($str_subscription_id);
			 echo '</br>';
			 echo 'str_invoice_status: '.$str_invoice_status = @$column[18];
			 $str_invoice_status = trim($str_invoice_status);
			 
			 $str_invoice_status = strtolower($str_invoice_status);
			 
			 if($str_invoice_status!="draft")
			 {
				 
				 $subscription_data = UserSubscription::where([
				'stripe_subscription_id' => $str_subscription_id
				])
				->orderBy('id', 'desc')
				->first();
				
				if(!empty($subscription_data->id))
				{
				     

					  $subscription_invoice_data = UserSubscriptionInvoice::where([
				'stripe_invoice_id' => $str_invoice_id
				])
				->orderBy('id', 'desc')
				->first();
					 
					 if(empty($subscription_invoice_data->id))
					 {
					     $subscription_invoice = new UserSubscriptionInvoice();
						 $subscription_invoice->user_id = @$subscription_data->user_id;
						 $subscription_invoice->user_subscription_id	 = @$subscription_data->id;
						 $subscription_invoice->stripe_subscription_id	= $str_subscription_id;
						 $subscription_invoice->stripe_invoice_id = $str_invoice_id;
						 $subscription_invoice->payment_status	 = $str_invoice_status;
						 $subscription_invoice->status = 1;				
						 $subscription_invoice->save();
						 
						$get_user_details =  User::get_user_details(@$subscription_data->user_id);
                        $get_plan_details =  Plan::get_plan_details(@$subscription_data->plan_id);  						
						
						 $data['email'] = @$get_user_details->email;
						$data['name']  = @$get_user_details->first_name.' '.@$get_user_details->last_name;
						$data['plan_name']  = @$get_plan_details->name;
						$data['plan_price']  = @$get_plan_details->price;
						
						$data['ends_at']  = date('Y-m-d',strtotime(@$subscription_data->ends_at));
						
						

					 }
					 
				}//if(!empty($subscription_data->id))
				
				
				 
			 }//if($str_invoice_status!="draft")
			 
				
			  
			echo '<pre>';
			print_r($column);
            echo '</pre>';
			echo '</br>';
			
		  }	
			
			echo 'm: '.$m++;
			
			echo '</br>';
			
        }
    }
			
			//print_r($file);
			
			// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('user_csv_data_saved_flag', 1);
				//return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				echo errorMessage($e->errorInfo[2], true);
			}
			
			exit;
			
    	}
    	
	    return view('admin.importcsv.import_invoice_csv_data');	
    }
	
}
