
<?php $__env->startSection('content'); ?>

<div class="left-column ComingSoon border_right col-lg-7 col-md-6" >
    <div class=" ">
        <section>
           <div class="container text-center">
            <div class="MailingList MailingComingSoon" style="border-top: 2px solid transparent;">
             <div class="row">
              <div class="offset-md-2 col-md-8 offset-md-2">
                <div>
                    <img src="<?php echo e(asset('front/images/mainLogo.png')); ?>" width="200">
                </div>
                <h1>Coming Soon...</h1>
                <!-- <h2 class="text-uppercase">And Never Stop Playing</h2> -->                     
            </div>
        </div>
    </div>
</div>
</section>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>