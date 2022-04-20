
<?php $__env->startSection('style_new'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('front/new_css/feeds.css?'.time())); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('front/new_css/pop-classifieds.css?'.time())); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('front/new_css/quiz.css?'.time())); ?>">
   
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="popFeedBlogs">
      <div class="YTtopContant text-center">
         <img src="<?php echo e(asset('front/images/news_feeds_banner.png')); ?>" alt="WelcomeToPOPWeekHeader" class="img-fluid w-100">
      </div>
      <div class="popStartPosts w-100 pt-4 pb-3 border-bottom">                  
         <div class="popNewsPosts w-100">
            <div class="popNewsFeed">
               <div class="row">
                  <div class="col-md-6">
                     <div class="popNewsImg">
                        <?php if(!empty(@$featured_news_feeds->image)): ?>
                           <img src="<?php echo e(asset('uploads/images/feed/'.@$featured_news_feeds->image)); ?>" class="img-fluid">
                        <?php elseif(!empty(@$featured_news_feeds->video_url)): ?>
                           <?php
                              preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$featured_news_feeds->video_url, $match);
                              $str_og_image_new = 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg';
                           ?>
                           <img src="<?php echo e($str_og_image_new); ?>" class="img-fluid">
                        <?php else: ?>
                           <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="img-fluid">
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="popNewsContent">
                        <h3 class=""><?php echo e(@$featured_news_feeds->title); ?></h3>
                        <div class="newsDesc <?php if(strlen(strip_tags(@$featured_news_feeds->caption)) > 500): ?><?php echo e('four-line-text'); ?> <?php endif; ?>">
                           <p><?php echo e(substr(@$featured_news_feeds->caption, 0, 500).'...'); ?> </p>
                           <?php if(!empty(@$featured_news_feeds->url)): ?>
                              <a href="<?php echo e(@$featured_news_feeds->url); ?>" class="" target="blank">more...</a>
                           <?php else: ?>
                              
                           <?php endif; ?>
                           
                        </div>
                        <div class="newsLinks">
                           <?php if(!empty(@$featured_news_feeds->url)): ?>
                              <a href="<?php echo e(@$featured_news_feeds->url); ?>" class="one-line-text"><?php echo e(@$featured_news_feeds->url); ?></a>
                           <?php endif; ?>
                           <?php if(!empty(@$featured_news_feeds->video_url)): ?>
                              <a href="<?php echo e(@$featured_news_feeds->video_url); ?>" class="one-line-text mt-1"><?php echo e(@$featured_news_feeds->video_url); ?></a> 
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="newsNames pt-4">
               <form  id="newsFeedsForm">
                  <div class="NewsGames py-3">
                     <div>
                        <p>Toy & Game Industry News Courtesy of <a href="javascript:void(0)">The Bloom Report</a></p>
                     </div>
                     <div>
                     <?php if(@$uinfo->is_news_feeds != 1): ?>
                        <div class="submit_news">
                           <input type="hidden" name="submit_post" id="submit_Post" value="1">
                           <button class="btn NewsBtn" onclick="submit_news_feeds_form(this); return false;">Submit News</button>
                        </div>
                     <?php endif; ?>
                     </div>
                  </div>
                  <div class="NewsPostsDats pb-3">
                     <div>
                        <h6><?php echo e(date('F d, Y',strtotime(@$featured_news_feeds->created_at))); ?></h6>
                     </div>
                     <div>
                        <div class="byDateTopic">
                           <label class="date_label" for="daterangepicker">Search by date
                           <input type="text" name="datepicker" class="date_Picker" id="daterangepicker" value="">
                           <input type="hidden" name="is_date_select" id="is_date_select" value="0">
                           </label> 
                           <div class="menuDropdown d-inline-block">
                              <div class="dropdown cq-dropdown" data-name='statuses'>
                                 <a href="javascript:void(0);" class="dropdown-toggle" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Filter by topic</a>
                                 <ul class="dropdown-menu" aria-labelledby="btndropdown">
                                    <ul class="ulDrop">
                                       <?php $__currentLoopData = $feedsCategorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedsCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <li>
                                          <label class="radio-btn"><input type="checkbox"  name="category_filter[]" value="<?php echo e($feedsCategory->id); ?>" class="pe-2" id="categoryFilter"><?php echo e(ucwords($feedsCategory->name)); ?></label>
                                       </li>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <li class="text-center liBtn">
                                          <button type='button' class='btn btn-xs save btn-primary apply_filter' value='Save'>Apply Filter</button>
                                       </li>
                                    </ul>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <form class="<?php if(@$uinfo->is_news_feeds == 1): ?><?php echo e('border-top'); ?><?php endif; ?>">   
            <?php if(@$uinfo->is_news_feeds == 1): ?>
            <div class="feedInputs mt-2">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <img src="<?php echo e(@imageBasePath(@$uinfo->profile_image)); ?>" alt="profileimage" class="img-fluid rounded-circle">
                  </div>
                  <input type="text" class="form-control startPostInput" placeholder="Start a Post" onclick="feedtype('1');" readonly>
               </div>
            </div>
            <div class="feedIconsLists">
               <ul class="list-unstyled IconsLists m-0 viewIconsLists">
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
               </ul>
            </div>

            <input type="hidden" name="submit_post" id="submit_Post" value="0">
            <?php endif; ?>
            
            <input type="hidden" name="page_type" id="page_type" value="news_feeds">
            <input type="hidden" name="offset" id="offSet" value="1">
            <input type="hidden" name="no_user_offset" id="no_user_offset" value="<?php echo e($no_User_Offset); ?>">
            <input type="hidden" name="load_status" id="loadStatus" value="active">
            <input type="hidden" id="is_user_login" value="<?php echo e(@$uinfo->id); ?>">

         </form>        
         
      </div>
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
      <div class="allPostHere w-100 clearfix mb-4">
         <?php $feed_id = @$feeds[0]['id']; ?>
         <div class="popFeedPost w-100 py-4 border-bottom d-lg-none d-block" id="feed-main-box<?php echo e($feed_id); ?>">
            <div class="feedCategory d-flex pb-2">
               <h6><span><b>MEME OF THE DAY</b></span></h6>
            </div>  
            <div class="feedPostContents">
               <div class="feedVidImg w-100">
                  <a href="javascript:void(0)" onclick="memeModel(this,`<?php echo e(@$sidebarData['meme']->id); ?>`)">
                     <img src="<?php echo e(@imageBasePath( @$sidebarData['meme']->featured_image)); ?>" alt="sidebarbanner" class="img-fluid">
                  </a>
               </div>
            </div>     
         </div>
         <div class="filterDiv">
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
            <?php else: ?>
               <div class="text-danger text-center mt-5 mb-5 font-weight-bold">
                  No news feeds available right now!!
                  <input type="hidden" id="no_news_feeds" class="is_news_feeds" value="0">
               </div>

               
            <?php endif; ?>
         </div>
         <!--   -----------------------------------------------------------------   -->
      </div>
      <div class="showMore text-center mb-3">
         <a href="javascript:void(0);" class="d-inline-block" onclick="scroll_feeds(); return false;"><i class="fa fa-spin st_loader st_page_loading st_loadMore" style="display: none;"></i> <b><span class="load_more_span">load more</span></b></a>
      </div>
   </div>
