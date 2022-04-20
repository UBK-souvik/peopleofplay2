@extends('front.layouts.pages')
@section('content')

<?php
 use App\Http\Controllers\Front\MessageController;
 ?>
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

   #active {
    background-color: #f5c518;
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
                          <input type="hidden" id="totalMassage" value="{{ $totalMassage }}">
                          <input type="hidden" id="sidebarUserCount" value="{{ count($convertion_user) }}">
                         @foreach ($convertion_user as $key => $cuser)
                          <div class="chat_list" id="">
                            <a href="javascript:void(0);" onclick="getMassageUserChat(this,'{{ $cuser->message_id }}','{{ $cuser->receiver }}')">
                              <div class="chat_people">
                                <img src="{{ @imageBasePath($cuser->profile_image)}}" class="border-radius chatImg">
                                <span class="ml-2 text-light">{{ @$cuser->first_name }}  {{ @$cuser->last_name }}  <?php echo MessageController::newMassage($cuser->message_id,$cuser->receiver); ?> 
                                </span>
                              
                              </div>
                            </a>
                          </div>
                          @endforeach
                        </div>
                     </div>
                     <div class="mesgs">
                        <div class="msg_history">
                        </div>
                        <div class="type_msg" style="display: none;">
                           <div class="input_msg_write">
                            <form id="messageForm" onsubmit="messageSend(this);return false;">
                              @csrf
                              <input type="text" name="message" id="massage" oninput="massageText(this);" style="border: 1px solid #000;" placeholder="Enter Massage">
                              <input type="hidden" name="message_id" id="message_id" value="">
                              <input type="hidden" name="sender" id="sender_id" value="{{ Auth::guard('users')->user()->id }}">
                              <input type="hidden" name="receiver" id="receiver_id" value="">
                              <button type="submit"  class="btn btn-info sendBtn" style="display: none;"><i class="fa fa-paper-plane" aria-hidden="true" ></i>  <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i></button>
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

       setInterval(function(){ 
        var mgs_id = $('#message_id').val();
        var recieve_id = $('#receiver_id').val();
        var sidebarUserCount = $('#sidebarUserCount').val();
        var totalMassage = $('#totalMassage').val();
        if(mgs_id !='') {
          getMassageBox(mgs_id,recieve_id);
          raedMassage(mgs_id);
         }
           getMassageBoxSidebar(mgs_id,sidebarUserCount,totalMassage);
         }, 3000);
   
   });

        function getMassageBox(message_id='',receiver_id='') {
          
           $.ajax({
                   url: "{{ route('front.user.messagetext') }}",
                   data: {'message_id':message_id},
                   type: 'GET',
                   beforeSend: function () {
                   },
                   error: function (jqXHR, exception) {
                   },
                   success: function (data) {
                       $('.msg_history').html(data)
                   }
               });

   }

   function getMassageUserChat(e,message_id='',receiver_id='') {
      $('.chat_list').removeAttr('id');
      $(e).parent().attr('id', 'active');
      $('#message_id').val(message_id);
      $('#receiver_id').val(receiver_id);
      $('.type_msg').show();
      $('.sendBtn').hide();
      $('#massage').val('');
      getMassageBox(message_id,receiver_id);
   }


   function messageSend(e) {
    $.ajax({
     url: "{{ route('front.user.message.send') }}",
     data: $('#messageForm').serialize(),
     type: 'POST',
                 // dataType :'json',
                 beforeSend: function () {
                  $('.st_loading').show();
                },
                error: function (jqXHR, exception) {
                },
                success: function (data) {
                  $('.msg_history').html(data);
                  $('.st_loading').hide();
                  $("#messageForm")[0].reset();
                }
              });
  }

  function getMassageBoxSidebar(mgs_id,no_of_users,totalMassage) {
   $.ajax({
           url: "{{ route('front.user.message.massage_sidebar') }}",
           data: {"_token": "{{ csrf_token() }}",'mgs_id':mgs_id,'no_of_users':no_of_users,'totalMassage':totalMassage},
           type: 'POST',
           dataType:'json',
           beforeSend: function () {
           },
           error: function (jqXHR, exception) {
           },
           success: function (data) {
           
            if(data.sidebar == "yes") {
              alert("sdsa");
              $('.inbox_chat').html(data.view);
            }
           }
       });
  }

   function massageText(e) {
    var strlenght = $('#massage').val().length;
    if(strlenght >0)
     {
      $('.sendBtn').show();
     } else {
       $('.sendBtn').hide();
     }
   }


  function raedMassage(message_id) {
    $.ajax({
       url: "{{ route('front.user.message.read') }}",
       data: {"_token": "{{ csrf_token() }}",'message_id':message_id},
       type: 'POST',
       beforeSend: function () {
       },
       error: function (jqXHR, exception) {
       },
       success: function (data) {
           // $('.msg_history').html(data)
       }
   });
  }


</script>
@endsection