<div class="accordion__header">
        <h2>Professional Contact</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body">
      


       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Name<i class="has-error"></i></label>
          <div class="col-sm-6">
              <select class="form-control select-ajax py-3" data-select2-tags="true" name="contact_info[company_name]" >  
                <?php if(!empty($user->inventorContactInfo->company_name)): ?>
                    <?php
                      $value  = $user->inventorContactInfo->company_name;  
                      $text   = $user->inventorContactInfo->company_name;  
                      if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                          $value = $abc->id;  
                          $text = $abc->first_name." ".$abc->last_name;  
                      }
                    ?>
                    <option value="<?php echo e($value); ?>" selected><?php echo e($text); ?></option>
                <?php endif; ?>
              </select>
             <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
              required="required" value="<?php if(!empty($user->inventorContactInfo->company_name)): ?><?php echo e(@$user->inventorContactInfo->company_name); ?><?php endif; ?>"
              class="form-control" placeholder=""> -->
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="CompanyEmailID" type="email"  class="form-control"
              value="<?php if(!empty($user->inventorContactInfo->company_email_id)): ?><?php echo e(@$user->inventorContactInfo->company_email_id); ?><?php endif; ?>"
              name="contact_info[company_email_id]" required="required"
              placeholder="">
          </div>
       </div>

       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="CompanyEmailID" type="number"  class="form-control" value="<?php if(!empty($user->inventorContactInfo->company_phone)): ?><?php echo e(@$user->inventorContactInfo->company_phone); ?><?php endif; ?>"
              name="contact_info[company_phone]" required="required"
              placeholder="">
          </div>
       </div>
    </div>