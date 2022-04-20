@extends('admin.layouts.master')

@section('title') {{ adminTransLang('manage_permissions') }} @endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> {{ adminTransLang('manage_permissions') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
        <li><a href="{{ route('admin.admins.index') }}"> {{ adminTransLang('all_admins') }} </a></li>
        <li class="active">{{ adminTransLang('manage_permissions') }}</li>
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
                <input type="hidden" name="navigation_id[]" value="1">
                @if(count($navigations))
                    @foreach($navigations[0] as $groupId => $group) 
                        <div id="permission-user-{{ $groupId }}" class="col-sm-12">
                            <label for="chkAll_{{ $groupId }}" class="col-sm-4">
                                <strong>{{ $group }}</strong>
                            </label>
                            <div class="col-sm-8">        
                                <label>
                                    <input type="checkbox" id="chkAll_{{ $groupId }}" name="navigation_id[]" value="{{ $groupId }}" class="checkAll" {{ $groupId == 1 ? 'disabled' : '' }} {{ $groupId == 1 ? 'checked' : (in_array($groupId, $userPermissions) ? 'checked' : '') }}> 
                                </label>  
                            </div>

                            @if(isset($navigations[$groupId]) && count($navigations[$groupId]))
                                @foreach ($navigations[$groupId] as $navigation_id => $name)
                                    <label for="chkAll_{{ $navigation_id }}" class="col-sm-4 small_label">
                                        {{ $name }}
                                    </label>              
                                    <div class="col-sm-2">
                                        <label>
                                            <input type="checkbox" id="chkAll_{{ $navigation_id }}" name="navigation_id[]" value="{{ $navigation_id }}" {{ in_array($navigation_id, $userPermissions) ? 'checked' : '' }}> 
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif

                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                      <button type="button" class="btn btn-success" id="createBtn">{{ adminTransLang('save_permission') }}</button>
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
      $(document).on('click','#createBtn',function(e){
        e.preventDefault()
        $.ajax({
            url: "{{ route('admin.admins.permission.save', ['id' => Request::segment(4) ]) }}",
            data: $('#create-form').serialize(),
            dataType: 'json',
            type: 'POST',
            beforeSend: function()
            {
                $('#createBtn').attr('disabled',true)
                $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger')
            },
            error: function(jqXHR, exception){
                $('#createBtn').attr('disabled',false)

                var msg = formatErrorMessage(jqXHR, exception)
                $('.message_box').html(msg).removeClass('hide')
            },
            success: function (data)
            {
                $('#createBtn').attr('disabled',false)
                if(data.status == 1)
                {
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success')
                    window.location.replace('{{ route("admin.admins.index")}}')

                } else {
                    var message = formatErrorMessageFromJSON(data.errors)
                    $('.message_box').html(message).removeClass('hide')
                }

            }
        })
    })

    $(document).on('change', '.checkAll', function(e){
        var ContainerID = $(this).val();
        var status = this.checked ? true : false;
        $("#permission-user-"+ContainerID).find("input[type=checkbox]").each(function(){
            this.checked = status;
        })  
    });
})
</script>

@endsection