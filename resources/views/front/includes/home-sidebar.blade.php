@php 
$sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
$current_url_new = URL::current();  
@endphp 
<!--- ****************** || Meme of the day || **************** --->
{{--
   @if(@$is_front_page != 1)
      @if(!empty($sidebarData['meme']))
      <div class="MemeOfTheDay p-4 text-center mb-4">
         <div class="RecentBlogHead mb-3">
            <h4 class="mb-0 text-left">Meme of the Day</h4>
         </div>
         <hr>
         <div class="RecentMemeHead" onclick="memeModel(this,'{{ $sidebarData['meme']->id}}')">
            <img src="{{@imageBasePath( $sidebarData['meme']->featured_image)}}" alt="sidebarbanner" class="img-fluid">
         </div>
         @php 
      $str_to_meme_url_new = url('/pages/meme/'.$sidebarData['meme']->id);
         @endphp
         <div class="memeSocialMediaIcon mt-2">
            <ul class="nav  justify-content-center">
            <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_meme_url_new');"><i class="fa photo_icon fa-clone"></i></a></li>
               <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{@$str_to_meme_url_new}}"><i class="fa photo_icon fa-facebook"></i></a></li>
               <li><a target="_blank" href="http://twitter.com/share?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-twitter"></i></a></li>
               <li><a target="_blank" href="https://www.instagram.com/?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-instagram"></i></a></li>
               <li><a target="_blank" href="https://wa.me/?text={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
            </ul>
         </div>
      </div>
      <input type="hidden" name="hid_meme_url_new" id="hid_meme_url_new" value="{{ $str_to_meme_url_new }}">
      @endif
   @endif
--}}

<!--- ****************** || Meme of the day || **************** --->
<!--- ****************** || Recent Blogs || **************** --->
@if(isset($sidebarData['recentBlogsList']) && count($sidebarData['recentBlogsList'])>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Blogs</h4>
   </div>
   <hr>
   @php 
   $str_blog_detail = 'front.pages.blog.detail'; 
   @endphp
   @foreach ($sidebarData['recentBlogsList'] as $recentBlogs_row)
   <a href="{{route($str_blog_detail, $recentBlogs_row->slug)}}">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="{{@newsBlogImageBasePath($recentBlogs_row->featured_image)}}" alt="Blog Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1">{{ $recentBlogs_row->name }}</h6>
            <p class="mb-0"> {{ $recentBlogs_row->title }}</p>
         </div>
      </div>
   </a>
   @endforeach
   <hr>
   <a href="{{ url('blog_pedia') }}" class="text-center d-block">See more</a>
</div>
@endif
<!--- ****************** || Recent Blogs || **************** --->
<!--- ****************** || Recent WIKI || **************** --->
@if(isset($sidebarData['recentWikiList']) && count($sidebarData['recentWikiList'])>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Wiki</h4>
   </div>
   <hr>
   @php 
   @endphp
   @foreach ($sidebarData['recentWikiList'] as $rowWiki)
   <a href="{{ $rowWiki->url }}" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="{{@imageBasePath($rowWiki->featured_image)}}" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1">{{ $rowWiki->wikiCategory->name }}</h6>
            <p class="mb-0"> {{ $rowWiki->title }}</p>
         </div>
      </div>
   </a>
   <hr>
   @endforeach
   <a href="{{ url('wiki') }}" target="_blank" class="text-center d-block">See more</a>
</div>
@endif
<!--- ****************** || Recent WIKI || **************** --->
<!--- ****************** || Recent POP Entertainments || **************** --->
@if(isset($sidebarData['recentEntertainmentList']) && count($sidebarData['recentEntertainmentList'])>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent Entertainment</h4>
   </div>
   <hr>
   @php 
   @endphp
   @foreach ($sidebarData['recentEntertainmentList'] as $rowEntertainment)
   <a href="{{ @$rowEntertainment->url }}" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="{{@imageBasePath($rowEntertainment->featured_image)}}" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1">{{ $rowEntertainment->entertainmentCategory->name }}</h6>
            <p class="mb-0"> {{ $rowEntertainment->title }}</p>
         </div>
      </div>
   </a>
   <hr>
   @endforeach
   <a href="{{ url('entertainment') }}" target="_blank" class="text-center d-block">See more</a>
</div>
@endif
<!--- ****************** || Recent POP Entertainments || **************** --->
<!--- ****************** || Recent POP Cast || **************** --->
@if(isset($sidebarData['recentCastList']) && count($sidebarData['recentCastList'])>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
      <h4 class="mb-0">Recent POPcast</h4>
   </div>
   <hr>
   @php 
   @endphp
   @foreach ($sidebarData['recentCastList'] as $rowCast)
   <a href="{{ @$rowCast->url }}" target="_blank">
      <div class="RecentBlg mb-2 d-flex align-items-center">
         <div class="RecentBlogImage">
            <img src="{{@imageBasePath($rowCast->featured_image)}}" alt="Wiki Image" class="img-fluid">
         </div>
         <div class="RecentBlogPara">
            <h6 class="mb-1">{{ $rowCast->entertainmentCategory->name }}</h6>
            <p class="mb-0"> {{ $rowCast->title }}</p>
         </div>
      </div>
   </a>
   <hr>
   @endforeach
   <a href="{{ url('popcast') }}" target="_blank" class="text-center d-block">See more</a>
</div>
@endif
<!--- ****************** || Recent POP Cast || **************** --->
@if(!empty($home_product_data->id))
@php 
$str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;  
@endphp
<div class="w-100 HappyDay py-2">
   <div class=" HappyDayBorder">
      <div class="d-flex justify-content-between mt-2 px-3">
         <div class="HappyTopHeader">
            <h2 class="text-left HappyTopHeading" style="font-size: 20px;">Today is...</h2>
         </div>
         <div class="dropdown socialDropdown">
            <span class="fontWeightSix myDropdownBtn" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
            <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
               <ul class="dropSocialShare">
                  <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_product_home_page_url_new');"><i class="fa photo_icon fa-clone"></i></a></li>
                  <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{@$str_home_product_page_url_new}}"><i class="fa photo_icon fa-facebook"></i></a></li>
                  <li><a target="_blank" href="http://twitter.com/share?url={{@$str_home_product_page_url_new}}"><i class="fa photo_icon fa-twitter"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/?url={{@$str_home_product_page_url_new}}"><i class="fa photo_icon fa-instagram"></i></a></li>
                  <li><a target="_blank" href="https://wa.me/?text={{@$str_home_product_page_url_new}}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <hr>
      <div class="HappyProduct px-4">
        <span class="text-left" style="font-size: 17px;">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_one)}}</span>
      </div>
      <div class="text-center mt-1">
         <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}"><img src="{{@imageBasePath(@$home_product_data->main_image)}}" class="img-fluid"></a>
      </div>
      <div class="col-md-12 mt-2 view-btn">
         <!-- <p class="mb-0 mr-1" style="float: left;">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_two)}} </p> -->
         <div class="my-2 text-right" style="width: 100%;z-index: 9;cursor: pointer;"><a target="_blank" class="LinkTag" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_two)}}</a></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<input type="hidden" name="hid_product_home_page_url_new" id="hid_product_home_page_url_new" value="{{@$str_home_product_page_url_new}}">
