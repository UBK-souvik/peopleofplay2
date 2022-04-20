 <div class="feedCommentMainBox">
<div class="media">
   <img src="http://pop.local.com/uploads/images/users/20211012065235TedCdtnsMF_users_.png" alt="John Doe" class="mr-3 rounded-circle rounded-circle" style="width:50px;">
  
   <div class="media-body">
      <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
      <p>Lorem ipsum...</p>
      <div class="FeedsReply">
         <div class="media py-3">
            <img src="http://pop.local.com/uploads/images/users/20211012065235TedCdtnsMF_users_.png" alt="Jane Doe" class="mr-3 rounded-circle" style="width:45px;">
            <div class="media-body">
               <h4>Jane Doe <small><i>Posted on February 20 2016</i></small></h4>
               <p>Lorem ipsum...</p>
            </div>
         </div>
         <div class="comment-box add-comment">
            <span class="commenter-pic">
            <img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="CommImg" class="img-fluid">
            </span>
            <span class="commenter-name">
               <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
                  @csrf
                  <div class="FromInput d-flex align-items-center">
                     <input type="text" placeholder="Write a comment..." name="comment">
                     <input type="hidden" name="feed_id" value="{{ $feed_id }}">
                     <input type="hidden" name="type" value="comment">
                     <input type="hidden" name="comm_id" value="0">
                     <input type="hidden" name="reply_id" value="0">
                     <button type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                  </div>
               </form>
            </span>
         </div>
      </div>
   </div>
 </div>
</div>
<div class="comment-box add-comment mt-4">
   <span class="commenter-pic">
   <img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="CommImg" class="img-fluid">
   </span>
   <span class="commenter-name">
      <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
         @csrf
         <div class="FromInput d-flex align-items-center">
            <input type="text" placeholder="Write a comment..." name="comment">
            <input type="hidden" name="feed_id" value="{{ $feed_id }}">
            <input type="hidden" name="type" value="comment">
            <input type="hidden" name="comm_id" value="0">
            <input type="hidden" name="reply_id" value="0">
             <button type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
         </div>
      </form>
   </span>
</div>
<?php  
   $comments = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id,'type'=>'comment'])->orderByDesc('id')->get();
   // echo"<pre>";print_r($comments);die;
   $feed_count = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id])->orderByDesc('id')->get()->count();
   
   
   //$time_count = time();
   // date_default_timezone_set('Asia/Kolkata');
   //$time_count = date('h:i A ');
   // date('h:i A D',$answer->created_at); 
   ?>
