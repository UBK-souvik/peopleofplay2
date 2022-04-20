<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Plan;

use Carbon\Carbon;

class CheckForSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!empty(Auth::guard('users')->user()) && !Auth::guard('users')->user()->stripe_id) {

            /*New Code start from here for if user register and don't do payment
            $plan = Plan::findOrFail(1);

            $user = User::find(get_current_user_info()->id);
            $user->stripe_id = $plan->stripe_plan_id;
            $user->type_of_user = 1;
            
            // if(!empty($role_id))
            // {
            //    $user->role = $role_id;   
            // }        
            $user->role = 1;        
            $user->save();
            $subscription = new UserSubscription();
            $subscription->user_id = $user->id;
            $subscription->plan_id = $plan->id;
            $subscription->price = $plan->price;
            $subscription->validity = $plan->validity;
            $subscription->ends_at = Carbon::now()->addDay($plan->validity);
            $subscription->payment_status = 2;
            $subscription->save();

            return $next($request);
            /*New Code end*/


            // return redirect('/');
            // return redirect()->route('front.plans', 0);
        }

        return $next($request);
    }
}
