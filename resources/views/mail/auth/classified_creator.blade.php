<!DOCTYPE html>
<html>
	<head>
		<title>{{$mail_title}}</title>
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
		    
<p class="mb-1">Hello {{$user_name}},</p>
<p>	<a href="{{$profile_user_link_url_new}}" target="_blank">{{$str_current_user_name}}</a> is interested in {{$classified_title}}. </p>
<p style="margin: 2px;">Happy POPping!</p>



		  </div>
	</body>
</html>
