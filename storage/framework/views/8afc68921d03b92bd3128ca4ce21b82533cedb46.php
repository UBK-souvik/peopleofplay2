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
	  	<div style="position: absolute;left: 37%;transform: translate(0%,0%);">
	  		<img src="https://peopleofplay.com/front/images/mainLogo.png" width="180">
	  	</div>
	    <!-- <h3 style="font-size: 25px;font-weight: 700;margin-top: 30px;margin-bottom: 30px;color: #662C92;">Activate your Profile</h3>
	    <hr> -->
	    <p style="margin-top: 6px;margin-bottom: 10px;font-size: 18px;">Welcome <?php echo e($name); ?>!</p>
	    <p>Thank you for signing up for a POP Company account. We are so happy to have you as a member of the People of Play community. Be sure to check out all of what POP has to offer! Below are few examples of the many things you can do:</p>
	    <p style="margin: 2px;font-size: 11px;"><strong>Add Products and Pictures to your Profile</strong></p>
		<p style="margin: 2px;font-size: 11px;"><strong>Explore using our Advanced Search Features</strong></p>
		<p style="margin: 2px;font-size: 11px;"><strong>Follow People, Products, Events, and More by adding them to your Watchlist</strong></p>
		<p>If you have any questions, encounter any issues, or want to learn more about how much you can do with your POP Profile, please do not hesitate to reach out to <a href="mailto:info@peopleofplay.com" target="_blank"> info@peopleofplay.com.</a></p>           <?php echo $__env->make("mail.invoice.mail_common_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

			<p style="margin: 2px;">Happy Playing,</p>
			<p style="margin: 2px;">The POPpy Seeds</p>
	  </div>
	   <!-- <div class="container" style="background-color: #fff;position: relative;width: 650px;text-align: center;">
	        <div style="margin-top: 10px;">
	        	<a href="https://peopleofplay.com/" target="_blank" style="color: #662C92;text-transform: uppercase;">peopleofplay.com</a>
	        </div>
	        
	  </div> -->
</body>
</html>