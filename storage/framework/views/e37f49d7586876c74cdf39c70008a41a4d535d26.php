<?php $__env->startSection('content'); ?>

<?php
$base_url = url('/');
$int_count_related_blog_flag = 0;
$str_current_url =  url()->current();

$str_blog_description = '';

if(!empty($blog->description))
{
 $str_blog_description = $blog->description;
}

if(!empty($str_blog_description))
{
  $find_text = ['contenteditable="true"', 'type="text"'];
  $replace_text   = ['', ''];
  $str_blog_description = str_replace($find_text, $replace_text, $str_blog_description);
}


while( strpos($str_blog_description, '<p><br></p><p><br></p>') !== FALSE ) {
$str_blog_description = str_replace('<p><br></p><p><br></p>', '<p><br></p>', $str_blog_description);
}

while( strpos($str_blog_description, '<p class="ql-align-center"><br></p><p class="ql-align-center"><br></p>') !== FALSE ) {
$str_blog_description = str_replace('<p class="ql-align-center"><br></p><p class="ql-align-center"><br></p>', '<p class="ql-align-center"><br></p>', $str_blog_description);
}

//$str_blog_description = preg_replace("/+/", "", $str_blog_description);

?>
<style type="text/css">

  .ql-editor {
    white-space: normal!important;
  }

  .ql-align-right
  {
    text-align:right;
  }

  .ql-align-left
  {
    text-align:left;
  }

  .ql-align-center
  {
    text-align:center;
  }
    </style>
    <div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
      <div class="container-width">
       <div class="left-column colheightleft">
        <div class="First-column bg-white blogparagraph border_right">
         <div class="col-md-12 " >
           <div class="row sectionTop">
            <div class="col-sm-10 px-0">
              <h2 class="text-left blogDetHead">
                <?php echo e($blog->title); ?>

                <?php
                @$str_user_name = App\Helpers\Utilities::getUserName($blog->user);
                $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $blog->user);
                ?>
                <!-- <span class="span-text-grey">By: <?php echo e((!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )); ?> </span> -->
              </h2>
              <div class="mb-0">
                <p class="mb-0 span-text-grey" ><span class="span-text-grey">by <a class="span-text-grey" target="_blank" href="<?php if(!empty($str_user_url_new)): ?><?php echo e($str_user_url_new); ?><?php else: ?><?php echo e('#'); ?> <?php endif; ?>"><?php echo e((!empty(@$str_user_name) ? @$str_user_name : 'People Of Play' )); ?> </a></span> <small class="span-text-grey ml-0 blogDate"> | <?php echo e(@App\Helpers\Utilities::getDateFormat($blog->created_at)); ?></small>
                </p>
                <p class="mb-0 span-text-grey" ><small class="span-text-grey ml-0 blogDate"><?php if(!empty($blog_category_name)): ?><?php echo e(@$blog_category_name); ?><?php endif; ?></small>
                </p>
              </div>
            </div>
            <div class="col-sm-2 px-0 text-sm-right">
              <div>
                <div class="dropdown socialDropdown SocialShareBlog mr-1 mt-2">
                  <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> Share <a href="#" class="photo_icon fa fa-share-square-o"></a></span>
                  <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu">
                   <ul class="dropSocialShare">
                    <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_current_url');"><i class="fa photo_icon fa-clone"></i></a></li>
                    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo e($str_current_url); ?>"><i class="fa photo_icon fa-facebook"></i></a></li>
                    <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e($str_current_url); ?>"><i class="fa photo_icon fa-twitter"></i></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/?url=<?php echo e($str_current_url); ?>"><i class="fa photo_icon fa-instagram"></i></a></li>
                    <li><a target="_blank" href="https://wa.me/?text=<?php echo e($str_current_url); ?>"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- <p><small class="span-style DeskMobAlign ml-0 blogDate"><?php if(!empty($blog_category_name)): ?><?php echo e(@$blog_category_name); ?><?php endif; ?> | <?php echo e(@App\Helpers\Utilities::getDateFormat($blog->created_at)); ?></small> </p> -->
          </div>

             <?php /*<div class="blogDetHeadImg mt-4" style="background-image: url('{{@newsBlogImageBasePath($blog->featured_image)}}');">
             </div> */?>
             <div class="col-md-6 ">
              <img src="<?php echo e(@newsBlogImageBasePath($blog->featured_image)); ?>" class="imgDetailBlog">
            </div>

          </div>
        </div>
        <div class="col-md-12">
         <div class="blogDetHeadRow blogDetailDes sectionTop" >
          <!-- p-text blogDetHeadDesc -->
          <p class="text-justify p-text"><?php echo $str_blog_description; ?></p>
        </div>
      </div>
      <div class="col-md-12 mb-5">
       <div class="blogDetHeadRow sectionTop">
        <div class="tags">
          <!-- <strong>Tag: </strong> -->
          <?php $tags = array(); ?>
          <?php if(!empty($blog->tag)): ?>
          <?php $tags = explode(',',$blog->tag); ?>
          <?php endif; ?>

          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="tag_class"> <?php echo $tag; ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php if(!empty($related_blog) && count($related_blog)>1): ?>
<div class="right-column colheightleft backgroundrightforblog px-3 py-3 kright-column" >
  <div class="BlogBottomColumn">
    <h2 class="text-left blogSideHead" >Recent
      <?php if($type_post == "blog"): ?>
      <?php echo e('Blogs'); ?>

      <?php elseif($type_post == 'AdminBlog'): ?>
      <?php echo e('Interviews'); ?>

      <?php elseif($type_post == 'did-you-know'): ?>
      <?php echo e('Did You Knows'); ?>

      <?php else: ?>
      <?php echo e('News'); ?>

      <?php endif; ?>
    </h2>
    <div class="row">
     <?php $__currentLoopData = $related_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_blog_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <?php
     if($blog->id == $related_blog_row->id){
     continue;
   }
   if($type_post == 'AdminBlog')
   {
    $type_post = 'interviews';
  }
  elseif($type_post == 'did-you-know')
  {
    $type_post = 'did-you-know';
  }
  $str_slug = @$related_blog_row->slug;

  $str_slug_url = $base_url . '/' . $type_post . '/' . $str_slug;
  ?>

  <?php if($int_count_related_blog_flag>=4): ?>
  <?php break; ?>;
  <?php endif; ?>
  <div class="col-md-3 col-sm-6">
    <div class="RelatedPost mb-3">
     <a href="<?php echo e($str_slug_url); ?>">
      <img src="<?php echo e(@newsBlogImageBasePath($related_blog_row->featured_image)); ?>" class="img-fluid blogSideImg" >
      <p class="mt-1 blogSideTitle"><?php echo e($related_blog_row->title); ?></p>
    </a>
  </div>
</div>
<?php
$int_count_related_blog_flag++;
?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
<?php else: ?>


<?php endif; ?>
</div>
</div>
</div>
<input type="hidden" name="hid_current_url" id="hid_current_url" value="<?php echo e($str_current_url); ?>">
<?php if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1): ?>
<?php echo $__env->make('front.includes.join_mailing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


<script>
  $(document).ready(function(){
    $('.ql-clipboard').css('display', 'none');
    $('.ql-tooltip').css('display', 'none');
  });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>