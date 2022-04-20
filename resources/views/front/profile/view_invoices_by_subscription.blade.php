@if(!empty($invoices_data))
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
		
		@foreach($invoices_data as $invoices_data_row)
			<tr>
				<td><strong>
					@if(!empty(@$invoices_data_row->hosted_invoice_url))
						<a target="_blank" href="{{@$invoices_data_row->hosted_invoice_url}}">{{@$invoices_data_row->id}}</a>
					@else
						<a href="javascript:void(0);">{{@$invoices_data_row->id}}</a>
					@endif
				</strong></td>
				<td>${{number_format(@$invoices_data_row->total / 100,2)}}</td>
				<td>
				    @if($subscription->payment_status == 4)
				        {{@$endDate}}
				    @else
    				    {{@App\Helpers\UtilitiesFour::get_date_from_time_stamp(@$invoices_data_row->created)}}
				    @endif
			    </td>
				<td>
					@if(!empty(@$invoices_data_row->hosted_invoice_url))
						<a target="_blank" href="{{@$invoices_data_row->hosted_invoice_url}}">
					@else
						<a href="javascript:void(0);">
					@endif
						@if(@$invoices_data_row->status == 'paid') <span class="alert-success text-success status"><b>Paid</b></span>@elseif(@$invoices_data_row->status == 'open') <span class="alert-danger text-danger status"><b>Past due</b></span>@else<span class="alert-dark text-dark status"><b>{{ucwords(@$invoices_data_row->status)}}</b></span>@endif
					</a>
				</td>
			</tr>		
		@endforeach
		
		</table>
@endif							