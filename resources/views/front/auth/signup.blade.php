@extends('front.layouts.pages')
@section('title')
SIGN UP
@endsection

@section('content')
@php

$base_url = url('/');
$register_url = url('/') . '/register/';

@endphp

<style>
.text-grey
{
	color:#551A8B;
}
.PricingTable .table thead th h6, .PricingTable .table thead th span {
    font-size: 12px;
    font-weight: 700;
    color: #000;
}
h5.card-title {
    font-weight: 600;
    font-size: 22px;
    font-weight: 700;
    color: #000;
}
.button_1{
    background: #ffca2c !important;
}
.button_3 {
    background: #77BF4E !important;
}
.button_2 {
    background: #652C8F !important;
    color: #fff !important;
}
.button_4 {
    background: #F01A1A !important;
    color: #fff !important;
}

.SignUpPagePriceTable .freeTop {
    top: 0px !important;
}
strong.monthPay {
    font-weight: 500;
}
.sidetitle {
    color: #000 !important;
}

 .PricingTable .table thead th span {
    font-size: 12px;
    font-weight: 700;
    color: #000;
}
.PricingTable .table thead th h6{
font-size: 22px;
    font-weight: 700;
    color: #000;
  }
   h5.card-title {
    white-space: nowrap;
}
</style>
<?php //echo "<pre>"; print_r($plans); die; ?>
<div class="col-12">
  <section class="SignUpPagePriceTable">
   <div class="container bg-black1 k_black1">
    <div class="row wrap-allbox py-5">
      <div class="PricingTable table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2"></th>
            @foreach($plans as $plan) 
            @php $plan = (object) $plan; @endphp
            <th>
               <div class="TableHead text-center pt-4">
                                <div class="TablePlanHead">
                  @if($plan->type_of_plan == 1)
                  <span class="freeTop"> FREE </span>
                  @elseif($plan->type_of_plan == 2)
                  <span class="mostPopularTop"> MOST POPULAR </span>
                  @endif
                 
                    <h5 class="text-center mb-0 text-uppercase">{{ $plan->name }} </h5>
                     @if($plan->type_of_plan == 2)
                                    <small class="ProMemberSubTitle"> <b>(formerly titled Pro Membership)</b></small>
                                    @endif
                    <div class="wrap-all text-center">
                     <h6 class="card-price">${{ (int) $plan->price }}<span
                      class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
                    </h6>
                    <strong class="monthPay" style="">
                      $ {{($plan->type_of_plan == 3) ? '4.16' : round($plan->price/12,2)}} / month
                      <p class="sidetitle mt-2 mb-2">{{ $plan->description }}</p>
                    </strong>
                  </div>
                </div>
                  <div class="TablePriceBtn pt-2 text-center">
                   <!--<a class="BtnSignUp btn SignUpBtn SignUpFirst button_{{$plan->type_of_plan}}" data-toggle="modal" data-target="#myMaintainance"  href="#">SIGN UP</a>-->
                    <a class="BtnSignUp btn SignUpBtn SignUpFirst button_{{$plan->type_of_plan}}"   href="{{$register_url . $plan->type_of_plan . '/'. base64_encode($plan->id) }}">SIGN UP</a> 
                 </div>
                </div>
               </th>
               @endforeach

             </thead>
             <tbody>
               <tr class="d-none">
                <td colspan="2">POP Week Events without <br> Pitch Event (Nov 15-19)</td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon">  
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
               <tr class="d-none">
                <td colspan="2">POP Week Events with <br> Pitch Event (Nov 15-19)</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon">
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              <tr>
                <td colspan="2">Receive Industry News & Updates</td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              <tr>
                <td colspan="2">POP Pub Events & Networking</td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              <tr>
                <td colspan="2">Post Pictures & Videos</td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              <tr>
                <td colspan="2">Add Media Mentions</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              
              <tr>
                <td colspan="2">Access to Database <br> Information</td>
                <td> 
                  <span>Primary</span>
                </td>
                <td> 
                  <span>Basic</span>
                </td>
                <td> 
                  <span>Complete</span>
                </td>
                <td> 
                  <span>Complete</span>
                </td>
              </tr>
              <tr>
                <td colspan="2">Blogs</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <span>Post</span>
                </td>
                <td> 
                  <span>Post & <br> <strong>Be Featured</strong></span>
                </td>

                <td> 
                  <span>Post & <br> <strong>Be Featured</strong></span>
                </td>
              </tr>
              <tr>
                <td colspan="2">Classifieds</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <span>Apply</span>
                </td>
                <td> 
                  <span>Post &  <strong>Apply</strong></span>
                </td>

                <td> 
                  <span>Post & <strong>Apply</strong></span>
                </td>
              </tr>
              <tr>
                <td colspan="2">Products</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <span>Add 1 Product</span>
                </td>
                <td> 
                  <span>Add <strong>Unlimited</strong> & <br> Promote</span>
                </td>
                <td> 
                  <span>Add <strong>Unlimited</strong> & <br> Promote</span>
                </td>
              </tr>
              <tr>
                <td colspan="2">Use Advanced Search</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
                <td> 
                  <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
                </td>
              </tr>
              <tr>
                <td colspan="2">Be Discoverable by Skills & Location</td>
                <td> 
                  <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
                </td>
                <td> 
                 <img src="{{ asset('front/images/close.png') }}" alt="profileimage" class="TableIcon CloseIcon"> 
               </td>
               <td> 
                <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
              </td>
              <td> 
                <img src="{{ asset('front/images/check.png') }}" alt="profileimage" class="TableIcon TickIcon"> 
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </section>
</div>

<style type="text/css">
.button_1 {
  background: #007FAA;
}
.button_2 {
  background: #B03820;
}
.button_3 {
  background: #548235;
}
.button_4 {
  background: #000000;
}
</style>



<div class="modal" id="myMaintainance" style="padding-right: 17px;">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header kbg_black">
    <div class="row p-2 w-100">
     <h4 class="text-white mx-auto text-uppercase">Under Maintenance</h4>
   </div>
   <button type="button" class="close" data-dismiss="modal">×</button>
 </div>
 <div class="modal-body p-3">
  <div class="text-center">
    <h3 class="textPurple font-weight-bold">Payments Under Maintenance</h3>
    <p class="mb-0">Payments are under scheduled maintenance, come back soon. :)</p>
    <p>Till then you can review our plans and features.</p> 
    <a href="{{url('/')}}" class="btn btnAll">Go to Home Page</a>            
  </div>
</div>
</div>
</div>
</div>


@endsection

