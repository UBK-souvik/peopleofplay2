    <div class="accordion__header is-active">
        <h2>Basic Details</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body is-active">

	
	   
	                <?php $__currentLoopData = $arr_roles_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($id == 1 || $id == 3): ?><?php continue; ?>; <?php endif; ?>
                            <input type="hidden" name="role" value="<?php echo e($id); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
	   
	   

       <div class="form-group">
          <label for="email" class="col-sm-2 control-label">In Gold List </label>
          <div class="col-sm-6">
              <input type="radio" id="yes" name="gold" value="1" <?php if(!empty(@$user->gold)): ?><?php echo e('checked'); ?> <?php endif; ?>>
              <label for="yes">Yes</label><br>
              <input type="radio" id="no" name="gold" value="0" <?php if(empty(@$user->gold)): ?><?php echo e('checked'); ?> <?php endif; ?>>
              <label for="no">No</label><br>
          </div>
       </div>	   	   <div class="form-group">          <label for="email" class="col-sm-2 control-label">Profile Caption </label>          <div class="col-sm-6">              
	   <input type="text" id="home_page_slide_show_caption" class="form-control" name="home_page_slide_show_caption" value="<?php if(!empty(@$user->home_page_slide_show_caption)): ?><?php echo e($user->home_page_slide_show_caption); ?> <?php endif; ?>">          </div>       </div>
        
    <div class="form-group">          
            <label for="email" class="col-sm-2 control-label">Caption Url</label>          
            <div class="col-sm-6">              
             <input type="text" id="caption_url" class="form-control" name="caption_url" value="<?php if(!empty(@$user->caption_url)): ?><?php echo e($caption_url); ?> <?php endif; ?>">          
            </div>       
         </div>
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">First Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php if(!empty($user->first_name)): ?><?php echo e($user->first_name); ?><?php endif; ?>">
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Last Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php if(!empty($user->last_name)): ?><?php echo e($user->last_name); ?><?php endif; ?>">
          </div>
       </div>
       <?php if(empty($user->id)): ?>
	     <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="password" required class="form-control" name="password" placeholder="Password">
          </div>
       </div>
       <?php endif; ?>
	   <!--   <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Mobile <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" required class="form-control" name="mobile" value="<?php if(!empty($user->mobile)): ?><?php echo e($user->mobile); ?><?php endif; ?>">
          </div>
       </div> -->
       <!-- <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Gender <i class="has-error"></i></label>
          <div class="col-sm-6">
              <select name="gender" class="form-control">
                    <?php $__currentLoopData = @config('cms.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($gender); ?>" <?php echo e(!empty($user->gender) && ($gender === $user->gender) ? 'selected' : ''); ?>><?php echo e($gender); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </div>
       </div> -->
       <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Pronoun <i class="has-error"></i></label>
          <div class="col-sm-6">
              <select name="pronoun" class="form-control">
                  <option value="">Choose</option>
                  <option value="He/Him/His" <?php echo e('He/Him/His'===@$user->pronoun ? 'selected' : ''); ?>>He/Him/His</option>
                  <option value="She/Her/Hers" <?php echo e('She/Her/Hers'===@$user->pronoun ? 'selected' : ''); ?>>She/Her/Hers</option>
                  <option value="They/Them/Theirs" <?php echo e('They/Them/Theirs'===@$user->pronoun ? 'selected' : ''); ?>>They/Them/Theirs</option>
                  <option value="not-specify" <?php echo e('not-specify'===@$user->pronoun ? 'selected' : ''); ?>>Prefer not to specify</option>
              </select>
          </div>
       </div>
       <div class="form-group">
          <label for="profile_image" class="col-sm-2 control-label">Profile Image <i class="has-error"></i></label>
          <div class="col-sm-6">
              <img id="profile-blah-image" src="<?php echo e(@imageBasePath(@$user->profile_image)); ?>" alt="" class="twoFiftySeven">
			      <?php if(!empty($user->profile_image)): ?>
            <?php else: ?>
              <!-- <img id="profile-blah-image" src="<?php echo e(url('front/new/images/10.png')); ?>" alt="" class="twoFiftySeven"> -->
            <?php endif; ?>
            <input id="file-uploadten" accept="image/*" onchange="readProfileURL(this);" type="file" name="profile_image" class="marginTopFive">
            <h4 class="text-danger ">Note: Please upload image up to <?php echo e(App\Helpers\UtilitiesTwo::get_max_upload_image_size()); ?> only</h4>
          </div>
       </div>
       <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Name <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php if(!empty($user->username)): ?><?php echo e($user->username); ?><?php endif; ?>">
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Role <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="text" class="form-control" name="role" value="<?php if(!empty($user->role)): ?><?php echo e(@config('cms.role')[$user->role]); ?><?php endif; ?>" placeholder="User Role">
          </div>
       </div>-->
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Innovator Description <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <textarea class="form-control" required rows="9" name="description" id="Userdescription" placeholder=""><?php if(!empty($user->description)): ?><?php echo e($user->description); ?><?php endif; ?></textarea>
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact1" class="col-sm-2 control-label">Fun Fact 1</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact1" placeholder="Fun Fact 1" value="<?php if(!empty(@$user->fun_fact1)): ?><?php echo e(@$user->fun_fact1); ?><?php endif; ?>">
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact2" class="col-sm-2 control-label">Fun Fact 2</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact2" placeholder="Fun Fact 2" value="<?php if(!empty(@$user->fun_fact2)): ?><?php echo e(@$user->fun_fact2); ?><?php endif; ?>">
          </div>
       </div>
       <div class="form-group">
          <label for="fun_fact3" class="col-sm-2 control-label">Fun Fact 3</label>
          <div class="col-sm-6">
             <input required type="text" class="form-control" name="fun_fact3" placeholder="Fun Fact 3" value="<?php if(!empty(@$user->fun_fact3)): ?><?php echo e(@$user->fun_fact3); ?><?php endif; ?>">
          </div>
       </div>
	    <?php echo $__env->make('admin.users.admin_user_badge', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	   
    </div>