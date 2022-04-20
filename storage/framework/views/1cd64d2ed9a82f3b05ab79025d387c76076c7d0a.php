
<?php $__env->startSection('content'); ?>

<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <div class="col-md-12">
          <div class="row sectionBox">
            <h1 class="Tile-style w-100 mb-0"> Article Categories</h1>
          </div>
        </div>
        
			<div class="col-md-12 ">
				<div class="row sectionBox padding-20">
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 margin-bottom-20 pl-0 inputPaddingLeft">
                        <div class="fat-heading-abb">
                            <a href="<?php echo e(route('front.pages.knowledge.base.article.by.category', [$category->id])); ?>">
                                <!-- fa fa-folder -->
                                <i class="fa fa-folder photo_icon"></i> <?php echo e($category->category); ?>
                                <span class="cat-count">(<?php echo e($category->articles_count); ?>)</span>
                            </a>
                        </div>
                        <div class="fat-content-small padding-left-30">
                            <ul>
                                <?php $__currentLoopData = $category->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->index >= 5): ?>
                                        <?php break; ?>
                                    <?php endif; ?>
                                    <li>  <!-- fa fa-file-text-o --> 
                                        <a href="<?php echo e(route('front.pages.knowledge.base.article.by.id', [$article->id])); ?>">
                                            <i class="fa fa-file-text-o photo_icon"></i> <?php echo e($article->title); ?>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			   </div>	
				
            </div>
        
          </div>

          </div>
		  <?php if(Auth::guard('users')->check()): ?>
			   <?php echo $__env->make('front.includes.profile-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	  
		   <?php else: ?>
			   <?php echo $__env->make('front.includes.pages-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		   <?php endif; ?>
          
		  
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>