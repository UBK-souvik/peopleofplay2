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
@endphp 
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

   @if(($i < 1 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=1; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif
   @if(($i < 6 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=6; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif
   @if(($i < 10 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=10; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif
   @if(($i < 13 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=13; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif
   @if(($i < 15 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=15; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif
   @if(($i < 17 && $k == 0) && ($feeds_cnt <= $i))
      @php $i=17; @endphp
      @include('front.feeds.side_bar_content_feed')
   @endif