
<?php $__env->startSection('content'); ?>

<?php
$str_email_modify_new = 'pop****y@pop.com';
$str_classifed_application_message_new = '1-Click Application';
$int_classifed_id_new =  @$classified->id;
$int_is_free_not_logged_user =0;
 $int_is_application_saved_flag = '';
if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
{
$int_is_free_not_logged_user = 1; 
 $int_is_application_saved_flag = $classified_application_apply;
}
 
  if($classified_application_apply == 1) {
  $str_classifed_application_message_new = 'Application Submitted';
}
  $str_classifed_application_new = $str_classifed_application_message_new;
  $str_classifed_application_message_saved_new = 'Application Submitted';
  $str_classified_email_new =$classified->user->email;
?>


<style type="text/css">
  
.sectionTop {
    padding: 15px;
}
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="container-width">
      <div class="left-column colheightleft mx-3">
         <div class="First-column bg-white ClassifiedDetail border_right">
            <div class="col-md-12 ">
               <div class="row sectionTop">
                  <div class="col-sm-10 px-0">
                     <h2 class="text-left blogDetHead">
                       <?php echo e($classified->title); ?>

                     </h2>
                     <div class="mb-0 ClassifiedPostDetail">
                        <p class="mb-0 span-text-grey"><span class="span-text-grey">by <a class="span-text-grey" target="_blank" href="<?php echo e(url('people/'.$classified->user->slug)); ?>"><?php echo e($classified->user->first_name); ?> <?php echo e($classified->user->last_name); ?> </a></span> <small class="span-text-grey ml-0 blogDate"> | <?php echo e(@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$classified->created_at)); ?></small> 
                        </p>
                     </div>
                  </div>
                  <div class="col-sm-2 px-0 text-sm-right">
                     <div>
                        <div class="dropdown socialDropdown SocialShareBlog mr-1 mt-2">
                           <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> Share <a href="#" class="photo_icon fa fa-share-square-o"></a></span>
                           <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu">
                              <ul class="dropSocialShare">
                                 <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_current_url');"><i class="fa photo_icon fa-clone"></i></a></li>
                                 <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(url('/pop-classified-details/'.$classified->slug)); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                                 <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(url('/pop-classified-details/'.$classified->slug)); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                                 <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(url('/pop-classified-details/'.$classified->slug)); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                                 <li><a target="_blank" href="https://wa.me/?text=<?php echo e(url('/pop-classified-details/'.$classified->slug)); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <input type="hidden" name="hid_current_url" id="hid_current_url" value="<?php echo e(url('/pop-classified-details/'.$classified->slug)); ?>">  
            <div class="col-md-12">
               <div class="ClassifiedDetail">
                  <div>
                    <?php echo nl2br(@$classified->description); ?>

                  </div>
               </div>
               <div class="col-md-12 pb-3">
                    <div class="text-center mt-2" id="div-classified-application-<?php echo e($int_classifed_id_new); ?>">
                           <a href="javascript:void(0);" id="href-div-classified-application-<?php echo e($int_classifed_id_new); ?>"
                           <?php if(empty($int_is_application_saved_flag)): ?> onclick="return save_classified_applicant_data(<?php echo e($int_classifed_id_new); ?>, <?php echo e($int_is_free_not_logged_user); ?>);" <?php else: ?> disabled <?php endif; ?> id="click-application-id-<?php echo e($int_classifed_id_new); ?>" class="btn py-1 px-4 clickApplicationBtn classifiedApplication-<?php echo e($int_classifed_id_new); ?>" style="background-color: #9900ff; color: #fff;"><?php echo e($str_classifed_application_new); ?></a>
                        </div>
                        <div style="display:none;" class="text-center mt-2 textPurple" id="div-classified-application-loading-<?php echo e($int_classifed_id_new); ?>">
                           Loading...Please Wait.
                        </div>
               </div>
            </div>
         </div>
      </div>

      <div class="backgroundrightforblog mt-4 px-3 py-3">
         <div class="BlogBottomColumn">
            <h2 class="text-left blogSideHead">Related 
               Classified
            </h2>
            <div class="row">
               <?php if(isset($classified_related) && !empty($classified_related)): ?>
               <?php $__currentLoopData = $classified_related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classifiedRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="col-md-6 col-lg-4 col-sm-6 RelatedCol mb-4">
                  <div class="h-100 RelatedClassifiedPost mb-3">
                  	<div class="RelatedClassifiedRecent">
                  		<h5><a href="<?php echo e(url('/pop-classified-details/'.$classifiedRow->slug)); ?>"><?php echo e($classifiedRow->title); ?></a></h5>
                  		<p class="relatedClassfiedshortDesc"><?php echo nl2br($classifiedRow->description); ?></p>
                  	</div> 
                     <a href="<?php echo e(url('/pop-classified-details/'.$classifiedRow->slug)); ?>" class="ClassifiedReadMoreBtn btn">
                      	Read More
                     </a>
                  </div>
               </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
            </div>
         </div>
      </div>

   </div>
       <div class="modal fade" id="modal-classified-application-<?php echo e($int_classifed_id_new); ?>" style="z-index: 1050;">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                           <div class="modal-header kbg_black" >
                              <div class="row pl-3">
                                 <h4 class="text-white">Classified Application</h4>
                              </div>
                              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                           </div>

                           <div class="modal-body">
                              <?php if(!empty($int_is_free_not_logged_user)): ?>
                              <div class="col-md-12 strong_size">
                                 <div class="row sectionBox">
                                    <div>

                                       <h5><?php echo e(@$str_email_modify_new); ?></h5>
                                       <div class="row p-3">
                                       
                                          <h4>To reveal the email</h4>
                                          &nbsp  &nbsp  
                                          <a class="textPurple" href="<?php if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1): ?><?php echo e(url('/change-plan/1')); ?><?php else: ?><?php echo e(url('/login')); ?><?php endif; ?>">
                                             <div class="bg-text w-100">
                                                <h4><?php if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1): ?><?php echo e('Please Upgrade your Plan'); ?><?php else: ?><?php echo e('Please Log In'); ?><?php endif; ?></h4>
                                             </div>
                                          </a>
                                       </div>
                                       <p>(Only for Basic, PRO & Company Users)</p>
                                    </div>
                                 </div>
                              </div>
                              <?php else: ?>
                              <p>
                                 Your 1 click application is submitted successfully, you may also send a personal email to the address below:
                              </p>
                              <div>
                                 <p>
                                    <strong class="textPurple"><?php echo e($str_classified_email_new); ?></strong> &nbsp<a class="btn edit-btn-style py-2 " onclick="return copyToClipboard('#hid_current_email_complete');"> Copy
                                    </a>
                                 </p>
                              </div>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                       <?php if(empty($int_is_free_not_logged_user)): ?>
                  <input type="hidden" name="hid_current_email_complete" id="hid_current_email_complete" value="<?php echo e($str_classified_email_new); ?>"> 
                  <?php endif; ?> 
                  </div>
   <?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    function get_classified_detail(type_id)
   {
    window.location.href = "<?php echo e(url('/')); ?>/pop-classified/"+type_id;
   }
   
   
   function show_classified_modal_popup_new(int_classified_id)
   {
   var modal_more_at_form = '#modal-classified-application-'+int_classified_id;
       $(modal_more_at_form).show();
       $(modal_more_at_form).css('display', 'block');
       $(modal_more_at_form).modal({ show: true });
   } 
      function save_classified_applicant_data(int_classified_id, int_is_free_not_logged_user)
   {
    if(int_is_free_not_logged_user == 1)
    {
      show_classified_modal_popup_new(int_classified_id);
     }
        else
     {
        url_new ="<?php echo e(url('/')); ?>/save-classified-applicant";
          
          $.ajax({
        url: url_new,
        type: 'post',
        dataType: "json",
        data: {
         int_classified_id: int_classified_id,
         token: ajax_csrf_token_new,
   
        },
   
        headers: {
   
         'X-CSRF-TOKEN': ajax_csrf_token_new
   
        },
        
        beforeSend: function () {
                       $('.classifiedApplication-'+int_classified_id).attr('disabled', true);
            $('#div-classified-application-'+int_classified_id).hide();
            $('#div-classified-application-loading-'+int_classified_id).show();
                       // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                   },
                   error: function (jqXHR, exception) {
                       $('.classifiedApplication-'+int_classified_id).attr('disabled', false);
                       $('#div-classified-application-'+int_classified_id).show();
            $('#div-classified-application-loading-'+int_classified_id).hide();
                       var msg = formatErrorMessage(jqXHR, exception);
                       toastr.error(msg)
                   },
   
        success: function( data ) {
        $('.classifiedApplication-'+int_classified_id).attr('disabled', true);
          $('.classifiedApplication-'+int_classified_id).html('<?php echo e($str_classifed_application_message_saved_new); ?>');
        $('#div-classified-application-'+int_classified_id).show();
        $('#div-classified-application-loading-'+int_classified_id).hide(); 
   
        $(".classifiedApplication-"+int_classified_id).unbind("click");
        
         document.getElementById("href-div-classified-application-"+int_classified_id).onclick=callme_new_return_func;
   
        toastr.success(data.message)
        
         show_classified_modal_popup_new(int_classified_id);
   
        }
   
         });
     }     
   } 

    function callme_new_return_func()
   {
    return false;
   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>