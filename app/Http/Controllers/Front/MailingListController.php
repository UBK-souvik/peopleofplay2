<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\Plan;
use App\Models\News;
use App\Models\User;
use App\Models\Country;
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

use Mail;

class MailingListController extends ModuleController
{
    
    function send_mail_template($type_id)
	{
		$str_send_email = config('mail.template_email_to_address.address');
            
            if(empty($type_id))
			{
			   $type_id = 0;	
			}				
			  		
		    if($type_id == 1)
			{
				$user = User::where('email', $str_send_email)->first();

				$url = get_reset_password_link($user->id);
				$data['url'] = $url;
				$data['email'] = $user->email;
				$data['name']  = @$user->first_name.' '.@$user->last_name;
				
				$this->send_mail_by_phpmailer(trim($data['email']), 'Reset Password - People Of Play - ' . $data['email'], 'mail.auth.reset_password', $data);
			}
			
			if($type_id == 2)
			{
			
			$data['contact_name']  = 'James Peter';
			$data['contact_email']  = $str_send_email;
			$data['contact_mobile']  = '';
			$data['contact_subject']  = 'Plan Contact';
			$data['contact_message']  = 'Plan Contact Message';
			
			$this->send_mail_by_phpmailer($str_send_email, 'New User General Inquiry - '.$data['contact_name']. ' - ' . Config::get('commonconfig.web_site_name_new'), 'mail.auth.contact_us_template', $data);
			
			}
			
			return view('front.auth.email_template_types_dropdown', compact('type_id'));
        
    }

}
