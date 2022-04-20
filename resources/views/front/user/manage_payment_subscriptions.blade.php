@extends('front.layouts.pages')
@section('content')

@php

$user_current_info = get_current_user_info();
$base_url = url('/');
$str_profile_user_edit = '';

$arr_menu_list = App\Helpers\UtilitiesTwo::getMenuLinks($base_url, $user_current_info);

if(!empty($user_current_info->id))
{
  $str_profile_change_plan =	$arr_menu_list['profile_change_plan'];
}

$str_user_name = App\Helpers\Utilities::getUserName($user_current_info);
$str_profile_image = @imageBasePath(@$user_current_info->profile_image);

$int_plan_id =  @$user->subscription->plan_id;
$current_url_new = URL::current();
$is_live_url_mode =  @App\Helpers\UtilitiesTwo::chkLiveCurrentUrl();
$str_loading_text = "
<div class='text-center'>
   <h3 style='font-family: myFirstFont;font-size: 20px;color: #662C92'>Loading... Please Wait.</h3>
   <p class='text-danger'>Do not press back button or refresh page.</p>
</div>
";
$str_loading_text = $str_loading_text . " 
<div class='text-center'>";
   $str_loading_text = $str_loading_text . "  <i class='fa fa-spin st_loader st_loading' style='display: none;'></i>"; 
   $str_loading_text = $str_loading_text . " 
</div>
";
@endphp

