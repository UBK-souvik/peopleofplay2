<!-- <link rel="stylesheet" href="<?php echo e(asset('front/new/css/bootstrap.min.css')); ?>"> -->
<link rel="stylesheet" href="<?php echo e(asset('front/css/select2-bootstrap.css?'.time())); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front/cropperjs-main/croppie.min.css?'.time())); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front/new_css/feed_new.css?'.time())); ?>">
<script src="<?php echo e(asset('front/new/js/croppie.js?.time()')); ?>"></script>


<style type="text/css">
  .upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
  }

  .cr-boundary {
    display: none;
  }
  .cr-slider{
    display: none;
  }
  .upload-result {
    display: none;
  }

  .image-preview {
    display: none;
  }

   .upload-result1 {
    display: none;
  }

  .image-preview1 {
    display: none;
  }

  .btn {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 20px;
    font-weight: bold;
  }

  .upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
  }

  .reset-crop {
    /* width: 100px; */
    font-size: 10px;
    text-align: center;
    font-size: 10px;
    padding: 2px 3px;
  }
  .edit_image_preview{
    display: none;
  }
  .editImagePreview{
    display: block !important;
    object-fit: contain !important;
  }
  .align-items-center {
    -ms-flex-align: center!important;
    align-items: center!important;
    display: flex;
    justify-content: center;
}
.upload-result{
        width: 120px;
        font-size: 12px;
        background-color: #662e91;
        color: #fff;
  }
