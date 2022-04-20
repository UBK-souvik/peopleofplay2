@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_admins') }} @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ adminTransLang('all_admins') }} </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">{{ adminTransLang('all_admins') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.admins.create') }}" class="btn btn-success">{{ adminTransLang('create_user') }}</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
                        
				        <div class="box-body grid-view">
				            <table class="table table-striped table-bordered table-hover dataTable" id="admins-table">
				                <thead>
					                <tr>
					                    <th>{{ adminTransLang('name') }}</th>
					                    <th>{{ adminTransLang('email') }}</th>
                                        <th>{{ adminTransLang('mobile') }}</th>
					                    <th>{{ adminTransLang('status') }}</th>
					                    <th>{{ adminTransLang('registered_on') }}</th>
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
        $('#admins-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.admins.list") }}',
            columns : [
	            { "data": "name" },
	            { "data": "email" },
                { "data": "mobile" },
	            { "data": "status" },
	            { "data": "created_at" },
                {
                    "mRender": function (data, type, row) 
                    {
                        return '<a href="{{ URL::to("admin/admin/update") }}/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>\
                        <a href="{{ URL::to("admin/admin/view") }}/'+row.id+'">\
                            <i class="fa fa-eye fa-fw"></i>\
                        </a>\
                        <a href="{{ URL::to("admin/admin/delete") }}/'+row.id+'" class="delete_admins" >\
                            <i class="fa fa-trash fa-fw"></i>\
                        </a>\
                        <a href="{{ URL::to("admin/admin-account/reset-password") }}/'+row.id+'" class="danger" >\
                            <i class="fa fa-key fa-fw"></i>\
                        </a>';
                    }, 
                    orderable: false,
                    searchable: false
                }
	        ]
        });

        $('#admins-table').on('click', '.delete_admins', function(e){
            e.preventDefault();
            var r = confirm("{{ adminTransLang('are_you_sure_to_delete') }}");
            if (r == false) {
                return false;
            }
            var href = $(this).attr('href');
            $.get( href, function( data ) {
                $('#admins-table').DataTable().ajax.reload();
            });
        });
    });

</script>
@endsection