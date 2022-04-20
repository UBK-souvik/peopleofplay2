                           @foreach ($chats as $key2 => $row_chat)
                            @if($row_chat->receiver == Auth::guard('users')->user()->id)
                             <div class="incoming_msg" style="clear: both;">
                                <div class="incoming_msg_img"> 
                                   <img src="{{imageBasePath($row_chat->profile_image)}}" class="border-radius textChatImg">
                                </div>
                                <div class="received_msg {{(empty($row_chat->IsRead)) ? 'set_read' : ''}}">
                                   <div class="received_withd_msg">
                                      @if(empty($row_chat->IsRead))
                                      <sup><span class="badge badge-danger" style="font-size: 8px;padding: 2px 5px;">New</span></sup>
                                      @endif
                                      <p>{{$row_chat->message}}</p>
                                      <span class="time_date text-left"> {{date('h:i A | M d',strtotime($row_chat->created_at))}} </span>
                                   </div>
                                </div>
                             </div>
                             @else 
                                 <div class="sent_msg" style="clear: both;">
                                 <!-- <div class="text-right" style="font-size: 12px;text-align: right">Marlie Robbins</div> -->
                                 <p>{{$row_chat->message}}</p>
                                 <span class="time_date text-right">{{date('h:i A | M d',strtotime($row_chat->created_at))}}</span> 
                              </div>
                             @endif
                             @endforeach