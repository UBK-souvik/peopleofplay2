 $('#add-edit-user-main-box-body-div  .accordion__header').click(function(e) {
  e.preventDefault();
  var currentIsActive = $(this).hasClass('is-active');
  $(this).parent('.accordion').find('> *').removeClass('is-active');
  if(currentIsActive != 1) {
    $(this).addClass('is-active');
    $(this).next('.accordion__body').addClass('is-active');
  }
});

var k = 1;

 function readProfileURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-blah-image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		function readBannerURL(input) {
			
			$('#advertisement-blah-image').show();
			
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#advertisement-blah-image')
                        .attr('src', e.target.result);	

                     var image = new Image();
					image.src = e.target.result;

					image.onload = function() {
						// access image size here 
						var str_banner_img_width = this.width;
						var str_banner_img_height = this.height;
						$('#banner_width_hidden').val(str_banner_img_width);
						$('#banner_height_hidden').val(str_banner_img_height);

					};
						
                };

                reader.readAsDataURL(input.files[0]);
												
            }
        }
		
		
		$(document).on('click','#user-roles-div-main-id .add-link',function(e) {
                e.preventDefault();
				
				var str_html_roleDivId = $('#roleDivId').html();				
				str_new_div_content = '<div class="row add-row" id="roleDivId_add_row'+k+'">'  + str_html_roleDivId + '</div>';  
				
				$("#user-roles-div-main-id .user_role").append(str_new_div_content);
				
	        k++;			
        })

        $(document).on('click','#user-roles-div-main-id .remove-link',function(e) {
            e.preventDefault();
			
			var confirm_chk = confirm("Are you sure?");			
			var main_div_id = $(this).parent().parent().parent();
			div_main_div_id =  main_div_id.attr('id');
			
			if(confirm_chk == true && div_main_div_id!="roleDivId")
			{			
				//var rowSample = $(this)
					//.closest('#user-roles-div-main-id .user_role')
					//.remove()					
					$(this).parent().parent().parent().remove();					
			      //$("#user-roles-div-main-id").closest('#user-roles-div-main-id .user_role').remove();  
		
			}	
        })
		
		function admin_show_standard_ckeditor_new(texarea_element_id)
		{
		   // CKEDITOR.replace( texarea_element_id );	
		   CKEDITOR.replace(texarea_element_id, {
		      removeButtons: '',
		      // toolbar_Basic: 'Underline'
		    });
		}
		
		function admin_get_ckeditor_description_new(texarea_element_id)
		{
		   var ckeditor_description_new = CKEDITOR.instances[texarea_element_id].getData();	
		   
		   return ckeditor_description_new;
		}
		
		