<?php 
  $arr_badges_list = @App\Helpers\UtilitiesTwo::get_batch_list_data();
?>

<?php $__currentLoopData = $arr_badges_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_badges_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
  $int_batch_id = $arr_badges_list_row;  
  $str_badge_name = 'badge_' . $int_batch_id;
  $str_badge_caption = 'badge_' . $int_batch_id . '_caption';
?>

<div class="form-group">
          <label for="profile_image" class="col-sm-2 control-label">Badge Image <?php echo e($int_batch_id); ?><i class="has-error"></i></label>
          <div class="col-sm-6">
              <img id="badge-blah-image-<?php echo e($int_batch_id); ?>" src="<?php echo e(@imageBasePath(@$user->$str_badge_name)); ?>" alt="" class="twoFiftySeven">
			<?php if(!empty($user->$str_badge_name)): ?>
            <?php else: ?>
              <!-- <img id="profile-blah-image" src="<?php echo e(url('front/new/images/10.png')); ?>" alt="" class="twoFiftySeven"> -->
            <?php endif; ?>
            <input id="file-uploadten-<?php echo e($int_batch_id); ?>" accept="image/*" onchange="readBadgeURL(this, <?php echo e($int_batch_id); ?>);" type="file" name="<?php echo e($str_badge_name); ?>" class="marginTopFive">
            <h4 class="text-danger ">Note: Please upload image up to <?php echo e(App\Helpers\UtilitiesTwo::get_max_upload_image_size()); ?> only</h4>
          </div>
       </div>

<div class="form-group">
          <label for="badge_caption" class="col-sm-2 control-label">Badge Caption <?php echo e($int_batch_id); ?><i class="has-error"></i></label>
          <div class="col-sm-6">
            <input id="text-badge-caption-<?php echo e($int_batch_id); ?>" type="text" name="<?php echo e($str_badge_caption); ?>" value="<?php echo e(@$user->$str_badge_caption); ?>" class="form-control">
          </div>
       </div>	   
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>