@extends('admin.layouts.master')

@section('title') {{ adminTransLang('all_users') }} @endsection

@section('content')

<link href="{{asset('backend/plugins/tags.css')}}" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 
<style>
.intl-tel-input.allow-dropdown {width: 100%; }
</style>
    <section class="content-header">
        <h1> @if(!empty($user->id)){{ adminTransLang('edit_user_new') }} @else {{ adminTransLang('create_user') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.users.index') }}">{{ adminTransLang('all_users') }}</a></li>
            <li class="active">@if(!empty($user->id)){{ adminTransLang('edit_user_new') }} @else {{ adminTransLang('create_user') }} @endif</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
           <div class="col-md-12">
              <div class="box">
                 <div class="box-body" id="add-edit-user-main-box-body-div">
                    <p class="alert alert-block alert-danger message_box hide alert-dismissible"></p>
                    <form class="form-horizontal" id="add-edit-user-main-box-body-form">
                        {{ csrf_field() }}

                        <div class="accordion">
                            @include('admin.users.user_basic_details')
                            
                            @include('admin.users.contact_info')
                            
                            @include('admin.users.personal_details')
                            
                            {{-- @if(!empty($user_id))
                                 @include('admin.users.user_roles_details') --}}    
                                
                                @include('admin.users.admin_list_innovator_role')                               
                                
                            {{--  @endif --}}

                            @include('admin.users.social_media_details')
                            
                            @include('admin.users.user_meta_details')
                            
                            
                        </div>
                        <div class="col-sm-6" style="margin-top: 8px;">
                            <div class="row">
                            
                            <input type="hidden"  id="admin_add_edit_profile_role_random_time_stamp_hidden_id" name="admin_add_edit_profile[random_time_stamp_new]" value="{{$str_random_time_stamp_new}}">
                                <button type="button" class="btn btn-success" id="createBtn">Save</button>
                            </div>
                        </div>
                    </form>
                 </div>
                 
                 
                  <div class="div">
                    
                                  @include('admin.users.admin_add_role_popup')

                                </div>

                 <div class="box-footer">
                    
                 </div>
              </div>
           </div>
        </div>
    </section>
@endsection


@section('scripts')

<script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
{{-- <script src="{{asset('backend/plugins/tags.js')}}"></script> --}}

<script>

    admin_show_standard_ckeditor_new('Userdescription');
    
    <?php /*
    $(function () {
        console.log($('#myTags').tagsValues())
    })

    function runSuggestions(element,query) {

        /*
        using ajax to populate suggestions
         
        let sug_area=$(element).parents().eq(2).find('.autocomplete .autocomplete-items');
        $.getJSON("{{url('admin/users/getTags')}}", { query: query }, function( data ) {
            _tag_input_suggestions_data = data;
            $.each(data,function (key,value) {
                let template = $("<div>"+value.name+"</div>").hide()
                sug_area.append(template)
                template.show()
            })
        });

    } */?>
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>

<script>
$(document).ready(function(){

            // $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput();
            // $("[name='mobile']").intlTelInput({
            //     initialCountry: "auto",
            //     geoIpLookup: function(callback) {
            //         callback("{{$ip_data ? $ip_data->countryCode : ''}}");
            //     }
            // });

            var test = $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput({
              utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
              initialCountry: 'auto',
              geoIpLookup: function(callback) {
                callback('us');
              }
            });
            var mob = "{{!empty(@$user->mobile) ? '+'.$user->dial_code.$user->mobile : '0'}}";
            if(mob != 0){
                $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput("setNumber", mob);
            }
                
            $('body').on('click','#add-edit-user-main-box-body-div  #createBtn',function(e){
                e.preventDefault();
                 if($.trim($('#add-edit-user-main-box-body-div  [name="mobile"]').val()) != '' && $('#add-edit-user-main-box-body-div  [name="mobile"]').intlTelInput("isValidNumber") == false) {
                    $('#add-edit-user-main-box-body-div  .message_box').html('{{ adminTransLang("invalid_mobile_no") }}').removeClass('alert-success hide').addClass('alert-danger');
                    return false;
                }

                var phone = $('#add-edit-user-main-box-body-div  [name="mobile"]').intlTelInput("getSelectedCountryData");
                $('#add-edit-user-main-box-body-div  [name="mobile"]').val(($('#add-edit-user-main-box-body-div  [name="mobile"]').val()).replace(/ /g, ''));
                var fd = new FormData($('#add-edit-user-main-box-body-div  form')[0]);
                fd.append('dial_code', phone.dialCode);

                var ckeditor_description_new = admin_get_ckeditor_description_new('Userdescription');
                fd.append('description', ckeditor_description_new);

                // var error = '';
                // $( ".social" ).each(function( index ) {
                //     var str = $( this ).val();
                //     var name = $(this).attr('id');
                //     if(str != ''){
                //         console.log(name + validURL(str))
                //         if(validURL(str) == false){
                //             $('#add-edit-user-main-box-body-div .message_box').html(name + ' URL is Invalid').removeClass('alert-success hide').addClass('alert-danger');
                //             error = 'yes';
                //             return false;
                //         }
                //     }
                // });
                // if(error != '' && error == 'yes'){
                //     return false;
                // }

                /*var skills = [];
                $( "span.tag" ).each(function( index ) {
                  // console.log( index + ": " + $( this ).find('.text').text() );
                  skills.push($( this ).find('.text').text());
                });
                fd.append('skills', skills);*/

                $.ajax({
                    url: "{{ route('admin.users.save-add-edit', @$user_id) }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function()
                    {
                        $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',true);
                        $('#add-edit-user-main-box-body-div  .message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                    },
                    error: function(jqXHR, exception){
                        $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);
                        
                        var msg = formatErrorMessage(jqXHR, exception);
                        
                        var res = msg.replace(/The/g, "");
                        
                        $('#add-edit-user-main-box-body-div  .message_box').html(res).removeClass('hide');
                    },
                    success: function (data)
                    {
                        $('#add-edit-user-main-box-body-div  #createBtn').attr('disabled',false);                        
                        window.location.replace('{{ route("admin.users.index")}}');
                        
                    }
                });
                
                
                
            });
}); 
        
        
function delete_role_ajax(user_id, role_id)
{
    var confirm_chk = confirm("Are you sure?");
    if(confirm_chk == true)
    {
        $.ajax({
        url: baseUrl + "/admin/users/delete-role-data/" + user_id + "/" + role_id,
        headers: {
         'X-CSRF-TOKEN': ajax_csrf_token_new
        },
        type: 'GET',
        beforeSend: function () {
            //$('.productSubmitButton').attr('disabled', true);
            // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
        },
        error: function (jqXHR, exception) {
            //$('.productSubmitButton').attr('disabled', false);

            var msg = formatErrorMessage(jqXHR, exception);
            toastr.error(msg);
            console.log(msg);
            // $('.message_box').html(msg).removeClass('hide');
        },
        success: function (data) {
           //base_url_new + 
           $('#add-edit-user-main-box-body-div  #roleDivId'+role_id).hide();
        }
       });  
    }
    

}
    
</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $.dobPicker({
            // Selectopr IDs
            daySelector: '.f_day',
            monthSelector: '.f_month',
            yearSelector: '.f_year',

            // Default option values
            dayDefault: 'Date',
            monthDefault: 'Month',
            yearDefault: 'Year',
            // Minimum age
            minimumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(1)}},
            maximumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(2)}}
        }); 

        $.dobPicker({
            // Selectopr IDs
            daySelector: '.to_day',
            monthSelector: '.to_month',
            yearSelector: '.to_year',

            // Default option values
            dayDefault: 'Date',
            monthDefault: 'Month',
            yearDefault: 'Year',
            // Minimum age
            minimumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(1)}},
            maximumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(2)}}
        }); 

        $.dobPicker({
            // Selectopr IDs
            daySelector: '#dobday',
            monthSelector: '#dobmonth',
            yearSelector: '#dobyear',

            // Default option values
            dayDefault: 'Date',
            monthDefault: 'Month',
            yearDefault: 'Year',
            // Minimum age
            minimumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(1)}},
            maximumAge: {{@App\Helpers\UtilitiesTwo::getMinMaxAge(2)}}
        }); 

        $('#dobday option[value={{!empty($user->dobday) ? $user->dobday : '0'}}]').attr('selected','selected');
        $('#dobmonth option[value={{!empty($user->dobmonth) ? $user->dobmonth : '0'}}]').attr('selected','selected');
        $('#dobyear option[value={{!empty($user->dobyear) ? $user->dobyear : '0'}}]').attr('selected','selected');      
   
      
    });
