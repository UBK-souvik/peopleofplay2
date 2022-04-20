@extends('front.layouts.pages')
@section('content')
@php
$user_current_info = get_current_user_info();
$base_url = url('/');
$role_type_id = 0;
$int_type_of_user = 0;
$str_modal_role_type = '';
$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
$chk_slug_in_current_url = App\Helpers\UtilitiesTwo::chkSlugInCurrentUrl();
$str_user_url = App\Helpers\Utilities::get_user_url($base_url, $user_current_info);
if(!empty($user_current_info->role))
{
   $role_type_id = $user_current_info->role; 
}
if(!empty($user_current_info->type_of_user))
{
   $int_type_of_user = $user_current_info->type_of_user; 
}
if(!empty($user_current_info->id))
{
   $str_profile_user_edit = $arr_menu_list['profile_user_edit'];
}
$str_current_url =  url()->current();
$str_user_website = $user->website;
$def_user_image_path = App\Helpers\Utilities::get_default_image();
$is_chk_contact_info_flag = 0;
if(!empty($user->inventorContactInfo->agent_name) || !empty($user->inventorContactInfo->agent_email_id) 
|| !empty($user->inventorContactInfo->manager_name) || !empty($user->inventorContactInfo->manager_email_id)
|| !empty($user->inventorContactInfo->company_name) || !empty($user->inventorContactInfo->company_email_id) )
{
   $is_chk_contact_info_flag = 1;  
}
if(!empty($user->inventorContactInfo->company_name))
{   
   $str_inventor_company_name =  @$user->inventorContactInfo->company_name;
   if(is_numeric($str_inventor_company_name))
   {
      $company_user_data = @App\Helpers\Utilities::get_user_object($str_inventor_company_name);
      $str_company_name = @App\Helpers\Utilities::getUserName($company_user_data);  
   }
   else
   {      
      $str_company_name = $str_inventor_company_name;     
   }   
}
else
{
   $str_company_name = '';
}
$arr_social_media_type = App\Helpers\UtilitiesTwo::getSocialMediaArrayValue($user->socialMedia);
$social_media_array_type =$arr_social_media_type[0];
$social_media_array_value =$arr_social_media_type[1];
$int_user_word_length = @App\Helpers\UtilitiesTwo::words_length(@$user->description);
$int_description_words_length = @App\Helpers\UtilitiesTwo::profile_about_words_length();
$int_fun_fact_description_words_length = App\Helpers\UtilitiesTwo::fun_fact_description_words_length();
$int_chk_user_logged_id =  @Auth::guard('users')->user()->id;
$int_user_id_current_new =  @$user->id;
$arr_badges_list = @App\Helpers\UtilitiesTwo::get_batch_list_data();
$int_chk_personal_details_flag = 0;
if(!empty($user->phone_number) || empty($user->hide_email) || empty($user->hide_telephone) || empty($user->hide_secondary_email) || !empty($user->email) || !empty($user->mobile)
|| !empty($user->secondary_phone_number) || !empty($user->secondary_email) || !empty($user->secondary_mobile)
|| !empty($user->postal_address) || !empty($user->city) || !empty($user->state) || !empty($user->zip_code)
|| !empty($user->countrydata->country_name) || !empty($user->business_address) || !empty($user->city_business)
|| !empty($user->state_business) || !empty($user->zip_code_business) || !empty($user->country_id_business)
|| !empty($str_user_website) || !empty($user->dobyear))
{
   $int_chk_personal_details_flag = 1;
}                 
@endphp
<link rel="stylesheet" type="text/css" href="">
<style>
   .bg-image {
      filter: blur(8px);
      -webkit-filter: blur(8px);
      height: 100px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
   }
   .bg-text {
      background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0, 0.4); 
      color: white;
      font-weight: bold;
      border: 3px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 80%;
      padding: 20px;
      text-align: center;
   }
   .bg-text h1{
      font-size: 25px;
   }
   #a_more, #award_mobile_more {display: none;}
   .sectionBox {
      padding: 10px 20px !important;
   }
   .UserProfile .span-style1 {
    padding: 10px 0 0 !important;
    display: inline-block;
   }
