@extends('front.layouts.pages')
@section('content')
<style>
   .MailingList {
   border-top: 1px solid #fff; 
   }
</style>
<div class="col-md-6 col-lg-7">
   <div class="PopFeeds">
      <div class="feed">
         <div class="top-banner bg-box-shadow text-center">
            <h3>Welcome to People of Play</h3>
            <h6>YOUR PREMIER PLAY RESOURCE</h6>
            <p> Feel the Community and Network like never before with: 
               our Events, POPpedia, Dictionary, Classifieds, 
               and the brand new POP Feed.
            </p>
            <a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#myModal">Set your Interests for your Feed</a>
         </div>

         <!--  Modal -->

         <!-- The Modal -->
         <div class="modal popfeedmodal" id="myModal">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
               <!-- Modal body -->
               <div class="modal-body">
                   <!--Welcome to your very own POP Feed!-->
      <div class="WelcomePopFeed">
         <div class="WelcomeHead mb-4">
            <h1>Welcome to your very own POP Feed!</h1>
            <h4>So we can provide you with the best content, please select all that apply:</h4>
         </div>
         <div class="WelComeOne WelcomeSetFeed mb-4"> 
            <h5>I am a:</h5>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Inventor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Retailer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Designer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Agent</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Marketer</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Media</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Collector</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Influencer</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Parent</a>
              </li>
            </ul>
         </div>
         <div class="WelComeTwo WelcomeSetFeed mb-4">
            <h5>I love:</h5>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Toys</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Games</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Dolls</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Action Figures</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">DIY</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Card Games</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Board Games</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Video Games</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Rideables</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Plush</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Puzzles</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Sports / Outdoor Play</a>
              </li>
            </ul>
         </div>
         <div class="WelComeThree WelcomeSetFeed mb-4">
            <h5>I am interested in:</h5>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Business of Play</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Learning through Play</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Young Inventors</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">Events</a>
              </li>
            </ul>
         </div>
         <div class="SetFeedBtnPrimary">
            <button type="submit" class="btn btn-primary">Continue to my POP Feed</button>
         </div>
      </div>
       <!--Welcome to your very own POP Feed!-->
               </div>

             </div>
           </div>
         </div>
