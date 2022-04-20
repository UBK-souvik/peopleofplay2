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
                                    <a href="{{ $row2->url }}">
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
                            <a class="btn" href="{{ url(Request::segment(1).'/'.$row->slug) }}"><span class="ButtonText">THESE STORIES AND MORE!</span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
@endsection
