@foreach ($home->brand_lists ?? [] as $brand_list_row)
                  @if(!empty($brand_list_row->brand_list->name))
				   <div class="item">
					  <div class="Gallery-text-overlay-Image3">
						 <a target="_blank" href="{{ url('/') . '/brand/'. @$brand_list_row->brand_list->slug }}">
							<img @if(!empty($int_is_owl_brandlist)){{'data-'}}@endif src="{{@imageBasePath($brand_list_row->brand_list->main_image)}}" class="@if(!empty($int_is_owl_brandlist)){{'owl-lazy'}}@endif homeProfileCircle rounded-circle mr-3">
							<div class="overlayimages8 withoutOverlay">
							   <strong>{{substr(@$brand_list_row->brand_list->name,0,75)}} </strong>
							</div>
						 </a>
					  </div>
				   </div>
                   @endif
@endforeach