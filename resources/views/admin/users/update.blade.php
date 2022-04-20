@extends('admin.layouts.master')

@section('title') {{ adminTransLang('edit_user') }} @endsection

@section('content')
    <section class="content-header">
        <h1> {{ adminTransLang('edit_user') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.users.index') }}">{{ adminTransLang('all_users') }}</a></li>
            <li class="active">{{ adminTransLang('edit_user') }}</li>
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
                                <label for="name" class="col-sm-2 control-label">{{ adminTransLang('name') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" placeholder="{{ adminTransLang('name') }}" value="{{ $user->name }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">{{ adminTransLang('email') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" placeholder="{{ adminTransLang('email') }}" value="{{ $user->email }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="mobile" class="col-sm-2 control-label">{{ adminTransLang('mobile') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="gender" class="col-sm-2 control-label">{{ adminTransLang('gender') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="gender">
                                        <option value="">{{ adminTransLang('select') }}</option>
                                        @foreach(config('cms.gender') as $value)
                                        <option value="{{ $value }}" {{ $user->gender == $value ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="profile_image" class="col-sm-2 control-label">{{ adminTransLang('profile_image') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    @if($user->profile_image)
                                        <img alt="" src="{{ $user->profile_image }}" width="60" height="60" style="float:left;"/>
                                    @endif
                                    <input type="file" name="profile_image">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="status">
                                        @foreach(config('cms.user_status') as $key => $status)
                                            <option value="{{ $key }}" {{ ($user->status == $key) ? 'selected="selected"' : ''}}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-offset-1 col-sm-6">
                            <button type="button" class="btn btn-success" id="updateBtn">{{ adminTransLang('update') }}</button>
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
            $("[name='mobile']").intlTelInput();
            if('{{ $user->dial_code }}' in dial_codes) {
                $("[name='mobile']").intlTelInput("setCountry", dial_codes['{{ $user->dial_code }}']);
            }
            
            $(document).on('click','#updateBtn',function(e){
                e.preventDefault();
                if($.trim($('[name="mobile"]').val()) != '' && $('[name="mobile"]').intlTelInput("isValidNumber") == false) {
                    $('.message_box').html('{{ adminTransLang("invalid_mobile_no") }}').removeClass('alert-success hide').addClass('alert-danger');;
                    return false;
                }

                var phone = $('[name="mobile"]').intlTelInput("getSelectedCountryData");
                $('[name="mobile"]').val(($('[name="mobile"]').val()).replace(/ /g, ''));
                var fd = new FormData($('form')[0]);
                
                fd.append('dial_code', phone.dialCode);

                $.ajax({
                    url: "{{ route('admin.users.update', ['id' => $user->id]) }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#updateBtn').attr('disabled',true);
                        $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#updateBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
                        $('.message_box').html(msg).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#updateBtn').attr('disabled',false);
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');

                        window.location.replace('{{ route("admin.users.index")}}');
                    }
                });
            });
        });
    </script>

@endsection