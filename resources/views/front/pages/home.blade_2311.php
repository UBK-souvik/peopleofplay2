@extends('front.layouts.pages')
@section('content')
<style>
   .homePaddingBotTwenty{
   padding-bottom: 0px!important;
   margin-bottom: 0;
   }
   .pr-sm-3, .px-sm-3 {
   padding-right:0rem!important;
   }
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="homepagebanner mb-1">
      <a href="{{ url('/sign-up') }}">
      <img src="{{ asset('front/images/WebHeader17.png') }}" alt="WebHeader15" class="img-fluid">
      </a>
   </div>
   <!--  <div class="homepagebanner mb-1">
      <a href="https://www.surveymonkey.com/r/KRTSCDF" target="_blank"> <img src="{{ asset('front/images/VOTEHeader.png') }}" alt="VOTEHeader" class="img-fluid"></a>
      </div> -->
   <div class="homepagebanner mb-1">
      <a href="https://www.eventbrite.com/e/2021-toy-game-international-innovation-awards-tagies-pops-got-talent-tickets-165035239845" target="_blank"> <img src="{{ asset('front/images/RSVPHeader.png') }}" alt="RSVPHeader" class="img-fluid"></a>
   </div>
   <div class="homepagebanner mb-2">
      <a href="javascript:void(0)"> <img src="{{ asset('front/images/SponsorsHeader.png') }}" alt="SponsorsHeader" class="img-fluid"></a>
   </div>
   <!-- <div class="awardsbanner my-3">
      <div class="votehere text-center">
         <p class="mb-0">2021 TAGIE Awards Finalists Revealed Below -
            <a href="javascript:void(0)">VOTE HERE!</a>
         </p>
         <p class="mb-0">On November 19th, find out who won, be entertained - the
            Toy & Game Innovation Awards air right here on POP!
            <a href="javascript:void(0)">RSVP HERE</a> (free)!
         </p>
      </div>
      </div> -->
   <!--  ************ || Award Slider Start|| ************ -->
   @if(isset($home_page_award_types) && !empty($home_page_award_types) && count($home_page_award_types)>0)
   @foreach ($home_page_award_types as $row_award_type)
   <div class="HomeSection">
      <div class="col-md-12">
         <div class="wrap-home-text specialCenter pt-3">
            <h3 class="homeTitle homePaddingBotTwenty"> 
               {{ @$row_award_type->title}}
            </h3>
         </div>
      </div>
      <div class="col-md-12 pTopTwenty">
         <div class="carousel-wrap pb-4">
            <div class="CarouselWrap owl-carousel  CarouselWrapSlide" id="OwlCarouselWrap">
               @foreach ($row_award_type->home_page_award as $homaAwardRow)
               <div class="item">
                  <div class="LatestToy text-center" style="display: inline-block;">
                     <a href="javascript:void(0);" class="linkfirst" onclick="homePageAwardModel(this,'{{ $homaAwardRow->id}}');">
                     <img src="{{ @imageBasePath(@$homaAwardRow->featured_image)}}" alt="award Image" class="img-fluid">
                     </a>
                     <div class="slidertext mt-2">
                        <a href="{{ @$homaAwardRow->homa_caption_url_one}}" class="linksecond">
                           <p class="mb-0"> {{ @$homaAwardRow->home_caption_one}} </p>
                        </a>
                        <a href="{{ @$homaAwardRow->homa_caption_url_two}}" class="linkfour">
                           <p class="mb-0"> {{ @$homaAwardRow->home_caption_two}} </p>
                        </a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   @endforeach
   @endif   
   <!--  ************ || Award Slider End || ************ -->
   <div class="left-column bg-black1 HomeMiddleColumn">
      <div class="First-middle-column bg-black1 pt-0 firstBorder">
         @foreach ($home_page as $home)     
         <!-- skip the latest news -->
         @if($home->type == 3)
         @continue
         @else
         <div class="HomeSection">
            <div class="col-md-12 mt-0" >
               <!-- paddingTopTwenty -->
               <div class="row homesectionTitleBox  pt-3 pb-0 homekborder">
                  <div class="wrap-home-text specialCenter " >
                     <h3 class="homeTitle homePaddingBotTwenty"> 
                        {{$home->title}}
                     </h3>
                  </div>
               </div>
            </div>
            @endif
            @switch($home->type)   
            @case(0)  
            <!-- for videos  section -->
            <!-- homesectionTitleBox -->
            <div class="col-md-12 px-0">
               <div class="row homesectionTitleBox">
                  <div class="col-lg-7" >
                     <div id="demo" class="carousel slide YouTubehomesection" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                           @if(count($home->VideoLinks) > 0 )
                           @foreach($home->VideoLinks as $key => $videolink)
                           @php 
                           //$GetAPI = @GetYoutubeAPI($videolink->video_link);
                           //$thumbnail = @$GetAPI['thumbnail']['thumb'];
                           $video_link_data = @$videolink->right_video_link;
                           $video_link_thumbnail = @$videolink->video_link_thumbnail;
                           $video_link_title = @$videolink->video_link_title;
                           $video_link_duration = @$videolink->video_link_duration;
                           $video_link_description = @$videolink->video_link_description;
                           @endphp
                           <div class="carousel-item @if($key == 0) {{ 'active' }} @endif" onclick="homePageYoutubeUrl(this,'{{ @$videolink->id }}','main')">
                              <img src="{{ @$video_link_thumbnail }}" alt="Los Angeles" class="img-fluid">
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
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        </a>
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="row" style="display: flex;flex-direction: column;">
                        <div class="w-100 clearfix sideBarDiv col-12 mt-2 mt-lg-0" id="right_div">
                           @if(count($home->RightVideoLinks) > 0 )
                           @foreach($home->RightVideoLinks as $rightkey => $rightvideo)
                           @php 
                           $right_video_link_data = @$rightvideo->right_video_link;
                           $right_video_link_thumbnail = @$rightvideo->right_video_link_thumbnail;
                           $right_video_link_title = @$rightvideo->right_video_link_title;
                           $right_video_link_duration = @$rightvideo->right_video_link_duration;
                           $right_video_link_description =@$rightvideo->right_video_link_description;
                           @endphp
                           <a href="javascript:void(0);" onclick="homePageYoutubeUrl(this,'{{ @$rightvideo->id }}','right')">
                              <div class="d-flex mt-0 fullBoxWrap">
                                 <div class="mr-2">
                                    <img class="demo cursor sideImg" src="{{$right_video_link_thumbnail}}"  alt='' >
                                 </div>
                                 <div>
                                    <div>
                                       <p class="textBlack mb-1 movieName">{{substr(@$right_video_link_title,0,35)}}</p>
                                    </div>
                                    <div class="mt-1">
                                       <p class="textBlack mb-2">{{@$right_video_link_duration}}</p>
                                    </div>
                                 </div>
                              </div>
                           </a>
                           @endforeach
                           @endif
                        </div>
                     </div>
                  </div>
                  @php 
                  $str_page_name = Request::segment(1);   
                  $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
                  ->where('page_name', $str_page_name)
                  ->first();
                  $advertisement_category_id = 1;
                  if(!empty($advertisement_category_data->id))
                  {
                  $advertisement_category_id = $advertisement_category_data->id;   
                  }
                  $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 2])
                  // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
                  ->orderBy('id','desc')
                  ->first();
                  @endphp
                  <!-- <div class="col-md-12 pr-0 padRightFifteen addImgAlign text-center py-2">
                     <a href="{{@$advertisement->destination_link}}" class="span-style1" target="_blank">
                     <img src="{{@imageBasePath(@$advertisement->advertisement_image)}}" class="img-fluid text-center mb-2 addImgHome">
                     <h3 class="bannerBottomText text-center"> {{@$advertisement->sponsor_name}}</h3>
                     </a>
                     </div> -->
               </div>
            </div>
            @break
            <!-- for products -->
            @case(1)
            <div class="col-md-12 pTopTwenty">
               <div class="row homesectionBox HomeSectionSlider pb-0 circleBox">
                  <div class="owl-carousel circle_list_page_new owl-theme" id="div-toy-products">
                     @foreach ($home->products ?? [] as $product)
                     <div class="item">
                        <div class="Gallery-text-overlay-Image3">
                           <a target="_blank" href="{{ url('/') . '/product/'. @$product->product->slug }}">
                              <img data-src="{{@prodEventImageBasePath($product->product->main_image)}}" class="owl-lazy homeProfileCircle rounded-circle img-fluid">
                              <div class="overlayimages8 withoutOverlay">
                                 <strong>{{substr(@$product->product->name,0,75)}} </strong>
                              </div>
                           </a>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <!-- <div class="mt-2"><a class="span-style1" href="#">Browse more >></a></div> -->
               </div>
            </div>
            @break
            <!-- for events -->
            @case(2)
            <div class="col-md-12 pTopTwenty">
               <div class="row">
                  <div class="">
                     <div class="Gallery-overlay d-flex justify-content-between">
                        @foreach ($home->events ?? [] as $event)
                        <div class="Gallery-text-overlay-Image3">
                           <a target="_blank" href="{{ url('/') . '/event/'. @$event->event->slug }}">
                              <img src="{{@prodEventImageBasePath($event->event->main_image)}}"
                                 class="img-fluid imagesCover">
                              <div class="overlayimages8">\
                                 <strong>{{substr(@$event->event->name,0,75)}}</strong>
                              </div>
                           </a>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <!-- <div class="mt-2"><a class="span-style1" href="#{{ url('/') . '/user/event' }}"> Browse more >> </a></div> -->
                  <!-- <hr class="bg-dark"> -->
               </div>
            </div>
            @break
            {{--  
            @case(3)
            <!-- for news -->
            @if(!empty($news))
            <div class="col-md-12">
               <div class="row below_box_padding">
                  <div class="col-md-8 pl-0">
                     @include("front.user.modules.featured_news_page")
                  </div>
                  @php 
                  $str_page_name = Request::segment(1);   
                  $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
                  ->where('page_name', $str_page_name)
                  ->first();
                  $advertisement_category_id = 1;
                  if(!empty($advertisement_category_data->id))
                  {
                  $advertisement_category_id = $advertisement_category_data->id;   
                  }
                  $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 3])
                  // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
                  ->orderBy('id','desc')
                  ->first();
                  //pr($advertisement_category_data);
                  @endphp
                  <div class="col-md-4 paddingTopFifty">
                     <a href="{{@$advertisement->destination_link}}" class="span-style1 text-right " target="_blank">
                        <img src="{{@imageBasePath(@$advertisement->advertisement_image)}}" class="img-fluid mb-2 featuredImageAdd">
                        <h3 class="bannerBottomText text-right"> {{@$advertisement->sponsor_name}}</h3>
                     </a>
                  </div>
               </div>
            </div>
            @endif
            @break  --}}
            @case(4)
            <div class="row below_box_padding">
               <div class="col-md-12">
                  <div class="">
                     <div class="Gallery-overlay d-flex">
                        @foreach($home->birthDaysAndAnniversaries() ?? [] as $birthDaysAndAnniversaries)
                        <div class="Gallery-text-overlay-Image1">
                           <img src="{{@imageBasePath($birthDaysAndAnniversaries->profile_image)}}"
                              class="img-fluid imagesCover">
                           <div class="overlayimages5">{{@$birthDaysAndAnniversaries->first_name}}
                              {{@$birthDaysAndAnniversaries->last_name}}
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
                  <!-- <div class=" mt-2"><a href="#" class="span-style1">Browse more Birthdays and Anniversaries >></a></div> -->
                  <!-- <hr class="bg-dark"> -->
               </div>
            </div>
            @break
            @case(5)
            <!-- for polls vote now -->
            @if($poll)
            <?php /*
               <!-- <div class="row justify-content-center" >
               </div> -->
               
               
               <!-- <div class="col-md-12" style="background-color: #fff;">
               <div class="row homesectionTitleBox justify-content-center">
               <div class="">
                  <h3 class="pollHead paddingBottomTwenty mb-0">{{$poll->question ?? null}}</h3>
               </div>
               </div>
               <div class="row" style="padding: 0 0 20px 0;">
               <div class="col-md-12 d-flex justify-content-center">
                  <form method="POST" action="{{route('front.polls.submit')}}">
                    <input type="hidden" name="poll_id" value="{{$poll->id ?? null}}">
                    <div class="Gallery-overlay d-flex justify-content-between pr-0">
                      <ul class="nav pollnav d-flex justify-content-between">
                        @switch(@$poll->type)
                        @case(1)
                        @foreach(@$poll->products ?? [] as $product)
                        <li class="pool_list" style="background-image: url({{@prodEventImageBasePath(@$product->product->main_image)}});">
                           <div class="pollbox text-center">
                             <div class="check">
                               <input type="radio" class="pollradioBtn" name="option_id" value="{{@$product->id}}">
                               <i class="fa fa-check" class="text-black" aria-hidden="true"></i>
                             </div>
                             <div class="pollTextContent paddingTopvote">
                               <strong >{{substr(@$product->product->name,0,75)}}</strong>
                             </div>
                           </div>
                        </li>
                        @endforeach
                        @break
                        @case(2)
                        @foreach(@$poll->events ?? [] as $events)
                        <li class="pool_list" style="background-image: url({{@prodEventImageBasePath(@$events->event->main_image)}});">
                           <div class="pollbox text-center">
                             <div class="check">
                               <input type="radio" class="pollradioBtn" name="option_id" value="{{@$events->id}}">
                               <i class="fa fa-check" class="text-black" aria-hidden="true"></i>
                             </div>
                             <div class="pollTextContent paddingTopvote">
                               <strong class="text-black">{{substr(@$events->event->name,0,75)}}</strong>
                             </div>
                           </div>
                        </li>
                        @endforeach
                        @break
                        @case(3)
                        @foreach(@$poll->users ?? [] as $users)
                        <li class="pool_list" style="background-image: url({{ imageBasePath(@$users->user->main_image) }});">
                           <div class="pollbox text-center">
                             <div class="check">
                               <input type="radio" class="pollradioBtn" name="option_id" value="{{@$users->id}}">
                               <i class="fa fa-check" class="text-black" aria-hidden="true"></i>
                             </div>
                             <div class="pollTextContent paddingTopvote">
                               <strong class="text-black">{{substr(@$users->user->name,0,75)}}</strong>
                             </div>
                           </div>
                        </li>
                        @endforeach
                        @break
                        @endswitch
                      </ul>
                    </div>
                    <div class="row justify-content-center">
                      <button type="submit" class="btn kwatchlistbtn voteBtn text-center">Vote Now</button>
                    </div>
                    @csrf
                  </form>
               </div>
               </div>
               </div> -->
               <!-- </div> -->
               <!-- <hr class="bg-dark"> -->
               
               <!-- <div class="col-md-12 mt-4" style="background-color: #fff;">
               <div class="row homesectionTitleBox pt-3 pb-0 homekborder">
               <div class="wrap-home-text specialCenter" >
                  <h3 class="homeTitle homePaddingBotTwenty">
                    Companies of Play
                  </h3>
               </div>
               </div>
               </div> -->
               <!-- <div class="col-md-12 pTopTwenty" style="background-color: #fff;">
               <div class="row homesectionBox pb-0"> -->
               
                */ ?>
            @else
            <div class="col-md-12">
               <div class="row homesectionTitleBox justify-content-center">
                  <div class="">
                     <h3 class="text-muted">New Polls coming soon</h3>
                  </div>
               </div>
            </div>
            @endif
            @break
            @case(6)
            <!-- for an innovators or company users -->
            <?php /*@if($home->display_order == 0) */?>
            @php
            $arr_companies_list = array();
            $arr_innovators_list = array();       
            foreach ($home->users ?? [] as $users)
            {        
            $base_url = url('/');
            $user_current_info_new = $users->user;
            $int_user_id_new = $user_current_info_new->id;
            $str_user_url_new = '';
            $str_user_name = '';
            $str_profile_image = '';
            $str_user_name_snippet =  '';
            $str_user_name_snippet_original = '';
            $str_user_caption_url =  '';
            if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
            {
            $str_user_caption_url = $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
            $str_profile_image = @imageBasePath($user_current_info_new->profile_image);
            $str_user_name_snippet =  substr(@$str_user_name,0,75);
            if(!empty($user_current_info_new->home_page_slide_show_caption))
            {        
            $str_user_name_snippet_original = $user_current_info_new->home_page_slide_show_caption;
            $str_user_name_snippet = $str_user_name_snippet_original;
            $str_user_name_snippet = substr($str_user_name_snippet, 0, 35);
            $str_user_caption_url = $user_current_info_new->caption_url;
            } 
            if($user_current_info_new->role == 3)
            {
            $str_image_class_name =  'homeProfileCircle rounded-circle';                          
            $arr_companies_list[$int_user_id_new]['str_user_url_new'] = @$str_user_url_new;
            $arr_companies_list[$int_user_id_new]['str_user_name'] = @$str_user_name;
            $arr_companies_list[$int_user_id_new]['str_profile_image'] = @$str_profile_image;
            $arr_companies_list[$int_user_id_new]['str_user_name_snippet'] = @$str_user_name_snippet;
            $arr_companies_list[$int_user_id_new]['str_image_class_name'] = @$str_image_class_name;     
            $arr_companies_list[$int_user_id_new]['str_user_name_snippet_original'] = @$str_user_name_snippet_original;
            }
            else
            {
            $str_image_class_name =  'img-fluid imagesCover img_res_mob_dec';
            $arr_innovators_list[$int_user_id_new]['str_user_url_new'] = @$str_user_url_new;
            $arr_innovators_list[$int_user_id_new]['str_user_name'] = @$str_user_name;
            $arr_innovators_list[$int_user_id_new]['str_profile_image'] = @$str_profile_image;
            $arr_innovators_list[$int_user_id_new]['str_user_name_snippet'] = @$str_user_name_snippet;
            $arr_innovators_list[$int_user_id_new]['str_image_class_name'] = @$str_image_class_name;
            $arr_innovators_list[$int_user_id_new]['str_user_name_snippet_original'] = @$str_user_name_snippet_original;
            }
            }
            }
            @endphp
            @if(!empty($arr_companies_list) && count($arr_companies_list)>0) 
            {{-- for a company --}}
            <div class="col-md-12 pTopTwenty">
               <div class="row homesectionBox HomeSectionSlider pb-0 circleBox">
                  <div class="owl-carousel circle_list_page_new owl-theme">
                     @foreach ($arr_companies_list  as $arr_companies_list_row)              
                     <div class="item">
                        <div class="Gallery-text-overlay-Image3">
                           <a target="_blank" href="{{@$arr_companies_list_row['str_user_url_new']}}">
                              <img data-src="{{@$arr_companies_list_row['str_profile_image']}}" class="owl-lazy homeProfileCircle rounded-circle">
                              <div class="overlayimages8 withoutOverlay">
                                 <strong>{{@$arr_companies_list_row['str_user_name']}} </strong>
                              </div>
                           </a>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <!-- <div class="mt-2"><a class="span-style1" href="#">Browse more >></a></div> -->
               </div>
            </div>
            @endif
            @if(!empty($arr_innovators_list) && count($arr_innovators_list)>0)           
            {{-- for a innovator --}}
            <div class="col-md-12 pTopTwenty">
               <div class="row homesectionBox HomeSectionSlider pb-0" style="border-radius: 10px;margin-top: 0px;">
                  <!-- <div class="owl-carousel-helper"> -->
                  <div class="owl-carousel mainListCarousel MainCarouselSlider list_page owl-theme FeaturedPeople">
                     @foreach ($arr_innovators_list  as $arr_innovators_list_row)
                     <div class="item">
                        <div class="Gallery-text-overlay-Image3">
                           <a target="_blank" href="{{@$arr_innovators_list_row['str_user_url_new']}}">
                              <div class="tip" data-placement="top" title="{{@$arr_innovators_list_row['str_user_name_snippet_original']}}">
                                 <img data-src="{{@$arr_innovators_list_row['str_profile_image']}}" class="owl-lazy {{@$arr_innovators_list_row['str_image_class_name']}}">
                              </div>
                           </a>
                           <div class="overlayimages8 pl-2 mt-2">
                              <strong class="small1">
                                 <a target="_blank" href="{{@$arr_innovators_list_row['str_user_url_new']}}">
                                    <div class="firstname text-dark">
                                       {{@$arr_innovators_list_row['str_user_name']}} 
                                    </div>
                                 </a>
                                 @if(!empty($arr_innovators_list_row['str_user_name_snippet']))
                                 <a target="_blank" href="{{@$arr_innovators_list_row['str_user_caption_url']}}">
                                    <div class="secondname">
                                       ({{@$arr_innovators_list_row['str_user_name_snippet']}})
                                    </div>
                                 </a>
                                 @endif
                              </strong>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <!-- </div> -->
                  <!-- <div class="mt-2"><a class="span-style1" href="#{{ url('/') . '/user/product' }}">Browse more >></a></div> -->
                  <!-- <hr class="bg-dark"> -->
               </div>
            </div>
            @endif
            <?php /*
               <div class="col-md-12 pTopTwenty" style="background-color: #fff">
               <div class="row homesectionBox pb-0" style="border-radius: 10px;margin-top: 0px;">
               <!-- <div class="owl-carousel-helper"> -->
               <div class="owl-carousel mainListCarousel list_page owl-theme">
                  @foreach ($home->users ?? [] as $users)
                  @php
                  $base_url = url('/');
                  $user_current_info_new = $users->user;
                  $str_user_name = '';
                  @endphp
                  @if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
                  @php
                  $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
                  $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                  if($user_current_info_new->role == 3)
                  {
                  $str_image_class_name =  'homeProfileCircle rounded-circle';     
                  }
                  else
                  {
                  $str_image_class_name =  'img-fluid imagesCover img_res_mob_dec';
                  }
                  @endphp
                  {{-- for a company --}}
                  @if($user_current_info_new->role == 3)                                       
                  <div class="item mr-1">
                    <div class="Gallery-text-overlay-Image3">
                      <a  target="_blank" href="{{$str_user_url_new}}">
                        {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                        <div>
                           <img data-src="{{@imageBasePath($users->user->profile_image)}}" class="owl-lazy {{$str_image_class_name}}">
                        </div>
                        <div class="overlayimages8 pl-2">
                           <strong class="small1">{{substr(@$str_user_name,0,75)}} </strong>
                        </div>
                      </a>
                    </div>
                  </div>
                  {{-- for a innovator --}}
                  @else
                  <div class="item mr-1">
                    <div class="Gallery-text-overlay-Image3">
                      <a  target="_blank" href="{{$str_user_url_new}}">
                        {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                        <div>
                           <img data-src="{{@imageBasePath($users->user->profile_image)}}" class="owl-lazy {{$str_image_class_name}}">
                        </div>
                        <div class="overlayimages8 pl-2">
                           <strong class="small1">{{substr(@$str_user_name,0,75)}} 
                           @if(!empty($users->user->home_page_slide_show_caption))
                            <div>
                            ({{$users->user->home_page_slide_show_caption}})
                             </div>
                           @endif
                           </strong>
                        </div>
                      </a>
                    </div>
                  </div>
                  @endif                                       
                  @endif
                  @endforeach
               </div>
               <!-- </div> -->
               <!-- <div class="mt-2"><a class="span-style1" href="#{{ url('/') . '/user/product' }}">Browse more >></a></div> -->
               <!-- <hr class="bg-dark"> -->
               </div>
               </div> */?>
            <?php /*@endif
               @if($home->display_order == 4 || $home->display_order == 5 || $home->display_order == 6) 
               {{-- for companies or innovators --}}
               <div class="col-md-12 pTopTwenty" style="background-color: #fff;">
               <div class="row homesectionBox pb-0 circleBox">
               <div class="owl-carousel circle_list_page owl-theme">
                  @foreach ($home->users ?? [] as $users)
                  @php
                  $base_url = url('/');
                  $user_current_info_new = $users->user;
                  $str_user_name = '';
                  @endphp
                  @if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
                  @php
                  $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
                  $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                  if($user_current_info_new->role == 3)
                  {
                  $str_image_class_name =  'homeProfileCircle rounded-circle';      
                  }
                  else
                  {
                  $str_image_class_name =  'img-fluid imagesCover img_res_mob_dec';
                  }
                  @endphp
                  {{-- for a company --}}
                  @if($user_current_info_new->role == 3)                                      
                  <div class="item mr-1">
                    <div class="Gallery-text-overlay-Image3">
                      <a  target="_blank" href="{{$str_user_url_new}}">
                        {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                        <div>
                           <img src="{{@imageBasePath($users->user->profile_image)}}" class="{{$str_image_class_name}}">
                        </div>
                        <div class="overlayimages8 pl-2">
                           <strong class="small1">{{substr(@$str_user_name,0,75)}} </strong>
                        </div>
                      </a>
                    </div>
                  </div>
                  {{-- for a innovator --}}
                  @else
                  <div class="item mr-1">
                    <div class="Gallery-text-overlay-Image3">
                      <a  target="_blank" href="{{$str_user_url_new}}">
                        {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                        <div>
                           <img src="{{@imageBasePath($users->user->profile_image)}}" class="{{$str_image_class_name}}">
                        </div>
                        <div class="overlayimages8 pl-2">
                           <strong class="small1">{{substr(@$str_user_name,0,75)}} 
                           
                           @if(!empty($users->user->home_page_slide_show_caption))
                            <div>
                            ({{$users->user->home_page_slide_show_caption}})
                             </div>
                           @endif
                           </strong>
                        </div>
                      </a>
                    </div>
                  </div>
                  @endif                                      
                  @endif
                  @endforeach
               </div>
               <!-- <div class="mt-2"><a class="span-style1" href="#">Browse more >></a></div> -->
               </div>
               </div>*/?>
            <?php /*@endif */?>
            @break
            <!-- for brands -->
            @case(7)
            @if(count($home->brand_lists) > 0 )
            @php
            $int_is_owl_brandlist = 0;
            @endphp
            <div class="col-md-12 pTopTwenty">
               <div class="row homesectionBox HomeSectionSlider pb-0 circleBox">
                  @if(count($home->brand_lists)<=6)
                  @include("front.user.modules.home_brand_list_loop")
                  @else
                  @php
                  $int_is_owl_brandlist = 1;
                  @endphp                 
                  <div class="owl-carousel circle_list_page owl-theme">
                     @include("front.user.modules.home_brand_list_loop")
                  </div>
                  @endif   
                  <!-- <div class="mt-2"><a class="span-style1" href="#">Browse more >></a></div> -->
               </div>
            </div>
            @endif     
            @break
            @endswitch
         </div>
         @endforeach
         <div class="HomeFeedBox">
            <div class=" homesectionTitleBox pt-3 pb-0 homekborder">
               <div class="wrap-home-text specialCenter">
                  <h3 class="homeTitle homePaddingBotTwenty">Collections from our Readers - Send Us Yours!</h3>
               </div>
            </div>
            <div class="col-md-12 paddingTopTwenty">
               <!-- <div class="text-center">
                  <h3 class="pollHead paddingBottomTwenty mb-0 textPurple">Collections from our Readers - Send Us Yours!</h3>
                  </div> -->
               <div class="row homesectionBox HomeSectionSlider" style="border-radius: 10px;margin-top: 10px;">
                  @if(!empty($collection_data) && count($collection_data)>6  )
                  <div class="owl-carousel mainListCarousel MainCarouselSlider pollCarasoul list_page owl-theme popup-gallery">              
                     @include("front.user.modules.collection_loop")
                  </div>
                  @else
                  @include("front.user.modules.collection_loop")         
                  @endif   
               </div>
            </div>
         </div>
      </div>
      {{-- @if(!empty($news))
      <!--  <div class="NextbackgroundColor homesectionBox">
         <div class="wrap-text d-flex text-black">
             <h3>Did you know?</h3>
             <p class="span-style ml-auto ml-0">
                 @foreach ($news->categories ?? [] as $category)
                 <a href="#">
                     {{$category->category->name ?? null}}
                 </a>
                     @if($loop->remaining)
                     |
                     @else
                     &gt;</p>
                     @endif
                 @endforeach
         </div>
         <div class="col-md-12">
             <div class="row ">
                 <div class="container ">
                     <div class="wrap-gallery mt-2 mb">
                         <div class="row">
                             <div class="col-md-12">
                                 <img src="{{imageBasePath($news->featured_image)}}"
                                     class="img-fluid mr-3" align="left">
                                     <p class="mb-0"><strong>{{$news->title}}</strong></p>
                                     <p>{{$news->created_at->diffForHumans() ?? null}}</p>
                                     {!!@substr($news->description,0,300)!!}
                                     @if(strlen($news->description) > 300)
                                       ...
                                     @endif
                                     
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="mt-2" ><a class="span-style1" href="{{route('front.pages.news')}}">See more Top News &gt;&gt;</a></div>
             </div>
         </div>
         </div> -->
      @endif --}}
      <!-- <hr> -->
      @include('front.includes.join_mailing')
   </div>
