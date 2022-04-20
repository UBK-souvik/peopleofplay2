                          <input type="hidden"  id="chatTotalMsg" value="{{ count($chats) }}">
                          <?php
                        $cdata=array();
                          function getDateC($c_date){
                                if($c_date==date('Y-m-d')){
                                    return '<span class="dateTime"><b>Today</b></span>';
                                }
                                elseif($c_date==date('Y-m-d',strtotime('-1 day'))){
                                    return '<span class="dateTime"><b>Yesterday</b></span>';
                                }else{
                                    return '<span class="dateTime"><b>'.date('l, M d, Y',strtotime($c_date)).'</b></span>'; 
                                }
                            }
                        ?>

                        <?php //echo "<pre>"; print_r($chats); die; ?>

                           @foreach ($chats as $key2 => $row_chat)
                           <?php
                                $c_date = date('Y-m-d',strtotime($row_chat['created_at']));
                                if(!in_array($c_date,$cdata)){
                                        $cdata[]=$c_date;
                                        echo '<div class="esMsgDays text-center mt-2 mb-5"><span class="btn">'.getDateC($c_date).'</span></div>';
                                }
                                ?>
                            @if($row_chat->receiver == Auth::guard('users')->user()->id)
                            <div class="esTableFilters esChatUserActive esRightMessage">
                                            <div class="esTableLeft esMsgUser">
                                                <div class="esUsrMImg">
                                                    <img src="{{imageBasePath($row_chat->sender_profile)}}" class="img-fluid" alt="Image 111">
                                                </div>
                                            </div>
                                            <div class="esTableRight  px-5">
                                                <div class="esUserMsgBox esRightSideChat mb-4" style="<?php  if(empty($row_chat->IsRead)) {?> background-color: #FFEFF6; <?php } ?> ">
                                                    <p>{{$row_chat->message}}</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                             @else 
                                 <div class="esTableFilters esChatUserActive esLeftMessage">
                                            <div class="esTableRight  px-5">
                                                <div class="esUserMsgBox esLeftSideChat mb-4">
                                                    <p>{{$row_chat->message}}</p>
                                                </div>
                                            </div>
                                            <div class="esTableLeft esMsgUser">
                                                <div class="esUsrMImg">
                                                    <img src="{{imageBasePath($row_chat->sender_profile)}}" class="img-fluid" alt="Image 222">
                                                </div>
                                            </div>
                                        </div>
                             @endif
                             @endforeach