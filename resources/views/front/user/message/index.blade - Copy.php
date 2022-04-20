@extends('front.layouts.pages')
@section('content')
<style type="text/css">
   .badge {
   display: inline-block;
   padding: .25em .4em;
   font-size: 75%;
   font-weight: 700;
   line-height: 1;
   text-align: center;
   white-space: nowrap;
   vertical-align: baseline;
   border-radius: .25rem;
   }
   sup {
   top: -.5em;
   }
   sub, sup {
   position: relative;
   font-size: 75%;
   line-height: 0;
   vertical-align: baseline;
   }
   .input_msg_write{
   border: 1px solid transparent;
   }
   textarea.write_msg::-webkit-scrollbar {
   width: 5px;
   }
   @media only screen and (max-width: 600px) {
   .msg_send_btn {
   right: -13px;
   }
   }
</style>
<div class="col-md-9 col-lg-10">
   <div class="left-column border_right" >
      <div class="First-column bg-white">
         <div class="col-md-12">
            <div class="row d-flex justify-content-between p-3">
               <div class="w-50">
                  <h3 class="sec_head_text mb-0 allMessageHead">All Messages</h3>
               </div>
               @if(count($messages) > 0)
               @foreach($messages as $key => $message)
               <?php 
                  if(Auth::guard('users')->user()->id == $message->sender){
                  
                    $conversation = $message->received; 
                  
                  } else{
                  
                     $conversation = $message->send;  
                  
                  }     
                  
                  ?>
               @if(@$message_id && @$message_id == $message->id)
               <div class="w-50">
                  <h3 class="sec_head_text mb-0 pull-right msgHeadName"><small>{{@$conversation->first_name.' '.@$conversation->last_name}}</small></h3>
               </div>
               @php break; @endphp
               @else
               @php
               $receipent = App\Models\User::find($uid);
               @endphp
               @if(!empty($receipent))
               <div class="w-50">
                  <h3 class="sec_head_text mb-0 pull-right msgHeadName ">
                     <small>{{@$receipent->first_name.' '.@$receipent->last_name}}</small>
                  </h3>
               </div>
               @php break; @endphp
               @endif
               @endif
               @endforeach
               @else
               @php
               $receipent = App\Models\User::find($uid);
               @endphp
               @if(!empty($receipent))
               <div class="w-50">
                  <h3 class="sec_head_text mb-0 pull-right msgHeadName">
                     <small>{{@$receipent->first_name.' '.@$receipent->last_name}}</small>
                  </h3>
               </div>
               @endif
               @endif
            </div>
         </div>
         <div class="col-md-12">
            <div class="row ">
               <!-- <h3 class="sec_head_text text-center ml-3">All Messages</h3> -->
               <div class="chatMessaging">
                  <div class="inbox_msg">
                     <div class="inbox_people">
                        <div class="headind_srch1 ">
                           <div class="recent_heading1" style="padding: 15px 15px;">
                              <h4 style="">Recent</h4>
                           </div>
                           <!-- <div class="srch_bar"> -->
                           <!-- <div class="stylish-input-group">
                              <input type="text" class="search-bar"  placeholder="Search" >
                              
                              <span class="input-group-addon">
                              
                              <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                              
                              </span> 
                              
                              </div> -->
                           <!-- </div> -->
                        </div>
                        <div class="inbox_chat">
                           @if(count($messages) > 0)
                           @foreach($messages as $key => $message)
                           <?php 
                              if(Auth::guard('users')->user()->id == $message->sender){
                              
                                $conversation = $message->received; 
                              
                              } else{
                              
                                 $conversation = $message->send;  
                              
                              }     
                              
                              ?>
                           <div class="chat_list {{$message_id}} {{($message_id == $message->id) ? 'active_chat' : ''}}">
                              <a href="{{url('user/message?uid='.@$conversation->id)}}">
                                 <div class="chat_people">
                                    <div class="chat_img"> 
                                       @if(!empty($conversation->profile_image))
                                       <img src="{{imageBasePath($conversation->profile_image)}}" class="border-radius chatImg">
                                       @else         
                                       <img src="{{App\Helpers\Utilities::get_default_image()}}" class="border-radius chatImg">
                                       @endif
                                    </div>
                                    <div class="chat_ib">
                                       @if(!empty($message->unread_chat))
                                       @if(!empty($message->unread_chat) && Auth::guard('users')->user()->id == $message->unread_chat->receiver)
                                       <sup>
                                       <span class="badge badge-danger" style="font-size: 8px;padding: 2px 5px;">New</span>
                                       </sup>
                                       @endif 
                                       @endif
                                       <h5> <span class="chat_date">{{date('M d',strtotime($message->updated_at))}}</span></h5>
                                       <p>{{@$conversation->first_name.' '.@$conversation->last_name}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           @endforeach
                           @else
                           <!-- <div class="chat_list"> </div> -->
                           @endif
                        </div>
                     </div>
                     <div class="mesgs">
                        <div class="msg_history">
                           @if(count($chats) > 0)
                           @foreach($chats as $key => $chat)
                           <?php 
                              if(Auth::guard('users')->user()->id == $chat->sender){
                              
                                $received = $chat->receiver; 
                              
                              } else{
                              
                                $received = $chat->sender; 
                              
                              }     
                              
                              ?>
                           <?php 
                              if(Auth::guard('users')->user()->id == $chat->sender){
                              
                                $opposite = $chat->received; 
                              
                              } else{
                              
                                 $opposite = $chat->send;  
                              
                              }     
                              
                              ?>
                           @if($chat->receiver == Auth::guard('users')->user()->id)
                           <div class="incoming_msg">
                              <div class="incoming_msg_img"> 
                                 @if(!empty($opposite->profile_image))
                                 <img src="{{imageBasePath($opposite->profile_image)}}" class="border-radius textChatImg">
                                 @else         
                                 <img src="{{App\Helpers\Utilities::get_default_image()}}" class="border-radius textChatImg">
                                 @endif
                              </div>
                              <div class="received_msg {{(empty($chat->IsRead)) ? 'set_read' : ''}}">
                                 <div class="received_withd_msg">
                                    @if(empty($chat->IsRead))
                                    <sup><span class="badge badge-danger" style="font-size: 8px;padding: 2px 5px;">New</span></sup>
                                    @endif
                                    <p>{{$chat->message}}</p>
                                    <span class="time_date text-left"> {{date('h:i A | M d',strtotime($chat->created_at))}} </span>
                                 </div>
                              </div>
                           </div>
                           @else
                           <div class="outgoing_msg">
                              <div class="sent_msg">
                                 <!-- <div class="text-right" style="font-size: 12px;text-align: right">Marlie Robbins</div> -->
                                 <p>{{$chat->message}}</p>
                                 <span class="time_date text-right">{{date('h:i A | M d',strtotime($chat->created_at))}}</span> 
                              </div>
                           </div>
                           @endif
                           @endforeach
                           @else
                           @php $received = $uid; @endphp
                           @if(count($messages) == 0 && count($chats) == 0 && $uid == '')
                           <p>There are no messages in your Inbox</p>
                           @else
                           <p>Please start your conversation by writing down</p>
                           @endif
                           @endif
                        </div>
                        <div class="type_msg">
                           <div class="input_msg_write">
                              <form action="{{url('user/message/send')}}" id="SendMessage" method="post" enctype="multipart/form-data">
                                 @csrf         
                                 <input type="hidden" name="message_id" value="{{$message_id}}">
                                 <input type="hidden" name="receiver" value="{{@$received}}">
                                 <input type="hidden" name="sender" value="{{Auth::guard('users')->user()->id}}">
                                 <!-- <input type="text"   name="message" required="" class="write_msg" placeholder="Type a message" /> -->
                                 <textarea name="message" required="" style="width: 90%;" class="write_msg px-2" placeholder="Type a message"></textarea>
                                 <button class="msg_send_btn" {{empty(@$received) ? 'disabled' : ''}} type="submit">
                                 <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                 </button>
                              </form>
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
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function(){
   
       // $('.set_read').mouseenter(function() {
   
       //    console.log($(this).text());
   
       //     var fd = new FormData($('#SendMessage')[0]);
   
       //     $.ajax({
   
       //         url: "{{ route('front.user.message.read') }}",
   
       //         data: fd,
   
       //         processData: false,
   
       //         contentType: false,
   
       //         dataType: 'json',
   
       //         type: 'POST',
   
       //         beforeSend: function () {
   
       //         },
   
       //         error: function (jqXHR, exception) {
   
       //         },
   
       //         success: function (data) {
   
       //             $('.chatMessaging').load(location.href + ' .inbox_msg');
   
       //         }
   
       //     });
   
       // });
   
       setTimeout(function() {
           if($(".received_msg").hasClass('set_read') ) {
             var fd = new FormData($('#SendMessage')[0]);
             $.ajax({
                 url: "{{ route('front.user.message.read') }}",
                 data: fd,
                 processData: false,
                 contentType: false,
                 dataType: 'json',
                 type: 'POST',
                 beforeSend: function () {
                 },
                 error: function (jqXHR, exception) {
   
                 },
                 success: function (data) {
                     $('.chatMessaging').load(location.href + ' .inbox_msg');
                     $('.k_sidebar').load(location.href + ' .align-items-start');
                 }
             });
           }
       }, 2000);
   
   });
</script>
@endsection