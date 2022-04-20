@extends('front.layouts.pages')
@section('content')

@php
    $arr_social_media_type = App\Helpers\UtilitiesTwo::getSocialMediaArrayValue($event->socialMedia);
    $social_media_array_type =$arr_social_media_type[0];
    $social_media_array_value =$arr_social_media_type[1];
	
	$int_event_word_length = @App\Helpers\UtilitiesTwo::words_length(@$event->description);
	$int_description_words_length = @App\Helpers\UtilitiesTwo::description_words_length();

@endphp

        <div class="left-column border_right" id="event-page-main-div">
          <div class="First-column bg-white">
            <div class="col-md-12">
              <div class="row sectionTop">
                    @if( empty(get_current_user_info()->type_of_user) )
                        <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                            <!-- <div class="image-width justifly-content-center"> -->
                            <img src="{{@prodEventImageBasePath(@$event->main_image)}}" class="img-fluid mr-0 imgtwoeighty">
                            <!-- </div> -->
                        </div>
                    @else 
                        @if(have_permission('event_p_p') )
                          <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                                <!-- <div class="image-width justifly-content-center"> -->
                                <img src="{{@prodEventImageBasePath(@$event->main_image)}}" class="img-fluid mr-0 imgtwoeighty">
                                <!-- </div> -->
                          </div>
                        @endif
                    @endif
                   <div class="col-md-8 rightBox">
                     <div class="Jengatext paragraph">
                       <h2 class="mb-1"> 
                          @if( empty(get_current_user_info()->type_of_user) )
                                {{$event->name}}
                          @else
                            @if(have_permission('event_name') )
                                {{$event->name}}
                            @endif
                          @endif
                        </h2>
                        @php
                            $base_url = url('/');
                            $user_current_info_new = $event->user;
                            $str_user_name = '';
                            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
                            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                        @endphp
                        <!-- <p class="productAuthor">by <a class="span-style1" target="_blank" href="{{$str_user_url_new}}">{{ $str_user_name }}</a></p> -->
                     </div>
                     <div>
                       <p class="productAuthor m-0 fontWeightSix">by : <a class="span-style1 fontWeightSix" target="_blank" href="{{$str_user_url_new}}">{{ $str_user_name }}</a></p>
                     </div>
                        @if( empty(get_current_user_info()->type_of_user) )
                           @include("front.user.modules.event_description")
						            @else 
                          @if(have_permission('event_description') )
                            @include("front.user.modules.event_description")
                          @endif
                        @endif
                        @if(!empty(@$event->fun_fact1) || !empty(@$event->fun_fact2) || !empty(@$event->fun_fact2) )
                            <p>Fun Facts: </p>
                            <ul style="list-style: inside; color: #111;">
                              @if(!empty(@$event->fun_fact1) )<li class="p-text">{{@$event->fun_fact1}}</li> @endif
                              @if(!empty(@$event->fun_fact2) )<li class="p-text">{{@$event->fun_fact2}}</li> @endif
                              @if(!empty(@$event->fun_fact3) )<li class="p-text">{{@$event->fun_fact3}}</li> @endif
                            </ul>
                            <hr>
                        @endif
                        @if( empty(get_current_user_info()->type_of_user) )
                             <p class="sidetitleProduct m-0">Website: <a href="{{$event->website}}"><span class="span-style text-lowercase">{{$event->website}}</span></a></p>
                        @else
                          @if(have_permission('website') )
                              <p class="sidetitleProduct m-0">Website: <a href="{{$event->website}}"><span class="span-style text-lowercase">{{$event->website}}</span></a></p>
                          @endif
                        @endif

                        @if(Auth::guard('users')->check())
                          @if(check_watch_list(3,$event->id))
                              <a type="button" href="#" class="btn NoPaddingWatch mt-2">
                                <i class="fa fa-check photo_icon" ></i>Added to Watchlist
                              </a>
                          @else
                              <a type="button" href="{{route('front.pages.add_to_watch_list')}}?type=3&value={{$event->id}}" class="btn NoPaddingWatch mt-2"><i class="fa fa-plus photo_icon"></i> Add to Watchlist</a>
                          @endif
                        @endif
                   </div>
              </div>
            </div>
            
			
			<div class="modal" id="eventDescModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header kbg_black">
              <div class="textContent">
                <h4 class="modal-title text-white">Event Description</h4>
              </div>
              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div >
                <p class="text-justify">{{@$event->description}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

			  
	@if(!empty($gallery_image_data))
       @include("front.user.modules.images_gallery")
    @endif
          
		  @if( (!empty($event->awards) && count($event->awards)>0))
              <div class="col-md-12 desktopveiw">
                <div class="row sectionBox">
                  <h3 class="sec_head_text text-left w-100">Award</h3>
                  <div>
                    <table class="table event_table short_collaborator_list">
                        <tbody>
                            @foreach($event->awards as $collaborator_key => $award)
                              @if($collaborator_key <= 2 )
                                <tr class="py-1 px-3">
                                  <td class="eve_dac_name">{{$award->name}}</td>
                                  <td>...</td>
                                  <td>
                                      <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{$award->id}}">View</a>
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                        </tbody>
                        @if(count($event->awards) > 3 )
                            <tbody id="dots"></tbody>
                        @endif
                        @if(count($event->awards) > 3 )
                          <tbody id="more">
                              @foreach($event->awards as $collaborator_key => $award)
                                  @if($collaborator_key > 2 )
                                      <tr class="py-1 px-3">
                                        <td class="eve_dac_name">{{$award->name}}</td>
                                        <td>...</td>
                                        <td>
                                            <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{$award->id}}">View</a>
                                        </td>
                                      </tr>
                                  @endif
                              @endforeach
                          </tbody>
                        @endif
                    </table>
                  </div>
                  <div class="mt-3 w-100">
                    @if(count($event->awards) > 3 )
                        <span class="span-style1 see_full_list expand" onclick="myFunction()" id="myBtn" style="cursor: pointer;">
                                Expand >>
                        </span>
                    @endif
                  </div> 
                </div>
              </div>

              <div class="col-md-12 mobileveiw">
                  <div class="row sectionBox">
                    <div>
                      <table class="table event_table short_collaborator_list">
                          <tbody>
                              @foreach($event->awards as $collaborator_key => $award)
                                @if($collaborator_key <= 2 )
                                  <tr class="py-1 px-3">
                                    <td class="eve_dac_name">{{$award->name}}</td>
                                    <td>...</td>
                                    <td>
                                        <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{$award->id}}">View</a>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                          </tbody>
                          @if(count($event->awards) > 3 )
                              <tbody id="dots"></tbody>
                          @endif
                          @if(count($event->awards) > 3 )
                            <tbody id="more">
                                @foreach($event->awards as $collaborator_key => $award)
                                    @if($collaborator_key > 2 )
                                        <tr class="py-1 px-3">
                                          <td class="eve_dac_name">{{$award->name}}</td>
                                          <td>...</td>
                                          <td>
                                              <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{$award->id}}">View</a>
                                          </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                          @endif
                      </table>
                      
                    </div>
                    <div class="mt-3 w-100">
                      @if(count($event->awards) > 3 )
                          <span class="span-style1 see_full_list expand" onclick="myFunction()" id="myBtn" style="cursor: pointer;">
                                  Expand >>
                          </span>
                      @endif
                    </div>
                      <hr>
                    </div>
              </div>
          @endif


