<select  class="form-control" name="expandable[]" id="select-ajax" multiple>
                                                <?php switch($category_id):
                                                    case (1): ?>
                                                        <?php $__currentLoopData = $main_list_page->products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option selected value="<?php echo e(@$product->product->id); ?>"><?php echo e(@$product->product->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php break; ?>
                                                    <?php case (2): ?>
                                                        <?php $__currentLoopData = $main_list_page->products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option selected value="<?php echo e(@$product->product->id); ?>"><?php echo e(@$product->product->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php break; ?>
                                                    <?php case (5): ?>
                                                        <?php $__currentLoopData = $main_list_page->events ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option selected value="<?php echo e(@$events->event->id); ?>"><?php echo e(@$events->event->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php break; ?>
                                                    <?php case (3): ?>
                                                        <?php $__currentLoopData = $main_list_page->companies ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!empty($company->user->first_name)): ?>
                                                                <option selected value="<?php echo e(@$company->user->id); ?>"><?php echo e(@$company->user->first_name .' | '.@$company->user->email); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php break; ?>
                                                    <?php case (4): ?>
                                                        <?php $__currentLoopData = $main_list_page->users ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!empty($users->user->first_name)): ?>
                                                                <option selected value="<?php echo e(@$users->user->id); ?>"><?php echo e(@$users->user->first_name .' | '.@$users->user->email); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php break; ?>
                                                    <?php case (6): ?>
                                                        <?php $__currentLoopData = $main_list_page->awards ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option selected value="<?php echo e(@$award->product->id); ?>"><?php echo e(@$award->product->name); ?>  ttt</option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php break; ?>
													<?php case (7): ?>
                                                        <?php $__currentLoopData = $main_list_page->brand_lists ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands_list_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option selected value="<?php echo e(@$brands_list_row->brand_list->id); ?>"><?php echo e(@$brands_list_row->brand_list->name); ?>  ttt</option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php break; ?>
													
                                                <?php endswitch; ?>
                                            </select>