</style>
<div class="col-md-7 col-lg-8 ProfileMiddleColumnSection">
   <div class="left-column border_right UserProfile" id="profile-page-main-div">
      <!----Profile Desgin----->
      <div class="First-column bg-white p-0">
         <div class="">
            <div class="col-md-12 p-0" >
               <div class="row sectionTop">
                  <div class="col-lg-5 col-sm-5 col-md-5 px-2">
                     <?php //echo Auth::guard('users')->user()->id."==". $user->id; die; ?>
                     @php
                     $str_user_name = @App\Helpers\Utilities::getUserName($user);
                     $base_url = url('/report/0/url/'.@$user->id);
                     @endphp            
                     <div class="imgtwoeighty">
                        <img src="{{@imageBasePath(@$user->profile_image)}}" class="img-fluid imgtwoeighty">
                     </div>
                     {{-- 
                        <div class="ProfileMessage my-4 text-center">
                           @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                           <a href="{{ url('user/message/'.@$user->id) }}" class="btn edit-btn-style">Message</a>
                           @endif
                        </div>
                        --}}
                        <div class=" mt-2 d-flex">
                           @foreach($arr_badges_list as $arr_badges_list_row)
                           @php
                           $int_batch_id = $arr_badges_list_row;
                           $str_badge_name = 'badge_' . $int_batch_id;
                           $str_badge_caption = 'badge_' . $int_batch_id . '_caption';
                           @endphp
                           @if(!empty(@$user->$str_badge_name))
                           <div class="tip mr-2" data-placement="top" title="@if(!empty(@$user->$str_badge_caption)){{@$user->$str_badge_caption}}@endif">
                              <img src="{{@imageBasePath(@$user->$str_badge_name)}}" class="mr-1 text-center badgesCircle" >
                           </div>
                           @endif
                           @endforeach 
                        </div>
                              <div class="col-12">
                                 <div class="text-center">
                                    {{--
                                       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                                          <a class="btn mt-2" style="border:1px solid grey;background-color: #fff;padding: 4px 15px;color: grey;" href="{{url('user/message/'.$user->id)}}">Send Message</a>
                                       @endif
                                    --}}
                                    
                                    <div class="my-2 text-center AddToFavorites">
                                       @if($user->role ==2)
                                       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                                       @if(check_watch_list(1,$user->id))
                                       @if(Auth::guard('users')->check())
                                       <a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'{{ check_watch_list(1,$user->id)->id }}',1,'{{$user->id}}');" class="btn NoPaddingWatch "><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>
                                       @endif
                                       @else
                                       <a type="button" href="javascript:void(0);" onclick="addFavorite(this,1,'{{$user->id}}');" class="btn NoPaddingWatch "><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>
                                       @endif
                                       @endif
                                       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id)
                                       <a class="btn FavEditProfile mr-1" href="{{ $str_profile_user_edit }}">Edit Profile</a>
                                       @endif
                                       @endif
                                       
                                       @if($user->role ==3)  
                                       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                                        {{--  <a class="btn mt-2" style="border:1px solid grey;background-color: #fff;padding: 4px 15px;color: grey;" href="{{url('user/message/'.$user->id)}}">Send Message</a> --}}
                                       @endif
                                       @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                                       @if(check_watch_list(4,$user->id))
                                       <a type="button"  href="javascript:void(0);" onclick="removeFavorites(this,'{{ check_watch_list(4,$user->id)->id }}',4,'{{$user->id}}');" class="btn NoPaddingWatch"><i class="fa fa-star mr-1" aria-hidden="true" style="color:#652793;"></i> Added to Favorites</a>
                                       @else
                                       <a type="button" href="javascript:void(0);" onclick="addFavorite(this,4,'{{$user->id}}');" class="btn NoPaddingWatch"><i class="fa fa-star-o mr-1" aria-hidden="true"></i>Add to Favorites</a>
                                       @endif
                                       @endif
                                       @endif
                                    </div>
                                 </div>
                              </div>
                        <div class="ProfilPagFeeds d-none">
                           <div class="ProfOpt py-4 py-sm-2 w-100">
                              <ul class="nav">
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src=" {{ url('/front/images/icons/pop1.png') }}" alt="ProfImg" class="img-fluid"><span>Pop it! (18)</span></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="{{ url('/front/images/icons/comment1.png') }}" alt="ProfImg" class="img-fluid"><span>Comment (6)</span></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="{{ url('/front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share (14)</span></a> 
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="{{ url('/front/images/icons/messages1.png') }}" alt="ProfImg" class="img-fluid"><span>Message</span></a>
                                 </li>
                              </ul>
                           </div>
                           <div class="FeedCommentsSec">
                              <div class="CommentsSection py-2 px-3 mt-2 w-100">
                                 <div class="w-100 clearfix CommentsProfImg">
                                    <div class="d-flex align-items-center">
                                       <div class="CommentProfileImg">
                                          <img src="/uploads/images/users/20210228225434A6APNS4XaI_users_.jpg" alt="ProfImg" class="img-fluid rounded-circle CommentProfileImage">
                                       </div>
                                       <div class="CommentUserName">
                                          <p class="mb-0">Clark Nesselrodt</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="w-100 clearfix AnotherUserComment my-1">
                                    <div class="d-flex align-items-center CommentUser">
                                       <div class="UsrComt w-75">
                                          <p class="m-0">Peggy is awesome!</p>
                                       </div>
                                       <div class="UsrComtDat w-25">
                                          <span>[Date]</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="CommentsSection py-2 px-3 mt-2 w-100">
                                 <div class="w-100 clearfix CommentsProfImg">
                                    <div class="d-flex align-items-center">
                                       <div class="CommentProfileImg">
                                          <img src="/uploads/images/users/20210228225434A6APNS4XaI_users_.jpg" alt="ProfImg" class="img-fluid rounded-circle CommentProfileImage">
                                       </div>
                                       <div class="CommentUserName">
                                          <p class="mb-0">Clark Nesselrodt</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="w-100 clearfix AnotherUserComment my-1">
                                    <div class="d-flex align-items-center CommentUser">
                                       <div class="UsrComt w-75">
                                          <p class="m-0">Peggy is awesome!</p>
                                       </div>
                                       <div class="UsrComtDat w-25">
                                          <span>[Date]</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="CommentBtn text-center my-2 w-100">
                                 <a href="javascript:void(0)" class="py-1 d-block AllCommentBtn">See All Comments</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-7 col-sm-7 col-md-7 px-2">
                        <div class="paragraph k_text_sec">
                           <div class="row RevRow">
                              <div class="col-sm-7 col-lg-6 col-xl-7 pr-sm-0">
                                 <h2 class="mb-0">
                                    {{@$str_user_name}} 

                                    @if(($user->role !=3) && ($user->is_verify_profile ==1))
                                    <img src="{{ asset('front/images/ProfessionalOnventorCheckmark.png') }}" alt="profileimage" class="img-fluid badges">
                                    @endif

                                 </h2>

                                 @if(!empty(@$user->pronoun) && @$user->pronoun != 'not-specify')
                                 <span class="acronym fontThirteen">{{@$user->pronoun}} </span>
                                 @endif
                                 @if($user->role ==3)
                                 @if(!empty($user->companyCategory->name))
                                 {{$user->companyCategory->name}}
                                 @endif
                                 @endif
                              </div>
                              @if($user->role ==2)
                              <div class="col-md-12">
                                       @if(!empty($user->home_page_slide_show_caption))
                                    <div class="CaptionTxt my-2">
                                       <p class="fontWeightSix">
                                       {{ucwords($user->home_page_slide_show_caption)}} 
                                       </p>
                                    </div>
                                       @endif
                              </div>
                              @endif
                           </div>
                           @if(!empty(@$user->acronym))
                           <div class="CaptionTxt my-2">
                              <p class="acronym fontThirteen font-weight-bold">({{@$user->acronym}}) </p>
                           </div>
                           @endif
                           @if(!empty($user->description))
                           @if(strlen($user->description) > 300)
                           <div class="textBoiReadMore">
                            {!! nl2br(@$user->description) !!}
                         </div>
                         <a href="javascript:void(0);" onclick="textBoi(this,1)" class="readMore ProfileReadMore btnReadMore">Read More...</a>
                         @else
                         <div>
                           {!! nl2br(@$user->description) !!}
                        </div>
                        @endif
                        <div class="textBoiReadLess" style="display: none;">
                         {!! nl2br(@$user->description) !!}
                         <a href="javascript:void(0);" onclick="textBoi(this,0)" class="readMore ProfileReadMore">Read Less...</a>
                      </div>
                      @endif
                      <!-- for a company User -->
                      @if($user->role ==3)
                      <!-- <hr class="horizline"> -->
                      <div class="col-md-12 strong_size">
                        <div class="row">
                           <!-- <h3 class="sec_head_text w-100">Contact Information</h3> -->
                           <div class="">
                              {{-- ($int_chk_user_logged_id == $int_user_id_current_new) &&  ($int_chk_user_logged_id!=$int_user_id_current_new) --}}
                              @if(have_permission('email') )
                              @if(empty($user->hide_email))
                              @if(!empty($user->email))
                              <p class="text-black p-0 mb-1"><strong>Email</strong> : {{ $user->email }}</p>
                              @endif   
                              @endif
                              @endif
                              @if(!empty($user->mobile))
                              <p class="text-black p-0 mb-1"><strong>Phone</strong> : {{@App\Helpers\UtilitiesFour::getUserDialCode($user)}} {{ $user->mobile }}</p>
                              @endif
                              @if(have_permission('email') )
                              @if(!empty($str_user_website))
                              <p class="text-black p-0 mb-1"><strong>Website</strong> : <a href="{{ (strpos($str_user_website, 'http://') !== 0 && strpos($str_user_website, 'https://') !== 0 ) ? 'http://'.$str_user_website : $str_user_website }}" target="_blank">{{@App\Helpers\UtilitiesTwo::get_video_title_data($str_user_website)}}</a></p>
                              @endif
                              @endif
                           </div>
                        </div>
                     </div>
                     <div class="mb-2 d-none">
                        @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                        <a class="btn mt-2" style="border:1px solid grey;background-color: #fff;padding: 4px 15px;color: grey;" href="{{url('user/message?uid='.$user->id)}}">Send Message</a>
                        @endif
                        @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                        @if(check_watch_list(4,$user->id))
                        <a type="button" href="#" class="btn NoPaddingWatch mt-2">
                           <i class="fa fa-check photo_icon" ></i> Added to Watchlist
                        </a>
                        @else
                        <a type="button" href="{{route('front.pages.add_to_watch_list')}}?type=4&value={{$user->id}}" class="btn NoPaddingWatch mt-2"><i class="fa fa-plus photo_icon"></i> Add to Watchlist</a>
                        @endif
                        @endif
                     </div>
                     <!-- <hr class="horizline"> -->
                     @endif
                     <div class="modal" id="userDescModal">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header kbg_black">
                                 <div class="textContent">
                                    <h4 class="modal-title text-white">User Description</h4>
                                 </div>
                                 <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                 <div >
                                    <p class="text-justify p-text">{{@$user->description}}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @if($user->role ==2)
                     @if(!empty($user->dobday) && !empty($user->dobmonth))  
                     @if(have_permission('born') )
                     <p>Born : @if(!empty($user->dobday))
                        <span class="text-capitalize">{{$user->dobday}}</span>
                        @endif 
                        @if(!empty($user->dobmonth))
                        <span class="text-capitalize"> {{ get_month($user->dobmonth) }}</span>
                        @endif
                        @endif
                        {{-- {{@Carbon\Carbon::parse($user->dob)->format('d M Y')}} --}} 
                        {{-- (age {{@Carbon\Carbon::parse($user->dob)->age}}) --}}
                     </p>
                     @endif
                     @if(isset(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 2)
                     @else
                     @if(Auth::guard('users')->check())
                     @else
                     <p> More at : <span class="text-lowercase">@include("front.profile.more_at_poppro_popup")</span></p>
                     @endif
                     @endif
                        <!--  <div class="my-2 ">
                           @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                           <a class="btn sendMessageBtn mr-1" href="{{url('user/message?uid='.$user->id)}}">Send Message</a>
                           @endif
                           @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id != $user->id)
                           @if(check_watch_list(1,$user->id))
                           <a type="button" href="#" class="btn NoPaddingWatch ">
                           <i class="fa fa-check photo_icon" ></i>Added to Favorites
                           </a>
                           @else
                           <a type="button" href="{{route('front.pages.add_to_watch_list')}}?type=1&value={{$user->id}}" class="btn NoPaddingWatch "><i class="fa fa-plus photo_icon"></i>Add to Favorite</a>
                           @endif
                           @endif
                           </div>
                        -->
                        {{-- @endif --}}           
                        @endif
                     </div>
                     @php
                     $obj_data_new = $user; 
                     @endphp
           
