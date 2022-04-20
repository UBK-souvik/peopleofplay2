 <?php if((!empty($user->email) && $user->hide_email ==0) || !empty($user->phone_number) || !empty($user->mobile) || !empty($user->secondary_email) || !empty($user->postal_address) || !empty($user->city) || !empty($user->state) || !empty($user->secondary_phone_number) || !empty($user->zip_code) || !empty($user->countrydata->country_name) || !empty($user->business_address) || !empty($user->city_business) || !empty($user->state_business) || !empty($user->zip_code_business) || !empty($user->country_id_business) || !empty($str_user_website) || !empty($user->virtual_show_room) || (!empty($user->dobday) AND !empty($user->dobmonth))): ?>
<?php //echo "dsf"; die; ?>
<div class="col-md-12 strong_size">
   <div class="row sectionBox ProfilePersonalDetails">
      <h3 class="sec_head_text w-100">Contact Information
         <?php if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id): ?>
         <a href="<?php echo e($str_profile_user_edit); ?>" class="move_edit_page" title="Edit Contact Infomation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         <?php endif; ?>
      </h3>
      <div class="w-100">
         
         <?php if(!empty($user->phone_number)): ?>
         <p class="text-black p-0 mb-1"><strong>Primary Phone</strong> :<?php echo e($user->phone_number); ?></p>
         <?php endif; ?>
         <?php if(have_permission('email') ): ?>
         <?php if(empty($user->hide_email)): ?>  
         <?php if(!empty($user->email)): ?>
         <p class="text-black p-0 mb-1"><strong>Primary Email</strong> : <?php echo e($user->email); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(!empty($user->mobile)): ?>
            <?php if(empty($user->hide_telephone)): ?>  
               <p class="text-black p-0 mb-1"><strong>Telephone</strong> : <?php echo e(@App\Helpers\UtilitiesFour::getUserDialCode($user)); ?> <?php echo e($user->mobile); ?></p>
            <?php endif; ?>
         <?php endif; ?>
         <?php if(!empty($user->secondary_phone_number)): ?>
         <p class="text-black p-0 mb-1"><strong>Secondary Phone</strong> : <?php echo e(@App\Helpers\UtilitiesFour::getUserDialCode($user)); ?> <?php echo e($user->secondary_phone_number); ?></p>
         <?php endif; ?>
         <?php if(have_permission('email') ): ?>
         <?php if(!empty($user->secondary_email) && empty($user->hide_secondary_email)): ?>
         <p class="text-black p-0 mb-1"><strong>Secondary Email</strong> : <?php echo e($user->secondary_email); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(!empty($user->secondary_mobile)): ?>
         <p class="text-black p-0 mb-1"><strong>Secondary Mobile</strong> : <?php echo e(@App\Helpers\UtilitiesFour::getUserDialCode($user)); ?> <?php echo e($user->secondary_mobile); ?></p>
         <?php endif; ?>
         <?php if(have_permission('postal_address') ): ?>
         <?php if(!empty($user->postal_address)): ?>
         <p class="text-black p-0 mb-1"><strong>Postal Address</strong> : <?php echo e($user->postal_address); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('city') ): ?>
         <?php if(!empty($user->city)): ?>
         <p class="text-black p-0 mb-1"><strong>City</strong> : <?php echo e($user->city); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('state') ): ?>
         <?php if(!empty($user->state)): ?>
         <p class="text-black p-0 mb-1"><strong>State</strong> : <?php echo e($user->state); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('post_zip_code') ): ?>
         <?php if(!empty($user->zip_code)): ?>
         <p class="text-black p-0 mb-1"><strong>Postcode/Zipcode</strong> : <?php echo e($user->zip_code); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('country') ): ?>
         <?php if(!empty($user->countrydata->country_name)): ?>
         <p class="text-black p-0 mb-1"><strong>Country</strong> : <?php echo e($user->countrydata->country_name); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('bussiness_address') ): ?>
         <?php if(!empty($user->business_address)): ?>
         <p class="text-black p-0 mb-1"><strong>Business Address</strong> : <?php echo e($user->business_address); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('city_business') ): ?>
         <?php if(!empty($user->city_business)): ?>
         <p class="text-black p-0 mb-1"><strong>Business Address City</strong> : <?php echo e($user->city_business); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('state_business') ): ?>
         <?php if(!empty($user->state_business)): ?>
         <p class="text-black p-0 mb-1"><strong>Business Address State</strong> : <?php echo e($user->state_business); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('zip_code_business') ): ?>
         <?php if(!empty($user->zip_code_business)): ?>
         <p class="text-black p-0 mb-1"><strong>Business Address Postcode/Zipcode</strong> : <?php echo e($user->zip_code_business); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('country_id_business') ): ?>
         <?php if(!empty($user->country_id_business)): ?>
         <p class="text-black p-0 mb-1"><strong>Business Address Country</strong> : <?php echo e($user->countryDataBusiness->country_name); ?></p>
         <?php endif; ?>
         <?php endif; ?>
         <?php if(have_permission('website') ): ?>
         <?php if(!empty($str_user_website)): ?>
         <p class="text-black p-0 mb-1"><strong>Website</strong> : 
           <a href="<?php echo e((strpos($str_user_website, 'http://') !== 0 && strpos($str_user_website, 'https://') !== 0 ) ? 'http://'.$str_user_website : $str_user_website); ?>" target="_blank"> <?php echo e(@$user->website); ?></a>
         </p>
         <?php endif; ?> 
         <?php endif; ?>
         <?php if($user->role == 3 || $user->role == 2 ): ?>
         <?php if(!empty($user->virtual_show_room)): ?>
         <p class="text-black p-0 mb-1"><strong>Virtual Show Room</strong> : <a target="_blank" href="<?php echo e($user->virtual_show_room); ?>"> View </a></p>
         <?php endif; ?>
         <?php endif; ?>
         <!-- <p class="text-black p-0 mb-1"><strong>City</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>State</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>Postcode/Zipcode</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>Country</strong> : Dynamic </p> -->
         <?php if(!empty($user->dobday) AND !empty($user->dobmonth)): ?>
         <p class="text-black p-0 mb-1"><strong>Date of birth</strong> : 
            <?php if(!empty($user->dobday)): ?>
            <?php echo e($user->dobday); ?>

            <?php endif; ?> 
            -
            <?php if(!empty($user->dobmonth)): ?>
            <?php echo e(get_month($user->dobmonth)); ?>

            <?php endif; ?>
         </p>
         <?php endif; ?>    
      </div>
   </div>
</div>
  <?php endif; ?> 