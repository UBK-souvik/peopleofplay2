<?php 
   $sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
   $str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;
   $str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
   $i = $offset_i; $k = 0;

   // $feeds_cnt = ltrim((count($countFeeds) - count($newfeeds3)),'-');
   $feeds_cnt = count($countFeeds);

   $str_user_name = '';
   $str_user_url_new = '#';
   $str_profile_image = '';
   if(!empty($question_detail[0]->user_id)){ 
         @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
         @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
         @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
   }
?> 
   <?php if($feeds_cnt > 0): ?>
      <?php $__currentLoopData = $feeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php 
         
            $feed_id = $feed['id']; 
            $i++; 
                  
            $cat_url = 'javascript:void(0)';
            if($feed['type'] == 1){
               $category = 'IMAGE';
            }elseif($feed['type'] == 2){
               $category = 'VIDEO';
            }elseif($feed['type'] == 3){
               $category = 'BLOG';
               $cat_url = url('blog/'.$feed['blog_slug']);
            }elseif($feed['type'] == 4){
               if($feed['check_post'] == '3'){
                  $category = 'WIKI';
                  $cat_url = 'wiki';
               }elseif($feed['check_post'] == '4'){
                  $category = 'ENTERTAINMENT';
                  $cat_url = 'entertainment';
               }elseif($feed['check_post'] == '5'){
                  $category = 'CAST';
                  $cat_url = 'popcast';
               }else{
                  $category = 'MEDIA-MENTION';
               }
            }
         ?>
         <div class="popFeedPost w-100 py-4 border-bottom <?php echo e($i); ?>" id="feed-main-box<?php echo e($feed['id']); ?>">
            <input type="hidden" class="i_position" value="<?php echo e($i); ?>">
            <div class="feedCategory d-flex pb-3">
               <h6><span><?php echo e($feed['category_name']); ?></span></h6>
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
                        <?php endif; ?>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
            
            <?php if($feed['type'] != 6): ?>
               <?php if(($feed['video_url'] != '' || $feed['url'] != '' || $feed['image'] != '')): ?>
                  <div class="feedVidImg w-100 mt-3 <?php echo e($feed['type']); ?>">
                     <?php if(!empty($feed['video_url'])): ?>
                        <?php 
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                        ?>
                        <iframe src="https://www.youtube.com/embed/<?php echo @$match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     <?php else: ?>
                        <?php if($feed['image'] != ''): ?>
                           <a href="javascript:void(0)" onclick="imagePopup(this); return false;">
                              <?php if(($feed['type'] == 3) && $feed['check_post'] == 0): ?>)
                                 <img src="<?php echo e(url('/uploads/images/feed/'.$feed['image'])); ?>" alt="No Image Found" class="img-fluid">
                              <?php else: ?>
                                 <img src="<?php echo e(url('/uploads/images/feed/'.$feed['image'])); ?>" alt="No Image Found" class="img-fluid">
                              <?php endif; ?>
                           </a>
                        <?php endif; ?>
                     <?php endif; ?>
                     <?php if($feed['url'] != ''): ?>
                        <?php if($feed['type'] == 1 || $feed['type'] == 2 || $feed['type'] == 4): ?>
                           <?php if($feed['image'] == ''): ?>
                              <a href="<?php echo e($feed['url']); ?>" class="feedOlnyText" target="_blank"><?php echo e($feed['url']); ?> </a>
                           <?php else: ?>
                              <a href="<?php echo e($feed['url']); ?>" target="_blank"><?php echo e($feed['url']); ?> </a>
                           <?php endif; ?>
                        <?php endif; ?>
                     <?php endif; ?>
                  </div>
               <?php else: ?>
                  <hr>
               <?php endif; ?>
               <div class="feed-tag mt-2">
                  <ul class="nav tag-list">
                  <?php if($feed['tag']) {
                     $feedTags = explode(',',$feed['tag']);
                     ?>
                  <?php $__currentLoopData = $feedTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                     <a class="nav-link" href="#">#<?php echo e($tags); ?></a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php  } ?>
                  <?php  $companies_id =explode(',',$feed['tag_companies']); 
                     if(!empty($companies_id) && count($companies_id)>0) {
                     $companies = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',3)->whereIn('id',$companies_id)->get()->toArray();  ?>
                  <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo e(url('company/'.$company->slug)); ?>">#<?php echo e($company->first_name .$company->last_name); ?></a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php } ?>
                  <?php  $product_id =explode(',',$feed['tag_products']); 
                     if(!empty($product_id) && count($product_id)>0) {
                     $products = DB::table('products')->select('products.id','products.name','products.slug')->whereIn('id',$product_id)->get()->toArray();   ?>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo e(url('product/'.$product->slug)); ?>">#<?php echo e($product->name); ?></a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php } ?>
                  <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                     if(!empty($peoples_id) && count($peoples_id)>0) {
                     $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',2)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                  <?php $__currentLoopData = $peoples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $people): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo e(url('people/'.$people->slug)); ?>">#<?php echo e($people->first_name .$people->last_name); ?></a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php } ?>
                  </ul>
               </div>
               <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
                  <hr class="mb-0">
                  <?php @$ProfOptsComments = 'display:none'; ?>
                  <?php if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id'],'news_feeds') >0): ?>
                  <?php @$ProfOptsComments = ''; ?>
                  <?php endif; ?>
                  
                  <hr class="my-0 commentCountSectionHr<?php echo e(@$feed['id']); ?>" style="<?php echo e(@$ProfOptsComments); ?>">
                  
                  <ul class="list-unstyled likeLists m-0">
                     <?php 
                     $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'news_feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                     
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
                        <span class="feedSelfLike"><?php echo e(@App\Helpers\Utilities::feedCommentLikeCount($feed['id'],'comment','0','news_feeds')); ?></span>
                     </a>
                     </li>
                     <li>
                     <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'<?php echo e($feed_id); ?>')">
                        <img src="<?php echo e(asset('front/images/pop_icons/6.png')); ?>" class="igm-fluid">
                        <span class="commentCount"><?php echo e(@App\Helpers\Utilities::feedCommentCount($feed['id'],'news_feeds')); ?></span>
                     </a>
                     </li>
                       
                  </ul>
               </div>
               <div class="feedcomments comment_show" id="showComment_<?php echo e($feed_id); ?>">
                  <hr class="mt-0">
                  <?php echo $__env->make('front.feeds.feed_comment_view', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               </div>
            <?php endif; ?>
         </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>