

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('edit_setting')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1> Edit Pub Heading</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li><a href="<?php echo e(route('admin.pub_heading.pub_meeting')); ?>"> <?php echo e(adminTransLang('all_settings')); ?> </a></li>
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
                                <label for="label" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="heading" placeholder="Heading" value="<?php echo e(@$setting->heading); ?>">
                                    <input type="hidden" name="id" value="<?php echo e(@$setting->id); ?>">
                                    <input type="hidden" name="type" value="<?php if(!empty(@$setting->type)): ?><?php echo e(@$setting->type); ?><?php else: ?><?php echo e(@$type); ?><?php endif; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Meeting URL <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="url" placeholder="Meeting URL" value="<?php echo e(@$setting->url); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Status <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <select name="status" class="form-control" id="">
                                        <option <?php if(@$setting->status == '1'): ?><?php echo e('selected'); ?><?php endif; ?> value="1">Active</option>
                                        <option <?php if(@$setting->status == '0'): ?><?php echo e('selected'); ?><?php endif; ?> value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Add Image <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <?php if(@$setting->image): ?>
                                    <img src="<?php echo e(asset('uploads/images/pub/'.@$setting->image)); ?>" class="imgHundred news_image" alt="" id="blah">
                                    <input type="hidden" name="is_image" value="<?php echo e(@$setting->image); ?>">
                                    <?php else: ?>
                                    <img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="imgHundred news_image" alt="" id="blah">
                                    <?php endif; ?>
                                    <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn">Save</button>
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
            var fd = new FormData($('form')[0]); 
            $.ajax({
                url: "<?php echo e(route('admin.pub_heading.save_meeting', ['id' => @$setting->id])); ?>",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
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
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('<?php echo e(route("admin.pub_heading.pub_meeting")); ?>');

                    } else {
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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>