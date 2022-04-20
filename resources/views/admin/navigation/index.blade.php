@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_navigation') }} @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ adminTransLang('all_navigation') }} </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">{{ adminTransLang('all_navigation') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.navigation.create') }}" class="btn btn-success">{{ adminTransLang('create_navigation') }}</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>{{ adminTransLang('id') }}</th>
                                        <th>{{ adminTransLang('name') }}</th>
					                    <th>{{ adminTransLang('en_name') }}</th>
					                    <th>{{ adminTransLang('icon') }}</th>
                                        <th>{{ adminTransLang('parent_id') }}</th>
                                        <th>{{ adminTransLang('action_path') }}</th>
                                        <th>{{ adminTransLang('status') }}</th>
                                        <th>{{ adminTransLang('show_in_menu') }}</th>
                                        <th>{{ adminTransLang('show_in_permission') }}</th>
                                        <th>{{ adminTransLang('child_permission') }}</th>
					                    <th>{{ adminTransLang('display_order') }}</th>
					                    <th>{{ adminTransLang('action') }}</th>
					                </tr>
				                </thead>
				                <tbody>
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
<script type="text/javascript">
	$(function() {
        $('#navigation-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.navigation.list") }}',
            columns : [
                { "data": "id"},
                { "data": "name"},
	            { "data": "en_name" },
	            { "data": "icon" },
                { "data": "parent_id" },
                { "data": "action_path" },
                { "data": "status" },
                { "data": "show_in_menu" },
                { "data": "show_in_permission" },
                { "data": "child_permission" },
	            { "data": "display_order" },
                {
                    "mRender": function (data, type, row) 
                    {
                        return '<a href="{{ URL::to("admin/navigation/update") }}/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>';
                    }, orderable: false
                }
	        ],
            order : [[0, 'desc']]
        });
    });

</script>
@endsection