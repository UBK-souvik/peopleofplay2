@extends('admin.layouts.master')

@section('title') {{ adminTransLang('detail') }} @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ adminTransLang('detail') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.admins.index') }}"> {{ adminTransLang('all_admins') }} </a></li>
            <li class="active">{{ adminTransLang('detail') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <p>
          <a class="btn btn-primary" href="{{ route('admin.admins.update', ['?id' => $admin->id]) }}">{{ adminTransLang('update') }}</a>
      </p>
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-md-12">
              <div class="box">
                  <div class="box-body">
                      <div class="offers-view">
                          <table id="w0" class="table table-striped table-bordered detail-view">
                              <tbody>
                                  <tr>
                                      <th>{{ adminTransLang('name') }}</th>
                                      <td>{{ $admin->name }}</td>
                                  </tr>
                                  <tr>
                                      <th>{{ adminTransLang('email') }}</th>
                                      <td>{{ $admin->email }}</td>
                                  </tr>
                                  <tr>
                                      <th>{{ adminTransLang('mobile') }}</th>
                                      <td>{{ $admin->mobile }}</td>
                                  </tr>
                                  <tr>
                                      <th>{{ adminTransLang('status') }}</th>
                                      <td>{{ $admin->status }}</td>
                                  </tr>
                                  <tr>
                                      <th>{{ adminTransLang('locale') }}</th>
                                      <td>{{ $admin->locale }}</td>
                                  </tr>
                                  <tr>
                                      <th>{{ adminTransLang('profile_image') }}</th>
                                      <td><img alt="" src="{{ $admin->profile_image }}" width="60" height="60"/></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection