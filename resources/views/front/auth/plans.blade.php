@extends('front.layouts.pages')
@section('title')
Plans
@endsection

@section('content')
@php

$base_url = url('/');
$register_url = url('/') . '/register/';

@endphp


@php 
$show=1;$subs='';
if( !empty($subscription)){
  if($subscription->status == 4){ 
    $now = \Carbon\Carbon::now();
    $date = \Carbon\Carbon::parse($subscription->ends_at);
    $diff = $now->diffInMonths($date);
    if(!empty($subscription->cancelled_at) AND $now < $date){ 
     $current_plan_id=$subscription->plan_id;
     $show = 0;
     $subs=$subscription;
     echo $show;
   }
 }

 if($subscription->status == 1){ 
   $subs=$subscription;
 }
}

@endphp


<style>
.text-grey
{
	color:#551A8B;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    @if($is_plan_expire == 1)
      <div class="alert alert-danger" style="margin-top:50px;">
        <strong>Warning!</strong> Your last date of subscription was <b><?php echo date('dS M Y',strtotime($plan_end_date));?></b>, please renew your subscription to access peopleofplay.com
        <a href="{{route('front.user.manage-payment-subscription')}}" class="ml-5 btn bg-warning text-dark btn-sm d-inline">Click Here</a>
      </div>
    @elseif($is_plan_expire == 2)
      <div class="alert alert-info" style="margin-top:50px;">
        <strong>Info!</strong> Your payment was successfull. Please activate your profile to access peopleofplay.com
        <a href="{{route('front.user.manage-payment-subscription')}}" class="ml-5 btn bg-warning text-dark btn-sm d-inline">Click For Profile Activation</a>
      </div>
    @endif
      <div class="container-width">
        <section class="pricing my-5">
          <div class="container">
            <div class="PricingTable table-responsive">
              @include('front/auth/plan_table')
            </div>
          </div>
          <!-- <div class="container bg-black1 k_black1">
            <div class="row wrap-allbox py-5">
              @foreach($plans as $plan) 
              @php $plan = (object) $plan; @endphp
              <div class="col-md-3 planColumn mb-3">
                <div class="card mb-3 cardBg w-100">
                  @if($plan->type_of_plan == 1)
                  <span class="freeTop"> FREE </span>
                  @elseif($plan->type_of_plan == 2)
                  <span class="mostPopularTop"> MOST POPULAR </span>
                  @endif
                  <div class="clear"></div>
                  <div class="card-body">
                    <h5 class="card-title text-center mb-0 mt-2">{{ $plan->name }}</h5>
                    <div class="wrap-all text-center">
                     <h6 class="card-price">${{ (int) $plan->price }}<span
                      class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
                    </h6>
                    <strong class="monthPay" style="">
                      $ {{($plan->type_of_plan == 3) ? '4.16' : round($plan->price/12,2)}} / month
                    </strong>
                    <p class="sidetitle mt-2 mb-2">{{ $plan->description }}</p>
                  </div>
                  @if($show == 1)
                  <div class="mt-2 text-center">
                   @if( !empty($subs) && ($subs->plan_id == $plan->id))
                   <h1 class="planHeadOne" class=" text-uppercase">Current Plan</h1></center>
                   @else
                   {{-- data-toggle="modal" data-target="#myMaintainance"  href="#" --}}
                   @php										  
                   $str_chang_plan_url = $base_url . '/plan/purchase/' . $role_id . '/' . base64_encode($plan->id).'/'. 1;
                   @endphp
                   <a id="change_plan_link_id_{{$plan->id}}" onclick="return goto_change_plan_new('{{$plan->id}}', '{{$str_chang_plan_url}}');" href="javascript:void(0);"   class="btn btnAll text-uppercase get_started change-plan-href-link-new" data-price="{{ $plan->price*100 }}" data-plan="{{ $plan->name }}" data-plan-id="{{ $plan->id }}">@if(empty($subs->plan->price)) {{'Select'}} @else {{ ($plan->price < @$subs->plan->price) ? 'Switch' : 'Upgrade' }} @endif</a>

                   @endif
                 </div>
                 @endif -->
               <!--   <h5 class="mt-3 mb-2 featureHead">Features</h5>
                 <div class="mt-2">
                  @php
                  $features = @explode('#@$!',$plan->features);
                  $a=array("danger","info","success","warning","mute","secondary","primary");
                  @endphp
                  @foreach($features?? [] as $k => $feature)
                  @php 
                  $random_keys=array_rand($a); 
                  if($k == 0){
                    $color= 'danger';
                  } else if($k == 1){
                    $color= 'info';
                  } else if($k == 2){
                    $color= 'success';
                  } else if($k == 3){
                    //$color= 'warning';
                    $color= 'grey';
                  } else if($k == 4){
                    $color= 'mute';
                  } else if($k == 5){
                    $color= 'secondary';
                  } else if($k == 6){
                    $color= 'primary';
                  } else if($k == 7){
                    $color= 'other';
                  } else if($k == 8){
                    $color= 'dark';
                  } else {
                    $color= 'danger';
                  }
                  @endphp
                  <div class="d-flex text-{{$color}}">
                    <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-{{$color}}">{{ $feature }}</p>
                  </div>

                  @endforeach
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section> -->
  </div>
</div>
</div>
</div>


<div class="modal" id="myMaintainance" style="padding-right: 17px;">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header kbg_black">
    <div class="row p-2 w-100">
     <h4 class="text-white mx-auto text-uppercase">Under Maintenance</h4>
   </div>
   <button type="button" class="close" data-dismiss="modal">×</button>
 </div>
 <div class="modal-body p-3">
  <div class="text-center">
    <h3 class="textPurple font-weight-bold">Payments Under Maintenance</h3>
    <p class="mb-0">Payments are under scheduled maintenance, come back soon. :)</p>
    <p>Till then you can review our plans and features.</p> 
    <a href="{{url('/')}}" class="btn btnAll">Go to Home Page</a>            
  </div>
</div>
</div>
</div>
</div>


<script>
  function goto_change_plan_new(int_plan_id, str_chang_plan_url_new)
  {
   
   $('#change_plan_link_id_'+int_plan_id).text('Loading... Please wait.');

   window.location.href = str_chang_plan_url_new;
 }

</script>

@endsection

