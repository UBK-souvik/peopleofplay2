@extends('admin.layouts.master')

@section('title') Create Truth or Lie @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Quiz </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.quiz.index') }}"> Quiz</a></li>
            <li class="active">Create Quiz</li>
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
                        <input type="hidden" name="question_id" value="{{@$question->id}}">
					  
					 <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title<i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          
                          <span>
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{ @$question->title }}">
                          </span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description<i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          
                          <span>
                          <textarea class="form-control" name="description" placeholder="Description">{{ @$question->description }}</textarea>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                     <label for="advertisement_image" class="col-sm-2 control-label">Image <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <img @if(!empty($question->image)){{'style=display:block;'}} @else {{'style=display:none;'}} @endif id="advertisement-blah-image" @if(!empty($question->image)) 
                        src="{{asset('uploads/images/quiz/'.$question->image)}}" @endif alt=""
                        class="imgHundred" >
                        <input id="file-uploadten" onchange="readBannerURL(this);" type="file" name="file" class="marginTopFive">
                     </div>
                  </div>
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.blog_status') as $key => $status)
								  @if($key>0)
									<option value="{{ $key }}" {{isset($question) && $question->status == $key ? 'selected' : ''}}>{{ $status }}</option>
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
                url: '{{route("admin.quiz.create")}}',
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
                        window.location.replace('{{ route("admin.quiz.index")}}');

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
