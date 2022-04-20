<div class="modal" id="myModal">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header kbg_black "  style="display: flex;">
                                  <div class="row " style="width: 100%;">
                                    <h4 class="">Collborators Edit</h4>
                                  </div>
                                  <button type="button" class="close kclose" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body paddingZero">
                                  <div class="">
                                    <form id="AddEditCollabModalForm" enctype="multipart/form-data">
                                      <?php echo csrf_field(); ?>
                                      <input type="hidden" name="collaboration_id" id="collaboration_id">
                                      <input type="hidden" name="product_id" value="<?php echo e(@$product->id); ?>">
                                      <input type="hidden" name="collab_hidden_user_image" id="collab_hidden_user_image" >
									  <input type="hidden" name="collab_user_id_hidden" id="collab_user_id_hidden">
                                      <div class="col-md-12">
                                        <div class="row">
                                          
										  
										  
                                          <div class="col-md-6 px-0">
                                            <div class="form-group TopMarginFiveMob">
                                              <label for="email">User Name:</label>
											  <input id="collab_user_name" class="form-control collab_user_name" name="collab_user_name" >
											  
											  
											  
                                            
											</div>
                                            <div class="form-group">
                                              <label for="pwd">User Roles:</label>
                                              <select class="form-control" name="collab_user_role" id="collab_user_role">
                                                <option value="">Select User Role</option>
                                                <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </select>
                                            </div>

                                            <button type="button" class="btn edit-btn-style rounded-0 text-center AddEditCollabModalSave">Save</button>

                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>