</style>
  <div class="PreLoader">
    <div class="d-table h-100 w-100">
        <div class="d-table-cell align-middle">
          <i class="fa fa-spin st_loader st_page_loading"></i>
        </div>
    </div>
  </div>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php if($type_of_user == 1 && $role == 1): ?>
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Warning!!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-danger text-center mt-2">
            Yor are a free user, so you are not able to upload any post on feeds. If you want to upload post please upgrade your profile. <b><a href="<?php echo e(route('front.plans', $role)); ?>">Change Plan</a></b>
          </div>
        </div>
      <?php else: ?>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Post <?php echo e(@$title_type); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="feedIconsLists">
            <ul class="nav IconsLists" style="justify-content: space-around;">
              <li>
                <a href="javascript:void(0);" class="nav-link clrYellow viewYellow" onclick="feedTypeChange(this,4);">
                    <img src="<?php echo e(asset('front/images/pop_icons/3.png')); ?>" class="img-fluid">
                    <p>Media</p>
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link clrRed viewRed" href="javascript:void(0);" onclick="feedTypeChange(this,1)" >
                          <img src="<?php echo e(asset('front/images/pop_icons/1.png')); ?>" class="img-fluid">
                    <p class="mb-0">Photo</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link clrOrange viewOrange" href="javascript:void(0);" onclick="feedTypeChange(this,2)">
                          <img src="<?php echo e(asset('front/images/pop_icons/2.png')); ?>" class="img-fluid">
                    <p class="mb-0">Video</p>
                  </a>
              </li>
              <?php if($page_type != 'news_feeds'): ?>
              <li>
                <a href="javascript:void(0);" class="nav-link clrGreen viewGreen" onclick="feedTypeChange(this,5);">
                    <img src="<?php echo e(asset('front/images/feed/feed_product.png')); ?>" class="img-fluid">
                    <p>Product</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="container">
          <div class="popFeedImageForm">
              <form id="imagefeedForm"  onsubmit="feedFormSubmit(this); return false;" method="POST" class="popFeedImage" enctype="multipart/form-data">
                  <input type="hidden" id="feedType" name="type" value="1">
                  <input type="hidden" id="page_type" name="page_type" value="<?php echo e($page_type); ?>">
                  <?php if(!empty($feeds->id)): ?>
                    <input type="hidden" id="request_type" name="request_type_id" value="<?php echo e(@$feeds->id); ?>">
                  <?php else: ?>
                    <input type="hidden" id="request_type" name="request_type_id" value="0">
                  <?php endif; ?>
                  <div class="feedInputsInside">
                    <div class="feedViewData"></div>
                    <div class="row">
                        <div class="col-md-6 ">
                          <div class="form-group ">
                            <div class="popTag ">
                              <input type="text" id="Tag" name="tags" class="form-control" value="<?php echo e(@$feeds->tag); ?>" placeholder="Tags">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="popPeopleTag">
                            <div class="form-group">
                              <select name="peoples[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_peoples = explode(',',@$feeds->tag_peoples);
                              ?>
                              <?php $__currentLoopData = $people_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $people_index => $people_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(!empty($arr_peoples) && in_array($people_value->id, $arr_peoples)): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($people_value->id); ?>"><?php echo e(ucwords($people_value->first_name.' '.$people_value->last_name)); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="popProductsTag">
                          <div class="form-group">
                            <select name="products[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_products = explode(',',@$feeds->tag_products);
                              ?>
                              <?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_index => $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(!empty($arr_products) && in_array($product_index, $arr_products)): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($product_index); ?>"><?php echo e($product_value); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="popCompaniesTag">
                          <div class="form-group">
                            <select  name="companies[]" id="select2-multiple-input-sm" class="form-control input-sm select2-multiple" multiple>
                              <?php 
                                $arr_companys = explode(',',@$feeds->tag_companies);
                              ?> 
                              <?php $__currentLoopData = $company_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_index => $company_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(!empty($arr_companys) && in_array($company_index, $arr_companys)): ?><?php echo e('selected'); ?>  <?php endif; ?> value="<?php echo e($company_index); ?>"><?php echo e($company_value); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
            <div class="popPostBtn text-center mt-2 mb-2">
              <span class="text-left"><input type="checkbox" name="add_to_profile" <?php if(empty(@$feeds->id)): ?><?php echo e('checked'); ?><?php endif; ?> > Add to my profile</span>
              <input type="hidden" name="feed_id" value="<?php echo e(@$feeds->id); ?>">
              <button type="submit" class="btn btn-style-post">POST <i class="fa fa-circle-o-notch fa-spin postLoading" style="display: none;"></i></button>
            </div>
          </form>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script type="text/javascript">

    $('.PreLoader').addClass('pre_loader_show');
    setTimeout(function(){
      var view_type = '<?php echo e($view_type); ?>';
      // alert(view_type);
      if(view_type != 0){
        feedTypeChange(this,view_type)  
      }else{
        feedTypeChange(this,1)  
      }
    },300);
      
    $(document).ready(function () {
      
      $("#imagefeedForm").bind("keypress", function (e) { 
        if(!$("#imagefeedForm").hasClass('enter_not_send')){
          if (e.keyCode == 13) {  
            return false;  
          }  
        }   
      }); 
      $("#productfeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      });
      $("#mediafeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      });
      $("#videofeedForm").bind("keypress", function (e) { 
        if (e.keyCode == 13) {  
          return false;  
        }  
      }); 
    });

  $(".popPeopleTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag People ",
    containerCssClass: 'feedSelectInput'
  });
  $(".popProductsTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag Product ",
    containerCssClass: 'feedSelectInput'
  });
  $(".popCompaniesTag .select2-multiple ").select2({
    theme: "bootstrap ",
    placeholder: "Tag Companies ",
    containerCssClass: 'feedSelectInput'
  });
    $(document).ready(function() {
  $('input[name="tags"]').tagsinput({
    trimValue: true,
    confirmKeys: [13, 44, 32],
    focusClass: 'my-focus-class'
  });

  $('.bootstrap-tagsinput input').on('focus', function() {
    $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
  }).on('blur', function() {
    $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
  });
});

    function getYoutubeThumbnailfeed(e) {

 var youtube_url = $(e).val();
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

 

 

      function feedTypeChange(e,type) {
        $('.PreLoader').addClass('pre_loader_show');
        var request_type = $('#request_type').val();
         $.ajax({
          url: "<?php echo e(route('front.feeds.new_post_type')); ?>",
          type: 'post',
          dataType: 'json',
          data: {"_token": "<?php echo e(csrf_token()); ?>",'type':type,request_type_id:request_type},
          success: function(data) {
            $('.feedViewData').html(data.view);
            $('#feedType').val(data.type);
            $('#exampleModalLabel').text('Post '+ data.title_type);
            
            $('.category_Id').parent().removeClass('errCount');
            $('.category_Id').next().html('');
            
            $('li').removeClass('list_active');
            if(type == 1){
              $('.viewRed').parent().addClass('list_active');
            }else if(type == 2){
              $('.viewOrange').parent().addClass('list_active');
            }else if(type == 4){
              $('.viewYellow').parent().addClass('list_active');
            }else if(type == 5){
              $('.viewGreen').parent().addClass('list_active');
            }
            $('.PreLoader').hide();
            $('.PreLoader').removeClass('pre_loader_show');
          }
        });
      }

    </script>
   