@endif
<?php //echo "<pre>"; print_r($home_advertisement_data); die;  ?>
@include("front.includes.include_word_of_day")                      
@if(!empty($home_advertisement_data->id))
@php
$str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
@endphp                    
<div class="w-100 TruthsNiceTry">
   <div class=" border-rig-box">
      <div class="advertisement_menu_dropdown">
         <div class="dropdown socialDropdown">
            <span class="fontWeightSix myDropdownBtn" data-toggle="dropdown"> <a href="#" class="photo_icon fa fa-ellipsis-h"></a></span>
            <div class="dropdown-content1 socialDropdownContent dictionaryShare dropdown-menu">
               <ul class="dropSocialShare">
                  <li><a href="javascript:void(0);" onclick="return copyToClipboard('#str_home_advertisement_data_destination_link');"><i class="fa photo_icon fa-clone"></i></a></li>
                  <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{@$str_home_advertisement_data_destination_link}}"><i class="fa photo_icon fa-facebook"></i></a></li>
                  <li><a target="_blank" href="http://twitter.com/share?url={{@$str_home_advertisement_data_destination_link}}"><i class="fa photo_icon fa-twitter"></i></a></li>
                  <li><a target="_blank" href="https://www.instagram.com/?url={{@$str_home_advertisement_data_destination_link}}"><i class="fa photo_icon fa-instagram"></i></a></li>
                  <li><a target="_blank" href="https://wa.me/?text={{@$str_home_advertisement_data_destination_link}}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <input type="hidden" name="str_home_advertisement_data_destination_link" id="str_home_advertisement_data_destination_link" value="{{ @$str_home_advertisement_data_destination_link }}">
      <div class="text-center">
         <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_advertisement_data_destination_link)}}"><img src="{{@imageBasePath($home_advertisement_data->advertisement_image)}}" style="width: 100%;height: 145px;object-fit: cover;border-top-left-radius: 15px;border-top-right-radius: 15px;"></a>
      </div>
      <div class="d-flex justify-content-between mt-2 mb-2 px-3">
         <div class="adver_Image">
            <h2 class="text-left threetruth" style="font-size: 20px;">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_advertisement_data->home_caption_one)}}</h2>
         </div>
      </div>
      <div class="col-md-12 mt-2 view-btn">
         <div class="mb-3" style="width: 100px;float:right;z-index: 9;cursor: pointer;"><a target="_blank" class="spanTag" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_advertisement_data_destination_link)}}">Click here <i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
