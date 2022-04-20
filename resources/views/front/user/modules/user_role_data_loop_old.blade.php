@php
$int_table_role_cnt_flag_new =1;
@endphp
<div class="table-responsive">
   <table class="table event_table">
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