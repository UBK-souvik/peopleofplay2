
<?php $__env->startSection('content'); ?>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop' async='async'></script>
<style>
   .MailingList {
   border-top: 1px solid #fff; 
   }
   .feed_classified_application {
      background: #662e91;
      width: 210px;
      border-radius: 4px;
      margin: 0 auto;
      color: #fff;
   }
   .close{
      position: absolute;
      top: 8px;
      right: 5px;
      color: #000000;
      font-size: 20px;
      font-weight: bold;
      transition: 0.3s;
      opacity: 1;
      
   }
   .close span{
      border-radius: 20px;
      background: white;
      padding: 0px 7px;
   }
   .st_loader{
      display: inline-block;
      /* font: normal normal normal 14px/1 FontAwesome; */
      /* font-size: inherit; */
      /* -webkit-font-smoothing: antialiased; */
      text-rendering: auto;
      -moz-osx-font-smoothing: grayscale;
      border-radius: 50%;
      border: 2px solid currentColor;
      border-right-color: transparent;
      width: 1rem;
      height: 1rem;
      vertical-align: text-bottom;
      animation: fa-spin .75s linear infinite !important;
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="popFeedBlogs">
      <div class="YTtopContant text-center">
         <img src="<?php echo e(asset('front/images/WebHeader17.png')); ?>" alt="WelcomeToPOPWeekHeader" class="img-fluid">
      </div>
      <div class="popStartPosts w-100 pt-4 pb-3 border-bottom">
         <form>
            <div class="feedInputs">
               <div class="input-group">
               <div class="input-group-prepend">
                  <img src="<?php echo e(@imageBasePath(@$uinfo->profile_image)); ?>" alt="profileimage" class="img-fluid rounded-circle">
               </div>
               <input type="text" class="form-control" placeholder="Start a Post" onclick="feedtype('1');">
               </div>
            </div>
            <div class="feedIconsLists">
               <ul class="list-unstyled IconsLists m-0">
               <li>
                  <a href="javascript:void(0);" class="clrRed" onclick="feedtype('1');">
                     <img src="<?php echo e(asset('front/images/pop_icons/1.png')); ?>" class="img-fluid">
                     <p>Photo</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrOrange" onclick="feedtype('2');">
                     <img src="<?php echo e(asset('front/images/pop_icons/2.png')); ?>" class="img-fluid">
                     <p>Video</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrYellow" onclick="feedtype('4');">
                     <img src="<?php echo e(asset('front/images/pop_icons/3.png')); ?>" class="img-fluid">
                     <p>Media</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrGreen mt-2" onclick="feedtype('5');">
                     <img src="<?php echo e(asset('front/images/feed/feed_product.png')); ?>" class="img-fluid">
                     <p>Product</p>
                  </a>
               </li>
               </ul>
            </div>
            <input type="hidden" name="offset" id="offSet" value="1">
            <input type="hidden" name="no_user_offset" id="no_user_offset" value="<?php echo e($no_User_Offset); ?>">
            <input type="hidden" name="load_status" id="loadStatus" value="active">
         </form>
      </div>
      <?php 
         $sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
         $str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;
         $str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
         $i = $offset_i; $k = 0;

         $str_user_name = '';
         $str_user_url_new = '#';
         $str_profile_image = '';
         if(!empty($question_detail[0]->user_id)){ 
               @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
               @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
               @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
         }        
            $cdata=array();    
      ?> 
      <div class="allPostHere w-100 clearfix mb-4">
         <?php $__currentLoopData = $feeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
               $i = 0;
               $cat_url = 'javascript:void(0)';
               $feed_id = $feed['id']; 

               if($feed['type'] == 1){
                  $category = 'IMAGE';
               }elseif($feed['type'] == 2){
                  $category = 'VIDEO';
               }elseif($feed['type'] == 3){
                  $category = 'BLOG';
               }elseif($feed['type'] == 4){
                  if($feed['check_post'] == '3'){
                     $category = 'WIKI';
                  }elseif($feed['check_post'] == '4'){
                     $category = 'ENTERTAINMENT';
                  }elseif($feed['check_post'] == '5'){
                     $category = 'CAST';
                  }else{
                     $category = 'MEDIA-MENTION';
                  }
               }elseif($feed['type'] == 5){
                  $category = 'PRODUCT';
               }elseif($feed['type'] == 6){
                  $category = 'CLASSIFIED';
               }
            ?>
            <div class="popFeedPost w-100 py-4 border-bottom <?php echo e($i); ?>" id="feed-main-box<?php echo e($feed['id']); ?>">
               <input type="hidden" class="i_position" value="<?php echo e($i); ?>">
               <div class="feedCategory d-flex pb-3">
                  <?php if(@$feed['is_front_admin_user'] == 1): ?>
                     <a href="<?php echo e(url($cat_url)); ?>" class="text-dark"><h6><span><b><?php echo e(@$category); ?></b></span></h6></a>
                  <?php else: ?>
                  <h6><span><b><a href="<?php echo e(url('people/'.$feed['slug'])); ?>" class="text-dark"><?php echo e(ucwords($feed['first_name'].' '.$feed['last_name'])); ?></a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="<?php echo e($cat_url); ?>" class="text-dark"><?php echo e(@$category); ?></a></b></span></h6>
                  <?php endif; ?>
                     <!-- <span class="timeDate"><?php echo e(@App\Helpers\Utilities::timeago($feed['time'])); ?></span> -->
                  
                  <div class="nav-item dropdown" >
                     <a class="" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                     <div class="dropdown-menu DropDownMenuMob">                        
                        <a class="dropdown-item" href="#" onclick="feedAction(`<?php echo e($feed['id']); ?>`,'report_from_show',`feed-main-box<?php echo e($feed['id']); ?>`); return false;">Report</a>
                     </div>
                  </div>
               </div>
               <div class="feedPostContents">
                  <div class="feedTitles d-flex">
                     <?php if($feed['type'] != 0): ?>
                        <div class="leftFeed">
                           <?php if($feed['type']==3): ?>
                              <a href="<?php echo e($feed['url']); ?>" target="blank"><h4><?php echo e($feed['title']); ?></h4></a>
                           <?php elseif($feed['type'] != 6): ?>
                              <?php if(!empty( $feed['url'])): ?>
                              <a href="<?php echo e($feed['url']); ?>" target="blank"><h4><?php echo e($feed['title']); ?></h4></a>
                              <?php else: ?>
                                 <h4><?php echo e($feed['title']); ?></h4>
                              <?php endif; ?>
                           <?php endif; ?>
                           <?php if($feed['type'] != 6): ?>
                              <div class="subDescriptions position-relative">
                                 <div class="pContents <?php if(strlen(strip_tags($feed['caption'])) > 500): ?><?php echo e('four-line-text'); ?> <?php endif; ?>">    
                                    <?php    
                                       $find = ['/^((?:&nbsp;|\s)+)|(?1)$/', '/\s*&nbsp;(?:\s*&nbsp;)*\s*/', '/\s+/'];
                                       $replace = ['', '&nbsp',' '];
                                       $feed['caption'] = preg_replace($find, $replace, trim($feed['caption']));                  
                                    ?>

                                    <?php if(!empty( $feed['url'])): ?>
                                       <a href="<?php echo e($feed['url']); ?>" target="blank"><p><?php echo e(strip_tags($feed['caption'])); ?></p></a>
                                    <?php else: ?>
                                       <p><?php echo e(strip_tags($feed['caption'])); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if(strlen(strip_tags($feed['caption'])) > 500): ?>
                                       <?php if($feed['type'] == 3): ?>
                                          <a href="<?php echo e(url($cat_url)); ?>" class="readMore">Click to article</a>
                                       <?php else: ?>
                                          <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                                       <?php endif; ?>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           <?php elseif($feed['type'] == 6): ?>
                              <a href="<?php echo e(url('/pop-classified-details/'.$feed['product_name'])); ?>" class="clickApplicationBtn">
                                 <h4><?php echo e($feed['title']); ?></h4>
                              </a>
                                 <div class="subDescriptions position-relative">
                                    <div class="pContents  <?php if(strlen(strip_tags($feed['caption'])) > 500): ?><?php echo e('four-line-text'); ?> <?php endif; ?>">
                                       <a href="<?php echo e(url('/pop-classified-details/'.$feed['product_name'])); ?>" class="clickApplicationBtn">
                                          <p><?php echo e(strip_tags($feed['caption'])); ?></p>
                                       </a>
                                       <?php if(strlen(strip_tags($feed['caption'])) > 500): ?>
                                       <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                                 <a href="<?php echo e(url('/pop-classified-details/'.$feed['product_name'])); ?>" class="clickApplicationBtn">
                                    <div class="text-center mt-3 feed_classified_application">
                                       Click For Application
                                    </div>
                                 </a>
                           <?php endif; ?>
                        </div>
                     <?php endif; ?>
                     <div class="rightFeed">
                        <?php if($feed['type'] != 0 && (@$feed['is_front_admin_user']!=1)): ?>
                           <?php if(@$feed['userRole'] == 3): ?>
                           <a href="<?php echo e(url('company/'.$feed['slug'])); ?>" class="profileImg HoverToolTip position-relative" target="_blank">
                           <?php else: ?>
                           <a href="<?php echo e(url('people/'.$feed['slug'])); ?>" class="profileImg HoverToolTip position-relative" target="_blank">
                           <?php endif; ?>
                              <p class="position-absolute"><?php echo e(ucwords($feed['first_name'].' '.$feed['last_name'])); ?></p>
                              <?php $dp_img = @imageBasePath(@$feed['profile_image']); ?> 
                              <img src="<?php echo e(@$dp_img); ?>" alt="profileimage" class="img-fluid rounded-circle">
                           </a>
                        <?php endif; ?> 
                        <!-- <a href="#"><p class="userName">Shubham Sharma</p></a> -->
                     </div>
                  </div>
               </div>
               
               <?php if($feed['type'] != 6 && $feed['type'] != 0): ?>
                  <div class="feedVidImg w-100 mt-3 <?php echo e($feed['type']); ?>">
                     <?php if($feed['video_url'] != ''): ?>
                        <?php 
                           preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                           if(@$feed['check_post'] == 1){
                              @App\Helpers\UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);
                           }
                        ?>
                        <!-- <iframe src="https://www.youtube.com/embed/<?php echo @$match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                        <a href="javascript:void(0)" class="popYouVideo" onclick="videoPopup(this,`<?php echo e(@$match[1]); ?>`); return false;">
                           <img src="<?php echo e(url('/uploads/images/youtube_video/'.@$match[1].'.jpg')); ?>" alt="No Image Found" class="img-fluid">
                           <img src="<?php echo e(url('/uploads/images/youtube_video/youtube_black.svg')); ?>" alt="No Image Found" class="img-fluid youTubePlay hoverHide">
                           <img src="<?php echo e(url('/uploads/images/youtube_video/youtube_red.svg')); ?>" alt="No Image Found" class="img-fluid youTubePlay hoverShow">
                           <!-- <i class="fa fa-youtube-play" aria-hidden="true"></i> -->
                        </a>
                     <?php else: ?>
                        <?php if($feed['image'] != ''): ?>
                           <a href="javascript:void(0)" onclick="imagePopup(this); return false;">
                              <?php if(($feed['type'] == 3) || ($feed['type'] == 5 && $feed['check_post'] == 0)): ?>
                                 <img src="<?php echo e(url('/uploads/images/feed/'.$feed['image'])); ?>" alt="No Image Found" class="img-fluid">
                              <?php elseif($feed['type'] == 5 && $feed['check_post'] == 1): ?>
                                 <img src="<?php echo e(url('/uploads/images/'.$feed['image'])); ?>" alt="No Image Found" class="img-fluid">
                              <?php else: ?>
                                 <img src="<?php echo e(url('/uploads/images/feed/'.$feed['image'])); ?>" alt="No Image Found" class="img-fluid">
                              <?php endif; ?>
                           </a>
                           <?php if($feed['type']==5): ?>
                           <a href="<?php echo e($feed['url']); ?>" target="_blank">
                                 <h5 class="text-center"><?php echo e($feed['product_name']); ?></h5>
                           </a>
                           <?php endif; ?>
                        <?php endif; ?>
                     <?php endif; ?>
                     <?php if($feed['url'] != ''): ?>
                        <?php if($feed['type'] == 1 || $feed['type'] == 2 || $feed['type'] == 4): ?>
                           <?php if($feed['image'] == ''): ?>
                              <a href="<?php echo e($feed['url']); ?>" class="feedOlnyText one-line-text" target="_blank"><?php echo e($feed['url']); ?> </a>
                           <?php else: ?>
                              <a href="<?php echo e($feed['url']); ?>" class="feedOlnyText one-line-text" target="_blank"><?php echo e($feed['url']); ?> </a>
                           <?php endif; ?>
                        <?php endif; ?>
                     <?php endif; ?>
                  </div>
                  <div class="feed-tag mt-2">
                     <ul class="nav tag-list">
                     <?php if($feed['tag']) {
                        $feedTags = explode(',',$feed['tag']);
                        ?>
                     <?php $__currentLoopData = $feedTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">#<?php echo e($tags); ?></a>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php  } ?>
                     <?php  $companies_id =explode(',',$feed['tag_companies']); 
                        if(!empty($companies_id) && count($companies_id)>0) {
                        $companies = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',3)->whereIn('id',$companies_id)->get()->toArray();  ?>
                     <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('company/'.$company->slug)); ?>"><?= '@'.$company->first_name .$company->last_name?></a>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php } ?>
                     <?php  $product_id =explode(',',$feed['tag_products']); 
                        if(!empty($product_id) && count($product_id)>0) {
                        $products = DB::table('products')->select('products.id','products.name','products.slug')->whereIn('id',$product_id)->get()->toArray();   ?>
                     <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('product/'.$product->slug)); ?>"><?= '@'.$product->name?>}</a>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php } ?>
                     <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                        if(!empty($peoples_id) && count($peoples_id)>0) {
                        $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',2)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                     <?php $__currentLoopData = $peoples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $people): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('people/'.$people->slug)); ?>"><?= '@'.$people->first_name .$people->last_name?></a>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php } ?>
                     </ul>
                  </div>
                  <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
                     <hr class="mb-0">
                     <?php @$ProfOptsComments = 'display:none'; ?>
                     <?php if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id']) >0): ?>
                     <?php @$ProfOptsComments = ''; ?>
                     <?php endif; ?>
                     
                     <hr class="my-0 commentCountSectionHr<?php echo e(@$feed['id']); ?>" style="<?php echo e(@$ProfOptsComments); ?>">
                     
                     <ul class="list-unstyled likeLists m-0">
                        <?php 
                        $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                        
                        if($addLikeFeed) {
                           $is_like = 0;
                           $img_pop_icon_0 = asset('front/images/pop_icons/like_icon.png');
                        } else {
                           $is_like = 1;
                           $img_pop_icon_1 =  asset('front/images/pop_icons/7.png');
                        }
                        ?>
                        <li>
                        <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'<?= $feed['id'] ?>','<?= $is_like ?>','comment',0)">
                           <input type="hidden" class="is_like_hidden" value="<?= $is_like ?>">
                           
                           <img src="<?php echo e(asset('front/images/pop_icons/like_icon.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Like_Icon" <?php if($is_like == 1){ echo "style='display:none'"; } ?>>
                           <img src="<?php echo e(asset('front/images/pop_icons/7.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Un_Like_Icon" <?php if($is_like == 0){ echo "style='display:none'"; } ?>>
                           <span class="feedSelfLike"><?php echo e(@App\Helpers\Utilities::feedCommentLikeCount($feed['id'])); ?></span>
                        </a>
                        </li>
                        <li>
                        <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'<?php echo e(@$feed_id); ?>')">
                           <img src="<?php echo e(asset('front/images/pop_icons/6.png')); ?>" class="igm-fluid">
                           <span class="commentCount"><?php echo e(@App\Helpers\Utilities::feedCommentCount($feed['id'])); ?></span>
                        </a>
                        </li>
                        
                        <li class="nav-item">
                           <div class="dropdown socialDropdown SocialShareBlog">
                              <a class="fontWeightSix myDropdownBtn dropdown-toggle" href="#!" data-toggle="dropdown" aria-expanded="true">
                                 <img src="https://peopleofplay.com/front/images/icons/share1.png" alt="ProfImg" class="img-fluid"> <span style="font-size:10px;font-weight:400;">Share</span>
                              </a>
                              <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-24px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
                                 <ul class="dropSocialShare">
                                 <li><a href="javascript:void(0);" onclick="return copySharingUrl(`<?php echo e(url('feed/'.$feed_id)); ?>`);"><i class="fa photo_icon fa-clone"></i></a></li>
                                 <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(url('feed/'.$feed_id)); ?>" data-url="<?php echo e(url('feed/'.$feed_id)); ?>" data-title="<?php echo e($feed['title']); ?>" data-description="<?php echo e($feed['caption']); ?>" data-image="<?php if(!empty($feed['image'])): ?><?php echo e(asset('/uploads/images/feed/'.$feed['image'])); ?><?php elseif(!empty($feed['video_url'])): ?><?php echo e('https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg'); ?><?php endif; ?>"><i class="fa photo_icon fa-facebook"></i></a>
                                 </li>
                                 <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(url('feed/'.$feed_id)); ?>" data-url="<?php echo e(url('feed/'.$feed_id)); ?>" data-title="<?php echo e($feed['title']); ?>" data-description="<?php echo e($feed['caption']); ?>" data-image="<?php if(!empty($feed['image'])): ?><?php echo e(asset('/uploads/images/feed/'.$feed['image'])); ?><?php elseif(!empty($feed['video_url'])): ?><?php echo e('https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg'); ?><?php endif; ?>"><i class="fa photo_icon fa-twitter"></i></a>
                                 </li>
                                 <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(url('feed/'.$feed_id)); ?>" data-url="<?php echo e(url('feed/'.$feed_id)); ?>" data-title="<?php echo e($feed['title']); ?>" data-description="<?php echo e($feed['caption']); ?>" data-image="<?php if(!empty($feed['image'])): ?><?php echo e(asset('/uploads/images/feed/'.$feed['image'])); ?><?php elseif(!empty($feed['video_url'])): ?><?php echo e('https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg'); ?><?php endif; ?>"><i class="fa photo_icon fa-instagram"></i></a>
                                 </li>
                                 <li><a target="_blank" href="https://wa.me/?text=<?php echo e(url('feed/'.$feed_id)); ?>" data-url="<?php echo e(url('feed/'.$feed_id)); ?>" data-title="<?php echo e($feed['title']); ?>" data-description="<?php echo e($feed['caption']); ?>" data-image="<?php if(!empty($feed['image'])): ?><?php echo e(asset('/uploads/images/feed/'.$feed['image'])); ?><?php elseif(!empty($feed['video_url'])): ?><?php echo e('https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg'); ?><?php endif; ?>"><i class="fa photo_icon fa-whatsapp"></i></a>
                                 </li>
                                 <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(url('feed/'.$feed_id)); ?>" data-url="<?php echo e(url('feed/'.$feed_id)); ?>" data-title="<?php echo e($feed['title']); ?>" data-description="<?php echo e($feed['caption']); ?>" data-image="<?php if(!empty($feed['image'])): ?><?php echo e(asset('/uploads/images/feed/'.$feed['image'])); ?><?php elseif(!empty($feed['video_url'])): ?><?php echo e('https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg'); ?><?php endif; ?>"><i class="fa photo_icon fa-linkedin" aria-hidden="true"></i></a>
                                 </li>
                                 </ul>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  

                  <div class="feedcomments comment_show" id="showComment_<?php echo e($feed_id); ?>">
                     <hr class="mt-0">
                     <?php echo $__env->make('front.feeds.feed_comment_view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  </div>
               <?php elseif($feed['type'] == 0 && $feed['pop_feed_position'] == 2): ?>
                  <?php $i = 6; ?>
                  <?php echo $__env->make('front.feeds.feed_meta_side_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php elseif($feed['type'] == 0 && $feed['pop_feed_position'] == 3): ?>
                  <?php $i = 10; ?>
                  <?php echo $__env->make('front.feeds.feed_meta_side_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php elseif($feed['type'] == 0 && $feed['pop_feed_position'] == 4): ?>
                  <?php $i = 13; ?>
                  <?php echo $__env->make('front.feeds.feed_meta_side_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php elseif($feed['type'] == 0 && $feed['pop_feed_position'] == 6): ?>
                  <?php $i = 17; ?>
                  <?php echo $__env->make('front.feeds.feed_meta_side_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>               
               <?php endif; ?>
            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
   </div>
</div>
<div class="col-md-12 text-center">
   <a href="<?php echo e(url('/')); ?>" class="btn btn-primary w-100">Show More Feeds</a>
</div>
</div>

<div id="youtubeURL" style="display:none;"><iframe id="iframe_data" width="100%" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('feeds_scripts'); ?>


<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop' async='async'></script>

<script type="text/javascript">
   var __st_loadLate=true; //if __st_loadLate is defined then the widget will not load on domcontent ready
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
   $(".WelcomeSetFeed ul li a").on("click",function(){
     $(this).toggleClass("setfeedactive");
   });
</script>
<script>
   $(document).ready(function(){           
      $('[data-toggle="tooltip"]').tooltip();   
   });
   
   var newsletter_flag = '<?php echo e(Session::has("newsletter_flag")); ?>';
   function eventSaveMessage(){
    if(newsletter_flag =="1" || newsletter_flag ==1)
    {
   
      toastr.success("Newsletter Subscriptions updated successfully.");
   }
   
   }
   window.onload = eventSaveMessage;
   
   function favoritesFeed(e,feed_id,type) {
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_favorite')); ?>",
    type: 'post',
    dataType: 'json',
    data: {"_token": "<?php echo e(csrf_token()); ?>",'feed_id':feed_id,'type':type},
    success: function(response) {
       if(response.status ==1) {
         $(e).parent().html('<a href="javascript:void(0)" onclick="favoritesFeed(this,'+feed_id+',0)"><i class="fa fa-star checked" aria-hidden="true"></i>  Add to Favorites </a>');
         toastr.success(response.message)
      } else {
         $(e).parent().html('<a href="javascript:void(0)" onclick="favoritesFeed(this,'+feed_id+',1)"><i class="fa fa-star-o" aria-hidden="true"></i>  Add to Favorites </a>');
         toastr.success(response.message)
      }
   }
   });
   }
   
   function likeFeed(e,feed_id,is_like,type,reply_id) {
      var is_like = $(e).children(".is_like_hidden").val();
      $.ajax({
         url: "<?php echo e(route('front.feeds.feed_like')); ?>",
         type: 'post',
         dataType: 'json',
         data: {"_token": "<?php echo e(csrf_token()); ?>",'feed_id':feed_id,'is_like':is_like,'type':type,'reply_id':reply_id},
         success: function(response) {
            $(e).parents().find('.commentCountSection'+feed_id).show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').find('.feedSelfLike').text(response.likeCount);
            $(e).find('.feedSelfLike').text(response.likeCount);
            $(e).parents().find('.commentCountSectionHr'+feed_id).show();
            if(response.status ==1) {
               var img = '<?=  asset("front/images/pop_icons/like_icon.png") ?>';
               $(e).children(".is_Like_Icon").show();
               $(e).children(".is_Un_Like_Icon").hide();
               $(e).children(".is_like_hidden").val(0);
               
               // $(e).children("img").attr('src',img);
               // $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',0,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>'+response.likeCount+'</span></a>');
               //   toastr.success(response.message)
            } else if(response.status == 2){
               $('#popMemberContinue').html(response.view);
               $('#popMemberContinue').modal('show');  
            }else {
               var img = '<?=  asset("front/images/pop_icons/7.png") ?>';
               $(e).children(".is_Un_Like_Icon").show();
               $(e).children(".is_Like_Icon").hide();
               $(e).children(".is_like_hidden").val(1);
               
               // $(e).children("img").attr('src',img);
               // $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',1,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>'+response.likeCount+'</span></a>');
               // toastr.success(response.message)
            }
         }
      });
   }
   
   
   function commentSubmit(e,key) {
      if($('#is_user_login').val() == ''){
         likeFeed('','','','','','');
         return false;
      }
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      $(e)[0].reset();
      toastr.success(data.response);
       $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
       $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
      $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
   }
   }
   });
   }
   
   
   function replyBox(e) {
   $(e).parent().parent().find('.reply-input-box').toggle();
   }
   
   function replySubmit(e,key) {
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      toastr.success(data.response);
      $(e)[0].reset();
       $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
         $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
         $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
         }
      }
   });
   }
   
   function subReplySubmit(e,key) {
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      toastr.success(data.response);
      $(e)[0].reset();
         $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
         $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
         }
      }
   });
   }
   
   function subReplyBox(e,key) {
   $('#sub-reply-box'+key).toggle();
   }
   
   
   function comman_feed_like(e,comment_id,feed_id,reply_id,type) {
   // alert(comment_id);
     $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment_like')); ?>",
    type: 'post',
    dataType: 'json',
    data: {"_token": "<?php echo e(csrf_token()); ?>",'comment_id':comment_id,'feed_id':feed_id,'reply_id':reply_id,'type':type},
    success: function(data) {
      if(data.success ==0) {
         //  toastr.error(data.response);
         $('#popMemberContinue').html(data.view);
         $('#popMemberContinue').modal('show');  
      } else {
            if(data.like_type == 1) {
               var source = "<?php echo e(asset('front/images/pop_icons/like_icon.png')); ?>";
               $(e).children(".is_Like_Icon").show();
               $(e).children(".is_Un_Like_Icon").hide();
               
               $(e).children('img').attr('src',source);
               $(e).children('.replyLikesCount').text(data.totalCount);
            } else {
               var source = "<?php echo e(asset('front/images/pop_icons/7.png')); ?>";
               $(e).children(".is_Un_Like_Icon").show();
               $(e).children(".is_Like_Icon").hide();

               $(e).children('img').attr('src',source);
               $(e).children('.replyLikesCount').text(data.totalCount);
            }
         //  toastr.success(data.response);
      }
   }
   });
   }
   
   
   function feedPreferenceModel() {
   $.ajax({
   url: "<?php echo e(route('front.feeds.feed_preference')); ?>",
   type: 'post',
   dataType: 'json',
   data: {"_token": "<?php echo e(csrf_token()); ?>"},
   success: function(response) {
     $('#DefaultModal').modal('show');
     $('#DefaultModal .modal-dialog').addClass('modal-lg');
     $('#DefaultModal .modal-content').html(response.view);
   }
   });
   }
   
   function moreRoleNav(e) {
   var lavelExpand = $(e).text();
   if(lavelExpand == 'Expand >>') {
     $(e).text('Collapse >>');
   } else {
     $(e).text('Expand >>');
   }
   $(".moreRoleNav").toggleClass("showNavPreference");
   
   }
   
   function moreCategoryNav(e) {
   var lavelExpand = $(e).text();
   if(lavelExpand == 'Expand >>') {
     $(e).text('Collapse >>');
   } else {
     $(e).text('Expand >>');
   }
   $(".moreCategoryNav").toggleClass("showNavPreference");
   
   }
   
   function prefereceForm(e) {
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_preference_search')); ?>",
    type: 'post',
    data: $('#feedPrefenceForm').serialize(),
    dataType: 'json',
    success: function(response) {
      if(response.status == 1){
         location.reload();
         return false;
         $('#DefaultModal').modal('hide');
         $('.MiddleColumnSection').html(response.view);
      }
     }
   });
   }
   
   
   
   function replyInputshow(e,id) {
   $(e).parents().find('.media-body').find('.commentReplyInput'+id).show();
   var x =$(e).parents().find('.media-body').find('.commentReplyInput'+id).find('.writeReply'+id).focus();
   }
   
   function commentToggle(e) {
   $(e).parent().parent().parent().parent().find('.feedcomments').toggle();
   }
   function viewAllReply(e) {
   $(e).parent().find('.hidViewAllComment').val(1);
   $(e).parent().find('.feedCommentMainBox').show();
   $(e).remove();
   }
   
   function feedActiveComment(e,id) {
      // if($('#is_user_login').val() == ''){
      //    likeFeed('','','','','','');
      //    return false;
      // }
      $('#showComment_'+id).toggleClass('comment_show');
      $(e).parents().find('.mainCommentActive').find('.commentWrite'+id).focus();
   }
   
   function share_post(e,id,feed_url){
      if($('#share-btn'+id).hasClass('is_show')){
         $('#share-btn'+id).removeClass('is_show');
         $('#share-btn'+id).show();
         $('#share-btn'+id+' div.st-btn').show();

         // var url = 'https://graph.facebook.com/v12.0/?scrape=true&id='+feed_url+'access_token=EAAF4ZBilMxJQBAFukX8GWwmavmVExrxj1Hjckf0S13SNZCmRqk5hzuWZBLmJMj870TvrvGc2r6ETclxhIpIq2gfOBabLBNKa5ITMZBQ0CnQdP92ZAHLSD9dFeZCiJG019CVZBxTRbP4ApPvz9BFy4z11nQUph3KtyB50e4ZCPAro64ClkpoGhd2nT20MfG3bHNro3qI0driZAQAZDZD';
         // $.ajax({
         //    type:'POST',
         //    url: url,
         //    success: function(data){
         //       console.log(data);
         //    }
         // });
         // console.log(url);
      }else{
         $('#share-btn'+id).addClass('is_show');
         $('#share-btn'+id).hide();
         $('#share-btn'+id+' div.st-btn').hide();
      }
      
      
   }
   
   function replyInputshow1(e,id) {
    $(e).parents().find('.media-body').find('.commentReplyInput1'+id).show();
   var x =$(e).parents().find('.media-body').find('.commentReplyInput1'+id).find('.writeReply'+id).focus();
   }

   function checkQuiz(val,id){
      var checkValue  = $(val).find('input').val();
      var str_background_color_new;
      //alert(checkValue);
      //   var int_which_is_lie = document.getElementById("which_is_lie"+id).value; 
        var int_which_is_lie = $("#which_is_lie"+id).val(); 
      
         document.getElementById("div-id-select-lie"+id).style.display ="none";
        document.getElementById("div-id-select-truth"+id).style.display ="none";
      
      document.getElementById("question_id").value = checkValue;
      
      if(int_which_is_lie == checkValue)
      {
          str_background_color_new = 'quizBgGreen';
      //   document.getElementById("div-id-select-lie"+id).style.display ="block";
        $("#div-id-select-lie"+id).show();
      }
      else
      {
         str_background_color_new = 'quizBgRed';
            //   document.getElementById("div-id-select-truth"+id).style.display ="block";         
              $("#div-id-select-truth"+id).show();         
      }
      
      $( "#mainDivId_"+(checkValue+id) + " #childDivId_"+(checkValue+id)  ).addClass( str_background_color_new );
   
     
    }
   
   
   // Event Form
   // $(document).on('click', '#submitQuiz', function (e) {
   //    e.preventDefault();
      
   // });

   function quiz_play(e){
      $('.playBtnQuiz1').find('.st_loader').show();
      var fd = $(e).serialize(); 
      $.ajax({
         url: "<?php echo e(route('front.feeds.feed_truth_data')); ?>",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         data: $(e).serialize(),
         dataType: 'json',
         type: 'POST',
         beforeSend: function () {
            $('#submitQuiz').attr('disabled', true);
            // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
         },
         error: function (jqXHR, exception) {
            $('#submitQuiz').attr('disabled', false);
            $('.playBtnQuiz1').children('.st_loader').hide();
            var msg = formatErrorMessage(jqXHR, exception);
            toastr.error(msg)
            console.log(msg);
            // $('.message_box').html(msg).removeClass('hide');
         },
         success: function (data) {
            if(data.status == 1){
               $('#submitQuiz').attr('disabled', false);
               $('.QuizBox').html(data.view);
            }else if(data.status == 2){
               $('#submitQuiz').attr('disabled', false);
               $('.quizPlay').html(data.view);
            }else if(data.status == 0){
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal('show');  
            }
            $('.playBtnQuiz1').children('.st_loader').hide();
            //toastr.success("Quiz Saved Successfully.");
            // window.location.replace('<?php echo e(route("front.pages.quiz.detail")); ?>');
         }
      });
   }

   function videoPopup(e,youtube_id){
      $('.PreLoader').show();
      var video_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      $('#iframe_data').attr('src','https://www.youtube.com/embed/'+youtube_id);
      video_data += $('#youtubeURL').html(); 
      $('#DefaultModal').addClass('showYouTubeVideo');     
      $('#DefaultModal .modal-content').html(video_data);
      setTimeout(function(){         
         $('#DefaultModal').modal({backdrop: 'static', keyboard: false}); 
         $('.PreLoader').hide();
      },1000);
   }

   function imagePopup(e){
      var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      img_data += $(e).html();
      $('#DefaultModal').removeClass('showYouTubeVideo'); 
      $('#DefaultModal .modal-content').html(img_data);
      $('#DefaultModal').modal('show');
   }

   var main_gallery_url_new = "<?php echo e(url('feeds')); ?>"; 
   var create_gallery_url_new = "<?php echo e(url('all/image-gallery/create')); ?>"; 
   var delete_gallery_url_new = "<?php echo e(url('all/image-gallery/delete')); ?>";
   var gallery_data_saved_flag = '';
   
   function openEditGalleryModal(id,type) {
      $('.st_gallery_loading').show();
     $.ajax({
        url: "<?php echo e(route('front.gallery.images.edit_modal_list')); ?>",
       data: {
        "_token": "<?php echo e(csrf_token()); ?>",
      'id':id,'file_type':'edit','type':type,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
         var modal_gallery_form = '#ModalGalleryVideoForm';
            $(modal_gallery_form).show();
             $('#ModalGalleryVideoForm .modal-content').html(data.view);
            $(modal_gallery_form).css('display', 'block');
            $(modal_gallery_form).modal({ show: true });
            $('#DefaultModal').modal('hide');        
            $('.st_gallery_loading').hide();            
        }
     });
   }
   
   function feedAction(id,type,div_id) {
      var err = 0;
      if(type == 'remove' || type == 'delete'){
         if(confirm('Are you sure you want to '+type+' this feed?')){
            var err = 0
         }else{
            var err = 1;
         }
      }
      if(err == 0){
         $.ajax({
            url: "<?php echo e(route('front.feeds.feed_action_type')); ?>",
            data: {
            "_token": "<?php echo e(csrf_token()); ?>",
            'id':id,'action_type':type
            },
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                  if(data.status == 1){
                     toastr.success(data.msg);
                     $('#'+div_id).remove();
                  }else if(data.status == 2){
                     $('#DefaultModal .modal-content').html(data.view);
                     $('#DefaultModal').modal('show');        
                  }    
            }
         });
      }
   }

   function show_more(e){
      $(e).parent().toggleClass('four-line-text');
      
      if($(e).parent().hasClass("four-line-text")){
         $(e).text('More');
      }else{
         $(e).text('Less');
      }

      // if($('.pContents').not("four-line-text")){
      //    $('.pContents').addClass("four-line-text");
      //    $('.readMore').text('More');
      // }
      // if($(e).text() != 'Less'){
      //    $(e).parent().toggleClass('four-line-text');
      // }
      
      // if($(e).parent().hasClass("four-line-text")){
      //    $(e).text('More');
      // }else{
      //    $(e).text('Less');
      // }
      
   }

   function copySharingUrl(url) {
     var $temp = $("<input>");
     $("body").append($temp);
     $temp.val(url).select();
     document.execCommand("copy");
     $temp.remove();
     toastr.success('Copied to Clipboard Successfully');
   }

   function textAreaAdjust(element) {
      element.style.height = "1px";
      element.style.height = (16+element.scrollHeight)+"px";
   }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>