@extends('admin.layouts.master')

@section('title') View profiles @endsection

@section('content')
<style>
    .social_media .form-group {
         margin-right: 0px;
         margin-left: 0px;
    }
</style>

    <section class="content-header">
        <h1> View profile</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.event.index') }}"> All profile </a></li>
            <li class="active">View profile</li>
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
                                                    @if(@$event_profile->main_image)
                                                        <img id="blah" width="100" height="70" src="{{imageBasePath($event_profile->main_image)}}" class="imgHundred">
                                                    @else
                                                        <img id="blah" src="#" alt="Preview" class="imgHundred">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{@$event_profile->profileName}}</td>
                                            </tr>
                                            <tr>
                                                <th>URL</th>
                                                <td><a target="_blank" href="{{@$event_profile->profileUrl}}">{{@$event_profile->profileUrl}}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Subtitle</th>
                                                <td>{{@$event_profile->profileSubtitle}}</td>
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


@section('scripts')

<script type="text/javascript">
    jQuery(function($) {
    $('.select2').select2()
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
            $.ajax({
                processData: false,
                contentType: false,
                url: "{{ route('admin.event.create') }}",
                data: new FormData($('form')[0]),
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
                        window.location.replace('{{ route("admin.event.index")}}');

                    } else {
                        var message = formatErrorMessageFromJSON(data.errors);
                        $('.message_box').html(message).removeClass('hide');
                    }

                }
            });
        });
    });
</script>

@endsection
