<?php
 $current_url_new = URL::current();
 if(strpos($current_url_new,'/admin/blog/create')>0 || strpos($current_url_new,'/admin/blog/update')>0)
  {
	$is_chk_admin_blog_flag = 1;  
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <link rel="icon" type="image/x-icon" href="<?php echo e(URL::to('frontend/images/favicon.png')); ?>" />
        <title><?php echo e(adminTransLang('admin_app_name')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

        <meta name="description" content="<?php echo e(config('app.name')); ?> - <?php echo $__env->yieldContent('title'); ?>" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <link rel="shortcut icon" href="<?php echo e(asset('front/images/mainLogo.png')); ?>" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/bootstrap/css/bootstrap.min.css')); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/ionicons-2.0.1/css/ionicons.min.css')); ?>">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/datatables/dataTables.bootstrap.css')); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/dist/css/AdminLTE.min.css')); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/dist/css/skins/_all-skins.min.css')); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/iCheck/flat/blue.css')); ?>">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/morris/morris.css')); ?>">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/datepicker/datepicker3.css')); ?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/daterangepicker/daterangepicker.css')); ?>">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
        <!-- Bootstrap date-time Picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>">

        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/select2/select2.min.css')); ?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/css/site.css')); ?>">
		
		<link rel="stylesheet" href="<?php echo e(URL::to('backend/css/backend_style_two.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::to('backend/css/backend_style_three.css')); ?>">
        <!-- Tel Input -->
        <?php echo $__env->make('includes.include_skills_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('front/new/css/bootstrap-tagsinput.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/jquery-ui.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/custom-jquery-ui.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> 
 
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		
		<?php if(!empty($is_chk_admin_blog_flag)): ?>
			 <?php echo $__env->make('includes.include_quill_js_files', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
		
		<?php echo $__env->make('includes.php_debug_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('styles'); ?>

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        <!-- Header Container Start -->
        <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Header Container End -->
        <!-- Left side column. contains the logo and sidebar -->
        <?php echo $__env->make('admin.includes.leftmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.content-wrapper -->

        <?php echo $__env->make('admin.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <script type="text/javascript">
            var baseUrl = "<?php echo e(URL::to('/')); ?>";
			var ajax_csrf_token_new = '<?php echo csrf_token(); ?>';
        </script>

        <!-- basic scripts -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo e(URL::to('backend/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo e(URL::to('backend/plugins/jQueryUI/jquery-ui.min.js')); ?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo e(URL::to('backend/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <!-- DataTables -->
        <script src="<?php echo e(URL::to('backend/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('backend/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>

        <!-- Sparkline -->
        <script src="<?php echo e(URL::to('backend/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
        <!-- jvectormap -->
        <script src="<?php echo e(URL::to('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo e(URL::to('backend/plugins/knob/jquery.knob.js')); ?>"></script>
        <!-- daterangepicker -->
        <script src="<?php echo e(URL::to('backend/plugins/daterangepicker/moment.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('backend/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
        <script src="<?php echo e(URL::to('backend/plugins/daterangepicker/combodate.js')); ?>"></script>
        <!-- datepicker -->
        <script src="<?php echo e(URL::to('backend/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo e(URL::to('backend/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
        <!-- bootstrap date-time picker -->
        <script src="<?php echo e(URL::to('backend/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>"></script>


        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo e(URL::to('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
        <!-- Slimscroll -->
        <script src="<?php echo e(URL::to('backend/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo e(URL::to('backend/plugins/fastclick/fastclick.js')); ?>"></script>
        
		<?php if(empty($is_chk_admin_blog_flag)): ?>
		<!-- CK Editor -->
        <script src="<?php echo e(URL::to('backend/plugins/ckeditor/ckeditor.js')); ?>"></script>
        <?php endif; ?>
		<!-- Chart JS -->
        <script src="<?php echo e(URL::to('backend/plugins/chartjs/Chart.min.js')); ?>"></script>
        <!-- Select2 -->
        <script src="<?php echo e(URL::to('backend/plugins/select2/select2.full.min.js')); ?>"></script>
        <!-- Tel Input -->
        <?php echo $__env->make('includes.include_skills_js_scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Google Map -->
        

        <!-- AdminLTE App -->
        <script src="<?php echo e(URL::to('backend/dist/js/app.min.js')); ?>"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo e(URL::to('backend/js/main.js')); ?>"></script>		
        <script src="<?php echo e(URL::to('backend/js/dobPicker.min.js')); ?>"></script>     
        <div id="remote_model" class="modal fade" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content"></div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
        <script src="<?php echo e(URL::to('backend/js/backend_library_one.js')); ?>"></script>
        <script src="<?php echo e(asset('front/js/bootstrap-tagsinput.js')); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/ywqmxeye1bqw640inrzx59t5k336ioq2oad0rc5d4cydjlnt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


        <script type="text/javascript">
            $('.editor').summernote();
             $('.select2').select2();

            $('#detail-container').on('click', 'li a', function(e){
                var table = $(this).data('table');
                $(this).data('table','');
                if(table)
                {
                $('#'+table).DataTable().draw();
                }
            });

            $(document).on('click', 'a[data-toggle="modal"]', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var target_element = $(this).data('target');
                $(target_element).find('.modal-content').html('<div class="modal-body">\
                        <div class="row">\
                        <div class="col-md-12 center">\
                                <i class="fa fa-spinner fa-spin fa-lg blue"></i> <?php echo e(adminTransLang("please_wait_this_will_take_few_moments")); ?>..\
                            </div>\
                        </div>\
                    </div>\
                </div>');
            });

            $('#remote_model').on('hidden.bs.modal', function (e) {
                $(this).removeData();
                $(this).find('.modal-content').empty();
            });
            $('#remote_model').on('show.bs.modal', function (e) {
                // $(this).removeData();
                // $(this).removeData('modal');
                // $(this).empty();
            });
			
			toastr.options.closeButton = true;
			toastr.options.closeMethod = 'fadeOut';
			toastr.options.closeDuration = 1000;
			toastr.options.closeEasing = 'swing';
			toastr.options.positionClass = 'toast-top-right';
            // toastr.options.positionClass = 'toast-top-full-width';
			
        </script>
        <script type="text/javascript">
            function validURL(str) {

            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/; 
            if (pattern.test(str)) { 
                return true; 
            } else  { 
                return false; 
            }

              // regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
              //   if (regexp.test(str))
              //   {
              //     return true;
              //   }
              //   else
              //   {
              //     return false;
              //   }
            }
        </script>
		
		
	   <script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
		
        <?php echo $__env->yieldContent('scripts'); ?>
		
		<style>
.phpdebugbar{
    display: none;
}
</style>

    </body>
</html>
