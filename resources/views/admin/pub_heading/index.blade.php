@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_settings') }} @endsection

@section('content')
    <section class="content-header">
        <h1> Pub Heading </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Pub Heading</li>
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
                                    <th>Heading</th>
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
            ajax: '{{ route("admin.pub_heading.list") }}',
            columns : [
	            { "data": "heading" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/pub_heading/update") }}/'+row.id+'" class="danger">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>';
                    }, 
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

</script>
@endsection