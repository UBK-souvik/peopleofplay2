<?php $__env->startSection('title'); ?> Create Header <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    .social_media .form-group {
         margin-right: 0px;
         margin-left: 0px;
    }
</style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Header</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.eventheader.index')); ?>"> Event Header </a></li>
            <li class="active">Create Header</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo e(@$event_header->id); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Header 1 <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="h1_tag" placeholder="" value="<?php echo e(@$event_header->h1_tag); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Header 2 <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="h2_tag" placeholder=""
                                             value="<?php echo e(@$event_header->h2_tag); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Header 3</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="h3_tag" placeholder="" value="<?php echo e(@$event_header->h3_tag); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button One Text</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_text" placeholder="" value="<?php echo e(@$event_header->button_text); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button Two Text</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_two_text" placeholder="" value="<?php echo e(@$event_header->button_two_text); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button Three Text</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_three_text" placeholder="" value="<?php echo e(@$event_header->button_three_text); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button One Link</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_one_link" placeholder="" value="<?php echo e(@$event_header->button_one_link); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button Two Link</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_two_link" placeholder="" value="<?php echo e(@$event_header->button_two_link); ?>">
                                            </div>
                                         </div>
                                        <div class="form-group">
                                            <label for="fun_fact1" class="col-sm-2 control-label">Button Three Link</label>
                                            <div class="col-sm-6">
                                               <input required type="text" class="form-control" name="button_three_link" placeholder="" value="<?php echo e(@$event_header->button_three_link); ?>">
                                            </div>
                                         </div>

                                    </div>
                                </div>

                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="row">
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
    // admin_show_standard_ckeditor_new('description');

    jQuery(function($) {
      $(document).on('click','#createBtn',function(e){

        // alert("ok");
            e.preventDefault();

            var fd = new FormData($('form')[0]);
            // var ckeditor_description_new = admin_get_ckeditor_description_new('description');
            // fd.append('description', ckeditor_description_new);

            // var error = '';
            // $( ".social" ).each(function( index ) {
            //     var str = $( this ).val();
            //     var name = $(this).attr('id');
            //     if(str != ''){
            //         console.log(name + validURL(str))
            //         if(validURL(str) == false){
            //             $('.message_box').html(name + ' URL is Invalid').removeClass('alert-success hide').addClass('alert-danger');
            //             error = 'yes';
            //             return false;
            //         }
            //     }
            // });
            // if(error != '' && error == 'yes'){
            //     return false;
            // }
            $.ajax({
                processData: false,
                contentType: false,
                url: "<?php echo e(route('admin.eventheader.create')); ?>",
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
                        // alert(data.msg);
                        window.location.replace('<?php echo e(route("admin.eventheader.index")); ?>');

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