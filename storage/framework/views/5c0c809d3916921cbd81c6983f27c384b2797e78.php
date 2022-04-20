

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('all_settings')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> Expiring Customers </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li class="active">Expiring Customers</li>
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
                                    <th>Sr.No.</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Subscription End</th>
                                    <th>Stipe Customer</th>
                                    <th>Payment Id</th>
                                    <th>Plan Id</th>
                                    <th>Stripe Subscription</th>
                                    <th>Profle Created</th>
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
            ajax: '<?php echo e(route("admin.expiring_customers.list")); ?>',
            scrollX: 200,
            scroller: {
                loadingIndicator: true
            },
            columns : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            { "data": "user_id" },
	            {
                    "mRender": function (data, type, row) {
                        return row.userNames;
                    }, 
                    orderable: false    
                },
	            { "data": "email" },
	            { "data": "status" },
	            { "data": "ends_at" },
	            { "data": "stripe_id" },
	            { "data": "stripe_payment_id" },
	            { "data": "stripe_plan_id" },
	            { "data": "stripe_subscription_id" },
	            { "data": "user_created_date" },
	            
	        ],
        });
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>