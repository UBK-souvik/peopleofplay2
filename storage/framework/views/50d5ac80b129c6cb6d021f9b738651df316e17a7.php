
<?php $__env->startSection('style_new'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('front/new_css/homepage.css?'.time())); ?>">
   <style>
      .homePaddingBotTwenty{
      padding-bottom: 0px!important;
      margin-bottom: 0;
      }
      .pr-sm-3, .px-sm-3 {
      padding-right:0rem!important;
      }
   </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('front/new_css/youtube-premieres.css')); ?>">
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="YoutubePremieres">
      <!--   <div class="homepagebanner mb-1">
         <img src="<?php echo e(asset('front/images/WebHeader17.png')); ?>" alt="WebHeader15" class="img-fluid">
         </div> -->
      <div class="YTtopContant text-center">
         <img src="<?php echo e(asset('front/images/WebHeader17.png')); ?>" alt="WelcomeToPOPWeekHeader" class="img-fluid">
      </div>
      <div class="YTtopContant text-center my-4">
         <h6 class="">POP Week, November 15 – 20th, was Sensational!</h6>
         <p class="mb-0">If you missed the POP Duos: Leaders & Legends Talks, 
            the TAGIE Awards and the Young Inventor Challenge Awards . . . 
            You can still enjoy them below and then in our all new <a href="javascript:void(0);">‘POP’ulated Wiki!</a>
         </p>
      </div>
      <!-- Monday -->
      <div class="WeekSchedule mb-3" id="monday">
         <div class="WeekScheduleHead text-center">
            <p>POP Duo Keynotes: Leaders & Legends Explore Creativity
            <p>
         </div>
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=Fg6fYZTdmK0');
                   ?>
            </div>
            <div class="YouTubeLinkTwo youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=xnzw_ZXW71w');
                   ?>
            </div>
         </div>
      </div>
      <!-- Monday -->
      <!-- Tuesday -->
      <div class="WeekSchedule mb-3" id="tuesday">
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=jsEeZKzm5ss');
                ?>
            </div>
            <div class="YouTubeLinkTwo youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=xhiDgKzvvNc');
                ?>
            </div>
         </div>
      </div>
      <!-- Tuesday -->
      <!-- Wednesday --> 
      <div class="WeekSchedule mb-3" id="wednesday">
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=RtuccV7NG6A');
                   ?>
            </div>
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=59CLGFpmkRI');
                   ?>
            </div>
         </div>
      </div>
      <!-- Wednesday -->
      <!-- Thursday -->
      <div class="WeekSchedule mb-3" id="thursday">
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=c0ViRh3IboI');
                   ?>
            </div>
            <div class="YouTubeLinkTwo youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=nm9R6sDOTho');
                   ?>
            </div>
         </div>
      </div>
      <!-- Thursday -->
      <!-- Friday -->
      <div class="WeekSchedule mb-3" id="friday">
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=wLlI4kAx73s');
                   ?>
            </div>
         </div>
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=SoW_RA0RUdY');
                   ?>
            </div>
         </div>
         <div clas="py-4">
            <div class="WeekScheduleHead text-center">
               <p>The Toy & Game International Excellence Awards! The TAGIEs!
               <p>
            </div>
         </div>
         <div class="WeekScheduleYouTube">
            <div class="YouTubeLinkOne youtubelink mb-2">
               <!-- <video width="100%" controls loop autoplay muted>
                  <source src="<?php echo e(asset('front/images/TAGIE_w_Bal_ Bouncing_from_POP.mp4')); ?>" type="video/mp4">
                  
                  Your browser does not support the video tag.
                  </video> -->
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=r08MLtm7Jf4');
                   ?>
            </div>
         </div>
         <!-- <div class="WeekScheduleBanner">
            <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner5.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
            </div> -->
      </div>
      <!-- Friday -->
      <!-- Saturday -->
      <div class="WeekSchedule mb-3" id="saturday">
         <div class="WeekScheduleHead text-center">
            <p>Saturday, November 20th Young Inventor Challenge Awards! Chicago Toy & Game Fair POP Channels!
            <p>
         </div>
         <div class="WeekScheduleYouTube">
            <div class="WeekScheduleBanner">
               <?php
                  echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=ZIYX3i22mO4');
                   ?>
            </div>
         </div>
         <div class="WeekSchedulePara text-center pb-0">
            <div class="WeekScheduleHead">
               <p>Chicago Toy & Game Fair
               <p>
            </div>
            <p>There is something for everyone at our virtual Fair! </p>
            <p class="mb-0">In addition to the Young Inventor Challenge, we have Stages of Entertainment and Experiences from your favorite toy and game companies and $1,250 in Prizes we are giving away until December 31st. Enter Today! </p>
         </div>
         <!-- <div class="WeekScheduleBanner">-->
         <!--     <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner6.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>-->
         <!--</div> -->
      </div>
      <!-- Saturday -->
      <a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
      <div class="homepagebanner mt-4 text-center">
         <a href="javascript:void(0);" target="_blank"> <img src="<?php echo e(asset('front/images/2021_POP_Week_sponsors_January_2022.jpg')); ?>" alt="POP-Week-sponsors-October-2021" class="img-fluid"></a>
      </div>
   </div>
