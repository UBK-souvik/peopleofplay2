@extends('front.layouts.pages')
@section('content')
<style>
   .paddingTopTwenty{
   border-top: 1px solid lightgrey;
   padding-top: 20px;
   }
   .paddingBottomTwenty{
   padding-bottom: 20px;
   }
   .UpdateSequance {
   width: 90px;
   font-weight: 500;
   font-size: 14px;
   }
   .addBtnGallery .edit-btn-style {
   box-shadow: 2px 3px 6px #808080;
   padding: .375rem .75rem;
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column gallerybgcolor border_right PopGallery" id="gallery-main-div-id-new">
      <div class="First-column" >
         <div class="col-md-12">
            <div class="row sectionTop">
               <div class="px-0 w-100">
                  <div class="subpage_title_block__right-column">
                     <div class="d-flex justify-content-between">
                        <div class="parent">
                           <!-- <h3 itemprop="name" class="slugname"> -->
                           <a href="#" itemprop="url" style="display: none;">
                           @if(!empty($slug))  {{ $slug }} @else {{ 'All' }} @endif
                           </a><span class="nobr">
                           </span>
                           <!-- </h3> -->
                           <h1 class="Tile-style pt-0 mb-3 w-100" >
                              @if(($gallery_link_type ==1) && ($gallery_type == 1))
                              {{ 'Photo' }}

                              @php 
                              $needhelpYoutubeVideo = 'https://youtu.be/gaGn_F7Zyqw';
                              @endphp

                              @elseif(($gallery_link_type ==2) && ($gallery_type == 2))
                              {{ 'Video' }}

                               @php 
                              $needhelpYoutubeVideo = 'https://youtu.be/5kBd8weALzQ';
                              @endphp

                              @elseif(($gallery_link_type ==3) && ($gallery_type == 1))
                              {{ 'Known For' }}

                               @php 
                              $needhelpYoutubeVideo = 'https://youtu.be/gaGn_F7Zyqw';
                              @endphp

                              @else
                              {{ 'Image' }} 

                               @php 
                              $needhelpYoutubeVideo = 'https://youtu.be/gaGn_F7Zyqw';
                              @endphp

                              @endif 
                              Gallery
                            <a target="_blank" href="{{ $needhelpYoutubeVideo }}" class="btnHelp btnHelpSmall btn">
                <div class="d-inline-block text-left pr-3">
                <p class="mb-0 needhelp"><b>Need Help ?</b></p> 
                <p class=" mb-0 helptutorial">click for tutorial</p>
                </div>
                <i class="fa fa-question-circle" aria-hidden="true"></i>
            </a>

                           </h1>
                        </div>
                     </div>
                     <div class="responsiveTab">
                        <div class="row">
                           <div class="col-md-12 col-xl-7 col-sm-7" style="margin-bottom: 10px;">
                              <div class="kmenu py-2 ">
                                 <ul class="nav nav-pills">
                                    <li class="nav-item">
                                       <a class=" @if($gallery_link_type == 1)
                                          {{ 'active' }}
                                          @endif" href="{{ $str_gallery_image_url }}">Images</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="@if($gallery_link_type == 2)
                                          {{ 'active' }}
                                          @endif" href="{{ $str_gallery_video_url  }}">Videos</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="@if($gallery_link_type == 3)
                                          {{ 'active' }}
                                          @endif" href="{{ $str_gallery_knownfor_url }}">Known For</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-md-12 col-xl-5 col-sm-5">
                              <ul class="nav GalleryButton">
                                <li class="nav-item">
                                  @if(isset($gallery_data) && count($gallery_data) >1)
                              <div class="">
                                 <button class="btn btn-primary UpdateSequance mr-2" onclick="update_sequance(this,'{{ $gallery_link_type }}');">Sequence  <i class="fa fa-spinner fa-spin st_loader" style="display: none;"></i></button>
                              </div>
                              @endif
                                </li>
                                <li class="nav-item">
                                  <div class="addBtnGallery">
                                @include("front.user.gallery.add_image_gallery")
                              </div>
                                </li>
                              </ul>
                              
                           </div>
                           <!-- <div class="col-md-12 col-lg-2 col-sm-2 col-12 pl-xl-0">
                              
                           </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <hr> -->
         <div class="col-md-12" id="fixed-size">
            <div class="paddingTopTwenty paddingBottomTwenty">
               <div class="row gallery-bottom">
                  <div class="col-sm-12 d-flex justify-content-end">
                     <span class="span-style1 text-right"> {{  $gallery_data->links('pagination') }}  </span> <!-- 'pagination' -->
                  </div>
               </div>
               <?php //echo "<pre>"; print_r($gallery_data); die; ?>
               <div class="d-flex flex-wrap p-0 galleryGrid">
                  @include("front.user.gallery.view_gallery_list")
               </div>
            </div>
         </div>
         <!-- <hr> -->
      </div>
   </div>
   <!-- Modal -->
   <div class="modal fade" id="imageProfileSQModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content content-images"></div>
      </div>
   </div>
</div>

@endsection
@section('scripts')
<script>
   var main_gallery_url_new = '{{ $main_gallery_url }}'; 
   var create_gallery_url_new = '{{ $create_gallery_url }}'; 
   var delete_gallery_url_new = '{{ $delete_gallery_url }}';
   var ajax_csrf_token_new = '{!! csrf_token() !!}';
   var gallery_data_saved_flag = '{{ Session::has("gallery_data_saved_flag") }}';
   
   
   
      // window on load event
      function gallerySaveMessage(){
   
       if(gallery_data_saved_flag!="")
       {
       //toastr.success("Gallery Saved Successfully.");
     }
   
   }
   window.onload = gallerySaveMessage;
</script>
<script type="text/javascript">
   function confirm_click()
   {
     return confirm("Are you sure ?");
   };
   
   function update_sequance(e,type) {
      $('.st_loader').show();
    $.ajax({
       url: "{{route('front.user.gallery.image_update_sequance')}}",
       data: {'_token':'{{ csrf_token() }}','type':type},// + '&ckeditor_description_new=' + 
       dataType: 'json',
       type: 'POST',
       success: function (data) {

        $('#imageProfileSQModal').modal('show');
        $('#imageProfileSQModal .content-images').html(data.view);
        $('.st_loader').hide();
      }
   });
   }
   
   function getIMageGallery(id,type,user_id,show_btn) {

     $.ajax({
        url: "{{ route('front.gallery.images.modal_list')}}",
       data: {
        "_token": "{{ csrf_token() }}",
      'id':id,
      'type':type,
      'user_id':user_id,
      'show_btn':show_btn,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
              $('#DefaultModal').modal('show');
             $('#DefaultModal .modal-content').html(data.view);
             
        }
     });
   }

   function open_add_GalleryModalView(e,id='',type) {
      $('.st_gallery_loading').show();
     $.ajax({
        url: "{{ route('front.gallery.images.edit_modal_list')}}",
       data: {
        "_token": "{{ csrf_token() }}",
      'id':id,'file_type':'add','type':type,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            //   $('#ModalGalleryVideoForm').modal('show');
            //  $('#ModalGalleryVideoForm .modal-content').html(data.view);
             
            var modal_gallery_form = '#ModalGalleryVideoForm';
            $(modal_gallery_form).show();
             $('#ModalGalleryVideoForm .modal-content').html(data.view);
            $(modal_gallery_form).css('display', 'block');
            $(modal_gallery_form).modal({ show: true });
            $('#DefaultModal').modal('hide');
            $('.st_gallery_loading').hide();
        }
     });
   }

   function openEditGalleryModal(id) {
      $('.st_gallery_loading').show();
     $.ajax({
        url: "{{ route('front.gallery.images.edit_modal_list')}}",
       data: {
        "_token": "{{ csrf_token() }}",
      'id':id,'file_type':'edit',
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            //   $('#ModalGalleryVideoForm').modal('show');
            //  $('#ModalGalleryVideoForm .modal-content').html(data.view);
             
            var modal_gallery_form = '#ModalGalleryVideoForm';
            $(modal_gallery_form).show();
             $('#ModalGalleryVideoForm .modal-content').html(data.view);
            $(modal_gallery_form).css('display', 'block');
            $(modal_gallery_form).modal({ show: true });
            $('#DefaultModal').modal('hide');
            $('.st_gallery_loading').hide();
            
        }
     });
   }


  function deleteGallery(id){
   if (confirm('Are you sure delete ?')) {
     $.ajax({
        url: "{{ route('front.all.videogallery.delete')}}",
       data: {
        "_token": "{{ csrf_token() }}",
      'gallery_id':id,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
              $('#DefaultModal').modal('hide');
             $('#DefaultModal .modal-content').html('');
             location.reload();
             //$('#modal-user-role-type-popup-new').modal('hide');
        }
     });
       }else{
      console.log('cancel')
    }
  }




</script>
@endsection