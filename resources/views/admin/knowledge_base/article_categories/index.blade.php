@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_article_categories') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('all_article_categories') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li class="active">{{ adminTransLang('all_article_categories') }}</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        @include('admin.includes.info-box')
        
            <a href="{{route('admin.knowledge-base-article-categories.showadd')}}" class="btn btn-success">Create Article Category</a>
	    </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="article-categories-table">
                            <thead>
                                <tr>
                                    
									<th>{{ adminTransLang('article_category') }}</th>
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
	    $(function() {
            $('#article-categories-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.knowledge-base-article-categories.list") }}',
                columns : [
          		    { "data": "category" },
					{ "data": "status" },
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="{{ route("admin.knowledge-base-article-categories.showedit") }}/'+row.id+'">\
                                <i class="fa fa-edit fa-fw"></i>\
                            </a>\
                            <a href="{{ URL::to("admin/knowledge-base/article-categories/delete") }}/'+row.id+'" class="delete_admins" >\
                                <i class="fa fa-trash fa-fw"></i>\
                            </a>';
                        }, 
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#article-categories-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("{{ adminTransLang('are_you_sure_to_delete') }}")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#article-categories-table').DataTable().ajax.reload();
                    });
                }
            });
        });
		
		var article_category_data_saved_flag = '{{ Session::has("article_category_data_saved_flag") }}';

        $(document).ready(function(){
			
		if(article_category_data_saved_flag!="")
		 {
			 $('#message-box-id').html('{{adminTransLang("data_saved_successfully")}}').removeClass('hide alert-danger').addClass('alert-success');
			 $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 
    </script>
@endsection