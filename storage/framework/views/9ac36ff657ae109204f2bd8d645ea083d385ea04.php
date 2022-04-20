

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('edit_setting')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1> Edit Pub Heading</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li><a href="<?php echo e(route('admin.pub_heading.index')); ?>"> <?php echo e(adminTransLang('all_settings')); ?> </a></li>
            <li class="active">Edit Pub Heading</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Heading</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="heading" placeholder="Heading" value="<?php echo e($setting->heading); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Message 1</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="description" placeholder="Description"><?php echo e($setting->description); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Message 2</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="description_2" placeholder="Description 2"><?php echo e($setting->description_2); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn"><?php echo e(adminTransLang('update')); ?></button>
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
      $(document).on('click','#updateBtn',function(e){
            e.preventDefault();
            
            $.ajax({
                url: "<?php echo e(route('admin.pub_heading.update', ['id' => $setting->id])); ?>",
                data: $('form').serialize(),
                dataType: 'json',
                type: 'POST',
                beforeSend: function() {
                    $('#updateBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception) {
                    $('#updateBtn').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#updateBtn').attr('disabled',false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.replace('<?php echo e(route("admin.pub_heading.index")); ?>');
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>