<div class="col-md-6 col-lg-7 MiddleColumnSection">
  @if($is_plan_expire == 1)
    <div class="alert alert-danger" style="margin-top:50px;">
      Please clear your outstanding invoice to reactivate your profile <b>OR</b> you can check your invoices in <a href="javascript:void(0)" class="view-invoice-history-list">invoice history</a>.
    </div>
  @endif
  <div class="left-column border_right ManagePaymentSubscription">
                     <div class="First-column bg-white p-3">


                        <h3 class="Tile-style social mb-3 pt-0">Manage Subscriptions</h3>
                        <div class="row mt-3 mx-0">

                           <div class="col-12  col-md-12 col-xl-6 mb-3 pl-0 pr-sm-3 pr-0 ">
                            <div class="border rounded  p-3 px-2">
                              <div class="row  mx-0">
                                <div class="col-md-10 col-10 pl-0">
                                  <div>
                                    <p class="text-left fontFourteen mb-1">Plan Details </p>
                                  </div>
                                  <p class="text-left fontThirteen mb-1">@if(!empty($subscription->plan->name)){{@$subscription->plan->name}}@endif</p>
                                  <p class="text-secondary fontThirteen mb-2">Active till: @if(!empty($subscription->ends_at)){{@App\Helpers\Utilities::getDateFormat($subscription->ends_at)}}@endif</p>
                                </div>
                                <div class="col-md-2 col-2 pr-0">
                                  <div class="text-right">
                                    <!-- <i class="fa fa-address-book-o fontTwenty photo_icon"></i> -->
                                    <img src="{{ asset('front/images/Plan.svg') }}">
                                  </div>
                                </div>
                                <div class="w-100">
                                  <hr class="mt-0 mb-2">
                                  <a href="{{$str_profile_change_plan}}" class="textPurple fontThirteen">Change Plan</a>&nbsp;&nbsp;@if(!empty($subscription->status) && $subscription->status ==4){{'Plan cancelled'}}@else <a href="javascript:void(0);" class="textPurple fontThirteen" id="cancel-subscription-new"> Cancel Plan </a> @endif
                                </div>
                              </div>
                            </div>
                           </div>
                           
                           <div class="col-12  col-md-12 col-xl-6 mb-3 pl-0 pr-sm-3 pr-0 ">
                            <div class="border rounded  p-3 px-2">
                              <div class="row  mx-0">
                                <div class="col-md-10 col-10 pl-0">
                                  <div>
                                    <p class="text-left fontFourteen mb-1">Payment Info </p>
                                  </div>
                                  @include('front.profile.view_credit_card_info')
                                </div>
                                <div class="col-md-2 col-2 pr-0">
                                  <div class="text-right">
                                    <!-- <i class="fa fa-address-book-o fontTwenty photo_icon"></i> -->
                                    <img src="{{ asset('front/images/CreditCard.svg') }}">
                                  </div>
                                </div>
                                <div class="w-100">
                                  <hr class="mt-0 mb-2">
                                  <a href="javascript:void(0);" id="update_card" class="textPurple fontThirteen">Edit Info</a>                                
							                    	@include('front.profile.view_update_credit_card_info')
								             </div>
                              </div>
                            </div>
                           </div>
                           <div class="col-12  col-md-12 col-xl-6 mb-3 pl-0 pr-sm-3 pr-0 ">
                            <div class="border rounded  p-3 px-2">
                              <div class="row  mx-0">
                                <div class="col-md-10 col-10 pl-0">
                                  <div>
                                    <p class="text-left fontFourteen mb-1">Billing Owner </p>
                                  </div>
                                  <p class="text-left fontThirteen mb-1">{{$str_user_name}}</p>
                                  <p class="text-secondary fontThirteen mb-2">{{@$user_current_info->email}}</p>
                                </div>
                                <div class="col-md-2 col-2 pr-0 pl-1">
                                  <div class="text-right">
                                    <!-- <i class="fa fa-address-book-o fontTwenty photo_icon"></i> -->
                                    <img width="50px" height="50px" src="{{@$str_profile_image}}" class="PaymentProfile">
                                  </div>
                                </div>
                                
								<!--<div class="w-100">
                                  <hr class="mt-0 mb-2">
                                  <a href="file:///C:/Users/Dell/Downloads/manage_subscription%20(2).html#" class="textPurple fontThirteen">Change Plan</a> , <a href="file:///C:/Users/Dell/Downloads/manage_subscription%20(2).html#" class="textPurple fontThirteen">Cancle Plan</a>
                                </div>-->
								
                              </div>
                            </div>
                           </div>
                            <div class="col-12  col-md-12 col-xl-6 mb-3 pl-0 pr-sm-3 pr-0 ">
                            <div class="border rounded  p-3 px-2">
                              <div class="row  mx-0">
                                <div class="col-md-10 col-10 pl-0">
                                  <div>
                                    <p class="text-left fontFourteen mb-1">Invoice  </p>
                                  </div>
                                  <p class="text-left fontThirteen mb-1">Subscription Id: {{@$str_subscription_id}}</p>
                                  <p class="text-secondary fontThirteen mb-2" id="div-no-invoices-id">{{App\Helpers\UtilitiesFour::getLoadingMessage()}}</p>
                                <input type="hidden" name="txt_latest_invoice_url"  id="txt_latest_invoice_url">
								  
									<div class="modal fade" id="viewInvoiceInfoPopop" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													 <h3 class="modal-title">View Invoice Info</h3>
									 
												</div>
												<div class="modal-body">
													 <div class="mb-4 mt-2" id="invoice_data_div">
																   {{App\Helpers\UtilitiesFour::getLoadingMessage()}}
														</div>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
								  
								
								</div>
                                <div class="col-md-2 col-2 pr-0">
                                  <div class="text-right">
                                    <!-- <i class="fa fa-address-book-o fontTwenty photo_icon"></i> -->
                                    <img src="{{ asset('front/images/PDF.svg') }}">
                                  </div>
                                </div>
                                <div class="w-100">
                                  <hr class="mt-0 mb-2">
                                  <a href="javascript:void(0);" id="div-view-latest-invoice" class="textPurple fontThirteen">View Latest</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="view-invoice-history-list" class="textPurple fontThirteen">Invoice History</a>
                                </div>
                                
                                
                                @if($is_plan_expire == 1)
                                <div class="w-100">
                                  
                                  <?php
                                    $disabled = $msg = '';
                                    if(@$st_customer_invoices->status == 'draft'){
                                      $disabled = 'disabled';
                                      echo '<div class="alert alert-info" style="margin-top:50px;">
                                        <strong>Info!</strong> Your invoice is in drafting state. Please wait till your invoice has been generated...
                                      </div>';
                                    }else{
                                  ?>

                                    <a href="#!" onclick="show_coupon_code('paddingTopFourtyFive');">Do you have coupon code?</a>

                                    <div class="col-md-12 paddingTopFourtyFive pr-0 pl-0" style="display:none;">
                                      <div class="payFormPop">
                                        <form class="CouponCode" id="coupon-code-form">
                                            <div class="input-group">
                                              <input type="text" type="text" class="form-control" name="coupon_code_text" id="coupon_code_text" placeholder="Coupon Code" value="">
                                              <div class="input-group-append">
                                                  <button type="button" onclick="return apply_coupon_code_data(1);" id="btn-apply-coupon-code" class="btn btn-success">Submit <i class="fa fa-spin st_loader st_loading" style="display: none;"></i></button>
                                                  <button type="button" onclick="remove_coupon_code_data(this); return false;" id="btn-remove-coupon-code" class="btn border border-danger text-danger bg-white ml-2" disabled>Remove <i class="fa fa-spin st_loader st_remove_loading" style="display: none;"></i></button>
                                              </div>
                                            </div>
                                        </form>
                                        <p class="text-danger fontFourteen" id="div-coupon-code-msg" style="display:none;"></p>
                                      </div>
                                    </div>

                                    <p>
                                      <a href="{{@$st_customer_invoices->hosted_invoice_url}}" class="pay_Now invoice_payNow invoiceUrl btn btn-primary font-weight-bold mt-2" style="width:auto;" target="blank" {{$disabled}}>Pay Now $<span class="pay_Price">{{number_format(@$st_customer_invoices->amount_remaining/100,2)}}</span></a>
                                  
                                      <a href="#!" class="pay_Now checkout_payNow btn btn-primary font-weight-bold mt-2" style="width:auto; display:none;" onclick="select_plan('{{$int_plan_id}}'); return false;">Pay Now $<span class="pay_Price">{{number_format(@$st_customer_invoices->amount_remaining/100,2)}}</span></a>

                                      <a href="#!" class="pay_Now coupon_payNow btn btn-primary font-weight-bold mt-2" style="width:auto; display:none;" onclick="save_subscription_new_ajax(0, 0, 1); return false;">Pay Now $<span class="pay_Price">{{number_format(@$st_customer_invoices->amount_remaining/100,2)}}</span></a>

                                      <input type="hidden" name="stripe_coupon_id_hidden" id="stripe_coupon_id_hidden">
                                      <input type="hidden" name="stripe_invoice_renew_id_hidden" id="stripe_invoice_renew_id_hidden" value="{{@$st_customer_invoices->id}}">
                                    </p>
                                  <?php } ?>
                                  <!-- show loading after response is received from stripe -->
                                  <div id="paymentProccess">
                                      <div id="processing" style="display:none;margin-top:50px;">
                                        <p class="text-center">{!!$str_loading_text!!}</p>
                                      </div>
                                  </div>
                                  <p id="result" class="mb-0 text-center" style="font-size:18px;color:#662C92;"></p>
                                </div>
                                @endif
                              </div>
                            </div>
                           </div>
                           <div class="col-12  col-md-12 col-xl-6 mb-3 pl-0 pr-sm-3 pr-0 ">
                            <div class="border rounded  p-3 px-2">
                              <div class="row  mx-0">
                                <div class="col-md-10 col-10 pl-0">
                                  <div>
                                    <p class="text-left fontFourteen mb-1">Contact Support </p>
                                  </div>
                                  <!-- <p class="text-left fontThirteen mb-1">Premium Workspace</p>
                                  <p class="text-secondary fontThirteen mb-2">It is a long established fact that a reader</p>
								  -->
                                </div>
                                <div class="col-md-2 col-2 pr-0">
                                  <div class="text-right">
                                    <!-- <i class="fa fa-address-book-o fontTwenty photo_icon"></i> -->
                                    <img src="{{ asset('front/images/CustomerSupport.svg') }}">
                                  </div>
                                </div>
                                <!--<div class="w-100">
                                  <hr class="mt-0 mb-2">
                                  <a href="file:///C:/Users/Dell/Downloads/manage_subscription%20(2).html#" class="textPurple fontThirteen">Change Plan</a> , <a href="file:///C:/Users/Dell/Downloads/manage_subscription%20(2).html#" class="textPurple fontThirteen">Cancle Plan</a>
                                </div> -->
                              </div>
                            </div>
                           </div>
                          
                        </div>

                        
                     </div>
                  </div>
