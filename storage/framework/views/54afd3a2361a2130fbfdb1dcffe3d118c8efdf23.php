

<?php $__env->startSection('title'); ?> All Columnists <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Columnists Blog </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
                <li class="active">All  Columnists Blog</li>
            </ol>
        </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
        <!-- Main content -->
        <section class="content">
            <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                             <form id="columnlistForm" onsubmit="columnistsSave(); return false;">
                                  <?php echo csrf_field(); ?>
                            <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control select2" name="user_id">
                                        <option value="">-- Select User --</option>
                                        <?php if(isset($users) && !empty($users)): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($uRow->id); ?>"> <?php echo e($uRow->first_name.' '.$uRow->last_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
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
            ajax: '<?php echo e(route("admin.blog_columnists.list")); ?>',
            columns : [
                { "data": "first_name" },
                { "data": "last_name" },
	            {
                    "mRender": function (data, type, row)
                    {
                        return '<a class="delete_admins" href="<?php echo e(URL::to("admin/blog_columnists/delete")); ?>/'+row.id+'">\<i class="fa fa-trash fa-fw"></i>\</a>';
                    }, orderable: false
                }
	        ],
            order : [[0, 'desc']]
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


    function columnistsSave() {
         // $('#btnfeed').attr('disabled',true);
         var fd = new FormData($('#columnlistForm')[0]);
         $.ajax({
                    url: "<?php echo e(route('admin.blog_columnists.create')); ?>",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        // $('#btnfeed').attr('disabled',true);
                        // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){

                        var msg = formatErrorMessage(jqXHR, exception);
                        toastr.error(msg)
                        console.log(msg);
                       
                    },
                    success: function (data)
                    {
                        toastr.success(data.message);
                          location.reload();

                    }
                });
    }
	
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>