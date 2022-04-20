

<?php $__env->startSection('title'); ?> Bloom Reports <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <style>
      #exTab2 li.active {
        color : white;
        background-color: #367fa9;
        padding : 5px 4px 1px 5px;
      }
    </style>

    <section class="content-header">
        <h1> Bloom Reports</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="#"> All Bloom Reports </a></li>
            <li class="active">Bloom Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-md-12">
            <div class="box">              
                <div id="exTab2" class="container">	
                  <ul class="nav nav-tabs">
                    <li class=" <?php if(@$request_type == 'welcome'): ?><?php echo e('active'); ?> <?php endif; ?>"><a href="#welcome_id" data-toggle="tab">Welcome Section</a></li>
                    <li class=" <?php if(@$request_type == 'person'): ?><?php echo e('active'); ?> <?php endif; ?>"><a href="#person_id" data-toggle="tab">Person Section</a></li>
                    <li class=" <?php if(@$request_type == 'news'): ?><?php echo e('active'); ?> <?php endif; ?>"><a href="#news_id" data-toggle="tab">News Section</a></li>
                  </ul>
        
                  <div class="tab-content ">
                    <!-- Welcome Section Start -->
                    <div class="tab-pane <?php if(@$request_type == 'welcome'): ?><?php echo e('active'); ?> <?php endif; ?>" id="welcome_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Welcome Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo e(@$welcome_section->id); ?>">
                            <input type="hidden" name="section_type" value="welcome">

                            <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="heading" placeholder="Heading" value="<?php echo e(@$welcome_section->title); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Sub-Heading </label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="sub_heading" placeholder="Sub-Heading" value="<?php echo e(@$welcome_section->sub_heading); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="description" placeholder="Description"><?php echo e(@$welcome_section->caption); ?></textarea>
                            </div>
                          </div>    

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="<?php echo e(@$welcome_section->date); ?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Featured Block </label>
                            <div class="col-sm-6">
                              <select class="form-control featured_block" name="featured_block">
                                <option <?php if(@$welcome_section->is_featured == 0): ?><?php echo e('selected'); ?> <?php endif; ?> value="0">No</option>
                                <option <?php if(@$welcome_section->is_featured == 1): ?><?php echo e('selected'); ?> <?php endif; ?> value="1">Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image </label>
                            <div class="col-sm-6">
                            <?php if(@$welcome_section->image): ?>
                              <img src="<?php echo e(asset('uploads/images/bloom_reports/'.@$welcome_section->image)); ?>" class="imgHundred" alt="" id="blah">
                              <input type="hidden" name="is_image" value="@$welcome_section->image">
                            <?php else: ?>
                              <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred" alt="" id="blah">
                            <?php endif; ?>
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');">
                            </div>
                          </div>  
              
                          <?php echo csrf_field(); ?>

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Welcome Section End -->

                    <!-- Person Section Start -->
                    <div class="tab-pane <?php if(@$request_type == 'person'): ?><?php echo e('active'); ?> <?php endif; ?>" id="person_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>Person Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo e(@$person_section->id); ?>">
                            <input type="hidden" name="section_type" value="person">

                            <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="heading" placeholder="Heading" value="<?php echo e(@$person_section->title); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Sub-Heading </label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="sub_heading" placeholder="Sub-Heading" value="<?php echo e(@$person_section->sub_heading); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="description" placeholder="Description"><?php echo e(@$person_section->caption); ?></textarea>
                            </div>
                          </div>    

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="<?php echo e(@$person_section->date); ?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Featured Block </label>
                            <div class="col-sm-6">
                              <select class="form-control featured_block" name="featured_block">
                                <option <?php if(@$person_section->is_featured == 0): ?><?php echo e('selected'); ?> <?php endif; ?> value="0">No</option>
                                <option <?php if(@$person_section->is_featured == 1): ?><?php echo e('selected'); ?> <?php endif; ?> value="1">Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image </label>
                            <div class="col-sm-6">
                            <?php if(@$person_section->image): ?>
                              <img src="<?php echo e(asset('uploads/images/bloom_reports/'.@$person_section->image)); ?>" class="imgHundred" alt="" id="blah2">
                              <input type="hidden" name="is_image" value="@$person_section->image">
                            <?php else: ?>
                              <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred" alt="" id="blah2">
                            <?php endif; ?>
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah2');">
                            </div>
                          </div>  
              
                          <?php echo csrf_field(); ?>
              
                          <?php echo csrf_field(); ?>

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Person Section End -->

                    <!-- News Section Start -->
                    <div class="tab-pane <?php if(@$request_type == 'news'): ?><?php echo e('active'); ?> <?php endif; ?>" id="news_id">
                      <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <h3>News Section</h3>
                        <form class="form-horizontal" onsubmit="submit_bloom_reports(this); return false;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo e(@$news_section->id); ?>">
                            <input type="hidden" name="section_type" value="news">

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$news_section->title); ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">URL <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control url" name="url" placeholder="URL" value="<?php echo e(@$news_section->url); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <select class="form-control category_id" name="category">
                              <option value="">--Select Category--</option>
                                <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option <?php if(@$news_section->category_id == $category->id): ?><?php echo e('selected'); ?><?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Caption </label>
                            <div class="col-sm-6">
                              <textarea class="form-control textBlog" name="caption" placeholder="Caption"><?php echo e(@$news_section->caption); ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="check_image" class="col-sm-2 control-label">Date <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="datepicker form-control" name="date" placeholder="yyyy-mm-dd" value="<?php echo e(@$news_section->date); ?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Submitted By <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="submitted_by" placeholder="Submitted By" value="<?php echo e(@$news_section->submitted_by); ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Video URL </label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control video_url" name="video_url" placeholder="Video URL" value="<?php echo e(@$news_section->video_url); ?>" oninput="getYoutubeThumbnailfeed('video_url');">
                            </div>
                            <div class="col-sm-1">
                              <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred" alt="" id="video_Image" style="display:none; width:40px !important; height:40px !important; ">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6">
                            <?php if(@$news_section->image): ?>
                              <img src="<?php echo e(asset('uploads/images/feed/'.@$news_section->image)); ?>" class="imgHundred news_image" alt="" id="blah3">
                              <input type="hidden" name="is_image" value="<?php echo e(@$news_section->image); ?>">
                            <?php else: ?>
                              <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred news_image" alt="" id="blah3">
                            <?php endif; ?>
                            <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah3');">
                            </div>
                          </div>
              
                          <?php echo csrf_field(); ?>

                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                              <button type="submit" class="btn btn-success" id="createBtn">Post to news feeds</button>
                              <span class="ml-3 mt-3"><input type="checkbox" name="add_to_feeds" value="on"> &nbsp;Add to home feeds.</span>
                              <span class="ml-3 mt-3"><input type="checkbox" name="add_to_news_feeds" value="on"> &nbsp;Add to news feeds.</span>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- News Section End -->
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

  
  var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  tinymce.init({
    selector: 'textarea.textBlog',
    media_dimensions: false,
    media_alt_source: false,
    media_poster: false,
    paste_block_drop: false, 
    plugins: 'contextmenu print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',

    imagetools_cors_hosts: ['picsum.photos'],
    menubar: '',
    toolbar: 'undo redo | bold italic underline strikethrough cut copy paste',
    toolbar_sticky: false,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic underline strikethrough | cut copy paste | quicklink blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'wrap',
    contextmenu: 'cut copy paste | bold italic underline strikethrough | link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    image_title: true,
    automatic_uploads: true,
    images_upload_url: '<?php echo e(url("/tinyimage/upload")); ?>',
    images_upload_credentials: true,
    relative_urls: false,
    remove_script_host: false,
    file_picker_types: 'image',
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

    $(document).ready(function(){
      getYoutubeThumbnailfeed('video_url');
    });

    jQuery(function($) {

      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd', 
        todayHighlight: true,
        autoclose: true,
        endDate: 'now',
        showButtonPanel: true,
      });

      setTimeout(function(){      
        var text_2 = $(".category_id option:selected").text();
        if(text_2.search("RIP") >= 0){
          $('.rip_categorys').show();
        }
      },300);

    });

    function submit_bloom_reports(e){
      tinyMCE.triggerSave();
      var fd = new FormData($(e)[0]);  			
      $.ajax({
          processData: false,
          contentType: false,
          data: fd,
          dataType: 'json',
          url: '<?php echo e(route("admin.bloom_reports.submit")); ?>',
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
                  window.location.replace("<?php echo e(route('admin.bloom_reports.index')); ?>");

              } else {
                  var message = formatErrorMessageFromJSON(data.errors);
                  $('.message_box').html(message).removeClass('hide');
              }

          }
      });
    }

    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+id)
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function getYoutubeThumbnailfeed(cls) {
      var youtube_url = $('.'+cls).val();
      if(youtube_url != ''){
        $.ajax({
          url: "<?php echo e(route('admin.news_feeds.get_youtube_thumbnail')); ?>",
          data: {'_token':'<?php echo e(csrf_token()); ?>','video_url':youtube_url},
          dataType: 'json',
          type: 'POST',
          success: function (data) {
            if(data.success == 1){
              $('.news_image').attr('src',data.thumbnail);
              $('.marginTopFive').hide();
              // $('.imgHundred').hide();
              // $('#video_Image').show();
            } else {
              $('#add-gallery-image-upload-preview-onevideo').attr('src','');
              $('.marginTopFive').show();
              // $('.imgHundred').show();
              // $('#video_Image').hide();
              $('.news_image').attr('src',"<?php echo e(asset('front/new/images/Product/team_new.png')); ?>");
              toastr.error(data.msg);
            }
          }
        });
      }
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>