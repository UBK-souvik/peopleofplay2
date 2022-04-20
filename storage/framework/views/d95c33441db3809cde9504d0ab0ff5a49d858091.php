

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('manage_permissions')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> <?php echo e(adminTransLang('manage_permissions')); ?> -- <?php echo e(@$user_type->name); ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
        <li><a href="<?php echo e(route('admin.permission.index')); ?>"> <?php echo e(adminTransLang('all_role')); ?> </a></li>
        <li class="active"><?php echo e(adminTransLang('manage_permissions')); ?></li>
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
                        <input type="hidden" name="id" value="<?php echo e(@$user_type->id); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="box">
                                    <div class="box-body" id="add-edit-user-main-box-body-div">
                                        <h3>User Permissions</h3>
                                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Gender</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="gender" <?php echo e((in_array('gender', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div> 
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Born</strong>
                                            </label> 
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="born" <?php echo e((in_array('born', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Email</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="email" <?php echo e((in_array('email', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Contact Info</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="contact_info" <?php echo e((in_array('contact_info', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Postal Address</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="postal_address" 
                                                    <?php echo e((in_array('postal_address', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>City</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="city" <?php echo e((in_array('city', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>State</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="state" <?php echo e((in_array('state', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Postcode/Zipcode</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="post_zip_code" <?php echo e((in_array('post_zip_code', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Country</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="country" <?php echo e((in_array('country', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Website</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="website" <?php echo e((in_array('website', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Business Address</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="bussiness_address" <?php echo e((in_array('bussiness_address', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Skills</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="skills" <?php echo e((in_array('skills', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Date at company (From - To)</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="date_at_company" <?php echo e((in_array('date_at_company', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>User Roles</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" value="user_roles" <?php echo e((in_array('user_roles', $UserTypePermission) ? 'checked' : '')); ?> class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Social Media</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('social_media', $UserTypePermission) ? 'checked' : '')); ?> value="social_media" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <h3>Product Permissions</h3>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Category</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('category', $UserTypePermission) ? 'checked' : '')); ?> value="category" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Sub-Categories</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('sub_category', $UserTypePermission) ? 'checked' : '')); ?> value="sub_category" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <h3>Event Permissions</h3>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Event Name</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('event_name', $UserTypePermission) ? 'checked' : '')); ?> value="event_name" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Event Description</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('event_description', $UserTypePermission) ? 'checked' : '')); ?> value="event_description" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Event Website</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('event_website', $UserTypePermission) ? 'checked' : '')); ?> value="event_website" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Event Profile picture</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('event_p_p', $UserTypePermission) ? 'checked' : '')); ?> value="event_p_p" class="checkAll"> 
                                                </label>  
                                            </div>
                                        </div> 

                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Event Show ON</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('event_show_on', $UserTypePermission) ? 'checked' : '')); ?> value="event_show_on" class="checkAll"> 
                                                </label>  
                                            </div> 
                                        </div>
                                        <h3>Award Permissions</h3>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Award Company</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('award_company', $UserTypePermission) ? 'checked' : '')); ?> value="award_company" class="checkAll"> 
                                                </label>  
                                            </div> 
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Award Year Established</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('award_yr_establish', $UserTypePermission) ? 'checked' : '')); ?> value="award_yr_establish" class="checkAll"> 
                                                </label>  
                                            </div> 
                                        </div>
                                        <div id="permission-user-38" class="col-sm-12">
                                            <label for="" class="col-sm-4">
                                                <strong>Award Year dissolved</strong>
                                            </label>
                                            <div class="col-sm-8">        
                                                <label>
                                                    <input type="checkbox"  name="navigation_id[]" <?php echo e((in_array('award_yr_desolve', $UserTypePermission) ? 'checked' : '')); ?> value="award_yr_desolve" class="checkAll"> 
                                                </label>  
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="button" class="btn btn-success" id="createBtn"><?php echo e(adminTransLang('save_permission')); ?></button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    jQuery(function($) {
      $(document).on('click','#createBtn',function(e){
        e.preventDefault()
        $.ajax({
            url: "<?php echo e(route('admin.permission.permission.save', ['id' => $user_type->id ])); ?>",
            data: $('#create-form').serialize(),
            dataType: 'json',
            type: 'POST',
            beforeSend: function()
            {
                $('#createBtn').attr('disabled',true)
                $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger')
            },
            error: function(jqXHR, exception){
                $('#createBtn').attr('disabled',false)

                var msg = formatErrorMessage(jqXHR, exception)
                $('.message_box').html(msg).removeClass('hide')
            },
            success: function (data)
            {
                $('#createBtn').attr('disabled',false)
                if(data.status == 1)
                {
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success')
                    window.location.replace('<?php echo e(route("admin.permission.index")); ?>')

                } else {
                    var message = formatErrorMessageFromJSON(data.errors)
                    $('.message_box').html(message).removeClass('hide')
                }

            }
        })
    })

    $(document).on('change', '.checkAll', function(e){
        var ContainerID = $(this).val();
        var status = this.checked ? true : false;
        $("#permission-user-"+ContainerID).find("input[type=checkbox]").each(function(){
            this.checked = status;
        })  
    });
})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>