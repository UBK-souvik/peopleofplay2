<div class="accordion__header">
        <h2>Personal Details</h2>
        <span class="accordion__toggle"></span>
    </div>
    <div class="accordion__body">
      <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Primary Mobile <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input type="text" required class="form-control" name="mobile" value="{{@$str_mobile_no_new}}">
          </div>
       </div>
	  <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Primary Phone <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="phone_number" required type="number" name="phone_number" value="@if(!empty($user->phone_number)){{@$user->phone_number}}@endif" class="form-control" placeholder="">
          </div>
       </div>
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Primary Email <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input type="email" required class="form-control" name="email" placeholder=""  value="@if(!empty($user->email)){{$user->email}}@endif">
          </div>
       </div> 

       <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Hide Email </label>
          <div class="col-sm-6">
		            <input id="hide_email" type="checkbox" name="hide_email" value="1"  @if(!empty($user->hide_email)){{ 'checked' }} @endif>
          </div>
       </div> 
        <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Phone<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input  id="Phone" type="number" name="phone_number" value="@if(!empty($user->phone_number)){{@$user->phone_number}}@endif" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Email<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input id="primary_email" required type="email" name="primary_email" value="@if(!empty($user->email)){{@$user->email}}@endif"class="form-control" placeholder="">
          </div>
        </div>
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Primary Mobile<i class="has-error">*</i></label>
          <div class="col-sm-6">
             <input  id="primary_mobile" required type="number" name="primary_mobile" value="@if(!empty($user->mobile)){{@$user->mobile}}@endif" class="form-control" placeholder="">
          </div>
        </div> -->
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="secondary_phone" type="number" name="secondary_phone_number" value="@if(!empty($user->secondary_phone_number)){{@$user->secondary_phone_number}}@endif" class="form-control" placeholder="">
          </div>
        </div>
         <!-- <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Phone<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input >
          </div>
        </div> -->
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Secondary Email<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input  id="secondary_email" type="Email" name="secondary_email" value="@if(!empty($user->secondary_email)){{@$user->secondary_email}}@endif"class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label">Secondary Mobile <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input  id="secondary_mobile" type="number" name="secondary_mobile" value="@if(!empty($user->secondary_mobile)){{@$user->secondary_mobile }}@endif" class="form-control" placeholder="">
          </div>
       </div> 
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Postal Address<i class="has-error"></i></label>
          <div class="col-sm-6">
             <textarea class="form-control" rows="1" id="PostalAddress" name="postal_address"  placeholder="">@if(!empty($user->postal_address)){{@$user->postal_address}}@endif</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">City<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="City" type="text" name="city" value="@if(!empty($user->city)){{@$user->city}}@endif" class="form-control" placeholder="">
          </div>
        </div>
		    <div class="form-group">
          <label for="name" class="col-sm-2 control-label">State<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="State" type="text" name="state" value="@if(!empty($user->state)){{@$user->state}}@endif" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Postcode/Zipcode<i class="has-error"><!--* --></i></label>
          <div class="col-sm-6">
             <input id="PostcodeZipcode"  type="text" name="zip_code" value="@if(!empty($user->zip_code)){{@$user->zip_code}}@endif" class="form-control"
                placeholder="">
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
          <label for="name" class="col-sm-2 control-label">Business Address<i class="has-error"></i></label>
          <div class="col-sm-6">
             <textarea class="form-control" required rows="1" name="business_address" id="business_address" placeholder="">@if(!empty($user->business_address)){{@$user->business_address}}@endif</textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address City <i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="City"  type="text" name="city_business" value="@if(!empty($user->city_business)){{@$user->city_business}}@endif" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address State<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="State" type="text" name="state_business" value="@if(!empty($user->state_business)){{@$user->state_business}}@endif" class="form-control" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address Postcode/Zipcode<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="PostcodeZipcode"  type="text" name="zip_code_business" value="@if(!empty($user->zip_code_business)){{@$user->zip_code_business}}@endif" class="form-control"
                placeholder="">
          </div>
        </div>
		
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Business Address Country<i class="has-error"></i></label>
          <div class="col-sm-6">
             <select name="country_id_business" class="form-control select2 country_id">
                    <option value="">Choose</option>
                    @if(!empty($user->country_id_business) )
                      @php $country_id = $user->country_id_business; @endphp
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
          <label for="name" class="col-sm-2 control-label">Website<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="Website" required type="text" name="website" value="@if(!empty($user->website)){{@$user->website}}@endif" class="form-control" placeholder="">
          </div>
        </div>
		
		<div class="form-group">
          <label for="name" class="col-sm-2 control-label">Date of Birth <i class="has-error">*</i></label>
          <div class="col-sm-6">
             <!-- <input id="dateofbirth" required type="date" name="dob" value="@if(!empty($user->dob)){{$user->dob }}@endif" class="form-control"> -->
				      {{-- 
                <select class="col-sm-3 dmy day rightMargin" name="dobday" id="dobday">
                  @if(!empty(@$user->dobday))
                      <option value="{{@$user->dobday}}" selected="">{{@$user->dobday}}</option> 
                  @endif
                </select>
                <select class="col-sm-3 dmy month rightMargin" name="dobmonth" id="dobmonth">
                  @if(!empty(@$user->dobmonth))
                      <option value="{{@$user->dobmonth}}" selected="">{{@$user->dobmonth}}</option>
                  @endif
                </select>
                <select class="col-sm-3 dmy year rightMargin" name="dobyear" id="dobyear">
                  @if(!empty(@$user->dobyear))
                      <option value="{{@$user->dobyear}}" selected="">{{@$user->dobyear}}</option>
                  @endif
  				      </select> 
              --}}
		
			  
              <select class="col-sm-3 dmy year1 rightMargin" name="dobyear" id="dobyear"></select>
              <select class="col-sm-3 dmy month1 rightMargin" name="dobmonth" id="dobmonth"></select>
      			  <select class="col-sm-3 dmy day1 rightMargin" name="dobday" id="dobday"></select>
          </div>
       </div>   
	   @php
	     $int_dobday =  @$user->dobday;
	     $int_dobmonth =  @$user->dobmonth;
		 $int_dobyear =  @$user->dobyear;
		 
		 $str_dob_date_new = $int_dobday . "-" . $int_dobmonth . "-" . $int_dobyear;
	   @endphp	 
	   
	   @if(!empty($user->dobyear))
	  	 
       <div class="form-group">
          <label for="name" class="col-sm-2 control-label">User Age<i class="has-error"></i></label>
          <div class="col-sm-6">
             <input id="UserAge" type="text" name="age" readonly value="@if(!empty($user->dobyear)){{@Carbon\Carbon::parse($str_dob_date_new)->age}}@endif" class="form-control" placeholder="">
          </div>
       </div>
	   @endif
        
    </div>

    <style type="text/css">
      span.select2.select2-container.select2-container--default.select2-container--below { width: 505px !important }
      .country_id { width: 505px !important }
    </style>