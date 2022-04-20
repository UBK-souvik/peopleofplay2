<?php if(!empty($gallery_image_data) && $cnt_gallery_image_data>0): ?>
    <div class="col-md-12 sectionBox">
        <h2 class="sec_head_text text-left w-100">Photo Gallery 
        <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id): ?>
            <a href="<?php echo e(url('all/image-gallery')); ?>" class="move_edit_page" title="Edit Photo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <?php endif; ?>
            </h2>
        <div class="row px-3 py-0">            
            <div class="d-flex flex-wrap justifly-content-center images-size1 mb-0 ProPhotoGallery">
                <div class="profilephotoslidercss  owl-carousel  owl-theme profilephotoslider">
                <?php $__currentLoopData = $gallery_image_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nkey => $gimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               
                    <div class="item">
                
                  <a href="javascript:void(0);" class="imagesliderachore"  onclick="getIMageGallery('<?php echo e($gimage->id); ?>',1,'<?php echo e($gimage->user_id); ?>',0);">
                    <img src="<?php echo e(asset('uploads/images/gallery/photos/'.$gimage->media)); ?>">
                    <div class="userPoductTitle withoutOverlay profileSliderCaption"><strong><?php echo e($gimage->caption); ?></strong></div>
                  </a>
                 
                </div>
           
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="ml-1 w-100">
                <span>
    				<?php if(!empty($gallery_image_data) && $cnt_gallery_image_data>0): ?>
                        <i class="photo_icon fa fa-camera" ></i>
                    <?php endif; ?> 
    				
                    <?php if(!empty($gallery_image_data) && $cnt_gallery_image_data>0): ?>
                        <a class="span-style1" href="<?php echo e(url('/')); ?><?php echo e($gallery_images_link); ?>"> See All Photos  <a>  
                    <?php endif; ?>  
    				
                    
                </span> 
    			  
			</div>
        </div>
    </div>
  

<?php endif; ?>


  <?php 
    @$user_product_list_count = @$user_media_list_count = @$user_brand_list_count = @$user_blogs_list_count = @$user_award_list_count =0 ;
    ?>
    <?php if(isset($arr_products_objs_new) && count($arr_products_objs_new)>0): ?>
      <?php @$user_product_list_count =  count($arr_products_objs_new); ?>
    <?php endif; ?>

    <?php if(isset($user->media_list) && count($user->media_list)>0): ?>
      <?php @$user_media_list_count =  count($user->media_list); ?>
    <?php endif; ?>

    <?php if(isset($user->brand_lists) && count($user->brand_lists)>0): ?>
     <?php  @$user_brand_list_count =  count($user->brand_lists); ?>
    <?php endif; ?>

    <?php if(isset($user_blogs_list) && count($user_blogs_list)>0): ?>
      <?php @$user_blog_list_count =  count($user_blogs_list); ?>
    <?php endif; ?>

    <?php if(isset($user_award_list) && count($user_award_list)>0): ?>
      <?php @$user_award_list_count =  count($user_award_list); ?>
    <?php endif; ?>

<?php $__env->startSection('scripts'); ?>
<script>

    var image_gallary_image_dataCount = '<?php echo e(count($gallery_image_data)); ?>';
    var  owl_item_image_loop = false;
    if(image_gallary_image_dataCount > 5) {
      var  owl_item_image_loop = true;
    }

    var image_gallary_know_dataCount = '<?php echo e(count($gallery_known_for_data)); ?>';
    var  owl_item_know_loop = false;
    if(image_gallary_know_dataCount > 5) {
      var  owl_item_know_loop = true;
    }


    var image_gallary_video_dataCount = '<?php echo e(count($gallery_video_data)); ?>';
    var  owl_item_video_loop = false;
    if(image_gallary_video_dataCount > 3) {
      var  owl_item_video_loop = true;
    }

    var user_product_list_count = '<?php echo e(@$user_product_list_count); ?>';
    var user_media_list_count = '<?php echo e(@$user_media_list_count); ?>';
    var user_brand_list_count = '<?php echo e(@$user_brand_list_count); ?>';
    var user_blog_list_count = '<?php echo e(@$user_blog_list_count); ?>';
    var user_award_list_count = '<?php echo e(@$user_award_list_count); ?>';
   







      $('.profilephotoslider').owlCarousel({
            nav:true,
            dots:false,
            margin:10,
            loop : owl_item_image_loop,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                     0:{
                          items:1
                     },
                      400:{
                         items:3
                     },
                     600:{
                         items:3
                     },
                     786:{
                         items:4
                     },
                     1200:{
                         items:5
                     }
                 }
        })

       $('.profileknowslider').owlCarousel({
            nav:true,
            dots:false,
            margin:10,
            loop : owl_item_know_loop,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                     0:{
                          items:1
                     },
                      400:{
                         items:3
                     },
                     600:{
                         items:3
                     },
                     786:{
                         items:4
                     },
                     1200:{
                         items:5
                     }
                 }
        })

$('.profilevideoslider').owlCarousel({
    nav:true,
    dots:false,
    margin:10,
    loop: owl_item_video_loop,
    responsiveClass:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
             0:{
                  items:1
             },
              400:{
                 items:2
             },
             565:{
                 items:3
             },
             786:{
                 items:3
             },
             1200:{
                 items:3
             }
         }
})
</script>


  <?php echo $__env->make("front.includes.profile_js_scripts_include", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

