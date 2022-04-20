

<?php $__env->startSection('content'); ?>


<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <div class="col-md-12">
          <div class="row sectionBox">
            <h1 class="Tile-style w-100 mb-0">View Full Article </h1>
          </div>
        </div>
        
        <div class="">
		    <div class="col-md-12 sectionBox">
        <div class="panel panel-default">
            <div class="article-heading my-1 pl-2">
                <i class="fa fa-pencil-square-o photo_icon" style="margin-left: 7px;"></i> <?php echo e($article->title); ?>

            </div>
            <div class="article-info">
                <div class="art-date">
                    <i class="fa fa-calendar-o photo_icon"></i> <?php echo e($article->created_at); ?>

                </div>
                
            </div>
            <div class="article-content">
               <?php echo $article->description; ?>

            </div>
			
	        <div class="col-md-12 px">
						 <div class="row blogDetHeadRow">
							<div class="tags" style="margin-left: 7px;"><strong>Tag: </strong><span> <?php echo $article->tag; ?></span></div>
						 </div>
		    </div>
            
        </div>
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