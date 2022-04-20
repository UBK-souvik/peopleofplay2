<?php
$int_table_role_cnt_flag_new =1;
?>

<div class="table-responsive">
   <?php $cnt = 0; ?>
  <?php $__currentLoopData = $role_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if($int_role_data_count_flag<=0 && $int_table_role_cnt_flag_new>5): ?>
         <?php break; ?>;
         <?php else: ?>
         <?php endif; ?>
  <div class="industryroles">
   <?php 
      $roles_url = '#';
      $user_current_info = get_current_user_info();
      $roles_url = App\Helpers\UtilitiesFour::getTeamMemberLinks(@$role->user_ID); 
      // echo "<pre>role_data - "; print_r($role_data->toArray()); die;
   ?>
   <a href="<?php echo e($roles_url); ?>" class="text-dark" target="_blank">
   <div class="indusroles d-flex">
      <div class="industryrolesImages mr-3">
         <?php                               
               if(!empty($company_id))
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }
               }
               if(!empty($innovator_id))
               { 
               if($role->at == 1)
               {
               $str_def_image =  @prodEventImageBasePath(@$role->role_profile_image);           
               }
               else if($role->at == 2)
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               else
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }        
               }
               ?>
         <img src="<?php echo e($str_def_image); ?>" class="rounded-circle">
      </div>
      <div class="industryrolesDetails">
         <div class="industryrolesHead">
            <h3 class="mb-1">
               <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_key => $users_user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if($role_key == @$role->role): ?>
               <?php echo e($users_user_role); ?> 
               <?php endif; ?> 
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </h3>
            <h4 class="mb-0"><?php echo e(@ucwords($str_display_name)); ?></h4>
         </div>
         <div class="poprolesDateTime" style="display: none;">
            <p class="mb-0">Dec 2021 - Present &#8226; 1yr 10 mos</p>
            <span>San Francisco Bay Aresa</span>
         </div>
    <!--      <div class="rolesDesp my-2">
            <p> <?php if(!empty($role->description)): ?>
                                 <?php echo e($role->description); ?>

                                 <?php endif; ?> 
                              </p></p>
         </div> -->
      </div>
   </div>
   </a>
</div>
 <?php
         $int_table_role_cnt_flag_new++;
         ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 



   <table class="table event_table" style="display: none;">
      <tbody>
         <?php $__currentLoopData = $role_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if($int_role_data_count_flag<=0 && $int_table_role_cnt_flag_new>5): ?>
         <?php break; ?>;
         <?php else: ?>
         <?php endif; ?>
         <tr class="py-4 py-sm-0">
            <td class="pl-0">
               <?php                               
               if(!empty($company_id))
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }
               }
               if(!empty($innovator_id))
               { 
               if($role->at == 1)
               {
               $str_def_image =  @prodEventImageBasePath(@$role->role_profile_image);           
               }
               else if($role->at == 2)
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               else
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }        
               }
               ?>
               <img src="<?php echo e($str_def_image); ?>" class="rounded-circle">
            </td>
            <td class="span-style1 mb-1" style="display: block;">
               <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_key => $users_user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if($role_key == @$role->role): ?>
               <?php echo e($users_user_role); ?> 
               <?php endif; ?> 
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <!-- <td></td> -->          
            <td class=""><a class="mb-1 text-black fontWeightFourH" style="color: #000;"><?php echo e(@ucwords($str_display_name)); ?></a></td>
           <!--  <td class=""><a class="mb-1 span-style1" href="javascript:void(0);" onclick="return openShowRoleModalPopupNew('<?php echo e(@$role->id); ?>', '<?php echo e($str_role_data_main_div_id); ?>');">See More</a></td> -->
            <div class="modal" id="SeeMore<?php echo e($role->id); ?>">
               <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                     <div class="modal-header kbg_black">
                        <div class="textContent">
                           <h4 class="modal-title text-white"><?php echo e($role_type_data_new); ?> Role</h4>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal">×</button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-12">
                              <p class="text-black p-0 mb-1"><strong>Role </strong> : 
                                 <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_key => $users_user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($role_key == @$role->role): ?>
                                 <?php echo e($users_user_role); ?> 
                                 <?php endif; ?> 
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </p>
                              <?php
                              if(!empty($role->people_id))
                              {
                              $str_user_name = App\Helpers\Utilities::getUserName($role->people_data);  
                              }
                              else
                              {
                              $str_user_name = $role->name; 
                              }
                              ?>
                              <p class="text-black p-0 mb-1"><strong>Name </strong> :  <?php echo e(@ucwords($str_display_name)); ?></p>
                              <?php if($user->role == 2): ?>
                              <p class="text-black p-0 mb-1">
                                 <strong>At </strong> : 
                                 <?php $__currentLoopData = $arr_role_at_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_role_at_list_key => $arr_role_at_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($arr_role_at_list_key == $role->at): ?>
                                 <?php echo e($arr_role_at_list_val); ?>

                                 <?php endif; ?> 
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <!-- for a product display the name -->
                                 <?php if($role->at == 1): ?>
                                 <?php echo '<span>('.@ucwords($str_display_name).')</span>'; ?> 
                                 <?php endif; ?>
                              </p>
                              <?php endif; ?>
                              
                              <p class="text-black p-0 mb-1"><strong>Description </strong> : 
                                 <?php if(!empty($role->description)): ?>
                                 <?php echo e($role->description); ?>

                                 <?php endif; ?> 
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </tr>
         <?php
         $int_table_role_cnt_flag_new++;
         ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
      </tbody>
   </table>
</div>

<div class="industryroles d-none">
   <div class="indusroles d-flex">
      <div class="industryrolesImages">
         <img src="<?php echo e($str_def_image); ?>" class="rounded-circle">
      </div>
      <div class="industryrolesDetails">
         <div class="industryrolesHead">
            <h3 class="mb-1">Business Development</h3>
            <h4 mb-1>Development</h4>
         </div>
         <div class="poprolesDateTime">
            <p class="mb-0">Dec 2021 - Present &#8226; 1yr 10 mos</p>
            <span>San Francisco Bay Aresa</span>
         </div>
         <div class="rolesDesp my-2">
            <p>I write about, culture and language, and politics, among other things.</p>
         </div>
         <div class="rolesGallery">
            <ul>
               <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="<?php echo e(asset('front/images/11.png')); ?>" alt="profileimage" class="img-fluid"></a>
              </li>
            </ul>
         </div>
      </div>
   </div>
</div>



