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
use GuzzleHttp\Client;

use App\Models\ContactUs;

use Mail;
use Session;
use Config;

class ContactController extends ModuleController
{

    public function postContactUs(Request $request)
    {
        // ini_set("allow_url_fopen", 1);
		// pr($request->all()); //die;
		
		$recaptcha_secret_key =  Config::get("commonconfig.recaptcha_secret_key");
		
		if(!empty($request->about_contact == 'yes')){
			$rules = [
				'contact_name' => 'required',
					'contact_email' => 'required|email',	
			];
				 
			$niceNames = [
				'contact_name' => 'Contact Name',
				'contact_email' => 'Contact Email',	
			];
		}else{
			$rules = [
				'contact_name' => 'required',
				'contact_email' => 'required|email',
				'recaptcha_response' => 'required'		
			];
				 
			$niceNames = [
				'contact_name' => 'Contact Name',
				'contact_email' => 'Contact Email',
				'recaptcha_response' => 'Captcha'		
			];
		}
		
		 
       $this->validate($request, $rules, [], $niceNames);		
		
        try {
			
			DB::beginTransaction();
			if(empty($request->about_contact == 'yes')){
			
				$response = $request->recaptcha_response;
				$userIP = $_SERVER["REMOTE_ADDR"];
			$captcha_success =	$this->curl_request("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret_key}&response={$response}",'GET');
				//$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret_key}&response={$response}");
			// $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret_key}&response={$response}&remoteip={$userIP}");
			
		
		// $captcha_success=json_decode($verify);

			$str_success =  $captcha_success->success;

				if (empty($str_success)) {
				
				$message = ['msg' => '<b>Captcha</b> Validation Required!'];
						return response()->json($message, 422);
				}
				
			}
            
            $data['contact_name']  = @$request->contact_name;
			$data['contact_email']  = @$request->contact_email;
			$data['contact_mobile']  = @$request->contact_mobile;
			$data['contact_subject']  = @$request->contact_subject;
			$data['contact_message']  = @$request->contact_message;
			
			
			$obj_contact_us = new ContactUs();
            $obj_contact_us->contact_name = $data['contact_name'];
            $obj_contact_us->contact_email = $data['contact_email'];
			$obj_contact_us->contact_mobile = $data['contact_mobile'];
			$obj_contact_us->contact_subject = $data['contact_subject'];
			$obj_contact_us->contact_message = $data['contact_message'];

			// pr($obj_contact_us); die;

            $obj_contact_us->save();
			
			
            // pr($data,1); 
            /*Mail::send('mail.auth.contact_us_template',$data, function($message) use ($data) {
            $message->to(config('mail.contact_to.address'), Config::get('commonconfig.web_site_name_new'));
            $message->subject('New User General Inquiry - '.$data['contact_name']. ' - ' . Config::get('commonconfig.web_site_name_new'));
            $message->from(config('mail.from.address'),Config::get('commonconfig.web_site_name_new'));
            });*/
			
			$this->send_mail_by_phpmailer(env('TO_EMAIL'), 'New User General Inquiry - '.$data['contact_name']. ' - ' . Config::get('commonconfig.web_site_name_new'), 'mail.auth.contact_us_template', $data);
			
			Session::flash('contact_data_saved_flag', 1);

            // $user->notify(new ResetPassword($url));
			DB::commit();

            return successMessage('Contact Us Data Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getContactUs(){
        return view('front.auth.contact_us');
    }
    
    	public function curl_request($url,$method,$post_data=array())
	{
		
		//print_r($url);die;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  //CURLOPT_POSTFIELDS => http_build_query($post_data),
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
		$resp = json_decode($response);
		// echo "<pre>"; print_r($resp);die;
		curl_close($curl);
		return $resp;
	}

}
