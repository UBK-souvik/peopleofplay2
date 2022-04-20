<style>
  .paddingTopTwenty{
    padding-top: 20px;
  }
  .paddingBottomTwenty{
    padding-bottom: 20px;
  }

  .custom-file {
    position: relative;
    display: inline-block;
    height: calc(2.25rem + 2px);
    margin-bottom: 0;
    margin: 0 auto;
    width:unset;
  }
  #caption {
    margin: auto;
    display: block;
    width: 100%;
    max-width: 700px;
    text-align: left;
    color: #ccc;
    padding: 10px;
    height: 182px;
  }
  .div-image-upload-gallery-class {
   margin:0;
 }
 .Preloader {
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
}

.modal-open1 {
  overflow: hidden;
}
.modal-open1 .modal {
  overflow-x: hidden;
  overflow-y: auto;
}
.cropper-open-model {
  overflow: hidden;
}
.cropper-open-model {
  overflow-x: hidden;
  overflow-y: auto;
}

</style>
<?php

$user_current_info = get_current_user_info();
$base_url = url('/');
$role_type_id = 0;
$int_type_of_user = 0;
$str_modal_role_type = '';

$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);

$chk_slug_in_current_url = App\Helpers\UtilitiesTwo::chkSlugInCurrentUrl();

$str_user_url = App\Helpers\Utilities::get_user_url($base_url, $user_current_info);

$feeds_ads = App\Helpers\Utilities::get_feeds_ad();

if(!empty($user_current_info->role))
{
 $role_type_id = $user_current_info->role;
}

if(!empty($user_current_info->type_of_user))
{
  $int_type_of_user = $user_current_info->type_of_user;
}

if(!empty($user_current_info->id))
{

 $str_profile_view = $arr_menu_list['profile_user_view'];
 $str_profile_user_edit = $arr_menu_list['profile_user_edit'];
 $str_profile_change_plan = $arr_menu_list['profile_change_plan'];
 $str_profile_change_password = $arr_menu_list['profile_change_password'];
 $str_profile_product_index = $arr_menu_list['profile_product_index'];
 $str_link_user_watch_list = $arr_menu_list['str_link_user_watch_list'];
 $str_profile_all_image_gallery = $arr_menu_list['profile_all_image_gallery'];
 $str_profile_all_video_gallery = $arr_menu_list['profile_all_video_gallery'];
 $str_profile_all_media = $arr_menu_list['profile_all_media'];
 $str_profile_all_award = $arr_menu_list['profile_all_award'];
 $str_profile_event_index = $arr_menu_list['profile_event_index'];
 $str_profile_blog_index = $arr_menu_list['profile_blog_index'];
 $str_profile_brand_index = $arr_menu_list['profile_brand_index'];
 $str_profile_news_index = $arr_menu_list['profile_news_index'];
 $str_profile_user_message = $arr_menu_list['profile_user_message'];
 $str_link_user_logout = $arr_menu_list['str_link_user_logout'];
 $str_modal_role_type = $arr_menu_list['profile_change_plan'];
 $str_profile_brand_index = $arr_menu_list['profile_brand_index'];
 $str_profile_dictionary_index = $arr_menu_list['profile_dictionary_index'];
 $str_profile_classified_index = $arr_menu_list['profile_classified_index'];
} else {
 $str_profile_view = $arr_menu_list['str_login'];
 $str_profile_user_edit = $arr_menu_list['str_login'];
 $str_profile_change_plan = $arr_menu_list['str_login'];
 $str_profile_change_password = $arr_menu_list['str_login'];
 $str_profile_product_index = $arr_menu_list['str_login'];
 $str_profile_all_image_gallery = $arr_menu_list['str_login'];
 $str_profile_all_video_gallery = $arr_menu_list['str_login'];
 $str_profile_all_media = $arr_menu_list['str_login'];
 $str_profile_all_award = $arr_menu_list['str_login'];
 $str_profile_event_index = $arr_menu_list['str_login'];
 $str_profile_blog_index = $arr_menu_list['str_login'];
 $str_profile_news_index = $arr_menu_list['str_login'];
 $str_profile_user_message = $arr_menu_list['profile_user_message'];
 $str_link_user_logout = $arr_menu_list['str_login'];
 $str_modal_role_type = $arr_menu_list['str_login'];
 $str_profile_brand_index = $arr_menu_list['str_login'];
 $str_profile_dictionary_index = $arr_menu_list['str_login'];
 $str_profile_classified_index = $arr_menu_list['str_login'];
}
?>

