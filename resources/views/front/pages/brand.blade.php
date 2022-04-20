@extends('front.layouts.pages')
@section('content')
@php
$arr_social_media_type = App\Helpers\UtilitiesTwo::getSocialMediaArrayValue($brand_list->socialMedia);
$social_media_array_type =$arr_social_media_type[0];
$social_media_array_value =$arr_social_media_type[1];
$int_product_word_length = @App\Helpers\UtilitiesTwo::words_length(@$brand_list->description);
$int_description_words_length = @App\Helpers\UtilitiesTwo::description_words_length();
@endphp
<style type="text/css">
   #a_more, #award_mobile_more, #d_more {display: none;}
</style>
<?php
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[0]) ){
       $category1 = $brand_list->categories->pluck('category_id')[0];
   } else {
       $category1 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[1]) ){
       $category2 = $brand_list->categories->pluck('category_id')[1];
   } else {
       $category2 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('category_id')[2]) ){
       $category3 = $brand_list->categories->pluck('category_id')[2];
   } else {
       $category3 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[0]) ){
       $sub_category1 = $brand_list->categories->pluck('sub_category_id')[0];
   } else {
       $sub_category1 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[1]) ){
       $sub_category2 = $brand_list->categories->pluck('sub_category_id')[1];
   } else {
       $sub_category2 = 0;
   }
   
   if(isset($brand_list) && count($brand_list->categories) > 0 && isset($brand_list->categories->pluck('sub_category_id')[2]) ){
       $sub_category3 = $brand_list->categories->pluck('sub_category_id')[2];
   } else {
       $sub_category3 = 0;
   }
   ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column bg-white border_right BrandProfile"  id="product-page-main-div">
      <div class="First-column bg-white">
         <div class="col-md-12">
            <div class="row sectionTop">
               <div class="col-lg-5 col-sm-5 col-md-12 px-2 imgProfilePadding">
                  <img src="{{@imageBasePath(@$brand_list->main_image)}}" class="img-fluid mr-0 imgtwoeighty">
               </div>
               <div class="col-lg-7 col-sm-7 col-md-12 px-2 rightBox">
                  <div class="Jengatext paragraph mt-md-3 mt-lg-0">
                     <div class="row align-items-center">
                        <div class="col-sm-8 pr-0">
                           <div class="JengaW75">
                              <h2 class="mb-0">{{$brand_list->name}}</h2>
                              <p class="productAuthor d-none">
                                 @php
                                 $base_url = url('/');
                                 $user_current_info_new = @$brand_list->created_byy;
                                 $str_user_name = '';
                                 if(@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3)
                                 {
                                 $str_user_url_new = @App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
                                 }
                                 else
                                 {
                                 $str_user_url_new = "#"; 
                                 }
                                 $str_user_name = @App\Helpers\Utilities::getUserName($user_current_info_new);
                                 $report_url = url('/report/4/'.Request::segment(2).'/'.@$brand_list->user_id);
                                 @endphp  
                              </p>
                           </div>
                        </div>
                        <div class="col-sm-4 pl-sm-0">
                           <div class="JengaW25">
                                <div class="text-left text-md-right">
                                   <div class="my-2 AddToFavorites">
                                      {{-- <a type="button" href="http://pop.com.local/add-to-watch-list?type=1&amp;value=644" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorite</a> --}}
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
           
            <div class="PopProductAuthor">
               <p class="productAuthor m-0 fontWeightSix">by : <a class="span-style1 fontWeightSix" target="_blank" href="{{$str_user_url_new}}">{{ $str_user_name }}</a></p>
            </div>
            <ul class="d-flex flex-row ul-text-color my-1">
               <a href="#!" class="text-dark fontFourteen">
                  <li>
                     @if(have_permission('category') )
                     {{category_byID($category1)}} 
                     @endif
                     @if(have_permission('sub_category') )
                     {{!empty($sub_category1) ? '| '.sub_category_byID($sub_category1) : ''}}
                     @endif
                     {{-- @foreach ($brand_list->categories->nth(2) as $category)
                     {{ $category->category->category_name ?? null }}
                     @if($loop->index > $loop->count)
                     |
                     @endif
                     @endforeach --}}
                  </li>
               </a>
            </ul>
           
                 @if(!empty($brand_list->description))
                        @if(strlen($brand_list->description) > 300)
                         <div class="textBoiReadMore">
                             {!! nl2br(@$brand_list->description) !!}
                        </div>
                         <a href="javascript:void(0);" onclick="textBoi(this,1)" class="readMore ProfileReadMore brandprofilebtn btnReadMore">Read More...</a>
                        @else
                        <div>
                           {!! nl2br(@$brand_list->description) !!}
                        </div>
                        @endif
                        <div class="textBoiReadLess" style="display: none;">
                             {!! nl2br(@$brand_list->description) !!}
                           <a href="javascript:void(0);" onclick="textBoi(this,0)" class="readMore brandprofilebtn ProfileReadMore">Read Less...</a>
                        </div>
                        @endif
          <!--   <div class="modal" id="DescModal">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header kbg_black">
                        <div class="textContent">
                           <h4 class="modal-title text-white">Brand Description</h4>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div >
                           <p class="text-justify p-text">{!! @$brand_list->description !!}</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div> -->
            {{--
            <p class="sidetitlePrice marginBotsix" >Price:
               <span class="text-danger">${{$brand_list->price}}<span>
            </p>
            --}}
          
            <div class="row d-flex justifly-content-start">
               {{--
               <!-- <div class="amazonWrap">
                  <label for="amazon_3" class="">
                     <a  href="@if(!empty($brand_list->buyFrom->amazon)) {{ $brand_list->buyFrom->amazon }} @else {{ '#' }} @endif" target="_blank">
                         <img src="{{asset('front/new/images/Brand/amazon-button3.png')}}">
                     </a>
                  </label>
                  </div>  -->
               --}}
            </div>
         </div>
      </div>
   </div>

    <!--  ******** || Fun Facts || ********* -->
             @php 
             @$fun_fact1 = @$brand_list->fun_fact1;
             @$fun_fact2 = @$brand_list->fun_fact2;
             @$fun_fact3 = @$brand_list->fun_fact3;
             @$editFunfacts = 0;
             @endphp  

           @include("front.includes.fun-facts")
          <!--  ******** || Fun Facts || ********* -->
   @if(!empty($brand_list->brand) || !empty($brand_list->company) || !empty($brand_list->launched_date))
   <section class="sectionBox col-md-12">
      <div class="row">
         @if(!empty($brand_list->company))            
         <div class="col-md-4 strong_size">
            <h2 class="sec_head_text_two w-100 mb-1 text-left">Manufacturer: </h2>
            <div>
               <p class="p-text mb-0">{{@$brand_list->company}}</p>
               <!-- <ul style="list-style: inside; color: #111;">
                  <li class="p-text mb-0">{{@$brand_list->company}}</li>
                  </ul> -->
            </div>
         </div>
         @endif
         @if(!empty($brand_list->launched_date))            
         <div class="col-md-4 strong_size">
            <h2 class="sec_head_text_two w-100 mb-1 text-left">Launched Date: </h2>
            <div>
               <p class="p-text mb-0">{{@$brand_list->launched_date}}</p>
               <!--  <ul style="list-style: inside; color: #111;">
                  <li class="p-text mb-0">{{@$brand_list->launched_date}}</li>
                  </ul> -->
            </div>
         </div>
         @endif
      </div>
   </section>
   @endif 
   @if(!empty($brand_list->buyFrom->amazon) || !empty($brand_list->buyFrom->ebay) || !empty($brand_list->buyFrom->pop))
   <div class="col-md-12">
      <div class="row sectionBox desktopveiw">
         <h2 class="sec_head_text w-100 text-left">Buy From</h2>
         <div class="w-100 TableBrand">
            <table class="table event_table short_award_list" >
               <tbody>
                  @if(!empty($brand_list->buyFrom->amazon))
                  <tr>
                     <td class="dask_name">{{ $brand_list->buyFrom->amazon_caption }}</td>
                     <td>
                        <a class="span-style1" target="_blank" href="{{@$brand_list->buyFrom->amazon ? $brand_list->buyFrom->amazon : null}}">
                        {{-- @$brand_list->buyFrom->amazon ? $brand_list->buyFrom->amazon : null --}}
                        View Link
                        </a>
                     </td>
                  </tr>
                  @endif
                  @if(!empty($brand_list->buyFrom->ebay))
                  <tr>
                     <td class="dask_name">{{ $brand_list->buyFrom->ebay_caption }}</td>
                     <td>
                        <a class="span-style1" target="_blank" href="{{@$brand_list->buyFrom->ebay ? $brand_list->buyFrom->ebay : null}}">
                        {{-- @$brand_list->buyFrom->ebay ? $brand_list->buyFrom->ebay : null --}}
                        View Link
                        </a>
                     </td>
                  </tr>
                  @endif
                  @if(!empty($brand_list->buyFrom->pop))
                  <tr>
                     <td class="dask_name">{{ $brand_list->buyFrom->pop_caption }}</td>
                     <td>
                        <a class="span-style1" target="_blank" href="{{@$brand_list->buyFrom->pop ? $brand_list->buyFrom->pop : null}}">View Link{{-- @$brand_list->buyFrom->pop ? $brand_list->buyFrom->pop : null --}}</a>
                     </td>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>
   </div>
   @endif
   @if(!empty($gallery_image_data))
   @include("front.user.modules.images_gallery")
   @endif
   @if(!empty($gallery_known_for_data))
   @include("front.user.modules.known_for_images")
   @endif
   <!-- list of all the products in this brand -->
   @if(!empty($products_brands_list) && count($products_brands_list)>0)
   <div class="col-md-12">
      <div class="row sectionBox officialLinks">
         <h2 class="sec_head_text text-left w-100 d-block">Products</h2>
         @php  
         $int_products_brands_list_flag = 1;
         @endphp         
         <div class="Social-align d-flex justifly-content-start text-center flex-wrap">
            @foreach($products_brands_list as $products_brands_list_row)
            <div class="">
               <a href="{{ url('/') . '/product/'. @$products_brands_list_row->slug }}" target="_blank">
                  <img src="{{@prodEventImageBasePath($products_brands_list_row->main_image)}}" class=" productSlider mr-2 ">
                  <p class="link-text w-100 text-center userPoductTitle withoutOverlay mb-3"><strong>{{App\Helpers\UtilitiesTwo::get_video_title_data(@$products_brands_list_row->name)}}</strong></p>
               </a>
            </div>
            @php  
            $int_products_brands_list_flag++;
            @endphp
            @endforeach
         </div>
      </div>
   </div>
   @endif  
   @if(!empty($awards) && count($awards)>0 && !empty($award->eventAward) && count($award->eventAward)>0)
   <div class="col-md-12">
      <div class="row sectionBox desktopveiw">
         <h2 class="sec_head_text w-100 text-left">Awards</h2>
         <div class="w-100 TableBrandTwo">
            <table class="table event_table short_award_list" >
               <tbody>
                  @foreach($awards ?? [] as $award_key => $award)
                  @if($award_key <= 2)
                  <tr class="py-1 px-3">
                     <td class=" pl-0"><a href="#" class="dask_name">{{@$award->eventAward->name}}</a></td>
                     <td>...</td>
                     <td>
                        <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{@$award->eventAward->id}}">View</a>
                     </td>
                  </tr>
                  @endif
                  @endforeach
               </tbody>
               @if(count($awards) > 3 )
               <tbody id="a_dots"></tbody>
               @endif
               @if(count($awards) > 3 )
               <tbody id="a_more">
                  @foreach($awards ?? [] as $award_key => $award)
                  @if($award_key > 2)
                  <tr class="py-1 px-3">
                     <td class=" pl-0"><a href="#" class="dask_name">{{@$award->eventAward->name}}</a></td>
                     <td>...</td>
                     <td>
                        <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{@$award->eventAward->id}}">View</a>
                     </td>
                  </tr>
                  @endif
                  @endforeach
               </tbody>
               @endif
            </table>
         </div>
         <div class="mt-3 w-100">
            @if(count($awards) > 3 )
            <span class="span-style1 see_full_list expand" onclick="a_myFunction()" id="a_myBtn" style="cursor: pointer;">
            Expand >>
            </span>
            @endif
         </div>
      </div>
   </div>
   @endif
   @if(!empty($awards) && count($awards)>0 && !empty($award->eventAward) && count($award->eventAward)>0)
   <div class="col-md-12">
      <div class="row sectionBox mobileveiw">
         <h2 class="sec_head_text w-100 text-left">Awards</h2>
         <div class="w-100 TableBrandThree">
            <table class="table event_table short_award_list" >
               <tbody>
                  @foreach($awards ?? [] as $award_key => $award)
                  @if($award_key <= 2)
                  <tr class="py-1 px-3">
                     <td class=" pl-0"><a href="#" class="dask_name">{{@$award->eventAward->name}}</a></td>
                     <td>...</td>
                     <td>
                        <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{@$award->eventAward->id}}">View</a>
                     </td>
                  </tr>
                  @endif
                  @endforeach
               </tbody>
               @if(count($awards) > 3 )
               <tbody id="award_mobile_dots"></tbody>
               @endif
               @if(count($awards) > 3 )
               <tbody id="award_mobile_more">
                  @foreach($awards ?? [] as $award_key => $award)
                  @if($award_key > 2)
                  <tr class="py-1 px-3">
                     <td class=" pl-0"><a href="#" class="dask_name">{{@$award->eventAward->name}}</a></td>
                     <td>...</td>
                     <td>
                        <a class="span-style1" href="{{route('front.user.awardnominee.index')}}?id={{@$award->eventAward->id}}">View</a>
                     </td>
                  </tr>
                  @endif
                  @endforeach
               </tbody>
               @endif
            </table>
         </div>
         <div class="mt-3 w-100">
            @if(count($awards) > 3 )
            <span class="span-style1 see_full_list expand" onclick="award_mobile_myFunction()" id="award_mobile_myBtn" style="cursor: pointer;">
            Expand >>
            </span>
            @endif
         </div>
      </div>
   </div>
   @endif
   <?php
      /*  @include("front.user.modules.product_collaborator_list") */
      
      ?>  
   @if(!empty($gallery_video_data))
   @include("front.user.modules.videos_gallery")
   @endif
   @if(!empty($brand_list->officialLinks) && count($brand_list->officialLinks)>0)
   <div class="col-md-12">
      <div class="row sectionBox officialLinks">
         <h2 class="sec_head_text text-left w-100 d-block">Official Links</h2>
         <?php $sr = 1; ?>
         <div class="Social-align">
            @foreach($brand_list->officialLinks ?? [] as $socials)
            <a href="{{$socials->value}}" target="_blank">
               <p class="link-text w-100">{{substr($socials->value,0,20)}}...</p>
            </a>
            <?php $sr = $sr + 1; ?>
            @endforeach
         </div>
      </div>
   </div>
   @endif    
   {{--  
   @if(!empty($brand_list->brand) || !empty($brand_list->company))
   <section class="">
      <div class="col-md-12">
         <div class="row sectionBox strong_size">
            <h2 class="sec_head_text text-left w-100">Brand Metadata</h2>
            <div>
               @if(have_permission('category') )
               <p class="text-black p-0 mb-1"><strong>Category</strong> : 
                  @if(!empty($category1) )
                  {{category_byID($category1)}}
                  @endif
                  @if(!empty($category2) )
                  {{', '.category_byID($category2)}}
                  @endif
                  @if(!empty($category3) )
                  {{', '.category_byID($category3)}}
                  @endif
               </p>
               @endif
               @if(have_permission('category') )
               <p class="text-black p-0 mb-1"><strong>Sub Category</strong> : 
                  @if(!empty($sub_category1) )
                  {{sub_category_byID($sub_category1)}}
                  @endif
                  @if(!empty($sub_category2) )
                  {{', '.sub_category_byID($sub_category2)}}
                  @endif
                  @if(!empty($category3) )
                  {{', '.sub_category_byID($sub_category3)}}
                  @endif
               </p>
               @endif
            </div>
         </div>
      </div>
   </section>
   @endif
   --}}
   <?php /*
      @if(!empty($brand_list->classification))
          <div class="col-md-12">
             <div class="row sectionBox">
                <h2 class="sec_head_text text-left w-100">Classification</h2>
                <div>
                   @if(!empty($brand_list->classification->type)) 
                      <p class="text-black p-0 mb-1">Type : {{@config('cms.classification_type')[$brand_list->classification->type] ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->classification->delivery_mechanism)) 
                      <p class="text-black p-0 mb-1">Delivery Mechanism : {{@config('cms.delivery_mechanism')[$brand_list->classification->delivery_mechanism] ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->classification->toy_type)) 
                      <p class="text-black p-0 mb-1">Toy Type : {{@config('cms.toy_type')[$brand_list->classification->toy_type] ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->classification->year_launched)) 
                      <p class="text-black p-0 mb-1">Launched : {{$brand_list->classification->year_launched ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->classification->inventor)) 
                      <p class="text-black p-0 mb-1">Inventor : {{$brand_list->classification->inventor ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->classification->team)) 
                      <p class="text-black p-0 mb-1">Team : {{$brand_list->classification->team ?? null}}</p>
                   @endif
                   @if(!empty($brand_list->brand))     
                      <p class="text-black p-0 mb-1">Brand : {{@$brand_list->brand}}</p>
                   @endif
                   @if(!empty($brand_list->company))     
                      <p class="text-black p-0 mb-1">Manufacturer : {{@$brand_list->company}}</p>
                   @endif
      
                </div>
             </div>
          </div>
      @endif  */ ?> 
   @include("front.user.modules.social_media_icons")
   @include("front.user.modules.ajax_image_gallery_video")
