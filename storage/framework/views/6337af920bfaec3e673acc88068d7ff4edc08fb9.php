
<?php $__env->startSection('content'); ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column">
    <form id="media-form" enctype="multipart/form-data">
        <input type="hidden" name="media_id" value="<?php echo e(@$media->id); ?>">
        <?php echo csrf_field(); ?>
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			<?php if(!empty($media->id)): ?>
			  <?php echo e('Edit'); ?>

			<?php else: ?>
			  <?php echo e('Add'); ?>	
			<?php endif; ?>
			
			Media</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    <?php
					  $str_featured_image_type_new = 'media';
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
						<div class="form-group">
							<label for="Add New Post">Caption</label>
							<textarea class="form-control " rows="2" id="Caption" placeholder="Caption" name="caption"><?php echo e(@$media->caption); ?></textarea>
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
						<button type="button" id="mediaSubmit" class="btn btnAll az">Publish</button>
						<?php if(isset($is_only_feed) && $is_only_feed == 1): ?>
							<input type="hidden" name="feed_check" value="on">
							<input type="hidden" id="only_feed" class="is_only_feed" name="is_only_feed" value="1">
							<input type="hidden" name="is_feed_image" value="<?php echo e(@$media->featured_image); ?>">
							<span class="ml-3 mt-1"><input type="checkbox" name="feed_check" value="on" checked disabled>&nbsp;Share to feed &nbsp;</span>
						<?php else: ?>
							<span class="ml-3 mt-1"><input type="checkbox" name="feed_check" value="on">&nbsp;Share to feed &nbsp;</span>
						<?php endif; ?>
						<?php echo $__env->make('includes.include_add_update_loading_btn', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
					</div>
					<div class="col-md-12 text-danger mt-2">
						<small>Note: If you want the changes to take effect on Feed please check the 'Share to my feed' Checkbox</small>
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
     $(document).on('click', '#mediaSubmit', function (e) {
            e.preventDefault();
			
			var chk_is_valid_file = FileValidation('featured_image');
			
			if(chk_is_valid_file)
			{
				var fd = new FormData($('#media-form')[0]);  
				
				$.ajax({
					url: "<?php echo e(route('front.user.media.create')); ?>",
					headers: {
					 'X-CSRF-TOKEN': ajax_csrf_token_new
					},
					data: fd,
					processData: false,
					contentType: false,
					dataType: 'json',
					type: 'POST',
					beforeSend: function () {
						//$('#mediaSubmit').attr('disabled', true);
						show_hide_loading_button_add_update_pages(1);
						// $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
					},
					error: function (jqXHR, exception) {
						//$('#mediaSubmit').attr('disabled', false);
						show_hide_loading_button_add_update_pages(0);

						var msg = formatErrorMessage(jqXHR, exception);
						toastr.error(msg)
						console.log(msg);
						// $('.message_box').html(msg).removeClass('hide');
					},
					success: function (data) {
						//$('#mediaSubmit').attr('disabled', false);
						show_hide_loading_button_add_update_pages(1);
						//$('#media-form').trigger('reset')
						toastr.success("Media Saved Successfully.");
						// $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
						//toastr.success(data.message)
						if($('#only_feed').hasClass('is_only_feed')){
							window.location.replace('<?php echo e(route("front.home")); ?>');
						}else{
							window.location.replace('<?php echo e(route("front.user.media.index")); ?>');
						}

					}
				});
			}	
			
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>