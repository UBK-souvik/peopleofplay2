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
                
                  <a href="javascript:void(0);" class="imagesliderachore"  onclick="getIMageGallery('{{ $gimage->id }}',1,'{{ $gimage->user_id }}',0);">
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


  @php 
    @$user_product_list_count = @$user_media_list_count = @$user_brand_list_count = @$user_blogs_list_count = @$user_award_list_count =0 ;
    @endphp
    @if(isset($arr_products_objs_new) && count($arr_products_objs_new)>0)
      @php @$user_product_list_count =  count($arr_products_objs_new); @endphp
    @endif

    @if(isset($user->media_list) && count($user->media_list)>0)
      @php @$user_media_list_count =  count($user->media_list); @endphp
    @endif

    @if(isset($user->brand_lists) && count($user->brand_lists)>0)
     @php  @$user_brand_list_count =  count($user->brand_lists); @endphp
    @endif

    @if(isset($user_blogs_list) && count($user_blogs_list)>0)
      @php @$user_blog_list_count =  count($user_blogs_list); @endphp
    @endif

    @if(isset($user_award_list) && count($user_award_list)>0)
      @php @$user_award_list_count =  count($user_award_list); @endphp
    @endif

@section('scripts')
<script>

    var image_gallary_image_dataCount = '{{ count($gallery_image_data) }}';
    var  owl_item_image_loop = false;
    if(image_gallary_image_dataCount > 5) {
      var  owl_item_image_loop = true;
    }

    var image_gallary_know_dataCount = '{{ count($gallery_known_for_data) }}';
    var  owl_item_know_loop = false;
    if(image_gallary_know_dataCount > 5) {
      var  owl_item_know_loop = true;
    }


    var image_gallary_video_dataCount = '{{ count($gallery_video_data) }}';
    var  owl_item_video_loop = false;
    if(image_gallary_video_dataCount > 3) {
      var  owl_item_video_loop = true;
    }

    var user_product_list_count = '{{  @$user_product_list_count }}';
    var user_media_list_count = '{{ @$user_media_list_count }}';
    var user_brand_list_count = '{{ @$user_brand_list_count }}';
    var user_blog_list_count = '{{ @$user_blog_list_count }}';
    var user_award_list_count = '{{ @$user_award_list_count }}';
   







      $('.profilephotoslider').owlCarousel({
            nav:true,
            dots:false,
            margin:10,
            loop : owl_item_image_loop,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                     0:{
                          items:1
                     },
                      400:{
                         items:3
                     },
                     600:{
                         items:3
                     },
                     786:{
                         items:4
                     },
                     1200:{
                         items:5
                     }
                 }
        })

       $('.profileknowslider').owlCarousel({
            nav:true,
            dots:false,
            margin:10,
            loop : owl_item_know_loop,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                     0:{
                          items:1
                     },
                      400:{
                         items:3
                     },
                     600:{
                         items:3
                     },
                     786:{
                         items:4
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
    loop: owl_item_video_loop,
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
             565:{
                 items:3
             },
             786:{
                 items:3
             },
             1200:{
                 items:3
             }
         }
})
</script>


  @include("front.includes.profile_js_scripts_include")
@endsection

