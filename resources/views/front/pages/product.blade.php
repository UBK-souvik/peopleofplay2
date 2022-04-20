@extends('front.layouts.pages')
@section('content')
@php
$arr_social_media_type = App\Helpers\UtilitiesTwo::getSocialMediaArrayValue($product->socialMedia);
$social_media_array_type =$arr_social_media_type[0];
$social_media_array_value =$arr_social_media_type[1];
$int_product_word_length = @App\Helpers\UtilitiesTwo::words_length(@$product->description);
$int_description_words_length = @App\Helpers\UtilitiesTwo::description_words_length();
$base_url = url('/');
$str_company_user_name = '';
$str_company_image_data =  @imageBasePath('');
if(!empty($product->companydata) && is_object($product->companydata))
{
$company_user_current_info_new = $product->companydata;
}
else
{
$str_company_user_name =  @$product->company; 
}
$str_company_image_class_name =  'homeProfileCircle rounded-circle';
if(!empty(@$company_user_current_info_new->role) && (@$company_user_current_info_new->role == 2 || @$company_user_current_info_new->role == 3) )
{
$str_company_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $company_user_current_info_new);
$str_company_user_name = App\Helpers\Utilities::getUserName($company_user_current_info_new);
if($company_user_current_info_new->role == 3)
{
$str_company_image_class_name =  'homeProfileCircle rounded-circle';      
}
else
{
$str_company_image_class_name =  'img-fluid imagesCover img_res_mob_dec';
}
$str_company_image_data =  @imageBasePath(@$company_user_current_info_new->profile_image);
}
$int_fun_fact_description_words_length = App\Helpers\UtilitiesTwo::fun_fact_description_words_length();
@endphp
<style type="text/css">
   #a_more, #award_mobile_more, #d_more {display: none;}
   .manufuturarProImg {
      width: 60px !important;
      height: 60px !important;
      border-radius: 100% !important;
   }
   .industryrolesHead a {
      font-size: 13px;
      color: #3d3b3b;
      font-weight: normal;
      text-decoration: underline;
   }
   .industryrolesHead h3 {
      margin: 0px !important;
   }
   .PopProductAuthor a.span-style1.fontWeightSix {
      text-decoration: underline;
      color: #000 !important;
   }
