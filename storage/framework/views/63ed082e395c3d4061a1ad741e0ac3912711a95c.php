<?php
$str_create_update_button_new = '';

if(!empty($is_chk_user_blog_create_flag))
{
   $str_create_update_button_new = 'blogSubmit';	
}

if(!empty($is_chk_user_news_create_flag))
{
   $str_create_update_button_new = 'newsSubmit';
}

if(!empty($is_chk_user_media_create_flag))
{
   $str_create_update_button_new = 'mediaSubmit';	
}	


$int_file_size_divisor_new = Config::get('commonconfig.file_size_divisor_new');
$int_file_size_limit_new = Config::get('commonconfig.file_size_limit_new');

?>
<script>

//frontend_show_standard_ckeditor_new('Userdescription');
<?php if(!empty($is_chk_user_blog_news_create_flag)): ?>
	if(CKEDITOR)
	{
		CKEDITOR.replace( 'Userdescription', {
			on: {
				instanceReady: function(evt) {
					document.getElementById('board').style.visibility = 'hidden';
					//document.getElementById('Userdescription').style.display = 'block';
				}
			}
		});
	}
<?php endif; ?>

var int_file_size_divisor_new = <?php echo e($int_file_size_divisor_new); ?>;
var int_file_size_limit_new = <?php echo e($int_file_size_limit_new); ?>;

/* for a mobile version */
$(document).ready(function() {
  $('#resizing_select_mainSearch').change(function(){
    $("#width_tmp_option_main_search").html($('#resizing_select_mainSearch option:selected').text()); 
    $(this).width($("#width_tmp_select_main_search").width());  
	
	document.getElementById("int_search_dd_val_hidden_new").value = $('#resizing_select_mainSearch').val();
	
  });
});
</script>
<script>
/* for a desktop */
$(document).ready(function() {
  $('#resizing_select_mainSearch_Desk').change(function(){
    $("#width_tmp_option_main_search_Desk").html($('#resizing_select_mainSearch_Desk option:selected').text()); 
    $(this).width($("#width_tmp_select_main_search_Desk").width());  
	
	document.getElementById("int_search_dd_val_hidden_new").value = $('#resizing_select_mainSearch_Desk').val();
  });
});
</script>

<script>

function copyToClipboard(element) {
     var $temp = $("<input>");
     $("body").append($temp);
     $temp.val($(element).val()).select();
     document.execCommand("copy");
     $temp.remove();
     toastr.success('Copied to Clipboard Successfully');
   }

$( document ).ready(function() {
        var isshow = '<?php echo e(@$int_flag_is_show); ?>';
        console.log(isshow);
        if (isshow != '1') { 
            <?php 
                Session::put('isshow',1); 
            ?>   
			
			 //$("body").css("visibility","hidden");
            //$("body").css("display","none");
		    
			       delay();	
        }
		else
		{
			//$("body").css("visibility","visible");
            //$("body").css("display","block");
		}
		
		 
    });
	
	function delay() {
		
    var secs = 1000;
  	// Show popup here
      // $('#one_time_popup').show();
  	
      setTimeout('initFadeIn()', secs);
  }

function initFadeIn() {
    //$("body").css("visibility","visible");
    //$("body").css("display","none");
	
	//$("body").fadeIn(1200);
}

/* for loading the advertisements */
	$(document).ready(function(){
		
	  load_ajax_advertisement_images_data('top-bar-ads' , 1, 1,1);	
	  load_ajax_advertisement_images_data('side-bar-ads' , 5, 2);		
		// returns width of browser viewport
	});

$(document).ready(function() {
    $('.close').click(function(){
        $('#one_time_popup').hide();
    });
});

function load_ajax_advertisement_images_data(str_div_id, int_limit, int_position,int_show_header =0)
{

	var  postData;
    postData = {
		    int_limit: int_limit,
		    int_position: int_position,
            _token: ajax_csrf_token_new,
        };

    $.ajax({
        url: base_url_new + '/ads/ajax-get-ads-data',
				data: postData,
				headers: {
         'X-CSRF-TOKEN': ajax_csrf_token_new
        },
        type: 'POST',
        beforeSend: function () {
                
				},
        error: function (jqXHR, exception) {
            var msg = formatErrorMessage(jqXHR, exception);
        },
        success: function (data) {
	           $('#'+str_div_id).html(data);  
	                             
        }
    });	
}
</script>

