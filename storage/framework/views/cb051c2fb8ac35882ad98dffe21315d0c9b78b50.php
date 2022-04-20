
<?php $__env->startSection('content'); ?>
<?php
@$int_chk_is_my_blog_news = App\Helpers\UtilitiesTwo::chkIsMyBlogNews();
?>
<style type="text/css">
   .pagination{
   padding: 10px !important;
   margin: auto !important;
   width: 35% !important;
   }
   @media (max-width: 560px) {
   /*ul.pagination li:not(.show-mobile) {
   display: none;
   }*/
   .pagination {
   margin: 0 !important;
   }
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnFullWidth">
   <div class="containerWidth">
      <div class="left-column colheightleft border_right BlogListPage">
         <div class="First-column bg-white">
            <div class="col-md-12">
               <div class="row sectionBox" style="border-top: 1px solid transparent;">
                  <div class="col-md-5 col-sm-5 col-5 px-0">
                     <h1 class="Tile-style w-100 mb-0">
                        <?php if($type_post=='blog' || $type_post=='blog_pedia'): ?>
                        <?php echo e('Blogs'); ?>

                        <?php elseif($type_post=='AdminBlog'): ?>
                        <?php echo e('Featured Articles'); ?>

                        <?php else: ?>
                        <?php echo e('News'); ?>

                        <?php endif; ?>
                        <?php if(!empty($int_chk_is_my_blog_news)): ?><span class="authername">(<?php echo e($str_user_name .' '); ?>)</span><?php endif; ?>
                     </h1>
                  </div>
                  <div class="col-md-7 col-sm-7 col-7 px-0">
                     <?php //echo "<pre>"; print_r($blog_categories); ?>
                     <div class="w-100 blog_Selectcategories text-right">
                        <div class="BlogCategories">
                           <?php if(isset($blog_categories) && !empty($blog_categories)): ?>
                           <select class="form-control " id="blogCategory" onchange="categoryFilter(this);">
                              <option value=""> -- Select Category -- </option>
                              <?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog_cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(@$blog_cate->id == @$category_id) { echo 'selected'; } ?> value="<?php echo e(@$blog_cate->id); ?>"> <?php echo e(@$blog_cate->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                           <?php endif; ?>
                        </div>
                     </div>
                     <!--  -->
                  </div>
               </div>
            </div>
            <?php if(!empty($blogs) && count($blogs)>0): ?> 
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            if(!empty($blog->blog_data->user))          
            {
            @$str_user_name = App\Helpers\Utilities::getUserName($blog->blog_data->user);
            @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $blog->blog_data->user);
            }
            else
            {
            @$str_user_name = App\Helpers\Utilities::getUserName($blog->user);
            @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $blog->user);             
            }
            @$str_created_at = App\Helpers\Utilities::getDateFormat($blog->created_at);
            if($type_post == 'blog'  || $type_post =='blog_pedia')
            {
            $str_blog_detail = 'front.pages.blog.detail';
            }
            elseif($type_post == 'AdminBlog')
            {
            $str_blog_detail = 'front.pop_blogs.slug';
            }
            elseif($type_post == 'did-you-know')
            {
            $str_blog_detail = 'front.pages.did-you-know.detail';
            }
            else
            {
            $str_blog_detail = 'front.pages.news.detail'; 
            }
            ?>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <div class="col-sm-4 col-md-5 col-lg-3 pl-0">
                     <div class="image-width justifly-content-center">
                        <a href="<?php echo e(route($str_blog_detail, $blog->slug)); ?>" class="sec_head_text">
                        <img src="<?php echo e(@newsBlogImageBasePath($blog->featured_image)); ?>" class="img-fluid imgOneSixtyFive">
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-8 col-md-7 col-lg-9 pl-0">
                     <div class="blogparagraph">
                        <a href="<?php echo e(route($str_blog_detail, $blog->slug)); ?>" class="blogNewsTitle text-dark">
                           <h2 class="text-left blogNewsTitle mb-0"><?php echo e(@$blog->title); ?></h2>
                        </a>
                        <span class="span-text-grey">by: <a target="_blank" href="<?php if(!empty($str_user_url_new)): ?><?php echo e($str_user_url_new); ?><?php else: ?><?php echo e('#'); ?><?php endif; ?>"><?php echo e((!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )); ?> | <?php echo e(@$str_created_at); ?> </a></span>
                     </div>
                     <div class="mt-2">
                        <p class="blogPara mt-0 mb-2"><?php echo @App\Helpers\Utilities::getFilterDescriptionHome($blog->description, 3); ?> </p>
                        <div>
                           <a href="<?php echo e(route($str_blog_detail, $blog->slug)); ?>" class="blogReadMore"> Read Full Blog</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
               <?php echo e($blogs->links('pagination')); ?>

            </div>
            <?php else: ?> 
            <div class="col-md-12 text-center pb-3 font-weight-bold">
                <hr>
                No record found in this category.
                </div>
            <?php endif; ?>
         </div>
         <?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
   </div>
</div>

<div class="col-md-3 px-md-4 RightColumnSection">  
   <div class="right-column k_sidebar right-colom-sidebar">
      <div class="RightSidebarAllPage">
         <?php echo $__env->make('front.includes.home-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
   </div>
</div>

<?php 
if(Request::segment(1) == 'blog_pedia'){
   $searchUrl = Request::segment(1);
} else {
   $searchUrl = Request::segment(1)."/search";
}
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   function categoryFilter(e) {
     var id = $(e).val();
     window.location.href = "<?php echo e(url($searchUrl)); ?>/"+id;
   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>