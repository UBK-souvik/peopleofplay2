<?php echo e(! $user = Auth::guard('admin')->user()); ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><!-- <img height="30" src="<?php echo e(imageBasePath('logo/logo.png')); ?>" /> --><b><?php echo e(adminTransLang('company')); ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo e(adminTransLang('toggle_navigation')); ?></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if($user->profile_image): ?>
                            <img src="<?php echo e(imageBasePath($user->profile_image)); ?>" class="user-image">
                        <?php else: ?> 
                            <img src="<?php echo e(imageBasePath('backend/images/logo/logo.png')); ?>" class="user-image">
                        <?php endif; ?>
                        <span class="hidden-xs"><?php echo e(ucfirst($user->name)); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if($user->profile_image): ?>
                            <img src="<?php echo e(imageBasePath($user->profile_image)); ?>" class="img-circle">
                            <?php else: ?> 
                            <img src="<?php echo e(imageBasePath('backend/images/logo/logo.png')); ?>" class="img-circle">
                            <?php endif; ?>
                            <p>
                                <?php echo e(ucfirst($user->name)); ?>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(route('admin.admins.update', ['id' => $user->id])); ?>" class="btn btn-default btn-flat"><?php echo e(adminTransLang('profile')); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-default btn-flat"><?php echo e(adminTransLang('sign_out')); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
        