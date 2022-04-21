<?php $__env->startSection('title'); ?> Description <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Header (Page header) -->
        <section class="content-header">
            
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
                <li class="active">Create Description</li>
            </ol>
        </section>
        <p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <p>
                <a href="<?php echo e(route('admin.eventdescription.create')); ?>" class="btn btn-success">Create Description</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="">
				                <thead>
					                <tr>
                                        <th>Description Header</th>
                                        <th>Description</th>
                                        <th>Button Text</th>
                                        <th>Action</th>
					                </tr>
				                </thead>
				                <tbody>
                                     <?php foreach ($eventDescription as $key => $event) { ?>
                                        <tr>
                                          <td><?php echo e($event->description_header); ?></td>
                                          <td><?php echo html_entity_decode($event->description_details); ?></td>
                                          <td><?php echo e($event->button_text); ?></td>

                                          <td><a href="<?php echo e(URL::to("admin/eventdescription/update")); ?>/<?php echo e($event->id); ?>">
                                            <i class="fa fa-edit fa-fw"></i>
                                            <a class="delete_admins" href="<?php echo e(URL::to("admin/eventdescription/delete")); ?>/<?php echo e($event->id); ?>">
                                                <i class="fa fa-trash fa-fw"></i>
                                                </a></td>


                                        </tr>
                                     <?php } ?>

				                </tbody>
				            </table>
				        </div>
				    </div>
				    <!-- /.box -->
				</div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
     $('#navigation-table').on('click', '.delete_admins', function(e){
         alert("ok");
            e.preventDefault();
            var r = confirm("<?php echo e(adminTransLang('are_you_sure_to_delete')); ?>");
            if (r == false) {
                return false;
            }
            var href = $(this).attr('href');
            $.get( href, function( data ) {
                $('#navigation-table').DataTable().ajax.reload();
            });
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>