</div>
</div>
</div>

<!--  ******** || Fun Facts || ********* -->
   @php 
   @$fun_fact1 = @$user->fun_fact1;
   @$fun_fact2 = @$user->fun_fact2;
   @$fun_fact3 = @$user->fun_fact3;
   @$editFunfacts = 1;
   @endphp  

 @include("front.includes.fun-facts")
<!--  ******** || Fun Facts || ********* -->

{{-- for an innovator --}} 
@if(isset(Auth::guard('users')->user()->type_of_user) )
@if($user->role == 2 || $user->role == 3)
@if(!empty($user->skills) || !empty($user->services))
@if(have_permission('skills') && have_permission('gender') )
<div class="col-md-12">
   <div class="row sectionBox SkillsExpertise">
     <h3 class="sec_head_text w-100">Skills & Expertise  
      @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id)
      <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Edit Skills & Expertise"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
      @endif
   </h3>
   <div class="row strong_size" >
      <div class="col-md-12">
         @if(have_permission('skills') )
         @php 
         $str_user_skills_new = '';
         if(!empty($user->skills)){
            $explode = explode(',', $user->skills);
         }if(!empty($user->services)){
            $explode = explode(',', $user->services);
         }
         
         $implode = implode(', ', $explode);
         foreach($explode as $explode_row)
         {
            if(empty($str_user_skills_new))
            {
               $str_user_skills_new = '<span class="spanTag">'. $explode_row. '</span>';   
            }
            else
            {
               $str_user_skills_new = $str_user_skills_new . '&nbsp;&nbsp;<span class="spanTag">'. $explode_row. '</span>';    
            }
         }
         @endphp
         <p class="text-black p-0 mb-1">{!!$str_user_skills_new!!}</p>
         @endif
         @if(have_permission('gender') )
         {{-- 
            <p class="text-black p-0 mb-0"><strong>Gender</strong> : {{ $user->gender }}</p>
            --}}
            @endif
            {{-- 
               <p class="text-black p-0 mb-1"><strong>User Age</strong> : {{ @Carbon\Carbon::parse($user->dob)->age }}</p>
               --}}
            </div>
         </div>
      </div>
   </div>
   @endif
   @endif
   @endif
   @endif 
   {{-- for an innovator or company --}}
   @if(isset(Auth::guard('users')->user()->type_of_user) )
   @if($user->role == 2 || $user->role == 3)
   @if(have_permission('website') )
   @if(!empty($role_data) && count($role_data)>0) 
   @include("front.profile.user_role_data_popup")
   @endif
   @endif
   @endif
   @endif 
   @if(!empty($gallery_image_data))
   @include("front.user.modules.images_gallery")
   @endif
   @if(!empty($gallery_known_for_data))
   @include("front.user.modules.known_for_images")

   @endif
   {{-- @if($user->role ==2) --}}
   @if(!empty($awards) && count($awards)>0)
   <div class="col-md-12">
      <div class="row sectionBox desktopveiw">
         <h2 class="sec_head_text w-100 text-left">Awards</h2>
         <div class="table-respomsive">
            <table class="table event_table short_award_list" >
               <tbody>



                <?php //echo "<pre>"; print_r($awards); die; ?> 
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
{{-- @endif --}}
               <!-- @if(!empty($awards) && count($awards)>0)
               <div class="col-md-12">
                  <div class="row sectionBox mobileveiw">
                     <h2 class="sec_head_text w-100 text-left">Awards</h2>
                     <div>
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
               @endif -->
               @endif 
               <!-- user brands slideshow -->
               @include("front.user.modules.user_brand_list")
               <!-- user products slideshow --> 
               @include("front.user.modules.user_products")
               <!-- user media slideshow -->
               @include("front.user.modules.user_media_list") 
               <!-- user media slideshow -->
               @include("front.user.modules.user_award_list")
               
               @if(!empty($gallery_video_data))
               @include("front.user.modules.videos_gallery")
               @endif
               {{-- for an innovator  --}}
               @if(isset(Auth::guard('users')->user()->type_of_user) )
               @if(isset(Auth::guard('users')->user()->type_of_user) && (Auth::guard('users')->user()->type_of_user == 2 || Auth::guard('users')->user()->type_of_user == 3))
               @if(($user->role ==2 || $user->role ==3)  && !empty($int_chk_personal_details_flag))

               @include('front.profile.personal_details')
               <!-- <hr> -->
               @endif
               @endif
               @endif 
               <!-- for a free user or user not logged in --> 
               @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
               <div class="col-md-12 strong_size">
                  <div class="row sectionBox">
                     <h3 class="sec_head_text w-100">Contact Information</h3>
                     @include("front.user.modules.blur")
                  </div>
               </div>
               @endif
               {{-- for an innovator or company  --}}
               @if(isset(Auth::guard('users')->user()->type_of_user) )
               @if($user->role == 2 || $user->role == 3)
               @if(have_permission('website') )
               @include("front.user.modules.social_media_icons")
               @endif
               @endif
               @endif
               <!-- user blog slideshow -->
               @include("front.user.modules.user_blog_list")
               <!-- for a free user or user not logged in --> 
               @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
               <div class="col-md-12 strong_size">
                  <div class="row sectionBox">
                   <h3 class="sec_head_text w-100">Social Media 
                     @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id)
                     <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Social Media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                     @endif
                  </h3>
                  @include("front.user.modules.blur")
               </div>
            </div>
            @endif
            <!-- for a free user or user not logged in --> 
            @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
            <div class="col-md-12 strong_size">
               <div class="row sectionBox SkillExpertise">
                  <h3 class="sec_head_text w-100">Skills & Expertise</h3>
                  @include("front.user.modules.blur")
               </div>
            </div>
            @endif
            <!-- <hr> -->
            <!-- for a free user or user not logged in --> 
            @if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1) 
            <div class="col-md-12 strong_size">
               <div class="row sectionBox">
                  <h3 class="sec_head_text w-100">Roles</h3>
                  @include("front.user.modules.blur")
               </div>
            </div>
            @endif
         </div>
      </div>
      <div class="userProfileNews ">
         {{-- for an innovator or company --}}
         @if($user->role == 2 || $user->role == 3) 
         @if(!empty($news))      
         @include("front.user.modules.featured_news_page")
         @endif
         @endif
      </div>
   </div>
   @include('front.includes.join_mailing')
</div>
@include("front/includes/advertisement")
<script>
   $(document).ready(function(){
      $('#AboutReadMore').click(function() {
       $('.AboutUser p').toggleClass("Abt");
    });
   });

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
@include("front.user.modules.ajax_image_gallery_video")
<style type="text/css">
   #more {display: none;}
</style>
<input type="hidden" name="hid_current_url" id="hid_current_url" value="{{$str_current_url}}">

@include("front.includes.profile_js_scripts_include")

@endsection