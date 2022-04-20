<div class="accordion__header">
        <h2><!-- Innovator Metadata-->Skills & Expertise</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body active"> 
        <?php if(!empty($user->status)): ?>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Status<i class="has-error">*</i></label>
            <div class="col-sm-6">
               <input id="status" type="text" name="status" readonly="" value="<?php if(!empty($user->status)): ?><?php echo e(@config('cms.user_status')[$user->status]); ?><?php endif; ?>" class="form-control" placeholder="">
            </div>
         </div>
        <?php endif; ?>
        <?php if(!empty($user->created_at)): ?>
         <div class="form-group">
            <label for="resgister_on" class="col-sm-2 control-label">Registered on<i class="has-error">*</i></label>
            <div class="col-sm-6">
               <input id="resgister_on" type="text" name="resgister_on" readonly="" value="<?php if(!empty($user->created_at)): ?><?php echo e(date('Y-m-d H:i A',strtotime($user->created_at))); ?><?php endif; ?>" class="form-control" placeholder="">
            </div>
         </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Skills<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <!-- <input id="Skills" type="text" required name="skills"  value="<?php if(!empty($user->skills)): ?><?php echo e(@$user->skills); ?><?php endif; ?>" class="form-control skill_get" placeholder=""> -->
             <?php echo $__env->make('admin.users.admin_user_skills_drop_down', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
       </div>
       
       
	   
       <!-- <div class="form-group">
          <label for="status" class="col-sm-2 control-label">Status <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select class="form-control" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                <option value="2">Block</option>
             </select>
          </div>
       </div> -->
    </div>

    <style type="text/css">
      .dmy {height: 34px;padding: 6px 12px;}
    </style>