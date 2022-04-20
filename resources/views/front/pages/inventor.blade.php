@extends('front.layouts.pages')
@section('content')
    <div class="First-column bg-white">
      <!-- First Section of intro -->
      <div class="row">
        <div class="col-md-4">
          <div class="image-width justifly-content-center">
            @if($user->profile_image)
            <img id="" src="{{imageBasePath($user->profile_image)}}" alt=""
                class="img-fluid mr-3">
            @endif
          </div>
        </div>
        <div class="col-md-8">
          <div class="Jengatext paragraph">
            <h2>{{$user->first_name .' '. $user->last_name}}</h2>
          </div>

          <ul class="d-flex flex-row ul-text-color">
            <a href="#!">
              <li>Inventor | Award Recipient</li>
            </a>
          </ul>
          <hr>
          <p class="p-text">{{$user->description}}<br>
            <hr>
            <p class="sidetitleProduct">Born:<span class="span-style"> {{@Carbon\Carbon::parse($user->dob)->format('d M Y')}} (age {{@Carbon\Carbon::parse($user->dob)->age}})</span></p>
            <p class="sidetitleProduct">More at:<span class="span-style"> PopPro >></span></p>
            <p class="sidetitleProduct">Contact info: View<span class="span-style"> agent, manager, legal and
                company <a href="#teamsection">
            </p>

            <br>


        </div>





      </div>
      <hr>
      <div class="row rowpadding desktopveiw">
        <div class="col-md-12">
          <div class="wrap-gallery mb-3">
            <div class="Gallery-overlay d-flex flex-row">
              @foreach ($user->galleries->sortByDesc('created_at') ?? [] as $gallery)
              @if($gallery->media_type == 1)
              <div class="Gallery-text-overlay">
                <img src="{{imagebasePath($gallery->media)}}" class="img-fluid">
              </div>
              @endif
              @if($gallery->media_type == 2)
              <div class="Gallery-text-overlay">
                <video width="100" height="100" controls>
                    <source src="{{imagebasePath($gallery->media)}}"></source>
                </video>
              </div>
              @endif
              @if($gallery->media_type == 3)
              <div class="Gallery-text-overlay">
                <img src="{{imagebasePath($gallery->media)}}" class="img-fluid">
              </div>
              @endif
              @endforeach
            </div>
          </div>
          <small><span class="span-style">{{$user->galleries->where('media_type',1)->count() ?? 0}} photos &nbsp; &nbsp; | &nbsp; &nbsp;
            {{$user->galleries->where('media_type',2)->count() ?? 0}}  videos
                &nbsp; &nbsp; |
                &nbsp; &nbsp; {{$user->galleries->where('media_type',3)->count() ?? 0}}  articles &nbsp; &nbsp; &gt;&gt;</span></small>

        </div>
      </div>

      <div class="row rowpadding mobileveiw">
        <div class="col-md-12">
          <div class="wrap-gallery mb-3">
            <div class="Gallery-overlay d-flex flex-row">
              <div class="Gallery-text-overlay">
                <img src="{{asset('front/new/images/Product/image5.jpg') }}" class="img-fluid w-20">
              </div>
              <div class="Gallery-text-overlay px-1">
                <img src="{{asset('front/new/images/Product/image6.jpg') }}" class="img-fluid">
              </div>
              <div class="Gallery-text-overlay">
                <img src="{{asset('front/new/images/Product/image2.png') }}" class="img-fluid">
              </div>
            </div>
          </div>
          <small><span class="span-style1"><a href=#Imagegallery>230 photos &nbsp; &nbsp; | &nbsp;
                &nbsp;</a><a href=#Vediosection>40 videos</a> &nbsp; &nbsp; | &nbsp; &nbsp; 6012 articles
              &nbsp; &nbsp; &gt;&gt;</span></small>

        </div>
      </div>
      <!--<div class="row MobileFirstGallery">
      <div class="col-md-12">
        <div class="wrap-gallery mb-3">
          <div class="Gallery-overlay d-flex flex-row">
            <div class="Gallery-text-overlay">
                  <img src="images/Events/images2.jpg" class="img-fluid w-20">
                </div>
                <div class="Gallery-text-overlay px-1">
                  <img src="images/Events/images4.jpg" class="img-fluid">
              </div>
                <div class="Gallery-text-overlay">
                  <img src="images/Events/images6.jpg" class="img-fluid">
              </div>
            </div>
         </div>
         <small><span class="span-style">230 photos &nbsp; &nbsp; | &nbsp; &nbsp; 40 videos &nbsp; &nbsp; | &nbsp; &nbsp; 6012 articles &nbsp; &nbsp; &gt;&gt;</span></small>>
        <hr class="mt- bg-dark">
          </div>
    </div>-->
      <hr>
      <div class="wrap-text desktopveiw">
        <h3>Known for</h3>
      </div>
      <div class="row desktopveiw">
        <div class="col-md-12">
          <div class="wrap-gallery my-3">
            <div class="Gallery-overlay d-flex">
              <div class="Gallery-text-overlay-Image">
                <img src="{{ asset('front/new/images/Product/image8.jpg') }}" class="img-fluid imagesCover">
                <div class="overlayimages5">DC's Legends of To...
                </div>
              </div>
              <div class="Gallery-text-overlay-Image">
                <img src="{{ asset('front/new/images/Product/image9.jpg') }}" class="img-fluid imagesCover">
                <div class="overlayimages5">2018 Mouth Jenga
                </div>
              </div>
              <div class="Gallery-text-overlay-Image">
                <img src="{{ asset('front/new/images/Product/image10.jpg') }}" class="img-fluid imagesCover">
                <div class="overlayimages5">Magicians
                </div>
              </div>
              <div class="Gallery-text-overlay-Image">
                <img src="{{ asset('front/new/images/Product/image11.jpg') }}" class="img-fluid imagesCover">
                <div class="overlayimages5">Game Night
                </div>
              </div>
            </div>
          </div>
          <span class="span-style1 mt-5" data-toggle="modal" data-target=".bs-example-modal-lg">See all title
            >></span>
          <hr>

        </div>
      </div>

      <div class="wrap-text mobileveiw">
        <h3>Featured in</h3>
      </div>
      <div class="row mobileveiw">
        <div class="col-md-12">
          <div class="wrap-gallery my-3">
            <div class="Gallery-overlay d-flex">
              <div class="Gallery-text-overlay-Image">
                <img src="images/Product/image8.jpg" class="img-fluid imagesCover">
                <div class="overlayimages5">DC's Legends of To...
                </div>
              </div>
              <div class="Gallery-text-overlay-Image">
                <img src="images/Product/image9.jpg" class="img-fluid imagesCover">
                <div class="overlayimages5">2018 Mouth Jenga
                </div>
              </div>
              <div class="Gallery-text-overlay-Image">
                <img src="images/Product/image10.jpg" class="img-fluid imagesCover">
                <div class="overlayimages5">Magicians
                </div>
              </div>

            </div>
          </div>
          <span class="span-style1 mt-5" data-toggle="modal" data-target=".bs-example-modal-lg">See all
            birthdays >></span>
          <hr>

        </div>
      </div>



      <!--<div class="row MobileFirstGallery">
      <div class="col-md-12">
        <div class="wrap-gallery mb-3">
          <div class="wrap-text">
            <h3 class="mb-5 mt-3">Known for</h3>
            </div>
          <div class="Gallery-overlay d-flex flex-row">
            <div class="Gallery-text-overlay">
                  <img src="images/gallery1.jpg" class="img-fluid w-20">
                <div class="">Jenga</div>
                </div>
                <div class="Gallery-text-overlay px-1">
                  <img src="images/gallery2.jpg" class="img-fluid">
                <div class="">Ex Libris</div>
                </div>
                <div class="Gallery-text-overlay">
                  <img src="images/gallery3.jpg" class="img-fluid">
                <div class=" w-22">Great Western Railway</div>
                </div>
            </div>
         </div>
           <span class="span-style mt-3 px-3">See all birthdays >> </span>
           <hr>
          </div>
    </div>-->
    @if(count($user->inventorAwards))
      <div class="row">
        <div class="col-md-12">
          <div class="wrap-gallery">
            <div class="wrap-text">
              <h3 class="mb-4 mt-2">Awards</h3>
            </div>
            <div class="Gallery-overlay d-flex my-3">
                @foreach($user->inventorAwards->nth(2) as $award)
                <div class="Gallery-text-overlay">
                    <img src="{{imageBasePath($award->file )}}" class="img-fluid imagesCover">
                    <div class="overlayimages7">
                    </div>
                </div>
                @endforeach
            </div>
          </div>
          <div class="d-flex">
            <p class="sidetitleProduct bgcolor">Nominated for 2 Game of the Year. Another 28 wins & 63
              nominations.<span class="span-style">See more >></span></p>

          </div>


        </div>
      </div>
      @endif

      <div id="" class="mt-3">
        <div class="row">
          <div class="col-md-12">
            <div class="wrap-gallery mb-3">
            </div>
            <hr>
            <div class="wrap-text" id="Imagegallery">
              <h3>Image Gallery</h3>
            </div>
            <div class="row desktopveiw">
              <div class="col-md-12">
                <div class="wrap-gallery my-3">
                  <div class="Gallery-overlay d-flex">
                    @foreach($user->galleries->where('media_type',1)->nth(4) ?? [] as $media)
                    <div class="Gallery-text-overlay-Image">
                        <img src="{{imageBasePath($media->title)}}" class="img-fluid w-20">
                    </div>
                    @endforeach
                  </div>
                </div>
                <span class="span-style1 mt-5">See all images >></span>
                <hr>
              </div>
            </div>
            <div class="row mobileveiw">
              <div class="col-md-12">
                <div class="wrap-gallery my-3">
                  <div class="Gallery-overlay d-flex">
                    <div class="Gallery-text-overlay-Image">
                      <img src="images/imggallery18.jpg" class="img-fluid imagesCover">

                    </div>
                    <div class="Gallery-text-overlay-Image">
                      <img src="images/imggallery19.jpg" class="img-fluid imagesCover">

                    </div>
                    <div class="Gallery-text-overlay-Image">
                      <img src="images/imggallery20.jpg" class="img-fluid imagesCover">

                    </div>

                  </div>
                </div>
                <span class="span-style1 mt-5">See all images >></span>
                <hr>
              </div>
            </div>
            </section>


            <section class="py-2">
              <div class="wrap-text" id="Vediosection">
                <h3 class="">Videos</h3>
              </div>
              <div class="row desktopveiw">
                <div class="col-md-12">
                  <div class="wrap-gallery my-3">
                    <div class="Gallery-overlay d-flex">
                        @foreach($user->galleries->where('media_type',2)->nth(4) ?? [] as $media)
                        <div class="Gallery-text-overlay-Image">
                            <img src="{{imageBasePath($media->title)}}" class="img-fluid w-20">
                        </div>
                        @endforeach
                    </div>
                  </div>

                  <span class="span-style1 mt-5">See all videos</span>

                  <hr>
                </div>
              </div>
              <div class="row mobileveiw">
                <div class="col-md-12">
                  <div class="wrap-gallery my-3">
                    <div class="Gallery-overlay d-flex">
                      <div class="Gallery-text-overlay-Image">
                        <img src="images/vedio17.jpg" class="img-fluid imagesCover">

                      </div>
                      <div class="Gallery-text-overlay-Image">
                        <img src="images/vedio18.jpg" class="img-fluid imagesCover">

                      </div>
                      <div class="Gallery-text-overlay-Image">
                        <img src="images/vedio19.jpg" class="img-fluid imagesCover">

                      </div>
                    </div>
                  </div>
                  <span class="span-style1 mt-5">See all videos</span>
                  <hr>
                </div>
              </div>
            </section>


            <div class="row py-2">
              <div class="col-md-12">
                <h2 class="sidetitleProducttitle1">Social Media</h2>
                <div class="py-2">
                    @foreach($user->socialMedia ?? [] as $socials)
                    <div class="Social-align d-flex align-items-center mt-3">
                        <img src="{{@asset('front/'.(config('cms.social_media_icon')[$socials->type]))}}" class="img-thumbnail mr-5">
                        <div class="link-text">{{$socials->value}}</div>
                    </div>
                    @endforeach

                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>


@endsection
