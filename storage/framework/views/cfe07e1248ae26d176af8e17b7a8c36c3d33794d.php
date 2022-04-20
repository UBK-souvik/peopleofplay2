
<?php $__env->startSection('content'); ?>

<section id="login">
    <div class="container k_black1">
        <div class="row paddingzero">
            <div class="col-md-7 col-md-6 col-xl-5 clearfix klogin_Style my-5 p-4 rounded mx-auto">
                <div class="login_logo">
                    <a href="#" class="d-block bg-white px-3 py-2 text-uppercase text-center text-bold textPurple Logostyle">Reset Password</a>
              </div>
                <form class="formstyle mb-5 mt-2" id="loginForm">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required="required"
                            >
                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required="required"
                            >
                    </div>
                    <div class="d-flex mb-2">
                        <button formaction="#" id="btnLogin" type="submit" class="btn btnLogin mr-2">Submit</button>
                    </div>
                    <small><label class="form-check-label text-dark">
                        <a class="span-style1" href="<?php echo e(route('front.login')); ?>" class="btn-link" >Login</a>
                        </label></small>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
   $(function($) {

            $(document).on('click','#btnLogin',function(e){
                e.preventDefault();

                toastr.remove();

                var fd = new FormData($('#loginForm')[0]);
                $.ajax({
                    url: "<?php echo e(route('front.reset_password')); ?>",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#btnLogin').attr('disabled',true);
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#btnLogin').attr('disabled',false);

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        console.log(msg);
                        // $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#btnLogin').attr('disabled',false);
                        $('#loginForm').trigger('reset');
                        // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        toastr.success(data.message)
                        window.location.replace('<?php echo e(route("front.login")); ?>');

                    }
                });
            });
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>