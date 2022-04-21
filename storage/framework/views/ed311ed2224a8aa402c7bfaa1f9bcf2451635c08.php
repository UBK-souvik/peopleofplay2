<?php $__env->startSection('title'); ?> Section four header <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Section four header </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
                <li class="active">Section four header</li>
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
				            <table class="table table-striped table-bordered table-hover dataTable" id="navigation-table">
				                <thead>
					                <tr>
                                        <th>Header</th>
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
            ajax: '<?php echo e(route("admin.sectionfour.list")); ?>',
            columns : [
	            { "data": "profileHeader" },
                {
                    "mRender": function (data, type, row)
                    {
                        return '<a href="<?php echo e(URL::to("admin/sectionfour/update")); ?>/'+row.id+'">\
                            <i class="fa fa-edit fa-fw"></i>\
                        </a>\
                       ';
                    },
                    orderable: false
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

    var news_data_saved_flag = '<?php echo e(Session::has("news_data_saved_flag")); ?>';

        $(document).ready(function(){

        if(news_data_saved_flag!="")
         {
             $('#message-box-id').html('<?php echo e(adminTransLang("data_saved_successfully")); ?>').removeClass('hide alert-danger').addClass('alert-success');
             $("#message-box-id").fadeTo(4000, 500).slideUp(500, function(){
             $("#message-box-id").alert('close');
            });
         }
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>