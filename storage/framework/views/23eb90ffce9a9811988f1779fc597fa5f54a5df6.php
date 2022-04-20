<?php if(!empty($gallery_known_for_data) && count($gallery_known_for_data)>0): ?>
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="wrap-gallery mb-0 mt-0">
         <h2 class="sec_head_text text-left w-100">Known for
      <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
          <a href="<?php echo e(url('all/known-for-gallery')); ?>" class="move_edit_page" title="Edit Known For"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
      <?php endif; ?>
        </h2>
         <div class="row">
            <div class="col-md-12">
               <div class="wrap-gallery">
                  <div class="Gallery-overlay d-flex flex-wrap">
                    <div class="profilephotoslidercss owl-carousel  owl-theme profileknowslider">
                     <?php $__currentLoopData = $gallery_known_for_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nkey => $gimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                  <a href="javascript:void(0);" class="imagesliderachore"  onclick="getIMageGallery('<?php echo e($gimage->id); ?>',3,'<?php echo e($gimage->user_id); ?>',0);">
                    <img src="<?php echo e(asset('uploads/images/gallery/photos/'.$gimage->media)); ?>">
                    <div class="userPoductTitle withoutOverlay profileSliderCaption"><strong><?php echo e(ucfirst(@$gimage->caption)); ?></strong></div>
                  </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
                  </div>
               </div>
               <span data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-picture-o photo_icon"></i> <a class="span-style1" href="<?php echo e(url('/')); ?><?php echo e($gallery_known_for_link); ?>">See all Photos</a></span>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>

