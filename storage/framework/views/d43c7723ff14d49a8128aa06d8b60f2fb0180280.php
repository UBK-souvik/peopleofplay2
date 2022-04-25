<?php if($str_featured_image_type_new == 'blog'): ?>
<div class="col-md-4">
   <div class="form-group">
      <!-- imgtwoeighty -->
      <img id="blah" src="<?php echo e(@newsBlogImageBasePath(@$blog->featured_image)); ?>" class="img-fluid blogImg">
      <br>
      <div class="PopUploadBtn">
         <input type="file" onchange="readBlogNewsURL_img(this);"  class="custom-file-input1 mt-2 imageBlog" name="featured_image" id="featured_image" accept="image/*">
         <input type="hidden" name="image_priview" id="image_priview" value="<?php echo e(@$blog->featured_image); ?>" />
      </div>
      <div class="ProfileUploadBtn1 text-left">
         <small class="text-danger">Note: Please upload featured blog image (1089px × 612px)</small>
      </div>
   </div>
</div>
<?php endif; ?>
<?php if($str_featured_image_type_new == 'media'): ?>
<div class="col-md-4">
   <div class="form-group">
      <!-- imgtwoeighty -->
      <?php if(!empty(@$media->featured_image)): ?>
         <?php if(@$is_only_feed == 1): ?>
         <img id="blah" src="<?php echo e(asset('uploads/images/feed/'.@$media->featured_image)); ?>" class="img-fluid blogImg">
         <?php else: ?>
         <img id="blah" src="<?php echo e(@mediaImageBasePath(@$media->featured_image)); ?>" class="img-fluid blogImg">
         <?php endif; ?>
      <?php else: ?>
         <img id="blah" src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="img-fluid blogImg">
      <?php endif; ?>
      <br>
      <div class="media-upload">
         <input onchange="readBlogNewsURL(this);" type="file" class="custom-file-input1 mt-2 imageBlog" name="featured_image" id="featured_image" accept="image/*">
      </div>
      <div class="ProfileUploadBtn1 text-left">
         <small class="text-danger ">Note: Please upload 2*1 ratio size image</small>
      </div>
   </div>
</div>
<?php endif; ?>
<?php if($str_featured_image_type_new == 'news'): ?>
<div class="col-md-4">
   <div class="form-group">
      <img id="blah" src="<?php echo e(@newsBlogImageBasePath(@$news->featured_image)); ?>" class="img-fluid blogImg">
      <div class="mt-2">
         <input onchange="readBlogNewsURL(this);" type="file" name="featured_image" class="custom-file-input1 imageBlog" id="featured_image" accept="image/*">
      </div>
      <div class="ProfileUploadBtn1 text-left">
         <small class="text-danger ">Note: Please upload 2*1 ratio size image</small>
      </div>
   </div>
</div>
<?php endif; ?>
<?php if($str_featured_image_type_new == 'award'): ?>
<div class="col-md-4">
   <div class="form-group">
      <!-- imgtwoeighty -->
      <img id="blah" src="<?php echo e(@awardUserImageBasePath(@$media->featured_image)); ?>" class="img-fluid blogImg">
      <br>
      <div class="media-upload">
         <input onchange="readBlogNewsURL(this);" type="file" class="custom-file-input1 mt-2 imageBlog" name="featured_image" id="featured_image" accept="image/*">
      </div>
      <div class="ProfileUploadBtn1 text-left">
         <small class="text-danger ">Note: Please upload 2*1 ratio size image</small>
      </div>
   </div>
</div>
<?php endif; ?>

 <input type="hidden" name="crop_img" id="crop_img" value="">
