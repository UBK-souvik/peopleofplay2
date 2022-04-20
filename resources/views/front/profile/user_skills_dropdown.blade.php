@php 
                            $arr_skills_explode = array();
							
							if($user->role == 3)
							{
							   $str_skills_list =  @$user->services;
							}
							else
							{
							   $str_skills_list =  @$user->skills;
							}
							
							//if(strpos($str_skills_list, ',')>0)
							//{
                                $arr_skills_explode = explode(',', @$str_skills_list); 
							//}
							//else
							//{
							  if(empty($arr_skills_explode) || count($arr_skills_explode)<=0)
							  {
							     $arr_skills_explode[] = $str_skills_list;	
							  }
							//}
						     
							 $arr_skills_explode = array_unique($arr_skills_explode);
						     
							 if(!empty($arr_skills_explode) && count($arr_skills_explode)>1)
							 {
							    $str_skills_data_new =  implode(',', $arr_skills_explode);	 
							 }
							 else
							 {
								$str_skills_data_new =  $arr_skills_explode[0];
							 }
                            						
					    @endphp
				  
                  <span class="autocomplete">
                      <input id="Skills" type="text" required name="skills"  value="{{$str_skills_data_new}}" placeholder="Type Here">
                      {!!App\Helpers\UtilitiesTwo::getTagText()!!}
					  <!--<div class="autocomplete-items">
                      </div> -->
					  
                  </span> 
				  
				  <?php /*<select  id="Skills" name="skills[]" class="custom-select select2" multiple data-placeholder="Select">
                        {{-- <option value="">Select</option> --}}
                        @foreach ($get_skill_list as $get_skill_list_row)
                        @php
							   $arr_skill_row =  json_decode(@$get_skill_list_row);
							   $get_skill_list_index = @$arr_skill_row->id;
							   $get_skill_list_value = @$arr_skill_row->name;
                               @endphp                         
						 <option @if(!empty($arr_skills_explode) && in_array($get_skill_list_value, $arr_skills_explode)){{ 'selected' }}  @endif value="{{$get_skill_list_value}}">
                          {{$get_skill_list_value}}</option>
                        @endforeach
                        </select> */?>
										