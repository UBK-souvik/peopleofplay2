
<?php $__env->startSection('content'); ?>


<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12">
          <div class="row sectionBox">
            <h1 class="Tile-style w-100 mb-0 text-capitalize"><?php echo e($category->category); ?> <span class="cat-count">(<?php echo e($category->articles_count); ?>)</span></h1>
          </div>
        </div>
        
        <div class="col-md-12">
            <div class="row sectionBox">		    
		
		<!-- <div class="fb-heading">
            <i class="fa fa-folder"></i> <?php echo e($category->category); ?>
            <span class="cat-count">(<?php echo e($category->articles_count); ?>)</span>
        </div> -->
        <hr class="style-three">
        <?php $__currentLoopData = $category->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 px-0">
			<div class="panel panel-default" >
                <div class="article-heading-abb-two">
                    <a class="span-style1" href="<?php echo e(route('front.pages.knowledge.base.article.by.id', [$article->id])); ?>">
                        <i class="fa fa-pencil-square-o"></i> <?php echo e($article->title); ?> </a>
                </div>
                <div class="article-info">
                    <div class="art-date">
                        <i class="fa fa-calendar-o"></i> <?php echo e($article->created_at); ?>
                    </div>
                    <div class="art-category">
                        <a href="<?php echo e(route('front.pages.knowledge.base.article.by.category', [$category->id])); ?>">
                        </a>
                    </div>
                </div>
                <div class="article-content">
                    <p class="block-with-text">
                        <?php echo @App\Helpers\Utilities::getFilterDescriptionHome($article->description, 3); ?>
                    </p>
                </div>
                <div class="article-read-more">
                    <a href="<?php echo e(route('front.pages.knowledge.base.article.by.id', [$article->id])); ?>" class="btn kbtn-default btn-wide">Read more...</a>
                </div>
            </div>
		  </div>	
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
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