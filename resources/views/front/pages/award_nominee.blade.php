@extends('front.layouts.pages')
@section('content')

<style>
.kawardpage_section .first_box {
    border: 1px solid lightgrey;
    align-items: center;
}
.boxWidth {
    min-width: 278px;
    width: 49%;
}
.awardNomineeImg {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 100%;
}
.winner_text {
    background-color: #E2B616;
    padding: 2px 10px;
    border-radius: 3px;
    font-weight: 400;
}
.kawardpage_section .alinks {
    font-size: 14px;
    color: #5594C6;
    font-weight: 400;
}
.kawardpage_section .alinks_header {
    color: #000000;
    font-size: 17px;
    font-weight: 500;
    text-transform: capitalize;
}
 .paddingTwenty {
    padding: 20px;
}
</style>

<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column bg-white krow_margin kproduct border_right AwardNominee" >
    <div class="First-column bg-white">
        
        <div class="col-md-12">
            <div class="row sectionTop pb-0">
                <h3 class="Tile-style social mb-2 pt-0 w-100">{{$event_award->name}} <small>( {{$event_award->event->name ?? null}} )</small> </h3>
                <p>{{$event_award->description ?? null}}</p>
            </div>
        </div>


        <!-- Lattest design commented start from here -->
        <div class="col-md-12 kawardpage_section">
           <div class="row paddingTwenty pt-0">
              <div class="wrap_text w-100">
                <h3>Winner</h3>
                 <div class="kbox_wrap d-flex justify-content-between flex-wrap">
                    @foreach($event_award->nominees as $nominee)
                      @if($nominee->is_winner == 1)
                        @php
                            $name = null;
                            $image = imageBasePath('award.png');
                            $link = '#';
                            $collaborators = [];
                            if($nominee->reference_type == 2){
                                $name  = $nominee->reference;
                                // $image = null;
                            }else {
                                    if($nominee->type == 1) {
                                        $name = $nominee->product->name ?? null;
                                        $image = imageBasePath(@$nominee->product->main_image) ?? null;
                                        $link = @route('front.pages.product.detail',@$nominee->product->slug ?? '');
                                        $collaborators =  @$nominee->product->collaborators ?? null;

                                    }else {
                                        $name = @$nominee->user->first_name .' '.@$nominee->user->last_name  ?? null;
                                        $image = imageBasePath(@$nominee->user->profile_image) ?? null;
                                        $link = @route('front.pages.people.detail',@$nominee->user->slug ?? '');
                                    }
                                }
                        @endphp

                          <div class="kbox_wrap_inner d-flex justify-content-start p-2 first_box boxWidth">
                            <a href="{{$link}}">
                               <div class="mr-2">
                                  <img class="awardNomineeImg" src="{{$image}}">
                               </div>
                            </a>
                             <div class="pull-left">
                                @if($nominee->is_winner == 1)
                                  <div >
                                      <span class="winner_text">Winner</span>
                                  </div>
                                @endif
                                <div class="pull-left w-100">
                                   <a href="{{$link}}" class="alinks_header">{{$name}}</a>
                                </div>
                                  <a href="{{$link}}" class="alinks span-style1 " >View Profile</a>
                                  {{--
                                    @if(!empty($collaborators)) 
                                        <span class="collaboratorsText" style="font-size: 15px;">Collaborators </span>:               
                                          @foreach ($collaborators as $collaborator)
                                          <a href="{{$link}}" class="alinks span-style1 " >{{$collaborator->name}}</a>,
                                          @endforeach
                                    @endif
                                  --}}
                             </div>
                          </div>
                      @endif
                    @endforeach
                 </div>
              </div>
           </div>
        </div>
      
        <div class="col-md-12 kawardpage_section">
           <div class="row paddingTwenty pt-0">
              <div class="wrap_text w-100">
                <h3>Nominee's</h3>
                 <div class="kbox_wrap d-flex justify-content-between flex-wrap">
                    @foreach($event_award->nominees as $nominee)
                      @if($nominee->is_winner != 1)
                        @php
                            $name = null;
                            $image = imageBasePath('award.png');
                            $link = '#';
                            $collaborators = [];
                            if($nominee->reference_type == 2){
                                $name  = $nominee->reference;
                                // $image = null;
                            }else {
                                    if($nominee->type == 1) {
                                        $name = $nominee->product->name ?? null;
                                        $image = imageBasePath(@$nominee->product->main_image) ?? null;
                                        $link = @route('front.pages.product.detail',@$nominee->product->slug ?? '');
                                        $collaborators =  @$nominee->product->collaborators ?? null;

                                    }else {
                                        $name = @$nominee->user->first_name .' '.@$nominee->user->last_name  ?? null;
                                        $image = imageBasePath(@$nominee->user->profile_image) ?? null;
                                        $link = @route('front.pages.people.detail',@$nominee->user->slug ?? '');
                                    }
                                }
                        @endphp
                          <div class="kbox_wrap_inner d-flex justify-content-start p-2 first_box boxWidth mb-2">
                            <a href="{{$link}}">
                               <div class="mr-2">
                                  <img class="awardNomineeImg" src="{{$image}}">
                               </div>
                            </a>
                             <div class="pull-left">
                                @if($nominee->is_winner == 1)
                                  <div >
                                    <a href="{{$link}}">
                                      <span class="winner_text">Winner</span>
                                    </a>
                                  </div>
                                @endif
                                <div class="pull-left w-100">
                                   <a href="{{$link}}" class="alinks_header">{{$name}}</a>
                                </div>
                                  <a href="{{$link}}" class="alinks span-style1">View Profile</a>
                                  {{--
                                      @if(!empty($collaborators)) 
                                          <span class="collaboratorsText" style="font-size: 15px;">Collaborators </span>:               
                                            @foreach ($collaborators as $collaborator)
                                            <a href="{{$link}}" class="alinks span-style1 " >{{$collaborator->name}}</a>,
                                            @endforeach
                                      @endif
                                  --}}
                             </div>
                          </div>
                      @endif
                    @endforeach
                 </div>
              </div>
           </div>
        </div>  

      <!-- Lattest design commented end here -->

    </div>
</div>
</div>

@endsection
