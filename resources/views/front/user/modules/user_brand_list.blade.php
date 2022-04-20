<!-- <div class="col-md-12 paddingYaxis1">
   <div class="row  mb-0" >
       <div class="owl-carousel userMediaSlider owl-theme" id="video-gallery">
       <div class="item pr-1 pb-1" data-responsive="" data-src="https://i.ytimg.com/vi/A9QCepdvaYU/hqdefault.jpg" 
       data-poster="" data-sub-html="">
           <a href="#">
               <div class="Gallery-text-overlay-Image3">
               <img src="https://i.ytimg.com/vi/A9QCepdvaYU/hqdefault.jpg"
                   class="img-fluid imagesCover videoPreview">
                   <div class="overlayimages8">
                       <strong class="small1">kundan pandey</strong>
                   </div>
               </div>
           </a>
       </div>
     </div>
   </div>
   </div> -->

<!-- for a free user or user not logged in -->	
{{-- @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
<div class="col-md-12 strong_size">
   <h3 class="sec_head_text w-100">Brand  
    @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
            <a href="{{ url('user/brand') }}" class="move_edit_page" title="Edit Brand"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif</h3>
   <div class="row sectionBox">            
      @include("front.user.modules.blur")
   </div>
</div>
@else		 --}}
@if($user->role ==3)
@if(!empty($user->brand_lists) && count($user->brand_lists)>0 )
<div class="col-md-12 sectionBox">
   <div class="col-md-12 w-100 pl-0">
      <h3 class="sec_head_text w-100">Brands
      	  @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
            <a href="{{ url('user/brand') }}" class="move_edit_page" title="Edit Brand"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif

      </h3>
   </div>
   <div class="row ">
      @if(count($user->brand_lists) <= 0  )
      <div class="d-flex justify-content-start flex-wrap mt-2 BrandSilder">
         @foreach($user->brand_lists as $brand_list_key => $brand_list_row_new)
         <div style="margin-right:20px;">
            <a target="_blank" href="{{route('front.pages.brand.detail',$brand_list_row_new->slug)}}">
               <div>
                  <img  src="{{@imageBasePath(@$brand_list_row_new->main_image)}}"
                     class="img-fluid homeProfileCircle rounded-circle ">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$brand_list_row_new->name)}}</strong></div>
            </a>
         </div>
         @endforeach
      </div>
      @else
      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userBrandSlider owl-theme" id="user-brand-slider-div">
               @foreach($user->brand_lists as $brand_list_key => $brand_list_row_new)
               <div class="item" id="owl-carousel-brand-main-div-{{$brand_list_key}}">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="{{route('front.pages.brand.detail',$brand_list_row_new->slug)}}">
                        <img src="{{@imageBasePath(@$brand_list_row_new->main_image)}}" 
                           class="img-fluid homeProfileCircle rounded-circle">
                        <div class="overlayimages8 withoutOverlay">
                           <strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$brand_list_row_new->name)}}</strong>
                        </div>
                     </a>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
      @endif
   </div>
</div>
@endif
@endif
{{-- @endif --}}