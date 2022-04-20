<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('all_articles')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('all_articles')); ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('all_articles')); ?></li>
        </ol>
    </section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
		<p>
    <section class="content">
        <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
            <a href="<?php echo e(route('admin.knowledge-base-articles.showadd')); ?>" class="btn btn-success">Create Article</a>
	    </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body grid-view">
                        <table class="table table-striped table-bordered table-hover dataTable" id="articles-table">
                            <thead>
                                <tr>
                                    
									<th><?php echo e(adminTransLang('article_caption')); ?></th>
									<th><?php echo e(adminTransLang('article_category')); ?></th>
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
            $('#articles-table').DataTable({
				"pageLength": 50,
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route("admin.knowledge-base-articles.list")); ?>',
                columns : [
                    { "data": "title" },
					{ "data": "category_name" },
					{ "data": "status" },
                    {
                        "mRender": function (data, type, row) 
                        {
                            return '<a href="<?php echo e(route("admin.knowledge-base-articles.showedit")); ?>/'+row.id+'">\
                                <i class="fa fa-edit fa-fw"></i>\
                            </a>\
                            <a href="<?php echo e(URL::to("admin/knowledge-base/articles/delete")); ?>/'+row.id+'" class="delete_admins" >\
                                <i class="fa fa-trash fa-fw"></i>\
                            </a>';
                        }, 
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#articles-table').on('click', '.delete_admins', function(e){
                e.preventDefault();

                if (confirm("<?php echo e(adminTransLang('are_you_sure_to_delete')); ?>")) {
                    var href = $(this).attr('href');
                    $.get( href, function( data ) {
                        $('#articles-table').DataTable().ajax.reload();
                    });
                }
            });
        });
		
		var article_data_saved_flag = '<?php echo e(Session::has("article_data_saved_flag")); ?>';

        $(document).ready(function(){
			
		if(article_data_saved_flag!="")
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