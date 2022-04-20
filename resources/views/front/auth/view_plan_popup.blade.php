@php

$plans = App\Models\Plan::where('status', 1)
            ->get();
$register_url = url('/') . '/register/';

    @$plans = @$plans->toArray();
    $price = array_column($plans, 'price');
    array_multisort($price, SORT_ASC, $plans);

@endphp


<div id="modal-user-register-plan-popup" class="modal fade" style="z-index: 1450;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content k_black"  >
      <div class="modal-body p-5">
            <section class="pricing">
               <div class="container k_black">            
                <div class="row wrap-allbox ">       
                    @foreach($plans as $plan)
                        @php $plan = (object) $plan; @endphp
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-center">{{ $plan->name }}</h5>
                                    <div class="wrap-all">
                                        <h6 class="card-price text-center"><sup>$</sup>{{ (int) $plan->price }}<span
                                                class="period">/{{ $plan->validity > 360 ? 'year' : 'month' }}</span>
                                        </h6>
                                    </div>
                                    <p class="sidetitle text-center">{{ $plan->description }}</p>
                                    <center>                 
                                        <a class="btn btnAll text-uppercase get_started" href="{{$register_url . $plan->type_of_plan . '/'. base64_encode($plan->id) }}">SELECT</a></center>
                                        

                                        <!-- <p class="sidetitle mt-3">{{ $plan->features_title }}</p> -->
                                     
                                        
                                    
                                    @php
                                        $features = @explode(',',$plan->features);
                                    @endphp
                                    <hr class="mt-3 mb-2">
                                    <div class="text-center">
                                        @foreach($features?? [] as $feature)
                                       <p class="featuresList mb-0">{{ $feature }}</p>
                                       <hr class="my-2">
                                       @endforeach
                                    </div>
                                    @if(@count($features) > 3)
                                        <a href="#!">
                                            <p class="sidetitle sidetitlelink mt-3">See All features ></p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
               </div>
            </section>
      </div>
    </div>
  </div>
</div> 

