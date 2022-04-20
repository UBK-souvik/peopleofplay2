<?php
$str_side_class_name_new ='sidewidth';
$str_top_class_name_new ='row homesectionTitleBox top_banner_class py-0';
?>

<?php $__currentLoopData = $ajax_between_advertisement_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ajax_between_advertisement_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                	

    <!-- <div class="<?php if($int_position>1): ?><?php echo e($str_side_class_name_new); ?><?php else: ?><?php echo e($str_top_class_name_new); ?><?php endif; ?>"> 

		<a target="_blank" href="<?php echo e(url('/ads/get-no-clicks/'.$ajax_between_advertisement_data_row->id)); ?>">

		<img src="<?php echo e(@imageBasePath($ajax_between_advertisement_data_row->advertisement_image)); ?>" class="img-fluid text-center mb-2 imgadvertisementInner" width="100%">

			<p class="mt-0 mb-1"><span class="span-style1"><?php echo e($ajax_between_advertisement_data_row->sponsor_name); ?></span></p>

		</a> 

	</div> -->

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				

<?php if(!empty($ajax_between_advertisement_data) && count($ajax_between_advertisement_data)>0): ?>

  <!-- <hr> -->

<?php endif; ?>