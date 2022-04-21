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
   $str_profile_change_plan =	$arr_menu_list['profile_change_plan'];
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

@endphp

<!-- if the user has not completed the payment process dont show him this side bar -->
 <div class="col-md-3 p-0 p-md-4">
@if(empty($str_checkPaidUserAuthentication_two))
  
      <div class="right-column k_sidebar right-colom-sidebar">
         <div class="RightSidebarAllPage">
            <?php

            $homeSidebarShow = 1;
            if(Request::segment(1) == 'sign-up')
             {
              $homeSidebarShow = 0;  
             }
            if(Request::segment(2) == 'message') {
               $homeSidebarShow = 0;
            }
            if(Request::segment(1) == 'change-plan') {
               $homeSidebarShow = 0;
            }
            if(Request::segment(1) == 'people') {
               $homeSidebarShow = 0;
            }

             if(Request::segment(1) == 'user' && Request::segment(2) == 'classified' && Request::segment(3) == 'create') {
               $homeSidebarShow = 0;
            }
              if(Request::segment(1) == 'user' && Request::segment(2) == 'profile' && Request::segment(3) == 'edit') {
               $homeSidebarShow = 0;
            }
              if(Request::segment(1) == 'user' && Request::segment(2) == 'product' && Request::segment(3) == 'create') {
               $homeSidebarShow = 0;
            }
              if(Request::segment(1) == 'user' && Request::segment(2) == 'blog' && Request::segment(3) == 'create') {
               $homeSidebarShow = 0;
            }

            if(Request::segment(1) == 'home' && Request::segment(2) == 'get-site-search-data') {
               $homeSidebarShow = 0;
            }
            if(Request::segment(1) == 'company') {
               $homeSidebarShow = 0;
            }
             if(Request::segment(1) == 'user' && Request::segment(2) == 'blog' && Request::segment(3) == 'update' ) {
               $homeSidebarShow = 0;
            }
             if(Request::segment(1) == 'blog') {
               $homeSidebarShow = 0;
            }
            if(Request::segment(1) == 'user' && Request::segment(2) == 'classified' &&   Request::segment(3) == 'update' )
         {
            $homeSidebarShow = 0;  
         } 
           if(Request::segment(1) == 'user' && Request::segment(2) == 'profile')
         {
            $homeSidebarShow = 0;  
         } 
          if(Request::segment(1) == '3-truths-and-a-lie')
         {
            $homeSidebarShow = 0;  
         } if(Request::segment(1) == '3-truths-and-a-lie')
         {
            $homeSidebarShow = 0;  
         }

             ?>
            @if($homeSidebarShow == 1)
               @include('front.includes.home-sidebar') 
               @endif  
         </div>
      </div>
@endif
</div>