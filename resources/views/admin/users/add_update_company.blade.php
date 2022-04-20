@extends('admin.layouts.master')

@section('title') Add Company @endsection

@section('content')

<style>
.intl-tel-input.allow-dropdown {width: 100%; }
</style>
    <section class="content-header">
        <h1> @if(!empty($user->id)){{ adminTransLang('edit_company') }} @else {{ adminTransLang('create_company') }} @endif </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ adminTransLang('dashboard') }}</a></li>
            <li><a href="{{ route('admin.companies.index') }}">{{ adminTransLang('all_companies') }}</a></li>
            <li class="active">@if(!empty($user->id)) {{ adminTransLang('edit_company') }} @else {{ adminTransLang('create_company') }} @endif </li>
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
                                    <div class="accordion__header is-active">
                                        <h2>Basic Details</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body is-active">
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Name <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="first_name" placeholder="Name" value="@if(!empty($user->first_name)){{$user->first_name}}@endif">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="acronym" class="col-sm-2 control-label">Acronym </label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="acronym" placeholder="Acronym" value="@if(!empty($user->acronym)){{$user->acronym}}@endif">
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="email" class="col-sm-2 control-label">In Gold List </label>
                                          <div class="col-sm-6">
                                              <input type="radio" id="yes" name="gold" value="1" @if(!empty(@$user->gold)){{ 'checked' }} @endif>
                                              <label for="yes">Yes</label><br>
                                              <input type="radio" id="no" name="gold" value="0" @if(empty(@$user->gold)){{ 'checked' }} @endif>
                                              <label for="no">No</label><br>
                                          </div>
                                        </div>
                                       <!-- <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Last Name <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input required type="text" class="form-control" name="last_name" placeholder="Last Name" value="@if(!empty($user->last_name)){{$user->last_name}}@endif">
                                          </div>
                                       </div> -->
                                       <div class="form-group">
                                          <label for="email" class="col-sm-2 control-label">Email <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input type="email" required class="form-control" name="email" placeholder="Email"  value="@if(!empty($user->email)){{$user->email}}@endif">
                                          </div>
                                       </div>
									   
									                      <div class="form-group">
                                          <label for="email" class="col-sm-2 control-label">Hide Email </label>
                                          <div class="col-sm-6">
                                             <input id="hide_email" type="checkbox" name="hide_email" value="1"  @if(!empty($user->hide_email)){{ 'checked' }} @endif>
                                          </div>
                                       </div>
                                       
									                     @if(empty($user->id))
                                       <div class="form-group">
                                          <label for="password" class="col-sm-2 control-label">Password <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input type="password" required class="form-control" name="password" placeholder="Password">
                                          </div>
                                       </div>
                                       @endif
                                       <div class="form-group">
                                          <label for="mobile" class="col-sm-2 control-label">Mobile <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <input type="text" required class="form-control" name="mobile" value="{{@$str_mobile_no_new}}">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="category" class="col-sm-2 control-label">Category</label>
                                          <div class="col-sm-6">
                                             <select name="company_category_id" id="company_category_id" class="custom-select get_sc form-control" data-placeholder="Select">
                                                <option value="">Select Category </option>
                                                @foreach (@$categories as $index => $value)
                                                <option value="{{$value->id}}" {{ $value->id == @$user->company_category_id ? 'selected' :''}}
                                                 >{{$value->name}}</option>
                                                @endforeach 
                                            </select>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="profile_image" class="col-sm-2 control-label">Profile Image <i class="has-error"></i></label>
                                          <div class="col-sm-6">
                                             
                                             <img id="profile-blah-image" src="{{@imageBasePath(@$user->profile_image)}}" alt=""
                                                class="twoFiftySeven" >
                                            @if(!empty($user->profile_image))
                                            @else
                                              <!-- <img id="profile-blah-image" src="{{url('front/new/images/10.png')}}" alt="" class="twoFiftySeven"> -->
                                            @endif
                                            <input id="file-uploadten" onchange="readProfileURL(this);" type="file" name="profile_image" accept="image/*" class="marginTopFive">
                                            <h4 class="text-danger ">Note: Please upload image up to {{App\Helpers\UtilitiesTwo::get_max_upload_image_size()}} only.</h4>
                                            <!-- <h4 class="text-danger ">Note: Upload a picture in Square.</h4> -->
                                          </div>
                                       </div>
									   
                                      <div class="form-group">
                    									  <label for="name" class="col-sm-2 control-label">Country<i class="has-error">*</i></label>
                    									  <div class="col-sm-6">
                    										  <select required name="country_id" class="form-control select2 country_id">
                    												<option value="">Choose</option>
                    												@if(!empty($user->country_id) )
                    												  @php $country_id = $user->country_id; @endphp
                    												@else
                    												  @php $country_id = 234; @endphp
                    												@endif
                    												@foreach($countries as $id => $name)
                    													<option value="{{$id}}" {{($id == $country_id) ? 'selected' : ''}}>{{$name}}</option>
                    												@endforeach
                    											</select>
                    									  </div>
                    									</div>
                                       <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Company Description <i class="has-error">*</i></label>
                                          <div class="col-sm-6">
                                             <textarea class="form-control" required rows="9" name="description" id="Userdescription" placeholder="">@if(!empty($user->description)){{$user->description}}@endif</textarea>
                                          </div>
                                       </div>
									   
									   <div class="form-group">
									  <label for="name" class="col-sm-2 control-label">Services<i class="has-error">*</i></label>
									  <div class="col-sm-6">
										 <!-- <input id="Skills" type="text" required name="skills"  value="@if(!empty($user->skills)){{@$user->skills}}@endif" class="form-control skill_get" placeholder=""> -->
										 @include('admin.users.admin_user_skills_drop_down')
									  </div>
								   </div>
									   
                                    </div>
                                	
                                	    <style>
                                        .social_media .form-group {
                                             margin-right: 0px; 
                                             margin-left: 0px; 
                                        }
                                      </style>
                                    <div class="accordion__header">
                                        <h2>Social Media</h2>
                                        <span class="accordion__toggle"></span>
                                    </div>
                                    <div class="accordion__body">
                                        <div class="row social_media">
                                            @foreach(config('cms.social_media') as $index => $social)
                                                @php
                                                  $str_social_val = '';
                                                  if(!empty($user->socialMedia))
                                                  {   
                                                    $str_social_val = @$user->socialMedia->pluck('value','type')->toArray()[$index];
                                                  }
                                                @endphp 
                                                    
                                                    
                                                @if($loop->index > 8)
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <label for="{{ $social }}">{{ $social }}</label>
                                                            <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                                             value="{{$str_social_val}}" class="social form-control">
                                                        </div>
                                                    </div>
                                                @elseif($loop->index > 8 && $loop->index < 16) 
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <label for="{{ $social }}">{{ $social }}</label>
                                                            <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                                            value="{{$str_social_val}}" class="social form-control">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <label for="{{ $social }}">{{ $social }}</label>
                                                            <input type="url" id="{{ $social }}" name="socials[{{$index}}]"
                                                            value="{{$str_social_val}}" class="social form-control">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
								
								{{--@if(!empty($user_id))
								 @include('admin.users.user_roles_details') --}}	
								
								@include('admin.users.admin_list_innovator_role')								
								
							    {{-- @endif --}}
								

                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="row">
								<input type="hidden"  id="admin_add_edit_profile_role_random_time_stamp_hidden_id" name="admin_add_edit_profile[random_time_stamp_new]" value="{{$str_random_time_stamp_new}}">	
                                        <button type="button" class="btn btn-success" id="createBtn">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="box-footer">

                        </div>
						
						<div class="div">
					
								  @include('admin.users.admin_add_role_popup')

							    </div>
						
                    </div>
                </div>
            </div>
    </section>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){
		  
    
    admin_show_standard_ckeditor_new('Userdescription');
        // $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput();

        $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput({
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
          initialCountry: 'auto',
          geoIpLookup: function(callback) {
            callback('us');
          }
        });
        <?php /*var mob = "{{!empty(@$user->mobile) ? '+'.$user->dial_code.$user->mobile : '0'}}"; */?>        var mob = "{{!empty(@$str_mobile_no_new) ? '+'.@$user->dial_code.@$str_mobile_no_new : '0'}}";
        if(mob != 0){
            $("#add-edit-user-main-box-body-div  [name='mobile']").intlTelInput("setNumber", mob);
        }
        
        $('body').on('click','#add-edit-user-main-box-body-div  #createBtn',function(e){
            e.preventDefault();
      			 if($.trim($('#add-edit-user-main-box-body-div  [name="mobile"]').val()) != '' && $('#add-edit-user-main-box-body-div  [name="mobile"]').intlTelInput("isValidNumber") == false) {
                      $('#add-edit-user-main-box-body-div  .message_box').html('{{ adminTransLang("invalid_mobile_no") }}').removeClass('alert-success hide').addClass('alert-danger');;
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

            $.ajax({
			    url: "{{ route('admin.users.save-add-edit-Company', $user_id) }}",
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
                    window.location.replace('{{ route("admin.companies.index")}}');
                    
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

@include('admin.users.admin_edit_profile_dob_js')

@endsection