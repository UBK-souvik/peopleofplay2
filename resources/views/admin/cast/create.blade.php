@extends('admin.layouts.master')

@section('title') Create Cast @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.cast.index') }}"> All Cast </a></li>
            <li class="active">Create Cast</li>
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
                        <label for="title" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$data->title}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="category_id" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <?php //echo "<pre>"; print_r($categories); die ?>
                        <select class="form-control" id="category_id" name="category_id">
                           <option value="">-- Select Category --</option> 
                           @foreach ($categories as $key => $category)
                            <option value="{{ $category->id }}" <?php if($category->id== @$data->category_id){ echo 'selected'; } ?>> {{ $category->name }} </option> 
                           @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">URL <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="url" placeholder="url" value="{{@$data->url}}">
                        </div>
                      </div>
                      <div class="form-group">
                             <label for="check_image" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
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
                      <input type="hidden" name="type" value="cast">
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

                      <div class="form-group">
                        <label for="news_feeds_category" class="col-sm-2 control-label">News Categories <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="news_feeds_category">
                            <option value="">--Select News Feeds Categories--</option>
                            @foreach(@$feeds_categories as $feeds_category)
                              <option value="{{ $feeds_category->id }}" >{{ $feeds_category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Submit</button>
                          <span class="ml-3 mt-3"><input type="checkbox" name="feed_check" value="on"> &nbsp;Share to home feeds.</span>
                          <span class="ml-3 mt-3"><input type="checkbox" name="news_feed_check" value="on"> &nbsp;Share to news feeds.</span>
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
                url: "{{ route('admin.cast.create') }}",
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
                        window.location.replace('{{ route("admin.cast.index")}}');

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
