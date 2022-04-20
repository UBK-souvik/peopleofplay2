
<?php $__env->startSection('title'); ?>
Plans
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php

$base_url = url('/');
$register_url = url('/') . '/register/';

?>


<?php 
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

?>


<style>
.text-grey
{
	color:#551A8B;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <?php if($is_plan_expire == 1): ?>
      <div class="alert alert-danger" style="margin-top:50px;">
        <strong>Warning!</strong> Your last date of subscription was <b><?php echo date('dS M Y',strtotime($plan_end_date));?></b>, please renew your subscription to access peopleofplay.com
        <a href="<?php echo e(route('front.user.manage-payment-subscription')); ?>" class="ml-5 btn bg-warning text-dark btn-sm d-inline">Click Here</a>
      </div>
    <?php elseif($is_plan_expire == 2): ?>
      <div class="alert alert-info" style="margin-top:50px;">
        <strong>Info!</strong> Your payment was successfull. Please activate your profile to access peopleofplay.com
        <a href="<?php echo e(route('front.user.manage-payment-subscription')); ?>" class="ml-5 btn bg-warning text-dark btn-sm d-inline">Click For Profile Activation</a>
      </div>
    <?php endif; ?>
      <div class="container-width">
        <section class="pricing my-5">
          <div class="container">
            <div class="PricingTable table-responsive">
              <?php echo $__env->make('front/auth/plan_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
          <!-- <div class="container bg-black1 k_black1">
            <div class="row wrap-allbox py-5">
              <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
              <?php $plan = (object) $plan; ?>
              <div class="col-md-3 planColumn mb-3">
                <div class="card mb-3 cardBg w-100">
                  <?php if($plan->type_of_plan == 1): ?>
                  <span class="freeTop"> FREE </span>
                  <?php elseif($plan->type_of_plan == 2): ?>
                  <span class="mostPopularTop"> MOST POPULAR </span>
                  <?php endif; ?>
                  <div class="clear"></div>
                  <div class="card-body">
                    <h5 class="card-title text-center mb-0 mt-2"><?php echo e($plan->name); ?></h5>
                    <div class="wrap-all text-center">
                     <h6 class="card-price">$<?php echo e((int) $plan->price); ?><span
                      class="period">/<?php echo e($plan->validity > 360 ? 'year' : 'month'); ?></span>
                    </h6>
                    <strong class="monthPay" style="">
                      $ <?php echo e(($plan->type_of_plan == 3) ? '4.16' : round($plan->price/12,2)); ?> / month
                    </strong>
                    <p class="sidetitle mt-2 mb-2"><?php echo e($plan->description); ?></p>
                  </div>
                  <?php if($show == 1): ?>
                  <div class="mt-2 text-center">
                   <?php if( !empty($subs) && ($subs->plan_id == $plan->id)): ?>
                   <h1 class="planHeadOne" class=" text-uppercase">Current Plan</h1></center>
                   <?php else: ?>
                   
                   <?php										  
                   $str_chang_plan_url = $base_url . '/plan/purchase/' . $role_id . '/' . base64_encode($plan->id).'/'. 1;
                   ?>
                   <a id="change_plan_link_id_<?php echo e($plan->id); ?>" onclick="return goto_change_plan_new('<?php echo e($plan->id); ?>', '<?php echo e($str_chang_plan_url); ?>');" href="javascript:void(0);"   class="btn btnAll text-uppercase get_started change-plan-href-link-new" data-price="<?php echo e($plan->price*100); ?>" data-plan="<?php echo e($plan->name); ?>" data-plan-id="<?php echo e($plan->id); ?>"><?php if(empty($subs->plan->price)): ?> <?php echo e('Select'); ?> <?php else: ?> <?php echo e(($plan->price < @$subs->plan->price) ? 'Switch' : 'Upgrade'); ?> <?php endif; ?></a>

                   <?php endif; ?>
                 </div>
                 <?php endif; ?> -->
               <!--   <h5 class="mt-3 mb-2 featureHead">Features</h5>
                 <div class="mt-2">
                  <?php
                  $features = @explode('#@$!',$plan->features);
                  $a=array("danger","info","success","warning","mute","secondary","primary");
                  ?>
                  <?php $__currentLoopData = $features?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php 
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
                  ?>
                  <div class="d-flex text-<?php echo e($color); ?>">
                    <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-<?php echo e($color); ?>"><?php echo e($feature); ?></p>
                  </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <a href="<?php echo e(url('/')); ?>" class="btn btnAll">Go to Home Page</a>            
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>