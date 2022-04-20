{{-- @component('mail::message')
Reset Password Link of Player of Player
<br>
<a href="{{$url}}">
@component('mail::button', ['url' => $url])
Reset</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

<!DOCTYPE html>
<html>
	<head>
		<title>Reset People of Play Password - {{$name}} - Peoplofplay.com</title>
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
		    <hr>
		    <p class="mb-1">Hey {{$name}}!</p>
		    <p>Oops! We just heard you forgot your People of Play password. No need to worry (it happens to the best of us). Please use the link below to <a href="{{$url}}" >reset your password</a>:
</p>

<p>Please let us know if you have any questions or encounter any other issues at info@peopleofplay.com</p>

            <p style="margin: 2px;">Happy Playing,</p>
			<p style="margin: 2px;">The POPcorns</p>


		    <button class="btn btnAll" ><a href="{{$url}}" class="btn btnAll">Reset your Password</a></button>
		  </div>
	</body>
</html>
