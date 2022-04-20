<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptionServer extends Model
{
    protected $table = 'user_subscriptions_server';

    protected $fillable = [
        'user_id',
        'plan_id',
        'reminder_mail',
        'stripe_payment_id',
        'stripe_id',
        'stripe_plan_id',
        'price',
        'validity',
        'ends_at',
        'stripe_subscription_id',
        'payment_status',
        'status'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
	
	public static function get_user_subscription_data($user)
	 { 
        //$subscription = UserSubscription::where('user_id',$user->id)->orderBy('id','desc')->first();
        
		$query = UserSubscription::select('user_subscriptions.*')->with([
                'plan',
            ]);
			
		    $query->where('user_subscriptions.user_id', $user->id);
			$query->orderBy('user_subscriptions.id','desc');			
			$subscription = $query->first();		
		
		return 	$subscription;	
     }
}
