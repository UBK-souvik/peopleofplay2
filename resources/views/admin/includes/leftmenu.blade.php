{{! $user = Auth::guard('admin')->user() }}
{{! $userMenuList = Session::get('userMenuList') }}
@php
$current_url_new = URL::current();
$is_chk_def_adv_page_flag = 0;
$is_chk_spon_adv_page_flag = 0;
if(strpos($current_url_new, '/')>0)
{
$arr_current_url_new = explode('/', $current_url_new);
$arr_current_url_cnt = count($arr_current_url_new);
$arr_current_url_last_index = $arr_current_url_new[$arr_current_url_cnt-1];
if((strpos($current_url_new,'/advertisements/all_index/1')>0 || strpos($current_url_new,'/advertisements/showadd/1')>0)
|| (strpos($current_url_new,'/advertisements/showedit/')>0 && $arr_current_url_last_index == 1))
{
$is_chk_def_adv_page_flag = 1;
}
if((strpos($current_url_new,'/advertisements/all_index/0')>0 || strpos($current_url_new,'/advertisements/showadd/0')>0)
|| (strpos($current_url_new,'/advertisements/showedit/')>0 && $arr_current_url_last_index == 0))
{
$is_chk_spon_adv_page_flag = 1;
}
}
@endphp
<?php //echo "<pre>"; print_r($user->email); die; ?>


<?php
    $dashboard = $notes = $home_page = $menu = $profiletype =  $proUser = $basicUser = $freeUser = $propleVerify = $role = $preference = $wiki = $rip = $ytPremieres =  $company = $companyCategory = $product =  $brand = $skill = $productCategory = $productSubCategory = $event = $events_2022 = $interviews=
    $blog = $classified= $seourl = $dictionary = $collections = $blogCategory = $new =  $didyouknow = $newCategory = $polls = $brands = $transactions = $permissions  =  $newsletter = $reports = $sidebar = $defaultAdvertisement = $faq = $faqQuestion= $artical = $articalCategory = $quiz = $truthalie = $quizQuestion = $manageGallery=  $appSettings= $popentertainment = $popcast = $officeHour = $meme= $additional_menus= 1;
    if($user->email == 'juliadekorte@peopleofplay.com') {
        $notes = $home_page = $menu = $profiletype =  $proUser = $basicUser = $freeUser = $propleVerify = $role = $preference =  $ytPremieres =  $company = $companyCategory = $product =  $brand = $skill = $productCategory = $productSubCategory = $event = $interviews = $blog = $classified= $seourl = $dictionary = $collections = $blogCategory = $new =  $didyouknow = $newCategory = $polls = $brands = $transactions = $permissions  =  $newsletter = $reports = $sidebar = $defaultAdvertisement = $faq = $faqQuestion= $artical = $articalCategory = $quiz = $truthalie = $quizQuestion = $manageGallery=  $appSettings= $officeHour = $meme= $additional_menus= 0;
    }

   $fieldname = $user->locale == 'en' ? 'en_name' : 'name'; ?>
<style>
   .disNone{
      display: none;
   }