<!-- if the user has not completed the payment process dont show him this side bar -->
<?php
$rightSidebarShow = 1;
if(Request::segment(1) =='change-plan') {
  $rightSidebarShow = 0;
}

if(Request::segment(1) =='sign-up' || Request::segment(1) =='pub') {
  $rightSidebarShow = 0;
}

$showPostBtn = 1;

$showLock = 0;
if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1) {
 $showLock = 1;
}
?>

<?php if($rightSidebarShow == 1 ): ?>


<div class="col-md-3 col-lg-2 LeftColumnSection">
  <div class="right-column k_sidebar left-colom-sidebar">
    <div class="DashboardProfile" id="sidebartoggle-container">
      <div class="MobileToggleSideBar">
        <?php if(isset($feeds_ad)): ?>
        <?php if(@$feeds_ad[3]->type == 'right_ad' && !empty(@$feeds_ad[3]->image)): ?>
          <div class="OptionalAd OptionalAd1 text-center mb-4">
            <a href="<?php if(!empty($feeds_ad[3]->url)): ?><?php echo e($feeds_ad[3]->url); ?>)<?php else: ?><?php echo e('javascript:void(0)'); ?><?php endif; ?>" target="<?php if(!empty($feeds_ad[3]->url)): ?><?php echo e('_blank'); ?>)<?php endif; ?>">
              <img src="<?php echo e(asset('uploads/images/feeds_ad/'.$feeds_ad[3]->image)); ?>" alt="">
            </a>
          </div>
        <?php endif; ?>
         <?php endif; ?>
      </div>
    </div>


  <!-- <div id="SideBarToggle">
    <div class="one"></div>
    <div class="two"></div>
    <div class="three"></div>
  </div> -->
  <div class="leftsidebartogglewrapper" id="SideBarToggle">
    <button  role="button" class="menu-toggle leftside">
      <span class="icon-bars"></span>
    </button>
  </div>


  <?php
  $showRightSidebarToggle = 1;
  if(Request::segment(1) =='people' || Request::segment(1) =='company' || Request::segment(1) =='product' || Request::segment(1) =='brand' || Request::segment(1) =='pub' || Request::segment(1) =='pop-classified'|| Request::segment(1) =='pop-dictionary'|| Request::segment(1) =='blog_pedia' || Request::segment(1) =='blog' || Request::segment(1) == 'feeds' || Request::segment(1) == 'feed') {
    $showRightSidebarToggle = 0;
  }
  if(Request::segment(1) =='home' || Request::segment(1) =='get-site-search-data')
  {
   $showRightSidebarToggle = 0;
 }
 if(Request::segment(1) =='user' || Request::segment(2) =='message')
 {
   $showRightSidebarToggle = 0;
 }

 if(Request::segment(1) =='plan' || Request::segment(2) =='purchase')
 {
   $showRightSidebarToggle = 0;
 }

 if(Request::segment(1) =='user' && Request::segment(2) =='blog' && (Request::segment(3) =='preview_detail' || Request::segment(3) =='pre_view_detail'))
 {
   $showRightSidebarToggle = 0;
 }
 ?>
 <?php if($showRightSidebarToggle ==1): ?>
 <div class="rightsidebartogglewrapper" id="RightSideBarToggle">
  <button  role="button" class="menu-toggle rightside">
    <span class="icon-bars"></span>
  </button>
</div>
<?php endif; ?>

<!-- Feed Model -->
  <!-- <div class="modal fade PostModel" id="feedModel"  data-backdrop="static" data-keyboard="false">
  </div>
