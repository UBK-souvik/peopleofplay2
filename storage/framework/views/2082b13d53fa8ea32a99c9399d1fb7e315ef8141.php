<div class="col-md-12">
  <div class="row sectionBox bg-white">
    <!-- <h3 class="sec_head_text w-100"><?php echo e($role_type_data_new); ?> Roles</h3> -->
    <h3 class="sec_head_text w-100">

   <?php if(isset($user->role) && @$user->role ==3): ?>
              Who are your team members?
              <?php else: ?> 
              What are your industry roles?
              <?php endif; ?>
  </h3>
		<!-- <h3 class="Tile-style social mt-3">User Roles</h3> -->
		<!-- <span class="parent-row"> -->
        <!-- <span class="add-row"> -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
			        <a href="#" class="btn btnAll mt-1 show-add-role-modal-popup"  data-toggle="modal" data-target="#addRoleModalDiv">Add</a>
            </div>
          </div>
		    </div> 
        <!-- </span> -->
    <!-- </span> -->
        <!-- <div class="row" > -->
            <div class="col-md-12 px-0">
                <div class="table-responsive text-nowrap" id="edit-profile-roles-data-div"> </div>
            </div>
        <!-- </div> -->
        </div>
  </div>