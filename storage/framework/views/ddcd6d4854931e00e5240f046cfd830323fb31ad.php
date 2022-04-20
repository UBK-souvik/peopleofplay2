

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('transactions')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('transactions')); ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('transactions')); ?></li>
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
                        <table class="table table-striped table-bordered table-hover dataTable" id="users-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(adminTransLang('name')); ?></th>
                                    <th><?php echo e(adminTransLang('email')); ?></th>
                                    <th><?php echo e(adminTransLang('status')); ?></th>
                                    <th>Customer ID</th>
                                    <th>Subscription ID</th>
                                    <th>Price</th>
                                    <th><?php echo e(adminTransLang('end_at')); ?></th>
                                    <!-- <th><?php echo e(adminTransLang('status')); ?></th> -->
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
            $('#users-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route("admin.transactions.list")); ?>',
                columns : [
                    { "data": "name" },
                    { "data": "email" },
                    {
                        "mRender": function (data, type, row) 
                        {
                            if(row.gold == 1){
                                return 'Gold';
                            } else if(row.gold == 0){
                                return '<a class="delete_admins btn btn-primary" href="<?php echo e(URL::to("admin/user/subscription/refund")); ?>/'+row.id+'">Refund</a><a class="delete_admins btn btn-danger" href="<?php echo e(URL::to("admin/user/subscription/cancel")); ?>/'+row.id+'">Cancel</a>';
                            } else if(row.gold == 2){
                                return 'Canceled';
                            } else if(row.gold == 3){
                                return 'Refunded';
                            }
                        }, 
                        orderable: false
                    },
                    { "data": "stripe_id" },
                    { "data": "stripe_subscription_id" },
                    { "data": "price" },
                    {
                        "data": "ends_at",
                        "mRender": function (data, type, row) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    // { "data": "status" },
                ],
            order : [[0, 'desc']]
            });

            $('#users-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("<?php echo e(adminTransLang('are_you_sure_to_delete')); ?>")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#message-box-id').html('Subscription updated Successfully').removeClass('hide alert-danger').addClass('alert-success');
             
                        $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
                             $("#message-box-id").alert('close');
                        });
                        $('#users-table').DataTable().ajax.reload();
                    });
                }
            });
        });
		
		var user_data_saved_flag = '<?php echo e(Session::has("user_data_saved_flag")); ?>';

        $(document).ready(function(){
			
		if(user_data_saved_flag!="")
		 {
			 //toastr.success("Gallery Saved Successfully.");
			 //$('#message-box-id').show();
			 //$('#message-box-id').attr('style', 'display:block');
			 //$('#message-box-id').css('display', 'block');
		     $('#message-box-id').html('<?php echo e(adminTransLang("data_saved_successfully")); ?>').removeClass('hide alert-danger').addClass('alert-success');
			 
             $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
	         $("#message-box-id").alert('close');
            }); 			 
		 }
		}); 
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>