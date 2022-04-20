@php 
                            $arr_tags_explode = array();
							
							if(!empty($blog->tag))
							{
							   $str_tags_list =  @$blog->tag;
							}
							
							if(!empty($news->tag))
							{
							   $str_tags_list =  @$news->tag;
							}

							if(!empty(@$news_Feeds->tag))
							{
							   $str_tags_list =  @$news_Feeds->tag;
							}
							
							//if(strpos($str_tags_list, ',')>0)
							//{
                                $arr_tags_explode = explode(',', @$str_tags_list); 
							//}
							//else
							//{
							  if(empty($arr_tags_explode) || count($arr_tags_explode)<=0)
							  {
							     $arr_tags_explode[] = $str_tags_list;	
							  }
							//}
						     
							 $arr_tags_explode = array_unique($arr_tags_explode);
						     
							 if(!empty($arr_tags_explode) && count($arr_tags_explode)>1)
							 {
							    $str_tags_data_new =  implode(',', $arr_tags_explode);	 
							 }
							 else
							 {
								$str_tags_data_new =  $arr_tags_explode[0];
							 }
                            						
					    @endphp
				  
                  <span class="autocomplete">
                      <input id="Tag" type="text" required name="tags"  value="{{$str_tags_data_new}}" placeholder="Type Here">
                  </span>