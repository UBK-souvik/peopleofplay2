@extends('front.layouts.pages')
@section('style_new')
   <link rel="stylesheet" href="{{ asset('front/new_css/feeds.css?'.time()) }}">
   <link rel="stylesheet" href="{{ asset('front/new_css/pop-classifieds.css?'.time()) }}">
   <link rel="stylesheet" href="{{ asset('front/new_css/quiz.css?'.time()) }}">
   
   <style>
      .MailingList {
      border-top: 1px solid #fff; 
      }
      .feed_classified_application {
         background: #662e91;
         width: 210px;
         border-radius: 4px;
         margin: 0 auto;
         color: #fff;
      }
      .close{
         position: absolute;
         top: 8px;
         right: 5px;
         color: #000000;
         font-size: 20px;
         font-weight: bold;
         transition: 0.3s;
         opacity: 1;
         
      }
      .close span{
         border-radius: 20px;
         background: white;
         padding: 0px 7px;
      }
      .st_loader{
         display: inline-block;
         /* font: normal normal normal 14px/1 FontAwesome; */
         /* font-size: inherit; */
         /* -webkit-font-smoothing: antialiased; */
         text-rendering: auto;
         -moz-osx-font-smoothing: grayscale;
         border-radius: 50%;
         border: 2px solid currentColor;
         border-right-color: transparent;
         width: 1rem;
         height: 1rem;
         vertical-align: text-bottom;
         animation: fa-spin .75s linear infinite !important;
      }
      .PopAllGallery .modal-header .close {
         margin: 0px !important;
      }
      @media(min-width: 1201px){
         .MiddleColumnSection {
            padding: 0px 30px
         } 
      }
      @media(min-width: 992px){
    .LeftColumnSection {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 18%;
    flex: 0 0 18%;
    max-width: 18%;
}
.MiddleColumnSection {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 56%;
    flex: 0 0 56%;
    max-width: 56%;
}
.rightSideSection {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 25%;
    flex: 0 0 26%;
    max-width: 26%;
}
}
   </style>
@endsection
@section('content')

