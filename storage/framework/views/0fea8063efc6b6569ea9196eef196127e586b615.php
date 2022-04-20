

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('edit_admin')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo e(! $user = Auth::guard('admin')->user()); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('edit_admin')); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.admins.index')); ?>"> <?php echo e(adminTransLang('all_admins')); ?> </a></li>
            <li class="active"><?php echo e(adminTransLang('edit_admin')); ?></li>
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
                    <form class="form-horizontal" id="update-form">
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo e(adminTransLang('name')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="name" placeholder="<?php echo e(adminTransLang('name')); ?>" value="<?php echo e($admin->name); ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><?php echo e(adminTransLang('email')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="email" class="form-control" name="email" placeholder="<?php echo e(adminTransLang('email')); ?>" value="<?php echo e($admin->email); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="col-sm-2 control-label"><?php echo e(adminTransLang('mobile')); ?> <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="mobile" placeholder="<?php echo e(adminTransLang('mobile')); ?>" value="<?php echo e($admin->mobile); ?>">
                        </div>
                      </div>
                       <?php if($user->id != $admin->id): ?>
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <!-- <option value="">Select</option> -->
                              <?php $__currentLoopData = config('cms.user_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(($admin->status == $key) ? 'selected="selected"' : ''); ?>><?php echo e($status); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label"><?php echo e(adminTransLang('user_type')); ?> <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                            <select class="form-control" name="role_id">
                              <option value="">Select</option>
                              <?php if(count($roles)): ?>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($role->id); ?>" <?php echo e(($admin->role_id == $role->id) ? 'selected="selected"' : ''); ?>><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </select>
                        </div>
                      </div>
                      <?php endif; ?>
                      <div class="form-group">
                        <label for="locale" class="col-sm-2 control-label"><?php echo e(adminTransLang('locale')); ?> <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="locale">
                              <option value="">Select</option>
                              <?php $__currentLoopData = config('cms.user_locale'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"  <?php echo e(($admin->locale == $key) ? 'selected="selected"' : ''); ?>><?php echo e($locale); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo e(adminTransLang('profile_image')); ?></label>
                        <div class="col-sm-6">
                            <?php if($admin->profile_image): ?>
                            <img alt="" src="<?php echo e($admin->profile_image); ?>" width="60" height="60" style="float:left;"/>
                            <?php endif; ?>
                            <input type="file" name="profile_image">
                        </div>
                      </div>

                      <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">

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
        <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    jQuery(function($) {
       $(document).on('click','#updateBtn',function(e){
            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('admin.admins.update', ['id' => $admin->id])); ?>",
                data:new FormData($('form')[0]),
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#updateBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#updateBtn').attr('disabled',false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#updateBtn').attr('disabled',false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');

                    if('<?php echo e($admin->id); ?>' != 1) {
                        window.location.replace('<?php echo e(route("admin.admins.index")); ?>');
                    }
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>