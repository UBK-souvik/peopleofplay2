
<?php $__env->startSection('title'); ?> Home Page Whatever Day Create <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
 <h1> Home Page Award Type Create</h1>
 <ol class="breadcrumb">
  <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
  <li><a href="<?php echo e(route('admin.cms.home-award_type.index')); ?>"> All Home Page Award Type List</a></li>
  <li class="active">Home Page Award Typ3 Create</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
 <!-- Small boxes (Stat box) -->
 <div class="row">
  <div class="col-md-12">
   <div class="box">
    <!-- /.box-header -->
    <div class="box-body">
     <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
     <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
      <input type="hidden" name="happy_whatever_day_id" value="<?php echo e(@$home_page_award_type->id); ?>">
      <div class="form-group">
       <label for="email" class="col-sm-2 control-label">Title</label>
       <div class="col-sm-6">
        <input id="home_caption_one" type="text" value="<?php echo e(@$home_page_award_type->title); ?>" name="title" class="form-control" placeholder="">
      </div>
    </div>
    <div class="form-group">
     <label for="status" class="col-sm-2 control-label"><?php echo e(adminTransLang('status')); ?> <i class="has-error">*</i></label>
     <div class="col-sm-6">
      <select class="form-control" name="status">

        <?php $__currentLoopData = config('cms.action_status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($key); ?>" <?php echo e(isset($home_page_award_type) && $home_page_award_type->status == $key ? 'selected' : ''); ?>><?php echo e($status); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>
  </div>
  <?php echo csrf_field(); ?>
  <div class="form-group">
   <div class="col-sm-offset-2 col-sm-6">
    <button type="button" class="btn btn-success" id="createBtn">Submit</button>
  </div>
</div>
</form>
</div>
</div>
</div>
<?php echo $__env->make('admin.includes.cropper_model', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>


 function readURL(input) {
  $('.custom-file__label .imageLoading').show();
  if (input.files && input.files[0]) {
   var reader = new FileReader();
   reader.onload = function(event) {
    $("#profile-blah-image").attr('src', event.target.result);
    $('#check_image').val(1);
  }
  reader.readAsDataURL(input.files[0]);
}
}

</script>
<script type="text/javascript">
 jQuery(function($) {
   $(document).on('click','#createBtn',function(e){
     e.preventDefault();

     var fd = new FormData($('#create-form')[0]);  

     $.ajax({
       processData: false,
       contentType: false,
       data: fd,
       dataType: 'json',
       url: '<?php echo e(route("admin.cms.home-award_type.update")); ?>',
       headers: {
        'X-CSRF-TOKEN': ajax_csrf_token_new
      },
      type: 'POST',
      beforeSend: function()
      {
       $('#createBtn').attr('disabled',true);
       $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
     },
     error: function(jqXHR, exception){
       $('#createBtn').attr('disabled',false);

       if(jqXHR.responseText.indexOf('Whatever day already exists')>0)
       {
         var err = eval("(" + jqXHR.responseText + ")");
         var msg = err.msg;
       }
       else
       {
         var msg = formatErrorMessage(jqXHR, exception);  
       }

       $('.message_box').html(msg).removeClass('hide');
     },
     success: function (data)
     {
       $('#createBtn').attr('disabled',false);
       if(data.status == 1)
       {
         $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
         window.location.replace('<?php echo e(route("admin.cms.home-award_type.index")); ?>');

       } else {
         var message = formatErrorMessageFromJSON(data.errors);
         $('.message_box').html(message).removeClass('hide');
       }

     }
   });
   });
 });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>