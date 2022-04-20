@extends('admin.layouts.master')

@section('title') All Interviews @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> All Interviews </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">All Interviews</li>
            </ol>
        </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.interview.create') }}" class="btn btn-success">Create Interview</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Featured Image</th>
                                        <th>Author Email</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tag</th>
                                        <th>Status</th>
                                        <th>Action</th>
					                </tr>
				                </thead>
				                <tbody>
				                </tbody>
				            </table>
				        </div>
				    </div>
				    <!-- /.box -->
				</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
        $('#navigation-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.interview.list") }}',
            columns : [
                {
                    "mRender": function(data,type,row) {
                        return '<img  src="'+row.featured_image+'" class="imgFifty">'
                    },
                    orderable: false
                },
                {
                    "data": "user.email",
                    "defaultContent": "Admin"
                },
	            { "data": "title" },
	            {
                    "mRender": function(data,type,row) {
                     if (typeof row.category == 'undefined' || row.category == null  || row.category == '')
					 {
                        return "";
                     }					  
					  if (typeof row.category.name == 'undefined'  || row.category.name == null  || row.category.name == '')
					  {
						  return "";						  
					  }	  
					  else
					  {
                          return row.category.name;
						  
					  }
					 

                    },
                    orderable: false
                },
				{ "data": "tag" },
                { "data": "status" },
                {
                    "mRender": function (data, type, row) 
                    {
                        return '<a href="{{ URL::to("admin/interview/update") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a class="delete_admins" href="{{ URL::to("admin/interview/delete") }}/'+row.id+'">\<i class="fa fa-trash fa-fw"></i>\</a>';
                    }, orderable: false
                }
	        ],
            order : [[0, 'desc']]
        });

        $('#navigation-table').on('click', '.delete_admins', function(e){
            e.preventDefault();
            var r = confirm("{{ adminTransLang('are_you_sure_to_delete') }}");
            if (r == false) {
                return false;
            }
            var href = $(this).attr('href');
            $.get( href, function( data ) {
                $('#navigation-table').DataTable().ajax.reload();
            });
        });
    });
	
	var blog_data_saved_flag = '{{ Session::has("blog_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(blog_data_saved_flag!="")
		 {
			 $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 

</script>
@endsection
