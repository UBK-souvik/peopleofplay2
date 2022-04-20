<div class="accordion__header">
        <h2>Professional Contact</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body">
      {{--
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Agent Name<i class="has-error"></i></label>
          <div class="col-sm-6">
              <select class="form-control select-ajax py-3" data-select2-tags="true" name="contact_info[agent_name]" >
                  @if(!empty($user->inventorContactInfo->agent_name))
                    @php
                      $value  = $user->inventorContactInfo->agent_name;  
                      $text   = $user->inventorContactInfo->agent_name;  
                      if($abc = \App\Models\User::find($user->inventorContactInfo->agent_name)){
                          $value = $abc->id;  
                          $text = $abc->first_name." ".$abc->last_name;  
                      }
                    @endphp
                    <option value="{{$value}}" selected>{{$text}}</option>
                  @endif  
              </select>
             <!-- <input id="AgentName" type="text" required name="contact_info[agent_name]" value="" class="form-control select-ajax" placeholder=""> -->
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Agent Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="AgentEmailID" type="email"
              name="contact_info[agent_email_id]" required
              value="@if(!empty($user->inventorContactInfo->agent_email_id)){{ @$user->inventorContactInfo->agent_email_id }} @endif"
              class="form-control">
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Manager Name<i class="has-error"></i></label>
          <div class="col-sm-6">
              <select class="form-control select-ajax py-3" data-select2-tags="true" name="contact_info[manager_name]" >  
                @if(!empty($user->inventorContactInfo->manager_name))
                    @php
                      $value  = $user->inventorContactInfo->manager_name;  
                      $text   = $user->inventorContactInfo->manager_name;  
                      if($abc = \App\Models\User::find($user->inventorContactInfo->manager_name)){
                          $value = $abc->id;  
                          $text = $abc->first_name." ".$abc->last_name;  
                      }
                    @endphp
                    <option value="{{$value}}" selected>{{$text}}</option>
                @endif
              </select>
             <!-- <input id="ManagerName" required type="text" class="form-control"
              value="@if(!empty($user->inventorContactInfo->manager_name)){{@$user->inventorContactInfo->manager_name}}@endif" name="contact_info[manager_name]" placeholder=""> -->
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Manager Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input  id="ManagerEmailID" type="email" 
              value="@if(!empty($user->inventorContactInfo->manager_email_id)){{@$user->inventorContactInfo->manager_email_id}}@endif"
              name="contact_info[manager_email_id]" required="required"
              class="form-control" placeholder="">
          </div>
       </div>
      --}}


       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Name<i class="has-error"></i></label>
          <div class="col-sm-6">
              <select class="form-control select-ajax py-3" data-select2-tags="true" name="contact_info[company_name]" >  
                @if(!empty($user->inventorContactInfo->company_name))
                    @php
                      $value  = $user->inventorContactInfo->company_name;  
                      $text   = $user->inventorContactInfo->company_name;  
                      if($abc = \App\Models\User::find($user->inventorContactInfo->company_name)){
                          $value = $abc->id;  
                          $text = $abc->first_name." ".$abc->last_name;  
                      }
                    @endphp
                    <option value="{{$value}}" selected>{{$text}}</option>
                @endif
              </select>
             <!-- <input id="CompanyName" type="text" name="contact_info[company_name]"
              required="required" value="@if(!empty($user->inventorContactInfo->company_name)){{@$user->inventorContactInfo->company_name}}@endif"
              class="form-control" placeholder=""> -->
          </div>
       </div>
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="CompanyEmailID" type="email"  class="form-control"
              value="@if(!empty($user->inventorContactInfo->company_email_id)){{@$user->inventorContactInfo->company_email_id}}@endif"
              name="contact_info[company_email_id]" required="required"
              placeholder="">
          </div>
       </div>

       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Company Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="CompanyEmailID" type="number"  class="form-control" value="@if(!empty($user->inventorContactInfo->company_phone)){{@$user->inventorContactInfo->company_phone}}@endif"
              name="contact_info[company_phone]" required="required"
              placeholder="">
          </div>
       </div>
    </div>