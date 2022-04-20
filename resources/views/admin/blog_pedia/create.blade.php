@extends('admin.layouts.master')

@section('title') Create Blog Pedia @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Blog Pedia</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.blog_pedia.index') }}"> All Blog Pedias </a></li>
            <li class="active">Create Blog Pedia</li>
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
                        <input type="hidden" name="blog_pedia_id" value="{{@$blog_pedia->id}}">

					  
<div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Blog <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="blog_id" @if(!empty($blog_pedia->id)) {{'disabled'}} @endif>
                            <option value="">Select</option>
                            @foreach($blog_list as $blog_row)
					           @php
							   $arr_blog_row =  json_decode(@$blog_row);
							   $key = @$arr_blog_row->id;
							   $status = @$arr_blog_row->text;
                               @endphp							   
							  <option value="{{ $key }}" {{isset($int_blog_id_sel_new) && $int_blog_id_sel_new == $key ? 'selected' : ''}}>{{ $status }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

     
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status"  @if(!empty($blog_pedia->id)) {{'disabled'}} @endif>
                              @foreach(config('cms.blog_status') as $key => $status)
								  @if($key>0)
									<option value="{{ $key }}" {{isset($blog) && $blog->status == $key ? 'selected' : ''}}>{{ $status }}</option>
								  @endif
							  @endforeach
                            </select>
                        </div>
                      </div>

                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
						   @if(empty($blog_pedia->id)) 
						  <button type="button" class="btn btn-success" id="createBtn">Submit</button> 
					       @endif                          
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
                url: '{{route("admin.blog_pedia.create")}}',
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
                        window.location.replace('{{ route("admin.blog_pedia.index")}}');

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
