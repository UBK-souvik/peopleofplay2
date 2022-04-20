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
$str_modal_form_div_id = 'ModalGalleryVideoForm';
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
                  <!--  <select onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  name="gallery_meta[destination_id]" class="form-control" data-placeholder="Select"> -->
                     <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                     @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                     {{-- show brand only for a company user --}}
                     @if($arr_destinations_list_key == 4 || $arr_destinations_list_key == 3)
                     @if(($int_type_of_user ==2) && ($role_type_id == 3))             
                     @else
                     @continue;
                     @endif
                     @endif

                     <input onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  type="radio" value="{{$arr_destinations_list_key}}" name="gallery_meta[destination_id]" <?php
                     if (!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; }  ?> > <label> {{ $arr_destinations_list_val }}</label>
                     
                     @endforeach
                  
               </div>
            </div>
            @endif
         </div>
         <div class="col-lg-6">
            @if($gallery_type == 1)
            <div class="form-group text-center">
               <div id="file-upload-formsecond" class="uploadersecond">
                  <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                     <div id="div-image-gallery-preview-id">                
                        <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$str_media_data)}}"  alt="">
                     </div>
                  </div>
               </div>
               @if($gallery_type == 1)
               <div class="form-group">
                  <div class="div-image-upload-gallery-class">
                     <div class="custom-file">
                        <input type="file" class="custom-file__input image" id="file-gallery-uploadsecond-new" name="photo" onchange="getImagePreviewReadURL(this,'ModalGalleryVideoForm',1);" accept="image/*" >
                        <label class="custom-file__label" for="file-gallery-uploadsecond-new">Upload Image</label>
                        <!-- <input type="hidden" id="photo_img_ID" name="photo" value=""> -->
                     </div>
                  </div>
               </div>
               @endif
            </div>
            @endif
         </div>
         <div class="col-lg-6">
            @if($gallery_type == 1)
            <div class="form-group mt-4 mt-md-0 d-none">
               <label for="">Title</label>
               <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($str_title)) {{ $str_title }} @endif">
            </div>
            <div class="form-group">
               <label for="">Caption</label>
               <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" value="" name="gallery_meta[caption]">@if(!empty($str_caption)){{$str_caption}}@endif</textarea>
            </div>
            @endif
         </div>
      </div>
      <input type="hidden" id="crop_img" name="crop_img" value="">
      @if($gallery_type == 2)
      <div class="row">
         <div class="col-12">
            <div class="form-group">
               <div>
                  <label>Where do you want to post?<span class="text-danger">*</span></label><br>
                     @foreach ($arr_destinations_list as $arr_destinations_list_key => $arr_destinations_list_val)
                        @if($arr_destinations_list_key == 3)
                     @continue;
                     @endif
                     <input onchange="return showProdEventDropDownByDest('{{ $str_modal_form_div_id }}', this.value);"  type="radio" value="{{$arr_destinations_list_key}}" name="gallery_meta[destination_id]" <?php
                     if (!empty($int_destination_id) && ($int_destination_id == $arr_destinations_list_key)) { echo 'checked'; } elseif($arr_destinations_list_key == 1) { echo 'checked'; }  ?> > <label> {{ $arr_destinations_list_val }}</label>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div id="file-upload-formsecond" class="uploadersecond">
               <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                  <div id="div-image-gallery-preview-id">                
                     <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{ asset('front\new\images\default_video.jpg') }}"  alt="">
                  </div>
               </div>
            </div>
            <div class="form-group mt-4">
               <input id="VideoUrl" type="text" name="gallery_meta[video_url]" class="form-control" value="@if(!empty($str_media_data)) {{ $str_media_data }} @endif" placeholder="Video URL" oninput="getYoutubeThumbnail(this);">
               <small style="font-size:10px; color:red;"> Upload YouTube links only. Upload other links to Media.</small>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-group d-none">
               <label for="">Title</label>
               <input id="Title" type="text" name="gallery_meta[title]" class="form-control" placeholder="Title" value="@if(!empty($str_title)) {{ $str_title }} @endif">
            </div>
            <div class="form-group">
               <label for="">Caption</label>
               <textarea class="form-control" rows="18" id="Caption" placeholder="Caption" name="gallery_meta[caption]">@if(!empty($str_caption)){{$str_caption}}@endif</textarea>
            </div>
         </div>
      </div>
      @endif
      <div class="row">
         <div class="col-md-12 assign-prod-event-drop-down-class" @if(!empty($int_assign_product_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[1] }}">
         <div class="form-group">
            <!--  <label for="product-tag-id">Assign to Product</label> <span class="text-danger">*</span> -->
            <label for="">Select Product</label>
            <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
               <option value="">Select Product</option>
               @foreach ($user_product_data as $user_product_row)
               <option @if (!empty($int_assign_product_id) && ($int_assign_product_id == $user_product_row->id)){{ 'selected' }}  @endif  value="{{$user_product_row->id}}">
               {{ $user_product_row->name }}</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="col-lg-6 assign-prod-event-drop-down-class" @if(!empty($int_assign_brand_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[3] }}">
      <div class="form-group">
         <!-- <label for="brand-tag-id">Assign to Brand</label> <span class="text-danger">*</span> -->
         <label for="">Select Brand</label>
         <select name="gallery_meta[assign_brand_id]" class="form-control" data-placeholder="Select">
            <option value="">Select Brand</option>
            @foreach ($user_brand_data as $user_brand_row)
            <option @if (!empty($int_assign_brand_id) && ($int_assign_brand_id == $user_brand_row->id)){{ 'selected' }}  @endif  value="{{$user_brand_row->id}}">
            {{ $user_brand_row->name }}</option>
            @endforeach
         </select>
      </div>
   </div>
   <div class="col-md-12 assign-prod-event-drop-down-class" @if(!empty($int_assign_event_id)) {{ "style=display:block;" }} @else {{ "style=display:none;" }} @endif  id="assign-gallery-event-product-div{{ $arr_destinations_list_keys[2] }}">
   <div class="form-group">
      <!--  <label for="product-tag-id">Assign to Event</label> -->
      <label for="">Select Event</label>
      <select name="gallery_meta[assign_event_id]" class="form-control" data-placeholder="Select">
         <option value="">Select Event</option>
         @foreach ($user_event_data as $user_event_row)
         <option @if (!empty($int_assign_event_id) && ($int_assign_event_id == $user_event_row->id)){{ 'selected' }}  @endif  value="{{$user_event_row->id}}">
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
                     @foreach ($company_list as $company_index => $company_value)
                     <option @if(!empty($arr_companies[$int_gallery_id]) && in_array($company_index, $arr_companies[$int_gallery_id])){{ 'selected' }}  @endif value="{{$company_index}}">
                     {{$company_value}}</option>
                     @endforeach
                     --}}
                  </select>
               </div>
            </div> -->
            <div class="form-group">
               <label for="">Tag Products</label>
               <div>
                  <select name="products[]" id="products_select" class="custom-select" multiple data-placeholder="Search Products">
                     {{-- 
                     <option value="">Select</option>
                     --}}
                  </select>
               </div>
            </div>
               <div class="form-group">
               <label for="">Tag Companies</label>
               <div>
                  <select name="companies[]" id="company_select" class="custom-select" multiple data-placeholder="Search Companies">
                     {{-- 
                     <option value="">Select</option>
                     --}}
                  </select>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-group">
            <label for="">Tag People</label>
               <div>
                  <select name="peoples[]" id="peoples_select" class="custom-select" multiple data-placeholder="Search People">
                     {{-- 
                     <option value="">Select</option>
                     --}}
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
      <span class="mr-3 mt-1"><input type="checkbox" name="feed_check" value="on"> &nbsp;Share to feed &nbsp;</span> 
      <button type="button" onclick="return gallerySaveSubmitAjax('{{ $int_gallery_id }}');" class="btn edit-btn-style gallerySubmitButton">Post <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i> </button>
   </div>
