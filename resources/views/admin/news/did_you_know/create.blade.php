@extends('admin.layouts.master')

@section('title') Create Did You Know @endsection

@section('content')

@php 
$arr_categories_pivot_id = array();
  if(!empty($news_categories_pivot))
  {
	 foreach($news_categories_pivot as $news_categories_pivot_val)					
	  {	
		$arr_categories_pivot_id[] = $news_categories_pivot_val['news_category_id'];								  
	  }  
  }								  							   
@endphp

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Did You Know</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.news.index') }}"> All Did You Knows </a></li>
            <li class="active">Create Did You Know</li>
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
                        <input type="hidden" name="news_id" value="{{@$news->id}}">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$news->title}}">
                        </div>
                      </div>

                      @include('admin.includes.author_drop_down_list')

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" multiple name="category_id[]">
                            <option value="">Select</option>
                            @foreach($news_categories as $key => $status)
                               
							  <option
                              value="{{ $key }}"
                               @if(in_array($key, $arr_categories_pivot_id)) {{'selected'}}@endif>{{ $status }}</option>
							  
                            @endforeach
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tags <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input id="tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="@if(!empty($news->tag)){{@$news->tag}}@endif" placeholder="Tags">
						  {!!App\Helpers\UtilitiesTwo::getTagText()!!}
						</div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" id="description" name="description" placeholder="Description" value="">{{@$news->description}}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{@$news->meta_title}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{@$news->meta_description}}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Keyword <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" value="{{@$news->meta_keyword}}">
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <input type="file" name="featured_image" >
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <img src="{{@imageBasePath($news->featured_image)}}" width="100" alt="">
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                       <img src="{{@imageBasePath($news->featured_image)}}" class="imgHundred" alt="">
                        <input type="file" name="featured_image" class="marginTopFive">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.blog_status') as $key => $status)
                                @if($key>0)
								  <option value="{{ $key }}" {{isset($news) && $news->status == $key ? 'selected' : ''}}>{{ $status }}</option>
							    @endif	
                              @endforeach
                            </select>
                        </div>
                      </div>
					  
					  
					            <!-- <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Is Home Page <i class="has-error"></i></label>
                        <div class="col-sm-6">
                            <input id="is_home_page" name="is_home_page" type="checkbox" value="1" @if(!empty($news->is_home_page)){{'checked'}}@endif>
                        </div>
                      </div> -->
					 
                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Save</button>
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

    $('.select2').select2()

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
                url: '{{route("admin.did-you-know.create")}}',
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
                        window.location.replace('{{ route("admin.did-you-know.index")}}');

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
