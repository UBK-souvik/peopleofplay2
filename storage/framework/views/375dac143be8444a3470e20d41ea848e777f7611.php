<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">
<style>
   .kform_control .form-control {
   display: block;
   width: 100%;
   padding: 10px .75rem;
   font-size: 12px;
   line-height: 1;
   color: #495057;
   background-color: #fff;
   background-clip: padding-box;
   border: 1px solid #ced4da;
   border-radius: .25rem;
   transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
   }
   .kform_control .select2-container--default .select2-selection--single {
   min-height: 28px;
   font-size: 12px;
   }
   .kform_control label {
   display: inline-block;
   margin-bottom: 0.4rem;
   font-size: 13px !important;
   font-weight: 600;
   } 
   .kform_control select.form-control:not([size]):not([multiple]) {
   /*height: calc(1.90rem);*/
   }
   .kform_control .btn {
   font-size: 12.5px;
   }
   #gallery-main-div-id-new .select2-container .select2-selection--multiple {
   /*max-height: 33px;*/
   width: 305px;
   }
   .kform_control .div-image-upload-gallery-class {
   margin: 5px 0px 0px 0px; 
   }
   .PopAllGallery .modal-header {
   position: absolute;
   border-bottom: unset;
   right: 0;
   z-index: 99;
   }
   .PopAllGallery .modal-header .close {
   padding: .5rem;
   margin: -1rem -1rem -1rem auto;
   }
   .wrapalldiv {
   padding: 50px 30px 0 30px;
   }
   @media  only screen and (max-width: 567px) {
   #gallery-main-div-id-new .select2-container .select2-selection--multiple {
   max-height: 35px;
   width: 266px;
   }
   }
</style>

