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
   
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
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
          $this->sendRemainderInvoices1();   
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
      
        $this->info('Demo:Cron Cummand Run successfully!');
    }



    public function setApiKeys()
    {
        
    Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
    
    }
    
    // send mail to the users and save the invoice data in the table
    public function sendRemainderInvoices(){
        // $this->setApiKeys();
       $moduleController = new ModuleController();
       $moduleController->send_mail_by_phpmailer('harsh.sws2020@yopmail.com', 'Your POP Account Auto Renewal Failed - Harsh - People Of Play', 'mail.invoice.test', 'sdsadsa');
        
       
        
    }

    public function sendRemainderInvoices1(){
        // $this->setApiKeys();
       $moduleController = new ModuleController();
       $moduleController->send_mail_by_phpmailer('harsh.sws2020@yopmail.com', 'Your POP Account Auto Renewal Failed - Harsh  2 - People Of Play', 'mail.invoice.test', 'sdsadsa');
        
       
        
    }

}