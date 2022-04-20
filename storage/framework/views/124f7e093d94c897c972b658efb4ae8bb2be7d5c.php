
<?php $__env->startSection('title'); ?> <?php echo e($data->title); ?> <?php $__env->stopSection(); ?>
<style type="text/css">
   .table-striped tbody tr {
   text-align: inherit;
   }
</style>
<?php $__env->startSection('content'); ?>
<section class="content-header">
   <h1> <?php echo e('Entertainments Details'); ?></h1>
   <ol class="breadcrumb">
      <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
      <li><a href="<?php echo e(route('admin.entertainment.index')); ?>">All Entertainments</a></li>
      <li class="active"><?php echo e(adminTransLang('detail')); ?></li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <div class="box-body" id="add-edit-user-main-box-body-div">
               <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
               <form class="form-horizontal" id="">
                  <div class="accordion">
                     <div class="accordion__header is-active">
                        <h2>Entertainments - <?php echo e($data->title); ?></h2>
                        <!-- <span class="accordion__toggle"></span> -->
                     </div>
                     <div class="accordion__body is-active">
                        <table class="table table-striped table-bordered no-margin table-bordered">
                           <tbody>
                            
                            <tr>
                                <td>
                                    <b>Title</b>
                                </td>
                                <td>
                                    <?php echo e($data->title); ?>

                                </td>
                                <td>
                                   <b> Category </b>
                                </td>
                                <td style="word-break: break-all;">
                                    <?php echo e($data->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><b>URL</b></td>
                                <td colspan="3" style="word-break: break-all;"> <?php echo e(@$data->url); ?> </td>
                            </tr>
                             <tr>
                                <td>
                                    <b>Status</b>
                                </td>
                                <td>
                                    <?php if(@$data->status ==1): ?>
                                    <?php echo e('Active'); ?>

                                    <?php else: ?>
                                    <?php echo e('Inactive'); ?>


                                    <?php endif; ?>
                                </td>
                                <td>
                                   <b> Image </b>
                                </td>
                                <td style="word-break: break-all;">
                                    <img  src="<?php echo e(@imageBasePath($data->featured_image)); ?>" class="imgFifty">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                                <td colspan="3" style="word-break: break-all;"> <?php echo e(@$data->description); ?> </td>
                            </tr>
                          
                           </tbody>
                        </table>
                     </div>                   
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>