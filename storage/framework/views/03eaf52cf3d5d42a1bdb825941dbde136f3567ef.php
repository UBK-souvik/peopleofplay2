<script src="<?php echo e(asset('front/new/js/jquery-3.5.0.min.js')); ?>"></script>
<script>

var user_subscribe_data_saved_flag = '<?php echo e(Session::has("user_subscribe_data_saved_flag")); ?>';var user_plan_upgrade_data_saved_flag = '<?php echo e(Session::has("user_plan_upgrade_data_saved_flag")); ?>';var user_plan_created_data_saved_flag = '<?php echo e(Session::has("user_plan_created_data_saved_flag")); ?>';if(user_plan_upgrade_data_saved_flag!=""){	user_subscribe_data_saved_flag = '';	user_plan_created_data_saved_flag = '';}if(user_plan_created_data_saved_flag!=""){	user_subscribe_data_saved_flag = '';	user_plan_upgrade_data_saved_flag = '';}
$(document).ready(function(){
	load_images_data(1, 1, 'images-fixed-size');
	load_images_data(2, 2, 'videos-fixed-size');
	load_images_data(3, 1, 'known-for-fixed-size');
	// load_images_data(3, 1, 'home-for-fixed-size');
    
	userSaveSubscribeMessage();	
	// returns width of browser viewport
});

function userSaveSubscribeMessage(){
  
  if(user_subscribe_data_saved_flag!="")
  {
	 toastr.options.closeDuration = 10000; 
	 toastr.success("Please Update your Profile.");
  }    if(user_plan_upgrade_data_saved_flag!="")  {	 toastr.options.closeDuration = 10000; 	 toastr.success("Your Plan has been switched successfully.");  }    if(user_plan_created_data_saved_flag!="")  {	 toastr.options.closeDuration = 10000; 	 toastr.success("Your Account has been created successfully.");  }  
  
}

function load_images_data(int_gallery_link_type, int_gallery_type, str_div_bind_id)
{	 
	
	var  postData;
     postData = {
            "slug": '<?php echo e($slug); ?>',
			"user_id": '<?php echo e($user_id); ?>',
			"page_type": '<?php echo e($page_type); ?>',
			"product_id": '<?php echo e($product_id); ?>',
			"event_id": '<?php echo e($event_id); ?>',
			"brand_list_id": '<?php echo e($brand_list_id); ?>',
			"gallery_link_type": int_gallery_link_type,
			"gallery_type": int_gallery_type,
			"get_current_screen_size":get_current_screen_size,
			_token: ajax_csrf_token_new,
        };

          $.ajax({
                url: base_url_new + '/page/ajax-gallery-video-image-data',
				data: postData,
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                type: 'POST',
                beforeSend: function () {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    //toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
					
					$('#'+str_div_bind_id).html(data);
                    
					$('#'+str_div_bind_id).lightGallery({
						width: '700px',
						height: '470px',
						mode: 'lg-fade',
						addClass: 'fixed-size',
						counter: false,
						download: false,
						startClass: '',
						enableSwipe: false,
						enableDrag: false,
						speed: 500,
						selector: '.item'
					});

                }
            });	
}
</script>