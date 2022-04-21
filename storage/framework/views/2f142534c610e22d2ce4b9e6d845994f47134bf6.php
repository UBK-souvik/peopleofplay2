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
                            <a class="btn hover_btn" href="<?php echo e($row->button_one_link); ?>" target="_blank"><span class="ButtonText " style="padding:17px;"><?php echo e($row->button_text); ?></span></a>
                        </div>
                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" href="<?php echo e($row->button_two_link); ?>" target="_blank"><span class="ButtonText " style="padding:17px;"><?php echo e($row->button_two_text); ?></span></a>
                        </div>
                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" href="<?php echo e($row->button_three_link); ?>" target="_blank"><span class="ButtonText " style="padding:17px;"><?php echo e($row->button_three_text); ?></span></a>
                        </div>
                    </div>
                </div>
        <?php } ?>

                
                <div class="ImageBoxSection my-2">
                    <?php foreach ($sectionThree as $key => $section) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > <?php echo e($section->profileHeader); ?> </h4>
                    </div>
                    <?php } ?>

                    <div class="row" >
                        <?php foreach ($sectionProfile as $key => $sectionprofile) { ?>
                            <div class="col-sm-12 col-xs-12 col-md-3">
                                <div class="imagebox  profileImg" >
                                <a href="<?php echo e($sectionprofile->profileUrl); ?>" target="_blank">

                                        <img src="<?php echo e(@imageBasePath($sectionprofile->main_image)); ?>" class="category-banner img-fluid">

                                </a>
                            </div>

                                <a href="<?php echo e($sectionprofile->profileUrl); ?>" target="_blank">
                                <span class="imagebox-desc text-center mt-2 profileName" > <?php echo e($sectionprofile->profileName); ?> </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1 profileSubtitle" > <?php echo e($sectionprofile->profileSubtitle); ?> </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                


                

                <div class="ImageBoxSection my-2">
                    <?php foreach ($profileHeader as $key => $row3) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > <?php echo e($row3->profileHeader); ?> </h4>
                    </div>
                    <?php } ?>

                    <div class="row" >
                        <?php foreach ($data as $key => $row2) { ?>
                            <div class="col-sm-12 col-xs-12 col-md-3">
                                <div class="imagebox  profileImg" >
                                <a href="<?php echo e($row2->profileUrl); ?>" target="_blank">

                                        <img src="<?php echo e(@imageBasePath($row2->main_image)); ?>" class="category-banner img-fluid">

                                </a>
                            </div>

                                <a href="<?php echo e($row2->profileUrl); ?>" target="_blank">
                                <span class="imagebox-desc text-center mt-2 profileName" > <?php echo e($row2->profileName); ?> </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1 profileSubtitle" > <?php echo e($row2->profileSubtitle); ?> </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                

                
                <div class="ImageBoxSection my-2">
                    <?php foreach ($SectionFour as $key => $sectionfour) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > <?php echo e($sectionfour->profileHeader); ?> </h4>
                    </div>
                    <?php } ?>

                    <div class="row" >
                        <?php foreach ($SectionFourProfile as $key => $sectionfourprofile) { ?>
                            <div class="col-sm-12 col-xs-12 col-md-3">
                                <div class="imagebox  profileImg" >
                                <a href="<?php echo e($sectionfourprofile->profileUrl); ?>" target="_blank">

                                        <img src="<?php echo e(@imageBasePath($sectionfourprofile->main_image)); ?>" class="category-banner img-fluid">

                                </a>
                            </div>

                                <a href="<?php echo e($sectionfourprofile->profileUrl); ?>" target="_blank">
                                <span class="imagebox-desc text-center mt-2 profileName" > <?php echo e($sectionfourprofile->profileName); ?> </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1 profileSubtitle" > <?php echo e($sectionfourprofile->profileSubtitle); ?> </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                

                <div class="ImageBoxSection my-2 description" >
                    <?php foreach ($descriptionHeader as $key => $description) { ?>

                    <div class="imageboxhead text-center mt-5 mb-4">
                        <h4 style="" class="main_header"> <?php echo e($description->description_main_header); ?> </h4>
                    </div>
                    <?php } ?>
                    <?php foreach ($eventDescription as $key => $event) { ?>

                    <div>
                        <h4 style="font-size:22px;font-weight:bold; color:black;" class="description_header"> <?php echo e($event->description_header); ?></h4><br><span class="st-icon-pandora buttom_description" style=""><?php echo html_entity_decode($event->description_details); ?></span>
                    </div>
                         <?php if( $event->button_text  == NULL){ ?>
                                 <div class="imagebtn text-center " style="margin-top: -32px;">
                                </div>
                        <?php }else{?>
                                <div class="imagebtn text-center " style="float:left;">
                                 <a class="btn hover_btn" href="<?php echo e($event->button_link); ?>" target="_blank"><span class="ButtonText " style="padding:17px;"><?php echo e($event->button_text); ?></span></a>
                                    </div>
                        <?php } ?>
                        <?php } ?>

                </div>


                  <div class="col-md-10 col-lg-12" style="margin-top: 83px;">
                        <?php foreach ($eventBanner as $key => $banner) { ?>
                      <div class="ImageBoxSection text-center mt-5 mb-4">
                            <h4 style="color: #662e91; font-size: 28px;
                            font-weight: bold;"> <?php echo e($banner->banner_header); ?> </h4>
                      </div>
                      <div class="row">
                              <div class="col-md-10 bannerImage" >
                                  <div class="imageboxs banner_img">
                                          <img src="<?php echo e(@imageBasePath($banner->main_image)); ?>" class="category-banner img-fluid ">
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