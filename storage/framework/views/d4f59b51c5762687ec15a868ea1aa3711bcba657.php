
<?php $__env->startSection('content'); ?>

<!----content start---->
	<div class="container" style="min-height: 350px">
		<?php if(count($errors)): ?>
			<div class="alert alert-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>
		<div id="logreg-forms"  >
	        <form class="form-signin" action="<?php echo e(url('sales/login')); ?>" method="POST">
	        	<?php echo e(csrf_field()); ?>
	            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sales </h1>
	            <input type="password" name="input_pin" id="input_pin" class="form-control" placeholder="Enter PIN" required="">	            
	            <button class="btn RedButton  btn-block" type="submit"><i class="fa fa-sign-in photo_icon"></i> Sign in</button>
	            <!-- <a href="#" id="forgot_pswd">Forgot PIN?</a> -->
	        </form>

	        <form action="<?php echo e(url('sales/reset/pin')); ?>" method="POST" class="form-reset">
	        	<?php echo e(csrf_field()); ?>
	            <input type="email" id="resetEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
	            <button class="btn btn-primary btn-block" type="submit">Reset Pin</button>
	            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
	        </form>
            
    	</div>
	</div>
<!-----end------>

<style type="text/css">
    
/* sign in FORM */
#logreg-forms{
    width:412px;
    margin:10vh auto;
    background-color:#f3f3f3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
#logreg-forms form {
    width: 100%;
    max-width: 410px;
    padding: 15px;
    margin: auto;
}
#logreg-forms .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
#logreg-forms .form-control:focus { z-index: 2; }
#logreg-forms .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
#logreg-forms .form-signin input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

#logreg-forms .social-login{
    width:390px;
    margin:0 auto;
    margin-bottom: 14px;
}
#logreg-forms .social-btn{
    font-weight: 100;
    color:white;
    width:190px;
    font-size: 0.9rem;
}

#logreg-forms a{
    display: block;
    padding-top:10px;
    color:lightseagreen;
}

#logreg-form .lines{
    width:200px;
    border:1px solid red;
}


#logreg-forms button[type="submit"]{ margin-top:10px; }

#logreg-forms .facebook-btn{  background-color:#3C589C; }

#logreg-forms .google-btn{ background-color: #DF4B3B; }

#logreg-forms .form-reset, #logreg-forms .form-signup{ display: none; }

#logreg-forms .form-signup .social-btn{ width:210px; }

#logreg-forms .form-signup input { margin-bottom: 2px;}

.form-signup .social-login{
    width:210px !important;
    margin: 0 auto;
}

/* Mobile */

@media  screen and (max-width:500px){
    #logreg-forms{
        width:300px;
    }
    
    #logreg-forms  .social-login{
        width:200px;
        margin:0 auto;
        margin-bottom: 10px;
    }
    #logreg-forms  .social-btn{
        font-size: 1.3rem;
        font-weight: 100;
        color:white;
        width:200px;
        height: 56px;
        
    }
    #logreg-forms .social-btn:nth-child(1){
        margin-bottom: 5px;
    }
    #logreg-forms .social-btn span{
        display: none;
    }
    #logreg-forms  .facebook-btn:after{
        content:'Facebook';
    }
  
    #logreg-forms  .google-btn:after{
        content:'Google+';
    }
    
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	function toggleResetPswd(e){
	    e.preventDefault();
	    $('#logreg-forms .form-signin').toggle() // display:block or none
	    $('#logreg-forms .form-reset').toggle() // display:block or none
	}

	function toggleSignUp(e){
	    e.preventDefault();
	    $('#logreg-forms .form-signin').toggle(); // display:block or none
	    $('#logreg-forms .form-signup').toggle(); // display:block or none
	}

	$(()=>{
	    // Login Register Form
	    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
	    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
	    $('#logreg-forms #btn-signup').click(toggleSignUp);
	    $('#logreg-forms #cancel_signup').click(toggleSignUp);
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>