
<?php $__env->startSection('content'); ?>
<?php
$str_classifed_application_message_new = '1-Click Application';
$str_classifed_application_message_saved_new = 'Application Submitted';
$obj_user_current_info_new = get_current_user_info();
$int_type_of_user = 0;
$role_type_id  = 0;
if(!empty($obj_user_current_info_new->type_of_user))
{
$int_type_of_user = $obj_user_current_info_new->type_of_user; 
}
if(!empty($obj_user_current_info_new->role))
{
$role_type_id = $obj_user_current_info_new->role; 
}
$int_is_free_not_logged_user =0;
if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
{
$int_is_free_not_logged_user = 1; 
}
$currentURL = url()->current();
?>
<style>
   .firstSerchSection .titleText{
   font-size: 23px;
   }
   .firstSerchSection select.form-control:not([size]):not([multiple]){
   height: 50px;
   }
   .clickApplicationBtn{
   background-color: #9900FF;font-weight: 600;padding: 6px 27px;font-size: 15px;
   }
   .submitAdBtn{
   background-color: #FFFF00;
   padding: 10px 50px;
   border-radius: 7px;
   font-weight: 700;
   font-size: 19px; 
   }
   .clickApplicationBtn {
   border-radius: 4px !important;
   }
   @media  only screen and (max-device-width: 991px) {
   .clickApplicationBtn {
   font-size: 13px;
   display: inline-block;
   }
   }
   @media  only screen and (max-device-width: 400px) {
   .clickApplicationBtn {
   font-weight: 600 !important;
   padding: 6px 15px !important;
   font-size: 14px !important;
   border-radius: 4px !important;
   }
   .submitAdBtn {
   padding: 8px 18px !important;
   font-size: 16px !important;
   }
   }
  
  .short-desc {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 5;
      -webkit-box-orient: vertical;
      width: 100%;
   }
   .ClassifiedHeading {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
   }
   div#short-desc {
    position: relative;
    clear: both;
}
div#short-desc a.readMore.ProfileReadMore {
    bottom: 3px;
}