@endif
@php 
$sidebar_list = \App\Models\SideBar::where('status', 1)
->orderBy('display_order', 'asc')
->get();
$int_count_company_flag = 0;    
@endphp
@foreach($sidebar_list as $k => $sidebar)  
@if((!empty($sidebar->interviews) && count($sidebar->interviews)>0)             || (!empty($sidebar->videos) && count($sidebar->videos)>0)             || (!empty($sidebar->news) && count($sidebar->news)>0)             || (!empty($sidebar->products) && count($sidebar->products)>0)             || (!empty($sidebar->users) && count($sidebar->users)>0)             || (!empty($sidebar->companies) && count($sidebar->companies)>0)          )
<?php if($sidebar->title != 'Engaging Play Product' && $sidebar->title != 'Sponsors'){ ?>
<div class="SidebarBox">
   <div class="p-text mb-3">
      <p>{{$sidebar->title}} </p>
   </div>
   <hr>
   <div class="row">
      <div class="col-md-12">
         @switch($sidebar->type)
         @case(1)
         @php 
         $str_page_name = Request::segment(1);   
         $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
         ->where('page_name', $str_page_name)
         ->first();
         $advertisement_category_id = 1;
         if(!empty($advertisement_category_data->id))
         {
         $advertisement_category_id = $advertisement_category_data->id;   
         }
         $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 2])
         // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
         ->orderBy('id','desc')
         ->first();
         @endphp
         @if(!empty($advertisement) && isset($advertisement->destination_link))
         <div class="sideBarImgBox">
            <a href="{{@$advertisement->destination_link}}" class="span-style1" target="_blank">
               <img src="{{@imageBasePath(@$advertisement->advertisement_image)}}" class="img-fluid mb-2">
               <h3 class="imgHead pull-right"> {{@$advertisement->sponsor_name}}</h3>
            </a>
         </div>
         @endif
         @break
         @case(2)
         <div id="sidebar_div">
            @foreach($sidebar->videos ?? [] as $video)
            @php 
            $GetAPI = @GetYoutubeAPI($video->video_link);
            $thumbnail = @$GetAPI['thumbnail']['standard'];
            @endphp 
            <div class="item pr-1 pb-1" data-responsive="" data-src="{{$video->video_link}}" data-poster="" data-sub-html="">
               <div>
                  <a href="{{ $video->video_link }}" class="p-text1 span-style1" target="_blank">
                     <img src="{{ $thumbnail }}" class="img-fluid sidebarvideoimage">
                     <p class="span-white1 mt-2"> {{ $video->content }}</p>
                  </a>
               </div>
            </div>
            @endforeach
         </div>
         @break
         @case(3)
         <div class="row">
            <div class="col-md-12">
               <div class="image-width1">
                  @foreach($sidebar->news ?? [] as $new)
                  <div class="">
                     <a href="{{ url('/') . '/news/'. @$new->news->slug }}" class="text-white">{{@$new->news->title}}</a>
                     <p><small class="textYellow">{{@$new->content}}</small></p>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
         @break
         @case(4)
         <div class="d-flex flex-wrap" style="display:none !important;">
            @foreach($sidebar->products ?? [] as $product)
            <div class="image-width1 SponsorsColumn d-flex flex-row justifly-content-center mb-3 w-100">
               <a href="{{ url('/') . '/product/'. $product->product->slug }}" class="p-text1 span-style1">
               <img class="rounded-circle mr-2 sidebarImgCircle" src="{{@prodEventImageBasePath($product->product->main_image)}}">
               </a>
               <a href="{{ url('/') . '/product/'. $product->product->slug }}" class="p-text1 span-style1">
                  <div class="d-flex align-items-center" style="height:60px">
                     <p class="span-white1 SidebarPara mb-0" >{{@$product->content}}</p>
                  </div>
               </a>
            </div>
            @endforeach
         </div>
         @break
         @case(5)
         <div class="SideBarImgGallery d-flex flex-wrap">
            @foreach($sidebar->users ?? [] as $u => $users)
            @php
            $base_url = url('/');
            $user_current_info_new = $users->user;
            $str_user_name = '';
            if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
            {
            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
            }
            else
            {
            $str_user_url_new = "#"; 
            }
            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
            @endphp
            <div class="GalleryImageSideBar">
               <a href="{{@$str_user_url_new}}" class="p-text1 span-style1">
                  <img src="{{@imageBasePath($users->user->profile_image)}}" class="imgsideBarCompnay" class="img-fluid">
                  <p><small class="textYellow">{{@$users->content}}</small></p>
               </a>
            </div>
            @endforeach
         </div>
         @break
         @case(6)
         <div class="">
            @foreach($sidebar->companies ?? [] as $u => $users)
            {{-- @if($int_count_company_flag>=2)
            @break;
            @endif --}} 
            @php
            $base_url = url('/');
            $user_current_info_new = $users->user;
            $str_user_name = '';
            if(!empty(@$user_current_info_new->role) && (@$user_current_info_new->role == 2 || @$user_current_info_new->role == 3) )
            {
            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);  
            }
            else
            {
            $str_user_url_new = "#"; 
            }
            $str_user_name = App\Helpers\Utilities::getUserName($user_current_info_new);
            $str_company_content = $users->content;
            @endphp
            <div class="image-width1 d-flex flex-row justifly-content-center mb-3">
               <a href="{{@$str_user_url_new}}" class="p-text1 span-style1">
               <img class="rounded-circle mr-2 sidebarImgCircle" src="{{@imageBasePath($users->user->profile_image)}}">
               </a>
               <a href="{{@$str_user_url_new}}" class="span-style1">
                  <div class="d-flex align-items-center" style="height:56px">
                     <p class="span-white1 mb-0" >
                        @if(strlen($str_company_content)>60)
                        {{@substr($str_company_content, 0, 60) . '....'}}
                        @else
                        {{@$str_company_content}}  
                        @endif 
                     </p>
                  </div>
               </a>
            </div>
            @php
            $int_count_company_flag++;
            @endphp
            @endforeach
         </div>
         @break
         @case(7)
         <div class="row">
            <div class="col-md-12">
               <div class="image-width1">
                  @foreach ($sidebar->interviews ?? [] as $i => $inter)
                  <a href="{{ url('/') . '/featured-article/'. @$inter->interview->slug }}">
                     <div class="RecentBlg mb-2 d-flex align-items-center">
                        <div class="RecentBlogImage">
                           <img src="{{@newsBlogImageBasePath(@$inter->interview->featured_image)}}" alt="Blog Image" class="img-fluid">
                        </div>
                        <div class="RecentBlogPara">
                           <h6 class="mb-1">{{ App\Helpers\Utilities::getSingleCategoryName('blog_categories', @$inter->interview->category_id ,'name') }}</h6>
                           <p class="mb-0"> {{@$inter->interview->title}}</p>
                        </div>
                     </div>
                  </a>
                  @endforeach
                  <hr>
                  <a href="{{ url('featured-article') }}" class="text-center d-block">See more</a>
               </div>
            </div>
         </div>
         @break
         @case(8)
         @php 
         $str_page_name = Request::segment(1);   
         $advertisement_category_data = \App\Models\AdvertisementCategory::where('status', 1) 
         ->where('page_name', $str_page_name)
         ->first();
         $advertisement_category_id = 1;
         if(!empty($advertisement_category_data->id))
         {
         $advertisement_category_id = $advertisement_category_data->id;   
         }
         $advertisement = \App\Models\Advertisement::where(['advertisement_category' => $advertisement_category_id, 'advertisement_position' => 3])
         // ->whereRaw('? between from_date and to_date', [date('Y-m-d')])
         ->orderBy('id','desc')
         ->first();
         //pr($advertisement_category_data);
         @endphp
         @if(!empty($advertisement) && isset($advertisement->destination_link))
         <div class="sideBarImgBox">
            <a href="{{@$advertisement->destination_link}}" class="span-style1">
               <img src="{{@imageBasePath(@$advertisement->advertisement_image)}}" class="img-fluid mb-2 fullBanner">
               <h3 class="imgHead"> {{@$advertisement->sponsor_name}}</h3>
            </a>
         </div>
         @endif
         @break
         @endswitch
      </div>
   </div>
</div>
<?php } ?>        @endif
@endforeach
<!-- </div> -->
<style type="text/css">
   a.p-text1.span-style1 {
   color: #fff !important;
   }
</style>