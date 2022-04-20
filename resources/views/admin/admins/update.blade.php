@extends('admin.layouts.master')

@section('title') {{ adminTransLang('edit_admin') }} @endsection

@section('content')
  {{! $user = Auth::guard('admin')->user() }}
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ adminTransLang('edit_admin') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.admins.index') }}"> {{ adminTransLang('all_admins') }} </a></li>
            <li class="active">{{ adminTransLang('edit_admin') }}</li>
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
                    <form class="form-horizontal" id="update-form">
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ adminTransLang('name') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="name" placeholder="{{ adminTransLang('name') }}" value="{{ $admin->name }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">{{ adminTransLang('email') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="email" class="form-control" name="email" placeholder="{{ adminTransLang('email') }}" value="{{ $admin->email }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="col-sm-2 control-label">{{ adminTransLang('mobile') }} <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="mobile" placeholder="{{ adminTransLang('mobile') }}" value="{{ $admin->mobile }}">
                        </div>
                      </div>
                       @if($user->id != $admin->id)
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              <!-- <option value="">Select</option> -->
                              @foreach(config('cms.user_status') as $key => $status)
                                <option value="{{ $key }}" {{ ($admin->status == $key) ? 'selected="selected"' : ''}}>{{ $status }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">{{ adminTransLang('user_type') }} <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                            <select class="form-control" name="role_id">
                              <option value="">Select</option>
                              @if(count($roles))
                                @foreach($roles as $key => $role)
                                  <option value="{{ $role->id }}" {{ ($admin->role_id == $role->id) ? 'selected="selected"' : ''}}>{{ $role->name }}</option>
                                @endforeach
                              @endif
                            </select>
                        </div>
                      </div>
                      @endif
                      <div class="form-group">
                        <label for="locale" class="col-sm-2 control-label">{{ adminTransLang('locale') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="locale">
                              <option value="">Select</option>
                              @foreach(config('cms.user_locale') as $key => $locale)
                                <option value="{{ $key }}"  {{ ($admin->locale == $key) ? 'selected="selected"' : ''}}>{{ $locale }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ adminTransLang('profile_image') }}</label>
                        <div class="col-sm-6">
                            @if($admin->profile_image)
                            <img alt="" src="{{ $admin->profile_image }}" width="60" height="60" style="float:left;"/>
                            @endif
                            <input type="file" name="profile_image">
                        </div>
                      </div>

                      <input type="hidden" name="_token" value="{{ Session::token() }}">

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
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection


@section('scripts')

<script type="text/javascript">
    jQuery(function($) {
       $(document).on('click','#updateBtn',function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.admins.update', ['id' => $admin->id]) }}",
                data:new FormData($('form')[0]),
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

                    if('{{ $admin->id }}' != 1) {
                        window.location.replace('{{ route("admin.admins.index")}}');
                    }
                }
            });
        });
    });
</script>

@endsection
