
<?php
$current_url_new = URL::full();
$str_user_name = '';
$is_chk_blog_news_flag = 0;
$is_chk_plan_flag = 0;
$is_chk_plan_purch_flag = 0;
$is_chk_user_blog_news_flag = 0;
$str_base_url = url('/');
$is_chk_pop_dictionary_flag = 0;
$is_chk_pop_classified_flag = 0;
$is_chk_edit_update_create_flag = 0;
$is_chk_user_profile_page_flag = 0;
$is_chk_user_blog_news_create_flag = 0;
$is_chk_user_blog_create_flag = 0;
$is_chk_user_news_create_flag = 0;
$is_chk_user_media_create_flag = 0;
$is_chk_user_register_page_flag = 0;
$myRequest = new \Illuminate\Http\Request();
$str_recaptcha_site_key = Config::get("commonapi.recaptcha_site_key");
$is_chk_blog_news_flag =  @App\Helpers\UtilitiesFour::is_chk_blog_news_flag($current_url_new);
$is_chk_user_blog_news_flag =  @App\Helpers\UtilitiesFour::is_chk_user_blog_news_flag($current_url_new);
$is_chk_edit_update_create_flag =  @App\Helpers\UtilitiesFour::is_chk_edit_update_create_flag($current_url_new);
$is_chk_edit_profile_update_create_flag =  @App\Helpers\UtilitiesFour::is_chk_edit_profile_update_create_flag($current_url_new);
$is_chk_user_register_page_flag =  @App\Helpers\UtilitiesFour::is_chk_user_register_page_flag($current_url_new);
$is_chk_user_blog_news_create_flag =  @App\Helpers\UtilitiesFour::is_chk_user_blog_news_create_flag($current_url_new);
$is_chk_user_blog_create_flag =  @App\Helpers\UtilitiesFour::is_chk_user_blog_create_flag($current_url_new);
$is_chk_user_news_create_flag =  @App\Helpers\UtilitiesFour::is_chk_user_news_create_flag($current_url_new);
$is_chk_user_media_create_flag =  @App\Helpers\UtilitiesFour::is_chk_user_media_create_flag($current_url_new);
$is_chk_tag_create_flag =  @App\Helpers\UtilitiesFour::is_chk_tag_create_flag($current_url_new);
$is_chk_pop_dictionary_flag =  @App\Helpers\UtilitiesFour::is_chk_pop_dictionary_flag($current_url_new);
$is_chk_pop_classified_flag =  @App\Helpers\UtilitiesFour::is_chk_pop_classified_flag($current_url_new);
$is_chk_plan_flag =  @App\Helpers\UtilitiesFour::is_chk_plan_flag($current_url_new);
$is_chk_change_plan_flag =  @App\Helpers\UtilitiesFour::is_chk_change_plan_flag($current_url_new);
$is_chk_plan_create_flag =  @App\Helpers\UtilitiesFour::is_chk_plan_create_flag($current_url_new);
$is_chk_plan_purch_flag =  @App\Helpers\UtilitiesFour::is_chk_plan_purch_flag($current_url_new);
$is_product_page_flag =  @App\Helpers\UtilitiesFour::is_product_page_flag($myRequest, $current_url_new);
$is_event_page_flag =  @App\Helpers\UtilitiesFour::is_event_page_flag($myRequest, $current_url_new);
$is_profile_page_flag =  @App\Helpers\UtilitiesFour::is_profile_page_flag($myRequest, $current_url_new);
$is_gallery_page_flag =  @App\Helpers\UtilitiesFour::is_gallery_page_flag($myRequest, $current_url_new);
$arr_objs = array(@$user, @$product, @$event);
$str_user_name = @App\Helpers\Utilities::get_user_name_title_new($current_url_new, $arr_objs);
$int_flag_is_show =  Session::has("isshow");
// check if the user has completed payment or not
use App\Http\Controllers\Front\AuthenticationController;
use App\Http\Controllers\Front\HomeAjaxController;
$str_checkPaidUserAuthentication =  AuthenticationController::checkPaidUserAuthentication(1);
$str_checkPaidUserAuthentication_two =  AuthenticationController::checkPaidUserAuthentication(0);
$str_get_seo_data =  HomeAjaxController::getSeoData();
$str_og_image_new =  @App\Helpers\UtilitiesFour::get_og_image_new($current_url_new, @$blog, @$user,@$question_detail,$arr_objs);
$str_og_title_new =  @App\Helpers\UtilitiesFour::get_og_title_new($current_url_new, @$str_get_seo_data, @$dictionary_detail, @$blog, @$str_user_name,@$question_detail,@$classified);
$str_og_desc =  @App\Helpers\UtilitiesFour::get_og_desc($current_url_new, @$str_get_seo_data, @$dictionary_detail, @$blog, @$str_user_name,@$classified);
$str_meta_desc =  @App\Helpers\UtilitiesFour::get_meta_desc($current_url_new, @$str_get_seo_data, @$dictionary_detail, @$blog, @$str_user_name,@$classified);
$str_meta_keyword =  @App\Helpers\UtilitiesFour::get_meta_keyword($current_url_new, @$str_get_seo_data, @$dictionary_detail, @$blog, @$str_user_name);
$str_page_title =  @App\Helpers\UtilitiesFour::get_page_title($current_url_new, @$str_get_seo_data, @$dictionary_detail, @$blog, @$str_user_name,@$classified);
$is_home_page_url = $myRequest->is('/');
?>
<!DOCTYPE html>
<html>
   <head>
      <title><?php echo e($str_page_title); ?></title>
      <meta charset="utf-8">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <meta name="description" content="<?php echo e(@$str_meta_desc); ?>">
      <meta name="keywords" content="<?php echo e(@$str_meta_keyword); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Google / Search Engine Tags -->
      <meta itemprop="name" content="PeopleOfPlay">
      <meta itemprop="description" content="<?php echo e(@$str_meta_desc); ?>">
      
      <!-- Google / Search Engine Tags -->

      <!-- Facebook Meta Tags -->
      <meta property="og:site_name" content="PeopleOfPlay" />
      <meta property="og:url" content="<?php echo e(@$current_url_new); ?>">
      <meta property="og:type" content="website">
      <meta property="og:title" content="<?php echo e(@$str_og_title_new); ?>">
      <meta property="og:description" content="<?php echo e(@$str_og_desc); ?>">
      <meta property="og:image" content="<?php echo e(asset(@$str_og_image_new)); ?>">
      <meta property="og:image:width" content="500" />
      <meta property="og:image:height" content="260" />
      <!-- Facebook Meta Tags -->

      <!-- Twitter Meta Tags -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="<?php echo e(@$str_og_title_new); ?>">
      <meta property="twitter:description" content="<?php echo e(@$str_og_desc); ?>">
      
      <!-- Twitter Meta Tags -->

      <link rel="shortcut icon" href="<?php echo e(asset('front/images/mainLogo.png')); ?>" />
      
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

      
      <?php if(!empty($is_home_page_url)): ?>
      <!-- <link rel="stylesheet" href="<?php echo e(asset('front/new/css/HomePagestyle.css')); ?>">
         <link rel="stylesheet" href="<?php echo e(asset('front/new/css/Homestyle.css')); ?>"> -->
      <?php endif; ?>
      
      <?php if(!empty($is_product_page_flag)): ?>
      <?php endif; ?>
      
      <?php if(!empty($is_event_page_flag)): ?>
      <?php endif; ?>
      
      <?php if(!empty($is_profile_page_flag)): ?>
      <?php endif; ?>

      <link rel="stylesheet" href="<?php echo e(asset('front/new/css/bootstrap.min')); ?>.css">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
         integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
      
      <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">
      
      
      <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/intl-tel-input/css/intlTelInput.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/css/src/jquery.tagsinput-revisited.css')); ?>">
      
      
      <link rel="stylesheet" href="<?php echo e(asset('front/new/css/klightgallery.css')); ?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.1/css/lightgallery.min.css">
      <!-- <link rel="stylesheet" href="<?php echo e(asset('front/css/lightgallery/lightgallery_two.css')); ?>">   -->
      
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
      
      <link rel="stylesheet" href="<?php echo e(asset('front/new/css/bootstrap-tagsinput.css')); ?>">
      
      <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/jquery-ui.min.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/css/jquery-ui/custom-jquery-ui.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new/css/flatIcon/dashboardIcon/font/flaticon.css')); ?>">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      <!----NEW AND HOME CSS----->
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/common.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pagestyle.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/advance-search.css?'.time())); ?>">
      <!----NEW AND HOME CSS----->
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/homepage.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pop-dictionary.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pop-columnists.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pop-classifieds.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/blog.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/faq.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/change-plan.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/manage-payment.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/profile.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/watch-list.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/message.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/posts.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/feed.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/quiz.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/feeds.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/paymentpage.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/advertisement.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/chat.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pop_feed.css?'.time())); ?>">

      <link rel="stylesheet" href="<?php echo e(asset('front/cropperjs-main/cropper.css?'.time())); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('front/js/daterangepicker/daterangepicker.css?.time()')); ?>">

      <?php if(!empty($is_chk_user_blog_create_flag)): ?>
         <?php echo $__env->make('includes.include_quill_js_files', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>

      <?php echo $__env->make('includes.php_debug_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('front.includes.include_common_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <?php echo $__env->yieldContent('styles'); ?>
      <?php echo $__env->yieldContent('style_new'); ?>
   </head>

   <body>
      <div class="PreLoader">
         <div class="d-table h-100 w-100">
            <div class="d-table-cell align-middle">
               <i class="fa fa-spin st_loader st_page_loading"></i>
            </div>
         </div>
      </div>
      <?php echo $__env->make('front.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="container-width px-lg-4">
                  <div class="row">
                     <?php echo $__env->yieldContent('content'); ?>
                     
                     <?php if(Request::is('/') || Request::is('pub') || Request::is('sales*')): ?>
                     <!-- // The condition you require -->
                     
                     <?php else: ?>
                     <?php if(($is_chk_blog_news_flag<=0 && $is_chk_plan_flag<=0 && $is_chk_pop_dictionary_flag<=0 && $is_chk_pop_classified_flag<=0) || $is_chk_user_blog_news_flag>0): ?>
                     <?php if(Auth::guard('users')->check()): ?>
                     <?php else: ?>
                     <?php echo $__env->make('front.includes.pages-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     <?php endif; ?>
                     <?php endif; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>

       <!-- ****** || Default Modal || ****** -->
      <div class="modal fade" id="DefaultModal" tabindex="-1" role="dialog" aria-labelledby="DefaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
         </div>
      </div>
       <!-- ****** || Default Modal || ****** -->

      <!-- ****** || Default Modal || ****** -->
      <div class="popFeedsModal">
         <div class="modal fade popMemberContinueTwo" id="popMemberContinue" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content text-center">

               </div>
            </div>
         </div>
      </div>
      <!-- ****** || Default Modal || ****** -->

      </main>
      <!-- ****** || Include Footer || ****** -->
      <?php echo $__env->make('front.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- ****** || Include Footer || ****** -->
      <script src="<?php echo e(asset('front/new/js/jquery-3.5.0.min.js?.time()')); ?>"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
      <script src="<?php echo e(asset('front/js/daterangepicker/daterangepicker.js?.time()')); ?>"></script>


      <?php echo $__env->yieldContent('feeds_scripts'); ?>

      
      <script src="<?php echo e(URL::to('backend/js/dobPicker.min.js')); ?>"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
         integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
      <script src="<?php echo e(asset('front/new/js/bootstrap.min.js?'.time())); ?>"></script>
      <script src="<?php echo e(asset('front/cropperjs-main/cropper.js?'.time())); ?>"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      
      <script src="<?php echo e(asset('backend/plugins/select2/select2.full.min.js?'.time())); ?>"></script>
      
      
      <script src="<?php echo e(asset('backend/plugins/intl-tel-input/js/intlTelInput.js?'.time())); ?>"></script>
      <script src="<?php echo e(asset('front/js/src/jquery.tagsinput-revisited.js?'.time())); ?>"></script>
      
      
      <script src="<?php echo e(asset('backend/js/main.js?.time()')); ?>"></script>
      
      <script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
      
      <?php echo $__env->make('front.includes.include_js_common_file', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <script>
         
               $('.select2').select2();
               


             toasterOptions();



              <!-- for a user who has not completed his payment process -->
              <?php if(!empty($str_checkPaidUserAuthentication)): ?>
               window.location.href= '<?php echo e($str_checkPaidUserAuthentication); ?>';
              <?php endif; ?>

      </script>
      <?php echo $__env->make('front.includes.include_global_js_variables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- <script src="<?php echo e(asset('front/js/typeahead.js')); ?>"></script> -->
      <script src="<?php echo e(asset('front/js/OwlCarousel2-2.3.4/owl.carousel.js')); ?>"></script>
        
      
      <script src="<?php echo e(asset('front/js/lightgallery/picturefill.min.js')); ?>"></script>
      <script src="<?php echo e(asset('front/js/lightgallery/jquery.mousewheel.min.js')); ?>"></script>
      <script src="<?php echo e(asset('front/js/lightgallery/lightgallery-all.min.js')); ?>"></script>
      <script src="<?php echo e(asset('front/js/lightgallery/lightgallery_one.js')); ?>"></script>
      
      
      <script src="<?php echo e(asset('front/js/bootstrap-tagsinput.js')); ?>"></script>
      
      <!-- <script src="<?php echo e(asset('front/js/jquery-ui/jquery-ui.min.js')); ?>"></script>-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
         
             
         <?php if(empty($is_chk_user_blog_create_flag)): ?>
         <script src="<?php echo e(URL::to('backend/plugins/ckeditor/ckeditor.js')); ?>">
      </script>
      <?php endif; ?>
      <?php if(strpos($current_url_new,'/contact-us')>0): ?>
      <script defer type="text/javascript">
         var str_recaptcha_site_key = '<?php echo e($str_recaptcha_site_key); ?>';
      </script>
      <script defer src="https://www.google.com/recaptcha/api.js?render='<?php echo e($str_recaptcha_site_key); ?>'"></script>
      <?php endif; ?>

      <script type="text/javascript">

   $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 999999999999 + (10 * $('.modal:visible').length);
        //$(this).css('z-index', zIndex);
        $(this).css('overflow', "scroll");
        /* setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0); */
    });



         function validURL(str) {

             var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
             if (regexp.test(str))
             {
               return true;
             }
             else
             {
               return false;
             }
         }

         function memeModel(e,id) {
       var r_url = "<?php echo e(url('/pages/meme')); ?>";
        $.ajax({
          url: r_url,
          type: 'post',
          dataType: 'json',
          data: {"_token": "<?php echo e(csrf_token()); ?>",'id':id},
          success: function(data) {
            $('#DefaultModal').html(data.view);
            $('#DefaultModal').modal('show');
           }
      });
}
      </script>

      <?php echo $__env->yieldContent('scripts'); ?>



<script>

   $('#daterangepicker').daterangepicker({
      "autoUpdateInput": true,
      "showDropdowns": true,
      singleDatePicker: true,
      maxDate: new Date(),
      locale: {
         format: 'MM/DD/YYYY',
         cancelLabel: 'Clear'
      },
   });


$(window).scroll(function() {
    var sticky = $('.MobileHeader'),
        scroll = $(window).scrollTop();

    if (scroll >= 50) {
        sticky.addClass('position-sticky');
    } else {
        sticky.removeClass('position-sticky');
    }
});

// $(window).on("load", function() {
//    setTimeout(function(){
//       $('.PreLoader').hide();
//       $('.PreLoader').removeClass('pre_loader_show');
//    },500);
// });

</script>
<!--End of Tawk.to Script-->
   </body>
</html>
