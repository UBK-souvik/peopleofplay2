@php

$int_list_id = 0;

$int_list_id = @$list->id;

$base_url = url('/');
if(!empty($list->type) && ($list->type ==1 || $list->type ==4))
{
	$str_name_data = @App\Helpers\Utilities::getUserName($list->inventor);
	$str_image_path = @imageBasePath($list->inventor->profile_image);
	$str_description = @$list->inventor->description;
	$int_row_id = @$list->inventor->id;

  $user_current_info_new = @$list->inventor;
  $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);
  $redirect = $str_user_url_new;
}
if(!empty($list->type) && $list->type ==2)
{
	$str_name_data = @$list->product->name;
	$str_image_path = @prodEventImageBasePath($list->product->main_image);
	$str_description = @$list->product->description;
	$int_row_id = @$list->product->id;
  $redirect = @$base_url.'/product/'. @$list->product->slug;
}
if(!empty($list->type) && $list->type ==3)
{	
	$str_name_data = @$list->event->name;
	$str_image_path = @prodEventImageBasePath($list->event->main_image);
	$str_description = @$list->event->description;	
	$int_row_id = @$list->event->id;
  $redirect = @$base_url.'/event/'.@$list->event->slug;
}if(!empty($list->type) && $list->type ==5){	$str_name_data = @$list->brands_list->name;	$str_image_path = @prodEventImageBasePath($list->brands_list->main_image);	$str_description = @$list->brands_list->description;	$int_row_id = @$list->brands_list->id;  $redirect = @$base_url.'/brand/'. @$list->brands_list->slug;}

$str_description_short = @substr($str_description, 0, 200);
$str_remove_watch_list_link = route('front.pages.remove_from_watch_list', $int_list_id);

@endphp
  <a href="{{@$redirect}}">
    <div class="kbox_wrap_inner d-flex justify-content-start p-2 first_box boxWidth">
       <div class="mr-2">
          <img class="awardNomineeImg" src="{{$str_image_path}}">
       </div>
       <div class="pull-left w-100">
          <div class="w-100 d-flex justify-content-start">
            <div class="popFavInner">
              <p class="mb-0 mr-2"> <a href="{{@$redirect}}" class="alinks_header">{{$str_name_data}}</a></p>
            </div>
            <div class="pull-right popFavnner">
              <a class="text-danger removeWatchList" type="button" onclick="return confirm('Are you sure?')" href="{{$str_remove_watch_list_link}}">
                <i class="fa fa-times-circle-o"></i>
              </a>
            </div>
          </div>
          <div>
            <p class="mb-0 p-text">{!!@App\Helpers\Utilities::getFilterDescriptionHome($str_description, 3)!!} <a href="#" data-toggle="modal" class="readMore" data-target="#wathchListDetail{{$int_row_id}}">Read More...</a></p>
          </div>
       </div>
    </div>
  </a>
                          <!-- <hr> -->
						  
						  
						  
	  <div class="modal" id="wathchListDetail{{$int_row_id}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header kbg_black">
            <div class="textContent">
              <h4 class="modal-title ">Watchlist Description</h4>
            </div>
            <button type="button" class="close " data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
            <div>
              <p class="text-justify p-text">{!!@$str_description!!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>