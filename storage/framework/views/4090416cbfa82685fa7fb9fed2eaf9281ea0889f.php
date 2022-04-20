
<?php $__env->startSection('content'); ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="BlogColumnists">
      <div class="FirstColumn">
         <div class="PopColumnists text-center pb-3">
            <h1>POP Columnists</h1>
         </div>
   <!--  ****** || Users Blogs Start || ****** -->
         <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukey => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="UserBlogSliderSection mb-4">
            <?php 
            if($row->user_type ==3) { 
                $user_url = url('companies/'.$row->slug); 
            } elseif($row->user_type ==1) {
              $user_url = url('people/'.$row->slug);
            } ?>
            <a href="<?php echo e($user_url); ?>">
               <div class="BlogUserProfile d-flex align-items-center mb-4">
                  <div class="BlogUserpic">
                     <img src=" <?php if($row->profile_image !=''): ?> <?php echo e(asset('uploads/images/users/'.$row->profile_image)); ?> <?php else: ?> <?php echo e(asset('front/new/images/Product/team_new.png')); ?> <?php endif; ?>" alt="profileimage" class="img-fluid rounded-circle">
                  </div>
                  <div class="BlogUserName">
                     <h4><?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?></h4>
                  </div>
               </div>
            </a>
            <!--  ****** || Owl Slider || ****** -->
              <?php if(isset($row->blogs) && !empty($row->blogs)): ?>
            <div class="OwlCarouselUserBlogSlider">
               <div class="owl-carousel UserBlogsCarousel owl-theme" id="UserBlogSlider<?php echo e(@$ukey); ?>_<?php echo e(count($row->blogs)); ?>">
                 
                  <?php $__currentLoopData = $row->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="item pr-1 pb-1" data-responsive="" data-src="#" data-poster="" data-sub-html="">
                     <a href="<?php echo e(url('blog/'.$row1->slug)); ?>">
                        <div class="blog-image-slider">
                          <img src="<?php echo e(@newsBlogImageBasePath($row1->featured_image)); ?>" class="img-fluid imagesCover videoPreview">
                           <div class="overlayimages8">
                              <strong class="small1"><?php echo e($row1->title); ?></strong>
                           </div>
                        </div>
                     </a>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
              <?php endif; ?>
              <!--  ****** || Owl Slider || ****** -->
         </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <!--  ****** || Users Blogs End || ****** -->
 </div>
   </div>  
      <?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>

$( document ).ready(function() {
    $('.UserBlogsCarousel').each(function() {
     var slidercount =this.id.split('_');
      var items_owl_loop = false;
      if(slidercount[1]>3) {
        var items_owl_loop = true;
      }
      columnistsSlider( this.id,items_owl_loop)
    });


     // setInterval(function () {
     //      $('.mainListCarousel_Blog .owl-nav').removeClass('disabled');
     //      $('.mainListCarousel_Blog .owl-nav').removeClass('disabled');
     //    }, 1000);
});


function columnistsSlider(sliderId,items_owl_loop=false) {
   $('#'+sliderId).owlCarousel({
      margin:10,
      nav:false,
      loop: items_owl_loop,
      dots:false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsiveClass:true,
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
                 items:2
             },
             1200:{
                 items:3
             }
      }
   })
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>