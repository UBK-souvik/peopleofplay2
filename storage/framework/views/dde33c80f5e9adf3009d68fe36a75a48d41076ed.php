
<?php if(!empty($main_list->videos) && count($main_list->videos)>0): ?>
<div class="owl-carousel mainListCarousel_video owl-theme" id="video-gallery">
        <?php $__currentLoopData = $main_list->videos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $GetAPI = @GetYoutubeAPI($video->video_link);

                $thumbnail = @$GetAPI['thumbnail']['thumb'];
            ?> 
            
            <div class="item pr-1 pb-1" data-responsive="" data-src="<?php echo e(@$video->video_link); ?>" 
            data-poster="" data-sub-html="">
                <a href="<?php echo e($video->video_link); ?>">
                    <div class="Gallery-text-overlay-Image3">
                    <img src="<?php echo e($thumbnail); ?>"
                        class="img-fluid imagesCover videoPreview">
                        <div class="overlayimages8">
                            <strong class="small1"><?php echo e(App\Helpers\UtilitiesTwo::get_video_title_data(@$video->video_title)); ?></strong>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>								



		