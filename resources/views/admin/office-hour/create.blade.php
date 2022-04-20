@extends('admin.layouts.master')

@section('title') Create Office Hour @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create  Office Hour</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.office-hour.index') }}"> All  Office Hour </a></li>
            <li class="active">Create  Office Hour</li>
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
                        <input type="hidden" name="id" value="{{@$data->id}}">
                      
                      <div class="form-group">
                             <label for="check_image" class="col-sm-2 control-label"> Logo<i class="has-error">*</i></label>
                             <div class="col-sm-6">
                              <img id="blah" src="{{@imageBasePath(@$data->featured_image)}}" alt="" class="imgHundred">
                              <input type="file" name="featured_image" class="marginTopFive image" onchange="readURL(this);">
                              <input type="hidden" name="image" id="check_image" value="<?php if(isset($data->featured_image) && !empty($data->featured_image)) { echo 1; } ?> ">
                            </div>
                            </div>
                       <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description" placeholder="Description">{{@$data->description}}</textarea>
                         
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">Logo URL  (Zoom)<i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="featured_image_url" placeholder="url" value="{{ @$data->featured_image_url }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">Set Up Meeting</label>
                        <div class="col-sm-3">
                         <select class="form-control" name="type">
                           <option value="">Select Type</option>
                           <option @if(@$data->type ==1) {{ 'selected' }} @endif value="1">Email</option>
                           <option @if(@$data->type ==2) {{ 'selected' }} @endif value="2">URL</option>
                         </select>
                        </div>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" name="meeting_url" placeholder="Meeting" value="{{ @$data->meeting_url }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">Website URL</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="website_url" placeholder="Website" value="{{ @$data->website_url }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.action_status') as $key => $status)
                                <option value="{{ $key }}" {{isset($data) && $data->status == $key ? 'selected' : ''}}>{{ $status }}</option>
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
        // admin_show_standard_ckeditor_new('description');
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
             var fd = new FormData($('form')[0]);  
            // var ckeditor_description_new = admin_get_ckeditor_description_new('description');
            // fd.append('description', ckeditor_description_new);
            $.ajax({
                processData: false,
                contentType: false,
                url: "{{ route('admin.office-hour.create') }}",
                data: fd,
                dataType: 'json',
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
                        window.location.replace('{{ route("admin.office-hour.index")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });


     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
            
        }
</script>

@endsection
