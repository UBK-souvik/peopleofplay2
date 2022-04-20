@extends('admin.layouts.master')

@section('title') All News Category @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> All Rest In Play Category </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">All Rest In Play Category</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.rest-in-play.category.create') }}" class="btn btn-success">Create Rest In Play Category</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.rest-in-play.category.list") }}',
            columns : [
	            { "data": "name" },
                { "data": "description" },
                { "data": "status" },
                { "data": "action", orderable: false },
	        ],
            order : [[0, 'asc']]
        });

        $('#navigation-table').on('click', '.delete_admins', function(e){
            e.preventDefault();
            var r = confirm("{{ adminTransLang('are_you_sure_to_delete') }}");
            if (r == false) {
                return false;
            }
            if($(this).attr('href') == 'javascript:void(0);') {
                 var r = confirm("{{ 'Cannot delete this category because it has been used Rest IN Play.' }}");
                  return false;
            }
            var href = $(this).attr('href');
            $.get( href, function( data ) {
                $('#navigation-table').DataTable().ajax.reload();
            });
        });
    });

</script>
@endsection
