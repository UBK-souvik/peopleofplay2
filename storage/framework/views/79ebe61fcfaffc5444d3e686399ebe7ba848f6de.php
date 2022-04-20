<div class="popFeedImagePreview">
  <div class="col-ting my-4">
    <div class="control-group file-upload error-demo" id="file-upload1">
      <div class="image-box text-center">
        <div class="image-box-text" id="videoPreviewIcon">
          <div class="popFeedIcon">
            <img src="<?php echo e(asset('front/images/feed/feed_videos.png')); ?>" class="img-fluid mb-1">
          </div>
          <!-- <span class="btn"><i class="fa fa-plus" aria-hidden="true"></i> Add Video</span> -->
        </div>
        <img src="" alt="" id="thumbNailPreview" class="img-fluid uploadimg">
      </div>
      <div class="controls" style="display: none;">
        <input type="file" name="contact_image_1" />
        <!-- <input type="hidden" name="image_name" class="imageName" value="1627285465.jpg"  id="crop_img"> -->
      </div>
      <span class="errText" style="display:none;"></span>
    </div>
  </div>
</div>
<div class="popFeedTitle">
  <div class="form-group">
    <input id="VideoUrl" type="text" name="video_url" class="form-control" value="<?php echo e(@$feeds->video_url); ?>" placeholder="Video URL" onchange="getYoutubeThumbnailfeed(this);">
    <span class="errText" style="display:none;"></span>
  </div>
</div>
<div class="popFeedTitle">
  <div class="form-group">
    <input id="title" type="text" name="title" class="form-control" value="<?php echo e(@$feeds->title); ?>" placeholder="Title">
    <span class="errText" style="display:none;"></span>
  </div>
</div>
<div class="popFeedCaption ">
  <div class="form-group ">
    <textarea class="form-control " rows="3" id="Caption" placeholder="Caption" value=" " name="caption"><?php echo e(@$feeds->caption); ?></textarea>
  </div>
</div>

<script>

  $(document).ready(function(){ 
    setTimeout(function(){
      var youtube_url = $('#VideoUrl').val();
      if(youtube_url != ''){
        getYoutubeThumbnailNewsfeed(youtube_url);
      }
    },300);

     $("#Caption").on("focusin", function(){
      $("#imagefeedForm").addClass('enter_not_send');
    });
    $("#Caption").focusout(function(){
      $("#imagefeedForm").removeClass('enter_not_send');
    });
  });

  function getYoutubeThumbnailNewsfeed(youtube_url) {
    $.ajax({
      url: "<?php echo e(route('front.user.gallery.get_youtube_thumbnail')); ?>",
      data: {'_token':'<?php echo e(csrf_token()); ?>','video_url':youtube_url},
      dataType: 'json',
      type: 'POST',
      success: function (data) {
          if(data.success == 1){
            $('#thumbNailPreview').attr('src',data.thumbnail);
            $('#thumbNailPreview').css({'display':'inline'});
            $('#videoPreviewIcon').hide();
          } else {
          $('#add-gallery-image-upload-preview-onevideo').attr('src','');
          $('#thumbNailPreview').css({'display':''});
          $('#videoPreviewIcon').show();
          toastr.error(data.msg);
        }
      }
    });
  }

</script>