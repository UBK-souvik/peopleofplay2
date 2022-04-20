@php
  $user_current_info = get_current_user_info();
  
  $int_at_id = 0; 
  
  if(!empty($user_current_info->at))
  {
	 $int_at_id = $user_current_info->at;  
  }  
@endphp

<script type="text/javascript">
    $(function () {
       
        $('#dobmonth').append($('<option />').val(0).html('Month'));
        for (i = 1; i < 13; i++) {
            $('#dobmonth').append($('<option />').val(i).html(i));
        }
        updateNumberOfDays();

        $('#dobmonth').change(function () {
            updateNumberOfDays();
        });

        $('#dobday option[value={{!empty($user->dobday) ? $user->dobday : '0'}}]').attr('selected','selected');
        $('#dobmonth option[value={{!empty($user->dobmonth) ? $user->dobmonth : '0'}}]').attr('selected','selected');
       // $('#dobyear option[value={{!empty($user->dobyear) ? $user->dobyear : '0'}}]').attr('selected','selected');      

    });

    function updateNumberOfDays() {
        $('#dobday').html('');
        month = $('#dobmonth').val();
        //year = $('#dobyear').val();
      //  days = daysInMonth(month, year);
        $('#dobday').append($('<option />').val(0).html('Day'));
        for (i = 1; i <= 31 ; i++) {
            $('#dobday').append($('<option />').val(i).html(i));
        }

    }

    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }

</script>
<script type="text/javascript">

function load_dob_drop_down_data()
{
   // get_dob_drop_down_data();
}


