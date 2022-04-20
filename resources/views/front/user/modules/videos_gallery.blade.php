<style>
 .Gallery-text-overlay1 {
   padding-right: 10px;
 }
 .Gallery-text-overlay1.gallerybox p {
   text-align: center;
   padding: 10px 15px;
 }

</style>
@if(!empty($gallery_video_data) && count($gallery_video_data)>0)
<section >
 <div class="col-md-12 sectionBox ProfileVideoSec">
  <h3 class="sec_head_text w-100">Videos
   @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id) 
    <a href="{{ url('all/video-gallery') }}" class="move_edit_page" title="Edit Videos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    @endif
  </h3>
  <div class="row px-3 py-0">
         <!-- <div class="d-flex flex-wrap justifly-content-center images-size1 mb-0" id="videos-fixed-size">
         </div> -->
         <div class="d-flex flex-wrap justifly-content-center images-size1 mb-0" >
          <div class="pofilevideoslidercss profilevideoslider owl-carousel owl-theme ">
            @foreach ($gallery_video_data as $nkey => $gimage)
            <div class="item">
              <?php 
              //echo $gimage->media; die;
              $GetAPI = @GetYoutubeAPI($gimage->media);
             /// echo "<pre>"; print_r($GetAPI); die;
              $thumbnail = @$GetAPI['thumbnail']['thumb'];
              $thumbnail_title = @$GetAPI['title'];
              ?>
              <a href="javascript:void(0);" class="videoslideachore"  onclick="getIMageGallery('{{ $gimage->id }}',2,'{{ $gimage->user_id }}',0);">
                <img src="{{ $thumbnail }}" class="img-fluid imagesCover videoPreview">
                <div class="userPoductTitle withoutOverlay profileSliderCaption"><strong>{{ @$gimage->caption }}</strong></div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="mt-2"><i class="fa fa-video-camera photo_icon"></i><a class="span-style1 ml-1" href="{{url('/')}}{{$gallery_videos_link}}">See all videos</a></div>
    </div>
  </section>
  @endif

