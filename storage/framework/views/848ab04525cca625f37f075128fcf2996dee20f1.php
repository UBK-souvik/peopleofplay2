<?php //echo "<pre>"; print_r($data); die; ?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Meme of the day</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="owl-carousel popMemeOwlCarousel owl-theme">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item"> 
             <img class="d-block w-100" src="<?php echo e(@imageBasePath( $row->featured_image)); ?>" alt="Memes">
                <?php 
  $str_to_meme_url_new = url('/pages/meme/'.$row->id);
   ?>
   <div class="memeSocialMediaIcon mt-2">
      <ul class="nav  justify-content-center">
       
         <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(@$str_to_meme_url_new); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
         <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(@$str_to_meme_url_new); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
         <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(@$str_to_meme_url_new); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
         <li><a target="_blank" href="https://wa.me/?text=<?php echo e(@$str_to_meme_url_new); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
      </ul>
   </div>
           </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
$('.popMemeOwlCarousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
       
    }
})
</script>