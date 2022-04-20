@extends('admin.layouts.master')

@section('title') {{ 'Main List Paragraphs' }} @endsection

@section('content')
    <section class="content-header">
        <h1> Main List Paragraphs </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">Main List Paragraphs</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="paragraphs-table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>{{ adminTransLang('status') }}</th>
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
            $('#paragraphs-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.cms.main_list_paragraph.list") }}',
                columns : [
                    { "data": "type" },
					{ "data": "status" },                   
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.cms.main_list_paragraph.update") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></a>';
                        }, 
                        orderable: false
                    }
                ],
            order : [[2, 'desc']]
            });

        });
		 
    </script>
	
	@include('admin.users.user_admin_js')
	
@endsection