</div>
<div class="col-md-3 RightColumnSection">
   <div class="HomeRightColumn">
      <div class="HomeRightColInnov">
         <a href="https://www.chitag.com/2021-innovation-conference" target="_blank">
            <div class="sideBarImage">
               <img src="{{ asset('front/images/popweek.png') }}" alt="sidebarbanner" class="img-fluid">
            </div>
         </a>
      </div>
                   
     
      <!--- ****************** || Recent Blogs || **************** --->
      @if(isset($recentBlogs_data) && count($recentBlogs_data)>0)
      <div class="popRecentBlog">
         <div class="RecentBlogHead mb-3">
            <h4 class="mb-0">Recent Blogs</h4>
         </div>
         <hr>
         @php 
         $str_blog_detail = 'front.pages.blog.detail'; 
         @endphp
         @foreach ($recentBlogs_data as $recentBlogs_row)
         <a href="{{route($str_blog_detail, $recentBlogs_row->slug)}}">
            <div class="RecentBlg mb-2 d-flex align-items-center">
               <div class="RecentBlogImage">
                  <img src="{{@newsBlogImageBasePath($recentBlogs_row->featured_image)}}" alt="Blog Image" class="img-fluid">
               </div>
               <div class="RecentBlogPara">
                  <h6 class="mb-1">{{ $recentBlogs_row->name }}</h6>
                  <p class="mb-0"> {{ $recentBlogs_row->title }}</p>
               </div>
            </div>
         </a>
         @endforeach
         <hr>
         <a href="{{ url('blog_pedia') }}" class="text-center d-block">See more</a>
      </div>
      @endif
      <!--- ****************** || Recent Blogs || **************** --->
      <div class="w-100 clearfix IncludeInRightSideBar">
         @include('front.includes.home-sidebar')
      </div>
      <div class="HomeRightColInnov">
         <a href="javascript:void(0);" target="_blank">
            <div class="sideBarImage">
               <img src="{{ asset('front/images/pop-right-banner.png') }}" alt="sidebarbanner" class="img-fluid">
            </div>
         </a>
      </div>
   </div>
   <!-- The Modal -->
   <div class="modal popfeedmodal" id="homePageAwardModelId">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- Modal body -->
            <div class="modal-body">
               <!--Welcome to your very own POP Feed!-->
               <div class="WelcomePopFeed">
                  <img src="http://pop.local.com/uploads/images/20200909060640w7HAWdh9oA.jpg" alt="WebHeader15" class="img-fluid">
                  <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
                  <a>Caption One </a> <br>
               </div>
               <!--Welcome to your very own POP Feed!-->
            </div>
         </div>
      </div>
   </div>
   <!--  Modal -->