</div>
</div>
</div>
<script type="text/javascript">
    function d_myFunctionnew() {
     var dots = document.getElementById("d_dots");
     var moreText = document.getElementById("d_more");
     var btnText = document.getElementById("d_myBtn");
   
     if (dots.style.display === "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Read More"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "Read Less"; 
       moreText.style.display = "contents";
     }
   }

    function textBoi(e,type) {
        if(type ==1) {
          $('.textBoiReadMore').hide();
          $('.textBoiReadLess').show();
          $(e).hide();
        } else {
          $('.textBoiReadLess').hide();
          $('.textBoiReadMore').show();
          $('.btnReadMore').show();
        }
      }
  
</script>

<!-- </div> -->
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
       $(".full_award_list").hide();
       $(".see_full_award_list").click(function(eve) {
           var type = $(this).data('ty');
           eve.preventDefault();
           $(".full_award_list, .short_award_list").toggle();
   
           if(type == 'expand'){
             $(".a_collapse").show();
             $(".a_expand").hide();
           } else if(type == 'collapse') {
             $(".a_expand").show();
             $(".a_collapse").hide();
           }
       });
   });
</script>
<script>
   function myFunction() {
     var dots = document.getElementById("dots");
     var moreText = document.getElementById("more");
     var btnText = document.getElementById("myBtn");
   
     if (dots.style.display === "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Expand >>"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "<< Collapse"; 
       moreText.style.display = "contents";
     }
   }
   
   function a_myFunction() {
     var dots = document.getElementById("a_dots");
     var moreText = document.getElementById("a_more");
     var btnText = document.getElementById("a_myBtn");
   
     if (dots.style.display === "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Expand >>"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "<< Collapse"; 
       moreText.style.display = "contents";
     }
   }
   function award_mobile_myFunction() {
     var dots = document.getElementById("award_mobile_dots");
     var moreText = document.getElementById("award_mobile_more");
     var btnText = document.getElementById("award_mobile_myBtn");
   
     if (dots.style.display === "none") {
       dots.style.display = "inline";
       btnText.innerHTML = "Expand >>"; 
       moreText.style.display = "none";
     } else {
       dots.style.display = "none";
       btnText.innerHTML = "<< Collapse"; 
       moreText.style.display = "contents";
     }
   }
 

</script>
@endsection