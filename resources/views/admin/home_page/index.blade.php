@extends('admin.layouts.master')

@section('title') HomePage @endsection

@section('content')
    <section class="content-header">
        <h1> HomePage </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">HomePage</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
    <section class="content">
        @include('admin.includes.info-box')
        
		<div class="col-sm-6" style="margin-top: 8px;margin-bottom:5px;">
                        <div class="row">
						  <button type="button" class="btn btn-success" id="saveOrderBtn">Save Display Order</button>
                        </div>
                    </div>
		
		<div class="row"  id="save-order-main-box-body-div">
                <form class="form-horizontal" id="save-order-main-box-body-form">
						{{ csrf_field() }}    
			<div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Display Order</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
		      
		  </form>	
        </div>
		  
		  
		  
		
		
    </section>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
        
		$('body').on('click','#saveOrderBtn',function(e){
                e.preventDefault();
				 
                var fd = new FormData($('#save-order-main-box-body-div  form')[0]);
                //fd.append('dial_code', phone.dialCode);

                $.ajax({
				    url: baseUrl + '/admin/cms/home-page/save-order',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#saveOrderBtn').attr('disabled',true);
                        $('#message-box-id  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#saveOrderBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
						var res = '';
						if(msg.indexOf("essages.")>0)
						{
						   res = msg.split("essages.");	
						   msg = res[1];
						}
						
                        $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
						
						$('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
						
                        $('#saveOrderBtn').attr('disabled',false);
                        
                        window.location.replace('{{ route("admin.cms.home_page.index")}}' );                        
                    }
                });
				
				
				
            });
		
		
		
		$('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.cms.home_page.list") }}',
            columns : [
	            { "data": "display_order", 
				"mRender": function (data, type, row) {
					   var int_row_id_new = row.id;
					   var int_display_order_new = row.display_order;
					   return '<input style="width:35px;" type="text" name="display_order['+int_row_id_new+']" id="display_order_'+int_row_id_new+'" value="'+int_display_order_new+'">';					
				  }
				},  
	            { "data": "title" },
	            { "data": "type" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="{{ URL::to("admin/cms/home-page/update") }}/'+row.id+'" class="danger">\<i class="fa fa-edit fa-fw"></i>\</a>';
                    },
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

</script>
@endsection
