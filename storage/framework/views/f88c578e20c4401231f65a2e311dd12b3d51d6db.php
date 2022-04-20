

<?php $__env->startSection('title'); ?> Add Company Category <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1> <?php if(!empty(@$category->id)): ?> Edit Company Category <?php else: ?> Create Company Category <?php endif; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.user_role.index')); ?>">All Company Categories</a></li>
            <li class="active"><?php if(!empty(@$category->id)): ?> Edit Company Category <?php else: ?> Create Company Category <?php endif; ?> </li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body" id="add-edit-user-main-box-body-div">
                            <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <form class="form-horizontal" action="<?php echo e(route('admin.company-category.create')); ?>" id="add-edit-user-main-box-body-form" method="post">
					            <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="category_id" value="<?php if(!empty($category->id)): ?><?php echo e($category->id); ?><?php endif; ?>">
                                <div class="accordion">
                                    <div class="accordion__header is-active">
                                        <h2>Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Category Name<i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="name" placeholder="Category Name" value="<?php if(!empty($category->name)): ?><?php echo e($category->name); ?><?php endif; ?>">
                                          </div>
                                       </div>
                                    </div>
                                </div>

                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="row">
                                        <button type="submit" class="btn btn-success" id="createBtn">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="box-footer">

                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>