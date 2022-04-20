<div  class="col-md-12 mb-4 mt-2">
	<a href="<?php if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1): ?><?php echo e(url('/change-plan/1')); ?><?php else: ?><?php echo e(url('/login')); ?><?php endif; ?>">
	   <div class="bg-image" style='background-image: url("<?php echo e(url('/')); ?>/uploads/images/advertisements/20200831075726hmWjHM92wg_advertisements_.png");'></div>
	      <div class="bg-text w-100">
	        <h1><?php if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1): ?><?php echo e('Please Upgrade your Plan'); ?><?php else: ?><?php echo e('Log In to See'); ?><?php endif; ?></h1>
	        <p class="text-white"></p>
	      </div>
	</a>
</div>