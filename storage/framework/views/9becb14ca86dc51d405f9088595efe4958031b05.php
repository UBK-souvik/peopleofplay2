

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('detail')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('detail')); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.companies.index')); ?>"><?php echo e(adminTransLang('all_companies')); ?></a></li>
            <li class="active"><?php echo e(adminTransLang('detail')); ?></li>
        </ol>
    </section>

    <section class="content">
        <p>
            <a class="btn btn-success btn-floating" href="<?php echo e(route('admin.users.showeditCompany', ['?id' => $user->id])); ?>"><?php echo e(adminTransLang('update')); ?></a>
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body" id="add-edit-user-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="">
                            <div class="accordion">
                                <div class="accordion__header is-active">
                                    <h2>Basic Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th><?php echo e(adminTransLang('name')); ?></th>
                                                <td><?php echo e(@$user->first_name); ?> <?php echo e(@$user->last_name); ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Acronym</th>
                                                <td><?php echo e(@$user->acronym); ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Is Gold</th>
                                                <td><?php echo e(!empty($user->gold) ? 'Yes':'No'); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(adminTransLang('email')); ?></th>
                                                <td><?php echo e(@$user->email); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(adminTransLang('mobile')); ?></th>
                                                <td><?php echo e("+{$user->dial_code} {$user->mobile}"); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(adminTransLang('profile_image')); ?></th>
                                                <td><img alt="" src="<?php echo e($user->profile_image); ?>" width="60" height="60"/></td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td><?php if(!empty($user->countrydata->country_name)): ?><?php echo e($user->countrydata->country_name); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Company Description</th>
                                                <td><?php if(!empty($user->description)): ?><?php echo $user->description; ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Profile URL</th>
                                                <td><a target="_blank" href="<?php echo e(url('company/'.$user->slug)); ?>"><?php echo e($user->slug); ?></a></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(adminTransLang('status')); ?></th>
                                                <td><?php echo e($user->status); ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="accordion__header">
                                    <h2>Social Media</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <div class="row social_media">
                                        <?php $__currentLoopData = config('cms.social_media'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                              $str_social_val = '';
                                              if(!empty($user->socialMedia))
                                              {   
                                                $str_social_val = @$user->socialMedia->pluck('value','type')->toArray()[$index];
                                              }
                                            ?> 
                                                <div class="col-md-3" >
                                                    <div class="form-group" style="margin-left: 0px !important;margin-right: 0px !important;">
                                                        <label for="<?php echo e($social); ?>"><?php echo e($social); ?></label>
                                                        <input type="url" readonly="" id="<?php echo e($social); ?>" name="socials[<?php echo e($index); ?>]"
                                                         value="<?php echo e($str_social_val); ?>"
                                                             class="form-control">
                                                    </div>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>   

                                 <?php echo $__env->make('admin.users.view_innovator_roles_team_member', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                               								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>