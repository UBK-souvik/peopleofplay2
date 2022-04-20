<?php if($data_type == 2): ?>
   <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
                    <option value="">Select Product</option>
                    <?php $__currentLoopData = $user_product_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_product_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(!empty($int_assign_product_id) && ($int_assign_product_id == $user_product_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_product_row->id); ?>">
                      <?php echo e($user_product_row->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
<?php endif; ?>
 
<?php if($data_type == 3): ?>					 
					 <select name="gallery_meta[assign_event_id]"  class="form-control" data-placeholder="Select">
                    <option value="">Select Event</option>
                    <?php $__currentLoopData = $user_event_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_event_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php if(!empty($int_assign_event_id) && ($int_assign_event_id == $user_event_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_event_row->id); ?>">
                      <?php echo e($user_event_row->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
<?php endif; ?>					