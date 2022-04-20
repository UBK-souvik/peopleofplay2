
<?php $__env->startSection('content'); ?>

<?php

$str_get_current_user_url_new = App\Helpers\UtilitiesTwo::get_current_user_url_new();

?>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<div class="left-column" id="add-edit-classified-div-id">
    <form id="classified-form" enctype="multipart/form-data">
        <input type="hidden" name="classified_id" value="<?php echo e(@$classified->id); ?>">
        <?php echo csrf_field(); ?>
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			<?php if(!empty($classified->id)): ?>
			  <?php echo e('Edit'); ?>

			<?php else: ?>
			  <?php echo e('Add'); ?>	
			<?php endif; ?>
			
			Classified Post</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Category">Post Under</label><span class="text-danger">*</span>
                                    <select name="category_id" class="custom-select">
                                        <option value>Select</option>
                                        <?php $__currentLoopData = $classified_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <?php if($key == 9): ?>
										   <?php continue; ?>;
										 <?php endif; ?>
										<option value="<?php echo e($key); ?>" <?php echo e(isset($classified) && $classified->category_id == $key ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                            </div>
							<div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Add New Post">Title</label><span class="text-danger">*</span>
                                    <input id="AddNewPost" type="text" name="title" value="<?php echo e(@$classified->title); ?>" class="form-control" placeholder="">
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                <!-- </div> -->
                    <div class="col-md-12 pl-0  paddingBottomTwenty">
                            <div class="form-group m-0">
                                <label for="Comments">Description</label><span class="text-danger">*</span>
                                <textarea id="Comments" name="description"  rows="5" class="form-control"><?php echo e(@$classified->description); ?></textarea>
                            </div>
                    </div>
					
					<div class="col-md-12 pl-0">
                        <div class="form-group">
                            <label for="profile_url">POP Profile Url</label><span class="text-danger">*</span>
                            <input id="profile_url" type="text" name="profile_url" readonly value="<?php echo e(@$str_get_current_user_url_new); ?>" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-12">
                  <div class="row sectionBox">
                    <button type="button" id="classifiedSubmit" class="btn btnAll az">Publish</button>
      				<span class="ml-3 mt-2"><input type="checkbox" name="feed_check" value="on">&nbsp;Share to feed &nbsp;</span>
                  </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>

        //frontend_show_standard_ckeditor_new('Comments');

     // Event Form
     $(document).on('click', '#classifiedSubmit', function (e) {
            e.preventDefault();
			
			var fd = new FormData($('#classified-form')[0]);  
			
			$.ajax({
                url: "<?php echo e(route('front.user.classified.create')); ?>",
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                data: fd,
                processData: false,
                contentType: false,
				dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#classifiedSubmit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#classifiedSubmit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#classifiedSubmit').attr('disabled', false);
					toastr.success("Classified Saved Successfully.");
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    //toastr.success(data.message)
                    window.location.replace('<?php echo e(route("front.user.classified.index")); ?>');

                }
            });
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>