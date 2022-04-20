@extends('admin.layouts.master')

@section('title') {{ 'Home Page Whatever Days' }} @endsection

@section('content')
    <section class="content-header">
        <h1>Home Page Whatever Day List</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">Home Page Whatever Day List</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		
    <section class="content">
        <p>
		@include('admin.includes.info-box')
        
        </p>
		<p>
                <a href="{{url('admin/cms/home-page-whateverday/create')}}" class="btn btn-success">Create Happy Whatever Day</a>
            </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="paragraphs-table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
									<th>Caption 1</th>
									<th>Caption 2</th>
									<th>Date of Publish</th>
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
                ajax: '{{ route("admin.cms.happy_whatever_day.list") }}',
                columns : [
				    {
						"mRender": function(data,type,row) {
							return '<img  src="'+row.featured_image+'" class="imgFifty">'
						},
						orderable: false
					},
                    { "data": "home_caption_one" },
					{ "data": "home_caption_two" },
					{ "data": "date_to_be_published" },
					{ "data": "status" },                   
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.cms.happy_whatever_day.update") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a class="delete_admins" href="{{ route("admin.cms.happy_whatever_day.delete") }}/'+row.id+'">\<i class="fa fa-trash fa-fw"></i>\</a>';
                        }, 
                        orderable: false
                    }
                ],
            order : [[2, 'desc']]
            });
			
			$('#paragraphs-table').on('click', '.delete_admins', function(e){
            e.preventDefault();
            var r = confirm("{{ adminTransLang('are_you_sure_to_delete') }}");
            if (r == false) {
                return false;
            }
            var href = $(this).attr('href');
            $.get( href, function( data ) {
                $('#paragraphs-table').DataTable().ajax.reload();
            });
        });

        });
		 
    </script>
	
	@include('admin.users.user_admin_js')
	
@endsection