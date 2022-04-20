<!-- <table id="example" class="example table table-hover table-striped table-bordered"> -->
	<table id="example" class="example table table-striped kproductTbl">
    <thead class="titlestyle table-dark" style="background-color: #000;color: #fff;">
        <tr class="f17">
            <th>Name</th>
			<th>Email</th>
			<th>Plan</th>
			<th>Price</th>
			<th>Coupon Code</th>
			<th>Discount</th>
			<th>Price after Discount</th>
			<th>Status</th>
			<th>Subscribed Date</th>
			<th>Registered Date</th>
        </tr>
    </thead>

	<?php if(count($today_reports) > 0): ?>
    <tbody>
    	<?php if(count($today_reports) > 0): ?>
			<?php $__currentLoopData = $today_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
          <?php		  
		  $arr_price_data = @App\Helpers\UtilitiesTwo::get_discount_price_data($value->discount_value,  $value->discount_percent, $value->price);
		
		  $discount_per = @$arr_price_data[0]; 
		  $after_apply = @$arr_price_data[1];
		 ?>
				<tr>
				    <td class="verticalalign"><?php echo e(($value->name) ? $value->name : $value->first_name); ?></td>  
					<td class="verticalalign"><?php echo e($value->email); ?></td>
					<td class="verticalalign"><?php echo e(plan_name($value->plan_id)); ?></td>
					<td class="verticalalign">$<?php echo e($value->price); ?></td>
					<td class="verticalalign"><?php echo e($value->coupon_code); ?></td>
					<td class="verticalalign">$<?php echo e($discount_per); ?></td>
					<td class="verticalalign">$<?php echo e($after_apply); ?></td>
					
					<?php /*<td class="verticalalign">
						@if(@$value->gold == 1)
	                        Gold 
	                    @elseif(@$value->gold == 0)
	                        Active 
	                    @elseif(@$value->gold == 2)
	                        Canceled 
	                    @elseif(@$value->gold == 3)
	                        Refunded 
	                    @endif
					</td> */?>
					
					<td class="verticalalign">
						<?php if(@$value->status == 0 || empty(@$value->status)): ?>
	                        Pending 
	                    <?php elseif(@$value->status == 1 || @$value->status == 2): ?>
	                        Active 
	                    <?php elseif(@$value->status == 4): ?>
	                        Cancelled 
	                    <?php else: ?>
	                        Expired 
	                    <?php endif; ?>
					</td>
					
					<td class="verticalalign"><?php echo e(date('Y-m-d',strtotime($value->created_at))); ?></td>
					<td class="verticalalign"><?php echo e(date('Y-m-d',strtotime($value->users_created_at))); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>	
    </tbody>
    <?php else: ?>
	<tbody>
		<tr><td colspan="5">No reports</td></tr>
	</tbody>
    <?php endif; ?>
</table>	