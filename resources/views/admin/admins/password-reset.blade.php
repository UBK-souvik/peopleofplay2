@extends('admin.layouts.master')

@section('title') {{ adminTransLang('reset_password') }} @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ adminTransLang('reset_password') }} </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href='{{ route("admin.admins.index") }}'> {{ adminTransLang('all_admins') }} </a></li>
            <li class="active">{{ adminTransLang('reset_password') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="resetPassword-form" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">{{ adminTransLang('new_password') }}</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" placeholder="{{ adminTransLang('new_password') }}" value="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password_confirmation" class="col-sm-2 control-label">{{ adminTransLang('confirm_password') }}</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password_confirmation" placeholder="{{ adminTransLang('confirm_password') }}" value="">
                        </div>
                      </div>
                      <input type="hidden" name="_token" value="{{ Session::token() }}">

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="resetPasswordBtn">{{ adminTransLang('change_password') }}</button>
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
       $(document).on('click','#resetPasswordBtn',function(e){
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('admin.admins.password-reset', ['id' => $id]) }}",
                data: $('#resetPassword-form').serialize(),
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                {
                    $('#resetPasswordBtn').attr('disabled',true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function(jqXHR, exception){
                    $('#resetPasswordBtn').attr('disabled',false);
                    
                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data)
                {
                    $('#resetPasswordBtn').attr('disabled',false);
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');

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