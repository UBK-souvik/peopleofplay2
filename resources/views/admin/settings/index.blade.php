@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_settings') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('all_settings') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">{{ adminTransLang('all_settings') }}</li>
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
                                    <th>{{ adminTransLang('attribute') }}</th>
                                    <th>{{ adminTransLang('value') }}</th>
                                    <th>{{ adminTransLang('action') }}</th>
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
            ajax: '{{ route("admin.settings.list") }}',
            columns : [
	            { "data": "label" },
                {
                    "data": "value" ,
                    "mRender": function (data, type, row) {
                        return row.attribute == 'tax' ? `${row.value}%` : row.value;
                    } 
                },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/settings/update") }}/'+row.id+'" class="danger">\
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