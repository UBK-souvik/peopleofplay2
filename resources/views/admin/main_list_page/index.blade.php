@extends('admin.layouts.master')

@section('title') Menu Page @endsection

@section('content')
    <section class="content-header">
        <h1> Menu Page </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Menu Page</li>
        </ol>
    </section>
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @php $type = (isset($_GET['type'])) ? $_GET['type'] : '1'; @endphp
                    <select class="form-control" name="select_type" id="select_type">
                            <option value="0">Select Type</option>
                        @foreach(config('cms.drop_down_type') as $k => $val)
                            <option value="{{$k}}" {{($k == $type) ? 'selected' : ''}}>{{ucfirst($val)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
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
                                    <th>Menu Type</th>
									<th>Category</th>
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
        var type = $("#select_type").val();
        // alert(type);
        $('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: "{{ URL('admin/cms/main-list-page/list') }}?type="+type,
            columns : [
	            { "data": "display_order" },
	            { "data": "title" },
	            { "data": "type" },
				{ "data": "category_id" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/cms/main-list-page/update") }}/'+row.id+'" class="danger">\<i class="fa fa-edit fa-fw"></i>\</a>';
                    },
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

    $('#select_type').change(function(){
        var type = $(this).val();
        window.location.replace("{{ URL('admin/cms/main-list-page') }}?type="+type);
        $('#settings-table').DataTable().clear().destroy();
        $('#settings-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/cms/main-list-page/list/') }}?type="+type,
            columns : [
                { "data": "display_order" },
                { "data": "title" },
                { "data": "type" },
                { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/cms/main-list-page/update") }}/'+row.id+'" class="danger">\
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
