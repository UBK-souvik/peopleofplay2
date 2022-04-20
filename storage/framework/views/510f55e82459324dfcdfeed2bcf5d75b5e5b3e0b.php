

<?php $__env->startSection('title'); ?> Create Dictionary <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php
$int_description_words_length = @App\Helpers\UtilitiesTwo::word_description_words_length();
$current_url_new = URL::current();
?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Calendar Dictionary</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li> Calendar Dictionary</li>
            <li class="active">Calendar Dictionary</li>
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
                        <input type="hidden" name="dictionary_data_id" value="<?php echo e(@$dictionary_data->id); ?>">

                      <div class="form-group">
			  <label for="name" class="col-sm-2 control-label">Word of the Day </label>
			  <div class="col-sm-6">
				 <input  min="<?php echo date("Y-m-d"); ?>" id="date_to_be_published" 
		   value="<?php if(!empty($str_current_selected_date_new)): ?><?php echo e($str_current_selected_date_new); ?><?php endif; ?>" type="date" class="form-control" 
	placeholder="Publish Date" name="date_to_be_published" onchange="window.location.href='<?php echo e($current_url_new); ?>?current_selected_date='+this.value;">
			  </div>
		   </div>
		   
		   
		   <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Word <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="word_id" onchange="return get_word_description_ajax(this.value);">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $words_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $words_list_key => $words_list_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($words_list_key); ?>" <?php echo e(!empty($dictionary_chk_data) && $dictionary_chk_data->id == $words_list_key ? 'selected' : ''); ?>><?php echo e($words_list_value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
		   
		   <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description </label>
                        <div class="col-sm-6">
                          <div id="div-dictionary-description-id">
						  <?php if(!empty($dictionary_chk_data->description)): ?><?php echo e($dictionary_chk_data->description); ?><?php endif; ?>
						  </div>
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


function save_dictionary_word_form_data(confirm_flag)
{
            var fd = new FormData($('#create-form')[0]);  
			
			fd.append('confirm_flag', confirm_flag);			
			
		 	var str_date_to_be_published = $('#date_to_be_published').val();
  		
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '<?php echo e(route("admin.dictionary.calendar.create")); ?>',
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
                        window.location.replace(baseUrl + '/admin/dictionary/calendar_word/?current_selected_date='+str_date_to_be_published);

                    } else {
						 // for confirm message if the date alreday assigned to a word 
                         if(data.status == 2)
						 {
							 var int_confirm_flag = confirm(data.msg);
							 
							 if(int_confirm_flag)
							 {
			                   save_dictionary_word_form_data(0);					 
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
      			
      		save_dictionary_word_form_data(1);	
			
			
			
        });
    });
	
	
function get_word_description_ajax(word_id)
{
	   $.ajax({
        url: baseUrl + "/admin/dictionary/get-dictionary-description/" + word_id,
        headers: {
         'X-CSRF-TOKEN': ajax_csrf_token_new
        },
        type: 'GET',
        beforeSend: function () {
            //$('.productSubmitButton').attr('disabled', true);
            // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
        },
        error: function (jqXHR, exception) {
            //$('.productSubmitButton').attr('disabled', false);

            var msg = formatErrorMessage(jqXHR, exception);
            toastr.error(msg);
            console.log(msg);
            // $('.message_box').html(msg).removeClass('hide');
        },
        success: function (data) {
		   //base_url_new + 
	       $('#div-dictionary-description-id').html(data.description);
        }
       });	
	
}
	
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>