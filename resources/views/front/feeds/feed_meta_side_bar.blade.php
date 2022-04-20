@if((isset($i) && !empty($i == 6)) || (isset($j) && !empty($j == 1)))
   @php $feed_id = $feeds[0]['id']; @endphp
   <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{$feed_id}}">
      <input type="hidden" class="i_position" value="{{$i}}">
      <div class="feedCategory d-flex pb-3">         
         <a href="{{@$arr_dictionary_data[4]}}"><h6><span><b>WORD OF THE DAY</b></span></h6></a>
      </div>  
      <div class="feedPostContents">
         <div class="feedTitles d-flex">
            <div class="leftFeed">
               <h3 class="mb-0">Word of the Day</h3>
               <div class="subDescriptions position-relative mt-3">
                  <div class="pContents four-line-text">
                     <span style="font-size: 20px;  font-weight: 500;"><b>{{@$dictionary_detail[0]->title}}</b> <small class="text-sm">(Submitted by <a href="{{@$arr_dictionary_data[0]}}">{{@$arr_dictionary_data[1]}}</a>)</small>
                  </span>
                  </div>
                  <p style="font-size: 14px;">{{@$dictionary_detail[0]->description}} </p>
                  <!-- <p class="bottomText mt-3">
                     <b>Submitted by <a href="{{@$arr_dictionary_data[0]}}">{{@$arr_dictionary_data[1]}}</a></b>
                  </p> -->
                  @if(strlen(strip_tags(@$dictionary_detail[0]->description)) > 500)
                     <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                  @endif
               </div>
            </div>
            <div class="rightFeed d-none">
               <a href="javascript:void(0);" class="profileImg">
                  <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
               </a>
            </div>
         </div>
      </div> 
      <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
         <!-- <hr class="mb-0"> -->
         @php @$ProfOptsComments = 'display:none'; @endphp
         @if(@App\Helpers\Utilities::feedCommentLikeCount($feed_id) >0 || @App\Helpers\Utilities::feedCommentCount($feed_id) >0)
         @php @$ProfOptsComments = ''; @endphp
         @endif
         <!-- <hr class="my-0 commentCountSectionHr{{ @$feed_id }}" style="{{ @$ProfOptsComments }}"> -->
         <ul class="list-unstyled likeLists m-0">
            <?php 
               $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed_id,'type'=>'comment', 'reply_id'=>0])->get()->first();
               
               if($addLikeFeed) {
                  $is_like = 0;
                  $img_pop_icon = asset('front/images/pop_icons/like_icon.png');
               } else {
                  $is_like = 1;
                  $img_pop_icon =  asset('front/images/pop_icons/7.png');
               }
            ?>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'{{$feed_id}}','<?= $is_like ?>','comment',0)"><img src="{{ $img_pop_icon }}" alt="ProfImg" class="img-fluid"><span>{{ @App\Helpers\Utilities::feedCommentLikeCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')"><img src="{{ asset('front/images/pop_icons/6.png') }}" alt="ProfImg" class="img-fluid"><span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}',`{{ url('feed/'.$feed_id.'&') }}`)" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
            </li>
         </ul>
      </div>      
      <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
         <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id) }}" data-title="{{$feeds[0]['title']}}" data-description="{{$feeds[0]['caption']}}" data-image="@if(!empty($feeds[0]['image'])){{ asset('/uploads/images/feed/'.$feeds[0]['image']) }}@elseif(!empty($feeds[0]['video_url'])){{ 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg' }}@endif"></div>
      </div>
      <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
         <hr class="mt-0">
         @include('front.feeds.feed_comment_view')
      </div>
   </div>
@endif
@if((isset($i) && !empty($i == 10)) || (isset($j) && !empty($j == 1)))
   @php $feed_id = $feeds[0]['id']; @endphp
   <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{$feed_id}}">
      <input type="hidden" class="i_position" value="{{$i}}">
      <div class="feedCategory d-flex pb-3">         
         <a href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}"><h6><span><b>TODAY IS</b></span></h6></a>
      </div>  
      <div class="feedPostContents">
         <div class="feedTitles d-flex">
            <div class="leftFeed">
               <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}" class="text-dark">
                  <h2 class="text-left" style="font-size: 20px;"><b>Today is...</b></h2>
                  <div class="subDescriptions position-relative">
                     <div class="pContents four-line-text">
                        <span class="text-left" style="font-size: 17px;"><h2 class="text-left" style="font-size: 20px;">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_one)}}</h2></span>
                     </div>
                     @if(strlen(strip_tags(App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_one))) > 500)
                        <a href="javascript:void(0);" class="readMore" onclick="show_more(this); return false;">More</a>
                     @endif
                  </div>
               </a>
            </div>
            <div class="rightFeed d-none">
               <a href="javascript:void(0);" class="profileImg">
                  <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
               </a>
            </div>
         </div>
      </div> 
      <div class="feedVidImg w-100 mt-3">
         <a target="_blank" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}"><img src="{{@imageBasePath(@$home_product_data->main_image)}}" class="img-fluid"></a>
         <!-- <p class="mb-0 mr-1" style="float: left;">Check out Jumbo Floor Puzzle Dinosaurs </p> -->
         <a target="_blank" class="" href="{{App\Helpers\UtilitiesFour::get_url_link(@$str_home_product_page_url_new)}}">{{App\Helpers\UtilitiesTwo::get_whatever_day_title_data(@$home_product_data->home_caption_two)}}</a>
      </div> 

      <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
         <!-- <hr class="mb-0"> -->
         @php @$ProfOptsComments = 'display:none'; @endphp
         @if(@App\Helpers\Utilities::feedCommentLikeCount($feed_id) >0 || @App\Helpers\Utilities::feedCommentCount($feed_id) >0)
         @php @$ProfOptsComments = ''; @endphp
         @endif
         
         <!-- <hr class="my-0 commentCountSectionHr{{ @$feed_id }}" style="{{ @$ProfOptsComments }}"> -->
         <ul class="list-unstyled likeLists m-0">
            <?php 
               $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed_id,'type'=>'comment', 'reply_id'=>0])->get()->first();
               
               if($addLikeFeed) {
                  $is_like = 0;
                  $img_pop_icon = asset('front/images/pop_icons/like_icon.png');
               } else {
                  $is_like = 1;
                  $img_pop_icon =  asset('front/images/pop_icons/7.png');
               }
            ?>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'{{$feed_id}}','<?= $is_like ?>','comment',0)"><img src="{{ $img_pop_icon }}" alt="ProfImg" class="img-fluid"><span>{{ @App\Helpers\Utilities::feedCommentLikeCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')"><img src="{{ asset('front/images/pop_icons/6.png') }}" alt="ProfImg" class="img-fluid"><span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}',`{{ url('feed/'.$feed_id.'&home_product_id='.$home_product_data->id.'&') }}`)" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
            </li>
         </ul>
      </div>
      <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
         <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id.'?home_product_id='.$home_product_data->id) }}" data-title="{{$feeds[0]['title']}}" []data-description="{{$feeds[0]['caption']}}" data-image="@if(!empty($feeds[0]['image'])){{ asset('/uploads/images/feed/'.$feeds[0]['image']) }}@elseif(!empty($feeds[0]['video_url'])){{ 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg' }}@endif"></div>
            <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
            <hr class="mt-0">
            @include('front.feeds.feed_comment_view')
         </div>
      </div>
   </div>
@endif
@if((isset($i) && !empty($i == 13)) || (isset($j) && !empty($j == 1)))
@php $feed_id = $feeds[0]['id']; @endphp
   <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{$feed_id}}">
      <input type="hidden" class="i_position" value="{{$i}}">
      <div class="feedCategory d-flex pb-3">         
         <a href="{{ @$str_home_advertisement_data_destination_link }}"><h6><span><b>3 TRUTHS & A LIE</b></span></h6></a>
      </div>  
      <div class="QuizBox">
         <div class="feedPostContents">
            <div class="feedTitles d-flex">
               <div class="leftFeed">
                  <h4 class="text-center text-md-left mb-4 font-weight-normal">Can you guess which is the lie?</h4>
               </div>
               <div class="rightFeed d-none">
                  <a href="javascript:void(0);" class="profileImg">
                     <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
                  </a>
               </div>
            </div>
         </div> 
         <div class="feed-image-post text-center feedImagesPosts">
            <div class="First-column bg-black1 pt-0">
               <div class="">
                  <input type="hidden" name="" id="hid_current_url" value="{{ url('/3-truths-and-a-lie?user='.@$question_detail[0]->user->slug) }}">
                  <div class="row">
                     <div class="col-xl-12 mb-3">
                        <div class="quizLeftImg mt-4 text-center">
                           <a href="{{$str_user_url_new}}"><img src="{{$str_profile_image}}" class="w-100"></a>
                           <div class="text-center">
                              <a href="{{$str_user_url_new}}" class="p-0">
                                 <h6 class="font-weight-normal text-dark m-0">{{$str_user_name}}</h6>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-12 mb-4 deskPadLeft">
                        <form class="quiz-form" enctype="multipart/form-data" onsubmit="quiz_play(this); return false;">
                           <div>
                              @php  
                              $arr_questions_ids = App\Helpers\UtilitiesTwo::get_questions_list_new();
                              $int_ascii_val_alphabets = 65;
                              @endphp
                              @foreach($arr_questions_ids as $arr_questions_id_row)
                              @php
                              $int_question_id = $arr_questions_id_row;
                              //$str_ques_val_name_new = 'ques_'.$int_question_id.'_val';
                              $str_question_data_val_new = 'ques_'.$int_question_id.'_val';
                              $str_ques_val_name_new = 'question_id';
                              $str_str_ques_val = @$question_detail[0]->$str_question_data_val_new;
                              $str_val_alphabets = chr($int_ascii_val_alphabets);
                              $int_ascii_val_alphabets++;
                              @endphp    
                              <div id="mainDivId_{{$int_question_id}}_truth_quiz_play">
                                 <a onclick="checkQuiz(this,'_truth_quiz_play'); return false;" href="javascript:void(0)">
                                    <div id="childDivId_{{$int_question_id}}_truth_quiz_play" class="d-flex optionsBox mb-2">
                                       <div class="d-flex">
                                          <div class="textWrapLetter text-dark mt-1"><span>{{$str_val_alphabets}}</span></div>
                                          <input type="hidden" name="" value="{{$int_question_id}}">
                                          <div class="labelContainer text-dark mb-0">
                                          <p class="mb-0">{{@$str_str_ques_val}}</p>
                                          </div>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                              @endforeach
                              <div class="text-center" id="div-id-select-truth_truth_quiz_play"  style="display:none;">
                                 <p class="quizTextRed" style="font-size: 18px"><strong>Guess again</strong></p>
                              </div>
                              <div class="text-center"  id="div-id-select-lie_truth_quiz_play" style="display:none;">
                                 <p class="quizTextGreen" style="font-size: 18px"><strong>You guessed right!</strong></p>
                              </div>
                              <div class="text-center">
                                 <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty($question_detail[0]->id)){{$question_detail[0]->id}}@endif"> 
                                 <input type="hidden" id="which_is_lie_truth_quiz_play"  name="which_is_lie" value="@if(!empty($question_detail[0]->which_is_lie)){{$question_detail[0]->which_is_lie}}@endif">
                                 <input type="hidden" name="{{$str_ques_val_name_new}}" id="{{$str_ques_val_name_new}}"  value="">
                                 <input type="hidden" name="quiz_type" value="truth_quiz_play">
                                 <button type="submit" class="btn playBtnQuiz1 btnAll btn-primary">Play Again</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
         <!-- <hr class="mb-0"> -->
         @php @$ProfOptsComments = 'display:none'; @endphp
         @if(@App\Helpers\Utilities::feedCommentLikeCount($feed_id) >0 || @App\Helpers\Utilities::feedCommentCount($feed_id) >0)
         @php @$ProfOptsComments = ''; @endphp
         @endif
         
         <!-- <hr class="my-0 commentCountSectionHr{{ @$feed_id }}" style="{{ @$ProfOptsComments }}"> -->
         <ul class="list-unstyled likeLists m-0">
            <?php 
               $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed_id,'type'=>'comment', 'reply_id'=>0])->get()->first();
               
               if($addLikeFeed) {
                  $is_like = 0;
                  $img_pop_icon = asset('front/images/pop_icons/like_icon.png');
               } else {
                  $is_like = 1;
                  $img_pop_icon =  asset('front/images/pop_icons/7.png');
               }
            ?>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'{{$feed_id}}','<?= $is_like ?>','comment',0)"><img src="{{ $img_pop_icon }}" alt="ProfImg" class="img-fluid"><span>{{ @App\Helpers\Utilities::feedCommentLikeCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')"><img src="{{ asset('front/images/pop_icons/6.png') }}" alt="ProfImg" class="img-fluid"><span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}',`{{ url('feed/'.$feed_id.'&question_detail='.$question_detail[0]->id.'&') }}`)" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
            </li>
         </ul>
      </div>
      <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
         <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id.'?question_detail='.$question_detail[0]->id) }}" data-title="{{$feeds[0]['title']}}"[] data-description="{{$feeds[0]['caption']}}" data-image="@if(!empty($feeds[0]['image'])){{ asset('/uploads/images/feed/'.$feeds[0]['image']) }}@elseif(!empty($feeds[0]['video_url'])){{ 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg' }}@endif"> </div>
            <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
            <hr class="mt-0">
            @include('front.feeds.feed_comment_view')
         </div>
      </div>
   </div>
@endif
@if((isset($i) && !empty($i == 15)) || (isset($j) && !empty($j == 1)))
   @php $feed_id = $feeds[0]['id']; @endphp
   <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{$feed_id}}">
      <input type="hidden" class="i_position" value="{{$i}}">
      <div class="feedCategory d-flex pb-3">
         <h6><span><b>SPONSOR</b></span></h6>
      </div>  
      
      <div class="feedPostContents">
         <div class="feedTitles d-flex">
            <div class="leftFeed">
               <h3 class="mb-0">Advertisment</h3>
            </div>
         </div>
      </div> 

      <div class="feedVidImg w-100 mt-3">
         <div class="HomeRightColInnov">
            <a href="https://bpmsagency.com/" target="_blank">
               <div class="sideBarImage">
                  <img src="{{ asset('front/images/pop-right-banner.png') }}" alt="sidebarbanner" class="img-fluid">
               </div>
            </a>
         </div>
      </div> 
   </div>
@endif
@if((isset($i) && !empty($i == 17)) || (isset($j) && !empty($j == 1)))
@php $feed_id = $feeds[0]['id']; @endphp
   <div class="popFeedPost w-100 py-4 border-bottom {{$i}}" id="feed-main-box{{$feed_id}}">
      <input type="hidden" class="i_position" value="{{$i}}">
      <div class="feedCategory d-flex pb-3">
         <h6><span><b>TRIVIA QUIZ</b></span></h6>
      </div>  
      <div class="quizPlay">
         <div class="feedPostContents">
            <div class="feedTitles d-flex">
               <div class="leftFeed">
                  <h4 class="text-center text-md-left mb-4">{{ @$quiz_question_detail[0]->question }}</h4>
               </div>
               <div class="rightFeed d-none">
                  <a href="javascript:void(0);" class="profileImg">
                     <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
                  </a>
               </div>
            </div>
         </div> 
         <div class="feed-image-post text-center feedImagesPosts">
            <div class="First-column bg-black1 pt-0">
               <div class="">
                  <div class="col-xl-12 mb-3">
                     <div class="quizLeftImg mt-4 text-center">
                        <?php
                           if(@$quiz_question_detail[0]->image ==''){
                              $image = asset('front/images/team_new.png/');
                           } else {
                              $image = asset('uploads/images/question_quiz/'.@$quiz_question_detail[0]->image);
                           }
                        ?>
                        <a href="{{$str_user_url_new}}"><img src="{{ $image }}" class="w-100"></a>
                        <!-- <div class="mt-1 text-center">
                           <a href="{{$str_user_url_new}}">
                              <h5 class="font-weight-normal text-dark">{{$str_user_name}}</h5>
                           </a>
                        </div> -->
                     </div>
                  </div>
                  <div class="col-xl-12 mb-4 deskPadLeft">
                     <form class="quiz-form" enctype="multipart/form-data" onsubmit="quiz_play(this); return false;">
                     <div>
                        @php  
                        $arr_questions_ids = App\Helpers\UtilitiesTwo::get_questions_list_new();
                        $int_ascii_val_alphabets = 65;
                        @endphp
                        @foreach($arr_questions_ids as $arr_questions_id_row)
                        @php
                        $int_question_id = $arr_questions_id_row;
                        //$str_ques_val_name_new = 'ques_'.$int_question_id.'_val';
                        $str_question_data_val_new = 'ques_'.$int_question_id.'_val';
                        $str_ques_val_name_new = 'question_id';
                        $str_str_ques_val = @$quiz_question_detail[0]->$str_question_data_val_new;
                        $str_val_alphabets = chr($int_ascii_val_alphabets);
                        $int_ascii_val_alphabets++;
                        @endphp    
                        <div id="mainDivId_{{$int_question_id}}_quiz_play">
                           <a onclick="checkQuiz(this,'_quiz_play'); return false;" href="javascript:void(0)">
                              <div id="childDivId_{{$int_question_id}}_quiz_play" class="d-flex optionsBox mb-3">
                                 <div class="d-flex">
                                    <div class="textWrapLetter text-dark mt-1"><span>{{$str_val_alphabets}}</span></div>
                                    <input type="hidden" name="" value="{{$int_question_id}}">
                                    <div class="labelContainer text-dark mb-0">
                                    <p class="mb-0">{{@$str_str_ques_val}}</p>
                                    </div>
                                 </div>
                              </div>
                           </a>
                        </div>
                        @endforeach
                        <div class="text-center" id="div-id-select-truth_quiz_play"  style="display:none;">
                           <p class="quizTextRed" style="font-size: 18px"><strong>Incorrect! You selected a Truth!</strong></p>
                        </div>
                        <div class="text-center"  id="div-id-select-lie_quiz_play" style="display:none;">
                           <p class="quizTextGreen" style="font-size: 18px"><strong>Correct! You selected a Lie!</strong></p>
                        </div>
                        <div class="text-center">
                           <input type="hidden" id="questions_id"  name="questions_id" value="@if(!empty(@$quiz_question_detail[0]->id)){{@$quiz_question_detail[0]->id}}@endif"> 
                           <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty($question_dquiz_question_detailetail[0]->quiz_id)){{@$quiz_question_detail[0]->quiz_id}}@endif"> 
                           <!-- <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty(@$quiz_question_detail[0]->id)){{@$quiz_question_detail[0]->id}}@endif">  -->
                           <input type="hidden" id="which_is_lie_quiz_play"  name="which_is_lie" value="@if(!empty(@$quiz_question_detail[0]->which_is_lie)){{@$quiz_question_detail[0]->which_is_lie}}@endif">
                           <input type="hidden" name="{{$str_ques_val_name_new}}" id="{{$str_ques_val_name_new}}"  value="">
                           <input type="hidden" name="quiz_type" value="quiz_play">
                           <button type="submit" class="btn playBtnQuiz1 btnAll">Play Again</button>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="feedLikeCmnt d-flex justify-content-end pt-2 pb-3">
         <!-- <hr class="mb-0"> -->
         @php @$ProfOptsComments = 'display:none'; @endphp
         @if(@App\Helpers\Utilities::feedCommentLikeCount($feed_id) >0 || @App\Helpers\Utilities::feedCommentCount($feed_id) >0)
         @php @$ProfOptsComments = ''; @endphp
         @endif
         
         <!-- <hr class="my-0 commentCountSectionHr{{ @$feed_id }}" style="{{ @$ProfOptsComments }}"> -->
         <ul class="list-unstyled likeLists m-0">
            <?php 
               $addLikeFeed = DB::table('feed_likes')->where(['user_id'=>$session_id,'feed_id'=>$feed_id,'type'=>'comment', 'reply_id'=>0])->get()->first();
               
               if($addLikeFeed) {
                  $is_like = 0;
                  $img_pop_icon = asset('front/images/pop_icons/like_icon.png');
               } else {
                  $is_like = 1;
                  $img_pop_icon =  asset('front/images/pop_icons/7.png');
               }
            ?>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="likeFeed(this,'{{$feed_id}}','<?= $is_like ?>','comment',0)"><img src="{{ $img_pop_icon }}" alt="ProfImg" class="img-fluid"><span>{{ @App\Helpers\Utilities::feedCommentLikeCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" onclick="feedActiveComment(this,'{{ $feed_id }}')"><img src="{{ asset('front/images/pop_icons/6.png') }}" alt="ProfImg" class="img-fluid"><span class="commentCount">{{  @App\Helpers\Utilities::feedCommentCount($feed_id)}}</span></a>
            </li>
            <li class="nav-item">
               <a href="javascript:void(0)" onclick="share_post(this,'{{ $feed_id }}',`{{ url('feed/'.$feed_id.'&quiz_question_detail='.@$quiz_question_detail[0]->id.'&') }}`)" class="btn ws-btn"><img src="{{ url('front/images/icons/share1.png') }}" alt="ProfImg" class="img-fluid"> <span>Share</span></a>
            </li>
         </ul>
      </div>
      <div class="share_btn is_show" id="share-btn{{ $feed_id }}">
         <div class="sharethis-inline-share-buttons" data-url="{{ url('feed/'.$feed_id.'?quiz_question_detail='.@$quiz_question_detail[0]->id) }}" data-title="{{$feeds[0]['title']}}" data-description="{{$feeds[0]['caption']}}" data-image="@if(!empty($feeds[0]['image'])){{ asset('/uploads/images/feed/'.$feeds[0]['image']) }}@elseif(!empty($feeds[0]['video_url'])){{ 'https://img.youtube.com/vi/'.$match[1].'/mqdefault.jpg' }}@endif"> </div>
            <div class="feedcomments comment_show" id="showComment_{{ $feed_id }}">
               <hr class="mt-0">
               @include('front.feeds.feed_comment_view')
            </div>
         </div>
   </div>
@endif

<!-- ------------------------------------------------------------------------------------ -->

@if(isset($feed_quiz_type) && !empty($feed_quiz_type))
   @php
      $str_user_name = '';
      $str_user_url_new = '#';
      $str_profile_image = '';
      if(!empty($question_detail[0]->user_id)){ 
         @$str_user_name = App\Helpers\Utilities::getUserName(@$question_detail[0]->user);
         @$str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, @$question_detail[0]->user);
         @$str_profile_image = @imageBasePath(@$question_detail[0]->user->profile_image);
      }
   @endphp
   <div class="feedPostContents">
      <div class="feedTitles d-flex">
         <div class="leftFeed">
            <h4 class="text-center text-md-left mb-4 font-weight-normal">
               @if($feed_quiz_type == 'truth_quiz_play')
                  Can you guess which is the lie?
               @elseif($feed_quiz_type == 'quiz_play')
                  {{ @$quiz_data['title'] }}
               @endif
            </h4>
         </div>
         <div class="rightFeed d-none">
            <a href="javascript:void(0);" class="profileImg">
               <img src="{{asset('front/images/mainLogo.png')}}" alt="profileimage" class="img-fluid rounded-circle">
            </a>
         </div>
      </div>
   </div> 
   <div class="feed-image-post text-center feedImagesPosts">
      <div class="First-column bg-black1 pt-0">
         <div class="">
            <input type="hidden" name="" id="hid_current_url" value="{{ url('/3-truths-and-a-lie?user='.@$question_detail[0]->user->slug) }}">
            <div class="row">
               <div class="col-xl-12 mb-3">
                  <div class="quizLeftImg mt-4 text-center">
                     @if($feed_quiz_type == 'truth_quiz_play')
                        <a href="{{$str_user_url_new}}"><img src="{{$str_profile_image}}" class="w-100"></a>
                        <div class="mt-1 text-center">
                           <a href="{{$str_user_url_new}}">
                              <h6 class="font-weight-normal text-dark ">{{$str_user_name}}</h6>
                           </a>
                        </div>
                     @elseif($feed_quiz_type == 'quiz_play')
                        <?php
                           if(@$question_detail[0]->image ==''){
                              $image = asset('front/images/team_new.png/');
                           } else {
                              $image = asset('uploads/images/question_quiz/'.@$question_detail[0]->image);
                           }
                        ?>
                        <a href="{{$str_user_url_new}}"><img src="{{ $image }}" class="w-100"></a>
                     @endif
                  </div>
               </div>
               <div class="col-xl-12 mb-4 deskPadLeft">
               <form class="quiz-form" enctype="multipart/form-data" onsubmit="quiz_play(this); return false;">
                  <div>
                     @php  
                     $arr_questions_ids = App\Helpers\UtilitiesTwo::get_questions_list_new();
                     $int_ascii_val_alphabets = 65;
                     @endphp
                     @foreach($arr_questions_ids as $arr_questions_id_row)
                        @php
                        $int_question_id = $arr_questions_id_row;
                        //$str_ques_val_name_new = 'ques_'.$int_question_id.'_val';
                        $str_question_data_val_new = 'ques_'.$int_question_id.'_val';
                        $str_ques_val_name_new = 'question_id';
                        $str_str_ques_val = @$question_detail[0]->$str_question_data_val_new;
                        $str_val_alphabets = chr($int_ascii_val_alphabets);
                        $int_ascii_val_alphabets++;
                        @endphp    
                        <div id="mainDivId_{{$int_question_id}}_{{$feed_quiz_type}}">
                           <a onclick="checkQuiz(this,'_{{$feed_quiz_type}}'); return false;" href="javascript:void(0)">
                              <div id="childDivId_{{$int_question_id}}_{{$feed_quiz_type}}" class="d-flex optionsBox mb-3">
                                 <div class="d-flex">
                                    <div class="textWrapLetter text-dark mt-1"><span>{{$str_val_alphabets}}</span></div>
                                    <input type="hidden" name="" value="{{$int_question_id}}">
                                    <div class="labelContainer text-dark mb-0">
                                    <p class="mb-0">{{@$str_str_ques_val}}</p>
                                    </div>
                                 </div>
                              </div>
                           </a>
                        </div>
                     @endforeach
                     <div class="text-center" id="div-id-select-truth_{{$feed_quiz_type}}"  style="display:none;">
                        <p class="quizTextRed" style="font-size: 18px"><strong>Incorrect! You selected a Truth!</strong></p>
                     </div>
                     <div class="text-center"  id="div-id-select-lie_{{$feed_quiz_type}}" style="display:none;">
                        <p class="quizTextGreen" style="font-size: 18px"><strong>Correct! You selected a Lie!</strong></p>
                     </div>
                     <div class="text-center">
                        <input type="hidden" id="quiz_id"  name="quiz_id" value="@if(!empty($question_detail[0]->id)){{$question_detail[0]->id}}@endif"> 
                        <input type="hidden" id="which_is_lie_{{$feed_quiz_type}}"  name="which_is_lie" value="@if(!empty($question_detail[0]->which_is_lie)){{$question_detail[0]->which_is_lie}}@endif">
                        <input type="hidden" name="{{$str_ques_val_name_new}}" id="{{$str_ques_val_name_new}}"  value="">
                        <input type="hidden" name="quiz_type" value="{{$feed_quiz_type}}">
                        <button type="submit" class="btn playBtnQuiz1 btnAll btn-primary">Play Again</button>
                     </div>
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endif