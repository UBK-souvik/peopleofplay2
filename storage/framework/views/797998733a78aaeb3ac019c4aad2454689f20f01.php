<div class="accordion__header">
        <h2>Personal Details</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body">
      <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Primary Mobile <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input type="text" required class="form-control" name="mobile" value="<?php echo e(@$str_mobile_no_new); ?>">
          </div>
       </div>
	  <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Primary Phone <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="phone_number" required type="number" name="phone_number" value="<?php if(!empty($user->phone_number)): ?><?php echo e(@$user->phone_number); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
       </div>
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Primary Email <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="email" required class="form-control" name="email" placeholder=""  value="<?php if(!empty($user->email)): ?><?php echo e($user->email); ?><?php endif; ?>">
          </div>
       </div> 

       <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Hide Email </label>
          <div class="col-sm-6">
		            <input id="hide_email" type="checkbox" name="hide_email" value="1"  <?php if(!empty($user->hide_email)): ?><?php echo e('checked'); ?> <?php endif; ?>>
          </div>
       </div> 
        <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Phone<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input  id="Phone" type="number" name="phone_number" value="<?php if(!empty($user->phone_number)): ?><?php echo e(@$user->phone_number); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Email<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="primary_email" required type="email" name="primary_email" value="<?php if(!empty($user->email)): ?><?php echo e(@$user->email); ?><?php endif; ?>"class="form-control" placeholder="">
          </div>
        </div>
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Mobile<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input  id="primary_mobile" required type="number" name="primary_mobile" value="<?php if(!empty($user->mobile)): ?><?php echo e(@$user->mobile); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div> -->
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="secondary_phone" type="number" name="secondary_phone_number" value="<?php if(!empty($user->secondary_phone_number)): ?><?php echo e(@$user->secondary_phone_number); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
         <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input >
          </div>
        </div> -->
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input  id="secondary_email" type="Email" name="secondary_email" value="<?php if(!empty($user->secondary_email)): ?><?php echo e(@$user->secondary_email); ?><?php endif; ?>"class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Secondary Mobile <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input  id="secondary_mobile" type="number" name="secondary_mobile" value="<?php if(!empty($user->secondary_mobile)): ?><?php echo e(@$user->secondary_mobile); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
       </div> 
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Postal Address<i class="has-error"></i></label>
          <div class="col-sm-6">
             <textarea class="form-control" rows="1" id="PostalAddress" name="postal_address"  placeholder=""><?php if(!empty($user->postal_address)): ?><?php echo e(@$user->postal_address); ?><?php endif; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">City<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="City" type="text" name="city" value="<?php if(!empty($user->city)): ?><?php echo e(@$user->city); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">State<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="State" type="text" name="state" value="<?php if(!empty($user->state)): ?><?php echo e(@$user->state); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Postcode/Zipcode<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="PostcodeZipcode"  type="text" name="zip_code" value="<?php if(!empty($user->zip_code)): ?><?php echo e(@$user->zip_code); ?><?php endif; ?>" class="form-control"
                placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Country<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <select required name="country_id" class="form-control select2 country_id">
                    <option value="">Choose</option>
                    <?php if(!empty($user->country_id) ): ?>
                      <?php $country_id = $user->country_id; ?>
                    <?php else: ?>
                      <?php $country_id = 234; ?>
                    <?php endif; ?>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(($id == $country_id) ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address<i class="has-error"></i></label>
          <div class="col-sm-6">
             <textarea class="form-control" required rows="1" name="business_address" id="business_address" placeholder=""><?php if(!empty($user->business_address)): ?><?php echo e(@$user->business_address); ?><?php endif; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address City <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="City"  type="text" name="city_business" value="<?php if(!empty($user->city_business)): ?><?php echo e(@$user->city_business); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address State<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="State" type="text" name="state_business" value="<?php if(!empty($user->state_business)): ?><?php echo e(@$user->state_business); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address Postcode/Zipcode<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="PostcodeZipcode"  type="text" name="zip_code_business" value="<?php if(!empty($user->zip_code_business)): ?><?php echo e(@$user->zip_code_business); ?><?php endif; ?>" class="form-control"
                placeholder="">
          </div>
        </div>
		
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address Country<i class="has-error"></i></label>
          <div class="col-sm-6">
             <select name="country_id_business" class="form-control select2 country_id">
                    <option value="">Choose</option>
                    <?php if(!empty($user->country_id_business) ): ?>
                      <?php $country_id = $user->country_id_business; ?>
                    <?php else: ?>
                      <?php $country_id = 234; ?>
                    <?php endif; ?>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(($id == $country_id) ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Website<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="Website" required type="text" name="website" value="<?php if(!empty($user->website)): ?><?php echo e(@$user->website); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
        </div>
		
		<div class="form-group">
          <label for="name" class="col-sm-2 control-label">Date of Birth <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <!-- <input id="dateofbirth" required type="date" name="dob" value="<?php if(!empty($user->dob)): ?><?php echo e($user->dob); ?><?php endif; ?>" class="form-control"> -->
				      
		
			  
              <select class="col-sm-3 dmy year1 rightMargin" name="dobyear" id="dobyear"></select>
              <select class="col-sm-3 dmy month1 rightMargin" name="dobmonth" id="dobmonth"></select>
      			  <select class="col-sm-3 dmy day1 rightMargin" name="dobday" id="dobday"></select>
          </div>
       </div>   
	   <?php
	     $int_dobday =  @$user->dobday;
	     $int_dobmonth =  @$user->dobmonth;
		 $int_dobyear =  @$user->dobyear;
		 
		 $str_dob_date_new = $int_dobday . "-" . $int_dobmonth . "-" . $int_dobyear;
	   ?>	 
	   
	   <?php if(!empty($user->dobyear)): ?>
	  	 
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Age<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="UserAge" type="text" name="age" readonly value="<?php if(!empty($user->dobyear)): ?><?php echo e(@Carbon\Carbon::parse($str_dob_date_new)->age); ?><?php endif; ?>" class="form-control" placeholder="">
          </div>
       </div>
	   <?php endif; ?>
        
    </div>

    <style type="text/css">
      span.select2.select2-container.select2-container--default.select2-container--below { width: 505px !important }
      .country_id { width: 505px !important }
    </style>