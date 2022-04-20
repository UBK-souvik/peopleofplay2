@extends('front.layouts.pages')
@section('content')
<style>
   .headTopContainer img{
   width: max-width:500px;height: 260px;object-fit:cover;
   }
   .galleryContainer{
   background-color: #FFE133;padding: 50px 0;
   border-radius: 12px;
   box-shadow: 0px 4px 4px #8c8c8c;
   }
   .galleryBox {
   border: 5px solid #662c92;
   border-radius: 5px;
   background-color: #662c92;
   /* width: 225px; */
   margin: 0 auto;
   height: 100%;
   }
   .galleryBox img {
   border-radius: 5px;
   width: auto;
   height: auto;
   }
   .galleryBox .nameWrap{
   background-color: #662C92;color: #fff;
   }
   .pubDesc {
   font-size: 18px;
   }
   @media only screen and (max-width: 600px) {
   .headText {
   font-size: 30px;
   }
   .pubDesc{
   font-size: 16px;
   }
   }
   .First-column{
      border:1px solid #cdcdcd !important;
      border-radius: 10px;
   }
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   {{--
      <div class="First-column bg-white p-3">
         <section>
            <div class="container headTopContainer Pop-Pub">
               <div class="text-center mt-3">
                  <h1 class="mt-3 font-weight-bold headText">Welcome to <span class="textPurple">POP</span> Pub!</h1>
                  <!-- <h5 class="mt-4 font-weight-bold" style="line-height: 1.4;">INTERNATIONAL INNOVATION SUMMIT</h5>
                     <h5 class="mt-3 font-weight-bold mt-4">POP Networking rooms open <span class="text-danger"> 24 hours </span> a day from November 16th-20th!</h5>
                     
                     <h3 class="mt-5 font-weight-bold textPurple font-weight-bold">Thank you to our esteemed sponsors!</h3>
                     
                     <img class="mt-3" src="https://static.wixstatic.com/media/df6cd8_6492ff07fb2e488882169fc6f0212212~mv2.jpg/v1/fill/w_933,h_429,al_c,q_85/Conference%20Sponsors.webp"> -->
               </div>
            </div>
         </section>
         <section>
            <div class="container text-center pt-3 pb-3">
               <!-- <h4 class="textPurple font-weight-bold">POP, FIZZ, CHEERS!</h4>
                  <h5 class="font-weight-bold font-italic mt-4">After Hours Conference Networking Zoom Rooms! </h5> -->
               <div class="pb-3">
                  <!-- <img src="https://static.wixstatic.com/media/b68856_f6f43ff9f4b74d2eb58dd68e4c3346a8~mv2.png/v1/fill/w_305,h_321,al_c,lg_1,q_85/GreenOpenDoor.webp" class="img-fluid" style="width: 250px;"> -->
                  <p class="pubDesc">{!! nl2br($pub_heading->description) !!}</p>
                  <hr class="pubhorz">
                  <p class="pubDesc" style="color:red; font-weight:500;">{!! nl2br($pub_heading->description_2) !!}</p>
               </div>
            </div>
         </section>
         <section class="galleryContainer px-4 px-lg-0">
            <div class="row text-center">
               <div class="col-lg-1 col-12 px-lg-1 px-5"></div>
               <div class="col-lg-1 col-12 px-lg-1 px-5"></div>
               <div class="col-md-6 col-lg-2 col-sm-6 mb-4">
                  <div class="galleryBox">
                     <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09" target="_blank">
                        <img src="https://static.wixstatic.com/media/b68856_d8a8f9f4003f40ec9f591c3a5298d9ec~mv2.png/v1/fill/w_215,h_215,al_c,q_85,usm_0.66_1.00_0.01/Uno-Room.webp" class="img-fluid">
                        <div class="overlayimages8 text-center nameWrap">
                           <strong class="small1">Uno Room </strong>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2 col-sm-6 mb-4">
                  <div class="galleryBox">
                     <a href="https://us02web.zoom.us/j/5155383491?pwd=Y1drWWMxRG5vcVRadmVEckxBNVZuZz09" target="_blank">
                        <img src="https://static.wixstatic.com/media/df6cd8_e1dbfbb6c7e34799bd8cf8fa7ccfb14e~mv2.png/v1/fill/w_215,h_214,al_c,q_85,usm_0.66_1.00_0.01/Jenga%20Room.webp" class="img-fluid">
                        <div class="overlayimages8 text-center nameWrap">
                           <strong class="small1">Jenga Room</strong>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2 col-sm-6 mb-4">
                  <div class="galleryBox">
                     <a href="https://us02web.zoom.us/j/7416395446?pwd=TkgrRFV5ai9adzgwazBneVpwd1BZZz09" target="_blank">
                        <img src="https://static.wixstatic.com/media/b68856_76c889b1e65e470e9867f1c7dfb2ab52~mv2.png/v1/fill/w_215,h_215,al_c,q_85,usm_0.66_1.00_0.01/Burping-Bobby-Room.webp" class="img-fluid">
                        <div class="overlayimages8 text-center nameWrap">
                           <strong class="small1">Burping Bobby Room </strong>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2 col-sm-6 mb-4">
                  <div class="galleryBox">
                     <a href="https://us02web.zoom.us/j/4296772027?pwd=aVF4aXJOSnNFcy80Tm5QOXpNcllTZz09" target="_blank">
                        <img src="https://static.wixstatic.com/media/b68856_30e3cad240db4a3abf014aa076900b63~mv2.png/v1/fill/w_215,h_215,al_c,q_85,usm_0.66_1.00_0.01/Hatchimals-Room.webp" class="img-fluid">
                        <div class="overlayimages8 text-center nameWrap">
                           <strong class="small1">Hatchimals Room </strong>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-lg-1 col-12 px-lg-1 px-5"></div>
            </div>
         </section>
      </div>
   --}}

   <div class="container mt-4">
      <div class="row">
            <div class="col-md-3">
               <div class="leftSideBar">
                     <ul class="nav flex-column text-right">
                        <li class="nav-item">
                           <a class="nav-link" href="#">Directory</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Virtual Pub</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('service-providers') }}">Office Hours</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/pop-classified')}}">Classifieds</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('/')}}">Social Feed</a>
                        </li>
                     </ul>
               </div>
            </div>
         <div class="col-md-9">
            <!--Pop Pub Banner-->
            <section class="W-100 clearfix popPubBanner" id="popPubBanner">
                  <div class="popPubImage position-relative">
                     <img src="{{asset('uploads/images/pub/poppub_banner.png')}}" alt="popPub" class="img-fluid">
                     <div class="popPubtextGraphic position-absolute">
                        <img src="{{asset('uploads/images/pub/Pop_pub_text_graphic.png')}}" alt="poppubtextgraphic" class="img-fluid">
                     </div>
                  </div>
            </section>
            <!--Pop Pub Contant-->
            <section class="W-100 clearfix popPubContant mt-5" id="popPubContant">
                  <div class="popPubContant">
                     <p class="pubDesc">{!! nl2br($pub_heading->description) !!}</p>
                     <p class="pubDesc"><b>{!! nl2br($pub_heading->description_2) !!} </b></p>
                  </div>
            </section>
            <!--Horizontal Line-->
            <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                  <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
            </section>
            <!--Horizontal Line-->
            <!--Mingling Space-->
            @if(!empty(@$pub_featured_rooms))
               <section class="W-100 clearfix minglingSpace mt-5" id="minglingSpace">                  
                  <div class="row justify-content-center">
                     <div class="col-md-4">
                     <a href="{{@$pub_featured_rooms->url}}">
                        <div class="minglingSpaceImage text-center text-dark">
                              <img src="{{asset('uploads/images/pub/'.@$pub_featured_rooms->image)}}" alt="popPub" class="img-fluid">
                              <h5 class="mb-0">{{ucwords(@$pub_featured_rooms->heading)}}</h5>
                              
                        </div>
                     </a>
                     </div>
                     <a href="{{@$pub_featured_rooms->url}}">
                     <div class="col-md-4">
                        <div class="minglingSpacePara text-center">
                           <h2 class="mb-4 text-dark">MINGLING SPACE</h2>
                           <p class="mb-4 text-dark">Be the first to enter.<br>
                              We'll invite others to join you!</p>
                           <a class="btn" href="{{@$pub_featured_rooms->url}}">JOIN ROOM</a>
                        </div>
                     </div>
                     </a>
                  </div>
               </section>
                  <!--Mingling Space-->
                  <!--Horizontal Line-->
               <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                     <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               </section>
            @endif
            <!--Horizontal Line-->
            <!--Meeting Line-->
            @if(!empty(@$pub_meeting_rooms->toArray()))
               <section class="W-100 clearfix meetingSpace mb-4" id="horizontalLine">
                     <div class="meetingHeading mb-5">
                        <p><span>MEETING SPACE</span> Hop into a room for a meeting. You are welcome here anytime!</p>
                     </div>
                     <div class="row">
                        @foreach($pub_meeting_rooms as $pub_meeting_room)
                           @if(@$pub_meeting_room->type == 0)
                           <a href="{{@$pub_meeting_room->url}}">
                              <div class="col-md-4 col-sm-6">
                                 <div class="meetingSpaceOuter">
                                       <div class="meetingSpaceImg">
                                          <img src="{{asset('uploads/images/pub/'.@$pub_meeting_room->image)}}" alt="image2" class="img-fluid">
                                       </div>
                                       <div class="meetingSpaceConnect text-center text-dark">
                                          <h5 class="mb-1">{{ucwords(@$pub_meeting_room->heading)}}</h5>
                                       </div>
                                       <div class="meetingSpaceBtn text-center">
                                          <a class="btn" href="{{@$pub_meeting_room->url}}">JOIN ROOM</a>
                                       </div>
                                 </div>
                              </div>
                           </a>
                           @endif
                        @endforeach
                     </div>
               </section>
               <!--Meeting Line-->
                  <!--Horizontal Line-->
               <section class="W-100 clearfix horizontalLine py-2" id="horizontalLine">
                     <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               </section>
            @endif
            <!--Horizontal Line-->
         </div>
         {{--
         <div class="col-md-3">
            <div class="rightSideBar text-center">
               <div class="topRightSidebarHead">
                  <h4>UPCOMING <br>Hosted Events</h4>
               </div>
               <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               <div class="monthlyPopPub text-center">
                     <div class="monthlyPopPubImg mb-2">
                        <img src="{{asset('uploads/images/pub/monthly.png')}}" alt="monthly" class="img-fluid">
                     </div>
                     <div class="monthlyPopPubTxt">
                        <p>(Time shown in your time zone) Meet in the Uno Room.</p>
                     </div>
               </div>
               <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               <div class="monthlyPopPub text-center">
                     <div class="monthlyPopPubImg mb-2">
                        <img src="{{asset('uploads/images/pub/monthly.png')}}" alt="monthly" class="img-fluid">
                     </div>
                     <div class="monthlyPopPubTxt">
                        <p>(Time shown in your time zone) Meet in the Uno Room.</p>
                     </div>
               </div>
               <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               <div class="monthlyPopPub text-center">
                     <div class="monthlyPopPubImg mb-2">
                        <img src="{{asset('uploads/images/pub/monthly.png')}}" alt="monthly" class="img-fluid">
                     </div>
                     <div class="monthlyPopPubTxt">
                        <p>(Time shown in your time zone) Meet in the Uno Room.</p>
                     </div>
               </div>
               <hr class="hrHorizontal" style="border-top: 1px solid #C4C4C4;">
               <div class="neverMissEvent">
                     <p>Never miss an event:</p>
                     <a href="#" class="btn btn-outline-primary">Join Mailing List</a>
               </div>
            </div>
         </div>
         --}}
      </div>
      </div>

   </div>
@endsection