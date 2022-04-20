
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
  ?>

<section id="MobileFirstHomePage krow_mobile" class="Mobheader">
   <header class="MobileHeader">
      <nav class="navbar navbar-expand-xl navbar-dark backGroundGradient mt-0 pt-0">
         <div class="container-fluid">
            <div class="MobileHeader">
               <div class="" style="width:35%; display: contents;">
               <a href="{{url('/')}}"><img class="MobileHeaderLogo" src="{{ asset('front/images/mainLogo.png') }}" width="120"></a>
</div>
               <!-- <a href="{{url('/')}}"
                  class=" navbar-brand d-block px-3 py-2 text-uppercase text-center text-bold text-white Logostyle">People1<span
                     class="span-text-grey-logo">of</span>play</a></a> -->
                     <div class="" style="width:45%; display: contents;">
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
                  <!-- Menu toggle -->
                     <div class="" style="width:20%; display: contents;">
                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#menu"
                           aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars navbarsicon" aria-hidden="true"></i>
                        </button>
                        <ul class="navbar-nav mr-auto main_header_menu mobilesize_background">
                           <li class="nav-item dropdown topDropDown RightDrop">
                              @if(Auth::guard('users')->check())
                                 @php
                                    $user = get_current_user_info();
                                    $str_user_name = @App\Helpers\Utilities::getUserName($user);
                                 @endphp   
                                 <a class="li-color dropdown-toggle is_user helpList1" href="#" id="navbardrop" data-toggle="dropdown"><img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="profileimage" class="img-fluid rounded-circle"><h6>{{$str_user_name}}56</h6></a>
                              @else
                                 <a class="li-color dropdown-toggle helpList1" href="#" id="navbardrop" data-toggle="dropdown">My Account</a>
                              @endif
                           <div class="dropdown-menu DropDownMenuMob HelpDropDown1 dashboardDropdown1">
                                 @if(Auth::guard('users')->check())
                              <!--  @if(empty($user_current_info->id))
                                 <div class="d-inine">
                                    <a href="{{$str_link_user_login}}" class="dashboardplogin dropdown-item">
                                    
                                       &nbsp; LOG IN
                                    </a>
                                    <a href="{{$str_link_sign_up}}" class="dashboardplogin dropdown-item">
                                   
                                       &nbsp; SIGN UP
                                    </a>

                                 </div>
                                 @endif -->
                                 @if(empty($str_checkPaidUserAuthentication))
                                 <a class="dropdown-item" href="{{$str_profile_change_plan}}">Change My Plan</a>  
                              <a class="dropdown-item" href="{{route('front.user.manage-payment-subscription')}}">Manage Payment</a>
                               <a class="dropdown-item" href="http://www4.chitag.com/phplist/index.php?p=subscribe"> Manage Newsletter</a>
                                 <a class="dropdown-item" href="{{$str_profile_change_password}}"> Change Password</a>
                               <!-- <a class="dropdown-item" href="javascript:void(0);">  Delete Profile</a> -->
                              @else
                              <!-- <a class="dropdown-item" href="{{$str_profile_change_plan}}">Select Plan</a>   -->
                              @endif
                              <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                               @else
                              <a  class="dropdown-item" href="{{$str_link_user_login}}">LOG IN</a>
                              <a  class="dropdown-item" href="{{$str_link_sign_up}}">SIGN UP</a>
                              @endauth
                            
                              
                           </div>
                        </li>
               </ul>
