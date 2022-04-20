

<?php $__env->startSection('title'); ?> <?php echo e(adminTransLang('detail')); ?> <?php $__env->stopSection(); ?>

<style type="text/css">
    .table-striped tbody tr {
        text-align: inherit;
    }
</style>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1> <?php echo e(adminTransLang('detail')); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(adminTransLang('dashboard')); ?></a></li>
            <li><a href="<?php echo e(route('admin.free.users.index')); ?>">All People Free</a></li>
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
                                    <h2>Basic Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Type</th>
                                                <td>Innovator</td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(adminTransLang('name')); ?></th>
                                                <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </td>
                                            </tr>
                                            
                                            <?php if($user->role == 2): ?>
                                                <tr>
                                                    <th><?php echo e(adminTransLang('gender')); ?></th>
                                                    <td><?php echo e($user->gender); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <th><?php echo e(adminTransLang('profile_image')); ?></th>
                                                <td><img alt="" src="<?php echo e($user->profile_image); ?>" width="60" height="60"/></td>
                                            </tr>

                                            <tr>
                                                <th>Innovator Description</th>
                                                <td><?php if(!empty($user->description)): ?><?php echo $user->description; ?><?php endif; ?></td>
                                            </tr>

                                            <tr>
                                                <th>Profile URL</th>
                                                <td><a target="_blank" href="<?php echo e(url('people/'.$user->slug)); ?>"><?php echo e($user->slug); ?></a></td>
                                            </tr>

                                                <tr>
                                                    <th>Fun Fact 1</th>
                                                    <td><?php echo e($user->fun_fact1); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 2</th>
                                                    <td><?php echo e($user->fun_fact2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Fun Fact 3</th>
                                                    <td><?php echo e($user->fun_fact3); ?></td>
                                                </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="accordion__header">
                                    <h2>Contact Info</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <!-- <tr>
                                                <th>Agent Name</th>
                                                <td>
                                                    <?php if(!empty($user->inventorContactInfo->agent_name)): ?>
                                                        <?php
                                                          $text   = $user->inventorContactInfo->agent_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->agent_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        ?>
                                                        <?php echo e($text); ?>

                                                    <?php endif; ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Agent Email</th>
                                                <td><?php if(!empty($user->inventorContactInfo->agent_email_id)): ?><?php echo e(@$user->inventorContactInfo->agent_email_id); ?> <?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Manager Name</th>
                                                <td>
                                                    <?php if(!empty($user->inventorContactInfo->manager_name)): ?>
                                                        <?php
                                                          $text   = $user->inventorContactInfo->manager_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->manager_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        ?>
                                                        <?php echo e($text); ?>

                                                    <?php endif; ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Manager Email</th>
                                                <td><?php if(!empty($user->inventorContactInfo->manager_email_id)): ?><?php echo e(@$user->inventorContactInfo->manager_email_id); ?><?php endif; ?></td>
                                            </tr> -->
                                            <tr>
                                                <th>Company Name</th>
                                                <td>
                                                    <?php if(!empty($user->inventorContactInfo->company_name)): ?>
                                                        <?php
                                                          $text   = $user->inventorContactInfo->company_name;  
                                                          if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                                                              $text = $abc->first_name." ".$abc->last_name;  
                                                          }
                                                        ?>
                                                        <?php echo e($text); ?>

                                                    <?php endif; ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Company Email</th>
                                                <td><?php if(!empty($user->inventorContactInfo->company_email_id)): ?><?php echo e(@$user->inventorContactInfo->company_email_id); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Company Phone</th>
                                                <td><?php if(!empty($user->inventorContactInfo->company_phone)): ?><?php echo e(@$user->inventorContactInfo->company_phone); ?><?php endif; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="accordion__header">
                                    <h2>Personal Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Primary Mobile</th>
                                                <td><?php echo e("+{$user->dial_code} {$user->mobile}"); ?></td>
                                            </tr>
										    <tr>
                                                <th>Primary Phone</th>
                                                <td><?php echo e("+{$user->dial_code} {$user->phone_number}"); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Primary Email</th>
                                                <td><?php echo e($user->email); ?></td>
                                            </tr>
											<tr>
                                                <th>Secondary Phone</th>
                                                <td><?php if(!empty($user->secondary_phone_number)): ?><?php echo e(@$user->secondary_phone_number); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Email</th>
                                                <td><?php if(!empty($user->secondary_email)): ?><?php echo e(@$user->secondary_email); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Secondary Mobile</th>
                                                <td><?php if(!empty($user->secondary_mobile)): ?><?php echo e(@$user->secondary_mobile); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Postal Address</th>
                                                <td><?php if(!empty($user->postal_address)): ?><?php echo e(@$user->postal_address); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td><?php if(!empty($user->city)): ?><?php echo e(@$user->city); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td><?php if(!empty($user->state)): ?><?php echo e(@$user->state); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Postcode/Zipcode</th>
                                                <td><?php if(!empty($user->zip_code)): ?><?php echo e(@$user->zip_code); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>
                                                    <?php if(!empty($user->country_id) ): ?>
                                                      <?php $country_id = $user->country_id; ?>
                                                    <?php else: ?>
                                                      <?php $country_id = 234; ?>
                                                    <?php endif; ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($id == $country_id): ?>
                                                            <?php echo e($name); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bussiness Address</th>
                                                <td><?php if(!empty($user->business_address)): ?><?php echo e(@$user->business_address); ?><?php endif; ?></td>
                                            </tr>
											<tr>
                                                <th>Business Address City</th>
                                                <td><?php if(!empty($user->city_business)): ?><?php echo e(@$user->city_business); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Business Address State</th>
                                                <td><?php if(!empty($user->city_business)): ?><?php echo e(@$user->city_business); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Business Address Postcode/Zipcode</th>
                                                <td><?php if(!empty($user->zip_code_business)): ?><?php echo e(@$user->zip_code_business); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Business Address Country</th>
                                                <td>
                                                    <?php if(!empty($user->country_id_business) ): ?>
                                                      <?php $country_id = $user->country_id_business; ?>
                                                    <?php else: ?>
                                                      <?php $country_id = 234; ?>
                                                    <?php endif; ?>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($id == $country_id): ?>
                                                            <?php echo e($name); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Website</th>
                                                <td><?php if(!empty($user->website)): ?><?php echo e(@$user->website); ?><?php endif; ?></td>
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
                                
                                <div class="accordion__header">
                                    <h2>Innovator Metadata</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th><?php echo e(adminTransLang('status')); ?></th>
                                                <td><?php echo e($user->status); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Registered on</th>
                                                <td><?php if(!empty($user->created_at)): ?><?php echo e(date('Y-m-d H:i A',strtotime($user->created_at))); ?><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Skills</th>
                                                <td><?php if(!empty($user->skills)): ?><?php echo e(@$user->skills); ?><?php endif; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>
                                                    <?php if(!empty(@$user->dobday)): ?>
                                                        <?php echo e(@$user->dobday); ?> 
                                                    <?php endif; ?>
                                                    <?php if(!empty(@$user->dobmonth)): ?>
                                                        -<?php echo e(@$user->dobmonth); ?>

                                                    <?php endif; ?>
                                                    <?php if(!empty(@$user->dobyear)): ?>
                                                        -<?php echo e(@$user->dobyear); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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