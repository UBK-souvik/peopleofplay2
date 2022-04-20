@extends('admin.layouts.master')

@section('title') Create Award @endsection

@section('content')

@php 
$arr_nominee_custom = array();
@endphp

  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Create Award</h1>
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
                        <input type="hidden" value="{{@$event_award->id}}" name="event_award_id">
                        <input type="hidden" value="{{@$event->id ?? @$event_award->event_id}}" name="event_id">

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name<i class="has-error">*</i></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="name"
                              placeholder="Name" value="{{@$event_award->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description<i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="description" placeholder="Description">{{@$event_award->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Type <i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <select name="type" id="" class="form-control nominee_reference">
                                    <option value="">Choose</option>
                                    @foreach(config('cms.award_type') as $key => $value)
                                    <option value="{{$key}}"
                                     {{isset($event_award) && @$event_award->type == $key ? 'selected' : ''}}
                                        >{{$value}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nominee with a Profile on PopPro</label>
                            <div class="col-sm-6">
                                <select class="form-control select-ajax" multiple name="nominee[]" >
                                    @foreach($event_award->nominees ?? [] as $nominee)
                                    @php
                                        $nominee_id = $nominee->id;
                                        $nominee_id = $nominee->reference_id;
                                        $nominee_name = null;
                                        if($nominee->reference_type == 2){
                                            $nominee_custom_name = $nominee->reference;
											$arr_nominee_custom[] = $nominee_custom_name;
                                        }else {
                                            if($nominee->type == 1){
                                                $nominee_name = isset($nominee->product->name) ? $nominee->product->name : null;
                                            }else{
                                                $nominee_name = @$nominee->user->first_name.' '.@$nominee->user->last_name.' | '.@$nominee->user->email;
                                            }
                                        }
                                    @endphp
									@if($nominee->reference_type == 1)
									  <option value="{{$nominee_id}}" selected >{{$nominee_name}}</option>
                                    @endif
									
									@endforeach
                                </select>
                                <input type="hidden" name="reference_type" value="1" class="form-control ">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nominee without a Profile on PopPro </label>
                            <div class="col-sm-6">
                                <input id="nominee_tag"  data-role="tagsinput"  type="text" name="nominee_tag" class="form-control other-tag-input-class" value="@if(!empty($arr_nominee_custom) && count($arr_nominee_custom)>0){{@implode(',', $arr_nominee_custom)}}@endif" placeholder="Nominee">
                                {!!App\Helpers\UtilitiesTwo::getTagText()!!}
							 </div>
                        </div>
						
						<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Select type of winner</label>
                            <div class="col-sm-6">
                                  <input type="radio" name="winner_type" value="1" {{(empty(@$event_award->winner_type) || @$event_award->winner_type == 1) ? 'checked' : '' }}>
                                  <label style="margin-right: 10px;" for="with_pop">Winner with a Profile on PopPro</label>
                                  <input type="radio" name="winner_type" value="2" {{(@$event_award->winner_type == 2) ? 'checked' : '' }}>
                                  <label for="without_pop">Winner without a Profile on PopPro</label>
                            </div>
                        </div> 

                        <div class="form-group winner_div" id="winner1">
                            <label for="main_image" class="col-sm-2 control-label">Winner<i class="has-error">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control select-ajax" name="winner" >
                                @if(isset($event_award) && $event_award->nominees->where('is_winner',1)->first())
                                    @php
                                        $nominee = $event_award->nominees->where('is_winner',1)->first();
                                        $nominee_id = $nominee->id;
                                        $nominee_id = $nominee->reference_id;
                                        $nominee_name = null;
                                        if($nominee->reference_type == 2){
                                            $without_pro_nominee_name = $nominee->reference;
                                        }else {
                                            if($nominee->type == 1){
                                                $nominee_name = isset($nominee->product->name) ? $nominee->product->name : null;
                                            }else{
                                                $nominee_name = @$nominee->user->first_name.' '.@$nominee->user->last_name.' | '.@$nominee->user->email;
                                            }
                                        }
                                    @endphp
                                    <option value="{{$nominee_id}}" selected>{{$nominee_name}}</option>
                                @endif
                                </select>
                            </div>
                        </div>
						
						<div class="form-group winner_div" id="winner2">
                            <label for="name" class="col-sm-2 control-label">Winner without a Profile on PopPro </label>
                            <div class="col-sm-6">
                                <input id="nominee_tag"  type="text" name="winner_tag" class="form-control" value="{{@$without_pro_nominee_name}}" placeholder="Nominee">
                            </div>
                        </div> 

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

        ajaxSelect2();
        var wtype = {{(@$event_award->winner_type) ? @$event_award->winner_type : 1}}
        winner_type(wtype);

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
        $(document).on('click','#createBtn',function(e){
            e.preventDefault();
            $.ajax({
            processData: false,
            contentType: false,
            url: "{{ route('admin.event.award.create') }}",
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
                    window.location.replace('{{ route("admin.event.award.index")}}/{{@$event->id ?? @$event_award->event_id}}');

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