</div>
            </div>
            <div class="collapse navbar-collapse" id="menu">
               <ul class="navbar-nav mr-auto main_header_menu mobilesize_background">
                        <li>
                           <a href="{{$str_news_link_new}}" target="_blank" class="li-color">News</a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Networking</a>
                           <div class="dropdown-menu" style="margin-left:15px;">
                              <a class="dropdown-item" href="{{url('/')}}/pub">Pub Meeting</a>
                              <a class="dropdown-item" href="{{ $str_link_advance_search }}">Search & Browse</a>
                              @if(!Auth::guard('users')->check())
                                 <a class="dropdown-item" href="{{$str_link_sign_up}}">Create a Profile</a>
                              @endif
                              <a class="dropdown-item" href="{{ route('front.pages.quiz.detail') }}">3 Truths and a Lie</a>
                              <a class="dropdown-item" href="{{$str_link_classifieds}}">Classifieds</a>
                              <a class="dropdown-item" target="_blank" href="{{$str_link_pop_industry_get_together}}">Networking Events</a>
                           </div>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Knowledge</a>
                           <div class="dropdown-menu" style="margin-left:15px;">
                              <a class="dropdown-item" href="{{ $str_link_wiki }}">Wiki – Articles</a>
                              <a class="dropdown-item" href="{{ route('front.pages.blogs') }}">Blogs</a>
                              <a class="dropdown-item" href="#">Interviews</a>
                              <a class="dropdown-item" href="#">Videos</a>
                              <a class="dropdown-item" href="{{ $str_link_drop_menu_dictionary_word_of_day }}">Dictionary</a>
                              <a class="dropdown-item" href="{{$str_link_drop_menu_rip}}">Rest in Peace - RIP</a>
                              <a class="dropdown-item" href="{{$str_link_pop_cast}}">Popcasts</a>
                              <a class="dropdown-item" href="{{$str_link_pop_entertainment}}">Entertainment</a>
                              <a class="dropdown-item" target="_blank" href="{{$str_link_pop_2021_first_quarter}}">Conferences</a>
                              <a class="dropdown-item" href="{{$str_link_office_hours}}">Office Hours</a>
                           </div>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Events</a>
                           <div class="dropdown-menu" style="margin-left:15px;">
                              <a class="dropdown-item" href="{{url('/')}}/pub">Pub Meeting</a>
                              <a class="dropdown-item" target="_blank" href="{{$str_link_pop_industry_get_together}}">Networking Events</a>
                           </div>
                        </li>
                        <li>
                           <a href="{{route('front.about')}}" class="li-color">About POP</a>
                        </li>
                        
                        <!--  ----------------------------------------------------------   -->
                        {{--
                           <li>
                                 <a href="{{ $str_link_advance_search }}" class="li-color">Advance Search</a>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Browse 1</a>
                              <div class="dropdown-menu DropDownMenuMob" style="margin-left:15px;">
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_inventors}}">People</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_companies}}">Companies</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_toys}}">Toys</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_games}}">Games</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_brands}}">Brands</a>
                                 <!-- <a class="dropdown-item" href="{{$str_link_drop_menu_brands}}">Brand</a>
                                    <a class="dropdown-item" href="{{$str_link_drop_menu_kids}}">Kids</a> -->
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">POPpedia</a>
                              <div class="dropdown-menu DropDownMenuMob" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{$str_news_link_new}}" target="_blank">Business of Play News</a>
                                 <a class="dropdown-item"  target="_blank" href="{{ $str_link_drop_menu_dictionary_word_of_day }}"> Dictionary </a>
                                 <a class="dropdown-item"  target="_blank" href="{{$str_link_columnists}}"> Columnists </a>
                                 <a class="dropdown-item"  href="{{ $str_link_wiki }}" target="_blank"> Wiki </a>
                                 <a class="dropdown-item"  href="{{$str_link_pop_play_in_education}}" target="_blank">Play in Education </a>
                                 <a class="dropdown-item" target="_blank"  href="{{$str_blog_pedia_link_new}}"> Featured Blogs</a> 
                                 <a class="dropdown-item" target="_blank"  href="{{$str_link_drop_menu_rip}}">RIP - Rest In Play</a>
                                  <a class="dropdown-item" target="_blank"  href="{{$str_link_office_hours}}">Office Hours</a>
                                  <a class="dropdown-item" target="_blank"  href="{{$str_link_pop_entertainment}}">Entertainment</a>
                                  <a class="dropdown-item" target="_blank"  href="{{$str_link_pop_cast}}">POPcast</a>
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Events</a>
                              <div class="dropdown-menu DropDownMenuMob" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{$str_link_pop_2021_first_quarter}}" target="_blank">Conference</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_yic}}" target="_blank">Young Inventor Challenge</a>
                                <!-- <a class="dropdown-item" href="{{$str_link_pop_2021_first_quarter}}">Innovation Conference </a>  -->
                                 <a class="dropdown-item" href="{{$str_link_pop_2020_pop_tagies_toys_games_awards}}" target="_blank">TAGIE Awards </a> 
                                 <a class="dropdown-item" href="{{$str_link_pop_playchic}}" target="_blank">PlayCHIC</a>
                                  <a class="dropdown-item" href="{{$str_link_pop_industry_get_together}}" target="_blank">Networking</a>
                              </div>
                            
                           </li>
                           <li>
                              <a href="{{$str_link_classifieds}}" class="li-color">Classifieds </a>
                           </li>
                           <li>
                                 <a href="{{url('/')}}/pub" class="li-color">Pub Meeting</a>
                           </li>
                        --}}
                        <!--  ------------------------------------------------------------------   -->
                           
                           
                           <li class="nav-item dropdown topDropDown RightDrop">
                              @if(Auth::guard('users')->check())
                                 @php
                                    $user = get_current_user_info();
                                    $str_user_name = @App\Helpers\Utilities::getUserName($user);
                                 @endphp   
                                 <a class="li-color dropdown-toggle is_user helpList1" href="#" id="navbardrop" data-toggle="dropdown"><img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="profileimage" class="img-fluid rounded-circle"><h6>{{$str_user_name}}56</h6></a>
                              @else
                                 <a class="li-color dropdown-toggle helpList1" href="#" id="navbardrop" data-toggle="dropdown">My Account</a>
                              @endif
                           <div class="dropdown-menu DropDownMenuMob HelpDropDown1 dashboardDropdown1">
                                 @if(Auth::guard('users')->check())
                              <!--  @if(empty($user_current_info->id))
                                 <div class="d-inine">
                                    <a href="{{$str_link_user_login}}" class="dashboardplogin dropdown-item">
                                    
                                       &nbsp; LOG IN
                                    </a>
                                    <a href="{{$str_link_sign_up}}" class="dashboardplogin dropdown-item">
                                   
                                       &nbsp; SIGN UP
                                    </a>

                                 </div>
                                 @endif -->
                                 @if(empty($str_checkPaidUserAuthentication))
                                 <a class="dropdown-item" href="{{$str_profile_change_plan}}">Change My Plan</a>  
                              <a class="dropdown-item" href="{{route('front.user.manage-payment-subscription')}}">Manage Payment</a>
                               <a class="dropdown-item" href="http://www4.chitag.com/phplist/index.php?p=subscribe"> Manage Newsletter</a>
                                 <a class="dropdown-item" href="{{$str_profile_change_password}}"> Change Password</a>
                               <!-- <a class="dropdown-item" href="javascript:void(0);">  Delete Profile</a> -->
                              @else
                              <!-- <a class="dropdown-item" href="{{$str_profile_change_plan}}">Select Plan</a>   -->
                              @endif
                              <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                               @else
                              <a  class="dropdown-item" href="{{$str_link_user_login}}">LOG IN</a>
                              <a  class="dropdown-item" href="{{$str_link_sign_up}}">SIGN UP</a>
                              @endauth
                            
                              
                           </div>
                        </li>
               </ul>
            </div>
         </div>
      </nav>
   </header>
