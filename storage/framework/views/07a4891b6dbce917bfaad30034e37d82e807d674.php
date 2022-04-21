<?php $__env->startSection('content'); ?>
<style>
   .headTopContainer img{
   width: max-width:500px;height: 260px;object-fit:cover;
   }
   .galleryContainer{
   background-color: #FFE133;padding: 50px 0;
   border-radius: 12px;
   box-shadow: 0px 4px 4px #8c8c8c;
   }
   .galleryBox {
   border: 5px solid #662c92;
   border-radius: 5px;
   background-color: #662c92;
   /* width: 225px; */
   margin: 0 auto;
   height: 100%;
   }
   .galleryBox img {
   border-radius: 5px;
   width: auto;
   height: auto;
   }
   .galleryBox .nameWrap{
   background-color: #662C92;color: #fff;
   }
   .pubDesc {
   font-size: 18px;
   }
   @media  only screen and (max-width: 600px) {
   .headText {
   font-size: 30px;
   }
   .pubDesc{
   font-size: 16px;
   }
   }
   .First-column{
      border:1px solid #cdcdcd !important;
      border-radius: 10px;
   }
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   

   <div class="container mt-4">
      <div class="row">
            <div class="col-md-3">
               <div class="leftSideBar">
                     <ul class="nav flex-column text-right">
                        <li class="nav-item">
                           <a class="nav-link" href="#">Directory</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Virtual Pub</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo e(url('service-providers')); ?>">Office Hours</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo e(url('/pop-classified')); ?>">Classifieds</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo e(url('/')); ?>">Social Feed</a>
                        </li>
                     </ul>
               </div>
            </div>
         <div class="col-md-9">
            <!--Pop Pub Banner-->
            <section class="W-100 clearfix popPubBanner" id="popPubBanner">
                  <div class="popPubImage position-relative">
                     <img src="<?php echo e(asset('uploads/images/pub/EventsMeetingsNetworkingHeader.jpg')); ?>" alt="popPub" class="img-fluid">

                  </div>
            </section>
            <!--Pop Pub Contant-->
            <section class="W-100 clearfix popPubContant mt-5" id="popPubContant">
                  <div class="popPubContant">
                     <p class="pubDesc"><?php echo nl2br($pub_heading->description); ?></p>
                     <p class="pubDesc"><b><?php echo nl2br($pub_heading->description_2); ?> </b></p>
                  </div>
            </section>
            <!--Horizontal Line-->
            <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                  <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
            </section>
            <!--Horizontal Line-->
            <!--Mingling Space-->
            <?php if(!empty(@$pub_featured_rooms)): ?>
               <section class="W-100 clearfix minglingSpace mt-5" id="minglingSpace">
                  <div class="row justify-content-center">
                     <div class="col-md-4">
                     <a href="<?php echo e(@$pub_featured_rooms->url); ?>">
                        <div class="minglingSpaceImage text-center text-dark">
                              <img src="<?php echo e(asset('uploads/images/pub/'.@$pub_featured_rooms->image)); ?>" alt="popPub" class="img-fluid">
                              <h5 class="mb-0"><?php echo e(ucwords(@$pub_featured_rooms->heading)); ?></h5>

                        </div>
                     </a>
                     </div>
                     <a href="<?php echo e(@$pub_featured_rooms->url); ?>">
                     <div class="col-md-4">
                        <div class="minglingSpacePara text-center">
                           <h2 class="mb-4 text-dark">MINGLING SPACE</h2>

                           <a class="btn" href="<?php echo e(@$pub_featured_rooms->url); ?>">JOIN ROOM</a>
                        </div>
                     </div>
                     </a>
                  </div>
               </section>
                  <!--Mingling Space-->
                  <!--Horizontal Line-->
               <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                     <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               </section>
            <?php endif; ?>
            <!--Horizontal Line-->
            <!--Meeting Line-->
            <?php if(!empty(@$pub_meeting_rooms->toArray())): ?>
               <section class="W-100 clearfix meetingSpace mb-4" id="horizontalLine">
                     <div class="meetingHeading mb-5">
                        <p><span>MEETING SPACE</span> Hop into a room for a meeting. You are welcome here anytime!</p>
                     </div>
                     <div class="row">
                        <?php $__currentLoopData = $pub_meeting_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub_meeting_room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if(@$pub_meeting_room->type == 0): ?>
                           <a href="<?php echo e(@$pub_meeting_room->url); ?>">
                              <div class="col-md-4 col-sm-6">
                                 <div class="meetingSpaceOuter">
                                       <div class="meetingSpaceImg">
                                          <img src="<?php echo e(asset('uploads/images/pub/'.@$pub_meeting_room->image)); ?>" alt="image2" class="img-fluid">
                                       </div>
                                       <div class="meetingSpaceConnect text-center text-dark">
                                          <h5 class="mb-1"><?php echo e(ucwords(@$pub_meeting_room->heading)); ?></h5>
                                       </div>
                                       <div class="meetingSpaceBtn text-center">
                                          <a class="btn" href="<?php echo e(@$pub_meeting_room->url); ?>">JOIN ROOM</a>
                                       </div>
                                 </div>
                              </div>
                           </a>
                           <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
               </section>
               <!--Meeting Line-->
                  <!--Horizontal Line-->
               <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                     <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               </section>
            <?php endif; ?>
            <!--Horizontal Line-->
         </div>
         
      </div>
      </div>

   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>