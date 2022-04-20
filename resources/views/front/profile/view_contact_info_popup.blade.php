<a href="#" class="span-style1" data-toggle="modal" data-target="#modal-contact-info-profile-popup">
            View Company name, E-mail & Phone @if(empty($user->id)){{ 'on PopPro' }}@endif
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
                  {{--
                      <p class="text-black p-0 mb-1"><strong>Agent Name</strong> : 
                          @if(!empty($user->inventorContactInfo->agent_name))
                              @php
                                $slug = '#';
                                $text   = $user->inventorContactInfo->agent_name;  
                                if($abc = \App\Models\User::find($user->inventorContactInfo->agent_name)){
                                    $text = $abc->first_name." ".$abc->last_name;  
                                    $slug = App\Helpers\Utilities::get_user_url($base_url, $abc);
                                    $slug = $abc->slug;  
                                }
                              @endphp
                              <a href="{{$slug}}" class="span-style1">
                                      {{$text}}
                              </a>
                          @endif
                      </p>
                      <p class="text-black p-0 mb-1"><strong>Agent Email </strong> : {{ @$user->inventorContactInfo->agent_email_id }}</p>
                      <p class="text-black p-0 mb-1"><strong>Manager Name </strong> : 
                        @if(!empty($user->inventorContactInfo->manager_name))
                              @php
                                $slug = '#'; 
                                $text   = $user->inventorContactInfo->manager_name;  
                                if($abc = \App\Models\User::find($user->inventorContactInfo->manager_name)){
                                    $text = $abc->first_name." ".$abc->last_name;  
                                     $slug = $abc->slug;  
                                     $slug = App\Helpers\Utilities::get_user_url($base_url, $abc);
                                }
                              @endphp
                              <a href="{{$slug}}" class="span-style1">{{ @$text }}</a>
                          @endif
                      </p>
                      <p class="text-black p-0 mb-1"><strong>Manager Email </strong> :
                          {{ @$user->inventorContactInfo->manager_email_id }}
                      </p>
                  --}}
                  <p class="text-black p-0 mb-1"><strong>Company Name </strong> :
                    @if(!empty($user->inventorContactInfo->company_name))
                        @php
                          $slug = '#';
                          $text   = $user->inventorContactInfo->company_name;  
                          if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                              $text = $abc->first_name." ".$abc->last_name; 
                              $slug = $abc->slug;  
                              $slug = App\Helpers\Utilities::get_user_url($base_url, $abc); 
                          }
                        @endphp												@if($slug == "#")						  {{ @$text }}					    @else						  <a href="{{$slug}}" target="_blank" class="span-style1">{{ @$text }}</a>						    @endif							
                    @endif
                  </p>
                  <p class="text-black p-0 mb-1"><strong>Company Email</strong> : {{@$user->inventorContactInfo->company_email_id }}</p>
                  <p class="text-black p-0 mb-1"><strong>Company Phone</strong> : {{@$user->inventorContactInfo->company_phone }}</p>
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
            			         <div>{{ @$user->inventorContactInfo->agent_name }}</div>
                        </div>
                        <div class="form-group">
                          <label for="AgentEmailID"><strong>Agent Email ID</strong></label>
                          <div>{{ @$user->inventorContactInfo->agent_email_id }}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="Manager Name"><strong>Manager Name</strong></label>
                        <div class="form-group">
                          <div>{{ @$user->inventorContactInfo->manager_name }}</div>
                        </div>
                        <div class="form-group">
                          <label for="ManagerEmailID"><strong>Manager Email ID</strong></label>
                          <div>{{ @$user->inventorContactInfo->manager_email_id }}</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="CompanyName"><strong>Company Name</strong></label>
                          <div>{{ @$user->inventorContactInfo->company_name }}</div>
                        </div>
                        <div class="form-group">
                          <label for="CompanyEmailID"><strong>Company Email ID</strong></label>
                          <div>{{@$user->inventorContactInfo->company_email_id }}</div>
                        </div>
                      </div>
                    </div>
                  </div>          
                  </div>
                </div>
              </div>
            </div> --><!-- /.modal -->
			
          