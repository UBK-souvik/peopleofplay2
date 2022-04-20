 <?php if(Session::has('fail')): ?>
	<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
		<?php echo e(Session::get('fail')); ?>

	</div>
 <?php endif; ?>

 <?php if(Session::has('success')): ?>
	<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <i class="ace-icon fa fa-check green"></i>
		<?php echo e(Session::get('success')); ?>

	</div>
 <?php endif; ?>