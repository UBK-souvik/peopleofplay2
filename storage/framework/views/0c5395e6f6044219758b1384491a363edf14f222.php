
<?php $__env->startSection('content'); ?>
<?php
$base_url = url('/'); 
$user_current_info = get_current_user_info(); 
$def_user_image_path = App\Helpers\Utilities::get_default_image();
$int_chk_is_event_product_flag = 0;
$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$str_profile_change_plan = @$arr_menu_list['profile_change_plan'];
$str_profile_change_plan = (!empty($str_profile_change_plan)) ? $str_profile_change_plan : $base_url.'/sign-up';
?>
<link href="<?php echo e(asset('backend/plugins/tags.css')); ?>" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style type="text/css">
   .search-gateway-head h1 {
   color: #333333;
   font-size: 20px;
   line-height: 110%;
   margin: 14px 0;
   }
   .search-gateway-head h3, .InterestingKeywords h3 {
   color: #A58500;
   font-size: 15px;
   margin: 0 0 0.5em;
   padding: 0;
   }
   .InterestingKeywords h3{
   font-size: 20px;
   }
   .pop-search-gateway__options {
   display: -webkit-box;
   display: -ms-flexbox;
   display: flex;
   }
   .pop-search-gateway__options,
   .pop-search-gateway__browse {
   margin: 20px auto;
   }
   .pop-search-gateway__link, .pop-search-gateway__link:hover {
   -webkit-box-flex: 1;
   -ms-flex: 1;
   flex: 1;
   margin: 0 15px;
   text-decoration: none;
   }
   .search-gateway-head {
   padding: 0 15px;
   }
   .popArticle {
   border-radius: 12px;
   border: 1px solid #E8E8E8;
   margin-bottom: 7px;
   padding: 10px 12px;
   width: auto;
   background-color: #FFFFFF;
   }
   .imdb-search-gateway__options h4 {
   color: inherit;
   }
   .pop-search-gateway__link h4 {
   color: #333333;
   font-size: 16px;
   margin: 0.35 em 0 0.25 em;
   padding: 0;
   }
   .pop-search-gateway__link p {
   color: #333333;
   font-size: 14px;
   }
   .pop-search-gateway__link p {
   margin: 0.5 em 0 0.75 em;
   line-height: 140%;
   padding: 0;
   }
   .pop-search-gateway__link a {
   color: #662c92;
   text-decoration: none;
   font-size: 14px;
   }
   .pop-search-gateway__link a:hover, .pop-search-gateway__browse a:hover, .full-table ul li a:hover {
   text-decoration: underline;
   }
   .TopicHead h6 {
   font-size: 14px;
   }
   .main-box-body-div{
   border-radius: 12px;
   border: 1px solid #E8E8E8;
   margin-bottom: 7px;
   padding: 10px 12px;
   }
   .full-table {
   width: 50%;
   }
   .full-table ul li a {
   padding: 2px 0px;
   }
   .SearchKeywords {
   border-radius: 12px;
   border: 1px solid #E8E8E8;
   margin-bottom: 6px;
   padding: 10px 12px;
   }
   @media  only screen and (max-width: 991px) {
   .pop-search-gateway__options {
   flex-direction: column;
   }
   @media  only screen and (max-width: 767px) {
   .pop-search-gateway__options {
   flex-direction: unset;
   }
   }
   }
   @media  only screen and (max-width: 600px) {
   .pop-search-gateway__options {
   flex-direction: column;
   }
   }
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column paddingTwenty border_right AdvceSearch">
      <div class="First-column bg-white p-3">
         <!-- New Design -->
         <?php if(!empty(get_current_user_info()->type_of_user) && get_current_user_info()->type_of_user == 2 && !empty(get_current_user_info()->role) && (get_current_user_info()->role == 2 || get_current_user_info()->role == 3)): ?> 
         <div id="pop-main" class="pop-search-gateway">
            <div class="text-center">
            <img src="<?php echo e(asset('front/images/database_advanced_search_header.png')); ?>" alt="profileimage" class="img-fluid">
           </div>
            <div id="pop-header" class="search-gateway-head">
               <h1>Advanced Search</h1>
               <h3>3 Ways to Search</h3>
            </div>
            <div class="pop-search-gateway__options">
               <div class="popArticle pop-search-gateway__link">
                  <h4>Search By Name</h4>
                
                  <a href="javascript:void(0);" onclick="goToByScroll('add-edit-user-main-box-body-div');"> Advanced Search Name</a><br>
                  <a href="javascript:void(0);">Browse Name <i class="fa fa-caret-right ml-2" aria-hidden="true"></i></a>
               </div>
               <div class="popArticle pop-search-gateway__link">
                  <h4>Search By Skills</h4>
                
                  <a href="javascript:void(0);" onclick="goToByScroll('add-edit-user-main-box-body-div2');"> Advanced Search Skills</a><br>
                  <a href="<?php echo e(url('/skills')); ?>">Browse Skills <i class="fa fa-caret-right ml-2" aria-hidden="true"></i></a>
               </div>
               <div class="popArticle pop-search-gateway__link">
                  <h4>Search By Roles</h4>
                
                  <a href="javascript:void(0);" onclick="goToByScroll('add-edit-user-main-box-body-div3');"> Advanced Search Roles</a><br>
                  <a href="<?php echo e(url('/roles')); ?>">Browse Roles <i class="fa fa-caret-right ml-2" aria-hidden="true"></i></a>
               </div>
            </div>
         </div>
         <div class="col-md-12" id="add-edit-user-main-box-body-div">
            <form id="add-edit-user-main-box-body-div" method="post" action="<?php echo e(route('front.home.site.advance.search.data')); ?>">
               <?php echo csrf_field(); ?>
               <!-- <div class="col-md-12"> -->
               <div class="MainBoxBodyEdit" id="add-edit-user-main-box-body-div">
                  <div class="main-box-body-div">
                     <div class="TopicHead text-center my-4">
                        <h4 class="font-weight-normal">Search By Name</h4>
                     </div>
                        <div class="advancedSearchPage">
                           <div class="row">
                              <div class="col-md-12 col-lg-6 col-xl-6">
                                 <div class="form-group mb-0">
                                 <div>
                                    <span class="autocomplete">
                                       <input id="keyword_text_search" type="text" placeholder="Search By Name" name="keyword_text_search" value="" class="form-control skill_get ml-0 w-100">
                                    </span>
                                 </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-lg-6 col-xl-4 col-xl-4">
                                 <div class="d-flex justify-content-start AdvSearchCheckBox">
                                    <div class="mr-3">
                                       <div class="form-group mb-0">                           
                                          <input id="advanced_company_filter_chk" type="checkbox"  value="2" name="advanced_company_filter_chk[]">
                                          <label for="advanced_company_filter_chk" class="mb-0">Companies</label>
                                       </div>
                                    </div>
                                    <div class="mr-3">
                                       <div class="form-group mb-0">                            
                                          <input id="advanced_product_filter_chk" type="checkbox"  value="3" name="advanced_product_filter_chk[]">
                                          <label for="advanced_product_filter_chk" class="mb-0">Products</label>
                                       </div>
                                    </div>
                                    <div class="mr-3">
                                       <div class="form-group mb-0">
                                          <input id="advanced_people_filter_chk" type="checkbox" value="1" name="advanced_people_filter_chk[]">
                                          <label for="advanced_people_filter_chk" class="mb-0">People</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-12 col-xl-2 col-md-2">
                                 <div class="form-group mb-0 pt-lg-2 pt-xl-0">
                                    <button class="btn btnAll" id="search">Search <i class="fa fa-spinner fa-spin postLoading" style="display: none;"></i></button>
                                 </div>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
               <!-- </div> -->
            </form>  
         </div>
         <!-- Name Form-->
         <!-- Skills Form-->
         <div class="col-md-12">
            <div class="MainBoxBodyEdit" id="add-edit-user-main-box-body-div2">
               <div class="main-box-body-div">
                  <div class="TopicHead text-center my-4">
                     <h4 class="font-weight-normal">Search By Skills</h4>
                  </div>
                  <form id="add-edit-user-main-box-body-div2" method="post" action="<?php echo e(route('front.home.site.advance.search.data')); ?>">
                     <?php echo csrf_field(); ?>
                     <div class="advancedSearchPage">
                        <div class="row">
                           <div class="col-md-12 col-lg-6">
                              <div class="form-group mb-0">
                                 <div class="tags-input" id="myTags">
                                    <span class="data">
                                    <?php if(!empty(@$user->skills)): ?>
                                    <?php $explode = explode(',', $user->skills) ?>
                                    <?php $__currentLoopData = $explode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="tag">
                                    <span class="text" _value="Nairobi 047"><?php echo e($val); ?></span><span class="close">&times;</span>
                                    </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </span>
                                    <span class="autocomplete w-100">
                                       <input id="Skills" type="text" name="skills" value="" class="form-control skill_get ml-0" placeholder="Search By Keyword">
                                       <span class="SkillsExample">Example: designer, pumps, robotics...</span>
                                       <div class="autocomplete-items">
                                       </div>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 col-lg-6 col-xl-4">
                                 <div class="d-flex justify-content-start AdvSearchCheckBox">
                                    <div class="mr-3">
                                       <div class="form-group mb-0">                           
                                          <input id="advanced_company_filter_chk" type="checkbox"  value="2" name="advanced_company_filter_chk[]">
                                          <label for="advanced_company_filter_chk" class="mb-0">Companies</label>
                                       </div>
                                    </div>
                                    <div class="mr-3">
                                       <div class="form-group mb-0">                            
                                          <input id="advanced_product_filter_chk" type="checkbox"  value="3" name="advanced_product_filter_chk[]">
                                          <label for="advanced_product_filter_chk" class="mb-0">Products</label>
                                       </div>
                                    </div>
                                    <div class="mr-3">
                                       <div class="form-group mb-0">
                                          <input id="advanced_people_filter_chk" type="checkbox" value="1" name="advanced_people_filter_chk[]">
                                          <label for="advanced_people_filter_chk" class="mb-0">People</label>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                           <div class="col-lg-12 col-xl-2 col-md-2">
                              <div class="form-group mb-0">
                                 <button class="btn btnAll" id="search2">Search <i class="fa fa-spinner fa-spin postLoading2" style="display: none;"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Skills Form-->
         <!-- Roles Form-->
         <div class="col-md-12">
            <div class="MainBoxBodyEdit" id="add-edit-user-main-box-body-div3">
               <div class="main-box-body-div">
                  <div class="TopicHead text-center my-4">
                     <h4 class="font-weight-normal">Search By Roles</h4>
                  </div>
                  <form id="add-edit-user-main-box-body-div3" >
                     <div class="advancedSearchPage">
                        <div class="row">
                           <div class="col-md-12 col-lg-6">
                              <div class="form-group mb-0"> 
                                 <select class="form-control" name="collab_user_role" id="collab_user_role">
                                    <option value="">Select User Role</option>
                                    <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e((@$request->collab_user_role == $key) ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                              </div>
                           </div>
                    
                           <div class="col-md-12 col-lg-6 col-xl-4">
                              <div class="d-flex justify-content-start AdvSearchCheckBox">
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                           
                                       <input id="advanced_company_filter_chk" type="checkbox"  value="2" name="advanced_company_filter_chk[]">
                                       <label for="advanced_company_filter_chk" class="mb-0">Companies</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                            
                                       <input id="advanced_product_filter_chk" type="checkbox"  value="3" name="advanced_product_filter_chk[]">
                                       <label for="advanced_product_filter_chk" class="mb-0">Products</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">
                                       <input id="advanced_people_filter_chk" type="checkbox" value="1" name="advanced_people_filter_chk[]">
                                       <label for="advanced_people_filter_chk" class="mb-0">People</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-12 col-xl-2 col-md-2">
                              <div class="form-group mb-0 pt-lg-2 pt-xl-0">
                                 <button class="btn btnAll" id="search3">Search <i class="fa fa-spinner fa-spin postLoading3" style="display: none;"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Roles Form-->
         <!-- Blogs, Articles, Wiki, POP Cast, Entertainment, Feeds, News-Feeds Form -->
         <div class="col-md-12">
            <div class="MainBoxBodyEdit" id="add-edit-user-main-box-body-div4">
               <div class="main-box-body-div">
                  <div class="TopicHead text-center my-4">
                     <h4 class="font-weight-normal">Search By Contents</h4>
                  </div>
                  <form id="add-edit-user-main-box-body-div4" method="post" action="<?php echo e(route('front.home.site.advance.search.data')); ?>" onsubmit="search_Data(this); return false;">
                     <?php echo csrf_field(); ?>
                     <div class="advancedSearchPage">
                        <div class="row">
                           <div class="col-md-12 col-lg-6 col-xl-10">
                              <div class="form-group mb-0">
                                 <div>
                                    <span class="autocomplete">
                                       <input id="articles" type="text" placeholder="Search By Contents" name="contents" value="" class="form-control skill_get ml-0 w-100">
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-12 col-xl-2 col-md-2">
                              <div class="form-group mb-0">
                                 <button type="submit" class="btn btnAll">Search <i class="fa fa-spinner fa-spin postLoading2" style="display: none;"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 col-lg-6 col-xl-4">
                              <div class="d-flex justify-content-start AdvSearchCheckBox">
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                           
                                       <input id="advanced_filter_chk" type="checkbox"  value="blogs" name="advanced_filter_chk[blogs]">
                                       <label for="advanced_filter_chk" class="mb-0">Blogs</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                           
                                       <input id="advanced_filter_chk" type="checkbox"  value="wiki" name="advanced_filter_chk[wiki]">
                                       <label for="advanced_filter_chk" class="mb-0">Wiki</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                            
                                       <input id="advanced_filter_chk" type="checkbox"  value="pop_cast" name="advanced_filter_chk[pop_cast]">
                                       <label for="advanced_filter_chk" class="mb-0">POP Cast</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">
                                       <input id="advanced_filter_chk" type="checkbox" value="entertainment" name="advanced_filter_chk[entertainment]">
                                       <label for="advanced_filter_chk" class="mb-0">Entertainment</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                           
                                       <input id="advanced_filter_chk" type="checkbox"  value="feeds" name="advanced_filter_chk[feeds]">
                                       <label for="advanced_filter_chk" class="mb-0">Feeds</label>
                                    </div>
                                 </div>
                                 <div class="mr-3">
                                    <div class="form-group mb-0">                            
                                       <input id="advanced_filter_chk" type="checkbox"  value="news_feeds" name="advanced_filter_chk[news_feeds]">
                                       <label for="advanced_filter_chk" class="mb-0">News Feeds</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Blogs, Articles, Wiki, POP Cast, Entertainment, Feeds, News-Feeds Form -->
         <?php else: ?> 
         <p>
            Hey there, it looks like you're trying to use the advanced search, which isn't included 
            in your current POP plan. Upgrading will allow you to search for the people you need 
            based on the skillsets you're after and their area of specialization.
         </p>
         <p> 
            You can easily upgrade to either POP Pro (as an individual) or POP Company (as a company).
         </p>
         <p>
            <a class="btnAll" href="<?php echo e($str_profile_change_plan); ?>">Upgrade My Plan</a>
         </p>
         <?php endif; ?>
      </div>
      <div class="First-column bg-white pt-0" id="advance_search_div" <?php if(empty(@$result_data[0]->name)): ?>style="display:none;" <?php endif; ?>>
         <?php if(!empty($str_category_name)): ?>     
         <div class="wrap-text text-white">
            <p class="m-0" style="font-size: 19px;"><?php if(!empty($str_category_name)): ?> Products in <b>" <?php echo e($str_category_name); ?> "</b> <?php endif; ?></p>
         </div>
         <?php else: ?>       
         <div class="wrap-text text-white">
            <p class="m-0" style="font-size: 19px;"><?php if(!empty($search_data)): ?> Results for <b>" <?php echo e($search_data); ?> "</b> <?php endif; ?></p>
         </div>
         <?php endif; ?>   
         <?php $__currentLoopData = $slug_prefix_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug_prefix_list_key => $slug_prefix_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php $__currentLoopData = $slug_prefix_list_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug_prefix_list_child_key => $slug_prefix_list_child_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if(in_array($slug_prefix_list_key, $arr_type_new)>0 && in_array($slug_prefix_list_child_key, $arr_slug_prefix_new)>0): ?>
         <div class="row">
            <div class="col-md-12">
               <?php if(empty($str_category_name)): ?>
               <h2 class="sidetitleProducttitle1 pt-3"><?php echo e($slug_prefix_list_child_val['type']); ?></h2>
               <?php endif; ?>
               <table class="table event_table HomeSearch">
                  <tbody>
                     <?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php
                     $get_search_url_data = '';
                     $str_title = $result_data_row->name;
                     $str_slug_prefix_data = $result_data_row->slug_prefix;
                     $str_slug_data = $result_data_row->slug;
                     //$int_data_type_index = $result_data_row->data_type_index;
                     $int_type_data = $result_data_row->type;
                     $get_search_url_data = App\Helpers\Utilities::get_search_url_data($base_url, $int_type_data, $str_slug_prefix_data, $str_slug_data);
                     $int_chk_flag = 0;
                     $int_chk_is_blog_flag = '';
                     $int_chk_is_feeds_flag = '';
                     $str_media_data = '';
                     // for a user  
                     if($int_type_data == 1 && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == $slug_prefix_list_child_key)) //{{--   --}}
                     {     
                     $int_chk_flag = 1;   
                     }
                     // for a product or event
                     elseif(($int_type_data == 2 || $int_type_data == 3) && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == 'product' || $str_slug_prefix_data == 'event')) //{{--   --}}
                     {   
                     $int_chk_flag = 1;
                     $int_chk_is_event_product_flag = 1;
                     }
                     // for a blog
                     elseif(($int_type_data == 8) && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == 'blog')) //{{--   --}}
                     {   
                     $int_chk_flag = 1;
                     $int_chk_is_blog_flag = 1;
                     }
                     elseif(($int_type_data == 9 || $int_type_data == 10) && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == 'feeds' || $str_slug_prefix_data == 'news_feeds')) //{{--   --}}
                     {   
                     $int_chk_flag = 1;
                     $int_chk_is_feeds_flag = 1;
                     }
                     else                        
                     {   
                     $int_chk_flag = 0;
                     }                       
                     // for a blog
                     if($int_chk_is_blog_flag>0)
                     {
                     $str_media_data = @newsBlogImageBasePath($result_data_row->image);
                     }
                     // for a product or event
                     else if($int_chk_is_event_product_flag>0)
                     {
                     $str_media_data = @prodEventImageBasePath($result_data_row->image);
                     }
                     else if($int_chk_is_feeds_flag>0)
                     {
                        if(!empty($result_data_row->image)){
                           $str_media_data = @imageBasePath('feed/'.$result_data_row->image);   
                        }else{
                           $str_media_data = asset('front/new/images/Product/team_new.png');   
                        }
                     }
                     // for a user                             
                     else
                     {
                     $str_media_data = @imageBasePath($result_data_row->image);   
                     }
                     ?>
                     <?php if(!empty($int_chk_flag)): ?>                  
                     
                     <tr class="py-0">
                        <td class="pl-0" style="width:50px !important;"><a target="blank" href="<?php echo e($get_search_url_data); ?>" class="dac_name">
                           <?php if(!empty($str_media_data)): ?>
                           <img src="<?php echo e($str_media_data); ?>" class="rounded-circle">
                           <?php endif; ?>
                           </a>
                        </td>
                        <td class=""><a target="blank" href="<?php echo e($get_search_url_data); ?>" class="dac_name"><?php echo e($str_title); ?></a></td>
                     </tr>
                     
                     <?php endif; ?>                             
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
                  </tbody>
               </table>
            </div>
         </div>
         <?php endif; ?>   
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
<script src="<?php echo e(asset('backend/plugins/tags.js')); ?>"></script>
<script>
   function runSuggestions(element,query) {
       /*
       using ajax to populate suggestions
        */
       let sug_area=$(element).parents().eq(2).find('.autocomplete .autocomplete-items');
       $.getJSON("<?php echo e(url('user/profile/getTags')); ?>", { query: query }, function( data ) {
           _tag_input_suggestions_data = data;
           $.each(data,function (key,value) {
               let template = $("<div class='showDropDownSearch'>"+value.name+"</div>").hide()
               sug_area.append(template);
               template.show();
               
           })
       });
   
   }
