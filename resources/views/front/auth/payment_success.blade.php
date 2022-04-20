<!doctype html>
<html lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      {{-- <link rel="stylesheet" href="https://sspsoftproindia.com/assets/css/bootstrap.min.css">--}}
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{asset('front/new/css/style_two.css') }}">
      <link rel="stylesheet" href="{{asset('front/new/css/style_three.css') }}">
      <script src="https://js.stripe.com/v3/"></script>
      <script src="https://checkout.stripe.com/checkout.js"></script>
	  @include('includes.php_debug_bar')
   </head>
   <body>
      <style>
      </style>
      <div class="container marginTwoHundred" style="">
         <div class="row text-center mx-auto">
            <div class="col-sm-8 col-sm-offset-2 mx-auto">
               <img src="{{asset('front/images/mainLogo.png') }}" width="300">
               <h2 class="headTwo successPaymentHead text-success">Payment Successful</h2>
               <p class="paraGraphPayment" style=""><strong class="text-success">Your payment was processed successfully. Pop over to the website and jump in to the world of play!</strong></p>
               <h2 class="headTwo planPayment text-success">{{@$user->plan}}</h2>
               <div class="mb-3 successPaymentTableWrap">
                  <table class="table table-striped table-bordered mx-auto" style="width: 550px;"> 
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Name</strong></td>
                        <td class="py-2">
                           {{@$user->first_name}} 
                           {{@$user->last_name ?? ''}} 
                        </td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Email</strong></td>
                        <td class="py-2">{{@$user->email ?? ''}}</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Country</strong></td>
                        <td class="py-2">{{@$user->country ?? ''}}</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Payment ID</strong></td>
                        <td class="py-2">{{@$user->stripe_payment_id ?? ''}}</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Plan Price</strong></td>
                        <td class="py-2">${{@$subs_pre_plan_price ?? ''}}</td>
                     </tr>
                     @if(!empty($str_coupon_code))
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Coupon Code</strong></td>
                        <td class="py-2">{{@$str_coupon_code ?? ''}}</td>
                     </tr>
                     @endif
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Discount</strong></td>
                        <td class="py-2">${{@$discount_per ?? ''}}</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Price after Discount</strong></td>
                        <td class="py-2">${{@$after_apply ?? ''}}</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Plan Validity</strong></td>
                        <td class="py-2">{{@$subs_pre_plan_validity ?? ''}} days</td>
                     </tr>
                     <tr>
                        <td class="py-2"><strong class="fontWeightSix">Plan Ends On</strong></td>
                        <td class="py-2">{{@$subs_pre_plan_ends_at ?? ''}}</td>
                     </tr>
                  </table>
               </div>
               <a href="{{url('/')}}" class="btn RedButton text-uppercase RedButton">POP OVER TO THE WEBSITE</a>
               <br><br>
            </div>
         </div>
      </div>
</body>
</html>	  