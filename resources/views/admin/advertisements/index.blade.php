@extends('admin.layouts.master')

@section('title') 

@if(empty($is_default))
 {{ adminTransLang('all_advertisements') }} 
@else
 {{ adminTransLang('all_default_advertisements') }} 	
@endif

@endsection

@section('content')
    <section class="content-header">
        <h1> 
@if(empty($is_default))
 {{ adminTransLang('all_advertisements') }} 
@else
 {{ adminTransLang('all_default_advertisements') }} 	
@endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">
@if(empty($is_default))
 {{ adminTransLang('all_advertisements') }} 
@else
 {{ adminTransLang('all_default_advertisements') }} 	
@endif</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
		@if(empty($is_default))
		  <a href="{{ route('admin.advertisements.showadd') }}/0" class="btn btn-success">Create Sponsored Advertisement</a>
		@else
		  <a href="{{ route('admin.advertisements.showadd') }}/1" class="btn btn-success">Create Default Advertisement</a>
        @endif
		
		</p>
		
		<div class="row">
		
		<div class="form-group">
          <label for="name" class="col-sm-2 control-label">Page <i class="has-error">*</i></label>
          <div class="col-sm-6">
      		  <select required name="advertisement_category" class="form-control select2 py-3" onchange="return get_adv_list_by_category_postion(this.value);">
                    <option value="0"> Select Page</option>
                    @foreach($advertisement_category as $advertisement_category_id => $advertisement_category_name)
                    <option value="{{$advertisement_category_id}}" {{(!empty($category_id) && $advertisement_category_id == $category_id)? 'selected' : ''}}>{{$advertisement_category_name}}</option>
                    @endforeach
      		  </select>		  		  
          </div>
       </div>
	   
		</div>
		
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="advertisements-table">
                            <thead>
                                <tr>
                                    
									<th>{{ adminTransLang('advertisement_title') }}</th>
									<th>{{ adminTransLang('advertisement_position') }}</th>
									<th>Page</th>
									<th>{{ adminTransLang('advertisement_image') }}</th>
                                    <th>{{ adminTransLang('from_date') }}</th>
                                    <th>{{ adminTransLang('to_date') }}</th>
									<th>{{ adminTransLang('advertisement_no_of_clicks') }}</th>
									<th>{{ adminTransLang('advertisement_is_default') }}</th>
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
	
	function get_adv_list_by_category_postion(category_id)
	{
		window.location.href = '{{ route("admin.advertisements.index") }}/{{$is_default}}/'+category_id;
	}
	
	var ads_image_upload_path_new = '{{ App\Helpers\Utilities::get_ads_upload_folder_path()}}';
        $(function() {
            $('#advertisements-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
				
                ajax: '{{ route("admin.advertisements.list") }}/{{$is_default}}/{{$category_id}}',
                columns : [
                    { "data": "title" },
					{ "data": "advertisement_position_new" },
					{ "data": "advertisement_category_name" },
					{
                        "data": "advertisement_image",
                        "mRender": function (data, type, row) {
                            return '<img class="imgFifty" src="'+ads_image_upload_path_new + `${row.advertisement_image}`+'">';
                        },
					},	
					{ "data": "from_date" },
					{ "data": "to_date" },
                    { "data": "no_of_clicks" },
                    { "data": "is_default_new" },					
                    /*{
                        "data": "mobile",
                        "mRender": function (data, type, row) {
                            return `+${row.dial_code} ${row.mobile}`;
                        }
                    },*/
                    { "data": "status" },
                    /*{
                        "data": "created_at",
                        "mRender": function (data, type, row) {
                            return moment(data).format('YYYY-MM-DD hh:mm A');
                        }
                    },*/
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.advertisements.showedit") }}/'+row.id+'/'+row.is_default_flag+'">\
                                <i class="fa fa-edit fa-fw"></i>\
                            </a>\
                            <a href="{{ URL::to("admin/advertisements/delete") }}/'+row.id+'" class="delete_admins" >\
                                <i class="fa fa-trash fa-fw"></i>\
                            </a>';
                        }, 
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#advertisements-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("{{ adminTransLang('are_you_sure_to_delete') }}")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#advertisements-table').DataTable().ajax.reload();
                    });
                }
            });
        });
		
		var advertisement_data_saved_flag = '{{ Session::has("advertisement_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(advertisement_data_saved_flag!="")
		 {
			 $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 
    </script>
@endsection