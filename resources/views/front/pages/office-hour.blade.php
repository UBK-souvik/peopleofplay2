@extends('front.layouts.pages')
@section('content')

<link rel="stylesheet" href="{{ asset('front/new_css/office-hours.css?'.time()) }}">

<div class="col-md-6 col-lg-7 MiddleColumnSection">
    <div class="container-width">
       <div class="OfficeHours">
            <div class="OfficeHoursHead text-center mb-5">
                <h2>Office Hours</h2>
                <p class="mb-0">Free 15 minutes Consultations.</p>
                <p class="mb-0">Click on the calendar link to schedule your appt.</p>
                <p class="mb-0">Click on the logo in their 'office' for your meeting. It is their zoom room! Simple! </p>
            </div>
            <div class="OfficeHoursMainContant">
                <div class="card-deck">
                    @if(@$data && !empty($data))
                    @foreach($data as $key =>$row)
                  <div class="card">
                    <div class="card-body text-center">
                        <div class="MainContantBox">
                            <div class="CardBodyImage">
                                <a target="blank" href="{{ @$row->featured_image_url }}">
                                 <img src="{{@imageBasePath(@$row->featured_image)}}" alt="profileimage" class="img-fluid">
                                </a>
                            </div>
                            <div class="CardBodyContant">
                                <p class="mb-0">{{ @$row->description }}</p>
                            </div>
                        </div>
                        <div class="OfficeButtonGroup">
                            <div>
                                @if($row->type == 1) 
                                @php
                                  @$meeting_url = "mailto:".@$row->meeting_url;
                                  @endphp
                                @elseif($row->type == 2)
                                    @php
                                    @$meeting_url = @$row->meeting_url;
                                    @endphp
                                @else 
                                    @php
                                    @$meeting_url = "javascript:void(0);";
                                    @endphp
                                @endif
                             <a target="blank" href="{{ $meeting_url }}" class="btn meetingBtn">Set Up a Meeting</a>
                            </div>
                            <div>
                             <a target="blank" href="{{ @$row->website_url }}" class="btn WebsiteBtn">Visit Website</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  @endforeach

                   <div class="card">
                    <div class="card-body text-center">
                        <div class="MainContantBox defaultOfficeHour" style="">
                            
                            <div class="CardBodyContant">
                                <p class="mb-0">List Your Business HERE!</p>
                            </div>
                        </div>
                        <div class="OfficeButtonGroup">
                            <div>
                            
                             <a  href="javascript:void(0);" class="btn meetingBtn">Set Up a Meeting</a>
                            </div>
                            <div>
                             <a href="javascript:void(0);" class="btn WebsiteBtn">Your Website</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  @endif

                  </div>
                  <div>
                      <p class="text-center font-weight-bold">Contact us for details if you want your business to be part of Office Hours! </p>
                  </div>
    </div>
       </div>
    </div>
</div>
@endsection