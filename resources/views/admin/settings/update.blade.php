@extends('admin.layouts.master')

@section('title') {{ adminTransLang('edit_setting') }} @endsection

@section('content')

    <section class="content-header">
        <h1> {{ adminTransLang('edit_setting') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li><a href="{{ route('admin.settings.index') }}"> {{ adminTransLang('all_settings') }} </a></li>
            <li class="active">{{ adminTransLang('edit_setting') }}</li>
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
                                <label for="label" class="col-sm-2 control-label">{{ adminTransLang('attribute') }}</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="label" placeholder="{{ adminTransLang('attribute') }}" value="{{ $setting->label }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="value" class="col-sm-2 control-label">{{ adminTransLang('value') }}</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="value" placeholder="{{ adminTransLang('value') }}" value="{{ $setting->value }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn">{{ adminTransLang('update') }}</button>
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
            
            $.ajax({
                url: "{{ route('admin.settings.update', ['id' => $setting->id]) }}",
                data: $('form').serialize(),
                dataType: 'json',
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
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.replace('{{ route("admin.settings.index")}}');
                }
            });
        });
    });
</script>

@endsection