@extends('admin.layouts.master')

@section('title') 

All Galleries

@endsection

@section('content')
    <section class="content-header">
   <h1> 
   All Galleries
   </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">
All Galleries
</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
		  <a href="{{ route('admin.galleries.showadd') }}/1" class="btn btn-success">Create Image Gallery</a>		
		  <a href="{{ route('admin.galleries.showadd') }}/2" class="btn btn-success">Create Video Gallery</a>
		  <a href="{{ route('admin.galleries.showadd') }}/3" class="btn btn-success">Create Known For Gallery</a>
        
		{{-- @if(!empty($user_id)){{'disabled'}}@endif --}}
		
		</p>
		
		<div class="row">
		
		<div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Select User</label>
                                <div class="col-sm-6">
                                   <select class="form-control select2" name="select_gallery_user_id" id="select_gallery_user_id" onchange="return get_gallery_list_by_users(this.value, 0);">
                                     <option>Select User</option>
                                     @if(count($users_list) > 0)
                                        @foreach($users_list as $users_list_row)
                                          <option value="{{$users_list_row->id}}" {{ (@$user_id  == $users_list_row->id ) ? 'selected' :''}}> {{$users_list_row->text}}</option>
                                        @endforeach
                                     @endif
                                   </select>
                                </div>
                              </div>
		</div>			
<div class="row">		
		<div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Select Media</label>
                                <div class="col-sm-6">
                                   <select class="form-control select2" name="select_media_id" id="select_media_id" onchange="return get_gallery_list_by_users({{@$user_id}},this.value);">
                                     <option>Select Media</option>
									  @foreach($get_gallery_link_types_urls as $get_gallery_link_types_url_key => $get_gallery_link_types_url_val)
										<option value="{{$get_gallery_link_types_url_key}}" @if(@$int_media_id  == $get_gallery_link_types_url_key){{'selected'}}@endif> {{ucwords(str_replace('-', ' ', $get_gallery_link_types_url_val))}}</option>
									  @endforeach
                                   </select>
                                </div>
                              </div>					  
	   
		</div>
		
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="galleries-table">
                            <thead>
                                <tr>
                                    
									<th>Title</th>
									<th>User Email</th>
									<th>Gallery Type</th>
									<th>Is Known For</th>
									<th>Media(Click to View)</th>
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
	
    <div class="modal fade" id="DescModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
                 <h3 class="modal-title">View Image/Video</h3>
 
            </div>
            <div class="modal-body">
                 <div id="div-video-image"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
       
	
@endsection

@section('scripts')
    <script type="text/javascript">
	
	function get_gallery_list_by_users(user_id,media_id)
	{
		window.location.href = '{{ route("admin.galleries.index") }}/'+user_id+'/'+media_id;
	}
	
	var str_image_upload_path_new = '{{ url('/') . $folder_path }}';
	
        $(function() {
var galleries_table_new = $('#galleries-table').DataTable({
				
				
                processing: true,
                serverSide: true,
				
                ajax: '{{ route("admin.galleries.list") }}/{{$user_id}}/{{$int_media_id}}',
                columns : [
                    { "data": "title" },
					{
                    "data": "user_data.email",
                    "defaultContent": "Admin"
                    },
					//{ "data": "gallery_type_data" },
					{
					"data":"type",
					"mRender": function (data, type, row) {
					   
					   if(row.type == 2)
					   {
						  return 'Video';
					   }	   
					   else
					   {
						 return 'Image';  
					   }
					   
					  }
					},
					{
					"data":"is_known_for",
					"mRender": function (data, type, row) {
					   
					   if(row.is_known_for>0)
					   {
						 return 'Yes';  
					   }	   
					   else
					   {
						 return 'No';  
					   }
					   
					  }
					},
					
					{
                        "data": "media",
                        "mRender": function (data, type, row) {
                            
							var str_gallery_image_video_data ='';
							var str_path_video_image_gallery ='';
							var str_video_id_data = '';
							var int_gallery_type = row.type;
							
							if(int_gallery_type == 1)
							{
							   str_gallery_image_video_data = '<img style="width:100px;height:100px;"  src="'+ str_image_upload_path_new + `${row.media}`+'">';	
							   str_path_video_image_gallery = str_image_upload_path_new + row.media;							
							}
							else if(int_gallery_type == 2)
							{
							   str_gallery_image_video_data =  '<img style="width:100px;height:100px;" src="'+`${row.image_video_data}`+'"/></a>';	
							   str_path_video_image_gallery = row.media;
							   str_video_id_data = row.video_id_data;
							}
							else
							{
							  str_gallery_image_video_data =  '<img style="width:100px;height:100px;"  src="'+ str_image_upload_path_new + `${row.media}`+'">';
							  str_path_video_image_gallery = str_image_upload_path_new + row.media;
							}
							
							//return '<a data-video-id-data="'+str_video_id_data+'" data-gallery-type="'+int_gallery_type+'" data-str-path-video-image-gallery="'+str_path_video_image_gallery+'" href="#" class="span-style1" data-toggle="modal" data-target="#modal-gallery-info-popup">' + str_gallery_image_video_data + '</a>';
							return '<a data-video-id-data="'+str_video_id_data+'" data-gallery-type="'+int_gallery_type+'" data-str-path-video-image-gallery="'+str_path_video_image_gallery+'" href="#" class="span-style1" data-toggle="modal" data-target="#modal-gallery-info-popup">Click to View</a>';
							 
                        },
					},	
					/*{
                        "data": "mobile",
                        "mRender": function (data, type, row) {
                            return `+${row.dial_code} ${row.mobile}`;
                        }
                    },*/
                    
                    /*{
                        "data": "created_at",
                        "mRender": function (data, type, row) {
                            return moment(data).format('YYYY-MM-DD hh:mm A');
                        }
                    },*/
                    {	
                        "data": "caption",					
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.galleries.showedit") }}/'+row.id+'/'+row.type+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a href="{{ URL::to("admin/galleries/delete") }}/'+row.id+'" class="delete_admins" >\<i class="fa fa-trash fa-fw"></i>\</a>';
                        }, 
                        orderable: false
                    }
                ],
				order : [[1, 'desc']]
            });

            $('#galleries-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("{{ adminTransLang('are_you_sure_to_delete') }}")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#galleries-table').DataTable().ajax.reload();
                    });
                }
            });
			
			$('#galleries-table').on('click', '.span-style1', function() {
				
				    //var cell = galleries_table_new.cell( this );

				    //alert( cell.data() );
					
					//var val = $(this).closest('tr').find('td:eq(3)').text(); // amend the index as needed
                    //    alert(val);
                    $('#DescModal').modal("show");				      
					
					var str_path_video_image_gallery_new = $(this).data("str-path-video-image-gallery");
					var str_video_id_data_new = $(this).data("video-id-data");
					  
					if($(this).data("gallery-type") == 2)
					{
					  $('#DescModal #div-video-image').html('<iframe width="500" height="400" src="https://www.youtube.com/embed/'+str_video_id_data_new+'"></iframe>');
					}
					else
					{
					  $('#DescModal #div-video-image').html('<img src='+str_path_video_image_gallery_new+' width="500px" height="500px">');	
					}
				
    //function code here
			});

			
			
        });
		
		var gallery_data_saved_flag = '{{ Session::has("gallery_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(gallery_data_saved_flag!="")
		 {
			 $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 
    </script>
@endsection