<script type="text/javascript">
  $(document).on('click', '.delete_account', function(e){
      e.preventDefault();
      var r = confirm("Are you sure you want to delete account");
      if (r == false) {
          return false;
      }
      $('#myModal' ).modal('show');
  });

  // On Form Submit
  $(document).on('click', '.delete_account_button', function (e) {
      e.preventDefault();
      var password = $('#password').val();
      var href = "<?php echo e(url('/delete_account')); ?>?pass="+password;
      if(password != '') {
        $.get( href, function( data ) {
              console.log(data);
              if (data.status == true) {
                toastr.success(data.msg);
                window.location.href = "<?php echo e(url('/')); ?>";
              } else {
                toastr.error(data.msg);
                location.reload();
              }
        });
      } else {
        toastr.error('Please enter password');
      }
  });
</script>

<script type="text/javascript">
  function confirm_click()
  {
    return confirm("Are you sure ?");
  };
</script>

<script type="text/javascript">
  var report_successfully = '<?php echo e(Session::has("report_successfully")); ?>';
  $( document ).ready(function() {
      if(report_successfully!="")
      {
          toastr.success('Your Report has been submitted');
          <?php 
                Session::flash('report_successfully', 0); 
                Session::forget('report_successfully', 0); 
          ?>
      }
  });

function isObject(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == Object;
}


/* for top header search */

$(document).ready(function(){

	get_autocomplete_search_data_new("home-site-search-input-mobile");
	get_autocomplete_search_data_new("home-site-search-input");

});
   
  
function get_autocomplete_search_data_new(input_text_id)  
{   
  

   $("#"+input_text_id).autocomplete({
        source: function( request, response ) {
			
			var  int_search_dd_val_desk_new =  document.getElementById("int_search_dd_val_hidden_new").value;
            var  int_search_dd_val_mobile_new =  document.getElementById("int_search_dd_val_hidden_new").value;
	
		   // Fetch data
		   $.ajax({
			url: base_url_new + '/home/get-ajax-site-search-data',
			type: 'post',
			dataType: "json",
			data: {
			 int_search_dd_val_desk_new:int_search_dd_val_desk_new,
			 int_search_dd_val_mobile_new:int_search_dd_val_mobile_new,
			 search: request.term,
			 token: ajax_csrf_token_new,
			},
			headers: {
			 'X-CSRF-TOKEN': ajax_csrf_token_new
			},
			success: function( data ) {
				// console.log(data);
			 response( data );

			}
		   });
		  },
		minLength: 2
    })
   .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		var item_image = '';
		item_image = item.image;
		var item_id_new = 0;		item_id_new = item.id;
		var item_type = 0;
		item_type = item.type;
		var full_image_upload_path_new = '';

		console.log(item);
		
		if(item_image!="" && item_image!=null)
		{
		    if(item_image.indexOf('_users_')>0)
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + slug_user_prefix_new + '/' + item_image;	
			}
			else if(item_image.indexOf('_products_')>0)
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + slug_product_prefix_new + '/' + item_image;	
			}
			else if(item_image.indexOf('_events_')>0)
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + slug_event_prefix_new + '/' + item_image;	
			}
			else if(item_image.indexOf('_brands_')>0)
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + slug_brand_prefix_new + '/' + item_image;	
			}
            else if(item_image.indexOf('_blogs_')>0)
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + slug_blog_prefix_new + '/' + item_image;	
			}			
            else if(item.slug_prefix == 'feeds' || item.slug_prefix == 'news_feeds')
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + '/feed/' + item_image;	
			}			
			else
			{
			  full_image_upload_path_new = base_url_new + image_upload_path_new + item_image;	
			}	
		}
		else
		{
			if(item_type == 1)
		    {			
		      full_image_upload_path_new = str_get_def_image_new;
            } 
 			else
			{
			  full_image_upload_path_new = str_prod_event_get_def_image_new;	
			}
		}
		
		var item_link_slug_prefix = '';		
		var str_slug_prefix_new = '';		
		var str_slug_prefix = item.slug_prefix;
		
		if(item_type == 1)
		{
			if(str_slug_prefix == 3)
			{
			   str_slug_prefix_new =  '/company';	
			}
			else
			{
			   str_slug_prefix_new =  '/people'; 	
			}
			//str_slug_prefix_new = '';
		}
		else
		{
			str_slug_prefix_new =  '/' + item.slug_prefix;
		}				
		
		if(item_type == 10)		
		{		  
	      var inner_html = '<a href="' + base_url_new + '/home/get-site-search-data?type=product_category&category_id=' + item_id_new + '"><div class="list_item_container"><div class="image">Products in <span class="label text-dark">' + item.name + '</span></div></div></a>';			
		}
		else		
		{
	      var inner_html = '<a href="' + base_url_new + str_slug_prefix_new + '/' + item.slug + '"><div class="list_item_container"><div class="image"><img src="' + full_image_upload_path_new + '"> <span class="label text-dark">' + item.name + '</span></div></div></a>';        
		}
		
		
        return $( "<li class='mt-2'></li>" )
            .data( "item.ui-autocomplete", item )
            .append(inner_html)
            .appendTo( ul );
    }
	
 }	
	
