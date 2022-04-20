@extends('admin.layouts.master')

@section('title') Poll @endsection

@section('content')

    <section class="content-header">
        <h1> Poll</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li><a href="{{ route('admin.settings.index') }}"> {{ adminTransLang('all_settings') }} </a></li>
            <li class="active">Poll</li>
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
                                <label for="label" class="col-sm-2 control-label">Question</label>
                                <div class="col-sm-6">
                                <input type="text" name="question" class="form-control" value="{{@$poll->question}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select name="type"  class="form-control">
                                    @foreach (config('cms.poll_type') as $key => $value)
                                    <option value="{{$key}}" {{ @$poll->type == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status"  class="form-control">
                                    @foreach (config('cms.action_status') as $key => $value)
                                    <option value="{{$key}}" {{ @$poll->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <hr>

                            <span id="isExpandable" style="display: none;">
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="options[]" id="select-ajax" multiple>
                                            @switch(@$poll->type)
                                                @case(1)
                                                    @foreach (@$poll->products ?? [] as $product)
                                                    <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                    @endforeach
                                                    @break
                                                @case(2)
                                                    @foreach (@$poll->events ?? [] as $events)
                                                    <option selected value="{{@$events->event->id}}">{{@$events->event->name}}</option>
                                                    @endforeach
                                                    @break
                                                @case(3)
                                                    @foreach (@$poll->users ?? [] as $users)
                                                    <option selected value="{{@$users->user->id}}">{{@$users->user->username .' | '.$users->user->email}}</option>
                                                    @endforeach
                                                    @break
                                            @endswitch
                                        </select>
                                    </div>
                                </div>
                            </span>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="button" class="btn btn-success" id="updateBtn">Submit</button>
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
    jQuery(function ($) {

        // Change Type Event
        function onChangeOfType() {
            var isExpandable = $('#isExpandable');
            var type = $('[name="type"]');
            isExpandable.hide();
            if($.inArray(parseInt(type.val()),[1,2,3,4]) !== -1) {
                isExpandable.show();
            }
        }

        onChangeOfType();
        $(document).on('change','[name="type"]',function() {
            $('#select-ajax').val('');
            onChangeOfType()
        });
        // End Change Type Event

        // Select2 Ajax
        $("#select-ajax").select2({
            minimumInputLength: 2,
            maximumSelectionLength: 5,
            ajax: {
                url: '{{route("admin.polls.search")}}',
                // dataType: 'json',
                placeholder: "Search Item",
                allowClear: true,
                type: "GET",
                quietMillis: 100,
                delay: 250,
                data: function (term) {
                    return {
                        query: term,
                        type: $('[name="type"]').val()
                    };
                },
                processResults: function (data,params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * 50) < data.total
                        },
                        cache:true
                    }
                }
            }
        });
        // End Select1 Ajax


        // On Form Submit
        $(document).on('click', '#updateBtn', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.polls.create', ['id' => @$poll->id]) }}",
                data: $('form').serialize(),
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#updateBtn').attr('disabled', true);
                    $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#updateBtn').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#updateBtn').attr('disabled', false);
                    $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    window.location.replace('{{ route("admin.polls.index")}}');
                }
            });
        });
        // End On Form Submit
    });
</script>

@endsection
