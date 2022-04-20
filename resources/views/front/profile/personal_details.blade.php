 @if((!empty($user->email) && $user->hide_email ==0) || !empty($user->phone_number) || !empty($user->mobile) || !empty($user->secondary_email) || !empty($user->postal_address) || !empty($user->city) || !empty($user->state) || !empty($user->secondary_phone_number) || !empty($user->zip_code) || !empty($user->countrydata->country_name) || !empty($user->business_address) || !empty($user->city_business) || !empty($user->state_business) || !empty($user->zip_code_business) || !empty($user->country_id_business) || !empty($str_user_website) || !empty($user->virtual_show_room) || (!empty($user->dobday) AND !empty($user->dobmonth)))
<?php //echo "dsf"; die; ?>
<div class="col-md-12 strong_size">
   <div class="row sectionBox ProfilePersonalDetails">
      <h3 class="sec_head_text w-100">Contact Information
         @if(isset(Auth::guard('users')->user()->id) && Auth::guard('users')->user()->id == $user->id)
         <a href="{{ $str_profile_user_edit }}" class="move_edit_page" title="Edit Contact Infomation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
         @endif
      </h3>
      <div class="w-100">
         {{-- ($int_chk_user_logged_id == $int_user_id_current_new) &&  || (($int_chk_user_logged_id!=$int_user_id_current_new)  --}}
         @if(!empty($user->phone_number))
         <p class="text-black p-0 mb-1"><strong>Primary Phone</strong> :{{ $user->phone_number }}</p>
         @endif
         @if(have_permission('email') )
         @if(empty($user->hide_email))  
         @if(!empty($user->email))
         <p class="text-black p-0 mb-1"><strong>Primary Email</strong> : {{ $user->email }}</p>
         @endif
         @endif
         @endif
         @if(!empty($user->mobile))
            @if(empty($user->hide_telephone))  
               <p class="text-black p-0 mb-1"><strong>Telephone</strong> : {{@App\Helpers\UtilitiesFour::getUserDialCode($user)}} {{$user->mobile}}</p>
            @endif
         @endif
         @if(!empty($user->secondary_phone_number))
         <p class="text-black p-0 mb-1"><strong>Secondary Phone</strong> : {{@App\Helpers\UtilitiesFour::getUserDialCode($user)}} {{ $user->secondary_phone_number }}</p>
         @endif
         @if(have_permission('email') )
         @if(!empty($user->secondary_email) && empty($user->hide_secondary_email))
         <p class="text-black p-0 mb-1"><strong>Secondary Email</strong> : {{ $user->secondary_email }}</p>
         @endif
         @endif
         @if(!empty($user->secondary_mobile))
         <p class="text-black p-0 mb-1"><strong>Secondary Mobile</strong> : {{@App\Helpers\UtilitiesFour::getUserDialCode($user)}} {{ $user->secondary_mobile }}</p>
         @endif
         @if(have_permission('postal_address') )
         @if(!empty($user->postal_address))
         <p class="text-black p-0 mb-1"><strong>Postal Address</strong> : {{ $user->postal_address }}</p>
         @endif
         @endif
         @if(have_permission('city') )
         @if(!empty($user->city))
         <p class="text-black p-0 mb-1"><strong>City</strong> : {{ $user->city }}</p>
         @endif
         @endif
         @if(have_permission('state') )
         @if(!empty($user->state))
         <p class="text-black p-0 mb-1"><strong>State</strong> : {{ $user->state }}</p>
         @endif
         @endif
         @if(have_permission('post_zip_code') )
         @if(!empty($user->zip_code))
         <p class="text-black p-0 mb-1"><strong>Postcode/Zipcode</strong> : {{ $user->zip_code }}</p>
         @endif
         @endif
         @if(have_permission('country') )
         @if(!empty($user->countrydata->country_name))
         <p class="text-black p-0 mb-1"><strong>Country</strong> : {{ $user->countrydata->country_name }}</p>
         @endif
         @endif
         @if(have_permission('bussiness_address') )
         @if(!empty($user->business_address))
         <p class="text-black p-0 mb-1"><strong>Business Address</strong> : {{ $user->business_address }}</p>
         @endif
         @endif
         @if(have_permission('city_business') )
         @if(!empty($user->city_business))
         <p class="text-black p-0 mb-1"><strong>Business Address City</strong> : {{ $user->city_business }}</p>
         @endif
         @endif
         @if(have_permission('state_business') )
         @if(!empty($user->state_business))
         <p class="text-black p-0 mb-1"><strong>Business Address State</strong> : {{ $user->state_business }}</p>
         @endif
         @endif
         @if(have_permission('zip_code_business') )
         @if(!empty($user->zip_code_business))
         <p class="text-black p-0 mb-1"><strong>Business Address Postcode/Zipcode</strong> : {{ $user->zip_code_business }}</p>
         @endif
         @endif
         @if(have_permission('country_id_business') )
         @if(!empty($user->country_id_business))
         <p class="text-black p-0 mb-1"><strong>Business Address Country</strong> : {{ $user->countryDataBusiness->country_name }}</p>
         @endif
         @endif
         @if(have_permission('website') )
         @if(!empty($str_user_website))
         <p class="text-black p-0 mb-1"><strong>Website</strong> : 
           <a href="{{ (strpos($str_user_website, 'http://') !== 0 && strpos($str_user_website, 'https://') !== 0 ) ? 'http://'.$str_user_website : $str_user_website }}" target="_blank"> {{ @$user->website }}</a>
         </p>
         @endif 
         @endif
         @if($user->role == 3 || $user->role == 2 )
         @if(!empty($user->virtual_show_room))
         <p class="text-black p-0 mb-1"><strong>Virtual Show Room</strong> : <a target="_blank" href="{{ $user->virtual_show_room}}"> View </a></p>
         @endif
         @endif
         <!-- <p class="text-black p-0 mb-1"><strong>City</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>State</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>Postcode/Zipcode</strong> : Dynamic </p>
            <p class="text-black p-0 mb-1"><strong>Country</strong> : Dynamic </p> -->
         @if(!empty($user->dobday) AND !empty($user->dobmonth))
         <p class="text-black p-0 mb-1"><strong>Date of birth</strong> : 
            @if(!empty($user->dobday))
            {{$user->dobday}}
            @endif 
            -
            @if(!empty($user->dobmonth))
            {{ get_month($user->dobmonth) }}
            @endif
         </p>
         @endif    
      </div>
   </div>
</div>
  @endif 