            <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Quiz <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <select class="form-control select2" name="quiz_id" >
                            <option value="">Select</option>
                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($quiz_row->id); ?>" <?php if(isset($question->quiz_id) && !empty($question->quiz_id)){ echo "selected"; } ?> ><?php echo e($quiz_row->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>