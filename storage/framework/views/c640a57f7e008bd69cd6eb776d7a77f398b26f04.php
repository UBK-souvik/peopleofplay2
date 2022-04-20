
<?php $__env->startSection('title'); ?> Create Blog <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> Create Blog </h1>
   <ol class="breadcrumb">
      <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
      <li><a href="<?php echo e(route('admin.blog.index')); ?>"> All Blogs </a></li>
      <li class="active">Create Blog</li>
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
                  <input type="hidden" name="blog_id" value="<?php echo e(@$blog->id); ?>">
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" id="AddNewPost" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$blog->title); ?>">
                     </div>
                  </div>
                  <?php echo $__env->make('admin.includes.author_drop_down_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <select class="form-control" name="category_id">
                           <option value="">Select</option>
                           <?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($key); ?>" <?php echo e(isset($blog) && $blog->category_id == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Tags <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <?php echo $__env->make("admin.includes.admin_tags_drop_down", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        
                        <input name="discussionContent" type="hidden" value="<?php echo e(@$blog->description); ?>">
                        <input name="blog_description_hidden"  id="blog_description_hidden" type="hidden" value="<?php echo e(@$blog->description); ?>">
                        <!-- <div id="editor-container">
                           </div> -->
                        <?php echo $__env->make("includes.include_quill_editor", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Meta Title <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" id="AddMetaTitle"  class="form-control" name="meta_title" placeholder="Meta Title" value="<?php echo e(@$blog->meta_title); ?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Meta Description <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <textarea class="form-control" rows="4" id="MetaDescription" name="meta_description" placeholder="Meta Description"><?php echo e(@$blog->meta_description); ?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Meta Keyword <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" id="MetaKeyword" class="form-control" name="meta_keyword" placeholder="Meta Keyword" value="<?php echo e(@$blog->meta_keyword); ?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <img id="profile-blah-image" src="<?php echo e(@newsBlogImageBasePath(@$blog->featured_image)); ?>" alt="" class="imgHundred">
                        <input type="file" name="featured_image"  class="marginTopFive image" onchange="readURL(this);">
                        <input type="hidden" id="crop_img" name="crop_img">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                     <div class="col-sm-6">
                        <select class="form-control" name="status">
                        <?php $__currentLoopData = config('cms.blog_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key>0): ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(isset($blog) && $blog->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
                  <?php echo csrf_field(); ?>
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
   <?php echo $__env->make("admin.includes.cropper_model", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make("includes.include_quill_editor_js", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
  var bs_modal = $('#modal');
  var image = document.getElementById('blah');
  var cropper,reader,file;

  function readURL(e) {

   var bs_modal = $('#modal');
   var image = document.getElementById('image');
   var cropper,reader,file;
   

   $("body").on("change", ".image", function(e) {
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
      aspectRatio: 1,
            // viewMode: 3,
            crop(event) {
              console.log(event.detail.x);
              console.log(event.detail.y);
              console.log(event.detail.width);
              console.log(event.detail.height);
              console.log(event.detail.rotate);
              console.log(event.detail.scaleX);
              console.log(event.detail.scaleY);
            },
            preview: '.preview'
          });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#crop").click(function() {
    canvas = cropper.getCroppedCanvas({
      width: 160,
      height: 160,
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
          url: "<?php echo e(route('admin.blog.upload')); ?>",
          data: {image: base64data,"_token": "<?php echo e(csrf_token()); ?>"},
          success: function(data) {

            bs_modal.modal('hide');
            $('#profile-blah-image').attr('src',base64data);
            $('#crop_img').val(data.crop_img);
                        // html = '<img src="' + img + '" />';
                        //    $("#preview-crop-image").html(html);
                        // alert("success upload image");
                      }
                 });
      };
    });
  });
}
</script>
<script type="text/javascript">
   $( document ).ready(function() {
    
     <?php if(!empty($blog->description)): ?>
     <?php /*
      //var editor = document.getElementsByClassName('ql-editor');
      //editor[0].root.innerHTML = '{{@$blog->description}}';
      //quill.clipboard.dangerouslyPasteHTML(0, '{{@$blog->description}}'); */?>
     
     //Clear the existing contents
     quill.setText("");
     var sHTML = document.getElementById("blog_description_hidden").value.trim();
     quill.clipboard.dangerouslyPasteHTML(0, sHTML);
     
     <?php endif; ?>
       
       });
    
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
    $('#create-form #MetaDescription').val(str_new_description_data_new);
   });
   
   
   
   //CKEDITOR.replace( 'Comments' );
   /*
   CKEDITOR.replace('Comments', {
           filebrowserUploadUrl: '<?php echo e(URL::to("backend/plugins/ckeditor/ck_upload.php")); ?>',
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
   
   
   
   $('#create-form #AddNewPost').on('keyup change', function() {
       var str_new_post_data =  $('#create-form #AddNewPost').val();
    // do validation
    $('#create-form #AddMetaTitle').val(str_new_post_data);
   });
   
   $('body').on('keyup change','#create-form .tag-input',function(e){
    var str_new_keyword_data =  $('#create-form #Tag').val();
    var str_new_keyword_data_new =  str_new_keyword_data.split(",", 3);
    // do validation
    $('#create-form #MetaKeyword').val(str_new_keyword_data_new);
   });
   
   $('#create-form #Comments').on('keyup change', function() {
   
   });
   
   
   function frontend_get_quill_editor_description_new(str_element_id)
   {
   // Get content of a specific editor:
   return quill.getText();
   }  
   
   
       //admin_show_standard_ckeditor_new('description');
   
       // CKEDITOR.config.removeButtons = 'Underline,Subscript,Superscript';
   
       // CKEDITOR.replace('description', {
       //   removeButtons: '',
       //   // toolbar_Basic: 'Underline'
       // });
   
       $("#tag").tagsinput({
       });
   
       jQuery(function($) {
           $('.select2').select2()
   
           $(document).on('click','#createBtn',function(e){
               e.preventDefault();
              alert("yes"); 
              var fd = new FormData($('#create-form')[0]);  
              //var ckeditor_description_new = admin_get_ckeditor_description_new('description');
               //fd.append('ckeditor_description_new', ckeditor_description_new);     
        var editor_content = quill.container.innerHTML;
        fd.append('ckeditor_description_new', editor_content);
        
               $.ajax({
                   processData: false,
                   contentType: false,
                   data: fd,
                   dataType: 'json',
                   url: '<?php echo e(route("admin.blog.create")); ?>',
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
                           window.location.replace('<?php echo e(route("admin.blog.index")); ?>');
   
                       } else {
                           var message = formatErrorMessageFromJSON(data.errors);
                           $('.message_box').html(message).removeClass('hide');
                       }
                   }
               });
           });
       });
</script>
<?php echo $__env->make('includes.include_tags_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>