</div>
@endsection
@section('scripts')
<script type="text/javascript"></script>
<script type="text/javascript">
   var poll_submitted = '{{ Session::has("poll_message") }}';
   $( document ).ready(function() {
    if(poll_submitted!="")
    {
     toastr.success('Your Poll has been submitted');
     <?php 
      Session::flash('poll_message', 0); 
       // $request->session()->forget('poll_message');
      Session::forget('poll_message', 0); 
      ?>
   }
   
   
   });
   setInterval(function () {
     $('.owl-carouselHomepageTest .owl-nav').removeClass('disabled');
     $('.CarouselWrapSlide .owl-nav').removeClass('disabled');
   }, 1000);
   
   
   function homePageYoutubeUrl(e,id,type) {
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
       });
      $.ajax({
           type: "GET",
           url: "{{ route('front.modal-youtube') }}",
           data:{"_token": "{{ csrf_token() }}",'id':id,'type':type},
           dataType:'json',
           success: function(data)
           {
               $('#DefaultModal').modal('show');
               $('#DefaultModal .modal-content').html(data.view);
           }
         });
   }


   
   function homePageAwardModel(e,id) {
      // $('#homePageAwardModelId').modal('show');
      $.ajax({
       url: "{{ route('front.home-page-award.modal') }}",
       type: 'POST',
       dataType: 'json',
       data: {"_token": "{{ csrf_token() }}",'id':id},
       success: function(data) {
        $('#homePageAwardModelId').modal('show');
        $('#homePageAwardModelId .modal-body').html(data.view);
   
         // $('.loadingType').hide();
       // $('.PostBody #post_from_data').html(data.view);
       
    }
   });
   }
   
