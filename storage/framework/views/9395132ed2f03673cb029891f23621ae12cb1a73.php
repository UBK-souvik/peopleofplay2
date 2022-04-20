

<?php $__env->startSection('title'); ?> <?php echo e($page_type); ?> Featured News Feed <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php 
$arr_categories_pivot_id = array();
  if(!empty($news_categories_pivot))
  {
	 foreach($news_categories_pivot as $news_categories_pivot_val)					
	  {	
		$arr_categories_pivot_id[] = $news_categories_pivot_val['news_category_id'];								  
	  }  
  }								  							   
?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e($page_type); ?> Featured News Feed</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.news.index')); ?>"> All News </a></li>
            <li class="active"><?php echo e($page_type); ?> Featured News Feed</li>
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
                        <input type="hidden" name="news_feeds_id" value="<?php echo e(@$newsFeeds->id); ?>">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Heading" value="<?php echo e(@$newsFeeds->title); ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Caption <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" name="caption" placeholder="Caption"><?php echo e(@$newsFeeds->caption); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="category">
                          <option value="">--Select Category--</option>
                            <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option <?php if(@$newsFeeds->category_id == $category->id): ?><?php echo e('selected'); ?><?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">URL </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control url" name="url" placeholder="URL" value="<?php echo e(@$newsFeeds->url); ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Video URL </label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control video_url" name="video_url" placeholder="Video URL" value="<?php echo e(@$newsFeeds->video_url); ?>" oninput="getYoutubeThumbnailfeed(this);">
                        </div>
                        <div class="col-sm-1">
                          <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred" alt="" id="video_Image" style="display:none; width:40px !important; height:40px !important; ">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                        <?php if(@$newsFeeds->image): ?>
                          <img src="<?php echo e(asset('uploads/images/feed/'.@$newsFeeds->image)); ?>" class="imgHundred" alt="" id="blah">
                        <?php else: ?>
                          <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred" alt="" id="blah">
                        <?php endif; ?>
                        <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');" required>
                        </div>
                      </div>
					 
                      <?php echo csrf_field(); ?>

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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">

    jQuery(function($) {

    $('.select2').select2()

      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
			
			      var fd = new FormData($('#create-form')[0]);  
			
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                dataType: 'json',
                url: '<?php echo e(route("admin.news_feeds.featured_news.create")); ?>',
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
                    
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace("<?php echo e(route('admin.news_feeds.featured_news_feeds')); ?>");

                    } else {
                      $('#createBtn').attr('disabled',false);
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });

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

    function getYoutubeThumbnailfeed(e) {
      var youtube_url = $(e).val();
      $.ajax({
        url: "<?php echo e(route('admin.news_feeds.get_youtube_thumbnail')); ?>",
        data: {'_token':'<?php echo e(csrf_token()); ?>','video_url':youtube_url},
        dataType: 'json',
        type: 'POST',
        success: function (data) {
          if(data.success == 1){
            $('#video_Image').attr('src',data.thumbnail);
            $('#video_Image').show();
            $('.marginTopFive').hide();
            // $('.url').attr('disabled',true);
          } else {
            $('#add-gallery-image-upload-preview-onevideo').attr('src','');
            $('#video_Image').hide();
            $('.marginTopFive').show();
            // $('.url').removeAttr('disabled');
            toastr.error(data.msg);
          }
        }
      });
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>