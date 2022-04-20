<div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Feed {{ @$feedTitle }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body pb-0">
   <?php $gallery_type = $view_type; ?>
   <form id="feedForm" method="POST" class="kform_control PopFeedField" enctype="multipart/form-data">
      <input type="hidden" name="type" value="{{ $view_type    }}">
     
         <div class="row">
            <div class="col-lg-12 mb-3">
               <select name="type" class="form-control FeedFormSelected" onchange="changeType(this)">
                  <option value="">Type of Post</option>
                  @foreach($feed_type as $ftype)
                  <option <?php if($id == $ftype->id){ echo 'selected'; } ?> value="{{$ftype->id}}">{{$ftype->type}}</option>
                  @endforeach
               </select>
                <div class="text-center">
              <i class="fa fa-circle-o-notch fa-spin loadingType" style="display: none;color: #652C8F;"></i>
            </div>
            </div>
            <div class="col-lg-6">
               @if($gallery_type == 4)
               <div class="form-group text-center">
                  <div id="file-upload-formsecond" class="uploadersecond">
                     <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                        <div id="div-image-gallery-preview-id">                
                           <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$str_media_data)}}"  alt="">
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-group mb-4">
                     <div class="div-image-upload-gallery-class">
                        <div class="custom-file">
                           <input type="file" class="custom-file__input image" id="file-gallery-uploadsecond-new" name="photo" onchange="return getFeedImagePreview(this);" accept="image/*" >
                           <label class="custom-file__label" for="file-gallery-uploadsecond-new">Upload Image <i class="fa fa-spinner fa-spin loadingUpload" style="display: none;"></i></label>
                        </div>
                     </div>
                  </div>
               </div>
               @elseif($gallery_type == 2)
               <div id="file-upload-formsecond" class="uploadersecond videogallery">
                  <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
                     <div id="div-image-gallery-preview-id">                
                        <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-onevideo" src="{{ asset('front\new\images\default_video.jpg') }}"  alt="">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <input id="VideoUrl" type="text" name="video_url" class="form-control BoxShadow mt-2" value="@if(!empty($str_media_data)) {{ $str_media_data }} @endif" placeholder="Video URL" oninput="getYoutubeThumbnailfeed(this);">
               </div>
               @endif
            </div>
            <div class="col-lg-6">
               @if($gallery_type == 1 || $gallery_type == 2)
               <div class="form-group">
                  <input id="Title" type="text" name="title" class="form-control" placeholder="Title" value="@if(!empty($str_title)) {{ $str_title }} @endif">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="7" id="Caption" placeholder="Caption" value="@if(!empty($str_caption)){{$str_caption}}@endif" name="caption"></textarea>
               </div>
               @endif
            </div>
         </div>
         <div class="mt-2">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <!-- <label for="Tag">Tag</label><span class="text-danger">*</span> -->
                     @include("front.includes.tags_drop_down")

                  </div>
                  <div class="form-group">
                     <div>
                       <?php //echo "<pre>"; print_r($product_list); die; ?>
                       <select name="products[]" class="custom-select select2 ProdTag" multiple data-placeholder="Tag Products">

                        {{-- 
                           <option value="">Select</option>
                           --}}

                           @foreach ($product_list as $product_index => $product_value)
                           <option   value="{{$product_index}}">{{$product_value}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <div>
                        <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Tag People">
                           {{-- 
                              <option value="">Select</option>
                              --}}
                              @foreach ($people_list as $people_index => $people_value)
                              <option value="{{$people_index}}">{{$people_value}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="customsele">
                           <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag Companies">
                              {{-- 
                                 <option value="">Select</option>
                                 --}}
                                 @foreach ($company_list as $company_index => $company_value)
                                 <option value="{{$company_index}}">{{$company_value}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-right pt-0">
               @csrf            
               <button type="submit" class="btn edit-btn-style" id="btnfeed">POST <i class="fa fa-circle-o-notch fa-spin postLoading" style="display: none;"></i></button>
            </div>
         </form>
      
   </div>
</div>

<script>
   $('.select2').select2();

   function getYoutubeThumbnailfeed(e) {
   //$('#add-gallery-image-upload-preview-one').attr('src','');
   var youtube_url = $(e).val();
    $.ajax({
       url: "{{route('front.user.gallery.get_youtube_thumbnail')}}",
       data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
       dataType: 'json',
       type: 'POST',
       success: function (data) {
        if(data.success == 1){
          $('#add-gallery-image-upload-preview-onevideo').attr('src',data.thumbnail);
          } else {
             $('#add-gallery-image-upload-preview-onevideo').attr('src','<?php echo asset('front/new/images/default_video.jpg'); ?>');
              toastr.error(data.msg);
          }
      }
   });
}
</script>  
@include('includes.include_tags_js')