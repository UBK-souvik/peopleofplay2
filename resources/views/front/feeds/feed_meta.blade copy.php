@extends('front.layouts.pages')
@section('content')

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e7b95ecb4fb830012007850&product=inline-share-buttons&cms=sop' async='async'></script>
<style>
   .MailingList {
      border-top: 1px solid #fff; 
   }
</style>
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
         </div>
         @foreach ($feeds as $key => $feed)
         <div class="feed-main-box mb-3" id="feed-main-box{{ $feed['id'] }}">
            <div class="feed-box bg-box-shadow">
               <div class="w-100 clearfix feed-profile d-flex ">
                  <div class="profile-img w-50">
                     <a href="javascript:void(0)">
                        <div class="d-flex align-items-center">
                           <div class="prof-image mr-2">
                              <img src="{{@imageBasePath(@$feed['profile_image'])}}" alt="profileimage" class="img-fluid rounded-circle">
                           </div>
                           <div class="Prof-name">
                              <span>{{ $feed['first_name'].' '.$feed['last_name'] }}</span>
                           
                              <div class="poptooltip">{{ @App\Helpers\Utilities::timeago($feed['time'])}}
                                <span class="poptooltiptext"><?php echo  \Carbon\Carbon::parse($feed['created_at'])->format('l,d F Y'); ?> at <?php echo  \Carbon\Carbon::parse($feed['created_at'])->format('h:i:s'); ?></span>
                              </div>
                           </div>
                        </div>
                     </a>
                  </div>
                  <div class="add-favorites w-50 d-table">
                     <div class="d-table-cell align-middle text-right">
                        <?php 
                        $favoritesFeed = DB::table('feed_favorite')->where('user_id',$session_id)->where('feed_id',$feed['id'])->get()->first();
                        if($favoritesFeed) {
                         $is_fav = 0;
                         $fav_icon = 'fa fa-star';
                      } else {
                         $is_fav = 1;
                         $fav_icon = 'fa fa-star-o';
                      }
                      ?>
                      <!-- <div  class="favoriteAncer">
                        <a href="javascript:void(0)" onclick="favoritesFeed(this,<?= $feed['id'] ?>,<?= $is_fav ?>)"><i class="{{ $fav_icon }}" aria-hidden="true"></i> Add to Favorites</a>
                     </div> -->
                  </div>
               </div>
            </div>

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
            <div class="feed-image-post text-center">
               <?php //echo $feed['type']; ?>
               @if($feed['type'] == 2)
               @if($feed['video_url'] != '')
               <?php
                echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"350\" src=\"//www.youtube.com/embed/$1?autoplay=1\" frameborder=\"0\"   allowfullscreen></iframe>",$feed['video_url']);
               ?>

               @endif
               @else
               @if($feed['image'] != '')
               @if($feed['type']==5 || $feed['type']==3)
               <a href="{{ $feed['url'] }}" target="_blank">
                @endif
               <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="lego_toys_img" class="img-fluid">
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
               <a href="{{ $feed['url'] }}" target="_blank">{{ $feed['url'] }} </a>
               @endif
               @endif
            </div>
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
            </div>
            <hr class="mb-0">
            @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0 || @App\Helpers\Utilities::feedCommentCount($feed['id']) >0)
             <div class="ProfOptsComments py-4 py-sm-2 w-100">
               <ul class="nav">

                  <li class="nav-item">
                    @if(@App\Helpers\Utilities::feedCommentLikeCount($feed['id']) >0)
                    <a class="nav-link" href="javascript:void(0);"> <img src="{{ asset('front/images/icons/pop_like.png') }}" alt="ProfImg" class="img-fluid"> <span class="feedSelfLike">{{ @App\Helpers\Utilities::feedCommentLikeCount($feed['id'])}}</span> </a>
                    @endif
                  </li>
                  <li class="nav-item">
                    @if(@App\Helpers\Utilities::feedCommentCount($feed['id']) >0)
                    <a class="nav-link" href="javascript:void(0);" onclick="commentToggle(this);">{{  @App\Helpers\Utilities::feedCommentCount($feed['id'])}} comments
                     </a>
                     @endif
                  </li>
            </ul>
            </div>
            <hr class="my-0">
            @endif
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
                    <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}')" class="btn ws-btn"><i class="fa fa-share-alt"></i> <span>Share</span></a>
                      <div class="share_btn" id="share_btn{{ $feed_id }}" style="display:none;"><div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id) }}" data-title="Sharing is great!"></div></div>
                  <!-- <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share (0)</span></a>  -->
               </li>
            </ul>
         </div>
         <hr class="mt-0">
        
         <div class="feedcomments">
            @include('front.feeds.feed_comment_view')
         </div>
      </div>
   </div>
</div>
</div>
@endforeach
</div>
</div>
<div class="col-md-12 text-center">
   <a href="{{ url('/feeds') }}" class="btn btn-primary"> Show More Feeds</a>
</div>
</div>
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
    success: function(response) {
        $('#DefaultModal').modal('hide');
       $('.MiddleColumnSection').html(response);
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
  $(e).parent().find('.feedCommentMainBox').show();
  $(e).remove();
}

function feedActiveComment(e,id) {
 $(e).parents().find('.mainCommentActive').find('.commentWrite'+id).focus();
}

function share_post(){
        if($('.share_btn').attr('style') == ''){
          $('.share_btn').hide();
          $('.share_btn div.st-btn').hide();
        }else{
          $('.share_btn').show();
          $('.share_btn div.st-btn').show();
        }
      }
</script>
@endsection 
