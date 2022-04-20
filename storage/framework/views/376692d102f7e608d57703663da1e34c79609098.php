

<?php $__env->startSection('title'); ?> All Newsletters <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> All Newsletters </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li class="active"> All Newsletters </li>
        </ol>
    </section>
        <p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php $type = (isset($_GET['type'])) ? $_GET['type'] : '0'; ?>
                    <select class="form-control" name="select_type" id="select_type">
                            <option value="0">Select Newsletter Type</option>
                        <?php $__currentLoopData = config('cms.newsletter_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k); ?>" <?php echo e(($k == $type) ? 'selected' : ''); ?>><?php echo e(ucfirst($val)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <span data-href="<?php echo e(route('export_excel.excel')); ?>" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span>
                </div>
            </div>
        </div>
    </section>
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
                                    <th>Role</th>
                                    <th>NewsLetter Type</th>
                                    <th>Country</th>
                                    <th>Zip Code</th>
                                    <th><?php echo e(adminTransLang('registered_on')); ?></th>
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
        $('#users-table').DataTable({
			"pageLength": 50,
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("admin.newsletter.list")); ?>?type='+type,
            columns : [
                { "data": "name" },
                { "data": "email" },
                { "data": "type" },
                { "data": "type_of_user" },
                { "data": "country_id"},
                { "data": "zip_code" },
                {
                     "data": "created_at",
                     "mRender": function (data, type, row) {
                         return moment(data).format('YYYY-MM-DD hh:mm A');
                     }
                }
            ],
        order : [[2, 'desc']]
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

<script type="text/javascript">
    $('#select_type').change(function(){
        var type = $(this).val();
        window.location.replace("<?php echo e(route('admin.newsletter.index')); ?>?type="+type);
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

<script>
   function exportTasks(_this) {
        var type = $("#select_type").val();
        let _url = $(_this).data('href');
        window.location.href = _url+"?type="+type;
   }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>