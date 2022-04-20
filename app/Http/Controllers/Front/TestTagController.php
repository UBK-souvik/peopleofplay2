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

class TestTagController extends Controller
{
	
	
	public function checkout_session()
    {
				//require 'vendor/autoload.php';
				\Stripe\Stripe::setApiKey('sk_test_51HPhuEBgD4GNlNtNGbxeRvIr6AWTWX1LjcNbSrjemJjEQE3pEXULDYBoWn0EhafTPmh56AGubpLrMUYRRQeB5pBL000BXc3hTe');

				//header('Content-Type: application/json');

				$YOUR_DOMAIN = 'https://pop.showboatentertainment.com';

				$checkout_session = \Stripe\Checkout\Session::create([
				  'customer_email' => 'customer@example.com',
				  'submit_type' => 'donate',
				  'billing_address_collection' => 'required',
				  'shipping_address_collection' => [
					'allowed_countries' => ['US', 'CA'],
				  ],
				  'payment_method_types' => ['card'],
				  'line_items' => [[
					'price_data' => [
					  'currency' => 'usd',
					  'unit_amount' => 2000,
					  'product_data' => [
						'name' => 'Stubborn Attachments',
						'images' => ["https://i.imgur.com/EHyR2nP.png"],
					  ],
					],
					'quantity' => 1,
				  ]],
				  'mode' => 'payment',
				  'success_url' => $YOUR_DOMAIN . '/success.html',
				  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
				]);
dd($checkout_session);
				echo json_encode(['id' => $checkout_session->id]);
    }
    
}