</section>
<section id="DesktopFirstHomePage" class="box-width">
   <header class="DesktopHeader">
      <div class="container-fluid">
         <div class="box-width1">
            <div class="row">
               <div class="col col-lg-2 col-md-3">
                  <div class="TopHeaderLogo">
                  <a href="{{url('/')}}"><img src="{{ asset('front/images/mainLogo.png') }}"  class="PopLogo" style="position: absolute;z-index: 99;"></a>
                  <!-- <a href="{{url('/')}}"
                     class="d-block px-3 py-2 text-uppercase text-center text-bold text-white Logostyle">People1<span
                         class="span-text-grey-logo">of</span>play</a> -->
                  </div>
               </div>
               <div class="col col-lg-10 col-md-9">
                  <div class="DestopMainHeader">
               <div class="HeaderNavBar">
                  <div class="HeaderSeachBar">
                  <div class="d-flex align-items-center HeaderNavMenuBar">
                     <form class="form-inline my-2 my-lg-0 searchFormHead" method="post" action="{{route('front.home.site.search.data')}}" style="margin-left: 13px;">
                        @csrf
                        <div class="">
                     @php
                      $int_is_desk_top_search_flag_new = 1;
                     @endphp
                           @include("front.includes.top_search_bar")
                           <!-- <div class="nav-item dropdown advanceDrop">  -->
                           <!-- <select class="li-color w-100 text-white selectOption">
                              <option>All</option>
                              <option><i class="fa photo_icon fa-search-plus"></i> Advanced Search</option>
                              <option>People</option>
                              <option>Companies</option>
                              <option>Toys</option>
                              <option>Games</option>
                              <option>Brand</option>
                              </select> -->
                           <!-- <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">All</a>
                              <div class="dropdown-menu HelpDropDown">
                                  <a class="dropdown-item" href="#"><i class="fa photo_icon fa-search"></i> All</a>
                                  <a class="dropdown-item" @if(!empty($user_current_info->id)) href="{{route('front.home.site.advance.search.data')}}" @else data-toggle="modal" data-target="#modal-more-at-poppro-popup" @endif><i class="fa photo_icon fa-search-plus"></i> Advanced Search</a>
                              </div> -->
                           <!-- </div> -->
                           <!-- </div> -->
                           <!-- <div>
                              <div class="form-group has-search" id="home-site-search-input-div-main">
                                                          <span class="fa fa-search form-control-feedback"></span>
                                                          <input id="home-site-search-input" name="home-site-search-text-name" class="form-control top-search-bar-class-new" type="text" placeholder="Search POP" aria-label="Search"  style="padding-left: 22px;">
                                                      </div>
                                                  </div> -->
                        </div>
                     </form>
