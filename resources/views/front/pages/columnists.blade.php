@extends('front.layouts.pages')
@section('content')
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="BlogColumnists">
      <div class="FirstColumn">
         <div class="PopColumnists text-center pb-3">
            <h1>POP Columnists</h1>
         </div>
   <!--  ****** || Users Blogs Start || ****** -->
         @foreach ($users as $ukey => $row)
         <div class="UserBlogSliderSection mb-4">
            <?php 
            if($row->user_type ==3) { 
                $user_url = url('companies/'.$row->slug); 
            } elseif($row->user_type ==1) {
              $user_url = url('people/'.$row->slug);
            } ?>
            <a href="{{ $user_url }}">
               <div class="BlogUserProfile d-flex align-items-center mb-4">
                  <div class="BlogUserpic">
                     <img src=" @if($row->profile_image !='') {{ asset('uploads/images/users/'.$row->profile_image) }} @else {{ asset('front/new/images/Product/team_new.png') }} @endif" alt="profileimage" class="img-fluid rounded-circle">
                  </div>
                  <div class="BlogUserName">
                     <h4>{{ $row->first_name }} {{ $row->last_name }}</h4>
                  </div>
               </div>
            </a>
            <!--  ****** || Owl Slider || ****** -->
              @if(isset($row->blogs) && !empty($row->blogs))
            <div class="OwlCarouselUserBlogSlider">
               <div class="owl-carousel UserBlogsCarousel owl-theme" id="UserBlogSlider{{ @$ukey }}_{{ count($row->blogs) }}">
                 
                  @foreach ($row->blogs as $row1)
                  <div class="item pr-1 pb-1" data-responsive="" data-src="#" data-poster="" data-sub-html="">
                     <a href="{{ url('blog/'.$row1->slug) }}">
                        <div class="blog-image-slider">
                          <img src="{{@newsBlogImageBasePath($row1->featured_image)}}" class="img-fluid imagesCover videoPreview">
                           <div class="overlayimages8">
                              <strong class="small1">{{ $row1->title }}</strong>
                           </div>
                        </div>
                     </a>
                  </div>
                  @endforeach
               </div>
            </div>
              @endif
              <!--  ****** || Owl Slider || ****** -->
         </div>
   @endforeach
 <!--  ****** || Users Blogs End || ****** -->
 </div>
   </div>  
      @include('front.includes.join_mailing') 
</div>

@endsection
@section('scripts')
<script>

$( document ).ready(function() {
    $('.UserBlogsCarousel').each(function() {
     var slidercount =this.id.split('_');
      var items_owl_loop = false;
      if(slidercount[1]>3) {
        var items_owl_loop = true;
      }
      columnistsSlider( this.id,items_owl_loop)
    });


     // setInterval(function () {
     //      $('.mainListCarousel_Blog .owl-nav').removeClass('disabled');
     //      $('.mainListCarousel_Blog .owl-nav').removeClass('disabled');
     //    }, 1000);
});


function columnistsSlider(sliderId,items_owl_loop=false) {
   $('#'+sliderId).owlCarousel({
      margin:10,
      nav:false,
      loop: items_owl_loop,
      dots:false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsiveClass:true,
      responsive:{
         0:{
                  items:1
             },
              400:{
                 items:2
             },
             565:{
                 items:3
             },
             786:{
                 items:2
             },
             1200:{
                 items:3
             }
      }
   })
}

</script>
@endsection