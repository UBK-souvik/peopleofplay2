
<?php $__env->startSection('content'); ?>
<?php
$user_current_info = get_current_user_info();
$base_url = url('/');
$role_type_id = 0;
$int_type_of_user = 0;
$str_modal_role_type = '';
$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$chk_slug_in_current_url = App\Helpers\UtilitiesTwo::chkSlugInCurrentUrl();
$str_user_url = App\Helpers\Utilities::get_user_url($base_url, $user_current_info);
if(!empty($user_current_info->role))
{
   $role_type_id = $user_current_info->role; 
}
if(!empty($user_current_info->type_of_user))
{
   $int_type_of_user = $user_current_info->type_of_user; 
}
if(!empty($user_current_info->id))
{
   $str_profile_user_edit = $arr_menu_list['profile_user_edit'];
}
$str_current_url =  url()->current();
$str_user_website = $user->website;
$def_user_image_path = App\Helpers\Utilities::get_default_image();
$is_chk_contact_info_flag = 0;
if(!empty($user->inventorContactInfo->agent_name) || !empty($user->inventorContactInfo->agent_email_id) 
|| !empty($user->inventorContactInfo->manager_name) || !empty($user->inventorContactInfo->manager_email_id)
|| !empty($user->inventorContactInfo->company_name) || !empty($user->inventorContactInfo->company_email_id) )
{
   $is_chk_contact_info_flag = 1;  
}
if(!empty($user->inventorContactInfo->company_name))
{   
   $str_inventor_company_name =  @$user->inventorContactInfo->company_name;
   if(is_numeric($str_inventor_company_name))
   {
      $company_user_data = @App\Helpers\Utilities::get_user_object($str_inventor_company_name);
      $str_company_name = @App\Helpers\Utilities::getUserName($company_user_data);  
   }
   else
   {      
      $str_company_name = $str_inventor_company_name;     
   }   
}
else
{
   $str_company_name = '';
}
$arr_social_media_type = App\Helpers\UtilitiesTwo::getSocialMediaArrayValue($user->socialMedia);
$social_media_array_type =$arr_social_media_type[0];
$social_media_array_value =$arr_social_media_type[1];
$int_user_word_length = @App\Helpers\UtilitiesTwo::words_length(@$user->description);
$int_description_words_length = @App\Helpers\UtilitiesTwo::profile_about_words_length();
$int_fun_fact_description_words_length = App\Helpers\UtilitiesTwo::fun_fact_description_words_length();
$int_chk_user_logged_id =  @Auth::guard('users')->user()->id;
$int_user_id_current_new =  @$user->id;
$arr_badges_list = @App\Helpers\UtilitiesTwo::get_batch_list_data();
$int_chk_personal_details_flag = 0;
if(!empty($user->phone_number) || empty($user->hide_email) || empty($user->hide_telephone) || empty($user->hide_secondary_email) || !empty($user->email) || !empty($user->mobile)
|| !empty($user->secondary_phone_number) || !empty($user->secondary_email) || !empty($user->secondary_mobile)
|| !empty($user->postal_address) || !empty($user->city) || !empty($user->state) || !empty($user->zip_code)
|| !empty($user->countrydata->country_name) || !empty($user->business_address) || !empty($user->city_business)
|| !empty($user->state_business) || !empty($user->zip_code_business) || !empty($user->country_id_business)
|| !empty($str_user_website) || !empty($user->dobyear))
{
   $int_chk_personal_details_flag = 1;
}                 
?>
<link rel="stylesheet" type="text/css" href="">
<style>
   .bg-image {
      filter: blur(8px);
      -webkit-filter: blur(8px);
      height: 100px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
   }
   .bg-text {
      background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0, 0.4); 
      color: white;
      font-weight: bold;
      border: 3px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 80%;
      padding: 20px;
      text-align: center;
   }
   .bg-text h1{
      font-size: 25px;
   }
   #a_more, #award_mobile_more {display: none;}
   .sectionBox {
      padding: 10px 20px !important;
   }
   .UserProfile .span-style1 {
    padding: 10px 0 0 !important;
    display: inline-block;
   }
