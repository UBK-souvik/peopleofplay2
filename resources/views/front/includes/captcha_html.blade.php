@php
$str_recaptcha_site_key =	Config::get("commonconfig.recaptcha_site_key");
@endphp
<div class="form-group">
   <div id="captcha">
   </div>
   <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
   <div data-type="image" data-callback="imNotARobot" class="g-recaptcha" data-sitekey="{{$str_recaptcha_site_key}}"></div>
   <div id="mail-status"></div>
</div>
<script>
   var imNotARobot = function() {
    var get_response = grecaptcha.getResponse();	
    $('#recaptchaResponse').val(get_response);
    };
</script>