</div>

<script src="{{ asset('backend/plugins/select2/select2.full.min.js?'.time()) }}"></script>

<script type="text/javascript">
   
   $(document).ready(function(){
      $('#products_select').select2({
         placeholder: '--- Search Test Products ---',
         ajax: {
            url: "{{ route('front.gallery.images.test_searching') }}",
            headers: {
                    'X-CSRF-TOKEN': ajax_csrf_token_new
                   },
            type: 'post',  
            dataType: 'json',  
            delay: 250,
            data: function (params) {
               return {
                  searchTerm: params.term, // search term
                  searchTable: 'products',
               };
            },  
            processResults: function (response) {
               return {
                  results: response
               };
            },
            cache: true
         }
      });

      $('#peoples_select').select2({
         placeholder: '--- Search Peoples ---',
         ajax: {
            url: "{{ route('front.gallery.images.test_searching') }}",
            headers: {
                    'X-CSRF-TOKEN': ajax_csrf_token_new
                   },
            type: 'post',  
            dataType: 'json',  
            data: function (params) {
               return {
                  searchTerm: params.term,
                  searchTable: 'peoples',
               };
            },  
            delay: 250,
            processResults: function (data) {
               return {
                  results: data
               };
            },
            cache: true
         }
      });

      $('#company_select').select2({
         placeholder: '--- Search Companies ---',
         ajax: {
            url: "{{ route('front.gallery.images.test_searching') }}",
            headers: {
                    'X-CSRF-TOKEN': ajax_csrf_token_new
                   },
            type: 'post',  
            dataType: 'json',  
            data: function (params) {
               return {
                  searchTerm: params.term, // search term
                  searchTable: 'company',
               };
            },  
            delay: 250,
            processResults: function (data) {
               return {
                  results: data
               };
            },
            cache: true
         }
      });
   });

   
   // $('.select2').select2();

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
      console.log(1);
    }
      console.log(2);
  });

   bs_modal.on('shown.bs.modal', function() {
      console.log(3);
    cropper = new Cropper(image, {
            // aspectRatio: 1,
         aspectRatio: 'NAN',
             viewMode: 1,
            // const ZIBtn = document.getElementById('btnZoomIn');
            // const ZOBtn = document.getElementById('btnZoomOut');
            crop(event) {
            //   console.log(event.detail.x);
            //   console.log(event.detail.y);
            //   console.log(event.detail.width);
            //   console.log(event.detail.height);
            //   console.log(event.detail.rotate);
            //   console.log(event.detail.scaleX);
            //   console.log(event.detail.scaleY);
            },
            preview: '.preview',
          });
      console.log(4);
  }).on('hidden.bs.modal', function() {
      console.log(5);
    cropper.destroy();
    cropper = null;
      var val = $(e).val();
      // $('#photo_img_ID').val(val);
      // $(e).val('').trigger('change');
      $('#'+id).show();
  });
  
   $('#btnZoomIn').on('click', function () { cropper.zoom(0.1); })
   $('#btnZoomOut').on('click', function () { cropper.zoom(-0.1); })

  $("#crop").click(function() {
      console.log('6');
     $('.crop_laoder').show();
    canvas = cropper.getCroppedCanvas({
     // width: 160,
     // height: 600,
    });


   //  ZIBtn.onclick = options.zoom;
   //  ZOBtn.onclick = options.zoom; 

    canvas.toBlob(function(blob) {
      console.log(7);
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
          $('#add-gallery-image-upload-preview-one').attr('src',data.thumbnail);
          } else {
             $('#add-gallery-image-upload-preview-one').attr('src','<?php echo asset('front/new/images/default_video.jpg'); ?>');
              toastr.error(data.msg);
          }
      }
   });
}

function modalClose(e,id){
   $('#'+id).modal('hide');
   location.reload();
}


</script>