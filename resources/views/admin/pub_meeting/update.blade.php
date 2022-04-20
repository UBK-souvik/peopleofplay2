@extends('admin.layouts.master')

@section('title') {{ adminTransLang('edit_setting') }} @endsection

@section('content')

    <section class="content-header">
        <h1> Edit Pub Heading</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li><a href="{{ route('admin.pub_heading.pub_meeting') }}"> {{ adminTransLang('all_settings') }} </a></li>
            <li class="active">Edit Pub Heading</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Heading <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="heading" placeholder="Heading" value="{{ @$setting->heading }}">
                                    <input type="hidden" name="id" value="{{@$setting->id}}">
                                    <input type="hidden" name="type" value="@if(!empty(@$setting->type)){{@$setting->type}}@else{{ @$type }}@endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Meeting URL <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="url" placeholder="Meeting URL" value="{{ @$setting->url }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Status <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <select name="status" class="form-control" id="">
                                        <option @if(@$setting->status == '1'){{ 'selected' }}@endif value="1">Active</option>
                                        <option @if(@$setting->status == '0'){{ 'selected' }}@endif value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">Add Image <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if(@$setting->image)
                                    <img src="{{asset('uploads/images/pub/'.@$setting->image)}}" class="imgHundred news_image" alt="" id="blah">
                                    <input type="hidden" name="is_image" value="{{@$setting->image}}">
                                    @else
                                    <img src="{{asset('front/new/images/Product/team_new.png')}}" class="imgHundred news_image" alt="" id="blah">
                                    @endif
                                    <input type="file" name="featured_image" class="marginTopFive" onchange="readURL(this,'blah');">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn">Save</button>
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
    jQuery(function($) {
      $(document).on('click','#updateBtn',function(e){
            e.preventDefault();
            var fd = new FormData($('form')[0]); 
            $.ajax({
                url: "{{ route('admin.pub_heading.save_meeting', ['id' => @$setting->id]) }}",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                type: 'POST',
                beforeSend: function() {
                    $('#updateBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception) {
                    $('#updateBtn').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#updateBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('{{ route("admin.pub_heading.pub_meeting")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }
                }
            });
        });
    });

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

</script>

@endsection