@extends('admin.layouts.master')

@section('title') {{ adminTransLang('edit_role') }} @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ adminTransLang('edit_role') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.role.index') }}"> {{ adminTransLang('all_role') }} </a></li>
            <li class="active">{{ adminTransLang('edit_role') }}</li>
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
                    <form class="form-horizontal" id="update-form" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ adminTransLang('name') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="name" placeholder="{{ adminTransLang('name') }}" value="{{ $role->name }}">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                                <option value="{{ $role->id }}">Select</option>
                              @foreach(config('cms.action_status') as $key => $status)
                                <option value="{{ $key }}" {{ ($role->status == $key) ? 'selected="selected"' : ''}}>{{ $status }}</option>
                              @endforeach
                            </select>
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
                url: "{{ route('admin.role.update', ['id' => $role->id]) }}",
                data: $('#update-form').serialize(),
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
                    if(data.status == 1)
                    {
                        $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                        window.location.replace('{{ route("admin.role.index")}}');

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