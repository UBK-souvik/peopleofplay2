@extends('front.layouts.pages')
@section('content')
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class="left-column Popblog" id="add-edit-blog-div-id">
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
               Blog Post
            </h3>
            <div class="col-md-12">
               <div class="row sectionBox pb-0">
                  @php
                  $str_featured_image_type_new = 'blog';
                  @endphp
                  @include('front.user.include_featured_image')                    
                  <div class="col-md-8">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Add New Post">Title</label><span class="text-danger">*</span>
                              <input id="AddNewPost" type="text" name="title" value="{{@$blog->title}}" class="form-control" placeholder="">
                           </div>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="Tag">Tag</label><span class="text-danger">*</span>
                              @include("front.includes.tags_drop_down")
                              <?php /* <input id="Tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="{{@$blog->tag}}" placeholder="">
                                 <!--<p>Separate with commas or the Enter key.</p>-->
                                 {!!App\Helpers\UtilitiesTwo::getTagText()!!} --}} */?>
                              <p class="TagNote"><small class="text-danger">Note: Type text and Press Enter to Create a Tag.</small></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- </div> -->
                  <div class="col-md-12 paddingBottomTwenty">
                     <div class="form-group m-0">
                        <label for="Comments">Blog</label><span class="text-danger">*</span>
                        <?php $description =@$blog->description; ?>
                        <!-- <div id="editor-container">
                           </div> -->
                        @include("includes.include_quill_editor")
                        {{-- 
                        <textarea id="Comments" name="description"  row="10" class="form-control w-100">{{@$blog->description}}</textarea>
                        --}}
                        <input type="hidden" name="blog_id" value="{{@$blog->id}}">
                        <input type="hidden" id="blog_preview_id" name="blog_preview_id" value="">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <h2 class="sec_head_text w-100 text-left">Add SEO</h2>
                  <div class="col-md-6  ">
                     <div class="form-group">
                        <label for="Add Meta Title">Meta Title</label><span class="text-danger"></span>
                        <input id="AddMetaTitle" type="text" name="meta_title" value="{{@$blog->meta_title}}"  class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-6 ">
                     <div class="form-group">
                        <label for="MetaKeyword">Meta Keyword</label><span class="text-danger"></span>
                        <input id="MetaKeyword" type="text" name="meta_keyword" value="{{@$blog->meta_keyword}}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-md-12  ">
                     <div class="form-group mb-0">
                        <label for="MetaDescription">Meta Description</label><span class="text-danger"></span>
                        <textarea id="MetaDescription" type="text" name="meta_description"  rows="5"  class="form-control">{{ strip_tags(@$blog->meta_description) }}</textarea>
                     </div>
                  </div>
                  <div class="col-md-12 mt-3">
                     <div class="form-group mb-0">
                        <input type="checkbox" name="feed_check" value="on">
                        <label for="">Share to feed</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="row sectionBox">
                  <input type="hidden" id="blg_status" name="blg_status" vlue="1">
                  <button type="button" id="blogSubmit" class="btn btnAll az mr-3">@if(!isset($blog) || $blog->status == 0) {{ 'Publish' }}@else {{ 'Update' }}@endif <i class="fa fa-spinner fa-spin postLoading" style="display: none;"></i></button>
                  @if(!isset($blog) || $blog->status == 0)
                     <button type="button" id="blogDraft" class="btn btnAll az mr-3" name="blog_draft" onclick="blogs_Submit(this); return false;">Save as draft <i class="fa fa-spinner fa-spin postLoading1" style="display: none;"></i></button>
                  @endif
                     <button type="button" id="blogPreview" class="btn btnAll az mr-3" onclick="blog_preview(this); return false;">Preview</button>
               </div>
            </div>
         </div>
      </form>
   </div>
   @include("front.includes.cropper_model")
