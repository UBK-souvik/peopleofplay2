@extends('admin.layouts.master')

@section('title') {{ adminTransLang('dashboard') }} @endsection

@section('content')

<?php

$user = Auth::guard('admin')->user();

 ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ adminTransLang('dashboard') }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{ adminTransLang('home') }}</a></li>
            <li class="active">{{ adminTransLang('dashboard') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $people }}</h3>
                        <p>Total People</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <a href=" @if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{ route('admin.users.index') }} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $company }}</h3>
                        <p>Total Companies</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{ route('admin.companies.index') }} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $products }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon"><i class="fa fa-product-hunt"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{ route('admin.products.index') }} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $roles }}</h3>
                        <p>Total Roles</p>
                    </div>
                    <div class="icon"><i class="fa fa-user-circle-o"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{ route('admin.user_role.index') }} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $Blogs }}</h3>
                        <p>Total Blogs</p>
                    </div>
                    <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{url('/admin/blog')}} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $Poll }}</h3>
                        <p>Total Polls</p>
                    </div>
                    <div class="icon"><i class="fa fa-question-circle"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{url('/admin/polls')}} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $News }}</h3>
                        <p>Total News</p>
                    </div>
                    <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{url('/admin/news')}} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $Events }}</h3>
                        <p>Total Events</p>
                    </div>
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <a href="@if($user->email == 'juliadekorte@peopleofplay.com') {{ 'javascript:void(0);' }} @else {{url('/admin/events')}} @endif" class="small-box-footer">{{ adminTransLang('more_info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
