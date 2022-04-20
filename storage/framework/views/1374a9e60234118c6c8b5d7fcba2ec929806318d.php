
<?php $__env->startSection('content'); ?>

<div class="left-column">
    <div class="First-column border_right">
      <form id="profileForm">
        <?php echo csrf_field(); ?>
        <div class="col-md-12">
        <div id="FirstRow_Product" class="row sectionTop">
          <h3 class="Tile-style social pt-0 w-100 mb-0">Contact Information</h3>
            <!-- <div class="col-md-12"> -->
            
            <!-- <div class="ProfileUploadBtn  text-left">
                <small class="text-danger ">Note: Please upload 4*5 ratio size image</small>
              </div> -->

			<!-- <div class="form-group">
              <label for="CompanyID">User ID</label>
              <input id="CompanyID" type="number" name="user_id_number" readonly value="<?php echo e($user->user_id_number); ?>" class="form-control" placeholder="">
            </div> -->

          <!-- </div> -->
          <!-- <div class="col-md-8 colmargin"> -->
		  
            <!-- <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="UserName">First Name</label><span class="text-danger">*</span>
                  <input id="first_name" type="text" name="first_name" value="<?php echo e($user->first_name); ?>" class="form-control" placeholder="">
                </div>
              </div>
            </div> -->
			<!-- <div class="row">
              <div class="col-md-12 ">
                <div class="form-group mb-0">
                  <label for="UserName">Last Name</label><span class="text-danger">*</span>
                  <input id="last_name" type="text" name="last_name" value="<?php echo e($user->last_name); ?>" class="form-control" placeholder="">
                </div>
              </div>
            </div> -->
			
          <!-- </div> -->
        </div>
      </div>
		<!-- <hr> -->

              
        
      <div class="col-md-12">
        <div class="row sectionTop" style="padding-top: 0;">
          <!-- <h3 class="sec_head_text w-100">Contact Information</h3> -->

          <div class="col-md-4 pl-0 inputPaddingLeft">
            <div class="form-group">
              <label for="UserName">First Name</label><span class="text-danger">*</span>
              <input id="first_name" type="text" name="first_name" value="<?php echo e($user->first_name); ?>" class="form-control" placeholder="">
            </div>
          </div>

          <div class="col-md-4 ">
            <div class="form-group">
              <label for="UserName">Last Name</label><span class="text-danger">*</span>
              <input id="last_name" type="text" name="last_name" value="<?php echo e($user->last_name); ?>" class="form-control" placeholder="">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group mb-0 marginBottomSixteen ">
              <label for="Email">Primary Email</label><span class="text-danger">*</span>
              <input id="Email" type="Email"  readonly name="Email" value="<?php echo e($user->email); ?>"class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-4 pl-0 inputPaddingLeft">
            <div class="form-group mb-0">
              <label for="Mobile">Primary Mobile</label><span class="text-danger">*</span>
              <input id="Mobile" type="number"  name="mobile" value="<?php echo e($user->mobile); ?>" class="form-control" placeholder="">
            </div>
          </div>

        </div>
      </div>
        <div class="row">
          
        </div>
		<div class="row">
          
          
          <div class="col-md-3">
            
            

			<!-- <div class="form-group">
              <label for="City">City</label>
              <input id="City" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="State">State</label>
              <input id="State" type="text"  class="form-control" placeholder="">
            </div> -->
          </div>
          <div class="col-md-12">
            


            <!-- <div class="form-group">
              <label for="Country">Country</label>
              <input id="Country" type="text" name="Country" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="Website">Website</label>
              <input id="Website" type="text" name="Website" class="form-control" placeholder="">
            </div> -->

          </div>

        </div>
        <div class="col-md-12">
          <div class="row sectionBox">
            <button type="button" class="btn btnAll profileEdit">Update</button>
          </div>
        </div>
        
        </form>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- // preview images by kundan -->
<script>
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


		/*function populate_edit_role_data()
		{
			var str_role_name = $(this).data("role-name");

			alert(str_role_name);

			$('#add_edit_profile_role_name').val(str_role_name);
		}*/
</script>
<script>

    $(function ($) {

        $(document).on('click','.add-link',function() {
            var rowSample = $(this)
                .closest('.add-row')
                .clone()
                .appendTo($(this).closest('.parent-row'))
                .find('.add-link')
                .removeClass('add-link btn-success')
                .addClass('remove-link btn-danger')
                .html('- Remove')
        })
        $(document).on('click','.remove-link',function(e) {
            e.preventDefault();
            var rowSample = $(this)
                .closest('.add-row')
                .remove()
        })

        $(document).on('click', '.profileEdit', function (e) {
            e.preventDefault();


            var fd = new FormData($('#profileForm')[0]);
            $.ajax({
                url: "<?php echo e(route('front.user.profile.edit')); ?>",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('.profileEdit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('.profileEdit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('.profileEdit').attr('disabled', false);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message)
                    // window.location.replace('<?php echo e(route("admin.users.index")); ?>');
                    // window.location.replace('<?php echo e(route("front.login")); ?>');

                }
            });
        });
    });
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>