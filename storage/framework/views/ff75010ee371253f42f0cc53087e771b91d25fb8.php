<?php 
   $page_type = 'news_feeds';
   $comments = @App\Helpers\Utilities::getCommentsFeeds($feed_id,'comment',0,@$page_type);
   echo '<input type="hidden" class="news_feeds_comment" value="'.$page_type.'">';
  $totalComments = count($comments);
?>
 <?php if(isset($comments) && !empty($comments)): ?>
 <?php if(count($comments)>1 && $is_show_all ==0): ?>
<a href="javascript:void(0);" class="viewAllReply" onclick="viewAllReply(this)">View More</a>

 <?php endif; ?>
      <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commentRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <div class="feedCommentMainBox mb-3 " style="<?php  if($totalComments-1 != $key && $is_show_all ==0) { echo 'display: none'; } ?>">
<div class="media">
   <a href="<?php echo e(url('people/'.$commentRow->slug)); ?>">
      <img src="<?php echo e(@imageBasePath($commentRow->profile_image)); ?>" alt="John Doe" class="mr-3 rounded-circle rounded-circle" style="width:50px;">
   </a>
   <div class="media-body">
    <div class="feedMsg">
      <h4><a href="<?php echo e(url('people/'.$commentRow->slug)); ?>"><?php echo e($commentRow->first_name); ?> <?php echo e($commentRow->last_name); ?></a> <small class="poptooltip"><?php echo e(@App\Helpers\Utilities::timeago($commentRow->time)); ?>

                 <span class="poptooltiptext"><?php echo  \Carbon\Carbon::parse($commentRow->created_at)->format('l,d F Y'); ?> at <?php echo  \Carbon\Carbon::parse($commentRow->created_at)->format('h:i:s'); ?></span>
               </small></h4>
      <p><?php echo e($commentRow->comment); ?></p>
    </div>
      <div class="RlyLik 1">
         <ul class="nav likeLists">
           <li class="nav-item">
               <a class="nav-link popit d-inline" href="javascript:void(0);" onclick="comman_feed_like(this,'<?php echo e($commentRow->id); ?>','<?php echo e($feed_id); ?>',0,'comment',);">
                  <?php  $replysFeedsLike = @App\Helpers\Utilities::getReplysFeedsLike($feed_id,$commentRow->id,@$uinfo->id,0,'comment',@$page_type); ?>
                  <img src="<?php echo e(asset('front/images/pop_icons/like_icon.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Like_Icon" <?php if($replysFeedsLike == 1){ echo "style='display:none'"; } ?>>
                  <img src="<?php echo e(asset('front/images/pop_icons/7.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Un_Like_Icon" <?php if($replysFeedsLike == 0){ echo "style='display:none'"; } ?>>

               </a>
               <small class="replyLikesCount" onclick="comment_feed_like_user(this,'<?php echo e($commentRow->id); ?>','<?php echo e($feed_id); ?>',0,'comment'); return false;"><?php echo e(@App\Helpers\Utilities::getReplysFeedsLikeCount($feed_id,$commentRow->id,0,'comment',@$page_type)); ?></small> 
           </li>
           <li class="nav-item">
              <a class="nav-link reply" href="javascript:void(0);" onclick="replyInputshow(this,'<?php echo e($commentRow->id); ?>');"> <?php echo e(@App\Helpers\Utilities::feedCommentReplyCount($feed_id,$commentRow->id,0,'reply',@$page_type)); ?> Reply</a>
           </li>
         </ul>
      </div>
      <?php 
        $replies = @App\Helpers\Utilities::getReplysFeeds($feed_id,$commentRow->id,'reply',@$page_type);
       ?>
        <?php if(isset($replies) && !empty($replies)): ?>
         <?php $__currentLoopData = $replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$replyRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <!--  <div class="FeedsReply"> -->
         <div class="media py-3">
            <a href="<?php echo e(url('people/'.$replyRow->slug)); ?>">
               <img src="<?php echo e(@imageBasePath($replyRow->profile_image)); ?>" alt="Jane Doe" class="mr-3 rounded-circle" style="width:45px;">
            </a>
            <div class="media-body">
              <div class="feedMsg">
               <h4><a href="<?php echo e(url('people/'.$replyRow->slug)); ?>"><?php echo e($replyRow->first_name); ?> <?php echo e($replyRow->last_name); ?></a> <small class="poptooltip"><?php echo e(@App\Helpers\Utilities::timeago($replyRow->time)); ?>

                 <span class="poptooltiptext"><?php echo  \Carbon\Carbon::parse($replyRow->created_at)->format('l,d F Y'); ?> at <?php echo  \Carbon\Carbon::parse($replyRow->created_at)->format('h:i:s'); ?></span>
               </small></h4>
               <p><?php echo e($replyRow->comment); ?></p>
             </div>
              <div class="RlyLik 2">
                  <ul class="nav likeLists">
                    <li class="nav-item">
                        <a class="nav-link popit d-inline" href="javascript:void(0);"  onclick="comman_feed_like(this,'<?php echo e($commentRow->id); ?>','<?php echo e($feed_id); ?>','<?php echo e($replyRow->id); ?>','reply',);">
                        
                           <?php  $replysFeedsLike = @App\Helpers\Utilities::getReplysFeedsLike($feed_id,$commentRow->id,@$uinfo->id,$replyRow->id,'comment',@$page_type); ?>
                           <img src="<?php echo e(asset('front/images/pop_icons/like_icon.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Like_Icon" <?php if($replysFeedsLike == 1){ echo "style='display:none'"; } ?>>
                           <img src="<?php echo e(asset('front/images/pop_icons/7.png')); ?>" alt="ProfImg" class="img-fluid like_Icon is_Un_Like_Icon" <?php if($replysFeedsLike == 0){ echo "style='display:none'"; } ?>>

                        </a>
                        <small class="replyLikesCount" onclick="comment_feed_like_user(this,'<?php echo e($commentRow->id); ?>','<?php echo e($feed_id); ?>','<?php echo e($replyRow->id); ?>','reply'); return false;"><?php echo e(@App\Helpers\Utilities::getReplysFeedsLikeCount($feed_id,$commentRow->id,$replyRow->id,'reply',@$page_type)); ?></small> 
                    </li>
                    <li class="nav-item">
                      <a class="nav-link reply" href="javascript:void(0);" onclick="replyInputshow1(this,'<?php echo e($replyRow->id); ?>');">  Reply</a>
                    </li>
                  </ul>
                   <div class="comment-box add-comment mt-2 commentReplyInput1<?php echo e($replyRow->id); ?>" style="display: none;">
                    <span class="commenter-pic">
                    <img src="<?php echo e(@imageBasePath(Auth::guard('users')->user()->profile_image)); ?>" alt="CommImg" class="img-fluid">
                    </span>
                    <span class="commenter-name">
                       <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
                          <?php echo csrf_field(); ?>
                          <div class="FromInput d-flex align-items-center">
                             <!-- <input type="text" placeholder="Write a reply..."  class="writeReply<?php echo e($replyRow->id); ?>" name="comment"> -->
                             <textarea placeholder="Write a reply..." name="comment" class="writeReply<?php echo e($replyRow->id); ?>" onkeyup="textAreaAdjust(this)"></textarea>

                             <input type="hidden" name="hid_view_all_comment" class="hidViewAllComment" value="<?php echo e(@$is_show_all); ?>">
                             <input type="hidden" name="feed_id" value="<?php echo e($feed_id); ?>">
                             <input type="hidden" name="type" value="reply">
                             <input type="hidden" name="comm_id" value="<?php echo e($commentRow->id); ?>">
                             <input type="hidden" name="reply_id" value="0">
                             <button type="submit" class="btn btn-default"><span class="post_comment"><img src="<?php echo e(asset('front/images/send_post.svg')); ?>"></span></button>
                          </div>
                       </form>
                    </span>
                 </div>
               </div>
            </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
         <div class="comment-box add-comment mt-2 commentReplyInput<?php echo e($commentRow->id); ?>" style="display: none;">
            <span class="commenter-pic">
            <img src="<?php echo e(@imageBasePath(Auth::guard('users')->user()->profile_image)); ?>" alt="CommImg" class="img-fluid">
            </span>
            <span class="commenter-name">
               <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
                  <?php echo csrf_field(); ?>
                  <div class="FromInput d-flex align-items-center">
                     <!-- <input type="text" placeholder="Write a reply..."  class="writeReply<?php echo e($commentRow->id); ?>" name="comment"> -->
                     <textarea placeholder="Write a reply..." name="comment" class="writeReply<?php echo e($commentRow->id); ?>" onkeyup="textAreaAdjust(this)"></textarea>

                     <input type="hidden" name="hid_view_all_comment" class="hidViewAllComment" value="<?php echo e(@$is_show_all); ?>">
                     <input type="hidden" name="feed_id" value="<?php echo e($feed_id); ?>">
                     <input type="hidden" name="type" value="reply">
                     <input type="hidden" name="comm_id" value="<?php echo e($commentRow->id); ?>">
                     <input type="hidden" name="reply_id" value="0">
                     <button type="submit" class="btn btn-default"><span class="post_comment"><img src="<?php echo e(asset('front/images/send_post.svg')); ?>"></span></button>
                  </div>
               </form>
            </span>
         </div>
      <!-- </div> --> 
   </div>
 </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<div class="comment-box add-comment mt-4 pb-3 mainCommentActive">
   <span class="commenter-pic">
   <img src="<?php echo e(@imageBasePath(Auth::guard('users')->user()->profile_image)); ?>" alt="CommImg" class="img-fluid">
   </span>
   <span class="commenter-name">
      <form id="commentform<?= $feed_id ?>" class="commentform" onsubmit="commentSubmit(this,'<?= $feed_id ?>');return false;">
         <?php echo csrf_field(); ?>
         <div class="FromInput d-flex align-items-center">
            <!-- <input type="text" placeholder="Write a comment..." name="comment" class="commentWrite<?php echo e($feed_id); ?>"> -->
            <textarea placeholder="Write a comment..." name="comment" class="commentWrite<?php echo e($feed_id); ?>" onkeyup="textAreaAdjust(this)"></textarea>
            
            <input type="hidden" name="hid_view_all_comment" class="hidViewAllComment" value="<?php echo e(@$is_show_all); ?>">
            <input type="hidden" name="feed_id" value="<?php echo e($feed_id); ?>">
            <input type="hidden" name="type" value="comment">
            <input type="hidden" name="comm_id" value="0">
            <input type="hidden" name="reply_id" value="0">
             <button type="submit" class="btn btn-default"><span class="post_comment"><img src="<?php echo e(asset('front/images/send_post.svg')); ?>"></span></button>
         </div>
      </form>
   </span>
</div>

<div class="row">
<div class="col-12">
</div>
</div>