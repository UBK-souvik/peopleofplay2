<!-- <div class="col-md-12 paddingYaxis1">
   <div class="row  mb-0" >
       <div class="owl-carousel userMediaSlider owl-theme" id="video-gallery">
       <div class="item pr-1 pb-1" data-responsive="" data-src="https://i.ytimg.com/vi/A9QCepdvaYU/hqdefault.jpg" 
       data-poster="" data-sub-html="">
           <a href="#">
               <div class="Gallery-text-overlay-Image3">
               <img src="https://i.ytimg.com/vi/A9QCepdvaYU/hqdefault.jpg"
                   class="img-fluid imagesCover videoPreview">
                   <div class="overlayimages8">
                       <strong class="small1">kundan pandey</strong>
                   </div>
               </div>
           </a>
       </div>
     </div>
   </div>
   </div> -->

<!-- for a free user or user not logged in -->	

<?php if($user->role ==3): ?>
<?php if(!empty($user->brand_lists) && count($user->brand_lists)>0 ): ?>
<div class="col-md-12 sectionBox">
   <div class="col-md-12 w-100 pl-0">
      <h3 class="sec_head_text w-100">Brands
      	  <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
            <a href="<?php echo e(url('user/brand')); ?>" class="move_edit_page" title="Edit Brand"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <?php endif; ?>

      </h3>
   </div>
   <div class="row ">
      <?php if(count($user->brand_lists) <= 0  ): ?>
      <div class="d-flex justify-content-start flex-wrap mt-2 BrandSilder">
         <?php $__currentLoopData = $user->brand_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand_list_key => $brand_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div style="margin-right:20px;">
            <a target="_blank" href="<?php echo e(route('front.pages.brand.detail',$brand_list_row_new->slug)); ?>">
               <div>
                  <img  src="<?php echo e(@imageBasePath(@$brand_list_row_new->main_image)); ?>"
                     class="img-fluid homeProfileCircle rounded-circle ">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$brand_list_row_new->name)); ?></strong></div>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>
      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userBrandSlider owl-theme" id="user-brand-slider-div">
               <?php $__currentLoopData = $user->brand_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand_list_key => $brand_list_row_new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="item" id="owl-carousel-brand-main-div-<?php echo e($brand_list_key); ?>">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="<?php echo e(route('front.pages.brand.detail',$brand_list_row_new->slug)); ?>">
                        <img src="<?php echo e(@imageBasePath(@$brand_list_row_new->main_image)); ?>" 
                           class="img-fluid homeProfileCircle rounded-circle">
                        <div class="overlayimages8 withoutOverlay">
                           <strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$brand_list_row_new->name)); ?></strong>
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