<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="popFeedBlogs">
      <div class="YTtopContant text-center">
         <img src="{{ asset('front/images/WebHeader_new.png') }}" alt="WelcomeToPOPWeekHeader" class="img-fluid w-100">
      </div>
      <div class="popStartPosts w-100 pt-4 pb-3 border-bottom">
         <form>
            <div class="feedInputs">
               <div class="input-group">
               <div class="input-group-prepend">
                  <img src="{{@imageBasePath(@$uinfo->profile_image)}}" alt="profileimage" class="img-fluid rounded-circle">
               </div>
               <input type="text" class="form-control startPostInput" placeholder="Start a Post" onclick="feedtype('4');" readonly>
               </div>
            </div>
            <div class="feedIconsLists">
               <ul class="list-unstyled IconsLists m-0 viewIconsLists">
               <li>
                  <a href="javascript:void(0);" class="clrYellow" onclick="feedtype('4');">
                     <img src="{{ asset('front/images/pop_icons/3.png') }}" class="img-fluid">
                     <p>Media</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrRed" onclick="feedtype('1');">
                     <img src="{{ asset('front/images/pop_icons/1.png') }}" class="img-fluid">
                     <p>Photo</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrOrange" onclick="feedtype('2');">
                     <img src="{{ asset('front/images/pop_icons/2.png') }}" class="img-fluid">
                     <p>Video</p>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" class="clrGreen" onclick="feedtype('5');">
                     <img src="{{ asset('front/images/feed/feed_product.png') }}" class="img-fluid">
                     <p>Product</p>
                  </a>
               </li>
               </ul>
            </div>
            <input type="hidden" name="page_type" id="page_type" value="feeds">
            <input type="hidden" name="offset" id="offSet" value="1">
            <input type="hidden" name="no_user_offset" id="no_user_offset" value="{{$no_User_Offset}}">
            <input type="hidden" name="load_status" id="loadStatus" value="active">
            <input type="hidden" id="is_user_login" value="{{@$uinfo->id}}">
            <input type="hidden" id="dictionary_id" value="{{@$dictionary_detail[0]->id}}">
         </form>
      </div>
      @php 
      $sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
      $str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;
      $str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
      $i = $offset_i; $k = 0;
      
      // $feeds_cnt = ltrim((count($countFeeds) - count($newfeeds3)),'-');
      $feeds_cnt = count($countFeeds);

      $str_user_name = '';
      $str_user_url_new = '#';
      $str_profile_image = '';
      if(!empty($question_detail[0]->user_id)){ 
            @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
            @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
            @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
      }
      $str_to_meme_url_new = url('/pages/meme/'.$sidebarData['meme']->id);
      @endphp 
      <div class="allPostHere w-100 clearfix mb-4">
         @php $feed_id = $feeds[0]['id']; @endphp
         <div class="popFeedPost w-100 py-4 border-bottom d-lg-none d-block" id="feed-main-box{{$feed_id}}">
            <div class="feedCategory d-flex pb-2">
               <h6><span><b>MEME OF THE DAY</b></span></h6>
               <div class="social_iconontop">
                  <div class="dropdown socialDropdown SocialShareBlog">
                     <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> Share <a href="#" class="photo_icon fa fa-share-square-o"></a></span>
                     <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu">
                        <ul class="dropSocialShare">
                           <li><a href="javascript:void(0);" onclick="return copySharingUrl(`{{@$str_to_meme_url_new}}`);"><i class="fa photo_icon fa-clone"></i></a></li>
                           
                           <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{@$str_to_meme_url_new}}"><i class="fa photo_icon fa-facebook"></i></a></li>
                           <li><a target="_blank" href="http://twitter.com/share?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-twitter"></i></a></li>
                           <li><a target="_blank" href="https://www.instagram.com/?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-instagram"></i></a></li>
                           <li><a target="_blank" href="https://wa.me/?text={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>  
            <div class="feedPostContents">
               <div class="feedVidImg w-100">
                  <a href="javascript:void(0)" onclick="memeModel(this,`{{ @$sidebarData['meme']->id}}`)">
                     <img src="{{@imageBasePath( @$sidebarData['meme']->featured_image)}}" alt="sidebarbanner" class="img-fluid">
                  </a>
               </div>
            </div>     
         </div>
      @if($feeds_cnt > 0)
         @foreach ($feeds as $key => $feed)
            @php 

            $feed_id = $feed['id']; 

            if($feed['pop_feed_position'] == 1 || $feed['pop_feed_position'] == 2 || $feed['pop_feed_position'] == 3 || $feed['pop_feed_position'] == 4 || $feed['pop_feed_position'] == 5 || $feed['pop_feed_position'] == 6){
            continue;
            }
            $i++; 
            @endphp
            @if($i == 6 || $i == 10 || $i == 13 || $i == 15 || $i == 17)               
               @php $category = 'POP POST'; @endphp
               @include('front.feeds.side_bar_content_feed')
            @endif
            @php            
               $cat_url = 'javascript:void(0)';
               if($feed['type'] == 1){
                  $category = 'IMAGE';
               }elseif($feed['type'] == 2){
                  $category = 'VIDEO';
               }elseif($feed['type'] == 3){
                  $category = 'BLOG';
                  $cat_url = url('blog/'.$feed['blog_slug']);
               }elseif($feed['type'] == 4){
                  if($feed['check_post'] == '3'){
                     $category = 'WIKI';
                     $cat_url = 'wiki';
                  }elseif($feed['check_post'] == '4'){
                     $category = 'ENTERTAINMENT';
                     $cat_url = 'entertainment';
                  }elseif($feed['check_post'] == '5'){
                     $category = 'CAST';
                     $cat_url = 'popcast';
                  }else{
                     $category = 'MEDIA-MENTION';
                  }
               }elseif($feed['type'] == 5){
                  $category = 'PRODUCT';
               }elseif($feed['type'] == 6){
                  $category = 'CLASSIFIED';
               }
            @endphp
            <div class="popFeedPost w-100 py-4 border-bottom feed_Id_{{ $feed['id'] }} {{$i}}" id="feed-main-box{{ $feed['id'] }}">
               <input type="hidden" class="i_position" value="{{$i}}">
               <div class="feedCategory d-flex pb-3">
                  @if($feed['is_front_admin_user'] == 1)
                     <a href="{{ url($cat_url) }}" class="text-dark"><h6><span><b>{{@$category}}</b></span></h6></a>
                  @else
                  <h6><span><b><a href="{{url('people/'.$feed['slug'])}}" class="text-dark" target="_blank">{{ ucwords($feed['first_name'].' '.$feed['last_name']) }}</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="{{ $cat_url }}" class="text-dark">{{@$category}}</a></b></span></h6>
                  @endif
                     <!-- <span class="timeDate">{{ @App\Helpers\Utilities::timeago($feed['time'])}}</span> -->
                  
                  <div class="nav-item dropdown" >
                     <a class="" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                     <div class="dropdown-menu DropDownMenuMob">
                        @if(isset($session_id) && !empty($session_id) && ($session_id == $feed['user_id']))
                           <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'delete',`feed-main-box{{ $feed['id'] }}`); return false;">Delete</a>
                           <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'remove',`feed-main-box{{ $feed['id'] }}`); return false;">Remove From Feeds</a>
                           
                           @if($feed['type'] == 1 || $feed['type'] == 2 || $feed['type'] == 4 || $feed['type'] == 5)
                              <a class="dropdown-item" href="#" onclick="editFeedtype(`{{$feed['type']}}`,`{{$feed['id']}}`); return false;">Edit</a>
                           @elseif($feed['type'] == 3)
                                 <a class="dropdown-item" href="{{url('user/feed/update/blog/'.$feed['id'])}}" target="_blank">Edit</a>
                           @elseif($feed['type'] == 6)
                              <a class="dropdown-item" href="{{url('user/feed/update/classified/'.$feed['id'])}}" target="_blank">Edit</a>
                           @endif
                           {{--
                           <!-- @if($feed['type'] == 1 || $feed['type'] == 2)
                               <a class="dropdown-item" href="#" onclick="openEditGalleryModal(`{{$feed['id']}}`,'feeds_edit'); return false;">Edit</a>
                            @elseif($feed['type'] == 3)
                                  <a class="dropdown-item" href="{{url('user/feed/update/blog/'.$feed['id'])}}">Edit</a>
                            @elseif($feed['type'] == 4)
                               <a class="dropdown-item" href="{{url('user/feed/update/media/'.$feed['id'])}}">Edit</a>
                            @elseif($feed['type'] == 5)
                               <a class="dropdown-item" href="{{url('user/feed/update/product/'.$feed['id'])}}">Edit</a>
                            @elseif($feed['type'] == 6)
                               <a class="dropdown-item" href="{{url('user/feed/update/classified/'.$feed['id'])}}">Edit</a>
                            @endif -->
                           --}}
                        @else
                           <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'report_from_show',`feed-main-box{{ $feed['id'] }}`); return false;">Report</a>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="feedPostContents">
                  <div class="feedTitles d-flex">
                     @if($feed['type'] != 0)
                        <div class="leftFeed">
                           @if($feed['type']==3)
                              <a href="{{ $feed['url'] }}" target="blank"><h4>{{ $feed['title'] }}</h4></a>
                           @elseif($feed['type'] != 6)
                              @if(!empty( $feed['url']))
                              <a href="{{ $feed['url'] }}" target="blank"><h4>{{ $feed['title'] }}</h4></a>
                              @else
                                 <h4>{{ $feed['title'] }}</h4>
                              @endif
                           @endif
                           @if($feed['type'] != 6)
                              <div class="subDescriptions position-relative">
                                 <div class="pContents @if(strlen(strip_tags($feed['caption'])) > 500){{ 'four-line-text' }} @endif">    
                                    @php    
                                       $find = ['/^((?:&nbsp;|\s)+)|(?1)$/', '/\s*&nbsp;(?:\s*&nbsp;)*\s*/', '/\s+/'];
                                       $replace = ['', '&nbsp',' '];
                                       $feed['caption'] = preg_replace($find, $replace, trim($feed['caption']));                  
                                    @endphp

                                    @if(!empty( $feed['url']))
                                       <a href="{{ $feed['url'] }}" target="blank"><p>{{ strip_tags($feed['caption']) }}</p></a>
                                    @else
                                       <p>{{ strip_tags($feed['caption']) }}</p>
                                    @endif
                                    
                                    @if(strlen(strip_tags($feed['caption'])) > 500)
                                       @if($feed['type'] == 3)
                                          <a href="{{ url($cat_url) }}" class="readMore" target="_blank">Click to article</a>
                                       @else
                                          <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                                       @endif
                                    @endif
                                 </div>
                              </div>
                           @elseif($feed['type'] == 6)
                              <a href="{{ url('/pop-classified-details/'.$feed['product_name'])}}" class="clickApplicationBtn" target="_blank">
                                 <h4>{{ $feed['title'] }}</h4>
                              </a>
                                 <div class="subDescriptions position-relative">
                                    <div class="pContents  @if(strlen(strip_tags($feed['caption'])) > 500){{ 'four-line-text' }} @endif">
                                       <a href="{{ url('/pop-classified-details/'.$feed['product_name'])}}" class="clickApplicationBtn" target="_blank">
                                          <p>{{ strip_tags($feed['caption']) }}</p>
                                       </a>
                                       @if(strlen(strip_tags($feed['caption'])) > 500)
                                       <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                                       @endif
                                    </div>
                                 </div>
                                 <a href="{{ url('/pop-classified-details/'.$feed['product_name'])}}" class="clickApplicationBtn" target="_blank">
                                    <div class="text-center mt-3 feed_classified_application">
                                       Click For Application
                                    </div>
                                 </a>
                           @endif
                        </div>
                     @endif
                     <div class="rightFeed">
                        @if($feed['type'] != 0 && ($feed['is_front_admin_user']!=1))
                           @if($feed['userRole'] == 3)
                           <a href="{{url('company/'.$feed['slug'])}}" class="profileImg HoverToolTip position-relative" target="_blank">
                           @else
                           <a href="{{url('people/'.$feed['slug'])}}" class="profileImg HoverToolTip position-relative" target="_blank">
                           @endif
                              <p class="position-absolute">{{ ucwords($feed['first_name'].' '.$feed['last_name']) }}</p>
                              @php $dp_img = @imageBasePath(@$feed['profile_image']); @endphp 
                              <img src="{{@$dp_img}}" alt="profileimage" class="img-fluid rounded-circle">
                           </a>
                        @endif 
                        <!-- <a href="#"><p class="userName">Shubham Sharma</p></a> -->
                     </div>
                  </div>
               </div>
               
               @if($feed['type'] != 6)
                  <div class="feedVidImg w-100 mt-3 {{$feed['type']}}">
                     @if($feed['video_url'] != '')
                        <?php 
                           preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                           if(@$feed['check_post'] == 1){
                              @App\Helpers\UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);
                           }
                        ?>
                        <!-- <iframe src="https://www.youtube.com/embed/<?php echo @$match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                        <a href="javascript:void(0)" class="popYouVideo" onclick="videoPopup(this,`{{@$match[1]}}`); return false;">
                           <img src="{{ url('/uploads/images/youtube_video/'.@$match[1].'.jpg') }}" alt="No Image Found" class="img-fluid">
                           <img src="{{ url('/uploads/images/youtube_video/youtube_black.svg') }}" alt="No Image Found" class="img-fluid youTubePlay hoverHide">
                           <img src="{{ url('/uploads/images/youtube_video/youtube_red.svg') }}" alt="No Image Found" class="img-fluid youTubePlay hoverShow">
                           <!-- <i class="fa fa-youtube-play" aria-hidden="true"></i> -->
                        </a>
                     @else
                        @if($feed['image'] != '')
                           <a href="javascript:void(0)" onclick="imagePopup(this); return false;">
                              @if(($feed['type'] == 3) || ($feed['type'] == 5 && $feed['check_post'] == 0))
                                 <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                              @elseif($feed['type'] == 5 && $feed['check_post'] == 1)
                                 <img src="{{ url('/uploads/images/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                              @else
                                 <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                              @endif
                           </a>
                           @if($feed['type']==5)
                           <a href="{{ $feed['url'] }}" target="_blank">
                                 <h5 class="text-center">{{ $feed['product_name'] }}</h5>
                           </a>
                           @endif
                        @endif
                     @endif
                     @if($feed['url'] != '')
                        @if($feed['type'] == 1 || $feed['type'] == 2 || $feed['type'] == 4)
                           @if($feed['image'] == '')
                              <a href="{{ $feed['url'] }}" class="feedOlnyText one-line-text" target="_blank">{{ $feed['url'] }} </a>
                           @else
                              <a href="{{ $feed['url'] }}" class="feedOlnyText one-line-text" target="_blank">{{ $feed['url'] }} </a>
                           @endif
                        @endif
                     @endif
                  </div>
                  <div class="feed-tag mt-2">
                     <ul class="nav tag-list">
                     <?php if($feed['tag']) {
                        $feedTags = explode(',',$feed['tag']);
                        ?>
                     @foreach ($feedTags as $tags)
                     <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">#{{ $tags }}</a>
                     </li>
                     @endforeach
                     <?php  } ?>
                     <?php  $companies_id =explode(',',$feed['tag_companies']); 
                        if(!empty($companies_id) && count($companies_id)>0) {
                        $companies = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',3)->whereIn('id',$companies_id)->get()->toArray();  ?>
                     @foreach ($companies as $company)
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('company/'.$company->slug) }}" target="_blank"><?= '@'.$company->first_name .$company->last_name?></a>
                     </li>
                     @endforeach
                     <?php } ?>
                     <?php  $product_id =explode(',',$feed['tag_products']); 
                        if(!empty($product_id) && count($product_id)>0) {
                        $products = DB::table('products')->select('products.id','products.name','products.slug')->whereIn('id',$product_id)->get()->toArray();   ?>
                     @foreach ($products as $product)
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('product/'.$product->slug) }}" target="_blank"><?= '@'.$product->name?></a>
                     </li>
                     @endforeach
                     <?php } ?>
                     <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                        if(!empty($peoples_id) && count($peoples_id)>0) {
                        $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role','!=',3)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                     @foreach ($peoples as $people)
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('people/'.$people->slug) }}" target="_blank"><?= '@'.$people->first_name .$people->last_name?></a>
                     </li>
                     @endforeach
                     <?php } ?>
                     </ul>
                  </div>
                  <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
                     <hr class="mb-0">
                     @php @$ProfOptsComments = 'display:none'; @endphp
                     @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id']) >0)
                     @php @$ProfOptsComments = ''; @endphp
                     @endif
                     
                     <hr class="my-0 commentCountSectionHr{{ @$feed['id'] }}" style="{{ @$ProfOptsComments }}">
                     
                     <ul class="list-unstyled likeLists m-0">
                        <?php 
                        $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                        
                        if($addLikeFeed) {
                           $is_like = 0;
                           $img_pop_icon_0 = asset('front/images/pop_icons/like_icon.png');
                        } else {
                           $is_like = 1;
                           $img_pop_icon_1 =  asset('front/images/pop_icons/7.png');
                        }
                        ?>
                        <li>
                        <a class="nav-link d-inline" href="javascript:void(0);" onclick="likeFeed(this,'<?= $feed['id'] ?>','<?= $is_like ?>','comment',0)">
                           <input type="hidden" class="is_like_hidden" value="<?= $is_like ?>">
                           
                           <img src="{{ asset('front/images/pop_icons/like_icon.png') }}" alt="ProfImg" class="img-fluid like_Icon is_Like_Icon" <?php if($is_like == 1){ echo "style='display:none'"; } ?>>
                           <img src="{{ asset('front/images/pop_icons/7.png') }}" alt="ProfImg" class="img-fluid like_Icon is_Un_Like_Icon" <?php if($is_like == 0){ echo "style='display:none'"; } ?>>
                        </a>
                        <span class="feedSelfLike likes_Count ml-1" onclick="feed_like_user(`{{$feed['id']}}`)">{{ @App\Helpers\Utilities::feedCommentLikeCount($feed['id']) }}</span>
                        </li>
                        <li>
                        <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')">
                           <img src="{{ asset('front/images/pop_icons/6.png') }}" class="igm-fluid">
                           <span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed['id'])}}</span>
                        </a>
                        </li>
                        {{--
                        <li class="nav-item">
                        <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}',`{{ url('feed/'.$feed_id.'&') }}`)" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
                        <!-- <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share (0)</span></a>  -->
                        </li>
                        --}}
                        <li class="nav-item">
                           <div class="dropdown socialDropdown SocialShareBlog">
                              <a class="fontWeightSix myDropdownBtn dropdown-toggle" href="#!" data-toggle="dropdown" aria-expanded="true">
                                 <img src="https://peopleofplay.com/front/images/icons/share1.png" alt="ProfImg" class="img-fluid"> <span style="font-size:10px;font-weight:400;">Share</span>
                              </a>
                              <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-24px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
                                 <ul class="dropSocialShare">
                                    <li><a href="javascript:void(0);" onclick="return copySharingUrl(`{{ url('feed/'.$feed_id) }}`);"><i class="fa photo_icon fa-clone"></i></a></li>
                                    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{ url('feed/'.$feed_id) }}" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-facebook"></i></a>
                                    </li>
                                    <li><a target="_blank" href="http://twitter.com/share?url={{ url('feed/'.$feed_id) }}" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-twitter"></i></a>
                                    </li>
                                    <li><a target="_blank" href="https://wa.me/?text={{ url('feed/'.$feed_id) }}" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-whatsapp"></i></a>
                                    </li>
                                    <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('feed/'.$feed_id) }}" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </li>
                        
                     </ul>
                  </div>
                  {{--
                  <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
                     <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"></div>
                  </div>
                  --}}
                  
                  <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
                     <hr class="mt-0">
                     @include('front.feeds.feed_comment_view')
                  </div>
               @endif
            </div>
            @endforeach
         @else
            @php $j=1; $k=1; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         <!--   -----------------------------------------------------------------   -->
      </div>
      <div class="showMore text-center mb-3" style="display: none;">
         <a href="javascript:void(0);" class="d-inline-block" onclick="scroll_feeds(); return false;"><i class="fa fa-spin st_loader st_page_loading st_loadMore" style="display: none;"></i> <b><span class="load_more_span">load more</span></b></a>
      </div>
   </div>
