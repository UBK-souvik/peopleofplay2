<?php

$plans = App\Models\Plan::where('status', 1)
            ->get();
$register_url = url('/') . '/register/';

    @$plans = @$plans->toArray();
    $price = array_column($plans, 'price');
    array_multisort($price, SORT_ASC, $plans);

?>


<div id="modal-user-register-plan-popup" class="modal fade" style="z-index: 1450;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content k_black"  >
      <div class="modal-body p-5">
            <section class="pricing">
               <div class="container k_black">            
                <div class="row wrap-allbox ">       
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $plan = (object) $plan; ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-center"><?php echo e($plan->name); ?></h5>
                                    <div class="wrap-all">
                                        <h6 class="card-price text-center"><sup>$</sup><?php echo e((int) $plan->price); ?><span
                                                class="period">/<?php echo e($plan->validity > 360 ? 'year' : 'month'); ?></span>
                                        </h6>
                                    </div>
                                    <p class="sidetitle text-center"><?php echo e($plan->description); ?></p>
                                    <center>                 
                                        <a class="btn btnAll text-uppercase get_started" href="<?php echo e($register_url . $plan->type_of_plan . '/'. base64_encode($plan->id)); ?>">SELECT</a></center>
                                        

                                        <!-- <p class="sidetitle mt-3"><?php echo e($plan->features_title); ?></p> -->
                                     
                                        
                                    
                                    <?php
                                        $features = @explode(',',$plan->features);
                                    ?>
                                    <hr class="mt-3 mb-2">
                                    <div class="text-center">
                                        <?php $__currentLoopData = $features?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <p class="featuresList mb-0"><?php echo e($feature); ?></p>
                                       <hr class="my-2">
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php if(@count($features) > 3): ?>
                                        <a href="#!">
                                            <p class="sidetitle sidetitlelink mt-3">See All features ></p>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
               </div>
            </section>
      </div>
    </div>
  </div>
</div> 

