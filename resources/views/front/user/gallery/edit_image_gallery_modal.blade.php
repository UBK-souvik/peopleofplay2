<link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
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
   @media only screen and (max-width: 567px) {
   #gallery-main-div-id-new .select2-container .select2-selection--multiple {
   max-height: 35px;
   width: 266px;
   }
   }
</style>

@php
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
@endphp

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body modal-product">
            <div class="wrapalldiv">
               <div class="row">
                  <div class="col-12">
                     @if($gallery_type == 1)
                     <div class="form-group">
                        <div>
                           {{-- 
                              <!--  <select onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select"> -->
                           --}}
                              <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                              @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                              {{-- show brand only for a company user --}}
                              @if($arr_destinations_list_key == 4 || $arr_destinations_list_key == 3)
                                 @if(($int_type_of_user ==2) && ($role_type_id == 3))    
                                 @else
                                    @continue;
                                 @endif
                              @endif

                              <input onchange="return showProdEventDropDownByDest('{{ $gallery_info->id }}', this.value);"  type="radio" value="{{$arr_destinations_list_key}}" name="gallery_meta[destination_id]" <?php
                              if (!empty($gallery_info->destination_id) && ($gallery_info->destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; }  ?> > <label> {{ $arr_destinations_list_val }}</label>
                              
                              @endforeach
                           
                        </div>
                     </div>
                     @endif
                  </div>
                  <div class="col-lg-6">
                     @if($gallery_info->type == 1)
                     <div class="form-group text-center">
                        <div id="file-upload-formsecond" class="uploadersecond">
                           <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                              <div id="div-image-gallery-preview-id">   
                                 @if(isset($is_not_gallery) && $is_not_gallery == 1)     
                                 <input type="hidden" value="1" name="is_not_gallery">        
                                 <input type="hidden" value="{{@$gallery_info->image}}" name="is_image">        
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{ asset('uploads/images/feed/'.@$gallery_info->image) }}"  alt="">
                                 @else      
                                 <input type="hidden" value="{{@$gallery_info->media}}" name="is_image">
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$gallery_info->media)}}"  alt="">
                                 @endif
                              </div>
                           </div>
                        </div>
                        @if($gallery_info->type == 1)
                        <div class="form-group">
                           <div class="div-image-upload-gallery-class">
                              <div class="custom-file">
                                 <input type="file" class="custom-file__input image" id="file-gallery-uploadsecond-new" name="photo" onchange="getImagePreviewReadURL(this,'ModalGalleryVideoForm',1);" accept="image/*" >
                                 <label class="custom-file__label" for="file-gallery-uploadsecond-new">Edit Image</label>
                                 <!-- <input type="hidden" id="photo_img_ID" name="photo" value=""> -->
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>
                     @endif
                  </div>
                  <div class="col-lg-6">
                     @if($gallery_info->type == 1)
                     <div class="form-group mt-4 mt-md-0 @if($request_type != 'feeds_edit'){{ 'd-none' }}@endif"">
                        <label for="">Title</label>
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($gallery_info->title)) {{ $gallery_info->title }} @endif">
                     </div>
                     <div class="form-group">
                        <label for="">Caption</label>
                        <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" value="" name="gallery_meta[caption]">@if(!empty($gallery_info->caption)){{$gallery_info->caption}}@endif</textarea>
                     </div>
                     @endif
                  </div>
               </div>
               <input type="hidden" id="crop_img" name="crop_img" value="">
               @if($gallery_info->type == 2)
               <div class="row">
                  <div class="col-12">
                     <div class="form-group">
                        <div>
                           <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                              @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                                 @if($arr_destinations_list_key == 3)
                              @continue;
                              @endif
                              <input onchange="return showProdEventDropDownByDest('{{ $gallery_info->id }}', this.value);"  type="radio" value="{{$arr_destinations_list_key}}" name="gallery_meta[destination_id]" <?php
                              if (!empty($gallery_info->destination_id) && ($gallery_info->destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; } if (empty($gallery_info->destination_id) && ($gallery_info->destination_id != $arr_destinations_list_key) && $request_type == 'feeds_edit'){ echo ' disabled'; } elseif($arr_destinations_list_key != 1) { echo ' disabled'; } ?> > <label> {{ $arr_destinations_list_val }}</label>
                              @endforeach
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

                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{ asset('front\new\images\default_video.jpg') }}"  alt="" style="display:none;">
                              <?php }else{ ?>
                                 <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{ asset('front\new\images\default_video.jpg') }}"  alt="">
                              <?php } ?>                                 
                           </div>
                        </div>
                     </div>
                     <div class="form-group mt-4">
                        <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="@if(!empty($gallery_info->media)) {{ $gallery_info->media }} @endif" placeholder="Video URL" oninput="getYoutubeThumbnail(this);">
                        <small style="font-size:10px; color:red;"> Upload YouTube links only. Upload other links to Media.</small>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group @if($request_type != 'feeds_edit'){{ 'd-none' }}@endif">
                        <label for="">Title</label>
                        <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($gallery_info->title)) {{ $gallery_info->title }} @endif">
                     </div>
                     <div class="form-group">
                        <label for="">Caption</label>
                        <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" name="gallery_meta[caption]">@if(!empty($gallery_info->caption)){{$gallery_info->caption}}@endif</textarea>
                     </div>
                  </div>
               </div>
               @endif
               <div class="row">
                  <div class="col-md-12 assign-prod-event-drop-down-class" @if(!empty($gallery_info->assign_product_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[1] }}">
                  <div class="form-group">
                     <!--  <label for="product-tag-id">Assign to Product</label> <span class="text-danger">*</span> -->
                     <label for="">Select Product</label>
                     <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
                        <option value="">Select Product</option>
                        @foreach ($user_product_data as $user_product_row)
                        <option @if (!empty($gallery_info->assign_product_id) && ($gallery_info->assign_product_id == $user_product_row->id)){{ 'selected' }}  @endif  value="{{$user_product_row->id}}">
                        {{ $user_product_row->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-lg-6 assign-prod-event-drop-down-class" @if(!empty($gallery_info->assign_brand_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[3] }}">
               <div class="form-group">
                  <!-- <label for="brand-tag-id">Assign to Brand</label> <span class="text-danger">*</span> -->
                  <label for="">Select Brand</label>
                  <select name="gallery_meta[assign_brand_id]" class="form-control" data-placeholder="Select">
                     <option value="">Select Brand</option>
                     @foreach ($user_brand_data as $user_brand_row)
                     <option @if (!empty($gallery_info->assign_brand_id) && ($gallery_info->assign_brand_id == $user_brand_row->id)){{ 'selected' }}  @endif  value="{{$user_brand_row->id}}">
                     {{ $user_brand_row->name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-12 assign-prod-event-drop-down-class" @if(!empty($gallery_info->assign_event_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif  id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[2] }}">
            <div class="form-group">
               <!--  <label for="product-tag-id">Assign to Event</label> -->
               <label for="">Select Event</label>
               <select name="gallery_meta[assign_event_id]" class="form-control" data-placeholder="Select">
                  <option value="">Select Event</option>
                  @foreach ($user_event_data as $user_event_row)
                  <option @if (!empty($gallery_info->assign_event_id) && ($gallery_info->assign_event_id == $user_event_row->id)){{ 'selected' }}  @endif  value="{{$user_event_row->id}}">
                  {{ $user_event_row->name }}</option>
                  @endforeach
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
                        {{-- 
                        <option value="">Select</option>
                        --}}
                        @foreach ($company_list as $company_index => $company_value)
                        <option @if(!empty($arr_companies[$int_gallery_id]) && in_array($company_index, $arr_companies[$int_gallery_id])){{ 'selected' }}  @endif value="{{$company_index}}">
                        {{$company_value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div> -->
               <div class="form-group">
                  <div>
                     <label for="">Tag Products</label>
                     <select name="products[]" class="custom-select select2" multiple data-placeholder="Tag Products">
                        {{-- 
                        <option value="">Select</option>
                        --}}
                        @foreach ($product_list as $product_index => $product_value)
                        <option @if (!empty($arr_products) && in_array($product_index, $arr_products)){{ 'selected' }}  @endif  value="{{$product_index}}">
                        {{$product_value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
                  <div class="form-group">
                  <div>
                     <label for="">Tag Companies</label>
                     <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag Companies">
                        {{-- 
                        <option value="">Select</option>
                        --}}
                        @foreach ($company_list as $company_index => $company_value)
                        <option @if(!empty($arr_companys) && in_array($company_index, $arr_companys)){{ 'selected' }}  @endif value="{{$company_index}}">
                        {{$company_value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group">
                  <label for="">Tag People</label>
                  <div>
                     <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Tag People">
                        {{-- 
                        <option value="">Select</option>
                        --}}
                        @foreach ($people_list as $people_index => $people_value)
                        <option @if(!empty($arr_peoples) && in_array($people_value->id, $arr_peoples)){{ 'selected' }}  @endif value="{{$people_value->id}}">
                        {{ ucwords($people_value->first_name.' '.$people_value->last_name) }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <div class="modal-footer border-top-0 d-flex justify-content-right">
      <input type="hidden" name="gallery_meta[gallery_id]" value="@if(!empty($int_gallery_id)){{ $int_gallery_id }} @endif">
      @csrf            
      <input id="gallery_link_type" type="hidden" name="gallery_meta[gallery_link_type]" value="@if(!empty($gallery_link_type)){{ $gallery_link_type }} @endif">
      <input id="gallery_type" type="hidden" name="gallery_meta[gallery_type]" value="@if(!empty($gallery_type)){{ $gallery_type }} @endif">
      <input id="is_known_for" type="hidden" name="gallery_meta[is_known_for]" value="@if(!empty($is_known_for)){{ $is_known_for }} @endif">
      {{-- 
         <!-- <button type="button" onclick="return gallerySaveSubmitAjax('{{ $int_gallery_id }}');" class="btn edit-btn-style gallerySubmitButton">Post <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i> </button> --> 
      --}}
      <span class="mr-3 mt-1"><input type="checkbox" name="feed_check" value="on" @if($request_type == 'feeds_edit'){{ 'checked disabled' }}@endif> &nbsp;Share to feed &nbsp;</span>
      @if($request_type == 'feeds_edit')
         <input type="hidden" name="feed_check" value="on">
      @endif
      @if(isset($is_not_gallery) && $is_not_gallery == 1)     
         <input type="hidden" value="1" name="is_not_gallery">  
      @endif
      <button type="button" onclick="return gallerySaveSubmitAjax('');" class="btn edit-btn-style gallerySubmitButton">Post <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i> </button>
   </div>
</div>

<script src="{{ asset('backend/plugins/select2/select2.full.min.js?'.time()) }}"></script>
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
      // aspectRatio: 1,
         aspectRatio: 'NAN',
             viewMode: 1,
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
          url: "{{ route('front.gallery.image.upload') }}",
          data: {'image': base64data ,'_token':'{{ csrf_token() }}'},
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
       url: "{{route('front.user.gallery.get_youtube_thumbnail')}}",
       data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
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