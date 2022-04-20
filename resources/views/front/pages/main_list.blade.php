@extends('front.layouts.pages')
@section('content')
@php
  $current_url_new = URL::current();
  $is_chk_kids_page_flag = 0;
if(strpos($current_url_new,'/pages/kids')>0)
  {
    $is_chk_kids_page_flag = 1;  
  }
  
  $int_main_list_display_order = 0;
  $int_main_list_video_flag = 0;
@endphp


<!-- <style>
.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot{
      display: none!important;
   }    
</style> -->

 
<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column bg-black1 krow_margin kproduct MultiSlider">
    <div class="First-column bg-black1 pt-0">

@if(!empty($is_chk_kids_page_flag))
<div class="col-md-12">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text-center">
                <img src="{{ url('/')}}/front/images/kidsBanner.png" class="img-fluid" >
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty($main_list_paragraph->description))
<div class="col-md-12 mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text-center">
            {{$main_list_paragraph->description}}
            </div>
        </div>
    </div>
</div>
@endif  

    @foreach ($main_list_page as $main_list) 
    
        @php
        $int_main_list_display_order = $main_list->display_order;
       
        if($int_main_list_display_order == 3 || $int_main_list_display_order == 11 || $int_main_list_display_order == 12 || $int_main_list_display_order == 13 || $int_main_list_display_order == 14 || $int_main_list_display_order == 15 || $int_main_list_display_order == 16)
        {
          $int_main_list_video_flag = 1; 
        }
        @endphp 
        
        {{-- for videos when there is no data --}}
        @if(empty($main_list->videos) || count($main_list->videos)<=0 && ($int_main_list_video_flag == 1))
            @continue;
        @endif  
        
        @if((!empty($main_list->videos) && count($main_list->videos)>0) 
        || (!empty($main_list->products) && count($main_list->products)>0) 
        || (!empty($main_list->events) && count($main_list->events)>0) 
        || (!empty($main_list->users) && count($main_list->users)>0) 
        || (!empty($main_list->companies) && count($main_list->companies)>0)  
        || (!empty($main_list->awards) && count($main_list->awards)>0)
        || (!empty($main_list->brand_lists) && count($main_list->brand_lists)>0))
        
            <div class="col-md-12">
                <div class="row homesectionTitleBox" style="border-bottom: 2px solid #f5c518;">
                    <div class="wrap-home-text specialCenter">
                        <h3 class="homeTitle mb-0">{{$main_list->title}}</h3>
                    </div>
                </div>
            </div>
        
            <!-- <div class="wrap-text text-white">
                <h3></h3>
            </div>  -->
            @switch($main_list->category_id)
                @case(1)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive userProfileSec mb-0 ">
                        {{-- for videos only --}}
                            @if($int_main_list_video_flag == 1)
                                @include("front.user.modules.main_list_videos")
                            @else
                                <div class="owl-carousel mainListCarousel owl-theme">
                                    @foreach ($main_list->products ?? [] as $product)
                                    <div class="item">
                                        <div class="Gallery-text-overlay-Image3">
                                            <a href="{{ url('/') . '/product/'. @$product->product->slug }}">
                                            <img src="{{@prodEventImageBasePath(@$product->product->main_image)}}"
                                                class="img-fluid imagesCover img_res_mob_dec">
                                                <div class="overlayimages8 text-center"><strong class="">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$product->product->name)}}</strong>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif  
                        </div>
                    </div>
                @break

                @case(2)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive  userProfileSec mb-0" >
                        {{-- for videos only --}}
                        @if($int_main_list_video_flag == 1)
                            @include("front.user.modules.main_list_videos")
                        @else
                            <div class="owl-carousel mainListCarousel owl-theme"><!-- _video -->
                                @foreach ($main_list->products ?? [] as $product)
                                    @if(!empty(@$product->product->slug))
                                        <div class="item">
                                            <div class="Gallery-text-overlay-Image3">
                                                <a href="{{ url('/') . '/product/'. @$product->product->slug }}">
                                                <img src="{{@prodEventImageBasePath($product->product->main_image)}}"
                                                    class="img-fluid imagesCover img_res_mob_dec" >
                                                    <div class="overlayimages8"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$product->product->name)}}</strong>
                                                        <!-- <br><small
                                                     class="small1">Release in: {{@$product->product->classification->launched}}</small> -->
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                            <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/product' }}">Browse more >></a></span> -->
                        @endif
                            <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break

                @case(5)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive  userProfileSec mb-0">
                            {{-- for videos only --}}
                            @if($int_main_list_video_flag == 1)
                                @include("front.user.modules.main_list_videos")
                            @else
                                <div class="owl-carousel mainListCarousel owl-theme kuv">
                                    @foreach ($main_list->events ?? [] as $event)
                                    <div class="item">
                                        <div class="Gallery-text-overlay-Image3">
                                            <a href="{{ url('/') . '/event/'. @$event->event->slug }}">
                                            <img src="{{@prodEventImageBasePath(@$event->event->main_image)}}"
                                                class="img-fluid imagesCover img_res_mob_dec">
                                            <div class="overlayimages8"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$event->event->name)}}</strong>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                            @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                                <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/event' }}"> Browse more >> </a></span> -->
                            @endif
                                <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break

                @case(3)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive  userProfileSec mb-0">
                            {{-- for videos only --}}
                            @if(($int_main_list_video_flag == 1))
                               @include("front.user.modules.main_list_videos")
                            @else
                              @if(!empty($main_list->companies) && count($main_list->companies)>0)  
                                <div class="owl-carousel userBrandPageSlider owl-theme">
                                    @foreach ($main_list->companies ?? [] as $users)
                                        @php
                                            $base_url = url('/');
                                            $user_current_info_new = $users->user;
                                            $str_user_name = '';
                                        @endphp
                                        @if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
                                            @php
                                                $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
                                                $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                                            @endphp
                                            <div class="item">
                                                <div class="Gallery-text-overlay-Image3">
                                                    <a href="{{@$str_user_url_new}}"> {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                                                    <img src="{{@imageBasePath($users->user->profile_image)}}"
                                                        class="img-fluid homeProfileCircle rounded-circle" >
                                                        <div class="overlayimages8"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$str_user_name)}}</strong>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                              @endif    
                            @endif
                            @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                                <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/product' }}">Browse more >></a></span> -->
                            @endif
                            <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break

                @case(4)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive userProfileSec mb-0">
                            {{-- for videos only --}}
                            @if($int_main_list_video_flag == 1)
                                @include("front.user.modules.main_list_videos")
                            @else
                                <div class="owl-carousel mainListCarousel owl-theme">
                                    @foreach ($main_list->users ?? [] as $users)
                                        @php
                                            $base_url = url('/');
                                            $user_current_info_new = $users->user;
                                            $str_user_name = '';
                                        @endphp
                                        @if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
                                            @php
                                                $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
                                                $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
                                            @endphp
                                            <div class="item">
                                                <div class="Gallery-text-overlay-Image3">
                                                    <a href="{{@$str_user_url_new}}"> {{-- {{ url('/') . '/inventors/'. $users->user->username }} --}}
                                                    <img src="{{@imageBasePath($users->user->profile_image)}}"
                                                        class="img-fluid imagesCover img_res_mob_dec" >
                                                        <div class="overlayimages8"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$str_user_name)}}</strong>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                                <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/product' }}">Browse more >></a></span> -->
                            @endif
                            <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break

                @case(6)
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive userProfileSec mb-0">
                            {{-- for videos only --}}
                            @if($int_main_list_video_flag == 1)
                                @include("front.user.modules.main_list_videos")
                            @else
                                <div class="owl-carousel mainListCarousel owl-theme">
                                    @foreach ($main_list->awards ?? [] as $award)
                                    <div class="item">
                                        <div class="Gallery-text-overlay-Image3">
                                            <a href="{{ url('/') . '/product/'. @$award->product->slug }}">
                                            <img src="{{@prodEventImageBasePath($award->product->main_image)}}"
                                                class="img-fluid imagesCover img_res_mob_dec">
                                                <div class="overlayimages8 text-center"><strong class="">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$award->product->name)}}</strong>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif  
                        </div>
                    </div>
                @break
                @case(7)
                
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive  userProfileSec mb-0" >
                        {{-- for videos only --}}
                        @if($int_main_list_video_flag == 1)
                            
                         @include("front.user.modules.main_list_videos")
                        
                        @else
                           <div class="owl-carousel mainListCarousel owl-theme"><!-- _video -->
                                @foreach ($main_list->brand_lists ?? [] as $brand_lists_row)
                                    @if(!empty(@$brand_lists_row->brand_list->slug))
                                        <div class="item">
                                            <div class="Gallery-text-overlay-Image3">
                                                <a href="{{ url('/') . '/brand/'. @$brand_lists_row->brand_list->slug }}">
                                                <img src="{{@imageBasePath($brand_lists_row->brand_list->main_image)}}"
                                                    class="img-fluid imagesCover img_res_mob_dec" >
                                                    <div class="overlayimages8"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$brand_lists_row->brand_list->name)}}</strong>
                                                        <!-- <br><small
                                                     class="small1">Release in: {{@$product->product->classification->launched}}</small> -->
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                            <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/product' }}">Browse more >></a></span> -->
                        @endif
                            <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break
                @case(8)
                
                    <div class="col-md-12 paddingYaxis1">
                        <div class="row homesectionBox pTopThityFive  userProfileSec mb-0" >
                        {{-- for videos only --}}
                        @if($int_main_list_video_flag == 1)
                            
                         @include("front.user.modules.main_list_videos")
                        
                        @endif
                        @if($int_main_list_display_order != 3 && $int_main_list_display_order != 11 && $int_main_list_display_order != 12 && $int_main_list_display_order != 13 && $int_main_list_display_order != 14 && $int_main_list_display_order != 15 && $int_main_list_display_order != 16)
                            <!-- <span class="span-style1 mt-5"><a href="{{ url('/') . '/user/product' }}">Browse more >></a></span> -->
                        @endif
                            <!-- <hr class="bg-dark"> -->
                        </div>
                    </div>
                @break
            @endswitch
            @if($loop->remaining)
            <!-- <hr class="bg-dark"> -->
            @endif
        @endif  
    @endforeach
        @if(count($main_list_page) == 0 && $type == 'awards' && @$i == 0)
            <div class="text-white award-page">
                <h3 class="text-center">POP Awards - The Top Selling Toys and Games of all Time </h3>
                <p class="text-white">Many toys and games have sold more units than the top selling songs, albums, movies and books of all time. We think it is time to give perspective and the importance due to toys and games. What better way than the POP Awards! Check out the numbers below!</p>
                <b>POP Diamond, 1 billion +</b>
                <ul>
                    <li>Barbie</li>
                    <li>Hot Wheels </li>
                    <li>LEGOs </li>
                    <li>Star Wars Action figures </li>
                </ul>
                <b>POP Platinum, 100 million +</b>
                <ul>
                    <li>Rubik's Cube</li>
                    <li>Radio Flyer Wagon </li>
                    <li>Silly Putty  </li>
                    <li>Duncan Yo-Yo  </li>
                    <li>G.I  </li>
                    <li>Etch-A-Sketch   </li>
                    <li>Mr. Potato Head  </li>
                    <li>Hula Hoop  </li>
                    <li>Super Soaker   </li>
                    <li>Nerf Blaster   </li>
                    <li>Uno    </li>
                    <li>Frisbee    </li>
                    <li>Monopoly    </li>
                </ul>
                <b>POP Gold, 25 million +</b>
                <ul>
                    <li>Jenga</li>
                    <li>Transformers     </li>
                    <li>Rummikub    </li>
                    <li>Settlers of Catan     </li>
                    <li>Easy Bake Oven     </li>
                    <li>Game of Life    </li>
                </ul>
                <b>POP Six Zeros Club,1 million +</b>
                <p class="text-white">(Why POP Six Zeros? Bronze seems like a consolation prize, it is a HUGE achievement to reach 1,000,000!)</p>
                <ul>
                    <li>Exploding Kittens </li>
                    <li>Blurt      </li>
                    <li>Hatchimals    </li>
                    <li>Zoomer     </li>
                    <li>Air Hogs      </li>
                </ul>
            </div>
            @php @$i = 1 @endphp
        @endif
    </div>
</div>
 
         @include('front.includes.join_mailing')
       
</div>
<style type="text/css">
    .award-page ul { list-style: inside; }
    .award-page ul li {
        color: white;
    }
</style>


@endsection

@section('scripts')


  <script>
      $('.mainListCarousel').owlCarousel({
     lazyLoad: true,
   // stagePadding: 50,
         // rtl:true,
         margin:10,
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
      $('.mainListCarousel_video').owlCarousel({

      lazyLoad: true,
   // stagePadding: 50,
         // rtl:true,
         margin:10,
     nav:true,
         
         loop:true,
         dots:false,
           autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:2.26
        },
        600:{
            items:3.22
        },
        1000:{
            items:3.22
        }
    }
})
 $( ".owl-prev").html('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>');
 $( ".owl-next").html('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>');

  </script>
  <script>

          $('.userBrandPageSlider').owlCarousel({
     lazyLoad: true,
   // stagePadding: 50,
         // rtl:true,
         margin:10,
         nav:false,
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
     items:2.25
  },
  991:{
    items:3.25
 },
 1199:{
    items:4.25
 }
         
         }
})


     
  </script>
  <script type="text/javascript">
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
  </script>
@include("front.includes.profile_js_scripts_include")
@endsection