@extends('admin.layouts.master')

@section('title') All Reports @endsection

@section('content')
    <section class="content-header">
        <h1> All Reports </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active"> All Reports </li>
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
                                    <th>Type</th>
                                    <th>Profile URL</th>
                                    <th>URL</th>
                                    <th>Registered ON</th>
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
        $('#users-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.reports.list") }}?type='+type,
            columns : [
                { "data": "type" },
                {
                    "mRender": function (data, type, row) 
                    {
                        return '<a target="_blank" href="'+row.profile_url+'">Profile URL</a>';
                    }, 
                    orderable: false
                },
                {
                    "mRender": function (data, type, row) 
                    {
                        return '<a target="_blank" href="'+row.url+'">'+row.url+'</a>';
                    }, 
                    orderable: false
                },
                {
                     "data": "created_at",
                     "mRender": function (data, type, row) {
                         return moment(data).format('YYYY-MM-DD hh:mm A');
                     }
                }
            ],
        order : [[3, 'desc']]
        });
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

<script>
   function exportTasks(_this) {
        var type = $("#select_type").val();
        let _url = $(_this).data('href');
        window.location.href = _url+"?type="+type;
   }
</script>
@endsection