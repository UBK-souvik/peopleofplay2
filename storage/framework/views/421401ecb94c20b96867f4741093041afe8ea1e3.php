      

<?php $__env->startSection('title'); ?> Create Event <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
</style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Event</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.event.index')); ?>"> All Events </a></li>
            <li class="active">Create Event</li>
        </ol>
    </section>

    <!-- Main content -->
    <!--     
    <section class="content">
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                        <input type="hidden" name="event_id" value="<?php echo e(@$event->id); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">User<i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <select class="form-control select2" name="user_id">
                                  <option value="">Choose</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"
                                     <?php echo e(isset($event) && $event->user_id == $id ? 'selected' : ''); ?>>
                                        <?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Event Id <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="event_id_number"
                              readonly
                              placeholder="Event Id" value="<?php echo e(@$event->event_id_number ?? generateRandomString()); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo e(@$event->name); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Website <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="website" placeholder="Website"
                             value="<?php echo e(@$event->website); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="description" rows="4"><?php echo e(@$event->description); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="main_image" class="col-sm-2 control-label">Main Image <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <input type="file" name="main_image">
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="fun_fact1" class="col-sm-2 control-label">Fun Fact 1</label>
                          <div class="col-sm-6">
                             <input required type="text" class="form-control" name="fun_fact1" placeholder="Fun Fact 1" value="<?php if(!empty(@$event->fun_fact1)): ?><?php echo e(@$event->fun_fact1); ?><?php endif; ?>">
                          </div>
                       </div>
                       <div class="form-group">
                          <label for="fun_fact2" class="col-sm-2 control-label">Fun Fact 2</label>
                          <div class="col-sm-6">
                             <input required type="text" class="form-control" name="fun_fact2" placeholder="Fun Fact 2" value="<?php if(!empty(@$event->fun_fact2)): ?><?php echo e(@$event->fun_fact2); ?><?php endif; ?>">
                          </div>
                       </div>
                       <div class="form-group">
                          <label for="fun_fact3" class="col-sm-2 control-label">Fun Fact 3</label>
                          <div class="col-sm-6">
                             <input required type="text" class="form-control" name="fun_fact3" placeholder="Fun Fact 3" value="<?php if(!empty(@$event->fun_fact3)): ?><?php echo e(@$event->fun_fact3); ?><?php endif; ?>">
                          </div>
                       </div>

                        <div class="col-md-12">
                            <div class="row social_media">
                                <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $str_social_val = '';
                                        if(!empty(@$event->socialMedia))
                                        {     
                                            $str_social_val = @$event->socialMedia->pluck('value','type')->toArray()[$index];
                                        }
                                    ?> 
                                        <div class="col-md-3" >
                                            <div class="form-group">
                                                <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                                                <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                                 value="<?php echo e($str_social_val); ?>" class="form-control">
                                            </div>
                                        </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
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
    </section> -->

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                                <input type="hidden" name="event_id" value="<?php echo e(@$event->id); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">User<i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                              <select class="form-control select2" name="user_id">
                                                  <option value="">Choose</option>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($name->id); ?>" <?php echo e(isset($event) && $event->user_id == $name->id ? 'selected' : ''); ?>><?php echo e(@$name->text); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Event Id <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="event_id_number"
                                              readonly
                                              placeholder="Event Id" value="<?php echo e(@$event->event_id_number ?? generateRandomString()); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo e(@$event->name); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Website <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control" name="website" placeholder="Website"
                                             value="<?php echo e(@$event->website); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Description <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="description" name="description" rows="4"><?php echo e(@$event->description); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="main_image" class="col-sm-2 control-label">Main Image <i class="has-error">*</i></label>
                                            <div class="col-sm-6">
                                                <input type="file" name="main_image">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="fun_fact1" class="col-sm-2 control-label">Fun Fact 1</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="fun_fact1" placeholder="Fun Fact 1" value="<?php if(!empty(@$event->fun_fact1)): ?><?php echo e(@$event->fun_fact1); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact2" class="col-sm-2 control-label">Fun Fact 2</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="fun_fact2" placeholder="Fun Fact 2" value="<?php if(!empty(@$event->fun_fact2)): ?><?php echo e(@$event->fun_fact2); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="fun_fact3" class="col-sm-2 control-label">Fun Fact 3</label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="fun_fact3" placeholder="Fun Fact 3" value="<?php if(!empty(@$event->fun_fact3)): ?><?php echo e(@$event->fun_fact3); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                    </div>
                                  
                                    <div class="accordion__header">
                                        <h2>Social Media</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body">
                                        <div class="row social_media">
                                            <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $str_social_val = '';
                                                    if(!empty(@$event->socialMedia))
                                                    {     
                                                        $str_social_val = @$event->socialMedia->pluck('value','type')->toArray()[$index];
                                                    }
                                                ?> 
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                                                            <input type="url" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                                             value="<?php echo e($str_social_val); ?>" class="social form-control">
                                                        </div>
                                                    </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    admin_show_standard_ckeditor_new('description');

    jQuery(function($) {
    $('.select2').select2()
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();

            var fd = new FormData($('form')[0]);  
            var ckeditor_description_new = admin_get_ckeditor_description_new('description');
            fd.append('description', ckeditor_description_new);

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
                url: "<?php echo e(route('admin.event.create')); ?>",
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
                        window.location.replace('<?php echo e(route("admin.event.index")); ?>');

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