--></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
  $(document).ready(function(){
 // SideBar toggle js
 $('#SideBarToggle').click(function(){
  $(this).toggleClass('on');
  $('#sidebartoggle-container').slideToggle();
});

 $('.leftside').on('click', function() {
  $('.leftsidebartogglewrapper').toggleClass('menu--is-revealed');
});


 $("#SideBarToggle").on('click', function() {
  $("#RightSideBarToggle").toggleClass('active');
});
 $("#RightSideBarToggle").on('click', function() {
  $(".RightColumnSection").toggleClass('active');
  $("#SideBarToggle").toggleClass('active');
});
 $('.rightside').on('click', function() {
  $('.rightsidebartogglewrapper').toggleClass('menu--is-revealed');
});
 // SideBar toggle js

 $(".main_header_menu li.nav-item.dropdown a").click(function(){
  $(this).parent().find('.DropDownMenuMob').slideToggle();
});
});


  function feedFormSubmit(e) {
    $('.postLoading').show();
    var post_type = $('#feedType').val();
    if(post_type == 1 || post_type == 4){
      var crp_img = crop_upload_image(e);
    }else{
      feedFormSubmit_2(e);
    }
  }

  function feedFormSubmit_2(e) {

    $('.postLoading').show();
    $('.btn-style-post').attr('disabled',true);
   var fd = new FormData($(e)[0]);
   var submit_post_val = $('#submit_Post').val();
   fd.append("_token","<?php echo e(csrf_token()); ?>");
   fd.append("submit_post_val",submit_post_val);
   $.ajax({
    url: "<?php echo e(route('front.feeds.save')); ?>",
    data: fd,
    processData: false,
    contentType: false,
    dataType: 'json',
    type: 'POST',
    beforeSend: function()
    {
          // $('#btnfeed').attr('disabled',true);
          // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
        },
        error: function(jqXHR, exception){
          $('.postLoading').hide();
          // $('#btnfeed').attr('disabled',false);
          $('.btn-style-post').attr('disabled',false);
          console.log(jqXHR);
          var msg = formatErrorMessage(jqXHR, exception);
          toastr.error(msg)
          console.log(msg);
          // $('.message_box').html(msg).removeClass('hide');
        },
        success: function (data)
        {
          if(data.success == 0){
              var err = JSON.parse(data.response);
              var er = '';
              $.each(err, function(k, v) {
                  er += v+'<br>';
                  $("[name="+k+"]").parent().addClass('errCount');
                  $("[name="+k+"]").next().html(v);
                  $("[name="+k+"]").next().show();

                  if(k == 'product_id' || k == 'video_url'){
                    $('.error-demo').addClass('errCount');
                    $('.error-demo .errText').show();
                  }
                  // console.log('key - '+k+' - err - '+er);
              });

              // toastr.error(er,'Error');
              $('.postLoading').hide();
              $('.btn-style-post').attr('disabled',false);
          }else{
            $('.postLoading').hide();
            // $('#btnfeed').attr('disabled',false);
            // $('#btnfeed').trigger('reset');
            // $('.btn-style-post').attr('disabled',false);
            // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
            toastr.success(data.message)
            // window.location.replace('<?php echo e(route("front.feeds")); ?>');
            if(data.page == 'home'){
              window.location.replace('<?php echo e(route("front.home")); ?>');
            }else if(data.page == 'news_feeds'){
              window.location.replace('<?php echo e(route("front.feeds_news.news-feeds")); ?>');
            }
          }

        }
      });
 }

