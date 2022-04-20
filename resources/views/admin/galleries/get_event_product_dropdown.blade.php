@if($data_type == 2)
   <select name="gallery_meta[assign_product_id]" class="form-control" data-placeholder="Select">
                    <option value="">Select Product</option>
                    @foreach ($user_product_data as $user_product_row)
                      <option @if (!empty($int_assign_product_id) && ($int_assign_product_id == $user_product_row->id)){{ 'selected' }}  @endif  value="{{$user_product_row->id}}">
                      {{ $user_product_row->name }}</option>
                    @endforeach
                     </select>
@endif
 
@if($data_type == 3)					 
					 <select name="gallery_meta[assign_event_id]"  class="form-control" data-placeholder="Select">
                    <option value="">Select Event</option>
                    @foreach ($user_event_data as $user_event_row)
                      <option @if (!empty($int_assign_event_id) && ($int_assign_event_id == $user_event_row->id)){{ 'selected' }}  @endif  value="{{$user_event_row->id}}">
                      {{ $user_event_row->name }}</option>
                    @endforeach
                    </select>
@endif					