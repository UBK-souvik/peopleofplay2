@extends('front.layouts.pages')
@section('content')
   <style>
      .YTtopContant img{
         height: 113px;
         width: 181px;
         border-radius: 0px;
      }
   </style>
   <div class="col-md-10">
      {{--
         <div class="YTtopContant text-center">
            <img src="{{ asset('front/images/mainLogo.png')}}" alt="WelcomeToPOPWeekHeader">
         </div>
         <div class="popModalContentTwo">
            <p>People of Play is the toy industry’s most comprehensive networking and resource hub; a social platform and industry portal where toy industry veterans, newbies, inventors, buyers, job seekers, recruiters, consumers, and others come to find each other. Get up-to-the-minute toy industry, event, and product news; participate in live online educational and networking events; browse a vast library of expert resources; and peruse and post to the industry’s only dedicated social feed.</p>
         </div>
      --}}

      <section class="w-100 clearfix popAboutUsBanner mt-4 mb-lg-5 mb-3" id="popAboutUsBanner">
         <div class="container">
            <div class="aboutTopBanner">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="leftSideImg text-center">
                              <img src="{{asset('front/images/icons/girl.png')}}" alt="BannerImg" class="img-fluid">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="rightSideContant pr-5 py-5 text-white">
                              <p><b>People of Play</b> is the toy industry's most comprehensive networking and resource hub; a social platform and industry portal where toy industry veterans, newbies, inventors, buyers, job seekers, recruiters, consumers, and others come to find each other.</p>

                              <p>Get up-to-the-minute toy industry, event, and product news; participate in live online educational and networking events; browse a vast library of expert resources; and peruse and post to the industry's only dedicated social feed.</p>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>



      <section class="w-100 clearfix popAboutUsEvents mb-lg-5 mb-3" id="popAboutUsEvents">
         <div class="container">
            <div class="aboutEventsSec">
                  <div class="row align-items-center">
                     <div class="col-md-8 col-xl-9">
                        <div class="leftSideEventsContant text-left">
                              <p>“We started with our CHITAG events and built community and visibility for inventors and innovators. With POP online, we've created a place where ALL in the industry <b>can come to find each other</b>.”</p>
                              <p><small>- Mary Couzin, Founder of People of Play</small></p>
                        </div>
                     </div>
                     <div class="col-md-4 col-xl-3">
                        <div class="rightSideEventsContant">
                              <img src="{{asset('front/images/icons/avtar-img')}}.png" alt="BannerImg" class="img-fluid">
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>

      <section class="w-100 clearfix popAboutUsCloumn mb-lg-5 mb-3" id="popAboutUsCloumn">
         <div class="container">
            <div class="aboutColumnSec">
                  <div class="card-deck">
                     <div class="card bgVolate">
                        <div class="card-body text-center">
                        <h2>JOIN</h2>
                        <p class="card-text">Magnify the power of your network by joining POP. Move your business forward with knowledge and connections.</p>
                        </div>
                     </div>
                     <div class="card bgVolate">
                        <div class="card-body text-center">
                        <h2>Advertise</h2>
                        <p class="card-text">Reach 350,000 toy industry leaders and enthusiasts. We have advertising packages for on-line, social media, and newsletters.</p>
                        </div>
                     </div>
                     <div class="card bgVolate">
                        <div class="card-body text-center">
                        <h2>Sponsor</h2>
                        <p class="card-text">Sponsor our events to associate your brand with innovation. Monthly POP Pubs, annual conference, TAGIE awards, Young Inventor challenge, and more.</p>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>

      <section class="w-100 clearfix popAboutUsReasonsJoin pt-lg-5 pt-3 mb-lg-5 mb-3" id="popAboutUsReasonsJoin">
         <div class="container">
            <div class="aboutReasonsJoinSec">
                  <div class="row">
                     <div class="col-12">
                        <div class="aboutReasonsHeading mb-5">
                              <h3>5 REASONS TO JOIN POP</h3>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="aboutReasonsDetails pl-lg-5 pl-sm-4 pl-3">
                              <div class="aboutReasonsDetailsInner mb-5">
                                 <div class="aboutDetailsHeading">
                                    <h4><span>1.</span> NETWORKING!</h4>
                                 </div>
                                 <div class="aboutDetailsPara">
                                    <p>If you've contacted Mary Couzin for advice on who to talk to, or if you have spent hours looking for someone who has the expertise to help you... this is the platform for you! The power of Mary's network has gone online! As a member you get powerful search tools to connect you to the right people to move your career or business forward.</p>
                                 </div>
                              </div>
                              <div class="aboutReasonsDetailsInner mb-5">
                                 <div class="aboutDetailsHeading">
                                    <h4><span>2.</span> STRUT YOUR STUFF</h4>
                                 </div>
                                 <div class="aboutDetailsPara">
                                    <p>Visibility makes things happen! Participate in the POP community to bring attention to your products or services. Create a profile, add products to the POP database, share your knowledge in the wiki, post in classifieds, and share news and announcements on the POP homepage feed.
                                    </p>
                                 </div>
                              </div>
                              <div class="aboutReasonsDetailsInner mb-5">
                                 <div class="aboutDetailsHeading">
                                    <h4><span>3.</span> BUILD KNOWLEDGE</h4>
                                 </div>
                                 <div class="aboutDetailsPara">
                                    <p>Access tens of thousands of articles, profiles, interviews, videos, and more.</p>
                                 </div>
                              </div>
                              <div class="aboutReasonsDetailsInner mb-5">
                                 <div class="aboutDetailsHeading">
                                    <h4><span>4.</span> ATTEND EVENTS</h4>
                                 </div>
                                 <div class="aboutDetailsPara">
                                    <p>Mingle with other members at private POP networking events, be a part of important career and business building events for specific communities such as educators, consumers, marketing, pr, pro/new inventors and more - the largest and longest running in our industry.</p>
                                 </div>
                              </div>
                              <div class="aboutReasonsDetailsInner mb-5">
                                 <div class="aboutDetailsHeading">
                                    <h4><span>5.</span> EVERYBODY'S DOING IT</h4>
                                 </div>
                                 <div class="aboutDetailsPara">
                                    <p>Membership is assessable, with several tiers from free to "company-wide. That means that everyone in the industry can, and should, join People of Play! </p>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>



      @if(!Auth::guard('users')->check())
      <section class="w-100 clearfix popAboutUsMiddleBanner pt-lg-5 pt-3 mb-lg-5 mb-3" id="popAboutUsMiddleBanner">
         <div class="container">
            <div class="aboutReasonsMiddleBanner">
                  <div class="row">
                     <div class="col-12">
                        <div class="jumbotron bannerJumbotron text-center">
                              <p class="mb-5">People of Play's mission is to connect, support, and inform the POP community. </p>
                              <a href="{{route('front.sign-up')}}" class="btn aboutMiddleBannerBtn">JOIN POP</a>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>
      @endif

      
      <section class="w-100 clearfix popAboutUsTestimonial mb-lg-5 mb-3" id="popAboutUsTestimonial">
         <div class="container">
            <div class="aboutTestimonialSec">
                  <div class="aboutTestimonial">
                     <div class="testimonialSlider owl-carousel">
                        <?php for($i=0; $i<8; $i++){ ?>
                        <div class="item">
                              <a href="{{$slider['profile_url'][$i]}}">
                                 <div class="row">
                                    <div class="col-md-4 col-xl-3">
                                       <div class="rightSideEventsContant text-center position-relative">
                                             <img src="{{$slider['image'][$i]}}" alt="BannerImg" class="img-fluid">
                                             <div class="quoteImg position-absolute">
                                                <img src="{{asset('front/images/icons/quote.png')}}" alt="quoteImg" class="img-fluid">
                                             </div>
                                       </div>
                                    </div>
                                    <div class="col-md-8 col-xl-9">
                                       <div class="leftSideEventsContant text-left py-4 text-dark">
                                             <p>{{$slider['testi_text'][$i]}}</p>
                                             <p><small>{{$slider['name'][$i]}}</small></p>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
            </div>
            <hr class="horizontalLine">
         </div>
      </section>


      <section class="w-100 clearfix popAboutUsOurMission pt-lg-5 pt-3 mb-lg-5 mb-3" id="popAboutUsOurMission">
         <div class="container">
            <div class="aboutReasonsOurMission">
                  <div class="row">
                     <div class="col-12">
                        <div class="aboutReasonsHeading mb-4">
                              <h3>Our Mission</h3>
                        </div>
                        <div class="aboutReasonsOurMission mb-5">
                              <ol class="nav">
                                 <li>To Connect the POP Community: toy and game inventors, developers, factories, suppliers, developers, marketers, salespeople, retailers, shoppers, members of the media – all play stakeholders.</li>
                                 <li>To Support the POP Community: POP events, pub events, and internet platform.</li>
                                 <li>To Inform the POP Community: newsletters, seminars, on-line resources, and 24/7 news feed.</li>
                              </ol>
                        </div>
                        <div class="aboutReasonsHeading mb-4">
                              <h3>Our Vision</h3>
                        </div>
                        <div class="aboutReasonsOurVision mb-5">
                              <ul class="nav">
                                 <li>To be the most comprehensive network in the worldwide community of play.</li>
                              </ul>
                        </div>
                        <div class="aboutReasonsHeading mb-4">
                              <h3>Our Values</h3>
                        </div>
                        <div class="aboutReasonsOurValues mb-5">
                              <ul class="nav">
                                 <li>We believe in the power of play as a necessary component of child development.</li>
                                 <li>We believe that the people in the Toy & Game Industry are dedicated to bringing joy and happiness to children of all ages throughout the world.</li>
                                 <li>We believe that Innovation and Creativity are the driving forces for industry growth and relevance.</li>
                              </ul>
                        </div>
                        <a href="https://www.chitag.com/about-chitag" class="btn aboutListBtn mb-5" target="_blank">Meet Our Team</a>
                     </div>
                  </div>
            </div>
            <hr class="horizontalLine">
         </div>
      </section>
      
      <section class="w-100 clearfix popAboutUsOurContact pt-lg-5 pt-3 mb-lg-5 mb-3" id="popAboutUsOurContact">
         <div class="container">
            <div class="aboutReasonsContact">
                  <div class="row">
                     <div class="col-12">
                        <div class="aboutReContact mb-4">
                              <h3>CONTACT US</h3>
                        </div>
                        <div class="contanctUsform">
                           <form class="formstyle px-3 mt-2" id="contactUsForm">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="password" class="textPurple">Name</label>
                                       <input type="text" class="form-control" placeholder="" name="contact_name" id="contact_name">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="EmailID" class="textPurple">Email</label>
                                       <input type="email" class="form-control" placeholder="" name="contact_email" id="contact_email" required="required" data-error="Email Id is required.">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="text" class="textPurple">Mobile</label>
                                       <input type="text" class="form-control" placeholder="" name="contact_mobile" id="contact_mobile">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="text" class="textPurple">Subject</label>
                                       <input type="text" class="form-control" placeholder="" name="contact_subject" id="contact_subject">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="text" class="textPurple">Message</label>
                                       <textarea class="form-control" rows="4" name="contact_message" id="contact_message"></textarea>
                                    </div>
                                 </div>
                                 
                                 
                                 <div class="col-md-12">
                                    <div class="mt-0 mt-md-2 text-center">
                                       <button type="submit" id="btnContactUsSave" class="btn RedButton w-50">Submit</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>

   </div>

   

@endsection
@section('scripts')
<script>
    $('.testimonialSlider').owlCarousel({
        margin: 10,
        nav: false,
        dots:true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
    
   $(function($) {

            $(document).on('click','#btnContactUsSave',function(e){
                e.preventDefault();

                toastr.remove();

                var fd = new FormData($('#contactUsForm')[0]);
				
				var str_response =  $('#recaptchaResponse').val();
				
                $.ajax({
                    url: "{{ route('front.contact-us.save') }}",
                    //data: fd,
                    data: {
					"contact_name":$('input[name="contact_name"]').val(),
					"contact_email":$('input[name="contact_email"]').val(),
					"contact_mobile":$('input[name="contact_mobile"]').val(),
					"contact_subject":$('input[name="contact_subject"]').val(),
					"contact_message":$('#contact_message').val(),
               "about_contact":"yes",
					"g_recaptcha_response": str_response,
					"recaptcha_response":$('input[name="recaptcha_response"]').val()
					},
					headers: {
			     'X-CSRF-TOKEN': ajax_csrf_token_new
			    },
					//processData: false,
                    //contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#btnContactUsSave').attr('disabled',true);
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#btnContactUsSave').attr('disabled',false);

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        console.log(msg);
                        // $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        // $('#btnContactUsSave').attr('disabled',false);
                        // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        //toastr.success("Contact Data Saved Successfully")
                        window.location.reload();

                    }
                });
            });
        });
		
   var contact_data_saved_flag = '{{ Session::has("contact_data_saved_flag") }}';
    // window on load event
   function contactSaveMessage(){
     
     if(contact_data_saved_flag!="")
     {
       toastr.success("Contact form submitted successfully.");
     }
     
   }
   window.onload = contactSaveMessage;
</script>
</script>
@endsection