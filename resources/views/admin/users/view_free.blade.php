@extends('admin.layouts.master')

@section('title') {{ adminTransLang('detail') }} @endsection

<style type="text/css">
    .table-striped tbody tr {
        text-align: inherit;
    }
</style>
@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('detail') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.free.users.index') }}">All People Free</a></li>
            <li class="active">{{ adminTransLang('detail') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body" id="add-edit-user-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="">
                            <div class="accordion">
                                <div class="accordion__header is-active">
                                    <h2>Basic Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Type</th>
                                                <td>Innovator</td>
                                            </tr>
                                            <tr>
                                                <th>{{ adminTransLang('name') }}</th>
                                                <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            </tr>
                                            
                                            @if($user->role == 2)
                                                <tr>
                                                    <th>{{ adminTransLang('gender') }}</th>
                                                    <td>{{ $user->gender }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>{{ adminTransLang('profile_image') }}</th>
                                                <td><img alt="" src="{{ $user->profile_image }}" width="60" height="60"/></td>
                                            </tr>

                                            <tr>
                                                <th>Innovator Description</th>
                                                <td>@if(!empty($user->description)){!! $user->description !!}@endif</td>
                                            </tr>

                                            <tr>
                                                <th>Profile URL</th>
                                                <td><a target="_blank" href="{{url('people/'.$user->slug)}}">{{$user->slug}}</a></td>
                                            </tr>

                                                <tr>
                                                    <th>Fun Fact 1</th>
                                                    <td>{{ $user->fun_fact1 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 2</th>
                                                    <td>{{ $user->fun_fact2 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 3</th>
                                                    <td>{{ $user->fun_fact3 }}</td>
                                                </tr>
                                            {{--
                                            @if(!empty($user->fun_fact1) )
                                            @endif
                                            @if(!empty($user->fun_fact2) )
                                            @endif
                                            @if(!empty($user->fun_fact3) )
                                            @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="accordion__header">
                                    <h2>Contact Info</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <!-- <tr>
                                                <th>Agent Name</th>
                                                <td>
                                                    @if(!empty($user->inventorContactInfo->agent_name))
                                                        @php
                                                          $text   = $user->inventorContactInfo->agent_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->agent_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        @endphp
                                                        {{$text}}
                                                    @endif 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Agent Email</th>
                                                <td>@if(!empty($user->inventorContactInfo->agent_email_id)){{ @$user->inventorContactInfo->agent_email_id }} @endif</td>
                                            </tr>
                                            <tr>
                                                <th>Manager Name</th>
                                                <td>
                                                    @if(!empty($user->inventorContactInfo->manager_name))
                                                        @php
                                                          $text   = $user->inventorContactInfo->manager_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->manager_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        @endphp
                                                        {{$text}}
                                                    @endif 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Manager Email</th>
                                                <td>@if(!empty($user->inventorContactInfo->manager_email_id)){{@$user->inventorContactInfo->manager_email_id}}@endif</td>
                                            </tr> -->
                                            <tr>
                                                <th>Company Name</th>
                                                <td>
                                                    @if(!empty($user->inventorContactInfo->company_name))
                                                        @php
                                                          $text   = $user->inventorContactInfo->company_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        @endphp
                                                        {{$text}}
                                                    @endif 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Company Email</th>
                                                <td>@if(!empty($user->inventorContactInfo->company_email_id)){{@$user->inventorContactInfo->company_email_id}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Company Phone</th>
                                                <td>@if(!empty($user->inventorContactInfo->company_phone)){{@$user->inventorContactInfo->company_phone}}@endif</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="accordion__header">
                                    <h2>Personal Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Primary Mobile</th>
                                                <td>{{ "+{$user->dial_code} {$user->mobile}" }}</td>
                                            </tr>
										    <tr>
                                                <th>Primary Phone</th>
                                                <td>{{ "+{$user->dial_code} {$user->phone_number}" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Primary Email</th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
											<tr>
                                                <th>Secondary Phone</th>
                                                <td>@if(!empty($user->secondary_phone_number)){{@$user->secondary_phone_number }}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Email</th>
                                                <td>@if(!empty($user->secondary_email)){{@$user->secondary_email}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Mobile</th>
                                                <td>@if(!empty($user->secondary_mobile)){{@$user->secondary_mobile }}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Postal Address</th>
                                                <td>@if(!empty($user->postal_address)){{@$user->postal_address}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td>@if(!empty($user->city)){{@$user->city}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td>@if(!empty($user->state)){{@$user->state}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Postcode/Zipcode</th>
                                                <td>@if(!empty($user->zip_code)){{@$user->zip_code}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>
                                                    @if(!empty($user->country_id) )
                                                      @php $country_id = $user->country_id; @endphp
                                                    @else
                                                      @php $country_id = 234; @endphp
                                                    @endif
                                                    @foreach($countries as $id => $name)
                                                        @if($id == $country_id)
                                                            {{$name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bussiness Address</th>
                                                <td>@if(!empty($user->business_address)){{@$user->business_address}}@endif</td>
                                            </tr>
											<tr>
                                                <th>Business Address City</th>
                                                <td>@if(!empty($user->city_business)){{@$user->city_business}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Business Address State</th>
                                                <td>@if(!empty($user->city_business)){{@$user->city_business}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Business Address Postcode/Zipcode</th>
                                                <td>@if(!empty($user->zip_code_business)){{@$user->zip_code_business}}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Business Address Country</th>
                                                <td>
                                                    @if(!empty($user->country_id_business) )
                                                      @php $country_id = $user->country_id_business; @endphp
                                                    @else
                                                      @php $country_id = 234; @endphp
                                                    @endif
                                                    @foreach($countries as $id => $name)
                                                        @if($id == $country_id)
                                                            {{$name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td>@if(!empty($user->website)){{@$user->website}}@endif</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="accordion__header">
                                    <h2>Social Media</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <div class="row social_media">
                                        @foreach(config('cms.social_media') as $index => $social)
                                            @php
                                              $str_social_val = '';
                                              if(!empty($user->socialMedia))
                                              {   
                                                $str_social_val = @$user->socialMedia->pluck('value','type')->toArray()[$index];
                                              }
                                            @endphp 
                                                <div class="col-md-3" >
                                                    <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                        <label for="{{ $social }}">{{ $social }}</label>
                                                        <input type="url" readonly="" id="{{ $social }}" name="socials[{{$index}}]"
                                                         value="{{$str_social_val}}"
                                                             class="form-control">
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="accordion__header">
                                    <h2>Innovator Metadata</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>{{ adminTransLang('status') }}</th>
                                                <td>{{$user->status}}</td>
                                            </tr>
                                            <tr>
                                                <th>Registered on</th>
                                                <td>@if(!empty($user->created_at)){{date('Y-m-d H:i A',strtotime($user->created_at)) }}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Skills</th>
                                                <td>@if(!empty($user->skills)){{@$user->skills}}@endif</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>
                                                    @if(!empty(@$user->dobday))
                                                        {{@$user->dobday}} 
                                                    @endif
                                                    @if(!empty(@$user->dobmonth))
                                                        -{{@$user->dobmonth}}
                                                    @endif
                                                    @if(!empty(@$user->dobyear))
                                                        -{{@$user->dobyear}}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                

                            @include('admin.users.view_innovator_roles_team_member')								

								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection