<style type="text/css">
    .AwardSection h2 {
    color: #672997;
    font-size: 23px!important;
    font-weight: 700!important;
}
    .AwardSection .kimg_div_class_new {
    max-width: 222px;
    max-height: 150px;
    border-radius: 6px;
    min-width: 222px;
    min-height: 150px;
}
</style>


@if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
    <div class="col-md-12 sectionBox mb-3" style="background-color: #ffffff;
    box-shadow: 0px 2px 4px 1px #8c8c8c !important;
    border-radius: 12px;">
        <div class="AwardSection">
        <h2 class="sec_head_text text-left w-100">Award 2021</h2>
        <div class="row px-3 py-0">            
            <div class="d-flex flex-wrap justifly-content-center images-size1 mb-0" id="home-for-fixed-size">
            </div>
            <div class="ml-1 w-100">
                <span>
                 {{--   @if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
                        <i class="photo_icon fa fa-camera" ></i>
                    @endif --}}
                   
                    {{--   @if(!empty($gallery_image_data) && $cnt_gallery_image_data>0)
                        <a class="span-style1" href="{{ url('/') }}{{ $gallery_images_link }}"> See All Photos  $cnt_gallery_image_data ?? 0}} {{ $cnt_gallery_image_data == 1 ? 'photo' : 'photos'  <a>  
                    @endif  --}}
                 
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
    </div>
@endif