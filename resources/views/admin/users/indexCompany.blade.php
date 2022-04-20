@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_companies') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('all_companies') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">{{ adminTransLang('all_companies') }}</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
            <a href="{{ route('admin.users.showaddCompany') }}" class="btn btn-success">Create Company</a>
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
                                    <th>{{ adminTransLang('mobile') }}</th>
                                    <th>{{ adminTransLang('status') }}</th>
                                    <th>{{ adminTransLang('registered_on') }}</th>
                                    <th>News Feeds</th>
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
            $('#users-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.companies.list") }}',
                columns : [
                    { "data": "name" },
                    { "data": "email" },
                    {
                        "data": "mobile",
                        "mRender": function (data, type, row) {
                            var str_mobile_prefix ='';
							if(row.dial_code == null || row.dial_code ==undefined)
							{
								str_mobile_prefix = '';
							}
							else								
							{
								str_mobile_prefix = '+'+row.dial_code;
							}
							
							return str_mobile_prefix + " " + `${row.mobile}`;
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
                            // return '<div class="text-center custom-control custom-switch"><input type="checkbox" id="news_feeds_user_'+row.id+'" class="custom-control-input" value="'+row.is_news_feeds+'" onchange="news_feeds_user_status(this,'+row.id+','+row.is_news_feeds+')" '+row.news_feeds_checked+'><label class="custom-control-label" for="news_feeds_user_'+row.id+'" ></label></div>';

                            return '<label class="customSwitch" for="news_feeds_user_'+row.id+'"><input type="checkbox" id="news_feeds_user_'+row.id+'" value="'+row.is_news_feeds+'" onchange="news_feeds_user_status(this,'+row.id+','+row.is_news_feeds+')" '+row.news_feeds_checked+'><span class="slider"></span></label>';
                        }, 
                        orderable: false
                    },
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.users.showeditCompany") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a href="{{ URL::to("admin/companies/view") }}/'+row.id+'">\<i class="fa fa-eye fa-fw"></i>\</a>\<a href="{{ URL::to("admin/users/delete") }}/'+row.id+'" class="delete_admins" >\<i class="fa fa-trash fa-fw"></i>\</a>\<a href="{{ URL::to("admin/users/reset-password") }}/'+row.id+'" class="danger" >\<i class="fa fa-key fa-fw"></i>\</a>\<a href="{{ URL::to("admin/mester-login") }}/'+row.id+'" class="danger" target="blank">\<i class="fa fa-sign-in fa-fw"></i>\</a>';
                            
                        }, 
                        //orderable: false,
                        //searchable: false
                    }
                ],
				order : [[4, 'desc']]
            });

            // <a href="{{ URL::to("admin/users/reset-password") }}/'+row.id+'" class="danger" >\
            //                     <i class="fa fa-key fa-fw"></i>\
            //                 </a>';

            /*$('#users-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("{{ adminTransLang('are_you_sure_to_delete') }}")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#users-table').DataTable().ajax.reload();
                    });
                }
            }); */
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

        function news_feeds_user_status(e,id,type){
            if(type == 0){
                var msg = 'Are you sure give permission to this user to post news feeds?';
            }else{
                var msg = 'Are you sure to remove permission from this user to post news feeds?';
            }
            if(confirm(msg)){
                var news_val = $(e).val();
                $.ajax({
                    url:"{{ route('admin.feeds.news_feeds_user_status') }}",
                    type:'get',
                    data:{id:id,news_val:news_val},
                    dataType:'json',
                    success:function(data){
                        if(data.status == 1){
                            toastr.success('Updated Successfully','Success');
                            usersTable.draw('false');
                        }
                    }
                });
            }else{
                if($(e).prop("checked") == true){
                    $(e).prop('checked', false);
                }else{
                    $(e).prop('checked', true);
                }
            }
        }
    </script>
	
	@include('admin.users.user_admin_js')
	
@endsection