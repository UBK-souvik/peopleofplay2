<div class="modal" id="adminAddRoleModalDiv">
                            
							<div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header kbg_black">
                                  <div class="row p-2">
                                    <h4 class="text-white"><?php echo e($role_type_data_new); ?> Roles 									
									<span id="admin-span-role-team-id-new"></span></h4>
                                  </div>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body p-3">
                                  <div class="">
                                    
									<form id="adminAddRoleModalDivForm">
							           <?php echo csrf_field(); ?>
                                      <div class="col-md-12">
                                        <div class="row">
                                          <div class="col-md-6 pl-0">
                                            <div class="form-group">
                                              <label for="email"><?php echo e($role_type_data_new); ?> Role:</label>
                                              <select class="form-control" data-placeholder="Select" 
                                                  name="admin_add_edit_profile_role[role]" 
                                                  id="admin_add_edit_profile_role_data">
                                                  <option value="">Select User Role</option>
                                                  <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_key => $users_user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <option value="<?php echo e($role_key); ?>" <?php if($role_key == @$role->role): ?><?php echo e("selected"); ?> <?php endif; ?> ><?php echo e($users_user_role); ?> </option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </select>
                                              <!-- <input id="admin_add_edit_profile_role_data" type="text" class="form-control" placeholder="User Role" name="admin_add_edit_profile_role[role]"> -->
                                            </div>
                                          </div>
										  
										  <?php if($int_role_type_id_data_new == 3): ?>
											  <input value="5" id="admin_add_edit_profile_role_at" type="hidden" class="form-control" name="admin_add_edit_profile_role[at]">
										  <?php else: ?>
                                              <div class="col-md-6 px-0">
                                            <div class="form-group">
                                              <label for="pwd">At:</label>
                  										        <select  id="admin_add_edit_profile_role_at" name="admin_add_edit_profile_role[at]" class="form-control" data-placeholder="Select" onchange="return adminShowProductCompany(this.value);">
                                    							<option value="">Select At</option>
                                                  <?php if(isset($arr_role_at_list)): ?> 
                                      							<?php $__currentLoopData = @$arr_role_at_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr_role_at_list_key => $arr_role_at_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      							       <?php if($int_role_type_id_data_new == 2 && $arr_role_at_list_key>2): ?>
																	      <?php break; ?>
																       <?php endif; ?>
																	   <option  value="<?php echo e($arr_role_at_list_key); ?>"><?php echo e($arr_role_at_list_val); ?></option>
                                      							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  <?php endif; ?>
                                              </select>
                                            </div>
                                          </div>  											  
                                         													
									     <?php endif; ?>
                                          
										  
										  
										  
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="row">
                                          
										  <div class="col-md-12 px-0">
                                            <div class="form-group">
                                              <label for="pwd">Description:</label>
                                              <!-- <input id="admin_add_edit_profile_role_description" type="text" class="form-control" placeholder="Description" style="width:300px;" name="admin_add_edit_profile_role[description]"> -->

                                              <textarea  id="admin_add_edit_profile_role_description" type="text" class="form-control" placeholder="Type your description" name="admin_add_edit_profile_role[description]"></textarea>
                                            </div>
                                          </div>
										  
										  
										  <div class="col-md-6 pl-0" id="admin-div-people-list" <?php if($int_role_type_id_data_new == 3): ?> style="display:block;" <?php else: ?> style="display:none;"  <?php endif; ?>>
                                            <div class="form-group">
                                              <label for="pwd">People:</label>
											  
											  <input id="admin_add_edit_profile_role_name_people_id" name="admin_add_edit_profile_role[people_name]" class="form-control" >
                        
                                              <!-- <input id="admin_add_edit_profile_role_name"  name="admin_add_edit_profile_role[name]" type="text" class="form-control" placeholder="Name"> -->
                                            </div>
                                          </div>
										  
										  <div class="col-md-6 pl-0" id="admin-div-company-list" style="display:none;">
                                            <div class="form-group">
                                              <label for="pwd">Company:</label>
                                              <input id="admin_add_edit_profile_role_name_company_id" name="admin_add_edit_profile_role[company_name]" class="form-control" style="width:300px;">
                                              
                                            </div>
                                          </div>
										  
										  <div class="col-md-6 pl-0" id="admin-div-product-list" style="display:none;">
                                            <div class="form-group">
                                              <label for="pwd">Product:</label>
                                              <input id="admin_add_edit_profile_role_name_product_id" name="admin_add_edit_profile_role[product_name]" class="form-control" style="width:300px;">
                                              
                                            </div>
                                          </div>
										  
										  
                                          
                                        </div>
                                      </div>
									  
									  
                                      
									  
								      
									  <input type="hidden"  id="admin_add_edit_profile_role_product_hidden_id" name="admin_add_edit_profile_role[product_hidden_id]">
									  <input type="hidden"  id="admin_add_edit_profile_role_company_hidden_id" name="admin_add_edit_profile_role[company_hidden_id]">
									  <input type="hidden"  id="admin_add_edit_profile_role_people_hidden_id" name="admin_add_edit_profile_role[people_hidden_id]">
									  <input type="hidden"  id="admin_add_edit_profile_role_hidden_id" name="admin_add_edit_profile_role[role_id]">
									  <input type="hidden"  id="admin_add_edit_profile_user_hidden_id" name="admin_add_edit_profile_role[user_id]" value="<?php echo e($user_id); ?>">
                                      <input type="hidden"  id="admin_add_edit_profile_role_random_time_stamp_hidden_id" name="admin_add_edit_profile_role[random_time_stamp_new]" value="<?php echo e($str_random_time_stamp_new); ?>">
									  <input type="hidden"  id="admin_add_edit_profile_role_type_hidden_id" name="admin_add_edit_profile_role[int_role_type_new]" value="<?php echo e($int_role_type_id_data_new); ?>">
									  <button type="button" class="btn btn-success adminAddUpdateRoleBtn" style="margin: 15px;">Save</button>
                   
                                    </form>
                                  </div>
                                </div>
                                <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div> -->
                              </div>
                            </div>
							
                          </div>