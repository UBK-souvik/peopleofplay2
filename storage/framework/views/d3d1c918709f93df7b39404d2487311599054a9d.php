<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('all_role')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('all_role')); ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('all_role')); ?></li>
        </ol>
    </section>

    <section class="content">
        <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- <p>
            <a href="<?php echo e(route('admin.permission.create')); ?>" class="btn btn-success"><?php echo e(adminTransLang('create_role')); ?></a>
        </p> -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="role-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(adminTransLang('id')); ?></th>
                                    <th><?php echo e(adminTransLang('name')); ?></th>
                                    <th><?php echo e(adminTransLang('status')); ?></th>
                                    <th><?php echo e(adminTransLang('action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	$(function() {
        $('#role-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.permission.list")); ?>',
            columns : [
                { "data": "id"},
                { "data": "name"},
                { "data": "status" },
                {
                    "mRender": function (data, type, row) 
                    {
                        var html = '<a href="<?php echo e(URL::to("admin/permission/update")); ?>/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>';
                            html += '<a href="<?php echo e(URL::to("admin/permission/permission")); ?>/'+row.id+'">\
                                <i class="fa fa-lock fa-fw"></i>\
                            </a>';
                        return html;
                    }, orderable: false
                }
	        ],
            order : [[0, 'desc']]
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>