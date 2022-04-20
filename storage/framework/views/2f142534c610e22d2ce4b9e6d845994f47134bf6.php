<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('front/new_css/wiki.css?'.time())); ?>">

<div class="col-md-10 col-lg-12">
    <div class="container-width mt-0">
     <div class="left-column colheightleft">

        <?php foreach ($header as $key => $row) { ?>
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <div class="imageboxhead text-center">
                            <h2 style="color: rgb(62, 62, 62);font-size: 32px;font-weight:900;margin-top: 20px;"> <?php echo e($row->h1_tag); ?> </h2>
                        </div>

                        <div class="imageboxhead text-center ">
                            <h3 style="color: rgb(62, 62, 62);font-size: 28px;font-weight:900;"> <?php echo e($row->h2_tag); ?> </h3>
                        </div>

                        <div class="imageboxhead text-center " style="margin-top: 12px;">
                            <h4 style="color: #662e91;font-size: 28px;font-weight:bold;"> <?php echo e($row->h3_tag); ?> </h4>
                        </div>

                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" target="_blank"><span class="ButtonText " style="padding:17px;"><?php echo e($row->button_text); ?></span></a>
                        </div>
                    </div>
                </div>
        <?php } ?>

                <div class="ImageBoxSection my-2">
                    <?php foreach ($profileHeader as $key => $row3) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > <?php echo e($row3->profileHeader); ?> </h4>
                    </div>
                    <?php } ?>

                    <div class="row images_class" style="">
                        <?php foreach ($data as $key => $row2) { ?>
                            <div class="col-sm-3 ">
                                <a href="<?php echo e($row2->profileUrl); ?>" target="_blank">

                                <div class="imagebox imgbox" style="width: 201px;height: 250px;object-fit: cover;object-position: 50% 50%;">
                                        <img src="<?php echo e(@imageBasePath($row2->main_image)); ?>" class="category-banner img-fluid">

                                </div>
                                </a>
                                <a href="<?php echo e($row2->profileUrl); ?>" target="_blank">
                                <span class="imagebox-desc text-center mt-2" style="font-size: 17px;
                                font-weight: bold; color:black;    margin-left: 78px;"> <?php echo e($row2->profileName); ?> </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1" style="font-family:sans-serif;font-size:13px;margin-left: 78px;"> <?php echo e($row2->profileSubtitle); ?> </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="ImageBoxSection my-2 description" style="">
                    <?php foreach ($descriptionHeader as $key => $description) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5">
                        <h4 style="color: #662e91;font-size: 28px;
                        font-weight: bold;"> <?php echo e($description->description_main_header); ?> </h4>
                    </div>
                    <?php } ?>
                    <?php foreach ($eventDescription as $key => $event) { ?>

                    <div>
                        <h4 style="font-size:22px;font-weight:bold; color:black;" > <?php echo e($event->description_header); ?></h4><br><span class="st-icon-pandora " style="font-size: 14px;color:black;"><?php echo html_entity_decode($event->description_details); ?></span>
                    </div>
                    <?php } ?>

                </div>


                  <div class="col-md-10 col-lg-12">
                        <?php foreach ($eventBanner as $key => $banner) { ?>
                      <div class="ImageBoxSection text-center mt-5 mb-2">
                            <h4 style="color: #662e91; font-size: 28px;
                            font-weight: bold;"> <?php echo e($banner->banner_header); ?> </h4>
                      </div>
                      <div class="row">
                              <div class="col-sm-10 col-lg-4 mb-4" style="position: ">
                                  <div class="imageboxs bannerImg" style="width: 929px;object-fit: cover;object-position: 50% 50%;">
                                          <img src="<?php echo e(@imageBasePath($banner->main_image)); ?>" class="category-banner img-fluid">
                                  </div>
                              </div>
                        <?php } ?>
                     </div>
                  </div>
            </div>

    </div>
</div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('front.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>