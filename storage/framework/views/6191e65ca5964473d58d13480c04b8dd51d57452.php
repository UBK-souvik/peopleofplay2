<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">


<?php
$user_current_info = get_current_user_info();
?>

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
   <form onsubmit="feedsReportSubmit(this); return false;">
      <div class="row">
            <div class="col-md-12 p-0">
               <div class="form-group">
                  <label for="" class="px-3">Reason <sup class="text-danger">*</sup></label>
                  <div class="col-md-12 selectTwo">
                     <select name="reason" class="select2 w-100" data-placeholder="Select Reason" required>
                        <option value="">Select</option>
                        <?php $__currentLoopData = $report_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($report_label->id); ?>"><?php echo e(ucwords($report_label->label)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label for="">Description</label>
                  <textarea class="form-control" rows="2" id="Description" placeholder="Description" name="description"></textarea>
                  <input type="hidden" name="feed_id" value="<?php echo e($feed_id); ?>">
                  <input type="hidden" name="action_type" value="feed_report_submit">
               </div>
            </div>
         </div>
      <div class="modal-footer border-top-0 d-flex justify-content-right">
         <?php echo csrf_field(); ?>            
         <button type="submit" class="btn edit-btn-style feedsReportSubmit">Post Report<i class="fa fa-spinner fa-spin st_loading" style="display: none;"></i> </button>
      </div>
   </form>
</div>


<script src="<?php echo e(asset('backend/plugins/select2/select2.full.min.js?'.time())); ?>"></script>
<script type="text/javascript">

   $('.select2').select2();

function feedsReportSubmit(e) {

   $.ajax({
      url: "<?php echo e(url(@$action_url)); ?>",
      data: $(e).serialize(),
      dataType: 'json',
      type: 'POST',
      success: function (data) {
         if(data.status == 3){
            toastr.success(data.msg); 
            $('#DefaultModal').modal('hide');    
         }else if(data.status == 0){
            toastr.warning('Need to login first!!','Warning');
            setTimeout(function(){
               window.location.replace('<?php echo e(route("front.login")); ?>');
            },1000);
            
         }
      }
   });
}


</script>