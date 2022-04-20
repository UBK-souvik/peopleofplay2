@extends('admin.layouts.master')

@section('title') View Payment @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> View Payment</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.payments') }}"> All Payments </a></li>
            <li class="active">View Payment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                <!-- /.box-header -->
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <table class="table table-striped table-bordered no-margin">
                            <tbody>
                                <tr>
                                    <th>{{ adminTransLang('name') }}</th>
                                    <td>{{$payments->name}}</td>
                                </tr>
                                <tr>
                                    <th>{{ adminTransLang('email') }}</th>
                                    <td>{{@$payments->email}}</td>
                                </tr>
                                <tr>
                                    <th>Customer ID</th>
                                    <td>{{@$payments->stripe_id}}</td>
                                </tr>
                                <tr>
                                    <th>Subscription ID</th>
                                    <td>{{@$payments->stripe_subscription_id}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{@$payments->price}}</td>
                                </tr>
                                <tr>
                                    <th>{{ adminTransLang('end_at') }}</th>
                                    <td>{{ date('Y-m-d', strtotime(@$payments->ends_at) )}}</td>
                                </tr>
                                <tr>
                                    <th>{{ adminTransLang('status') }}</th>
                                    <td>{{@$payments->status}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