@if(!empty($gallery_known_for_data))
  
  @include("front.user.modules.known_for_images")

@endif


@if(!empty($gallery_video_data))
                
  @include("front.user.modules.videos_gallery")

@endif
    
	
@include("front.user.modules.social_media_icons")

</div>
             
		  
          <div class="NextbackgroundColor">
            
			<!--<div class="wrap-text d-flex text-white">
               <h3 class="sec_head_text">Did you know?</h3>
               <p class="span-style ml-auto"> Top|   Toys   |   Games   |   Celebs></p>
            </div>
             <div class="row">
                 <div class="col-md-12">
                   <div class="container">
                       <div class="wrap-gallery my-3">
                           <div class="row">
                             <div class="col-md-3">
                                <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image16.jpg" class="img-fluid mr-3">
                              </div>
                              <div class="col-md-9">
                               <div class="paragraphdesign">
                                 <p>There is a Star Wars video game!<br>
                                   2 days ago  | <span class="span-style">London</span><br><br>The actors of the early Star Wars have voiced a video game? In this game, you assume the role of Luke Skywalker and fight past many enemies to to reach and destroy the Death Star. <br>This game was featured in Star Wars: Rogue Squadron III - Rebel Strike (2003)<span class="span-style">See more>></span></p>
                               </div>
                               </div>
                           </div>
                       </div>
                   </div>
                       <span class="span-style1">See more Top News >></span>
                 </div>
             </div>-->
			 

       <!-- POLL SECTION COMMENTED START -->
			 
           <!--  <hr class="bg-dark">
                 <div class="text-white mt-3">
                   <h3>Poll: Favorite Game</h3>
                   </div>
                                 <div class="row desktopveiw">
                    <div class="col-md-12">
                       <div class="wrap-gallery my-3">
                           <div class="Gallery-overlay d-flex">
                             <div class="Gallery-text-overlay">
                             <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image17.jpg" class="img-fluid imagesCover">
                             </div>
                            <div class="Gallery-text-overlay">
                               <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image18.jpg" class="img-fluid imagesCover">
                             </div>

                               <div class="Gallery-text-overlay">
                                 <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image19.jpg" class="img-fluid imagesCover">
                               </div>

                             <div class="Gallery-text-overlay gallerybottom">
                               <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image20.jpg" class="img-fluid imagesCover">
                             </div>
                           <div class="Gallery-text-overlay">
                             <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image21.jpg" class="img-fluid imagesCover">
                           </div>


                       </div>
                   </div>
                 </div>


                 </div>
                 <div class="row mobileveiw">
                    <div class="col-md-12">
                       <div class="wrap-gallery my-3">
                           <div class="Gallery-overlay d-flex">
                             <div class="Gallery-text-overlay">
                             <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image17.jpg" class="img-fluid imagesCover">
                             </div>
                            <div class="Gallery-text-overlay">
                               <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image18.jpg" class="img-fluid imagesCover">
                             </div>

                               <div class="Gallery-text-overlay">
                                 <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image19.jpg" class="img-fluid imagesCover">
                               </div>



                       </div>
                   </div>
                 </div>


                 </div>
                   <button type="button" class="btn btn-style1 rounded-0 btnspace">Vote for your favorite</button>

                 <hr class="bg-dark">
             <div class="d-flex text-whitemt-3">
               <h3>The Chicago Toy & Game Week 2020</h3>
             </div>
               <div class="row p-3">
                 <div class="col-md-12">
                   <div class="container">
                       <div class="wrap-gallery my-3">
                           <div class="row">
                             <div class="col-md-3">
                                <img src="https://portraitsbnw.com/priya/updated/images/Homepageimage/Image22.png" class="img-fluid mr-3">
                              </div>
                              <div class="col-md-9">
                               <div class="paragraphdesign text-white">
                                 <p>See everything that is happening in Chicago in celebration of the annual Chicago Toy & Game Week 2020
                                   <span class="span-style">See complete itinerary>></span></p>
                               </div>
                               </div>
                           </div>
                         </div>
                      </div>
                    </div>
                 </div>
                 <hr class="bg-dark">
               </div> -->
       <!-- POLL SECTION COMMENTED END -->
          </div>







        </div>
      <!-- </div> -->
    <!-- </div>
  </div>
</main> -->






@include("front.user.modules.ajax_image_gallery_video")

<style type="text/css">
    #more {display: none;}
</style>
@endsection

@section('scripts')
<script>
  function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Expand >>"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "<< Collapse"; 
      moreText.style.display = "contents";
    }
  }

  function d_myFunction() {
     var dots = document.getElementById("d_dots");
     var moreText = document.getElementById("d_more");
     var btnText = document.getElementById("d_myBtn");
   
     if (dots.style.display === "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Read More"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "Read Less"; 
       moreText.style.display = "contents";
     }
   }
</script>

@endsection
