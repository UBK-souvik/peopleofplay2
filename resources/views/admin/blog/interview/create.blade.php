@extends('admin.layouts.master')

@section('title') Create Interview @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Interview</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.interview.index') }}"> All Interviews </a></li>
            <li class="active">Create Interview</li>
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
                        <input type="hidden" name="blog_id" value="{{@$blog->id}}">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$blog->title}}">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Author <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="user_id">
                            <option value="">Select</option>
                            <option value="0" selected>  Admin </option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="category_id">
                            <option value="">Select</option>
                            @foreach($blog_categories as $key => $status)
                              <option value="{{ $key }}" {{isset($blog) && $blog->category_id == $key ? 'selected' : ''}}>{{ $status }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tags <i class="has-error">*</i></label>
                        <div class="col-sm-6">
						 @include("admin.includes.admin_tags_drop_down")
						
						{{-- <input id="tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="@if(!empty($blog->tag)){{@$blog->tag}}@endif" placeholder="Tags">
						{!!App\Helpers\UtilitiesTwo::getTagText()!!} --}}
						
						</div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" id="description" name="description" placeholder="Description">{{@$blog->description}}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{@$blog->meta_title}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{@$blog->meta_description}}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Keyword <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" value="{{@$blog->meta_keyword}}">
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <input type="file" name="featured_image" >
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <img src="{{@imageBasePath($blog->featured_image)}}" width="100" alt="">
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                        <img id="profile-blah-image" src="{{@newsBlogImageBasePath($blog->featured_image)}}" alt="" class="imgHundred">
                        <input type="file" name="featured_image" class="marginTopFive">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
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

admin_show_standard_ckeditor_new('description');

    jQuery(function($) {
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
			
			var ckeditor_description_new = admin_get_ckeditor_description_new('description');
			
			var fd = new FormData($('#create-form')[0]);  
            fd.append('ckeditor_description_new', ckeditor_description_new);
			
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '{{route("admin.interview.create")}}',
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
                        window.location.replace('{{ route("admin.interview.index")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

@include('includes.include_tags_js')

@endsection
