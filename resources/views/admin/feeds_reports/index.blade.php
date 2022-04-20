@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_settings') }} @endsection

@section('content')
    <section class="content-header">
        <h1> Feeds Reports </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Feeds Reports</li>
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
                                    <th>Reported by user</th>
                                    <th>Reported against user</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Reason</th>
                                    <th>URL</th>
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
            ajax: '{{ route("admin.feed_reports.list") }}',
            scrollX: 200,
            scroller: {
                loadingIndicator: true
            },
            columns : [
	            { "data": "report_user_name" },
                {
                    "mRender": function (data, type, row) {
                        if(row.report_against_user_name != null){
                            return row.report_against_user_name+'<br>('+row.uf_email+')';
                        }else{
                            return '';
                        }
                    }, 
                    orderable: false
                },
	            { "data": "feed_type" },
	            { "data": "title" },
	            { "data": "label" },
                {
                    "mRender": function (data, type, row){
                        return '<a href="'+row.url+'" target="_blank">'+row.url+'</a><br>'
                    }, 
                    orderable: false
                },
	            { "data": "status" },
	            {
                    "mRender": function (data, type, row){
                        if(row.feedReportId != null){
                            if(row.status == ''){
                                return '<a href="javascript:void(0)" onclick="reportView(this,'+row.feedReportId+'); return false;"><i class="fa fa-eye fa-fw"></i></a>\
                                <a href="javascript:void(0)" onclick="deleteReportedFeed(this,'+row.feedReportId+'); return false;"><i class="fa fa-trash fa-fw"></i></a>';
                            }else{
                                return '<a href="javascript:void(0)" onclick="reportView(this,'+row.feedReportId+'); return false;"><i class="fa fa-eye fa-fw"></i></a>';
                            }
                        }else{
                            return '';
                        }
                    }, 
                    orderable: false
                },
	        ],
            order : [[0, 'desc']]
        });
    });

    function reportView(e,id){
        $.ajax({
            url: "{{ route('admin.feed_reports.report_view')}}",
            data: {id:id},
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.status == 1){
                    $('#remote_model .modal-content').html(data.view);
                    $('#remote_model').modal('show');
                }  
            }
        });
    }

    function deleteReportedFeed(e,id){
        $.ajax({
            url: "{{ route('admin.feed_reports.delete_report_feed')}}",
            data: {id:id},
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.status == 1){
                    toastr.success(data.msg,'Success');
                    $('#settings-table').DataTable().ajax.reload();
                }  
            }
        });
    }

</script>
@endsection