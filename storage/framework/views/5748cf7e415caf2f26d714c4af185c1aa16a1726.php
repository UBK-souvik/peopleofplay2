
<!-- for a free user or user not logged in -->	

<?php if($user->role ==2 || $user->role ==3): ?>

<?php if(!empty($arr_products_objs_new) && count($arr_products_objs_new)>0 ): ?>
<div class="col-md-12">
   <div class="row">
      <div class="col-md-12 sectionBox">
         <div>
            <h3 class="sec_head_text w-100">Products 
              <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
    <a href="<?php echo e(url('user/product')); ?>" class="move_edit_page" title="Edit Product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    <?php endif; ?>
            </h3>
         </div>
         <?php 
         $int_products_slide_flag_new = 0;
         ?>
         <?php   //echo "<pre>"; print_r($arr_products_objs_new); die; ?>
         <?php if(count($arr_products_objs_new) <0  ): ?>
         <div class="d-flex flex-wrap">
            <?php $__currentLoopData = $arr_products_objs_new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collaborator_key => $collaborator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mr-2">
               <a target="_blank" href="<?php echo e(url('product/'.$collaborator['slug'])); ?>">
                  <div>
                     <img src="<?php echo e(@prodEventImageBasePath(@$collaborator['main_image'])); ?>" class="productSlider ">
                  </div>
                  <div  class="userPoductTitle withoutOverlay"><strong><?php echo e(@App\Helpers\UtilitiesTwo::get_video_title_data(@$collaborator['name'])); ?></strong></div>
               </a>
               <?php if(!empty($arr_products_objs_role_names_new[@$int_products_slide_flag_new])): ?>
               <div  class="userPoductTitle withoutOverlay pt-1"><small>(<?php echo e(@$arr_products_objs_role_names_new[@$int_products_slide_flag_new]); ?>)</small></div>
               <?php endif; ?>
            </div>
            <?php 
            $int_products_slide_flag_new++;
            ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php else: ?>
         <div class="col-md-12 mt-2" style="background-color: #fff;">
            <div class="row pb-0 circleBox">
               <div class="owl-carousel userProductSlider owl-theme" id="user-product-slider-div">
                  <?php 
                  $int_products_slide_flag_new = 0;
                  ?>
                  <?php $__currentLoopData = $arr_products_objs_new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collaborator_key => $collaborator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                  <div class="item" id="owl-carousel-product-main-div-<?php echo e($int_products_slide_flag_new); ?>">
                     <div class="Gallery-text-overlay-Image3">
                        <a target="_blank" href="<?php echo e(url('product/'.@$collaborator['slug'])); ?>">
                           <img src="<?php echo e(@prodEventImageBasePath(@$collaborator['main_image'])); ?>" class="productSlider">
                           <div class="userPoductTitle withoutOverlay">
                              <strong><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$collaborator['name'])); ?></strong>
                           </div>
                        </a>
                     </div>
                     <?php if(!empty($arr_products_objs_role_names_new[@$int_products_slide_flag_new])): ?>
                     <div  class="userPoductTitle withoutOverlay pt-1"><small>(<?php echo e($arr_products_objs_role_names_new[@$int_products_slide_flag_new]); ?>)</small></div>
                     <?php endif; ?>
                  </div>
                  
                  <?php 
                  $int_products_slide_flag_new++;
                  ?>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
         </div>
         <?php endif; ?>
      </div>
   </div>
</div>
<?php endif; ?>
<?php endif; ?>
