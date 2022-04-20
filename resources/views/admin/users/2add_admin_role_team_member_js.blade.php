<script type="text/javascript">
$(document).ready(function(){
	
	    
		if(document.getElementById('add_edit_profile_role_name_company_id'))
		{
		   get_admin_company_people_list('add_edit_profile_role_name_company_id', '{{route("admin.user.role.search.company")}}', 'add_edit_profile_role_company_hidden_id', 'addRoleModalDivForm');	
		}
		
		if(document.getElementById('add_edit_profile_role_name_people_id'))
		{
		   get_admin_company_people_list('add_edit_profile_role_name_people_id', '{{route("admin.user.role.search.people")}}', 'add_edit_profile_role_people_hidden_id', 'addRoleModalDivForm');	
		}
		
		if(document.getElementById('add_edit_profile_role_name_product_id'))
		{
		  get_admin_company_people_list('add_edit_profile_role_name_product_id', '{{route("admin.user.role.search.product")}}', 'add_edit_profile_role_product_hidden_id', 'addRoleModalDivForm');
		}
		
			
		$(document).on('click','#edit-profile-roles-data-div  .edit-role-popup-class',function(e) {
            e.preventDefault();
	
			showAdminProductCompany(int_role_at);
			
            
        });
		
		
    });

function get_admin_company_people_list(div_id_new, url_new, hidden_field_id, form_id_new)
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

function showAdminProductCompany(type_val)
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
</script>	 