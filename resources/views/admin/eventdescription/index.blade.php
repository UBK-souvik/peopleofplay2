@extends('admin.layouts.master')

@section('title') Description @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <h1> All Events </h1> --}}
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">Create Description</li>
            </ol>
        </section>
        <p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.eventdescription.create') }}" class="btn btn-success">Create Description</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="">
				                <thead>
					                <tr>
                                        <th>Description Header</th>
                                        <th>Description</th>
                                        <th>Action</th>
					                </tr>
				                </thead>
				                <tbody>
                                     <?php foreach ($eventDescription as $key => $event) { ?>
                                        <tr>
                                          <td>{{ $event->description_header }}</td>
                                          <td>{!!html_entity_decode($event->description_details)!!}</td>
                                          <td><a href="{{ URL::to("admin/eventdescription/update") }}/{{ $event->id }}">
                                            <i class="fa fa-edit fa-fw"></i></td>
                                        </tr>
                                     <?php } ?>

				                </tbody>
				            </table>
				        </div>
				    </div>
				    <!-- /.box -->
				</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection

@section('scripts')

@endsection
