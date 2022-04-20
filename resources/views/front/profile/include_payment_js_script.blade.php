@php
  $current_page_url_data_new = URL::current();
@endphp  
<script>

function show_invoices_data(subscription_invoice_count)
	{
		//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
	$.ajax({
                    type: "POST",
                    url: "{{route('front.user.site.ajax.invoices.data')}}",
                    data: {
                      _token: ajax_csrf_token_new,
	                  current_url_new: '{{@$current_page_url_data_new}}',
                      subscription_invoice_count:subscription_invoice_count					  
                    },
					headers: {
                     'X-CSRF-TOKEN': ajax_csrf_token_new
                    },
                    beforeSend: function() {
                           //$('#div-no-invoices-id').show();							
                        },
                    error: function(jqXHR, exception){
                            //$('#div_loading_id').show();
                        },
                    success: function (response) {
						if(subscription_invoice_count>0)
						{
							var obj_subscription_invoice_response = JSON.parse(response);
							
						   $('#div-no-invoices-id').html(obj_subscription_invoice_response.str_count_invoices);
                           $('#txt_latest_invoice_url').val(obj_subscription_invoice_response.hosted_invoice_url);
						   
                           $('.PreLoader').hide();
                            $('.PreLoader').removeClass('pre_loader_show');
						}
						else
						{

                            $('#modal-user-register-plan-popup').modal('show');
						    $('#modal-user-register-plan-popup .modal-content').html(response);	
						    // $('#invoice_data_div').html(response);	

                            $('.PreLoader').hide();
                            $('.PreLoader').removeClass('pre_loader_show');
						}
						
						
                        //document.getElementById('div_loading_id').innerHTML(response);
                    }
                });
	 }

function show_account_info()
	{
		//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
	$.ajax({
                    type: "POST",
                    url: "{{route('front.user.site.ajax.account.data')}}",
                    data: {
                      _token: ajax_csrf_token_new,
	                  current_url_new: '{{@$current_page_url_data_new}}'					  					  
                    },
					headers: {
                     'X-CSRF-TOKEN': ajax_csrf_token_new
                    },
                    beforeSend: function() {
                            //$('#div_loading_id').show();
                        },
                    error: function(jqXHR, exception){
                            //$('#div_loading_id').show();
                        },
                    success: function (response) {
						$('#div_loading_id').html(response);
                        //document.getElementById('div_loading_id').innerHTML(response);
                    }
                });
	 }
	 
	
$('#div-view-latest-invoice').click(function(){ 

var str_txt_latest_invoice_url = $('#txt_latest_invoice_url').val();

window.open(str_txt_latest_invoice_url);
})

$('.view-invoice-history-list').click(function(){
            //$('#card_div').show();
			// $('#viewInvoiceInfoPopop').modal("show");
        $('.PreLoader').addClass('pre_loader_show');
			
			show_invoices_data(0);
        })


	 
$('#cancel-subscription-new').click(function(){
            if (confirm('Are you sure?')) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "GET",
                    url: "{{route('front.cancel.subscription')}}",
                    data: {
                      _token: CSRF_TOKEN, 
                    },
                    dataType: "json",
                    beforeSend: function() {
                            $('#cancel').attr('disabled',true);
                            $('#cancel').html('Please Wait...');
                        },
                    error: function(jqXHR, exception){
                            $('#cancel').attr('disabled',false);
                            $('#cancel').html('Cancel');

                            var msg = formatErrorMessage(jqXHR, exception);
                            toastr.error(msg)
                        },
                    success: function (response) {
                        toastr.success(response.message)
                        location.reload();
                    }
                });    
            }        
        })
		
		$('#update_card').click(function(){
            //$('#card_div').show();
			$('#editCardInfoPopop').modal("show");
        })
		
		
		var stripe = Stripe("{{\App\Models\SiteSetting::get_keys(0)}}");
var elements = stripe.elements();
var style = {
    base: {
        color: "#32325d",
    }
};

var card = elements.create("card", {
    style: style
});
card.mount("#card-element");
card.on('change', ({
    error
}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
    }
});

var form = document.getElementById('payment-form');

form.addEventListener('submit', function (ev) {
    ev.preventDefault();
    $('#submit').attr('disabled',true);
    $('#submit').html('Please Wait...');

    stripe
        .createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: '{{get_current_user_info()->first_name}}',
            },
        })
        .then(function (result) {
            
            if(result.error)
            {               
                 toastr.error(result.error.message);    
                 $('#submit').attr('disabled',false);
                 $('#submit').html('Update');  
                 return false;               
            }
            
          if(result.paymentMethod)
          { 
            result._token = '{{csrf_token()}}',
            $.ajax({
                type: "GET",
                url: "{{ route('front.card.update') }}",
                data: result,
                dataType: "json",
                beforeSend: function() {
                        $('#submit').attr('disabled',true);
                        $('#submit').html('Please Wait...');
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                error: function(jqXHR, exception){
                        $('#submit').attr('disabled',false);
                        $('#submit').html('Update');

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        $('.message_box').html(msg).removeClass('hide');
                    },
                success: function (response) {
                    $('#payment-form').trigger('reset');
                    toastr.success(response.message)
                    location.reload();
                }
            });
         
          }      
            
            // Handle result.error or result.paymentMethod
        }).catch(function(e) {
            $('#submit').attr('disabled',false);
            $('#submit').html('Update');
        });
});

</script>