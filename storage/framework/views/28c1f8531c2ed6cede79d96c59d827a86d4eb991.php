<?php $__env->startSection('title'); ?>
Purchase
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
$int_plan_id =  $plan->id;
$current_url_new = URL::current();
$base_url = url('/');
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
?>
<script src="https://js.stripe.com/v3"></script>
<style>
 body{
  background-color: #fff !important;
 }

   #iframe-container iframe {
   width: 100%;
   height: 400px;
   }
   .Overlay-Badge--bottomLeft
   {
   display: none!important;
   }
   .Overlay-BadgeImage{
   display: none!important;
   }
   .Overlay-BadgeImage{
   width: 0!important;
   height: 0!important;
   }
   .featherlight-close-icon.featherlight-close{
   background-color: #662C92;
   color: #fff;
   padding: 0px 0px;
   top: 0;
   position: absolute;
   right: 218px;
   }
   .example.example1 {
   background-color: #fff;
   }
   .example.example1 * {
   font-family: Roboto, Open Sans, Segoe UI, sans-serif;
   font-size: 16px;
   font-weight: 500;
   }
   .example.example1 fieldset {
   margin: 0 15px 20px;
   padding: 0;
   border-style: none;
   background-color: #fff;
   box-shadow: 0 6px 9px rgba(50, 50, 93, 0.06), 0 2px 5px rgba(0, 0, 0, 0.08),
   inset 0 1px 0 #662C92;
   border-radius: 4px;
   }
   .example.example1 .row {
   display: -ms-flexbox;
   display: flex;
   -ms-flex-align: center;
   align-items: center;
   margin-left: 15px;
   }
   .example.example1 .row + .row {
   border-top: 1px solid #662C92;
   margin-right: 15px;
   }
   .example.example1 label {
   width: 15%;
   min-width: 70px;
   padding: 11px 0;
   color: #000;
   overflow: hidden;
   text-overflow: ellipsis;
   white-space: nowrap;
   }
   .example.example1 input, .example.example1 button {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   outline: none;
   border-style: none;
   }
   .example.example1 input::placeholder {
   color: #000!important;
   opacity: 1; /* Firefox */
   }
   .example.example1 input:-ms-input-placeholder {
   color: #000!important;
   }
   .example.example1 input::-ms-input-placeholder {
   color: #000!important;
   }
   .example.example1 input:-webkit-autofill {
   -webkit-text-fill-color: #662C92;
   transition: background-color 100000000s;
   -webkit-animation: 1ms void-animation-out;
   }
   .example.example1 .StripeElement--webkit-autofill {
   background: transparent !important;
   }
   .example.example1 .StripeElement {
   width: 100%;
   padding: 11px 15px 11px 0;
   }
   .example.example1 input {
   width: 100%;
   padding: 11px 15px 11px 0;
   color: #000;
   background-color: transparent;
   -webkit-animation: 1ms void-animation-out;
   }
   .example.example1 input::-webkit-input-placeholder {
   color: #87bbfd;
   }
   .example.example1 input::-moz-placeholder {
   color: #87bbfd;
   }
   .example.example1 input:-ms-input-placeholder {
   color: #87bbfd;
   }
   .example.example1 .payButtonPOP {
   display: block;
   width: calc(100% - 30px);
   height: 40px;
   margin: 40px 15px 0;
   background-color: #662C92;
   border-radius: 4px;
   color: #f5c518;
   font-weight: 300;
   cursor: pointer;
   }
   .example.example1 .popupClosePayment{
   font-size: 30px;
   background-color: #662C92;
   padding: 3px 10px;
   margin-right: 15px;
   color: #fff;
   margin-top: -12px;
   border-radius: 50%;
   }
   }
   .example.example1 .error svg .base {
   fill: #fff;
   }
   .example.example1 .error svg .glyph {
   fill: #6772e5;
   }
   .example.example1 .error .message {
   color: #fff;
   }
   .example.example1 .success .icon .border {
   stroke: #87bbfd;
   }
   .example.example1 .success .icon .checkmark {
   stroke: #fff;
   }
   .example.example1 .success .title {
   color: #fff;
   }
   .example.example1 .success .message {
   color: #9cdbff;
   }
   .example.example1 .success .reset path {
   fill: #fff;
   }
   .st_loader{
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
<?php
$user = get_current_user_info();
$base_url = url('/');
$str_user_url = @App\Helpers\Utilities::get_user_url($base_url, $user);
?>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div id="modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body" id="iframe-container">
            </div>
         </div>
      </div>
   </div>
   <!-- show loading after response is received from stripe -->
   <div id="paymentProccess">
      <div id="processing" style="display:none;margin-top:50px;">
         <p class="text-center"><?php echo $str_loading_text; ?></p>
      </div>
   </div>
   <p id="result" class="mb-0 text-center" style="font-size:18px;color:#662C92;"></p>
<div id="open_lightbox_iframe">
</div>
<div class="container popPaySection px-3" <?php if(!empty($str_session_id_new)): ?> style="display:none;" <?php endif; ?> id="div-delivery-address-id">
<div class="row">
   <div class="col-md-12 col-xl-6">
      <div class="row">
         <div class="col-md-6 paddingTopFourtyFive">
            <div>
               <h3 class="fontTwentyTwo">Billing Address</h3>
               <p class="mb-0 fontFifteen fontWeightSix"><?php echo e(@App\Helpers\Utilities::getUserName($user)); ?></p>
               <p class="mb-0 fontFourteen"><?php if(!empty($user->postal_address)): ?><?php echo e($user->postal_address); ?><?php endif; ?></p>
               <?php if(!empty($user->city) && !empty($user->state)): ?>
               <p class="mb-0 fontFourteen"><?php echo e($user->city); ?> , <?php echo e($user->state); ?> </p>
               <?php endif; ?>
               <p class="mb-0 fontFourteen"><?php if(!empty($user->countrydata->country_name)): ?><?php echo e($user->countrydata->country_name); ?><?php endif; ?>  <?php if(!empty($user->zip_code)): ?> <?php echo e('-'); ?> <?php echo e($user->zip_code); ?><?php endif; ?></p>
               <p class="mb-0 fontFourteen">Email : <?php echo e($user->email); ?></p>
               <!-- <p class="mb-0 fontFourteen">Phone No : +<?php echo e($user->dial_code); ?> <?php echo e($user->mobile); ?></p> -->
            </div>
         </div>
         <div class="col-md-6 paddingTopFourtyFive">
            <h3 class="fontTwentyTwo">Payment Information</h3>
            <p class="mb-0 fontWeightSix fontFifteen">Payment Method</p>
            <p class="mb-0 fontFourteen">Card</p>
         </div>
         <div class="col-md-12 paddingTopFourtyFive">
            <div class="payFormPop">
               <form class="CouponCode" id="coupon-code-form">
                  <div class="input-group">
                     <input type="text" type="text" class="form-control" name="coupon_code_text" id="coupon_code_text" placeholder="Coupon Code">
                     <div class="input-group-append">
                        <button type="button" onclick="return apply_coupon_code_data(1);" id="btn-apply-coupon-code" class="btn btn-success">Submit <i class="fa fa-spin st_loader st_loading" style="display: none;"></i></button>
                        <button type="button" onclick="remove_coupon_code_data(this); return false;" id="btn-remove-coupon-code" class="btn border border-danger text-danger bg-white ml-2" disabled>Remove <i class="fa fa-spin st_loader st_remove_loading" style="display: none;"></i></button>
                     </div>
                  </div>
               </form>
               <p class="text-danger fontFourteen" id="div-coupon-code-msg" style="display:none;"></p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-xl-6 OrderSummary">
      <hr class="d-xl-none mb-4">
      <h3 class="fontTwentyTwo">Order Summary</h3>
      <table class="w-100">
         <tr>
            <td>
               <p class="mb-0">Upgrade Plan</p>
            </td>
            <td class="text-right">
               <p class="mb-0"></p>
            </td>
         </tr>
         <tr>
            <td>
               <p class="mb-0"><?php echo e($plan->name); ?></p>
            </td>
            <td class="text-right">
               <p class="mb-0"></p>
            </td>
         </tr>
         <tr>
            <td>
               <p class="mb-0">Total Price </p>
            </td>
            <td class="text-right">
               <p class="mb-0">$<span class="membershipprice"><?php echo e((int) $plan->price); ?></span><span
                  class="period">/<?php echo e($plan->validity > 360 ? 'year' : 'month'); ?></span> </p>
            </td>
         </tr>
         <tr>
            <td>
               <p class="mb-0">Discount </p>
            </td>
            <td class="text-right">
               <p class="mb-0">$<span id="span-discount-id">0</span></p>
            </td>
         </tr>
         <tr>
            <td>
               <p class="mb-0">Order Total</p>
            </td>
            <td class="text-right">
               <p class="mb-0">$<span id="span-price-discount-id"><?php echo e((int) $plan->price); ?></span><span
                  class="period">/<?php echo e($plan->validity > 360 ? 'year' : 'month'); ?></span></p>
            </td>
         </tr>
      </table>
      <div class="mt-3 text-center">
         <form class="form-horizontal" id="charge-form">
            <div class="form-group">
               <div class="col-sm-12 p-0">
                  <input type="hidden" name="role_id_hidden" id="role_id_hidden" value="<?php echo e($role_id); ?>">
                  <input type="hidden" name="stripe_coupon_id_hidden" id="stripe_coupon_id_hidden">
                  <input type="hidden" name="stripe_price_discount_hidden_id" id="stripe_price_discount_hidden_id">
                  <div class="PaymentIcons">
                     <img src="<?php echo e(asset('front/images/payment-icon/US_standard.png')); ?>" alt="visa" class="Paymenticons img-fluid">
                  </div>
                  <!-- <ul class="nav PaymentIconDetails">
                     <li class="nav-item">
                       <a class="nav-link" href="#"><img src="<?php echo e(asset('front/images/payment-icon/visa.png')); ?>" alt="visa" class="VisaIcon"></a>
                     </li>
                     <li class="nav-item">
                       <a class="nav-link" href="#"><img src="<?php echo e(asset('front/images/payment-icon/mastercard.png')); ?>" alt="mastercard" class="MasterCardIcon"></a>
                     </li>
                     <li class="nav-item">
                       <a class="nav-link" href="#"><img src="<?php echo e(asset('front/images/payment-icon/americanexpress.png')); ?>" alt="americanexpress" class="AmericanExpressIcon"></a>
                     </li>
                     <li class="nav-item">
                       <a class="nav-link" href="#"><img src="<?php echo e(asset('front/images/payment-icon/jcb.png')); ?>" alt="jcb" class="JcbIcon"></a>
                     </li>
                     </ul> -->
                  <button id="<?php echo e($int_plan_id); ?>" onclick="select_plan(this.id)"  role="link"  type="button" class="btn btnAll my-4 payLegacyBtnnew" > Pay Now </button>
                  <button  type="button" id="customButton_save" onclick="return save_subscription_new_ajax(0, 0, 1);" class="btn btnAll" style="display:none;">Submit </button>

               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
<!--Example 1-->
<div class="modal" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="cell example example1" id="example-1" style="border: 4px solid #662C92;">
            <form  action="/charge" method="post" id="payment-form">
               <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                     <div class="text-center py-2">
                        <img src="https://pop.showboatentertainment.com/front/images/mainLogo.png" style="width: 130px;">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="error" role="alert">
                        <button type="button" class="close popupClosePayment" data-dismiss="modal">&times;</button>
                     </div>
                  </div>
               </div>
               <fieldset>
                  <div class="row">
                     <label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
                     <input id="example1-name" data-tid="elements_examples.form.name_placeholder" type="text" placeholder="Jane Doe" required="" autocomplete="name">
                  </div>
                  <div class="row">
                     <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
                     <input id="example1-email" data-tid="elements_examples.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required="" autocomplete="email">
                  </div>
                  <div class="row">
                     <label for="example1-phone" data-tid="elements_examples.form.phone_label">Phone</label>
                     <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder" type="tel" placeholder="(941) 555-0123" required="" autocomplete="tel">
                  </div>
               </fieldset>
               <fieldset>
                  <div class="row">
                     <div id="example1-card"></div>
                     <div style="color:#ff0000;" id="example1-card-errors" role="alert"></div>
                  </div>
               </fieldset>
               <button type="submit" id="btn-pay-id-new" data-tid="elements_examples.form.pay_button" class="mb-3 payButtonPOP">Click to make payment</button>
               <!-- <div class="error" role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                  <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                  <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                  </svg>
                  <span class="message"></span></div> -->
            </form>
            <!-- <div class="success">
               <div class="icon">
                 <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                   <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                   <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                 </svg>
               </div>
               <h3 class="title" data-tid="elements_examples.success.title">Payment successful</h3>
               <p class="message"><span data-tid="elements_examples.success.message">Thanks for trying Stripe Elements. No money was charged, but we generated a token: </span><span class="token">tok_189gMN2eZvKYlo2CwTBv9KKh</span></p>
               <a class="reset" href="#">
                 <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                   <path fill="#000000" d="M15,7.05492878 C10.5000495,7.55237307 7,11.3674463 7,16 C7,20.9705627 11.0294373,25 16,25 C20.9705627,25 25,20.9705627 25,16 C25,15.3627484 24.4834055,14.8461538 23.8461538,14.8461538 C23.2089022,14.8461538 22.6923077,15.3627484 22.6923077,16 C22.6923077,19.6960595 19.6960595,22.6923077 16,22.6923077 C12.3039405,22.6923077 9.30769231,19.6960595 9.30769231,16 C9.30769231,12.3039405 12.3039405,9.30769231 16,9.30769231 L16,12.0841673 C16,12.1800431 16.0275652,12.2738974 16.0794108,12.354546 C16.2287368,12.5868311 16.5380938,12.6540826 16.7703788,12.5047565 L22.3457501,8.92058924 L22.3457501,8.92058924 C22.4060014,8.88185624 22.4572275,8.83063012 22.4959605,8.7703788 C22.6452866,8.53809377 22.5780351,8.22873685 22.3457501,8.07941076 L22.3457501,8.07941076 L16.7703788,4.49524351 C16.6897301,4.44339794 16.5958758,4.41583275 16.5,4.41583275 C16.2238576,4.41583275 16,4.63969037 16,4.91583275 L16,7 L15,7 L15,7.05492878 Z M16,32 C7.163444,32 0,24.836556 0,16 C0,7.163444 7.163444,0 16,0 C24.836556,0 32,7.163444 32,16 C32,24.836556 24.836556,32 16,32 Z"></path>
                 </svg>
               </a>
               </div> -->
         </div>
      </div>
   </div>
</div>
<?php /*
   <div class="container bg-white mt-3">
       <div class="col-md-12 mt-3">
           <div class="row p-3">
           <div class="col-md-9 border">

        {{--
         <form id="payment-form" class="mr-ml-3">
                   <div  style="width: 27em; height: 3em; margin-top:18px;" id="card-element" class="mr-md-20">
                     <!-- Elements will create input elements here -->
                   </div>

                   <!-- We'll put the error messages in this element -->
                   <div id="card-errors" role="alert"></div>
                   <input type="hidden" name="role_id_hidden" id="role_id_hidden" value="{{$role_id}}">
                   <button id="submit" class="btn  btnLogin btnAll">Pay Now</button>
               </form> --}}

        <div id="processing" style="display:none;margin-top:10px;">
       <p class="text-center">Processing...</p>
     </div>

     <p id="result" class="bg-info"></p>

     <div id="open_lightbox_iframe">
     </div>

     <div id="modal" class="modal fade" tabindex="-1" role="dialog">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-body" id="iframe-container">
           </div>
         </div>
       </div>
     </div>

   <div class="d-flex">
    <form class="form-horizontal" id="charge-form">
       <div class="form-group">
         <div class="col-sm-offset-2 col-sm-10">
      <div id="card-errors" role="alert"></div>
                   <input type="hidden" name="role_id_hidden" id="role_id_hidden" value="{{$role_id}}">
          <input type="hidden" name="stripe_coupon_id_hidden" id="stripe_coupon_id_hidden">
          <input type="hidden" name="stripe_price_discount_hidden_id" id="stripe_price_discount_hidden_id">
           <button  type="button" id="customButton" class="btn btnAll">Pay Now</button>
         </div>
       </div>
     </form>
     <div>
       <form class="form-inline" id="coupon-code-form">
         <input required type="text" class="form-control" name="coupon_code_text" id="coupon_code_text" placeholder="Coupon Code" style="border-radius: 4px 0 0 4px;padding: 9px .75rem;">
         <button type="button" onclick="return apply_coupon_code_data();" id="btn-apply-coupon-code" class="btn btnAll" style="border-radius: 0 4px 4px 0;">Submit</button>
       </form>

    <p class="text-danger fontFourteen" id="div-coupon-code-msg" style="display:none;"></p>

     </div>
   </div>
           </div>
           <div class="col-md-3 p-3 border">
               <div class="">
                   <div class="wrap-all">
                       <p class="text-center">Upgrade Plan</p>
                       <h5 class="card-title text-muted text-uppercase text-center">{{ $plan->name }}</h5>
                       {{-- <h6 class="card-cut text-center"><strike>Normally ${{$plan->name }}</strike>
                       </h6> --}}
                       <h6 class="card-price text-center">Total Price: ${{ (int) $plan->price }}<span
                               class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
                       </h6>
            <h6 class="card-price text-center">Discount: $<span id="span-discount-id">0</span><span
                               class="period"></span>
                       </h6>
            <h6 class="card-price text-center">Total Price After Discount : $<span id="span-price-discount-id">{{ (int) $plan->price }}</span><span
                               class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
                       </h6>
                       {{-- <h6 class="card-save text-center">saving $0</h6> --}}
                   </div>
               </div>
           </div>
           </div>
       </div>
   </div> */ ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.6/featherlight.min.js"></script>
<!-- <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script> -->
<script type="text/javascript">

      var stripePublishableKey = "<?php echo e(\App\Models\SiteSetting::get_keys(0)); ?>";

       // Create an instance of the Stripe object with your publishable API key
      var stripe = Stripe(stripePublishableKey);
      //var checkoutButton = document.getElementById("checkout-button");

   function select_plan(id) {
    displayProcessing();
    /* return false; */
    $('.payLegacyBtnnew').attr('disabled',true);

    var stripe_coupon_id_hidden = $('#charge-form #stripe_coupon_id_hidden').val();

    var int_hundred_discount_flag =0;
    var str_resp_data_src_id_new = 1;

     fetch("<?php echo e(route('front.plan.create.checkout.session')); ?>", {
          method: "POST",
    headers: {
          'Content-Type': 'application/json'
        },
      body: JSON.stringify({
      _token: '<?php echo e(csrf_token()); ?>',
      plan_id: id,
      current_url_new: '<?php echo e($current_url_new); ?>',
      stripe_coupon_id_hidden: stripe_coupon_id_hidden,
      })
        })
          .then(function (response) {
            $('.payLegacyBtnnew').attr('disabled',false);

            $('#modal').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            document.getElementById("charge-form").style.display = 'block';
            document.getElementById("result").style.display = 'block';

      //alert(1);
      return response.json();
          })
          .then(function (session) {
            //alert(2);
            document.getElementById("processing").style.display = 'none';
            return stripe.redirectToCheckout({ sessionId: session.id });
            /* return window.location.href = session.url; */
          })
          .then(function (result) {
            $('.payLegacyBtnnew').attr('disabled',false);

            $('#modal').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            document.getElementById("charge-form").style.display = 'block';
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

            $('#modal').modal('hide');
            $('.st_loading').hide();
            document.getElementById("processing").style.display = 'none';
            document.getElementById("charge-form").style.display = 'block';
            document.getElementById("result").style.display = 'block';

      console.error("Error:", error);
          });
      }





   /*function select_plan(id) {
    var stripe = Stripe(stripePublishableKey);

      stripe.redirectToCheckout({
        lineItems: [{price: id, quantity: 1}],
        mode: 'subscription',

        successUrl: 'https://pop.showboatentertainment.com/payment/success?session_id={CHECKOUT_SESSION_ID}',
        cancelUrl: 'https://pop.showboatentertainment.com/payment/canceled',
      })
      .then(function (result) {
        if (result.error) {
          var displayError = document.getElementById('error-message');
          displayError.textContent = result.error.message;
        }
      });
    };*/

   //var amount = '<?php echo e($plan->price * 100); ?>';
   var amount = '<?php echo e($plan->price * 100); ?>';
   var currency = 'USD';
   var str_plan_price = '<?php echo e($plan->price); ?>';


   function get_discount_price()
   {
     var str_discount_price_new = $('#stripe_price_discount_hidden_id').val();

     if(str_discount_price_new!="" && str_discount_price_new!="undefined" && str_discount_price_new!=undefined)
     {
        return str_discount_price_new * 100;
     }
     else
     {
     return amount;
     }
   }


   /* var stripe = Stripe(stripePublishableKey); */

   /*
   var elements = stripe.elements();

   // Custom styling can be passed to options when creating an Element.
   var style = {
    base: {
      // Add your base input styles here. For example:
      fontSize: '16px',
      color: '#32325d',
    },
   };

   // Create an instance of the card Element.
   var card = elements.create('card', {style: style});

   // Add an instance of the card Element into the `card-element` <div>.
   card.mount('#example1-card');


   // Create a source or display an error when the form is submitted.
   var form = document.getElementById('payment-form');
   form.addEventListener('submit', function(event) {
    event.preventDefault();

    $('#btn-pay-id-new').attr('disabled',true);
    $('#btn-pay-id-new').html('Please Wait...');

    //alert('card: '+card.three_d_secure);

    stripe.createSource(card).then(function(result) {
      if (result.error) {
        // Inform the user if there was an error
        var errorElement = document.getElementById('example1-card-errors');
        errorElement.textContent = result.error.message;

      $('#btn-pay-id-new').attr('disabled',false);
         $('#btn-pay-id-new').html('Click to make payment');

      } else {
        //alert('chk 3d secure: '+    result.source.card.three_d_secure);

     // Send the source to your server
        stripeSourceHandler(result.source);

      }
    });

   }); */


   /*
   function stripeSourceHandler(source) {

   //console.log(source);
   //alert('3d1: '+source.card.three_d_secure);

   stripe
    .createPaymentMethod({
      type: 'card',
      card: card,
      billing_details: {
    name: '<?php echo e(@$user->email); ?>',
      },
    })
    .then(function(result) {
      // Handle result.error or result.paymentMethod
   //alert('pay id: '+result.paymentMethod.id);



   var str_resp_data_src_id_new = result.paymentMethod.id;

   if(str_resp_data_src_id_new!="" && str_resp_data_src_id_new!=undefined && str_resp_data_src_id_new!="undefined")
   {

    //alert('url: '+source.redirect.url);

    var amount_new = get_discount_price();

      stripe.createSource({
      type: 'three_d_secure',
      amount: amount_new,
      currency: currency,
      three_d_secure: {
      card: source.id
      },
      redirect: {
      //return_url: "https://shop.example.com/crtA6B28E1"
      return_url: "<?php echo e($current_url_new); ?>?str_resp_data_src_id_new="+str_resp_data_src_id_new
      }
    }).then(function(result) {

      //console.log(result);

      // handle result.error or result.source
      if(result.error)
      {
        //alert('error1:'+result.error);
        //alert('error2:'+result.error.code);
        //alert('error3:'+result.error.message);
      }
      //alert('result:'+result.source);
      //alert('redirect url: '+result.source.redirect.url);
      //alert('redirect status: '+result.source.redirect.status);
      //alert('3d secure authenticated: '+result.source.three_d_secure.authenticated);

      window.location.href =result.source.redirect.url;

    });


   }
      else
   {
    alert(result.error);
   }


    });

    // Insert the source ID into the form so it gets submitted to the server
    /*var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeSource');
    hiddenInput.setAttribute('value', source.id);
    form.appendChild(hiddenInput);

    alert('src: '+source.id);

    // Submit the form
    //form.submit();
   }*/



   function displayProcessing() {

      var processHtml = $('#paymentProccess').html();
      $('#modal .modal-content').html(processHtml);
      $('#modal').modal({backdrop: 'static', keyboard: false});
      $('.st_loading').show();
    document.getElementById("processing").style.display = 'block';

    document.getElementById("charge-form").style.display = 'none';
    document.getElementById("result").style.display = 'none';
   }

   function displayResult(resultText) {
      $('#modal').modal('hide');
      document.getElementById("processing").style.display = 'none';
      $('.st_loading').hide();

    document.getElementById("charge-form").style.display = 'block';
    document.getElementById("result").style.display = 'block';
    document.getElementById("result").style.height = '150px';
    document.getElementById("result").style.marginTop  = '100px';
    document.getElementById("result").style.marginLeft  = '50px';
    document.getElementById("result").style.marginBottom  = '50px';
    document.getElementById("result").innerText = resultText;
   }



   // save the subscription data
   function save_subscription_new_ajax(str_session_id, stripe_coupon_id_hidden, int_hundred_discount_flag)
   {

    //   alert ("ok");
   var int_payment_log_id = 0;

   var str_resp_data_src_id_new = '<?php echo e($str_resp_data_src_id_new); ?>';
   var invoice_Id = '<?php echo e($str_invoice_Id); ?>';

   $.ajax({
                  type: "POST",
                  url: "<?php echo e(route('front.plan.save.subscriptiondata')); ?>",
                  data:{
          plan_id: '<?php echo e($plan->id); ?>',
          _token: '<?php echo e(csrf_token()); ?>',
          role_id_hidden:  '<?php echo e($role_id); ?>',
          change_plan: '<?php echo e(@$change_plan); ?>',
          str_session_id: str_session_id,
          stripe_coupon_id_hidden: stripe_coupon_id_hidden,
          int_hundred_discount_flag: int_hundred_discount_flag,
          coupon_code: $('#coupon_code_text').val(),
          str_resp_data_src_id_new:str_resp_data_src_id_new,
          invoice_Id: invoice_Id,
        },
                  dataType: "json",
                  beforeSend: function() {
                        displayProcessing();
            //$('#submit').attr('disabled',true);
                          //$('#submit').html('Please Wait...');
                          // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                      },
                      error: function(jqXHR, exception){
                          //$('#submit').attr('disabled',false);
                          //$('#submit').html('Pay');

            var int_payment_log_id = 0;

            int_payment_log_id = jqXHR.responseJSON.int_payment_log_id;

            if(int_payment_log_id == undefined || int_payment_log_id == "undefined" || int_payment_log_id =="")
            {
              int_payment_log_id = 0;
            }

                          var msg = formatErrorMessage(jqXHR, exception);
                          //toastr.error(msg)
                          if(jqXHR.responseJSON.type == 'failed'){
                               location = '<?php echo e(@$base_url); ?>/payment/failed/'+int_payment_log_id;
                          }else if(jqXHR.responseJSON.type == 'cancel'){
                               location = '<?php echo e(@$base_url); ?>/payment/cancel/'+int_payment_log_id;
                          }else if(jqXHR.responseJSON.type == 'same_code'){
                               toastr.error(jqXHR.responseJSON.msg);
                                 $('#modal').modal('hide');
                                 $('.st_loading').hide();
                               document.getElementById("processing").style.display = 'none';
                               document.getElementById("charge-form").style.display = 'block';
                               document.getElementById("result").style.display = 'block';
                          } else {
                             toastr.error(msg);
                             location = '<?php echo e(@$base_url); ?>/payment/cancel/'+int_payment_log_id;
                             setTimeout(function(){ location; }, 2000);
                          }
                          //$('.message_box').html(msg).removeClass('hide');

            //displayResult("Unexpected card source creation response status: " + jqXHR.responseJSON.type + ". Error: " + msg);

                      },
                  success: function (response) {
                    // console.log(response);
                    // alert (response);

          if(int_hundred_discount_flag<=0)
          {
            $('#charge-form').trigger('reset');
            toastr.success(response.message)
            //var redirect = "<?php echo e(get_current_user_info()->role == 1 ? route('front.user.profile') : route('front.user.company.profile')); ?>"
            location = "<?php echo e(route('front.pages.payment.success')); ?>";
          }
          else
          {
            location = response.message;
          }
                      // location = response.message
                  }
              });

   }


   function apply_coupon_code_data(chk_valid)
   {
      // alert(chk_valid);
    $('.st_loading').show();
    var str_coupon_code =  $('#coupon_code_text').val();
    str_coupon_code = str_coupon_code.trim();
   //  alert(str_coupon_code);

    if(chk_valid>0 && str_coupon_code=="")
    {
      // alert("ok");

            $('#btn-apply-coupon-code').attr('disabled',true);
             $('#span-discount-id').html(0);
             $('#stripe_coupon_id_hidden').val('');
             $('#stripe_price_discount_hidden_id').val('');
             var total = $('.membershipprice').text();
             $('#span-price-discount-id').text(total);
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
                  url: "<?php echo e(route('front.plan.coupon.code')); ?>",
                  data:{
                   str_coupon_code: str_coupon_code,
                   _token: '<?php echo e(csrf_token()); ?>',
        },
                  dataType: "json",
                  beforeSend: function() {
                          //displayProcessing();
            $('#btn-apply-coupon-code').attr('disabled', true);
                      },
                  error: function(jqXHR, exception){
                     // console.log(jqXHR.responseJSON.msg);
                          //$('#submit').attr('disabled',false);
                          //$('#submit').html('Pay');
                          // var msg = formatErrorMessage(jqXHR, exception);
            //var json = JSON.stringify(msg);
            //console.log(json);
            // data = JSON.parse(msg);
            // console.log(data.msg);
             $('#span-discount-id').html(0);
             $('#stripe_coupon_id_hidden').val('');
             $('#stripe_price_discount_hidden_id').val('');
             var total = $('.membershipprice').text();
             $('#span-price-discount-id').text(total);
             $('#div-coupon-code-msg').text(jqXHR.responseJSON.msg);
             document.getElementById("div-coupon-code-msg").style.setProperty("color", "red", "important");
            $('#div-coupon-code-msg').show();
            $('.payLegacyBtnnew').show();
            $('#customButton_save').hide();
            // show_error_message_new(msg);
            /*if(isObject(msg))
            {
            data = JSON.parse(msg);
            console.log(data.msg);
            toastr.error(msg);
              }
            else
            {
              toastr.error(msg);
            }*/

                          $('.st_loading').hide();
                          $('#btn-apply-coupon-code').attr('disabled', false);
                      },
                                 // contentType: false,
      //  processData: false,
                  success: function (response) {
                     console.log(response);

          var stripe_coupon_id_new = response.message[0];
                      var success_message_new = response.message[1];
          var stripe_percent_data_new = response.message[2];
          var stripe_amount_data_new = response.message[3];

          if(stripe_coupon_id_new!='')
          {
            //alert(str_plan_price);
            //alert(stripe_percent_data_new);
            //alert();
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
            $('#span-price-discount-id').html(after_apply);
            $('#btn-apply-coupon-code').html("Re-enter <i class='fa fa-spin st_loading' style='display: none;'></i>");

            //alert(stripe_coupon_id_new);
            //$('#coupon-code-form').trigger('reset');
            //toastr.success(response.message);
            document.getElementById("div-coupon-code-msg").style.display = 'block';
            document.getElementById("div-coupon-code-msg").style.setProperty("color", "green", "important");
            document.getElementById("div-coupon-code-msg").innerHTML = success_message_new;

            $('#btn-remove-coupon-code').attr('disabled', false);

            $('#charge-form #stripe_coupon_id_hidden').val(stripe_coupon_id_new);

            if(after_apply<=0)
            {
               //document.getElementById("customButton").style.display = 'none';
               $('.payLegacyBtnnew').hide();
               document.getElementById("customButton_save").style.display = 'block';
            }
            else
            {
              $('.payLegacyBtnnew').show();
              //document.getElementById("customButton").style.display = 'block';
              document.getElementById("customButton_save").style.display = 'none';
            }

            //var redirect = "<?php echo e(get_current_user_info()->role == 1 ? route('front.user.profile') : route('front.user.company.profile')); ?>"
            // location = response.message
            $('.st_loading').hide();
             $('#btn-apply-coupon-code').attr('disabled', false);
          }
                  }


              });
   }

   $('body').on('click','#open_lightbox_iframe .featherlight-close',function(e){

   e.preventDefault();

   //var int_confirm_flag = confirm('Are you sure?');

   //if(int_confirm_flag)
   //{
       displayProcessing();

    document.getElementById("div-delivery-address-id").style.display = "block";
    document.getElementById("open_lightbox_iframe").style.display = "none";
      $('#modal').modal('hide');
         $('.st_loading').hide();
         document.getElementById("processing").style.display = 'none';
          document.getElementById("charge-form").style.display = 'block';
   //}


   });


   <?php /*
      $(document).ready(function(){

       @if(!empty($str_client_secret_new) && !empty($str_source_new))

         stripe3DSStatusChangedHandler('{{$str_source_new}}', '{{$str_client_secret_new}}');

        @endif
      });
      */?>
   $(document).ready(function(){

    <?php if(!empty($str_session_id_new)): ?>

     stripeNewLegacyChangedHandler('<?php echo e($str_session_id_new); ?>');

     <?php endif; ?>
   });

   function stripeNewLegacyChangedHandler(str_session_id_new) {

    /*if (source.status == 'chargeable') {
      //$.featherlight.current().close();
      var msg = '3D Secure authentication succeeded: ' + source.id + '. In a real app you would send this source ID to your backend to create the charge.';
      displayResult(msg); */

   // save subscription

   var stripe_coupon_id_hidden = $('#stripe_coupon_id_hidden').val();

      save_subscription_new_ajax(str_session_id_new, stripe_coupon_id_hidden, 0);


    /*} else if (source.status == 'failed') {
      //$.featherlight.current().close();
      var msg = '3D Secure authentication failed.';
      //displayResult(msg);
   location = '<?php echo e(@$base_url); ?>/payment/failed/0?error_message='+msg;
    } else if (source.status != 'pending') {
      //$.featherlight.current().close();
      var msg = "Unexpected 3D Secure status: " + source.status;
      //displayResult(msg);
   //location = '<?php echo e(@$base_url); ?>/payment/failed/0?error_message='+msg;
    }*/

   }

   <?php
      // save the subscription data
      /*function save_subscription_ajax(str_source_id, stripe_coupon_id_hidden, int_hundred_discount_flag)
      {
        var int_payment_log_id = 0;

        var str_resp_data_src_id_new = '{{$str_resp_data_src_id_new}}';

      $.ajax({
                      type: "POST",
                      url: "{{ route('front.plan.subscribe') }}",
                      data:{
                plan_id: '{{$plan->id}}',
                _token: '{{csrf_token()}}',
                role_id_hidden:  '{{$role_id}}',
                change_plan: '{{@$change_plan}}',
                str_source_id: str_source_id,
                stripe_coupon_id_hidden: stripe_coupon_id_hidden,
                int_hundred_discount_flag: int_hundred_discount_flag,
                str_resp_data_src_id_new:str_resp_data_src_id_new
              },
                      dataType: "json",
                      beforeSend: function() {
                              displayProcessing();
                  //$('#submit').attr('disabled',true);
                              //$('#submit').html('Please Wait...');
                              // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                          },
                      error: function(jqXHR, exception){
                              //$('#submit').attr('disabled',false);
                              //$('#submit').html('Pay');

                  var int_payment_log_id = jqXHR.responseJSON.int_payment_log_id;

                              var msg = formatErrorMessage(jqXHR, exception);
                              //toastr.error(msg)
                              if(jqXHR.responseJSON.type == 'failed'){
                                   location = '{{@$base_url}}/payment/failed/'+int_payment_log_id;
                              }else if(jqXHR.responseJSON.type == 'cancel'){
                                   location = '{{@$base_url}}/payment/cancel/'+int_payment_log_id;
                  } else {
                                   location = '{{@$base_url}}/payment/cancel/'+int_payment_log_id;
                              }
                              //$('.message_box').html(msg).removeClass('hide');

                  //displayResult("Unexpected card source creation response status: " + jqXHR.responseJSON.type + ". Error: " + msg);

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
                          // location = response.message
                      }
                  });

       }*/


      /*
      function stripe3DSStatusChangedHandler(str_source_new, str_client_secret_new) {

        /*if (source.status == 'chargeable') {
          //$.featherlight.current().close();
          var msg = '3D Secure authentication succeeded: ' + source.id + '. In a real app you would send this source ID to your backend to create the charge.';
          displayResult(msg);

        // save subscription

        var stripe_coupon_id_hidden = $('#stripe_coupon_id_hidden').val();

          //save_subscription_ajax(str_source_new, stripe_coupon_id_hidden, 0);


        /*} else if (source.status == 'failed') {
          //$.featherlight.current().close();
          var msg = '3D Secure authentication failed.';
          //displayResult(msg);
        location = '{{@$base_url}}/payment/failed/0?error_message='+msg;
        } else if (source.status != 'pending') {
          //$.featherlight.current().close();
          var msg = "Unexpected 3D Secure status: " + source.status;
          //displayResult(msg);
        //location = '{{@$base_url}}/payment/failed/0?error_message='+msg;
        }

      }*/?>

   // Create Checkout's handler
   /*var handler = StripeCheckout.configure({
    key: stripePublishableKey,
    image: '<?php echo e(asset("front/images/paymentLogo.png")); ?>',//https://stripe.com/img/documentation/checkout/marketplace.png
    locale: 'auto',
    allowRememberMe: false,
    token: function(token) {
      // use Checkout's card token to create a card source
      Stripe.source.create({
        type: 'card',
        token: token.id
      }, stripeCardResponseHandler);

      displayProcessing();
    }
   });

   $('#customButton').on('click', function(e) {

   var amount_new = get_discount_price();

    // Open Checkout with further options:
    handler.open({
      name: 'PeopleOfPlay.com',
      //description: '2 widgets',
      amount: amount_new,
      currency: currency,
   panelLabel: "Click to make payment",
    });
    e.preventDefault();
   });

   // Close Checkout on page navigation:
   $(window).on('popstate', function() {
    handler.close();
   });*/

   /*
   function stripeCardResponseHandler(status, response) {

    var amount_new = get_discount_price();

    if (response.error) {
      var message = response.error.message;
      displayResult("Unexpected card source creation response status: " + status + ". Error: " + message);
      return;
    }

    // check if the card supports 3DS
    if (response.card.three_d_secure == 'not_supported') {
      //displayResult("This card does not support 3D Secure.");
      //return;
    }

    //alert('chk 3d secure: '+    response.card.three_d_secure);

    // since we're going to use an iframe in this example, the
    // return URL will only be displayed briefly before the iframe
    // is closed. Set it to a static page on your site that says
    // something like "Please wait while your transaction is processed"
    //var returnURL = "https://shop.example.com/static_page";
      var returnURL = '<?php echo e($current_url_new); ?>';



     Stripe.confirmCardPayment(response.client_secret, {
    payment_method: {
      card: response.id,
      billing_details: {
        name: 'Jenny Rosen'
      }
    },
    setup_future_usage: 'off_session'
   }).then(function(result) {
    if (result.error) {
      // Show error to your customer
      console.log(result.error.message);
    } else {
      if (result.paymentIntent.status === 'succeeded') {
        // Show a success message to your customer
        // There's a risk of the customer closing the window before callback execution
        // Set up a webhook or plugin to listen for the payment_intent.succeeded event
        // to save the card to a Customer

        // The PaymentMethod ID can be found on result.paymentIntent.payment_method
      }
    }
   });

    // create the 3DS source from the card source
    Stripe.source.create({
      type: 'three_d_secure',
      amount: amount_new,
      currency: currency,
      three_d_secure: {
        card: response.id
      },
      redirect: {
        return_url: returnURL
      }
    }, stripe3DSecureResponseHandler);
   }

   // handle the response
   function stripe3DSecureResponseHandler(status, response) {

   //alert('status'+response.status);

   //alert(response.paymentMethod);

    if (response.error) {
      var message = response.error.message;
      displayResult("Unexpected 3DS source creation response status: " + status + ". Error: " + message);
      return;
    }

    // check the 3DS source's status
    if (response.status == 'chargeable') {
      //displayResult("This card does not support 3D Secure authentication, but liability will be shifted to the card issuer.");
      //return;
    } else if (response.status != 'pending') {
      displayResult("Unexpected 3D Secure status: " + response.status);
      return;
    }

    // start polling the source (to detect the change from pending
    // to either chargeable or failed)

    document.getElementById("div-delivery-address-id").style.display = "none";
    document.getElementById("processing").style.display = 'block';
    //document.getElementById("open_lightbox_iframe").style.display = 'block';







    // redirect to the bank website for otp verification
    //window.location.href = response.redirect.url;

    //alert(response.redirect.url);

    // open the redirect URL in an iframe
    // (in this example we're using Featherlight for convenience,
    // but this is of course not a requirement)
    //$( '#open_lightbox' ).$.featherlight({
    //var str_iframe_content = $.featherlight({
    //  loading:"<?php echo $str_loading_text; ?>",
   //iframe: response.redirect.url,
      //iframeWidth: '800',
      //iframeHeight: '600',
   //root:           '#open_lightbox_iframe',
   //openTrigger:    'click',               /* Event that triggers the lightbox */
   //closeTrigger:   'click',               /* Event that triggers the closing of the lightbox */
   /* Event that triggers the closing of the lightbox */
    //});

    //document.getElementById("iframe-div-loading").style.display = 'none';

    //var iframe = document.createElement('iframe');
    //iframe.src = response.redirect.url;
    //iframe.width = 800;
    //iframe.height = 600;

    //$( "#open_lightbox_iframe" ).append( iframe );

    //$( "#open_lightbox_iframe" ).featherlight({iframe: iframe, iframeMaxWidth: '80%', iframeWidth: 500,
   // iframeHeight: 300});


    //$("body").featherlight(
     //     iframe, {
      //    });

    //alert(str_iframe_content);

    /*var iframe = document.createElement('iframe');
    iframe.src = response.redirect.url;
    iframe.width = 600;
    iframe.height = 400;

    //document.getElementById("open_lightbox").value = ;
    //document.getElementById("open_lightbox").appendChild(str_iframe_content);
    //$('#open_lightbox').appendChild(iframe);


    console.log(response);
   }

   function stripe3DSStatusChangedHandler(status, source) {
    if (source.status == 'chargeable') {
      //$.featherlight.current().close();
      var msg = '3D Secure authentication succeeded: ' + source.id + '. In a real app you would send this source ID to your backend to create the charge.';
      displayResult(msg);

   // save subscription

   var str_source_id = source.id;
   var stripe_coupon_id_hidden = $('#stripe_coupon_id_hidden').val();

      save_subscription_ajax(str_source_id, stripe_coupon_id_hidden, 0);


    } else if (source.status == 'failed') {
      //$.featherlight.current().close();
      var msg = '3D Secure authentication failed.';
      //displayResult(msg);
   location = '<?php echo e(@$base_url); ?>/payment/failed/0?error_message='+msg;
    } else if (source.status != 'pending') {
      //$.featherlight.current().close();
      var msg = "Unexpected 3D Secure status: " + source.status;
      //displayResult(msg);
   //location = '<?php echo e(@$base_url); ?>/payment/failed/0?error_message='+msg;
    }
   }*/

   function remove_coupon_code_data(e){
      $('.st_remove_loading').show();
      $.ajax({
         type: "POST",
         url: "<?php echo e(route('front.plan.coupon.code')); ?>",
         data:{coupon_type:'remove_code',_token: '<?php echo e(csrf_token()); ?>',},
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
               $('#charge-form #stripe_coupon_id_hidden').val('');

               $('#span-discount-id').html(0);
               $('#stripe_coupon_id_hidden').val('');
               $('#stripe_price_discount_hidden_id').val('');
               var total = $('.membershipprice').text();
               $('#span-price-discount-id').text(total);

               $('.payLegacyBtnnew').show();
               $('#customButton_save').hide();
               $('.st_remove_loading').hide();
            }
         }
      });
   }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>