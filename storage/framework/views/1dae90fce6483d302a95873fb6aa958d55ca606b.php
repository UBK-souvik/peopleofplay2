<style>
	.select2.select2-container{
		min-width: 240px!important;
	}
	.select2.select2-container.select2-container--default{
		min-width: 240px!important;
	}
</style>
<div class="wrap-text text-white">
		<?php if($rtn_arr_cnt > 0): ?>
    	<p class="m-0" style="font-size: 25px;">Results found for <b>" <?php echo e($request->result_for); ?> "</b></p>
		<?php else: ?>
    	<p class="m-0" style="font-size: 25px;">No results found for <b>" <?php echo e($request->result_for); ?> "</b></p>
		<?php endif; ?>
</div>

<?php $__currentLoopData = $rtn_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rtn_arrs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if(!empty($rtn_arrs)): ?>
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
						<?php $__currentLoopData = $rtn_arrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result_data_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
										<a target="blank" href="<?php echo e($url); ?>" class="dac_name <?php echo e($key); ?>">
											<?php if(!empty($result_data_row['featured_image'])): ?>
												<img src="<?php echo e($img_url); ?>" class="rounded-circle">
											<?php elseif(!empty($result_data_row['image'])): ?>
												<img src="<?php echo e($img_url); ?>" class="rounded-circle">
											<?php else: ?>
												<img src="<?php echo e(asset('front/new/images/Product/team_new.png')); ?>" class="rounded-circle">
											<?php endif; ?>
										</a>
									</td>									
									<td class=""><a target="blank" href="<?php echo e($url); ?>" class="dac_name"><?php echo e($result_data_row['title']); ?></a></td>									
								</tr>   
							        
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</tbody>
				</table>
			</div>
		</div>	
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	


