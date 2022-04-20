<div class="popFeedProductPreview">
      <div class="col-ting my-4">
        <div class="control-group file-upload error-demo" id="file-upload1">
          <div class="image-box text-center" >
            <div class="image-box-text <?php if(!empty(@$feeds->image)): ?><?php echo e('edit_image_preview'); ?><?php endif; ?>" id="productPreviewIcon">
              <div class="popFeedIcon">
                <img src="<?php echo e(asset('front/images/feed/feed_products.png')); ?>" class="img-fluid">
              </div>
              <!-- <span class="btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</span> -->
            </div>
            <?php if(!empty(@$feeds->image)): ?>
              <img src="<?php echo e(asset('uploads/images/feed/'.@$feeds->image)); ?>" alt="" id="productFeedPreview" class="img-fluid uploadimg viewImagePreview editImagePreview">
            <?php else: ?>
              <img src="" alt="" id="productFeedPreview" class="img-fluid uploadimg viewImagePreview">
            <?php endif; ?>          
            <input type="hidden" name="image_name" class="imageName crop_img1" value="<?php echo e(@$feeds->image); ?>">
           <!--  <input type="hidden" name="image_name" class="imageName crop_img" value="1627285465.jpg"  > -->
          </div>
          <div class="controls" style="display: none;">
            <input type="file" class="image" name="photo" />
          </div>
          <span class="errText" style="display:none;"></span>
        </div>
      </div>
    </div>

    <div class="popFeedTitle">
      <div class="form-group">
        <input id="title" type="text" name="title" class="form-control" value="<?php echo e(@$feeds->title); ?>" placeholder="Title">
        <span class="errText" style="display:none;"></span>
      </div>
    </div>
    <div class="popFeedSelect">
      <div class="form-group">
        <select class="form-control" name="product_id" id="selectproduct" onchange="productChoise(this);">
          <option value="">Select Product</option>
          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option <?php if(@$feeds->product_name == @$row->name): ?><?php echo e('selected'); ?><?php endif; ?> value="<?php echo e(@$row->id); ?>"> <?php echo e(@$row->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <span class="errText" style="display:none;"></span>
      </div>
    </div>
    <div class="popFeedCaption ">
      <div class="form-group ">
        <textarea class="form-control " rows="3" id="Caption " placeholder="Caption " value=" " name="caption"><?php echo e(@$feeds->caption); ?></textarea>
      </div>
    </div>

<script>

  $(document).ready(function(){     
    $("#Caption").on("focusin", function(){
      $("#imagefeedForm").addClass('enter_not_send');
    });
    $("#Caption").focusout(function(){
      $("#imagefeedForm").removeClass('enter_not_send');
    });
  });

</script>