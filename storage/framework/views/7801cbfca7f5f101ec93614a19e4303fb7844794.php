<?php $__env->startSection('title'); ?> All News Category <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> All News Category </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
                <li class="active">All News Category</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <p>
                <a href="<?php echo e(route('admin.news_category.create')); ?>" class="btn btn-success">Create News Category</a>
            </p>
            <div class="row">
                <div class="col-md-12">
				    <div class="box">
				        <div class="box-body">
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
					                </tr>
				                </thead>
				                <tbody>
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
<script type="text/javascript">
	$(function() {
        $('#navigation-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.news_category.list")); ?>',
            columns : [
	            { "data": "name" },
                { "data": "status" },
                {
                    "mRender": function (data, type, row)
                    {
                        return '<a href="<?php echo e(URL::to("admin/news-category/update")); ?>/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>\
                        <a class="delete_admins" href="<?php echo e(URL::to("admin/news-category/delete")); ?>/'+row.id+'">\
                            <i class="fa fa-trash fa-fw"></i>\
                        </a>';
                    },
                    orderable: false
                }
	        ],
            order : [[0, 'asc']]
        });

        $('#navigation-table').on('click', '.delete_admins', function(e){
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
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>