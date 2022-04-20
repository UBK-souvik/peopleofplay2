@extends('front.layouts.pages')
@section('content')
<style>
	.MailingList {
	     border-top: 1px solid #fff; 
	}
</style>
<style>
    #card-element iframe{
        /*background-color: red;*/
        position: relative!important;
        padding-top: 15px!important;
        height: 40px!important;
    }
    .CardField-expiry{
        transform: translateX(137px)!important;
    }
    .CardField-child{
        transform: translateX(137px)!important;
    }
    .CardField-number.CardField-child{
        border:1px solid #111!important;
        padding: 6px!important;
        height: 30px!important;
    }
    .CardField-expiry.CardField-child{
           transform: translateX(109px)!important;
    }
    .CardField-expiry .CardField-child{
           transform: translateX(109px)!important;
    }

    @media only screen and (min-width: 600px) {
      .widthThreeTwoSix {
        width: 326px;
      }
    }
    
    /*CardField-expiry CardField-child*/
    /*CardField-number CardField-child*/
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column border_right AccountSubscription">
    <div class="First-column bg-white p-3">
        <h3 class="Tile-style social mb-3 pt-0">Manage Subscriptions</h3>
        <div class="row mt-3">
		  
		   <!-- if the user has entered his credit card details then only show this -->
		   @if(!empty($user->stripe_id) && strpos($user->stripe_id, 'us_')>0)		
				<div class="col-md-12">
					<h5 class="text-left">Card Details</h5>
					<table class="mt-3 w-100">
						<tbody>
							
							<tr>
							<td>
							 <div id="div_loading_id">
							  Loading. Please Wait...
							 </div>
							</td>
							</tr>
							
							
							@if(@$user->gold == 0)
								<tr>
									<td colspan="2">
										<button id="update_card" class="btn btnAll mt-3 mb-4">Edit</button>
									</td>
								</tr>
							@endif
						</tbody>
					</table>

					<div class="row mb-4 mt-2" id="card_div" style="display: none;">
						<div class="col-md-9 border">
							<form id="payment-form" class="mr-ml-3">
								<div  style="width: 27em; height: 3em; margin-top:18px;" id="card-element" class="mr-md-20">
								  <!-- Elements will create input elements here -->
								</div>

								<!-- We'll put the error messages in this element -->
								<div id="card-errors" role="alert"></div>
								<button id="submit" class="btn  btnAll mb-2" style="max-width: 115px;">Update</button>
							</form>     
						</div>       
					</div>
				</div>
			@endif
			
        	<div class="col-md-12">
        		<h5 class="text-left">Expiry Date - 
                    @if(@$user->gold == 1)
                        <span style="color: gold;">Gold Member</span>
                    @elseif(@$user->gold == 0)
                        <span style="color: green;">Active Member</span>
                    @elseif(@$user->gold == 2)
                        <span style="color: red;">Canceled Member</span>
                    @elseif(@$user->gold == 3)
                        <span style="color: yellow;">Refunded Member</span>
                    @endif
                    
                </h5>
        		<table class="mt-3 w-100">
        			<tbody>
                        <tr>
                            <td class="widthThreeTwoSix"><strong>ID:</strong></td>
                            <td>{{@$user->id}}</td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{@$user->first_name .' '.$user->last_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Expiry Date:</strong></td>
                            <td>{{@$user->subscription->ends_at}}</td>
                        </tr>
        				<!-- <tr>
        					
        					<td>{{@$user->subscription->ends_at}}</td>
        				</tr> -->
        				<tr>
        					@php 
        						$subscription = $user->subscription;
								
                                $plan_id = $subscription->plan_id;
	        					if(!empty($subscription->ends_at)){
					                $now = \Carbon\Carbon::now();
					                $date = \Carbon\Carbon::parse($subscription->ends_at);

					                 $diff = $now->diffInMonths($date);
									
					                $data['email'] = @$user->email;
					                $data['name']  = @$user->first_name.' '.@$user->last_name;
					                $data['plan_name']  = @$plan->name;
					            }
								
				            @endphp
							
							
                            @if(empty($subscription->cancelled_at) OR (!empty($subscription->cancelled_at) AND $now >=$date))
                            @if(@$user->gold == 1)
				                <td colspan="2">
                                    <p>You are a gold member</p>
				                </td>
                            @elseif(@$user->gold == 0)
                                
				            	@if($diff == 1)
                                <td>
				                   <button id="renew" class="btn btnAll mt-3">Renew</button>
                                </td>
					            @endif
                                 <td>
                                   <button id="renew" class="btn btnAll mt-3">Renew</button>
                                </td>
                                <td>
                                    <button id="cancel" class="btn btnAll mt-3">Cancel</button>
                                </td>
                            @elseif(@$user->gold == 2)
                                <td colspan="2">
                                    <p>You have canceled your subsription. Please click <a style="color: #0056b3;" href="{{route('front.plans',@$plan_id)}}">here</a> to buy membership.</p>
                                </td>
                             @elseif(@$user->gold == 3)
                                <td colspan="2">
                                    <p>Refunded</p>
                                </td>
                            @endif
                             @endif
        				</tr>
        			</tbody>
        		</table>
        	</div>
        </div>
        <!-- <div class="row mt-4" id="card_div" style="display: none;">
            <div class="col-md-9 border">
                <form id="payment-form" class="mr-ml-3">
                    <div  style="width: 27em; height: 3em; margin-top:18px;" id="card-element" class="mr-md-20">
                      Elements will create input elements here
                    </div>

                    We'll put the error messages in this element
                    <div id="card-errors" role="alert"></div>
                    <button id="submit" class="btn  btnLogin btnAll">Update</button>
                </form>     
            </div>       
        </div> -->
    </div>
</div>
</div>
@endsection
@section('scripts')



<script>

var newsletter_flag = '{{ Session::has("newsletter_flag") }}';

function eventSaveMessage(){
     
	if(newsletter_flag =="1" || newsletter_flag ==1)
	{
		toastr.success("Newsletter Subscriptions updated successfully.");
	}
   
}
   window.onload = eventSaveMessage;
</script>

<script type="text/javascript">


    
	function show_account_info()
	{
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
	$.ajax({
                    type: "GET",
                    url: "{{route('front.user.site.ajax.account.data')}}",
                    data: {
                      _token: CSRF_TOKEN, 
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
	
	
	$(document).ready(function(){
        
		show_account_info();
		
		$('#renew').click(function(){
            if (confirm('Are you sure?')) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "GET",
                    url: "{{route('front.plan.renew')}}",
                    data: {
                      _token: CSRF_TOKEN, 
                    },
                    dataType: "json",
                    beforeSend: function() {
                            $('#renew').attr('disabled',true);
                            $('#renew').html('Please Wait...');
                        },
                    error: function(jqXHR, exception){
                            $('#renew').attr('disabled',false);
                            $('#renew').html('Renew');

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

        $('#cancel').click(function(){
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
            $('#card_div').show();
        })
    })
</script>


<script>

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

@endsection