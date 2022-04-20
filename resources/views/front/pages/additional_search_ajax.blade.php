<style>
	.select2.select2-container{
		min-width: 240px!important;
	}
	.select2.select2-container.select2-container--default{
		min-width: 240px!important;
	}
</style>
<div class="wrap-text text-white">
		@if($rtn_arr_cnt > 0)
    	<p class="m-0" style="font-size: 25px;">Results found for <b>" {{$request->result_for}} "</b></p>
		@else
    	<p class="m-0" style="font-size: 25px;">No results found for <b>" {{$request->result_for}} "</b></p>
		@endif
</div>

@foreach($rtn_arr as $key => $rtn_arrs)
	@if(!empty($rtn_arrs))
		<div class="row">
			<div class="col-md-12">
				<h2 class="sidetitleProducttitle1 mt-4">
					<?php
						$exp = explode('_',$key);
						echo ucwords(@$exp[0].' '.@$exp[1]);
					?>
				</h2>
				<table class="table event_table AdvanceSearch">
					<tbody>
						@foreach($rtn_arrs as $result_data_row)
							<?php
								if($key == 'blogs'){
									$img_url = asset('uploads/images/blogs/'.@$result_data_row['featured_image']);
									$url = url('blog/'.@$result_data_row['slug']);
								}elseif($key == 'featured_articles'){
									$img_url = asset('uploads/images/'.@$result_data_row['featured_image']);
									$url = url('featured-article/'.@$result_data_row['slug']);
								}elseif($key == 'wiki'){
									$img_url = asset('uploads/images/wiki/'.@$result_data_row['featured_image']);
									$url = @$result_data_row['url'];
								}elseif($key == 'pop_casts' || $key == 'entertainment'){
									$img_url = asset('uploads/images/entertainment/'.@$result_data_row['featured_image']);
									$url = @$result_data_row['url'];
								}elseif($key == 'feeds'){
									$img_url = asset('uploads/images/feed/'.@$result_data_row['image']);
									$url = url('feed/'.@$result_data_row['id']);
								}elseif($key == 'news_feeds'){
									$img_url = asset('uploads/images/feed/'.@$result_data_row['image']);
									$url = url('news_feed/'.@$result_data_row['id']);
								}
							?>
							
								<tr class="py-0">
									<td class="pl-0" style="width:50px;">
										<a target="blank" href="{{$url}}" class="dac_name {{$key}}">
											@if(!empty($result_data_row['featured_image']))
												<img src="{{$img_url}}" class="rounded-circle">
											@elseif(!empty($result_data_row['image']))
												<img src="{{$img_url}}" class="rounded-circle">
											@else
												<img src="{{ asset('front/new/images/Product/team_new.png') }}" class="rounded-circle">
											@endif
										</a>
									</td>									
									<td class=""><a target="blank" href="{{$url}}" class="dac_name">{{$result_data_row['title']}}</a></td>									
								</tr>   
							        
						@endforeach	
					</tbody>
				</table>
			</div>
		</div>	
	@endif
@endforeach	