<!--  Modal -->
         @foreach ($feeds as $feed)
         <div class="feed-main-box mb-3">
            <div class="feed-box bg-box-shadow">
               <div class="w-100 clearfix feed-profile d-flex ">
                  <div class="profile-img w-50">
                     <a href="javascript:void(0)">
                        <div class="d-flex align-items-center">
                           <div class="prof-image mr-2">
                              @if($feed['profile_image'] != '')
                              <img src="{{ url('/uploads/images/users/'.$feed['profile_image']) }}" alt="profileimage" class="img-fluid rounded-circle">
                              @else 
                              <img src="{{ url('/uploads/images/users/default_user.png') }}" alt="profileimage" class="img-fluid rounded-circle">
                              @endif
                           </div>
                           <div class="Prof-name">
                              <span>{{ $feed['first_name'].' '.$feed['last_name'] }}</span>
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
                        <div  class="favoriteAncer">
                           <a href="javascript:void(0)" onclick="favoritesFeed(this,<?= $feed['id'] ?>,<?= $is_fav ?>)"><i class="{{ $fav_icon }}" aria-hidden="true"></i> Add to Favorites</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="feed-top-text my-4">
                  <h4>{{ $feed['title'] }}</h4>
               </div>
               <div class="feed-image-post">
                  <?php //echo $feed['type']; ?>
                  @if($feed['type'] == 2)
                  @if($feed['video_url'] != '')
                  <iframe src="{{ str_replace('watch?v=','embed/',$feed['video_url']) }}" title="Video" width="100%" height="400px"></iframe>
                  @endif
                  @else
                  @if($feed['image'] != '')
                  <img src="{{ url('/uploads/images/feed/'.$feed['image']) }}" alt="lego_toys_img" class="img-fluid">
                  @endif
                  @endif
                  @if($feed['url'] != '')
                  <a href="{{ $feed['url'] }}" target="_blank">{{ $feed['url'] }} </a>
                  @endif
               </div>
               <div class="feed-bottom-text">
                  <div class="feed-msg mt-2">
                     <p>{{ strip_tags($feed['caption']) }}</p>
                  </div>
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
                     </ul>
                     <?php  } ?>
                  </div>
                  <?php  $companies_id =explode(',',$feed['tag_companies']);  
                     $companies = DB::table('users')->select('users.id','users.first_name','users.last_name')->where('role',3)->whereIn('id',$companies_id)->get()->toArray();  ?>
                  <div class="feed-tag">
                     <ul class="nav tag-list">
                        @foreach ($companies as $company)
                        <li class="nav-item">
                           <a class="nav-link" href="#">#{{ $company->first_name .$company->last_name }}</a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
                  <?php  $product_id =explode(',',$feed['tag_products']); 
                     $products = DB::table('products')->select('products.id','products.name')->whereIn('id',$product_id)->get()->toArray();   ?>
                  <div class="feed-tag">
                     <ul class="nav tag-list">
                        @foreach ($products as $product)
                        <li class="nav-item">
                           <a class="nav-link" href="#">#{{ $product->name }}</a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
                  <?php  $peoples_id =explode(',',$feed['tag_peoples']);  
                     $peoples = DB::table('users')->select('users.id','users.first_name','users.last_name')->where('role',2)->whereIn('id',$peoples_id)->get()->toArray(); echo "" ?>
                  <div class="feed-tag">
                     <ul class="nav tag-list">
                        @foreach ($peoples as $people)
                        <li class="nav-item">
                           <a class="nav-link" href="#">#{{ $people->first_name .$people->last_name }}</a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               <hr>
               <div class="ProfOptComment py-4 py-sm-2 w-100 mt-4">
                  <ul class="nav">
                     <li class="nav-item">
                        <a class="nav-link" href="#"><img src=" http://pop.local.com/front/images/icons/pop1.png" alt="ProfImg" class="img-fluid"><span>Pop it! (18)</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#"><img src="http://pop.local.com/front/images/icons/comment1.png" alt="ProfImg" class="img-fluid"><span>Comment (6)</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#"><img src="http://pop.local.com/front/images/icons/share1.png" alt="ProfImg" class="img-fluid"> <span>Share (14)</span></a> 
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#"><img src="http://pop.local.com/front/images/icons/messages1.png" alt="ProfImg" class="img-fluid"><span>Message</span></a>
                     </li>
                  </ul>
               </div>

               <div class="feedcomments">
  <div class="row">
    <div class="col-12">
      <div class="comments">
       
        <div class="comments-details">
        
  
              
                     <span class="total-comments comments-sort">117 Comments</span>  
         
            
           
                     <div class="comment-box add-comment">
          <span class="commenter-pic">
            <img src="{{ asset('front/images/image1.jpg') }}" alt="CommImg" class="img-fluid">
          </span>
          <span class="commenter-name">
            <form action="" id="" class="commentform">
              <input type="text" placeholder="Add a comment" name="Add Comment">
              <button type="submit" class="btn btn-default">Comment</button>
            </form>
          </span>
        </div>
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
          </span>       
          <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
          <div class="comment-meta">
            <button type="button" class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
            <button type="button" class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
            <button type="button" class="comment-reply reply-popup"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
          </div>
          <div class="comment-box add-comment reply-box">
            <span class="commenter-pic">
              <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
            </span>
            <span class="commenter-name">
              <input type="text" placeholder="Add a public reply" name="Add Comment">
              <button type="submit" class="btn btn-default">Reply</button>
              <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
            </span>
          </div>
        </div>
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
          </span>       
          <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
          <div class="comment-meta">
            <button type="button" class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
            <button type="button" class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
            <button type="button" class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
          </div>
          <div class="comment-box replied">
            <span class="commenter-pic">
              <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
            </span>
            <span class="commenter-name">
              <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
            </span>       
            <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
            <div class="comment-meta">
              <button type="button" class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
              <button type="button" class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
              <button type="button"  class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
            </div>
            <div class="comment-box replied">
              <span class="commenter-pic">
                <img src="{{ asset('front/images/image1.jpg') }}" class="img-fluid">
              </span>
              <span class="commenter-name">
                <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
              </span>       
              <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
              <div class="comment-meta">
                <button type="button" class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
                <button type="button" class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
                <button type="button" class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
              </div>
            </div>
          </div>
      
                </div>
         
        
          </div>
        </div>

       
    </div>
  </div>
</div>



            </div>
         </div>
         @endforeach
      </div>
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
</script>
@endsection