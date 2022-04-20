<?php
  $current_url_new = URL::current();
  
  $arr_objs = array();
  
  $str_user_name = @App\Helpers\Utilities::get_user_name_title_new($current_url_new, $arr_objs);
  
  $int_flag_is_show =  Session::has("isshow");
  
  $str_recaptcha_site_key =	Config::get("commonconfig.recaptcha_site_key");

?>  
<!DOCTYPE html>
<html>

<head>
    <title><?php if(!empty($str_user_name)): ?><?php echo e(@$str_user_name); ?> <?php else: ?> <?php echo $__env->yieldContent('title'); ?> <?php endif; ?></title>
    <meta charset="utf-8">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/HomePagestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/Homestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/membership.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/productpagestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/productscss.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/registrationstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveaddevents.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveevents.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveheaderpart.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveHomepage.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsivelogin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveProductHomepage.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsiveregistration.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/responsivestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/styleedit.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/stylemessage.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/eventstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/editresponsivestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/addeventstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/addproductsresponsivestyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/addawardstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/productpagestyle.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/bootstrap.min')); ?>.css">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/font-awesome')); ?>.min.css">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/intl-tel-input/css/intlTelInput.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/intl-tel-input/css/intlTelInput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/custom-jquery-ui.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/style_two.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/style_three.css')); ?>">

    <!--NEW CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('front/new_css/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new_css/auth.css')); ?>">
    <!--NEW CSS-->
    <link rel="shortcut icon" href="<?php echo e(asset('front/images/mainLogo.png')); ?>" />
	<?php echo $__env->make('front.includes.include_common_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
    <?php echo $__env->yieldContent('styles'); ?>
</head>



<body>
    <?php echo $__env->make('front.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('front.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="<?php echo e(asset('front/new/js/jquery-3.3.1.slim.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front/new/js/jquery-3.5.0.min.js')); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!--<script src="<?php echo e(asset('front/js/jquery-migrate-3.0.0.min.js')); ?>"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
    <script src="<?php echo e(asset('front/new/js/bootstrap.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?php echo e(asset('backend/plugins/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/intl-tel-input/js/intlTelInput.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/main.js')); ?>"></script>
    <?php echo NoCaptcha::renderJs(); ?>

	<script language="javascript">
	
	/*document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});

	
	
	function mousehandler(e) {
        var myevent = (isNS) ? e : event;
        var eventbutton = (isNS) ? myevent.which : myevent.button;
        if ((eventbutton == 2) || (eventbutton == 3)) return false;
    }
    document.oncontextmenu = mischandler;
    document.onmousedown = mousehandler;
    document.onmouseup = mousehandler;
    function disableCtrlKeyCombination(e) {
        var forbiddenKeys = new Array("a", "s", "c", "x","u");
        var key;
        var isCtrl;
        if (window.event) {
            key = window.event.keyCode;
            //IE
            if (window.event.ctrlKey)
                isCtrl = true;
            else
                isCtrl = false;
        }
        else {
            key = e.which;
            //firefox
            if (e.ctrlKey)
                isCtrl = true;
            else
                isCtrl = false;
        }
        if (isCtrl) {
            for (i = 0; i < forbiddenKeys.length; i++) {
                //case-insensitive comparation
                if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
                    return false;
                }
            }
        }
        return true;
    }
	
	
  document.onmousedown = disableclick;
  var str_status_new = "Right Click Disabled";
  function disableclick(e)
  {
    if(event.button == 2)
    {
      alert(str_status_new);
      return false; 
    }
  }*/
</script>
<?php echo $__env->make('front.includes.include_js_common_file', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script>
        $('.select2').select2();
		
		toasterOptions();
		
        /*toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 1000;
        toastr.options.closeEasing = 'swing';
		toastr.options.positionClass = 'toast-top-full-width';
		
		toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
        toastr.options.preventDuplicates = true;		
		toastr.options.progressBar = true;*/
		
    </script>
	
	<?php echo $__env->make('front.includes.include_global_js_variables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!--<script src="<?php echo e(asset('front/js/jquery-ui/jquery-ui.min.js')); ?>"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
	<script src="<?php echo e(asset('front/js/jquery-ui/custom-jquery-ui-autocomplete.js')); ?>"></script>
	
	<?php if(strpos($current_url_new,'/contact-us')>0 || strpos($current_url_new,'/forgot-password')>0): ?>
	<script defer type="text/javascript">
	 var str_recaptcha_site_key = '<?php echo e($str_recaptcha_site_key); ?>';
	</script>	
	<script defer src="https://www.google.com/recaptcha/api.js?render='<?php echo e($str_recaptcha_site_key); ?>'"></script>
	<?php endif; ?>
	<script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
    <script type="text/javascript">     
    </script>
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6197431d6885f60a50bc8601/1fkrdsbsu';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>