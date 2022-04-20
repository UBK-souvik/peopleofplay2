<script type="text/javascript">

var str_del_people_company_msg = '';
str_del_people_company_msg =  "{{ adminTransLang('people_company_are_you_sure_to_delete_one') }}";
str_del_people_company_msg = str_del_people_company_msg + "{{ adminTransLang('people_company_are_you_sure_to_delete_two') }}";
        $(function() {
            
            $('#users-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm(str_del_people_company_msg)) {
                    var href = $(this).attr('href');
					
                    $.get( href, function( data ) {
                        $('#users-table').DataTable().ajax.reload();
						 
						 $('#message-box-id').html('Profile Deleted Successfully').removeClass('hide alert-danger').addClass('alert-success');
			 
						 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
						 $("#message-box-id").alert('close');
						
                    });
                
               });
			
			}
        });
	  });	
		 
    </script>