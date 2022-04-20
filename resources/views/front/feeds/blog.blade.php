<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Feed {{ @$feedTitle }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body pb-0">

      <form id="feedForm" method="POST" class="PopFeedField" enctype="multipart/form-data">
       <input type="hidden" name="type" value="{{$view_type}}">
       @csrf
       <div class="First-column bg-white">
        <div class="row">
         <div class="col-lg-12 mb-3">
          <select name="type" class="form-control FeedFormSelected" onchange="changeType(this)">
            <option value="">Type of Post</option>
            @foreach($feed_type as $ftype)
            <option <?php if($id == $ftype->id){ echo 'selected'; } ?> value="{{$ftype->id}}">{{$ftype->type}}</option>
            @endforeach
          </select>
          <div class="text-center">
            <i class="fa fa-circle-o-notch fa-spin loadingType" style="display: none;"></i>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group text-center">
           <div id="file-upload-formsecond" class="uploadersecond">
            <div for="file-uploadsecond" id="file-dragsecond" class="galleryperview">
             <div id="div-image-gallery-preview-id">                
              <img class="gallery-upload-preview-class img-fluid" id="add-gallery-image-upload-preview-one" src="{{@galleryImageBasePath(@$str_media_data)}}"  alt="">
              <input type="hidden" name="image_name" class="imageName" value=""  id="crop_img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group h-100">
        <div class="div-image-upload-gallery-class h-100 w-100">
         <div class="UploadGallery d-table h-100">
          <div class="custom-file h-100 d-table-cell align-middle">
           <input type="file" class="custom-file__input image" id="file-gallery-uploadsecond-new" name="photo" onclick="return getFeedImagePreview(this);" accept="image/*" >
           <label class="custom-file__label" for="file-gallery-uploadsecond-new">Upload Image <i class="fa fa-spinner fa-spin loadingUpload" style="display: none;"></i></label>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
  <div class="form-group">
   <input id="AddNewPost" type="text" name="title" value="" class="form-control" placeholder="Title">
 </div>
</div>
<div class="col-md-12">
  <div class="form-group">
   <div>
    <select name="category_id" class="custom-select CategorySelecter" data-placeholder="Category">
     <option value>Select Category</option>
     @foreach ($blog_categories as $key => $value)
     <option value="{{$key}}" {{isset($blog) && $blog->category_id == $key ? 'selected' : ''}}>{{$value}}</option>
     @endforeach
   </select>
 </div>
</div>
</div>
<div class="col-md-12 paddingBottomTwenty">
 <div class="BlogDescription">
  <div class="form-group m-0">
   <textarea class="textBlog2" name="ckeditor_description_new"></textarea>
 </div>
</div>
</div>
</div>
</div>
<div class="mt-2">
 <div class="row">
  <div class="col-md-6">
    <div class="form-group">
     @include("front.includes.tags_drop_down")
   </div>
 </div>
 <div class="col-md-6">
  <div class="form-group">
   <div>
    <select name="products[]" class="custom-select select2" multiple data-placeholder="Tag Products">
     {{-- 
       <option value="">Select</option>
       --}}
       @foreach ($product_list as $product_index => $product_value)
       <option  value="{{$product_index}}">{{$product_value}}</option>
       @endforeach
     </select>
   </div>
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <div>
    <select name="peoples[]" class="custom-select select2" multiple data-placeholder="Tag People">
     {{-- 
       <option value="">Select</option>
       --}}
       @foreach ($people_list as $people_index => $people_value)
       <option value="{{$people_index}}">{{$people_value}}</option>
       @endforeach
     </select>
   </div>
 </div>
</div> 
<div class="col-md-6">
  <div class="form-group">
   <div>
    <select name="companies[]" class="custom-select select2" multiple data-placeholder="Tag Companies">
     {{-- 
       <option value="">Select</option>
       --}}
       @foreach ($company_list as $company_index => $company_value)
       <option value="{{$company_index}}">{{$company_value}}</option>
       @endforeach
     </select>
   </div>
 </div>
</div>

</div>
</div>
</div>
<div class="modal-footer border-top-0 d-flex justify-content-right pt-0">
 @csrf            
 <button type="submit" class="btn edit-btn-style" id="btnfeed">POST <i class="fa fa-circle-o-notch fa-spin postLoading" style="display: none;"></i></button>
</div>
</div>
</form>
</div>
</div>
</div>
<script>
 $('.select2').select2();

</script> 
@include('includes.include_tags_js')

<script language="javascript" type="text/javascript">


  var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

  tinymce.init({
    selector: 'textarea.textBlog2',
    media_dimensions: false,
    media_alt_source: false,
    media_poster: false,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | imageupload',
    toolbar_sticky: false,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'wrap',
    contextmenu: 'link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        // enable title field in the Image dialog
        image_title: true,
        automatic_uploads: true,
        images_upload_base_path: '/img/gallery/',
        images_upload_credentials: true,

        file_picker_types: 'image',
            // and here's our custom image picker






            setup: function (editor) {
              editor.on('ExecCommand', (event) => {
                const command = event.command;
                if (command === 'mceMedia') {
                  const tabElems = document.querySelectorAll('div[role="tablist"] .tox-tab');
                  tabElems.forEach(tabElem => {
                    if (tabElem.innerText === 'Embed') {
                      tabElem.style.display = 'none';
                    }
                  });
                }
              });
            },



            file_picker_callback: function(cb, value, meta) {
              var input = document.createElement('input');
              input.setAttribute('type', 'file');
              input.setAttribute('accept', 'image/*');
              input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                  var id = 'blobid' + (new Date()).getTime();
                  var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                  var base64 = reader.result.split(',')[1];
                  var blobInfo = blobCache.create(id, file, base64);
                  blobCache.add(blobInfo);
                  cb(blobInfo.blobUri(), { title: file.name });
                };
              };

              input.click();
            }


          });
        </script>

