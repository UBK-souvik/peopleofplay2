@extends('front.layouts.pages')
@section('style_new')
   <link rel="stylesheet" href="{{ asset('front/new_css/feeds.css?'.time()) }}">
   <link rel="stylesheet" href="{{ asset('front/new_css/pop-classifieds.css?'.time()) }}">
   <link rel="stylesheet" href="{{ asset('front/new_css/quiz.css?'.time()) }}">
   
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
@endsection
@section('content')

<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="PopFeeds">
      <div class="feed">
         <div class="top-banner bg-box-shadow text-center">
            <h3>Welcome to People of Play</h3>
            <h6>YOUR PREMIER PLAY RESOURCE</h6>
            <p> Feel the Community and Network like never before with: 
               our Events, POPpedia, Dictionary, Classifieds, 
               and the brand new POP Feed.
            </p>
            <a href="javascript:void(0)" type="button" onclick="feedPreferenceModel();" >Set your Interests for your Feed</a>
            <input type="hidden" name="offset" id="offSet" value="1">
            <input type="hidden" name="no_user_offset" id="no_user_offset" value="{{$no_User_Offset}}">
            <input type="hidden" name="load_status" id="loadStatus" value="active">
         </div>
         @php 
            $sidebarData =\App\Helpers\Utilities::sidebarHomeNew();
            $str_home_product_page_url_new = url('/') . '/product/'. @$home_product_data->slug;
            $str_home_advertisement_data_destination_link = @$home_advertisement_data->destination_link;
            $i = $offset_i;
            
            $feeds_cnt = ltrim((count($countFeeds) - count($newfeeds3)),'-');

            $str_user_name = '';
            $str_user_url_new = '#';
            $str_profile_image = '';
            if(!empty($question_detail[0]->user_id)){ 
               @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
               @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
               @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
            }
         @endphp 
         @if(count($feeds) > 0)
            @foreach ($feeds as $key => $feed)
               @php 
               if($feed['pop_feed_position'] == 1 || $feed['pop_feed_position'] == 2 || $feed['pop_feed_position'] == 3 || $feed['pop_feed_position'] == 4 || $feed['pop_feed_position'] == 5 || $feed['pop_feed_position'] == 6){
                  continue;
               }
               $i++; 
               @endphp
               @if($i == 1 || $i == 6 || $i == 10 || $i == 13 || $i == 15 || $i == 17)
                  @include('front.feeds.side_bar_content_feed')
               @endif
               <div class="feed-main-box mb-3 {{$i}}" id="feed-main-box{{ $feed['id'] }}">
                  <input type="hidden" class="i_position" value="{{$i}}">
                  <div class="feed-box bg-box-shadow">
                     <div class="w-100 clearfix feed-profile d-flex ">
                        <div class="profile-img w-50">
                           <a href="javascript:void(0)">
                              <div class="d-flex align-items-center">
                                 <div class="prof-image mr-2">
                                    @if($feed['type'] != 0)
                                    <img src="{{@imageBasePath(@$feed['profile_image'])}}" alt="profileimage" class="img-fluid rounded-circle">
                                    @else
                                    <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
                                    @endif
                                 </div>
                                 <div class="Prof-name">
                                    @if($feed['type'] != 0)
                                    <span>{{ @$feed['first_name'].' '.@$feed['last_name'] }}</span> 
                                    @else
                                    <span>People Of Play</span> 
                                    @endif
                                    <div class="poptooltip">{{ @App\Helpers\Utilities::timeago($feed['time'])}}
                                       <span class="poptooltiptext"><?php echo  \Carbon\Carbon::parse($feed['created_at'])->format('l,d F Y'); ?> at <?php echo  \Carbon\Carbon::parse($feed['created_at'])->format('h:i:s'); ?></span>
                                    </div>
                                 </div>
                              </div>
                           </a>
                        </div>
                        <div class="add-favorites w-50 d-table">
                           <div class="align-middle text-right">
                              <li class="nav-item dropdown" style="list-style-type: none;">
                                 <a class="" href="#" id="navbardrop" data-toggle="dropdown"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                 <div class="dropdown-menu DropDownMenuMob" style="margin-left:15px;">
                                    @if(isset($session_id) && !empty($session_id) && ($session_id == $feed['user_id']))
                                       <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'delete',`feed-main-box{{ $feed['id'] }}`); return false;">Delete</a>
                                       <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'remove',`feed-main-box{{ $feed['id'] }}`); return false;">Remove From Feeds</a>
                                       @if($feed['type'] == 1 || $feed['type'] == 2)
                                          <a class="dropdown-item" href="#" onclick="openEditGalleryModal(`{{$feed['id']}}`,'feeds_edit'); return false;">Edit</a>
                                       @elseif($feed['type'] == 3)
                                          <a class="dropdown-item" href="{{url('user/feed/update/blog/'.$feed['id'])}}">Edit</a>
                                       @elseif($feed['type'] == 4)
                                          <a class="dropdown-item" href="{{url('user/feed/update/media/'.$feed['id'])}}">Edit</a>
                                       @elseif($feed['type'] == 5)
                                          <a class="dropdown-item" href="{{url('user/feed/update/product/'.$feed['id'])}}">Edit</a>
                                       @elseif($feed['type'] == 6)
                                          <a class="dropdown-item" href="{{url('user/feed/update/classified/'.$feed['id'])}}">Edit</a>
                                       @endif
                                    @else
                                       <a class="dropdown-item" href="#" onclick="feedAction(`{{$feed['id']}}`,'report_from_show',`feed-main-box{{ $feed['id'] }}`); return false;">Report</a>
                                    @endif
                                 </div>
                              </li>
                           </div>
                        </div>
                     </div>
                     @if($feed['type'] != 6 && $feed['type'] != 0)
                     <div class="feed-top-text mt-4 mb-2">
                        @if($feed['type']==3)
                        <a href="{{ $feed['url'] }}" target="blank">
                           @endif
                           <h5>{{ $feed['title'] }}</h5>
                           @if($feed['type']==3)
                        </a>
                        @endif
                        <div class="feed-msg mt-2">
                           <p>{{ strip_tags($feed['caption']) }}</p>
                        </div>
                     </div>
                     @endif
                     <div class="feed-image-post text-center {{$feed['type']}}">
                        <?php //echo $feed['type']; ?>
                        @if($feed['type'] == 2)
                        @if($feed['video_url'] != '')
                        <?php 
                           preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                           ?>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                        @else
                        @if($feed['image'] != '')
                        @if($feed['type']==5 || $feed['type']==3)
                        <a href="{{ $feed['url'] }}" target="_blank">
                        @endif
                        <a href="javascript:void(0)" onclick="imagePopup(this); return false;">
                        @if(($feed['type'] == 3) || ($feed['type'] == 5 && $feed['check_post'] == 0))
                           <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                        @elseif($feed['type'] == 5 && $feed['check_post'] == 1)
                           <img src="{{ url('/uploads/images/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                        @else
                           <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="No Image Found" class="img-fluid">
                        @endif
                        </a>
                        @if($feed['type']==5 || $feed['type']==3)
                        </a>
                        <br>
                        @endif
                        @if($feed['type']==5)
                        <a href="{{ $feed['url'] }}" target="_blank">
                           <h5 class="text-center">{{ $feed['product_name'] }}</h5>
                        </a>
                        @endif
                        @endif
                        @endif
                        @if($feed['url'] != '')
                           @if($feed['type'] == 1 || $feed['type'] == 2 || $feed['type'] == 4)
                           <br>
                           <a href="{{ $feed['url'] }}" target="_blank">{{ $feed['url'] }} </a>
                           @endif
                        @endif
                        @if($feed['type'] == 6)
                           <div class="col-md-6 col-lg-10 mb-4 mx-auto">
                              <div class="ClassifiedListBox">
                                 <div class="row">
                                    <div class="col-md-10 col-10">
                                       <h3 class="ClassifiedHeading">{{$feed['title']}}</h3>
                                    </div>
                                 </div>
                                 <div class="text-left" style="min-height: 187px;">
                                    <p class="p-text">
                                    <div  class="mainDiv" id="short-desc" >
                                       <div class="mb-2 desc short-desc text-left">
                                          {!! nl2br(@$feed['caption']) !!}
                                       </div>
                                       <a href="{{ url('/pop-classified-details/'.$feed['product_name'])}}" class="readMore ProfileReadMore px-2 py-1"> Read More... </a>
                                    </div>
                                    @php 
                                    $int_user_word_length = @App\Helpers\UtilitiesTwo::words_length(@$feed['caption']);
                                    $int_description_words_length = @App\Helpers\UtilitiesTwo::description_words_length();
                                    @endphp
                                 </div>
                                 <div class="text-center mt-2 feed_classified_application">
                                    <a href="{{ url('/pop-classified-details/'.$feed['product_name'])}}" class="text-white clickApplicationBtn">Click For Application</a>
                                 </div>
                                 <div class="text-center mt-3">
                                    <p>POSTED ON {{@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$feed['created_at'])}}</p>
                                 </div>
                                 </a>
                              </div>
                           </div>
                        @endif
                     </div>
                     @if($feed['type'] != 6)
                     <div class="feed-bottom-text mt-2">
                        <div class="feed-tag">
                           <ul class="nav tag-list">
                           <?php if($feed['tag']) {
                              $feedTags = explode(',',$feed['tag']);
                              ?>
                           @foreach ($feedTags as $tags)
                           <li class="nav-item">
                              <a class="nav-link" href="#">#{{ $tags }}</a>
                           </li>
                           @endforeach
                           <?php  } ?>
                           <?php  $companies_id =explode(',',$feed['tag_companies']); 
                              if(!empty($companies_id) && count($companies_id)>0) {
                              $companies = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',3)->whereIn('id',$companies_id)->get()->toArray();  ?>
                           @foreach ($companies as $company)
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('company/'.$company->slug) }}">#{{ $company->first_name .$company->last_name }}</a>
                           </li>
                           @endforeach
                           <?php } ?>
                           <?php  $product_id =explode(',',$feed['tag_products']); 
                              if(!empty($product_id) && count($product_id)>0) {
                              $products = DB::table('products')->select('products.id','products.name','products.slug')->whereIn('id',$product_id)->get()->toArray();   ?>
                           @foreach ($products as $product)
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('product/'.$product->slug) }}">#{{ $product->name }}</a>
                           </li>
                           @endforeach
                           <?php } ?>
                           <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                              if(!empty($peoples_id) && count($peoples_id)>0) {
                              $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name','users.slug')->where('role',2)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                           @foreach ($peoples as $people)
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('people/'.$people->slug) }}">#{{ $people->first_name .$people->last_name }}</a>
                           </li>
                           @endforeach
                           <?php } ?>
                           </ul>
                        </div>
                        <hr class="mb-0">
                        @php @$ProfOptsComments = 'display:none'; @endphp
                        @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id']) >0)
                        @php @$ProfOptsComments = ''; @endphp
                        @endif
                        <div class="ProfOptsComments py-4 py-sm-2 w-100 commentCountSection{{ @$feed['id'] }}" style="{{ @$ProfOptsComments }}">
                           <ul class="nav">
                              <li class="nav-item">
                                 @php @$feedlikeData = 'display:none'; @endphp
                                 @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0)
                                 @php @$feedlikeData = ''; @endphp
                                 @endif
                                 <a style="{{ @$feedlikeData }}" class="nav-link" href="javascript:void(0);"> 
                                 <img src="{{ asset('front/images/icons/pop_like.png') }}" alt="ProfImg" class="img-fluid"> 
                                 <span class="feedSelfLike">{{ @App\Helpers\Utilities::feedCommentLikeCount($feed['id'])}}</span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 @if(@App\Helpers\Utilities::feedCommentCount($feed['id']) >0)
                                 <a class="nav-link" href="javascript:void(0);" onclick="commentToggle(this);">{{  @App\Helpers\Utilities::feedCommentCount($feed['id'])}} comments
                                 </a>
                                 @endif
                              </li>
                           </ul>
                        </div>
                        <hr class="my-0 commentCountSectionHr{{ @$feed['id'] }}" style="{{ @$ProfOptsComments }}">
                        <div class="ProfOptComment py-4 py-sm-2 w-100">
                           <ul class="nav">
                              <?php 
                                 $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                                 
                                 if($addLikeFeed) {
                                    $is_like = 0;
                                    $img_pop_icon = asset('front/images/icons/pop_like.png');
                                 } else {
                                    $is_like = 1;
                                    $img_pop_icon =  asset('front/images/icons/pop1.png');
                                 }
                              ?>
                              <?php $feed_id = $feed['id']; ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'<?= $feed['id'] ?>','<?= $is_like ?>','comment',0)"><img src="{{ $img_pop_icon }}" alt="ProfImg" class="img-fluid"><span>Pop it!</span></a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')"><img src="{{ asset('front/images/icons/comment1.png') }}" alt="ProfImg" class="img-fluid"><span class="commentCount">Comment</span></a>
                              </li>
                              <li class="nav-item">
                                 <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}')" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
                                 <div class="share_btn" id="share-btn{{ $feed_id }}" style="display:none;">
                                    <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id) }}" data-title="Sharing is great!"></div>
                                 </div>
                                 <!-- <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share (0)</span></a>  -->
                              </li>
                           </ul>
                        </div>
                        <hr class="mt-0">
                        <div class="feedcomments">
                           @include('front.feeds.feed_comment_view')
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            @endforeach
         @else
            @php $j=1; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         
         @if($feeds_cnt < 1)
            @php $i=1; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         @if($feeds_cnt < 6 && $i == $feeds_cnt)
            @php $i=6; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         @if($feeds_cnt < 10 && $i == $feeds_cnt)
            @php $i=10; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         @if($feeds_cnt < 13 && $i == $feeds_cnt)
            @php $i=13; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         @if($feeds_cnt < 15 && $i == $feeds_cnt)
            @php $i=15; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
         @if($feeds_cnt < 17 && $i == $feeds_cnt)
            @php $i=17; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif

      </div>
      <div class="text-center">
         <!-- <i class="fa fa-spinner fa-spin st_page_loading" style="display: none;"></i> -->
         <i class="fa fa-spin st_loader st_page_loading" style="display: none;"></i>
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

