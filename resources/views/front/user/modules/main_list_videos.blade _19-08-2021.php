
@if(!empty($main_list->videos) && count($main_list->videos)>0)
<div class="owl-carousel mainListCarousel_video owl-theme" id="video-gallery">
                                    @foreach ($main_list->videos ?? [] as $video)
                                        @php 
                                            $GetAPI = @GetYoutubeAPI($video->video_link);

                                            $thumbnail = @$GetAPI['thumbnail']['thumb'];
                                        @endphp 
                                        
                                        <div class="item pr-1 pb-1" data-responsive="" data-src="{{@$video->video_link}}" 
                                        data-poster="" data-sub-html="">
                                            <a href="{{ $video->video_link }}">
                                                <div class="Gallery-text-overlay-Image3">
                                                <img src="{{ $thumbnail }}"
                                                    class="img-fluid imagesCover videoPreview">
                                                    <div class="overlayimages8">
                                                        <strong class="small1">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$video->video_title)}}</strong>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
@endif								


