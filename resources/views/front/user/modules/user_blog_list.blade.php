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
{{--     @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
<div class="col-md-12 strong_size">
   <h3 class="sec_head_text w-100">My Blog Posts 
   @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
   	<a href="{{ url('user/blog') }}" class="move_edit_page" title="Edit Blog"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
   	@endif
   </h3>
   <div class="row sectionBox">            
      @include("front.user.modules.blur")
   </div>
</div>
@else --}}		 
@if($user->role ==2 || $user->role ==3)
@if(!empty($user_blogs_list) && count($user_blogs_list)>0 )
<div class="col-md-12">
   <div class="row sectionBox">
      <div class="w-100">
         <h3 class="sec_head_text w-100">My Blog Posts 
         	@if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
         	<a href="{{ url('user/blog') }}" class="move_edit_page" title="Edit Blog"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         	@endif
         </h3>
      </div>
      @if(count($user_blogs_list) <= 0  )
      <div class="d-flex">
         @foreach($user_blogs_list as $user_blogs_list_key => $user_blogs_list_row_new)
         <div class="ProfileBlog" style="margin-right:20px;">
            <a target="_blank" href="{{route('front.pages.blog.detail',$user_blogs_list_row_new->slug ?? '')}}">
               <div>
                  <img style="width:200px;height:200px;object-fit:cover;" src="{{@newsBlogImageBasePath(@$user_blogs_list_row_new->featured_image)}}"
                     class="img-fluid videoPreview">
               </div>
               <div  class="overlayimages8 withoutOverlay"><strong>{{App\Helpers\UtilitiesTwo::get_blog_title_data(@$user_blogs_list_row_new->title)}}</strong></div>
            </a>
         </div>
         @endforeach
      </div>
      @else
      <div class="col-md-12" style="background-color: #fff;">
         <div class="row pb-0 circleBox">
            <div class="owl-carousel userBlogSlider owl-theme">
               @foreach($user_blogs_list as $user_blogs_list_key => $user_blogs_list_row_new)
               <div class="item" id="owl-carousel-product-main-div-{{$user_blogs_list_key}}">
                  <div class="Gallery-text-overlay-Image3">
                     <a target="_blank" href="{{route('front.pages.blog.detail',$user_blogs_list_row_new->slug ?? '')}}">
                        <img src="{{@newsBlogImageBasePath(@$user_blogs_list_row_new->featured_image)}}" 
                           class="img-fluid imagesCover videoPreview">
                        <div class="overlayimages8 withoutOverlay">
                           <strong>{{App\Helpers\UtilitiesTwo::get_blog_title_data(@$user_blogs_list_row_new->title)}}</strong>
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