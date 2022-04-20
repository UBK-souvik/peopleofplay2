<footer class="main-footer">
    <strong><?php echo e(adminTransLang('copyright')); ?> &copy; <?php echo e(date('Y')); ?> <a><?php echo e(adminTransLang('company')); ?></a>.</strong> <?php echo e(adminTransLang('all_rights_reserved')); ?>.
</footer>


<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<script>
function readBadgeURL(e, badge_id)
{
	if(e.files&&e.files[0]){
	var i=new FileReader;i.onload=function(e){$("#badge-blah-image-"+badge_id).attr("src",e.target.result)},
i.readAsDataURL(e.files[0])}
}

function showProdEventDropDownByDestNew(dest_id, page_type, int_profile_id, int_product_id)
{
		
	if(dest_id>0)
	{
	  $( ' .assign-prod-event-drop-down-class').hide(); 	
	  $( '#assign-'+page_type+'-event-product-div'+dest_id).show();	
	}

     load_user_event_product_data_new(dest_id, page_type, int_profile_id, int_product_id);	
}


function load_user_event_product_data_new(dest_id, page_type, int_profile_id, int_product_id)
{
	
	var  postData;
     postData = {
            "dest_id": dest_id,
			"page_type": page_type,
			"int_profile_id": int_profile_id,
			"int_product_id": int_product_id,
			_token: ajax_csrf_token_new,
        };

          $.ajax({
                url: baseUrl + '/admin/notes/get-user-product-event',
				data: postData,
				type: 'POST',
                beforeSend: function () {
					$('#select_div_assign_event_product_id'+dest_id).html('Loading...Please Wait.');
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    //$('#addRoleModalDiv .addUpdateRoleBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
					$('#select_div_assign_event_product_id'+dest_id).html('');
                },
                success: function (data) {
					   $('#select_div_assign_event_product_id'+dest_id).html(data);	
					   $('#assign-'+page_type+'-event-product-div'+dest_id+' .select2').select2();
					
                }
            });	
}
</script>