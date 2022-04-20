<?php

 $int_chk_is_home_page = 0;

 $str_featured_main_class = '';

 if(Request::is('/')) {

      $int_chk_is_home_page = 1;   

  }

  

  if($int_chk_is_home_page>0)

  {

	$str_featured_main_class = 	'col-md-8';        

  }

  else

  {

	$str_featured_main_class = 	'col-md-12';  

  }

  

?>

<!-- NextbackgroundColor border-bottom -->

    <div class="col-md-12 NextbackgroundColor1 userprofileBorder">

        <div class="row homesectionBox paddingTopTwenty paddingBottomTwenty">

            <div class="<?php echo e($str_featured_main_class); ?> pl-0">

                <div>

                    <!-- <h2 class="blog_title header_purple">Featured News</h2> -->

                    <a href="<?php echo e(route('front.pages.did-you-know.detail',$news->slug)); ?>">

                        <h2 class="blogInnerTitle"><?php echo e($news->title); ?></h2>

                    </a>

                </div>

                <div class="row mt-4">

                    <div class="col-md-12">

                        <div class="mb-1">

						    <a href="<?php echo e(route('front.pages.did-you-know.detail',$news->slug)); ?>">

                            <img <?php if(!empty($news->is_home_page)): ?><?php echo e("class=imgThreeTen"); ?> <?php else: ?> <?php echo e("class=imgThreeTen"); ?> <?php endif; ?>  src="<?php echo e(@newsBlogImageBasePath($news->featured_image)); ?>">

                            </a>

						</div>

                    </div>

                    <div class="col-md-12">

                        <div <?php if(empty($news->is_home_page)): ?><?php echo e("class=featured-news-description-class-new11"); ?> <?php endif; ?>>

                            <!-- <a href="<?php echo e(route('front.pages.news.detail',$news->slug)); ?>">

							<h2 class="blogInnerTitle"><?php echo e($news->title); ?></h2>

                            </a> -->

							<div class="category_article_date mb-1">

                                <small><?php echo e(App\Helpers\Utilities::getDateFormat($news->created_at)); ?> By People Of Play </small>

                            </div>

                            <p class="blogPara my-0">

							<?php if(!empty($news->is_home_page)): ?>

							  <?php echo App\Helpers\Utilities::getFilterDescriptionHome($news->description, 2); ?>


							<?php else: ?>

							  <?php echo App\Helpers\Utilities::getFilterDescriptionHome($news->description, 1); ?>


							<?php endif; ?>

							</p>

                            <div>

                                <span >

								<a <?php if(!empty($slug) && $int_chk_is_home_page<=0): ?> href="<?php echo e(route('front.pages.user.news', $slug)); ?>" <?php else: ?> href="<?php echo e(route('front.pages.news')); ?>" <?php endif; ?> class="span-style1">Browse more News >></a></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            

			<?php if(!empty($int_chk_is_home_page) && $int_chk_is_home_page>0): ?>

			

				<div class="col-md-4 paddingLeftZero marginTopMob">  

                    <div>

                        <h2 class="blogSideHomeTitle header_purple">Popular News</h2>

                    </div>                  

                    

					<?php $__currentLoopData = $popular_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular_news_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<div class="row mt-3">

							<div class="col-md-3 col-sm-3 col-3 pr-0 mb-2">

							    <a href="<?php echo e(route('front.pages.news.detail',$popular_news_row->slug)); ?>">

								<img class="img-fluid blogSideHomeImg" <?php if(!empty($popular_news_row->featured_image)): ?> src="<?php echo e(@newsBlogImageBasePath($popular_news_row->featured_image)); ?>" <?php else: ?>  src="<?php echo e(asset('front/images/lego_toys_img.jpeg')); ?>" <?php endif; ?>>

							    </a>

							</div>

							<div class="col-md-9 col-sm-9 col-9">

								<a href="<?php echo e(route('front.pages.news.detail',$popular_news_row->slug)); ?>">

								<h2 class="blogSideInnerTitle"><?php echo e(substr($popular_news_row->title, 0, 60)); ?></h2>

								</a>

								<div class="">

									<small class="blogSideHomeSmall"><?php echo e(App\Helpers\Utilities::getDateFormat($popular_news_row->created_at)); ?> By People Of Play</small>

								</div>

							</div>

						</div>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

			<?php endif; ?>

		

            <!-- <div>

                <span ><a href="<?php echo e(route('front.pages.news')); ?>" class="span-style1">Browse more News >></a></span>

            </div> -->

        </div>

    </div>