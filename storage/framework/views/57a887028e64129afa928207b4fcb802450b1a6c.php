<?php 
$sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
$current_url_new = URL::current();  
?> 
<!--- ****************** || Meme of the day || **************** --->


<!--- ****************** || Meme of the day || **************** --->
<!--- ****************** || Recent Blogs || **************** --->
<?php if(isset($sidebarData['recentBlogsList']) && count($sidebarData['recentBlogsList'])>0): ?>
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Blogs</h4>
   </div>
   <hr>
   <?php 
   $str_blog_detail = 'front.pages.blog.detail'; 
   ?>
   <?php $__currentLoopData = $sidebarData['recentBlogsList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentBlogs_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(route($str_blog_detail, $recentBlogs_row->slug)); ?>">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="<?php echo e(@newsBlogImageBasePath($recentBlogs_row->featured_image)); ?>" alt="Blog Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1"><?php echo e($recentBlogs_row->name); ?></h6>
            <p class="mb-0"> <?php echo e($recentBlogs_row->title); ?></p>
         </div>
      </div>
   </a>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <hr>
   <a href="<?php echo e(url('blog_pedia')); ?>" class="text-center d-block">See more</a>
</div>
<?php endif; ?>
<!--- ****************** || Recent Blogs || **************** --->
<!--- ****************** || Recent WIKI || **************** --->
<?php if(isset($sidebarData['recentWikiList']) && count($sidebarData['recentWikiList'])>0): ?>
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Wiki</h4>
   </div>
   <hr>
   <?php 
   ?>
   <?php $__currentLoopData = $sidebarData['recentWikiList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowWiki): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e($rowWiki->url); ?>" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="<?php echo e(@imageBasePath($rowWiki->featured_image)); ?>" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1"><?php echo e($rowWiki->wikiCategory->name); ?></h6>
            <p class="mb-0"> <?php echo e($rowWiki->title); ?></p>
         </div>
      </div>
   </a>
   <hr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(url('wiki')); ?>" target="_blank" class="text-center d-block">See more</a>
</div>
<?php endif; ?>
<!--- ****************** || Recent WIKI || **************** --->
<!--- ****************** || Recent POP Entertainments || **************** --->
<?php if(isset($sidebarData['recentEntertainmentList']) && count($sidebarData['recentEntertainmentList'])>0): ?>
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Entertainment</h4>
   </div>
   <hr>
   <?php 
   ?>
   <?php $__currentLoopData = $sidebarData['recentEntertainmentList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowEntertainment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(@$rowEntertainment->url); ?>" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="<?php echo e(@imageBasePath($rowEntertainment->featured_image)); ?>" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1"><?php echo e($rowEntertainment->entertainmentCategory->name); ?></h6>
            <p class="mb-0"> <?php echo e($rowEntertainment->title); ?></p>
         </div>
      </div>
   </a>
   <hr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(url('entertainment')); ?>" target="_blank" class="text-center d-block">See more</a>
</div>
<?php endif; ?>
<!--- ****************** || Recent POP Entertainments || **************** --->
<!--- ****************** || Recent POP Cast || **************** --->
<?php if(isset($sidebarData['recentCastList']) && count($sidebarData['recentCastList'])>0): ?>
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent POPcast</h4>
   </div>
   <hr>
   <?php 
   ?>
   <?php $__currentLoopData = $sidebarData['recentCastList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowCast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(@$rowCast->url); ?>" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="<?php echo e(@imageBasePath($rowCast->featured_image)); ?>" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1"><?php echo e($rowCast->entertainmentCategory->name); ?></h6>
            <p class="mb-0"> <?php echo e($rowCast->title); ?></p>
         </div>
      </div>
   </a>
   <hr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(url('popcast')); ?>" target="_blank" class="text-center d-block">See more</a>
</div>
<?php endif; ?>
<!--- ****************** || Recent POP Cast || **************** --->
<?php if(!empty($home_product_data->id)): ?>
<?php 
$str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;  
?>
<div class="w-100 HappyDay py-2">
   <div class=" HappyDayBorder">
      <div class="d-flex justify-content-between mt-2 px-3">
         <div class="HappyTopHeader">
            <h2 class="text-left HappyTopHeading" style="font-size: 20px;">Today is...</h2>
         </div>
         <div class="dropdown socialDropdown">
            <span class="fontWeightSix myDropdownBtn" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
            <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
               <ul class="dropSocialShare">
                  <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_product_home_page_url_new');"><i class="fa photo_icon fa-clone"></i></a></li>
                  <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(@$str_home_product_page_url_new); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                  <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(@$str_home_product_page_url_new); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(@$str_home_product_page_url_new); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                  <li><a target="_blank" href="https://wa.me/?text=<?php echo e(@$str_home_product_page_url_new); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <hr>
      <div class="HappyProduct px-4">
        <span class="text-left" style="font-size: 17px;"><?php echo e(App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_one)); ?></span>
      </div>
      <div class="text-center mt-1">
         <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)); ?>"><img src="<?php echo e(@imageBasePath(@$home_product_data->main_image)); ?>" class="img-fluid"></a>
      </div>
      <div class="col-md-12 mt-2 view-btn">
         <!-- <p class="mb-0 mr-1" style="float: left;"><?php echo e(App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_two)); ?> </p> -->
         <div class="my-2 text-right" style="width: 100%;z-index: 9;cursor: pointer;"><a target="_blank" class="LinkTag" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)); ?>"><?php echo e(App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_two)); ?></a></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<input type="hidden" name="hid_product_home_page_url_new" id="hid_product_home_page_url_new" value="<?php echo e(@$str_home_product_page_url_new); ?>">
