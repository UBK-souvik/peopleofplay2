@extends('front.layouts.pages')
@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-width">
                    <div class="left-column">
                        <div class="First-column bg-white px-2 pt-3">
                            <!-- First Section of intro -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="image-width justifly-content-center">
                                        <img src="{{imageBasePath($event->main_image)}}" class="img-fluid mr-3">
                                        <div class="paragraph">
                                            <h2>{{$event->name}}</h2>
                                            <ul class="d-flex flex-row ul-text-color">
                                                <li>{{$event->category->name ?? null}}</li>
                                                <li class="mx-3">{{$event->subCategory->name ?? null}}</li>
                                            </ul>
                                            <p class="p-text">{{$event->description}}<br><br>

                                                Began: {{$event->year_started}}<br><br>

                                                Company: <span class="span-style"> {{$event->company}}</span><br>
                                                Company Info: {{$event->company_info}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wrap-gallery mb-3">
                                        <div class="Gallery-overlay d-flex flex-row ">
                                            {{-- {{dd($event->media)}} --}}
                                            @foreach($event->media ?? [] as $media)
                                            @if($media->media_type == 1)
                                            <div class="Gallery-text-overlay thisiis">
                                                <img src="{{imageBasePath($media->title)}}" class="img-fluid w-20">
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <small><span class="span-style">{{$event->media->where('media_type',1)->count() ?? 0}} photos &nbsp; &nbsp; | &nbsp; &nbsp;
                                        {{$event->media->where('media_type',2)->count() ?? 0}}  videos
                                            &nbsp; &nbsp; |
                                            &nbsp; &nbsp; {{$event->media->where('media_type',3)->count() ?? 0}}  articles &nbsp; &nbsp; &gt;&gt;</span></small>

                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wrap-gallery my-3">
                                        <div class="Gallery-overlay d-flex justify-content-around">
                                            <div class="Gallery-text-overlay-Image">
                                                <img src="{{asset('front/new/images/Events/images8.jpg')}}" class="img-fluid imagesCover">
                                                <div class="overlayimages5"><b>TOY INNOVATOR OF THE YEAR</b>
                                                </div>
                                            </div>
                                            <div class="Gallery-text-overlay-Image">
                                                <img src="{{asset('front/new/images/Events/images8.jpg')}}" class="img-fluid imagesCover">
                                                <div class="overlayimages5"><b>GAME INNOVATOR OF THE YEAR</b>
                                                </div>
                                            </div>
                                            <div class="Gallery-text-overlay-Image">
                                                <img src="{{asset('front/new/images/Events/images8.jpg')}}" class="img-fluid imagesCover">
                                                <div class="overlayimages5"><b>YOUNG INVENTOR OF THE YEAR</b>
                                                </div>
                                            </div>
                                            <div class="Gallery-text-overlay-Image">
                                                <img src="{{asset('front/new/images/Events/images8.jpg')}}" class="img-fluid imagesCover">
                                                <div class="overlayimages5"><b>RISING STAR INNOVATOR OF THE YEAR</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="span-style mt-5 px-3">See all birthdays >></span>
                                    <hr class="mt- bg-dark">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wrap-gallery mb-3">
                                        <div class="wrap-text">
                                            <h3 class="mb-5 mt-3">Awards</h3>
                                        </div>
                                        <div class="Gallery-overlay d-flex">
                                            @foreach($event->awards->nth(2) as $award)
                                            <div class="Gallery-text-overlay">
                                                <img src="{{asset('front/new/images/Events/images9.jpg')}}" class="img-fluid imagesCover">
                                                <div class="overlayimages6">{{$award->name}}
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <span class="span-style">See more Top & Game awards >></span>

                                </div>
                            </div>
                        </div>
                        <div class="NextbackgroundColor">
                            <div class="d-flex text-white p-3 mt-3">
                                <h3>Did you know?</h3>
                                <p class="span-style ml-auto"> Top| Toys | Games | Celebs></p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container">
                                        <div class="wrap-gallery my-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="images/Homepageimage/image16.jpg" class="img-fluid mr-3">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="paragraphdesign">
                                                        <p>There is a Star Wars video game!<br>
                                                            2 days ago | <span
                                                                class="span-style">London</span><br><br>The actors of
                                                            the early Star
                                                            Wars have voiced a video game? In this game, you assume the
                                                            role of Luke Skywalker and
                                                            fight past many enemies to to reach and destroy the Death
                                                            Star. <br>This game was
                                                            featured in Star Wars: Rogue Squadron III - Rebel Strike
                                                            (2003)<span class="span-style">See more>></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="span-style mt-5 px-3">See more Top News >></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-white p-3 mt-3">
                            <h3>Poll: Favorite Game</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wrap-gallery my-3">
                                    <div class="Gallery-overlay d-flex justify-content-around">
                                        <div class="Gallery-text-overlay-Image">
                                            <img src="images/Homepageimage/image17.jpg" class="img-fluid imagesCover">
                                        </div>
                                        <div class="Gallery-text-overlay-Image">
                                            <img src="images/Homepageimage/image18.jpg" class="img-fluid imagesCover">
                                        </div>

                                        <div class="Gallery-text-overlay-Image">
                                            <img src="images/Homepageimage/image19.jpg" class="img-fluid imagesCover">
                                        </div>

                                        <div class="Gallery-text-overlay-Image">
                                            <img src="images/Homepageimage/image20.jpg" class="img-fluid imagesCover">
                                        </div>
                                        <div class="Gallery-text-overlay-Image">
                                            <img src="images/Homepageimage/image21.jpg" class="img-fluid imagesCover">
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-style1 rounded-0 text-center">Vote for your
                                favorite</button>
                        </div>
                        <div class="d-flex text-white p-3 mt-3">
                            <h3>The Chicago Toy & Game Week 2017</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <div class="wrap-gallery my-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="images/Homepageimage/image22.png" class="img-fluid mr-3">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="paragraphdesign text-white">
                                                    <p>See everything that is happening in Chicago in celebration of the
                                                        annual Chicago Toy &
                                                        Game Week 2017​<br><span class="span-style">&nbsp;See complete
                                                            itinerary>></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>
                    <div class="right-column px-3">
                        <div class="text-center mt-3">
                            <img src="images/Events/images11.jpg" class="img-fluid text-center my-2">
                            <p><span class="span-style">ad feedback</span></p>
                        </div>
                        <hr>
                        <div class="text-center p-text">
                            <p>Quick Links</p>
                        </div>

                        <ul class="list-align align-items-start mt-3 pl-5">
                            <a href="#!">
                                <li>Biography</li>
                            </a>
                            <a href="#!">
                                <li>Awards</li>
                            </a>
                            <a href="#!">
                                <li>Photo gallery</li>
                            </a>
                            <a href="#!">
                                <li>Play-o-graphy</li>
                            </a>
                            <a href="#!">
                                <li>Videos</li>
                            </a>
                        </ul>
                        <hr>

                        <div class="text-center p-text pb-3">
                            <p>People of Play picks: September</p>
                            <img src="images/Events/images12.jpg" class="img-fluid text-center my-2">
                        </div>

                        <p class="side-paragraph pt-3">A story of survival and resilience leads to joy for generations
                            of
                            children. <br><br>
                            What do popsicles, motorized bicycles, and Anne Frank have to do with one another? They are
                            all part of
                            the path that led Ora and Theo Coster to the stage at the 2012 TAGIE Awards to be honored
                            for Lifetime
                            Achievement. Theirs is an inspiring story that spans continents, decades.…and the terror of
                            wars.
                            <br><br>

                            Their most famous creation: <span class="span-style">Guess Who?<span>


                        </p>

                        <hr>
                        <div class="text-center p-text">
                            <p>Top 10 Toys</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th scope="row">Razor scooter</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fairy Garden</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">in store</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bilderhoos</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Edwin the Duck</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Enigmaze</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">in store</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fashion Angels</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mr. Game</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lionel Trains</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lite Poppers</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">in store</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kelele</th>
                                    <td colspan="2"></td>
                                    <td class="text-right">buy</td>
                                </tr>
                            </table>
                        </div>
                        <span class="span-style">See more popular toys & games >></span>
                        <hr>



                        <!-- Section -->
                        <div class="text-center p-text">
                            <p>White Papers</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th scope="row">&lt;White paper title&gt;...</th>
                                    <td colspan="2"></td>
                                    <td class="text-right"> &lt;Author name &gt;</td>
                                </tr>
                                <tr>
                                    <th scope="row">&lt;White paper title&gt;...</th>
                                    <td colspan="2"></td>
                                    <td class="text-right"> &lt;Author name &gt;</td>
                                </tr>
                                <tr>
                                    <th scope="row">&lt;White paper title&gt;...</th>
                                    <td colspan="2"></td>
                                    <td class="text-right"> &lt;Author name &gt;</td>
                                </tr>
                                <tr>
                                    <th scope="row">&lt;White paper title&gt;...</th>
                                    <td colspan="2"></td>
                                    <td class="text-right"> &lt;Author name &gt;</td>
                                </tr>
                                <tr>
                                    <th scope="row">&lt;White paper title&gt;...</th>
                                    <td colspan="2"></td>
                                    <td class="text-right"> &lt;Author name &gt;</td>
                                </tr>
                            </table>

                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-style rounded-0 text-center">Sign Up</button>
                        </div>
                        <hr>
                        <div class="text-center p-text">
                            <p>Blogger of the Month</p>
                            <img src="images/Homepageimage/image24.jpg" class="img-fluid text-center my-2"><br><span
                                class="span-style">Keri Wilmot<span>

                        </div>
                        <hr>
                        <center>
                            <iframe
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FChicagoToyAndGameWeek%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                                width="100%" height="140px" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </center>
                        <hr>
                        <center><a
                                href="https://twitter.com/intent/tweet?screen_name=ChicagoToyAndGameWeek&ref_src=twsrc%5Etfw"
                                class="twitter-mention-button" data-size="large" data-dnt="true"
                                data-show-count="true">Tweet to
                                @ChicagoToyAndGameWeek</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </center>
                        <hr>
                        <!--
            <div class="card">
              <img class="card-img-top" src="images/gallery7.jpg">
                  <div class="card-header bg-white">ManufacturingStories</div>
                <div class="card-body bg-white">Beth Engelman – Mommy on a Shoestring | ChiTAG (Chicago Toy and Game) Week – ManufacturingStories®</div>
                <div class="card-footer bg-white"><div class="image-width1 d-flex flex-row justifly-content-center">
                    <img src="images/pint.jpg" class="rounded-circle mr-3">
                     <div class="">
                      <p class="p-text2"><b>Mary Couzin - Chicago Toy & Game Fair CEO</b><br>Mary Couzin - Chicago Toy & Game Fair CEO
                      </p>
                       </div>
                    </div></div>
             </div>
            <hr>-->
                        <div class="text-center p-text">
                            <p>Around the web</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="image-width1 d-flex flex-row justifly-content-center">
                                    <img src="images/Homepageimage/image28.jpg" class="img-fluid mr-3">
                                    <div class="">
                                        <p class="p-text1">Marvel to launch Black Widow figurine<br><span
                                                class="span-style">lego.com</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="image-width1 d-flex flex-row justifly-content-center my-3">
                                    <img src="images/Homepageimage/image27.jpg" class="img-fluid mr-3">
                                    <div class="">
                                        <p class="p-text1">Old game with a new twist
                                            <br><span class="span-style">3ds.com</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="image-width1 d-flex flex-row justifly-content-center">
                                    <img src="images/Homepageimage/image29.jpg" class="img-fluid mr-3">
                                    <div class="">
                                        <p class="p-text1">Busy hatching another animal!
                                            <br><span class="span-style">hasbro.com</span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

