

                                <div class="modal-header text-center kbg_black">

                                  <h4 class="modal-title text-white mt-2">Collborators Add/Edit</h4>

                                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body p-3">

                                  <div class="">

                                    <form id="EditCollabModalForm" method="post" enctype="multipart/form-data" onsubmit="submitEditCollabModalForm(this,'edit_collaboration_id'); return false;">

                                      <?php echo csrf_field(); ?>

                                      <input type="hidden" name="collaboration_id" id="edit_collaboration_id" value="<?php echo e(@$productCollaborator->id); ?>">

                                      <input type="hidden" name="product_id" value="<?php echo e(@$productCollaborator->product_id); ?>">

                                      <input type="hidden" name="collab_hidden_user_image" id="collab_hidden_user_image" >

									  <input type="hidden" name="collab_user_id_hidden" id="collab_user_id_hidden">

                                      <div class="col-md-12">

                                        <div class="row">

                                          

										  

										  

                                          <div class="col-md-6 px-0">

                                            <div class="form-group">

                                              <label for="email">User Name:</label>

											  <!-- <input id="collab_user_name" class="form-control collab_user_name" name="collab_user_name" > -->

                        <select name="collab_user_name" id="collab_user_name" class="form-control input-sm select2-multiple-collab" multiple>
                          <?php $__currentLoopData = $collaborator_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collaborator_lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e(@$collaborator_lists->id); ?>" <?php if(@$productCollaborator->people_id == @$collaborator_lists->id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(@$collaborator_lists->text); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                       <!-- <option value="">Select</option> 

                       </select>

                                              <input type="text" class="form-control" name="collab_user_name" id="collab_user_name" placeholder="User Name" value=""> -->

                                            </div>

                                          </div>

                                          <div class="col-md-6 px-0">

                                            <div class="form-group">

                                              <label for="pwd">User Roles:</label>

                                              <select class="form-control" name="collab_user_role" id="collab_user_role">

                                                  <option value="">Select User Role</option>

                                                <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                  <option <?php if(@$productCollaborator->role == @$key): ?><?php echo e('selected'); ?><?php endif; ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                              </select>

                                            </div>



                                           



                                          </div>

                                        </div>

                                        <div class="row">

                                          <button type="submit" class="btn btnAll AddEditCollabModalSave">Save</button>

                                        </div>

                                      </div>

                                    </form>

                                  </div>

                                </div>

                                <!-- <div class="modal-footer">

                                  <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>

                                </div> -->

<script>
  $(document).ready(function(){
    $(".select2-multiple-collab").select2({
        theme: "bootstrap ",
        placeholder: "Collabrator",
        containerCssClass: 'feedSelectInput',
        maximumSelectionLength: 1,
    });
  });
</script>