@extends('front.layouts.pages')
@section('content')

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop' async='async'></script>
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
</style>
<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="popFeedBlogs">
      <div class="YTtopContant text-center">
         <img src="{{ asset('front/images/news_feeds_banner.png') }}" alt="WelcomeToPOPWeekHeader" class="img-fluid w-100">
      </div>
      <div class="popStartPosts w-100 pt-4 pb-3 border-bottom">                  
         <div class="popNewsPosts w-100">
            <div class="popNewsFeed">
               <div class="row">
                  <div class="col-md-6">
                     <div class="popNewsImg">
                        @if(!empty(@$featured_news_feeds->image))
                           <img src="{{ asset('uploads/images/feed/'.@$featured_news_feeds->image) }}" class="img-fluid">
                        @elseif(!empty(@$featured_news_feeds->video_url))
                           @php
                              preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$featured_news_feeds->video_url, $match);
                              $str_og_image_new = 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg';
                           @endphp
                           <img src="{{ $str_og_image_new }}" class="img-fluid">
                        @else
                           <img src="{{ asset('front/new/images/Product/team_new.png') }}" class="img-fluid">
                        @endif
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="popNewsContent">
                        <h3 class="">{{@$featured_news_feeds->title}}</h3>
                        <div class="newsDesc @if(strlen(strip_tags(@$featured_news_feeds->caption)) > 500){{ 'four-line-text' }} @endif">
                           <p>{{ substr(@$featured_news_feeds->caption, 0, 500).'...' }} </p>
                           @if(!empty(@$featured_news_feeds->url))
                              <a href="{{ @$featured_news_feeds->url }}" class="" target="blank">more...</a>
                           @else
                              {{--
                              @if(strlen(strip_tags(@$featured_news_feeds->caption)) > 500)
                                 <a href="javascript:void(0);" class="" onclick="show_more_feature(this); return false;">more...</a>
                              @endif
                              --}}
                           @endif
                           
                        </div>
                        <div class="newsLinks">
                           @if(!empty(@$featured_news_feeds->url))
                              <a href="{{ @$featured_news_feeds->url }}" class="one-line-text">{{ @$featured_news_feeds->url }}</a>
                           @endif
                           @if(!empty(@$featured_news_feeds->video_url))
                              <a href="{{ @$featured_news_feeds->video_url }}" class="one-line-text mt-1">{{ @$featured_news_feeds->video_url }}</a> 
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="newsNames pt-4">
               <form  id="newsFeedsForm">
                  <div class="NewsGames py-3">
                     <div>
                        <p>Toy & Game Industry News Courtesy of <a href="javascript:void(0)">The Bloom Report</a></p>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      @php 
         $sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
         $str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;
         $str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
         $i = $offset_i; $k = 0;

         $str_user_name = '';
         $str_user_url_new = '#';
         $str_profile_image = '';
         if(!empty($question_detail[0]->user_id)){ 
               @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
               @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
               @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
         }        
            $cdata=array();    
      @endphp 
      <div class="allPostHere w-100 clearfix mb-4">
         @foreach ($feeds as $key => $feed)
            @php
               $feed_id = $feed['id']; 
               $i = 0;
               $cat_url = 'javascript:void(0)';
               
               if($feed['type'] == 1){
                  $category = 'IMAGE';
               }elseif($feed['type'] == 2){
                  $category = 'VIDEO';
               }elseif($feed['type'] == 3){
                  $category = 'BLOG';
               }elseif($feed['type'] == 4){
                  if($feed['check_post'] == '3'){
                     $category = 'WIKI';
                  }elseif($feed['check_post'] == '4'){
                     $category = 'ENTERTAINMENT';
                  }elseif($feed['check_post'] == '5'){
                     $category = 'CAST';
                  }else{
                     $category = 'MEDIA-MENTION';
                  }
               }elseif($feed['type'] == 5){
                  $category = 'PRODUCT';
               }elseif($feed['type'] == 6){
                  $category = 'CLASSIFIED';
               }
            @endphp
            <div class="popFeedPost w-100 py-4 border-top {{$i}}" id="feed-main-box{{ $feed['id'] }}">
            <?php     
               $c_date = date('Y-m-d',strtotime($feed['created_at']));
               if(!in_array($c_date,$cdata)){
                  $cdata[]=$c_date;
                  @App\Helpers\UtilitiesFour::getDateCheck($c_date);
               }
            ?>
            <input type="hidden" class="i_position" value="{{$i}}">
            <div class="feedCategory d-flex pb-3">
               <h6><span>{{$feed['category_name']}}</span></h6>

               <div class="nav-item dropdown" >
                  <a class="" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                  <div class="dropdown-menu DropDownMenuMob">
                     <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'report_from_show',`feed-main-box{{ $feed['id'] }}`); return false;">Report</a>
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
                                       <a href="{{ url($cat_url) }}" class="readMore">Click to article</a>
                                    @else
                                       <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                                    @endif
                                 @endif
                              </div>
                           </div>
                        @endif
                     </div>
                  @endif
               </div>
            </div>
            
            @if($feed['type'] != 6)
               @if(($feed['video_url'] != '' || $feed['url'] != '' || $feed['image'] != ''))
                  <div class="feedVidImg w-100 mt-3 {{$feed['type']}}">
                     @if(!empty($feed['video_url']))
                        <?php 
                           preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                           // @App\Helpers\UtilitiesFour::uploadYoutTubeThumbnail(@$match[1]);
                        ?>
                        <a href="javascript:void(0)" class="popYouVideo" onclick="videoPopup(this,`{{@$match[1]}}`); return false;">
                           <img src="{{ url('/uploads/images/youtube_video/'.@$match[1].'.jpg') }}" alt="No Image Found" class="img-fluid">
                           <img src="{{ url('/uploads/images/youtube_video/youtube_black.svg') }}" alt="No Image Found" class="img-fluid youTubePlay hoverHide">
                           <img src="{{ url('/uploads/images/youtube_video/youtube_red.svg') }}" alt="No Image Found" class="img-fluid youTubePlay hoverShow">
                           <!-- <i class="fa fa-youtube-play" aria-hidden="true"></i> -->
                        </a>
                     @else
                        @if($feed['image'] != '')
                           <a href="javascript:void(0)" onclick="imagePopup(this); return false;">
                              @if(($feed['type'] == 3) && $feed['check_post'] == 0))
                                 <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                              @else
                                 <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                              @endif
                           </a>
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
               @else
                  <hr>
               @endif
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
                     <a class="nav-link" href="{{ url('company/'.$company->slug) }}"><?= '@'.$company->first_name .$company->last_name?></a>
                  </li>
                  @endforeach
                  <?php } ?>
                  <?php  $product_id =explode(',',$feed['tag_products']); 
                     if(!empty($product_id) && count($product_id)>0) {
                     $products = DB::table('products')->select('products.id','products.name','products.slug')->whereIn('id',$product_id)->get()->toArray();   ?>
                  @foreach ($products as $product)
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('product/'.$product->slug) }}"><?= '@'.$product->name?></a>
                  </li>
                  @endforeach
                  <?php } ?>
                  <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                     if(!empty($peoples_id) && count($peoples_id)>0) {
                     $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',2)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                  @foreach ($peoples as $people)
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('people/'.$people->slug) }}"><?= '@'.$people->first_name .$people->last_name?></a>
                  </li>
                  @endforeach
                  <?php } ?>
                  </ul>
               </div>
               <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
                  <hr class="mb-0">
                  @php @$ProfOptsComments = 'display:none'; @endphp
                  @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id'],'news_feeds') >0)
                  @php @$ProfOptsComments = ''; @endphp
                  @endif
                  
                  <hr class="my-0 commentCountSectionHr{{ @$feed['id'] }}" style="{{ @$ProfOptsComments }}">
                  
                  <ul class="list-unstyled likeLists m-0">
                     <?php 
                     $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'news_feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                     
                     if($addLikeFeed) {
                        $is_like = 0;
                        $img_pop_icon_0 = asset('front/images/pop_icons/like_icon.png');
                     } else {
                        $is_like = 1;
                        $img_pop_icon_1 =  asset('front/images/pop_icons/7.png');
                     }
                     ?>
                     <li>
                     <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'<?= $feed['id'] ?>','<?= $is_like ?>','comment',0)">
                        <input type="hidden" class="is_like_hidden" value="<?= $is_like ?>">
                        
                        <img src="{{ asset('front/images/pop_icons/like_icon.png') }}" alt="ProfImg" class="img-fluid like_Icon is_Like_Icon" <?php if($is_like == 1){ echo "style='display:none'"; } ?>>
                        <img src="{{ asset('front/images/pop_icons/7.png') }}" alt="ProfImg" class="img-fluid like_Icon is_Un_Like_Icon" <?php if($is_like == 0){ echo "style='display:none'"; } ?>>
                        <span class="feedSelfLike">{{ @App\Helpers\Utilities::feedCommentLikeCount($feed['id'],'comment','0','news_feeds') }}</span>
                     </a>
                     </li>
                     <li>
                     <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')">
                        <img src="{{ asset('front/images/pop_icons/6.png') }}" class="igm-fluid">
                        <span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed['id'],'news_feeds')}}</span>
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
                              <li><a href="javascript:void(0);" onclick="return copySharingUrl(`{{ url('news_feed/'.$feed_id) }}`);"><i class="fa photo_icon fa-clone"></i></a>
                              </li>
                              <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{ url('news_feed/'.$feed_id) }}" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-facebook"></i></a>
                              </li>
                              <li><a target="_blank" href="http://twitter.com/share?url={{ url('news_feed/'.$feed_id) }}" data-share-link="{{ url('news_feed/'.$feed_id) }}" data-url="{{ url('news_feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif""><i class="fa photo_icon fa-twitter"></i></a>
                              </li>
                              <li><a target="_blank" href="https://wa.me/?text={{ url('news_feed/'.$feed_id) }}"  data-share-link="{{ url('news_feed/'.$feed_id) }}" data-url="{{ url('news_feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-whatsapp"></i></a>
                              </li>
                              <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url('news_feed/'.$feed_id) }}"  data-share-link="{{ url('news_feed/'.$feed_id) }}" data-url="{{ url('news_feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"><i class="fa photo_icon fa-linkedin" aria-hidden="true"></i></a>
                              </li>
                              </ul>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>               
               {{--
               <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
                  <div class="sharethis-inline-share-buttons" data-url="{{ url('news_feed/'.$feed_id) }}" data-title="{{$feed['title']}}" data-description="{{$feed['caption']}}" data-image="@if(!empty($feed['image'])){{ asset('/uploads/images/feed/'.$feed['image']) }}@elseif(!empty($feed['video_url'])){{ 'https://img.youtube.com/vi/'.@$match[1].'/mqdefault.jpg' }}@endif"></div>
               </div>
               --}}
               <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
                  <hr class="mt-0">
                  @include('front.feeds_news.feed_comment_view')
               </div>
            @endif
         </div>
         @endforeach
      </div>
   </div>
   <div class="col-md-12 text-center">
      <a href="{{ url('news-feeds') }}" class="btn btn-primary w-100"> Show More News Feeds</a>
   </div>
</div>

<div class="col-md-3 col-lg-3 rightSideSection">
   <div class="popFeedSidebar">
      @php $feed_id = @$feeds[0]['id']; @endphp
      <div class="popFeedPost w-100 py-4 border-bottom d-none d-lg-block mb-4 {{$i}}" id="feed-main-box{{$feed_id}}">
         <input type="hidden" class="i_position" value="{{$i}}">
         <div class="feedCategory d-flex pb-2">
            <h6><span><b>MEME OF THE DAY</b></span></h6>
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
      <div class="OptionalAd OptionalAd1 text-center mb-4">
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

<div id="youtubeURL" style="display:none;"><iframe id="iframe_data" width="100%" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>


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

      $('.daterangepicker .applyBtn').click(function(){
         $('#is_date_select').val('1');
      });
   });
   
   var newsletter_flag = '{{ Session::has("newsletter_flag") }}';
   function eventSaveMessage(){
    if(newsletter_flag =="1" || newsletter_flag ==1)
    {
   
      toastr.success("Newsletter Subscriptions updated successfully.");
   }
   
   }
   window.onload = eventSaveMessage;
   
   
   
   function likeFeed(e,feed_id,is_like,type,reply_id) {
      var is_like = $(e).children(".is_like_hidden").val();
      var page_type = $('#page_type').val();
      $.ajax({
         url: "{{ route('front.feeds_news.feed_like') }}",
         type: 'post',
         dataType: 'json',
         data: {"_token": "{{ csrf_token() }}",'feed_id':feed_id,'is_like':is_like,'type':type,'reply_id':reply_id,page_type:page_type},
         success: function(response) {
            $(e).parents().find('.commentCountSection'+feed_id).show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').show();
            $(e).parents().find('.commentCountSection'+feed_id).find('a').find('.feedSelfLike').text(response.likeCount);
            $(e).find('.feedSelfLike').text(response.likeCount);
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
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');

   $.ajax({
    url: "{{ route('front.feeds_news.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
         $('#showComment_'+data.feed_id).html('');
         $('#showComment_'+data.feed_id).html(data.view);
      }
   }
   });
   }
   
   
   function replyBox(e) {
   $(e).parent().parent().find('.reply-input-box').toggle();
   }
   
   function replySubmit(e,key) {
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');
   $.ajax({
    url: "{{ route('front.feeds_news.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
            $('#showComment_'+data.feed_id).html('');
            $('#showComment_'+data.feed_id).html(data.view);
         }
      }
   });
   }
   
   function subReplySubmit(e,key) {
   var fd = new FormData($(e)[0]);
   fd.append("page_type",'news_feeds');
   $.ajax({
    url: "{{ route('front.feeds_news.feed_comment') }}",
    type: 'post',
    dataType: 'json',
    data: fd,
    processData: false,
    contentType: false,
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
            $('#showComment_'+data.feed_id).html('');
            $('#showComment_'+data.feed_id).html(data.view);
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
    url: "{{ route('front.feeds_news.feed_comment_like') }}",
    type: 'post',
    dataType: 'json',
    data: {"_token": "{{ csrf_token() }}",'comment_id':comment_id,'feed_id':feed_id,'reply_id':reply_id,'type':type,page_type:'news_feeds'},
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
               $(e).children('.replyLikesCount').text(data.totalCount);
            } else {
               var source = "{{asset('front/images/pop_icons/7.png')}}";
               $(e).children(".is_Un_Like_Icon").show();
               $(e).children(".is_Like_Icon").hide();

               $(e).children('img').attr('src',source);
               $(e).children('.replyLikesCount').text(data.totalCount);
            }
         //  toastr.success(data.response);
      }
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

         var url = 'https://graph.facebook.com/v12.0/?scrape=true&id='+feed_url+'access_token=EAAF4ZBilMxJQBAFukX8GWwmavmVExrxj1Hjckf0S13SNZCmRqk5hzuWZBLmJMj870TvrvGc2r6ETclxhIpIq2gfOBabLBNKa5ITMZBQ0CnQdP92ZAHLSD9dFeZCiJG019CVZBxTRbP4ApPvz9BFy4z11nQUph3KtyB50e4ZCPAro64ClkpoGhd2nT20MfG3bHNro3qI0driZAQAZDZD';
         $.ajax({
            type:'POST',
            url: url,
            success: function(data){
               console.log(data);
            }
         });
         console.log(url);
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

   function videoPopup(e,youtube_id){
      $('.PreLoader').show();
      var video_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>';
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
      var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>';
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

   function show_more_feature(e){
      $(e).parent().toggleClass('newsDescMore');
      
      if($(e).parent().hasClass("newsDescMore")){
         $(e).text('less');
      }else{
         $(e).text('more');
      }      
   }

   function newsFeedsFiterFormSubmit(){
      var form_ser = $('#newsFeedsForm')[0];
      var formData = new FormData(form_ser);
      $.ajax({
         url:"{{ route('front.feeds_news.news_feeds_filter') }}",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         type:"POST",
         data: formData,
         processData: false,
         contentType: false,
         dataType:'json',
         success:function(data){
            if(data.status == 1){
               if(data.cnt_feeds != 0){
                  $('.filterDiv').html(data.view);
               }else{
                  toastr.warning('News feeds not present on filter criteria','Warning');
               }
            }
         }
      });
   }

   function submit_news_feeds_form(e){
      $.ajax({
         url:"{{ route('front.feeds_news.submit_news_feeds_form') }}",
         headers: {
            'X-CSRF-TOKEN': ajax_csrf_token_new
         },
         type:"POST",
         data: {},
         dataType:'json',
         success:function(data){
            if(data.status == 1){
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal({backdrop: 'static', keyboard: false}); 
            }else{
               $('#popMemberContinue').html(data.view);
               $('#popMemberContinue').modal('show'); 
            }
         }
      });
   }

   function newsFeedFormSubmit(e) { 
    $('.postLoading').show();
    var post_type = $('#feedType').val();
   //  alert(post_type);
   //  return false;
    if(post_type == 1 || post_type == 4){
      var crp_img = crop_upload_image(e);      
    }else{
        newsFeedFormSubmit_2(e);
    }
  }

  function newsFeedFormSubmit_2(e) { 

    $('.postLoading').show();
    $('.btn-style-post').attr('disabled',true);
   var fd = new FormData($(e)[0]);
   var submit_post_val = $('#submit_Post').val();
   fd.append("_token","{{ csrf_token() }}");
   fd.append("submit_post_val",submit_post_val);
   $.ajax({
    url: "{{ route('front.feeds_news.save') }}",
    data: fd,
    processData: false,
    contentType: false,
    dataType: 'json',
    type: 'POST',
    beforeSend: function()
    {
          // $('#btnfeed').attr('disabled',true);
          // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
        },
        error: function(jqXHR, exception){
          $('.postLoading').hide();
          // $('#btnfeed').attr('disabled',false);
          $('.btn-style-post').attr('disabled',false);
          console.log(jqXHR);
          var msg = formatErrorMessage(jqXHR, exception);
          toastr.error(msg)
          console.log(msg);
          // $('.message_box').html(msg).removeClass('hide');
        },
        success: function (data)
        {
          if(data.success == 0){
              var err = JSON.parse(data.response);
              var er = '';
              $.each(err, function(k, v) { 
                  er += v+'<br>'; 
                  $("[name="+k+"]").parent().addClass('errCount');
                  $("[name="+k+"]").next().html(v);
                  $("[name="+k+"]").next().show();

                  if(k == 'product_id' || k == 'video_url'){
                    $('.error-demo').addClass('errCount');
                    $('.error-demo .errText').show();
                  }
                  // console.log('key - '+k+' - err - '+er);
              }); 
              
              // toastr.error(er,'Error');
              $('.postLoading').hide();
              $('.btn-style-post').attr('disabled',false);
          }else{
            $('.postLoading').hide();
            toastr.success(data.message)
            window.location.replace('{{ route("front.feeds_news.news-feeds")}}');
          }

        }
      });
 }

function newsFeedtype(view_type) {
  var page_type = $('#page_type').val();
  $('.PreLoader').show();
  $.ajax({
    url: "{{ route('front.feeds_news.feed_type') }}",
    type: 'get',
    dataType: 'json',
    data: {view_type:view_type,page_type:page_type},
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

function editNewsFeedtype(view_type,feed_id) {
  var page_type = $('#page_type').val();
  $('.PreLoader').show();
  $.ajax({
    url: "{{ route('front.feeds_news.feed_type') }}",
    type: 'get',
    dataType: 'json',
    data: {view_type:view_type,page_type:page_type,news_feed_id:feed_id,type:'news_feed_edit'},
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
            url: "{{ route('front.feeds_news.news_feed_action_type')}}",
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

   function copySharingUrl(url) {
     var $temp = $("<input>");
     $("body").append($temp);
     $temp.val(url).select();
     document.execCommand("copy");
     $temp.remove();
     toastr.success('Copied to Clipboard Successfully');
   }

   function textAreaAdjust(element) {
      element.style.height = "1px";
      element.style.height = (16+element.scrollHeight)+"px";
   }

</script>
@endsection