var str_save_role_url_redirect = "/user/profile/edit";
var str_save_role_data_url = "/user/role-profile-data/edit";
var str_save_role_url_delete = "/user/role-profile-data/delete";
var str_delete_role_data_url_ajax = "/user/delete-user-role-data-ajax";
var int_hide_collapse_social_icons_flag = 0;

function openEditGalleryModal(gallery_id){

       var modal_gallery_form = '#ModalGalleryVideoForm'+gallery_id;
	   $(modal_gallery_form).show();
	   $(modal_gallery_form).css('display', 'block');
	   $(modal_gallery_form).modal({ show: true });
	   $('#DefaultModal').modal('hide');
     }

$(document).ready(function(){
	
		 if(document.getElementById('edit-profile-roles-data-div'))
		 {
		   show_user_roles_edit_profile_data();	 
		 }
		 
		 
		$(document).on('submit', '#addRoleModalDiv #addRoleModalDivForm', function (e) {
		
            e.preventDefault();
            var fd = new FormData($('#addRoleModalDiv #addRoleModalDivForm')[0]);
            $.ajax({
                url: base_url_new + str_save_role_data_url,
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                     
       
                beforeSend: function () {
                    $('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', true);
                  
                },
                error: function (jqXHR, exception) {
                    $('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
             
                },
                success: function (data) {
                    $('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);
                 
                    toastr.success(data.message)
                  
					 $("#addRoleModalDiv").modal("hide");
					show_user_roles_edit_profile_data();

                }
            });
        });

		
    });
	
	
	function get_date_format_new(str_date)
		{
		   var now = new Date(str_date); 
		
 
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
			return today;
           			
		}
		
		
	function get_gallery_url_data(int_gallery_link_type)
	{
		    var str_save_gallery_url_create = create_gallery_url_new;
			var str_save_gallery_url_delete = delete_gallery_url_new;
			var str_save_gallery_url_redirect = main_gallery_url_new;
			
		
			
			var arr_url_data = [str_save_gallery_url_create, str_save_gallery_url_delete, str_save_gallery_url_redirect];
			
			return arr_url_data;
	}
				
	
	    function gallerySaveSubmitAjax(int_gallery_id_new) {
			var str_gallery_form
			if(int_gallery_id_new!="")
			  str_gallery_form = '#galleryForm' + int_gallery_id_new;
			else
			  str_gallery_form = '#galleryForm';	
			
            var str_save_gallery_url_create = "";
			var str_save_gallery_url_redirect = "";
            var int_gallery_type =  $(str_gallery_form + ' #gallery_type').val();
			var int_gallery_link_type =  $(str_gallery_form + ' #gallery_link_type').val();
            
			arr_url_data = get_gallery_url_data(int_gallery_link_type);
			
			str_save_gallery_url_create = arr_url_data[0];
            str_save_gallery_url_redirect = arr_url_data[2];
			
			
            var fd = new FormData($('#galleryForm' + int_gallery_id_new)[0]);
			
            $.ajax({
                url: str_save_gallery_url_create,
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
					$('.gallerySubmitButton').attr('disabled', true);
                    $(".gallerySubmitButton .st_loading ").show();
                },
                error: function (jqXHR, exception) {
                    $('.gallerySubmitButton').attr('disabled', false);                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg);
					openEditGalleryModal(int_gallery_id_new);
          			 $(".gallerySubmitButton .st_loading ").hide();
                },
                success: function (data) {
                	 $(".gallerySubmitButton .st_loading ").hide();
					toastr.success("Gallery Saved Successfully.");
					window.location.href = str_save_gallery_url_redirect;

                }
            });
        }
	 
	 function deleteGalleryModal(gallery_id, int_gallery_link_type){
		 
		 var arr_url_data;
	     var str_save_gallery_url_delete;		 
	     arr_url_data = get_gallery_url_data(int_gallery_link_type);			
	     str_save_gallery_url_delete = arr_url_data[1];
		 str_save_gallery_url_redirect = arr_url_data[2];
		 
		 var is_sure = confirm("Are you sure");
		 
		 postData = {
            "gallery_id": gallery_id,
			_token: ajax_csrf_token_new,
        };
		 
		 if(is_sure)
		 {
			 
			 $.ajax({
                url: str_save_gallery_url_delete,
                data: postData,
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                type: 'POST',
                beforeSend: function () {
              
                },
                error: function (jqXHR, exception) {
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg);
                    console.log(msg);
                    
                },
                success: function (data) {
                 
				   window.location.href = str_save_gallery_url_redirect;	
			
                }
            });
			 
			 
		    
		 }
		 
	 }