</script> -->

<script type="text/javascript">
    $(document).ready(function(){
        ajaxSelect2();
        function ajaxSelect2() {
            // Select2 Ajax
            $(document).find(".select-ajax").select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{route("front.user.getAgent")}}',
                    dataType: 'json',
                    tags: true,
                    placeholder: "Search Item",
                    allowClear: true,
                    type: "GET",
                    quietMillis: 100,
                    delay: 250,
                    data: function (term) {
                        return {
                            query: term,
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
    })
</script>

<script type="text/javascript">
    $(function () {
        
        $('#dobmonth').append($('<option />').val(0).html('Month'));
        for (i = 1; i < 13; i++) {
            $('#dobmonth').append($('<option />').val(i).html(i));
        }
        updateNumberOfDays();

        $('#dobmonth').change(function () {
            updateNumberOfDays();
        });

        $('#dobday option[value={{!empty($user->dobday) ? $user->dobday : '0'}}]').attr('selected','selected');
        $('#dobmonth option[value={{!empty($user->dobmonth) ? $user->dobmonth : '0'}}]').attr('selected','selected');
        //$('#dobyear option[value={{!empty($user->dobyear) ? $user->dobyear : '0'}}]').attr('selected','selected');      

    });

    function updateNumberOfDays() {
        $('#dobday').html('');
        month = $('#dobmonth').val();
      //  year = $('#dobyear').val();
       // days = daysInMonth(month, year);
        $('#dobday').append($('<option />').val(0).html('Day'));
        for (i = 1; i < 31 ; i++) {
            $('#dobday').append($('<option />').val(i).html(i));
        }

    }

    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }

</script>

@include('admin.users.admin_edit_profile_dob_js')

@endsection