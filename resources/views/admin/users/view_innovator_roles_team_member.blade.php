<div class="accordion__header">
                                    <h2>
									@php
									$str_role_type_new = '';
									if($user->role ==2)
									{
									  $str_role_type_new = 'Innovator'; 
									}
									
									if($user->role ==3)
									{
									  $str_role_type_new = 'Team Member'; 
									}
									
									@endphp
									
									{{$str_role_type_new}}
									
									Roles</h2>
                                    <span class="accordion__toggle"></span>
                                </div>

                                <div class="accordion__body">
                                    <table class="table table-striped table-bordered no-margin">
                                        <thead class="titlestyle table-dark">
                                            <tr>
                                                <th class="text-left">{{$str_role_type_new}} Role</th>
                                                <th class="text-left">At</th>
                                                <th class="text-left">Name</th>
                                                <!-- <th class="text-left">Date From</th>
                                                <th class="text-left">Date To</th>
                                                <th class="text-left">Description</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($role_data))
                                                @foreach ($role_data as $role)
                                                    @php
                                                        $int_role_id =  $role->id;
                                                        $role_div_id = 'Four_Product'.$role->id;
                                                        $row_role_div_id = 'roleDivId'.$role->id;
                                                        $row_role_at = $role->at;

                                                        $to_day_str = $role->to_day;
                                                        $to_month_str = $role->to_month;
                                                        $to_year_str = $role->to_year;

                                                        $from_day_str = $role->from_day;
                                                        $from_month_str = $role->from_month;
                                                        $from_year_str = $role->from_year;
														
														$int_people_id = $role->people_id;
														$int_company_id = $role->company_id;
														$int_product_id = $role->product_id;
														
														if(!empty($int_people_id))
														{
														  $str_user_name = @$role->people_name;	
														}
														else
														{
														  $str_user_name = @$role->name;	
														}
														
														if(!empty($int_company_id))
														{
														  $str_company_name = @$role->company_name;	
														}
														else
														{
														  $str_company_name = '';	
														}
														
														if(!empty($int_product_id))
														{
														  $str_product_name = @$role->product_name;	
														}
														else
														{
														  $str_product_name = '';	
														}

                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            @foreach(users_user_roles() as $role_key => $users_user_role)
                                                                @if($role_key == @$role->role)
                                                                    {{ $users_user_role }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($arr_role_at_list as $arr_role_at_list_key => $arr_role_at_list_val)
                                                                @if($arr_role_at_list_key == $row_role_at)
                                                                    {{ $arr_role_at_list_val }}
                                                                @endif 
                                                            @endforeach
                                                        </td>
                                                        <td>{{@$str_user_name}}</td>
                                                        
														{{-- <td>
                                                            @if(!empty(@$from_day_str))
                                                                {{@$from_day_str}} 
                                                            @endif
                                                            @if(!empty(@$from_month_str))
                                                                {{get_month(@$from_month_str)}}
                                                            @endif
                                                            @if(!empty(@$from_year_str))
                                                                {{@$from_year_str}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty(@$to_day_str))
                                                                {{@$to_day_str}} 
                                                            @endif
                                                            @if(!empty(@$to_month_str))
                                                                {{get_month(@$to_month_str)}}
                                                            @endif
                                                            @if(!empty(@$to_year_str))
                                                                {{@$to_year_str}}
                                                            @endif
                                                        </td>
                                                        <td>@if(!empty($role->description)){{$role->description}}@endif</td>
														--}}
                                                    
													</tr>
                                                @endforeach             
                                            @endif
                                        </tbody>
                                    </table>
                                </div> 