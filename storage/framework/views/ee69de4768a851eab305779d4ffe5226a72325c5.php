

<?php $__env->startSection('title'); ?> Create Truth or Lie <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Truth or Lie</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.question.index')); ?>"> All 3 Truths & a Lie </a></li>
            <li class="active">Create Truth or Lie</li>
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
                        <input type="hidden" name="question_id" value="<?php echo e(@$question->id); ?>">
					  
					  <?php echo $__env->make('admin.includes.author_drop_down_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                   
				      <?php  
				       $arr_questions_ids = App\Helpers\UtilitiesTwo::get_questions_list_new();
					  ?>

                      <?php $__currentLoopData = $arr_questions_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_questions_id_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  
					  <?php
					    $int_question_id = $arr_questions_id_row;
					  ?>
					  <?php echo $__env->make('admin.includes.include_truth_drop_down', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					  
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.blog_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <?php if($key>0): ?>
									<option value="<?php echo e($key); ?>" <?php echo e(isset($question) && $question->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
								  <?php endif; ?>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>
					  
					  
					  <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Which is a Lie? <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <span>
						  <select name="which_is_lie" class="form-control">
                              <?php $__currentLoopData = $arr_questions_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_questions_id_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    <option <?php if(!empty($question->which_is_lie) && $question->which_is_lie==$arr_questions_id_row): ?><?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($arr_questions_id_row); ?>"><?php echo e($arr_questions_id_row); ?></option>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </select>
						  </span>
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
                url: '<?php echo e(route("admin.question.create")); ?>',
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
                        window.location.replace('<?php echo e(route("admin.question.index")); ?>');

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