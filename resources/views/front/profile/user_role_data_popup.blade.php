<!-- <div class="row pt-2" id="teamsection">
        <div class="col-md-12">
            <h2 class="sidetitleProducttitle1">Roles</h2>
            <div class="py-2">
                <table class="table event_table">
                    <tbody>
                          <tr class="py-0">
                            <td class=" pl-0"><a href="#" class="span-style1 mb-1">1collab 43435435</a></td>
                            <td></td>
                            <td class=""><p class="mb-1" style="color: #000;">Inventor</p></td>
                        </tr>
                      </tbody>
                </table>
                    
            </div>
        </div>
    </div>	 -->
	
    @if(!empty($role_data) && count($role_data)>0)			
	@php	  
    $int_role_data_count = count($role_data);	  
	$int_role_data_count_flag = 0; 
	@endphp
        <div class="col-md-12">
          <div class="row sectionBox" >
            <h3 class="sec_head_text w-100">
             
            	@if(isset($user->role) && @$user->role ==3)
            	Who are your team members?
            	@else 
            	What are your industry roles?
            	@endif
     
            @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == @$user->id)
             <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Edit Industry Roles"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            @endif
         </h3>   
			{{-- $role_type_data_new --}}			  
			@if($int_role_data_count>5)				  			  
				@php                 
			$int_role_data_count_flag = 1;
             $str_role_data_main_div_id = 'user_role_data_loop_id_more_than_5';             
			@endphp	

			<div id="user_role_data_loop_id_more_than_5" style="display:none;">                      
			<!-- user roles loop -->	                @include("front.user.modules.user_role_data_loop")				                  
			</div>			  				  
			<div class="mt-3 w-100" id="user_role_collapse_div_id" style="display:none;">                         
			<span class="span-style1 see_full_list expand" onclick="show_more_than_5_user_roles(2);">                             << Collapse                         </span>                  </div>			 @endif	  			  		      
			@php                 
			 $int_role_data_count_flag = 0; $str_role_data_main_div_id = 'user_role_data_loop_id_less_than_5';             
			@endphp			     
			<div id="user_role_data_loop_id_less_than_5" class="w-100">                    
			<!-- user roles loop -->	             
			@include("front.user.modules.user_role_data_loop")				                 
			</div>	
			@if($int_role_data_count>5)	 			  
			 <div class="mt-3 w-100"  id="user_role_expand_div_id">                         
			 <span class="span-style1 see_full_list expand" onclick="show_more_than_5_user_roles(1);">                             
			 Expand >>                         </span>                  </div>			@endif  	  
          </div>
        </div>
		@endif


    