</style>
<?php
   // echo "<pre>"; print_r($product); die();
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[0]) ){
     $category1 = $product->categories->pluck('category_id')[0];
   } else {
     $category1 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[1]) ){
     $category2 = $product->categories->pluck('category_id')[1];
   } else {
     $category2 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('category_id')[2]) ){
     $category3 = $product->categories->pluck('category_id')[2];
   } else {
     $category3 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[0]) ){
     $sub_category1 = $product->categories->pluck('sub_category_id')[0];
   } else {
     $sub_category1 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[1]) ){
     $sub_category2 = $product->categories->pluck('sub_category_id')[1];
   } else {
     $sub_category2 = 0;
   }
   
   if(isset($product) && count($product->categories) > 0 && isset($product->categories->pluck('sub_category_id')[2]) ){
     $sub_category3 = $product->categories->pluck('sub_category_id')[2];
   } else {
     $sub_category3 = 0;
   }
   ?>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column bg-white border_rightF ProductProfile"  id="product-page-main-div">
      <div class="First-column bg-white">
         <div class="col-md-12">
            <div class="row sectionTop">
               <div class="col-lg-5 col-sm-5 col-md-12 px-2 imgProfilePadding">
                  <img src="{{@prodEventImageBasePath(@$product->main_image)}}" class="img-fluid mr-0 imgtwoeighty">
               </div>
               <div class="col-lg-7 col-sm-7 col-md-12 px-2 rightBox">
                  <div class="Jengatext paragraph mt-md-3 mt-lg-0">
                     <div class="row align-items-center">
                        <div class="col-sm-8 pr-0">
                           <div class="JengaW75">
                              <h2 class="mb-0">{{$product->name}}</h2>
                              <p class="productAuthor d-none">
                                 @php
                                 $base_url = url('/');
                                 $user_current_info_new = @$product->created_byy;
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
                                 $report_url = url('/report/4/'.Request::segment(2).'/'.@$product->user_id);
                                 @endphp  
                              </p>
                           </div>
                        </div>
                        <div class="col-sm-4 pl-sm-0">
                           <div class="JengaW25">
                              <div class="text-left text-md-right">
                                 <div class="my-2 AddToFavorites">
                                    @if(Auth::guard('users')->check())
                                    @if(check_watch_list(2,$product->id))
                                    <a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'{{ check_watch_list(2,$product->id)->id }}',2,'{{$user_current_info_new->id}}');" class="btn NoPaddingWatch "><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>
                                    @else
                                    <a href="javascript:void(0);" onclick="addFavorite(this,2,'{{$product->id}}');" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>
                                    @endif
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                    <div class="PopProductAuthor">
                     <p class="productAuthor m-0 fontWeightSix">by : <a class="span-style1 fontWeightSix" target="_blank" href="{{$str_user_url_new}}">{{ $str_user_name }}</a></p>
                  </div>
                  <ul class="d-flex flex-row ul-text-color1 my-1">
                     <a href="#!" class="text-dark fontFourteen">
                        <li>
                           @if(have_permission('category') )
                           {{category_byID($category1)}} 
                           @endif
                           @if(have_permission('sub_category') )
                           {{!empty($sub_category1) ? '| '.sub_category_byID($sub_category1) : ''}}
                           @endif
                           {{-- @foreach ($product->categories->nth(2) as $category)
                           {{ $category->category->category_name ?? null }}
                           @if($loop->index > $loop->count)
                           |
                           @endif
                           @endforeach --}}
                        </li>
                     </a>
                  </ul>
                  @if(!empty($product->description))
                        @if(strlen($product->description) > 300)
                         <div class="textBoiReadMore">
                             {!! nl2br(@$product->description) !!}
                        </div>
                         <a href="javascript:void(0);" onclick="textBoi(this,1)" class="readMore ProfileReadMore productprofilebtn btnReadMore">Read More...</a>
                        @else
                        <div>
                           {!! nl2br(@$product->description) !!}
                        </div>
                        @endif
                        <div class="textBoiReadLess" style="display: none;">
                             {!! nl2br(@$product->description) !!}
                           <a href="javascript:void(0);" onclick="textBoi(this,0)" class="readMore productprofilebtn ProfileReadMore">Read Less...</a>
                        </div>
                        @endif
                  <!-- <div class="modal" id="DescModal">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                           <div class="modal-header kbg_black">
                              <div class="textContent">
                                 <h4 class="modal-title text-white">Product Description</h4>
                              </div>
                              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                           </div>
                           <div class="modal-body">
                              <div >
                                 <p class="text-justify p-text">{!! @$product->description !!}</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  {{--
                  <p class="sidetitlePrice marginBotsix" >Price:
                     <span class="text-danger">${{$product->price}}<span>
                  </p>
                  --}}
                  @php
                  $obj_data_new = $product; 
                  @endphp

         
                  <div class="row d-flex justifly-content-start">
                     {{--
                     <!-- <div class="amazonWrap">
                        <label for="amazon_3" class="">
                           <a  href="@if(!empty($product->buyFrom->amazon)) {{ $product->buyFrom->amazon }} @else {{ '#' }} @endif" target="_blank">
                               <img src="{{asset('front/new/images/Product/amazon-button3.png')}}">
                           </a>
                        </label>
                        </div>  -->
                     --}}
                     <!-- <div class="col-md-12">
                        <div class="wathlistLeft ">
                           @if(Auth::guard('users')->check())
                           @if(check_watch_list(2,$product->id))
                           <a type="button" href="#" class="btn kAddedwatchlistbtn marginLeftNineMob">
                           <i class="fa fa-check photo_icon" ></i> Added to Watchlist
                           </a>
                           @else
                           <a type="button" href="{{route('front.pages.add_to_watch_list')}}?type=2&value={{$product->id}}" class="btn kwatchlistbtn marginLeftNineMob">
                           <i class="fa fa-plus photo_icon"></i> Add to Watchlist
                           </a>
                           @endif
                           @endif
                        </div>
                        </div> -->
                  </div>
               </div>
            </div>
         </div>
          <!--  ******** || Fun Facts || ********* -->
             @php 
             @$fun_fact1 = @$product->fun_fact1;
             @$fun_fact2 = @$product->fun_fact2;
             @$fun_fact3 = @$product->fun_fact3;
             @$editFunfacts = 0;
             @endphp  

           @include("front.includes.fun-facts")
          <!--  ******** || Fun Facts || ********* -->
         @if(!empty($product->brand) || !empty($product->company) || !empty($product->launched_date))
         <section class="sectionBox col-md-12">
            <div class="row">
               @if(!empty(@$product->brand))
               <div class="col-sm-6 col-md-12 col-lg-6 mb-3 strong_size">

                  <div class="indusroles d-flex">
                     <div class="industryrolesImages mr-3">
                        <img src="{{@imageBasePath(@$product->brand_list->main_image)}}" class="rounded-circle brandProImg" style="">
                     </div>
                     <div class="industryrolesDetails">
                        <div class="industryrolesHead">
                           <h3 class="mb-1">Brand</h3>
                           @if(!empty(@$product->brand_list->name))
                              <a href="{{ url('/') . '/brand/'. @$product->brand_list->slug }}" target="_blank">
                                 <!-- <img src="{{@imageBasePath($product->brand_list->main_image)}}" class="rounded-circle brandProImg" style=""> -->
                                 <p class="link-text1 w-100 mt-1">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$product->brand_list->name)}}</p>
                              </a>
                              @else
                              <p class="link-text1 w-100 mt-1">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$product->brand)}}</p>
                              @endif
                        </div>
                     </div>
                  </div>

               </div>
               @endif
               @if(!empty(@$product->company))
               <div class="col-sm-6 col-md-12 col-lg-6 mb-3 strong_size">

                  <div class="indusroles d-flex">
                     <div class="industryrolesImages mr-3">
                        <img src="{{@$str_company_image_data}}" class="rounded-circle manufuturarProImg" style="right: 83px;">
                     </div>
                     <div class="industryrolesDetails">
                        <div class="industryrolesHead">
                           <h3 class="mb-1">Manufacturer</h3>
                           @if(!empty($product->companydata->id))         
                              <a  target="_blank" href="{{$str_company_user_url_new}}">
                                 <p class="link-text1 w-100 mt-1 ">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$str_company_user_name)}} </p>
                              </a>
                           @else
                              <p class="link-text1 w-100 mt-1">{{App\Helpers\UtilitiesTwo::get_video_title_data(@$product->company)}}</p>
                           @endif
                        </div>
                     </div>
                  </div>

               </div>
               @endif   
               @if(!empty($product->launched_date))            
               <div class="col-sm-6 col-md-12 col-lg-6 strong_size">
                  <h2 class="sec_head_text_two w-100 mb-1 text-left">Launched Date: </h2>
                  <div>
                     <p class="p-text mb-0">{{@$product->launched_date}}</p>
                     <!--  <ul style="list-style: inside; color: #111;">
                        <li class="p-text mb-0">{{@$product->launched_date}}</li>
                        </ul> -->
                  </div>
               </div>
               @endif
            </div>
         </section>
         @endif 
         @if(!empty($product->buyFrom->amazon) || !empty($product->buyFrom->ebay) || !empty($product->buyFrom->pop))
         <div class="col-md-12">
            <div class="row sectionBox desktopveiw">
               <h2 class="sec_head_text w-100 text-left">Buy From</h2>
               <div class="w-100 TableProduct">
                  <table class="table event_table short_award_list" >
                     <tbody>
                        @if(!empty($product->buyFrom->amazon))
                        <tr>
                           <td class="dask_name">{{ $product->buyFrom->amazon_caption }}</td>
                           <td>
                              <a class="span-style1" target="_blank" href="{{@$product->buyFrom->amazon ? $product->buyFrom->amazon : null}}">
                              {{-- @$product->buyFrom->amazon ? $product->buyFrom->amazon : null --}}
                              View Link
                              </a>
                           </td>
                        </tr>
                        @endif
                        @if(!empty($product->buyFrom->ebay))
                        <tr>
                           <td class="dask_name">{{ $product->buyFrom->ebay_caption }}</td>
                           <td>
                              <a class="span-style1" target="_blank" href="{{@$product->buyFrom->ebay ? $product->buyFrom->ebay : null}}">
                              {{-- @$product->buyFrom->ebay ? $product->buyFrom->ebay : null --}}
                              View Link
                              </a>
                           </td>
                        </tr>
                        @endif
                        @if(!empty($product->buyFrom->pop))
                        <tr>
                           <td class="dask_name">{{ $product->buyFrom->pop_caption }}</td>
                           <td>
                              <a class="span-style1" target="_blank" href="{{@$product->buyFrom->pop ? $product->buyFrom->pop : null}}">View Link{{-- @$product->buyFrom->pop ? $product->buyFrom->pop : null --}}</a>
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
         @if(!empty($awards) && count($awards)>0 && !empty($award->eventAward) && count($award->eventAward)>0)
         <div class="col-md-12">
            <div class="row sectionBox desktopveiw">
               <h2 class="sec_head_text w-100 text-left">Awards</h2>
               <div class="w-100 TableProductTwo">
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
               <div class="w-100 TableProductThree">
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
         @include("front.user.modules.product_collaborator_list")
         @if(!empty($gallery_video_data))
         @include("front.user.modules.videos_gallery")
         @endif
         @if(!empty($product->officialLinks) && count($product->officialLinks)>0)
         <div class="col-md-12">
            <div class="row sectionBox officialLinks">
               <h2 class="sec_head_text text-left w-100 d-block">Official Links</h2>
               <?php $sr = 1; ?>
               <div class="Social-align">
                  @foreach($product->officialLinks ?? [] as $socials)
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
         @if(!empty($product->brand) || !empty($product->company))
         <section class="">
            <div class="col-md-12">
               <div class="row sectionBox strong_size">
                  <h2 class="sec_head_text text-left w-100">Product Metadata</h2>
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
            @if(!empty($product->classification))
                <div class="col-md-12">
                   <div class="row sectionBox">
                      <h2 class="sec_head_text text-left w-100">Classification</h2>
                      <div>
                         @if(!empty($product->classification->type)) 
                            <p class="text-black p-0 mb-1">Type : {{@config('cms.classification_type')[$product->classification->type] ?? null}}</p>
                         @endif
                         @if(!empty($product->classification->delivery_mechanism)) 
                            <p class="text-black p-0 mb-1">Delivery Mechanism : {{@config('cms.delivery_mechanism')[$product->classification->delivery_mechanism] ?? null}}</p>
                         @endif
                         @if(!empty($product->classification->toy_type)) 
                            <p class="text-black p-0 mb-1">Toy Type : {{@config('cms.toy_type')[$product->classification->toy_type] ?? null}}</p>
                         @endif
                         @if(!empty($product->classification->year_launched)) 
                            <p class="text-black p-0 mb-1">Launched : {{$product->classification->year_launched ?? null}}</p>
                         @endif
                         @if(!empty($product->classification->inventor)) 
                            <p class="text-black p-0 mb-1">Inventor : {{$product->classification->inventor ?? null}}</p>
                         @endif
                         @if(!empty($product->classification->team)) 
                            <p class="text-black p-0 mb-1">Team : {{$product->classification->team ?? null}}</p>
                         @endif
                         @if(!empty($product->brand))     
                            <p class="text-black p-0 mb-1">Brand : {{@$product->brand}}</p>
                         @endif
                         @if(!empty($product->company))     
                            <p class="text-black p-0 mb-1">Manufacturer : {{@$product->company}}</p>
                         @endif
            
                      </div>
                   </div>
                </div>
                @endif  */ ?> 
         @include("front.user.modules.social_media_icons")
         @include("front.user.modules.ajax_image_gallery_video")
      </div>
   </div>
   
   @include('front.includes.join_mailing')
   <script type="text/javascript">
    
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
</div>
<!-- </div> -->
@include("front.includes.include_read_more_js")
@endsection

@section('scripts')
@include("front.includes.profile_js_scripts_include")

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
  
   
   function addFavorite(e,type,user_id) {
   $.ajax({
   url: "{{route('front.pages.add_to_watch_list')}}?type=2&value="+user_id,
   data: {},
   dataType: 'json',
   type: 'GET',
   success: function (data) {
   $('.AddToFavorites').html('');
   $('.AddToFavorites').html('<a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'+data.id+','+type+','+user_id+');" class="btn NoPaddingWatch "><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>');
   toastr.success(data.msg);
   }
   });
   }
   
   function removeFavorites(e,id,type,user_id) {
   $.ajax({
   url: "{{url('remove-from-watch-list/')}}/"+id,
   data: {},
   dataType: 'json',
   type: 'GET',
   success: function (data) {
     $('.AddToFavorites').html('');
     $('.AddToFavorites').html('<a type="button" href="javascript:void(0);" onclick="addFavorite(this,'+type+','+user_id+');" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>');
   
     toastr.success(data.msg);
   }
   });
   }
</script>

@endsection