{{--
<div id="modal-user-register-plan-popup" class="modal fade" style="z-index: 1450;">
  <div class="modal-dialog modal-lg" role="document"  style="width: 1170px;">
    <div class="modal-content k_black"  >
      <div class="modal-body p-5">
            <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                       <div class="container-width">
                          <style>
                             .wrap-all {
                             background: none;
                             }
                             .featuresList{
                             font-size: 12px;
                             }
                            .pricing .card {
                                border-radius: 8px;
                                background-color: #E7E6E6;
                                min-height:582px;
                            }
                            .pricing .card-body {
                                 padding: 10px; 
                            }
                            .pricing .card-title {
                                margin: 8px 0;
                                font-size: 15px;
                                letter-spacing: 0rem;
                                font-weight: 700;
                            }
                            .pricing .card-price {
                                font-size: 40px;
                                margin: 0 0 1px 0px;
                                font-weight: 800;
                                font-family: "DIN Neuzeit Grotesk LT W01 BdCn", sans-serif!important;
                                font-style: normal;
                                color: #000!important;
                            }
                            .pricing .card-price .period {
                                 font-size: 0.9rem;
                                 color: #000!important;
                             }
                             .pricing .monthPay{
                                font-size: 13px;
                                color: #999;
                                font-weight: 600;
                             }
                             .pricing .sidetitle {
                                font-size: 11px;
                                color: #888888;
                                font-weight: 400;
                                font-family: "DIN Neuzeit Grotesk LT W01 BdCn", sans-serif!important;
                                text-transform: capitalize;
                            }
                            .featureHead{
                             font-size: 18px;
                            }
                            .text-other{
                             color: #ff6347;
                            }
                            .fontNormal{
                             font-weight: normal!important;
                            }
                          </style>
                          <section class="pricing">
                             <div class="container bg-black k_black">
                                <div class="row wrap-allbox py-5">
                                   <div class="col-md-3">
                                      <div class="card mb-3 cardBg">
                                         <div class="card-body">
                                            <h5 class="card-title m-0">PoPLITE</h5>
                                            <div class="wrap-all">
                                               <h6 class="card-price">$0<span
                                                  class="period">/year</span>
                                               </h6>
                                               <strong class="monthPay" style="">$0 / month</strong>
                                            </div>
                                            <p class="sidetitle mt-2 mb-2">For anyone who loves toys and games, and who wants to know more about the stories and people behind the magic of play.</p>
                                            <div>
                                               <a href="http://15.207.64.67/plan/purchase/2/MQ==" class="btn btnAll fontNormal text-uppercase get_started"
                                                  data-price="0" data-plan="Free"
                                                  data-plan-id="1">Get Started</a>
                                            </div>
                                            <h5 class="mt-3 mb-2 featureHead">Features</h5>
                                            <div class="mt-2">
                                               <div class="d-flex text-danger">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-danger">Basic access to information on products and the people and companies behind them</p>
                                               </div>
                                               <div class="d-flex text-info">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-info">Receive updates about People of Play and the latest products they are working on and releasing</p>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="card mb-3 cardBg">
                                         <div class="card-body">
                                            <h5 class="card-title m-0">PoPBASIC</h5>
                                            <div class="wrap-all">
                                               <h6 class="card-price">$50<span
                                                  class="period">/year</span>
                                               </h6>
                                               <strong class="monthPay" style="">$4.16 / month (billed yearly)</strong>
                                            </div>
                                            <p class="sidetitle mt-2 mb-2">Ideal for new toy and game inventors looking to get your concepts up and running, and show your products to others in the play industry.</p>
                                            <div>
                                               <a href="http://15.207.64.67/plan/purchase/2/MQ==" class="btn btnAll fontNormal text-uppercase get_started"
                                                  data-price="0" data-plan="Free"
                                                  data-plan-id="1">Get Started</a>
                                            </div>
                                            <!-- <hr class="mt-3 mb-2"> -->
                                            <h5 class="mt-3 mb-2 featureHead">Features</h5>
                                            <div class="mt-2">
                                               <div class="d-flex text-danger">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-danger">Get the latest news from leading industry innovators.</p>
                                               </div>
                                               <div class="d-flex text-info">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-info">Set up your own Innovator profile</p>
                                               </div>
                                               <div class="d-flex text-success">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-success">Show one product (with photos and videos) on your page</p>
                                               </div>
                                               <div class="d-flex text-warning">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-warning">Basic access to information on products and the people and companies behind them</p>
                                               </div>
                                               <div class="d-flex text-mute">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-mute">Receive updates about People of Play and the latest products they are working on and releasing</p>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="card mb-3 cardBg">
                                         <div class="card-body">
                                            <h5 class="card-title m-0">PoPPRO</h5>
                                            <div class="wrap-all">
                                               <h6 class="card-price">$250<span
                                                  class="period">/year</span>
                                               </h6>
                                               <strong class="monthPay" style="">$20.83 / month (billed yearly)</strong>
                                            </div>
                                            <p class="sidetitle mt-2 mb-2">Perfect for the professional inventor to build and maintain networks and stay current within the play industry.</p>
                                            <div>
                                               <a href="http://15.207.64.67/plan/purchase/2/MQ==" class="btn btnAll fontNormal text-uppercase get_started"
                                                  data-price="0" data-plan="Free"
                                                  data-plan-id="1">Get Started</a>
                                            </div>
                                            <h5 class="mt-3 mb-2 featureHead">Features</h5>
                                            <div class="mt-2">
                                               <div class="d-flex text-danger">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-danger">Access in-development products.</p>
                                               </div>
                                               <div class="d-flex text-info">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-info">Get the latest news from leading industry innovators and trades</p>
                                               </div>
                                               <div class="d-flex text-success">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-success">Set up your own Innovator profile</p>
                                               </div>
                                               <div class="d-flex text-warning">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-warning">Show unlimited products (with photos and videos) on your page</p>
                                               </div>
                                               <div class="d-flex text-mute">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-mute">Find relevant industry contacts and representation</p>
                                               </div>

                                               <div class="d-flex text-secondary">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-secondary">FULL access to information on products and the people and companies behind them</p>
                                               </div>
                                               <div class="d-flex text-primary">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-primary">Receive updates about People of Play and the latest products they are working on and releasing</p>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="card mb-3 cardBg">
                                         <div class="card-body">
                                            <h5 class="card-title m-0">PoPCOMPANY</h5>
                                            <div class="wrap-all">
                                               <h6 class="card-price">$1000<span
                                                  class="period">/year</span>
                                               </h6>
                                               <strong class="monthPay" style="">$83.33 / month (billed yearly)</strong>
                                            </div>
                                            <p class="sidetitle mt-2 mb-2">Especially designed for toy and game companies to access the People of Play, and find prospects and expertise.</p>
                                            <div>
                                               <a href="http://15.207.64.67/plan/purchase/2/MQ==" class="btn btnAll fontNormal text-uppercase get_started"
                                                  data-price="0" data-plan="Free"
                                                  data-plan-id="1">Get Started</a>
                                            </div>
                                            <h5 class="mt-3 mb-2 featureHead">Features</h5>
                                            <div class="mt-2">
                                               <div class="d-flex text-danger">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-danger">Launch Advertisement Campaigns</p>
                                               </div>
                                               <div class="d-flex text-info">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-info">Find person-to-hire based on skills</p>
                                               </div>
                                               <div class="d-flex text-success">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-success">Access in-development products</p>
                                               </div>
                                               <div class="d-flex text-warning">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-warning">Get the latest news from leading industry innovators and trades</p>
                                               </div>
                                               <div class="d-flex text-mute">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-mute">Set up your own Innovator profile</p>
                                               </div>

                                               <div class="d-flex text-secondary">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-secondary">Show unlimited products (with photos and videos) on your page</p>
                                               </div>
                                               <div class="d-flex text-primary">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-primary">Find relevant industry contacts and representation</p>
                                               </div>

                                               <div class="d-flex text-other">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-other">FULL access to information on products and the people and companies behind them</p>
                                               </div>
                                               <div class="d-flex text-dark">
                                                  <i class="fa fa-check photo_icon mt-1" aria-hidden="true"></i><p class="featuresList mb-0 oneLine text-dark">Receive updates about People of Play and the latest products they are working on and releasing</p>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </section>
                       </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
  </div>
</div>
--}}