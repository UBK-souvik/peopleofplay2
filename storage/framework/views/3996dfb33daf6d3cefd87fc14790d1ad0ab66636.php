
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front/new_css/youtube-premieres.css')); ?>">
<style>

</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
	<div class="YoutubePremieres">
	 <!--   <div class="homepagebanner mb-1">
	      <img src="<?php echo e(asset('front/images/WebHeader17.png')); ?>" alt="WebHeader15" class="img-fluid">
	   </div> -->
	   <div class="YTtopContant text-center">
	   		<img src="<?php echo e(asset('front/images/WelcomeToPOPWeekHeader.png')); ?>" alt="WelcomeToPOPWeekHeader" class="img-fluid">
	   </div>
	   <div class="YoutubePremieresButton my-2">
	   	<div class="YoutubeinnerButton">
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">RSVP Conference Content – FREE!</a>
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">RSVP  TAGIE Awards – FREE!</a>
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">Register for Pitch Event</a>
	   	</div>
	   </div>
	    <div class="homepagebanner mt-4 text-center">
	      <a href="javascript:void(0);" target="_blank"> <img src="<?php echo e(asset('front/images/POP-Week-sponsors-October-2021.jpg')); ?>" alt="POP-Week-sponsors-October-2021" class="img-fluid"></a>
	      <h1 class="bannertext my-4 mb-5" style="color: red;">Thank You Sponsors!</h1>
	   </div>
	   <div class="YTtopContant text-center my-4">
	   		<h6 class="">POP Week Schedule</h6>
		   	<p class="mb-0">POP Duos will premiere on the designated date and hour in CT (Chicago) time and videos will be available for on-demand viewing on this page until the end of November, then moved to POP Wiki. Pitch events are only for attendees registered for the pitch track and have Individual or Company POP profiles. Office hours are by appointment.</p>
		   	<p class="mb-0">Hosted Pub events are live and not recorded.</p>
	   </div>
	   <div class="PremieresBtnGroup">
	   <div class="YoutubePremieresButton PremieresButtonGroup my-2">
	   	<div class="YoutubeinnerButton">
	   	<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link" href="#monday" class="my-2">Monday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#tuesday" class="my-2">Tuesday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#wednesday" class="my-2">Wednesday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#thursday" class="my-2">Thursday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#friday" class="my-2">Friday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#saturday" class="my-2">Saturday</a>
			  </li>
			</ul>
	   	</div>
	   </div>
	   </div>
	   <!-- Monday -->
	   <div class="WeekSchedule mb-3" id="monday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Monday</h4>
	   		<p>08:30PM POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   					
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=Fg6fYZTdmK0');
	   			 ?>
	   		</div>
	   		<div clas="py-4">
		   		<div class="WeekScheduleHead text-center">
		   			<p>09:00PM POP Duo Keynotes<p>
		   		</div>
	   		</div>
	   		<div class="YouTubeLinkTwo youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=xnzw_ZXW71w');
	   			 ?>
	   		</div>
	   	</div>
	   	<div class="WeekSchedulePara">
	   		<p><strong>10:00am - 5:00pm:</strong> Pitches (for attendees with POP individual or company profiles/memberships registered for pitch tracks) and Office Hours (free consults by appt.)</p>
	   		<p><strong>4:00pm:</strong> Tips for Your POP Profile with Mary Couzin. Click on POP Pub image below. </p>
	   		<p><strong>5:00 - 7:00pm:</strong> Evening Networking - Join is the POP Pub! Click on image below</p>
	   	</div>
	   	<div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner1.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div>
	   </div>
	   <!-- Monday -->

	   <!-- Tuesday -->
	   <div class="WeekSchedule mb-3" id="tuesday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Tuesday</h4>
	   		<p>08:30PM POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   		<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=jsEeZKzm5ss');
	   			 ?>
	   		</div>
	   		<div clas="py-4">
		   		<div class="WeekScheduleHead text-center">
		   			<p>09:00PM POP Duo Keynotes<p>
		   		</div>
	   		</div>
	   		<div class="YouTubeLinkTwo youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=xhiDgKzvvNc');
	   			 ?>
	   		</div>
	   	</div>
	   	<div class="WeekSchedulePara">
	   		<p><strong>10:00am - 5:00pm:</strong> Pitches (for attendees with POP individual or company profiles/memberships registered for pitch tracks) and Office Hours (free consults by appt.)</p>
	   		<p><strong>4:00pm:</strong> Tips for Your POP Profile with Mary Couzin. Click on POP Pub image below. </p>
	   		<p><strong>5:00 - 7:00pm:</strong> Evening Networking - Join is the POP Pub! Click on image below</p>
	   	</div>
	   	<div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner2.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div>
	   </div>
	   <!-- Tuesday -->

	   <!-- Wednesday --> 
	   <div class="WeekSchedule mb-3" id="wednesday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Wednesday</h4>
	   		<p>08:30AM POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=RtuccV7NG6A');
	   			 ?>
	   		</div>
	   	</div>
	   	<div class="">
	   		<h5>Moderated by <a href="https://peopleofplay.com/people/christopher-byrne">Chris Byrne</a> the Toy Guy.</h5>
	   	</div>
	   	<div class="WeekSchedulePara">
	   		<p><strong>10:00am - 5:00pm:</strong> Pitches (for attendees with POP individual or company profiles/memberships registered for pitch tracks) and Office Hours (free consults by appt.)</p>
	   		<p><strong>4:00pm:</strong> Tips for Your POP Profile with Mary Couzin. Click on POP Pub image below. </p>
	   		<p><strong>5:00 - 7:00pm:</strong> Evening Networking - Join is the POP Pub! Click on image below</p>
	   	</div>
	   	<div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner3.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div>
	   </div>
	   <!-- Wednesday -->

	   <!-- Thursday -->
	   <div class="WeekSchedule mb-3" id="thursday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Thursday</h4>
	   		<p>08:30PM POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=c0ViRh3IboI');
	   			 ?>
	   		</div>
	   		<div clas="py-4">
		   		<div class="WeekScheduleHead text-center">
		   			<p>09:30PM POP Duo Keynotes<p>
		   		</div>
	   		</div>
	   		<div class="YouTubeLinkTwo youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=nm9R6sDOTho');
	   			 ?>
	   		</div>
	   	</div>
	   	<div class="WeekSchedulePara">
	   		<p><strong>10:00am - 5:00pm:</strong> Pitches (for attendees with POP individual or company profiles/memberships registered for pitch tracks) and Office Hours (free consults by appt.)</p>
	   		<p><strong>4:00pm:</strong> Tips for Your POP Profile with Mary Couzin. Click on POP Pub image below. </p>
	   		<p><strong>5:00 - 7:00pm:</strong> Evening Networking - Join is the POP Pub! Click on image below</p>
	   	</div>
	   	<div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner4.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div>
	   </div>
	   <!-- Thursday -->
	   <!-- Friday -->
	   <div class="WeekSchedule mb-3" id="friday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Friday</h4>
	   		<p>08:30PM POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=wLlI4kAx73s');
	   			 ?>
	   		</div>
	   	</div>
	   	<div class="WeekSchedulePara pb-0">
	   		<p><strong>10:00am - 5:00pm:</strong> Pitches (for attendees with POP individual or company profiles/memberships registered for pitch tracks) and Office Hours (free consults by appt.)</p>
	   		<p><strong>4:00pm:</strong> POP watch parties includeUNO Room and more TBA. </p>
	   		<p><strong>5:00pm:</strong> Toy and Game International Excellence awards – the TAGIEs.
