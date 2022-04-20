<div class="WelcomePopFeed">
	<img src="{{ @imageBasePath(@$data->featured_image)}}" alt="WebHeader15" class="img-fluid">
	
	@if(isset($data->home_caption_one) && !empty($data->home_caption_one))
	<br>
	<a href="{{ @$homa_caption_url_one}}">{{ @$data->home_caption_one }}</a>
	@endif
	
	@if(isset($data->home_caption_two) && !empty($data->home_caption_two))
	<br>
	<a href="{{ @$homa_caption_url_two}}">{{ @$data->home_caption_two }}</a>
	@endif
	<?php
	if(isset($data->url_caption_three) && !empty($data->url_caption_three)){
		$url_three = json_decode($data->url_caption_three);
	 ?>
	 <br>
	<a href="{{ @$url_three->url }}">{{ @$url_three->caption }}</a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_four) && !empty($data->url_caption_four)){
		$url_four = json_decode($data->url_caption_four);
	 ?>
	 <br>
	<a href="{{ @$url_four->url }}">{{ @$url_four->caption }}</a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_five) && !empty($data->url_caption_five)){
		$url_five = json_decode($data->url_caption_five);
	 ?>
	 <br>
	<a href="{{ @$url_five->url }}">{{ @$url_five->caption }}</a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_six) && !empty($data->url_caption_six)){
		$url_six = json_decode($data->url_caption_six);
	 ?>
	 <br>
	<a href="{{ @$url_six->url }}">{{ @$url_six->caption }}</a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_seven) && !empty($data->url_caption_seven)){
		$url_seven = json_decode($data->url_caption_seven);
	 ?>
	 <br>
	<a href="{{ @$url_seven->url }}">{{ @ $url_seven->caption }}</a>
	<?php } ?>
	
	
</div>

