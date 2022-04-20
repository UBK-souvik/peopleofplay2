
<?php $__env->startSection('content'); ?> 


<section id="contactUsSection">
         <div class="container">
            <div class="row paddingzero">
               <div class="col-md-7 col-md-6 col-xl-5 clearfix klogin_Style my-5 p-4 rounded mx-auto">
                  <div class="login_logo " >
                     <a href="#" class="d-block px-3 py-2 text-uppercase bg-white text-center text-bold Logostyle">HELP DESK</a>
                  </div>
                  <form class="formstyle mb-5 mt-2" id="contactUsForm">
                     <?php echo csrf_field(); ?>
					 <div class="form-group">
                        <label for="password" class="textPurple">Name</label>
                        <input type="text" class="form-control" placeholder="" name="contact_name" id="contact_name">
                     </div>              
                     <div class="form-group">
                        <label for="EmailID" class="textPurple">Email</label>
                        <input type="email" class="form-control" placeholder="" name="contact_email" id="contact_email" required="required"
                           data-error="Email Id is required.">
                     </div>
                     <div class="form-group">
                        <label for="text" class="textPurple">Mobile</label>
                        <input type="text" class="form-control" placeholder="" name="contact_mobile" id="contact_mobile">
                     </div>
                     <div class="form-group">
                        <label for="text" class="textPurple">Subject</label>
                        <input type="text" class="form-control" placeholder="" name="contact_subject" id="contact_subject">
                     </div>
                     <div class="form-group">
                        <label for="text" class="textPurple">Message</label>
                        <textarea class="form-control" rows="4" name="contact_message" id="contact_message"></textarea>
                     </div>
					 
					 <?php echo $__env->make('front.includes.captcha_html', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					 
                     <div>
                        <button type="submit" id="btnContactUsSave" class="btn RedButton w-100">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>


<!-- Sign Up Page-->
<section>
    


</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
   $(function($) {

            $(document).on('click','#btnContactUsSave',function(e){
                e.preventDefault();

                toastr.remove();

                var fd = new FormData($('#contactUsForm')[0]);
				
				var str_response =  $('#recaptchaResponse').val();
				
                $.ajax({
                    url: "<?php echo e(route('front.contact-us.save')); ?>",
                    //data: fd,
                    data: {
					"contact_name":$('input[name="contact_name"]').val(),
					"contact_email":$('input[name="contact_email"]').val(),
					"contact_mobile":$('input[name="contact_mobile"]').val(),
					"contact_subject":$('input[name="contact_subject"]').val(),
					"contact_message":$('#contact_message').val(),
					"g_recaptcha_response": str_response,
					"recaptcha_response":$('input[name="recaptcha_response"]').val()
					},
					headers: {
			     'X-CSRF-TOKEN': ajax_csrf_token_new
			    },
					//processData: false,
                    //contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#btnContactUsSave').attr('disabled',true);
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#btnContactUsSave').attr('disabled',false);

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        console.log(msg);
                        // $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#btnContactUsSave').attr('disabled',false);
                        // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        //toastr.success("Contact Data Saved Successfully")
                        window.location.href ="<?php echo e(route('front.contact-us')); ?>";

                    }
                });
            });
        });
		
   var contact_data_saved_flag = '<?php echo e(Session::has("contact_data_saved_flag")); ?>';
    // window on load event
   function contactSaveMessage(){
     
     if(contact_data_saved_flag!="")
     {
       toastr.success("Contact form submitted successfully.");
     }
     
   }
   window.onload = contactSaveMessage;
</script>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>