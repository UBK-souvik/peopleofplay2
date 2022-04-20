
<?php $__env->startSection('title'); ?> <?php echo e('Home Page Whatever Days'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="content-header">
 <h1>Home Page Award Type List</h1>
 <ol class="breadcrumb">
  <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
  <li class="active">Home Page Award List Type</li>
</ol>
</section>
<p id="message-box-id" class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
<section class="content">
 <p>
  <?php echo $__env->make('admin.includes.info-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</p>
 <p>
    <a href="<?php echo e(url('admin/cms/home-award-type/create')); ?>" class="btn btn-success">Create Home Page Award</a>
   </p>
<div class="row">
  <div class="col-md-12">
   <div class="box">
    <div class="box-body grid-view">
     <table class="table table-striped table-bordered table-hover dataTable" id="paragraphs-table">
      <thead>
       <tr>
        <th>Title</th>
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
     ajax: '<?php echo e(route("admin.cms.home_page_award_type_list")); ?>',
     columns : [
     { "data": "title" },
     { "data": "status" },                   
     {
       "mRender": function (data, type, row) 
       {
         return '<a href="<?php echo e(route("admin.cms.home-award_type.update")); ?>/'+row.id+'">\<i class="fa fa-edit fa-fw"></i>\</a>\<a class="delete_admins" href="<?php echo e(route("admin.cms.home-award_type.delete")); ?>/'+row.id+'">\<i class="fa fa-trash fa-fw"></i>\</a>';
       }, 
       orderable: false
     }
     ],
     order : [[2, 'desc']]
   });
   
   $('#paragraphs-table').on('click', '.delete_admins', function(e){
     e.preventDefault();
     var r = confirm("<?php echo e(adminTransLang('are_you_sure_to_delete')); ?>");
     if (r == false) {
       return false;
     }
     var href = $(this).attr('href');
     $.get( href, function( data ) {
       $('#paragraphs-table').DataTable().ajax.reload();
     });
   });
   
 });

</script>
<?php echo $__env->make('admin.users.user_admin_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>