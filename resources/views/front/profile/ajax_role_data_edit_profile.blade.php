<!--Table-->

<table class="table kproductTbl RolePro">

    <thead class="titlestyle">

        <tr>

            <!-- <th></th> -->

            <th class="text-left pl-0">{{ $role_type_data_new }} Roles</th>

            @if($user->role == 2)

			  <th class="text-left">At</th>

            @endif

			<th class="text-left">Name</th>

            <!-- <th class="text-left">Description</th> 

            <th class="text-left">Date From</th>

            <th class="text-left">Date to</th> -->

            <th class="text-left">Edit</th>

            <th class="">Delete</th>

        </tr>

    </thead>

    <tbody class="tbody_productlist">

        @foreach ($user->roles ?? [] as $role)

		

            @php

              if(!empty($role->at) && $role->at>0)

              {

            	  $int_role_at = $role->at;  

              }

              else

              {

            	 $int_role_at = 1; 

              }



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

			  $str_user_name = @App\Helpers\Utilities::getUserName(@$role->people_data);	

			}

			else if($int_role_at == 5 && !empty(@$role->name))

			{

			  $str_user_name = @$role->name;

			}

			else

			{

			  $str_user_name = @$role->name;	

			}

			

			if(!empty($int_company_id))

			{

			  $str_company_name = @App\Helpers\Utilities::getUserName(@$role->company_data);	

			}

			else if($int_role_at == 2 && !empty(@$role->name))

			{

			  $str_company_name = @$role->name;

			}

			else

			{

			  $str_company_name = '';	

			}

			

			if(!empty($int_product_id))

			{

			  $str_product_name = @$role->product_data->name;	

			}

			else if($int_role_at == 1 && !empty(@$role->name))

			{

			  $str_product_name = @$role->name;

			}

			else

			{

			  $str_product_name = '';	

			}

			

            @endphp	  



                <tr>

                    <td class="verticalalign text-left pl-0">

                        <a class="span-style1" href="#">

                            @foreach(users_user_roles() as $role_key => $users_user_role)

                                @if($role_key == @$role->role)

                                    {{ $users_user_role }} 

                                @endif 

                            @endforeach

                        </a>

                    </td>

					@if($user->role == 2)

                       <td class="verticalalign text-left pl-0">{{$arr_role_at_list[$int_role_at]}}</td>

                    @endif

					<td class="verticalalign text-left pl-0">

					@if($int_role_at == 1)

					  {{$str_product_name}}

					@elseif($int_role_at == 2)

					  {{$str_company_name}}

					@elseif($int_role_at == 5)

					  {{$str_user_name}}

					@else

					  {{$str_user_name}} 

				    @endif

					</td>

                    <!-- <td class="verticalalign text-left pl-0">{{$role->description}}</td> -->

                    

					{{--  <td class="verticalalign text-left pl-0">

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

            		<td class="verticalalign text-left pl-0">

                        @if(!empty(@$to_day_str))

                            {{@$to_day_str}}

                        @endif

                        @if(!empty(@$to_month_str))

                            {{get_month(@$to_month_str)}}

                        @endif

                        @if(!empty(@$to_year_str))

                            {{@$to_year_str}}

                        @endif                           

                    </td> --}}

					

                    <td class="verticalalign text-left pl-0">

                        <span class="table-edit">

                            <a href="#edit-profile-roles-data-div" class="span-style1 my-0 edit-role-popup-class" data-role-name="{{$role->name}}" data-role-data="{{$role->role}}"  

            				data-role-auto-id="{{$role->id}}"  data-role-at-id="{{$role->at}}"  data-role-description="{{$role->description}}"

            				data-role-date-from="{{App\Helpers\Utilities::get_date_format($role->date_from)}}"  

                            

							data-people-id="{{$int_people_id}}"

							data-company-id="{{$int_company_id}}"

							data-product-id="{{$int_product_id}}"

							

							data-product-name="{{$str_product_name}}"

							data-company-name="{{$str_company_name}}"

							data-people-name="{{$str_user_name}}"

							

							

							data-from_day_str="{{$from_day_str}}"  

                            data-from_month_str="{{$from_month_str}}"  

                            data-from_year_str="{{$from_year_str}}"  

            				

                            data-role-date-to="{{App\Helpers\Utilities::get_date_format($role->date_to)}}"  

                            data-to_day_str="{{$to_day_str}}"  

                            data-to_month_str="{{$to_month_str}}"  

                            data-to_year_str="{{$to_year_str}}"  



            				data-toggle="modal" data-target="#addRoleModalDiv">Edit</a>

                        </span>

                    </td>

                    <td class="verticalalign text-center">

                        <span class="table-delete">

                            <a href="#edit-profile-roles-data-div" class="text-danger my-0" onclick="return deleteRoleDataModal({{$role->id}});">Delete</a>

                        </span>

                    </td>

                </tr>                

        @endforeach

    </tbody>

    <!--Table confirm('Are you sure you want to delete this item?'); body-->

</table>