</script>
<script type="text/javascript">
   $(document).ready(function(){
      $('body').on('click','#add-edit-user-main-box-body-div  #search',function(e){
           e.preventDefault();
           // var skills = [];
           // $( "span.tag" ).each(function( index ) {
           //   console.log( index + ": " + $( this ).find('.text').text() );
           //   skills.push($( this ).find('.text').text());
           // });
           var fd = new FormData($('#add-edit-user-main-box-body-div  form')[0]);
          // fd.append('skills', skills);
   
           $.ajax({
              url:"<?php echo e(route('front.home.site.advance.search.data')); ?>",
            data: fd,
            processData: false,
            contentType: false,
            datatype: 'html',
              type: 'POST',
              beforeSend: function () {
               $('.postLoading').show();
            },
              error: function (jqXHR, exception) {
                  var msg = formatErrorMessage(jqXHR, exception);
                   $('.postLoading').hide();
              },
              success: function (data) {
                  $('#advance_search_div').html(data);
                  $('#advance_search_div').show();  
                   $('.postLoading').hide(); 
                    goToByScroll('advance_search_div')                  
              }
          });          
       });
   
   
      $('body').on('click','#add-edit-user-main-box-body-div2  #search2',function(e){
           e.preventDefault();
           var skills = [];
           $( "span.tag" ).each(function( index ) {
             console.log( index + ": " + $( this ).find('.text').text() );
             skills.push($( this ).find('.text').text());
           });
           var fd = new FormData($('#add-edit-user-main-box-body-div2  form')[0]);
           fd.append('skills', skills);
   
           $.ajax({
              url:"<?php echo e(route('front.home.site.advance.search.data')); ?>",
            data: fd,
            processData: false,
            contentType: false,
            datatype: 'html',
              type: 'POST',
              beforeSend: function () {
                $('.postLoading2').show();
            },
              error: function (jqXHR, exception) {
                  var msg = formatErrorMessage(jqXHR, exception);
                   $('.postLoading2').hide();
              },
              success: function (data) {
                  $('#advance_search_div').html(data); 
                  $('#advance_search_div').show(); 
                   $('.postLoading2').hide();  
                  goToByScroll('advance_search_div')                  
              }
          });          
       });
   
   
   
   
       $('body').on('click','#add-edit-user-main-box-body-div3  #search3',function(e){
           e.preventDefault();
           // var skills = [];
           // $( "span.tag" ).each(function( index ) {
           //   console.log( index + ": " + $( this ).find('.text').text() );
           //   skills.push($( this ).find('.text').text());
           // });
           var fd = new FormData($('#add-edit-user-main-box-body-div3  form')[0]);
           //fd.append('skills', skills);
   
           $.ajax({
              url:"<?php echo e(route('front.home.site.advance.search.data')); ?>",
            data: fd,
            processData: false,
            contentType: false,
            datatype: 'html',
              type: 'POST',
              beforeSend: function () {
               $('.postLoading3').show(); 
            },
              error: function (jqXHR, exception) {
                  var msg = formatErrorMessage(jqXHR, exception);
                  $('.postLoading3').hide(); 
              },
              success: function (data) {
                  $('#advance_search_div').html(data);  
                  $('#advance_search_div').show(); 
                  $('.postLoading3').hide();  
                  goToByScroll('advance_search_div')                 
              }
          });          
       });
   
   
   
   
   });
   
    function goToByScroll(id){
    $('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
   }

   function search_Data(e){
      var fd = new FormData($(e)[0]);
      fd.append('additional_search','yes');

      $.ajax({
         url:"<?php echo e(route('front.home.site.advance.search.data')); ?>",
         data: fd,
         processData: false,
         contentType: false,
         datatype: 'html',
         type: 'POST',
         beforeSend: function () {
            $(e).find('.postLoading2').show(); 
         },
         error: function (jqXHR, exception) {
            var msg = formatErrorMessage(jqXHR, exception);
            $(e).find('.postLoading2').hide(); 
         },
         success: function (data) {
            $('#advance_search_div').html(data);  
            $('#advance_search_div').show(); 
            $(e).find('.postLoading2').hide();  
            goToByScroll('advance_search_div')                 
         }
      });    
   }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>