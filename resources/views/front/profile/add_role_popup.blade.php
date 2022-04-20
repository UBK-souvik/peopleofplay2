<div class="modal" id="addRoleModalDiv">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header kbg_black">
            <div class="row p-2">
               <h4 >                
                  <span id="span-role-team-id-new"></span>
               </h4>
            </div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body p-3">
            <div class="">
               <form id="addRoleModalDivForm">
                  @csrf
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-6 pl-0">
                           <div class="form-group">
                              <label for="email">{{ ucfirst($role_type_data_new) }} Role:</label>
                              <select class="form-control" data-placeholder="Select" 
                                 name="add_edit_profile_role[role]" 
                                 id="add_edit_profile_role_data">
                                 <option value="">Select User Role</option>
                                 @foreach(users_user_roles() as $role_key => $users_user_role)
                                 <option value="{{$role_key}}" @if($role_key == @$role->role){{ "selected" }} @endif >{{ $users_user_role }} </option>
                                 @endforeach
                              </select>
                              <!-- <input id="add_edit_profile_role_data" type="text" class="form-control" placeholder="User Role" name="add_edit_profile_role[role]"> -->
                           </div>
                        </div>
                        @if($user->role == 3)
                        <!-- <input value="5" id="admin_add_edit_profile_role_at" type="hidden" class="form-control" name="admin_add_edit_profile_role[at]"> -->
                        <input value="5" id="admin_add_edit_profile_role_at" type="hidden" class="form-control" name="add_edit_profile_role[at]">
                        @else
                        <div class="col-md-6 px-0">
                           <div class="form-group">
                              <label for="pwd">At:</label>
                              <select  id="add_edit_profile_role_at" name="add_edit_profile_role[at]" class="form-control" data-placeholder="Select" onchange="return showProductCompany(this.value);">
                                 <option value="">Select At</option>
                                 @if(isset($arr_role_at_list)) 
                                 @foreach (@$arr_role_at_list as $arr_role_at_list_key => $arr_role_at_list_val)
                                 @if($user->role == 2 && $arr_role_at_list_key>2)
                                 @break
                                 @endif
                                 <option  value="{{$arr_role_at_list_key}}">{{ $arr_role_at_list_val }}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-12 px-0 d-none">
                           <div class="form-group">
                              <label for="pwd">Description:</label>
                              <!--  <input id="add_edit_profile_role_description" type="text" class="form-control" placeholder="Description" style="width:300px;" name="add_edit_profile_role[description]" value="sadas"> -->
                              <textarea  id="add_edit_profile_role_description" type="text" class="form-control" placeholder="Type your description" name="add_edit_profile_role[description]"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6 pl-0" id="div-people-list" @if($user->role == 3) style="display:block;" @else style="display:none;"  @endif>
                        <div class="form-group">
                           <label for="pwd">People:</label>
                           <input id="add_edit_profile_role_name_people_id" name="add_edit_profile_role[people_name]" class="form-control" >
                           <!-- <input id="add_edit_profile_role_name"  name="add_edit_profile_role[name]" type="text" class="form-control" placeholder="Name"> -->
                        </div>
                     </div>
                     <div class="col-md-6 pl-0" id="div-company-list" style="display:none;">
                        <div class="form-group">
                           <label for="pwd">Company:</label>
                           <input id="add_edit_profile_role_name_company_id" name="add_edit_profile_role[company_name]" class="form-control" style="width:300px;">
                        </div>
                     </div>
                     <div class="col-md-6 pl-0" id="div-product-list" style="display:none;">
                        <div class="form-group">
                           <label for="pwd">Product:</label>
                           <input id="add_edit_profile_role_name_product_id" name="add_edit_profile_role[product_name]" class="form-control" style="width:300px;">
                        </div>
                     </div>
                  </div>
            </div>
            {{--  <div class="col-md-12">
            <div class="row">
            <div class="col-md-6 pl-0">
            <label for="pwd">Date From: (Year is Mandatory)</label>
            <div class="form-group">
            {!! App\Helpers\TemplateFunctions::getDayDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[from_day]', 'add_edit_profile_role_from_day') !!}
            {!! App\Helpers\TemplateFunctions::getMonthDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[from_month]', 'add_edit_profile_role_from_month') !!}
            {!! App\Helpers\TemplateFunctions::getYearDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[from_year]', 'add_edit_profile_role_from_year') !!}
            <!-- <input id="add_edit_profile_role_from" type="date" class="form-control" placeholder="Date From" name="add_edit_profile_role[date_from]"> -->
            </div>
            </div>
            <div class="col-md-6 px-0">
            <label for="pwd">Date To: (Year is Mandatory)</label>
            <div class="form-group">
            <!-- <input id="add_edit_profile_role_to" type="date" class="form-control" placeholder="Date To" name="add_edit_profile_role[date_to]"> -->
            {!! App\Helpers\TemplateFunctions::getDayDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[to_day]', 'add_edit_profile_role_to_day') !!}
            {!! App\Helpers\TemplateFunctions::getMonthDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[to_month]', 'add_edit_profile_role_to_month') !!}
            {!! App\Helpers\TemplateFunctions::getYearDropDown(0, 'col-sm-3 dmy', 'add_edit_profile_role[to_year]', 'add_edit_profile_role_to_year') !!}
            </div>
            </div>
            </div>
            </div> --}}
            <input type="hidden"  id="add_edit_profile_role_product_hidden_id" name="add_edit_profile_role[product_hidden_id]">
            <input type="hidden"  id="add_edit_profile_role_company_hidden_id" name="add_edit_profile_role[company_hidden_id]">
            <input type="hidden"  id="add_edit_profile_role_people_hidden_id" name="add_edit_profile_role[people_hidden_id]">
            <input type="hidden"  id="add_edit_profile_role_hidden_id" name="add_edit_profile_role[role_id]">
            <button type="submit" class="btn btnAll addUpdateRoleBtn">Save</button>
            </form>
         </div>
      </div>
      <!-- <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div> -->
   </div>
</div>
</div>