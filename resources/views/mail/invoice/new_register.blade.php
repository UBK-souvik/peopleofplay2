{{--

@component('mail::message')

Thanks for subscribe Pro plan on Player of play

@component('mail::button', ['url' => $url])

Visit website

@endcomponent



Thanks,<br>

{{ config('app.name') }}

@endcomponent --}}







<!DOCTYPE html>

<html>

	<head>

		<title>PoPpro</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style>

			.btnAll {

			    background-color: #121212;

			    border-radius: 4px;

			    font-weight: 600;

			    font-size: 16px;

			    color: #F5C518;

			    padding: 10.5px 30px;

			}

		 	.btnAll:hover {

			    background-color: #111!important;

			    color: #fff!important;

			}

			p { padding: 2%; }

		</style>

	</head>

	<body style="">

		  <div class="container pt-5" style="background-color: #fff;position: relative;min-height: 300px;margin: 0% 20% 0% 20%;">

		  	<div style="text-align: center; position: absolute;top: -60px;left: 37%;transform: translate(0%,0%);">

		  		<img src="{{url('front/images/mainLogo.png')}}" width="180">

		  	</div>

		    <h3 class="">New Registration at PeopleofPlay - {{@$name}} - {{@$plan_name}}</h3>

		    <hr>

		    <p>Name: {{@$name}}.</p>

		    <p>Email: {{@$email}}</p>

		    <p>Plan Name: {{@$plan_name}}</p>

		    <p>Plan Amount: ${{@$plan_price}}</p>

		    <p>Plan Starts At: {{date('Y-m-d h:i:s')}}</p>

		    <p>Plan Ends At: {{@$end_date}}</p>
			@if(!empty(@$invoice_url))
				<p>Click on below link for download invoice:</p>
				<p><a href="{{@$invoice_url}}">{{@$invoice_url}}</a></p>
			@endif
		    <br>

		    <p>POP Team<br>

	    	<img src="{{url('front/images/mainLogo.png')}}" width="180">

		    </p>

		  </div>

	</body>

</html>