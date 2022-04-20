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
            <span class="freeTop FreePlan"> FREE </span>
            @elseif($plan->type_of_plan == 2)
            <span class="mostPopularTop PopPlanPopular"> MOST POPULAR </span>
            @endif
            <div class="PlanType">
              <h6>{{ $plan->name }}</h6>
              @if($plan->type_of_plan == 2)
              <small class="ProMemberSubTitle">(formerly titled Pro Membership)</small>
              @endif
            </div>
            <div class="wrap-all text-center">
             <h6 class="card-price">${{ (int) $plan->price }}<span
              class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
            </h6>
            <strong class="monthPay" style="">
              $ {{($plan->type_of_plan == 3) ? '4.16' : round($plan->price/12,2)}} / month
            </strong>
            <p class="sidetitle mt-2 mb-2">{{ $plan->description }}</p>
          </div>
        </div>
        @if($show == 1)
        <div class="TablePriceBtn mt-2 text-center">

         @if( !empty($subs) && ($subs->plan_id == $plan->id))
         @if($is_plan_expire == 1)
         @php   
         $str_chang_plan_url = $base_url . '/plan/purchase/' . $role_id . '/' . base64_encode($plan->id).'/'. 1;
         @endphp
         {{--
          <!-- <a id="change_plan_link_id_{{$plan->id}}" onclick="return goto_change_plan_new('{{$plan->id}}', '{{$str_chang_plan_url}}');" href="javascript:void(0);"   class="btn btnAll text-uppercase get_started change-plan-href-link-new" data-price="{{ $plan->price*100 }}" data-plan="{{ $plan->name }}" data-plan-id="{{ $plan->id }}">Renew Plan</a> -->
         --}}

         <a href="{{@$st_customer_invoices->hosted_invoice_url}}" class="invoiceUrl btn btn-primary font-weight-bold">Renew Plan</a>

         @else
         <h6 class="planHeadOne btn btnAll text-uppercase" class=" text-uppercase">Current Plan</h6>

         <!-- <span class="currentPlanLevel">current plan</span> -->
         @php   
         $str_chang_plan_url = $base_url . '/plan/purchase/' . $role_id . '/' . base64_encode($plan->id).'/'. 1;
         @endphp
       <!--   <a id="change_plan_link_id_{{$plan->id}}" onclick="return goto_change_plan_new('{{$plan->id}}', '{{$str_chang_plan_url}}');" href="javascript:void(0);"   class="btn btnAll text-uppercase get_started change-plan-href-link-new" data-price="{{ $plan->price*100 }}" data-plan="{{ $plan->name }}" data-plan-id="{{ $plan->id }}">@if(empty($subs->plan->price)) {{'Select'}} @else {{ ($plan->price < @$subs->plan->price) ? 'Switch' : 'Renew Plan' }} @endif</a> -->
       </center>
       @endif
       @else
       {{-- data-toggle="modal" data-target="#myMaintainance"  href="#" --}}
       @php   
       $str_chang_plan_url = $base_url . '/plan/purchase/' . $role_id . '/' . base64_encode($plan->id).'/'. 1;
       @endphp

       <a id="change_plan_link_id_{{$plan->id}}" onclick="return goto_change_plan_new('{{$plan->id}}', '{{$str_chang_plan_url.$invoice_id}}');" href="javascript:void(0);"   class="btn btnAll text-uppercase get_started change-plan-href-link-new" data-price="{{ $plan->price*100 }}" data-plan="{{ $plan->name }}" data-plan-id="{{ $plan->id }}">@if(empty($subs->plan->price)) {{'Select'}} @else {{ ($plan->price < @$subs->plan->price) ? 'Switch' : 'Upgrade' }} @endif</a>
       @endif
     </div>

     @endif

                                <!-- <div class="PlanSignUp">
                                  <a href="<?= url('/sign-up') ?>" class="btn SignUpBtn SignUpFirst">Sign Up</a>
                                </div> -->
                              </div>
                            </th>
                            @endforeach

                          </thead>
                          <tbody>
                            <tr>
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
                            <tr>
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