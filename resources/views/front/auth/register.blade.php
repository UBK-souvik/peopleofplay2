@extends('front.layouts.auth')
@section('styles')
@endsection
@section('content')

<style>
    #registration-form .select2-container .select2-selection--single {
        min-height: 36px;
        width: 457px;
    }

    .select2-container{
        width: 100%!important;
    }
    @media only screen and (max-width: 600px) {
        #registration-form .select2-container .select2-selection--single {
          min-height: 36px;
          width: 233px;
      }
      .select2-dropdown{
          width: 233px!important;
      }
  }
  .st_loading{
    display: inline-block;
    /* font: normal normal normal 14px/1 FontAwesome; */
    /* font-size: inherit; */
    text-rendering: auto;
    /* -webkit-font-smoothing: antialiased; */
    -moz-osx-font-smoothing: grayscale;
    border-radius: 50%;
    border: 2px solid currentColor;
    border-right-color: transparent;
    width: 1rem;
    height: 1rem;
    vertical-align: text-bottom;
    animation: fa-spin .75s linear infinite !important;
  }
</style>
<section id="Registration">
    <div class="container k_black1" >
        <div class="row">
         <div class="col-md-12 px-5">
            <div class="row">
                <div class="col-md-7 col-md-6 col-xl-5 clearfix klogin_Style my-5 p-4 rounded mx-auto">
                    <div class="login_logo" >
                        <a href="#" class="d-block px-3 py-2 LogoStyle text-center"><img src="{{ asset('front/images/mainLogo.png') }}" class="img-fluid"></a>
                    </div>
                    <div class="PeoplePlaySignIn text-center py-2">
                        <p class="mb-0">Join the People Of Play!</p>
                        <span class="text-capitalize">({{@$plan->name}})</span>
                    </div>
                    <form  class="formStyle mt-2" id="registration-form">
                        @csrf
                        <div class="row">
                            <div class="  @if($type_of_user != 4) col-sm-6 @else col-sm-12 @endif  pr-sm-0 pr-sm-2">
                                <div class="form-group">
                                    <input  type="text" name="first_name" class="form-control" placeholder="First Name"
                                    required="required" data-error="First Name is required.">
                                </div>
                            </div>
                            @if($type_of_user != 4)
                            <div class="col-sm-6 pl-sm-0 pl-sm-2">
                                <div class="form-group">
                                    <input  type="text" name="last_name" class="form-control" placeholder="Last Name"
                                    required="required" data-error="Last Name is required.">
                                </div>
                            </div>
                            @endif
                        </div>
                    <!-- <div class="form-group">
                        <input id="form_phone" type="tel" name="contract_number" class="form-control" placeholder="Contact Number"
                            required="required" data-error="Contact Number is required.">
                        </div> -->
                        <div class="form-group">
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Email"
                            required="required" data-error="Valid email is required.">
                        </div>
                        {{-- @if($type_of_user == 2)
                          <div class="form-group">
                             <select name="role" class="form-control select2 py-3">
                                <option value="">Type</option>
                                @foreach($arr_roles_list as $id => $name)
                                @if($id == 1)@continue;@endif
                                <option value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif --}}
					<!-- <div class="form-group">
                        <select name="country" class="form-control select2">
                            <option value="">Country</option>
                            @foreach($countries as $id => $name)
                            <option value="{{$id}}" {{$ip_data && $ip_data->status !='fail'  && strtolower($ip_data->country) == strtolower($name)
                            ?
                            'selected' : ''}}>{{$name}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="pwd"
                        data-error="Password is required.">
                    </div>
                 <!--    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" id="confirm_password"
                            data-error="Confirm Password is not matched.">
                        </div> -->
                        <h3 class="textPurple" style="font-size: 23px;">Your Plan Price ${{(int) @$plan->price}}</h3>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="newsletter" checked="" value="1">
                            <label class="custom-control-label" for="customCheck">Sign up for Newsletter</label>
                        </div>
                       <!--  <div class="form-group checkboxRegister mb-0">

                            <input type="checkbox" >
                            <label for="vehicle1" class="textPurple" >Sign up for Newsletter</label>
                        </div> -->
                  <!--   <div class="form-group checkboxRegister">
                        <input type="checkbox" required="" name="term_and_condition" value="1">
                        <label for="vehicle1" class="textPurple" >I agree to these <a target="_blank" href="{{route('front.TermsAndConditions')}}" class="span-style1">Terms & Conditions</a> </label>
                    </div>   -->            

                    <input type="hidden" name="plan_id_hidden"  id="plan_id_hidden" value="{{$plan_id_encrypt}}">
                    <input type="hidden" name="type_of_user_hidden"  id="type_of_user_hidden" value="{{$type_of_user}}">

                    <div class="col-md-6">
                      <div class="form-group">
                        {!! app('captcha')->display(); !!}
                        @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                    
                    <button type="button" class="btn RedButton w-100 text-uppercase btnLogin">Complete Sign Up<!--  & Proceed to Pay --></button>
                    <button type="submit" class="btn RedButton w-100 stLoading" disabled style="display: none;"><i class="fa fa-spin st_loading"></i></button>
                    <div class="SignUpLegal py-2">
                        <p class="signup_legal mb-0"><small> By joining, you agree to our <a target="_blank" href="javascript:void(0);">Terms&nbsp;of&nbsp;Service</a> and <a target="_blank" href="javascript:void(0);">Privacy&nbsp;Policy</a>. </small></p>
                    </div>
                    <div class="text-center"><small><label class="form-check-label ForgetPwd text-secondary m-0">Already a Member?<a class="textPurple" href="{{route('front.login')}}"> Log In</a></label></small> </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection

@section('scripts')
<script>
 $(function($) {
    $("[name='contract_number']").intlTelInput({
        initialCountry: "auto",
        geoIpLookup: function(success, failure) {
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              var countryCode = (resp && resp.country) ? resp.country : "us";
              success(countryCode);
          });
        },
        
    });

    $(document).on('click','.btnLogin',function(e){
        e.preventDefault();
        $('.stLoading').show();
        $('.btnLogin').hide();
        $('.btnLogin').attr('disabled',true);
        toastr.remove();
                // if($.trim($('[name="contract_number"]').val()) != '' && $('[name="contract_number"]').intlTelInput("isValidNumber") == false) {
                //     toastr.error('{{ adminTransLang("invalid_mobile_no") }}')
                //     return false;
                // }

                // var phone = $('[name="contract_number"]').intlTelInput("getSelectedCountryData");
                // $('[name="contract_number"]').val(($('[name="contract_number"]').val()).replace(/ /g, ''));
                var fd = new FormData($('#registration-form')[0]);
                // fd.append('dial_code', phone.dialCode);


                $.ajax({
                    url: "{{ route('front.register') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    success:function(res){  
                        if(res.success == 0){
                            var err = JSON.parse(res.response);
                            var er = '';
                            $.each(err, function(k, v) { 
                                er += v+'<br>'; 
                            }); 
                            toastr.error(er,'Error');
                            $('.btnLogin').attr('disabled',false);
                            $('.btnLogin').show();
                            $('.stLoading').hide();
                        }else if(res.success == 1){
                           $('.btnLogin').attr('disabled',false);
                           toastr.success('Registration successfully','Success');
                           window.location.href = res.message;
                            $('.stLoading').hide();
                            $('.btnLogin').show();
                       }
            // $('#add_task .st_loader').hide();
            // $(e).find('.st_loader').hide();
        }
    });
            });
});
</script>
@endsection

