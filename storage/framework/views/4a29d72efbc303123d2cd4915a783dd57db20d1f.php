<?php if(!empty($invoices_data)): ?>
<style>
	td .status{
		font-size: 13px;
		border-radius: 4px;
		padding: 2px 5px;
	}
</style>
<table class="table">
        <tr>
				<th>Invoice Id </strong></td>
				<th>Amount</td>
				<th>Date</td>
				<th>Status</td>
			</tr>  
		
		<?php $__currentLoopData = $invoices_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoices_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><strong>
					<?php if(!empty(@$invoices_data_row->hosted_invoice_url)): ?>
						<a target="_blank" href="<?php echo e(@$invoices_data_row->hosted_invoice_url); ?>"><?php echo e(@$invoices_data_row->id); ?></a>
					<?php else: ?>
						<a href="javascript:void(0);"><?php echo e(@$invoices_data_row->id); ?></a>
					<?php endif; ?>
				</strong></td>
				<td>$<?php echo e(number_format(@$invoices_data_row->total / 100,2)); ?></td>
				<td>
				    <?php if($subscription->payment_status == 4): ?>
				        <?php echo e(@$endDate); ?>

				    <?php else: ?>
    				    <?php echo e(@App\Helpers\UtilitiesFour::get_date_from_time_stamp(@$invoices_data_row->created)); ?>

				    <?php endif; ?>
			    </td>
				<td>
					<?php if(!empty(@$invoices_data_row->hosted_invoice_url)): ?>
						<a target="_blank" href="<?php echo e(@$invoices_data_row->hosted_invoice_url); ?>">
					<?php else: ?>
						<a href="javascript:void(0);">
					<?php endif; ?>
						<?php if(@$invoices_data_row->status == 'paid'): ?> <span class="alert-success text-success status"><b>Paid</b></span><?php elseif(@$invoices_data_row->status == 'open'): ?> <span class="alert-danger text-danger status"><b>Past due</b></span><?php else: ?><span class="alert-dark text-dark status"><b><?php echo e(ucwords(@$invoices_data_row->status)); ?></b></span><?php endif; ?>
					</a>
				</td>
			</tr>		
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
		</table>
<?php endif; ?>							