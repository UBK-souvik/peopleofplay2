@php
$int_table_role_cnt_flag_new =1;
@endphp

<div class="table-responsive">
   <?php $cnt = 0; ?>
  @foreach ($role_data as $role)
         @if($int_role_data_count_flag<=0 && $int_table_role_cnt_flag_new>5)
         @break;
         @else
         @endif
  <div class="industryroles">
   <?php 
      $roles_url = '#';
      $user_current_info = get_current_user_info();
      $roles_url = App\Helpers\UtilitiesFour::getTeamMemberLinks(@$role->user_ID); 
      // echo "<pre>role_data - "; print_r($role_data->toArray()); die;
   ?>
   <a href="{{$roles_url}}" class="text-dark" target="_blank">
   <div class="indusroles d-flex">
      <div class="industryrolesImages mr-3">
         @php                               
               if(!empty($company_id))
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }
               }
               if(!empty($innovator_id))
               { 
               if($role->at == 1)
               {
               $str_def_image =  @prodEventImageBasePath(@$role->role_profile_image);           
               }
               else if($role->at == 2)
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               else
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }        
               }
               @endphp
         <img src="{{$str_def_image}}" class="rounded-circle">
      </div>
      <div class="industryrolesDetails">
         <div class="industryrolesHead">
            <h3 class="mb-1">
               @foreach(users_user_roles() as $role_key => $users_user_role)
               @if($role_key == @$role->role)
               {{ $users_user_role }} 
               @endif 
               @endforeach
            </h3>
            <h4 class="mb-0">{{@ucwords($str_display_name)}}</h4>
         </div>
         <div class="poprolesDateTime" style="display: none;">
            <p class="mb-0">Dec 2021 - Present &#8226; 1yr 10 mos</p>
            <span>San Francisco Bay Aresa</span>
         </div>
    <!--      <div class="rolesDesp my-2">
            <p> @if(!empty($role->description))
                                 {{$role->description}}
                                 @endif 
                              </p></p>
         </div> -->
      </div>
   </div>
   </a>
</div>
 @php
         $int_table_role_cnt_flag_new++;
         @endphp
         @endforeach 



   <table class="table event_table" style="display: none;">
      <tbody>
         @foreach ($role_data as $role)
         @if($int_role_data_count_flag<=0 && $int_table_role_cnt_flag_new>5)
         @break;
         @else
         @endif
         <tr class="py-4 py-sm-0">
            <td class="pl-0">
               @php                               
               if(!empty($company_id))
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }
               }
               if(!empty($innovator_id))
               { 
               if($role->at == 1)
               {
               $str_def_image =  @prodEventImageBasePath(@$role->role_profile_image);           
               }
               else if($role->at == 2)
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               else
               {
               $str_def_image =  @imageBasePath(@$role->role_profile_image);
               }
               if(empty(@$role->name))
               {
               $str_display_name = @$role->role_at_name;            
               }
               else
               {
               $str_display_name = @$role->name;
               }        
               }
               @endphp
               <img src="{{$str_def_image}}" class="rounded-circle">
            </td>
            <td class="span-style1 mb-1" style="display: block;">
               @foreach(users_user_roles() as $role_key => $users_user_role)
               @if($role_key == @$role->role)
               {{ $users_user_role }} 
               @endif 
               @endforeach
            </td>
            <!-- <td></td> -->          
            <td class=""><a class="mb-1 text-black fontWeightFourH" style="color: #000;">{{@ucwords($str_display_name)}}</a></td>
           <!--  <td class=""><a class="mb-1 span-style1" href="javascript:void(0);" onclick="return openShowRoleModalPopupNew('{{@$role->id}}', '{{$str_role_data_main_div_id}}');">See More</a></td> -->
            <div class="modal" id="SeeMore{{$role->id}}">
               <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                     <div class="modal-header kbg_black">
                        <div class="textContent">
                           <h4 class="modal-title text-white">{{$role_type_data_new}} Role</h4>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal">×</button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-12">
                              <p class="text-black p-0 mb-1"><strong>Role </strong> : 
                                 @foreach(users_user_roles() as $role_key => $users_user_role)
                                 @if($role_key == @$role->role)
                                 {{ $users_user_role }} 
                                 @endif 
                                 @endforeach
                              </p>
                              @php
                              if(!empty($role->people_id))
                              {
                              $str_user_name = App\Helpers\Utilities::getUserName($role->people_data);  
                              }
                              else
                              {
                              $str_user_name = $role->name; 
                              }
                              @endphp
                              <p class="text-black p-0 mb-1"><strong>Name </strong> :  {{@ucwords($str_display_name)}}</p>
                              @if($user->role == 2)
                              <p class="text-black p-0 mb-1">
                                 <strong>At </strong> : 
                                 @foreach ($arr_role_at_list as $arr_role_at_list_key => $arr_role_at_list_val)
                                 @if($arr_role_at_list_key == $role->at)
                                 {{ $arr_role_at_list_val }}
                                 @endif 
                                 @endforeach
                                 <!-- for a product display the name -->
                                 @if($role->at == 1)
                                 {!!'<span>('.@ucwords($str_display_name).')</span>'!!} 
                                 @endif
                              </p>
                              @endif
                              {{-- 
                              <p class="text-black p-0 mb-1"><strong>Date From </strong> :
                                 @if(!empty($role->from_day))
                                 {{$role->from_day}} - 
                                 @endif 
                                 @if(!empty($role->from_month))
                                 {{ get_month($role->from_month) }} -
                                 @endif
                                 @if(!empty($role->from_year))
                                 {{ $role->from_year }}
                                 @endif
                              </p>
                              <p class="text-black p-0 mb-1"><strong>Date To </strong> :
                                 @if(!empty($role->to_day))
                                 {{$role->to_day}} - 
                                 @endif 
                                 @if(!empty($role->to_month))
                                 {{ get_month($role->to_month) }} -
                                 @endif
                                 @if(!empty($role->to_year))
                                 {{ $role->to_year }}
                                 @endif
                              </p>
                              --}}
                              <p class="text-black p-0 mb-1"><strong>Description </strong> : 
                                 @if(!empty($role->description))
                                 {{$role->description}}
                                 @endif 
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </tr>
         @php
         $int_table_role_cnt_flag_new++;
         @endphp
         @endforeach      
      </tbody>
   </table>
</div>

<div class="industryroles d-none">
   <div class="indusroles d-flex">
      <div class="industryrolesImages">
         <img src="{{$str_def_image}}" class="rounded-circle">
      </div>
      <div class="industryrolesDetails">
         <div class="industryrolesHead">
            <h3 class="mb-1">Business Development</h3>
            <h4 mb-1>Development</h4>
         </div>
         <div class="poprolesDateTime">
            <p class="mb-0">Dec 2021 - Present &#8226; 1yr 10 mos</p>
            <span>San Francisco Bay Aresa</span>
         </div>
         <div class="rolesDesp my-2">
            <p>I write about, culture and language, and politics, among other things.</p>
         </div>
         <div class="rolesGallery">
            <ul>
               <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
              <li>
                <a href="#"><img src="{{ asset('front/images/11.png') }}" alt="profileimage" class="img-fluid"></a>
              </li>
            </ul>
         </div>
      </div>
   </div>
</div>



