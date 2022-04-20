
<?php $__env->startSection('style_new'); ?>     
   <link href="<?php echo e(asset('front/new_css/bloom.css?'.time())); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   <!---------------|| Chitag Design Section ||--------------->
   <section class="w-100 clearfix theBloomReports" id="theBloomReports">
   <div class="customContainer">
      <div class="bloomReports w-100 clearfix">
         <div class="bloomHeader mb-2">
         <div class="bloomTop pb-4">
            <div class="leftSide">
               <div class="ukrainStand">
               <a href="javascript:void(0);" class="d-inline-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/ukrain.svg')); ?>" class="img-fluid">
               </a>
               </div>
               <div class="bloomLogo">
               <a href="javascript:void(0);" class="d-inline-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/bloom_logo.jpg')); ?>" class="img-fluid">
               </a>
               <p>March 18 - 25, 2022</p>
               </div>
            </div>
            <div class="shareFB">
               <a href="javascript:void(0);" class="d-inline-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/fb.png')); ?>" class="img-fluid">
               </a>
            </div>
         </div>
         <div class="bloomBtm">
            <ul class="list-unstyled blmBtnList">
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/1.jpg')); ?>" class="img-fluid">
               </a>
               </li>
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/2.jpg')); ?>" class="img-fluid">
               </a>
               </li>
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/3.jpg')); ?>" class="img-fluid">
               </a>
               </li>
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/4.jpg')); ?>" class="img-fluid">
               </a>
               </li>
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/5.jpg')); ?>" class="img-fluid">
               </a>
               </li>
               <li>
               <a href="javascript:void(0);" class="d-block">
               <img src="<?php echo e(asset('uploads/images/bloom_reports/btn_images/6.jpg')); ?>" class="img-fluid">
               </a>
               </li>
            </ul>
         </div>
         </div>
         <div class="welcomeNews w-100 clearfix wlcmBorder">
            <div class="blmHeading">
               <h2><?php echo e(ucfirst(@$bloomReport['welcome']->title)); ?></h2>
            </div>
            <div class="blmContent">
               <div class="d-flex manageFlex">
                  <div class="divOne1">
                  <div class="cntimg mt-md-5">
                     <img src="<?php echo e(asset('uploads/images/bloom_reports/'.@$bloomReport['welcome']->image)); ?>" class="img-fluid">
                  </div>
                  </div>
                  <div class="divOne2">
                     <div class="imgContnt">
                        <?php echo nl2br(@$bloomReport['welcome']->caption); ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="welcomeNews w-100 clearfix wlcmBorder">
            <div class="blmHeading d-flex">
               <div class="headImg"><img src="https://static.wixstatic.com/media/b68856_555519fed1064340844ebc5a1320f19d~mv2.jpg/v1/fill/w_90,h_90,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/tBR%20Circle%20LOGO.jpg" class="img-fluid"></div>
               <div class="headText">
                  <h2 class="m-0"><?php echo e(ucfirst(@$bloomReport['person']->title)); ?></h2>
                  <h4 class="m-0"><?php echo e(ucfirst(@$bloomReport['person']->sub_heading)); ?></h4>
               </div>
            </div>
            <div class="blmContent">
               <div class="d-flex manageFlex mt-3">
                  <div class="divOne1">
                     <div class="cntimg">
                        <img src="<?php echo e(asset('uploads/images/bloom_reports/'.@$bloomReport['person']->image)); ?>" class="img-fluid">
                     </div>
                  </div>
                  <div class="divOne2">
                     <div class="imgContnt">
                        <?php echo nl2br(@$bloomReport['person']->caption); ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php if(!empty($bloom_news_reports->toArray())): ?>
            <div class="welcomeNews w-100 clearfix wlcmBorder">
               <?php $cdata = $cdata_2 = array(); ?>
               <?php $__currentLoopData = $bloom_news_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $bloom_news_report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                     <div class="sepContent">
                        <?php  
                           $category = $bloom_news_report->category_id;
                           if(!in_array($category,$cdata)){
                              $cdata[] = $category;
                        ?>
                              <div class="blmHeading d-flex">
                                 <h2 class="m-0"><?php echo e(ucwords($bloom_news_report->cat_name)); ?></h2>
                              </div>
                        <?php } ?>
                        <div class="blmContent">
                           <div class="d-flex manageFlex mt-3">
                              <div class="divOne3">
                                 <div class="imgContnt">
                                    <?php if(!empty($bloom_news_report->caption)): ?>
                                    <a href="<?php echo e($bloom_news_report->url); ?>"><?php echo e(ucfirst($bloom_news_report->title)); ?></a><?php echo nl2br($bloom_news_report->caption); ?>

                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> 
                     <?php if(!in_array($bloom_news_report->category_id,$cdata_2)): ?>
                        <?php 
                           $catId = $bloom_news_report->category_id;
                           $cdata_2[$catId][] = $catId; 
                        ?>
                        <?php echo e(@App\Helpers\UtilitiesFour::getBloomAds($cdata_2,$catId)); ?>

                     <?php endif; ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
            </div>
         <?php endif; ?>
         <div class="welcomeNews w-100 clearfix wlcmBorder joinPOP">
            <div class="blmContent">
               <div class="d-flex manageFlex">
                  <div class="divOne1">
                  <div class="cntimg mt-md-5">
                     <img src="https://static.wixstatic.com/media/b68856_196741b3187340fb9cc1d315083e2c72~mv2.jpg/v1/fill/w_190,h_160,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/Pop%2520Logo%2520Database%2520Options_edited_j.jpg" class="img-fluid">
                  </div>
                  </div>
                  <div class="divOne2">
                  <div class="imgContnt">
                     <div class="blmHeading text-center">
                  <h2 style="color: #D51043;">JOIN PEOPLE OF PLAY (POP) <br class="d-none d-lg-block">It's Linkedin + IMDb + Wikipedia + Fiverr!</h2>
                  </div>
                     <ul class="joinPOPList pl-3">
                     <li>Display your entire portfolio, unlimited products, videos, photos, media, and more</li>
                     <li>Easy-setup and a real live helpful person to talk to if you have questions</li>
                     <li>Advanced search for industry contacts by roles, skills, location, and more</li>
                     <li>POP Pub networking – just one connection can change your life!</li>
                     <li>Access to information of products, people, and companies</li>
                     <li>Find person-to-hire based on skills, roles and expertise </li>
                     <li>Ad campaigns, target members of the industry</li> 
                     <li>Exclusive discounts and events</li> 
                     <li>Classified Ads</li>
                     </ul>
                     <div class="text-center JoinNow">
                        <h6>What are you waiting for? We've got the most powerful platform in our industry! <br> Join here:  <a href="www.peopleofplay.com" class="d-inline-block" target="_blank">www.peopleofplay.com</a></h6>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="welcomeNews w-100 clearfix wlcmBorder worldWideTop">
            <div class="blmHeading">
               <h2 class="m-0">Worldwide Magazines Weekly Top Stories</h2>
               <h4 style="color: #662D91;">Added Friday Morning Chicago Time. Check Back for Complete Lists.</h4>
            </div>
            <div class="blmContent">
               <div class="d-flex manageFlex">
                  <div class="divOne3 ">
                     <div class="imgContnt wldWideList py-3">
                        <h5>Toy Trade Monthly Issues</h5>
                        <?php echo nl2br(@$bloomReport['weekly_stories']->caption); ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="welcomeNews w-100 clearfix wlcmBorder videoOfWeek">
            <div class="blmHeading">
               <h2 class="m-0">Video of the Week</h2>
            </div>
            <div class="imageAdd border-0">
               <?php 
                  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',@$bloomReport['video_week']->video_url, $match);
               ?>
               <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo @$match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               <h6>Watch "Dominoes," the latest in the Cat Trials.</h6>
            </div>
         </div>
         <div class="fullAdsimages my-4">
            <a href="https://www.peopleofplay.com/" class="d-block" target="_blank">
               <img src="https://static.wixstatic.com/media/b68856_d5f9e461fafe421ea7464e44953658cf~mv2.png/v1/fill/w_976,h_448,al_c,usm_0.66_1.00_0.01,enc_auto/Welcome%20to%20the%20%20Future%20POP%20Ad.png" class="img-fluid">
            </a>
         </div>
         <div class="footerMsg w-100 clearfix text-center">
            <h6 class="mb-4"><i>Thank you for being a reader of the Bloom Report. — Mary and Graeme</i></h6>
            <p>Founding Editor and Publisher (1998-2020, Retired): Philip Bloom</p>
            <p>We are honored to carry on Phil's 22 year legacy and continue the Bloom Report. Phil has been a mensch</p>
            <p>and we've loved working with him. Here is a fun and interesting interview with Phil.</p>
            <p>If you would like to reach Phil: philip.bloom100@verizon.net</p> 
            <p>Publisher: Mary Couzin, Chicago Toy & Game Group, Inc.</p>
            <p>Managing Editor: Graeme Thomson</p>
            <p>Assistant Editor: Patrick Fisher</p>
            <p class="lastMsg mt-4 mb-3"><i>Not only does the Bloom Report give you all the news you need to know... we give you all the news you didn't know you needed to know!" -Phil Bloom</i></p>
            <div class="ftrImg text-center">
               <img src="https://static.wixstatic.com/media/b68856_82d9b8cdd7f446f78757caa8b4530484~mv2.jpg/v1/fill/w_600,h_259,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/Phil%2520Bloom%252C%2520Mary%2520Couzin%252C%2520Gra.jpg" class="img-fluid">
            </div>
         </div>
      </div>
   </div>
   </section>
   <!---------------|| Chitag Design Section ||--------------->
   <script>
   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
   });
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>