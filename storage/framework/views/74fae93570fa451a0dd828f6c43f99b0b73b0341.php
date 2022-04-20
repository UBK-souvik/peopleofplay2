
<!-- for a free user or user not logged in -->  

<?php if($user->role ==2 || $user->role ==3): ?>
<?php if(!empty($user->media_list) && count($user->media_list)>0 ): ?>
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="w-100">
        <h3 class="sec_head_text w-100">Media 
          <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
      <a href="<?php echo e(url('user/media')); ?>" class="move_edit_page" title="Edit Media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        <?php endif; ?>
        </h3>
      </div>
      <?php if(count($user->media_list) <= 0  ): ?>
      <div class="d-flex flex-wrap w-100">
         <?php $__currentLoopData = $user->media_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media_list_key => $media_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="ProfileBlogMedia">
            <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$media_list_row_new->url_data)); ?>">
               <div>
                  <img src="<?php echo e(@mediaImageBasePath(@$media_list_row_new->featured_image)); ?>"
                     class="img-fluid videoPreview">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$media_list_row_new->title)); ?></strong>
               </div>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>
      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userMediaSlider owl-theme">
               <?php $__currentLoopData = $user->media_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media_list_key => $media_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="item cgfg" id="owl-carousel-product-main-div-<?php echo e($media_list_key); ?>">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$media_list_row_new->url_data)); ?>">
                        <img src="<?php echo e(@mediaImageBasePath(@$media_list_row_new->featured_image)); ?>" 
                           class="img-fluid imagesCover videoPreview">
                        <div class="overlayimages8 withoutOverlay">
                           <strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$media_list_row_new->title)); ?></strong>
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