$(document).ready(function(){
	
	    //ekUploadten();
		//ekUploadsecond();
		load_dob_drop_down_data();
		        /* in the add/edit role modal popup of edit profile for company list */ 
		if(document.getElementById('add_edit_profile_role_name_company_id'))
		{
		   get_company_people_list('add_edit_profile_role_name_company_id', '{{route("front.user.role.search.company")}}', 'add_edit_profile_role_company_hidden_id', 'addRoleModalDivForm');	
		}								/* in the add/edit product for manufacturer list */		if(document.getElementById('product_company_hidden_id'))		{		   get_company_people_list('Company', '{{route("front.user.role.search.company")}}', 'product_company_hidden_id', 'divProductMainDivIdNew');			}				/* in the add/edit product for brand list */		if(document.getElementById('product_brand_hidden_id'))		{		   get_company_people_list('Brand', '{{route("front.user.role.search.brand_list")}}', 'product_brand_hidden_id', 'divProductMainDivIdNew');			}
		        /* in the add/edit role modal popup of edit profile for people list */

		 if(document.getElementById('add_edit_profile_role_name_people_id'))
		{
		   get_company_people_list('add_edit_profile_role_name_people_id', '{{route("front.user.role.search.people")}}', 'add_edit_profile_role_people_hidden_id', 'addRoleModalDivForm');	
		}
		        /* in the add/edit role modal popup of edit profile for product list */
		if(document.getElementById('add_edit_profile_role_name_product_id'))
		{
		  get_company_people_list('add_edit_profile_role_name_product_id', '{{route("front.user.role.search.product")}}', 'add_edit_profile_role_product_hidden_id', 'addRoleModalDivForm');
		}
		        /* in the add/edit role modal popup of edit product colloborator for people list */
		if(document.getElementById('collab_user_name'))
		{
		  get_company_people_list('collab_user_name', '{{route("front.user.role.search.people")}}', 'collab_user_id_hidden', 'AddEditCollabModalForm');
		}

	
        $('#dobday option[value={{!empty($user->dobday) ? $user->dobday : '0'}}]').attr('selected','selected');
        $('#dobmonth option[value={{!empty($user->dobmonth) ? $user->dobmonth : '0'}}]').attr('selected','selected');
       
		
		$(document).on('click','.show-add-role-modal-popup',function(e) {
            e.preventDefault();
			
			$('#addRoleModalDivForm').closest('form').get(0).reset();
			
			$('#addRoleModalDiv  #span-role-team-id-new').html('Add');
			
			$('#addRoleModalDivForm  #add_edit_profile_role_data').val('');			
			$('#addRoleModalDivForm  #add_edit_profile_role_name').val('');
            
            @if($user->role == 2) 			
			  $('#addRoleModalDivForm #add_edit_profile_role_at').val('');
			@endif
			
			$('#addRoleModalDivForm #add_edit_profile_role_hidden_id').val(0);
			$('#addRoleModalDivForm  #add_edit_profile_role_description').val('');
			
			$('#addRoleModalDivForm #add_edit_profile_role_product_hidden_id').val(0);
			$('#addRoleModalDivForm #add_edit_profile_role_company_hidden_id').val(0);
			$('#addRoleModalDivForm #add_edit_profile_role_people_hidden_id').val(0);

            showProductCompany(0);			
			
            //$('#addRoleModalDivForm #add_edit_profile_role_from_day option[value=""]').attr('selected','selected');
            //$('#addRoleModalDivForm #add_edit_profile_role_from_month option[value=""]').attr('selected','selected');
            //$('#addRoleModalDivForm #add_edit_profile_role_from_year option[value=""]').attr('selected','selected');

            //$('#addRoleModalDivForm #add_edit_profile_role_to_day option[value=""]').attr('selected','selected');
            //$('#addRoleModalDivForm #add_edit_profile_role_to_month option[value=""]').attr('selected','selected');
            //$('#addRoleModalDivForm #add_edit_profile_role_to_year option[value=""]').attr('selected','selected');		
			
		});	
		
		$(document).on('click','#edit-profile-roles-data-div  .edit-role-popup-class',function(e) {
            e.preventDefault();

            $('#addRoleModalDiv  #span-role-team-id-new').html('Edit');  
            
			var int_role_people_data = $(this).data("people-id");
			$('#addRoleModalDiv  #add_edit_profile_role_people_hidden_id').val(int_role_people_data);
			
			var int_role_company_data = $(this).data("company-id");
			$('#addRoleModalDiv  #add_edit_profile_role_company_hidden_id').val(str_role_company_data);
			
			var int_role_product_data = $(this).data("product-id");
			$('#addRoleModalDiv  #add_edit_profile_role_product_hidden_id').val(int_role_product_data);
			
			var str_role_name = $(this).data("role-name");
			$('#addRoleModalDiv  #add_edit_profile_role_name').val(str_role_name);
			
			var str_role_people_data = $(this).data("people-name");
			
			if(str_role_people_data == "" || str_role_people_data == undefined)
			{
				str_role_people_data = str_role_name;
			}
			
			$('#addRoleModalDiv  #add_edit_profile_role_name_people_id').val(str_role_people_data);
			
			var str_role_company_data = $(this).data("company-name");
			
			if(str_role_company_data == "" || str_role_company_data == undefined)
			{
				str_role_company_data = str_role_name;
			}
			
			$('#addRoleModalDiv  #add_edit_profile_role_name_company_id').val(str_role_company_data);
			
			var str_role_product_data = $(this).data("product-name");
			
			if(str_role_product_data == "" || str_role_product_data == undefined)
			{
				str_role_product_data = str_role_name;
			}
			
			$('#addRoleModalDiv  #add_edit_profile_role_name_product_id').val(str_role_product_data);
						
			var str_role_data = $(this).data("role-data");
			$('#addRoleModalDiv  #add_edit_profile_role_data').val(str_role_data);			
			
			
			var int_role_at = $(this).data("role-at-id");
			$('#addRoleModalDiv #add_edit_profile_role_at').val(int_role_at);
			
			showProductCompany(int_role_at);
			
			var int_role_auto_id = $(this).data("role-auto-id");
			$('#addRoleModalDiv #add_edit_profile_role_hidden_id').val(int_role_auto_id);
			
			var str_role_description = $(this).data("role-description");
			$('#addRoleModalDiv  #add_edit_profile_role_description').val(str_role_description);			
			
			var int_from_day_str = $(this).data("from_day_str");
			var int_from_month_str = $(this).data("from_month_str");
			var int_from_year_str = $(this).data("from_year_str");
			
			var int_to_day_str = $(this).data("to_day_str");
			var int_to_month_str = $(this).data("to_month_str");
			var int_to_year_str = $(this).data("to_year_str");

            //$('#add_edit_profile_role_from_day option[value='+ int_from_day_str +']').attr('selected','selected');
            //$('#add_edit_profile_role_from_month option[value='+ int_from_month_str +']').attr('selected','selected');
            //$('#add_edit_profile_role_from_year option[value='+ int_from_year_str +']').attr('selected','selected');

            //$('#add_edit_profile_role_to_day option[value='+ int_to_day_str +']').attr('selected','selected');
            //$('#add_edit_profile_role_to_month option[value='+ int_to_month_str +']').attr('selected','selected');
            //$('#add_edit_profile_role_to_year option[value='+ int_to_year_str +']').attr('selected','selected');		

			/*var str_role_from = $(this).data("role-date-from");
			str_role_from = get_date_format_new(str_role_from);
			$('#addRoleModalDiv #add_edit_profile_role_from').val(str_role_from);
			
			var from_year_str = $(this).data("from_year_str");
			console.log(from_year_str);
			$('#addRoleModalDiv  #add_edit_profile_role_from_year option[value='+from_year_str+']').attr('selected','selected');

			var str_role_to = $(this).data("role-date-to");
			str_role_to = get_date_format_new(str_role_to);
            $('#addRoleModalDiv #add_edit_profile_role_to').val(str_role_to);*/
            
        });
		
		
    });



        //$('#myselect2').val(selected).trigger('change');
	function get_dob_drop_down_data()
	{	
		// $.dobPicker({
  //           // Selectopr IDs
  //           daySelector: '#dobday',
  //           monthSelector: '#dobmonth',
  //           yearSelector: '#dobyear',

  //           // Default option values
  //           dayDefault: 'Date',
  //           monthDefault: 'Month',
  //           yearDefault: 'Year',
		// 	// Minimum age
	 //        minimumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(1)}},
  //           maximumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(2)}}
  //       });
	 }	
		
		
	function get_company_people_list(div_id_new, url_new, hidden_field_id, form_id_new)
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
		
	
		

     
	 var str_get_role_data_url_ajax = "/user/get-user-role-data-ajax";
	 
	 function show_user_roles_edit_profile_data() {
            
			$.ajax({
                url: base_url_new + str_get_role_data_url_ajax,
                processData: false,
                contentType: false,
                type: 'GET',
                beforeSend: function () {
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
					$('#edit-profile-roles-data-div').html(data);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    // window.location.replace('{{ route("admin.users.index")}}');
                    // window.location.replace('{{ route("front.login")}}');
					//window.location.href = base_url_new + str_save_role_url_redirect;

                }
            });
        }
	 
	 function showProductCompany(type_val)
	 {
		 if(type_val == 2)
		 {
			 $('#div-company-list').show();
			 $('#div-product-list').hide();
		 }
		 else if(type_val == 1)
		 {
			 $('#div-product-list').show();
			 $('#div-company-list').hide();
		 }
		 else
		 {
			 $('#div-company-list').hide();
			 $('#div-product-list').hide();
		 }
		 
	 } 
	 
	<?php  /*function runSuggestions(element,query) {

        /*
        using ajax to populate suggestions
         
        let sug_area=$(element).parents().eq(2).find('.autocomplete .autocomplete-items');
        $.getJSON("{{url('user/profile/getTags')}}", { query: query }, function( data ) {
            _tag_input_suggestions_data = data;
            $.each(data,function (key,value) {
                let template = $("<div>"+value.name+"</div>").hide()
                sug_area.append(template)
                template.show()
            })
        });

    }*/ ?>

</script>

@include('includes.include_skills_js')