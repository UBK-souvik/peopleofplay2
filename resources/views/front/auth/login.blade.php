@extends('front.layouts.auth')
@section('content')
 @if(Auth::guard('users')->check())
   @php
  header("Location: " . URL::to('/user/profile'), true, 302);
        exit();
        @endphp
@else
<style>
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
.cldRotated {
    display: flex;
    justify-content: flex-start;
    align-content: center;
    margin-bottom: 15px;
}
.divTwo {
    display: flex;
    align-items: center;
    position: relative;
    z-index: 11;
    max-height: 60px;
}
.frmGroup {
    margin: 0;
}
.frmGroup>div>div, .frmGroup iframe {
    width: auto !important;
}
  @media(max-width:575px){
/*     .colRotate {
    margin-top: -35px;
} */
  .cldRotated .divOne {
    width: 240px !important;
}
  .divTwo a.btn {
    padding: 4px;
    display: inline-block;
    font-size: 12px;
    line-height: 20px;
    background-color: #fff;
}
  .cldRotated {
    justify-content: space-between;
}
  }
</style>
<section id="login">
    <div class="container">
        <div class="paddingzero">
            <div class="col-md-12 px-md-5 px-3">
                <div class="row">
                <div class="col-md-10 col-xl-5 clearfix klogin_Style my-5 p-md-4 p-3 rounded mx-auto">
              <div class="login_logo" >
                <a href="#" class="d-block px-3 py-2 LogoStyle text-center"><img src="{{ asset('front/images/mainLogo.png') }}" class="img-fluid"></a>
              </div>
              <div class="PeoplePlaySignIn text-center py-2">
                <p>Log In to People Of Play!</p>
            </div>
                <form method="POST" class="formStyle mb-5 mt-2" id="loginForm" onsubmit="submit_login_form_new(); return false;">
                    @csrf
                    <div class="form-group">
                      <label for="EmailID" class="textPurple">Email</label>
                        <input type="email" class="form-control" placeholder="" name="email" required="required"
                            data-error="User Name is required.">
                    </div>
                    <div class="form-group">
                       <label for="password" class="textPurple">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password"  required="required"
                            data-error="Password is required.">
                    </div>

                    <div class="cldRotated">
                    <div class="divOne">
                      <div class="form-group position-relative frmGroup">
                        {!! app('captcha')->display(); !!}
                        @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                    <div class="divTwo colRotate">
                    <a class="btn" onclick="reload_cap(this); return false;"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                    </div>
                    </div>

                    <div>
                        <button id="btnLogin" type="submit" class="btn RedButton w-100" >LOG IN </button>
                        <button type="submit" class="btn RedButton w-100 stLoading" disabled style="display: none;"><i class="fa fa-spin st_loading"></i></button>
                    </div>
                    <div class="text-center my-2">
					  <label class="form-check-label ForgetPwd text-secondary">Not a Member? <a href="{{url('sign-up')}}" class="textPurple" >Sign Up</a> and <a class="textPurple" href="{{route('front.forgot_password')}}">Forgot Password?</a>
					  </label>
                    </div>
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Sign Up Page-->
<section>
    
	@include("front.auth.view_plan_popup")
	
	<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 Loginh3">Type of Membership</h3>
        <button type="button" class="close regclosehidden" data-dismiss="modal" aria-label="Close">
          <span class="modalclosebutton"aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body Registration">
        <form>
               <button formaction="{{route('front.register')}}?type=standard" type="submit" class="btn btn-secondary btn-lg btn-block btnLoginfree mr-2">Free Registration</button>
                <button formaction="{{route('front.register')}}?type=paid" type="submit" class="btn btn-secondary btn-lg btn-block btnLoginfree">Paid Registration</button>
         </form>
      </div>
    </div>
  </div>
	</div>


</section>
@endsection
  @endauth

@section('scripts')
<script>

   //$(function($) {

            //$(document).on('click','#btnLogin',function(e){
                //e.preventDefault();
              function submit_login_form_new() 
              {
                $('.stLoading').show();
                toastr.clear();
                toasterOptions();
                var fd = new FormData($('#loginForm')[0]);
                $.ajax({
                    url: "{{ route('front.login') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#btnLogin').attr('disabled',true);
                        $('#btnLogin').hide();
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#btnLogin').attr('disabled',false);
                        $('.stLoading').hide();
                        $('#btnLogin').show();

                        var msg = formatErrorMessage(jqXHR, exception);
                        
						console.log(msg);
						toastr.error(msg);
                        // $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#btnLogin').attr('disabled',false);
                        // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        toastr.success("Logged in Successfully")
                        window.location.replace(data.message);
                        $('.stLoading').hide();
                        $('#btnLogin').show();

                    }
                });
			  }	
            //});
        //});

      function reload_cap(e){
        $(e).addClass('reload_cap');
        grecaptcha.reset();
        setTimeout(function(){
          $(e).removeClass('reload_cap');
        },500);
        
      }

</script>
@endsection
