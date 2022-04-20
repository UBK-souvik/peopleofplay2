<?php
	$base_url = url('/'); 
	$def_user_image_path = App\Helpers\Utilities::get_default_image();
	$int_chk_is_event_product_flag = 0;
	if (!empty($request->country_id)) {
		foreach($countries as $id => $name){
			$search_data .= ($id == @$request->country_id) ? $name : '' ;
		}
	}
    if(empty($search_data))	{
	  $search_data .= (!empty(@$request->state) ) ? ' '.@$request->state : '' ;	}	else	{	  $search_data .= (!empty(@$request->state) ) ? ', '.@$request->state : '' ;		}		if(empty($search_data))	{
	 $search_data .= (!empty(@$request->city) ) ?  ' '.@$request->city : '' ;    }	else	{	  $search_data .= (!empty(@$request->city) ) ?  ', '.@$request->city : '' ;		}

	if(!empty($request->collab_user_role)) {
		foreach(users_user_roles() as $key => $value){						if(empty($search_data))	        {			  $search_data .= (@$request->collab_user_role == $key) ? ' '.$value : '' ;				}		    else			{			  $search_data .= (@$request->collab_user_role == $key) ? ', '.$value : '' ;				}
		}
	}
	if(isset($request->skills) && !empty($request->skills)) {				if(empty($search_data))		{
		  $search_data .= (!empty(@$request->skills) ) ? ' '.@$request->skills : '' ;		}		else		{		  $search_data .= (!empty(@$request->skills) ) ? ', '.@$request->skills : '' ;			}
	}
	
	if(isset($request->keyword_text_search) && !empty($request->keyword_text_search)) {				
	if(empty($search_data))		{
		  $search_data .= (!empty(@$request->keyword_text_search) ) ? ' '.@$request->keyword_text_search : '' ;		}		else		{		  $search_data .= (!empty(@$request->keyword_text_search) ) ? ', '.@$request->keyword_text_search : '' ;			}
	}
?>
<style>
	.select2.select2-container{
		min-width: 240px!important;
	}
	.select2.select2-container.select2-container--default{
		min-width: 240px!important;
	}
</style>
<div class="wrap-text text-white">
		<?php if(count($result_data) > 0): ?>
    	<p class="m-0" style="font-size: 25px;">Results for <b>" <?php echo e($search_data); ?> "</b></p>
		<?php else: ?>
    	<p class="m-0" style="font-size: 25px;">No results found for <b>" <?php echo e($search_data); ?> "</b></p>
		<?php endif; ?>
</div>

<?php $__currentLoopData = $slug_prefix_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug_prefix_list_key => $slug_prefix_list_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php $__currentLoopData = $slug_prefix_list_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug_prefix_list_child_key => $slug_prefix_list_child_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(in_array($slug_prefix_list_key, $arr_type_new)>0 && in_array($slug_prefix_list_child_key, $arr_slug_prefix_new)>0): ?>
		<div class="row
		">
            <div class="col-md-12">
                <h2 class="sidetitleProducttitle1"><?php echo e($slug_prefix_list_child_val['type']); ?></h2>
                <table class="table event_table AdvanceSearch">
                	<tbody>
						<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    <?php
								$get_search_url_data = '';


								$str_title = $result_data_row->name;
								$str_slug_prefix_data = $result_data_row->slug_prefix;
								$str_slug_data = $result_data_row->slug;
								//$int_data_type_index = $result_data_row->data_type_index;
								$int_type_data = $result_data_row->type;
								$get_search_url_data = App\Helpers\Utilities::get_search_url_data($base_url, $int_type_data, $str_slug_prefix_data, $str_slug_data);
								$int_chk_flag = 0;

								if($int_type_data == 1 && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == $slug_prefix_list_child_key)) //{{--   --}}
								{	   
								$int_chk_flag = 1;   
								}
								elseif(($int_type_data == 2 || $int_type_data == 3) && ($slug_prefix_list_key == $int_type_data) && ($str_slug_prefix_data == 'product' || $str_slug_prefix_data == 'event')) //{{--   --}}
								{   
								$int_chk_flag = 1;
								$int_chk_is_event_product_flag = 1;
								}
								else                        
								{   
								$int_chk_flag = 0;
								}	

								if($int_chk_is_event_product_flag>0)
								{
								$str_media_data = @prodEventImageBasePath($result_data_row->image);
								}	 
								else
								{
								$str_media_data = @imageBasePath($result_data_row->image);	 
								}
						    ?>
							
							<?php if(!empty($int_chk_flag)): ?>						  
							  
									<tr class="py-0">
										<td class="pl-0" style="width:50px;"><a target="blank" href="<?php echo e($get_search_url_data); ?>" class="dac_name">
										<?php if(!empty($str_media_data)): ?>
										  <img src="<?php echo e($str_media_data); ?>" class="rounded-circle">
									    <?php endif; ?>
										
										</a></td>
										<td class=""><a target="blank" href="<?php echo e($get_search_url_data); ?>" class="dac_name"><?php echo e($str_title); ?></a></td>
										<!-- <td class=""><a href="#" class="dac_name">Irrfan Khan (Actor, The Lunchbox (2013))</a> <p class="m-0">aka "Irfan"</p></td> -->
									</tr>
									
	                        <?php endif; ?>                             
				        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			
			   
						<!-- <tr class="py-0">
						<td class="pl-0"><img src="http://52.66.150.6/front/new/images/Product/team.png" class="rounded-circle "></td>
						<td class=""><a href="#" class="dac_name">Irfan Ahmed Syed (Actor, Saaho (2019))</a><p class="m-0">Company</p></td>
						</tr> -->
                	</tbody>
        		</table>
            	<!-- <p class="my-2">View:  <a href="#" class="span-style1">More name matches</a>  or  <a href="#" class="span-style1">Exact name matches</a></p> -->
            </div>
    	</div>							
     <?php endif; ?>   
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	


