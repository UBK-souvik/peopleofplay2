
<?php $__env->startSection('content'); ?>


<div class="col-md-6 col-lg-7 MiddleColumnSection">
   <div class="left-column paddingTwenty border_right AdvceSearch">
      <div class="First-column bg-white p-3">
<!-- Keywords Design-->
<div class="col-md-12">
<div class="SearchKeywords ab_links">
   <div class="InterestingKeywords mb-3">
 <h3 class="font-weight-normal"> Browse Interesting Keywords</h3>
</div>
<div class="widget_content no_inline_blurb pl-2">
   <div class="widget_nested d-flex">
       <?php 
         @$totalSkill = count($skill_list);
         @$halfSkill = @$totalSkill/2;
         @$halfSkill =   round(@$halfSkill);
         ?>

 <?php $__currentLoopData = $skill_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skey => $srow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php if(@$halfSkill >$skey): ?>
  <?php if($skey==0): ?>
      <div class="w-50 skillListColOne">
   <?php endif; ?>
           <span class="nav-item font-weight-normal">
             <a class="nav-link p-0 pb-1 font-weight-normal" href="<?php echo e(url('skill/'.$srow->name)); ?>"><?php echo e($srow->name); ?>

               <small class="totalCountRole"> <?php 
                echo  '('.App\Helpers\UtilitiesTwo::skillsListCountUser($srow->name).')'; 
              ?>
              </small>
             </a>
           </span>
   <?php if($skey == @$halfSkill-1): ?>
      </div>
   <?php endif; ?>
<?php else: ?>
 <?php if($skey == @$halfSkill): ?>
      <div class="w-50 skillListColTwo">
         <?php endif; ?>
           <span class="nav-item">
             <a class="nav-link p-0 pb-1" href="<?php echo e(url('skill/'.$srow->name)); ?>"><?php echo e($srow->name); ?>

               <small class="totalCountRole"> <?php 
                echo  '('.App\Helpers\UtilitiesTwo::skillsListCountUser($srow->name).')'; 
              ?>
              </small>
             </a>
           </span>
           <?php if($skey == @$totalSkill-1): ?>
      </div>
    <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
</div>
</div>
</div>


<!-- Keywords Design-->
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>