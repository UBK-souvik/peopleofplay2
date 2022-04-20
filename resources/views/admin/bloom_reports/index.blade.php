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
        <p>
            <a href="{{ route('admin.bloom_reports.create') }}" class="btn btn-success">Add Weekly Magzine</a>
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Title</th>
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
            ajax: '{{ route("admin.bloom_reports.weekly_report_list") }}',
            type: 'get',
            scrollX: 200,
            scroller: {
                loadingIndicator: true
            },
            columns : [
                {data: 'DT_RowIndex', name: 'id'},
	            { "data": "week_range" },
	            {
                    "mRender": function (data, type, row){
                        return '<a href="{{url("admin/bloom_reports_test_create")}}?report_range='+row.slug+'"><i class="fa fa-edit fa-fw"></i></a>\
                            <a class="delete_admins" href="javascript:void(0)" onclick="delete_report(this,'+row.id+'); return false;"><i class="fa fa-trash fa-fw"></i></a>';
                    }, 
                    orderable: false
                },
	        ],
            order : [[0, 'asc']]
        });
    });

    // function reportView(e,id){
    //     $.ajax({
    //         url: "",
    //         data: {id:id},
    //         dataType: 'json',
    //         type: 'GET',
    //         success: function (data) {
    //             if(data.status == 1){
    //                 $('#remote_model .modal-content').html(data.view);
    //                 $('#remote_model').modal('show');
    //             }  
    //         }
    //     });
    // }

</script>
@endsection