<?php endif; ?>
<?php //echo "<pre>"; print_r($home_advertisement_data); die;  ?>
<?php echo $__env->make("front.includes.include_word_of_day", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                      
<?php if(!empty($home_advertisement_data->id)): ?>
<?php
$str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
?>                    
<div class="w-100 TruthsNiceTry">
   <div class=" border-rig-box">
      <div class="advertisement_menu_dropdown">
         <div class="dropdown socialDropdown">
            <span class="fontWeightSix myDropdownBtn" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
            <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
               <ul class="dropSocialShare">
                  <li><a href="javascript:void(0);" onclick="return copyToClipboard('#str_home_advertisement_data_destination_link');"><i class="fa photo_icon fa-clone"></i></a></li>
                  <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e(@$str_home_advertisement_data_destination_link); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                  <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(@$str_home_advertisement_data_destination_link); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e(@$str_home_advertisement_data_destination_link); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                  <li><a target="_blank" href="https://wa.me/?text=<?php echo e(@$str_home_advertisement_data_destination_link); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <input type="hidden" name="str_home_advertisement_data_destination_link" id="str_home_advertisement_data_destination_link" value="<?php echo e(@$str_home_advertisement_data_destination_link); ?>">
      <div class="text-center">
         <a target="_blank" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$str_home_advertisement_data_destination_link)); ?>"><img src="<?php echo e(@imageBasePath($home_advertisement_data->advertisement_image)); ?>" style="width: 100%;height: 145px;object-fit: cover;border-top-left-radius: 15px;border-top-right-radius: 15px;"></a>
      </div>
      <div class="d-flex justify-content-between mt-2 mb-2 px-3">
         <div class="adver_Image">
            <h2 class="text-left threetruth" style="font-size: 20px;"><?php echo e(App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_advertisement_data->home_caption_one)); ?></h2>
         </div>
      </div>
      <div class="col-md-12 mt-2 view-btn">
         <div class="mb-3" style="width: 100px;float:right;z-index: 9;cursor: pointer;"><a target="_blank" class="spanTag" href="<?php echo e(App\Helpers\UtilitiesFour::get_url_link(@$str_home_advertisement_data_destination_link)); ?>">Click here <i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<?php endif; ?>
