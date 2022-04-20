@extends('admin.layouts.master')

@section('title') Featured News @endsection

@section('content')

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Featured News </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
                <li class="active">Featured News</li>
            </ol>
        </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            @include('admin.includes.info-box')
            <p>
                <a href="{{ route('admin.news_feeds.featured_news.create') }}" class="btn btn-success">Create News Feeds</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Featured Image</th>
                                        <th>Title</th>
                                        <th>Posted By</th>
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
            ajax: '{{ route("admin.news_feeds.featured_news_feeds_list") }}',
            columns : [
                {
                    "mRender": function(data,type,row) {
                        if(row.type == 2){
                            return '<img  src="'+row.video_url+'" class="imgFifty">'
                        }else{
                            return '<img  src="'+row.image+'" class="imgFifty">'
                        }
                    },
                    orderable: false
                },
	            { "data": "title" },
                {
                    "mRender": function (data, type, row)
                    {
                        if(row.submitted_by == 1){
                            return 'Admin';
                        }else{
                            return 'User';

                        }
                    }, orderable: false
                },
                {
                    "mRender": function (data, type, row)
                    {
                        return '<a href="{{ URL::to("admin/news_feeds/featured_news/update") }}/'+row.id+'">\
                        <i class="fa fa-edit fa-fw"></i>\
                        </a>\
                        <a class="delete_admins" href="{{ URL::to("admin/news_feeds/delete") }}/'+row.id+'">\
                            <i class="fa fa-trash fa-fw"></i>\
                        </a>';
                    }, orderable: false
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

        function getYoutubeThumbnailfeed(youtube_url) {
            $.ajax({
                url: "{{route('admin.news_feeds.get_youtube_thumbnail')}}",
                data: {'_token':'{{ csrf_token() }}','video_url':youtube_url},
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                if(data.success == 1){
                    $('#blah').attr('src',data.thumbnail);
                    $('#blah').css({'display':'inline'});
                    $('.marginTopFive').hide();
                    $('.url').attr('disabled',true);
                } else {
                    $('#add-gallery-image-upload-preview-onevideo').attr('src','');
                    $('#blah').css({'display':''});
                    $('.marginTopFive').show();
                    $('.url').removeAttr('disabled');
                    toastr.error(data.msg);
                }
                }
            });
            }

</script>
@endsection
