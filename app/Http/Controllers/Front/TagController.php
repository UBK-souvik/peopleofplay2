<?php
namespace App\Http\Controllers\Front;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use App\Models\User;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\GalleryAwardTag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\UtilitiesTwo;
use Mail;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Config;


require(app_path().'/Libraries/PHPMailer-master/vendor/autoload.php');

class TagController extends Controller
{
	
	
	public function getTestPaymentGateway()
    {
        	
		return view('front.auth.test_payment_gateway');
    }
	
	public function getFileContents()
    {
		$dir_name = "path/to/image/folder/";
		$images = glob($dir_name."*.png");
		foreach($images as $image) {
		   //echo '<img src="'.$image.'" /><br />';
		}
	}
	
	public function index()
    {
						/*Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
						
		
		
		
		$all_subscriptions = Invoice::all(['limit' => 4]);

          echo '<pre>';
		  print_r($all_subscriptions);
          echo '</pre>';
		
		 exit;*/
		
		//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
//$mail->Host = 'smtp.mailersend.net';
//$mail->Host = 'email-smtp.us-east-2.amazonaws.com';
$mail->Host = 'mail.showboatentertainment.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
//$mail->Username = 'MS_Dt9j9T@peopleofplay.com';
//$mail->Username = 'AKIAWTOWXEKSUOBQQOIL';
$mail->Username = 'info@showboatentertainment.com';
//Password to use for SMTP authentication
//$mail->Password = 'FgMWcwyfubyRjmuS';
$mail->Password = '*A&W_x=?wyLP';

//Set who the message is to be sent from
//$mail->setFrom('info@peopleofplay.com', 'First Last');
$mail->setFrom('info@showboatentertainment.com', 'First Last');
//Set an alternative reply-to address
//$mail->addReplyTo('mail.peopleofplay@gmail.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress('arvindnath2008@gmail.com', 'John Doe');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP body';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->msgHTML('abcde fgh', __DIR__);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
        
 exit;       
        
						
						
						
						$str_customer_id =  'cus_J9355r7eXpbwMO';					
						
		$str_customer_id = trim($str_customer_id);
		
		$customer_data = Customer::retrieve($str_customer_id);
	
       echo 'p: '.$default_payment_method = @$customer_data->invoice_settings['default_payment_method'];	
		echo '<pre>';
		print_r($customer_data);
	echo '</pre>';
	
	
	$payment_data = PaymentMethod::retrieve(
  @$default_payment_method,
  []
);

echo '<pre>';
		print_r($payment_data);
	echo '</pre>';
	
	echo 'la:'.$payment_data->card['last4'];
	
	echo 'av:'.$payment_data->card['networks']['available'][0];
	
	
	exit;
	
	
	
 $str_payment_methods =	 PaymentMethod::all([
  'customer' => $str_customer_id,
  'type' =>'card'
]);

echo '<pre>';
		print_r($str_payment_methods);
	echo '</pre>';
			//exit;		
        $str_subscription_id =  'sub_J91tbaWECYo9d2';					
						
		$str_subscription_id = trim($str_subscription_id);
		
		$subscription_data = Subscription::retrieve($str_subscription_id);
		
		echo '<pre>';
		print_r($subscription_data);
	echo '</pre>';
		
		/*
		echo 'latest_invoice'. $str_latest_invoice = @$subscription_data->latest_invoice;
		
		$str_latest_invoice = trim($str_latest_invoice);
		
		$invoice_data = Invoice::retrieve($str_latest_invoice);
		
		$str_payment_intent = $invoice_data->payment_intent;
		
		$str_payment_intent = trim($str_payment_intent);
		
		echo '<pre>';
		print_r($invoice_data);
	echo '</pre>';
		
		$payment_intent_data = PaymentIntent::retrieve($str_payment_intent);
		
		echo '<pre>';
		print_r($payment_intent_data);
	   echo '</pre>';
		
		echo 'code1: '.$payment_intent_data->last_payment_error['decline_code'];
		echo 'code2: '.$payment_intent_data->last_payment_error['message'];
		echo 'code3: '.$payment_intent_data->last_payment_error['code'];
		echo 'code4: '.$payment_intent_data->last_payment_error['customer'];
		
		echo 'code5: '.$payment_intent_data->charges['data'][0]['outcome']->seller_message;
		echo 'code6: '.$payment_intent_data->charges['data'][0]['outcome']->network_status;
		echo 'code7: '.$payment_intent_data->charges['data'][0]['outcome']->reason;
		echo 'code8: '.$payment_intent_data->charges['data'][0]['outcome']->type;
		*/
		
		
		
		/*
		//phpinfo();
		Mail::send([], [], function ($message) {
  $message->to('arvindsilamkoti2008@gmail.com');//kundanpandey065@gmail.com
    //->from('info@mirafurnishing.com','People Of Play')
    $message->subject('Welcome');
    // here comes what you want
    $message->setBody('Hi, welcome user!'); // assuming text/plain
    // or:
	//$message->getHeaders()->addTextHeader('From', 'mail.peopleofplay@gmail.com');
	//$message->getHeaders()->addTextHeader('X-Sender', 'mail.peopleofplay@gmail.com');
	
	//$headers .= "Reply-To: The Sender <sender@sender.com>\r\n"; 
    //$headers .= "Return-Path: The Sender <sender@sender.com>\r\n"; 
    //$headers .= "From: sender@sender.com" ."\r\n" .
    //$headers .= "Organization: Sender Organization\r\n";
	
	$message->getHeaders()->addTextHeader('Reply-To', 'mail.peopleofplay@gmail.com');
	$message->getHeaders()->addTextHeader('Return-Path', 'mail.peopleofplay@gmail.com');
	$message->getHeaders()->addTextHeader('From', 'mail.peopleofplay@gmail.com');
	$message->getHeaders()->addTextHeader('Organization', 'People Of Play');
	
	$message->getHeaders()->addTextHeader('X-Mailer', 'PHP/'. phpversion());
	$message->getHeaders()->addTextHeader('X-Priority', '1');
	$message->getHeaders()->addTextHeader('MIME-Version', '1.0');
	$message->getHeaders()->addTextHeader('Content-Type', 'text/html; charset=iso-8859-1\n');
    $message->setBody('<h1>Hi, welcome user!</h1>', 'text/html'); // for HTML rich messages
});exit;

		
		/*
		
		
		 $headers  = "From: testsite < mail@testsite.com >\n";
    $headers .= "Cc: testsite < mail@testsite.com >\n"; 
    $headers .= "X-Sender: testsite < mail@testsite.com >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "Return-Path: mail@testsite.com\n"; // Return path for errors
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		
		
		
		$foo = "0123456789a123456789b123456789c";

// Looking for '0' from the 0th byte (from the beginning)
//var_dump(strrpos($foo, '0', 0));
echo '</br>';
// Looking for '0' from the 1st byte (after byte "0")
//var_dump(strrpos($foo, '0', 1));
echo 'pos: '.strpos($foo, '7');
echo '</br>';
// Looking for '7' from the 21th byte (after byte 20)
var_dump(strrpos($foo, '7', 20));
echo '</br>';
// Looking for '7' from the 29th byte (after byte 28)
var_dump(strrpos($foo, '7', 28));
echo '</br>';
// Looking for '7' right to left from the 5th byte from the end
var_dump(strrpos($foo, '7', -5));
echo '</br>';
// Looking for 'c' right to left from the 2nd byte from the end
var_dump(strrpos($foo, 'c', -2));
echo '</br>';
// Looking for '9c' right to left from the 2nd byte from the end
var_dump(strrpos($foo, '9c', -2));*/
		   //phpinfo();
		   //echo UtilitiesTwo::getUserIP();
		   
		   exit;
		   //$gallery_data_new = Gallery::with('gallery_products')->get();//->where('user_id',$user_id)
		   
		   /*$gallery_data_new = Gallery::whereHas('gallery_products', function($query) {
			$query->where('user_id', 24)->whereHas('productdata', function ($query) {
				$query->where('user_id', 24);
			});
		})->get();
		
		, 'gallery_awards' => function($gallery_awards) {
            //$gallery_persons->where('user_id', 24);
			
			$gallery_awards->with('awarddata');
			
         }
		
		*/
		
		
		$query = Gallery::with(['gallery_product_tags' => function($gallery_product_tags) {

			$gallery_product_tags->with('productdata');
	
		}, 'gallery_company_tags' => function($gallery_company_tags) {
            //$gallery_persons->where('user_id', 24);
			$gallery_company_tags->with('companydata');
			
         }, 'gallery_other_tags' => function($gallery_other_tags) {
            //$gallery_persons->where('user_id', 24);
			//$gallery_others->with('otherdata');		
			
         }, 'gallery_person_tags' => function($gallery_person_tags) {
            //$gallery_persons->where('user_id', 24);
			
			$gallery_person_tags->with('persondata');
			
         }, 'gallery_award_tags' => function($gallery_award_tags) {
            //$gallery_persons->where('user_id', 24);
			$gallery_award_tags->with('awarddata');
			
         }, 'gallery_products' => function($gallery_products) {
            $gallery_products->where('slug', 'testpro123');
			//$gallery_award_tags->with('awarddata');
			
         }]);
		$query->where('user_id', 24);
		$query->groupBy('assign_product_id');
		//$query->where('products.slug', 'testpro123');
		//$query->where('assign_product_id', 18);
		//$query->where('productdata.id', 18);
		
		$gallery_data_new = $query->get();
		
		
		   /*if ($gallery_destination_id == 2) {
			  $gallery_data_new->where('prod.slug', $slug);
		   }
		    //&& (!empty($field_name))
		   
		   // && (!empty($field_name))
		   if ($gallery_destination_id == 1) {
			  $gallery_data_new->where('usr.slug', $slug);			  
		   }
		   
		   if(!empty($gallery_destination_id))
		   {
			  $query->where('g.destination_id', $gallery_destination_id);   
		   }
		   
		   if(!empty($user_id))
		   {
			  $query->where('g.user_id', $user_id);   
		   }
		
		   */
		   
		   echo '<pre>';
					   //print_r($gallery_data_new_row);
				echo '</pre>';
		   
		   foreach($gallery_data_new as $gallery_data_row)
           {
			     echo 'title'.$gallery_data_row->title;
			   
			     $int_gallery_id = $gallery_data_row->id;
				 $is_known_for = $gallery_data_row->is_known_for;				 
				 $str_media_data = $gallery_data_row->media;
				 $str_award_tag = $gallery_data_row->award_name;
				 //$str_product_tag = $gallery_data_row->product_name;
				 $str_title = $gallery_data_row->title;
				 $str_caption = $gallery_data_row->caption;
				 $str_url = $gallery_data_row->url;
				 $int_destination_id = $gallery_data_row->destination_id;
				 $int_assign_product_id = $gallery_data_row->assign_product_id;
				 $int_assign_event_id = $gallery_data_row->assign_event_id;
				 $int_gallery_user_id = $gallery_data_row->user_id;
			   if(is_object($gallery_data_row->gallery_products))
			   {
				   echo 'user_id'.$gallery_data_row->gallery_products->user_id;
			   }	   
			   
			   
			   if(is_object($gallery_data_row->gallery_product_tags))
			   {
				   
			       foreach($gallery_data_row->gallery_product_tags as $gallery_data_product_tag_row)
                   {
					   
				       echo '<pre>';
					   //print_r($gallery_data_product_row);
			   print_r($gallery_data_product_tag_row->productdata);
			    
			         if(!empty($gallery_data_product_tag_row->persondata->id))
					 {
			           $arr_products[$int_gallery_id][] = $gallery_data_product_tag_row->productdata->id;
				 $product_url = url('/') . '/product/' . $gallery_data_product_tag_row->productdata->name;
                 $arr_products_urls[$int_gallery_id][] = "<a target='_blank' href='$product_url'>".$gallery_data_product_tag_row->productdata->name."</a>";				 
				 $str_product_tag = implode(",", $arr_products_urls[$int_gallery_id]);
			   
			   echo '</pre>';
                     }			   
                   }					   
			   }
			   
			   
			   if(is_object($gallery_data_row->gallery_person_tags))
			   {
				   
			       foreach($gallery_data_row->gallery_person_tags as $gallery_data_person_tag_row)
                   {
					   
				       echo '<pre>';
					   //print_r($gallery_data_product_row);
			   print_r($gallery_data_person_tag_row->persondata);
			   
			         if(!empty($gallery_data_person_tag_row->persondata->id))
					 {
						 $arr_persons[$int_gallery_id][] = $gallery_data_person_tag_row->persondata->id;
				 $person_url = url('/') . '/inventor/' . $gallery_data_person_tag_row->persondata->name;
				 $arr_persons_urls[$int_gallery_id][] = "<a target='_blank'  href='$person_url'>".$gallery_data_person_tag_row->persondata->name."</a>";				 
				 $str_person_tag = implode(",", $arr_persons_urls[$int_gallery_id]); 
					 }
			           
			   
			   echo '</pre>';	  
                   }					   
			   }
			   
			   if(is_object($gallery_data_row->gallery_company_tags))
			   {
				   
			       foreach($gallery_data_row->gallery_company_tags as $gallery_data_company_tag_row)
                   {
					   
				       echo '<pre>';
					   //print_r($gallery_data_product_row);
			   print_r($gallery_data_company_tag_row->companydata);
			      if(!empty($gallery_data_company_tag_row->companydata->id))
					 {
			    $arr_companies[$int_gallery_id][] = $gallery_data_company_tag_row->companydata->id;
				 $company_url = url('/') . '/inventor/' . $gallery_data_company_tag_row->companydata->name;
				 $arr_companies_urls[$int_gallery_id][] = "<a target='_blank'  href='$company_url'>".$gallery_data_company_tag_row->companydata->name."</a>";
				 $str_company_tag = implode(",", $arr_companies_urls[$int_gallery_id]);
			   
			   echo '</pre>';
					 }			   
                   }					   
			   }
			   
			   
			   
			   if(is_object($gallery_data_row->gallery_other_tags))
			   {
				   
			       foreach($gallery_data_row->gallery_other_tags as $gallery_data_other_tag_row)
                   {
					  if(!empty($gallery_data_other_tag_row->other_tag))
					 {
					   $arr_others[$int_gallery_id][] = $gallery_data_other_tag_row->other_tag;
				 $str_others = implode(",", $arr_others[$int_gallery_id]);
				 $str_modal_form_div_id =  "ModalGalleryVideoForm".$int_gallery_id;
					 } 
			       }
			   }	   
			   
			   
			   
		   }/**/
		   
		   //echo '<pre>';
		   //print_r($gallery_data_new);
		   //echo '</pre>';
    }
	
	
    public function getUserTags()
    {
        $user_data = User::get();
		
		$user_main_arr = array();
		foreach($user_data as $user_row)
		{			
			$user_arr = array();
			$user_arr["id"] = $user_row['id'];
			$user_arr["name"] = $user_row['first_name'];
		    $user_main_arr[] = $user_arr;	
		}	
		
	    echo json_encode( $user_main_arr );
    }
	
	public function getProductTags()
    {
        $product_data = Product::get();
		
		$product_main_arr = array();
		foreach($product_data as $product_row)
		{			
			$product_arr = array();
			$product_arr["id"] = $product_row['id'];
			$product_arr["name"] = $product_row['name'];
		    $product_main_arr[] = $product_arr;	
		}	
		
	    echo json_encode( $product_main_arr );
    }
	
	public function getAwardTags()
    {
        $award_data = Award::get();
		
		$award_main_arr = array();
		foreach($award_data as $award_row)
		{			
			$award_arr = array();
			$award_arr["id"] = $award_row['id'];
			$award_arr["name"] = $award_row['name'];
		    $award_main_arr[] = $award_arr;	
		}	
		
	    echo json_encode( $award_main_arr );
    }
	
	public function getCompanyTags()
    {
        
		$company_data =  User::where('role', 3);
		$company_main_arr = array();
		foreach($company_data as $company_row)
		{			
			$company_arr = array();
			$company_arr["id"] = $company_row['id'];
			$company_arr["name"] = $company_row['first_name'];
		    $company_main_arr[] = $company_arr;	
		}	
		
	    echo json_encode( $company_main_arr );
    }

    
}
