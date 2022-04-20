

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('all_settings')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> Feeds Reports </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?> </a></li>
            <li class="active">Feeds Reports</li>
        </ol>
    </section>

    <section class="content">
        <p>
            <a href="<?php echo e(route('admin.bloom_reports.create')); ?>" class="btn btn-success">Add Bloom Report</a>
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="settings-table">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Title</th>
                                    <th>Type</th>
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
            ajax: '<?php echo e(route("admin.bloom_reports.list")); ?>',
            type: 'get',
            scrollX: 200,
            scroller: {
                loadingIndicator: true
            },
            columns : [
                {data: 'DT_RowIndex', name: 'id'},
	            { "data": "title" },
	            { "data": "section_type" },
	            {
                    "mRender": function (data, type, row){
                        return '<a href="<?php echo e(url("admin/bloom_reports_test_create")); ?>?type='+row.section_type+'&id='+row.id+'"><i class="fa fa-edit fa-fw"></i></a>\
                            <a class="delete_admins" href="javascript:void(0)" onclick="delete_report(this,'+row.id+'); return false;"><i class="fa fa-trash fa-fw"></i></a>';
                    }, 
                    orderable: false
                },
	        ],
            order : [[0, 'asc']]
        });
    });

    // function reportView(e,id){
    //     $.ajax({
    //         url: "",
    //         data: {id:id},
    //         dataType: 'json',
    //         type: 'GET',
    //         success: function (data) {
    //             if(data.status == 1){
    //                 $('#remote_model .modal-content').html(data.view);
    //                 $('#remote_model').modal('show');
    //             }  
    //         }
    //     });
    // }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>