function readURL(mainDivId, input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
	   
	  //$(mainDivId + ' #div-image-gallery-preview-id').show();
	  //$(mainDivId + ' #div-image-gallery-preview-id').css("display", "block");
       	  
      $( '#'+mainDivId + ' .gallery-upload-preview-class').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

//$("#file-gallery-uploadsecond-new").change(function() {
//  readURL(this);
//});	 

function getImagePreview(mainDivId, this_obj)
{
	readURL(mainDivId, this_obj);
}

function showProdEventDropDownByDest(mainDivId, dest_id)
{
		
	if(dest_id>0)
	{
	  $( '#'+mainDivId + ' .assign-prod-event-drop-down-class').hide(); 	
	  $( '#'+mainDivId + ' #assign-gallery-event-product-div'+dest_id).show();	
	}		
}

function deleteRoleDataModal(role_id){
		 
		 var is_sure = confirm("Are you sure");
		 
		 postData = {
            "role_id": role_id,
        };
		
		if(is_sure)
		{
		 
		 $.ajax({
                url: base_url_new + str_delete_role_data_url_ajax + '/' + role_id,
                data: postData,
                processData: false,
                contentType: false,
                type: 'GET',
                beforeSend: function () {
                    $('#edit-profile-roles-data-div').html("Loading. Please Wait...");
					//$('.productSubmitButton').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    //$('.productSubmitButton').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg);
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    //alert(data);
					//$('.productSubmitButton').attr('disabled', false);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message);
					show_user_roles_edit_profile_data();
                    //$('#productForm').trigger('reset')
                    //window.location.replace('<?php echo e(route("front.user.product.index")); ?>');
			
                }
            });
		
		   //window.location.href = base_url_new + str_save_role_url_delete + '/' + role_id;	 
		 }
}
		
		function show_hide_loading_button_add_update_pages(int_type) 
		{
		  if(int_type == 1)
		  {
			//$('#mediaSubmit').hide();
			$('#mediaSubmit').attr('disabled', true);
		    //$('#btn-loading-new').show();  
		  }			  
		  else
		  {
			  $('#mediaSubmit').attr('disabled', false);
			  //$('#mediaSubmit').show();
			  //$('#btn-loading-new').hide();
		  }
		}				
		
		
		function readBlogNewsURL(input) {
			
			$('#blah').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
			
			FileValidation('featured_image');
        }
		
	 function FileValidation(str_file_name)
	 {
        const fi = document.getElementById(str_file_name);
        // Check if any file is selected.
        if (fi.files.length > 0) {
			
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
				//alert(fi.files.item(i).type);
                const file = Math.round((fsize / int_file_size_divisor_new));
                // The size of the file.
                if (file > int_file_size_limit_new) {					
                    //$('#<?php echo e($str_create_update_button_new); ?>').attr('disabled', true);
					toastr.error("File too Big, please select a file less than or equal to 2mb");
					return false;
                } 
				//else if (file < 2048) { 4096
                //    toastr.error("File too small, please select a file greater than 2mb");
                //} 
				else {
                    //alert('<b>' + file + '</b> KB');
					//$('#<?php echo e($str_create_update_button_new); ?>').attr('disabled', false);
					return true;
                }
            }
        }
		
		return true;
		
    }
		
		
		function getExpandCollapseClass() {
	     
			 if(int_hide_collapse_social_icons_flag ==0)
			 {
			   $( '#btn-expand-collapse-social-media-icons').html('<< Collapse');

			   int_hide_collapse_social_icons_flag = 1;		   
			 }
			 else
			 {
				 $( '#btn-expand-collapse-social-media-icons').html('Expand >>');

			     int_hide_collapse_social_icons_flag = 0;
			 }
         		 		 
		}
		
		function frontend_show_standard_ckeditor_new(texarea_element_id)
		{
		   // CKEDITOR.replace( texarea_element_id );	
		   CKEDITOR.replace(texarea_element_id, {
		      removeButtons: '',
		      // toolbar_Basic: 'Underline'
		    });
		}
		
		function frontend_get_ckeditor_description_new(texarea_element_id)
		{
		   var ckeditor_description_new = CKEDITOR.instances[texarea_element_id].getData();	
		   
		   return ckeditor_description_new;
		}	
  
		function shareWikiToFeed(e,id,type){
			$.ajax({
				url: "<?php echo e(route('front.shareWikiToFeed')); ?>",
				type: 'POST',
				headers: {
				'X-CSRF-TOKEN': ajax_csrf_token_new
				},
				data: {id:id,type:type},
				dataType: "JSON",
				beforeSend: function () {
						
						},
				error: function (jqXHR, exception) {
					var msg = formatErrorMessage(jqXHR, exception);
				},
				success: function (data) {
					if(data.success == 1){
						toastr.success(data.msg,'Success');
					}
				}
			});	
		}

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SDQVFR5VHG"></script>
<script>
	if((window.location.pathname != '/bloom_reports_test')){
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
	  
		gtag('config', 'G-SDQVFR5VHG');
	}
</script>

<script>

	
	// function getOgProperty(e){
	// 	var url = $(e).val();
	// 	$.ajax({
	// 		url: "<?php echo e(route('front.feeds.getOgProperty')); ?>",
	// 		data: {'_token':'<?php echo e(csrf_token()); ?>','url':url},
	// 		dataType: 'json',
	// 		type: 'POST',
	// 		success: function (data) {
	// 			if(data.success == 1){
	// 				$('#Title').val(data.title);
	// 				$('#Caption').text(data.caption);
	// 				$('.viewImagePreview').attr('src',data.image);
	// 				$('.crop_img1').val(data.image);
	// 				$('.image-box .popFeedIcon, .image-box .upload-btn-wrapper').hide();
	// 				$('.file-upload .image-box img').show();
	// 				$('.reset-crop').hide();
	// 			} else {
				
	// 				toastr.error(data.msg);
	// 			}
	// 		}
	// 	});
	// }

</script>


