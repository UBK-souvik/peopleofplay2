@extends('admin.layouts.master')

@section('title') {{ adminTransLang('detail') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('detail') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.companies.index') }}">{{ adminTransLang('all_companies') }}</a></li>
            <li class="active">{{ adminTransLang('detail') }}</li>
        </ol>
    </section>

    <section class="content">
        <p>
            <a class="btn btn-success btn-floating" href="{{ route('admin.users.showeditCompany', ['?id' => $user->id]) }}">{{ adminTransLang('update') }}</a>
        </p>
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
                                                <th>{{ adminTransLang('name') }}</th>
                                                <td>{{ @$user->first_name }} {{ @$user->last_name }} </td>
                                            </tr>
                                            <tr>
                                                <th>Acronym</th>
                                                <td>{{ @$user->acronym }} </td>
                                            </tr>
                                            <tr>
                                                <th>Is Gold</th>
                                                <td>{{ !empty($user->gold) ? 'Yes':'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ adminTransLang('email') }}</th>
                                                <td>{{ @$user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ adminTransLang('mobile') }}</th>
                                                <td>{{ "+{$user->dial_code} {$user->mobile}" }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ adminTransLang('profile_image') }}</th>
                                                <td><img alt="" src="{{ $user->profile_image }}" width="60" height="60"/></td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>@if(!empty($user->countrydata->country_name)){{ $user->countrydata->country_name }}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Company Description</th>
                                                <td>@if(!empty($user->description)){!! $user->description !!}@endif</td>
                                            </tr>
                                            <tr>
                                                <th>Profile URL</th>
                                                <td><a target="_blank" href="{{url('company/'.$user->slug)}}">{{$user->slug}}</a></td>
                                            </tr>
                                            <tr>
                                                <th>{{ adminTransLang('status') }}</th>
                                                <td>{{ $user->status }}</td>
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

                                 @include('admin.users.view_innovator_roles_team_member')
                               								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection