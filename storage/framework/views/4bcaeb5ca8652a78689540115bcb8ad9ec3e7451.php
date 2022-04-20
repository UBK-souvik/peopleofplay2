
<div id="modal-user-role-type-popup-new" class="modal show">

              <div class="modal-dialog modal-sm" role="document">

                <div class="modal-content"  >

                	<div class="modal-header kbg_black">

	                    <div class="textContent">

	                      <h4 class="modal-title text-white w-100 planModelSmallHead">Choose The Profile Type</h4>

	                    </div>

	                    <button type="button" class="close text-white" data-dismiss="modal">×</button>

	                </div>

                  <div class="modal-body">

          			            

						<div class="form-group">

							<select name="role" id="role_id_sel" required class="form-control select2 py-3">

								<option value="">Type</option>

								<?php $__currentLoopData = $arr_roles_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								   <?php if($id == 1): ?><?php continue; ?>;<?php endif; ?>

								   <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								

								

							</select>

						</div>

								

						<button type="button " onclick="return chk_role_type_selected();" class="btn btnAll">Continue</button>

                  </div>

                </div><!-- /.modal-content -->

              </div><!-- /.modal-dialog -->

            </div><!-- /.modal -->