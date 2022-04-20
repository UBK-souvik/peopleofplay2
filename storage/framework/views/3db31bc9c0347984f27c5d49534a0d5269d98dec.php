<?php
  
  $int_at_id = 0; 
  
  /*if(!empty($user_current_info->at))
  {
	 $int_at_id = $user_current_info->at;  
  } */ 
?>
<script type="text/javascript">


var admin_str_save_role_data_url = "/admin/user/profile/admin-role-profile-data/edit";

var str_delete_role_data_url_ajax = "/admin/user/admin-delete-user-role-data-ajax";

var admin_str_get_role_data_url_ajax = "/admin/user/profile/admin-get-user-role-data-ajax/<?php echo e($user_id); ?>/<?php echo e($str_random_time_stamp_new); ?>/<?php echo e($int_role_type_id_data_new); ?>";

$(document).ready(function(){
	
	    admin_show_user_roles_edit_profile_data();						if(document.getElementById('product_brand_hidden_id'))		{		   admin_get_company_people_list('Brand', '<?php echo e(route("admin.user.role.search.brand_list")); ?>', 'product_brand_hidden_id', 'divProductMainDivIdAdminNew');			}				if(document.getElementById('product_company_hidden_id'))		{		   admin_get_company_people_list('Company', '<?php echo e(route("admin.user.role.search.company")); ?>', 'product_company_hidden_id', 'divProductMainDivIdAdminNew');			}
		
		if(document.getElementById('admin_add_edit_profile_role_name_company_id'))
		{
		   admin_get_company_people_list('admin_add_edit_profile_role_name_company_id', '<?php echo e(route("admin.user.role.search.company")); ?>', 'admin_add_edit_profile_role_company_hidden_id', 'adminAddRoleModalDivForm');	
		}
		
		if(document.getElementById('admin_add_edit_profile_role_name_people_id'))
		{
		   admin_get_company_people_list('admin_add_edit_profile_role_name_people_id', '<?php echo e(route("admin.user.role.search.people")); ?>', 'admin_add_edit_profile_role_people_hidden_id', 'adminAddRoleModalDivForm');	
		}
		
		if(document.getElementById('admin_add_edit_profile_role_name_product_id'))
		{
		  admin_get_company_people_list('admin_add_edit_profile_role_name_product_id', '<?php echo e(route("admin.user.role.search.product")); ?>', 'admin_add_edit_profile_role_product_hidden_id', 'adminAddRoleModalDivForm');
		}
		
		if(document.getElementById('collab_user_name'))
		{
		  admin_get_company_people_list('collab_user_name', '<?php echo e(route("admin.user.role.search.people")); ?>', 'collab_user_id_hidden', 'AddEditCollabModalForm');
		}
		
		if(document.getElementById('collab_user_name'))
		{
		  admin_get_company_people_list('collab_user_name', '<?php echo e(route("admin.user.role.search.people")); ?>', 'collab_user_id_hidden', 'AddEditCollabModalForm');
		}
		
		$(document).on('click','.admin-show-add-role-modal-popup',function(e) {
            e.preventDefault();
			
			adminShowRolePopup();
    		
			$('#adminAddRoleModalDivForm').closest('form').get(0).reset();
			
			$('#adminAddRoleModalDiv  #admin-span-role-team-id-new').html('Add');
			
			$('#adminAddRoleModalDivForm  #admin_add_edit_profile_role_data').val('');			
			$('#adminAddRoleModalDivForm  #admin_add_edit_profile_role_name').val('');	
             
			<?php if(@$int_role_type_id_data_new == 2): ?> 
			  $('#adminAddRoleModalDivForm #admin_add_edit_profile_role_at').val('');
			<?php endif; ?>
			
			$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_hidden_id').val(0);
			//$('#adminAddRoleModalDivForm  #admin_add_edit_profile_role_description').val('');
			
			$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_product_hidden_id').val(0);
			$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_company_hidden_id').val(0);
			$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_people_hidden_id').val(0);

            adminShowProductCompany(0);			
			
            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_from_day option[value="0"]').attr('selected','selected');
            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_from_month option[value="0"]').attr('selected','selected');
            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_from_year option[value="0"]').attr('selected','selected');

            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_to_day option[value="0"]').attr('selected','selected');
            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_to_month option[value="0"]').attr('selected','selected');
            //$('#adminAddRoleModalDivForm #admin_add_edit_profile_role_to_year option[value="0"]').attr('selected','selected');		
			
		});	
		
		$(document).on('click','#admin-edit-profile-roles-data-div  .admin-edit-role-popup-class',function(e) {
            e.preventDefault();
			
			adminShowRolePopup();
			
			$('#adminAddRoleModalDiv  #admin-span-role-team-id-new').html('Edit');  
            
			var int_role_people_data = $(this).data("people-id");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_people_hidden_id').val(int_role_people_data);
			
			var int_role_company_data = $(this).data("company-id");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_company_hidden_id').val(str_role_company_data);
			
			var int_role_product_data = $(this).data("product-id");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_product_hidden_id').val(int_role_product_data);
			
			var str_role_name = $(this).data("role-name");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_name').val(str_role_name);
			
			var str_role_people_data = $(this).data("people-name");
			
			if(str_role_people_data == "" || str_role_people_data == undefined)
			{
				str_role_people_data = str_role_name;
			}
			
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_name_people_id').val(str_role_people_data);
			
			var str_role_company_data = $(this).data("company-name");
			
			if(str_role_company_data == "" || str_role_company_data == undefined)
			{
				str_role_company_data = str_role_name;
			}
			
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_name_company_id').val(str_role_company_data);
			
			var str_role_product_data = $(this).data("product-name");
			
			if(str_role_product_data == "" || str_role_product_data == undefined)
			{
				str_role_product_data = str_role_name;
			}
			
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_name_product_id').val(str_role_product_data);
						
			var str_role_data = $(this).data("role-data");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_data').val(str_role_data);			
			
			
			var int_role_at = $(this).data("role-at-id");
			$('#adminAddRoleModalDiv #admin_add_edit_profile_role_at').val(int_role_at);
			
			adminShowProductCompany(int_role_at);
			
			var int_role_auto_id = $(this).data("role-auto-id");
			$('#adminAddRoleModalDiv #admin_add_edit_profile_role_hidden_id').val(int_role_auto_id);
			
			var str_role_description = $(this).data("role-description");
			$('#adminAddRoleModalDiv  #admin_add_edit_profile_role_description').val(str_role_description);			
			
			var int_from_day_str = $(this).data("from_day_str");
			var int_from_month_str = $(this).data("from_month_str");
			var int_from_year_str = $(this).data("from_year_str");
			
			var int_to_day_str = $(this).data("to_day_str");
			var int_to_month_str = $(this).data("to_month_str");
			var int_to_year_str = $(this).data("to_year_str");

            //$('#admin_add_edit_profile_role_from_day option[value='+ int_from_day_str +']').attr('selected','selected');
            //$('#admin_add_edit_profile_role_from_month option[value='+ int_from_month_str +']').attr('selected','selected');
            //$('#admin_add_edit_profile_role_from_year option[value='+ int_from_year_str +']').attr('selected','selected');

            //$('#admin_add_edit_profile_role_to_day option[value='+ int_to_day_str +']').attr('selected','selected');
            //$('#admin_add_edit_profile_role_to_month option[value='+ int_to_month_str +']').attr('selected','selected');
            //$('#admin_add_edit_profile_role_to_year option[value='+ int_to_year_str +']').attr('selected','selected');		

        });
		
		
		
		
		$(document).on('click', '#adminAddRoleModalDiv .adminAddUpdateRoleBtn', function (e) {
            e.preventDefault();
            var fd = new FormData($('#adminAddRoleModalDivForm')[0]);
            $.ajax({
                url: baseUrl + admin_str_save_role_data_url,
				headers: {
				 'X-CSRF-TOKEN': ajax_csrf_token_new
				},
				data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#adminAddRoleModalDiv .adminAddUpdateRoleBtn').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#adminAddRoleModalDiv .adminAddUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#adminAddRoleModalDiv .adminAddUpdateRoleBtn').attr('disabled', false);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message)
                    // window.location.replace('<?php echo e(route("admin.users.index")); ?>');
                    // window.location.replace('<?php echo e(route("front.login")); ?>');
					//window.location.href = base_url_new + str_save_role_url_redirect;
					 $("#adminAddRoleModalDiv").modal("hide");
					admin_show_user_roles_edit_profile_data();

                }
            });
        });
		
		
    });

			
	function admin_get_company_people_list(div_id_new, url_new, hidden_field_id, form_id_new)
	{	
	
	     $('#'+div_id_new).autocomplete({
        source: function( request, response ) {
		   // Fetch data
		   $.ajax({
			url: url_new,
			type: 'post',
			dataType: "json",
			data: {
			 searchTerm: request.term,
			 token: ajax_csrf_token_new,
			},
			headers: {
			 'X-CSRF-TOKEN': ajax_csrf_token_new
			},
			success: function( data ) {
			 response( data );
			 if(data.length == 0)
			 {
			    $('#'+hidden_field_id).val(0);	 
			 }
			 
			}
		   });
		  },
		minLength: 1,
		delay: 300,
		appendTo: $('#'+form_id_new),
		select: function( event, ui ) {
		event.preventDefault();
        //console.log( "Selected: " + ui.id + " aka " + ui.text );
		var val_company_hidden_id = ui.item.id;
		$('#'+hidden_field_id).val(val_company_hidden_id);
		$('#'+div_id_new).val(ui.item.text);
		
      },
    focus: function(event, ui) {
		event.preventDefault();
        $('#'+div_id_new).val(ui.item.text);
    }
		
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		
		var item_text = '';
		item_text = item.text;
		
	    var inner_html = item_text;
		return $( "<li></li>" )
            .data( "item.ui-autocomplete", item )
			.append("<a>" + item_text + "</a>")
            .appendTo( ul );
    }
	
}
	 
	 
	 function admin_show_user_roles_edit_profile_data() {
            
			$.ajax({
                url: baseUrl + admin_str_get_role_data_url_ajax,
                processData: false,
                contentType: false,
                type: 'GET',
                beforeSend: function () {
					$('#admin-edit-profile-roles-data-div').html('Loading. Please Wait.......');
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
					$('#admin-edit-profile-roles-data-div').html(data);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    // window.location.replace('<?php echo e(route("admin.users.index")); ?>');
                    // window.location.replace('<?php echo e(route("front.login")); ?>');
					//window.location.href = base_url_new + str_save_role_url_redirect;

                }
            });
        }
	 
	 function adminShowProductCompany(type_val)
	 {
		 if(type_val == 2)
		 {
			 $('#admin-div-company-list').show();
			 $('#admin-div-product-list').hide();
		 }
		 else if(type_val == 1)
		 {
			 $('#admin-div-product-list').show();
			 $('#admin-div-company-list').hide();
		 }
		 else
		 {
			 $('#admin-div-company-list').hide();
			 $('#admin-div-product-list').hide();
		 }
		 
	 }
	 
	 function adminShowRolePopup()
	 {
	    var modal_role_form = '#adminAddRoleModalDiv';
		   $(modal_role_form).show();
		   $(modal_role_form).css('display', 'block');
		   $(modal_role_form).modal({ show: true });
     }
	 
	 
	 function adminDeleteRoleDataModal(role_id){
		 
		 var is_sure = confirm("Are you sure");
		 
		 postData = {
            "role_id": role_id,
        };
		
		if(is_sure)
		{
		 
		 $.ajax({
                url: baseUrl + str_delete_role_data_url_ajax + '/' + role_id,
                data: postData,
                processData: false,
                contentType: false,
                type: 'GET',
                beforeSend: function () {
                    $('#admin-edit-profile-roles-data-div').html("Loading. Please Wait...");
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
					admin_show_user_roles_edit_profile_data();
                    //$('#productForm').trigger('reset')
                    //window.location.replace('<?php echo e(route("front.user.product.index")); ?>');
			
                }
            });
		
		   //window.location.href = base_url_new + str_save_role_url_delete + '/' + role_id;	 
		 }
}
    
</script>

<?php echo $__env->make('includes.include_skills_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>