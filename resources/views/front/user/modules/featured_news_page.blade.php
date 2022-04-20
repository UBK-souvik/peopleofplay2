@php

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

  

@endphp

<!-- NextbackgroundColor border-bottom -->

    <div class="col-md-12 NextbackgroundColor1 userprofileBorder">

        <div class="row homesectionBox paddingTopTwenty paddingBottomTwenty">

            <div class="{{$str_featured_main_class}} pl-0">

                <div>

                    <!-- <h2 class="blog_title header_purple">Featured News</h2> -->

                    <a href="{{route('front.pages.did-you-know.detail',$news->slug)}}">

                        <h2 class="blogInnerTitle">{{$news->title}}</h2>

                    </a>

                </div>

                <div class="row mt-4">

                    <div class="col-md-12">

                        <div class="mb-1">

						    <a href="{{route('front.pages.did-you-know.detail',$news->slug)}}">

                            <img @if(!empty($news->is_home_page)){{"class=imgThreeTen"}} @else {{"class=imgThreeTen"}} @endif  src="{{@newsBlogImageBasePath($news->featured_image)}}">

                            </a>

						</div>

                    </div>

                    <div class="col-md-12">

                        <div @if(empty($news->is_home_page)){{"class=featured-news-description-class-new11"}} @endif>

                            <!-- <a href="{{route('front.pages.news.detail',$news->slug)}}">

							<h2 class="blogInnerTitle">{{$news->title}}</h2>

                            </a> -->

							<div class="category_article_date mb-1">

                                <small>{{App\Helpers\Utilities::getDateFormat($news->created_at)}} By People Of Play </small>

                            </div>

                            <p class="blogPara my-0">

							@if(!empty($news->is_home_page))

							  {!!App\Helpers\Utilities::getFilterDescriptionHome($news->description, 2)!!}

							@else

							  {!!App\Helpers\Utilities::getFilterDescriptionHome($news->description, 1)!!}

							@endif

							</p>

                            <div>

                                <span >

								<a @if(!empty($slug) && $int_chk_is_home_page<=0) href="{{ route('front.pages.user.news', $slug)}}" @else href="{{route('front.pages.news')}}" @endif class="span-style1">Browse more News >></a></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            

			@if(!empty($int_chk_is_home_page) && $int_chk_is_home_page>0)

			

				<div class="col-md-4 paddingLeftZero marginTopMob">  

                    <div>

                        <h2 class="blogSideHomeTitle header_purple">Popular News</h2>

                    </div>                  

                    

					@foreach($popular_news as $popular_news_row)

						<div class="row mt-3">

							<div class="col-md-3 col-sm-3 col-3 pr-0 mb-2">

							    <a href="{{route('front.pages.news.detail',$popular_news_row->slug)}}">

								<img class="img-fluid blogSideHomeImg" @if(!empty($popular_news_row->featured_image)) src="{{@newsBlogImageBasePath($popular_news_row->featured_image)}}" @else  src="{{asset('front/images/lego_toys_img.jpeg')}}" @endif>

							    </a>

							</div>

							<div class="col-md-9 col-sm-9 col-9">

								<a href="{{route('front.pages.news.detail',$popular_news_row->slug)}}">

								<h2 class="blogSideInnerTitle">{{substr($popular_news_row->title, 0, 60)}}</h2>

								</a>

								<div class="">

									<small class="blogSideHomeSmall">{{App\Helpers\Utilities::getDateFormat($popular_news_row->created_at)}} By People Of Play</small>

								</div>

							</div>

						</div>

					@endforeach

                </div>

			@endif

		

            <!-- <div>

                <span ><a href="{{route('front.pages.news')}}" class="span-style1">Browse more News >></a></span>

            </div> -->

        </div>

    </div>