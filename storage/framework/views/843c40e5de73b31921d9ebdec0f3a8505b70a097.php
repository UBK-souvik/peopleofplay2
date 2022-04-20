

<?php $__env->startSection('title'); ?> Create Dictionaries <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php
$int_description_words_length = @App\Helpers\UtilitiesTwo::word_description_words_length();
?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Dictionaries</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.dictionary.index')); ?>"> All Dictionaries </a></li>
            <li class="active">Create Dictionary</li>
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
                        <input type="hidden" name="dictionary_id" value="<?php echo e(@$dictionary->id); ?>">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$dictionary->title); ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Author <i class="has-error">*</i></label>
                        <div class="col-sm-6">
						  
						
							  <select class="form-control select2" name="user_id">
								<option value="">Select</option>
							    
							         <option <?php if(!empty($dictionary->added_by) && $dictionary->added_by == 2): ?> <?php echo e('selected'); ?> <?php endif; ?> value="0"><?php echo e(Config::get('commonconfig.web_site_name_new')); ?></option>
						        
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									  <option value="<?php echo e($key); ?>" <?php echo e(!empty($dictionary->user_id) && $dictionary->user_id == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  </select>
						  
						  
                        </div>
                      </div>

                      
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea  maxlength="<?php echo e($int_description_words_length); ?>" class="form-control" id="description" name="description" placeholder="Description" value=""><?php echo e(@$dictionary->description); ?>

                          </textarea>
                        </div>
                      </div>


                      <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">Word of the Day </label>
			  <div class="col-sm-6">
				 <input min="<?php echo date("Y-m-d"); ?>" id="date_to_be_published" 
		   value="<?php if(!empty($dictionary->date_to_be_published)): ?><?php echo e($dictionary->date_to_be_published); ?><?php endif; ?>" type="date" class="form-control" 
	placeholder="Publish Date" name="date_to_be_published">
			  </div>
		   </div>


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.dictionary_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <option value="<?php echo e($key); ?>" <?php echo e(!empty($dictionary->status) && $dictionary->status == $key ? 'selected' : ''); ?>><?php if(strtolower($status) == 'approved'): ?><?php echo e('Approve'); ?> <?php else: ?> <?php echo e($status); ?><?php endif; ?></option>
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


function save_dictionary_form_data(confirm_flag)
{
            var fd = new FormData($('#create-form')[0]);  
			
			fd.append('confirm_flag', confirm_flag);			
  		
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '<?php echo e(route("admin.dictionary.create")); ?>',
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
                        window.location.replace('<?php echo e(route("admin.dictionary.index")); ?>');

                    } else {
                         if(data.status == 2)
						 {
							 var int_confirm_flag = confirm(data.msg);
							 
							 if(int_confirm_flag)
							 {
			                   save_dictionary_form_data(0);					 
							 }
							 
						 }
						
						//var message = formatErrorMessageFromJSON(data.errors);
                        //$('.message_box').html(message).removeClass('hide');
                    }

                }
            });

    }


    jQuery(function($) {
       

        $(document).on('click','#createBtn',function(e){
            e.preventDefault();
      			
      		save_dictionary_form_data(1);	
			
			
			
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>