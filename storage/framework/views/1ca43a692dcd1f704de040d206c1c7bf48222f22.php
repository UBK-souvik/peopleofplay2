

<?php $__env->startSection('title'); ?> Create Classified <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Classified</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.classified.index')); ?>"> All Classifieds </a></li>
            <li class="active">Create Classified</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                        <input type="hidden" name="classified_id" value="<?php echo e(@$classified->id); ?>">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$classified->title); ?>">
                        </div>
                      </div>
					  
					  <?php echo $__env->make('admin.includes.author_drop_down_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="category_id">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $classified_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($key); ?>" <?php echo e(isset($classified) && $classified->category_id == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea  class="form-control" id="description" name="description" placeholder="Description" value=""><?php echo e(@$classified->description); ?>

                          </textarea>
                        </div>
                      </div>
					  
					  
					  <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Profile Url <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input id="profile_url" type="text" name="profile_url" readonly value="<?php echo e(@$classified->profile_url); ?>" class="form-control" placeholder="">
                        </div>
                      </div>
					  

                      <!-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <input type="file" name="featured_image" >
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <img src="<?php echo e(@imageBasePath($classified->featured_image)); ?>" width="100" alt="">
                        </div>
                      </div> -->


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.classified_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <?php if($key>0): ?>
									<option value="<?php echo e($key); ?>" <?php echo e(isset($classified) && $classified->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
								  <?php endif; ?>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>

                      <?php echo csrf_field(); ?>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">


function get_classified_user_url(int_user_id)
{
	
	
$.ajax({

			url: '<?php echo e(route("admin.classified.get-user-url")); ?>',

			type: 'post',

			dataType: "json",

			data: {

			 int_user_id: int_user_id,

			 token: ajax_csrf_token_new,

			},

			headers: {

			 'X-CSRF-TOKEN': ajax_csrf_token_new

			},
			
			beforeSend: function () {
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },

			success: function( data ) {
				$('#profile_url').val(data.msg);			
			}

		   });
}		   
		   


    jQuery(function($) {
        $('.select2').select2()

        $(document).on('click','#createBtn',function(e){
            e.preventDefault();
      			
      			var fd = new FormData($('#create-form')[0]);  
  		
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '<?php echo e(route("admin.classified.create")); ?>',
  			        headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                type: 'POST',
                beforeSend: function()
                {
                    $('#createBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#createBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('<?php echo e(route("admin.classified.index")); ?>');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>