</script>
<script >
   $('#video-gallery').lightGallery({
    width: '700px',
    height: '470px',
    mode: 'lg-fade',
    addClass: 'fixed-size',
    counter: false,
    download: false,
    startClass: '',
    enableSwipe: false,
    enableDrag: false,
    speed: 500,
    selector: '.item'
   });
   $('#right_div').lightGallery({
    width: '700px',
    height: '470px',
    mode: 'lg-fade',
    addClass: 'fixed-size',
    counter: false,
    download: false,
    startClass: '',
    enableSwipe: false,
    enableDrag: false,
    speed: 500,
    selector: '.item'
   });
   $('#sidebar_div').lightGallery({
    width: '700px',
    height: '470px',
    mode: 'lg-fade',
    addClass: 'fixed-size',
    counter: false,
    download: false,
    startClass: '',
    enableSwipe: false,
    enableDrag: false,
    speed: 500,
    selector: '.item'
   });
</script>
<script>
   var slideIndex = 1;
   setInterval(function(){ plusSlides(1); }, 25000);
   showSlides(slideIndex);
   // var myVar = setInterval(myTimer, 1000);
   
   // function myTimer() {
   //       window.location.reload(1);
   //  alert("hello");
   // }
   
   function plusSlides(n) {
      showSlides((slideIndex += n));
   }
   
   function currentSlide(n) {
      showSlides((slideIndex = n));
   }
   
   function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("myMainSlides");
      var dots = document.getElementsByClassName("demo");
   // var captionText = document.getElementById("caption");   
   if(slides && dots)
   {
    if (n > slides.length) {
       slideIndex = 1;
    }
    if (n < 1) {
       slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
   }
   for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
   }
   slides[slideIndex - 1].style.display = "block";
   
   if(dots[slideIndex - 1])
   {
      dots[slideIndex - 1].className += " active";
   }
    // captionText.innerHTML = dots[slideIndex - 1].nextElementSibling.innerHTML;
    // console.log(dots[slideIndex - 1].nextSibling.innerHTML);
   }
   
   }  
