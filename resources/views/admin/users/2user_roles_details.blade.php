	<div class="accordion__header">
        <h2>Innovator Roles</h2>
        <span class="accordion__toggle"></span>
    </div>
	
    <div class="accordion__body" id="user-roles-div-main-id">
	<div>
			<button type="button" class="btn btn-success add-link">+ Add More</button>				  
     </div>
        <style>
  #Four_Product .form-group{
        margin-bottom: 0;
      }
</style>
        <div  class="parent-row user_role">
			@php
				$role_div_id = 'Four_Product';
				$row_role_div_id = 'roleDivId';
				$row_role_at = 0;
				$row_date_from_str = '';
				$row_date_to_str = '';
				$int_role_id = 0;
			@endphp
		
		 	@include('admin.users.add_user_role_popup')
		</div>
		<span>
			@if(!empty($user->roles))
				@foreach ($user->roles ?? [] as $role)
					@php
						$int_role_id =  $role->id;
						$role_div_id = 'Four_Product'.$role->id;
						$row_role_div_id = 'roleDivId'.$role->id;
						$row_role_at = $role->at;
						//$row_date_from_str = App\Helpers\Utilities::get_date_format_new($role->date_from);
						$row_date_from_str = \Carbon\Carbon::parse($role->date_from)->format('Y-m-d');
						//$row_date_to_str = App\Helpers\Utilities::get_date_format_new($role->date_to);			   
						$row_date_to_str = \Carbon\Carbon::parse($role->date_to)->format('Y-m-d');
						//$row_date_to_str =  \Carbon\CarbonInterval::createFromDateString($role->date_to)->format('d-m-Y');


						$to_day_str = $role->to_day;
						$to_month_str = $role->to_month;
						$to_year_str = $role->to_year;

						$from_day_str = $role->from_day;
						$from_month_str = $role->from_month;
						$from_year_str = $role->from_year;



					@endphp
					<div  class="parent-row user_role">
	              		@include('admin.users.add_user_role_popup')
	              	</div>
			    @endforeach				
		    @endif


        </span>
        
		

        <!-- </span> -->
    </div>