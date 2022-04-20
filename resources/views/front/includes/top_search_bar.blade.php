@php

    $arr_top_search_types_list = App\Helpers\Utilities::get_top_search_types_list();  

    // for a desk top 
    if(!empty($int_is_desk_top_search_flag_new))
	{
	    $str_search_div_style_new = 'width: 530px;';
			
		$str_search_select_box_id_new = 'resizing_select_mainSearch_Desk';
		
		$str_search_select_box_name_new = 'resizing_select_mainSearch_Desk_Name';
	
		$str_width_search_select_box_id_new = 'width_tmp_select_main_search_Desk';	
		
		$str_option_search_select_box_id_new = 'width_tmp_option_main_search_Desk';
		
		$str_search_box_id_new = 'home-site-search-input';
		
		$str_search_box_name_new = 'home-site-search-text-name';
	}
	else
	{	
		$str_search_div_style_new = '';		
	
		$str_search_select_box_id_new = 'resizing_select_mainSearch';
		
		$str_search_select_box_name_new = 'resizing_select_mainSearch_Name';
		
		$str_width_search_select_box_id_new = 'width_tmp_select_main_search';
		
		$str_option_search_select_box_id_new = 'width_tmp_option_main_search';

        $str_search_box_id_new = 'home-site-search-input-mobile';
		
		$str_search_box_name_new = 'home-site-search-input-mobile';
			
	}

@endphp

<div class="d-flex myMainSearchWrap">
  <div class="mySelectBoxSearchWrap">
     <select class="mySelectBoxSearch" id="{{$str_search_select_box_id_new}}" name="{{$str_search_select_box_name_new}}">
	 
	     @foreach ($arr_top_search_types_list as $arr_top_search_types_list_key => $arr_top_search_types_list_val)
		  <option @if(!empty($int_search_dd_val_desk_new) && $int_search_dd_val_desk_new == $arr_top_search_types_list_key) {{'selected'}} @endif value="{{$arr_top_search_types_list_key}}">{{ $arr_top_search_types_list_val }} @if($arr_top_search_types_list_key == 2)&nbsp;&nbsp;&nbsp;@endif</option>
          @endforeach
     </select>
     <select class="" id="{{$str_width_search_select_box_id_new}}">
        <option id="{{$str_option_search_select_box_id_new}}"></option>
     </select>
  </div>
 <div class="w-100 SearchBar">
 	<div class="search-box">
     <input type="text" value="@if(!empty($search_data)){{@$search_data}}@endif" id="{{$str_search_box_id_new}}" name="{{$str_search_box_name_new}}" class="form-control may_main_searc_inputBoxSearch  top-search-bar-class-new " placeholder="Search POP">
	 </div>
	 <img src="{{ asset('front/images/search.png') }}" alt="lego_toys_img" id="SearchBarIcon" class="img-fluid">
  </div>
</div>