</script>
<script>
   $('.circle_list_page').owlCarousel({
      lazyLoad: true,
   
      margin:10,
      nav:false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
       0:{
        items:2.25
     },
     600:{
        items:3.35
     },
     1000:{
        items:6.35
     }
   }
   })
   
   
   
   $('.circle_list_page_new').owlCarousel({
      lazyLoad: true,
   // stagePadding: 50,
         // rtl:true,
         margin:5,
         nav:true,
         loop:true,
         dots:false,
         autoplay:true,
         autoplayTimeout:3000,
         autoplayHoverPause:true,
         responsive:{
            0:{
              items:1
           },
           350:{
             items:2
          },
          430:{
             items:2.62
          },
          575:{
             items:3.62
          },
          768:{
             items:3.25
          },
          991:{
           items:3.25
        },
        1199:{
           items:4.25
        }
     }
   })
   $( ".owl-prev").html('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>');
   $( ".owl-next").html('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>');
</script>
<script>
   $('.list_page').owlCarousel({
      lazyLoad: true,
   // stagePadding: 50,
         // rtl:true,
         margin:5,
         nav:true,
         loop:true,
         dots:false,
         autoplay:true,
         autoplayTimeout:3000,
         autoplayHoverPause:true,
         responsive:{
            0:{
              items:1
           },
   
           350:{
             items:2
          },
          430:{
             items:2.62
          },
          575:{
             items:3.62
          },
          768:{
             items:3.25
          },
          991:{
           items:3.25
        },
        1199:{
           items:4.25
        }
     }
   })
   $( ".owl-prev").html('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>');
   $( ".owl-next").html('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>');
