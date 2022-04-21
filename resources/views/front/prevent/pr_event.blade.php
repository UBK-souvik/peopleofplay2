@extends('front.layouts.layout')
@section('content')
<link rel="stylesheet" href="{{ asset('front/new_css/wiki.css?'.time()) }}">

<div class="col-md-10 col-lg-12">
    <div class="container-width mt-0">
     <div class="left-column colheightleft">

        <?php foreach ($header as $key => $row) { ?>
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <div class="imageboxhead text-center">
                            <h2 style="color: rgb(62, 62, 62);font-size: 32px;font-weight:900;margin-top: 20px;"> {{ $row->h1_tag }} </h2>
                        </div>

                        <div class="imageboxhead text-center ">
                            <h3 style="color: rgb(62, 62, 62);font-size: 28px;font-weight:900;"> {{ $row->h2_tag }} </h3>
                        </div>

                        <div class="imageboxhead text-center " style="margin-top: 12px;">
                            <h4 style="color: #662e91;font-size: 28px;font-weight:bold;"> {{ $row->h3_tag }} </h4>
                        </div>

                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" href="{{ $row->button_one_link }}" target="_blank"><span class="ButtonText " style="padding:17px;">{{ $row->button_text }}</span></a>
                        </div>
                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" href="{{ $row->button_two_link }}" target="_blank"><span class="ButtonText " style="padding:17px;">{{ $row->button_two_text }}</span></a>
                        </div>
                        <div class="imagebtn text-center " style="margin-top: 22px;">
                            <a class="btn hover_btn" href="{{ $row->button_three_link }}" target="_blank"><span class="ButtonText " style="padding:17px;">{{ $row->button_three_text }}</span></a>
                        </div>
                    </div>
                </div>
        <?php } ?>

                <div class="ImageBoxSection my-2">
                    <?php foreach ($profileHeader as $key => $row3) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > {{ $row3->profileHeader }} </h4>
                    </div>
                    <?php } ?>

                    <div class="row" >
                        <?php foreach ($data as $key => $row2) { ?>
                            <div class="col-sm-12 col-xs-12 col-md-3">
                                <div class="imagebox  profileImg" >
                                <a href="{{ $row2->profileUrl }}" target="_blank">

                                        <img src="{{ @imageBasePath($row2->main_image) }}" class="category-banner img-fluid">

                                </a>
                            </div>

                                <a href="{{ $row2->profileUrl }}" target="_blank">
                                <span class="imagebox-desc text-center mt-2 profileName" > {{ $row2->profileName }} </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1 profileSubtitle" > {{ $row2->profileSubtitle }} </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="ImageBoxSection my-2">
                    <?php foreach ($sectionThree as $key => $section) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5" >
                        <h4 style="color: #662e91;font-size: 28px;font-weight:bold;" > {{ $section->profileHeader }} </h4>
                    </div>
                    <?php } ?>

                    <div class="row" >
                        <?php foreach ($sectionProfile as $key => $sectionprofile) { ?>
                            <div class="col-sm-12 col-xs-12 col-md-3">
                                <div class="imagebox  profileImg" >
                                <a href="{{ $sectionprofile->profileUrl }}" target="_blank">

                                        <img src="{{ @imageBasePath($sectionprofile->main_image) }}" class="category-banner img-fluid">

                                </a>
                            </div>

                                <a href="{{ $sectionprofile->profileUrl }}" target="_blank">
                                <span class="imagebox-desc text-center mt-2 profileName" > {{ $sectionprofile->profileName }} </span>
                                </a>
                                <span class="imagebox-desc text-center mt-1 profileSubtitle" > {{ $sectionprofile->profileSubtitle }} </span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="ImageBoxSection my-2 description" >
                    <?php foreach ($descriptionHeader as $key => $description) { ?>

                    <div class="imageboxhead text-center mt-5 mb-5">
                        <h4 style="color: #662e91;font-size: 28px;
                        font-weight: bold;"> {{ $description->description_main_header }} </h4>
                    </div>
                    <?php } ?>
                    <?php foreach ($eventDescription as $key => $event) { ?>

                    <div>
                        <h4 style="font-size:22px;font-weight:bold; color:black;" > {{ $event->description_header }}</h4><br><span class="st-icon-pandora " style="font-size: 14px;color:black;">{!!html_entity_decode($event->description_details)!!}</span>
                    </div>
                    <?php } ?>

                </div>


                  <div class="col-md-10 col-lg-12">
                        <?php foreach ($eventBanner as $key => $banner) { ?>
                      <div class="ImageBoxSection text-center mt-5 mb-2">
                            <h4 style="color: #662e91; font-size: 28px;
                            font-weight: bold;"> {{ $banner->banner_header }} </h4>
                      </div>
                      <div class="row">
                              <div class="col-md-10 bannerImage" >
                                  <div class="imageboxs banner_img">
                                          <img src="{{ @imageBasePath($banner->main_image) }}" class="category-banner img-fluid ">
                                  </div>
                              </div>
                        <?php } ?>
                     </div>
                  </div>
            </div>

    </div>
</div>
</div>

@endsection