</div>
                     <div class="MainMenuHeader">
               <ul class="nav li-text sideListTopHead">
                         <!-- <ul class="d-flex flex-row justify-content-around second-icon-text text-white text-center main_header_menu"> -->
                           <li>
                              <a href="{{$str_news_link_new}}" target="_blank" class="li-color">News</a>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Networking</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{url('/')}}/pub">Pub Meeting</a>
                                 <a class="dropdown-item" href="{{ $str_link_advance_search }}">Search & Browse</a>
                                 @if(!Auth::guard('users')->check())
                                    <a class="dropdown-item" href="{{$str_link_sign_up}}">Create a Profile</a>
                                 @endif
                                 <a class="dropdown-item" href="{{ route('front.pages.quiz.detail') }}">3 Truths and a Lie</a>
                                 <a class="dropdown-item" href="{{$str_link_classifieds}}">Classifieds</a>
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Knowledge</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{ $str_link_wiki }}">Wiki – Articles</a>
                                 <a class="dropdown-item" href="{{ route('front.pages.blogs') }}">Blogs</a>
                                 <a class="dropdown-item" href="#">Interviews</a>
                                 <a class="dropdown-item" href="#">Videos</a>
                                 <a class="dropdown-item" href="{{ $str_link_drop_menu_dictionary_word_of_day }}">Dictionary</a>
                                 <a class="dropdown-item" href="{{$str_link_drop_menu_rip}}">Rest in Peace - RIP</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_cast}}">Popcasts</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_entertainment}}">Entertainment</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_pop_2021_first_quarter}}">Conferences</a>
                                 <a class="dropdown-item" href="{{$str_link_office_hours}}">Office Hours</a>
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Events</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_pop_industry_get_together}}">Networking Events</a>
                              </div>
                           </li>
                           <li>
                              <a href="{{route('front.about')}}" class="li-color">About POP</a>
                           </li>

                        <!-- ---------------------------------------------------------- -->
                        {{--
                           <li>
                              <a href="{{ $str_link_advance_search }}" class="li-color">Advance Search</a>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Browse 2</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_inventors}}">People</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_companies}}">Companies</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_toys}}">Toys</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_games}}">Games</a>
                                 <a class="dropdown-item" target="_blank" href="{{$str_link_drop_menu_brands}}">Brands</a>
                                 <!-- <a class="dropdown-item" href="{{$str_link_drop_menu_brands}}">Brand</a>
                                    <a class="dropdown-item" href="{{$str_link_drop_menu_kids}}">Kids</a> -->
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">POPpedia</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{$str_news_link_new}}" target="_blank">Business of Play News</a>
                                 <a class="dropdown-item"  target="_blank" href="{{ $str_link_drop_menu_dictionary_word_of_day }}"> Dictionary </a>
                                 <a class="dropdown-item"  target="_blank" href="{{$str_link_columnists}}"> Columnists </a>
                                 <a class="dropdown-item"  href="{{ $str_link_wiki }}" target="_blank"> Wiki </a> 
                                 <a class="dropdown-item"  href="{{$str_link_pop_play_in_education}}" target="_blank">Play in Education </a>
                                 <a class="dropdown-item" target="_blank"  href="{{$str_blog_pedia_link_new}}"> Featured Blogs</a> 
                                 <a class="dropdown-item" target="_blank"  href="{{$str_link_drop_menu_rip}}">RIP - Rest In Play</a>
                                  <a class="dropdown-item" target="_blank"  href="{{$str_link_office_hours}}">Office Hours</a>
                                  <a class="dropdown-item" target="_blank"  href="{{$str_link_pop_entertainment}}">Entertainment</a>
                                   <a class="dropdown-item" target="_blank"  href="{{$str_link_pop_cast}}">POPcast</a>
                              </div>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Events</a>
                              <div class="dropdown-menu" style="margin-left:15px;">
                                 <a class="dropdown-item" href="{{$str_link_pop_2021_first_quarter}}" target="_blank">Conference</a>
                                 <a class="dropdown-item" href="{{$str_link_pop_yic}}" target="_blank">Young Inventor Challenge</a>
                               <!--   <a class="dropdown-item" href="{{$str_link_pop_2021_first_quarter}}">Innovation Conference </a> -->
                                 <a class="dropdown-item" href="{{$str_link_pop_2020_pop_tagies_toys_games_awards}}" target="_blank">TAGIE Awards </a>
                                 <a class="dropdown-item" href="{{$str_link_pop_playchic}}" target="_blank">PlayCHIC</a>
                                  <a class="dropdown-item" href="{{$str_link_pop_industry_get_together}}" target="_blank">Networking</a>
                              </div>
                            
                           </li>
                           <li>
                              <a href="{{$str_link_classifieds}}" class="li-color">Classifieds </a>
                           </li>
                           <li>
                              <a href="{{url('/')}}/pub" class="li-color">Pub Networking</a>
                           </li>
                        --}}
                            
                           <li class="nav-item dropdown topDropDown RightDrop">
                              @if(Auth::guard('users')->check())
                                 @php
                                    $user = get_current_user_info();
                                    $str_user_name = @App\Helpers\Utilities::getUserName($user);
                                 @endphp   
                                 <a class="li-color dropdown-toggle is_user helpList1" href="#" id="navbardrop" data-toggle="dropdown"><img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="profileimage" class="img-fluid rounded-circle"><h6>{{$str_user_name}}</h6></a>
                              @else
                                 <a class="li-color dropdown-toggle helpList1" href="#" id="navbardrop" data-toggle="dropdown">My Account</a>
                              @endif

                           <div class="dropdown-menu HelpDropDown1 dashboardDropdown1">
                              @if(Auth::guard('users')->check())
                                 <!--  @if(empty($user_current_info->id))
                                 <div class="d-inine">
                                    <a href="{{$str_link_user_login}}" class="dashboardplogin dropdown-item">
                                    
                                       &nbsp; LOG IN
                                    </a>
                                    <a href="{{$str_link_sign_up}}" class="dashboardplogin dropdown-item">
                                   
                                       &nbsp; SIGN UP
                                    </a>

                                 </div>
                                 @endif -->
                                 @if(empty($str_checkPaidUserAuthentication))
                                    <a class="dropdown-item" href="{{$str_profile_change_plan}}">Change My Plan</a>  
                                    <a class="dropdown-item" href="{{route('front.user.manage-payment-subscription')}}">Manage Payment</a>
                                    <a class="dropdown-item" href="http://www4.chitag.com/phplist/index.php?p=subscribe"> Manage Newsletter</a>
                                    <a class="dropdown-item" href="{{$str_profile_change_password}}"> Change Password</a>
                                    <!-- <a class="dropdown-item" href="javascript:void(0);">  Delete Profile</a> -->
                                 @else
                                 <!-- <a class="dropdown-item" href="{{$str_profile_change_plan}}">Select Plan</a>   -->
                                 @endif
                                 <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                              @else
                                 <a  class="dropdown-item" href="{{$str_link_user_login}}">LOG IN</a>
                                 <a  class="dropdown-item" href="{{$str_link_sign_up}}">SIGN UP</a>
                              @endauth
                               
                              <!--  <a class="watchListLinkHead dropdown-item" href="{{$str_link_user_watch_list}}">
                           Change My Plan
                              </a>
                              @if(empty($str_checkPaidUserAuthentication))
                             <a class="dropdown-item" href="{{$str_link_user_profile}}">Manage Payment</a>
                               <a class="dropdown-item" href="{{$str_link_user_profile}}"> Manage Newsletter</a>
                                 <a class="dropdown-item" href="{{$str_link_user_profile}}"> Change Password</a>
                               <a class="dropdown-item" href="{{$str_link_user_profile}}">  Delete Profile</a>
							   
                              @else-->
                              <!-- <a class="dropdown-item" href="{{$str_profile_change_plan}}">Select Plan</a>   -->
							<!--	<a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                              @endif -->
                              
                           </div>
                        </li>
                         <!-- @if(empty($user_current_info->id)) -->
                          <!--  <div class="d-inline">
                             <li class="nav-item li-color logSignUp">
                                 <a href="{{$str_link_user_login}}" class="">LOG IN </a>
                             </li>

                              <li class="nav-item li-color logSignUp" style="">
                                 <a href="{{$str_link_sign_up}}" class="signUpBtn1 pr-0 mr-0">SIGN UP </a>
                              </li>
                           </div> -->
                         <!-- @endif -->

                           <?php /*
                              @if(isset(Auth::guard('users')->user()->type_of_user) && (Auth::guard('users')->user()->type_of_user == 2 || Auth::guard('users')->user()->type_of_user == 3))
                                                         @else    
                                                             @if(empty($user_current_info->id))                               
                                                              <li>
                                                              <a href="{{route('front.sign-up')}}" class="li-color">POP SIGN UP</a>
                                  </li>                              
                                 @endif  
                                                         @endif
                              
                              
                              @if(Auth::guard('users')->check())
                                                             <a class="watchListLinkHead" href="{{$str_link_user_watch_list}}"><li class="watchlistLI">Favorites</li></a>
                                                             <li class="nav-item dropdown pr-0 mr-0"> 
                                                                 <a class="li-color dropdown-toggle helpList" href="#" id="navbardrop" data-toggle="dropdown">Dashboard</a>
                                                                 <div class="dropdown-menu HelpDropDown dashboardDropdown">
                                                                     <a class="dropdown-item" href="{{$str_link_user_profile}}">My Account</a>
                                                                     <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                                                                 </div>
                                                             </li>
                                                         @else
                                                              
                                 <li>
                                    <a href="{{$str_link_user_login}}" class="li-color">LOGIN</a>
                                 </li>
                                                         @endif
                              
                              */ ?>
                           <!-- @if(isset(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 2)
                              @else
                                  <li><a href="#" class="text-white" data-toggle="modal" data-target="#modal-more-at-poppro-popup">PoPPro</a></li>
                              @endif -->
                           <!-- @if(Auth::guard('users')->check())
                              <a href="{{$str_link_user_watch_list}}"><li class="li-color">Watchlist</li></a>
                              <li class="nav-item dropdown">
                                  <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Dashboard</a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{$str_link_user_profile}}">My Account</a>
                                      <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                                  </div>
                              </li>
                              @else
                              <a href="{{$str_link_user_login}}"><li class="li-color">LOG IN</li></a>
                              <a href="{{$str_link_sign_up}}" class="signUpBtn"><li class="li-color" style="">SIGN UP</li></a>
                              @endauth -->
                      
                     </ul>