</script>
<script>
   var owlhomepageAward = $('.CarouselWrapSlide');
   owlhomepageAward.owlCarousel({
     margin: 10,
     nav: true,
     loop:true,
     autoplay:true,
     autoplayTimeout:3000,
     autoplayHoverPause:true,
     responsive: {
       0: {
         items: 1
      },
      600: {
         items: 2.66
      },
      768:{
         items: 2
      },
      992: {
         items: 2
      },
      1080:{
         items: 2.66
      }
   }
   });
   $( ".owl-prev").html('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>');
   $( ".owl-next").html('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
   $('.popup-gallery').magnificPopup({
      delegate: 'a',
      type: 'image',
      gallery: {
         enabled: true,
         navigateByImgClick: true,
   preload: [0,1] // Will preload 0 - before current, and 1 after the current image
   },
   callbacks: {
   elementParse: function(item) {
      console.log(item.el[0].className);
      if(item.el[0].className == 'video') {
         item.type = 'iframe',
         item.iframe = {
          patterns: {
            youtube: {
        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
   
        id: 'v=', // String that splits URL in a two parts, second part should be %id%
         // Or null - full URL will be returned
         // Or a function that should return %id%, for example:
         // id: function(url) { return 'parsed id'; } 
   
        src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
     },
     vimeo: {
        index: 'vimeo.com/',
        id: '/',
        src: '//player.vimeo.com/video/%id%?autoplay=1'
     },
     gmaps: {
        index: '//maps.google.',
        src: '%id%&output=embed'
     }
   }
   }
   } else {
   item.type = 'image',
   item.tLoading = 'Loading image #%curr%...',
   item.mainClass = 'mfp-img-mobile',
   item.image = {
    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
   }
   }
   
   }
   }
   });
</script>
<script>
   $(function() {
     $( 'ul.pollnav li' ).on( 'click', function() {
        $( this ).parent().find( 'li.active' ).removeClass( 'active' );
        $( this ).addClass( 'active' );
        $('[name="option_id"]').prop('checked',false)
        $(this).find('[name="option_id"]').prop('checked',true);
     });
   });
</script>
@endsection