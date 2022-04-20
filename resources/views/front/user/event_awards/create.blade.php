@extends('front.layouts.pages')
@section('content')
@php
$arr_nominee_custom = array();
@endphp
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<div class="left-column bg-white border_right">
    <div class="First-column bg-white p-3">
        <form id="event-form" class="kform_control">
            <input type="hidden" value="{{@$event_award->id}}" name="event_award_id">
            <input type="hidden" value="{{@$event->id ?? @$event_award->event_id}}" name="event_id">
            @csrf
            <h3 class="sec_head_text mb-0 paddingTwenty">Add/Edit Award ({{@$event->name}})</h3>
            <div class="col-md-12">
                <div class="row sectionBox">
                        @csrf
                        <div class="col-md-6 pl-0 inputPaddingLeft">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input id="AwardName" type="text" name="name"
                                    value="{{@$event_award->name}}"
                                    class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Type</label>
                                <select name="type" id="award_type" class="form-control nominee_reference">
                                    <option value="">Choose</option>
                                    @foreach(config('cms.award_type') as $key => $value)
                                    <option value="{{$key}}"
                                     {{isset($event_award) && @$event_award->type == $key ? 'selected' : ''}}
                                        >{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea class="form-control" name="description" placeholder="Description">{{@$event_award->description}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group nominee mb-0">
                                <label >Nominee with a Profile on PopPro</label>
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
                                <!-- <input type="text" name="award[nominee][0][reference][]" class="form-control "> -->
                                <input type="hidden" name="reference_type" value="1" class="form-control ">
                            </div>
                        </div>
						
						<div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group nominee mb-0">
                                <label for="Description">Nominee without a Profile on PopPro</label>
                                <br>
                                <input id="nominee_tag"  data-role="tagsinput"  type="text" name="nominee_tag" class="form-control other-tag-input-class" value="@if(!empty($arr_nominee_custom) && count($arr_nominee_custom)>0){{@implode(',', $arr_nominee_custom)}}@endif" placeholder="Nominee">
                                {!!App\Helpers\UtilitiesTwo::getTagText()!!}
							</div>
                        </div>

                        <div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group nominee mb-0">
                                <label for="name" class="col-sm-4 control-label">Select type of winner</label>
                                <input type="radio" name="winner_type" value="1" {{(empty(@$event_award->winner_type) || @$event_award->winner_type == 1) ? 'checked' : '' }}>
                                <label style="margin-right: 10px;" for="with_pop">Winner with a Profile on PopPro</label>
                                <input type="radio" name="winner_type" value="2" {{(@$event_award->winner_type == 2) ? 'checked' : '' }}>
                                <label for="without_pop">Winner without a Profile on PopPro</label>
                            </div>
                        </div>
						
                        <div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group nominee mb-0 winner_div" id="winner1">
                                <label >Winner with a Profile on PopPro</label>
                                <select class="form-control select-ajax" name="winner" >
                                @if(isset($event_award) && $event_award->nominees->where('is_winner',1)->first())
                                    @php
                                        $nominee = $event_award->nominees->where('is_winner',1)->first();
                                        $nominee_id = $nominee->reference_id;
                                        $nominee_name = null;
                                        if($nominee->reference_type == 2){
                                            $without_pro_nominee_name = $nominee->reference;
                                        }else {
                                            if($nominee->type == 1){
                                                $nominee_name = isset($nominee->product->name) ? $nominee->product->name : null;
                                            }else{
                                                $nominee_name = $nominee->user->first_name.' '.$nominee->user->last_name.' | '.$nominee->user->email;
                                            }
                                        }
                                    @endphp
                                    <option value="{{$nominee_id}}" selected>{{$nominee_name}}</option>
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 pl-0 inputPaddingLeft">
                            <div class="form-group nominee mb-0 winner_div" id="winner2">
                                <label>Winner without a Profile on PopPro </label>
                                <input id="nominee_tag"  type="text" name="winner_tag" class="form-control" value="{{@$without_pro_nominee_name}}" placeholder="Nominee">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-12">
              <div class="row sectionBox">
                <button type="button" class="btn btnAll" id="eventSubmit">Save</button>
              </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



    $(document).on('change','[name="award[type][]"]',function() {
        var val = $(this).val();

        if(val !== '' || val !== undefined){
            console.log(val)
            $(this).closest('.add-row').find('.select-ajax').each(function() {
                $(this).select2('val','')
            });
        }
    });

    // refer
// ref-radio
    $(document).on('change','.ref-radio',function() {
        var val = $(this).val() === 'on' ? 1 : 0;
        console.log(val)
        $(this).closest('.form-group').find('[type="hidden"]').val(val);
    });

    function addNomineeToAward(index)
    {
        return ` <div class="row add-row">
                    <div class="form-group nominee col-md-6">
                        <label >Nominee</label>
                        <select class="form-control select-ajax"
                        data-select2-tags="true"
                        name="award[nominee][${index}][reference][]">
                        </select>
                        <input type="hidden" name="award[nominee][${index}][reference_type][]" value="2" class="form-control ">
                    </div>
                    <div class="form-group nominee col-md-3">
                        <label >Is Winner</label>
                        <input type="hidden" name="award[nominee][${index}][is_winner][]" value="0">
                        <input type="radio"  class="form-control ref-radio">
                    </div>
                    <div class="form-group nominee col-md-3">
                        <button type="button" class="btn btn-danger remove-link">+ Remove</button>
                    </div>
                </div>`;
    }

    $(document).on('click','.add-link-nominee',function() {
        var length = $(this).closest('.parent-row').find('.add-row').length
        var html = addNomineeToAward(length > 0 ? length : 0);
        $(this)
            .closest('.add-row')
            .append(html)
            // $(".select-ajax").select2('destroy')
            ajaxSelect2()
    })



    $(document).on('click','.add-link',function() {
        var rowSample = $(this)
            .closest('.add-row')
            .clone()
            .appendTo($(this).closest('.parent-row'))
            .find('.add-link')
            .removeClass('add-link btn-success')
            .addClass('remove-link btn-danger')
            .html('- Remove')


    })
    $(document).on('click','.remove-link',function(e) {
        e.preventDefault();
        var rowSample = $(this)
            .closest('.add-row')
            .remove()
    })

    ajaxSelect2();

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
                    // var val = $(this).closest('.ref-row').find('[name="type"]').val()
                    var val = $("#award_type").val()
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



    $(function ($) {

        // Event Form
        $(document).on('click', '#eventSubmit', function (e) {
            e.preventDefault();

            var fd = new FormData($('#event-form')[0]);
            $.ajax({
                url: "{{ route('front.user.event.award.create') }}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('#eventSubmit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('#eventSubmit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('#eventSubmit').attr('disabled', false);
                    $('#event-form').trigger('reset')
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message)
                    window.location.replace('{{ route("front.user.event.award.index",@$event->id ?? @$event_award->event_id)}}');

                    // window.location.replace('{{ route("admin.users.index")}}');
                    // window.location.replace('{{ route("front.login")}}');

                }
            });
        });

    // Award Form

    function awardTableConstruct(obj,index) {
        console.log(obj,index,'THIS IIS')
        var json = JSON.stringify(obj);
        return `<tr data-json='${json}' data-id="${obj.id}">
                    <input type="hidden" data-name="id" name="award[${index}][id]" value="${obj.id}">
                    <td>${obj.name}
                    <input type="hidden" data-name="name" name="award[${index}][name]" value="${obj.name}">
                    </td>
                    <td>${obj.description}
                    <input type="hidden" data-name="description" name="award[${index}][description]" value="${obj.description}">
                    </td>
                    <td>${obj.events_associated_with}
                    <input type="hidden" data-name="events_associated_with" name="award[${index}][events_associated_with]" value="${obj.events_associated_with}">
                    </td>
                    <td>${obj.year_established}
                    <input type="hidden" data-name="year_established" name="award[${index}][year_established]" value="${obj.year_established}">
                    </td>
                    <td>${obj.year_dissolved}
                    <input type="hidden" data-name="year_dissolved" name="award[${index}][year_dissolved]" value="${obj.year_dissolved}">
                    </td>
                    <td>${obj.previous_year_recipients}
                    <input type="hidden" data-name="previous_year_recipients" name="award[${index}][previous_year_recipients]" value="${obj.previous_year_recipients}">
                    </td>
                    <td>${obj.previous_year_products}
                    <input type="hidden" data-name="previous_year_products" name="award[${index}][previous_year_products]" value="${obj.previous_year_products}">
                    </td>
                    <td>
                        <span class="table-edit">
                            <button type="button"
                                class="btn edit-btn-style-table rounded-0 btn-sm my-0 edit-award">Edit</button>
                        </span>
                    </td>
                    <td>
                        <span class="table-delete">
                            <button type="button"
                                class="btn edit-btn-style-table rounded-0 btn-sm my-0 delete-award">Delete</button>
                        </span>
                    </td>
                </tr>`;
    }

    var awards = [];

    $(document).on('click', '#awardSubmit', function (e) {
            e.preventDefault();
            var fd = new FormData($('#award-form')[0]);
            var data = Object.fromEntries(fd);

            data['.nominee_reference'] = [];
            data['.nominee_reference_type'] = [];
            data['.nominee_is_winner'] = [];
            $('.nominee_reference').each(function() {
                data['nominee_reference'].push($(this).val())
                data['nominee_reference_type'].push($(this).attr('data-type'))
                data['nominee_is_winner'].push(
                    $(this).closest('.row').find('input[type="radio"]').val() === 'on' ? true : false
                )
            });

            awards.push(data);
            console.log(awards)

            // $('#awardSubmit').attr('disabled', false);
            // var index = $('#event-award-body').find('tr').length
            // var htmlData = awardTableConstruct(data.message, index > 0 ? index  : 0);
            // $('#event-award-body').find('tr[data-id="'+data.message.id+'"]').remove();
            // $('#event-award-body').append(htmlData);
            $('#award-form').trigger('reset')
            $('#ModalLoginForm').modal('hide');


            // var fd = new FormData($('#award-form')[0]);
            // $.ajax({
            //     url: "{{ route('front.user.event.award.create') }}",
            //     data: fd,
            //     processData: false,
            //     contentType: false,
            //     dataType: 'json',
            //     type: 'POST',
            //     beforeSend: function () {
            //         $('#awardSubmit').attr('disabled', true);
            //         // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
            //     },
            //     error: function (jqXHR, exception) {
            //         $('#awardSubmit').attr('disabled', false);

            //         var msg = formatErrorMessage(jqXHR, exception);
            //         toastr.error(msg)
            //         console.log(msg);
            //         // $('.message_box').html(msg).removeClass('hide');
            //     },
            //     success: function (data) {
            //         $('#awardSubmit').attr('disabled', false);
            //         var index = $('#event-award-body').find('tr').length
            //         var htmlData = awardTableConstruct(data.message, index > 0 ? index  : 0);
            //         $('#event-award-body').find('tr[data-id="'+data.message.id+'"]').remove();
            //         $('#event-award-body').append(htmlData);
            //         $('#award-form').trigger('reset')
            //         $('#ModalLoginForm').modal('hide');


            //         // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
            //         // toastr.success(data.message)


            //         // window.location.replace('{{ route("front.login")}}');

            //     }
            // });
        });
    });
    $('#ModalLoginForm').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset')
        $(this).find('form').find('[name="id"]').val('');
    })
    //Delete Award
    $(document).on('click','.delete-award',function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    })

    // Edit Award Modal
    $(document).on('click','.edit-award',function(e) {
        e.preventDefault();

        var json = $(this).closest('tr').attr('data-json');
        var data = null;
        var modal = $('#ModalLoginForm');
        if(json) {
            data = JSON.parse(json);
            modal.modal('show');
            Object.keys(data).forEach(element => {
                modal.find('[name="'+element+'"]').val(data[element]);
            });
        }
    })
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

    var wtype = '{{(@$event_award->winner_type) ? @$event_award->winner_type : 1}}';
    winner_type(wtype);
</script>
@endsection