function feedtype(view_type) {
  var page_type = $('#page_type').val();
  $('.PreLoader').addClass('pre_loader_show');
  $.ajax({
    url: "<?php echo e(route('front.feeds.feed_type')); ?>",
    type: 'get',
    dataType: 'json',
    data: {view_type:view_type,page_type:page_type},
    success: function(data) {
      $('.PreLoader').hide();
      if(data.status == 1){
        $('#DefaultModal').html(data.view);
        $('#DefaultModal').addClass('popFeedPosts');
        $('#DefaultModal').modal({backdrop: 'static', keyboard: false});
        // $(".Preloader").fadeOut("slow");

        $('li').removeClass('list_active');
        if(view_type == 1){
          $('.viewRed').parent().addClass('list_active');
        }else if(view_type == 2){
          $('.viewOrange').parent().addClass('list_active');
        }else if(view_type == 4){
          $('.viewYellow').parent().addClass('list_active');
        }else if(view_type == 5){
          $('.viewGreen').parent().addClass('list_active');
        }
      }else if(data.status == 0){
        $('#popMemberContinue').html(data.view);
        $('#popMemberContinue').modal('show');
        toastr.warning(data.msg,'Warning');
      }else if(data.status == 2){
        $('.startPostInput').blur();
        $('#popMemberContinue').html(data.view);
        $('#popMemberContinue').modal('show');
      }
    }
  });
}

function changeType(e) {
  var feed_type = $(e).val();
  if(feed_type !=''){
    $('.loadingType').show();
  }

  var r_url = "<?php echo e(url('/new_post_type')); ?>";

  $.ajax({
    url: r_url+"/"+feed_type,
    type: 'get',
    dataType: 'json',
    data: {},
    success: function(data) {
      $('.loadingType').hide();
      $('#DefaultModal').html(data.view);
      $('#DefaultModal .modal-dialog').addClass('modal-lg modal-dialog-centered');
      $('#DefaultModal').modal({backdrop: 'static', keyboard: false});
      $(".Preloader").fadeOut("slow");

    }
  });
}

   // function getFeedImagePreview(e) {
   //  $('.loadingUpload').show();
   // var fd = new FormData($('#feedForm')[0]);
   //   $.ajax({
   //      url: "<?php echo e(route('front.feeds.feed_image_upload')); ?>",
   //      type: 'POST',
   //      processData: false,
   //      contentType: false,
   //      dataType: 'json',
   //      data: fd,
   //       error: function(jqXHR, exception){
   //         $('.loadingUpload').hide();
   //                      $('#btnfeed').attr('disabled',false);

   //                      var msg = formatErrorMessage(jqXHR, exception);
   //                      toastr.error(msg)
   //                      console.log(msg);
   //                  },
   //      success: function(response) {
   //        $('.imageName').val(response.image);
   //        var image_url = "<?php echo e(url('/uploads/images/feed/')); ?>"+'/'+response.image;
   //         $('.galleryperview img').attr('src',image_url);
   //          $('.loadingUpload').hide();
   //       }
   //  });
   // }

   function feedType(e,type) {
    var r_url = "<?php echo e(url('/new_post_type')); ?>";
    $.ajax({
      url: r_url+"/"+type,
      type: 'get',
      dataType: 'json',
      data: {},
      success: function(data) {
        $('#DefaultModal').html(data.view);
        $('body').addClass('modal-open1');
          // $('body').removeClass('modal-open');
          $('#DefaultModal .modal-dialog').addClass('modal-lg modal-dialog-centered');
          $('#DefaultModal').modal({backdrop: 'static', keyboard: false});
          $(".Preloader").fadeOut("slow");

        }
      });
  }

  function productChoise(e) {
   var pid = $(e).val();
   var r_url = "<?php echo e(url('/product-info')); ?>";
   $.ajax({
    url: r_url,
    type: 'post',
    dataType: 'json',
    data: {"_token": "<?php echo e(csrf_token()); ?>",'id':pid},
    success: function(data) {
      $('#productFeedPreview').attr('src',data.image);
      $('#productFeedPreview').css({'display':'inline'});
      $('#productPreviewIcon').hide();
    }
  });
 }

 function closeModelFeedCrooper(e) {
  $('#modalfeedCropNew').modal('hide');
  $('body').removeClass('modal-open');
    // $('body').removeClass('modal-open1');
    $('body').removeClass('cropper-open-model');
  }
</script>
</div>
<?php endif; ?>

