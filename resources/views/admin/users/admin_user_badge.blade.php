@php 
  $arr_badges_list = @App\Helpers\UtilitiesTwo::get_batch_list_data();
@endphp

@foreach($arr_badges_list as $arr_badges_list_row)

@php
  $int_batch_id = $arr_badges_list_row;  
  $str_badge_name = 'badge_' . $int_batch_id;
  $str_badge_caption = 'badge_' . $int_batch_id . '_caption';
@endphp

<div class="form-group">
          <label for="profile_image" class="col-sm-2 control-label">Badge Image {{$int_batch_id}}<i class="has-error"></i></label>
          <div class="col-sm-6">
              <img id="badge-blah-image-{{$int_batch_id}}" src="{{@imageBasePath(@$user->$str_badge_name)}}" alt="" class="twoFiftySeven">
			@if(!empty($user->$str_badge_name))
            @else
              <!-- <img id="profile-blah-image" src="{{url('front/new/images/10.png')}}" alt="" class="twoFiftySeven"> -->
            @endif
            <input id="file-uploadten-{{$int_batch_id}}" accept="image/*" onchange="readBadgeURL(this, {{$int_batch_id}});" type="file" name="{{$str_badge_name}}" class="marginTopFive">
            <h4 class="text-danger ">Note: Please upload image up to {{App\Helpers\UtilitiesTwo::get_max_upload_image_size()}} only</h4>
          </div>
       </div>

<div class="form-group">
          <label for="badge_caption" class="col-sm-2 control-label">Badge Caption {{$int_batch_id}}<i class="has-error"></i></label>
          <div class="col-sm-6">
            <input id="text-badge-caption-{{$int_batch_id}}" type="text" name="{{$str_badge_caption}}" value="{{@$user->$str_badge_caption}}" class="form-control">
          </div>
       </div>	   
@endforeach