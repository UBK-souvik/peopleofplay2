@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_settings') }} @endsection

@section('content')
    <style>
        .content_height{
            min-height: 160px !important;
        }
    </style>
    <section class="content-header">
        <h1> Featured Meeting Room </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Featured Room List</li>
        </ol>
    </section>

    <section class="content content_height">
        @include('admin.includes.info-box')
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Heading</th>
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

    <section class="content-header">
        <h1> Other Meeting Room </h1>
    </section>

    <section class="content">
        @include('admin.includes.info-box')
        <p>
            <a href="{{ url('admin/create_meeting?type=0') }}" class="btn btn-success">Create Meeting Room</a>
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table2">
                            <thead>
                                <tr>
                                    <th>Heading</th>
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
        window.table = $('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            searching: false, 
            paging: false, 
            info: false,
            ajax: {
                url: '{{ route("admin.pub_heading.pub_meeting_list") }}',
                type: 'get',
                data: function (d) {
                    d.type = 1;
                },
            },    
            columns : [
	            { "data": "heading" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ route("admin.pub_heading.update_meeting") }}/'+row.id+'" class="danger"><i class="fa fa-edit fa-fw"></i></a>';
                    }, 
                    searchable: false,
                    orderable: false
                }
	        ]
        });

        window.table2 = $('#settings-table2').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.pub_heading.pub_meeting_list") }}',
                type: 'get',
                data: function (d) {
                    d.type = 0;
                },
            },  
            columns : [
	            { "data": "heading" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ route("admin.pub_heading.update_meeting") }}/'+row.id+'" class="danger"><i class="fa fa-edit fa-fw"></i></a>\
                        <a href="javascript:void(0)" class="danger" onclick="deletePubMeetingRoom(this,'+row.id+'); return false;"><i class="fa fa-trash fa-fw"></i></a>';
                    }, 
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

    function deletePubMeetingRoom(e,id){
        if(confirm('Are you sure want to delete this meeting room?')){
            $.ajax({
                url: "{{ route('admin.pub_heading.deletePubMeetingRoom') }}",
                type: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(data){
                    toastr.success(data.msg,'Success');
                    table.draw();
                }
            });
        }
    }

</script>
@endsection