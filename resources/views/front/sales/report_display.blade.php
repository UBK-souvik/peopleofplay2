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

	@if(count($today_reports) > 0)
    <tbody>
    	@if(count($today_reports) > 0)
			@foreach($today_reports as $key => $value)
			
          @php		  
		  $arr_price_data = @App\Helpers\UtilitiesTwo::get_discount_price_data($value->discount_value,  $value->discount_percent, $value->price);
		
		  $discount_per = @$arr_price_data[0]; 
		  $after_apply = @$arr_price_data[1];
		 @endphp
				<tr>
				    <td class="verticalalign">{{($value->name) ? $value->name : $value->first_name }}</td>  
					<td class="verticalalign">{{$value->email}}</td>
					<td class="verticalalign">{{plan_name($value->plan_id)}}</td>
					<td class="verticalalign">${{$value->price}}</td>
					<td class="verticalalign">{{$value->coupon_code}}</td>
					<td class="verticalalign">${{$discount_per}}</td>
					<td class="verticalalign">${{$after_apply}}</td>
					
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
						@if(@$value->status == 0 || empty(@$value->status))
	                        Pending 
	                    @elseif(@$value->status == 1 || @$value->status == 2)
	                        Active 
	                    @elseif(@$value->status == 4)
	                        Cancelled 
	                    @else
	                        Expired 
	                    @endif
					</td>
					
					<td class="verticalalign">{{date('Y-m-d',strtotime($value->created_at))}}</td>
					<td class="verticalalign">{{date('Y-m-d',strtotime($value->users_created_at))}}</td>
				</tr>
			@endforeach
		@endif	
    </tbody>
    @else
	<tbody>
		<tr><td colspan="5">No reports</td></tr>
	</tbody>
    @endif
</table>	