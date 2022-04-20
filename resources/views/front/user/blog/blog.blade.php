@extends('front.layouts.pages')
@section('content')


<div class="col-md-6 col-lg-7 MiddleColumnSection">
<div class="left-column PopBlogPage" id="add-edit-blog-div-id">
    
	<!-- method="post"  -->


	<form id="blog-form" enctype="multipart/form-data">
        <!-- <textarea id="Comments" name="description"  row="10" class="form-control">{{@$blog->description}}</textarea>
		    <input type="hidden" name="blog_id" value="{{@$blog->id}}"> -->
        @csrf
        <div class="First-column bg-white">
            <h3 class="sec_head_text mb-0" style="padding: 20px;">
			@if(!empty($blog->id))
			  {{'Edit'}}
			@else
			  {{'Add'}}	
			@endif			
			Blog Post</h3>
            <div class="col-md-12">
                <div class="row sectionBox pb-0">
                    
					@php
					  $str_featured_image_type_new = 'blog';
					@endphp
					@include('front.user.include_featured_image')					
					
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Add New Post">Title</label><span class="text-danger">*</span>
                                    <input id="AddNewPost" type="text" name="title" value="{{@$blog->title}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Category">Category</label><span class="text-danger">*</span>
                                    <select name="category_id" class="custom-select">
                                        <option value>Select</option>
                                        @foreach ($blog_categories as $key => $value)
                                        <option value="{{$key}}" {{isset($blog) && $blog->category_id == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="Tag">Tag</label><span class="text-danger">*</span>
                                    @include("front.includes.tags_drop_down")
									<?php /* <input id="Tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="{{@$blog->tag}}" placeholder="">
                                    <!--<p>Separate with commas or the Enter key.</p>-->
                                    {!!App\Helpers\UtilitiesTwo::getTagText()!!} --}} */?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                    <div class="col-md-12 pl-0  paddingBottomTwenty">
                      <div class="form-group m-0">
                          <label for="Comments">Blog</label><span class="text-danger">*</span>
                          <input name="discussionContent" type="hidden" value="{{@$blog->description}}">
						  <input name="blog_description_hidden"  id="blog_description_hidden" type="hidden" value="{{@$blog->description}}">
						  
						  <!-- <div id="editor-container">
						  </div> -->
						    @include("includes.include_quill_editor")
						  
						  {{-- <textarea id="Comments" name="description"  row="10" class="form-control w-100">{{@$blog->description}}</textarea> --}}
                          <input type="hidden" name="blog_id" value="{{@$blog->id}}">
                      </div>
                    </div>
                    
                </div>
                </div>
            
            <div class="col-md-12">
                <div class="row sectionBox">
                    <h2 class="sec_head_text w-100 text-left">Add SEO</h2>
                    <div class="col-md-6 pl-0 ">
                        <div class="form-group">
                            <label for="Add Meta Title">Meta Title</label><span class="text-danger"></span>
                            <input id="AddMetaTitle" type="text" name="meta_title" value="{{@$blog->meta_title}}"  class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6 pl-0">
                        <div class="form-group">
                            <label for="MetaKeyword">Meta Keyword</label><span class="text-danger"></span>
                            <input id="MetaKeyword" type="text" name="meta_keyword" value="{{@$blog->meta_keyword}}" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12 pl-0 ">
                        <div class="form-group mb-0">
                            <label for="MetaDescription">Meta Description</label><span class="text-danger"></span>
                            <textarea id="MetaDescription" type="text" name="meta_description"  row="10" class="form-control">{{@$blog->meta_description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="row sectionBox">
                <button type="button" id="blogSubmit" class="btn btnAll az">Publish</button>
              </div>
            </div>
            </div>
    </form>
</div>
</div>
@endsection

@section('scripts')

@include("includes.include_quill_editor_js")

<script language="javascript" type="text/javascript">
			

$( document ).ready(function() {
 
  @if(!empty($blog->description))
  <?php /*
  //var editor = document.getElementsByClassName('ql-editor');
  //editor[0].root.innerHTML = '{{@$blog->description}}';
  //quill.clipboard.dangerouslyPasteHTML(0, '{{@$blog->description}}'); */?>
  
  //Clear the existing contents
  quill.setText("");
  var sHTML = document.getElementById("blog_description_hidden").value.trim();
  quill.clipboard.dangerouslyPasteHTML(0, sHTML);
  
  @endif
		 
    });


</script>

<script>

function stripHtml(html){
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}


quill.on('text-change', function(delta, source) {
  /*if (source == 'api') {
    console.log("An API call triggered this change.");
  } else if (source == 'user') {
    console.log("A user action triggered this change.");
  }*/
  var ckeditor_description_new = frontend_get_quill_editor_description_new('Comments');
	
	ckeditor_description_new = stripHtml(ckeditor_description_new);
	var str_new_description_data_new = ckeditor_description_new.substr(0, 120);
	// do validation
	$('#add-edit-blog-div-id #MetaDescription').val(str_new_description_data_new);
});



//CKEDITOR.replace( 'Comments' );
/*
CKEDITOR.replace('Comments', {
        filebrowserUploadUrl: '{{ URL::to("backend/plugins/ckeditor/ck_upload.php") }}',
        filebrowserUploadMethod: 'form'
    });


CKEDITOR.instances.Comments.on('change', function() { 
        //var str_new_description_data =  $('#add-edit-blog-div-id #Comments').val();
	var ckeditor_description_new = frontend_get_ckeditor_description_new('Comments');
	
	ckeditor_description_new = stripHtml(ckeditor_description_new);
	var str_new_description_data_new = ckeditor_description_new.substr(0, 120);
	// do validation
	$('#add-edit-blog-div-id #MetaDescription').val(str_new_description_data_new);
});*/



$('#add-edit-blog-div-id #AddNewPost').on('keyup change', function() {
    var str_new_post_data =  $('#add-edit-blog-div-id #AddNewPost').val();
	// do validation
	$('#add-edit-blog-div-id #AddMetaTitle').val(str_new_post_data);
});

$('body').on('keyup change','#add-edit-blog-div-id .tag-input',function(e){	
    var str_new_keyword_data =  $('#add-edit-blog-div-id #Tag').val();
	var str_new_keyword_data_new =  str_new_keyword_data.split(",", 3);
	// do validation
	$('#add-edit-blog-div-id #MetaKeyword').val(str_new_keyword_data_new);
});

$('#add-edit-blog-div-id #Comments').on('keyup change', function() {

});


function frontend_get_tinymce_editor_description_new(str_element_id)
{
// Get content of a specific editor:
return tinyMCE.get(str_element_id).getContent();
}

function frontend_get_quill_editor_description_new(str_element_id)
{
// Get content of a specific editor:
return quill.getText();
}

        //frontend_show_standard_ckeditor_new('Comments');

     // Event Form
     $(document).on('click', '#blogSubmit', function (e) {
            e.preventDefault();
			
			var fd = new FormData($('#blog-form')[0]); 
            
			/*fd.delete('description');			
			var ckeditor_description_new = frontend_get_ckeditor_description_new('Comments');
            //var ckeditor_description_new = frontend_get_tinymce_editor_description_new('Comments');
			fd.append('ckeditor_description_new', ckeditor_description_new);*/
			
			// Populate hidden form on submit
			//var discussionContent = document.querySelector('input[name=discussionContent]');
			//discussionContent.value = JSON.stringify(quill.getContents());
			//alert(discussionContent.value);			
			var editor_content = quill.container.innerHTML;
			//alert(editor_content);
			//var justHtml = editor.root.innerHTML;			
			//{"ops":[{"insert":"dsfsdf dsfs\n"}]}
			//var obj = discussionContent.value);
            //alert(obj.ops);
			//alert(discussionContent.value.ops);			
			fd.append('ckeditor_description_new', editor_content);
	
			//alert(ckeditor_description_new);
			
            $.ajax({
                url: "{{ route('front.user.blog.create') }}",
				headers: {
                 'X-CSRF-TOKEN': ajax_csrf_token_new
                },
                data: fd,// + '&ckeditor_description_new=' + ckeditor_description_new
                processData: false,
                contentType: false,
				dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#blogSubmit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#blogSubmit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#blogSubmit').attr('disabled', false);
                    toastr.success("Blog Saved Successfully.");
					//$('#blog-form').trigger('reset')
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    //toastr.success(data.message)
                    window.location.replace('{{ route("front.user.blog.index")}}');

                }
            });
        });

</script>

@include('includes.include_tags_js')

@endsection
