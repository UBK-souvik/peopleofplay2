@extends('admin.layouts.master')

@section('title') Main List Paragraph Update @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Main List Paragraph Update</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.cms.main_list_paragraph.index') }}"> All Main List Paragraphs </a></li>
            <li class="active">Main List Paragraph Update</li>
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
                        <input type="hidden" name="main_list_paragraph_id" value="{{@$main_list_paragraph->id}}">

                      <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="type" class="form-control" value="{{@$main_list_paragraph->type}}">
                                    <input type="text" readonly="" name="type_for_show" class="form-control" value="{{ucfirst(config('cms.drop_down_type')[@$main_list_paragraph->type])}}" >

                                </div>
                            </div>



                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea  class="form-control" id="description" name="description" placeholder="Description" value="">{{@$main_list_paragraph->description}}
                          </textarea>
                        </div>
                      </div>
					  
					                        <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.action_status') as $key => $status)
								  <option value="{{ $key }}" {{isset($main_list_paragraph) && $main_list_paragraph->status == $key ? 'selected' : ''}}>{{ $status }}</option>
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
                url: '{{route("admin.cms.main_list_paragraph.update")}}',
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
                        window.location.replace('{{ route("admin.cms.main_list_paragraph.index")}}');

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
