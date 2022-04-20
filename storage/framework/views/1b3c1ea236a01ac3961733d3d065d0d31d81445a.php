<div class="WelcomePopFeed">
	<img src="<?php echo e(@imageBasePath(@$data->featured_image)); ?>" alt="WebHeader15" class="img-fluid">
	
	<?php if(isset($data->home_caption_one) && !empty($data->home_caption_one)): ?>
	<br>
	<a href="<?php echo e(@$homa_caption_url_one); ?>"><?php echo e(@$data->home_caption_one); ?></a>
	<?php endif; ?>
	
	<?php if(isset($data->home_caption_two) && !empty($data->home_caption_two)): ?>
	<br>
	<a href="<?php echo e(@$homa_caption_url_two); ?>"><?php echo e(@$data->home_caption_two); ?></a>
	<?php endif; ?>
	<?php
	if(isset($data->url_caption_three) && !empty($data->url_caption_three)){
		$url_three = json_decode($data->url_caption_three);
	 ?>
	 <br>
	<a href="<?php echo e(@$url_three->url); ?>"><?php echo e(@$url_three->caption); ?></a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_four) && !empty($data->url_caption_four)){
		$url_four = json_decode($data->url_caption_four);
	 ?>
	 <br>
	<a href="<?php echo e(@$url_four->url); ?>"><?php echo e(@$url_four->caption); ?></a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_five) && !empty($data->url_caption_five)){
		$url_five = json_decode($data->url_caption_five);
	 ?>
	 <br>
	<a href="<?php echo e(@$url_five->url); ?>"><?php echo e(@$url_five->caption); ?></a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_six) && !empty($data->url_caption_six)){
		$url_six = json_decode($data->url_caption_six);
	 ?>
	 <br>
	<a href="<?php echo e(@$url_six->url); ?>"><?php echo e(@$url_six->caption); ?></a>
	<?php } ?>
	<?php
	if(isset($data->url_caption_seven) && !empty($data->url_caption_seven)){
		$url_seven = json_decode($data->url_caption_seven);
	 ?>
	 <br>
	<a href="<?php echo e(@$url_seven->url); ?>"><?php echo e(@ $url_seven->caption); ?></a>
	<?php } ?>
	
	
</div>

