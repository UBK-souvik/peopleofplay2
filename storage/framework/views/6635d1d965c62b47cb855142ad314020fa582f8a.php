<a href="#" class="span-style1" data-toggle="modal" data-target="#modal-contact-info-profile-popup">
            View Company name, E-mail & Phone <?php if(empty($user->id)): ?><?php echo e('on PopPro'); ?><?php endif; ?>
</a>
<?php $base_url = url('/'); ?>
<div class="modal fade" id="modal-contact-info-profile-popup">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header kbg_black">
            <div class="textContent">
               <h4 class="modal-title text-white">Contact Info</h4>
            </div>
            <button type="button" class="close text-white" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  
                  <p class="text-black p-0 mb-1"><strong>Company Name </strong> :
                    <?php if(!empty($user->inventorContactInfo->company_name)): ?>
                        <?php
                          $slug = '#';
                          $text   = $user->inventorContactInfo->company_name;  
                          if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                              $text = $abc->first_name." ".$abc->last_name; 
                              $slug = $abc->slug;  
                              $slug = App\Helpers\Utilities::get_user_url($base_url, $abc); 
                          }
                        ?>												<?php if($slug == "#"): ?>						  <?php echo e(@$text); ?>					    <?php else: ?>						  <a href="<?php echo e($slug); ?>" target="_blank" class="span-style1"><?php echo e(@$text); ?></a>						    <?php endif; ?>							
                    <?php endif; ?>
                  </p>
                  <p class="text-black p-0 mb-1"><strong>Company Email</strong> : <?php echo e(@$user->inventorContactInfo->company_email_id); ?></p>
                  <p class="text-black p-0 mb-1"><strong>Company Phone</strong> : <?php echo e(@$user->inventorContactInfo->company_phone); ?></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
       
	   
            <!-- <div id="modal-contact-info-profile-popup" class="modal fade">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content p-2"  >
                  <div class="modal-body p-2 allsideborder">
          			  <div class="">
                    <div class="row p-2">
            				  <div class="col-md-4">
                        <div class="form-group">
                          <label for="Agent Name"><strong>Agent Name</strong></label>
            			         <div><?php echo e(@$user->inventorContactInfo->agent_name); ?></div>
                        </div>
                        <div class="form-group">
                          <label for="AgentEmailID"><strong>Agent Email ID</strong></label>
                          <div><?php echo e(@$user->inventorContactInfo->agent_email_id); ?></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="Manager Name"><strong>Manager Name</strong></label>
                        <div class="form-group">
                          <div><?php echo e(@$user->inventorContactInfo->manager_name); ?></div>
                        </div>
                        <div class="form-group">
                          <label for="ManagerEmailID"><strong>Manager Email ID</strong></label>
                          <div><?php echo e(@$user->inventorContactInfo->manager_email_id); ?></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="CompanyName"><strong>Company Name</strong></label>
                          <div><?php echo e(@$user->inventorContactInfo->company_name); ?></div>
                        </div>
                        <div class="form-group">
                          <label for="CompanyEmailID"><strong>Company Email ID</strong></label>
                          <div><?php echo e(@$user->inventorContactInfo->company_email_id); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>          
                  </div>
                </div>
              </div>
            </div> --><!-- /.modal -->
			
          