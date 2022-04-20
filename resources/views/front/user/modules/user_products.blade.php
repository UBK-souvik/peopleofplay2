
<!-- for a free user or user not logged in -->	
{{-- @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
<div class="col-md-12 strong_size">
   <h3 class="sec_head_text w-100">Products 

     @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
    <a href="{{ url('user/product') }}" class="move_edit_page" title="Edit Product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    @endif
  </h3>
   <div class="row sectionBox">            
      @include("front.user.modules.blur")
   </div>
</div>
@else --}}
@if($user->role ==2 || $user->role ==3)

@if(!empty($arr_products_objs_new) && count($arr_products_objs_new)>0 )
<div class="col-md-12">
   <div class="row">
      <div class="col-md-12 sectionBox">
         <div>
            <h3 class="sec_head_text w-100">Products 
              @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
    <a href="{{ url('user/product') }}" class="move_edit_page" title="Edit Product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    @endif
            </h3>
         </div>
         @php 
         $int_products_slide_flag_new = 0;
         @endphp
         <?php   //echo "<pre>"; print_r($arr_products_objs_new); die; ?>
         @if(count($arr_products_objs_new) <0  )
         <div class="d-flex flex-wrap">
            @foreach($arr_products_objs_new as $collaborator_key => $collaborator)
            <div class="mr-2">
               <a target="_blank" href="{{url('product/'.$collaborator['slug'])}}">
                  <div>
                     <img src="{{@prodEventImageBasePath(@$collaborator['main_image'])}}" class="productSlider ">
                  </div>
                  <div  class="userPoductTitle withoutOverlay"><strong>{{@App\Helpers\UtilitiesTwo::get_video_title_data(@$collaborator['name'])}}</strong></div>
               </a>
               @if(!empty($arr_products_objs_role_names_new[@$int_products_slide_flag_new]))
               <div  class="userPoductTitle withoutOverlay pt-1"><small>({{@$arr_products_objs_role_names_new[@$int_products_slide_flag_new]}})</small></div>
               @endif
            </div>
            @php 
            $int_products_slide_flag_new++;
            @endphp
            @endforeach
         </div>
         @else
         <div class="col-md-12 mt-2" style="background-color: #fff;">
            <div class="row pb-0 circleBox">
               <div class="owl-carousel userProductSlider owl-theme" id="user-product-slider-div">
                  @php 
                  $int_products_slide_flag_new = 0;
                  @endphp
                  @foreach($arr_products_objs_new as $collaborator_key => $collaborator)
                  {{-- @if(!empty($collaborator['name']) && !empty($collaborator['main_image']) && !empty($collaborator['slug'])) --}}
                  <div class="item" id="owl-carousel-product-main-div-{{$int_products_slide_flag_new}}">
                     <div class="Gallery-text-overlay-Image3">
                        <a target="_blank" href="{{url('product/'.@$collaborator['slug'])}}">
                           <img src="{{@prodEventImageBasePath(@$collaborator['main_image'])}}" class="productSlider">
                           <div class="userPoductTitle withoutOverlay">
                              <strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$collaborator['name'])}}</strong>
                           </div>
                        </a>
                     </div>
                     @if(!empty($arr_products_objs_role_names_new[@$int_products_slide_flag_new]))
                     <div  class="userPoductTitle withoutOverlay pt-1"><small>({{$arr_products_objs_role_names_new[@$int_products_slide_flag_new]}})</small></div>
                     @endif
                  </div>
                  {{-- @endif --}}
                  @php 
                  $int_products_slide_flag_new++;
                  @endphp  
                  @endforeach
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>
</div>
@endif
@endif
{{--  @endif --}}