
<?php $__env->startSection('content'); ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column">
    <form id="award-form" enctype="multipart/form-data">
        <input type="hidden" name="media_id" value="<?php echo e(@$media->id); ?>">
        <?php echo csrf_field(); ?>
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			<?php if(!empty($media->id)): ?>
			  <?php echo e('Edit'); ?>

			<?php else: ?>
			  <?php echo e('Add'); ?>	
			<?php endif; ?>
			
			Awards</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    <?php
					  $str_featured_image_type_new = 'award';
					?>
					<?php echo $__env->make('front.user.include_featured_image', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					
                    <div class="col-md-8">
						<div class="form-group">
							<label for="Add New Post">Title</label><span class="text-danger">*</span>
							<input id="AddNewPost" type="text" name="title" value="<?php echo e(@$media->title); ?>" class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label for="Add New Post">Url</label><span class="text-danger">*</span>
							<input id="AddNewUrl" type="text" name="url_data" value="<?php echo e(@$media->url_data); ?>" class="form-control" placeholder="">
						</div>  
                    </div>
					
					<!-- <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Add New Post">Url</label><span class="text-danger">*</span>
                                    <input id="AddNewUrl" type="text" name="url_data" value="<?php echo e(@$media->url_data); ?>" class="form-control" placeholder="">
                                </div>
                            </div>
                            
                        </div>
                    </div> -->
                <!-- </div> -->
                    
                </div>
                </div>
            
            <div class="col-md-12">
              <div class="row sectionBox">
			   <div class="col-md-12">
					<button type="button" id="awardSubmit" class="btn btnAll az">Publish <i class="fa fa-spinner fa-spin str_loader" style="display: none;"></i></button>                
					<?php echo $__env->make('includes.include_add_update_loading_btn', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
				</div>			
			  </div>
            </div>
            </div>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>

     // Event Form
     $(document).on('click', '#awardSubmit', function (e) {
            e.preventDefault();
			
			var chk_is_valid_file = FileValidation('featured_image');
			
			if(chk_is_valid_file)
			{
				var fd = new FormData($('#award-form')[0]);  
				
				$.ajax({
					url: "<?php echo e(route('front.user.award.create')); ?>",
					headers: {
					 'X-CSRF-TOKEN': ajax_csrf_token_new
					},
					data: fd,
					processData: false,
					contentType: false,
					dataType: 'json',
					type: 'POST',
					beforeSend: function () {
						$('#awardSubmit').attr('disabled',true);
						$('.str_loader').show();
					},
					error: function (jqXHR, exception) {
						var msg = formatErrorMessage(jqXHR, exception);
						toastr.error(msg)
						$('.str_loader').hide();
						$('#awardSubmit').attr('disabled',false);
					},
					success: function (data) {
					   toastr.success("Award Saved Successfully.");
					   window.location.replace('<?php echo e(route("front.user.award.index")); ?>');
					   $('.str_loader').hide();
					   $('#awardSubmit').attr('disabled',false);

					}
				});
			}	
			
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>