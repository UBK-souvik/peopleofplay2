

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('sign_in')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p class="alert alert-block alert-danger message_box hide"></p>
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success alert-dismissible" id="message_box">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <i class="ace-icon fa fa-check green"></i>
            <?php echo e(Session::get('success')); ?>

        </div>
    <?php endif; ?>
 

    <div class="login-box-body">
        <p class="login-box-msg"><?php echo e(adminTransLang('sign_in_to_start_your_session')); ?></p>
        <form id="login-form" method="post" action="#">
            <div class="form-group has-feedback">
                <input type="email" class="form-control login_input" name="email" placeholder="<?php echo e(adminTransLang('email')); ?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control login_input" placeholder="<?php echo e(adminTransLang('password')); ?>" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck hide">
                        <label>
                            <input type="checkbox" name="remember"> <?php echo e(adminTransLang('remember_me')); ?>

                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat" id="login-submit"><?php echo e(adminTransLang('sign_in')); ?></button>
                </div>
            </div>
            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    jQuery(function($) {

        $(document).on('click','#login-submit',function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo e(route("admin.login")); ?>',
                dataType : 'json',
                type: 'POST',
                data: $('#login-form').serialize(),
                beforeSend: function()
                {
                    $('#message_box').remove();
                    $('#login-submit').attr('disabled',true);
                    $('.message_box').html('').addClass('hide');
                },
                error: function(jqXHR, exception){
                    $('#login-submit').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#login-submit').html(data.success).removeClass('btn-primary').addClass('btn-success');
                    window.location.replace('<?php echo e(route("admin.dashboard")); ?>');
                }
            });
        });

        $(document).on('keypress', '.login_input', function(e){
            if(e.which == 10 || e.which == 13) {
                e.preventDefault();
                $('#login-submit').click();
            }
        });

        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.login-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>