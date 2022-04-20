

<?php $__env->startSection('title'); ?> Menu Page <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> Menu Page </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li class="active">Menu Page</li>
        </ol>
    </section>
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php $type = (isset($_GET['type'])) ? $_GET['type'] : '1'; ?>
                    <select class="form-control" name="select_type" id="select_type">
                            <option value="0">Select Type</option>
                        <?php $__currentLoopData = config('cms.drop_down_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k); ?>" <?php echo e(($k == $type) ? 'selected' : ''); ?>><?php echo e(ucfirst($val)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
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
                                    <th>Menu Type</th>
									<th>Category</th>
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
        var type = $("#select_type").val();
        // alert(type);
        $('#settings-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(URL('admin/cms/main-list-page/list')); ?>?type="+type,
            columns : [
	            { "data": "display_order" },
	            { "data": "title" },
	            { "data": "type" },
				{ "data": "category_id" },
	            { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="<?php echo e(URL::to("admin/cms/main-list-page/update")); ?>/'+row.id+'" class="danger">\<i class="fa fa-edit fa-fw"></i>\</a>';
                    },
                    searchable: false,
                    orderable: false
                }
	        ]
        });
    });

    $('#select_type').change(function(){
        var type = $(this).val();
        window.location.replace("<?php echo e(URL('admin/cms/main-list-page')); ?>?type="+type);
        $('#settings-table').DataTable().clear().destroy();
        $('#settings-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(url('admin/cms/main-list-page/list/')); ?>?type="+type,
            columns : [
                { "data": "display_order" },
                { "data": "title" },
                { "data": "type" },
                { "data": "status" },
                {
                    "mRender": function (data, type, row) {
                        return '<a href="<?php echo e(URL::to("admin/cms/main-list-page/update")); ?>/'+row.id+'" class="danger">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>';
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