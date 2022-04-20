
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link rel="stylesheet" href="https://sspsoftproindia.com/assets/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('front/new/css/style_two.css') }}">
    <link rel="stylesheet" href="{{asset('front/new/css/style_three.css') }}">
	
		<script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
	  @include('includes.php_debug_bar')
</head>
    <body>
    
	@php
	if($error_type=='cancel')
	{
	  $error_type_new = 'CANCELLED'; 
	}
	else
	{		
	 $error_type_new = 'FAILED';
    }
	
	@endphp

<div class="container marginTwoHundred" style="">
    <div class="row text-center mx-auto">
        <div class="col-sm-8 col-sm-offset-2 mx-auto">
        <img src="{{asset('front/images/mainLogo.png') }}" width="300">
        <h2 class="headTwo successPaymentHead text-danger">Payment {{$error_type_new}}</h2>
        <p class="paraGraphPayment" style=""><strong class="text-danger">Your payment has been {{$error_type_new}}.</strong> </p>				
		@if(!empty($payment_log_data->payment_message))		 
			<p class="paraGraphPayment" style=""> {{@$payment_log_data->payment_message}}	
		 </p>		
		@endif				
		
		@if(!empty($payment_log_data->payment_seller_message))		 
			<p class="paraGraphPayment" style=""> {{@$payment_log_data->payment_seller_message}}	</p>		
		@endif

        @if(!empty($str_error_message))
			<p class="paraGraphPayment" style=""> {{@$str_error_message}}	</p>
         @endif			
		
		<p class="paraGraphPayment">Please check your account balance if your balance has been deducted then please contact me. 
		Dont worry about your payment i am ready to help you..</p>
        <a href="{{url('/')}}" class="btn RedButton text-uppercase btnLogin">POP OVER TO THE WEBSITE</a>
    <br><br>
        </div>
        
    </div>
</div>
</body>
</html>