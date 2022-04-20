
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
  @media (max-width: 767px) {
     select#blogCategory {
       width: 100%; 
       float: unset; 
  }
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
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="containerWidth">
      <div class="left-column colheightleft border_right BlogListPage">
         <div class="First-column bg-white">
            <div class="col-md-12">
               <div class="row sectionBox" style="border-top: 1px solid transparent;">
                  <div class="col-md-9 px-0 order-1 order-md-1">
                     <h1 class="Tile-style w-100 mb-0">
                     <?php if(Request::segment(1) == 'wiki'): ?> 
                     <?php 
                      $str_read = 'Wiki';
                      echo $str_read1 = 'Wiki - '. $category->name;
                      $str_cate_url = 'wiki';
                     ?>
                     <?php elseif(Request::segment(1) == 'entertainment'): ?>
                      <?php 
                       @$str_read = 'Entertainment';
                      echo $str_read1 = 'Entertainment - '. $category->name;
                      $str_cate_url = 'entertainment';
                       ?>
                        <?php elseif(Request::segment(1) == 'popcast'): ?>
                      <?php 
                       @$str_read = 'POPcast';
                      echo $str_read1 = 'POPcast - '. $category->name;
                      $str_cate_url = 'popcast';
                       ?>
                     <?php else: ?>
                     <?php 
                      $str_read = 'Rest In Play';
                      echo $str_read = 'Rest In Play - '. $category->name;
                      $str_cate_url = 'rest-in-play';
                     ?>
                     <?php endif; ?>
                     </h1>
                  </div>
                  <div class="col-md-3 px-0 order-2 order-md-2">
                        <div class="w-100 blog_Selectcategories text-md-right text-md-center">
                        <div class="BlogCategories mb-4 mb-md-0">
                          <?php if(isset($categories) && !empty($categories)): ?>
                           <select class="form-control " id="blogCategory" onchange="categoryFilter(this);">
                              <option value=""> -- Select Category -- </option>
                              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(@$cate_row->slug == Request::segment(2)) { echo 'selected'; } ?> value="<?php echo e(@$cate_row->slug); ?>"> <?php echo e(@$cate_row->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                           <?php endif; ?>
                        </div>
                     </div>
                     <!--  -->
                  </div>
               </div>
            </div>
            <?php if(!empty($data) && count($data)>0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              @$str_user_name = App\Helpers\Utilities::getUserName($row->user);
             @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $row->user);
            ?>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <div class="col-sm-4 col-md-5 col-lg-3 pl-0">
                     <div class="image-width justifly-content-center">
                        <a href="<?php echo e(url($row->url)); ?>" class="sec_head_text">
                        <img src="<?php echo e(@imageBasePath($row->featured_image)); ?>" class="img-fluid imgOneSixtyFive">
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-8 col-md-7 col-lg-9 pl-0">
                     <div class="blogparagraph">
                        <a href="<?php echo e(url($row->url)); ?>" class="blogNewsTitle text-dark">
                           <h2 class="text-left blogNewsTitle mb-0"><?php echo e(@$row->title); ?></h2>
                        </a>
                        <span class="span-text-grey"><a href="javascript:void(0);">
                          <?php if(@$row->authore_no_profile !=''): ?>
                          <a href="javascript:void(0);">
                          <?php echo e(@$row->authore_no_profile); ?> <?php echo e(' | '); ?>

                        </a>
                          <?php else: ?> 
                          <a target="_blank" href="<?php if(!empty($str_user_url_new)): ?><?php echo e($str_user_url_new); ?><?php else: ?><?php echo e('#'); ?><?php endif; ?>">
                          <?php echo e((!empty(@$str_user_name) ? @$str_user_name.' | ' : '' )); ?>

                        </a>
                          <?php endif; ?>
                            <?php echo e(@$row->created_at); ?> </a></span>
                     </div>
                     <div class="mt-2">
                        <p class="blogPara mt-0 mb-2"><?php echo @App\Helpers\Utilities::getFilterDescriptionHome($row->description, 3); ?> </p>
                        <div>
                           <a href="<?php echo e(url($row->url)); ?>" class="blogReadMore"> Read Full <?php echo e($str_read); ?></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
               <?php echo e($data->links('pagination')); ?>

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
<div class="col-md-3 RightColumnSection">
<!--- ****************** || Category of POP Wiki || **************** --->

<?php if(!empty($categories) && count($categories)>0): ?>
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
    <?php
      if(Request::segment(1)=='wiki') {
        @$category_type = 'Category of POP Wiki';
      } else if(Request::segment(1)=='rest-in-play') {
         @$category_type = 'Decades';
      } else if(Request::segment(1)=='entertainment') {
         @$category_type = 'Category of POP Entertainment';
      } else if(Request::segment(1)=='popcast') {
         @$category_type = 'Category of POP Cast';
      }
    ?>
      <h4 class="mb-0"><?php echo e(@$category_type); ?> </h4>
   </div>
   <div class="PopCategoryList">
      <ul class="nav flex-column">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url(Request::segment(1).'/'.$row->slug)); ?>"> <?php echo e($row->name); ?></a>
         </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
   </div>
</div>
<?php endif; ?>
<!--- ****************** || Category of POP Wiki || **************** --->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   function categoryFilter(e) {
     var id = $(e).val();
     window.location.href = "<?php echo e(url($str_cate_url)); ?>/"+id;
   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>