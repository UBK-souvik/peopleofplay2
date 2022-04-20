@extends('admin.layouts.master')

@section('title') View Pub @endsection

@section('content')
<style>
    .social_media .form-group {
         margin-right: 0px; 
         margin-left: 0px; 
    }
</style>

    <section class="content-header">
        <h1> View Pub</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.pub.index') }}"> All Pub </a></li>
            <li class="active">View Pub</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body" id="add-edit-user-main-box-body-div">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                            <div class="accordion">
                                <div class="accordion__header is-active">
                                    <h2>Basic Details</h2>
                                    <span class="accordion__toggle"></span>
                                </div>
                                <div class="accordion__body is-active">
                                    <table class="table table-striped table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>Main Image</th>
                                                <td>
                                                    @if(@$event->main_image)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event->main_image)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Header</th>
                                                <td>{!! @$event->header !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Text 1</th>
                                                <td>{{ $event->zoom_text_1 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Image 1</th>
                                                <td>
                                                    @if(@$event->zoom_image_1)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_1)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Text 2</th>
                                                <td>{{ $event->zoom_text_2 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Image 2</th>
                                                <td>
                                                    @if(@$event->zoom_image_2)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_2)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Text 3</th>
                                                <td>{{ $event->zoom_text_3 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Image 3</th>
                                                <td>
                                                    @if(@$event->zoom_image_3)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_3)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Text 4</th>
                                                <td>{{ $event->zoom_text_4 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Zoom Image 4</th>
                                                <td>
                                                    @if(@$event->zoom_image_4)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event->zoom_image_4)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>News 1</th>
                                                <td>{!! @$event->news_1 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 2</th>
                                                <td>{!! @$event->news_2 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 3</th>
                                                <td>{!! @$event->news_3 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 4</th>
                                                <td>{!! @$event->news_4 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 5</th>
                                                <td>{!! @$event->news_5 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 6</th>
                                                <td>{!! @$event->news_6 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 7</th>
                                                <td>{!! @$event->news_7 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 8</th>
                                                <td>{!! @$event->news_8 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 8</th>
                                                <td>{!! @$event->news_8 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 9</th>
                                                <td>{!! @$event->news_9 !!}</td>
                                            </tr>
                                            <tr>
                                                <th>News 10</th>
                                                <td>{!! @$event->news_10 !!}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


