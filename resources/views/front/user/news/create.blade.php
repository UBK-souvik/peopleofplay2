@extends('front.layouts.pages')
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

<div class="left-column">
    <form id="news-form" class="kform_control" enctype="multipart/form-data">
        <input type="hidden" name="blog_id" value="{{@$news->id}}">
        @csrf
        <div class="First-column bg-white">
        <div class="col-md-12">
            <div class="row sectionTop">
                <h3 class="sec_head_text mb-0">
				@if(!empty($news->id))
			      {{'Edit'}}
				@else
				  {{'Add'}}	
				@endif
				
				Did You Know</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div id="FirstRow_Product" class="row sectionBox">
              
			        @php
					  $str_featured_image_type_new = 'news';
					@endphp
					@include('front.user.include_featured_image')
			  
              <div class="col-md-8 colmargin">
                <div class="row">
                  <div class="col-md-6 pl-0">
                    <div class="form-group">
                        <label for="Add New Post">Title</label><span class="text-danger">*</span>
                        <input id="AddNewPost" type="text" name="title" value="{{@$news->title}}" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="form-group">
                        <label for="Add New Post">Is Featured
                        <input id="is_featured_news" class="form-control mt-2 inputCheckBoxNews" name="is_featured_news" type="checkbox" value="1" @if(!empty($news->is_featured)){{'checked'}}@endif class="form-control" placeholder="">
                        </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pl-0">
                        <div class="form-group">
                            <label for="Tag">Tag</label><span class="text-danger">*</span>
                            <input id="Tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class kNewsInput" value="{{@$news->tag}}" placeholder="">
                            {!!App\Helpers\UtilitiesTwo::getTagText()!!}
						</div>
                    </div>
                    <div class="col-md-6 pl-0">
                        <div class="form-group">
                            <label for="Category">Category</label><span class="text-danger">*</span>
                            <select name="category_id[]" class="custom-select select2" multiple>
                                @foreach($news_categories as $key => $status)
                               
							  <option
                              value="{{ $key }}"
                               @if(in_array($key, $arr_categories_pivot_id)) {{'selected'}}@endif>{{ $status }}</option>
							  
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="Comments">Description</label><span class="text-danger">*</span>
                    <textarea id="Comments" name="description"  row="10" class="form-control">{{@$news->description}}</textarea>
                </div>
            </div>
        <div class="col-md-12">
            <div class="row sectionBox">
                <h3 class="sec_head_text w-100">Add SEO</h3>
                <div class="col-md-6 pl-0">
                    <div class="form-group">
                        <label for="Add Meta Title">Meta Title</label><span class="text-danger">*</span>
                        <input id="AddMetaTitle" type="text" name="meta_title" value="{{@$news->meta_title}}"  class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-6 pl-0">
                    <div class="form-group">
                        <label for="MetaKeyword">Meta Keyword</label><span class="text-danger">*</span>
                        <input id="MetaKeyword" type="text" name="meta_keyword" value="{{@$news->meta_keyword}}" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-12 pl-0">
                    <div class="form-group mb-0">
                        <label for="MetaDescription">Meta Description</label><span class="text-danger">*</span>
                        <textarea id="MetaDescription" type="text" name="meta_description"  row="10" class="form-control">{{@$news->meta_description}}</textarea>
                    </div>
                </div> 
            </div>
        </div>

        <div class="col-md-12">
            <div class="row sectionBox">
                <button type="button" id="newsSubmit" class="btn edit-btn-style  az">Publish</button>
            </div>
        </div>

        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>

frontend_show_standard_ckeditor_new('Comments');

     // Event Form
     $(document).on('click', '#newsSubmit', function (e) {
            e.preventDefault();
			
			var ckeditor_description_new = frontend_get_ckeditor_description_new('Comments');
			
			var fd = new FormData($('#news-form')[0]);  
            fd.append('ckeditor_description_new', ckeditor_description_new);
			
			$.ajax({
                url: "{{ route('front.user.news.create') }}",
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                data: fd,
                processData: false,
                contentType: false,
				dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#newsSubmit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#newsSubmit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#newsSubmit').attr('disabled', false);
                    $('#news-form').trigger('reset')
					toastr.success("News Saved Successfully.");
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    //toastr.success(data.message)
                    window.location.replace('{{ route("front.user.news.index")}}');

                }
            });
        });

</script>
@endsection