</style>
<div class="col-md-7 col-lg-8 ProfileMiddleColumnSection">
   <div class="left-column border_right UserProfile" id="profile-page-main-div">
      <!----Profile Desgin----->
      <div class="First-column bg-white p-0">
         <div class="">
            <div class="col-md-12 p-0" >
               <div class="row sectionTop">
                  <div class="col-lg-5 col-sm-5 col-md-5 px-2">
                     <?php //echo Auth::guard('users')->user()->id."==". $user->id; die; ?>
                     <?php
                     $str_user_name = @App\Helpers\Utilities::getUserName($user);
                     $base_url = url('/report/0/url/'.@$user->id);
                     ?>            
                     <div class="imgtwoeighty">
                        <img src="<?php echo e(@imageBasePath(@$user->profile_image)); ?>" class="img-fluid imgtwoeighty">
                     </div>
                     
                        <div class=" mt-2 d-flex">
                           <?php $__currentLoopData = $arr_badges_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_badges_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                           $int_batch_id = $arr_badges_list_row;
                           $str_badge_name = 'badge_' . $int_batch_id;
                           $str_badge_caption = 'badge_' . $int_batch_id . '_caption';
                           ?>
                           <?php if(!empty(@$user->$str_badge_name)): ?>
                           <div class="tip mr-2" data-placement="top" title="<?php if(!empty(@$user->$str_badge_caption)): ?><?php echo e(@$user->$str_badge_caption); ?><?php endif; ?>">
                              <img src="<?php echo e(@imageBasePath(@$user->$str_badge_name)); ?>" class="mr-1 text-center badgesCircle" >
                           </div>
                           <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                              <div class="col-12">
                                 <div class="text-center">
                                    
                                    
                                    <div class="my-2 text-center AddToFavorites">
                                       <?php if($user->role ==2): ?>
                                       <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                                       <?php if(check_watch_list(1,$user->id)): ?>
                                       <?php if(Auth::guard('users')->check()): ?>
                                       <a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'<?php echo e(check_watch_list(1,$user->id)->id); ?>',1,'<?php echo e($user->id); ?>');" class="btn NoPaddingWatch "><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>
                                       <?php endif; ?>
                                       <?php else: ?>
                                       <a type="button" href="javascript:void(0);" onclick="addFavorite(this,1,'<?php echo e($user->id); ?>');" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>
                                       <?php endif; ?>
                                       <?php endif; ?>
                                       <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id): ?>
                                       <a class="btn FavEditProfile mr-1" href="<?php echo e($str_profile_user_edit); ?>">Edit Profile</a>
                                       <?php endif; ?>
                                       <?php endif; ?>
                                       
                                       <?php if($user->role ==3): ?>  
                                       <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                                        
                                       <?php endif; ?>
                                       <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                                       <?php if(check_watch_list(4,$user->id)): ?>
                                       <a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'<?php echo e(check_watch_list(4,$user->id)->id); ?>',4,'<?php echo e($user->id); ?>');" class="btn NoPaddingWatch"><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>
                                       <?php else: ?>
                                       <a type="button" href="javascript:void(0);" onclick="addFavorite(this,4,'<?php echo e($user->id); ?>');" class="btn NoPaddingWatch"><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>
                                       <?php endif; ?>
                                       <?php endif; ?>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                        <div class="ProfilPagFeeds d-none">
                           <div class="ProfOpt py-4 py-sm-2 w-100">
                              <ul class="nav">
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src=" <?php echo e(url('/front/images/icons/pop1.png')); ?>" alt="ProfImg" class="img-fluid"><span>Pop it! (18)</span></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="<?php echo e(url('/front/images/icons/comment1.png')); ?>" alt="ProfImg" class="img-fluid"><span>Comment (6)</span></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="<?php echo e(url('/front/images/icons/share1.png')); ?>" alt="ProfImg" class="img-fluid"> <span>Share (14)</span></a> 
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="<?php echo e(url('/front/images/icons/messages1.png')); ?>" alt="ProfImg" class="img-fluid"><span>Message</span></a>
                                 </li>
                              </ul>
                           </div>
                           <div class="FeedCommentsSec">
                              <div class="CommentsSection py-2 px-3 mt-2 w-100">
                                 <div class="w-100 clearfix CommentsProfImg">
                                    <div class="d-flex align-items-center">
                                       <div class="CommentProfileImg">
                                          <img src="/uploads/images/users/20210228225434A6APNS4XaI_users_.jpg" alt="ProfImg" class="img-fluid rounded-circle CommentProfileImage">
                                       </div>
                                       <div class="CommentUserName">
                                          <p class="mb-0">Clark Nesselrodt</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="w-100 clearfix AnotherUserComment my-1">
                                    <div class="d-flex align-items-center CommentUser">
                                       <div class="UsrComt w-75">
                                          <p class="m-0">Peggy is awesome!</p>
                                       </div>
                                       <div class="UsrComtDat w-25">
                                          <span>[Date]</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="CommentsSection py-2 px-3 mt-2 w-100">
                                 <div class="w-100 clearfix CommentsProfImg">
                                    <div class="d-flex align-items-center">
                                       <div class="CommentProfileImg">
                                          <img src="/uploads/images/users/20210228225434A6APNS4XaI_users_.jpg" alt="ProfImg" class="img-fluid rounded-circle CommentProfileImage">
                                       </div>
                                       <div class="CommentUserName">
                                          <p class="mb-0">Clark Nesselrodt</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="w-100 clearfix AnotherUserComment my-1">
                                    <div class="d-flex align-items-center CommentUser">
                                       <div class="UsrComt w-75">
                                          <p class="m-0">Peggy is awesome!</p>
                                       </div>
                                       <div class="UsrComtDat w-25">
                                          <span>[Date]</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="CommentBtn text-center my-2 w-100">
                                 <a href="javascript:void(0)" class="py-1 d-block AllCommentBtn">See All Comments</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-7 col-sm-7 col-md-7 px-2">
                        <div class="paragraph k_text_sec">
                           <div class="row RevRow">
                              <div class="col-sm-7 col-lg-6 col-xl-7 pr-sm-0">
                                 <h2 class="mb-0">
                                    <?php echo e(@$str_user_name); ?> 

                                    <?php if(($user->role !=3) && ($user->is_verify_profile ==1)): ?>
                                    <img src="<?php echo e(asset('front/images/ProfessionalOnventorCheckmark.png')); ?>" alt="profileimage" class="img-fluid badges">
                                    <?php endif; ?>

                                 </h2>

                                 <?php if(!empty(@$user->pronoun) && @$user->pronoun != 'not-specify'): ?>
                                 <span class="acronym fontThirteen"><?php echo e(@$user->pronoun); ?> </span>
                                 <?php endif; ?>
                                 <?php if($user->role ==3): ?>
                                 <?php if(!empty($user->companyCategory->name)): ?>
                                 <?php echo e($user->companyCategory->name); ?>

                                 <?php endif; ?>
                                 <?php endif; ?>
                              </div>
                              <?php if($user->role ==2): ?>
                              <div class="col-md-12">
                                       <?php if(!empty($user->home_page_slide_show_caption)): ?>
                                    <div class="CaptionTxt my-2">
                                       <p class="fontWeightSix">
                                       <?php echo e(ucwords($user->home_page_slide_show_caption)); ?> 
                                       </p>
                                    </div>
                                       <?php endif; ?>
                              </div>
                              <?php endif; ?>
                           </div>
                           <?php if(!empty(@$user->acronym)): ?>
                           <div class="CaptionTxt my-2">
                              <p class="acronym fontThirteen font-weight-bold">(<?php echo e(@$user->acronym); ?>) </p>
                           </div>
                           <?php endif; ?>
                           <?php if(!empty($user->description)): ?>
                           <?php if(strlen($user->description) > 300): ?>
                           <div class="textBoiReadMore">
                            <?php echo nl2br(@$user->description); ?>

                         </div>
                         <a href="javascript:void(0);" onclick="textBoi(this,1)" class="readMore ProfileReadMore btnReadMore">Read More...</a>
                         <?php else: ?>
                         <div>
                           <?php echo nl2br(@$user->description); ?>

                        </div>
                        <?php endif; ?>
                        <div class="textBoiReadLess" style="display: none;">
                         <?php echo nl2br(@$user->description); ?>

                         <a href="javascript:void(0);" onclick="textBoi(this,0)" class="readMore ProfileReadMore">Read Less...</a>
                      </div>
                      <?php endif; ?>
                      <!-- for a company User -->
                      <?php if($user->role ==3): ?>
                      <!-- <hr class="horizline"> -->
                      <div class="col-md-12 strong_size">
                        <div class="row">
                           <!-- <h3 class="sec_head_text w-100">Contact Information</h3> -->
                           <div class="">
                              
                              <?php if(have_permission('email') ): ?>
                              <?php if(empty($user->hide_email)): ?>
                              <?php if(!empty($user->email)): ?>
                              <p class="text-black p-0 mb-1"><strong>Email</strong> : <?php echo e($user->email); ?></p>
                              <?php endif; ?>   
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php if(!empty($user->mobile)): ?>
                              <p class="text-black p-0 mb-1"><strong>Phone</strong> : <?php echo e(@App\Helpers\UtilitiesFour::getUserDialCode($user)); ?> <?php echo e($user->mobile); ?></p>
                              <?php endif; ?>
                              <?php if(have_permission('email') ): ?>
                              <?php if(!empty($str_user_website)): ?>
                              <p class="text-black p-0 mb-1"><strong>Website</strong> : <a href="<?php echo e((strpos($str_user_website, 'http://') !== 0 && strpos($str_user_website, 'https://') !== 0 ) ? 'http://'.$str_user_website : $str_user_website); ?>" target="_blank"><?php echo e(@App\Helpers\UtilitiesTwo::get_video_title_data($str_user_website)); ?></a></p>
                              <?php endif; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <div class="mb-2 d-none">
                        <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                        <a class="btn mt-2" style="border:1px solid grey;background-color: #fff;padding: 4px 15px;color: grey;" href="<?php echo e(url('user/message?uid='.$user->id)); ?>">Send Message</a>
                        <?php endif; ?>
                        <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                        <?php if(check_watch_list(4,$user->id)): ?>
                        <a type="button" href="#" class="btn NoPaddingWatch mt-2">
                           <i class="fa fa-check photo_icon" ></i> Added to Watchlist
                        </a>
                        <?php else: ?>
                        <a type="button" href="<?php echo e(route('front.pages.add_to_watch_list')); ?>?type=4&value=<?php echo e($user->id); ?>" class="btn NoPaddingWatch mt-2"><i class="fa fa-plus photo_icon"></i> Add to Watchlist</a>
                        <?php endif; ?>
                        <?php endif; ?>
                     </div>
                     <!-- <hr class="horizline"> -->
                     <?php endif; ?>
                     <div class="modal" id="userDescModal">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header kbg_black">
                                 <div class="textContent">
                                    <h4 class="modal-title text-white">User Description</h4>
                                 </div>
                                 <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                 <div >
                                    <p class="text-justify p-text"><?php echo e(@$user->description); ?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php if($user->role ==2): ?>
                     <?php if(!empty($user->dobday) && !empty($user->dobmonth)): ?>  
                     <?php if(have_permission('born') ): ?>
                     <p>Born : <?php if(!empty($user->dobday)): ?>
                        <span class="text-capitalize"><?php echo e($user->dobday); ?></span>
                        <?php endif; ?> 
                        <?php if(!empty($user->dobmonth)): ?>
                        <span class="text-capitalize"> <?php echo e(get_month($user->dobmonth)); ?></span>
                        <?php endif; ?>
                        <?php endif; ?>
                         
                        
                     </p>
                     <?php endif; ?>
                     <?php if(isset(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 2): ?>
                     <?php else: ?>
                     <?php if(Auth::guard('users')->check()): ?>
                     <?php else: ?>
                     <p> More at : <span class="text-lowercase"><?php echo $__env->make("front.profile.more_at_poppro_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span></p>
                     <?php endif; ?>
                     <?php endif; ?>
                        <!--  <div class="my-2 ">
                           <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                           <a class="btn sendMessageBtn mr-1" href="<?php echo e(url('user/message?uid='.$user->id)); ?>">Send Message</a>
                           <?php endif; ?>
                           <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id): ?>
                           <?php if(check_watch_list(1,$user->id)): ?>
                           <a type="button" href="#" class="btn NoPaddingWatch ">
                           <i class="fa fa-check photo_icon" ></i>Added to Favorites
                           </a>
                           <?php else: ?>
                           <a type="button" href="<?php echo e(route('front.pages.add_to_watch_list')); ?>?type=1&value=<?php echo e($user->id); ?>" class="btn NoPaddingWatch "><i class="fa fa-plus photo_icon"></i>Add to Favorite</a>
                           <?php endif; ?>
                           <?php endif; ?>
                           </div>
                        -->
                                   
                        <?php endif; ?>
                     </div>
                     <?php
                     $obj_data_new = $user; 
                     ?>
           
</div>
</div>
</div>

<!--  ******** || Fun Facts || ********* -->
   <?php 
   @$fun_fact1 = @$user->fun_fact1;
   @$fun_fact2 = @$user->fun_fact2;
   @$fun_fact3 = @$user->fun_fact3;
   @$editFunfacts = 1;
   ?>  

 <?php echo $__env->make("front.includes.fun-facts", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--  ******** || Fun Facts || ********* -->

 
<?php if(isset(Auth::guard('users')->user()->type_of_user) ): ?>
<?php if($user->role == 2 || $user->role == 3): ?>
<?php if(!empty($user->skills) || !empty($user->services)): ?>
<?php if(have_permission('skills') && have_permission('gender') ): ?>
<div class="col-md-12">
   <div class="row sectionBox SkillsExpertise">
     <h3 class="sec_head_text w-100">Skills & Expertise  
      <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id): ?>
      <a href="<?php echo e($str_profile_user_edit); ?>" class="move_edit_page" title="Edit Skills & Expertise"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
      <?php endif; ?>
   </h3>
   <div class="row strong_size" >
      <div class="col-md-12">
         <?php if(have_permission('skills') ): ?>
         <?php 
         $str_user_skills_new = '';
         if(!empty($user->skills)){
            $explode = explode(',', $user->skills);
         }if(!empty($user->services)){
            $explode = explode(',', $user->services);
         }
         
         $implode = implode(', ', $explode);
         foreach($explode as $explode_row)
         {
            if(empty($str_user_skills_new))
            {
               $str_user_skills_new = '<span class="spanTag">'. $explode_row. '</span>';   
            }
            else
            {
               $str_user_skills_new = $str_user_skills_new . '&nbsp;&nbsp;<span class="spanTag">'. $explode_row. '</span>';    
            }
         }
         ?>
         <p class="text-black p-0 mb-1"><?php echo $str_user_skills_new; ?></p>
         <?php endif; ?>
         <?php if(have_permission('gender') ): ?>
         
            <?php endif; ?>
            
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <?php endif; ?>
   <?php endif; ?>
   <?php endif; ?> 
   
   <?php if(isset(Auth::guard('users')->user()->type_of_user) ): ?>
   <?php if($user->role == 2 || $user->role == 3): ?>
   <?php if(have_permission('website') ): ?>
   <?php if(!empty($role_data) && count($role_data)>0): ?> 
   <?php echo $__env->make("front.profile.user_role_data_popup", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php endif; ?>
   <?php endif; ?>
   <?php endif; ?>
   <?php endif; ?> 
   <?php if(!empty($gallery_image_data)): ?>
   <?php echo $__env->make("front.user.modules.images_gallery", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php endif; ?>
   <?php if(!empty($gallery_known_for_data)): ?>
   <?php echo $__env->make("front.user.modules.known_for_images", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   <?php endif; ?>
   
   <?php if(!empty($awards) && count($awards)>0): ?>
   <div class="col-md-12">
      <div class="row sectionBox desktopveiw">
         <h2 class="sec_head_text w-100 text-left">Awards</h2>
         <div class="table-respomsive">
            <table class="table event_table short_award_list" >
               <tbody>



                <?php //echo "<pre>"; print_r($awards); die; ?> 
                <?php $__currentLoopData = $awards ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_key => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($award_key <= 2): ?>
                <tr class="py-1 px-3">
                  <td class=" pl-0"><a href="#" class="dask_name"><?php echo e(@$award->eventAward->name); ?></a></td>
                  <td>...</td>
                  <td>
                     <a class="span-style1" href="<?php echo e(route('front.user.awardnominee.index')); ?>?id=<?php echo e(@$award->eventAward->id); ?>">View</a>
                  </td>
               </tr>
               <?php endif; ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <?php if(count($awards) > 3 ): ?>
            <tbody id="a_dots"></tbody>
            <?php endif; ?>
            <?php if(count($awards) > 3 ): ?>
            <tbody id="a_more">
               <?php $__currentLoopData = $awards ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_key => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if($award_key > 2): ?>
               <tr class="py-1 px-3">
                  <td class=" pl-0"><a href="#" class="dask_name"><?php echo e(@$award->eventAward->name); ?></a></td>
                  <td>...</td>
                  <td>
                     <a class="span-style1" href="<?php echo e(route('front.user.awardnominee.index')); ?>?id=<?php echo e(@$award->eventAward->id); ?>">View</a>
                  </td>
               </tr>
               <?php endif; ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <?php endif; ?>
         </table>
      </div>
      <div class="mt-3 w-100">
         <?php if(count($awards) > 3 ): ?>
         <span class="span-style1 see_full_list expand" onclick="a_myFunction()" id="a_myBtn" style="cursor: pointer;">
            Expand >>
         </span>
         <?php endif; ?>
      </div>
   </div>
</div>

               <!-- <?php if(!empty($awards) && count($awards)>0): ?>
               <div class="col-md-12">
                  <div class="row sectionBox mobileveiw">
                     <h2 class="sec_head_text w-100 text-left">Awards</h2>
                     <div>
                        <table class="table event_table short_award_list" >
                           <tbody>
                              <?php $__currentLoopData = $awards ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_key => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($award_key <= 2): ?>
                              <tr class="py-1 px-3">
                                 <td class=" pl-0"><a href="#" class="dask_name"><?php echo e(@$award->eventAward->name); ?></a></td>
                                 <td>...</td>
                                 <td>
                                    <a class="span-style1" href="<?php echo e(route('front.user.awardnominee.index')); ?>?id=<?php echo e(@$award->eventAward->id); ?>">View</a>
                                 </td>
                              </tr>
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                           <?php if(count($awards) > 3 ): ?>
                           <tbody id="award_mobile_dots"></tbody>
                           <?php endif; ?>
                           <?php if(count($awards) > 3 ): ?>
                           <tbody id="award_mobile_more">
                              <?php $__currentLoopData = $awards ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_key => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($award_key > 2): ?>
                              <tr class="py-1 px-3">
                                 <td class=" pl-0"><a href="#" class="dask_name"><?php echo e(@$award->eventAward->name); ?></a></td>
                                 <td>...</td>
                                 <td>
                                    <a class="span-style1" href="<?php echo e(route('front.user.awardnominee.index')); ?>?id=<?php echo e(@$award->eventAward->id); ?>">View</a>
                                 </td>
                              </tr>
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                           <?php endif; ?>
                        </table>
                     </div>
                     <div class="mt-3 w-100">
                        <?php if(count($awards) > 3 ): ?>
                        <span class="span-style1 see_full_list expand" onclick="award_mobile_myFunction()" id="award_mobile_myBtn" style="cursor: pointer;">
                           Expand >>
                        </span>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?> -->
               <?php endif; ?> 
               <!-- user brands slideshow -->
               <?php echo $__env->make("front.user.modules.user_brand_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <!-- user products slideshow --> 
               <?php echo $__env->make("front.user.modules.user_products", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <!-- user media slideshow -->
               <?php echo $__env->make("front.user.modules.user_media_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
               <!-- user media slideshow -->
               <?php echo $__env->make("front.user.modules.user_award_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               
               <?php if(!empty($gallery_video_data)): ?>
               <?php echo $__env->make("front.user.modules.videos_gallery", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php endif; ?>
               
               <?php if(isset(Auth::guard('users')->user()->type_of_user) ): ?>
               <?php if(isset(Auth::guard('users')->user()->type_of_user) && (Auth::guard('users')->user()->type_of_user == 2 || Auth::guard('users')->user()->type_of_user == 3)): ?>
               <?php if(($user->role ==2 || $user->role ==3)  && !empty($int_chk_personal_details_flag)): ?>

               <?php echo $__env->make('front.profile.personal_details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <!-- <hr> -->
               <?php endif; ?>
               <?php endif; ?>
               <?php endif; ?> 
               <!-- for a free user or user not logged in --> 
               <?php if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1): ?>
               <div class="col-md-12 strong_size">
                  <div class="row sectionBox">
                     <h3 class="sec_head_text w-100">Contact Information</h3>
                     <?php echo $__env->make("front.user.modules.blur", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  </div>
               </div>
               <?php endif; ?>
               
               <?php if(isset(Auth::guard('users')->user()->type_of_user) ): ?>
               <?php if($user->role == 2 || $user->role == 3): ?>
               <?php if(have_permission('website') ): ?>
               <?php echo $__env->make("front.user.modules.social_media_icons", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php endif; ?>
               <?php endif; ?>
               <?php endif; ?>
               <!-- user blog slideshow -->
               <?php echo $__env->make("front.user.modules.user_blog_list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <!-- for a free user or user not logged in --> 
               <?php if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1): ?>
               <div class="col-md-12 strong_size">
                  <div class="row sectionBox">
                   <h3 class="sec_head_text w-100">Social Media 
                     <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id): ?>
                     <a href="<?php echo e($str_profile_user_edit); ?>" class="move_edit_page" title="Social Media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                     <?php endif; ?>
                  </h3>
                  <?php echo $__env->make("front.user.modules.blur", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               </div>
            </div>
            <?php endif; ?>
            <!-- for a free user or user not logged in --> 
            <?php if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1): ?>
            <div class="col-md-12 strong_size">
               <div class="row sectionBox SkillExpertise">
                  <h3 class="sec_head_text w-100">Skills & Expertise</h3>
                  <?php echo $__env->make("front.user.modules.blur", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               </div>
            </div>
            <?php endif; ?>
            <!-- <hr> -->
            <!-- for a free user or user not logged in --> 
            <?php if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1): ?> 
            <div class="col-md-12 strong_size">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Roles</h3>
                  <?php echo $__env->make("front.user.modules.blur", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
      <div class="userProfileNews ">
         
         <?php if($user->role == 2 || $user->role == 3): ?> 
         <?php if(!empty($news)): ?>      
         <?php echo $__env->make("front.user.modules.featured_news_page", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <?php endif; ?>
         <?php endif; ?>
      </div>
   </div>
   <?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php echo $__env->make("front/includes/advertisement", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
   $(document).ready(function(){
      $('#AboutReadMore').click(function() {
       $('.AboutUser p').toggleClass("Abt");
    });
   });

   function textBoi(e,type) {
    if(type ==1) {
     $('.textBoiReadMore').hide();
     $('.textBoiReadLess').show();
     $(e).hide();
  } else {
     $('.textBoiReadLess').hide();
     $('.textBoiReadMore').show();
     $('.btnReadMore').show();
  }
}
</script>
</div>
<?php echo $__env->make("front.user.modules.ajax_image_gallery_video", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
   #more {display: none;}
</style>
<input type="hidden" name="hid_current_url" id="hid_current_url" value="<?php echo e($str_current_url); ?>">

<?php echo $__env->make("front.includes.profile_js_scripts_include", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>