</div>				  

		

@endsection

@section('scripts')

<script>
 $(document).ready(function(){
        
		if(document.getElementById('div_loading_id'))
		{
			show_account_info();
		}
		
		show_invoices_data(1);
		
  });

  function payNow(e,yes_url,no_url){
    
    $('.PreLoader').addClass('pre_loader_show');
    $.ajax({
      type: "POST",
      url: "{{route('front.user.site.ajax.invoices.getInvoiceId')}}",
      data: {
        _token: ajax_csrf_token_new,
        redirect_url: yes_url,
        is_coupon_code:'yes',					  
      },
      dataType:'json',
      headers: {
        'X-CSRF-TOKEN': ajax_csrf_token_new
      },
      success: function (response) {
        yes_url = response.coupon_url;

        var html = '<div class="text-dark font-weight-bold text-center mt-5 mb-5">Are you have coupon code? <div><a href="'+yes_url+'" class="btn btn-sm mr-2">YES</a><a href="'+no_url+'" class="btn btn-sm ml-2">NO</a></div></div>';

        $('#modal-user-register-plan-popup').modal('show');
        $('#modal-user-register-plan-popup .modal-content').html(html);

        $('.PreLoader').hide();
        $('.PreLoader').removeClass('pre_loader_show');
      }
    });
  }

  function show_coupon_code(cls){
    $('.'+cls).show();
  }

  function apply_coupon_code_data(chk_valid){

    var str_plan_price = '{{number_format(@$st_customer_invoices->amount_remaining/100,2)}}';

    $('.st_loading').show();
    var str_coupon_code =  $('#coupon_code_text').val();
    str_coupon_code = str_coupon_code.trim();
    if(chk_valid>0 && str_coupon_code=="")
    {
      $('#btn-apply-coupon-code').attr('disabled',true);
      $('#span-discount-id').html(0);
      $('#stripe_coupon_id_hidden').val('');
      $('#stripe_price_discount_hidden_id').val('');
      var total = $('.membershipprice').text();
      $('.pay_Price').text(total);
      document.getElementById("div-coupon-code-msg").style.display = 'block';
      document.getElementById("div-coupon-code-msg").style.setProperty("color", "red", "important");
      document.getElementById("div-coupon-code-msg").innerHTML = "Please Enter the Coupon Code";
      $('.payLegacyBtnnew').show();
      $('#customButton_save').hide();
      $('.st_loading').hide();
      $('#btn-apply-coupon-code').removeAttr('disabled');
      return false;
    }
    $.ajax({
      type: "POST",
      url: "{{ route('front.plan.coupon.code') }}",
      data:{
      str_coupon_code: str_coupon_code,
      _token: '{{csrf_token()}}',
      },
      dataType: "json",
      beforeSend: function() {
        //displayProcessing();
        $('#btn-apply-coupon-code').attr('disabled', true);
      },
      error: function(jqXHR, exception){
        $('#span-discount-id').html(0);
        $('#stripe_coupon_id_hidden').val('');
        $('#stripe_price_discount_hidden_id').val('');
        var total = $('.membershipprice').text();
        $('.pay_Price').text(total);
        $('#div-coupon-code-msg').text(jqXHR.responseJSON.msg);
        document.getElementById("div-coupon-code-msg").style.setProperty("color", "red", "important");
        $('#div-coupon-code-msg').show();
        $('.payLegacyBtnnew').show();
        $('#customButton_save').hide();
        $('.st_loading').hide();
        $('#btn-apply-coupon-code').attr('disabled', false);
      },
      success: function (response) {
        var stripe_coupon_id_new = response.message[0];
        var success_message_new = response.message[1];
        var stripe_percent_data_new = response.message[2];
        var stripe_amount_data_new = response.message[3];
        if(stripe_coupon_id_new!=''){
          if(stripe_amount_data_new!="")
          {
            var discount_per = stripe_amount_data_new;
            discount_per = stripe_amount_data_new/100;            
            discount_per = discount_per.toFixed(2);                  
            var after_apply = str_plan_price - discount_per;
          }
          else
          {
            var discount_per = str_plan_price * (stripe_percent_data_new/100);
            discount_per = discount_per.toFixed(2);                  
            var after_apply = str_plan_price - discount_per; 
          }
          $('#span-discount-id').html(discount_per);
          $('#stripe_price_discount_hidden_id').val(after_apply);         
          $('.pay_Price').html(after_apply);           
          $('#btn-apply-coupon-code').html("Re-enter <i class='fa fa-spin st_loading' style='display: none;'></i>");
          //alert(stripe_coupon_id_new);
          //$('#coupon-code-form').trigger('reset');
          //toastr.success(response.message);
          document.getElementById("div-coupon-code-msg").style.display = 'block';
          document.getElementById("div-coupon-code-msg").style.setProperty("color", "green", "important");
          document.getElementById("div-coupon-code-msg").innerHTML = success_message_new;
          $('#btn-remove-coupon-code').attr('disabled', false);
          $('#stripe_coupon_id_hidden').val(stripe_coupon_id_new);
          $('.pay_Now').hide();  
          if(after_apply<=0){
            $('.coupon_payNow').show();      
          }
          else{
            $('.checkout_payNow').show();
          }
          //var redirect = "{{get_current_user_info()->role == 1 ? route('front.user.profile') : route('front.user.company.profile')}}"
          // location = response.message
          $('.st_loading').hide();
          $('#btn-apply-coupon-code').removeAttr('disabled');
        } 
      }
    });
  }

  
  function remove_coupon_code_data(e){
    $('.st_remove_loading').show();
    $.ajax({
        type: "POST",
        url: "{{ route('front.plan.coupon.code') }}",
        data:{coupon_type:'remove_code',_token: '{{csrf_token()}}',},
        dataType: "json",
        error: function(jqXHR, exception){
          $('.st_remove_loading').hide();
          $(e).attr('disabled', false);
        },
        success: function (response) {
          if(response.status == 1){
              $('#coupon_code_text').val('');
              $(e).attr('disabled','true');
              $('#div-coupon-code-msg').html(response.msg);
              // toastr.success(response.msg,'Success');
              $('#stripe_coupon_id_hidden').val('');

              $('#span-discount-id').html(0);
              $('#stripe_coupon_id_hidden').val('');
              $('#stripe_price_discount_hidden_id').val('');
              var total = '{{number_format(@$st_customer_invoices->amount_remaining/100,2)}}';
              $('.pay_Price').text(total);
              
              $('.pay_Now').hide();
              $('.invoice_payNow').show();
              $('.st_remove_loading').hide();
          }
        }
    });
  }

  function select_plan(id) {
    displayProcessing();
    /* return false; */
    $('.payLegacyBtnnew').attr('disabled',true);
    
    var stripe_coupon_id_hidden = $('#stripe_coupon_id_hidden').val();
    
    var int_hundred_discount_flag =0;
    var str_resp_data_src_id_new = 1;
    
     fetch("{{ route('front.plan.create.checkout.session') }}", {
          method: "POST",
    headers: {
          'Content-Type': 'application/json'
        },
      body: JSON.stringify({
      _token: '{{csrf_token()}}',
      plan_id: id,
      current_url_new: '{{$current_url_new}}',
      stripe_coupon_id_hidden: stripe_coupon_id_hidden,
      })
        })
          .then(function (response) {
            $('.payLegacyBtnnew').attr('disabled',false);
            
            $('#viewInvoiceInfoPopop').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            // document.getElementById("charge-form").style.display = 'block';
            document.getElementById("result").style.display = 'block';
         
      //alert(1);
      return response.json();
          })
          .then(function (session) {
            // alert(2);
            // document.getElementById("processing").style.display = 'none';
            return stripe.redirectToCheckout({ sessionId: session.id });
            /* return window.location.href = session.url; */
          })
          .then(function (result) {
            $('.payLegacyBtnnew').attr('disabled',false);
            
            $('#viewInvoiceInfoPopop').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            // document.getElementById("charge-form").style.display = 'block';
            document.getElementById("result").style.display = 'block';
         
      //alert(3);
      // If redirectToCheckout fails due to a browser or network
            // error, you should display the localized error message to your
            // customer using error.message.
            if (result.error) {
              alert(result.error.message);
            }
          })
          .catch(function (error) {
            $('.payLegacyBtnnew').attr('disabled',false);
            
            $('#viewInvoiceInfoPopop').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            // document.getElementById("charge-form").style.display = 'block';
            document.getElementById("result").style.display = 'block';
         
      console.error("Error:", error);
          });
      }

    function displayProcessing() {

      var processHtml = $('#paymentProccess').html();
      $('#viewInvoiceInfoPopop .modal-content').html(processHtml);
      $('#viewInvoiceInfoPopop').modal({backdrop: 'static', keyboard: false});
      $('.st_loading').show();
      document.getElementById("processing").style.display = 'block';

      // document.getElementById("charge-form").style.display = 'none';
      document.getElementById("result").style.display = 'none';
    }

    function save_subscription_new_ajax(str_session_id, stripe_coupon_id_hidden, int_hundred_discount_flag){
      var int_payment_log_id = 0;
      
      var str_resp_data_src_id_new = '';
      
      $.ajax({
        type: "POST",
        url: "{{ route('front.plan.save.subscriptiondata') }}",
        data:{
          plan_id: '{{$int_plan_id}}',
          _token: '{{csrf_token()}}',
          role_id_hidden:  '{{@$role_id}}',
          change_plan: '{{@$change_plan}}',
          str_session_id: str_session_id,
          stripe_coupon_id_hidden: stripe_coupon_id_hidden,
          int_hundred_discount_flag: int_hundred_discount_flag,
          coupon_code: $('#coupon_code_text').val(),
          str_resp_data_src_id_new:str_resp_data_src_id_new,
          stripe_invoice_renew_id_hidden:$('#stripe_invoice_renew_id_hidden').val(),
        },
        dataType: "json",
        beforeSend: function() {
          displayProcessing(); 
        },
        error: function(jqXHR, exception){
          var int_payment_log_id = 0;
          
          int_payment_log_id = jqXHR.responseJSON.int_payment_log_id;
          
          if(int_payment_log_id == undefined || int_payment_log_id == "undefined" || int_payment_log_id =="")
          {
            int_payment_log_id = 0;
          }

          var msg = formatErrorMessage(jqXHR, exception);
          //toastr.error(msg)
          if(jqXHR.responseJSON.type == 'failed'){
              location = '{{@$base_url}}/payment/failed/'+int_payment_log_id;
          }else if(jqXHR.responseJSON.type == 'cancel'){
              location = '{{@$base_url}}/payment/cancel/'+int_payment_log_id;
          }else if(jqXHR.responseJSON.type == 'same_code'){
              toastr.error(jqXHR.responseJSON.msg);    
              $('.st_loading').hide();
              $('#viewInvoiceInfoPopop').modal('hide');
              document.getElementById("processing").style.display = 'none';
              document.getElementById("charge-form").style.display = 'block';
              document.getElementById("result").style.display = 'block';
          } else {
            toastr.error(msg);
            location = '{{@$base_url}}/payment/cancel/'+int_payment_log_id;
            setTimeout(function(){ location; }, 2000);
          }                
        },
        success: function (response) {              
          if(int_hundred_discount_flag<=0)
          {
            $('#charge-form').trigger('reset');
            toastr.success(response.message)
            //var redirect = "{{get_current_user_info()->role == 1 ? route('front.user.profile') : route('front.user.company.profile')}}"
            location = "{{route('front.pages.payment.success')}}";
          }
          else
          {
            location = response.message;
          }
        }
      });
      
    }
	
</script>		

@include('front.profile.include_payment_js_script')
		@endsection