</div>
<div class="col-md-3 RightColumnSection">
   <div class="HomeRightColumn">
      <!--  <div class="HomeRightColInnov">
         <a href="https://www.chitag.com/2021-innovation-conference" target="_blank">
         <div class="sideBarImage">
            <img src="<?php echo e(asset('front/images/popweek.png')); ?>" alt="sidebarbanner" class="img-fluid">
         </div>
         </a>
         </div> -->
      <div class="w-100 clearfix IncludeInRightSideBar">
         <?php echo $__env->make('front.includes.home-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
      <div class="HomeRightColInnov">
         <a href="https://bpmsagency.com/" target="_blank">
            <div class="sideBarImage">
               <img src="<?php echo e(asset('front/images/pop-right-banner.png')); ?>" alt="sidebarbanner" class="img-fluid">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript"></script>
<script type="text/javascript">
   var poll_submitted = '<?php echo e(Session::has("poll_message")); ?>';
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
   
   
   
   function homePageAwardModel(e,id) {
      // $('#homePageAwardModelId').modal('show');
    $.ajax({
        url: "<?php echo e(route('front.home-page-award.modal')); ?>",
        type: 'POST',
        dataType: 'json',
        data: {"_token": "<?php echo e(csrf_token()); ?>",'id':id},
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
   
      //   src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
        src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe. 
     },
     vimeo: {
       index: 'vimeo.com/',
       id: '/',
      //  src: '//player.vimeo.com/video/%id%?autoplay=1'
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
   
   $(document).ready(function(){
   
   
   $('.PremieresButtonGroup .YoutubeinnerButton a[href^="#"]').on('click',function (e) {
       e.preventDefault();
       var target = this.hash;
       var $target = $(target);
       var divheight = $(".PremieresBtnGroup").height();
       var totalheight = (divheight + 10);
       // alert(totalheight);
       $('html, body').stop().animate({
           'scrollTop': $target.offset().top - totalheight
       }, 900, 'swing', function () {
           // window.location.hash = target;
       });
   });
   }); 
   // $(window).scroll(function () {
   //    var divheight = $(".PremieresBtnGroup").height();
   //   });
   
   
   $(document).ready(function(){
   $(window).scroll(function () {
         if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
             $('.PremieresBtnGroup').addClass("sticky");
         } else {
            $('#back-to-top').fadeOut();
            $('.PremieresBtnGroup').removeClass("sticky");
         }
      });
      // scroll body to 0px on click
      $('#back-to-top').click(function () {
         $('body,html').animate({
            scrollTop: 0
         }, 600);
         return false;
      });
   });
   
   $(window).on('beforeunload', function(){
   $(window).scrollTop(0);
   });
   
   function memeModel(e,id) {
       var r_url = "<?php echo e(route('front.pages.meme')); ?>";
        $.ajax({
          url: r_url,
          type: 'POST',
          dataType: 'json',
          data: {"_token": "<?php echo e(csrf_token()); ?>",'id':id},
          success: function(data) {
            $('#DefaultModal').html(data.view);
            $('#DefaultModal').modal('show');
           }
      });
   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>