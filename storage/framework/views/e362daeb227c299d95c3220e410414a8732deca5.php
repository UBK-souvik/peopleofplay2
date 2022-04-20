<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <link rel="icon" type="image/x-icon" href="<?php echo e(URL::to('frontend/images/favicon.png')); ?>" />
        <title><?php echo e(adminTransLang('admin_app_name')); ?> - <?php echo $__env->yieldContent('title'); ?></title>


        <meta name="description" content="<?php echo e(config('app.name')); ?> - <?php echo $__env->yieldContent('title'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/bootstrap/css/bootstrap.min.css')); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/dist/css/AdminLTE.min.css')); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/iCheck/square/blue.css')); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<?php echo $__env->make('includes.php_debug_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head> 
    <body class="hold-transition login-page">
        
        <div class="login-box">
            <div class="login-logo">
                
                <div class="clearfix"></div>
                <a>
                    <b><?php echo e(config('cms.company')); ?></b><br>
                    <?php echo e(adminTransLang('admin_panel')); ?>

                </a>
            </div>
            <!-- /.login-logo -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo e(URL::to('backend/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo e(URL::to('backend/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo e(URL::to('backend/plugins/iCheck/icheck.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('backend/js/main.js')); ?>"></script>
        
		
	  <script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
		
		<?php echo $__env->yieldContent('scripts'); ?>
        
    </body>
</html>