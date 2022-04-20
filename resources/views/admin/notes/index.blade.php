@extends('admin.layouts.master')

@section('title') 

 {{ adminTransLang('all_notes') }} 

@endsection

@section('content')
    <section class="content-header">
        <h1> 
 {{ adminTransLang('all_notes') }} 
 </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">
 {{ adminTransLang('all_notes') }} 
</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
		  <a href="{{ route('admin.notes.showadd') }}" class="btn btn-success">Create Notes</a>
		
		</p>
		
		<div class="row">
		
	
	   
		</div>
		
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
									<th>Note 1</th>
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
        $('#navigation-table').DataTable({
			"pageLength": 10,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.notes.list") }}',
            columns : [
			    //{ "data": "name_data" },
				{
					"data":"user_data.email",
					"mRender": function (data, type, row) {
					console.log(row.destination_id)
					   if(row.destination_id == 1)
					   {
						  return row.user_data.email;
					   }	   
					   else if(row.destination_id == 2)
					   {
						 return row.product_data.name;   
					   }
					   else
					   {
						 return 'Admin';  
					   }					
				  }
				},	
                { "data": "notes_1" },
	            {
                    "mRender": function (data, type, row)
                    {
                        return '<a href="{{ URL::to("admin/notes/showedit") }}/'+row.id+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a class="delete_admins" href="{{ URL::to("admin/notes/delete") }}/'+row.id+'">\<i class="fa fa-trash fa-fw"></i>\</a>';
                    }, orderable: false
                }
	        ],
            order : [[1, 'desc']]
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
	
	var notes_data_saved_flag = '{{ Session::has("notes_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(notes_data_saved_flag!="")
		 {
			 $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 

</script>
@endsection