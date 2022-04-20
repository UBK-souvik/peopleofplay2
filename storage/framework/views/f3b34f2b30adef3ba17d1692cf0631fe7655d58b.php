<?php $__env->startSection('title'); ?> Sidebar List Page <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> Sidebar List Page </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li class="active">Sidebar List Page</li>
        </ol>
    </section>
    <section class="content">
        <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Display Order</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
        $('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(URL('admin/cms/sidebar-page/list')); ?>",
            columns : [
	            { "data": "display_order" },
	            { "data": "title" },
	            { "data": "type" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="<?php echo e(URL::to("admin/cms/sidebar-page/update")); ?>/'+row.id+'" class="danger">\<i class="fa fa-edit fa-fw"></i>\</a>';
                    },
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>