</div>

<div class="col-md-3 col-lg-3 rightSideSection">
   <div class="popFeedSidebar">
      <?php $feed_id = @$feeds[0]['id']; ?>
      <div class="popFeedPost w-100 py-4 border-bottom d-none d-lg-block <?php echo e($i); ?>" id="feed-main-box<?php echo e($feed_id); ?>">
         <input type="hidden" class="i_position" value="<?php echo e($i); ?>">
         <div class="feedCategory d-flex pb-2">
            <h6><span><b>MEME OF THE DAY</b></span></h6>
         </div>  
         <div class="feedPostContents">
            <div class="feedVidImg w-100">
               <a href="javascript:void(0)" onclick="memeModel(this,`<?php echo e(@$sidebarData['meme']->id); ?>`)">
                  <img src="<?php echo e(@imageBasePath( @$sidebarData['meme']->featured_image)); ?>" alt="sidebarbanner" class="img-fluid">
               </a>
            </div>
         </div>     
      </div>
      <?php if($feeds_ad[0]->type == 'top_ad' && !empty($feeds_ad[0]->image)): ?>
      <div class="OptionalAd OptionalAd1 text-center mb-4">
         <a href="<?php if(!empty($feeds_ad[0]->url)): ?><?php echo e($feeds_ad[0]->url); ?><?php else: ?><?php echo e('javascript:void(0)'); ?><?php endif; ?>" target="<?php if(!empty($feeds_ad[0]->url)): ?><?php echo e('_blank'); ?>)<?php endif; ?>">
            <img src="<?php echo e(asset('uploads/images/feeds_ad/'.$feeds_ad[0]->image)); ?>" alt="" width="300px" height="250px">
         </a>
      </div>
      <?php endif; ?>
      <?php if($feeds_ad[1]->type == 'middle_ad' && !empty($feeds_ad[1]->image)): ?>
      <div class="OptionalAd OptionalAd2 text-center mb-4">
         <a href="<?php if(!empty($feeds_ad[1]->url)): ?><?php echo e($feeds_ad[1]->url); ?><?php else: ?><?php echo e('javascript:void(0)'); ?><?php endif; ?>" target="<?php if(!empty($feeds_ad[1]->url)): ?><?php echo e('_blank'); ?>)<?php endif; ?>">
            <img src="<?php echo e(asset('uploads/images/feeds_ad/'.$feeds_ad[1]->image)); ?>" alt="" width="300px" height="600px">
         </a>
      </div>
      <?php endif; ?>
      <?php if($feeds_ad[2]->type == 'bottom_ad' && !empty($feeds_ad[2]->image)): ?>
      <div class="OptionalAd OptionalAd1 text-center mb-4">
         <a href="<?php if(!empty($feeds_ad[2]->url)): ?><?php echo e($feeds_ad[2]->url); ?><?php else: ?><?php echo e('javascript:void(0)'); ?><?php endif; ?>" target="<?php if(!empty($feeds_ad[2]->url)): ?><?php echo e('_blank'); ?>)<?php endif; ?>">
            <img src="<?php echo e(asset('uploads/images/feeds_ad/'.$feeds_ad[2]->image)); ?>" alt="" width="300px" height="250px">
         </a>
      </div>
      <?php endif; ?>
   </div>
