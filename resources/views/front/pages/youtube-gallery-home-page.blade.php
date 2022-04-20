<div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Gallery</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <div id="carouselExampleIndicators" class="carousel slide YouTubecarouselIndicators" data-ride="carousel">
      <div class="carousel-inner">
         @if(count($data) > 0 )
         @foreach($data as $key => $videolink)
         @php 
         if(@$type =='right') {
         $video_link_data = @$videolink->right_video_link;
         $video_link_thumbnail = @$videolink->right_video_link_thumbnail;
         $video_link_title = @$videolink->right_video_link_title;
         $video_link_duration = @$videolink->right_video_link_duration;
         $video_link_description =@$videolink->right_video_link_description;
         } else {
         $video_link_data = @$videolink->video_link;
         $video_link_thumbnail = @$videolink->video_link_thumbnail;
         $video_link_title = @$videolink->video_link_title;
         $video_link_duration = @$videolink->video_link_duration;
         $video_link_description = @$videolink->video_link_description;
         }
         @endphp
         <div class="carousel-item @if($videolink->id == $select_id) {{ 'active' }} @endif ">
            <!-- <img class="d-block w-100" src="{{ @$video_link_thumbnail }}" alt="{{ @$video_link_title }}"> -->
            <?php
               echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",@$video_link_data);
                ?>
            <div class="carousel-caption" >
               <h6>
                  <img src="{{ asset('front/images/play.png') }}" class="playIconMainSlider">
                  {{substr(@$video_link_title,0,30)}}.. 
                  <smail> {{@$video_link_duration}}</smail>
               </h6>
               <p class="starcast">{{substr(@$video_link_description,0,60)}}..</p>
            </div>
         </div>
         @endforeach
         @endif
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
</div>