
<!-- for a free user or user not logged in -->  
{{-- @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
<div class="col-md-12 strong_size">
   <h3 class="sec_head_text w-100">Awards  
       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
      <a href="{{ url('user/award') }}" class="move_edit_page" title="Edit Award"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        @endif
   </h3>
   <div class="row sectionBox">            
      @include("front.user.modules.blur")
   </div>
</div>
@else    --}}
<?php //echo "<pre>"; print_r($user_award_list); die; ?>
@if($user->role ==2 || $user->role ==3)
@if(!empty($user_award_list) && count($user_award_list)>0 )
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="w-100">
        <h3 class="sec_head_text w-100">Awards
          @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
      <a href="{{ url('user/award') }}" class="move_edit_page" title="Edit Award"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        @endif
        </h3>
      </div>
      @if(count($user_award_list) <= 0  )
      <div class="d-flex flex-wrap w-100">
         @foreach($user_award_list as $award_list_key => $award_list_row_new)
         <div class="ProfileBlogMedia">
            <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$award_list_row_new->url_data)}}">
               <div>
                  <img src="{{@awardUserImageBasePath(@$award_list_row_new->featured_image)}}"
                     class="img-fluid videoPreview">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$award_list_row_new->title)}}</strong>
               </div>
            </a>
         </div>
         @endforeach
      </div>
      @else


      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userAwardSlider owl-theme">
               @foreach($user_award_list as $award_list_key => $award_list_row_new)
               <div class="item" id="owl-carousel-useraward-main-div-{{$award_list_key}}">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$award_list_row_new->url_data)}}">
                        <img src="{{@awardUserImageBasePath(@$award_list_row_new->featured_image)}}" 
                           class="img-fluid imagesCover videoPreview">
                        <div class="overlayimages8 withoutOverlay">
                           <strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$award_list_row_new->title)}}</strong>
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