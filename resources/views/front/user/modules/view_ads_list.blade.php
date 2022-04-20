@php
$str_side_class_name_new ='sidewidth';
$str_top_class_name_new ='row homesectionTitleBox top_banner_class py-0';
@endphp

@foreach($ajax_between_advertisement_data as $ajax_between_advertisement_data_row)                                	

    <!-- <div class="@if($int_position>1){{$str_side_class_name_new}}@else{{$str_top_class_name_new}}@endif"> 

		<a target="_blank" href="{{url('/ads/get-no-clicks/'.$ajax_between_advertisement_data_row->id)}}">

		<img src="{{@imageBasePath($ajax_between_advertisement_data_row->advertisement_image)}}" class="img-fluid text-center mb-2 imgadvertisementInner" width="100%">

			<p class="mt-0 mb-1"><span class="span-style1">{{$ajax_between_advertisement_data_row->sponsor_name}}</span></p>

		</a> 

	</div> -->

@endforeach				

@if(!empty($ajax_between_advertisement_data) && count($ajax_between_advertisement_data)>0)

  <!-- <hr> -->

@endif