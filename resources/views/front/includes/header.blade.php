
<?php
$user_current_info = get_current_user_info();
$base_url = url('/');
$str_link_user_profile ='';
$int_type_of_user = 0;
$role_type_id = 0;
$str_modal_role_type = '';

$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);
if(!empty($user_current_info->id))
{
$str_link_user_profile = App\Helpers\Utilities::get_user_url($base_url, $user_current_info);
}
if(!empty($user_current_info->type_of_user))
{
$int_type_of_user = $user_current_info->type_of_user;
}
if(!empty($user_current_info->role))
{
$role_type_id = $user_current_info->role;
}
$str_link_drop_menu_toys = $arr_menu_list['str_link_drop_menu_toys'];
$str_link_advance_search = $arr_menu_list['str_link_advance_search'];
$str_link_columnists = $arr_menu_list['str_columnists'];
$str_link_drop_menu_games = $arr_menu_list['str_link_drop_menu_games'];
$str_link_drop_menu_companies = $arr_menu_list['str_link_drop_menu_companies'];
$str_link_drop_menu_inventors = $arr_menu_list['str_link_drop_menu_inventors'];
$str_link_user_login = $arr_menu_list['str_link_user_login'];
$str_link_user_login_pop = $arr_menu_list['str_link_user_login'];
$str_link_drop_menu_events = $arr_menu_list['str_link_drop_menu_events'];
$str_link_drop_menu_awards = $arr_menu_list['str_link_drop_menu_awards'];
$str_link_user_watch_list = $arr_menu_list['str_link_user_watch_list'];
$str_link_knowledge_base_faqs = $arr_menu_list['str_link_knowledge_base_faqs'];
$str_link_knowledge_base_articles = $arr_menu_list['str_link_knowledge_base_articles'];
$str_link_sign_up = $arr_menu_list['str_link_sign_up'];
$str_link_coming_soon = $arr_menu_list['str_link_coming_soon'];
$str_link_drop_menu_brands = $arr_menu_list['str_link_drop_menu_brands'];
$str_link_drop_menu_kids = $arr_menu_list['str_link_drop_menu_kids'];
$str_link_drop_menu_rip = $arr_menu_list['str_link_drop_menu_rip'];
$str_link_classifieds = $arr_menu_list['str_link_classifieds'];
if(!empty($user_current_info->id))
{

$str_profile_all_video_gallery = $arr_menu_list['profile_all_video_gallery'];
$str_profile_all_award = $arr_menu_list['profile_all_award'];
$str_profile_view = $arr_menu_list['profile_user_view'];
$str_profile_user_edit = $arr_menu_list['profile_user_edit'];
$str_profile_change_plan = $arr_menu_list['profile_change_plan'];
$str_profile_change_password = $arr_menu_list['profile_change_password'];
$str_profile_product_index = $arr_menu_list['profile_product_index'];
$str_profile_all_image_gallery = $arr_menu_list['profile_all_image_gallery'];
$str_profile_all_media = $arr_menu_list['profile_all_media'];
$str_profile_event_index = $arr_menu_list['profile_event_index'];
$str_profile_blog_index = $arr_menu_list['profile_blog_index'];
$str_profile_news_index = $arr_menu_list['profile_news_index'];
$str_profile_user_message = $arr_menu_list['profile_user_message'];
$str_link_user_logout = $arr_menu_list['str_link_user_logout'];
$str_modal_role_type = $arr_menu_list['profile_change_plan'];
$str_profile_brand_index = $arr_menu_list['profile_brand_index'];
$str_profile_dictionary_index = $arr_menu_list['profile_dictionary_index'];
$str_profile_classified_index = $arr_menu_list['profile_classified_index'];
}
$str_news_link_new = $arr_menu_list['str_news_link_new'];
$str_interviews_link_new = $arr_menu_list['str_interviews_link_new'];
$str_link_pop_2021_first_quarter = $arr_menu_list['str_link_pop_2021_first_quarter'];
$str_link_pop_industry_get_together = $arr_menu_list['str_link_pop_industry_get_together'];
$str_link_pop_2020_pop_tagies_toys_games_awards = $arr_menu_list['str_link_pop_2020_pop_tagies_toys_games_awards'];
$str_link_pop_playchic = $arr_menu_list['str_link_pop_playchic'];
$str_link_pop_yic = $arr_menu_list['str_link_pop_yic'];
$str_link_pop_2020_fair_stages = $arr_menu_list['str_link_pop_2020_fair_stages'];
$str_link_pop_play_in_education = $arr_menu_list['str_link_pop_play_in_education'];
$str_link_pop_contact_us = $arr_menu_list['str_link_pop_contact_us'];
$str_link_drop_menu_dictionary_word_of_day = $arr_menu_list['str_link_drop_menu_dictionary_word_of_day'];
$str_link_pop_play_shop = $arr_menu_list['str_link_pop_play_shop'];
$str_blog_pedia_link_new = $arr_menu_list['str_blog_pedia_link_new'];
$str_link_wiki = $arr_menu_list['str_link_wiki'];
$str_link_office_hours = $arr_menu_list['str_link_office_hours'];
$str_link_pop_entertainment = $arr_menu_list['str_link_pop_entertainment'];
$str_link_pop_cast = $arr_menu_list['str_link_pop_cast'];
// check if the user has completed payment or not
use App\Http\Controllers\Front\AuthenticationController;
$str_checkPaidUserAuthentication =  AuthenticationController::checkPaidUserAuthentication(0);

