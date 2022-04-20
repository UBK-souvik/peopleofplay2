@extends('admin.layouts.master')

@section('title') Sidebar List Page @endsection

@section('content')
    <section class="content-header">
        <h1> Sidebar List Page </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Sidebar List Page</li>
        </ol>
    </section>
    <section class="content">
        @include('admin.includes.info-box')
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Display Order</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
        $('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: "{{ URL('admin/cms/sidebar-page/list') }}",
            columns : [
	            { "data": "display_order" },
	            { "data": "title" },
	            { "data": "type" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/cms/sidebar-page/update") }}/'+row.id+'" class="danger">\<i class="fa fa-edit fa-fw"></i>\</a>';
                    },
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

</script>
@endsection
