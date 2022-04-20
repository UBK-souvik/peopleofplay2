@if($dest_id == 1)
   <select class="form-control select2" name="{{$page_type}}_meta[assign_profile_id]" aria-hidden="true" tabindex="-1">
                    <option value="">Select User Profile</option>
                    @foreach ($arr_user_data as $user_profile_row)
                      <option @if (!empty($int_profile_id) && ($int_profile_id == $user_profile_row->id)){{ 'selected' }}  @endif  value="{{$user_profile_row->id}}">
                      {{ $user_profile_row->text }}</option>
                    @endforeach
                     </select>
@endif

@if($dest_id == 2)
   <select class="form-control select2" name="{{$page_type}}_meta[assign_product_id]" aria-hidden="true" tabindex="-1">
                    <option value="">Select Product</option>
                    @foreach ($arr_product_data as $user_product_row)
                      <option @if (!empty($int_product_id) && ($int_product_id == $user_product_row->id)){{ 'selected' }}  @endif  value="{{$user_product_row->id}}">
                      {{ $user_product_row->text }}</option>
                    @endforeach
                     </select>
@endif