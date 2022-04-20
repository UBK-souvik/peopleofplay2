@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_settings') }} @endsection

@section('content')
    <style>
        .del_image{
            position: absolute;
            left: 107px;
            bottom: 160px;
            border-radius: 50px;
            background: #000;
            padding: 0px 5px;
        }
        .top_margin{
            margin-top: 10px !important;
        }
    </style>
    <section class="content-header">
        <h1> Feeds Advertisement </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li class="active">Feeds Advertisement</li>
        </ol>
    </section>

    <section class="content">
        @include('admin.includes.info-box')
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal" id="create-form" enctype="multipart/form-data" onsubmit="uploadAdImage(this); return false;">
                            <input type="hidden" name="id" value="{{@$data->id}}">

                            <div class="form-group">
                                <label for="check_image" class="col-sm-2 control-label">Right Top Ad Image (300x250) <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if(!empty($feeds_ad[0]->image))
                                        <a href="javascript:void(0)" onclick="delAdImg(this,'{{$feeds_ad[0]->id}}'); return false;"><span class="text-danger del_image"><i class="fa fa-times" aria-hidden="true"></i></span></a>
                                        <img id="blah" src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[0]->image)}}" alt="" class="imgHundred">
                                    @else
                                        <img id="blah" src="{{asset('front/new/images/Product/team_new.png')}}" alt="" class="imgHundred">
                                    @endif
                                    <input type="file" name="top_ad" class="marginTopFive image" onchange="readURL(this,'blah');">
                                    <input type="hidden" name="top_ad_image" id="top_ad_image" value="<?php if(isset($feeds_ad[0]->type) && !empty($feeds_ad[0]->type)) { echo $feeds_ad[0]->type; } ?> ">
                                    <div class="top_margin">
                                        <input type="url" class="form-control" name="top_ad_url" placeholder="Right Top Ad Image Url" value="<?php if(isset($feeds_ad[0]->url) && !empty($feeds_ad[0]->url)) { echo $feeds_ad[0]->url; } ?>">
                                    </div>                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="check_image" class="col-sm-2 control-label">Right Middle Ad Image (300x600) <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if(!empty($feeds_ad[1]->image))
                                        <a href="javascript:void(0)" onclick="delAdImg(this,'{{$feeds_ad[1]->id}}'); return false;"><span class="text-danger del_image"><i class="fa fa-times" aria-hidden="true"></i></span></a>
                                        <img id="blah_2" src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[1]->image)}}" alt="" class="imgHundred">
                                    @else
                                        <img id="blah_2" src="{{asset('front/new/images/Product/team_new.png')}}" alt="" class="imgHundred">
                                    @endif
                                    <input type="file" name="middle_ad" class="marginTopFive image" onchange="readURL(this,'blah_2');">
                                    <input type="hidden" name="middle_ad_image" id="check_image" value="<?php if(isset($feeds_ad[1]->type) && !empty($feeds_ad[1]->type)) { echo $feeds_ad[1]->type; } ?> ">
                                    <div class="top_margin">
                                        <input type="url" class="form-control" name="middle_ad_url" placeholder="Right Middle Ad Image Url" value="<?php if(isset($feeds_ad[1]->url) && !empty($feeds_ad[1]->url)) { echo $feeds_ad[1]->url; } ?>">
                                    </div>               
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="check_image" class="col-sm-2 control-label">Right Bottom Ad Image (300x250) <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if(!empty($feeds_ad[2]->image))
                                        <a href="javascript:void(0)" onclick="delAdImg(this,'{{$feeds_ad[2]->id}}'); return false;"><span class="text-danger del_image"><i class="fa fa-times" aria-hidden="true"></i></span></a>
                                        <img id="blah_3" src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[2]->image)}}" alt="" class="imgHundred">
                                    @else
                                        <img id="blah_3" src="{{asset('front/new/images/Product/team_new.png')}}" alt="" class="imgHundred">
                                    @endif
                                    <input type="file" name="bottom_ad" class="marginTopFive image" onchange="readURL(this,'blah_3');">
                                    <input type="hidden" name="bottom_ad_image" id="check_image" value="<?php if(isset($feeds_ad[2]->type) && !empty($feeds_ad[2]->type)) { echo $feeds_ad[2]->type; } ?> ">
                                    <div class="top_margin">
                                        <input type="url" class="form-control" name="bottom_ad_url" placeholder="Right Bottom Ad Image Url" value="<?php if(isset($feeds_ad[2]->url) && !empty($feeds_ad[2]->url)) { echo $feeds_ad[2]->url; } ?>">
                                    </div>               
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="check_image" class="col-sm-2 control-label">Left Ad Image (160x600) <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if(!empty($feeds_ad[3]->image))
                                        <a href="javascript:void(0)" onclick="delAdImg(this,'{{$feeds_ad[3]->id}}'); return false;"><span class="text-danger del_image"><i class="fa fa-times" aria-hidden="true"></i></span></a>
                                        <img id="blah_4" src="{{asset('uploads/images/feeds_ad/'.$feeds_ad[3]->image)}}" alt="" class="imgHundred">
                                    @else
                                        <img id="blah_4" src="{{asset('front/new/images/Product/team_new.png')}}" alt="" class="imgHundred">
                                    @endif
                                    <input type="file" name="right_ad" class="marginTopFive image" onchange="readURL(this,'blah_4');">
                                    <input type="hidden" name="right_ad_image" value="<?php if(isset($feeds_ad[3]->type) && !empty($feeds_ad[3]->type)) { echo $feeds_ad[3]->type; } ?> ">
                                    <div class="top_margin">
                                        <input type="url" class="form-control" name="righ_ad_url" placeholder="Left Ad Image Url" value="<?php if(isset($feeds_ad[3]->url) && !empty($feeds_ad[3]->url)) { echo $feeds_ad[3]->url; } ?>">
                                    </div>             
                                </div>
                            </div>

                            @csrf

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-success" id="createBtn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">
	
    function uploadAdImage(e){

        // var get_img=event.target.files[0];
		// var form_data = new FormData($(e)[0]);
        // form_data.append('featured_image', get_img);

        var form_data = new FormData($(e)[0]);  

        // var ckeditor_description_new = admin_get_ckeditor_description_new('description');
        // fd.append('description', ckeditor_description_new);
        $.ajax({
            processData: false,
            contentType: false,
            url: "{{ route('admin.FeedsAdController.uploadAdImage') }}",
            data: form_data,
            dataType: 'json',
            type: 'POST',
            beforeSend: function()
            {
                $('#createBtn').attr('disabled',true);
                $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
            },
            error: function(jqXHR, exception){
                $('#createBtn').attr('disabled',false);

                var msg = formatErrorMessage(jqXHR, exception);
                $('.message_box').html(msg).removeClass('hide');
            },
            success: function (data)
            {
                $('#createBtn').attr('disabled',false);
                if(data.status == 1)
                {
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.reload();

                } else {
                    var message = formatErrorMessageFromJSON(data.errors);
                    $('.message_box').html(message).removeClass('hide');
                }

            }
        });
    }
    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+id)
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function delAdImg(e,id){
        if(confirm('Are you sure to delete this image?')){
            $.ajax({            
                url: "{{ route('admin.FeedsAdController.deleteAdImage') }}",
                data: {id:id, _token:"{{ csrf_token() }}"},
                dataType: 'json',
                type: 'POST',
                success: function (data){
                    if(data.status == 1){
                        var img_src = "{{asset('front/new/images/Product/team_new.png')}}";
                        $(e).next('img').attr('src',img_src);
                        $(e).remove();
                        toastr.success(data.msg,'Success');
                    }
                }
            });
        }
    }

</script>
@endsection