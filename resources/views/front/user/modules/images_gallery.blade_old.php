@if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
    <div class="col-md-12 sectionBox">
        <h2 class="sec_head_text text-left w-100">Photo Gallery 
        @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
            <a href="{{ url('all/image-gallery') }}" class="move_edit_page" title="Edit Photo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif
            </h2>
        <div class="row px-3 py-0">            
            <div class="d-flex flex-wrap justifly-content-center images-size1 mb-0 ProPhotoGallery">
                <div class="profilephotoslidercss  owl-carousel  owl-theme profilephotoslider">
                @foreach ($gallery_image_data as $nkey => $gimage)
               
                    <div class="item">
                
                  <a type="button" class="imagesliderachore"  onclick="getIMageGallery('{{ $gimage->id }}',1,'{{ $gimage->user_id }}',0);">
                    <img src="{{ asset('uploads/images/gallery/photos/'.$gimage->media) }}">
                    <div class="userPoductTitle withoutOverlay profileSliderCaption"><strong>{{ $gimage->caption }}</strong></div>
                  </a>
                 
                </div>
           
                @endforeach
                </div>
            </div>
            <div class="ml-1 w-100">
                <span>
    				@if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
                        <i class="photo_icon fa fa-camera" ></i>
                    @endif 
    				
                    @if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
                        <a class="span-style1" href="{{ url('/') }}{{ $gallery_images_link }}"> See All Photos {{-- $cnt_gallery_image_data ?? 0}} {{ $cnt_gallery_image_data == 1 ? 'photo' : 'photos' --}} <a>  
                    @endif  
    				
                    {{-- @if(!empty($gallery_video_data) && $cnt_gallery_video_data>0) 
                        | <a class="span-style1" href="{{ url('/') }}{{ $gallery_videos_link }}">
                             {{ $cnt_gallery_video_data ?? 0}} {{ $cnt_gallery_video_data == 1 ? 'video' : 'videos' }} 
                        <a> 
                    @endif --}}
                </span> 
    			{{-- @if(!empty($blogs_list) && count($blogs_list)>0) | 
                    <a class="span-style1" href="{{ url('/') }}{{ $blogs_link }}"> 
                        {{ count($blogs_list) ?? 0}}  {{ count($blogs_list) == 1 ? 'article' : 'articles' }} 
                    <a> 
                @endif --}}  
			</div>
        </div>
    </div>
@endif

@section('scripts')
<script>
      $('.profilephotoslider').owlCarousel({
    nav:true,
    dots:false,
    margin:10,
   // loop:true,
    responsiveClass:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
             0:{
                  items:1
             },
              400:{
                 items:2
             },
             600:{
                 items:2
             },
             992:{
                 items:3
             },
             1200:{
                 items:5
             }
         }
})

      $('.profilevideoslider').owlCarousel({

    nav:true,
    dots:false,
    margin:10,
    // loop:true,
    responsiveClass:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
             0:{
                  items:1
             },
              400:{
                 items:1
             },
             600:{
                 items:2
             },
             992:{
                 items:2
             },
             1200:{
                 items:3
             }
         }
})


      

</script>


  @include("front.includes.profile_js_scripts_include")
@endsection
