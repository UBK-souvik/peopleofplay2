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
    <div class="esDashboardData">
      <div class="esRightSide esMsgChatBox">
        <div class="esDashBdDiv h-100 bg-white">
          <div class="esChatBoxInbox">
            <div class="esChatBoxLeft">
              <button class="navbar-toggler">
                <span class="line1"></span>
                <span class="line2"></span>
                <span class="line3"></span>
              </button>
              <div class="esChatForToggle">
                <div class="w-100 esTableFilters esChatNotification d-flex align-items-center">
                  <div class="esTableLeft">
                    <h4 class="m-0">Chats &amp; Notifications</h4>
                  </div>
                  <div class="esTableRight p-0">
                   <!--  <a href="javascript:void(0);" class=""><img src="images/icons/search.png" class="img-fluid"></a> -->
                 </div>
               </div>
               <div class="esAllChatNotifiations">
                <div class="esOtherNotifications ss">
                  <ul class="list-unstyled esChatLists">

                    <input type="hidden" id="newUserActive" value="{{ Request::segment(3) }}">
                    <input type="hidden" id="totalMassage" value="{{ $totalMassage }}">
                    <input type="hidden" id="sidebarUserCount" value="{{ count($massageUsers) }}">
                    @foreach ($massageUsers as $key => $cuser)
                    <li class="chat_list" id="<?php if(@$massage_id == $cuser->message_id) { echo 'active'; } ?>" style="<?php if(@$cuser->sender == Auth::guard('users')->user()->id) {echo ""; } ?>">
                      <a href="javascript:void(0);" class="d-block" onclick="getMassageUserChat(this,'{{ $cuser->message_id }}','{{ $cuser->receiver }}')" id="{{ $cuser->receiver }}_{{ $cuser->message_id }}">
                        <div class="esChatWithUser">
                          <div class="esTableFilters esChatUserActive">
                            <div class="esTableLeft esMsgUser">
                              <div class="esUsrMImg newImage">
                                <img src="{{ @imageBasePath(@$cuser->profile_image)}}" class="img-fluid esImage" alt="Image">
                              </div>
                            </div>
                            <div class="esTableRight">
                              <span class="esUsName">{{ @$cuser->first_name }}  {{ @$cuser->last_name }}</span>
                              <?php echo MessageController::newMassage($cuser->message_id,$cuser->receiver); ?>
                            </div>
                          </div>
                        </div>
                      </a>
                    </li>
                   
                    @endforeach

                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="esChatBoxRight position-relative">
            <div class="esTableFilters esChatUser align-items-center">
              <div class="esTableLeft esMsgUser userTopName" style="@if(isset($newUser) && !empty($newUser)){{ '' }} @else display: none; @endif;">
                <div class="esForAns bg-white m-0">
                  <div class="esUsrMImg activeUserImage">
                    <img src="{{imageBasePath(@$newUser->profile_image)}}" class="img-fluid" alt="Image">
                  </div>
                  <h3 class="m-0 pl-3 pr-2 activeUserName"> {{ @$newUser->first_name }} {{ @$newUser->last_name }}</h3>
                </div>
              </div>              <div class="esTableRight p-0">
               <!--  <a href="javascript:void(0);" class=""><img src="images/icons/dots.png" class="img-fluid"></a> -->
             </div>
           </div>
           <div class="esInsideChatBox" id="chatBoxScrollDiv">
            <div class="esInsideMsgBox">
              <div class="esInsideRightMessage px-4 pt-3">
              </div>
            </div>
          </div>
          <div class="esEnterMessage py-2"  style=" @if(isset($newUser) && !empty($newUser)){{ '' }} @else display: none; @endif">

            <form id="messageForm" onsubmit="messageSend(this);return false;">
              @csrf
              <div class="esEnterMsg d-flex align-items-center justify-content-center">                                        <div class="esMsgInput">
                <input type="text" name="message" class="form-control border-0 mx-2" id="massage" oninput="massageText(this);" placeholder="Type your Message Here....">
                <input type="hidden" name="message_id" id="message_id" value="">
                <input type="hidden" name="sender" id="sender_id" value="{{ Auth::guard('users')->user()->id }}">
                <input type="hidden" name="receiver" id="receiver_id" value="@if(isset($newUser) && !empty($newUser)) {{ $newUser->id }} @endif">
              </div>
              <div class="esMsgSend">
                <button type="submit"  class="btn sendBtn" style="display: none;"><img src="{{ asset('front/images/icons/send.png') }}">  <i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i></button>
                <!--  <a href="javascript:void(0);" class="p-2"><img src="images/icons/send.png"></a> -->
              </div>
            </div>
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
@endsection
@section('scripts')
<script type="text/javascript">
 $(document).ready(function(){

$('.esSideBar .navbar-toggler').click(function() {
    $('.esSideBar').toggleClass('esShowSideBar');
  });

  $('.esChatBoxLeft .navbar-toggler').click(function() {
    $('.esChatBoxLeft').toggleClass('esShowSideBar');
  });

  var newUserActive = $('#newUserActive').val();
  
 
   $(".chat_list a").each(function(){
     if(newUserActive !=''){
       var activeUser =this.id.split('_');
      if(activeUser[0] == newUserActive){
        $('#message_id').val(activeUser[1]);
        getMassageUserChat(this,activeUser[1],activeUser[0]);
      }
  }
  });

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
           // getMassageBox(mgs_id,recieve_id);
          //  raedMassage(mgs_id);
         }
          // getMassageBoxSidebar(mgs_id,sidebarUserCount,totalMassage);
       }, 3000);

     });

 function getMassageBox(message_id='',receiver_id='') {
   var total_massage = $('#chatTotalMsg').val();
   $.ajax({
     url: "{{ route('front.user.messagetext') }}",
     data: {'message_id':message_id,'total_massage':total_massage},
     type: 'GET',
     dataType:'json',
     beforeSend: function () {
     },
     error: function (jqXHR, exception) {
     },
     success: function (data) {
      if(data.refresh_view == true) {
      $('.esInsideRightMessage').html(data.view);
      $(".esInsideChatBox").scrollTop($(".esInsideChatBox").prop('scrollHeight')); 
      }
    }
  });

 }

 function getMassageUserChat(e,message_id='',receiver_id='') {
  $('.chat_list').removeAttr('id');
  $(e).parent().attr('id', 'active');
  $('#message_id').val(message_id);
  $('#receiver_id').val(receiver_id);
  $('.esEnterMessage').show();
  $('.sendBtn').hide();
  $('#massage').val('');
  $('.userTopName').show();
  var esName = $(e).find('.esUsName').text();
  $('.activeUserName').text(esName);
  var esImage  = $(e).find('.newImage').html();
  $('.activeUserImage').html(esImage);
  getMassageBox(message_id,receiver_id);
}


function messageSend(e) {
  $.ajax({
   url: "{{ route('front.user.message.send') }}",
   data: $('#messageForm').serialize(),
   type: 'POST',
   dataType :'json',
     beforeSend: function () {
      $('.st_loading').show();
    },
    error: function (jqXHR, exception) {
    },
    success: function (data) {
      $('.sendBtn').hide();
      $('.esInsideRightMessage').html(data.view);
      $('.st_loading').hide();
      $("#messageForm")[0].reset();
      $(".esInsideChatBox").scrollTop($(".esInsideChatBox").prop('scrollHeight')); 
    }
  });
}

function getMassageBoxSidebar(mgs_id,no_of_users,totalMassage) {
   var total_massage = $('#totalMassage').val();
 $.ajax({
   url: "{{ route('front.user.message.massage_sidebar') }}",
   data: {"_token": "{{ csrf_token() }}",'mgs_id':mgs_id,'no_of_users':no_of_users,'total_massage':total_massage},
   type: 'POST',
   dataType:'json',
   beforeSend: function () {
   },
   error: function (jqXHR, exception) {
   },
   success: function (data) {
    if(data.sidebar == "yes") {
      $('.esChatLists').html(data.view);
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