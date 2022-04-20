

<?php $__env->startSection('title'); ?> Main List Paragraph Update <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Main List Paragraph Update</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.cms.main_list_paragraph.index')); ?>"> All Main List Paragraphs </a></li>
            <li class="active">Main List Paragraph Update</li>
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
                        <input type="hidden" name="main_list_paragraph_id" value="<?php echo e(@$main_list_paragraph->id); ?>">

                      <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="type" class="form-control" value="<?php echo e(@$main_list_paragraph->type); ?>">
                                    <input type="text" readonly="" name="type_for_show" class="form-control" value="<?php echo e(ucfirst(config('cms.drop_down_type')[@$main_list_paragraph->type])); ?>" >

                                </div>
                            </div>



                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea  class="form-control" id="description" name="description" placeholder="Description" value=""><?php echo e(@$main_list_paragraph->description); ?>

                          </textarea>
                        </div>
                      </div>
					  
					                        <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($key); ?>" <?php echo e(isset($main_list_paragraph) && $main_list_paragraph->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
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
                url: '<?php echo e(route("admin.cms.main_list_paragraph.update")); ?>',
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
                        window.location.replace('<?php echo e(route("admin.cms.main_list_paragraph.index")); ?>');

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