</div>

<div class="col-md-3 col-lg-3 rightSideSection">
   <div class="popFeedSidebar">
      @php $feed_id = $feeds[0]['id']; @endphp
      <div class="popFeedPost w-100 py-4 border-bottom d-none d-lg-block mb-4 {{$i}}" id="feed-main-box{{$feed_id}}">
         <input type="hidden" class="i_position" value="{{$i}}">
         <div class="feedCategory d-flex pb-2">
            <h6><span><b>MEME OF THE DAY</b></span></h6>
            <div class="social_iconontop">
               <div class="dropdown socialDropdown SocialShareBlog">
                  <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> Share <a href="#" class="photo_icon fa fa-share-square-o"></a></span>
                  <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu">
                     <ul class="dropSocialShare">
                        <li><a href="javascript:void(0);" onclick="return copySharingUrl(`{{@$str_to_meme_url_new}}`);"><i class="fa photo_icon fa-clone"></i></a></li>
                        <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{@$str_to_meme_url_new}}"><i class="fa photo_icon fa-facebook"></i></a></li>
                        <li><a target="_blank" href="http://twitter.com/share?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/?url={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://wa.me/?text={{@$str_to_meme_url_new }}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>  
         <div class="feedPostContents">
            <div class="feedVidImg w-100">
               <a href="javascript:void(0)" onclick="memeModel(this,`{{ @$sidebarData['meme']->id}}`)">
                  <img src="{{@imageBasePath( @$sidebarData['meme']->featured_image)}}" alt="sidebarbanner" class="img-fluid">
               </a>
            </div>
         </div>     
      </div>
      @if($feeds_ad[0]->type == 'top_ad' && !empty($feeds_ad[0]->image))
      <div class="OptionalAd OptionalAd1 text-center mb-4">
         <a href="@if(!empty($feeds_ad[0]->url)){{ $feeds_ad[0]->url }}@else{{'javascript:void(0)'}}@endif" target="@if(!empty($feeds_ad[0]->url)){{ '_blank' }}@endif">
            <img src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[0]->image)}}" alt="" width="300px" height="250px">
         </a>
      </div>
      @endif
      @if($feeds_ad[1]->type == 'middle_ad' && !empty($feeds_ad[1]->image))
      <div class="OptionalAd OptionalAd2 text-center mb-4">
         <a href="@if(!empty($feeds_ad[1]->url)){{ $feeds_ad[1]->url }}@else{{'javascript:void(0)'}}@endif" target="@if(!empty($feeds_ad[1]->url)){{ '_blank' }}@endif">
            <img src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[1]->image)}}" alt="" width="300px" height="600px">
         </a>
      </div>
      @endif
      @if($feeds_ad[2]->type == 'bottom_ad' && !empty($feeds_ad[2]->image))
      <div class="OptionalAd OptionalAd1 OptionalAd3 text-center mb-4">
         <a href="@if(!empty($feeds_ad[2]->url)){{ $feeds_ad[2]->url }}@else{{'javascript:void(0)'}}@endif" target="@if(!empty($feeds_ad[2]->url)){{ '_blank' }}@endif">
            <img src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[2]->image)}}" alt="" width="300px" height="250px">
         </a>
      </div>
      @endif
   </div>
   <div class="HomeRightColumn">
      <div class="w-100 clearfix IncludeInRightSideBar">
         @include('front.includes.home-sidebar')
      </div>
   </div>