</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="ClassifiedsSearchSection">
      <section class="firstSerchSection ">
         <div class="container">
            <div class="col-md-12 p-0">
               <div class="text-center">
                  <h1 class="mainHeadText"><span class="textPurple">POP</span> Classifieds</h1>
                  <i>(Lite, Pro and Company Post for Free)</i>
                  <div class="row mt-2">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                        <p>Post in 5 seconds, Apply in 1!</p>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <select class="form-control" onchange="return get_classified_detail(this.value);">
                           <option value="0"><?php echo e($all_classified_categories[8]->name); ?></option>
                           <?php $__currentLoopData = $all_classified_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_classified_categorie_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                     
                           <?php if($all_classified_categorie_row->id == 9): ?>
                           <?php continue; ?>;
                           <?php endif; ?>
                           <option <?php if(!empty($type_id) && $type_id == $all_classified_categorie_row->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($all_classified_categorie_row->id); ?>"><?php echo e($all_classified_categorie_row->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 p-0" style="margin-top: 60px">
               <div class="row">
                   
                  <?php if(!empty($all_classified_list) && count($all_classified_list)>0): ?>
                  <?php $__currentLoopData = $all_classified_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_classified_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                  <?php
                  $int_is_application_saved_flag = 0;
                  $str_email_modify_new = '';
                  
                  $str_classifed_application_new = $str_classifed_application_message_new;
                  
                  $base_url = url('/');
                  $user_current_info_new = $all_classified_list_row->user;
                  
                  $str_classified_email_new = @$str_classified_email_new->email;
                  $int_at_pos_new = strpos($str_classified_email_new, '@');
                 
                  if($int_at_pos_new>0)
                  {
                  $arr_email_data = explode('@',$str_classified_email_new);
                  $str_email_one = substr($arr_email_data[0], -1);
                  $str_email_two = substr($arr_email_data[0], 0, 3);
                  $str_email_three = $arr_email_data[1];
                  $str_email_modify_new = $str_email_two . '****' . $str_email_one . '@' .$str_email_three;
                  }
                  $str_user_name = '';
                  $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
                  $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                  $int_classifed_id_new =  @$all_classified_list_row->id;
                  if(!empty($all_classified_application) && count($all_classified_application)>0)
                  {
                  foreach($all_classified_application as $all_classified_application_row)
                  {
                  if(!empty($int_classifed_id_new))
                  {
                  if(!empty($all_classified_application_row->classified_id) && ($int_classifed_id_new == $all_classified_application_row->classified_id))
                  {
                  $str_classifed_application_new = $str_classifed_application_message_saved_new;
                  $int_is_application_saved_flag = 1;
                  break;
                  }
                  }
                  } 
                  }
                  $int_classified_word_length = @App\Helpers\UtilitiesTwo::words_length(@$all_classified_list_row->description);
                  $int_user_word_length = @App\Helpers\UtilitiesTwo::words_length(@$all_classified_list_row->description);
                  $int_description_words_length = @App\Helpers\UtilitiesTwo::description_words_length();
                  ?>
                     
                  <div class="col-md-6 col-lg-4 mb-4">
                     <div class="ClassifiedListBox">
                        <div class="row">
                           <div class="col-md-10 col-10">
                              <h3 class="ClassifiedHeading"><?php echo e($all_classified_list_row->title); ?></h3>
                           </div>
                           <div class="col-md-2 col-2">
                              <div class="pull-right mt-1">
                                 <div class="dropdown socialDropdown">
                                    <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
                                    <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
                                       <ul class="dropSocialShare">
                                          <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_dictionary_url_2');"><i class="fa photo_icon fa-clone"></i></a></li>
                                          <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                                          <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                                          <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                                          <li><a target="_blank" href="https://wa.me/?text=<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                        <div style="min-height: 187px;">
                           <p class="p-text">
                           <div  class="mainDiv clearfix" id="short-desc" >
                              <div class="desc  short-desc" style="float: left;">
                                 <?php echo nl2br(@$all_classified_list_row->description); ?>

                              </div>
                              <a href="<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>" class="readMore ProfileReadMore" onclick="readMoreBtn(this)"> Read More... </a>
                           </div>
                           <?php if($int_user_word_length > $int_description_words_length): ?>
                           <div id="d_dots<?php echo e($int_classifed_id_new); ?>"></div>
                           <div id="d_more<?php echo e($int_classifed_id_new); ?>" style="display:none;">
                              <p><?php echo @App\Helpers\UtilitiesTwo::limit_words($all_classified_list_row->description, 0, $int_user_word_length); ?> <a data-toggle="modal" class="readMore ProfileReadMore" onclick="d_myFunction_classified(<?php echo e($int_classifed_id_new); ?>)" id="d_myBtn<?php echo e($int_classifed_id_new); ?>">Read Less...</a></p>
                           </div>
                           <?php endif; ?>
                        </div>
                         
                        <div class="text-center mt-2" id="div-classified-application-<?php echo e($int_classifed_id_new); ?>">
                           <a href="javascript:void(0);" id="href-div-classified-application-<?php echo e($int_classifed_id_new); ?>"
                           <?php if(empty($int_is_application_saved_flag)): ?> onclick="return save_classified_applicant_data(<?php echo e($int_classifed_id_new); ?>, <?php echo e($int_is_free_not_logged_user); ?>);" <?php else: ?> disabled <?php endif; ?> id="click-application-id-<?php echo e($int_classifed_id_new); ?>" class="text-white clickApplicationBtn classifiedApplication-<?php echo e($int_classifed_id_new); ?>"><?php echo e($str_classifed_application_new); ?></a>
                        </div>
                        
                        <div style="display:none;" class="text-center mt-2 textPurple" id="div-classified-application-loading-<?php echo e($int_classifed_id_new); ?>">
                           Loading...Please Wait.
                        </div>
                        
                        <div class="text-center mt-3">
                           <p><small>POSTED BY</small> <strong><a href="<?php echo e($str_user_url_new); ?>"><?php echo e($str_user_name); ?></a> </strong>on <?php echo e(@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$all_classified_list_row->created_at)); ?></p>
                        </div>
                         
                     </a>
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
                                        
                                       <h5><?php echo e($str_email_modify_new); ?></h5>
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
                  </div>
                  <?php if(empty($int_is_free_not_logged_user)): ?>
                  <input type="hidden" name="hid_current_email_complete" id="hid_current_email_complete" value="<?php echo e($str_classified_email_new); ?>"> 
                  <?php endif; ?> 
                 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                  
                  <?php else: ?>
                  <div class="col-md-12 text-center">
                     <h5 class="text-center">               
                        <?php if(!empty($type_id)): ?>  
                        No Classifieds exist in this Category.
                        <?php else: ?>
                        No Classifieds exist.
                        <?php endif; ?>             
                     </h5>
                  </div>
                  <?php endif; ?>  
               </div>
            </div>
         </div>
      </section>
      <?php if(($int_type_of_user ==2) && ($role_type_id == 3 || $role_type_id ==2)): ?>
      <div class="text-center">
         <a href="<?php echo e(route('front.user.classified.create')); ?>" class="text-center textPurple submitAdBtn">Submit an Ad for Free!</a>
      </div>
      <?php endif; ?> 
   </div>
   <?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<input type="hidden" name="hid_dictionary_url_2" id="hid_dictionary_url_2" value="<?php echo e(url('/pop-classified-details/'.$all_classified_list_row->slug)); ?>"> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
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
   
   function d_myFunction_classified(int_classified_id) {
          var dots = document.getElementById("d_dots"+int_classified_id);
          var moreText = document.getElementById("d_more"+int_classified_id);
          var btnText = document.getElementById("d_myBtn"+int_classified_id);
        
          if (dots.style.display == "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read More"; 
            moreText.style.display = "none";
       
       document.getElementById("div_limit_description_new"+int_classified_id).style.display = 'block';
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read Less"; 
            moreText.style.display = "contents";
       
       document.getElementById("div_limit_description_new"+int_classified_id).style.display = 'none';
       
          }
       }  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>