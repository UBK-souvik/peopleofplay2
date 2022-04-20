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
                   <br>
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
                      <div class="share_btn" id="share-btn{{ $feed_id }}" style="display:none;"><div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id) }}" data-title="Sharing is great!"></div></div>
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