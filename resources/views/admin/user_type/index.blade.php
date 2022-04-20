@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_role') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('all_role') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">{{ adminTransLang('all_role') }}</li>
        </ol>
    </section>

    <section class="content">
        @include('admin.includes.info-box')
        <!-- <p>
            <a href="{{ route('admin.permission.create') }}" class="btn btn-success">{{ adminTransLang('create_role') }}</a>
        </p> -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="role-table">
                            <thead>
                                <tr>
                                    <th>{{ adminTransLang('id') }}</th>
                                    <th>{{ adminTransLang('name') }}</th>
                                    <th>{{ adminTransLang('status') }}</th>
                                    <th>{{ adminTransLang('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
        $('#role-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.permission.list") }}',
            columns : [
                { "data": "id"},
                { "data": "name"},
                { "data": "status" },
                {
                    "mRender": function (data, type, row) 
                    {
                        var html = '<a href="{{ URL::to("admin/permission/update") }}/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>';
                            html += '<a href="{{ URL::to("admin/permission/permission") }}/'+row.id+'">\
                                <i class="fa fa-lock fa-fw"></i>\
                            </a>';
                        return html;
                    }, orderable: false
                }
	        ],
            order : [[0, 'desc']]
        });
    });

</script>
@endsection