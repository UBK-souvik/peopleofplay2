
<!-- for a free user or user not logged in -->  

<?php //echo "<pre>"; print_r($user_award_list); die; ?>
<?php if($user->role ==2 || $user->role ==3): ?>
<?php if(!empty($user_award_list) && count($user_award_list)>0 ): ?>
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="w-100">
        <h3 class="sec_head_text w-100">Awards
          <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
      <a href="<?php echo e(url('user/award')); ?>" class="move_edit_page" title="Edit Award"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        <?php endif; ?>
        </h3>
      </div>
      <?php if(count($user_award_list) <= 0  ): ?>
      <div class="d-flex flex-wrap w-100">
         <?php $__currentLoopData = $user_award_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_list_key => $award_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="ProfileBlogMedia">
            <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$award_list_row_new->url_data)); ?>">
               <div>
                  <img src="<?php echo e(@awardUserImageBasePath(@$award_list_row_new->featured_image)); ?>"
                     class="img-fluid videoPreview">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$award_list_row_new->title)); ?></strong>
               </div>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>


      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userAwardSlider owl-theme">
               <?php $__currentLoopData = $user_award_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award_list_key => $award_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="item" id="owl-carousel-useraward-main-div-<?php echo e($award_list_key); ?>">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$award_list_row_new->url_data)); ?>">
                        <img src="<?php echo e(@awardUserImageBasePath(@$award_list_row_new->featured_image)); ?>" 
                           class="img-fluid imagesCover videoPreview">
                        <div class="overlayimages8 withoutOverlay">
                           <strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$award_list_row_new->title)); ?></strong>
                        </div>
                     </a>
                  </div>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
         </div>
      </div>
      <?php endif; ?>
   </div>
</div>
<?php endif; ?>
<?php endif; ?>