</div>

<form id="galleryForm" class="kform_control">
   <div id="ModalGalleryVideoForm" class="modal PopAllGallery" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content"></div>
      </div>
   </div>
</form>

<div id="youtubeURL" style="display:none;"><iframe id="iframe_data" width="100%" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

@include('front.includes.cropper_model')

@endsection

@section('feeds_scripts')


<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop' async='async'></script>

<script type="text/javascript">
   var __st_loadLate=true; //if __st_loadLate is defined then the widget will not load on domcontent ready
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

<script>

   $(document).ajaxComplete(function() { 
      //creates the share icons 
      stButtons.locateElements(); 
   });

   $(document).ready(function() { 

      var xhr; 

      setTimeout(function(){
         scroll_feeds('doc_ready');
      },2500); 

      $(window).scroll(function() {
         scroll_feeds();
      });

      function abort_xhr_request(){
         if(xhr && xhr.readyState != 4){
            xhr.abort();
         }
      }

      function scroll_feeds(function_type=''){
         $('.showMore .load_more_span').text('load more');
         var load_status = $('#loadStatus').val();
         var offset = $('#offSet').val();
         var no_user_offset = $('#no_user_offset').val();
         var limit = 5;
         var feed_hgt = $(".allPostHere").height();
         var hgt = $(".popFeedPost:nth-last-of-type(2)").height();
         var i_position = $('.allPostHere .popFeedPost:last-child .i_position').val();
         var minus_hgt = feed_hgt - hgt;
         var dictionary_id = $('#dictionary_id').val();
         
         
         if(($(window).scrollTop() >= minus_hgt && load_status == 'active') || (function_type == 'doc_ready')){
            if(i_position == null){
               i_position = $(".allPostHere .popFeedPost:nth-last-of-type(2) .i_position").val();
            }
            console.log('i_position - '+i_position+' - hgt - '+hgt);
            $('.st_loadMore').show();
            $('#loadStatus').val('inactive');
            setTimeout(function(){ 
               if($('#loadStatus').val() == 'inactive'){
                  $('#loadStatus').val('active');
                  $('.showMore .load_more_span').text('Click for reload');
               }
            }, 10000);
            // console.log($(document).height()+' - '+$(window).scrollTop()+' - '+ $(window).height());
            // alert($(document).height());
            $('.showMore').show();
            
            xhr = $.ajax({
               url: "{{ route('front.feeds') }}",
               headers: {
                  'X-CSRF-TOKEN': ajax_csrf_token_new
               },
               data: {page_scroll:'yes',offset:offset,limit:limit,i_position:i_position,no_user_offset:no_user_offset,dictionary_id:dictionary_id},
               dataType: 'json',
               type: 'POST',
               beforeSend: function () {
                  // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
               },
               error: function (jqXHR, exception) {

                  var msg = formatErrorMessage(jqXHR, exception);
                  // toastr.error(msg);
                  console.log(msg);
                  // $('.message_box').html(msg).removeClass('hide');
               },
               success: function (data) {
                  if(data.status == 1){
                     if(data.cnt_feeds != 0){
                        if(!$('.popFeedPost').hasClass('feed_Id_'+data.feed_Id)){
                           $('.allPostHere').append(data.view);
                           $('#offSet').val(data.offset);
                           $('#no_user_offset').val(data.noUserOffset);
                           $('#loadStatus').val('active');
                           $('.no_more_post').remove();
                        }
                     }else if(data.cnt_feeds == 0){
                        $('.showMore').hide();
                     }
                  }

                  const st = window.__sharethis__
                  if (!st) {
                     const script = document.createElement('script')
                     script.src =
                        'https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop'
                     document.body.appendChild(script)
                  } else if (typeof st.initialize === 'function') {
                     st.href = window.location.href
                     st.initialize()
                  }

                  $('.st_loadMore').hide();
                  stButtons.locateElements(); 
                  setInterval(abort_xhr_request());
               }
            });
            
         }
      }
   });
