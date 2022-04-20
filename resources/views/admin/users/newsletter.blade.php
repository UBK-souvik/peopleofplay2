@extends('admin.layouts.master')

@section('title') All Newsletters @endsection

@section('content')
    <section class="content-header">
        <h1> All Newsletters </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active"> All Newsletters </li>
        </ol>
    </section>
        <p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @php $type = (isset($_GET['type'])) ? $_GET['type'] : '0'; @endphp
                    <select class="form-control" name="select_type" id="select_type">
                            <option value="0">Select Newsletter Type</option>
                        @foreach(config('cms.newsletter_type') as $k => $val)
                            <option value="{{$k}}" {{($k == $type) ? 'selected' : ''}}>{{ucfirst($val)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <span data-href="{{ route('export_excel.excel') }}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span>
                </div>
            </div>
        </div>
    </section>
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
                                    <th>Role</th>
                                    <th>NewsLetter Type</th>
                                    <th>Country</th>
                                    <th>Zip Code</th>
                                    <th>{{ adminTransLang('registered_on') }}</th>
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
            ajax: '{{ route("admin.newsletter.list") }}?type='+type,
            columns : [
                { "data": "name" },
                { "data": "email" },
                { "data": "type" },
                { "data": "type_of_user" },
                { "data": "country_id"},
                { "data": "zip_code" },
                {
                     "data": "created_at",
                     "mRender": function (data, type, row) {
                         return moment(data).format('YYYY-MM-DD hh:mm A');
                     }
                }
            ],
        order : [[2, 'desc']]
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

<script type="text/javascript">
    $('#select_type').change(function(){
        var type = $(this).val();
        window.location.replace("{{ route('admin.newsletter.index') }}?type="+type);
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

<script>
   function exportTasks(_this) {
        var type = $("#select_type").val();
        let _url = $(_this).data('href');
        window.location.href = _url+"?type="+type;
   }
</script>
@endsection