Move over Oscars, Emmy's, CMA... the Toy and Game International Excellence Awards are taking the VIRTUAL center stage! Everyone is invited!  Awards, funny stunts, and more!! Hosted by Karri Bean, Sr. Licensing Manager for LEGO at Disney Parks Experiences & Products. For details on nominees, presenters, and honorees, <a href="https://www.chitag.com/2021-tagies-toy-and-game-awards">visit this page</a>.
</p>
	   	</div>
	   	<!-- <div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner5.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div> -->
	   </div>
	   <!-- Friday -->
	   <!-- Saturday -->
	   <div class="WeekSchedule mb-3" id="saturday">
	   	<div class="WeekScheduleHead text-center">
	   		<h4>Saturday</h4>
	   		<p>9:00am POP Duo Keynotes<p>
	   	</div>
	   	<div class="WeekScheduleYouTube">
	   		<div class="YouTubeLinkOne youtubelink mb-2">
	   			<?php
	   			echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>",'https://www.youtube.com/watch?v=qE0YUUfk-YI');
	   			 ?>
	   			 <div class="AboveVideo text-center">
	   			 	<p><i>(Above video is the 2020 Young Inventor Challenge Award Show)</i></p>
	   			 </div>
	   		</div>
	   	</div>
	   	<div class="WeekSchedulePara pb-0">

	   		<h6>Saturday - Sunday November 20th-21st, 2021</h6>
	   		<p class="mb-0"><a href="https://www.chitag.com/2021-fair">Chicago Toy & Game Fair</a> and  <a href="http://www.chitag.com/yic">The Young Inventor Challenge!</a></p>
	   		<p class="mb-0">There is something for everyone at the virtual Fair! In addition to the Young Inventor Challenge, we have Stages of Entertainment and Experiences from your favorite toy and game companies!</p> 
	   	</div>
	   	<!-- <div class="WeekScheduleBanner">
	   		  <a href="https://us02web.zoom.us/j/3698147064?pwd=T0laSnRRM041bHU4N04rTVMwc3NGdz09#success" target="_blank"> <img src="<?php echo e(asset('front/images/YTBanner6.jpg')); ?>" alt="RSVPHeader" class="img-fluid"></a>
	   	</div> -->
	   </div>
	   <!-- Saturday -->
	   <div class="YoutubePremieresButton my-2">
	   	<div class="YoutubeinnerButton">
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">RSVP Conference Content – FREE!</a>
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">RSVP  TAGIE Awards – FREE!</a>
		   	<a href="https://www.chitag.com/2021-innovation-conference" class="btn my-2">Register for Pitch Event</a>
	   	</div>
	   </div>
	  <a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	

 </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
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
// 	var divheight = $(".PremieresBtnGroup").height();
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


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>