<div class="row">
<div class="col-12">
<div class="comments">
   <div class="comments-details">
      @if(isset($comments) && !empty($comments))
      @foreach($comments as $key => $commentRow)
      <div class="comment-box">
         <span class="commenter-pic">
         @if(isset($commentRow->profile_image) && !empty($commentRow->profile_image))
         <img src="{{ asset('uploads/images/users/'.$commentRow->profile_image) }}" class="img-fluid">
         @else 
         <img src="{{ asset('uploads/images/default_user.png') }}" class="img-fluid">
         @endif
         </span>
         <span class="commenter-name">
         <a href="javascript:void(0);">{{ $commentRow->first_name }} {{ $commentRow->last_name }}</a> <span class="comment-time">
         {{ @App\Helpers\Utilities::timeago($commentRow->time)}}
         </span>
         </span>       
         <p class="comment-txt more">{{ $commentRow->comment }}</p>
         <div class="comment-meta">
            <?php  
               $session_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d'); 
               $likeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$commentRow->id,'type'=>1])->first(); 
               $likeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$commentRow->id,'type'=>1])->get()->count(); 
               if(isset($likeCommentData) && !empty($likeCommentData)) {
                $is_like_comment = 1;
               } else {
                 $is_like_comment = 0;
               }
               
               $unlikeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$commentRow->id,'type'=>0])->first();
               
                $unlikeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$commentRow->id,'type'=>0])->get()->count(); 
               if(isset($unlikeCommentData) && !empty($unlikeCommentData)) {
                $is_unlike_comment = 1;
               } else {
                 $is_unlike_comment = 0;
               }
               ?>
            <a href="javascript:void(0);" onclick="comman_feed_like(this,'<?= $commentRow->id ?>',1,'<?= $is_unlike_comment ?>');" class="comment-like"><?php if($is_like_comment == 0){ ?><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php } else { ?> <i class="fa fa-thumbs-up"></i>  <?php } ?>  {{ $likeCommentcount }}</a>
            <a href="javascript:void(0);"  onclick="comman_feed_like(this,'<?= $commentRow->id ?>',0,'<?= $is_unlike_comment ?>');" class="comment-dislike">
            <?php if($is_unlike_comment == 0){ ?>
            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
            <?php }else { ?>
            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            <?php } ?> 
            {{ $unlikeCommentcount}}</a> 
            <a  class="comment-reply reply-popup "  href="javascript:void(0);" onclick="replyBox(this);"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a>         
         </div>
         <div class="comment-box add-comment reply-box reply-input-box">
            <span class="commenter-pic">
            <img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" class="img-fluid">
            </span>
            <span class="commenter-name">
               <form id="replyForm<?= $commentRow->id ?>" onsubmit="replySubmit(this); return false;">
                  @csrf
                  <input type="text" placeholder="Add a public reply" name="comment">
                  <input type="hidden" name="feed_id" value="{{ $feed_id }}">
                  <input type="hidden" name="type" value="reply">
                  <input type="hidden" name="comm_id" value="{{ $commentRow->id }}">
                  <input type="hidden" name="reply_id" value="0">
                  <button type="submit" class="btn btn-default">Reply</button>
               </form>
               <a href="javascript:void(0);" onclick="replyBoxCancel(this)" class="btn btn-default reply-popup">Cancel</a>
            </span>
         </div>
         <?php
            $replies = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id,'type'=>'reply','comm_id'=>$commentRow->id])->orderByDesc('id')->get();
            ?>
         @if(isset($replys) && !empty($replys))
         @foreach($replys as $key =>$replyRow)
         <div class="comment-box replied">
            <span class="commenter-pic">
            @if(isset($commentRow->profile_image) && !empty($commentRow->profile_image))
            <img src="{{ asset('uploads/images/users/'.$commentRow->profile_image) }}" class="img-fluid">
            @else 
            <img src="{{ asset('uploads/images/default_user.png') }}" class="img-fluid">
            @endif
            </span>
            <span class="commenter-name">
            <a href="#">{{ $replyRow->first_name }} {{ $replyRow->last_name }}</a> <span class="comment-time">
            {{ @App\Helpers\Utilities::timeago($replyRow->time)}}
            </span>
            </span>       
            <p class="comment-txt more">{{ $replyRow->comment }}</p>
            <div class="comment-meta">
               <?php  
                  $session_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d'); 
                  $likeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$replyRow->id,'type'=>1])->first(); 
                  $likeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$replyRow->id,'type'=>1])->get()->count(); 
                  if(isset($likeCommentData) && !empty($likeCommentData)) {
                   $is_like_comment = 1;
                  } else {
                    $is_like_comment = 0;
                  }
                  
                  $unlikeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$replyRow->id,'type'=>0])->first();
                  
                   $unlikeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$replyRow->id,'type'=>0])->get()->count(); 
                  if(isset($unlikeCommentData) && !empty($unlikeCommentData)) {
                   $is_unlike_comment = 1;
                  } else {
                    $is_unlike_comment = 0;
                  }
                  ?>
               <a href="javascript:void(0);" onclick="comman_feed_like(this,'<?= $replyRow->id ?>',1,'<?= $is_unlike_comment ?>');" class="comment-like"><?php if($is_like_comment == 0){ ?><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php } else { ?> <i class="fa fa-thumbs-up"></i>  <?php } ?>  {{ $likeCommentcount }}</a>
               <a href="javascript:void(0);"  onclick="comman_feed_like(this,'<?= $replyRow->id ?>',0,'<?= $is_unlike_comment ?>');" class="comment-dislike">
               <?php if($is_unlike_comment == 0){ ?>
               <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
               <?php }else { ?>
               <i class="fa fa-thumbs-down" aria-hidden="true"></i>
               <?php } ?> 
               {{ $unlikeCommentcount}}</a> 
               <a href="javascript:void(0);" class="comment-reply" onclick="subReplyBox(this,'<?= $replyRow->id ?>');"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a>         
            </div>
            <div class="comment-box add-comment reply-box" id="sub-reply-box<?= $replyRow->id ?>">
               <span class="commenter-pic">
               <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
               </span>
               <span class="commenter-name">
                  <form id="replyForm<?= $replyRow->id ?>" onsubmit="subReplySubmit(this); return false;">
                     @csrf
                     <input type="text" placeholder="Add a public reply" name="comment">
                     <input type="hidden" name="feed_id" value="{{ $feed_id }}">
                     <input type="hidden" name="type" value="sub_reply">
                     <input type="hidden" name="comm_id" value="{{ $commentRow->id }}">
                     <input type="hidden" name="reply_id" value="{{ $replyRow->id }}">
                     <button type="submit" class="btn btn-default">Reply</button>
                  </form>
                  <a href="javascript:void(0);" onclick="replyBoxCancel(this)" class="btn btn-default reply-popup">Cancel</a>
               </span>
            </div>
            <?php
               $sub_replys = DB::table('feed_comment')->select('feed_comment.*','users.first_name','users.last_name','users.profile_image')->join('users','users.id','=','feed_comment.user_id')->where(['feed_id'=>$feed_id,'type'=>'sub_reply','comm_id'=>$commentRow->id,'reply_id'=>$replyRow->id])->orderByDesc('id')->get();
               ?>
            @if(isset($sub_replys) && !empty($sub_replys))
            @foreach($sub_replys as $key =>$subReplyRow)
            <div class="comment-box replied">
               <span class="commenter-pic">
               @if(isset($commentRow->profile_image) && !empty($commentRow->profile_image))
               <img src="{{ asset('uploads/images/users/'.$commentRow->profile_image) }}" class="img-fluid">
               @else 
               <img src="{{ asset('uploads/images/default_user.png') }}" class="img-fluid">
               @endif
               </span>
               <span class="commenter-name">
               <a href="#">{{ $subReplyRow->first_name }} {{ $subReplyRow->last_name }}</a> <span class="comment-time">
               {{ @App\Helpers\Utilities::timeago($subReplyRow->time)}}
               </span>
               </span>       
               <p class="comment-txt more">{{ $subReplyRow->comment }}</p>
               <div class="comment-meta">
                  <?php  
                     $session_id = Session::get('login_users_59ba36addc2b2f9401580f014c7f58ea4e30989d'); 
                     $likeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$subReplyRow->id,'type'=>1])->first(); 
                     $likeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$subReplyRow->id,'type'=>1])->get()->count(); 
                     if(isset($likeCommentData) && !empty($likeCommentData)) {
                      $is_like_comment = 1;
                     } else {
                       $is_like_comment = 0;
                     }
                     
                     $unlikeCommentData = DB::table('feed_comment_like')->where(['user_id'=>$session_id,'comment_id'=>$subReplyRow->id,'type'=>0])->first();
                     
                      $unlikeCommentcount = DB::table('feed_comment_like')->where(['comment_id'=>$subReplyRow->id,'type'=>0])->get()->count(); 
                     if(isset($unlikeCommentData) && !empty($unlikeCommentData)) {
                      $is_unlike_comment = 1;
                     } else {
                       $is_unlike_comment = 0;
                     }
                     ?>
                  <a href="javascript:void(0);" onclick="comman_feed_like(this,'<?= $subReplyRow->id ?>',1,'<?= $is_unlike_comment ?>');" class="comment-like"><?php if($is_like_comment == 0){ ?><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php } else { ?> <i class="fa fa-thumbs-up"></i>  <?php } ?>  {{ $likeCommentcount }}</a>
                  <a href="javascript:void(0);"  onclick="comman_feed_like(this,'<?= $subReplyRow->id ?>',0,'<?= $is_unlike_comment ?>');" class="comment-dislike">
                  <?php if($is_unlike_comment == 0){ ?>
                  <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                  <?php }else { ?>
                  <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                  <?php } ?> 
                  {{ $unlikeCommentcount}}</a> 
                  <a href="javascript:void(0);" class="comment-reply" onclick="subReplyBox(this,'<?= $subReplyRow->id ?>');"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a>         
               </div>
               <div class="comment-box add-comment reply-box" id="sub-reply-box<?= $subReplyRow->id ?>">
                  <span class="commenter-pic">
                  <img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" class="img-fluid">
                  </span>
                  <span class="commenter-name">
                     <form id="replyForm<?= $subReplyRow->id ?>" onsubmit="subReplySubmit(this); return false;">
                        @csrf
                        <input type="text" placeholder="Add a public reply" name="comment">
                        <input type="hidden" name="feed_id" value="{{ $feed_id }}">
                        <input type="hidden" name="type" value="sub_reply">
                        <input type="hidden" name="comm_id" value="{{ $commentRow->id }}">
                        <input type="hidden" name="reply_id" value="{{ $replyRow->id }}">
                        <button type="submit" class="btn btn-default">Reply</button>
                     </form>
                     <a href="javascript:void(0);" onclick="replyBoxCancel(this)" class="btn btn-default reply-popup">Cancel</a>
                  </span>
               </div>
            </div>
            @endforeach
            @endif
         </div>
         @endforeach
         @endif
      </div>
      @endforeach
      @endif
      <div class="comment-box add-comment">
         <span class="commenter-pic">
         <img src="{{@imageBasePath(Auth::guard('users')->user()->profile_image)}}" alt="CommImg" class="img-fluid">
         </span>
         <span class="commenter-name">
            <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
               @csrf
               <input type="text" placeholder="Write a comment..." name="comment">
               <input type="hidden" name="feed_id" value="{{ $feed_id }}">
               <input type="hidden" name="type" value="comment">
               <input type="hidden" name="comm_id" value="0">
               <input type="hidden" name="reply_id" value="0">
               <button type="submit" class="btn btn-default">Comment</button>
            </form>
         </span>
      </div>
   </div>
</div>