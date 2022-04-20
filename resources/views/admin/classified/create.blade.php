@extends('admin.layouts.master')

@section('title') Create Classified @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Classified</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.classified.index') }}"> All Classifieds </a></li>
            <li class="active">Create Classified</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                        <input type="hidden" name="classified_id" value="{{@$classified->id}}">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$classified->title}}">
                        </div>
                      </div>
					  
					  @include('admin.includes.author_drop_down_list')

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="category_id">
                            <option value="">Select</option>
                            @foreach($classified_categories as $key => $status)
                              <option value="{{ $key }}" {{isset($classified) && $classified->category_id == $key ? 'selected' : ''}}>{{ $status }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea  class="form-control" id="description" name="description" placeholder="Description" value="">{{@$classified->description}}
                          </textarea>
                        </div>
                      </div>
					  
					  
					  <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Profile Url <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input id="profile_url" type="text" name="profile_url" readonly value="{{@$classified->profile_url}}" class="form-control" placeholder="">
                        </div>
                      </div>
					  

                      <!-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <input type="file" name="featured_image" >
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <img src="{{@imageBasePath($classified->featured_image)}}" width="100" alt="">
                        </div>
                      </div> -->


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.classified_status') as $key => $status)
								  @if($key>0)
									<option value="{{ $key }}" {{isset($classified) && $classified->status == $key ? 'selected' : ''}}>{{ $status }}</option>
								  @endif
							  @endforeach
                            </select>
                        </div>
                      </div>

                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
<script type="text/javascript">


function get_classified_user_url(int_user_id)
{
	
	
$.ajax({

			url: '{{route("admin.classified.get-user-url")}}',

			type: 'post',

			dataType: "json",

			data: {

			 int_user_id: int_user_id,

			 token: ajax_csrf_token_new,

			},

			headers: {

			 'X-CSRF-TOKEN': ajax_csrf_token_new

			},
			
			beforeSend: function () {
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    //console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },

			success: function( data ) {
				$('#profile_url').val(data.msg);			
			}

		   });
}		   
		   


    jQuery(function($) {
        $('.select2').select2()

        $(document).on('click','#createBtn',function(e){
            e.preventDefault();
      			
      			var fd = new FormData($('#create-form')[0]);  
  		
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '{{route("admin.classified.create")}}',
  			        headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                type: 'POST',
                beforeSend: function()
                {
                    $('#createBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#createBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#createBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('{{ route("admin.classified.index")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

@endsection
