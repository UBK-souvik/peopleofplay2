@extends('admin.layouts.master')

@section('title') Edit HomePage @endsection

@section('content')

    <section class="content-header">
        <h1> Edit HomePage</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }} </a></li>
            <li><a href="{{ route('admin.cms.home_page.index')}}"> Home Page List </a></li>
            <li class="active">Edit HomePage</li>
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
                            
							<?php /*<div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Display Order</label>
                                <div class="col-sm-6">
                                    <select name="display_order" class="form-control">
                                        @if(@$home_page->display_order == 0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                @if($key == 0)
                                                    <option value="{{$key}}" {{ $home_page->display_order == $key ? 'selected' : ''}}>{{$key}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(@$home_page->display_order != 0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                @if($key != 0)
                                                    <option value="{{$key}}" {{ $home_page->display_order == $key ? 'selected' : ''}}>{{$key}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div> */?>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" value="{{$home_page->title}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select name="type"  class="form-control">
                                        @if(@$home_page->display_order == 0 && $home_page->type == 0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                    <option value="{{$key}}" {{ $home_page->type == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        @endif
                                        @if(@$home_page->display_order == 0 && $home_page->type!=0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                    <option value="{{$key}}" {{ $home_page->type == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        @endif
										@if(@$home_page->display_order != 0 && $home_page->type!=0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                    <option value="{{$key}}" {{ $home_page->type == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        @endif
										@if(@$home_page->display_order != 0 && $home_page->type ==0)
                                            @foreach (config('cms.home_page_type') as $key => $value)
                                                    <option value="{{$key}}" {{ $home_page->type == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status"  class="form-control">
                                    @foreach (config('cms.action_status') as $key => $value)
                                    <option value="{{$key}}" {{ $home_page->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- for a pop advertise -->
                            @if($home_page->type!=8)

                            <hr>

                            <span id="isExpandable" style="display: none;">
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label expandable-label">Add Items</label>
                                    <div class="col-sm-6">
                                        <select  class="form-control" name="expandable[]" id="select-ajax" multiple>
                                            @switch($home_page->type)
                                                @case(1)
                                                    @foreach ($home_page->products ?? [] as $product)
                                                    <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                    @endforeach
                                                    @break
                                                @case(2)
                                                    @foreach ($home_page->events ?? [] as $events)
                                                    <option selected value="{{@$events->event->id}}">{{@$events->event->name}}</option>
                                                    @endforeach
                                                    @break
                                                @case(6)
                                                    @foreach ($home_page->users ?? [] as $users)
                                                        @if(!empty($users->user->first_name))
                                                            <option selected value="{{@$users->user->id}}">
                                                                {{@$users->user->first_name .' | '.@$users->user->email}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                    @break
												@case(7)
                                                    @foreach ($home_page->brand_lists ?? [] as $brand_list)
                                                    <option selected value="{{@$brand_list->brand_list->id}}">{{@$brand_list->brand_list->name}}</option>
                                                    @endforeach
                                                    @break
                                            @endswitch
                                        </select>
                                    </div>
                                </div>
                            </span>
							
							<!-- for video links -->

                            <div id="video_section" style="display: none;">
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 1</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[0]->video_link) ) ? $home_page->VideoLinks[0]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 2</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[1]->video_link)) ? $home_page->VideoLinks[1]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 3</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[2]->video_link)) ? $home_page->VideoLinks[2]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 4</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[3]->video_link)) ? $home_page->VideoLinks[3]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 5</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[4]->video_link)) ? $home_page->VideoLinks[4]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 6</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[5]->video_link)) ? $home_page->VideoLinks[5]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 7</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[6]->video_link)) ? $home_page->VideoLinks[6]->video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Slider Video Link 8</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="Link[]" class="form-control" 
                                        value="{{(isset($home_page->VideoLinks[7]->video_link)) ? $home_page->VideoLinks[7]->video_link : ''}}">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Right Section Link 1</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="RightLink[]" class="form-control" 
                                        value="{{(isset($home_page->RightVideoLinks[0]->right_video_link)) ? $home_page->RightVideoLinks[0]->right_video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Right Section Link 2</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="RightLink[]" class="form-control" value="{{(isset($home_page->RightVideoLinks[1]->right_video_link)) ? $home_page->RightVideoLinks[1]->right_video_link : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-sm-2 control-label">Right Section Link 3</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="RightLink[]" class="form-control" value="{{(isset($home_page->RightVideoLinks[2]->right_video_link)) ? $home_page->RightVideoLinks[2]->right_video_link : ''}}">
                                    </div>
                                </div>
                            </div>
							
							@endif

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
    jQuery(function ($) {

        // Change Type Event
        function onChangeOfType() {
            var isExpandable = $('#isExpandable');
            var video_section = $('#video_section');
            var type = $('[name="type"]');
            isExpandable.hide();
            video_section.hide();
            if($.inArray(parseInt(type.val()),[1,2,4,6,7]) !== -1) {
                isExpandable.show();
            }
            else if($.inArray(parseInt(type.val()),[0]) !== -1) {
                video_section.show();
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
            ajax: {
                url: '{{route("admin.cms.home_page.search")}}',
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
                url: "{{ route('admin.cms.home_page.update', ['id' => $home_page->id]) }}",
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
                    window.location.replace('{{ route("admin.cms.home_page.index")}}');
                }
            });
        });
        // End On Form Submit
    });
</script>

@endsection
