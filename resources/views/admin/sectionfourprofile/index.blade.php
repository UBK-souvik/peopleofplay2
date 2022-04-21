@extends('admin.layouts.master')

@section('title') Section three Profile @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Section three Profile </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">Section three Profile</li>
            </ol>
        </section>
        <p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.sectionfourprofile.create') }}" class="btn btn-success">Create Profile</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Main Image</th>
                                        <th>Name</th>
                                        <th>Url</th>
                                        <th>Subtitle</th>
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
            ajax: '{{ route("admin.sectionfourprofile.list") }}',
            columns : [
	            {
                    mRender: function(data,type,row) {
                        return '<img src="'+row.main_image+'" class="imgFifty">'
                    }
                },
	            { "data": "profileName" },
	            { "data": "profileUrl" },
	            { "data": "profileSubtitle" },

                {
                    "mRender": function (data, type, row)
                    {
                        return '<a href="{{ URL::to("admin/sectionfourprofile/update") }}/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>\
                        <a href="{{ URL::to("admin/sectionfourprofile/view") }}/'+row.id+'">\
                            <i class="fa fa-eye fa-fw"></i>\
                        </a>\
                        <a class="delete_admins" href="{{ URL::to("admin/sectionfourprofile/delete") }}/'+row.id+'">\
                            <i class="fa fa-trash fa-fw"></i>\
                        </a>';
                    },
                    orderable: false
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

    var news_data_saved_flag = '{{ Session::has("news_data_saved_flag") }}';

        $(document).ready(function(){

        if(news_data_saved_flag!="")
         {
             $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
             $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
             $("#message-box-id").alert('close');
            });
         }
        });

</script>
@endsection
