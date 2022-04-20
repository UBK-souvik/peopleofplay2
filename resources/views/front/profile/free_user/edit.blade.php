@extends('front.layouts.pages')
@section('content')

<div class="left-column">
    <div class="First-column border_right">
      <form id="profileForm">
        @csrf
        <div class="col-md-12">
        <div id="FirstRow_Product" class="row sectionTop">
          <h3 class="Tile-style social pt-0 w-100 mb-0">Contact Information</h3>
            <!-- <div class="col-md-12"> -->
            {{-- 
			@if($user->profile_image)
           <!--  <img id="blah" src="{{imageBasePath($user->profile_image)}}" alt=""
                class="img-fluid imgtwoeighty">
            @endif
            <div class="form-group ProfileUploadBtn mt-2 mb-0">
                <input id="file-uploadten" onchange="readURL(this);" class="custom-file-input1" type="file" name="profile_image" accept="image/*" />
            </div> -->
			--}}
            <!-- <div class="ProfileUploadBtn  text-left">
                <small class="text-danger ">Note: Please upload 4*5 ratio size image</small>
              </div> -->

			<!-- <div class="form-group">
              <label for="CompanyID">User ID</label>
              <input id="CompanyID" type="number" name="user_id_number" readonly value="{{ $user->user_id_number }}" class="form-control" placeholder="">
            </div> -->

          <!-- </div> -->
          <!-- <div class="col-md-8 colmargin"> -->
		  {{-- <!-- <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="UserName">User Name</label>
                  <input id="UserName" type="text" name="username" value="{{ $user->username }}" class="form-control" placeholder="">
                </div>
              </div>
		  </div>  -->--}}
            <!-- <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="UserName">First Name</label><span class="text-danger">*</span>
                  <input id="first_name" type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="">
                </div>
              </div>
            </div> -->
			<!-- <div class="row">
              <div class="col-md-12 ">
                <div class="form-group mb-0">
                  <label for="UserName">Last Name</label><span class="text-danger">*</span>
                  <input id="last_name" type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" placeholder="">
                </div>
              </div>
            </div> -->
			{{-- <!-- <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="UserRoles">User Role</label><span class="text-danger">*</span>
                  <input id="UserRoles" type="text" name="role" readonly class="form-control" value="{{ @config('cms.role')[$user->role]}}" placeholder="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="Userdescription">User description</label><span class="text-danger">*</span>
                  <textarea class="form-control" rows="5" name="description" id="Userdescription" placeholder="">{{ $user->description }}</textarea>
                </div>
              </div>
            </div> --> --}}
          <!-- </div> -->
        </div>
      </div>
		<!-- <hr> -->

              
        
      <div class="col-md-12">
        <div class="row sectionTop" style="padding-top: 0;">
          <!-- <h3 class="sec_head_text w-100">Contact Information</h3> -->

          <div class="col-md-4 pl-0 inputPaddingLeft">
            <div class="form-group">
              <label for="UserName">First Name</label><span class="text-danger">*</span>
              <input id="first_name" type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="">
            </div>
          </div>

          <div class="col-md-4 ">
            <div class="form-group">
              <label for="UserName">Last Name</label><span class="text-danger">*</span>
              <input id="last_name" type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" placeholder="">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group mb-0 marginBottomSixteen ">
              <label for="Email">Primary Email</label><span class="text-danger">*</span>
              <input id="Email" type="Email"  readonly name="Email" value="{{ $user->email }}"class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-4 pl-0 inputPaddingLeft">
            <div class="form-group mb-0">
              <label for="Mobile">Primary Mobile</label><span class="text-danger">*</span>
              <input id="Mobile" type="number"  name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="">
            </div>
          </div>

        </div>
      </div>
        <div class="row">
          {{-- <!-- <div class="col-md-4">
            <div class="form-group">
              <label for="Email">Secondary Email</label>
              <input id="secondary_email" type="Email" name="secondary_email" value="{{ $user->secondary_email }}"class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Phone">Secondary Phone</label>
            <input id="secondary_phone" type="number" name="secondary_phone_number" value="{{$user->secondary_phone_number}}" class="form-control" placeholder="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Mobile">Secondary Mobile</label>
              <input id="secondary_mobile" type="number" name="secondary_mobile" value="{{$user->secondary_mobile}}" class="form-control" placeholder="">
            </div>
          </div> --> --}}
        </div>
		<div class="row">
          {{-- <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="PostalAddress">Postal Address</label>
              <textarea class="form-control" rows="1" id="PostalAddress" name="postal_address"  placeholder="">{{ $user->postal_address }}</textarea>
            </div>

            <div class="form-group">
              <label for="State">State</label>
              <input id="State" type="text" name="state" value="{{ $user->state }}" class="form-control" placeholder="">
            </div>
          </div> --> --}}
          {{-- <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="Postcode/Zipcode">Postcode/Zipcode</label>
              <input id="PostcodeZipcode" type="number" name="zip_code" value="{{ $user->zip_code }}" class="form-control"
                placeholder="">
            </div>
            <div class="form-group">
                <label for="Country">Country</label>
                <select name="country_id" class="form-control select2">
                    <option value="">Choose</option>
                    @foreach($countries as $id => $name)
                    <option value="{{$id}}" {{$id == $user->country_id ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>

          </div> --> --}}
          <div class="col-md-3">
            {{-- <!-- <div class="form-group">
              <label for="BusinessAddress">Business Address</label>
              <textarea class="form-control" rows="1" name="business_address" id="business_address" placeholder="">{{ $user->business_address }}</textarea>
            </div> --> --}}
            {{-- <!-- <div class="form-group">
              <label for="Website">Website</label>
              <input id="Website" type="text" name="website" value="{{ $user->website }}" class="form-control" placeholder="">
            </div> --> --}}

			<!-- <div class="form-group">
              <label for="City">City</label>
              <input id="City" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="State">State</label>
              <input id="State" type="text"  class="form-control" placeholder="">
            </div> -->
          </div>
          <div class="col-md-12">
            {{-- <!-- <div class="form-group">
              <label for="City">City</label>
              <input id="City" type="text" name="city" value="{{ $user->city }}" class="form-control" placeholder="">
            </div> --> --}}


            <!-- <div class="form-group">
              <label for="Country">Country</label>
              <input id="Country" type="text" name="Country" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="Website">Website</label>
              <input id="Website" type="text" name="Website" class="form-control" placeholder="">
            </div> -->

          </div>

        </div>
        <div class="col-md-12">
          <div class="row sectionBox">
            <button type="button" class="btn btnAll profileEdit">Update</button>
          </div>
        </div>
        
        </form>
    </div>
  </div>

@endsection

@section('scripts')
<!-- // preview images by kundan -->
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


		/*function populate_edit_role_data()
		{
			var str_role_name = $(this).data("role-name");

			alert(str_role_name);

			$('#add_edit_profile_role_name').val(str_role_name);
		}*/
</script>
<script>

    $(function ($) {

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

        $(document).on('click', '.profileEdit', function (e) {
            e.preventDefault();


            var fd = new FormData($('#profileForm')[0]);
            $.ajax({
                url: "{{ route('front.user.profile.edit') }}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {
                    $('.profileEdit').attr('disabled', true);
                    // $('.message_box').html('').removeClass('alert-success').addClass('hide alert-danger');
                },
                error: function (jqXHR, exception) {
                    $('.profileEdit').attr('disabled', false);

                    var msg = formatErrorMessage(jqXHR, exception);
                    toastr.error(msg)
                    console.log(msg);
                    // $('.message_box').html(msg).removeClass('hide');
                },
                success: function (data) {
                    $('.profileEdit').attr('disabled', false);
                    // $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
                    toastr.success(data.message)
                    // window.location.replace('{{ route("admin.users.index")}}');
                    // window.location.replace('{{ route("front.login")}}');

                }
            });
        });
    });
 </script>
@endsection
