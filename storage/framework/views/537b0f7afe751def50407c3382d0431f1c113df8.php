<div class="popFeedImagePreview">
  <div class="col-ting my-4">
    <div class="control-group file-upload cropie-demo" id="file-upload1">
      <div class="image-box text-center" >
        <div class="image-box-text <?php if(!empty(@$news_Feeds->image)): ?><?php echo e('edit_image_preview'); ?><?php endif; ?>">
          <div class="popFeedIcon">
            <img src="<?php echo e(asset('front/images/feed/feed_images.png')); ?>" class="img-fluid mb-1">
          </div>
          <div class="upload-btn-wrapper">
            <button type="button" class="btn"><i class="fa fa-plus" aria-hidden="true"></i>Add Image <small class="text-danger">(680 * 500)</small></button>
            <input type="file" class="imagefeed btn upload-file" name="photo" value="Add Image">
          </div>
          <!--   <span class="btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Image</span> -->
        </div>
        <?php if(!empty(@$news_Feeds->image)): ?>
          <img src="<?php echo e(asset('uploads/images/feed/'.@$news_Feeds->image)); ?>" alt="" class="img-fluid uploadimg viewImagePreview editImagePreview">
        <?php else: ?>
          <img src="" alt="" class="img-fluid uploadimg viewImagePreview">
        <?php endif; ?>          
        <input type="hidden" name="image_name" class="imageName crop_img1" value="<?php echo e(@$news_Feeds->image); ?>">
      </div>
      <span class="errText" style="display:none;"></span>
    </div>
  </div>
</div>
<div class="form-group text-center">
  <button type="button" class="btn btn-sm btn-success upload-result d-none">Upload Image</button>
  <div id="image-preview" class="image-preview" style="background:#e1e1e1;padding:30px;height:300px; margin-bottom: 20px;">
  </div>
</div>
<div class="form-group text-center  <?php if(empty(@$news_Feeds->image)): ?><?php echo e('edit_image_preview'); ?><?php endif; ?> ">
  <button type="button" class="btn btn-info btn-sm reset-crop" onclick="resetCrop(this);" style="margin-top:2%;">Re-Upload</button>
</div>

<div class="popFeedTitle">
  <div class="form-group">
    <input id="Title" type="text" name="title" class="form-control" placeholder="Title" value="<?php echo e(@$news_Feeds->title); ?>">
    <span class="errText" style="display:none;"></span>
  </div>
</div>
<div class="popFeedCaption">
  <div class="form-group">
    <textarea class="form-control" rows="3" id="Caption" placeholder="Caption" value="" name="caption"><?php echo e(@$news_Feeds->caption); ?></textarea>
  </div>
</div>

<script src="<?php echo e(asset('front/new/js/croppie.js?.time()')); ?>"></script>
 <script type="text/javascript">
  
  
  $(document).ready(function(){     
    $("#Caption").on("focusin", function(){
      $("#imagefeedForm").addClass('enter_not_send');
    });
    $("#Caption").focusout(function(){
      $("#imagefeedForm").removeClass('enter_not_send');
    });
  });
  
  $uploadCrop = $('.cropie-demo').croppie({
    enableExif: true,
    viewport: {
      width: 300,
      height: 300,
      type: 'square'
      // type: 'circle'
    },
    boundary: {
      width: 300,
      height: 300
    },
    orientationControls: {
        enabled: true,
        leftClass: '',
        rightClass: ''
    },
    resizeControls: {
        width: true,
        height: true
    },
    customClass: '',
    showZoomer: true,
    enableZoom: true,
    enableResize: true,
    mouseWheelZoom: true,
    enableExif: true,
    enforceBoundary: true,
    enableOrientation: true,
    enableKeyMovement: true,
    update: function () { }
  });


  $('.upload-file').on('change', function() {
    $('.image-box').hide();
    $('.cr-boundary').show();
    $('.cr-slider').show();
    $('.upload-result').show();
    $('.reset-crop').show();
    $('.reset-crop').parent().show();

    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result,
        // points:[x1, y1, x1, y1],
      }).then(function() {
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });


  $('.upload-result').on('click', function(ev) {
    crop_upload_image();
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function crop_upload_image(e){
    var upload_file = $('.upload-file').val();
    var submit_post_val = $('#submit_Post').val();
    if(upload_file == ''){
      newsFeedFormSubmit_2(e);
      if(submit_post_val == 0){
        $('.cropie-demo').addClass('errCount');
        $('.cropie-demo .errText').html('The image name field is required.');
        $('.cropie-demo .errText').show();
      }
      return false;
    }else if($('.crop_img1').val() != ''){
      newsFeedFormSubmit_2(e);
      if(submit_post_val == 0){
        $('.cropie-demo').removeClass('errCount');
        $('.cropie-demo .errText').hide();
      }
      return false;
    }

    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'original'
    }).then(function(resp) {
      var formData = new FormData($('#imagefeedForm')[0]);
      formData.append("_token", "<?php echo e(csrf_token()); ?>");
      formData.append("image", resp);
      $.ajax({
        url: "<?php echo e(route('front.feeds_news.croppie-image-post')); ?>",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          html = '<img width="250" class="img-fluid" src="' + resp + '" />';
          $(".image-preview").html(html);
          $('.image-preview').show();
          $('.cr-slider').hide();
          $('.crop_img1').val(data.image_name);
          $('.cr-boundary').hide();
          $('.upload-result').hide();
          // $('.reset-crop').show();
          newsFeedFormSubmit_2(e);
        }
      });
    });
  }

  function resetCrop(e) {
    $('.image-box-text').removeClass('edit_image_preview');
    $('.viewImagePreview').removeClass('editImagePreview');
    $('.image-box').show();
    $('.image-preview').hide();
    $('.reset-crop').hide();
    $('.crop_img1').val('');
    
    $('.cr-boundary').hide();
    $('.cr-slider').hide();
    $('.upload-file').val('');
 }
 </script>