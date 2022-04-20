@extends('front.layouts.pages')
@section('content')

<!---------------|| Main Section ||--------------->
  <div class="col-md-6 col-lg-7 MiddleColumnSection">
    <div class="popFeedBlogs">
      <div class="YTtopContant text-center">
        <img src="https://peopleofplay.com/front/images/WebHeader17.png" alt="WelcomeToPOPWeekHeader" class="img-fluid">
      </div>
      <div class="popStartPosts w-100 pt-4 pb-3 border-bottom">
        <form>
          <div class="feedInputs">
            <div class="input-group">
              <div class="input-group-prepend">
                <img src="http://18.119.92.184//uploads/images/users/20211028011252yjzFdFAWTz_users_.png" alt="profileimage" class="img-fluid rounded-circle">
              </div>
              <input type="text" class="form-control" placeholder="Start a Post">
            </div>
          </div>
          <div class="feedIconsLists">
            <ul class="list-unstyled IconsLists m-0">
              <li>
                <a href="javascript:void(0);" class="clrRed">
                  <img src="{{ asset('front/images/pop_icons/1.png') }}" class="img-fluid">
                  <p>Photo</p>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="clrOrange">
                  <img src="{{ asset('front/images/pop_icons/2.png') }}" class="img-fluid">
                  <p>Video</p>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="clrYellow">
                  <img src="{{ asset('front/images/pop_icons/3.png') }}" class="img-fluid">
                  <p>Blog</p>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="clrGreen">
                  <img src="{{ asset('front/images/pop_icons/4.png') }}" class="img-fluid">
                  <p>Classifieds</p>
                </a>
              </li>
            </ul>
          </div>
          <input type="hidden" name="offset" id="offSet" value="1">
          <input type="hidden" name="no_user_offset" id="no_user_offset" value="{{$no_User_Offset}}">
          <input type="hidden" name="load_status" id="loadStatus" value="active">
        </form>
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
      <div class="allPostHere w-100 clearfix mb-4">
        @if($feeds_cnt > 0)
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
              @if(isset($feed['image']) && !empty($feed['image']))
                <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{ $feed['id'] }}">
                  <input type="hidden" class="i_position" value="{{$i}}">
                  <div class="feedCategory d-flex pb-3">
                    <h6>CATEGORY: <span>SUBCATEGORY</span></h6>
                    <div class="nav-item dropdown" >
                      <a class="" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                      <div class="dropdown-menu DropDownMenuMob">
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
                    </div>
                  </div>
                  <div class="feedPostContents">
                    <div class="feedTitles d-flex">
                      @if($feed['type'] != 6 && $feed['type'] != 0)
                        <div class="leftFeed">
                          @if($feed['type']==3)
                            <a href="{{ $feed['url'] }}" target="blank"><h4>{{ $feed['title'] }}</h4></a>
                          @else
                            <h4>{{ $feed['title'] }}</h4>
                          @endif
                          <div class="subDescriptions position-relative">
                            <div class="pContents four-line-text">
                              <p>{{ strip_tags($feed['caption']) }}</p>
                            </div>
                            <a href="javascript:void(0);" class="readMore">More</a>
                          </div>
                        </div>
                        @endif
                      <div class="rightFeed">
                        <a href="javascript:void(0);" class="profileImg">
                          @if($feed['type'] != 0)
                            <img src="{{@imageBasePath(@$feed['profile_image'])}}" alt="profileimage" class="img-fluid rounded-circle">
                            @else
                            <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
                          @endif
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="feedVidImg w-100 mt-3 {{$feed['type']}}">
                    @if($feed['type'] == 2)
                      @if($feed['video_url'] != '')
                        <?php 
                          preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$feed['video_url'], $match);
                        ?>
                        <iframe src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                    <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
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
                      
                      <ul class="list-unstyled likeLists m-0">
                        <?php 
                          $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed['id'],'type'=>'comment', 'reply_id'=>0])->get()->first();
                          
                          if($addLikeFeed) {
                            $is_like = 0;
                            $img_pop_icon = asset('front/images/icons/pop_like.png');
                          } else {
                            $is_like = 1;
                            $img_pop_icon =  asset('front/images//pop_icons/7.svg');
                          }
                        ?>
                        <?php $feed_id = $feed['id']; ?>
                        <li>
                          <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'<?= $feed['id'] ?>','<?= $is_like ?>','comment',0)">
                            <img src="{{ $img_pop_icon }}" alt="ProfImg" class="igm-fluid">
                            <span class="feedSelfLike">{{ @App\Helpers\Utilities::feedCommentLikeCount($feed['id'])}}</span>
                          </a>
                        </li>
                        <li>
                          <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')">
                            <img src="{{ asset('front/images/pop_icons/6.svg') }}" class="igm-fluid">
                            <span>{{  @App\Helpers\Utilities::feedCommentCount($feed['id'])}}</span>
                          </a>
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
                  @endif
                </div>
              @endif
            @endforeach
         @else
            @php $j=1; $k=1; @endphp
            @include('front.feeds.side_bar_content_feed')
         @endif
          <!--   -----------------------------------------------------------------   -->
      </div>
      <div class="showMore text-right mb-3">
          <a href="javascript:void(0);" class="d-inline-block">Load More ...</a>
      </div>
    </div>
  </div>
@endsection