@extends('front.layouts.pages')
@section('content')

<div class="col-md-6 col-lg-7 MiddleColumnSection">
    <div class="homepagebanner mb-1">
      <a href="https://www.eventbrite.com/e/2021-toy-game-international-innovation-awards-tagies-pops-got-talent-tickets-165035239845" target="_blank"> <img src="{{ asset('front/images/RSVPHeader.png') }}" alt="RSVPHeader" class="img-fluid"></a>
   </div>
   <div class="homepagebanner mb-2">
      <a href="javascript:void(0)"> <img src="{{ asset('front/images/SponsorsHeader.png') }}" alt="SponsorsHeader" class="img-fluid"></a>
   </div>

    <!--  ************ || Award Slider Start|| ************ -->
   @if(isset($home_page_award_types) && !empty($home_page_award_types) && count($home_page_award_types)>0)
   @foreach ($home_page_award_types as $key => $row_award_type)
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
         <div class="CarouselWrap owl-carousel  CarouselWrapSlide" id="OwlCarouselWrap_{{ $key }}_{{ count($row_award_type->home_page_award) }}">
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
<!-- The Modal -->
   <div class="modal popfeedmodal" id="homePageAwardModelId">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- Modal body -->
        <div class="modal-body">
          <!--Welcome to your very own POP Feed!-->
          <div class="WelcomePopFeed">             
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
<script>
	$('.CarouselWrapSlide').each(function() {
		var arr = this.id.split('_');
		loop_item = false;
        if(arr[2] >2){
        	loop_item = true;
           }
          var slider_id = arr[0]+'_'+arr[1]+'_'+arr[2];
          // alert(slider_id);
         CarouselWrapSlide(slider_id,loop_item)
        
       });


function CarouselWrapSlide(id,item_loop=false) {
   var owlhomepageAward = $('#'+id);
   owlhomepageAward.owlCarousel({
    margin: 10,
    nav: true,
    loop:item_loop,
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
 }
   $( ".owl-prev").html('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>');
   $( ".owl-next").html('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>');

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
@endsection