$showLock = 0;
if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1) {
 $showLock = 1;
}

  ?>

<!---------------|| Header ||--------------->
<header class="DesktopHeader">
   <div class="container-fluid">
      <div class="box-width1">
         <div class="TopHeaderSignIn mb-3 ">
            <ul class="nav justify-content-end">
               <li class="nav-item">
                  <a class="nav-link li-color" href="{{ route('front.home.site.search.data') }}">Advanced Search</a>
               </li>
               <li class="nav-item">
                  @if(!Auth::guard('users')->check())
                     <a class="nav-link li-color " href="{{$str_link_user_login}}">Sign In</a>
                  @else
                     <a class="nav-link li-color" href="{{$str_link_user_logout}}">Logout</a>
                  @endif
               </li>
            </ul>
         </div>
         <div class="DestopMainHeader">
            <div class="HeaderNavBar d-flex justify-content-between">
               <div class="HeaderSeachBar">
                  <div class="MainMenuHeader sideListTopHead">
                  <nav class="navbar navbar-expand-lg navbar-light w-100">
                     <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('front/images/mainLogo.png') }}" class="PopLogo"></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#popcollapsibleNavbar">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="popcollapsibleNavbar">
                     <ul class="nav">
                        <li class="nav-item">
                           <div class="dropdown">
                              <a class="nav-link li-color" href="{{route('front.feeds_news.news-feeds')}}">News</a>
                           </div>
                        </li>
                        <li class="nav-item">
                           <div class="dropdown">
                              <a class="nav-link li-color dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">Networking</a>
                              <div class="dropdown-menu">
                                 <div class="childDropOne">
                                    <a class="dropdown-item" href="{{url('/')}}/pub">Pub Meeting</a>
                                    <a class="dropdown-item" href="{{ $str_link_advance_search }}">Search & Browse</a>
                                    @if(!Auth::guard('users')->check())
                                       <a class="dropdown-item" href="{{$str_link_sign_up}}">Create a Profile</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('front.pages.quiz.detail') }}">3 Truths and a Lie</a>
                                    <a class="dropdown-item" href="{{$str_link_classifieds}}">Classifieds</a>
                                    <a class="dropdown-item" target="_blank" href="{{$str_link_pop_industry_get_together}}">Networking Events</a>
                                    <a class="dropdown-item" target="_blank" href="{{ route('front.prEvent') }}">2022 April Marketing and PR Event</a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="nav-item">
                        <div class="dropdown">
                           <a class="nav-link li-color dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">Knowledge</a>
                           <div class="dropdown-menu">
                              <div class="childDropOne">
                                 <a class="dropdown-item" href="{{ $str_link_wiki }}">Wiki - Articles & Videos</a>
                                 <a class="dropdown-item" href="{{ route('front.pages.blogs') }}">Blogs & Interviews</a>
                                 <a class="dropdown-item" href="{{ $str_link_drop_menu_dictionary_word_of_day }}">Dictionary</a>
                                 <a class="dropdown-item" href="{{$str_link_drop_menu_rip}}">Rest in Peace - RIP</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_cast}}">Popcasts</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_entertainment}}">Entertainment</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_pop_2021_first_quarter}}">Conferences</a>
                                 {{--
                                    <a class="dropdown-item" href="{{$str_link_office_hours}}">Service Providers</a>
                                 --}}
                                 <a class="dropdown-item" href="{{ url('service-providers') }}">Service Providers</a>
                              </div>
                           </div>
                        </div>
                        </li>
                        <li class="nav-item">
                        <div class="dropdown">
                           <a class="nav-link li-color dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown">Events</a>
                           <div class="dropdown-menu">
                              <div class="childDropOne">
                                 <a class="dropdown-item" href="{{url('/')}}/pub">Pub Meeting</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_pop_industry_get_together}}">Networking Events</a>
                              </div>
                           </div>
                        </div>
                        </li>
                        <li class="nav-item">
                        <div class="dropdown">
                           <a class="nav-link li-color" href="{{route('front.about')}}">About POP</a>
                        </div>
                        </li>
                     </ul>
                     </div>
                  </nav>
                  </div>
               </div>
               <div class="topSearchBar">
                  <div class="w-100 SearchBar">
                     <form class="form-inline mt-0 my-lg-0 w-100 mobsearchbar" id="form-home-site-search-input-main-mobile"  method="post" action="{{route('front.home.site.search.data')}}">
                        @csrf
                        <div class="w-100">
                           @php
                           $int_is_desk_top_search_flag_new = 0;
                           @endphp
                           @include("front.includes.top_search_bar")
                        </div>
                     </form>
                  </div>
               </div>
               @if(!Auth::guard('users')->check())
                  <div class="topBtn">
                     <a class="btn" href="{{$str_link_sign_up}}">Join Us</a>
                  </div>
               @else
                  <div class="topProfileBar">
                     <div class="topJoinUsMenu">
                     <div class="dropdown text-center">
                        <a class="btn dropdown-toggle p-0 drpMenu" data-toggle="dropdown">
                           <div class="topProfileImg"><img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" class="img-fluid"></div> Me
                        </a>
                        <div class="dropdown-menu">
                           <div class="profileDrop">
                              <div class="dropdown ">
                                 <a class="viewProfileBtn dropdown-toggle text-center" data-toggle="dropdown"  href="javascript:void(0);">View Profile</a>
                                 @if (!empty($user_current_info->id))
                                    <div class="dropdown-menu DashboardProfileDroplistList">
                                       <a class="dropdown-item" href="{{ $str_profile_view }}"><img src="{{ asset('front/images/user.png') }}" alt="image">View My Profile</a>

                                       <a class="dropdown-item" href="{{$str_profile_user_edit}}"><img src="{{ asset('front/images/edit-profile.png') }}" alt="image"> Edit My Profile</a>
                                       <a class="dropdown-item" href="{{$str_profile_change_plan}}"><img src="{{ asset('front/images/plan.png') }}" alt="image"> Change My Plan</a>
                                       <a class="dropdown-item" href="http://www4.chitag.com/phplist/index.php?p=subscribe" target="_blank"><img src="{{ asset('front/images/newsletter.png') }}" alt="image"> Manage Newsletter</a>
                                       <a class="dropdown-item" href="{{$str_profile_change_password}}"><img src="{{ asset('front/images/password.png') }}" alt="image">Change Password</a>
                                       <!--   <a class="dropdown-item" href="javascript:void(0);"><img src="{{ asset('front/images/delete-close.png') }}" alt="image"> Delete Profile</a> -->
                                       <a class="dropdown-item" href="{{$str_link_user_logout}}"><img src="{{ asset('front/images/logout.png') }}" alt="image"> Logout</a>
                                    </div>
                                 @endif
                              </div>
                           </div>
                           <div class="childDropOne">
                              <div class="dropdown ">
                              <a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><b>My Posts</b></a>
                              @if (!empty($user_current_info->id))
                                 <div class="dropdown-menu DashboardProfileDroplistList">
                                    <a class="dropdown-item" href="{{$str_profile_all_image_gallery}}"><img src="{{ asset('front/images/image.png') }}" alt="image"> Photo Gallery </a>
                                    <a class="dropdown-item" href="{{$str_profile_all_video_gallery}}"><img src="{{ asset('front/images/video.png') }}" alt="video"> Videos</a>
                                    <a class="dropdown-item" href="<?php if($showLock == 0){ ?>{{$str_profile_blog_index}} <?php } else { ?> javascript:void(0); <?php } ?>"><img src="{{ asset('front/images/blog.png') }}" alt="blog"> Blogs @if($showLock ==1 ) <i class="fa fa-lock" ml-1></i> @endif </a>
                                    @if(($int_type_of_user ==2) && ($role_type_id == 3))
                                    <a  class="dropdown-item" href="{{$str_profile_brand_index}}"
                                    class="nav-linkdashboard"><i class="flaticon-product mr-3 fa-icon1dashboard"
                                    aria-hidden="true"></i> Brand</a>
                                    @endif
                                    <a style="display:none;" class="dropdown-item" href="<?php if($showLock == 0){ ?>{{$str_profile_product_index}} <?php } else { ?> javascript:void(0); <?php } ?>"><img src="{{ asset('front/images/product1.png') }}" alt="product1"> Product Posts @if($showLock ==1 ) <i class="fa fa-lock" ml-1></i> @endif </a>
                                    <a class="dropdown-item" href="<?php if($showLock == 0){ ?>{{$str_profile_classified_index}} <?php } else { ?> javascript:void(0); <?php } ?>"><img src="{{ asset('front/images/classifieds.png') }}" alt="classifieds"> Classifieds @if($showLock ==1 ) <i class="fa fa-lock" ml-1></i> @endif </a>
                                    <a class="dropdown-item" href="<?php if($showLock == 0){ ?>{{$str_profile_all_media}} <?php } else { ?> javascript:void(0); <?php } ?>"><img src="{{ asset('front/images/media.png') }}" alt="media"> Media @if($showLock ==1 ) <i class="fa fa-lock" ml-1></i> @endif </a>

                                    <a class="dropdown-item" href="<?php if($showLock == 0){ ?>{{$str_profile_all_award}} <?php } else { ?> javascript:void(0); <?php } ?>"><img src="{{ asset('front/images/awardimg.png') }}" alt="media"> Awards @if($showLock ==1 ) <i class="fa fa-lock" ml-1></i> @endif </a>
                                 </div>
                                 @endif
                                 </div>
                              <a class="dropdown-item" href="{{$str_link_user_watch_list}}">Favorites</a>
                           </div>
                           <div class="childDroptwo">
                           <a class="dropdown-item" href="{{$str_profile_product_index}}">My Products</a>
                           <a class="dropdown-item" href="{{$str_profile_change_plan}}">Change my plan</a>
                           <a class="dropdown-item" href="{{route('front.user.manage-payment-subscription')}}">Manage payment</a>
                           <a class="dropdown-item" href="http://www4.chitag.com/phplist/index.php?p=subscribe" target="_blank">Manage Newsletter</a>
                           <a class="dropdown-item" href="{{$str_profile_change_password}}">Change password</a>
                           <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</header>
   <!---------------|| Header ||--------------->
<div class="container-fluid pt-5 pt-md-0 top-bar-ads-header" style=" display: none;">
   <div class="row">
      <div class="col-md-12 d-none d-md-block">
         <div class="container-width">
            <div class="col-md-12">
               <div class="row paddingXTwenty py-0">
                  <!--<a href="http://52.66.150.6/ads/get-no-clicks/9" target="_blank">-->
                  <div id="top-bar-ads"></div>
                  <!-- </a> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
   $('.topJoinUsMenu .drpMenu').click(function(){
      $('.topJoinUsMenu').toggleClass('activeDrop');
   });

</script>


@include("front.auth.view_plan_popup")
