@extends('admin.layouts.master')

@section('title') Create Award @endsection

@section('content')

@php 
$arr_nominee_custom = array();
@endphp

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create I Am A</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.event.index') }}"> All Awards </a></li>
            <li class="active">Create Award</li>
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
                        @csrf
                        <input type="hidden" value="{{ @$row->id }}" name="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Level<i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="level"
                              placeholder="Name" value="{{@$row->level}}">
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label for="categories" class="col-sm-2 control-label">Categories <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <select name="categories[]" id="" class="form-control select2 nominee_reference" multiple="">
                                    <option value="">Choose</option>
                                    @php 
                                    @$categoriesArr = explode(',',@$row->categories);
                                    @endphp


                                   @foreach(users_user_roles() as $role_key => $users_user_role)
                                    <option value="{{$role_key}}" @if(in_array(@$role_key,@$categoriesArr)){{ "selected" }} @endif >{{ $users_user_role }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
    jQuery(function($) {

   

        function ajaxSelect2() {
            // Select2 Ajax
            $(document).find(".select-ajax").select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{route("front.user.event.nominee")}}',
                    dataType: 'json',
                    tags: true,
                    placeholder: "Search Item",
                    allowClear: true,
                    type: "GET",
                    quietMillis: 100,
                    delay: 250,
                    data: function (term) {
                        var val = $('[name="type"]').val()
                        return {
                            query: term,
                            type: val
                            // type:
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 50) < data.total
                            },
                            cache: true
                        }
                    }
                }
            })
            .on('select2:select',function() {
                var val = $(this).val();
                console.log(val)
                if($.isNumeric(val)){
                    $(this).closest('.form-group').find('input[type="hidden"]').val(1)
                }
            });
            // End Select2 Ajax
        }

        // $('.select2').select2()
        $(document).on('submit','#create-form',function(e){
            e.preventDefault();
            $.ajax({
            processData: false,
            contentType: false,
            url: "{{ route('admin.feed_preference.iama.create') }}",
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
            	
            	var res = '';
            	if(msg.indexOf("essages.")>0)
            	{
            	   res = msg.split("essages.");	
            	   msg = res[1];
            	}
            	
                $('.message_box').html(msg).removeClass('hide');
            	console.log(msg);
            },
            success: function (data)
            {
                $('#createBtn').attr('disabled',false);
                if(data.status == 1)
                {
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.replace('{{ route("admin.feed_preference.iama.index")}}');

                } else {
                    var message = formatErrorMessageFromJSON(data.errors);
                    $('.message_box').html(message).removeClass('hide');
                }

            }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[name$='winner_type']").click(function() {
            var test = $(this).val();
            winner_type(test);
        });
    });

    function winner_type(test){
        $("div.winner_div").hide();
        $("#winner" + test).show();
    }
</script>

@endsection
