<style>
  .user_role .form-group {
       margin-right: 0px; 
       margin-left: 0px; 
  }
  .UserbtnRemove{
    margin-top: 5px;
  }
  .rightMargin{
    margin-right: 5px;
  }
</style>

<div  class="row add-row" id="{{ $row_role_div_id }}">
    <div class="col-md-4">
      <div class="form-group">
        <label for="Collaborators Image">Innovator Role:</label>
          <select class="form-control" data-placeholder="Select" name="add_edit_profile_role[role][]" 
              id="add_edit_profile_role_data">
              <option value="">Select User Role</option>
              @foreach(users_user_roles() as $role_key => $users_user_role)
                  <option value="{{$role_key}}" @if($role_key == @$role->role){{ "selected" }} @endif >{{ $users_user_role }} </option>
              @endforeach
          </select>
      	  @if(!empty($role->id))
      	    <input id="add_edit_profile_role_hidden_id{{$role->id}}" value="@if(!empty($role->id)){{$role->id}}@endif" type="hidden" name="add_edit_profile_role[role_hidden_id][]">
      	  @endif
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="User Name">At:</label>
         <select  id="add_edit_profile_role_at" name="add_edit_profile_role[at][]" class="form-control" data-placeholder="Select">
    				<option value="">Select At</option>
    				@foreach ($arr_role_at_list as $arr_role_at_list_key => $arr_role_at_list_val)
    				<option @if($arr_role_at_list_key == $row_role_at){{ "selected" }} @endif value="{{$arr_role_at_list_key}}">{{ $arr_role_at_list_val }}</option>
    				@endforeach
                 </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="User Roles">Name:</label>
        <input id="add_edit_profile_role_name" value="@if(!empty($role->name)){{$role->name}}@endif"  name="add_edit_profile_role[name][]" type="text" class="form-control" placeholder="Name">
      </div>
    </div>

     <div class="row">
       <div class="col-md-12">
            <div class="col-md-4">
                <label for="pwd">Date From:</label>
                <div class="form-group">
                  <!-- <input id="add_edit_profile_role_from" value="@if(!empty($row_date_from_str)){{$row_date_from_str}}@endif" type="date" class="form-control" placeholder="Date From" name="add_edit_profile_role[date_from][]"> -->
                  <select class="col-sm-3 dmy f_day rightMargin" name="add_edit_profile_role[from_day][]">
                    @if(!empty(@$from_day_str))
                        <option value="{{@$from_day_str}}" selected="">{{@$from_day_str}}</option> 
                    @endif
                  </select>
                  <select class="col-sm-3 dmy f_month rightMargin" name="add_edit_profile_role[from_month][]">
                    @if(!empty(@$from_month_str))
                        <option value="{{@$from_month_str}}" selected="">{{@$from_month_str}}</option>
                    @endif
                  </select>
                  <select class="col-sm-3 dmy f_year" name="add_edit_profile_role[from_year][]">
                    @if(!empty(@$from_year_str))
                        <option value="{{@$user->dobyear}}" selected="">{{@$from_year_str}}</option>
                    @endif
                  </select>
                </div>
            </div>
            <div class="col-md-4">
              <label for="pwd">Date To:</label>
              <div class="form-group">
                <!-- <input id="add_edit_profile_role_to" value="@if(!empty($row_date_to_str)){{$row_date_to_str}}@endif" type="date" class="form-control" placeholder="Date To" name="add_edit_profile_role[date_to][]"> -->
                <select class="col-sm-3 dmy to_day rightMargin" name="add_edit_profile_role[to_day][]">
                  @if(!empty(@$to_day_str))
                      <option value="{{@$to_day_str}}" selected="">{{@$to_day_str}}</option> 
                  @endif
                </select>
                <select class="col-sm-3 dmy to_month rightMargin" name="add_edit_profile_role[to_month][]">
                  @if(!empty(@$to_month_str))
                      <option value="{{@$to_month_str}}" selected="">{{@$to_month_str}}</option>
                  @endif
                </select>
                <select class="col-sm-3 dmy to_year" name="add_edit_profile_role[to_year][]">
                  @if(!empty(@$to_year_str))
                      <option value="{{@$to_year_str}}" selected="">{{@$to_year_str}}</option>
                  @endif
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="User Roles">Description:</label>
                <input id="add_edit_profile_role_description" value="@if(!empty($role->description)){{$role->description}}@endif" type="text" class="form-control" placeholder="Description" name="add_edit_profile_role[description][]">
              </div>
            </div>
        </div>
     </div>

    <div class="col-md-1">
      <div class="form-group">
        <label for="User Roles" >Action</label>

        <button type="button" 
              class="btn btn-danger UserbtnRemove  @if(empty($role->id)) {{"remove-link"}} @endif" @if(!empty($role->id)) onclick="return delete_role_ajax({{ $role->user_id }}, {{ $role->id }});" @endif>- Remove
        </button> 
      </div>
    </div>
</div>