<?php if($dest_id == 1): ?>
   <select class="form-control select2" name="<?php echo e($page_type); ?>_meta[assign_profile_id]" aria-hidden="true" tabindex="-1">
                    <option value="">Select User Profile</option>
                    <?php $__currentLoopData = $arr_user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_profile_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(!empty($int_profile_id) && ($int_profile_id == $user_profile_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_profile_row->id); ?>">
                      <?php echo e($user_profile_row->text); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
<?php endif; ?>

<?php if($dest_id == 2): ?>
   <select class="form-control select2" name="<?php echo e($page_type); ?>_meta[assign_product_id]" aria-hidden="true" tabindex="-1">
                    <option value="">Select Product</option>
                    <?php $__currentLoopData = $arr_product_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_product_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(!empty($int_product_id) && ($int_product_id == $user_product_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_product_row->id); ?>">
                      <?php echo e($user_product_row->text); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
<?php endif; ?>