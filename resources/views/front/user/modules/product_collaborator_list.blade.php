@if(!empty($peoples_list_data) && count($peoples_list_data)>0)

<div class="col-md-12" id="teamsection">
    <div class="row sectionBox">
        <h2 class="sec_head_text text-left w-100">Collaborator</h2>
        <div class="w-100 TableTeam">
            <div class="industryroles">
        
                 @foreach($peoples_list_data as $collaborator_key => $collaborator)
                      @php
                       $str_colloborator_name = '';
                       $str_colloborator_profile_image = '';
                       if(!empty($collaborator->people_name))

                       {

                           $str_colloborator_name = @$collaborator->people_name;

                       }

                       else

                       {

                           $str_colloborator_name = @$collaborator->name;

                       }

                       

                       $str_colloborator_profile_image = @imageBasePath($collaborator->profile_image);

                        $base_url = url('/');

                        $str_user_url_new = "#";

                        if($user_current_info_new = App\Models\User::find(@$collaborator->u_id) ){

                            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);

                        }

                      @endphp 
                        @if($collaborator_key <= 2 )
                           <div class="indusroles d-flex ">
               <div class="industryrolesImages mr-3">
                 <img src="{{@$str_colloborator_profile_image}}" class="rounded-circle">
              </div>
              <div class="industryrolesDetails">
                 <div class="industryrolesHead">
                    <h3 class="mb-1">{{@$str_colloborator_name}}</h3>
                    <h4 class="mb-0">
                         @foreach(users_user_roles() as $key => $value)
                                @if(@$collaborator->role == $key)
                                     {{$value}}
                                @endif
                         @endforeach

                    </h4>
                 </div>
              </div>
              </div>
                @endif

                    @endforeach


                     @if(count($peoples_list_data) > 3 )

                        @foreach($peoples_list_data as $collaborator_key => $collaborator)

                        @php

                           $str_colloborator_name = '';

                           $str_colloborator_profile_image = '';
                         if(!empty($collaborator->people_name))

                           {

                               $str_colloborator_name = @$collaborator->people_name;

                           }

                           else

                           {

                               $str_colloborator_name = @$collaborator->name;

                           }

                           

                           $str_colloborator_profile_image = @imageBasePath($collaborator->profile_image);

                           $base_url = url('/');

                            $str_user_url_new = "#";

                            if($user_current_info_new = App\Models\User::find(@$collaborator->u_id) ){

                                $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);

                            }
                         @endphp 
                            @if($collaborator_key > 2 )
                               <div class="indusroles d-flex ">
                             <div class="industryrolesImages m-3">
                                  <img src="{{@$str_colloborator_profile_image}}" class="rounded-circle ">
                                    </div>

                                    <div class="industryrolesDetails">
                 <div class="industryrolesHead">
                    <h3 class="mb-1"><a href="{{@$str_user_url_new}}" class="dac_name">{{@$str_colloborator_name}}</a></h3>
                    <h4 class="mb-0">
                          @foreach(users_user_roles() as $key => $value)
                                              @if(@$collaborator->role == $key)
                                                {{$value}}
                                              @endif
                                        @endforeach

                    </h4>
                 </div>
              </div>
              </div>



                            @endif
                        @endforeach
                    
                @endif


         
        </div>
            <table class="table event_table short_collaborator_list d-none w-100 TableTeam">
                <tbody>
                    @foreach($peoples_list_data as $collaborator_key => $collaborator)
					  @php
					   $str_colloborator_name = '';
					   $str_colloborator_profile_image = '';
					   if(!empty($collaborator->people_name))

					   {

						   $str_colloborator_name = @$collaborator->people_name;

					   }

					   else

					   {

						   $str_colloborator_name = @$collaborator->name;

					   }

					   

					   $str_colloborator_profile_image = @imageBasePath($collaborator->profile_image);

					    $base_url = url('/');

                        $str_user_url_new = "#";

                        if($user_current_info_new = App\Models\User::find(@$collaborator->u_id) ){

                            $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);

                        }

					  @endphp 

					  

                        @if($collaborator_key <= 2 )

                            <tr class="py-0 px-3">

                                <td class="pl-0">

								<img src="{{@$str_colloborator_profile_image}}" class="rounded-circle "> 									

							    </td>

                                <td class=""><a href="{{@$str_user_url_new}}" class="dac_name">{{@$str_colloborator_name}}</a></td>

                                <td class=""><p class="dac_name mb-0" style="color: #000;">

                                    @foreach(users_user_roles() as $key => $value)

                                          @if(@$collaborator->role == $key)

                                            {{$value}}

                                          @endif

                                    @endforeach

                                </p></td>

                            </tr>

                        @endif

                    @endforeach

                </tbody>

                @if(count($peoples_list_data) > 3 )

                    <tbody id="dots"></tbody>

                @endif

                @if(count($peoples_list_data) > 3 )

                    <tbody id="more">

                        @foreach($peoples_list_data as $collaborator_key => $collaborator)

						@php

						   $str_colloborator_name = '';

						   $str_colloborator_profile_image = '';
                         if(!empty($collaborator->people_name))

						   {

							   $str_colloborator_name = @$collaborator->people_name;

						   }

						   else

						   {

							   $str_colloborator_name = @$collaborator->name;

						   }

						   

						   $str_colloborator_profile_image = @imageBasePath($collaborator->profile_image);

                           $base_url = url('/');

                            $str_user_url_new = "#";

                            if($user_current_info_new = App\Models\User::find(@$collaborator->u_id) ){

                                $str_user_url_new = App\Helpers\Utilities::get_user_url($base_url, $user_current_info_new);

                            }
						 @endphp 
                            @if($collaborator_key > 2 )
                                <tr class="px-3">
                                    <td class="pl-0">
                                  <img src="{{@$str_colloborator_profile_image}}" class="rounded-circle ">
									</td>
                                    <td class=""><a href="{{@$str_user_url_new}}" class="dac_name">{{@$str_colloborator_name}}</a></td>
                                    <td class="pt-3"><p class="dac_name mb-0" style="color: #000;">
                                        @foreach(users_user_roles() as $key => $value)
                                              @if(@$collaborator->role == $key)
                                                {{$value}}
                                              @endif
                                        @endforeach
                                    </p></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                @endif
            </table>



            <div class="mt-3">

                @if(count($peoples_list_data) > 3 )

                    <span class="span-style1 see_full_list expand" onclick="myFunction()" id="myBtn" style="cursor: pointer;">

                            Expand >>

                    </span>

                @endif

                @if(isset(Auth::guard('users')->user()->type_of_user) && Auth::guard('users')->user()->type_of_user == 2)

                @else

                    <div class="mt-3 mb-0">

                        <a class="span-style1" href="#"data-toggle="modal" data-target="#modal-more-at-poppro-popup"><img src="{{  asset('front/new/images/PopPro.png') }}" class="img-fluid PopPro_icon"> - See production, sales & company info</a>

                    </div>

                @endif

            </div>   

        </div>

    </div>

</div>

@endif	



<style type="text/css">

    #more {display: none;}

</style>