</style>
<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
         <li class="header">{{ adminTransLang('main_navigation') }}</li>
         <!-- @if( isset($userMenuList[0]) && count($userMenuList[0]))
            @foreach($userMenuList[0] as $key => $navigation)
                @if($navigation['show_in_menu'] == 1)
                    @if(isset($userMenuList[$key]) && count($userMenuList[$key]))
                        <li class="treeview">
                            <a href="{{ $navigation['action_path'] }}">
                                <i class="{{ $navigation['icon'] }}"></i>
                                <span>{{ $navigation[$fieldname] }} </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            @if(isset($userMenuList[$key]) && count($userMenuList[$key]))
                                <ul class="treeview-menu">
                                    @foreach($userMenuList[$key] as $submenu)
                                        @if($submenu['show_in_menu'] == 1)
                                            <li {{ Request::is($submenu['action_path']) ? 'class=active' : '' }}><a href="{{ URL::to($submenu['action_path']) }}"><i class="fa fa-circle-o"></i>{{ $submenu[$fieldname] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @else
                        <li {{ Request::is("{$navigation['action_path']}*") ? 'class=active' : '' }}>
                            <a href="{{ URL::to($navigation['action_path']) }}">
                                <i class="{{ $navigation['icon'] }}"></i>
                                <span>{{ $navigation[$fieldname] }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
            @endif -->
         @if(@$dashboard == 1)
         <li {{ Request::is("{$navigation['action_path']}*") ? 'class=active' : '' }}>
         <a href="{{ URL::to('admin/dashboard') }}">
         <i class="fa fa-tachometer"></i>
         <span>Dashboard</span>
         </a>
         </li>
         @endif

        @if(@$notes ==1)
         <li {{ Request::is("{$navigation['action_path']}/admin/notes/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Notes</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/notes/all_index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/notes/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
        @endif

         <!-- Start home page -->
         @if(@$home_page == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/cms/home-page") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-grav"></i>
         <span>Home Page Sections</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/cms/home-page')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/cms/home-page-whateverdays')}}"><i class="fa fa-circle-o"></i>Happy Whatever Day List</a></li>
            <li ><a href="{{url('admin/cms/home-page-whateverday/create')}}"><i class="fa fa-circle-o"></i>Create Happy Whatever Day</a></li>
            <li ><a href="{{url('admin/cms/home-award')}}"><i class="fa fa-circle-o"></i>Award List</a></li>
            <li ><a href="{{url('admin/cms/home-award_type')}}"><i class="fa fa-circle-o"></i>Award Type List</a></li>
         </ul>
         </li>
         @endif

         <!--  <li {{ Request::is("{$navigation['action_path']}*") ? 'class=active' : '' }}>
            <a href="#">
                <i class="fa fa-grav"></i>
                <span>Other Page Sections</span>
            </a>
            <ul class="treeview-menu">
                <li ><a href="#"><i class="fa fa-circle-o"></i>List</a></li>
            </ul>
            </li> -->
            @if(@$menu == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/cms/main-list-page") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-grav"></i>
         <span>Menu</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/cms/main-list-page')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <!-- <li ><a href="#"><i class="fa fa-circle-o"></i>Create</a></li> -->
         </ul>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/cms/main-list-page-paragraphs')}}"><i class="fa fa-circle-o"></i>Paragraphs List</a></li>
            <!-- <li ><a href="#"><i class="fa fa-circle-o"></i>Create</a></li> -->
         </ul>
         </li>
         @endif
         <!-- End home page -->
         <!-- Start People page -->
         @if(@$profiletype == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/profile_type") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-users"></i>
         <span>Profile Type</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/profile_type')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
          @endif

         @if(@$freeUser == 1)
            <li {{ Request::is("{$navigation['action_path']}/admin/users") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>POP FOLLOWER</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{route('admin.free.users.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            </ul>
            </li>
         @endif
         @if(@$basicUser == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/users") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-users"></i>
         <span>POP LITE</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.basic.users.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li class="disNone"><a href="{{route('admin.basic.users.showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$proUser == 1)
            <li {{ Request::is("{$navigation['action_path']}/admin/users") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>POP INDIVIDUAL</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{url('admin/users')}}"><i class="fa fa-circle-o"></i>List</a></li>
               <li class="disNone"><a href="{{url('admin/users/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li>
         @endif
         @if(@$company == 1)
            <li {{ Request::is("{$navigation['action_path']}/admin/companies") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>POP COMPANY</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{url('admin/companies')}}"><i class="fa fa-circle-o"></i>List</a></li>
               <li class="disNone"><a href="{{url('admin/users/showaddCompany')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li>
            @endif
            @if(@$companyCategory == 1)
            <li {{ Request::is("{$navigation['action_path']}/admin/companies") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>Company Category</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{route('admin.company-category.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
               <li ><a href="{{route('admin.company-category.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li>
            @endif



           @if(@$propleVerify == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/verify_users") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-users"></i>
         <span>People Verify</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{ route('admin.verify.users.index') }}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
           @endif

           @if(@$role == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/user_role/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-user-circle-o"></i>
         <span>User Role</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.user_role.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{route('admin.user_role.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$preference == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/feed_preference/i_am_a*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-feed"></i>
         <span>Feed preference</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.feed_preference.iama.index')}}"><i class="fa fa-circle-o"></i>I Am A</a></li>
            <li ><a href="{{route('admin.feed_preference.ilove.index')}}"><i class="fa fa-circle-o"></i>I Love</a></li>
         </ul>
         </li>
          @endif

          @if(@$wiki == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/wiki/category*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-wikipedia-w"></i>
         <span>Wiki</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.wiki.category.index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
             <li ><a href="{{route('admin.wiki.index')}}"><i class="fa fa-circle-o"></i>Wiki</a></li>

         </ul>
         </li>
         @endif


           @if(@$popentertainment == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/entertainment/category*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-wikipedia-w"></i>
         <span>POP Entertainment</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.entertainment.category.index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
             <li ><a href="{{route('admin.entertainment.index')}}"><i class="fa fa-circle-o"></i>POP Entertainment</a></li>

         </ul>
         </li>
         @endif

      @if(@$popcast == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/cast/category*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-wikipedia-w"></i>
         <span>POP Cast</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.cast.category.index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
             <li ><a href="{{route('admin.cast.index')}}"><i class="fa fa-circle-o"></i>POP Cast</a></li>

         </ul>
         </li>
         @endif

         @if(@$officeHour  == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/office-hour*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-wikipedia-w"></i>
         <span>Office Hour</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.office-hour.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
             <li ><a href="{{route('admin.office-hour.create')}}"><i class="fa fa-circle-o"></i> Create</a></li>

         </ul>
         </li>
         @endif

         @if(@$rip == 1)
          <li {{ Request::is("{$navigation['action_path']}/admin/rest-in-play/category*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-play"></i>
         <span>Rest In Play</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.rest-in-play.category.index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
             <li ><a href="{{route('admin.rest-in-play.index')}}"><i class="fa fa-circle-o"></i>Rest In Play</a></li>

         </ul>
         </li>
          @endif

            @if(@$meme  == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/meme*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-play"></i>
         <span>Meme</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.meme.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
             <li ><a href="{{route('admin.meme.create')}}"><i class="fa fa-circle-o"></i> Create</a></li>

         </ul>
         </li>
         @endif
         <!--  @if(@$ytPremieres == 1)
        <li {{ Request::is("{$navigation['action_path']}/admin/youtube-premieres*") ? 'class=active' : '' }}>
         <a href="#">
        <i class="fa fa-youtube"></i>
         <span>Youtube Premieres</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.youtube-premieres.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
         @endif -->
         <!-- <li {{ Request::is("{$navigation['action_path']}*") ? 'class=active' : '' }}>
            <a href="#">
                <i class="fa fa-user-o"></i>
                <span>Admin Access</span>
            </a>
            <ul class="treeview-menu">
                <li ><a href="{{url('/admin/admin')}}"><i class="fa fa-circle-o"></i>List</a></li>
                <li ><a href="{{url('/admin/admin/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li>

            <li {{ Request::is("{$navigation['action_path']}*") ? 'class=active' : '' }}>
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Access Role</span>
            </a>
            <ul class="treeview-menu">
                <li ><a href="{{url('/admin/role')}}"><i class="fa fa-circle-o"></i>List</a></li>
                <li ><a href="{{url('/admin/role/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li> -->
         <!-- end People page -->
         <!-- Start Product page -->
         @if(@$product == 1)
         <li {{ Request::is("{$navigation['action_path']}/products/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-product-hunt"></i>
         <span>Products</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.products.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{route('admin.products.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$brand == 1)
         <li {{ Request::is("{$navigation['action_path']}/brand_lists/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-product-hunt"></i>
         <span>Brand Lists</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.brand_lists.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{route('admin.brand_lists.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$skill == 1)
         <li {{ Request::is("{$navigation['action_path']}/skills/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-product-hunt"></i>
         <span>Skills</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.skills.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
         @endif
         @if(@$productCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/category/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-list-alt"></i>
         <span>Product Category</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.category.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$productSubCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/sub_category/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-list-alt"></i>
         <span>Product Sub Category</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.sub_category.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{route('admin.sub_category.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
          @endif
         <!-- end Product page -->
         <!-- Start event page -->
         @if(@$productSubCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/pubs") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-calendar"></i>
         <span>Pub</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{route('admin.pub.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/pub_heading')}}"><i class="fa fa-circle-o"></i>Pub Heading Settings</a></li>
            <li ><a href="{{route('admin.pub_heading.pub_meeting')}}"><i class="fa fa-circle-o"></i>Pub Meeting List</a></li>
         </ul>
         </li>

          @endif
         <!-- end Event page -->
         <!-- Start event 2022 page -->
         @if(@$event == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/events") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-calendar"></i>
         <span>Events</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/events')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('admin/events/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif

         @if(@$events_2022 == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/eventyear") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-calendar"></i>
         <span>Events 2022</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/eventyear')}}"><i class="fa fa-circle-o"></i>Profile List</a></li>
            <li ><a href="{{url('admin/profileheader')}}"><i class="fa fa-circle-o"></i>Profile Header</a></li>
         </ul>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/eventheader')}}"><i class="fa fa-circle-o"></i>Page Header List</a></li>
            {{-- <li ><a href="{{url('admin/eventheader/create')}}"><i class="fa fa-circle-o"></i>Header Create</a></li> --}}
         </ul>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/eventdescription')}}"><i class="fa fa-circle-o"></i>Event Description List</a></li>
            <li ><a href="{{url('/admin/descriptionheader')}}"><i class="fa fa-circle-o"></i>Event Description Header</a></li>
            {{-- <li ><a href="{{url('admin/eventdescription/create')}}"><i class="fa fa-circle-o"></i>Event Description Create</a></li> --}}
         </ul>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/eventbanner')}}"><i class="fa fa-circle-o"></i>Event Banner List</a></li>
            {{-- <li ><a href="{{url('admin/eventbanner/create')}}"><i class="fa fa-circle-o"></i>Event Banner Create</a></li> --}}
         </ul>
         </li>
         @endif
         <!-- end Event 2022 page -->
         <!-- Start Blog page -->
          @if(@$interviews == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/interview/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Interviews</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/interview')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/interview/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
          @if(@$blog == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/blog/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Blogs</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/blog')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/blog/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="{{url('/admin/blog_pedia')}}"><i class="fa fa-circle-o"></i>List Blog Pedia</a></li>
            <li ><a href="{{url('/admin/blog_pedia/create')}}"><i class="fa fa-circle-o"></i>Create Blog Pedia</a></li>
            <li ><a href="{{url('/admin/blog_columnists')}}"><i class="fa fa-circle-o"></i>Columnists Blog List</a></li>
         </ul>
         </li>
          @endif
         @if(@$classified == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/classified/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Classifieds</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/classified')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/classified/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
          @endif
         @if(@$seourl == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/seo_url/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Seo Urls</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/seo_url')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/seo_url/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$dictionary == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/dictionary/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Dictionary</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/dictionary')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/dictionary/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="{{url('/admin/dictionary/calendar_word')}}"><i class="fa fa-circle-o"></i>Calendar</a></li>
         </ul>
         </li>
         @endif
         @if(@$collections == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/collection/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Collections</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/collection')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/collection/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
           @endif
         @if(@$blogCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/blog-category/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-list-alt"></i>
         <span>Blog Category</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/blog-category')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/blog-category/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
          @endif
         <!-- end Blog page -->
         <!-- Start news page -->
          @if(@$news == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/news/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>News</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/news')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/news/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$didyouknow == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/did-you-know/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Did You Know</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/did-you-know')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/did-you-know/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$newCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/news-category/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-list-alt"></i>
         <span>News Category</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/news-category')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/news-category/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         <!-- end news page -->
         <!-- Start polls page -->
         @if(@$polls == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/polls/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Polls</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/polls')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/polls/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$brands == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/brands/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Brands  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/brands')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/brands/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$transactions == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/payments/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Transactions  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/transactions')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/payments')}}"><i class="fa fa-circle-o"></i>Payments</a></li>
         </ul>
         </li>
          @endif
          @if(@$permissions == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/permission/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Permissions  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/permission')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
          @endif
          @if(@$newsletter == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/newsletter/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Newsletter  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/newsletter')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
         @endif
         @if(@$reports == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/reports/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Reports  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/reports')}}"><i class="fa fa-circle-o"></i>List</a></li>
         </ul>
         </li>
         @endif
         @if(@$sidebar == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/cms/sidebar-page/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-grav"></i>
         <span>Sidebar</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('admin/cms/sidebar-page')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <!-- <li ><a href="#"><i class="fa fa-circle-o"></i>Create</a></li> -->
         </ul>
         </li>
         @endif

         @if(@$defaultAdvertisement == 1)
         <li {{ Request::is("{$navigation['action_path']}/advertisements/all_index/0/0/*") || ($is_chk_def_adv_page_flag>0) ? 'class=active open' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Default Advertisements</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/advertisements/all_index/1/0')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/advertisements/showadd/1')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
          @endif
         <!-- <li {{ Request::is("{$navigation['action_path']}/admin/advertisements/all_index/0/0*") || ($is_chk_spon_adv_page_flag>0) ? 'class=active open' : '' }}>
            <a href="#">
                <i class="fa fa-question-circle"></i>
                <span>Sponsored Advertisements</span>
            </a>
            <ul class="treeview-menu">
                <li ><a href="{{url('/admin/advertisements/all_index/0/0')}}"><i class="fa fa-circle-o"></i>List</a></li>
                <li ><a href="{{url('/admin/advertisements/showadd/0')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
            </li> -->
        @if(@$faq == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/knowledge-base/faq-categories/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>FAQ Categories (KB)  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/knowledge-base/faq-categories')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/knowledge-base/faq-categories/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
          @endif
          @if(@$faqQuestion == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/knowledge-base/faq-questions/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>FAQ Questions (KB)  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/knowledge-base/faq-questions')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/knowledge-base/faq-questions/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
          @if(@$articalCategory == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/knowledge-base/article-categories/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Article Categories (KB)  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/knowledge-base/article-categories')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/knowledge-base/article-categories/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         @if(@$artical == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/knowledge-base/articles/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-question-circle"></i>
         <span>Articles (KB)  </span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/knowledge-base/articles')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/knowledge-base/articles/showadd')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
          @if(@$truthalie == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/question/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>3 Truths & a Lie</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/question')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/question/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         <!--Quiz-->
         @if(@$quiz == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/quiz/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Quiz</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/quiz')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/quiz/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         <!--Quiz-->
         <!--Quiz Question-->
         @if(@$quizQuestion == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/quiz-question/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Quiz Question</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/quiz-question')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/quiz-question/create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
         </ul>
         </li>
         @endif
         <!--Quiz Question-->
         @if(@$manageGallery == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/galleries/all_index/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-newspaper-o"></i>
         <span>Manage Galleries</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/galleries/all_index/0/0')}}"><i class="fa fa-circle-o"></i>List</a></li>
            <li ><a href="{{url('/admin/galleries/showadd/1')}}"><i class="fa fa-circle-o"></i>Create Image Gallery</a></li>
            <li ><a href="{{url('/admin/galleries/showadd/2')}}"><i class="fa fa-circle-o"></i>Create Video Gallery</a></li>
            <li ><a href="{{url('/admin/galleries/showadd/3')}}"><i class="fa fa-circle-o"></i>Create Known For Gallery</a></li>
         </ul>
         </li>
          @endif
         <!-- end polls page -->
         <!-- Start setting page -->
         @if(@$appSettings == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/settings/*") ? 'class=active' : '' }}>
         <a href="#">
         <i class="fa fa-cogs"></i>
         <span>App Settings</span>
         </a>
         <ul class="treeview-menu">
            <li ><a href="{{url('/admin/settings')}}"><i class="fa fa-circle-o"></i>App Settings</a></li>
         </ul>
         </li>
         @endif
         <!-- end setting page -->
         <!-- Additional Menus page -->
         @if(@$additional_menus == 1)
         <li {{ Request::is("{$navigation['action_path']}/admin/feeds_reports/*") ? 'class=active' : '' }}>
            <a href="{{url('/admin/feeds_reports')}}"><i class="fa fa-newspaper-o"></i> Reported Feeds</a>
         </li>
         <li {{ Request::is("{$navigation['action_path']}/admin/expiring_customers/*") ? 'class=active' : '' }}>
            <a href="{{url('/admin/expiring_customers')}}"><i class="fa fa-users"></i> Expiring Customers</a>
         </li>
         <li {{ Request::is("{$navigation['action_path']}/admin/feeds_ad/*") ? 'class=active' : '' }}>
            <a href="{{url('/admin/feeds_ad')}}"><i class="fa fa-newspaper-o"></i> Feeds Ad</a>
         </li>
         <li {{ Request::is("{$navigation['action_path']}/admin/feeds_category") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>New Feeds Category</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{route('admin.feeds-category.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
               <li ><a href="{{route('admin.feeds-category.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
            </ul>
         </li>
         <li {{ Request::is("{$navigation['action_path']}/admin/news-feeds") ? 'class=active' : '' }}>
            <a href="#">
            <i class="fa fa-users"></i>
            <span>New Feeds</span>
            </a>
            <ul class="treeview-menu">
               <li ><a href="{{route('admin.news_feeds.index')}}"><i class="fa fa-circle-o"></i>News Submission</a></li>
               <li ><a href="{{route('admin.news_feeds.featured_news_feeds')}}"><i class="fa fa-circle-o"></i>Featured News</a></li>
            </ul>
         </li>
         {{--
            <li {{ Request::is("{$navigation['action_path']}/admin/bloom-reports") ? 'class=active' : '' }}>
               <a href="#">
               <i class="fa fa-newspaper-o"></i>
               <span>Bloom Reports</span>
               </a>
               <ul class="treeview-menu">
                  <li ><a href="{{route('admin.bloom_reports.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
                  {{-- <li ><a href="{{route('admin.bloom_reports.create')}}"><i class="fa fa-circle-o"></i>Add Reports</a></li> --}}
               </ul>
            </li>
         --}}
         @endif
      </ul>
   </section>
</aside>
