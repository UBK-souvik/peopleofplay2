@extends('front.layouts.auth')
@section('content')

<section id="login">
    <div class="container k_black1">
        <div class="row paddingzero">
            <div class="col-md-7 col-md-6 col-xl-5 clearfix klogin_Style my-5 p-4 rounded mx-auto">
                <div class="login_logo">
                    <a href="#" class="d-block px-3 bg-white py-2 text-uppercase text-center text-bold textPurple Logostyle">Forgot Password</a>
              </div>
                <form class="formstyle mb-5 mt-2" id="loginForm">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" required="required"
                            data-error="User Name is required.">
                    </div>
                    @include('front.includes.captcha_html')
                    <div class="d-flex mb-2">
                        <button formaction="#" id="btnLogin" type="submit" class="btn RedButton w-100">SUBMIT</button>
                    </div>
                    <small><label class="form-check-label text-dark">
					<!-- data-toggle="modal" data-target="#modal-user-register-plan-popup" -->
                        <p class="mb-1 fontWeightSix text-secondary">* Not a Member? <a href="{{route('front.sign-up')}}"  class="btn-link textPurple fontWeightSix" >Sign Up</a></p>
                        <p class="mb-1 fontWeightSix text-secondary">* Already a Member? <a href="{{route('front.login')}}" class="btn-link textPurple fontWeightSix" >Log In</a></p>
                        </label></small>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
   $(function($) {

            $(document).on('click','#btnLogin',function(e){
                e.preventDefault();

                toastr.remove();

                var fd = new FormData($('#loginForm')[0]);
                $.ajax({
                    url: "{{ route('front.forgot_password') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#btnLogin').attr('disabled',true);
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#btnLogin').attr('disabled',false);

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        console.log(msg);
                        // $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#btnLogin').attr('disabled',false);
                        $('#loginForm').trigger('reset');
                        // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        toastr.success(data.message)

                    }
                });
            });
        });
</script>
@endsection
