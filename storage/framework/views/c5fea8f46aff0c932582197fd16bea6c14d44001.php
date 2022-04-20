

<?php $__env->startSection('title'); ?> Create Did You Know <?php $__env->stopSection(); ?>

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
        <h1> Create Did You Know</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.news.index')); ?>"> All Did You Knows </a></li>
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
                        <input type="hidden" name="news_id" value="<?php echo e(@$news->id); ?>">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e(@$news->title); ?>">
                        </div>
                      </div>

                      <?php echo $__env->make('admin.includes.author_drop_down_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" multiple name="category_id[]">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $news_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
							  <option
                              value="<?php echo e($key); ?>"
                               <?php if(in_array($key, $arr_categories_pivot_id)): ?> <?php echo e('selected'); ?><?php endif; ?>><?php echo e($status); ?></option>
							  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tags <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input id="tag" type="text" data-role="tagsinput" name="tag[]" class="form-control other-tag-input-class" value="<?php if(!empty($news->tag)): ?><?php echo e(@$news->tag); ?><?php endif; ?>" placeholder="Tags">
						  <?php echo App\Helpers\UtilitiesTwo::getTagText(); ?>

						</div>
                      </div>


                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" id="description" name="description" placeholder="Description" value=""><?php echo e(@$news->description); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Title <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="<?php echo e(@$news->meta_title); ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Description <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <textarea class="form-control" name="meta_description" placeholder="Meta Description"><?php echo e(@$news->meta_description); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Meta Keyword <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" value="<?php echo e(@$news->meta_keyword); ?>">
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <input type="file" name="featured_image" >
                        </div>
                        <div class="col-sm-6">
                            <br>
                            <img src="<?php echo e(@imageBasePath($news->featured_image)); ?>" width="100" alt="">
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Featured Image <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                       <img src="<?php echo e(@imageBasePath($news->featured_image)); ?>" class="imgHundred" alt="">
                        <input type="file" name="featured_image" class="marginTopFive">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <?php $__currentLoopData = config('cms.blog_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key>0): ?>
								  <option value="<?php echo e($key); ?>" <?php echo e(isset($news) && $news->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
							    <?php endif; ?>	
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>
					  
					  
					            <!-- <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Is Home Page <i class="has-error"></i></label>
                        <div class="col-sm-6">
                            <input id="is_home_page" name="is_home_page" type="checkbox" value="1" <?php if(!empty($news->is_home_page)): ?><?php echo e('checked'); ?><?php endif; ?>>
                        </div>
                      </div> -->
					 
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
                url: '<?php echo e(route("admin.did-you-know.create")); ?>',
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
                        window.location.replace('<?php echo e(route("admin.did-you-know.index")); ?>');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>