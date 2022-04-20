

<?php $__env->startSection('title'); ?> Create Cast <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.cast.index')); ?>"> All Cast </a></li>
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
                        <input type="hidden" name="id" value="<?php echo e(@$data->id); ?>">

                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$data->title); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="category_id" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <?php //echo "<pre>"; print_r($categories); die ?>
                        <select class="form-control" id="category_id" name="category_id">
                           <option value="">-- Select Category --</option> 
                           <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php if($category->id== @$data->category_id){ echo 'selected'; } ?>> <?php echo e($category->name); ?> </option> 
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">URL <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="url" placeholder="url" value="<?php echo e(@$data->url); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                             <label for="check_image" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                             <div class="col-sm-6">
                              <img id="blah" src="<?php echo e(@imageBasePath(@$data->featured_image)); ?>" alt="" class="imgHundred">
                              <input type="file" name="featured_image" class="marginTopFive image" onchange="readURL(this);">
                              <input type="hidden" name="image" id="check_image" value="<?php if(isset($data->featured_image) && !empty($data->featured_image)) { echo 1; } ?> ">
                            </div>
                            </div>
                       <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description" placeholder="Description"><?php echo e(@$data->description); ?></textarea>
                         
                        </div>
                      </div>
                      <input type="hidden" name="type" value="cast">
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(isset($data) && $data->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="news_feeds_category" class="col-sm-2 control-label">News Categories <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="news_feeds_category">
                            <option value="">--Select News Feeds Categories--</option>
                            <?php $__currentLoopData = @$feeds_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feeds_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($feeds_category->id); ?>" ><?php echo e($feeds_category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>

                      <?php echo csrf_field(); ?>

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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

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
                url: "<?php echo e(route('admin.cast.create')); ?>",
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
                        window.location.replace('<?php echo e(route("admin.cast.index")); ?>');

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>