</div>
@endsection
@section('scripts')
@include("includes.include_quill_editor_js")
<script>
   var bs_modal = $('#modal');
   var image = document.getElementById('blah');
   var cropper,reader,file;
   
   function readBlogNewsURL_img(e) {
   
     var bs_modal = $('#modal');
     var image = document.getElementById('image');
     var cropper,reader,file;
     
     $("body").on("change", ".imageBlog", function(e) {
       var files = e.target.files;
       var done = function(url) {
         image.src = url;
         bs_modal.modal('show');
       };
   
       if (files && files.length > 0) {
         file = files[0];
         if (URL) {
           done(URL.createObjectURL(file));
         } else if (FileReader) {
           reader = new FileReader();
           reader.onload = function(e) {
             done(reader.result);
           };
           reader.readAsDataURL(file);
         }
       }
     });
   
     bs_modal.on('shown.bs.modal', function() {
       cropper = new Cropper(image, {
         // aspectRatio: 16/9,
         aspectRatio: 'NAN',
             viewMode: 1,
             dragMode: 'move',
             preview: '.preview',
            cropBoxResizable: true,
             
             crop(event) {
               // console.log(event.detail.x);
               // console.log(event.detail.y);
               // console.log(event.detail.width);
               // console.log(event.detail.height);
               // console.log(event.detail.rotate);
               // console.log(event.detail.scaleX);
               // console.log(event.detail.scaleY);
             },
           });
     }).on('hidden.bs.modal', function() {
       cropper.destroy();
       cropper = null;
     });
     
      $('#btnZoomIn').on('click', function () { cropper.zoom(0.1); })
      $('#btnZoomOut').on('click', function () { cropper.zoom(-0.1); })
      
     $("#crop").click(function() {
      $('.crop_laoder').show();
       canvas = cropper.getCroppedCanvas({
         width: 1013,
         height: 600,
       });
   
       canvas.toBlob(function(blob) {
         url = URL.createObjectURL(blob);
         var reader = new FileReader();
         reader.readAsDataURL(blob);
         reader.onloadend = function() {
           var base64data = reader.result;
   
           $.ajax({
             type: "POST",
             dataType: "json",
             url: "{{ route('front.user.blog.upload') }}",
             data: {image: base64data},
             success: function(data) {
                $('.crop_laoder').hide();
               bs_modal.modal('hide');
               $('#blah').attr('src',base64data);
               $('#crop_img').val(data.crop_img);
               $('#image_priview').val(data.crop_img);
             }
           });
         };
       });
     });
   }
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
       tinyMCE.triggerSave();
       $('#blg_status').val(1);
       var fd = new FormData($('#blog-form')[0]); 
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
                  $('.postLoading').show();
                  $('button').attr('disabled', true);
   
              },
              error: function (jqXHR, exception) {
               $('button').attr('disabled', false);
               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
               $('.postLoading').hide();
           },
           success: function (data) {
               $('button').attr('disabled', false);
               toastr.success("Blog Saved Successfully.");
               $('.postLoading').hide();
               window.location.replace('{{ route("front.user.blog.index")}}');
           }
       });
   });

   function blogs_Submit(e){
      $('button').attr('disabled',true);
      
      $('#blg_status').val(0);

       tinyMCE.triggerSave();
       var fd = new FormData($('#blog-form')[0]); 
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
                  $('.postLoading1').show();
                  $('button').attr('disabled', true);
   
              },
              error: function (jqXHR, exception) {
               $('button').attr('disabled', false);
               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
               $('.postLoading1').hide();
           },
           success: function (data) {
              if(data.status == 2){
               $('button').attr('disabled', false);
               toastr.warning("If you want to share your blog on feeds, then please publish your blog.");
               $('.postLoading1').hide();
              }else{
               $('button').attr('disabled', false);
               toastr.success("Blog Saved Successfully.");
               $('.postLoading1').hide();
               window.location.replace('{{ route("front.user.blog.index")}}');
              }
               
           }
       });
   }

   function blog_preview(e){
      // var url = "{{ url('user/blog/preview_detail/') }}";
      // var slug = "/test-blog-2";
      // window.open(url+slug, '_blank');
      // return false;
       tinyMCE.triggerSave();
       $('#blg_status').val(2);
       var fd = new FormData($('#blog-form')[0]); 
       $.ajax({
           url: "{{ route('front.user.blog.pre_preview_detail') }}",
           headers: {
              'X-CSRF-TOKEN': ajax_csrf_token_new
          },
               data: fd,// + '&ckeditor_description_new=' + ckeditor_description_new
               processData: false,
               contentType: false,
               dataType: 'json',
               type: 'POST',
               beforeSend: function () {
                //  $('.postLoading').show();
                  //$('button').attr('disabled', true);
   
              },
              error: function (jqXHR, exception) {
              // $('button').attr('disabled', false);
               var msg = formatErrorMessage(jqXHR, exception);
               toastr.error(msg)
               console.log(msg);
              // $('.postLoading').hide();
           },
           success: function (data) {
              // $('button').attr('disabled', false);
              $('#blog_preview_id').val(data.id);
               var url = "{{ url('user/blog/pre_view_detail/') }}";
               var slug = "/"+data.slug;
               window.open(url+slug, '_blank');
               // $('#DefaultModal .modal-content').html(data.view);
               // $('#DefaultModal').modal('show');
           }
       });
   }
   
   //  function readBlogNewsURL_img(e) {
   //     if ($("#blah").show(), e.files && e.files[0]) {
   //         var a = new FileReader;
   //         a.onload = function(e) {
   //             $("#blah").attr("src", e.target.result)
   //         }, a.readAsDataURL(e.files[0])
   //     }
   // }
</script>
@include('includes.include_tags_js')
@endsection