</script>
@endsection

@section('scripts')
<script>
   $(".WelcomeSetFeed ul li a").on("click",function(){
     $(this).toggleClass("setfeedactive");
   });
</script>
<script>
   $(document).ready(function(){           
      $('[data-toggle="tooltip"]').tooltip();   
   });
   
   var newsletter_flag = '{{ Session::has("newsletter_flag") }}';
   function eventSaveMessage(){
    if(newsletter_flag =="1" || newsletter_flag ==1)
    {
   
      toastr.success("Newsletter Subscriptions updated successfully.");
   }
   
   }
   window.onload = eventSaveMessage;
   
   function favoritesFeed(e,feed_id,type) {
   $.ajax({
    url: "{{ route('front.feeds.feed_favorite') }}",
    type: 'post',
    dataType: 'json',
    data: {"_token": "{{ csrf_token() }}",'feed_id':feed_id,'type':type},
    success: function(response) {
       if(response.status ==1) {
         $(e).parent().html('<a href="javascript:void(0)" onclick="favoritesFeed(this,'+feed_id+',0)"><i class="fa fa-star checked" aria-hidden="true"></i>  Add to Favorites </a>');
         toastr.success(response.message)
      } else {
         $(e).parent().html('<a href="javascript:void(0)" onclick="favoritesFeed(this,'+feed_id+',1)"><i class="fa fa-star-o" aria-hidden="true"></i>  Add to Favorites </a>');
         toastr.success(response.message)
      }
   }
   });
   }
   
   function likeFeed(e,feed_id,is_like,type,reply_id) {
      var is_like = $(e).children(".is_like_hidden").val();
      $.ajax({
         url: "{{ route('front.feeds.feed_like') }}",
         type: 'post',
         dataType: 'json',
         data: {"_token": "{{ csrf_token() }}",'feed_id':feed_id,'is_like':is_like,'type':type,'reply_id':reply_id},
         success: function(response) {
            $(e).parents().find('.commentCountSection'+feed_id).show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').find('.feedSelfLike').text(response.likeCount);
            // $(e).find('.feedSelfLike').text(response.likeCount);
            $(e).next('.feedSelfLike').text(response.likeCount);
            $(e).parents().find('.commentCountSectionHr'+feed_id).show();
            if(response.status ==1) {
               var img = '<?=  asset("front/images/pop_icons/like_icon.png") ?>';
               $(e).children(".is_Like_Icon").show();
               $(e).children(".is_Un_Like_Icon").hide();
               $(e).children(".is_like_hidden").val(0);
               
               // $(e).children("img").attr('src',img);
               // $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',0,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>'+response.likeCount+'</span></a>');
               //   toastr.success(response.message)
            } else if(response.status == 2){
               $('#popMemberContinue').html(response.view);
               $('#popMemberContinue').modal('show');  
            }else {
               var img = '<?=  asset("front/images/pop_icons/7.png") ?>';
               $(e).children(".is_Un_Like_Icon").show();
               $(e).children(".is_Like_Icon").hide();
               $(e).children(".is_like_hidden").val(1);
               
               // $(e).children("img").attr('src',img);
               // $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',1,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>'+response.likeCount+'</span></a>');
               // toastr.success(response.message)
            }
         }
      });
   }
   
   
   function commentSubmit(e,key) {
      if($('#is_user_login').val() == ''){
         likeFeed('','','','','','');
         return false;
      }
   $.ajax({
    url: "{{ route('front.feeds.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      $(e)[0].reset();
      toastr.success(data.response);
       $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
       $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
      $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
   }
   }
   });
   }
   
   
   function replyBox(e) {
   $(e).parent().parent().find('.reply-input-box').toggle();
   }
   
   function replySubmit(e,key) {
   $.ajax({
    url: "{{ route('front.feeds.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      toastr.success(data.response);
      $(e)[0].reset();
       $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
         $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
         $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
         }
      }
   });
   }
   
   function subReplySubmit(e,key) {
   $.ajax({
    url: "{{ route('front.feeds.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: $(e).serialize(),
    success: function(data) {
       if(data.success ==0) {
        var err = JSON.parse(data.response);
        var er = '';
        $.each(err, function(k, v) { 
           er += v+'<br>'; 
        }); 
        toastr.error(er);
     } else {
      toastr.success(data.response);
      $(e)[0].reset();
         $('#feed-main-box'+data.feed_id).find('.commentCount').html('');
         $('#feed-main-box'+data.feed_id).find('.commentCount').html(data.feed_count);
       
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html('');
          $('#feed-main-box'+data.feed_id).find('.feedcomments').html(data.view);
         }
      }
   });
   }
   
   function subReplyBox(e,key) {
   $('#sub-reply-box'+key).toggle();
   }
   
   
   function comman_feed_like(e,comment_id,feed_id,reply_id,type) {
   // alert(comment_id);
     $.ajax({
    url: "{{ route('front.feeds.feed_comment_like') }}",
    type: 'post',
    dataType: 'json',
    data: {"_token": "{{ csrf_token() }}",'comment_id':comment_id,'feed_id':feed_id,'reply_id':reply_id,'type':type},
    success: function(data) {
      if(data.success ==0) {
         //  toastr.error(data.response);
         $('#popMemberContinue').html(data.view);
         $('#popMemberContinue').modal('show');  
      } else {
            if(data.like_type == 1) {
               var source = "{{asset('front/images/pop_icons/like_icon.png')}}";
               $(e).children(".is_Like_Icon").show();
               $(e).children(".is_Un_Like_Icon").hide();
               
               $(e).children('img').attr('src',source);
               $(e).next('.replyLikesCount').text(data.totalCount);
            } else {
               var source = "{{asset('front/images/pop_icons/7.png')}}";
               $(e).children(".is_Un_Like_Icon").show();
               $(e).children(".is_Like_Icon").hide();

               $(e).children('img').attr('src',source);
               $(e).next('.replyLikesCount').text(data.totalCount);
            }
         //  toastr.success(data.response);
      }
   }
   });
   }
   
   
   function feedPreferenceModel() {
   $.ajax({
   url: "{{ route('front.feeds.feed_preference') }}",
   type: 'post',
   dataType: 'json',
   data: {"_token": "{{ csrf_token() }}"},
   success: function(response) {
     $('#DefaultModal').modal('show');
     $('#DefaultModal .modal-dialog').addClass('modal-lg');
     $('#DefaultModal .modal-content').html(response.view);
   }
   });
   }
   
   function moreRoleNav(e) {
   var lavelExpand = $(e).text();
   if(lavelExpand == 'Expand >>') {
     $(e).text('Collapse >>');
   } else {
     $(e).text('Expand >>');
   }
   $(".moreRoleNav").toggleClass("showNavPreference");
   
   }
   
   function moreCategoryNav(e) {
   var lavelExpand = $(e).text();
   if(lavelExpand == 'Expand >>') {
     $(e).text('Collapse >>');
   } else {
     $(e).text('Expand >>');
   }
   $(".moreCategoryNav").toggleClass("showNavPreference");
   
   }
   
   function prefereceForm(e) {
   $.ajax({
    url: "{{ route('front.feeds.feed_preference_search') }}",
    type: 'post',
    data: $('#feedPrefenceForm').serialize(),
    dataType: 'json',
    success: function(response) {
      if(response.status == 1){
         location.reload();
         return false;
         $('#DefaultModal').modal('hide');
         $('.MiddleColumnSection').html(response.view);
      }
     }
   });
   }
   
   
   
   function replyInputshow(e,id) {
   $(e).parents().find('.media-body').find('.commentReplyInput'+id).show();
   var x =$(e).parents().find('.media-body').find('.commentReplyInput'+id).find('.writeReply'+id).focus();
   }
   
   function commentToggle(e) {
   $(e).parent().parent().parent().parent().find('.feedcomments').toggle();
   }
   function viewAllReply(e) {
   $(e).parent().find('.hidViewAllComment').val(1);
   $(e).parent().find('.feedCommentMainBox').show();
   $(e).remove();
   }
   
   function feedActiveComment(e,id) {
      // if($('#is_user_login').val() == ''){
      //    likeFeed('','','','','','');
      //    return false;
      // }
      $('#showComment_'+id).toggleClass('comment_show');
      $(e).parents().find('.mainCommentActive').find('.commentWrite'+id).focus();
   }
   
   function share_post(e,id,feed_url){
      if($('#share-btn'+id).hasClass('is_show')){
         $('#share-btn'+id).removeClass('is_show');
         $('#share-btn'+id).show();
         $('#share-btn'+id+' div.st-btn').show();

         // var url = 'https://graph.facebook.com/v12.0/?scrape=true&id='+feed_url+'access_token=EAAF4ZBilMxJQBAFukX8GWwmavmVExrxj1Hjckf0S13SNZCmRqk5hzuWZBLmJMj870TvrvGc2r6ETclxhIpIq2gfOBabLBNKa5ITMZBQ0CnQdP92ZAHLSD9dFeZCiJG019CVZBxTRbP4ApPvz9BFy4z11nQUph3KtyB50e4ZCPAro64ClkpoGhd2nT20MfG3bHNro3qI0driZAQAZDZD';
         // $.ajax({
         //    type:'POST',
         //    url: url,
         //    success: function(data){
         //       console.log(data);
         //    }
         // });
         // console.log(url);
      }else{
         $('#share-btn'+id).addClass('is_show');
         $('#share-btn'+id).hide();
         $('#share-btn'+id+' div.st-btn').hide();
      }
      
      
   }
   
   function replyInputshow1(e,id) {
    $(e).parents().find('.media-body').find('.commentReplyInput1'+id).show();
   var x =$(e).parents().find('.media-body').find('.commentReplyInput1'+id).find('.writeReply'+id).focus();
   }

   function checkQuiz(val,id){
      var checkValue  = $(val).find('input').val();
      var str_background_color_new;
      //alert(checkValue);
      //   var int_which_is_lie = document.getElementById("which_is_lie"+id).value; 
        var int_which_is_lie = $("#which_is_lie"+id).val(); 
      
         document.getElementById("div-id-select-lie"+id).style.display ="none";
        document.getElementById("div-id-select-truth"+id).style.display ="none";
      
      document.getElementById("question_id").value = checkValue;
      
      if(int_which_is_lie == checkValue)
      {
          str_background_color_new = 'quizBgGreen';
      //   document.getElementById("div-id-select-lie"+id).style.display ="block";
        $("#div-id-select-lie"+id).show();
      }
      else
      {
         str_background_color_new = 'quizBgRed';
            //   document.getElementById("div-id-select-truth"+id).style.display ="block";         
              $("#div-id-select-truth"+id).show();         
      }
      
      $( "#mainDivId_"+(checkValue+id) + " #childDivId_"+(checkValue+id)  ).addClass( str_background_color_new );
   
     
    }
   
   
   // Event Form
   // $(document).on('click', '#submitQuiz', function (e) {
   //    e.preventDefault();
      
   // });

   function quiz_play(e){
      $('.playBtnQuiz1').find('.st_loader').show();
      var fd = $(e).serialize(); 
      $.ajax({
         url: "{{ route('front.feeds.feed_truth_data') }}",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         data: $(e).serialize(),
         dataType: 'json',
         type: 'POST',
         beforeSend: function () {
            $('#submitQuiz').attr('disabled', true);
            // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
         },
         error: function (jqXHR, exception) {
            $('#submitQuiz').attr('disabled', false);
            $('.playBtnQuiz1').children('.st_loader').hide();
            var msg = formatErrorMessage(jqXHR, exception);
            toastr.error(msg)
            console.log(msg);
            // $('.message_box').html(msg).removeClass('hide');
         },
         success: function (data) {
            if(data.status == 1){
               $('#submitQuiz').attr('disabled', false);
               $('.QuizBox').html(data.view);
            }else if(data.status == 2){
               $('#submitQuiz').attr('disabled', false);
               $('.quizPlay').html(data.view);
            }else if(data.status == 0){
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal('show');  
            }
            $('.playBtnQuiz1').children('.st_loader').hide();
            //toastr.success("Quiz Saved Successfully.");
            // window.location.replace('{{ route("front.pages.quiz.detail")}}');
         }
      });
   }

   function videoPopup(e,youtube_id){
      $('.PreLoader').show();
      var video_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      $('#iframe_data').attr('src','https://www.youtube.com/embed/'+youtube_id);
      video_data += $('#youtubeURL').html(); 
      $('#DefaultModal').addClass('showYouTubeVideo');     
      $('#DefaultModal .modal-content').html(video_data);
      setTimeout(function(){         
         $('#DefaultModal').modal({backdrop: 'static', keyboard: false}); 
         $('.PreLoader').hide();
      },1000);
   }

   function imagePopup(e){
      var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      img_data += $(e).html();
      $('#DefaultModal').removeClass('showYouTubeVideo'); 
      $('#DefaultModal .modal-content').html(img_data);
      $('#DefaultModal').modal('show');
   }

   var main_gallery_url_new = "{{ url('feeds') }}"; 
   var create_gallery_url_new = "{{ url('all/image-gallery/create') }}"; 
   var delete_gallery_url_new = "{{ url('all/image-gallery/delete') }}";
   var gallery_data_saved_flag = '';
   
   function openEditGalleryModal(id,type) {
      $('.st_gallery_loading').show();
     $.ajax({
        url: "{{ route('front.gallery.images.edit_modal_list')}}",
       data: {
        "_token": "{{ csrf_token() }}",
      'id':id,'file_type':'edit','type':type,
        },
        dataType: 'json',
        type: 'POST',
        success: function (data) {
         var modal_gallery_form = '#ModalGalleryVideoForm';
            $(modal_gallery_form).show();
             $('#ModalGalleryVideoForm .modal-content').html(data.view);
            $(modal_gallery_form).css('display', 'block');
            $(modal_gallery_form).modal({ show: true });
            $('#DefaultModal').modal('hide');        
            $('.st_gallery_loading').hide();            
        }
     });
   }
   
   function feedAction(id,type,div_id) {
      var err = 0;
      if(type == 'remove' || type == 'delete'){
         if(confirm('Are you sure you want to '+type+' this feed?')){
            var err = 0
         }else{
            var err = 1;
         }
      }
      if(err == 0){
         $.ajax({
            url: "{{ route('front.feeds.feed_action_type')}}",
            data: {
            "_token": "{{ csrf_token() }}",
            'id':id,'action_type':type
            },
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                  if(data.status == 1){
                     toastr.success(data.msg);
                     $('#'+div_id).remove();
                  }else if(data.status == 2){
                     $('#DefaultModal .modal-content').html(data.view);
                     $('#DefaultModal').modal('show');        
                  }    
            }
         });
      }
   }

   function show_more(e){
      $(e).parent().toggleClass('four-line-text');
      
      if($(e).parent().hasClass("four-line-text")){
         $(e).text('More');
      }else{
         $(e).text('Less');
      }

      // if($('.pContents').not("four-line-text")){
      //    $('.pContents').addClass("four-line-text");
      //    $('.readMore').text('More');
      // }
      // if($(e).text() != 'Less'){
      //    $(e).parent().toggleClass('four-line-text');
      // }
      
      // if($(e).parent().hasClass("four-line-text")){
      //    $(e).text('More');
      // }else{
      //    $(e).text('Less');
      // }
      
   }

   function copySharingUrl(url) {
     var $temp = $("<input>");
     $("body").append($temp);
     $temp.val(url).select();
     document.execCommand("copy");
     $temp.remove();
     toastr.success('Copied to Clipboard Successfully');
   }

   function editFeedtype(view_type,feed_id) {
      var page_type = $('#page_type').val();
      $('.PreLoader').show();
      $.ajax({
         url: "{{ route('front.feeds.feed_type') }}",
         type: 'get',
         dataType: 'json',
         data: {view_type:view_type,page_type:page_type,feed_id:feed_id,type:'feed_edit'},
         success: function(data) {
            $('.PreLoader').hide();
            if(data.status == 1){
            $('#DefaultModal').html(data.view);
            $('#DefaultModal').addClass('popFeedPosts');
            $('#DefaultModal').modal({backdrop: 'static', keyboard: false});  
            // $(".Preloader").fadeOut("slow");
            
            $('li').removeClass('list_active');
            if(view_type == 1){
               $('.viewRed').parent().addClass('list_active');
            }else if(view_type == 2){
               $('.viewOrange').parent().addClass('list_active');
            }else if(view_type == 4){
               $('.viewYellow').parent().addClass('list_active');
            }else if(view_type == 5){
               $('.viewGreen').parent().addClass('list_active');
            }
            }else if(data.status == 0){
            $('#popMemberContinue').html(data.view);
            $('#popMemberContinue').modal('show');  
            toastr.warning(data.msg,'Warning');
            }else if(data.status == 2){
            $('.startPostInput').blur();
            $('#popMemberContinue').html(data.view);
            $('#popMemberContinue').modal('show');  
            }
         }
      });
   }

   function feed_like_user(feed_id) {
   // alert(comment_id);
      $.ajax({
         url: "{{ route('front.feeds.feed_comment_like_user') }}",
         type: 'post',
         dataType: 'json',
         data: {"_token": "{{ csrf_token() }}",'feed_id':feed_id,'like_type':'feed_like'},
         success: function(data) {
            if(data.status == 1) {
               var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
               img_data += data.view;
               $('#DefaultModal').removeClass('showYouTubeVideo'); 
               $('#DefaultModal .modal-content').html(img_data);
               $('#DefaultModal').modal('show');
               
            } 
         }
      });
   }

   function comment_feed_like_user(e,comment_id,feed_id,reply_id,type) {
   // alert(comment_id);
      $.ajax({
         url: "{{ route('front.feeds.feed_comment_like_user') }}",
         type: 'post',
         dataType: 'json',
         data: {"_token": "{{ csrf_token() }}",'comment_id':comment_id,'feed_id':feed_id,'reply_id':reply_id,'type':type},
         success: function(data) {
            if(data.status == 1) {
               var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
               img_data += data.view;
               $('#DefaultModal').removeClass('showYouTubeVideo'); 
               $('#DefaultModal .modal-content').html(img_data);
               $('#DefaultModal').modal('show');
               
            } 
         }
      });
   }

   function textAreaAdjust(element) {
      element.style.height = "1px";
      element.style.height = (16+element.scrollHeight)+"px";
   }
   
</script>
@endsection