@extends('front.layouts.pages')
@section('content')

@php
$str_email_modify_new = 'pop****y@pop.com';
$str_classifed_application_message_new = '1-Click Application';
$int_classifed_id_new =  @$classified->id;
$int_is_free_not_logged_user =0;
 $int_is_application_saved_flag = '';
if(!isset(Auth::guard('users')->user()->type_of_user) || Auth::guard('users')->user()->type_of_user == 1)
{
$int_is_free_not_logged_user = 1;
 $int_is_application_saved_flag = $classified_application_apply;
}

  if($classified_application_apply == 1) {
  $str_classifed_application_message_new = 'Application Submitted';
}
  $str_classifed_application_new = $str_classifed_application_message_new;
  $str_classifed_application_message_saved_new = 'Application Submitted';
  $str_classified_email_new =$classified->user->email;
@endphp


<style type="text/css">

.sectionTop {
    padding: 15px;
}
</style>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="container-width">
      <div class="left-column colheightleft mx-3">
         <div class="First-column bg-white ClassifiedDetail border_right">
            <div class="col-md-12 ">
               <div class="row sectionTop">
                  <div class="col-sm-10 px-0">
                     <h2 class="text-left blogDetHead">
                       {{ $classified->title }}
                     </h2>
                     <div class="mb-0 ClassifiedPostDetail">
                        <p class="mb-0 span-text-grey"><span class="span-text-grey">by <a class="span-text-grey" target="_blank" href="{{ url('people/'.$classified->user->slug) }}">{{ $classified->user->first_name }} {{ $classified->user->last_name }} </a></span> <small class="span-text-grey ml-0 blogDate"> | {{@App\Helpers\UtilitiesTwo::get_date_from_date_time_data(@$classified->created_at)}}</small>
                        </p>
                     </div>
                  </div>
                  <div class="col-sm-2 px-0 text-sm-right">
                     <div>
                        <div class="dropdown socialDropdown SocialShareBlog mr-1 mt-2">
                           <span class="fontWeightSix myDropdownBtn dropdown-toggle" data-toggle="dropdown"> Share <a href="#" class="photo_icon fa fa-share-square-o"></a></span>
                           <div class="dropdown-content1 socialDropdownContent blogShare dropdown-menu">
                              <ul class="dropSocialShare">
                                 <li><a href="javascript:void(0);" onclick="return copyToClipboard('#hid_current_url');"><i class="fa photo_icon fa-clone"></i></a></li>
                                 <li><a target="_blank" href="http://www.facebook.com/sharer.php?u={{ url('/pop-classified-details/'.$classified->slug) }}"><i class="fa photo_icon fa-facebook"></i></a></li>
                                 <li><a target="_blank" href="http://twitter.com/share?url={{ url('/pop-classified-details/'.$classified->slug) }}"><i class="fa photo_icon fa-twitter"></i></a></li>
                                 <li><a target="_blank" href="https://www.instagram.com/?url={{ url('/pop-classified-details/'.$classified->slug) }}"><i class="fa photo_icon fa-instagram"></i></a></li>
                                 <li><a target="_blank" href="https://wa.me/?text={{ url('/pop-classified-details/'.$classified->slug) }}"><i class="fa photo_icon fa-whatsapp"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <input type="hidden" name="hid_current_url" id="hid_current_url" value="{{ url('/pop-classified-details/'.$classified->slug) }}">
            <div class="col-md-12">
               <div class="ClassifiedDetail">
                  <div>
                    {!! nl2br(@$classified->description) !!}
                  </div>
               </div>
               <div class="col-md-12 pb-3">
                    <div class="text-center mt-2" id="div-classified-application-{{$int_classifed_id_new}}">
                           <a href="javascript:void(0);" id="href-div-classified-application-{{$int_classifed_id_new}}"
                           @if(empty($int_is_application_saved_flag)) onclick="return save_classified_applicant_data({{$int_classifed_id_new}}, {{$int_is_free_not_logged_user}});" @else disabled @endif id="click-application-id-{{$int_classifed_id_new}}" class="btn py-1 px-4 clickApplicationBtn classifiedApplication-{{$int_classifed_id_new}}" style="background-color: #9900ff; color: #fff;">{{$str_classifed_application_new}}</a>
                        </div>
                        <div style="display:none;" class="text-center mt-2 textPurple" id="div-classified-application-loading-{{$int_classifed_id_new}}">
                           Loading...Please Wait.
                        </div>
               </div>
            </div>
         </div>
      </div>

      <div class="backgroundrightforblog mt-4 px-3 py-3">
         <div class="BlogBottomColumn">
            <h2 class="text-left blogSideHead">Related
               Classified
            </h2>
            <div class="row">
               @if(isset($classified_related) && !empty($classified_related))
               @foreach ($classified_related as $classifiedRow)
               <div class="col-md-6 col-lg-4 col-sm-6 RelatedCol mb-4">
                  <div class="h-100 RelatedClassifiedPost mb-3">
                  	<div class="RelatedClassifiedRecent">
                  		<h5><a href="{{ url('/pop-classified-details/'.$classifiedRow->slug) }}">{{ $classifiedRow->title }}</a></h5>
                  		<p class="relatedClassfiedshortDesc">{!! nl2br($classifiedRow->description)!!}</p>
                  	</div>
                     <a href="{{ url('/pop-classified-details/'.$classifiedRow->slug) }}" class="ClassifiedReadMoreBtn btn">
                      	Read More
                     </a>
                  </div>
               </div>
                @endforeach
               @endif
            </div>
         </div>
      </div>

   </div>
       <div class="modal fade" id="modal-classified-application-{{$int_classifed_id_new}}" style="z-index: 1050;">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                           <div class="modal-header kbg_black" >
                              <div class="row pl-3">
                                 <h4 class="text-white">Classified Application</h4>
                              </div>
                              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                           </div>

                           <div class="modal-body">
                              @if(!empty($int_is_free_not_logged_user))
                              <div class="col-md-12 strong_size">
                                 <div class="row sectionBox">
                                    <div>

                                       <h5>{{ @$str_email_modify_new}}</h5>
                                       <div class="row p-3">

                                          <h4>To reveal the email</h4>
                                          &nbsp  &nbsp
                                          <a class="textPurple" href="@if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1){{url('/change-plan/1')}}@else{{url('/login')}}@endif">
                                             <div class="bg-text w-100">
                                                <h4>@if(!empty(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 1){{'Please Upgrade your Plan'}}@else{{'Please Log In'}}@endif</h4>
                                             </div>
                                          </a>
                                       </div>
                                       <p>(Only for Basic, PRO & Company Users)</p>
                                    </div>
                                 </div>
                              </div>
                              @else
                              <p>
                                 Your 1 click application is submitted successfully, you may also send a personal email to the address below:
                              </p>
                              <div>
                                 <p>
                                    <strong class="textPurple">{{$str_classified_email_new}}</strong> &nbsp<a class="btn edit-btn-style py-2 " onclick="return copyToClipboard('#hid_current_email_complete');"> Copy
                                    </a>
                                 </p>
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                       @if(empty($int_is_free_not_logged_user))
                  <input type="hidden" name="hid_current_email_complete" id="hid_current_email_complete" value="{{$str_classified_email_new}}">
                  @endif
                  </div>
   @include('front.includes.join_mailing')
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function get_classified_detail(type_id)
   {
    window.location.href = "{{url('/')}}/pop-classified/"+type_id;
   }


   function show_classified_modal_popup_new(int_classified_id)
   {
   var modal_more_at_form = '#modal-classified-application-'+int_classified_id;
       $(modal_more_at_form).show();
       $(modal_more_at_form).css('display', 'block');
       $(modal_more_at_form).modal({ show: true });
   }
      function save_classified_applicant_data(int_classified_id, int_is_free_not_logged_user)
   {
    if(int_is_free_not_logged_user == 1)
    {
      show_classified_modal_popup_new(int_classified_id);
     }
        else
     {
        url_new ="{{url('/')}}/save-classified-applicant";

          $.ajax({
        url: url_new,
        type: 'post',
        dataType: "json",
        data: {
         int_classified_id: int_classified_id,
         token: ajax_csrf_token_new,

        },

        headers: {

         'X-CSRF-TOKEN': ajax_csrf_token_new

        },

        beforeSend: function () {
                       $('.classifiedApplication-'+int_classified_id).attr('disabled', true);
            $('#div-classified-application-'+int_classified_id).hide();
            $('#div-classified-application-loading-'+int_classified_id).show();
                       // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                   },
                   error: function (jqXHR, exception) {
                       $('.classifiedApplication-'+int_classified_id).attr('disabled', false);
                       $('#div-classified-application-'+int_classified_id).show();
            $('#div-classified-application-loading-'+int_classified_id).hide();
                       var msg = formatErrorMessage(jqXHR, exception);
                       toastr.error(msg)
                   },

        success: function( data ) {
        $('.classifiedApplication-'+int_classified_id).attr('disabled', true);
          $('.classifiedApplication-'+int_classified_id).html('{{$str_classifed_application_message_saved_new}}');
        $('#div-classified-application-'+int_classified_id).show();
        $('#div-classified-application-loading-'+int_classified_id).hide();

        $(".classifiedApplication-"+int_classified_id).unbind("click");

         document.getElementById("href-div-classified-application-"+int_classified_id).onclick=callme_new_return_func;

        toastr.success(data.message)

         show_classified_modal_popup_new(int_classified_id);

        }

         });
     }
   }

    function callme_new_return_func()
   {
    return false;
   }
</script>
@endsection
