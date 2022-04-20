@extends('front.layouts.pages')
@section('content')
<div class="col-md-9 col-lg-10 MiddleColumnFullWidth">
<div class="left-column border_right" >
    <form id="event-form" class="kform_control">
        <input type="hidden" value="{{@$event->id}}" name="event_id">
        @csrf
        <div class="First-column bg-white" >
            <div class="col-md-12">
                <div class="row sectionTop">
                    <div class="col-md-4 imgProfilePadding marginBottomTwenty lessMargin">
                        <div id="file-upload-form" class="uploader">
                            
                            <img id="blah" class="kfile_imageten img-fluid imgtwoeighty"  src="{{@prodEventImageBasePath(@$event->main_image)}}" >
                            <div class="form-group mt-2 ProfileUploadBtn">
                                <input id="file-upload" type="file" class="custom-file-input1" onchange="readURL(this);" name="main_image" accept="image/*" />
                            </div>
                            <small class="text-danger text-left">Note: Please upload 4*5 ratio size image</small>

                            <!-- <input id="file-upload" type="file" name="main_image"
                                accept="image/*" /><label for="file-upload" id="file-drag">
                                <img id="file-image" src="#" alt="Preview" class="hidden">
                                <div id="start">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <div></div>
                                    <div id="notimage" class="hidden"></div>
                                    <span id="file-upload-btn" class="btn edit-btn-style">Add Event
                                        Image</span>
                                </div>
                                <div id="response" class="hidden">
                                    <div id="messages"></div>
                                    <progress class="progress" id="file-progress" value="0">
                                        <span>0</span>%
                                    </progress>
                                </div>
                            </label> -->
                        </div>
                    </div>
                    <div class="col-md-8">
                       <div class="row" id="First_Event">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NameEvent">Event ID</label><span class="text-danger">*</span>
                                    <input id="NameEvent" type="text" name="event_id_number" readonly class="form-control"
                                    value="{{isset($event) ? @$event->event_id_number : generateRandomString()}}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NameEvent">Name Of Event</label><span class="text-danger">*</span>
                                    <input id="NameEvent" type="text" name="name" class="form-control" value="{{@$event->name}}"
                                        placeholder="">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="NameEvent">Website</label><span class="text-danger">*</span>
                                    <input id="NameEvent" type="text" name="website" class="form-control" value="{{@$event->website}}"
                                        placeholder="">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label for="DescriptionEvent">Description</label><span class="text-danger">*</span>
                                    <textarea class="form-control" rows="4" id="Comments" name="description"
                                    placeholder="">{{@$event->description}}</textarea>
                                </div>
                            </div>
                            <!-- {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="YearStarted">Year Started</label>
                                    <input id="YearStarted" type="number" name="year_started" value="{{@$event->year_started}}"
                                        class="form-control" placeholder="">
                                </div>
                            </div> --}} -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
              <div class="row sectionBox">
                <h3 class="sec_head_text w-100">Fun Facts</h3>
                <div class="col-md-4 pl-0 inputPaddingLeft">
                  <div class="form-group">
                      <label for="fun_fact1">Fun Fact 1</label></span>
                      <input id="fun_fact1" type="text" name="fun_fact1" value="{{ @$event->fun_fact1 }}"
                      class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="fun_fact2">Fun Fact 2 </label></span>
                      <input id="fun_fact2" type="text" value="{{ @$event->fun_fact2 }}"
                      name="fun_fact2" required="required" class="form-control" placeholder=""> <!-- name="EmailID" -->
                  </div> 
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="fun_fact3">Fun Fact 3</label></span>
                      <input id="fun_fact3" type="text"  class="form-control" value="{{ @$event->fun_fact3 }}" name="fun_fact3" required="required" placeholder=""> <!-- name="EmailID" -->
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
                <div class="row social_media sectionBox">
                    @foreach(config('cms.social_media') as $index => $social)
                        @php
                            $str_social_val = '';
                            if(!empty($event->socialMedia))
                            {     
                                $str_social_val = @$event->socialMedia->pluck('value','type')->toArray()[$index];
                            }
                        @endphp 
                            <div class="col-md-3" >
                                <div class="form-group">
                                    <label for="{{ $social }}">{{ $social }}</label>
                                    <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                     value="{{$str_social_val}}" class="form-control social">
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12">
              <div class="row sectionBox">
                <button type="submit" class="btn btnAll" id="eventSubmit">Save</button>
              </div>
            </div>
            <!-- <hr> -->
            <!-- <div id="First_Event1" class="row">



                {{-- <div class="col-md-4">
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" class="custom-select">
                            <option selected class="search_categories">Select</option>
                            @foreach($categories as $key => $value)
                            <option  value="{{$key}}" {{@$event->category_id == $key ? 'selected': ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Sub Category">Sub Category</label>
                        <select name="sub_category_id" class="custom-select">
                            <option selected>Select</option>
                            @foreach($sub_categories as $key => $value)
                            <option  value="{{$key}}" {{@$event->sub_category_id == $key ? 'selected': ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
            </div> -->
            <!-- <hr> -->
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="DescriptionEvent">Description</label>
                        <textarea class="form-control" rows="2" name="description"
                        placeholder="">{{@$event->description}}</textarea>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="YearStarted">Year Started</label>
                        <input id="YearStarted" type="number" name="year_started" value="{{@$event->year_started}}"
                            class="form-control" placeholder="">
                    </div>
                </div> --}}
            </div> -->
            {{-- <h3 class="Tile-style social my-3">Contact Info</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Company">Company</label>
                        <input id="Company" type="text" name="company" class="form-control" value="{{@$event->company}}"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="CompanyInfo">Company Info</label>
                        <input id="CompanyInfo" type="text" name="company_info" class="form-control" value="{{@$event->company_info}}"
                            placeholder="">
                    </div>
                </div>
            </div> --}}
            {{-- <h3 class="Tile-style social my-3">Media</h3>
            <div class="row">
                <div class="col-md-4">
                    <label For="ImageEvent">Attachment Instructions :</label>
                    <ul class="Ulstyle">
                        <li>
                            Allowed only files with extension (jpg, png, gif)
                        </li>
                        <li>
                            Maximum number of allowed files 10 with 300 KB for each
                        </li>
                        <li>
                            you can select files from different folders
                        </li>
                    </ul>
                    <!--To give the control a modern look, I have applied a stylesheet in the parent span.-->
                    <span class="btn edit-btn-style fileinput-button">
                        <span>Add Images</span>
                        <input type="file" name="photo[]" id="files" multiple
                            accept="image/jpeg, image/png, image/gif,"><br />
                    </span>
                </div>
                <div class="col-md-8">
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <output id="Filelist" class="modal-content"></output>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-4">
                    <span class="btn edit-btn-style fileinput-button">
                        <span> Add Vedios</span>
                        <input type="file" name="video[]" id="vediofiles" accepts="video/*"
                            multiple>
                    </span>
                </div>
                <div class="col-md-8">
                    <output id="list"></output>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Article">Article</label>
                        <input id="Article" type="url" name="Article" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
            <hr> --}}

            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Related awards">Related awards</label>
                        <input id="Relatedawards" type="url" name="Related awards"
                            class="form-control" placeholder="">
                    </div>
                </div>
            </div> --}}
            <!-- <button type="submit" class="btn edit-btn-style" id="eventSubmit">Save</button> -->
    </form>
</div>
</div>

<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title w-100 font-weight-bold">Award</h1>
            </div>
            <div class="modal-body">
                <form  id="award-form">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input id="AwardName" type="text" name="name"
                            class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label >Type</label>
                        <input type="text" name="type"
                            class="form-control" placeholder="">
                    </div>
                    <span class="parent-row">
                        <div class="row add-row">
                            <div class="form-group nominee col-md-6">
                                <label >Nominee</label>
                                <input type="text"
                                    class="form-control nominee_reference " placeholder="">
                            </div>
                            <div class="form-group nominee col-md-3">
                                <label >Is Winner</label>
                                <input type="radio" class="form-control nominee_is_winner"  name="nominee_is_winner[]" id="">
                            </div>
                            <div class="form-group nominee col-md-3">
                            <button type="button" class="btn btn-success add-link">+ Add</button>
                            </div>
                        </div>
                    </span>

                    <div
                        class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="button"
                            class="btn edit-btn-style" id="awardSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.modal -->
@endsection

@section('scripts')
<script>
    frontend_show_standard_ckeditor_new('Comments');
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
                    var val = $(this).closest('.ref-row').find('[name="award[type][]"]').val()
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
            // var error = '';
            // $( ".social" ).each(function( index ) {
            //     var str = $( this ).val();
            //     var name = $(this).attr('id');
            //     if(str != ''){
            //         console.log(name + validURL(str))
            //         if(validURL(str) == false){
            //             toastr.error(name + ' URL is Invalid');
            //             error = 'yes';
            //             return false;
            //         }
            //     }
            // });
            // if(error != '' && error == 'yes'){
            //     return false;
            // }

            var ckeditor_description_new = frontend_get_ckeditor_description_new('Comments');
            
            var fd = new FormData($('#event-form')[0]);  
            fd.append('description', ckeditor_description_new);

            $.ajax({
                url: "{{ route('front.user.event.create') }}",
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
                    window.location.replace('{{ route("front.user.event.index")}}');

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
@endsection

