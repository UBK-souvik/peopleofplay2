

<?php $__env->startSection('title'); ?> Home Page Whatever Day Create <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Home Page Whatever Day Create</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.cms.happy_whatever_day.index')); ?>"> All Home Page Whatever Day List</a></li>
            <li class="active">Home Page Whatever Day Create</li>
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
                        <input type="hidden" name="happy_whatever_day_id" value="<?php echo e(@$happy_whatever_day->id); ?>">
    
							
							
							 <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Custom Text 1 <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input id="home_caption_one" type="text" value="<?php echo e(@$happy_whatever_day->home_caption_one); ?>" name="home_caption_one" class="form-control" placeholder="">
                                </div>
                             </div>

                             <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Custom Text 2 <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input id="home_caption_two" type="text" value="<?php echo e(@$happy_whatever_day->home_caption_two); ?>" name="home_caption_two" class="form-control" placeholder="">
                                </div>
                             </div>
							 
							 
							 
							 <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="product_id">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $get_product_list_dropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_get_product_list_dropdown_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					           <?php
							   //$arr_get_product_list_dropdown_row =  json_decode(@$get_product_list_dropdown_row);
							   $key = @$arr_get_product_list_dropdown_row->id;
							   $status = @$arr_get_product_list_dropdown_row->text;
                               ?>							   
							  <option value="<?php echo e($key); ?>" <?php echo e(isset($happy_whatever_day->product_id) && $happy_whatever_day->product_id == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">Date of Publish</label>
			  <div class="col-sm-6">
				 <input  min="<?php echo date("Y-m-d"); ?>" id="date_to_be_published" 
		   value="<?php if(!empty($happy_whatever_day->date_to_be_published)): ?><?php echo e($happy_whatever_day->date_to_be_published); ?><?php endif; ?>" type="date" class="form-control" 
	placeholder="Publish Date" name="date_to_be_published">
			  </div>
		   </div>
							 
							 
					                        <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($key); ?>" <?php echo e(isset($happy_whatever_day) && $happy_whatever_day->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
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
                url: '<?php echo e(route("admin.cms.happy_whatever_day.update")); ?>',
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
					
					if(jqXHR.responseText.indexOf('Whatever day already exists')>0)
					{
					   var err = eval("(" + jqXHR.responseText + ")");
                       var msg = err.msg;
					}
					else
					{
					   var msg = formatErrorMessage(jqXHR, exception);	
					}
					
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('<?php echo e(route("admin.cms.happy_whatever_day.index")); ?>');

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