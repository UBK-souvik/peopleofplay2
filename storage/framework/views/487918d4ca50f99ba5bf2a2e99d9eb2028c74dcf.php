<?php $__currentLoopData = $collection_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			  
			   <div class="item">
                  <div class="Gallery-text-overlay-Image3">
                     <a href="<?php echo e(@collectionImageBasePath($collection_data_row->featured_image)); ?>?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d635ce56a53ed68189603030b7ee6b26&auto=format&fit=crop&w=634&q=80" class="image1" title="<?php echo e($collection_data_row->title); ?>">
					 <img class="owl-lazy img-fluid imagesCover img_res_mob_dec" data-src="<?php echo e(@collectionImageBasePath($collection_data_row->featured_image)); ?>?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d635ce56a53ed68189603030b7ee6b26&auto=format&fit=crop&w=634&q=80" />
                      </a>
                      <p class="collectionShortDesc"><?php echo e(@$collection_data_row->title); ?></p>
                  </div>
				  
               </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>