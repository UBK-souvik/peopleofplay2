
<?php $__env->startSection('content'); ?>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<div class="container-width knowledge-base-faq-div-class">
    <div class="left-column colheightleft border_right">
      <div class="First-column bg-white">
        <div class="col-md-12 p-3 pb-0" >
          <div class="faqTopBg"><!-- sectionTop -->
            <h1 class="Tile-style w-100 mb-0 text-center text-white"> Frequently Asked Questions</h1>
        </div>
    </div>
    <!-- <hr class="mt-0 mb-3"> -->
    <div class="pb-3" style="">
        <div class="col-md-12">
         <div class="panel-group" id="accordionCategories" role="tablist" aria-multiselectable="true">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="panel panel-default">
                <div class="panel-heading panelPadding" role="tab" id="headingCategory<?php echo e($category->id); ?>">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionCategories" href="#collapseCategory<?php echo e($category->id); ?>" aria-expanded="true" aria-controls="collapseCategory<?php echo e($category->id); ?>">
                            <?php echo e($category->category); ?>

                        </a>
                        <a role="button" class="DownArrow pull-right" data-toggle="collapse" data-parent="#accordionCategories" href="#collapseCategory<?php echo e($category->id); ?>" aria-expanded="true" aria-controls="collapseCategory<?php echo e($category->id); ?>">
                            <i class="fa fa-angle-down photo_icon" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseCategory<?php echo e($category->id); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCategory<?php echo e($category->id); ?>">
                    <div class="panel-body">
                        <div class="panel-group" id="accordionQuestions<?php echo e($category->id); ?>" role="tablist" aria-multiselectable="true">
                            <?php $__currentLoopData = $category->faqQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="panel panel-default ">
                                <div class="panel-heading panelPadding" role="tab" id="headingQuestion<?php echo e($question->id); ?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordionQuestions<?php echo e($category->id); ?>" href="#collapseQuestion<?php echo e($question->id); ?>" aria-expanded="true" aria-controls="collapseQuestion<?php echo e($question->id); ?>">
                                            <?php echo e($question->question); ?>


                                        </a>
                                        <a role="button" class="DownArrow pull-right" data-toggle="collapse" data-parent="#accordionQuestions<?php echo e($category->id); ?>" href="#collapseQuestion<?php echo e($question->id); ?>" aria-expanded="true" aria-controls="collapseQuestion<?php echo e($question->id); ?>">
                                            <i class="fa fa-angle-down photo_icon" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseQuestion<?php echo e($question->id); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingQuestion<?php echo e($question->id); ?>">
                                    <div class="panel-body">
                                        <?php echo $question->answer; ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>