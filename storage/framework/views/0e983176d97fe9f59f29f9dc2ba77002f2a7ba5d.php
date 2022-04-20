<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Your POP Account Auto Renewal Warning - Peoplofplay.com</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
		a{
			text-decoration:none;
			color: #007bff;
		}
	</style>
</head>
<body style="background-color: #fff;">
     <div class="container pt-5" style="background-color: #fff;position: relative;min-height: 300px;margin: 0% 20% 0% 20%;">
		  	<div style="text-align: center; position: absolute;top: -60px;left: 37%;transform: translate(0%,0%);">
		  		<img src="<?php echo e(url('front/images/mainLogo.png')); ?>" width="180">
		  	</div>
		    <h3 class="">People Of Play</h3>
		    <hr>
		    <p class="mb-1">Hello <?php echo e($name); ?></p>
		    <br>
		    <p>Your POP Account will be automatically renewed on <b><?php echo e(@$end_date); ?></b> for <b>$<?php echo e(@$price); ?></b>. If you do not want to renew your account please click this link: <a href="https://peopleofplay.com/change-plan/<?php echo e(@plan_id); ?>" target="_blank">CHANGE PLAN</a>.</p>
		    <br>
		    <p>Please let us know if you have any questions or encounter any other issues at info@peopleofplay.com
            </p>
		    <br>
		    <p>Happy Playing<br>
	    	<span>The POP Stars</span>
		    </p>
		  </div>
		  

	</body>
	</html>