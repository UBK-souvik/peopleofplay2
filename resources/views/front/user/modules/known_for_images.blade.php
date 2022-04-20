@if(!empty($gallery_known_for_data) && count($gallery_known_for_data)>0)
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="wrap-gallery mb-0 mt-0">
         <h2 class="sec_head_text text-left w-100">Known for
      @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
          <a href="{{ url('all/known-for-gallery') }}" class="move_edit_page" title="Edit Known For"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
      @endif
        </h2>
         <div class="row">
            <div class="col-md-12">
               <div class="wrap-gallery">
                  <div class="Gallery-overlay d-flex flex-wrap">
                    <div class="profilephotoslidercss owl-carousel  owl-theme profileknowslider">
                     @foreach ($gallery_known_for_data as $nkey => $gimage)
                    <div class="item">
                  <a href="javascript:void(0);" class="imagesliderachore"  onclick="getIMageGallery('{{ $gimage->id }}',3,'{{ $gimage->user_id }}',0);">
                    <img src="{{ asset('uploads/images/gallery/photos/'.$gimage->media) }}">
                    <div class="userPoductTitle withoutOverlay profileSliderCaption"><strong>{{ ucfirst(@$gimage->caption) }}</strong></div>
                  </a>
                </div>
                @endforeach
             </div>
                  </div>
               </div>
               <span data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-picture-o photo_icon"></i> <a class="span-style1" href="{{url('/')}}{{$gallery_known_for_link}}">See all Photos</a></span>
            </div>
         </div>
      </div>
   </div>
</div>
@endif

