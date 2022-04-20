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

class ReminderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:cron';

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
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->sendRemainderOneDay();  
        $this->sendRemainderThreeDay();
        $this->subscriptionUpgrade();

        $this->info('Reminder of the Day sent to All Users');
    }

    public function sendRemainderOneDay()
    {
        $ends_at = date('Y-m-d',strtotime('-1 days'));
        $subscription_list_data = UserSubscription::select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join('users','users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereDate('ends_at',$ends_at)->where('reminder_mail',1)->get()->toArray();
        $moduleController = new ModuleController();
        $data= array();
        if(isset($subscription_list_data) && !empty($subscription_list_data)) {
            foreach($subscription_list_data as $row) {
             $data= array();
              $data['name'] = $row['first_name'].' '.$row['last_name'];
              $data['plan_name'] = $row['plan_name'];
              $data['end_date'] = $row['ends_at'];
              $data['price'] = $row['price'];
              // $moduleController->send_mail_by_phpmailer($row['email'], 'URGENT - Your POP Account Expiring Warning - '. $data['name']  .' - PeopleofPlay.com', 'mail.invoice.reminder_mail_one_day', $data);
              // UserSubscription::where('id',$row['id'])->update(['reminder_mail'=>0]);
          }
      }
  }

  public function sendRemainderThreeDay()
  {
    $ends_at = date('Y-m-d',strtotime('-3 days'));
    $subscription_list_data = UserSubscription::select('user_subscriptions.*','users.first_name','users.last_name','users.email','plans.name as plan_name')->join('users','users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereDate('ends_at',$ends_at)->where('reminder_mail',0)->get()->toArray();
    $moduleController = new ModuleController();
    $data= array();
    if(isset($subscription_list_data) && !empty($subscription_list_data)) {
        foreach($subscription_list_data as $row) {
          $data= array();
            $data['name'] = $row['first_name'] .' '. $row['last_name'];
            $data['plan_name'] = $row['plan_name'];
            $data['end_date'] = $row['ends_at'];
            $data['price'] = $row['price'];
            // $moduleController->send_mail_by_phpmailer($row['email'], 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_three_day', $data);
            // UserSubscription::where('id',$row['id'])->update(['reminder_mail'=>1]);
        }
    }
}

    public function subscriptionUpgrade() {
        $ends_at = date('Y-m-d',strtotime('+4 days'));
        UserSubscription::whereDate('ends_at','>',$ends_at)->update(['reminder_mail'=>0]);
    }
}
