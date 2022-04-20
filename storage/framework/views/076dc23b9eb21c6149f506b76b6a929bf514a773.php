<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo e(@$plan_name); ?></title>
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

	
	  <div class="container pt-5" style="background-color: #fff;position: relative;width: 650px;min-height: 300px;margin-top: 8%;border:3px solid #662C92;text-align: center;padding: 25px;border-radius: 10px;">
	  	<div style="position: absolute;top: -60px;left: 37%;transform: translate(0%,0%);">
	  		<img src="https://peopleofplay.com/front/images/mainLogo.png" width="180">
	  	</div>
	    <!-- <h3 style="font-size: 25px;font-weight: 700;margin-top: 30px;margin-bottom: 30px;color: #662C92;">Activate your Profile</h3>
	    <hr> -->
	    <p style="margin-top: 6px;margin-bottom: 10px;font-size: 18px;">Welcome <?php echo e($name); ?>!</p>
		<p>Your POP Account will be automatically renewed on <?php echo e(@$ends_at); ?> for <?php echo e(@$plan_price); ?>. If you do not want to renew your account please click this link: <a href="<?php echo e(url('user/manage-account-subscription')); ?>" target="_blank"> Renew Plan</a>.
 </p>

		<p>Please let us know if you have any questions or encounter any other issues at <a href="mailto:info@peopleofplay.com" target="_blank"> info@peopleofplay.com.</a></p>

			<p style="margin: 2px;">Happy Playing,</p>
			<p style="margin: 2px;">The POPulation</p>
	  </div>
</body>
</html>