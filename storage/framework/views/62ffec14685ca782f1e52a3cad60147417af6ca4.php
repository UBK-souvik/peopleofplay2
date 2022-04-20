<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Your People of Play Profile was Upgraded - Peoplofplay.com</title>
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
	  		<img src="<?php echo e(asset('front/images/mainLogo.png')); ?>" width="180">
	  	</div>
	    <p style="margin-top: 6px;margin-bottom: 10px;font-size: 18px;">Hello Admin,</p>
		<p><?php echo e(ucwords($user_name)); ?> has submitted news. Please review it. </p>
		<p>Title : <?php echo e(@$title); ?></p>
		<p>Category : <?php echo e(@$category_name); ?></p>

		<p><a href="<?php echo e(route('admin.news_feeds.index')); ?>" target="_blank">Go to dashboard</a></p>
	  </div>
</body>
</html>