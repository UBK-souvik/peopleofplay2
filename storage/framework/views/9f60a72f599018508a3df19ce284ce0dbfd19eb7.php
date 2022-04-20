

<?php $__env->startSection('title'); ?> Edit Free User <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
.intl-tel-input.allow-dropdown {width: 100%; }
</style>
    <section class="content-header">
        <h1>Edit Free Innovator </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.free.users.index')); ?>">All Free Users</a></li>
            <li class="active">Edit Free Innovator </li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" id="add-edit-user-main-box-body-form">
        						            <?php echo e(csrf_field()); ?>

                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">First Name <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="first_name" placeholder="Name" value="<?php if(!empty($user->first_name)): ?><?php echo e($user->first_name); ?><?php endif; ?>">
                                          </div>
                                        </div>
                                       <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Last Name <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php if(!empty($user->last_name)): ?><?php echo e($user->last_name); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="email" class="col-sm-2 control-label">Email <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input type="email" readonly="" required class="form-control" name="email" placeholder="Email"  value="<?php if(!empty($user->email)): ?><?php echo e($user->email); ?><?php endif; ?>">
                                          </div>
                                       </div>
									   
                                       <div class="form-group">
                                          <label for="mobile" class="col-sm-2 control-label">Mobile <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input type="text" required class="form-control" name="mobile" value="<?php if(!empty($user->mobile)): ?><?php echo e($user->mobile); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="row">
								                        <input type="hidden"  id="admin_add_edit_profile_role_random_time_stamp_hidden_id" name="admin_add_edit_profile[random_time_stamp_new]" value="<?php echo e($str_random_time_stamp_new); ?>">	
                                        <button type="button" class="btn btn-success" id="createBtn">Save</button>
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
<script>
    $(document).ready(function(){
		  
    
        $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput({
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
          initialCountry: 'auto',
          geoIpLookup: function(callback) {
            callback('us');
          }
        });

        var mob = "<?php echo e(!empty(@$user->mobile) ? '+'.$user->dial_code.$user->mobile : '0'); ?>";
        if(mob != 0){
            $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput("setNumber", mob);
        }
        
        $('body').on('click','#add-edit-user-main-box-body-div  #createBtn',function(e){
            e.preventDefault();
      			 if($.trim($('#add-edit-user-main-box-body-div  [name="mobile"]').val()) != '' && $('#add-edit-user-main-box-body-div  [name="mobile"]').intlTelInput("isValidNumber") == false) {
                      $('#add-edit-user-main-box-body-div  .message_box').html('<?php echo e(adminTransLang("invalid_mobile_no")); ?>').removeClass('alert-success hide').addClass('alert-danger');;
                      return false;
                  }

            var phone = $('#add-edit-user-main-box-body-div  [name="mobile"]').intlTelInput("getSelectedCountryData");
            $('#add-edit-user-main-box-body-div  [name="mobile"]').val(($('#add-edit-user-main-box-body-div  [name="mobile"]').val()).replace(/ /g, ''));
            var fd = new FormData($('#add-edit-user-main-box-body-div  form')[0]);
            fd.append('dial_code', phone.dialCode);


            $.ajax({
      			    url: "<?php echo e(route('admin.free_users.showedit', $user_id)); ?>",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',true);
                    $('#add-edit-user-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
					          var res = msg.replace(/The/g, "");
                    $('#add-edit-user-main-box-body-div  .message_box').html(res).removeClass('hide');
                },
                success: function (data)
                {
                    $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);                        
                    window.location.replace('<?php echo e(route("admin.free.users.index")); ?>');
                    
                }
            });
        });
    });	
	
	
	function delete_role_ajax(user_id, role_id)
	{
		var confirm_chk = confirm("Are you sure?");
		if(confirm_chk == true)
		{
		    $.ajax({
            url: baseUrl + "/admin/users/delete-role-data/" + user_id + "/" + role_id,
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
		       $('#add-edit-user-main-box-body-div  #roleDivId'+role_id).hide();
            }
           });	
		}
	}
</script>

<?php echo $__env->make('admin.users.admin_edit_profile_dob_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>