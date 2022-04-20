
<?php $__env->startSection('content'); ?>
<style>
.popFavInner {
    width: 90%;
}
.popFavnner a {
    float: right;
    padding: 0 10px;
}
.popFavnner {
    width: 10%;
}
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column border_right PopFavorites" >
      <div class="First-column bg-white">
         <div class="col-md-12">
            <div class="row sectionTop">
               <h2 class="Tile-style my-0 w-40 text-left">My Favorites</h2>
               <?php if(session()->has('success')): ?>
               <!-- <div class="alert alert-danger alert-dismissible fade show">
                  <ul>
                      <li><?php echo e(session()->get('success')); ?></li>
                  </ul>
                  </div> -->
               <?php endif; ?>
            </div>
         </div>
      
      <!-- static design -->
      <div class="col-md-12 kawardpage_section">
         <div class="row paddingTwenty pt-0">
            <div class="wrap_text">
               <div class="kbox_wrap d-flex justify-content-start flex-wrap">
                  <?php if(count($watch_list) > 0): ?>
                  <?php $__currentLoopData = $watch_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo $__env->make("front.user.modules.watch_list_box", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <p>Favorites List is empty</p>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
      <!-- static design -->
      </div>
   </div>
</div>
<!-- </div>
   </div>
   </div> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
   $(document).ready(function() {
     $(".expanded").hide();
   
     $(".expanded a, .collapsed a").click(function(eve) {
       var id = $(this).data('id');
         eve.preventDefault();
         // $(this).parent(".expanded, .collapsed").toggle();
         $(".expand_"+id+", .collapse_"+id).toggle();
     });
   });
</script>
<script>
   var watchlist_deleted_flag = '<?php echo e(Session::has("watchlist_deleted_flag")); ?>';
   
   function eventSaveMessage(){
        
        if(watchlist_deleted_flag =="1" || watchlist_deleted_flag ==1)
        {
          toastr.success("Removed Successfully from watchlist.");
        }
      
      }
      window.onload = eventSaveMessage;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>