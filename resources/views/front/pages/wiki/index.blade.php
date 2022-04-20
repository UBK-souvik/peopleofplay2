@extends('front.layouts.pages')
@section('content')

<link rel="stylesheet" href="{{ asset('front/new_css/wiki.css?'.time()) }}">
<div class="col-md-6 col-lg-7 MiddleColumnSection">
    <div class="container-width mt-0">


     <div class="left-column colheightleft">
        @if(Request::segment(1) == 'wiki')
        <div>
            <img src="{{ asset('front/images/WikiHeader.png') }}" alt="profileimage" class="img-fluid">
        </div>
        @elseif(Request::segment(1) == 'rest-in-play')
         <img src="{{ asset('front/images/RestInPlayHeader.jpg') }}" alt="profileimage" class="img-fluid">
        @endif
        <?php foreach ($data as $key => $row) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="imageboxhead text-center my-4">
                            <h2 style="color: #662e91;"> {{ $row->name }} </h2>
                            <p>  {{ $row->description }}  </p>
                        </div>
                    </div>
                </div>
                <div class="ImageBoxSection my-2">
                    <div class="row">
                        <?php foreach ($row->wiki as $key => $row2) { ?>
                            <div class="col-sm-6 col-lg-4 mb-2">
                                <div class="imagebox">
                                    <a href="{{ $row2->url }}" target="_blank">
                                        <img src="{{ @imageBasePath($row2->featured_image) }}" class="category-banner img-fluid">
                                        <span class="imagebox-desc"> {{ $row2->title }} </span>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="imagebtn text-center my-2">
                            <a class="btn" href="{{ url(Request::segment(1).'/'.$row->slug) }}"target="_blank"><span class="ButtonText">THESE STORIES AND MORE!</span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<div class="col-md-3 RightColumnSection">
<!--- ****************** || Category of POP Wiki || **************** --->
@if(!empty($categories) && count($categories)>0)
<div class="popRecentBlog">
   <div class="RecentBlogHead mb-3">
    @php
      if(Request::segment(1)=='wiki') {
        @$category_type = 'Category of POP Wiki';
      } else if(Request::segment(1)=='rest-in-play') {
         @$category_type = 'Decades';
      } else if(Request::segment(1)=='entertainment') {
         @$category_type = 'Category of POP Entertainment';
      } else if(Request::segment(1)=='popcast') {
         @$category_type = 'Category of POP Cast';
      }
    @endphp
      <h4 class="mb-0">{{ @$category_type}} </h4>
   </div>
   <hr>
   <div class="PopCategoryList">
      <ul class="nav flex-column">
        @foreach($categories as $row)
         <li class="nav-item">
            <a class="nav-link" href="{{ url(Request::segment(1).'/'.$row->slug)}}"> {{ $row->name }}</a>
         </li>
         @endforeach
      </ul>
   </div>
</div>
@endif
<!--- ****************** || Category of POP Wiki || **************** --->
</div>
@endsection