<?php 
$sidebar_list = \App\Models\SideBar::where('status', 1)
->orderBy('display_order', 'asc')
->get();
$int_count_company_flag = 0;    
?>
<?php $__currentLoopData = $sidebar_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $sidebar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
<?php if((!empty($sidebar->interviews) && count($sidebar->interviews)>0)             || (!empty($sidebar->videos) && count($sidebar->videos)>0)             || (!empty($sidebar->news) && count($sidebar->news)>0)             || (!empty($sidebar->products) && count($sidebar->products)>0)             || (!empty($sidebar->users) && count($sidebar->users)>0)             || (!empty($sidebar->companies) && count($sidebar->companies)>0)          ): ?>
<?php if($sidebar->title != 'Engaging Play Product' && $sidebar->title != 'Sponsors'){ ?>
<div class="SidebarBox">
   <div class="p-text mb-3">
      <p><?php echo e($sidebar->title); ?> </p>
   </div>
   <hr>
   <div class="row">
      <div class="col-md-12">
         <?php switch($sidebar->type):
         case (1): ?>
         <?php 
         $str_page_name = Request::segment(1);   
         $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
         ->where('page_name', $str_page_name)
         ->first();
         $advertisement_category_id = 1;
         if(!empty($advertisement_category_data->id))
         {
         $advertisement_category_id = $advertisement_category_data->id;   
         }
         $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 2])
         // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
         ->orderBy('id','desc')
         ->first();
         ?>
         <?php if(!empty($advertisement) && isset($advertisement->destination_link)): ?>
         <div class="sideBarImgBox">
            <a href="<?php echo e(@$advertisement->destination_link); ?>" class="span-style1" target="_blank">
               <img src="<?php echo e(@imageBasePath(@$advertisement->advertisement_image)); ?>" class="img-fluid mb-2">
               <h3 class="imgHead pull-right"> <?php echo e(@$advertisement->sponsor_name); ?></h3>
            </a>
         </div>
         <?php endif; ?>
         <?php break; ?>
         <?php case (2): ?>
         <div id="sidebar_div">
            <?php $__currentLoopData = $sidebar->videos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $GetAPI = @GetYoutubeAPI($video->video_link);
            $thumbnail = @$GetAPI['thumbnail']['standard'];
            ?> 
            <div class="item pr-1 pb-1" data-responsive="" data-src="<?php echo e($video->video_link); ?>" data-poster="" data-sub-html="">
               <div>
                  <a href="<?php echo e($video->video_link); ?>" class="p-text1 span-style1" target="_blank">
                     <img src="<?php echo e($thumbnail); ?>" class="img-fluid sidebarvideoimage">
                     <p class="span-white1 mt-2"> <?php echo e($video->content); ?></p>
                  </a>
               </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php break; ?>
         <?php case (3): ?>
         <div class="row">
            <div class="col-md-12">
               <div class="image-width1">
                  <?php $__currentLoopData = $sidebar->news ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="">
                     <a href="<?php echo e(url('/') . '/news/'. @$new->news->slug); ?>" class="text-white"><?php echo e(@$new->news->title); ?></a>
                     <p><small class="textYellow"><?php echo e(@$new->content); ?></small></p>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
         </div>
         <?php break; ?>
         <?php case (4): ?>
         <div class="d-flex flex-wrap" style="display:none !important;">
            <?php $__currentLoopData = $sidebar->products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="image-width1 SponsorsColumn d-flex flex-row justifly-content-center mb-3 w-100">
               <a href="<?php echo e(url('/') . '/product/'. $product->product->slug); ?>" class="p-text1 span-style1">
               <img class="rounded-circle mr-2 sidebarImgCircle" src="<?php echo e(@prodEventImageBasePath($product->product->main_image)); ?>">
               </a>
               <a href="<?php echo e(url('/') . '/product/'. $product->product->slug); ?>" class="p-text1 span-style1">
                  <div class="d-flex align-items-center" style="height:60px">
                     <p class="span-white1 SidebarPara mb-0" ><?php echo e(@$product->content); ?></p>
                  </div>
               </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php break; ?>
         <?php case (5): ?>
         <div class="SideBarImgGallery d-flex flex-wrap">
            <?php $__currentLoopData = $sidebar->users ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $base_url = url('/');
            $user_current_info_new = $users->user;
            $str_user_name = '';
            if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
            {
            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
            }
            else
            {
            $str_user_url_new = "#"; 
            }
            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
            ?>
            <div class="GalleryImageSideBar">
               <a href="<?php echo e(@$str_user_url_new); ?>" class="p-text1 span-style1">
                  <img src="<?php echo e(@imageBasePath($users->user->profile_image)); ?>" class="imgsideBarCompnay" class="img-fluid">
                  <p><small class="textYellow"><?php echo e(@$users->content); ?></small></p>
               </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php break; ?>
         <?php case (6): ?>
         <div class="">
            <?php $__currentLoopData = $sidebar->companies ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             
            <?php
            $base_url = url('/');
            $user_current_info_new = $users->user;
            $str_user_name = '';
            if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
            {
            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
            }
            else
            {
            $str_user_url_new = "#"; 
            }
            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
            $str_company_content = $users->content;
            ?>
            <div class="image-width1 d-flex flex-row justifly-content-center mb-3">
               <a href="<?php echo e(@$str_user_url_new); ?>" class="p-text1 span-style1">
               <img class="rounded-circle mr-2 sidebarImgCircle" src="<?php echo e(@imageBasePath($users->user->profile_image)); ?>">
               </a>
               <a href="<?php echo e(@$str_user_url_new); ?>" class="span-style1">
                  <div class="d-flex align-items-center" style="height:56px">
                     <p class="span-white1 mb-0" >
                        <?php if(strlen($str_company_content)>60): ?>
                        <?php echo e(@substr($str_company_content, 0, 60) . '....'); ?>

                        <?php else: ?>
                        <?php echo e(@$str_company_content); ?>  
                        <?php endif; ?> 
                     </p>
                  </div>
               </a>
            </div>
            <?php
            $int_count_company_flag++;
            ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php break; ?>
         <?php case (7): ?>
         <div class="row">
            <div class="col-md-12">
               <div class="image-width1">
                  <?php $__currentLoopData = $sidebar->interviews ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $inter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(url('/') . '/featured-article/'. @$inter->interview->slug); ?>">
                     <div class="RecentBlg mb-2 d-flex align-items-center">
                        <div class="RecentBlogImage">
                           <img src="<?php echo e(@newsBlogImageBasePath(@$inter->interview->featured_image)); ?>" alt="Blog Image" class="img-fluid">
                        </div>
                        <div class="RecentBlogPara">
                           <h6 class="mb-1"><?php echo e(App\Helpers\Utilities::getSingleCategoryName('blog_categories', @$inter->interview->category_id ,'name')); ?></h6>
                           <p class="mb-0"> <?php echo e(@$inter->interview->title); ?></p>
                        </div>
                     </div>
                  </a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <hr>
                  <a href="<?php echo e(url('featured-article')); ?>" class="text-center d-block">See more</a>
               </div>
            </div>
         </div>
         <?php break; ?>
         <?php case (8): ?>
         <?php 
         $str_page_name = Request::segment(1);   
         $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
         ->where('page_name', $str_page_name)
         ->first();
         $advertisement_category_id = 1;
         if(!empty($advertisement_category_data->id))
         {
         $advertisement_category_id = $advertisement_category_data->id;   
         }
         $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 3])
         // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
         ->orderBy('id','desc')
         ->first();
         //pr($advertisement_category_data);
         ?>
         <?php if(!empty($advertisement) && isset($advertisement->destination_link)): ?>
         <div class="sideBarImgBox">
            <a href="<?php echo e(@$advertisement->destination_link); ?>" class="span-style1">
               <img src="<?php echo e(@imageBasePath(@$advertisement->advertisement_image)); ?>" class="img-fluid mb-2 fullBanner">
               <h3 class="imgHead"> <?php echo e(@$advertisement->sponsor_name); ?></h3>
            </a>
         </div>
         <?php endif; ?>
         <?php break; ?>
         <?php endswitch; ?>
      </div>
   </div>
</div>
<?php } ?>        <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!-- </div> -->
<style type="text/css">
   a.p-text1.span-style1 {
   color: #fff !important;
   }
</style>