@include('front.includes.cropper_model')

@endsection
@section('scripts')
<script>
   $(".WelcomeSetFeed ul li a").on("click",function(){
     $(this).toggleClass("setfeedactive");
   });
</script>
<script>
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
   $.ajax({
    url: "{{ route('front.feeds.feed_like') }}",
    type: 'post',
    dataType: 'json',
    data: {"_token": "{{ csrf_token() }}",'feed_id':feed_id,'is_like':is_like,'type':type,'reply_id':reply_id},
    success: function(response) {
       $(e).parents().find('.commentCountSection'+feed_id).show();
       $(e).parents().find('.commentCountSection'+feed_id).find('a').show();
       $(e).parents().find('.commentCountSection'+feed_id).find('a').find('.feedSelfLike').text(response.likeCount);
       $(e).parents().find('.commentCountSectionHr'+feed_id).show();
       if(response.status ==1) {
        var img = '<?=  asset("front/images/icons/pop_like.png") ?>';
        $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',0,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>Pop it!</span></a>');
        toastr.success(response.message)
     } else {
      var img = '<?=  asset("front/images/icons/pop1.png") ?>';
      $(e).parent().html('<a class="nav-link" href="javascript:void(0)" onclick="likeFeed(this,'+feed_id+',1,`'+type+'`,0)"><img src="'+img+'" alt="ProfImg" class="img-fluid"><span>Pop it! </span></a>');
      toastr.success(response.message)
   }
   }
   });
   }
   
   
   function commentSubmit(e,key) {
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
       $('#feed-main-box'+data.feed_id).find('.commentCount').html('Comment ('+ data.feed_count +')');
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
         $('#feed-main-box'+data.feed_id).find('.commentCount').html('Comment ('+ data.feed_count +')');
       
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
         $('#feed-main-box'+data.feed_id).find('.commentCount').html('Comment ('+ data.feed_count +')');
       
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
          toastr.error(data.response);
      } else {
          // if(data.like_type == 0) {
               $(e).children('span').toggleClass('text-danger');
               $(e).children('.replyLikesCount').text(data.totalCount);
            // } else {
            //   $(e).children('span').addClass(''text-danger'');
            //   // $(e).html('<i class="fa fa-thumbs-up"></i> '+data.datacount);
            // }
          toastr.success(data.response);
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
   
   $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
   });
   
   
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
   $(e).parents().find('.mainCommentActive').find('.commentWrite'+id).focus();
   }
   
   function share_post(e,id){
    if($('#share-btn'+id).attr('style') == ''){
     $('#share-btn'+id).hide();
     $('#share-btn'+id+' div.st-btn').hide();
    }else{
     $('#share-btn'+id).show();
     $('#share-btn'+id+' div.st-btn').show();
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
            }
            //toastr.success("Quiz Saved Successfully.");
            // window.location.replace('{{ route("front.pages.quiz.detail")}}');
         }
      });
   }

   $(window).scroll(function() {
      scroll_feeds();
   });

   function scroll_feeds(){
      var load_status = $('#loadStatus').val();
      var offset = $('#offSet').val();
      var no_user_offset = $('#no_user_offset').val();
      var limit = 4;
      var feed_hgt = $(".feed").height();
      var hgt = $(".feed-main-box:nth-last-of-type(2)").height();
      var i_position = $(".feed-main-box:last-child .i_position").val();
      var minus_hgt = feed_hgt - hgt;
      
      
      if($(window).scrollTop() >= minus_hgt && load_status == 'active'){
         if(i_position == null){
            i_position = $(".feed-main-box:nth-last-of-type(2) .i_position").val();
         }
         // console.log('i_position - '+i_position);
         $('.st_page_loading').show();
         $('#loadStatus').val('inactive');
         setTimeout(function(){ 
            if($('#loadStatus').val() == 'inactive'){
               $('#loadStatus').val('active');
            }
         }, 10000);
         // console.log($(document).height()+' - '+$(window).scrollTop()+' - '+ $(window).height());
         // alert($(document).height());
         $.ajax({
            url: "{{ route('front.feeds') }}",
            headers: {
               'X-CSRF-TOKEN': ajax_csrf_token_new
            },
            data: {page_scroll:'yes',offset:offset,limit:limit,i_position:i_position,no_user_offset:no_user_offset},
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
               // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
            },
            error: function (jqXHR, exception) {

               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
               // $('.message_box').html(msg).removeClass('hide');
            },
            success: function (data) {
               if(data.status == 1){
                  if(data.cnt_feeds != 0){
                     $('.feed').append(data.view);
                     $('#offSet').val(data.offset);
                     $('#no_user_offset').val(data.noUserOffset);
                     $('#loadStatus').val('active');
                  }
               }
               $('.st_page_loading').hide();
            }
         });
         
      }
   }

   function imagePopup(e){
      var img_data = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>';
      img_data += $(e).html();
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

</script>
@endsection