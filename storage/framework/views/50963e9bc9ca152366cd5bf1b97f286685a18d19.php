

<?php $__env->startSection('title'); ?> <?php echo e('Main List Paragraphs'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> Main List Paragraphs </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li class="active">Main List Paragraphs</li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="paragraphs-table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th><?php echo e(adminTransLang('status')); ?></th>
                                    <th><?php echo e(adminTransLang('action')); ?></th>
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
            $('#paragraphs-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route("admin.cms.main_list_paragraph.list")); ?>',
                columns : [
                    { "data": "type" },
					{ "data": "status" },                   
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="<?php echo e(route("admin.cms.main_list_paragraph.update")); ?>/'+row.id+'">\<i class="fa fa-edit fa-fw"></a>';
                        }, 
                        orderable: false
                    }
                ],
            order : [[2, 'desc']]
            });

        });
		 
    </script>
	
	<?php echo $__env->make('admin.users.user_admin_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>