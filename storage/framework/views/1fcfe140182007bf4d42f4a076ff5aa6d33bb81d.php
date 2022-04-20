
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/style_two.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front/new/css/style_three.css')); ?>">
	
		<script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
</head>
    <body>
    
	<?php
	if($error_type=='cancel')
	{
	  $error_type_new = 'CANCELLED'; 
	}
	else
	{		
	 $error_type_new = 'FAILED';
    }
	
	?>

<div class="container marginTwoHundred" style="">
    <div class="row text-center mx-auto">
        <div class="col-sm-8 col-sm-offset-2 mx-auto">
        <img src="<?php echo e(asset('front/images/mainLogo.png')); ?>" width="300">
        <h2 class="headTwo successPaymentHead text-danger">Payment <?php echo e($error_type_new); ?></h2>
        <p class="paraGraphPayment" style=""><strong class="text-danger">Your payment has been <?php echo e($error_type_new); ?>.</strong> </p>				
		<?php if(!empty($payment_log_data->payment_message)): ?>		 
			<p class="paraGraphPayment" style=""> <?php echo e(@$payment_log_data->payment_message); ?>	
		 </p>		
		<?php endif; ?>				
		
		<?php if(!empty($payment_log_data->payment_seller_message)): ?>		 
			<p class="paraGraphPayment" style=""> <?php echo e(@$payment_log_data->payment_seller_message); ?>	</p>		
		<?php endif; ?>

        <?php if(!empty($str_error_message)): ?>
			<p class="paraGraphPayment" style=""> <?php echo e(@$str_error_message); ?>	</p>
         <?php endif; ?>			
		
		<p class="paraGraphPayment">Please check your account balance if your balance has been deducted then please contact me. 
		Dont worry about your payment i am ready to help you..</p>
        <a href="<?php echo e(url('/')); ?>" class="btn RedButton text-uppercase btnLogin">POP OVER TO THE WEBSITE</a>
    <br><br>
        </div>
        
    </div>
</div>
</body>
</html>