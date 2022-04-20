@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_users') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('all_users') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">{{ adminTransLang('all_users') }}</li>
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
                        <table class="table table-striped table-bordered table-hover dataTable" id="users-table">
                            <thead>
                                <tr>
                                    <th>{{ adminTransLang('name') }}</th>
                                    <th>{{ adminTransLang('email') }}</th>
                                    <th width="10%">Innovator Role</th>
                                    <th>{{ adminTransLang('status') }}</th>
                                    <th>{{ adminTransLang('registered_on') }}</th>
                                    <th >{{ adminTransLang('action') }}</th>
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
            $('#users-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.free.users.list") }}',
                columns : [
                    { "data": "name" },
                    { "data": "email" },
                    {
                        "data": "id",
                         "mRender": function (data, type, row) {
                             return `${row.type}`;
                         }
                    },
                    { "data": "status" },
                    {
                         "data": "created_at",
                         "mRender": function (data, type, row) {
                             return moment(data).format('YYYY-MM-DD hh:mm A');
                         }
                    },
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.free_users.showedit") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></i></a>\<a href="{{ URL::to("admin/free_users/view") }}/'+row.id+'">\<i class="fa fa-eye fa-fw"></i>\</a>\<a href="{{ URL::to("admin/users/delete") }}/'+row.id+'" class="delete_admins" >\<i class="fa fa-trash fa-fw"></i>\</a>\<a href="{{ URL::to("admin/free_users/reset-password") }}/'+row.id+'" class="danger" >\<i class="fa fa-key fa-fw"></i>\</a>\<a href="{{ URL::to("admin/mester-login") }}/'+row.id+'" class="danger" target="blank">\<i class="fa fa-sign-in fa-fw"></i>\</a>';
                        }, 
                        orderable: false
                    }
                ],
            order : [[2, 'desc']]
            });

            /*$('#users-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("{{ adminTransLang('are_you_sure_to_delete') }}")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#users-table').DataTable().ajax.reload();
                    });
                }
            });*/
        });
		
		var user_data_saved_flag = '{{ Session::has("user_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(user_data_saved_flag!="")
		 {
			 //toastr.success("Gallery Saved Successfully.");
			 //$('#message-box-id').show();
			 //$('#message-box-id').attr('style', 'display:block');
			 //$('#message-box-id').css('display', 'block');
		     $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 
             $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 
    </script>
	
	@include('admin.users.user_admin_js')
	
@endsection