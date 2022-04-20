
<?php $__env->startSection('content'); ?>
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
   <div class=" bg-black1 krow_margin kproduct QuizCustomDetail">
       <div class="First-column bg-black1 pt-0">
       <div class="quiz_heading py-4 text-center">
            <h2>Quiz</h2>
         </div>
         <div class="quiz_question py-4 py-xl-0 mb-4">
            <div class="row">
               <?php foreach($quiz_data as $quiz){ ?>
               <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                  <div class="QuizDetailSec d-flex align-center p-3">
                     <div class="QuizQuestionImage mb-2">
                        <img src="<?php echo e(@imageBasePath(@$quiz->image)); ?>" alt="profileimage" class="img-fluid">
                     </div>
                     <div class="QuizQuestion text-left mb-2">
                        <h6 class="text-left mb-2"><?php echo e($quiz->title); ?></h6>
                        <!-- <p class="mb-0"><?php echo e($quiz->description); ?></p> -->
                     </div>
                      <div class="QuizPlayBtn text-sm-right text-center">
                        <a href="<?php echo e(route('front.pages.quiz.question',$quiz->id)); ?>" class="btn playBtnQuiz1 btnAll mr-2" id="submitQuizQuestion">Play Now</a>
                     </div>
                  </div>
               </div>
                <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>