

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('reset_password')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('reset_password')); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.users.index')); ?>"><?php echo e(adminTransLang('all_users')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('reset_password')); ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form id="resetPassword-form" class="form-horizontal">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label for="new_password" class="col-sm-2 control-label"><?php echo e(adminTransLang('new_password')); ?> <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" placeholder="<?php echo e(adminTransLang('new_password')); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label"><?php echo e(adminTransLang('confirm_password')); ?> <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(adminTransLang('confirm_password')); ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-offset-1 col-sm-6">
                            <button type="button" class="btn btn-success" id="resetPasswordBtn"><?php echo e(adminTransLang('change_password')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        jQuery(function($) {
            $(document).on('click','#resetPasswordBtn',function(e){
                e.preventDefault();
                
                $.ajax({
                    url: "<?php echo e(route('admin.users.password-reset', ['id' => $id])); ?>",
                    data: $('#resetPassword-form').serialize(),
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#resetPasswordBtn').attr('disabled',true);
                        $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#resetPasswordBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
                        $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#resetPasswordBtn').attr('disabled',false);
                        if(data.status == 1)
                        {
                            $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');

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