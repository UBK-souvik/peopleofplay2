<style>
  #Four_Product .form-group{ margin-bottom: 0; }
  .text-left { text-align: left !important; }
</style>
<span class="parent-row">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group" style="margin-left: 10px">
        <a href="#" class="btn btn-success mt-1 edit-role-popup-class">Add</a>
      </div>
    </div>
  </div> 

  <div class="row my-2">
    <div class="col-md-12">
        <div class="table-responsive text-nowrap kproductTbl" id="edit-profile-roles-data-div-colabo"><!--Table-->
            <table class="table table-striped edit_profileTbl">
                <thead class="titlestyle table-dark">
                    <tr>
                        <!-- <th class="text-left">User Image</th> -->
                        <th class="text-left">User Name</th>
                        <th class="text-left">User Roles</th>
                        <th class="text-left">Edit</th>
                        <th class="text-left">Delete</th>
                    </tr>
                </thead>
                <tbody class="tbody_productlist" id='table_append'>
                  <?php $__currentLoopData = @$product->collaborators ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
					<?php
                           $str_user_name = @App\Helpers\Utilities::getUserName(@$collab->collaboratorData);
						   $collaborator_img_data = @imageBasePath(@$collab->collaboratorData->profile_image);
						   
						    if(!empty($str_user_name))
							{
								
							}	  
							else
							{
								$str_user_name =  @$collab->name;
							}
						   
						  ?>
					
                      <tr class="" id="row_<?php echo e(@$collab->id); ?>">
                          
						  
						  
                          <td class="verticalalign text-left pl-0"><?php echo e($str_user_name); ?></td>
                          <td class="verticalalign text-left pl-0">
                            <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if(@$collab->role == $key): ?>
                                <?php echo e($value); ?>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td class="verticalalign text-left pl-0">
                              <span class="table-edit">
                                  <a href="#" class="span-style1 my-0 edit-role-popup-class" data-user_role="<?php echo e(@$collab->role); ?>" data-people_name="<?php echo e($str_user_name); ?>" data-user_name="<?php echo e($collab->name); ?>" data-user_image="<?php echo e($collaborator_photos_folder); ?><?php echo e($collaborator_img_data); ?>" data-hidden_user_image="<?php echo e($collaborator_img_data); ?>" data-collaboration_id="<?php echo e(@$collab->id); ?>" >Edit</a>
                              </span>
                          </td>
                          <td class="verticalalign text-left">
                              <span class="table-delete">
                                  <a href="#" class="text-danger my-0" 
                                  onclick="return deleteCollaboratorModal(<?php echo e(@$collab->id); ?>);">Delete</a>
                              </span>
                          </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</span>
