{{--

@component('mail::message')

Thanks for subscribe Pro plan on Player of play

@component('mail::button', ['url' => @$url])

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

		  		<img src="{{asset('front/images/mainLogo.png')}}" width="180">

		  	</div>

		    <h3 class="">People Of Play</h3>

		    <hr>

		    <p class="mb-1">Hey {{$name}}!</p>

		    <p>Welcome to People of Play. We’re thrilled to see you here!</p>

		    <p>We’re confident that People of Play will help you in connecting with the people in our Toy & Games Industry.</p>

		    <p>Upload your Profile, Product, and Event and enjoy your {{@$plan_name}} Benefits</p>

		    <p>You can also find more of our guides here to learn more about People of Play features.</p>

		    <br>

		    <p>Thanks,<br>

	    	<span>Mary</span>

		    </p>

		  </div>

	</body>

</html>