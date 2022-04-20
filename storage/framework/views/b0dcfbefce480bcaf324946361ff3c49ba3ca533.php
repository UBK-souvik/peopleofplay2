<!--Table-->

<table class="table kproductTbl RolePro">

    <thead class="titlestyle">

        <tr>

            <!-- <th></th> -->

            <th class="text-left pl-0"><?php echo e($role_type_data_new); ?> Roles</th>

            <?php if($user->role == 2): ?>

			  <th class="text-left">At</th>

            <?php endif; ?>

			<th class="text-left">Name</th>

            <!-- <th class="text-left">Description</th> 

            <th class="text-left">Date From</th>

            <th class="text-left">Date to</th> -->

            <th class="text-left">Edit</th>

            <th class="">Delete</th>

        </tr>

    </thead>

    <tbody class="tbody_productlist">

        <?php $__currentLoopData = $user->roles ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		

            <?php

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

			

            ?>	  



                <tr>

                    <td class="verticalalign text-left pl-0">

                        <a class="span-style1" href="#">

                            <?php $__currentLoopData = users_user_roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_key => $users_user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($role_key == @$role->role): ?>

                                    <?php echo e($users_user_role); ?> 

                                <?php endif; ?> 

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </a>

                    </td>

					<?php if($user->role == 2): ?>

                       <td class="verticalalign text-left pl-0"><?php echo e($arr_role_at_list[$int_role_at]); ?></td>

                    <?php endif; ?>

					<td class="verticalalign text-left pl-0">

					<?php if($int_role_at == 1): ?>

					  <?php echo e($str_product_name); ?>


					<?php elseif($int_role_at == 2): ?>

					  <?php echo e($str_company_name); ?>


					<?php elseif($int_role_at == 5): ?>

					  <?php echo e($str_user_name); ?>


					<?php else: ?>

					  <?php echo e($str_user_name); ?> 

				    <?php endif; ?>

					</td>

                    <!-- <td class="verticalalign text-left pl-0"><?php echo e($role->description); ?></td> -->

                    

					

					

                    <td class="verticalalign text-left pl-0">

                        <span class="table-edit">

                            <a href="#edit-profile-roles-data-div" class="span-style1 my-0 edit-role-popup-class" data-role-name="<?php echo e($role->name); ?>" data-role-data="<?php echo e($role->role); ?>"  

            				data-role-auto-id="<?php echo e($role->id); ?>"  data-role-at-id="<?php echo e($role->at); ?>"  data-role-description="<?php echo e($role->description); ?>"

            				data-role-date-from="<?php echo e(App\Helpers\Utilities::get_date_format($role->date_from)); ?>"  

                            

							data-people-id="<?php echo e($int_people_id); ?>"

							data-company-id="<?php echo e($int_company_id); ?>"

							data-product-id="<?php echo e($int_product_id); ?>"

							

							data-product-name="<?php echo e($str_product_name); ?>"

							data-company-name="<?php echo e($str_company_name); ?>"

							data-people-name="<?php echo e($str_user_name); ?>"

							

							

							data-from_day_str="<?php echo e($from_day_str); ?>"  

                            data-from_month_str="<?php echo e($from_month_str); ?>"  

                            data-from_year_str="<?php echo e($from_year_str); ?>"  

            				

                            data-role-date-to="<?php echo e(App\Helpers\Utilities::get_date_format($role->date_to)); ?>"  

                            data-to_day_str="<?php echo e($to_day_str); ?>"  

                            data-to_month_str="<?php echo e($to_month_str); ?>"  

                            data-to_year_str="<?php echo e($to_year_str); ?>"  



            				data-toggle="modal" data-target="#addRoleModalDiv">Edit</a>

                        </span>

                    </td>

                    <td class="verticalalign text-center">

                        <span class="table-delete">

                            <a href="#edit-profile-roles-data-div" class="text-danger my-0" onclick="return deleteRoleDataModal(<?php echo e($role->id); ?>);">Delete</a>

                        </span>

                    </td>

                </tr>                

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

    <!--Table confirm('Are you sure you want to delete this item?'); body-->

</table>