</div>

<form id="galleryForm" class="kform_control">
   <div id="ModalGalleryVideoForm" class="modal PopAllGallery" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content"></div>
      </div>
   </div>
</form>

<?php echo $__env->make('front.includes.cropper_model', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
   $(".WelcomeSetFeed ul li a").on("click",function(){
     $(this).toggleClass("setfeedactive");
   });
</script>
<script>
   $(document).ready(function(){
      setTimeout(function(){
         scroll_feeds('doc_ready');
      },2500);
      
      $('[data-toggle="tooltip"]').tooltip();   

      $('.daterangepicker .applyBtn').click(function(){
         $('#is_date_select').val('1');
      });

      $('.daterangepicker .applyBtn, .liBtn .apply_filter').click(function(){
         setTimeout(function() {
            $('#offSetoffSet').val('1');
            newsFeedsFormSubmit();
         }, 500);
      });

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
      var page_type = $('#page_type').val();
      $.ajax({
         url: "<?php echo e(route('front.feeds.feed_like')); ?>",
         type: 'post',
         dataType: 'json',
         data: {"_token": "<?php echo e(csrf_token()); ?>",'feed_id':feed_id,'is_like':is_like,'type':type,'reply_id':reply_id,page_type:page_type},
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
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');

   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');
   $.ajax({
    url: "<?php echo e(route('front.feeds.feed_comment')); ?>",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
    data: {"_token": "<?php echo e(csrf_token()); ?>",'comment_id':comment_id,'feed_id':feed_id,'reply_id':reply_id,'type':type,page_type:'news_feeds'},
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

         var url = 'https://graph.facebook.com/v12.0/?scrape=true&id='+feed_url+'access_token=EAAF4ZBilMxJQBAFukX8GWwmavmVExrxj1Hjckf0S13SNZCmRqk5hzuWZBLmJMj870TvrvGc2r6ETclxhIpIq2gfOBabLBNKa5ITMZBQ0CnQdP92ZAHLSD9dFeZCiJG019CVZBxTRbP4ApPvz9BFy4z11nQUph3KtyB50e4ZCPAro64ClkpoGhd2nT20MfG3bHNro3qI0driZAQAZDZD';
         $.ajax({
            type:'POST',
            url: url,
            success: function(data){
               console.log(data);
            }
         });
         console.log(url);
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

   $(window).scroll(function() {
      scroll_feeds();
   });

   function scroll_feeds(function_type=''){
      $('.showMore .load_more_span').text('load more');

      if($('#no_news_feeds').hasClass('is_news_feeds')){
         $('.showMore').hide();
         return false;
      }

      var load_status = $('#loadStatus').val();
      var offset = $('#offSet').val();
      var no_user_offset = $('#no_user_offset').val();
      var limit = 5;
      var feed_hgt = $(".allPostHere").height();
      var hgt = $(".popFeedPost:nth-last-of-type(2)").height();
      var i_position = $('.allPostHere .popFeedPost:last-child .i_position').val();
      var minus_hgt = feed_hgt - hgt;
      
      var form_ser = $('#newsFeedsForm')[0];
      var formData = new FormData(form_ser);

      formData.append("page_scroll","yes");
      formData.append("offset",offset);
      formData.append("limit",limit);
      formData.append("i_position",i_position);
      formData.append("no_user_offset",no_user_offset);
      
      if(($(window).scrollTop() >= minus_hgt && load_status == 'active') || (function_type == 'doc_ready')){
         if(i_position == null){
            i_position = $(".allPostHere .popFeedPost:nth-last-of-type(2) .i_position").val();
         }
         console.log('i_position - '+i_position+' - hgt - '+hgt);
         $('.st_loadMore').show();
         $('#loadStatus').val('inactive');
         setTimeout(function(){ 
            if($('#loadStatus').val() == 'inactive'){
               $('#loadStatus').val('active');
               $('.showMore .load_more_span').text('Click for reload');
            }
         }, 10000);
         // console.log($(document).height()+' - '+$(window).scrollTop()+' - '+ $(window).height());
         // alert($(document).height());
         $('.showMore').show();
         
         $.ajax({
            url: "<?php echo e(route('front.news-feeds')); ?>",
            headers: {
               'X-CSRF-TOKEN': ajax_csrf_token_new
            },
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
               // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
            },
            error: function (jqXHR, exception) {

               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
               // $('.message_box').html(msg).removeClass('hide');
            },
            success: function (data) {
               if(data.status == 1){
                  if(data.cnt_feeds != 0){
                     $('.allPostHere .filterDiv').append(data.view);
                     $('#offSet').val(data.offset);
                     $('#no_user_offset').val(data.noUserOffset);
                     $('#loadStatus').val('active');
                     $('.no_more_post').remove();
                  }else if(data.cnt_feeds == 0){
                     $('.showMore').hide();
                  }
               }
               $('.st_loadMore').hide();
            }
         });
         
      }
   }

   function imagePopup(e){
      var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      img_data += $(e).html();
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

   function show_more_feature(e){
      $(e).parent().toggleClass('newsDescMore');
      
      if($(e).parent().hasClass("newsDescMore")){
         $(e).text('less');
      }else{
         $(e).text('more');
      }      
   }

   function newsFeedsFormSubmit(){
      var form_ser = $('#newsFeedsForm')[0];
      var formData = new FormData(form_ser);
      $.ajax({
         url:"<?php echo e(route('front.news_feeds_filter')); ?>",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         type:"POST",
         data: formData,
         processData: false,
         contentType: false,
         dataType:'json',
         success:function(data){
            if(data.status == 1){
               if(data.cnt_feeds != 0){
                  $('.filterDiv').html(data.view);
               }else{
                  toastr.warning('News feeds not present on filter criteria','Warning');
               }
            }
         }
      });
   }

   function submit_news_feeds_form(e){
      $.ajax({
         url:"<?php echo e(route('front.submit_news_feeds_form')); ?>",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         type:"POST",
         data: {},
         dataType:'json',
         success:function(data){
            if(data.status == 1){
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal({backdrop: 'static', keyboard: false}); 
            }else{
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal('show'); 
            }
         }
      });
   }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>