<?php
$user_current_info = get_current_user_info();
$role_type_id = 0;
$int_type_of_user = 0;
if(!empty($user_current_info->role))
{
$role_type_id = $user_current_info->role; 
}
if(!empty($user_current_info->type_of_user))
{
$int_type_of_user = $user_current_info->type_of_user; 
}
?>

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body modal-product">
            <div class="wrapalldiv">
               <div class="row">
                  <div class="col-12">
                     <?php if($gallery_type == 1): ?>
                     <div class="form-group">
                        <div>
                           
                              <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                              <?php $__currentLoopData = $arr_destinations_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_destinations_list_key => $arr_destinations_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                              <?php if($arr_destinations_list_key == 4 || $arr_destinations_list_key == 3): ?>
                                 <?php if(($int_type_of_user ==2) && ($role_type_id == 3)): ?>    
                                 <?php else: ?>
                                    <?php continue; ?>;
                                 <?php endif; ?>
                              <?php endif; ?>

                              <input onchange="return showProdEventDropDownByDest('<?php echo e($gallery_info->id); ?>', this.value);"  type="radio" value="<?php echo e($arr_destinations_list_key); ?>" name="gallery_meta[destination_id]" <?php
                              if (!empty($gallery_info->destination_id) && ($gallery_info->destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; }  ?> > <label> <?php echo e($arr_destinations_list_val); ?></label>
                              
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </div>
                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-lg-6">
                     <?php if($gallery_info->type == 1): ?>
                     <div class="form-group text-center">
                        <div id="file-upload-formsecond" class="uploadersecond">
                           <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                              <div id="div-image-gallery-preview-id">   
                                 <?php if(isset($is_not_gallery) && $is_not_gallery == 1): ?>     
                                 <input type="hidden" value="1" name="is_not_gallery">        
                                 <input type="hidden" value="<?php echo e(@$gallery_info->image); ?>" name="is_image">        
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="<?php echo e(asset('uploads/images/feed/'.@$gallery_info->image)); ?>"  alt="">
                                 <?php else: ?>      
                                 <input type="hidden" value="<?php echo e(@$gallery_info->media); ?>" name="is_image">
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="<?php echo e(@galleryImageBasePath(@$gallery_info->media)); ?>"  alt="">
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                        <?php if($gallery_info->type == 1): ?>
                        <div class="form-group">
                           <div class="div-image-upload-gallery-class">
                              <div class="custom-file">
                                 <input type="file" class="custom-file__input image" id="file-gallery-uploadsecond-new" name="photo" onchange="getImagePreviewReadURL(this,'ModalGalleryVideoForm',1);" accept="image/*" >
                                 <label class="custom-file__label" for="file-gallery-uploadsecond-new">Edit Image</label>
                                 <!-- <input type="hidden" id="photo_img_ID" name="photo" value=""> -->
                              </div>
                           </div>
                        </div>
                        <?php endif; ?>
                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-lg-6">
                     <?php if($gallery_info->type == 1): ?>
                     <div class="form-group mt-4 mt-md-0 <?php if($request_type != 'feeds_edit'): ?><?php echo e('d-none'); ?><?php endif; ?>"">
                        <label for="">Title</label>
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="<?php if(!empty($gallery_info->title)): ?> <?php echo e($gallery_info->title); ?> <?php endif; ?>">
                     </div>
                     <div class="form-group">
                        <label for="">Caption</label>
                        <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" value="" name="gallery_meta[caption]"><?php if(!empty($gallery_info->caption)): ?><?php echo e($gallery_info->caption); ?><?php endif; ?></textarea>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <input type="hidden" id="crop_img" name="crop_img" value="">
               <?php if($gallery_info->type == 2): ?>
               <div class="row">
                  <div class="col-12">
                     <div class="form-group">
                        <div>
                           <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                              <?php $__currentLoopData = $arr_destinations_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_destinations_list_key => $arr_destinations_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($arr_destinations_list_key == 3): ?>
                              <?php continue; ?>;
                              <?php endif; ?>
                              <input onchange="return showProdEventDropDownByDest('<?php echo e($gallery_info->id); ?>', this.value);"  type="radio" value="<?php echo e($arr_destinations_list_key); ?>" name="gallery_meta[destination_id]" <?php
                              if (!empty($gallery_info->destination_id) && ($gallery_info->destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; } if (empty($gallery_info->destination_id) && ($gallery_info->destination_id != $arr_destinations_list_key) && $request_type == 'feeds_edit'){ echo ' disabled'; } elseif($arr_destinations_list_key != 1) { echo ' disabled'; } ?> > <label> <?php echo e($arr_destinations_list_val); ?></label>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div id="file-upload-formsecond" class="uploadersecond">
                        <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                           <div id="div-image-gallery-preview-id">                                  
                              <?php 
                              if(!empty($gallery_info->media)){
                                 preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$gallery_info->media, $match);
                              ?>
                                 <iframe class="video_iframe" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="<?php echo e(asset('front\new\images\default_video.jpg')); ?>"  alt="" style="display:none;">
                              <?php }else{ ?>
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="<?php echo e(asset('front\new\images\default_video.jpg')); ?>"  alt="">
                              <?php } ?>                                 
                           </div>
                        </div>
                     </div>
                     <div class="form-group mt-4">
                        <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="<?php if(!empty($gallery_info->media)): ?> <?php echo e($gallery_info->media); ?> <?php endif; ?>" placeholder="Video URL" oninput="getYoutubeThumbnail(this);">
                        <small style="font-size:10px; color:red;"> Upload YouTube links only. Upload other links to Media.</small>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group <?php if($request_type != 'feeds_edit'): ?><?php echo e('d-none'); ?><?php endif; ?>">
                        <label for="">Title</label>
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="<?php if(!empty($gallery_info->title)): ?> <?php echo e($gallery_info->title); ?> <?php endif; ?>">
                     </div>
                     <div class="form-group">
                        <label for="">Caption</label>
                        <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" name="gallery_meta[caption]"><?php if(!empty($gallery_info->caption)): ?><?php echo e($gallery_info->caption); ?><?php endif; ?></textarea>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-md-12 assign-prod-event-drop-down-class" <?php if(!empty($gallery_info->assign_product_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-gallery-event-product-div<?php echo e($arr_destinations_list_keys[1]); ?>">
                  <div class="form-group">
                     <!--  <label for="product-tag-id">Assign to Product</label> <span class="text-danger">*</span> -->
                     <label for="">Select Product</label>
                     <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
                        <option value="">Select Product</option>
                        <?php $__currentLoopData = $user_product_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_product_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($gallery_info->assign_product_id) && ($gallery_info->assign_product_id == $user_product_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_product_row->id); ?>">
                        <?php echo e($user_product_row->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6 assign-prod-event-drop-down-class" <?php if(!empty($gallery_info->assign_brand_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?> id="assign-gallery-event-product-div<?php echo e($arr_destinations_list_keys[3]); ?>">
               <div class="form-group">
                  <!-- <label for="brand-tag-id">Assign to Brand</label> <span class="text-danger">*</span> -->
                  <label for="">Select Brand</label>
                  <select name="gallery_meta[assign_brand_id]" class="form-control" data-placeholder="Select">
                     <option value="">Select Brand</option>
                     <?php $__currentLoopData = $user_brand_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_brand_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option <?php if(!empty($gallery_info->assign_brand_id) && ($gallery_info->assign_brand_id == $user_brand_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_brand_row->id); ?>">
                     <?php echo e($user_brand_row->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
               </div>
            </div>
            <div class="col-md-12 assign-prod-event-drop-down-class" <?php if(!empty($gallery_info->assign_event_id)): ?> <?php echo e("style=display:block;"); ?> <?php else: ?> <?php echo e("style=display:none;"); ?> <?php endif; ?>  id="assign-gallery-event-product-div<?php echo e($arr_destinations_list_keys[2]); ?>">
            <div class="form-group">
               <!--  <label for="product-tag-id">Assign to Event</label> -->
               <label for="">Select Event</label>
               <select name="gallery_meta[assign_event_id]" class="form-control" data-placeholder="Select">
                  <option value="">Select Event</option>
                  <?php $__currentLoopData = $user_event_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_event_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php if(!empty($gallery_info->assign_event_id) && ($gallery_info->assign_event_id == $user_event_row->id)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($user_event_row->id); ?>">
                  <?php echo e($user_event_row->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </select>
            </div>
         </div>
      </div>
      <div class="mt-2">
         <div class="row">
            <div class="col-lg-6">
               <!--  <div class="form-group">
                  <div>
                     <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag">
                        
                        <?php $__currentLoopData = $company_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_index => $company_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($arr_companies[$int_gallery_id]) && in_array($company_index, $arr_companies[$int_gallery_id])): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($company_index); ?>">
                        <?php echo e($company_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div> -->
               <div class="form-group">
                  <div>
                     <label for="">Tag Products</label>
                     <select name="products[]" class="custom-select select2" multiple data-placeholder="Tag Products">
                        
                        <?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_index => $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($arr_products) && in_array($product_index, $arr_products)): ?><?php echo e('selected'); ?>  <?php endif; ?>  value="<?php echo e($product_index); ?>">
                        <?php echo e($product_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>
                  <div class="form-group">
                  <div>
                     <label for="">Tag Companies</label>
                     <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag Companies">
                        
                        <?php $__currentLoopData = $company_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_index => $company_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($arr_companys) && in_array($company_index, $arr_companys)): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($company_index); ?>">
                        <?php echo e($company_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group">
                  <label for="">Tag People</label>
                  <div>
                     <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Tag People">
                        
                        <?php $__currentLoopData = $people_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $people_index => $people_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(!empty($arr_peoples) && in_array($people_value->id, $arr_peoples)): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($people_value->id); ?>">
                        <?php echo e(ucwords($people_value->first_name.' '.$people_value->last_name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <div class="modal-footer border-top-0 d-flex justify-content-right">
      <input type="hidden" name="gallery_meta[gallery_id]" value="<?php if(!empty($int_gallery_id)): ?><?php echo e($int_gallery_id); ?> <?php endif; ?>">
      <?php echo csrf_field(); ?>            
      <input id="gallery_link_type" type="hidden" name="gallery_meta[gallery_link_type]" value="<?php if(!empty($gallery_link_type)): ?><?php echo e($gallery_link_type); ?> <?php endif; ?>">
      <input id="gallery_type" type="hidden" name="gallery_meta[gallery_type]" value="<?php if(!empty($gallery_type)): ?><?php echo e($gallery_type); ?> <?php endif; ?>">
      <input id="is_known_for" type="hidden" name="gallery_meta[is_known_for]" value="<?php if(!empty($is_known_for)): ?><?php echo e($is_known_for); ?> <?php endif; ?>">
      
      <span class="mr-3 mt-1"><input type="checkbox" name="feed_check" value="on" <?php if($request_type == 'feeds_edit'): ?><?php echo e('checked disabled'); ?><?php endif; ?>> &nbsp;Share to feed &nbsp;</span>
      <?php if($request_type == 'feeds_edit'): ?>
         <input type="hidden" name="feed_check" value="on">
      <?php endif; ?>
      <?php if(isset($is_not_gallery) && $is_not_gallery == 1): ?>     
         <input type="hidden" value="1" name="is_not_gallery">  
      <?php endif; ?>
      <button type="button" onclick="return gallerySaveSubmitAjax('');" class="btn edit-btn-style gallerySubmitButton">Post <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i> </button>
   </div>
</div>

<script src="<?php echo e(asset('backend/plugins/select2/select2.full.min.js?'.time())); ?>"></script>
<script type="text/javascript">

   $('.select2').select2();

  var bs_modal = $('#modal');
  var image = document.getElementById('blah');
  var cropper,reader,file;

  function getImagePreviewReadURL(e,id='') {

   var bs_modal = $('#modal');
   var image = document.getElementById('image');
   var cropper,reader,file;
   
   $('#'+id).hide();

   $("body").on("change", ".image", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };


    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

   bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
            // viewMode: 3,
            crop(event) {
              console.log(event.detail.x);
              console.log(event.detail.y);
              console.log(event.detail.width);
              console.log(event.detail.height);
              console.log(event.detail.rotate);
              console.log(event.detail.scaleX);
              console.log(event.detail.scaleY);
            },
            preview: '.preview'
          });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
      var val = $(e).val();
      // $('#photo_img_ID').val(val);
   //  $(e).val('').trigger('change');
    $('#'+id).show();
  });

   $('#btnZoomIn').on('click', function () { cropper.zoom(0.1); })
   $('#btnZoomOut').on('click', function () { cropper.zoom(-0.1); })

  $("#crop").click(function() {
     $('.crop_laoder').show();
    canvas = cropper.getCroppedCanvas({
     // width: 160,
     // height: 600,
    });

    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
        var base64data = reader.result;

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo e(route('front.gallery.image.upload')); ?>",
          data: {'image': base64data ,'_token':'<?php echo e(csrf_token()); ?>'},
          success: function(data) {
             $('.crop_laoder').hide();
            bs_modal.modal('hide');
            //$('#blah').attr('src',base64data);
            $('.gallery-upload-preview-class').attr('src', base64data);
            $('#crop_img').val(data.crop_img);
                        // html = '<img src="' + img + '" />';
                        //    $("#preview-crop-image").html(html);
                        // alert("success upload image");
                      }
                 });
      };
    });
  });
}

   // function getImagePreviewReadURL(input,n_n) {
   //  if (input.files && input.files[0]) {
   //      var reader = new FileReader();
   //      reader.onload = function(e) {
   //          $('.gallery-upload-preview-class').attr('src', e.target.result);
   //      }
   //      reader.readAsDataURL(input.files[0]);
   //  }
   // }

function getYoutubeThumbnail(e) {
   //$('#add-gallery-image-upload-preview-one').attr('src','');
   var youtube_url = $(e).val();
    $.ajax({
       url: "<?php echo e(route('front.user.gallery.get_youtube_thumbnail')); ?>",
       data: {'_token':'<?php echo e(csrf_token()); ?>','video_url':youtube_url},
       dataType: 'json',
       type: 'POST',
       success: function (data) {
        if(data.success == 1){
          $('.video_iframe').hide();
          $('#add-gallery-image-upload-preview-one').show();
          $('#add-gallery-image-upload-preview-one').attr('src',data.thumbnail);
          } else {
             $('#add-gallery-image-upload-preview-one').attr('src','<?php echo asset('front/new/images/default_video.jpg'); ?>');
              toastr.error(data.msg);
          }
      }
   });
}


</script>