</div>
                  </div>
               
                  </div>
                  </div>
               </div>
            </div>
            <!-- <div class="row pt-0">
               <div class="col">
                   <ul class="d-flex flex-row justify-content-around second-icon-text text-white text-center main_header_menu">
                       <div class="text-center text-md-right mobilehidden">
                           <ul class="list-unstyled deskTopSocialHeader">
                               <li class="">
                                   <a href="https://twitter.com/ChiTAGWeek" class=" rgba-white-slight text-white" target="_blank">
                                       <i class="fa fa-twitter photo_icon" aria-hidden="true"></i>
                                   </a>
                               </li>
                               <li class="">
                                   <a href="https://www.youtube.com/user/ChicagoToyAndGame/featured" class="rgba-white-slight text-white" target="_blank">
                                       <i class="fa fa-youtube-play photo_icon" aria-hidden="true"></i>
                                   </a>
                               </li>
                               <li class="">
                                   <a href="https://www.instagram.com/chitagweek/" class="rgba-white-slight text-white" target="_blank">
                                       <i class="fa fa-instagram photo_icon" aria-hidden="true"></i>
                                   </a>
                               </li>
               
                               <li class="">
                                   <a href="https://www.facebook.com/ChicagoToyAndGameWeek/" class="rgba-white-slight text-white" target="_blank">
                                       <i class="fa fa-facebook photo_icon" aria-hidden="true"></i>
                                   </a>
                               </li>
               
               
                           </ul>
                       </div>
                       <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Toys, Games & Companies</a>
                           <div class="dropdown-menu">
                           <a class="dropdown-item" href="{{$str_link_drop_menu_toys}}">Toys</a>
                               <a class="dropdown-item" href="{{$str_link_drop_menu_games}}">Games</a>
                               <a class="dropdown-item" href="{{$str_link_drop_menu_companies}}">Companies</a>
                           </div>
                       </li>
                       <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">People, Awards & Events</a>
                           <div class="dropdown-menu">
                               <a class="dropdown-item" href="{{$str_link_drop_menu_inventors}}">Innovators</a>
                               @if($int_type_of_user == 2 || $int_type_of_user == 3 ) 
                                   <a class="dropdown-item" href="{{$str_link_drop_menu_events}}">Awards & Events</a>
                               @endif
                           </div>
                       </li>
                       <li class="nav-item dropdown">
                           <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">News & Community</a>
                           <div class="dropdown-menu">
                               <a class="dropdown-item" href="#">Newsletters</a>
                               <a class="dropdown-item" href="#">Help</a>
               <a class="dropdown-item" href="{{$str_link_knowledge_base_faqs}}">FaQ</a>
                               <a class="dropdown-item" href="{{$str_link_knowledge_base_articles}}">Article Categories</a>
                        </div>
                       </li>
                       <a href="{{$str_link_user_watch_list}}">
                           <li class="li-color">Watchlist</li>
                       </a>
               
                       @if(Auth::guard('users')->check())
                           <li class="nav-item dropdown">
                               <a class="li-color dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Dashboard</a>
                               <div class="dropdown-menu">
                                   <a class="dropdown-item" href="{{$str_link_user_profile}}">My Account</a>
                                   <a class="dropdown-item" href="{{$str_link_user_logout}}">Logout</a>
                               </div>
                           </li>
                       @else
                           <a href="{{$str_link_user_login}}">
                               <li class="li-color">Login</li>
                           </a>
                       @endauth
                   </ul>
               </div>
               </div> -->
         </div>
      </div>
   </header>
</section>
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
@include("front.auth.view_plan_popup")