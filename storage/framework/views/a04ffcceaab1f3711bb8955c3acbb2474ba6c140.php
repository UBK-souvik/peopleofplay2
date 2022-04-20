<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
</style>
<div class="accordion__header">
    <h2>Social Media</h2>
    <span class="accordion__toggle"></span>
</div>
<div class="accordion__body">
    <div class="row social_media">
        <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
                $str_social_val = '';
                if(!empty($user->socialMedia))
                {	  
                    $str_social_val = @$user->socialMedia->pluck('value','type')->toArray()[$index];
                }
			?> 
            <div class="col-md-3" >
                <div class="form-group" style="margin-bottom:22px;">
                    <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                    <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]" value="<?php echo e($str_social_val); ?>" class="social form-control">
                    <span class="error" id="error_<?php echo e($social); ?>"></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>