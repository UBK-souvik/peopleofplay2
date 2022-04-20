@extends('admin.layouts.master')

@section('title') Create Event Category @endsection

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create event Category</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.event_category.index') }}"> All event Category </a></li>
            <li class="active">Create event Category</li>
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
                    <form class="form-horizontal" id="create-form" enctype="multipart/form-data">
                        <input type="hidden" name="event_id" value="{{@$event_category->id}}">

                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="name" placeholder="Name" value="{{@$event_category->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Parent Category <i class="has-error">*</i></label>

                        <div class="col-sm-6">
                            <select class="form-control" name="ecat_id">
                              <option value="">Select</option>
                              @if(count($roles))
                                @foreach($roles as $key => $role)
                                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                              @endif
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ adminTransLang('status') }} <i class="has-error">*</i></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                              @foreach(config('cms.action_status') as $key => $status)
                                <option value="{{ $key }}" {{isset($event_category) && $event_category->status == $key ? 'selected' : ''}}>{{ $status }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      @csrf

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                          <button type="button" class="btn btn-success" id="createBtn">Submit</button>
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
      $(document).on('click','#createBtn',function(e){
            e.preventDefault();
            $.ajax({
                processData: false,
                contentType: false,
                url: "{{ route('admin.event_category.create') }}",
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
                        window.location.replace('{{ route("admin.event_category.index")}}');

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
