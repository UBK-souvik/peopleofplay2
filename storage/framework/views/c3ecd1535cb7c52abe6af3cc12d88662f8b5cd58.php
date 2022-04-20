<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('dashboard')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php

$user = Auth::guard('admin')->user();

 ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('dashboard')); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('home')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('dashboard')); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($people); ?></h3>
                        <p>Total People</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <a href=" <?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(route('admin.users.index')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($company); ?></h3>
                        <p>Total Companies</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(route('admin.companies.index')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($products); ?></h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon"><i class="fa fa-product-hunt"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(route('admin.products.index')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($roles); ?></h3>
                        <p>Total Roles</p>
                    </div>
                    <div class="icon"><i class="fa fa-user-circle-o"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(route('admin.user_role.index')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($Blogs); ?></h3>
                        <p>Total Blogs</p>
                    </div>
                    <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(url('/admin/blog')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($Poll); ?></h3>
                        <p>Total Polls</p>
                    </div>
                    <div class="icon"><i class="fa fa-question-circle"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(url('/admin/polls')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($News); ?></h3>
                        <p>Total News</p>
                    </div>
                    <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(url('/admin/news')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($Events); ?></h3>
                        <p>Total Events</p>
                    </div>
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <a href="<?php if($user->email == 'juliadekorte@peopleofplay.com'): ?> <?php echo e('javascript:void(0);'); ?> <?php else: ?> <?php echo e(url('/admin/events')); ?> <?php endif; ?>" class="small-box-footer"><?php echo e(adminTransLang('more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>